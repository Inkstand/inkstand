<?php

require_once "page.lib.php";

$lib = new PageLibrary();

$pages = $lib->getListOfPages();

echo "
		<div class='panel panel-default'>
			<div class='panel-body'>
				<p>...</p>
			</div>

			<table class='table'>
				<thead>
					<tr>
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

	

	echo '</tr>';

}

echo "			</tbody>
			</table>
		</div>";

?>