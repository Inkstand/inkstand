<?php

class Route
{
	public $controller;
	public $action;
	public $args;

	public function parse_route($route) {

		// split the $route into bits for parsing
		$bits = explode("/", $route);

		// make sure index.php and all empty bits are removed from route
		for ($b=0; $b < count($bits); $b++) { 
			if($bits[$b] == 'index.php' || empty($bits[$b])) {
				// unset bit if empty or index.php
				unset($bits[$b]);
			}
		}

		// reorder bits
		$bits = array_values($bits);

		// make sure the controller bit is present 
		if(!empty($bits[0])) {

			// arguments. Example: domain.com/course/index/3 
			// --------------------------------------------^
			$args = array_values($bits);
			unset($args[0]);
			unset($args[1]);
			$args = array_values($args);

			$this->controller = $bits[0];

			$this->action = (isset($bits[1]) ? $bits[1] : null);

			$this->args = (isset($args) ? $args : null);
		} 
	}
	public function get_controller() {

		// check if controller exists

		$controller = $this->controller;
		$path = DIR . "/components/$controller/controller/$controller.controller.php";
		
		if(file_exists($path)) {

			require_once $path;

			// instantiate new controller class
			$name = ucfirst($controller) . 'Controller';

			// return controller and pass in this object for route referencing
			return new $name($this);
		}
	}
	public function invoke_action($controller, $action) {

		// default to index action if empty
		if(empty($action)) {
			$action = 'index';
		}

		$action = $action . '_action';

		// check if action exists
		if(method_exists($controller, $action)) {

			// invoke action
			$controller->$action();

		} else {
			// TODO: error
			echo "Action not found";
			echo "<br>";
			echo "controller " . $controller;
			echo "<br>";
			echo "action " . $action;
		}
	}
}

?>