<?php

$CORE->require_capability("Admin");

require_once DIR . '/components/article/article.lib.php';

$lib = new ArticleLibrary();

if($_SERVER['REQUEST_METHOD'] == "POST") {

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
		<span>
		Select a Layout: 
		<select name = "layout">
		<?php
			$currentLayout = $lib->getArticleLayout($id);
			foreach ($theme_layouts as $layout) {
				if ($layout == $currentLayout) {
					echo "<option selected = 'selected' value = '$layout'>$layout</option>";
				} else {
					echo "<option value = '$layout'>$layout</option>";
				}
			}
		?>
		</select>
		</span>
		<br>
		<br>
		<input type="hidden" name="id" value="<?php echo $article['id'] ?>">
		<input type = "submit" name = "submit1" value = "Delete Article">
	</form>
</div>
<footer>
	<a class="width50" href="#" onclick="document.getElementById('articleform').submit();">Update</a>
	<a class="width50" href="">Cancel</a>
</footer>