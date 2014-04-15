<?php

class PageLibrary 
{
	function getPage($id) {
		global $CORE;
		$table = $CORE->getTableFormat("page");
		return DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);
	}
}

?>