//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

var app = angular.module('myApp',[]);

app.controller('formInscriptionController', function($scope, $http, $location)
{
    $scope.user = {};
    $scope.register = function() 
    {
        if ($scope.user.password !== $scope.user.repeat_password) 
        {
            alert('Les mots de passe ne correspondent pas.');
            return;
        }
        $http.post('http://ton-api-symfony.com/api/user', $scope.user) // mettre  l'url de l'api, ça corresponds à la table user
        .then(function(response)
        {
            alert('Bienvenue parmis nous !');
            $location.path('/user');
        },function(error)
        {
            console.error('Erreur lors de l\'inscription : ', error);
        });
    };
});