<?php

$id = $editinstance;

$article = DB::queryFirstRow("SELECT * FROM coco_article WHERE id=%i", $id);

?>

<form method="post" action="edit.php">
	<span>
		<p>Title</p>
		<input type="text" value="<?php echo $article['title'] ?>">
	</span>
	<span>
		<p>Content</p>
		<textarea>
			<?php echo $article['content'] ?>
		</textarea>
	</span>
</form>