<h2>Page administration</h2>

<div class="panel panel-default">
	<div class="panel-body">
		<a class="btn btn-primary" href="<?php $CORE->editlink('page', 'addpage') ?>">
			<span class="glyphicon glyphicon-edit"></span> New page
		</a>
		<a class="btn btn-default" href="#" title="Edit menus to link to your pages">
			<span class="glyphicon glyphicon-tasks"></span> Menus and pages
		</a>
	</div>
	<form id="listform" method="post">
	<input type="hidden" name="action" value="">
	<table class="table" style="border-bottom:1px solid #ddd;">

		<thead>
			<tr>
				<th style="width:5px"><input id="mastercheckbox" type="checkbox"></th>
				<th>Name</th>
				<th></th>
				<th>Created by</th>
				<th>Date created</th>
				<th>Last modifed</th>
			</tr>
		</thead>
		<tbody>