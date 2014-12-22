appControllers.controller('TestingNodeController', function($scope){
	$scope.response;
	$scope.sendRequest = function(){
		socket.emit('request', true);
	};
	socket.on('response', function (data) {
		$scope.response=data;
		$scope.$apply();
	});
	// $scope.increaseValue = function(){
	// 	Users.create($scope.user).then(function(data)
	// 	{
	// 		console.log(data);
	// 	});
	// 	console.log("create user");
	// };
	// socket.on('example.update', function (data) {
	// 	$scope.value=JSON.parse(data);
	// });
});