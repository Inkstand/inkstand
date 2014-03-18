<?php

global $CORE;

?>

<h2>Articles</h2>

<div class="display-gallery">

<?php
	
foreach ($viewdata->articles as $article) {
	echo "<div class='display-item3'>";

	echo "<img src='http://image.motortrend.com/f/37149241+w1500+ar1+st0/2013-Ford-Taurus-SHO-front-three-quarter-static.jpg'>";

	echo "<h4><a href='" . $this->link("/index.php/article/view/" . $article['id']) . "'>" . $CORE->shortenString($article['title'], 100) . "</a></h4>";

	echo $article['description'];

	echo "</div>";
}

?>

</div>