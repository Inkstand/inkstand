<?php

require_once 'config.php';
$CORE = new Core();

$CORE->require_capability("Admin");

require_once DIR . '/components/article/article.lib.php';

$lib = new ArticleLibrary();

if($_SERVER['REQUEST_METHOD'] == "POST") {

	$lib->add_article($_POST);

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
	</form>
</div>
<footer>
	<a class="btn btn-primary" href="#" onclick="document.getElementById('articleform').submit();">Create</a>
	<a class="btn btn-default" href="#">Cancel</a>
</footer>
