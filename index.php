<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';
require_once 'core/lib/addTinymce.php';

// *** route ***

if(isset($_SERVER['PATH_INFO'])) {
	$routepath = $_SERVER['PATH_INFO'];
	
	$route = new Route();
	$route->directRoute($routepath);

	die();

} else { 

	$content = $CORE->getSetting("homepage");

	if($content == "custom") {

	} else if(file_exists(DIR . "/components/$content/index.view.php")) {

		require_once DIR . "/components/$content/$content.controller.php";

		// create controller instance from string
		$class = ucwords(strtolower($content)) . "Controller";

		$controller = new $class(null);

		$controller->component = $content;

		$controller->viewdata->layout = "homepage";

		$controller->index();

	} else {
		echo "Home page is broken :(";
	}
}

?>
