<?php

class ThemeManager
{
	public $controller;
	public $view;

	public function render_page($controller, $view, $themeoverride = null) {

		global $CORE;

		$this->controller = $controller;
		$this->view = $view;

		$currenttheme = (!is_null($themeoverride) ? $themeoverride : $CORE->get_setting('currenttheme'));
		// TODO: get layout
		$layout = 'default';
		// inject layout
		require_once DIR . "/plugin/theme/$currenttheme/layout/$layout.php";
	}
	public function inject_view() {

		// get component name
		$component = $this->controller->component->name;
		$view = $this->view;

		$viewdata = $this->controller->viewdata;

		require_once DIR . "/components/$component/view/$view.php";
	}
}

?>