<?php



?>

<h2><?php echo $viewdata->heading; ?></h2>

<ul>
	<?php

	foreach ($viewdata->courses as $course) {
		echo "<li>" . $course['name'] . "</li>";
	}

	?>
</ul>