<?php

class NewsystemController extends Controller
{
	public function __construct($route) {

		$this->component = "newsystem";

		parent::__construct($route);
	}

	public function index_action() {

		parent::view();
	}
}

?>