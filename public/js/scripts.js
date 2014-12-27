$(function(){
	timeoutAlerts();
	fixPortraits();
	$('.datepicker').datepicker({});
	$('.dropdown-autoclose-prevented *').click(function(e) {
        e.stopPropagation();
    });
  	$('[data-toggle="tooltip"]').tooltip()
});
function fixPortraits(){
	$( ".portrait" ).error(function() {
		 $(this).attr( "src", "../img/default.png" );
	});
	setTimeout(function(){ fixPortraits() }, 5000);
}
function timeoutAlerts(){
	setTimeout(function(){ $('.alert-success').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-info').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-warning').slideUp("slow")}, 7500);
}
