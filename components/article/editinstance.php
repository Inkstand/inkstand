<?php

if($_SERVER['REQUEST_METHOD'] == "POST") {

	require_once DIR . '/components/article/article.lib.php';

	$lib = new ArticleLibrary();

	$lib->editArticle($_POST);

}

$id = $viewdata->instanceid;

$article = DB::queryFirstRow("SELECT * FROM coco_article WHERE id=%i", $id);

$CORE->tinymce('#article1');

?>

<header>
	<h2>Editing Article</h2>
</header>
<div class="content">
	<form method="post" action="" id="articleform">
		<span>
			<p>Title</p>
			<input type="text" name="title" value="<?php echo $article['title'] ?>">
		</span>
		<span>
			<p>Content</p>
			<textarea id="article1" name="content">
				<?php echo $article['content'] ?>
			</textarea>
		</span>
		<input type="hidden" name="id" value="<?php echo $article['id'] ?>">
	</form>
</div>
<footer>
	<a class="width50" href="#" onclick="document.getElementById('articleform').submit();">Update</a>
	<a class="width50" href="">Cancel</a>
</footer>