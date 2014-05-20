<?php

$CORE->require_capability("Admin");

require_once DIR . '/components/article/article.lib.php';
require_once DIR . '/components/controller.php';

$lib = new ArticleLibrary();

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$lib->edit_article($_POST);

}

$id = $_GET['id'];
$table = $CORE->get_table_format("article");
$article = DB::queryFirstRow("SELECT * FROM $table WHERE id=%i", $id);

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
			$currenttheme = $CORE->get_setting("currenttheme");
			require_once (DIR . "/plugin/theme/$currenttheme/config.php");

			$current_layout = $lib->get_article_layout($id);
			foreach ($theme_layouts as $layout) {
				if ($layout == $current_layout) {
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
	<a class="btn btn-primary" href="#" onclick="document.getElementById('articleform').submit();">Update</a>
	<a class="btn btn-default" href="">Cancel</a>
</footer>