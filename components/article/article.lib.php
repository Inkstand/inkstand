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

		if (isset($post['submit1']) && $post['submit1'] == "Delete Article") {
			$this->deleteArticle($post);
		}

		DB::update($table, array(
			'title' => $post['title'],
			'content' => $post['content'],
			'layout' => $post['layout']
		), "id=%i", $post['id']);

	}

	function addArticle($post) {
		global $CORE;
		$table = $CORE->getTableFormat("article");

		DB::insert($table, array(
			'title' => $post['title'],
			'content' => $post['content'],
			'layout' => $post['layout']
		));

		header("Location: " . WWW . "/admin/index.php?path=/components/article/edit.php&");
 		exit;
	}

	function deleteArticle($post) {
		global $CORE;
		$table = $CORE->getTableFormat("article");
		DB::delete($table, "id=%i", $post['id']);

		header("Location: " . WWW . "/admin/index.php?path=/components/article/edit.php&");
 		exit;
	}

	function getArticleLayout($articleid) {
		global $CORE;
		$table = $CORE->getTableFormat("article");
		$result = DB::queryFirstRow("SELECT layout FROM $table WHERE id = %i", $articleid);
		return $result['layout'];
	}
}

?>