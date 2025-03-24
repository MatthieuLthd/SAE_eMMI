var app = angular.module('myApp',[]);

app.controller('formInscriptionController', function($scope, $http)
{
    $scope.user = {};
    $scope.register = function() 
    {
        if ($scope.user.password !== $scope.user.repeat_password) 
        {
            alert('Les mots de passe ne correspondent pas.');
            return;
        }
        $http.post('http://ton-api-symfony.com/api/register', $scope.user)
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