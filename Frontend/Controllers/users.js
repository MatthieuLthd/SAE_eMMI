//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

var app = angular.module('myApp', []);

app.controller('UserController', function($scope, Authentification)
{
    $scope.user = null;

    Authentification.getCurrentUser().then(function(response)
    {
       $scope.user = response.data;
    }, function(error)
{
    console.warn('Utilisateur non connecté');
    $scope.user = null;
});
    $scope.logout = function()
    {
    Authentification .logout().then(function()
    {
        $scope.user = null;
        window.location.href = '/';
    }); 
    };
});
