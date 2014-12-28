$(function(){
	timeoutAlerts();
	refreshUI();

	$('.datepicker').datepicker({});
	$('.dropdown-autoclose-prevented *').click(function(e) { e.stopPropagation(); });

	var normal = '<span class="glyphicon glyphicon-plus"></span><span>&nbsp;</span><span class="">Looking for a Player</span>';
	var hover = '<span class="glyphicon glyphicon-remove"></span><span>&nbsp;</span><span>Stop Looking?</span>';
	$('.list-group .list-group-item.col-md-6.empty.searching').hover(function(){
		$(".list-group .list-group-item.col-md-6.empty.searching .content").html(hover);
	}, function(){
		$(".list-group .list-group-item.col-md-6.empty.searching .content").html(normal);
	});
});
function timeoutAlerts(){
	setTimeout(function(){ $('.alert-success').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-info').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-warning').slideUp("slow")}, 7500);
}

function refreshUI(){
	$('[data-toggle="tooltip"]').tooltip();
	fixPortraits();

	setTimeout(function(){ refreshUI() }, 2500);
}

function fixPortraits(){
	$( ".portrait" ).error(function() {
		$(this).attr( "src", "../img/default.png" );
	});
}




