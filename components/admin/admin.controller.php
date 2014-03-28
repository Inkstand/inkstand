<?php

require_once DIR . '/components/controller.php';

class AdminController extends Controller
{

	public function __construct($args = null)
    {
        parent::__construct($args);
    }
    
	public function index() {

		

		return parent::view();
	}
	
	public function edit() {
		
		$arg1 = $this->args[0];
		$arg2 = $this->args[1];
		$arg3 = $this->args[2];

		// check if we're editing a component plugin
		if($arg1 == 'plugin') {

			if(empty($arg2)) {
				// TODO: Choose component to edit plugins 
			} else if(empty($arg3)) {
				// TODO: List of plugins from component
			} else {
				$this->viewdata->editfilepath = DIR . "/components/$arg2/plugin/$arg3/edit.php";
			}

		} else {
			// editing component at this point
			$this->viewdata->editfilepath = DIR . "/components/$arg1/edit.php";
		}

		return parent::view();
	}
}

?>