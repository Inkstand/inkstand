<?php

require_once DIR . '/components/course/plugin/peerreview/peerreview.lib.php';

$peerlib = new PeerreviewLibrary();

// get review to edit
$review = $peerlib->getReview(1);

if(empty($review))
{
	die("No review");
}

$CORE->tinymce("textarea[name=peer02]");

?>

<h2>Editing <?php echo $review['name'] ?></h2>

<form>
	<label for="peer01">Name</label>
	<input type="text" name="peer01" value="<?php echo $review['name'] ?>">

	<label for="peer02">Description</label>
	<textarea name="peer02"></textarea>
</form>