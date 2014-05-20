<?php

require_once DIR . '/components/page/model/page.php';

class PageController extends Controller
{

	public function __construct($route)
    {
    	require_once '/../component.config.php';
    	$this->component = $component;

        parent::__construct($route);
    }
    
	public function index_action() 
	{

		echo "No page here :(";
	}

	public function viewpage_action() 
	{

		$pageid = $this->route->args[0];

		$lib = new PageLibrary();

		$page = $lib->get_page($pageid);

		$this->viewdata->page = $page;

		return parent::view();
	}

	public function edit_action()
	{
		return parent::view();
	}

	public function add_page_action()
	{
		return parent::view();
	}
}

?>