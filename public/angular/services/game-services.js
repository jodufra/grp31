appServices.service('GameStore', function($http){
    var self = function(data){
        return $http.post( '/game', data );
    }
    return self;
});
app.factory('Dices', function ($q, $http)
{
    var self = {
        getReroll : function(dicesCount){
            return $http.post( '/game/getReroll', dicesCount );
        },
        getDices : function(){
            return $http.get( '/game/getDices' );
        },
    };
    return self;
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