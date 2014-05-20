<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$data = array(
		'text' => $_POST['text'], 
		'url' => $_POST['url']
	);

	$data = serialize($data);

	$table = $CORE->get_table_format("menu_items");
	DB::insert($table, array(
		'type' => 'link', // TODO
		'name' => $_POST['name'],
		'menuid' => $_POST['menuid'],
		'data' => $data
	));

	echo '<div class="alert alert-success"><b>Success!</b> Menu item has successfully been added to menu. <b><a href="index.php?path=/admin/edit/editmenu.php">Back</a></b></div>';
}

$menuid = $_GET['menuid'];

if(empty($menuid)) {
	die("Menu id missing");
}

?>

<h1>Add new menu item</h1>

<a class='btn btn-default' href="index.php?path=/admin/edit/editmenu.php">Back</a>

<hr>

<form role="form" method="post">
	<div class="form-group">
		<label>Item name <span style="opacity:0.5">(Example: blog link, product dropdown, etc)</span></label>
		<input type='text' name='name' class='form-control' required>
	</div>
	<div class="form-group">
		<label>Text</label>
		<input type='text' name='text' class='form-control' required>
	</div>
	<div class="form-group">
		<label>URL</label>
		<input type='text' name='url' class='form-control' required>
	</div>
	<input type="hidden" name='menuid' value='<?php echo $menuid ?>'>
	<input type="submit" class="btn btn-primary" value="Add">
</form>