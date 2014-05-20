<?php

class User
{
	private $attributes;

	public function create() {
		global $DB, $CORE;
		// TODO: get required fields for create

		$userid = $this->attributes['id'];
		$table = $CORE->get_table_format("user");

		// see if id is specified, if not it's not possible to progress
		if(!empty($userid)) {
			trigger_error("Cannot create user with an existing ID in class User: Using auto instead.");
			unset($attributes['id']);
		}

		// perform create; all pieces should be in place
		DB::insert($table, $this->attributes);

	}

	public function update() {
		global $DB, $CORE;
		// TODO: get required fields for create

		$userid = $this->attributes['id'];
		$table = $CORE->get_table_format("user");

		// see if id is specified, if not it's not possible to progress
		if(empty($userid)) {
			trigger_error("Cannot update user without ID in class User.");
			return false;
		}

		// check if user exists
		$result = DB::queryFirstRow("SELECT email FROM $table WHERE id=%i", $userid);
		if(empty($result)) {
			trigger_error("Tried to update user that does not exist: creating instead.");
			
			return create();
		} 

		// perform update
		DB::update($table, $this->attributes, "id = $userid");

	}

	public function set($attribute, $value) {
		$this->attributes[$attribute] = $value;
	}

	public function get($attribute) {
		if(!empty($this->attributes[$attribute])) {
			return $this->attributes[$attribute];
		}
		return NULL;
	}

	public function populate($id) {
		global $DB, $CORE;
		$table = $CORE->get_table_format("user");
		$userResult = DB::queryFirstRow("SELECT * FROM $table WHERE id=%i", $id);

		foreach ($userResult as $attributeName => $attributeValue) {
		 	$this->attributes[$attributeName] = $attributeValue;
		} 
	}

	public function getInfo() {

		return $this->attributes;

	}
}

?>