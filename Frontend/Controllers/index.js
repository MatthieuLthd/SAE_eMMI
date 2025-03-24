var app = angular.module('myApp',[]);

app.service('evenementService', function ($http)
{
    this.getEvents = function()
    {
        return $htpp.get('http://ton-api-symfony.com/api/events');
    };
});

app.controller('evenement', function($scope, evenementService )
{
    $scope.events = [];
        evenementService.getEvents().then(function(response){
            $scope.events = response.data;
        }, function(error) {
             console.error('Erreur de récupération des événements : ', error);
        });
});
