<?php

class Route
{
	public function directRoute($route) {

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

			// get the controller 
			$controller = $this->getController($bits[0], $args);
			$controller->component = $bits[0];

			// invoke the action if it exists, if not, invoke the index method
			if(!empty($bits[1])) {

				$method = $bits[1];
				$controller->$method();
			} else {

				$method = "index";
				$controller->$method();
			}
		} 
	}

	protected function getController($name, $args = null) {

		// get the controller
		require_once DIR . "/components/$name/$name.controller.php";

		// create controller instance from string
		$class = ucwords(strtolower($name)) . "Controller";

		$controller = new $class($args);

		return $controller;
	}
}

?>