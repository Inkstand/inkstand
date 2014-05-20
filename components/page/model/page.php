<?php

class Page 
{
	public function getPage($id) 
	{
		global $CORE;
		$table = $CORE->get_table_format("page");
		return DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);
	}
	public function get_list_of_pages() {
		global $CORE;
		$table = $CORE->get_table_format("page");
		return DB::query("SELECT * FROM $table");
	}
	public function addPage($page) 
	{

		// insert new page into the database

		global $CORE;
		$table = $CORE->get_table_format("page");

		return DB::insert($table, array(
			'title' => $page['title'],
			'description' => $page['description'],
			'content' => $page['content'],
			'datecreated' => time(),
			'datemodified' => time(),
			'usercreatedid' => 1,
			'usermodifiedid' => 1
		));
	}
	public function editPage($page) 
	{

		// update page record

		global $CORE;
		$table = $CORE->get_table_format("page");

		return DB::update($table, array(
			'title' => $page['title'],
			'description' => $page['description'],
			'content' => $page['content'],
			'datemodified' => time(),
			'usermodifiedid' => $CORE->userid
		), "id=%i", $page['id']);

	}
	public function printSuccess($action) 
	{
		if($action == 'edit') {
			echo '<div class="alert alert-success"><b>Success!</b> Page edited successfully.</div>';
		} 
	}
	public function printFailure($action) 
	{
		if($action == 'edit') {
			echo '<div class="alert alert-danger"><b>Error:</b> The page could not be edited.</div>';
		}
	}
	public function get_created_user($pageid) 
	{
		global $CORE;
		$table = $CORE->get_table_format("page");
		$userid = DB::queryFirstRow("SELECT usercreatedid FROM $table WHERE id = %i", $pageid);
		$table = $CORE->get_table_format("users");
		$user = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $userid['usercreatedid']);
		return $user;
	}
}

?>