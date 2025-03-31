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
    .when('/creerEvent', {
            templateUrl: '../Page/creerEvent.html',
            controller: 'creerEventController'
        })  
    .when('/commentaire', {
            templateUrl: '../Page/commentaire.html',
            controller: 'CommentaireController'
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

app.controller('creerEventController', function($scope) {
    $scope.message = "Créer un évenement";
});

app.controller('CommentaireController', function($scope) {
    $scope.message = "Postez un commentaire";
});
