<?php

class HtmlHelper
{
	public function start_tag($tag = 'div', $id = null, $class = null, $options = null) 
	{

		// echo start of element
		echo "<$tag ";

		// echo id is not empty
		if(!empty($id)) {
			echo "id=\"$id\" ";
		}

		// echo classes
		if(!empty($class)) {
			echo "class=\"$class\" ";
		}

		if($options != null) {
			// other options such as data-role="funky-monkey" or href
			foreach ($options as $option => $value) {
				if(!empty($option)) {
					echo "$option=\"$value\" ";
				}	
			}
		}

		echo ">";
	}

	public function end_tag($tag = 'div') 
	{

		// echo end tag
		echo "</$tag>";
	}

	public function start_div($id = null, $class = null, $options = null) 
	{
		// build div tag
		$this->start_tag('div', $id, $class, $options);
	}

	public function end_div() 
	{
		echo "</div>";
	}

	public function start_a($href, $target = null, $id = null, $class = null, $options = null) 
	{
		// make sure options isn't null
		if($options == null) {
			$options = array();
		}

		$options['href'] = $href;
		$options['target'] = $target;

		$this->start_tag("a", $id, $class, $options);
	}

	public function end_a() 
	{
		echo "</a>";
	}

	public function start_table($id = null, $class = null, $options = null) 
	{
		// build table tag
		$this->start_tag('table', $id, $class, $options);
	}

	public function end_table() 
	{
		echo "</table>";
	}

	public function start_tr($id = null, $class = null, $options = null)
	{
		$this->start_tag('tr', $id, $class, $options);
	}

	public function end_tr() 
	{
		echo "</tr>";
	}

	public function start_th($id = null, $class = null, $options = null)
	{
		// build th tag
		$this->start_tag('th', $id, $class, $options);
	}

	public function end_th() 
	{
		echo "</th>";
	}

	public function start_td($id = null, $class = null, $options = null)
	{
		// build td tag
		$this->start_tag('td', $id, $class, $options);
	}

	public function end_td() 
	{
		echo "</td>";
	}

	public function start_p($id = null, $class = null, $options = null)
	{
		// build p tag
		$this->start_tag('p', $id, $class, $options);
	}

	public function end_p() 
	{
		echo "</p>";
	}

	public function start_img($src, $width = null, $height = null, $alt = null, $id = null, $class = null, $options = null)
	{
		// make sure options isn't null
		if($options == null) {
			$options = array();
		}

		$options['width'] = $width;
		$options['height'] = $height;
		$options['alt'] = $alt;
		$options['src'] = $src;

		$this->start_tag("img", $id, $class, $options);
	}

	public function start_ul($id = null, $class = null, $options = null)
	{
		// build ul tag
		$this->start_tag('ul', $id, $class, $options);
	}

	public function end_ul() 
	{
		echo "</ul>";
	}

	public function start_li($id = null, $class = null, $options = null)
	{
		// build li tag
		$this->start_tag('li', $id, $class, $options);
	}

	public function end_li() 
	{
		echo "</li>";
	}

	public function start_header($tag = 'h1', $id = null, $class = null, $options = null)
	{
		// build header tag
		$this->start_tag($tag, $id, $class, $options);
	}

	public function end_header($tag) 
	{
		echo "</$tag>";
	}
}

?>