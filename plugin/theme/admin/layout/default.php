<?php

require_once 'header.php';

?>



<div id="row clearfix">
	<div class="col-md-3">
		<ul class="nav nav-sidebar">
			<li><a href="#">Components</a></li>
			<li><a href="#">Settings</a></li>
		</ul>
	</div>
	<div class="col-md-9">
		<?php $this->inject_view() ?>
	</div>
</div>
