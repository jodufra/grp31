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
    service.getReroll = function(data){
        data['_token'] = CSRF_TOKEN;
        return $http.post( '/game/getReroll', data );
    };
    service.getDices = function(){
        return $http.get( '/game/getDices' );
    };

    return service;
});

app.factory('Dices', function ($q, $http, CSRF_TOKEN)
{
    var service = {
        getReroll : function(data){
            data['_token']=CSRF_TOKEN;
            return $http.post( '/game/reroll', data );
        },
        getDices : function(){
            return $http.get( '/game/dices' );
        },
    };
    return service;
});

app.factory('Dice', function ()
{
    return function(val, saved){
        return new dice(val, saved);
    };
});

function dice(val, saved){
    this.val = val;
    this.saved = saved;
    return this;
}