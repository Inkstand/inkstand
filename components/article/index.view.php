<?php

global $CORE;

?>

<header>
	<h2>Articles</h2>
</header>

<div class="content">
	<div class="display-gallery">

	<?php
		
	foreach ($viewdata->articles as $article) {
		echo "<div class='display-item display-item2'>";

		echo "<header>";
		echo "<h4><a href='" . $this->link("/index.php/article/read/" . $article['id']) . "'>" . $CORE->shortenString($article['title'], 100) . "</a></h4>";
		echo "</header>";

		echo "<div class='content'>";

		if(!empty($article['image'])) {
			echo "<img src='" . WWW . $article['image'] . "'>";
		}

		echo "</div>"; // .content

		echo "<footer>";
		echo '<div class="fb-share-button" data-href="' . WWW . "/index.php/article/read/" . $article['id'] . '" data-type="button"></div>';
		echo '<a href="https://twitter.com/share" class="twitter-share-button" data-related="joeconradt" data-count="none">Tweet</a>';
		echo "</footer>";

		echo "</div>"; // .display-item
	}

	?>

	</div>
</div>