<?php

error_reporting(E_ALL ^ E_NOTICE);

$CONFIG = new stdClass();

// database config etc
$CONFIG->db_host = 'elighteninstance.ci1ni4buyjcn.us-west-2.rds.amazonaws.com';
$CONFIG->db_name = 'lms';
$CONFIG->db_user = 'lms';
$CONFIG->db_pass = 'c7C4bpWLqyGKmeJs';
$CONFIG->db_enco = 'utf8';
$CONFIG->db_port = null;
$CONFIG->db_prfx = 'lms_'; // database prefix, no underscore!
$CONFIG->dir = 'C:/xampp/htdocs/lms'; // NO TRAILING SLASH!
$CONFIG->www = 'http://localhost/lms'; // NO TRAILING SLASH!



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

?>