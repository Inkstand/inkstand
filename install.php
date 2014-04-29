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

	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	$url .= $_SERVER["REQUEST_URI"];

	$index = strpos($url, '/install.php');

	$url = substr($url, 0, $index);

	?>
	<link rel="stylesheet" href="plugin/theme/bootstrap/css/bootstrap.min.css">
	<style>
		form {
			max-width: 800px;
			width: 80%;
			margin-left: auto;
			margin-right: auto;
		}
		#background {
			background-image:url(core/resources/images/building.jpg);
			width:100%;
			height:100%;
			position:fixed;
			top:0;
			left:0;
			z-index:-9999;
		}
		h1 {
			text-align:center;
			margin-bottom:75px;
		}
		h2 {
			text-align:right;
		}
		h1, h2 {
			color:#fff;
			text-shadow:0px 0px 1px #000;
		}
		form {
			margin-bottom:75px;
		}
	</style>
	
	<h1>Let's install your Inkstand</h1>
	<form action = "install.php" method = "post">
		<h2>Server Credentials</h2>
		<span class="input-group-addon">Database Host</span> <input class="form-control" type = "text" name = "dbhost" value="localhost" /> <br>
		<span class="input-group-addon">Database Name</span> <input class="form-control" type = "text" name = "dbname" /> <br>
		<span class="input-group-addon">Database User</span> <input class="form-control" type = "text" name = "dbuser" /> <br>
		<span class="input-group-addon">Database Password</span> <input class="form-control" type = "text" name = "dbpass" /> <br>
		<span class="input-group-addon">Database Port</span> <input class="form-control" type = "text" name = "dbport" /> <br>
		<span class="input-group-addon">Database Prefix</span> <input class="form-control" type = "text" name = "dbpref" value="ink_" /> <br>
		<span class="input-group-addon">Web Root (NO TRAILING SLASH)</span> <input class="form-control" type = "text" name = "webroot" value="<?php echo $url ?>"/> <br><br>

		<h2>Admin Credentials</h2>
		<span class="input-group-addon">Admin Username</span> <input class="form-control" type = "text" name = "cmsadmin" /> <br>
		<span class="input-group-addon">Admin Password</span> <input class="form-control" type = "password" name = "cmsadminpass" /> <br>
		<span class="input-group-addon">First Name</span> <input class="form-control" type = "text" name = "cmsadminfirst" /> <br>
		<span class="input-group-addon">Last Name</span> <input class="form-control" type = "text" name = "cmsadminlast" /> <br>
		<span class="input-group-addon">Email</span> <input class="form-control" type = "text" name = "cmsadminemail" /> <br><br>
		<input class="form-control" type = "submit" name = "submit" value = "Install Now" />
	</form>
	<div id='background'></div>
	<?php
}

?>