<?php

require_once DIR . '/components/controller.php';

class ContactController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {
		require_once 'contact.lib.php';

		$lib = new ContactLibrary();
		return parent::view();
	}
}

?>