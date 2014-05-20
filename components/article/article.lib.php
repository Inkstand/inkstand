<?php

class ArticleLibrary 
{
	function get_article_list() {
		global $CORE;
		$table = $CORE->get_table_format("article");
		return DB::query("SELECT * FROM $table");
	}

	function get_article($articleid) {
		global $CORE;
		$table = $CORE->get_table_format("article");
		return DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $articleid);
	}

	function edit_article($post) {
		global $CORE;
		$table = $CORE->get_table_format("article");

		if (isset($post['submit1']) && $post['submit1'] == "Delete Article") {
			$this->delete_article($post);
		}

		DB::update($table, array(
			'title' => $post['title'],
			'content' => $post['content'],
			'layout' => $post['layout'],
			'datemodified' => time()
		), "id=%i", $post['id']);

	}

	function add_article($post) {
		global $CORE;
		$table = $CORE->get_table_format("article");

		DB::insert($table, array(
			'title' => $post['title'],
			'content' => $post['content'],
			'layout' => $post['layout'],
			'datecreated' => time(),
			'datemodified' => time()
		));

		header("Location: " . WWW . "/admin/index.php?path=/components/article/edit.php&");
 		exit;
	}

	function delete_article($post) {
		global $CORE;
		$table = $CORE->get_table_format("article");
		DB::delete($table, "id=%i", $post['id']);

		header("Location: " . WWW . "/admin/index.php?path=/components/article/edit.php&");
 		exit;
	}

	function get_article_layout($articleid) {
		global $CORE;
		$table = $CORE->get_table_format("article");
		$result = DB::queryFirstRow("SELECT layout FROM $table WHERE id = %i", $articleid);
		return $result['layout'];
	}
}

?>