<?php

global $CORE;

?>

<header>
	<h2><?php echo $CORE->get_setting('site_title');?></h2>
</header>

<div class="content">
	<?php echo $CORE->get_setting('custom_homepage_content'); ?>	
</div>