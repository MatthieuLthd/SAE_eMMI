//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

var app = angular.module('myApp', []);

app.controller('InscriptionEventController', function ($scope, $http, $location)
{
    $scope.register = function()
    {

        $http.post('http://ton-api-symfony.com/api/inscription') // mettre  l'url de l'api, ça corresponds à la table inscription
        .then(function(response)
        {
            alert('Inscription validée ! On a  hâte de te retrouver !');
            $location.path('/commantaire');

        },
    function(errors)
    {
        console.errors('Inscription invalide, réessaye.', errors)

    });
    };
    
    $scope.event = {};
    $http.post('http://ton-api-symfony.com/api/events',$scope.formData) // mettre  l'url de l'api, ça corresponds à la table events. Lu but est d'afficher est d'afficher les évenements et les informations qui les concernent notamment le nom et la description.
    .then(function(response)
    {
        $scope.event = response.data;
    });

});