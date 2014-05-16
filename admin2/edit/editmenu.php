<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// this is for actions on checked menu items in the list

	$table = $CORE->getTableFormat('menu_items');
	$menuitemids = DB::query("SELECT id FROM $table");

	foreach ($menuitemids as $menuitemid) {
		if(isset($_POST['checkbox' . $menuitemid['id']])) {
			$value = $_POST['checkbox' . $menuitemid['id']];

			if($value === 'on') {
				if($_POST['action'] === 'delete') {
					DB::query("DELETE FROM $table WHERE id = %i", $menuitemid['id']);
				}
			}
		}
	}
}

// TODO: get menu id 
$menuid = 1;

$table = $CORE->getTableFormat("menu_items");
$menuitems = DB::query("SELECT * FROM $table WHERE menuid = %i", $menuid);

echo "<h1>Edit menu</h1>";

echo "
		<div class='panel panel-default'>
			<div class='panel-body'>
				<a class='btn btn-primary' href='index.php?path=/admin/edit/addmenuitem.php&menuid=$menuid'>
					<span class='glyphicon glyphicon-edit'></span> New item
				</a>
			</div>
			<form id='listform' method='post'>
			<input type='hidden' name='action' value=''>
			<table class='table' style='border-bottom:1px solid #ddd;'>

				<thead>
					<tr>
						<th style='width:5px'><input id='mastercheckbox' type='checkbox'></th>
						<th>Type</th>
						<th></th>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
";

foreach ($menuitems as $menuitem) {
	
	echo '<tr>';

	echo "<td><input type='checkbox' name='checkbox" . $menuitem['id'] . "'></td>";

	echo '<td>' . ucfirst($menuitem['type']) . '</td>';

	echo "<td><a class='' href='index.php?path=/admin/edit/editmenuitem.php&menuid=" . $menuitem['id'] . "'><span class='glyphicon glyphicon-pencil'></span> Edit</a></td>";

	echo '<td>' . $menuitem['name'] . '</td>';

	echo '</tr>';

}

echo "			</tbody>
			</table>
			</form>
			<div class='panel-body'>
				<div class='btn-group'>
					<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
						With selected... <span class='caret'></span>
					</button>
					<ul class='dropdown-menu' id='selectionmenu' role='menu'>
					    <li><a value='delete'>Delete</a></li>
					</ul>
				</div>
			</div>

		</div>";

?>