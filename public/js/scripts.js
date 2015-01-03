$(function(){
	$('input[type=file]').bootstrapFileInput();
	$('.datepicker').datepicker({});
	timeoutAlerts();
	setInterval(function(){refreshUI();}, 2500);
});

function timeoutAlerts(){
	setTimeout(function(){ $('.alert-success').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-info').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-warning').slideUp("slow")}, 7500);
}

function refreshUI(){
	$('[data-toggle="tooltip"]').tooltip();
	$('.dropdown-autoclose-prevented').click(function(e) { e.stopPropagation(); });
	fixPortraits();
}

function fixPortraits(){
	$( ".portrait" ).error(function() {
		$(this).attr( "src", "../img/default.png" );
	});
}




