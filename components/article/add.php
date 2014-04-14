<?php

require_once '../../config.php';
require_once DIR . '/core/route/route.class.php';
require_once DIR . '/plugin/theme/foundation/layout/header.php';

$CORE->require_capability("Admin");

if($_SERVER['REQUEST_METHOD'] == "POST") {

	require_once DIR . '/components/article/article.lib.php';

	$lib = new ArticleLibrary();

	$lib->addArticle($_POST);

}

$CORE->tinymce('#article1');
?>

<div id="view-content">

	<div class="module module2"> 
		<div class="content">
			<form method="post" action="add.php" id="articleform">
				<span>
					<p>Title</p>
					<input type="text" name="title" >
				</span>
				<span>
					<p>Content</p>
					<textarea id="article1" name="content">
						
					</textarea>
				</span>
			</form>
		</div>
		<footer>
			<a class="width50" href="#" onclick="document.getElementById('articleform').submit();">Create</a>
			<a class="width50" href="<?php echo WWW . "/index.php/article"; ?>">Cancel</a>
		</footer>
	</div> 
</div>

<?php

require_once DIR . '/plugin/theme/foundation/layout/footer.php';

?>
