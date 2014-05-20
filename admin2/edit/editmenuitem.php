<?php
	global $CORE;

	if (isset($_POST['edit_link'])) {
		$data = array(
			'text' => $_POST['text'], 
			'url' => $_POST['url']
		);

		$data = serialize($data);
		$table = $CORE->get_table_format("menu_items");
		/*DB::insertUpdate($table, array(
		  'name' => $_POST['name'],
		  'data' => $data
		), 'id=%i', $_POST['item_id']);*/

		DB::update($table, array(
		  'name' => $_POST['name'],
		  'data' => $data
		  ), "id=%i", $_POST['item_id']);
	}
	$link_data = $CORE->get_menu_item($_GET['menuid']);

?>

<h1>Edit menu item</h1>

<a class='btn btn-default' href="index.php?path=/admin/edit/editmenu.php">Back</a>

<hr>

<form role="form" method="post">
	<div class="form-group">
		<label>Item name <span style="opacity:0.5">(Example: blog link, product dropdown, etc)</span></label>
		<input type='text' name='name' class='form-control' required value = "<?php echo $link_data['name'] ?>">
	</div>
	<div class="form-group">
		<label>Text</label>
		<input type='text' name='text' class='form-control' required value = "<?php echo $link_data['data']['text'] ?>">
	</div>
	<div class="form-group">
		<label>URL</label>
		<input type='text' name='url' class='form-control' required value = "<?php echo $link_data['data']['url'] ?>">
	</div>
	<input type="hidden" name='menuid' value='<?php echo $menuid ?>'>
	<input type="hidden" name='item_id' value='<?php echo $link_data['id'] ?>'>
	<input type="submit" class="btn btn-primary" value="Edit" name = "edit_link">
</form>