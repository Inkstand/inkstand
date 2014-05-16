<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	require_once 'controller/page.lib.php';

	$lib = new PageLibrary();

	$page = array(
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'content' => $_POST['content']
	);

	$lib->addPage($page);

}

$CORE->tinymce("#content");

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<h1>Add page</h1>
			<hr>
			<form method='post'>
				<div class="form-group">
					<label for='title'>Title</label>
					<input type='text' name='title' class='form-control' placeholder='Joe&#39;s coding services' required>
				</div>

				<div class="form-group">
					<label for='description'>Description (SEO)</label>
					<textarea name='description' class='form-control' placeholder='Check out our services! ...'></textarea>
				</div>

				<div class="form-group">
					<label for='content'>Content</label>
					<textarea id='content' name='content'></textarea>
				</div>

				<input type='submit' class='btn btn-primary' value='Create page'>

			</form>
		</div>
		<div class="col-md-4">
			<div class="alert alert-warning"><b>Remember:</b> Don't forget to link to this page in your menu!</div>
		</div>
	</div>
</div>