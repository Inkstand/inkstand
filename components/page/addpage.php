<?php

$CORE->tinymce("#content");

?>

<h1>Add page</h1>

<div class="container-fluid">
	<div class="row">
		<div class=".col-md-8">
			<form>
				<div class="form-group">
					<label for='title'>Title</label>
					<input type='text' name='title' class='form-control' placeholder='Joe&#39;s coding services'>
				</div>

				<div class="form-group">
					<label for='content'>Content</label>
					<textarea id='content' name='content'></textarea>
				</div>

				<input type='submit' class='btn btn-primary'>

			</form>
		</div>
		<div class=".col-md-4">
			<p>Hello!</p>
		</div>
	</div>
</div>