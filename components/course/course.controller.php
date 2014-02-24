<?php

require_once DIR . '/components/controller.php';

class CourseController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {

		require_once 'course.lib.php';

		$this->viewdata->courses = getCourseList();
		$this->viewdata->heading = "Course list";

		return parent::view();
	}
}

?>