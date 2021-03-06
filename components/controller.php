<?php

class Controller
{
	public $component;
	public $viewdata;
	public $args;

	protected function __construct($args) {
		$this->viewdata = new stdClass();
		$this->args = $args;
	}

	protected function view($name = null) {

		require_once 'config.php';
		global $CORE;

		$component = $this->component;
		$viewdata = $this->viewdata;

		// IF name is not specified:
		// find the method name that called this method
		// this will act as the default view 
		if($name == null) {
			$backtrace = debug_backtrace();

			// name is not the default (the method that called this one)
			$name = $backtrace[1]['function'];

		}

		// if theme has already been chosen (e.g. admin page hijacking to use different theme)
		if(!empty($viewdata->theme)) {
			$currenttheme = $viewdata->theme;
		} else {
			// get desired theme in settings
			$currenttheme = $CORE->getSetting("currenttheme");
		}

		//import theme settings file (will need to make it good for whichever theme is in use)
		require_once (DIR . "/plugin/theme/$currenttheme/config.php");
		$currentlayout = "default";
		if (isset($this->viewdata->layout) && $this->viewdata->layout != "") {
			if (in_array($this->viewdata->layout, $theme_layouts))
			{
				$currentlayout = $this->viewdata->layout;
			}
			
		}
		
		// stuff here will be accessable to layout file...
		// make anything here available for layouts on default

		require_once DIR . "/plugin/theme/$currenttheme/layout/$currentlayout.php";

	}

	protected function pluginview($pluginname, $name = null) {

		$component = $this->component . "/plugin/" . $pluginname;
		$viewdata = $this->viewdata;

		// IF name is not specified:
		// find the method name that called this method
		// this will act as the default view 
		if($name == null) {
			$backtrace = debug_backtrace();

			// name is not the default (the method that called this one)
			$name = $backtrace[1]['function'];

		}

		// TODO: get current theme and layout
		$currenttheme = "foundation";
		$currentlayout = "default";

		// stuff here will be accessable to layout file...
		// make anything here available for layouts on default

		require_once DIR . "/plugin/theme/$currenttheme/layout/$currentlayout.php";

	}

	public function plugin() {

		// domain.com/index.php/course/plugin/quiz/take/79
		// 1 component ---------^      ^      ^    ^    ^
		// 2 (needs alias) ------------^      |    |    |
		// 3 plugin --------------------------^    |    |
		// 4 action -------------------------------^    |
		// 5 quiz id -----------------------------------^

		// name of plugin (3)
		$pluginname = $this->args[0];

		// plugin action (4)
		$pluginaction = $this->args[1];

		// rest of args get past to plugin controller
		// remove first two arguments
		unset($this->args[0]);
		unset($this->args[1]);
		$args = array_values($this->args);

		// create the plugin controller

		require_once DIR . '/components/' . $this->component . '/plugin/' . $pluginname . '/' . $pluginname . '.controller.php';

		$class = ucwords(strtolower($pluginname)) . "Controller";

		$plugincontroller = new $class($args);

		$plugincontroller->$pluginaction();
	}
}

?>