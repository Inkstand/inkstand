<?php

require_once DIR . '/core/helpers/html_helper.php';

class PaginationHelper extends HtmlHelper
{
	public $max = 5;
	public $showitems = array(5,10,20,50,100);

	public function start_pagination_bar($totalitems)
	{
		$currentPage = (!empty($_GET['pp']) ? $_GET['pp'] : 1);

		// calculate how many pages the pagination needs 
		$showitems = (!empty($_GET['si']) ? $_GET['si'] : $this->showitems[0]);

		$pageCount = ceil($totalitems / $showitems);

		$this->start_tag('hr');
		$this->start_div(null, 'row');

		// first part of the pag bar, the number of total items
		$this->start_div(null, 'col-md-2');
		$this->start_p(null, 'text-muted');
		echo $totalitems . ' total';
		$this->end_p();
		$this->end_div();

		// second part of the pag bar, the actual pagination
		$this->start_div(null, 'col-md-8', array('style' => 'text-align:center'));
		$this->start_pagination($pageCount, $currentPage, $this->max);
		$this->end_div();

		// second part of the pag bar, the actual pagination
		$this->start_div(null, 'col-md-2');
		$this->start_showitems();
		$this->end_div();

		$this->end_div();
	}
	public function start_pagination($pageCount, $currentPage)
	{
		// echo out the start of the pagination list
		$this->start_ul(null, "pagination", array('style' => 'margin:auto'));

		// make sure max is acceptable
		if($this->max < 5 || $this->max % 2 == 0) {
			// throw error
			die("Parameter 'max' is not accetpable. Must be an odd number greater than or equal to 5");
		} 


		// echo out left arrow
		$this->start_li();
		$this->start_a('#');
		echo '&laquo;';
		$this->end_a();
		$this->end_li();

		if($pageCount >= $this->max) {
			$offset = $currentPage - (int)($this->max / 2);
			$startingItem = ($offset > 0 ? $offset : 1);
			$endingItem = $startingItem + $this->max;

			$offset = $pageCount - $currentPage - (int)($this->max / 2);

			if($offset > 0) {
				$offset = 0;
			}

			$startingItem += $offset;
			$endingItem += $offset;
		} else {
			$max = $pageCount;
			$startingItem = 1;
			$endingItem = $pageCount + 1;
		}

		for ($i=$startingItem; $i < $endingItem; $i++) { 
			
			$this->start_li(null, ($i == $currentPage ? 'active' : null));

			// work in conjuction with showitems
			$si = (!empty($_GET['si']) ? $_GET['si'] : '');

			$this->start_a('?pp=' . $i . '&si=' . $si);

			echo $i;

			$this->end_a();
			$this->end_li();

		}

		// echo out right arrow
		$this->start_li();
		$this->start_a('#');
		echo '&raquo;';
		$this->end_a();
		$this->end_li();

		$this->end_ul(); // end ul
	}
	public function start_showitems()
	{
		$this->start_tag('form', null, 'form', array('method' => 'get', ));

		$options = array(
			'name' => 'si',
			'style' => 'width:120px;float:right',
			'onchange' => 'this.form.submit()',
		);

		$this->start_tag('select', null, 'form-control', $options);

		// see if the item dropdown is set, if not, default to the first choice
		$current = (!empty($_GET['si']) ? $_GET['si'] : $this->showitems[0]);

		foreach ($this->showitems as $showitem) {

			$options = array(
				'value' => $showitem,
				'name' => 'si',
			);

			if($current == $showitem) {
				$options['selected'] = 'selected';
			}

			$this->start_tag('option', null, null, $options);
			echo $showitem . ' items';
			$this->end_tag('option');
		}

		$this->end_tag('select');
		$this->end_tag('form');
	}
	public function get_range()
	{
		// return two values for the LIMIT part of sql queries
		$pagination_page = (!empty($_GET['pp']) ? $_GET['pp'] : 1);
		$showitems = (!empty($_GET['si']) ? $_GET['si'] : $this->showitems[0]);

		$start = ($pagination_page -1) * $showitems;
		$end = (($pagination_page -1) * $showitems) + $showitems;

		return array('start' => $start, 'length' => $showitems);
	}
}

?>