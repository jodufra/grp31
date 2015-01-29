appServices.service('GameIndex', function($http){
    var service = {};
    service.getOngoingGames = function(){
        return $http.get( '/game/ongoinggames' );
    };

    return service;
});

appServices.service('GameStore', function($http){
    var service = function(data){
        return $http.post( '/game/store', data );
    }
    return service;
});

appServices.service('GameShow', function($http, CSRF_TOKEN){
    var service = {};
    service.Reroll = function(data){
        data['_token'] = CSRF_TOKEN;
        return $http.post( '/game/reroll', data);
    };
    service.Dices = function(data){
        data['_token'] = CSRF_TOKEN;
        return $http.post( '/game/dices', data);
    };
    service.move = function(data){
        data['_token'] = CSRF_TOKEN;
        return $http.post('/move/create', data);
    }

    return service;
});
