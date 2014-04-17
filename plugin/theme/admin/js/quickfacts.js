var contents = [
	"<p>PHP, Python, and Perl! I also love jQuery and C#",
	"<p>Check out my resume here: <a href='index.php/article/view/resume'>link!</a>"
];

$(document).ready(function() {
	$(".quick-facts select").change(function() {
		var val = $(this).val();
		if(val > 0) {
			$(".quick-facts .placeholder").slideUp(500, function() {
				$(".quick-facts .placeholder").html(contents[val - 1]).slideDown();
			});
		}
	});
});