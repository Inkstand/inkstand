<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

$CONFIG = new stdClass();

// database config etc
$CONFIG->db_host = 'joeconradt.com';
$CONFIG->db_name = 'portfolio';
$CONFIG->db_user = 'portfolio';
$CONFIG->db_pass = 'c7C4bpWLqyGKmeJs';
$CONFIG->db_enco = 'utf8';
$CONFIG->db_port = null;
$CONFIG->db_prfx = 'coco_'; // database prefix, no underscore!

$CONFIG->dir = ''; // NO TRAILING SLASH!
$CONFIG->www = 'http://localhost/modular'; // NO TRAILING SLASH!
/*
$CONFIG->dir = 'c:/xampp/htdocs/moduler'; // NO TRAILING SLASH!
$CONFIG->www = 'http://joeconradt.com'; // NO TRAILING SLASH!
*/



define('DIR', $CONFIG->dir);
define('WWW', $CONFIG->www);

// import string library 
// require_once 'lib/strings.php';

// password hashing library
require_once 'core/lib/password.php';

// import MeekroDB for database querying
require_once 'core/lib/meekrodb.2.2.class.php';

DB::$host = $CONFIG->db_host;
DB::$dbName = $CONFIG->db_name;
DB::$user = $CONFIG->db_user;
DB::$password = $CONFIG->db_pass;
DB::$encoding = $CONFIG->db_enco;
DB::$port = $CONFIG->db_port;

// import the core 
require_once 'core/core.php';

// core instance to use through system
$CORE = new Core();

// import user class
require_once 'core/user.class.php';

//import login library
require_once 'core/lib/login_lib.php';

?>
