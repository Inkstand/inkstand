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
			</div>

			<table class='table' style='border-bottom:1px solid #ddd;'>
				<thead>
					<tr>
						<th style='width:5px'><input type='checkbox'></th>
						<th>Name</th>
						<th>Visible</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
";

foreach ($pages as $page) {
	
	echo '<tr>';

	echo "<td><input type='checkbox'></td>";
	echo "<td><a href='" . $CORE->link("/index.php/page/viewpage/" . $page['id']) . "'>$page[title]</a></td>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<td></td>";

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