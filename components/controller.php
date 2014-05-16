<?php

class Controller
{
	public $component;
	public $viewdata;
	public $route;

	protected function __construct($route) {
		$this->route = $route;
		$this->viewdata = new stdClass();
	}

	protected function view($name = null) {

		// IF name is not specified:
		// find the method name that called this method
		// this will act as the default view
		if($name == null) {
		$backtrace = debug_backtrace();

			// name is not the default (the method that called this one)
			$name = explode('_', $backtrace[1]['function']);
			$name = $name[0];
		}

		// TODO: get admin theme in settings, using 'admin' for now
		$themeoverride = ($name == 'edit' ? 'admin' : null);

		//die("theme: " . THEME_MANAGER);
		require_once DIR . '/plugin/theme/thememanager.class.php';

		$thememanager = new ThemeManager();

		$thememanager->render_page($this, $name, $themeoverride);

	}
}

?>