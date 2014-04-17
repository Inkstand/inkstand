<?php 

require_once DIR . "/components/page/page.lib.php";
require_once DIR . "/core/module.class.php";


class PageEditModule extends Module {

	public function __construct($type) {

		$this->html = "

		<header>
			<h3>Pages</h3>
		</header>

		<div class='content'>
			<ul>
				
			</ul>
		</div>

		"; 

		parent::__construct($type);
	}


}



?>