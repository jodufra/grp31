$(function(){
	timeoutAlerts();
	fixPortraits();
	$('.datepicker').datepicker({});
	$('.dropdown-autoclose-prevented *').click(function(e) {
		e.stopPropagation();
	});
	$('[data-toggle="tooltip"]').tooltip()

	var normal = '<span class="glyphicon glyphicon-plus"></span><span>&nbsp;</span><span class="">Looking for a Player</span>';
	var hover = '<span class="glyphicon glyphicon-remove"></span><span>&nbsp;</span><span>Stop Looking?</span>';
	$('.list-group .list-group-item.col-md-6.empty.searching').hover(function(){
		$(".list-group .list-group-item.col-md-6.empty.searching .content").html(hover);
	}, function(){
		$(".list-group .list-group-item.col-md-6.empty.searching .content").html(normal);
	});
});
function fixPortraits(){
	$( ".portrait" ).error(function() {
		$(this).attr( "src", "../img/default.png" );
	});
	setTimeout(function(){ fixPortraits() }, 2500);
}
function timeoutAlerts(){
	setTimeout(function(){ $('.alert-success').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-info').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-warning').slideUp("slow")}, 7500);
}
