<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once 'page.lib.php';

	$lib = new PageLibrary();

	$page = array(
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'content' => $_POST['content']
	);

	$lib->editPage($page);

}

$CORE->tinymce("#content");

$id = $_GET['id'];

if(empty($id)) {
	die("Missing page id");
}

$table = $CORE->getTableFormat("page");
$page = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);

foreach ($page as &$pagedata) {
	$pagedata = htmlspecialchars($pagedata);
}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h1>Edit page</h1>
			<hr>
			<form method='post'>
				<div class="form-group">
					<label for='title'>Title</label>
					<input type='text' name='title' class='form-control' placeholder='<?php echo $page["title"] ?>' value='<?php echo $page["title"] ?>' required>
				</div>

				<div class="form-group">
					<label for='description'>Description (SEO)</label>
					<textarea name='description' class='form-control' placeholder='<?php echo $page["description"] ?>'><?php echo $page["description"] ?></textarea>
				</div>

				<div class="form-group">
					<label for='content'>Content</label>
					<textarea id='content' name='content'><?php echo $page["content"] ?></textarea>
				</div>

				<input type='submit' class='btn btn-primary' value='Update page'>

			</form>
		</div>
		<div class="col-md-4">
			<div class="alert alert-warning"><b>Remember:</b> Don't forget to link to this page in your menu!</div>
		</div>
	</div>
</div>