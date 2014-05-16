<?php
$CORE = new Core();

$page = $viewdata->page;

if(empty($page)) {
	echo "<h2>404 - Oops!</h2>";
	echo "<p>There doesn't appear to be an article, perhaps it's been moved or the supplied URL is incorrect.</p>";
}

?>

<header>
	<h2><?php echo $page['title'] ?></h2>
</header>

<div class="content">
	<?php echo $page['content'] ?>
</div>

<footer>

</footer>