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
		
		// get component to edit
		if(!empty($this->args[0])) {
			$editcomponent = $this->args[0];
		} else {
			$editcomponent = "article";
		}
		
		// get instance to edit
		if(!empty($this->args[1])) {
			$editinstance = $this->args[1];
		} else {
			$editinstance = null;
		}

		$this->viewdata->editcomponent = $editcomponent;
		$this->viewdata->editinstance = $editinstance;

		return parent::view();
	}

}

?>