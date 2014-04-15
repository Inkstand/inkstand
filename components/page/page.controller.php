<?php

require_once DIR . '/components/controller.php';

class PageController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {

		echo "No page here :(";
	}

	public function viewpage() {
		
		require_once 'page.lib.php';

		$pageid = $this->args[0];

		$lib = new PageLibrary();

		$page = $lib->getPage($pageid);

		$this->viewdata->page = $page;

		return parent::view();
	}
}

?>