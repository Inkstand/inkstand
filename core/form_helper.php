<?php

require_once DIR . '/core/html_helper.php';

class FormHelper extends HtmlHelper
{
	$inputs = array();

	public function add_input($name, $input_options = null, $options = null)
	{
		// make sure options isn't null
		if($options == null) {
			$options = array();
		}

		// make sure input options isn't null
		if($input_options == null) {
			$input_options = array();
		}

		// add to list of inputs
		array_push($inputs, array($name, $input_options, $options));
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

	public function start_inputs()
	{
		// echo out all inputs
		foreach ($inputs as $input) {

			// get options
			if($input['options'] == null) {
				$input['options'] = array();
			}

			$options['name'] = $input['name'];
			$options['value'] = $input['value'];

			$this

			$this->start_tag('input', $input['id'], $input['class'], $options);
		}
	}
}

?>