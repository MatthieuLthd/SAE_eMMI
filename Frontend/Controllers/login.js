//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.
var app = angular.module('myApp', []);

app.controller('formLoginController', function($scope, $http, $location) {
    $scope.login = {};

    $scope.loginData = function(){
    $http.post('http://ton-api-symfony.com/api/users', $scope.loginData) // mettre  l'url de l'api, ça corresponds à la table user
    .then(function(response)
    {
        alert('Te revoilà parmi nous !');
        $location.path('/user');
        localStorage.setItem('token', response.data.token);
    }, function(error){
        console.error('Erreur de connexion : ', error);
    });
   };
});