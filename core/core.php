<?php




function getSetting($name, $description = false) {
	$table = getTableFormat("config");
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

function setSetting($name, $value, $description = NULL) {
	$table = getTableFormat("config");

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

function getPluginSetting($name, $plugin, $description = false) {
	$table = getTableFormat("config_plugin");
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

function setPluginSetting($name, $plugin, $value, $description = NULL) {
	$table = getTableFormat("config_plugin");

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

function clearSetting($name) {
	setSetting($name, '', '');
}

function clearPluginSetting($name, $plugin) {
	setPluginSetting($name, $plugin, '', '');
}

function getTableFormat($tableName) {
	global $CONFIG;
	return $CONFIG->db_prfx . $tableName;
}

?>