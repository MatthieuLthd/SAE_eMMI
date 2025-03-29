var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', function($routeProvider)
{
    $routeProvider
    .when('/user', 
        {
            templateUrl: '../Page/user.html',
            controller: 'UserController'
        })
    .when('/inscription', {
            templateUrl: '../Page/inscription.html',
            controller: 'formInscriptionController'
        })
    .when('/login', {
            templateUrl: '../Page/login.html',
            controller: 'formLoginController'
        })    
        .otherwise
        ({
           redirectTo: '/'
        });
}]);

app.controller('UserController', function($scope) {
    $scope.message = "Page utilisateur";
});

app.controller('formInscriptionController', function($scope) {
    $scope.message = "Page d'inscription";
});

app.controller('formLoginController', function($scope) {
    $scope.message = "Page de connexion";
});
