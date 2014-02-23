

$(document).ready(function() {

	$(".module").click(function() {
		flipModule($(this));
	});

});

function flipModule(module) {
	var moduleid = module.attr("module");
	module.flippy({
		verso:"Hi !",
	    direction:"TOP",
	    duration:"750",
	    onStart:function(){
	        
	    },
	    onFinish:function(){
	        
	    }
	});
}