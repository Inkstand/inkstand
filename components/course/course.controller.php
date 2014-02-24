<?php

require_once DIR . '/components/controller.php';

class CourseController extends Controller
{

	public function __construct()
    {
        parent::__construct();
    }
    
	public function index() {

		$this->viewdata->heading = "Hello!";

		return parent::view();
	}
}

?>