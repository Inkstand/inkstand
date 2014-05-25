<?php

class ApplicationController extends Controller
{

	public function __construct($route)
    {
    	require_once '/../component.config.php';
    	$this->component = $component;

        parent::__construct($route);
    }
    
	public function index_action() 
	{

		return parent::view();
	}

	public function login_action()
	{
		return parent::view();
	}
}

?>