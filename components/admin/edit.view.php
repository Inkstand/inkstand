<?php

global $CORE;

$editcomponent = $viewdata->editcomponent;
$editinstance =  $viewdata->editinstance;

$isinstance = ($editinstance != null && $editinstance != 0);

?>

<header>
	<?php if($isinstance) { ?>

	<h2>Edit Article</h2>

	<?php } else { ?>

	<h2>Edit Article Component</h2>

	<?php } ?>
</header>

<div class="content">
	
	<?php

	if($isinstance) {
		require_once DIR . "/components/$editcomponent/editinstance.php";
	} else {
		require_once DIR . "/components/$editcomponent/edit.php";
	}
	

	?>

</div>