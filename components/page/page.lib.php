<?php

class PageLibrary 
{
	function getPage($id) {
		global $CORE;
		$table = $CORE->getTableFormat("page");
		return DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);
	}
	function getListOfPages() {
		global $CORE;
		$table = $CORE->getTableFormat("page");
		return DB::query("SELECT * FROM $table");
	}
	function addPage($page) {

		// insert new page into the database

		global $CORE;
		$table = $CORE->getTableFormat("page");

		return DB::insert($table, array(
			'title' => $page['title'],
			'description' => $page['description'],
			'content' => $page['content'],
			'datecreated' => time(),
			'datemodified' => time(),
			'usercreatedid' => $CORE->userid,
			'usermodifiedid' => $CORE->userid
		));
	}
	function editPage($page) {

		// update page record

		global $CORE;
		$table = $CORE->getTableFormat("page");

		return DB::update($table, array(
			'title' => $page['title'],
			'description' => $page['description'],
			'content' => $page['content'],
			'datemodified' => time(),
			'usermodifiedid' => $CORE->userid
		), "id=%i", $page['id']);

	}
	function printSuccess($action) {
		if($action == 'edit') {
			echo '<div class="alert alert-success"><b>Success!</b> Page edited successfully.</div>';
		} 
	}
	function printFailure($action) {
		if($action == 'edit') {
			echo '<div class="alert alert-danger"><b>Error:</b> The page could not be edited.</div>';
		}
	}
}

?>