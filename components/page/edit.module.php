<?php 

require_once DIR . '/core/module.class.php';

class PageEditModule extends Module {

	public function __construct($type) {

		require_once DIR . '/components/page/page.lib.php';

		$this->html = "

		<header>
			<h3>Pages</h3>
		</header>

		<div class='content'>
			<ul>";

		foreach ($variable as $key => $value) {
			# code...
		}

		$this->html .= "
			</ul>
		</div>

		"; 

		parent::__construct($type);
	}


}



?>