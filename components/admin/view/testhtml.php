<?php

require_once DIR . '/core/admin_helper.php';

$helper = new AdminHelper();

$titles = array(
	"Name",
	"Description",
	"Babes",
	"Puss"
);

$data = array(
	array(
		"Kitten",
		"Best wife ever",
		"carrying 1",
		"Extra smelly"
	),
);

$helper->admin_table($titles, $data);

?>