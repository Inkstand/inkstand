<?php

// password hashing library
require_once 'core/lib/password.php';

// import MeekroDB for database querying
require_once 'core/lib/meekrodb.2.2.class.php';

if (isset($_POST['submit']) && $_POST['submit'] == 'Install Now') {
	//lets install the cms

	DB::$host = $_POST['dbhost'];
	DB::$dbName = $_POST['dbname'];
	DB::$user = $_POST['dbuser'];
	DB::$password = $_POST['dbpass'];
	DB::$encoding = 'utf8';
	DB::$port = $_POST['dbport'];
	
	//first, lets create the config file
	$config_file = 'config.php';
	$config_creation = fopen($config_file, 'w') or die('Cannot open file:  '. $config_file); //implicitly creates file

	$config_creation = fopen($config_file, 'w') or die('Cannot open file:  '. $config_file);
	$config_data = '
		<?php
		session_start();

		error_reporting(E_ALL);
		ini_set(\'display_errors\', true);

		$CONFIG = new stdClass();

		// database config etc
		$CONFIG->db_host = \'' . $_POST['dbhost'] . '\';
		$CONFIG->db_name = \'' . $_POST['dbname'] . '\';
		$CONFIG->db_user = \'' . $_POST['dbuser'] . '\';
		$CONFIG->db_pass = \'' . $_POST['dbpass'] . '\';
		$CONFIG->db_enco = \'utf8\';
		$CONFIG->db_port = ' $_POST['dbport'] ';
		$CONFIG->db_prfx = \'' . $_POST['dbpref'] . '\'; // database prefix, no underscore!

		$CONFIG->dir = __dir__; // NO TRAILING SLASH!
		$CONFIG->www = \'' . $_POST['webroot'] . '\'; // NO TRAILING SLASH!

		define(\'DIR\', $CONFIG->dir);
		define(\'WWW\', $CONFIG->www);

		// import string library 
		// require_once \'lib/strings.php\';

		// password hashing library
		require_once \'core/lib/password.php\';

		// import MeekroDB for database querying
		require_once \'core/lib/meekrodb.2.2.class.php\';

		DB::$host = $CONFIG->db_host;
		DB::$dbName = $CONFIG->db_name;
		DB::$user = $CONFIG->db_user;
		DB::$password = $CONFIG->db_pass;
		DB::$encoding = $CONFIG->db_enco;
		DB::$port = $CONFIG->db_port;

		// import the core 
		require_once DIR . \'/core/core.php\';

		// core instance to use through system
		$CORE = new Core();

		// import user class
		require_once \'core/user.class.php\';

		if (isset($_POST[\'submit\']))
		{
			$CORE->handle_submit($_POST[\'submit\']);
		} else if (isset($_GET[\'submit\']))
		{
			if ($_GET[\'submit\'] == "Logout")
			{
				$CORE->handle_submit($_GET[\'submit\']);
			}
		}

		$logged_in = $CORE->check_if_logged_in();

		if ($logged_in == true) {
			echo \'<div id = \"logged_in_bar\">\';
				echo "Well hello there, " . $CORE->get_username();
				if ($CORE->is_admin()) {
					echo \' (Admin)   <a href = \' . WWW . \'/login.php?submit=Logout>Logout</a>\';
				} else {
				}	
			echo \'</div>\';
		}
	?>
	';


	fwrite($config_creation, $config_data);


	//next, lets create the tables in the database
	$newtable = "";
	$pref = '';
	if (isset($_POST['dbpref'])) {
		$pref = $_POST['dbpref'];
	}
	$newtable = $pref . "users";
	DB::query("CREATE TABLE $newtable(
		id int(11) NOT NULL AUTO_INCREMENT,
		username varchar(25),
		password varchar(255),
		f_name varchar(255),
		l_name varchar(255),
		useremail varchar(255),
		admin int(1),
		PRIMARY KEY (id)
		); ");

	$newtable = $pref . "logins";
	DB::query("CREATE TABLE $newtable(
		id int(11) NOT NULL AUTO_INCREMENT,
		userid int(11),
		user_ip text,
		user_ip_2 text,
		last_action text,
		PRIMARY KEY (id)
		); ");

	$newtable = $pref . "menu_items";
	DB::query("CREATE TABLE $newtable(
		id int(11) NOT NULL AUTO_INCREMENT,
		menuid int(11),
		type varchar(255),
		data text,
		PRIMARY KEY (id)
		); ");

	$newtable = $pref . "menu";
	DB::query("CREATE TABLE $newtable(
		id int(11) NOT NULL AUTO_INCREMENT,
		name varchar(255),
		PRIMARY KEY (id)
		); ");

	$newtable = $pref . "config";
	DB::query("CREATE TABLE $newtable(
		id int(11) NOT NULL AUTO_INCREMENT,
		name varchar(255),
		description text,
		value text,
		PRIMARY KEY (id)
		); ");



	//populate tables
	$newtable = $pref . "users";
	DB::insert($newtable, array(
	  'username' => $_POST['cmsadmin'],
	  'password' => password_hash($_POST['cmsadminpass'], PASSWORD_DEFAULT),
	  'f_name' => $_POST['cmsadminfirst'],
	  'l_name' => $_POST['cmsadminlast'],
	  'useremail' => $_POST['cmsadminemail'],
	  'admin' => 1
	));

	$newtable = $pref . "menu";
	DB::insert($newtable, array(
	  'name' => 'Main menu'
	));

	$newtable = $pref . "config";
	DB::insert($newtable, array(
	  'name' => 'currenttheme',
	  'description' => 'The current theme.',
	  'value' => 'bootstrap'
	));

	$newtable = $pref . "config";
	DB::insert($newtable, array(
	  'name' => 'homepage',
	  'description' => 'The contents of the homepage.',
	  'value' => 'article'
	));

	$newtable = $pref . "config";
	DB::insert($newtable, array(
	  'name' => 'Mod_Rewrite',
	  'description' => 'Takes out index.php from url',
	  'value' => 0
	));

	$newtable = $pref . "menu_items";
	DB::insert($newtable, array(
	  'menuid' => 1,
	  'data' => 'a:2:{s:4:"text";s:4:"Blog";s:3:"url";s:42:"http://localhost/modular/index.php/article";}',
	  'type' => 'link'
	));
	$newtable = $pref . "menu_items";
	DB::insert($newtable, array(
	  'menuid' => 1,
	  'data' => 'a:3:{s:4:"text";s:5:"About";s:3:"url";s:23:"https://www.google.com/";s:6:"target";s:6:"_blank";}',
	  'type' => 'link'
	));
	$newtable = $pref . "menu_items";
	DB::insert($newtable, array(
	  'menuid' => 1,
	  'data' => 'a:3:{s:4:"text";s:8:"Download";s:3:"url";s:23:"https://www.google.com/";s:6:"target";s:6:"_blank";}',
	  'type' => 'link'
	));


	//use sql from components to create and populate tables
	require_once('components/article/article.sql.php');
	require_once('components/page/page.sql.php');

}


if (file_exists('config.php')) {
	//should already be installed. Lets redirect to home
	require_once('config.php');
	header("Location: " . WWW);
} else {
	//config has not been created, so we must install the cms
	?>
	<h1>Lets install your cms</h1>
	<form action = "install.php" method = "post">
		Database Host <input type = "text" name = "dbhost" /> <br>
		Database Name <input type = "text" name = "dbname" /> <br>
		Database User <input type = "text" name = "dbuser" /> <br>
		Database Password <input type = "text" name = "dbpass" /> <br>
		Database Port <input type = "text" name = "dbport" /> <br>
		Database Prefix <input type = "text" name = "dbpref" /> <br>

		Web Root (NO TRAILING SLASH) <input type = "text" name = "webroot" /> <br><br>


		Admin Credentials<br>
		Admin Username <input type = "text" name = "cmsadmin" /> <br>
		Admin Password <input type = "password" name = "cmsadminpass" /> <br>
		First Name <input type = "text" name = "cmsadminfirst" /> <br>
		Last Name <input type = "text" name = "cmsadminlast" /> <br>
		Email <input type = "text" name = "cmsadminemail" /> <br><br>
		<input type = "submit" name = "submit" value = "Install Now" />
	</form>
	<?php
}

?>