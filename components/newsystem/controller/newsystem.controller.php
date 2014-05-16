<?php

class NewsystemController extends Controller
{
	public function __construct($route) {
		parent::__construct($route);
	}

	public function index_action() {
		echo "Index action";
	}
}

?>