<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once 'controller/page.lib.php';

	$lib = new PageLibrary();

	$page = array(
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'content' => $_POST['content']
	);

	$success = $lib->edit_page($page);

	if($success) {
		$lib->print_success('edit');
	} else {
		$lib->print_failure('edit');
	}

}

$CORE->tinymce("#content");

$id = $_GET['id'];

if(empty($id)) {
	die("Missing page id");
}

$table = $CORE->get_table_format("page");
$page = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);

foreach ($page as &$pagedata) {
	$pagedata = htmlspecialchars($pagedata);
}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h1>Edit page</h1>
			<a class='btn btn-default' href="<?php echo $CORE->edit_link('page', 'edit'); ?>"><span class='glyphicon glyphicon-arrow-left'></span> Back</a>
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

				<input type='hidden' name='id' value='<?php echo $id ?>'>

				<input type='submit' class='btn btn-primary' value='Update page'>
				<a class='btn btn-default' href="<?php echo $CORE->edit_link('page', 'edit'); ?>">Cancel</a>

			</form>
		</div>
		<div class="col-md-4">
			<div class="alert alert-warning"><b>Remember:</b> Don't forget to link to this page in your menu!</div>
		</div>
	</div>
</div>