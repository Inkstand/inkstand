<?php
/*
if(!isset($_COOKIE["PHPSESSID"]))
{
  session_start();
}*/
class Core
{

	public $username = "";
	public $userid = "";

	public function getSetting($name, $description = false) {
		$table = $this->getTableFormat("config");
		$result = DB::queryFirstRow("SELECT value, description FROM $table WHERE name=%s", $name);

		if($result === NULL) {
			return false;
		}

		if($description) {
			return array($result['value'], $result['description']);
		} else {
			return $result['value'];
		}
	}

	public function setSetting($name, $value, $description = NULL) {
		$table = $this->getTableFormat("config");

		if($description === NULL) {
			DB::insertUpdate($table, array(
			  'value' => $value,
			  'name' => $name
			));
		} else {
			DB::insertUpdate($table, array(
			  'value' => $value,
			  'description' => $description,
			  'name' => $name
			));
		}
	}

	public function getPluginSetting($name, $plugin, $description = false) {
		$table = $this->getTableFormat("config_plugin");
		$result = DB::queryFirstRow("SELECT value, description FROM $table WHERE name=%s0 AND plugin=%s1", $name, $plugin);

		if($result === NULL) {
			return false;
		}

		if($description) {
			return array($result['value'], $result['description']);
		} else {
			return $result['value'];
		}
	}

	public function setPluginSetting($name, $plugin, $value, $description = NULL) {
		$table = $this->getTableFormat("config_plugin");

		if($description === NULL) {
			DB::insertUpdate($table, array(
			  'value' => $value,
			  'name' => $name,
			  'plugin' => $plugin
			));
		} else {
			DB::insertUpdate($table, array(
			  'value' => $value,
			  'description' => $description,
			  'name' => $name,
			  'plugin' => $plugin
			));
		}
	}

	public function clearSetting($name) {
		$this->setSetting($name, '', '');
	}

	public function clearPluginSetting($name, $plugin) {
		$this->setPluginSetting($name, $plugin, '', '');
	}

	public function getTableFormat($tableName) {
		global $CONFIG;
		return $CONFIG->db_prfx . $tableName;
	}

	public function getString($name) {
		require_once DIR . "/core/lang/en/strings.php";
		return $strings[$name];
	}

	public function getPluginString($name, $plugin) {
		$table = $this->getTableFormat("plugin");
		$result = queryFirstRow("SELECT type FROM $table WHERE name=%s", $plugin);

		require_once DIR . "/plugin/" . $result['type'] . "/" . $plugin . "/lang/en/strings.php";

		return eval($plugin . "_strings[$name]");
	}

	public function printModule($type, $id) {
		global $CONFIG, $CORE;

		$MODULE = new stdClass();
		$MODULE->id = $id;
		$MODULE->type = $type;
		
		require DIR . "/plugin/module/" . $type . "/module.php";
	}
	public function shortenString($string, $length) {
		if(strlen($string) <= $length) {
			return $string;
		} else {
			return substr($string, 0, $length) . '...';
		}
	}
	public function tinymce($selector = 'textarea', $width = 'auto', $height = 300) {
		?>
		<script type="text/javascript" src="<?php echo WWW; ?>/core/lib/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">

		tinymce.init({
			selector: "<?php echo $selector ?>", 
			theme: "modern", 
			width: "<?php echo $width ?>", 
			height: "<?php echo $height ?>",
			plugins: [
			"advlist autolink link image lists charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
			"table contextmenu directionality emoticons paste textcolor responsivefilemanager"
			],
			toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
			toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
			image_advtab: true ,

			relative_urls:false,
			external_filemanager_path:"<?php echo WWW; ?>/core/lib/filemanager/",
			filemanager_title:"Responsive Filemanager" ,
			external_plugins: { "filemanager" : "<?php echo WWW; ?>/core/lib/filemanager/plugin.min.js"}
		});
		</script>

		<?php
	}


