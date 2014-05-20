<?php

class HomepageLibrary 
{
	public function getLayout() {
		global $CORE;
		return $CORE->get_setting('custom_homepage_layout');
	}
	
}

?>