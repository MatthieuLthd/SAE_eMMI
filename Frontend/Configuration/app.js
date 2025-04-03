var app = angular.module('myApp', ['ngRoute']);

// Configuration des routes
app.config(['$routeProvider', function($routeProvider) {
    $routeProvider
        .when('/user', { // Route pour la page utilisateur
            templateUrl: '../Page/user.html',
            controller: 'users'
        })
        .when('/inscription', { // Route pour la page d'inscription
            templateUrl: '../Page/inscription.html',
            controller: 'isncription'
        })
        .when('/login', { // Route pour la page de connexion
            templateUrl: '../Page/login.html',
            controller: 'login'
        })
        .when('/creerEvent', { // Route pour la page de création d'événement
            templateUrl: '../Page/creerEvent.html',
            controller: 'créerevent'
        })
        .when('/commentaire', { // Route pour la page des commentaires
            templateUrl: '../Page/commentaire.html',
            controller: 'commentaire'
        })
        .otherwise({ // Redirection par défaut
            redirectTo: '/login'
        });
}]);

// Contrôleur pour la page utilisateur
app.controller('users', function($scope) {
    $scope.message = "Page utilisateur";
});

// Contrôleur pour la page d'inscription
app.controller('formInscriptionController', function($scope) {
    $scope.message = "Page d'inscription";
});

// Contrôleur pour la page de connexion
app.controller('login', function($scope) {
    $scope.message = "Page de connexion";
});

// Contrôleur pour la page de création d'événement
app.controller('creerEventController', function($scope) {
    $scope.message = "Créer un événement";
});

// Contrôleur pour la page des commentaires
app.controller('commentaire', function($scope) {
    $scope.message = "Postez un commentaire";
});