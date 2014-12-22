$(function(){
	timeoutAlerts();
	fixPortraits();
	$('.datepicker').datepicker({});
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
