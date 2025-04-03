//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.
var app = angular.module('myApp',[]);

app.service('evenementService', function ($http)
{
    this.getEvents = function()
    {
        return $http.get('http://localhost/SAE_eMMI/Backend/public/index.php/api/events'); // mettre  l'url de l'api, ça corresponds à la table events
    };
    this.getFilteredEvents = function(filter){
        return $http.get('http://localhost/SAE_eMMI/Backend/public/index.php/api/events?filter=' + filter); // mettre  l'url de l'api, ça corresponds à la table events
    }
});

app.controller('evenement', function($scope, evenementService )
{
    $scope.events = [];
        evenementService.getEvents().then(function(response){
            $scope.events = response.data;
        }, function(error) {
             console.error('Erreur de récupération des événements : ', error);
        });
    $scope.filter = '';
    $scope.filterEvents = function() {
        evenementService.getFilteredEvents($scope.filter).then(function(response){
            $scope.events = response.data;
        }, function(error) {
             console.error('Erreur de récupération des événements filtrés : ', error);
        });
    };
});
