<?php

require_once DIR . '/components/controller.php';

class ContactController extends Controller
{
    public function __construct($route)
    {
    	require_once '/../component.config.php';
    	$this->component = $component;

        parent::__construct($route);
    }


	public function index_action() 
	{
		require_once DIR. '/components/contact/contact.lib.php';

		$lib = new ContactLibrary();
		return parent::view();
	}

	public function edit_action()
	{
		require_once DIR. '/components/contact/contact.lib.php';

		$lib = new ContactLibrary();

		return parent::view();
	}
}

?>