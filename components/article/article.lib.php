<?php

function getArticleList() {
	global $CORE;
	$table = $CORE->getTableFormat("article");
	return DB::query("SELECT * FROM $table");
}

?>