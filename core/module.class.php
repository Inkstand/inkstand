<?php

class Module {

	protected $type;
	protected $html = "";

	protected function __construct($type) {
		$this->type = $type;
	}
	protected function printModule() {
		echo '<div class="module module' . $type . '">';
		echo $this->html;
		echo '</div>';
	}
}