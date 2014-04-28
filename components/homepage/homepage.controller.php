<?php

require_once DIR . '/components/controller.php';

class HomepageController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {
		return parent::view();
	}
}

?>