<?php

require_once 'config.php';
$CORE = new Core();

$CORE->require_capability("Admin");

require_once DIR . '/components/article/article.lib.php';

$lib = new ArticleLibrary();

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$lib->addArticle($_POST);

}

$CORE->tinymce('#article1');
?>

<div class="content">
	<form method="post" action="" id="articleform">
		<span>
			<p>Title</p>
			<input type="text" name="title" >
		</span>
		<span>
			<p>Content</p>
			<textarea id="article1" name="content">
				
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
	</form>
</div>
<footer>
	<a class="width50" href="#" onclick="document.getElementById('articleform').submit();">Create</a>
	<a class="width50" href="<?php echo WWW . "/index.php/article"; ?>">Cancel</a>
</footer>
