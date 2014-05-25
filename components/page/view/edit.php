<?php

global $CORE;

require_once DIR . '/core/helpers/admin_helper.php';
require_once DIR . '/components/page/model/page.php';
require_once DIR . '/core/helpers/pagination_helper.php';

// new page 
$pagelib = new Page();

$pagination = new PaginationHelper();

$range = $pagination->get_range();

// get all pages
$pages = $pagelib->get_some_pages($range['start'], $range['length']);

$helper = new AdminHelper();

$titles = array(
	"Title",
	"",
	"Created by",
	"Date created",
	"Last modified"
);

$data = array();

foreach ($pages as $page) {

	$usercreated = $pagelib->get_created_user($page['id']);

	array_push($data, array(
		$page['title'],
		"edit",
		$usercreated['username'],
		gmdate("m-d-Y", $page['datecreated']),
		gmdate("m-d-Y", $page['datemodified'])
	));
}

?>

<h1>Page administration</h1>

<?php

$helper->start_div(null, "panel panel-default");


$helper->start_a($CORE->link("/admin/edit/page/add_page"), null, null, 'btn btn-primary');
$helper->start_tag('span', null, 'glyphicon glyphicon-edit');
$helper->end_tag('span');
echo " New page";
$helper->end_a();

$helper->start_a($CORE->link("/admin/edit/page/add_page"), null, null, 'btn btn-default');
$helper->start_tag('span', null, 'glyphicon glyphicon glyphicon-filter');
$helper->end_tag('span');
echo " Filters";
$helper->end_a();

$helper->admin_table($titles, $data);

$helper->end_div(); // panel panel-default

// get number of pages in db
$numOfPages = count($pagelib->get_list_of_pages());

$pagination->start_pagination_bar($numOfPages);


?>