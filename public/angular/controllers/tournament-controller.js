appControllers.controller('TournamentController', function($scope) {	
	var wLocation = window.location.href;
	var array = wLocation.split("/");
	var tournamenID = array[5];
	console.log(tournamenID);
	document.getElementById("startTournament").href="/tournaments/start/"+tournamenID;
});