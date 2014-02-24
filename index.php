<?php

require_once 'config.php';
require_once DIR . '/core/route/route.class.php';

// *** route ***

$routepath = $_SERVER['PATH_INFO'];

$route = new Route();
$route->directRoute($routepath);


?>