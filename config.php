<?php

error_reporting(E_ALL ^ E_NOTICE);

$CONFIG = new stdClass();

// database config etc
$CONFIG->db_host = 'localhost';
$CONFIG->db_name = 'lms';
$CONFIG->db_user = 'root';
$CONFIG->db_pass = '';
$CONFIG->db_enco = 'utf8';
$CONFIG->db_port = null;
$CONFIG->dir = 'C:/xampp/htdocs/lms'; // NO TRAILING SLASH!
$CONFIG->www = 'http://localhost/lms'; // NO TRAILING SLASH!

$PF = 'lms'; // database prefix, no underscore!



define('DIR', $CONFIG->dir);
define('WWW', $CONFIG->www);


DB::$host = $CONFIG->db_host;
DB::$dbName = $CONFIG->db_name;
DB::$user = $CONFIG->db_user;
DB::$password = $CONFIG->db_pass;
DB::$encoding = $CONFIG->db_enco;
DB::$port = $CONFIG->db_port;

?>