	//login functions
	public function check_if_logged_in(){
		if (isset($_SESSION['user'])) {
			//user is logged in (lets check all the credentials)
			//echo $_SESSION['user'];

			//lets verify the login user with the login table
			$login_results = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
			$verified_login = false;
			foreach ($login_results as $i)
			{
				if ($_SESSION['user'] == hash('ripemd160', $i['id'])) {
					//found the record we are looking for based on the id. Now, we must verify the ip, and then update the last action column
					if ($_SERVER['REMOTE_ADDR'] == $i['user_ip']) {
						//first ip is correct. check if 2nd is set. Then verify it.
						if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							if ($_SERVER['HTTP_X_FORWARDED_FOR'] == $i['user_ip_2']) {
								$verified_login = true;
							}
						} else {
							if ($_SERVER['REMOTE_ADDR'] == $i['user_ip_2']) {
								$verified_login = true;
							}
						}
					}
				}
				if ($verified_login) { //lets update the last action column
					/*DB::replace('logins', array(
					  'id' => $i["id"],
					  'last_action' => time()
					));*/
					DB::update('logins', array(
					'last_action' => time()
					), "id=%s", $i["id"]);
					//echo "You are logged in";
					$userid = $i['userid'];
				}
			}

			if (!$verified_login) {
				//account is not verified correctly. We must unset the session
				
				if(session_id() != '') {
				    session_destroy();
				}
			}

			return $verified_login;
		}
		return false;
	}

	public function handle_submit($submit_value) 
	{
		if ($submit_value == "Login") {
			$this->login_user();
		} else if ($submit_value = "Logout") {
			$this->logout_user();
		}
	}

	public function login_user()
	{
		//echo "form was submitted";
		$form_filled = true;

		//a way to set default values
		if (isset($_POST['username']) && $_POST['username'] != "") 
		{
			$username = $_POST["username"];
		} else
		{
			$username = "";
			$form_filled = false;
		}
		if (isset($_POST['password']) && $_POST['password'] != "") 
		{
			$password = $_POST["password"];
		} else
		{
			$password = "";
			$form_filled = false;
		}

		if ($form_filled)
		{
			$results = DB::query("SELECT id, username, password FROM users");
			foreach ($results as $row) {
				if ($row['username'] == $username)
				{
					if (password_verify($password, $row['password']))
					{
						//echo "Login Correct";
						$logged_in = true;
						//$_SESSION['user'] = $row['id'];

						/*Add login to logins table*/
						$userid = $row['id'];
						$userip = $_SERVER['REMOTE_ADDR'];
						if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							$userip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
						} else {
							$userip2 = $userip;
						}
						
						$current_time = time();

						DB::insert('logins', array(
						  'userid' => $userid,
						  'user_ip' => $userip,
						  'user_ip_2' => $userip2,
						  'last_action' => $current_time
						));

						//now, lets get the id of the session, hash it, and save it in the session variable
						$login_results = DB::query("Select * FROM logins");
						foreach ($login_results as $i)
						{
							if ($i['userid'] == $userid && $i['user_ip'] == $userip && $i['user_ip_2'] == $userip2 && $i['last_action'] == $current_time) {
								//echo "found the record";
								$_SESSION['user'] = hash('ripemd160', $i['id']);
							}
						}




						break;
					}
				} else
				{
					//echo "Username or Password not correct";
					$logged_in = false;
				}
			}
		}
	}

	public function logout_user()
	{
		$logged_in = $this->check_if_logged_in();
		$userid;
		if ($logged_in)
		{
			$current_logs = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
			foreach ($current_logs as $i)
			{
				if ($_SESSION['user'] == hash('ripemd160', $i['id'])) {
					//found the record we are looking for based on the id. Now, we must verify the ip, and then update the last action column
					$userid = $i['userid'];
				}
			}
			if ($userid != "") {
				DB::delete('logins', "userid=%i", "$userid");
			}
			session_destroy();
		} else
		{
			//don't log user out. Something fishy might be happening here
		}

		
	}

	public function require_login() 
	{
		if (!($this->check_if_logged_in())) {
			header("Location: " . WWW ."/login.php");
			exit;
		}
	}

	public function is_admin() {
		if (isset($_SESSION['user'])) {
			//user is logged in (lets check all the credentials)
			//echo $_SESSION['user'];

			//lets verify the login user with the login table
			$login_results = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
			$verified_login = false;
			foreach ($login_results as $i)
			{
				if ($_SESSION['user'] == hash('ripemd160', $i['id'])) {
					//found the record we are looking for based on the id. Now, we must verify the ip, and then update the last action column
					if ($_SERVER['REMOTE_ADDR'] == $i['user_ip']) {
						//first ip is correct. check if 2nd is set. Then verify it.
						if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
							if ($_SERVER['HTTP_X_FORWARDED_FOR'] == $i['user_ip_2']) {
								$verified_login = true;
							}
						} else {
							if ($_SERVER['REMOTE_ADDR'] == $i['user_ip_2']) {
								$verified_login = true;
							}
						}
					}
				}
				if ($verified_login) { //lets update the last action column
					/*DB::replace('logins', array(
					  'id' => $i["id"],
					  'last_action' => time()
					));*/
					DB::update('logins', array(
					'last_action' => time()
					), "id=%s", $i["id"]);
					//echo "You are logged in";

					//checking if user is admin
					$users = DB::query("SELECT id, admin FROM users");
					foreach ($users as $row) {
						if ($row['id'] == $i['userid'])
						{
							//Now, lets check if user is admin, if the login is verified
							if ($row['admin'] == 1) {
								return true;
							} else {
								return false;
							}
						}
					}

				}
			}

			if (!$verified_login) {
				//account is not verified correctly. We must unset the session
				
				if(session_id() != '') {
				    session_destroy();
				}
			}

			return $verified_login;
		}
		return false;
	}

	/*Function to be used for pages that require a certain capability. If no login type is specified in the call, then it will just require a login*/
	public function require_capability($login_type = NULL) {
		$has_capability = false;
		if ($login_type == NULL) {
			//just reqire login
			$this->require_login();
		} else if ($login_type == "Admin") {
			//require admin
			if ($this->is_admin()) {
				$has_capability = true;
			} else {
				echo "You are not admin, so you can't do this";
				exit;
			}
		}
	}

	/* function to print a menu */
	public function menu($menuid) {

		// this will be a very versatile function, allowing the echoing of links, search boxes, dropdowns, etc. 
		// Bootstrap!

		$table = $this->getTableFormat("menu_items");
		$menuitems = DB::query("SELECT * FROM $table WHERE menuid = %i", $menuid);

		// echo some HTML

		echo '<nav style="border-radius:0px" class="navbar navbar-default" role="navigation">';
		echo 	'<div class="container">';
		echo 		'<div class="navbar-header">
				      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="' . WWW . '">Home</a>
				    </div>';

		echo 	'<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">';

		echo 		'<ul class="nav navbar-nav">';

		// loop through all the menu elements 
		foreach ($menuitems as $menuitem) {

			$data = unserialize($menuitem['data']);

			if($menuitem['type'] == "link") {

				if(empty($data['url'])) {
					$data['url'] = "#";
				}
				if(empty($data['target'])) {
					$data['target'] = "_self";
				}
				if(empty($data['text'])) {
					$data['text'] = "[[text]]";
				}

				echo "<li><a href='$data[url]' target='$data[target]'>$data[text]</a></li>";
			}

		}

		echo 		'</ul>';

		echo 		'<form class="navbar-form navbar-right" role="search">
				        <div class="form-group">
				          <input type="text" class="form-control" placeholder="Search">
				        </div>
				        <button type="submit" class="btn btn-default">Submit</button>
				    </form>';

		echo	'</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			</nav>';
	}


	/*Gets logged in username*/
	public function get_username() {
		//$login_results = DB::query("Select id, userid, user_ip, user_ip_2, last_action FROM logins");
		$username = DB::queryFirstField("SELECT username FROM users WHERE username=%i", $this->userid);
		return $username;

	}

	public function link($rel) {
		if ($this->getSetting("Mod_Rewrite") == 0) {
			return WWW . $rel;
		} 
		return WWW . str_replace('index.php/', '', $rel);

		
	}

	public function editlink($component, $file) {

		if(!strpos($file, '.php')) {
			$file .= '.php';
		}

		return "index.php?type=component&path=/components/$component/$file";
	}
}

?>