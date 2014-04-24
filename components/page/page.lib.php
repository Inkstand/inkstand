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

		DB::insert($table, array(
			'title' => $page['title'],
			'description' => $page['description'],
			'content' => $page['content'],
			'datecreated' => time(),
			'datemodified' => time(),
			'usercreatedid' => $CORE->userid,
			'usermodifiedid' => $CORE->userid
		));
	}
}

?>