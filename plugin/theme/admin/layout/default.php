<?php

require_once 'header.php';

$path = DIR . '/components';
$folders = scandir($path);

foreach ($folders as $folder) {
    if ($folder === '.' or $folder === '..') continue;

}

?>

<div id="admin-sidebar">
	<div class="user-profile">
		<span class="col-md-2"><img width="33" height="33" src="http://www.fbccoll.org/assets/1599/1_profile-pic-placeholder.gif"></span>
		<span class="col-md-3"><a>Admin</a></span>
	</div>
	<ul class="nav nav-sidebar">
		<li>
			<a href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a>
		</li>
		<li>
			<a href="#" data-toggle-target="components"><i class="fa fa-th-large"></i> <span>Components</span></a>
			<ul id="components" class="nav nav-sidebar collapse">
				<?php foreach ($folders as $folder) : ?>
					<?php if ($folder === '.' or $folder === '..' or !is_dir($path . '/' . $folder)) continue; ?>

					<li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;|-- <?php echo $folder ?></a></li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
	</ul>
</div>
<div id="admin-content">
	<div class="content-bar">
		<ol style="display:inline-block" class="breadcrumb col-md-6">
			<li><a href="#"><i class="fa fa-home"></i> </a></li>
			<li><a href="#">Page</a></li>
			<li class="active">List</li>
		</ol>
		<div class="col-md-6">
			<a class="btn btn-default btn-xs">Update</a>
			<a class="btn btn-default btn-xs">View site</a>
		</div>
	</div>
	<div class="inner-content">
		<?php $this->inject_view() ?>
	</div>
</div>
