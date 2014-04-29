
$(document).ready(function() {
	$(".navtoggle").click(function() { 
		var id = $(this).attr("data-toggle");
		$("#" + id).slideToggle(); 
	});

	// checkbox to check them all
	$("#mastercheckbox").change(function() {
		console.log("hi");
		if(this.checked) {
			$("#pagelistform input[type=checkbox]").prop("checked", true);
		} else {
			$("#pagelistform input[type=checkbox]").prop("checked", false);
		}
	});

	// submit form from "with selection" dropdown
	$("#selectionmenu a").click(function() {

		var value = $(this).attr('value');

		$('#listform input[name=action]').attr('value', value);

		$('#listform').submit();

	});
});