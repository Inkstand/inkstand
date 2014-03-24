<?php

function getArticleList() {
	global $CORE;
	$table = $CORE->getTableFormat("article");
	return DB::query("SELECT * FROM $table");
}

function getArticle($articleid) {
	global $CORE;
	$table = $CORE->getTableFormat("article");
	return DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $articleid);
}

?>