<?php

class HomepageLibrary 
{
	public function getLayout() {
		global $CORE;
		return $CORE->getSetting('custom_homepage_layout');
	}
	
}

?>