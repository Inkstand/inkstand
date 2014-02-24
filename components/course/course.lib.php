<?php

function getCourseList() {

	return DB::query("SELECT * FROM coco_course");
}

?>