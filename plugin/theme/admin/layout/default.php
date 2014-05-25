<?php

require_once 'header.php';

$folders = scandir(DIR . '/components');

foreach ($folders as $folder) {
    if ($folder === '.' or $folder === '..') continue;

}

?>

<div id="admin-sidebar">
	<ul class="nav nav-sidebar">
		<li>
			<a href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a>
		</li>
		<li>
			<a href="#"><i class="fa fa-th-large"></i> <span>Components</span></a>
			<ul class="nav nav-sidebar collapse">
				<?php foreach ($folders as $folder) : ?>
					<?php if ($folder === '.' or $folder === '..') continue; ?>

				<li><?php echo $folder ?></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
	</ul>
</div>
<div id="admin-content">
	<div class="content-bar">
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> </a></li>
			<li><a href="#">Page</a></li>
			<li class="active">List</li>
		</ol>
	</div>
	<div class="inner-content">
		<?php $this->inject_view() ?>
	</div>
</div>
