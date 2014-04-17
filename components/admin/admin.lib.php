<?php

class AdminLibrary 
{
	function getSettingModules() {
		$html = '<div class="module module1">';
		$html .= '<div class="content">';
		$html .= '<p>This is a test setting module</p>';
		$html .= '</div>';
		$html .= '</div>';

		return array($html);
	}
}

?>