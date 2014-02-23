<?php

require_once 'header.php';

?>

<div id="view-content">
	
<?php

	foreach($VIEW->modules as $module) {
		$CORE->printModule($module['type'], $module['id']);
	}	

?>

</div>

<?php

require_once 'footer.php';

?>

