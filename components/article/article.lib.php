<?php

function getArticleList() {
	$table = getTableFormat("article");
	return DB::query("SELECT * FROM $table");
}

?>