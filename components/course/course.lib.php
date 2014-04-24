<?php

function getCourseList() {
	$table = $CORE->getTableFormat("course");
	return DB::query("SELECT * FROM $table");
}

?>