<?php

require_once "page.lib.php";

$lib = new PageLibrary();

$pages = $lib->getListOfPages();

echo "
		<div class='panel panel-default'>
			<div class='panel-body'>
				<a class='btn btn-primary' href='" . $CORE->editlink('page', 'addpage') . "'>
					<span class='glyphicon glyphicon-edit'></span> New page
				</a>
				<a class='btn btn-default href='#' title='Edit menus to link to your pages'>
					<span class='glyphicon glyphicon-tasks'></span> Menus and pages
				</a>
			</div>

			<table class='table' style='border-bottom:1px solid #ddd;'>

				<thead>
					<tr>
						<th style='width:5px'><input type='checkbox'></th>
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

	echo "<td><input type='checkbox'></td>";
	echo "<td><a href='" . $CORE->link("/index.php/page/viewpage/" . $page['id']) . "'>$page[title]</a></td>";
	
	// edit buttons
	echo "<td><a class='' href='" . $CORE->editlink('page', 'editpage.php?id=' . $page['id']) . "'><span class='glyphicon glyphicon-pencil'></span> Edit</a></td>";

	// get user created
	$table = $CORE->getTableFormat("users");
	$user = DB::queryFirstRow("SELECT f_name, l_name FROM $table WHERE id = %i", $page['usercreatedid']);

	echo "<td>$user[f_name] $user[l_name]</td>";

	// get date created
	$datecreated = $CORE->getTime($page['datecreated'], "Y-m-d");

	echo "<td>$datecreated</td>";

	$datemodified = $CORE->getTime($page['datemodified'], "Y-m-d");

	echo "<td>$datemodified</td>";

	echo '</tr>';

}

echo "			</tbody>
			</table>

			<div class='panel-body'>
				<div class='btn-group'>
					<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>
						With selected... <span class='caret'></span>
					</button>
					<ul class='dropdown-menu' role='menu'>
					    <li><a href='#'>Delete</a></li>
					    <li class='divider'></li>
					    <li><a href='#'>Unpublish (hide)</a></li>
					    <li><a href='#'>Publish (unhide)</a></li>
					</ul>
				</div>
			</div>

		</div>";

?>