<?php


// import string library 
// require_once 'lib/strings.php';

// password hashing library
require_once 'lib/password.php';

// import MeekroDB for database querying
require_once 'lib/meekrodb.2.2.class.php';

function getSetting($name, $description = false) {
	$result = DB::queryFirstRow("SELECT value, description FROM $PF_config WHERE name=%s", $name);

	if($result === NULL) {
		return false;
	}

	if($description) {
		return array($result['value'], $result['description']);
	} else {
		return $result['value'];
	}
}

function setSetting($name, $value, $description = NULL) {

	if($description === NULL) {
		DB::insertUpdate("$PF_config", array(
		  'value' => $value,
		), 'name=%s', $name);
	} else {
		DB::insertUpdate("$PF_config", array(
		  'value' => $value,
		  'description' => $description
		), 'name=%s', $name);
	}

}

?>