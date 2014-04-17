<?php

global $CORE;

?>

<header>
	<h2>Administration</h2>
</header>

<div class="content">

<?php
if(!empty($viewdata->modules)) {
	foreach($viewdata->modules as $module) {
		echo $module;
	}
}

?>

</div>