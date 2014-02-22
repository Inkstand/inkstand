<?php

$id = $_GET['id'];

$table = $CORE->getTableFormat("course");
$course = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);

?>

<div id="course_header" class="module_header">
	<h2><?php echo $course['name']; ?></h2>
	<p><?php echo $course['abbreviation']; ?></p>
</div>
<div id="course_content" class="module_content">
	<?php echo $course['description']; ?></div>
</div>
<div id="course_footer" class="course_footer">

</div>