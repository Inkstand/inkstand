<?php

class Controller
{
	public $component;
	public $viewdata;

	protected function __construct() {
		$this->viewdata = new stdClass();
	}

	protected function view($name = null) {

		$component = $this->component;

		// IF name is not specified:
		// find the method name that called this method
		// this will act as the default view 
		if($name == null) {
			$backtrace = debug_backtrace();

			// name is not the default (the method that called this one)
			$name = $backtrace[1]['function'];

		}

		function require_view($component, $name) {

			require_once DIR . "/components/$component/$name.view.php";
		}

		// TODO: get current theme and layout
		$currenttheme = "foundation";
		$currentlayout = "default";

		// stuff here will be accessable to layout file...
		// make anything here available for layouts on default

		require_once DIR . "/plugin/theme/$currenttheme/layout/$currentlayout.php";

	}
}

?>