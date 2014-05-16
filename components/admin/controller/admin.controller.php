<?php

class AdminController extends Controller
{

	public function __construct($route)
    {
    	require_once '/../component.config.php';
    	$this->component = $component;

        parent::__construct($route);
    }
    
	public function index_action() 
	{
		// use route class to route to edit pages on components

		
		
	}

	public function edit_action() 
	{
		$routepath = "";

		foreach ($this->route->args as $arg) {
			$routepath .= $arg . '/';
		}

		$route = new Route();
		$route->parse_route($routepath);

		$controller = $route->get_controller();

		$route->invoke_action($controller, $route->action);
	}
}

?>