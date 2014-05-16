<?php

class Route
{
	public $controller;
	public $action;
	public $args;

	public function parseRoute($route) {

		// split the $route into bits for parsing
		$bits = explode("/", $route);

		// remove first if blank
		if(empty($bits[0])) {
			unset($bits[0]);

			// reindex array
			$bits = array_values($bits);
		}

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
}

?>