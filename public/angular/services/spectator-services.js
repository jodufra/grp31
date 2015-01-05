appServices.service('Spectators', function($http, CSRF_TOKEN){
    var service = {};
    service.spectate = function(data){
    	data['_token'] = CSRF_TOKEN;
        return $http.post( '/spectators/store', data);
    };

    return service;
});