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
		
		if(!empty($this->args[0])) {
			$arg1 = $this->args[0];
		} else {
			$arg1 = null;
		}
		
		if(!empty($this->args[1])) {
			$arg2 = $this->args[1];
		} else {
			$arg2 = null;
		}

		if(!empty($this->args[2])) {
			$arg3 = $this->args[2];
		} else {
			$arg3 = null;
		}

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
			if(empty($arg2)) {
				$this->viewdata->editfilepath = DIR . "/components/$arg1/edit.php";
			} else {
				$this->viewdata->editfilepath = DIR . "/components/$arg1/editinstance.php";
				$this->viewdata->instanceid = $arg2;
			}
		}

		return parent::view();
	}

}

?>