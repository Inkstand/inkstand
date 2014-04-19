
$(document).ready(function() {
	$(".navtoggle").click(function() { 
		var id = $(this).attr("data-toggle");
		$("#" + id).slideToggle(); 
	});
});