<?php

// TODO: get menu id or a way to choose which menu to edit

$menuid = 1;

$table = $CORE->getTableFormat("menu");
$menu = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $menuid);

$table = $CORE->getTableFormat("menu_items");
$menuitems = DB::query("SELECT * FROM $table WHERE menuid = %i", $menuid);

?>

<script src="<?php echo WWW ?>/admin/js/editmenu.js"></script>

<h1>Edit menu</h1>

<form role="form" method="post">

	<ul class="list-group">
	<?php

	foreach ($menuitems as $menuitem) {
		echo '<li class="list-group-item">';

		if($menuitem['type'] == 'link') {

			// get menu item data into array
			$data = unserialize($menuitem['data']);

			echo ucfirst('<span>' . $menuitem['type']) . '</span>: <b>' . $data['text'] . '</b>';
			echo "<div class='btn-group' style='float:right'>
					<a class='btn btn-primary expand' data-target='item" . $menuitem['id'] . "'><span class='glyphicon glyphicon-chevron-down'></span></a>
					<a class='btn btn-danger delete'><span class='glyphicon glyphicon-remove'></span></a>
				</div>
			";

			echo '</li>';

			echo '<li id="item' . $menuitem['id'] . '" class="list-group-item options-collapse">';
			echo "
					<div class='form-group'>
						<label>Text</label>
						<input type='text' name='link_text_" . $menuitem['id'] . "' value='" . $data['text'] . "'>
					</div>
					<div class='form-group'>
						<label>URL</label>
						<input type='text' name='link_url_" . $menuitem['id'] . "' value='" . $data['url'] . "'>
					</div>
			";
			echo '</li>';
		}

		
		//echo '</li>'; DON'T FORGET THIS 
	}

	?>
	</ul>

</form>

<div class="btn-group">
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	Add new item... <span class="caret"></span>
	</button>
	<ul class="dropdown-menu add-new" role="menu">
		<li><a id="link">Link</a></li>
	</ul>
</div>

<div style='display:none'>
	<div id="link-template">
		<li class="list-group-item"><span>link</span>: <b>New item</b><div class="btn-group" style="float:right">
				<a class="btn btn-primary expand" data-target="item1"><span class="glyphicon glyphicon-chevron-down"></span></a>
				<a class="btn btn-danger delete"><span class="glyphicon glyphicon-remove"></span></a>
			</div>
		</li>
		<li id="item1" class="list-group-item options-collapse" style="display: none;">
				<div class="form-group">
					<label>Text</label>
					<input type="text" name="link_text_1" value="Blog">
				</div>
				<div class="form-group">
					<label>URL</label>
					<input type="text" name="link_url_1" value="http://localhost/modular/index.php/article">
				</div>
		</li>
	</div>

</div>