<?php

require_once DIR . '/components/controller.php';

class HomepageController extends Controller
{
	public function __construct($route)
    {
    	require_once '/../component.config.php';
    	$this->component = $component;

        parent::__construct($route);
    }
    
	public function index_action() {
		return parent::view();
	}

	public function edit_action() {
		return parent::view();
	}
}

?>