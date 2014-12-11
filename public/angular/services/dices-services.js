app.factory('Dices', function ($q, $http)
{
    var self = {

    };


    self.getReroll = function(dices)
    {
        var d = $q.defer();
        $http.post( '/game/getReroll', dices ).
            success(function (data)
            {
                d.resolve(data);
            }
        );
        return d.promise;
    };

    self.getDices = function()
    {
        var d = $q.defer();
        $http.get( '/game/getDices' ).
            success(function (data)
            {
                d.resolve(data);
            }
        );
        return d.promise;
    };

    return self;
});