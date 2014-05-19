<?php

require_once DIR . '/core/form_helper.php';

class AddpageForm extends FormHelper
{
	public function __construct() 
	{
		$this->add_input('title', 
			array(
				'label' => 'Title',
				'description' => 'Title of page', 
			),
			array(
				'placeholder' => 'Title',
			)
		);

		$this->add_input(
			'description',
			'Description (SEO)',
			'Description of the page for SEO purposes',
			null,
			'Description',
		);

		$this->add_input(
			'content',
			'Content',
			'Content of page',
			null
		);
	}
}

?>