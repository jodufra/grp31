$(function(){
	$('input[type=file]').bootstrapFileInput();
	$('.datepicker').datepicker({});
	timeoutAlerts();
	tabNav();
	fixPortraits();
	setInterval(function(){refreshUI();}, 2500);
});

function timeoutAlerts(){
	setTimeout(function(){ $('.alert-success').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-info').slideUp("slow")}, 5000);
	setTimeout(function(){ $('.alert-warning').slideUp("slow")}, 7500);
}

function fixPortraits(){
	$( ".portrait" ).error(function() {
		console.log('fixing portrait');
		$(this).attr( "src", "/img/default.png" );
	});
}

function refreshUI(){
	$('[data-toggle="tooltip"]').tooltip();
	$('.dropdown-autoclose-prevented').click(function(e) { e.stopPropagation(); });
	fixPortraits();
}

function tabNav(){
	var hash = window.location.hash;
	hash && $('ul.nav a[href="' + hash + '"]').tab('show');
	$('.nav-tabs a').click(function (e) {
		$(this).tab('show');
		var scrollmem = $('body').scrollTop();
		window.location.hash = this.hash;
		$('html,body').scrollTop(scrollmem);
	});
}