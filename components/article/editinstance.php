<?php

$id = $editinstance;

$article = DB::queryFirstRow("SELECT * FROM coco_article WHERE id=%i", $id);

$CORE->tinymce('#article1');

?>

<form method="post" action="edit.php">
	<span>
		<p>Title</p>
		<input type="text" value="<?php echo $article['title'] ?>">
	</span>
	<span>
		<p>Content</p>
		<textarea id="article1">
			<?php echo $article['content'] ?>
		</textarea>
	</span>
</form>