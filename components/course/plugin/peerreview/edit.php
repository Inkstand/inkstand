<?php

require_once DIR . '/components/course/plugin/peerreview/peerreview.lib.php';

$peerlib = new PeerreviewLibrary();

if($_SERVER['REQUEST_METHOD'] == 'post') {
	$peerlib->editReview($_POST, $_POST['action']);
}

// get review to edit
$review = $peerlib->getReview(1);

if(empty($review))
{
	die("No review");
}

$CORE->tinymce("textarea[name=peer02]");

if(empty($review['name'])) {
	$review['name'] = "Undefined name";
}
if(empty($review['description'])) {
	$review['description'] = "";
}

?>

<h2>Editing <?php echo $review['name'] ?></h2>

<form method="post" action="">
	<label for="name">Name</label>
	<input type="text" name="name" value="<?php echo $review['name'] ?>">

	<label for="description">Description</label>
	<textarea name="description"><?php echo $review['description'] ?></textarea>
	<input type="hidden" name="action" value="editreview">
	<input type="submit" value="Update">
</form>