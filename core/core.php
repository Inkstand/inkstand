<?php

class Core
{

	public function getSetting($name, $description = false) {
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

	public function setSetting($name, $value, $description = NULL) {
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

	public function getPluginSetting($name, $plugin, $description = false) {
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

	public function setPluginSetting($name, $plugin, $value, $description = NULL) {
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

	public function clearSetting($name) {
		setSetting($name, '', '');
	}

	public function clearPluginSetting($name, $plugin) {
		setPluginSetting($name, $plugin, '', '');
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
		$table = getTableFormat("plugin");
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
}

?>