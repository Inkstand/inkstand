<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	// this is for actions on checked pages in the list

	$table = $CORE->getTableFormat('article');
	$articleids = DB::query("SELECT id FROM $table");

	foreach ($articleids as $pageid) {
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

require_once "article.lib.php";

$lib = new ArticleLibrary();

$articles = $lib->getArticleList();

echo "<h1>Article administration</h1>";

echo "
		<div class='panel panel-default'>
			<div class='panel-body'>
				<a class='btn btn-primary' href='" . $CORE->editlink('article', 'addarticle') . "'>
					<span class='glyphicon glyphicon-edit'></span> New article
				</a>
				<a class='btn btn-default href='#' title='Edit menus to link to your pages'>
					<span class='glyphicon glyphicon-tasks'></span> Menus and pages
				</a>
			</div>
			<form id='pagelistform' method='post'>
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

foreach ($articles as $page) {
	
	echo '<tr>';

	echo "<td><input type='checkbox' name='checkbox" . $page['id'] . "'></td>";
	echo "<td><a href='" . $CORE->link("/index.php/article/read/" . $page['id']) . "'>$page[title]</a></td>";
	
	// edit buttons
	echo "<td><a class='' href='" . $CORE->editlink('article', 'editinstance.php', 'id=' . $page['id']) . "'><span class='glyphicon glyphicon-pencil'></span> Edit</a></td>";

	// get user created
	$table = $CORE->getTableFormat("users");
	$user = DB::queryFirstRow("SELECT f_name, l_name FROM $table WHERE id = %i", $page['authorid']);

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