<?php

class HomepageLibrary 
{
	public function get_layout() {
		global $CORE;
		return $CORE->get_setting('custom_homepage_layout');
	}
	
}

?>