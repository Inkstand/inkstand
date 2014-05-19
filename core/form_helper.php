<?php

require_once DIR . '/core/html_helper.php';

class FormHelper extends HtmlHelper
{
	$inputs = array();

	public function add_input($name, $value, $value, $placeholder, $id, $class, $options)
	{
		array_push($type, $name, $va)
	}

	public function start_form($action = null, $method = null, $id = null, $class = null, $options = null)
	{
		// build form tag

		// make sure options isn't null
		if($options == nul) {
			$options = array();
		}

		// add options
		$options['action'] = $action;
		$options['method'] = $method;

		$this->start_tag("form", $id, $class, $options);
	}
}

?>