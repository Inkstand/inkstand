

$(document).ready(function() {

	$("*[data-toggle-target]").click(function() {
		var target = $(this).attr('data-toggle-target');
		$("#" + target).slideToggle();
	});
});