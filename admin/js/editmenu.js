
$(document).ready(function() {

	// collapse all options
	$(".options-collapse").hide();

	$(".expand").click(function() {
		var target = $(this).attr('data-target');

		// toggle things
		toggleChevron($("span", $(this)));
		$("#" + target).toggle();
	});

	// delete item
	$(".delete").click(function() {
		var _this = $(this);
		var c = confirm("Are you sure you want to delete this item?");

		if(c) {
			_this.parent().parent().remove();
		}
		
	});

	// add new items

	$('.add-new #link').click(function() {
		
	});

});

function toggleChevron(element) {
	if(element.hasClass('glyphicon-chevron-down')) {
		element.removeClass('glyphicon-chevron-down');
		element.addClass('glyphicon-chevron-up');
	} else {
		element.removeClass('glyphicon-chevron-up');
		element.addClass('glyphicon-chevron-down');
	}
}