<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// this is for actions on checked pages in the list

	$table = $CORE->get_table_format('page');
	$pageids = DB::query("SELECT id FROM $table");

	foreach ($pageids as $pageid) {
		if(isset($_POST['checkbox' . $pageid['id']])) {
			$value = $_POST['checkbox' . $pageid['id']];

			if($value === 'on') {
				if($_POST['action'] === 'delete') {
					DB::query("DELETE FROM $table WHERE id = %i", $pageid['id']);
				}
			}
		}
	}
}

require_once "controller/page.lib.php";

$lib = new PageLibrary();

$pages = $lib->get_list_of_pages();

echo "<h1>Page administration</h1>";

echo "
		<div class='panel panel-default'>
			<div class='panel-body'>
				<a class='btn btn-primary' href='" . $CORE->edit_link('page', 'add_page') . "'>
					<span class='glyphicon glyphicon-edit'></span> New page
				</a>
				<a class='btn btn-default href='#' title='Edit menus to link to your pages'>
					<span class='glyphicon glyphicon-tasks'></span> Menus and pages
				</a>
			</div>
			<form id='listform' method='post'>
			<input type='hidden' name='action' value=''>
			<table class='table' style='border-bottom:1px solid #ddd;'>

				<thead>
					<tr>
						<th style='width:5px'><input id='mastercheckbox' type='checkbox'></th>
						<th>Name</th>
						<th></th>
						<th>Created by</th>
						<th>Date created</th>
						<th>Last modifed</th>
					</tr>
				</thead>
				<tbody>
";

foreach ($pages as $page) {
	
	echo '<tr>';

	echo "<td><input type='checkbox' name='checkbox" . $page['id'] . "'></td>";
	echo "<td><a href='" . $CORE->link("/index.php/page/viewpage/" . $page['id']) . "'>$page[title]</a></td>";
	
	// edit buttons
	echo "<td><a class='' href='" . $CORE->edit_link('page', 'edit_page.php', 'id=' . $page['id']) . "'><span class='glyphicon glyphicon-pencil'></span> Edit</a></td>";

	// get user created
	$table = $CORE->get_table_format("users");
	$user = DB::queryFirstRow("SELECT f_name, l_name FROM $table WHERE id = %i", $page['usercreatedid']);

	echo "<td>$user[f_name] $user[l_name]</td>";

	// get date created
	$datecreated = $CORE->get_time($page['datecreated'], "Y-m-d");

	echo "<td>$datecreated</td>";

	$datemodified = $CORE->get_time($page['datemodified'], "Y-m-d");

	echo "<td>$datemodified</td>";

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
					    <li><a value='delete'>Move to trash</a></li>
					    <li class='divider'></li>
					    <li><a value='hide'>Unpublish (hide)</a></li>
					    <li><a value='unhide'>Publish (unhide)</a></li>
					</ul>
				</div>
			</div>

		</div>";

?>