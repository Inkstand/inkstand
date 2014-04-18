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
}

?>