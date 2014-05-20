<?php

$id = $MODULE->id;

$table = $CORE->get_table_format("course");
$course = DB::queryFirstRow("SELECT * FROM $table WHERE id = %i", $id);

?>
<div id='<?php echo $MODULE->type . $MODULE->id ?>' module="<?php echo $MODULE->id; ?>" class="module module2 module-<?php echo $MODULE->type; ?>">
	<div id="course_header" class="module_header">
		<h2><?php echo $course['name']; ?></h2>
		<p><?php echo $course['abbreviation']; ?></p>
	</div>
	<div id="course_content" class="module_content">
		<?php echo $course['description']; ?>
	</div>
	<div id="course_footer" class="course_footer">

	</div>
</div>