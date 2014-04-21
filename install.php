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
		$CONFIG->db_port = \'' . $_POST['dbport'] . '\';
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



	//populate tables


	//use sql from components to create and populate tables

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
		Admin Password <input type = "password" name = "cmsadminpass" /> <br><br>
		<input type = "submit" name = "submit" value = "Install Now" />
	</form>
	<?php
}

?>