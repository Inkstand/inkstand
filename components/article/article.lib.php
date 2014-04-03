<?php

class ArticleLibrary 
{
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

	function editArticle($post) {
		global $CORE;
		$table = $CORE->getTableFormat("article");

		DB::update($table, array(
			'title' => $post['title'],
			'content' => $post['content']
		), "id=%i", $post['id']);

	}
}

?>