app.controller('users', function($scope, $http) {
    $scope.user = null;
    $scope.registeredEvents = [];
    $scope.events = [];

    // URL de base pour l'API
    const baseUrl = 'http://localhost/SAE_eMMI/Backend/public/index.php';

    // Récupérer l'utilisateur connecté
    $http.get(`${baseUrl}/api/users/me`).then(function(response) {
        $scope.user = response.data;

        // Récupérer les événements auxquels l'utilisateur est inscrit
        $http.get(`${baseUrl}/api/users/${$scope.user.id}/events`).then(function(response) {
            $scope.registeredEvents = response.data;
        }, function(error) {
            console.warn('Impossible de récupérer les événements de l\'utilisateur.');
        });

    }, function(error) {
        console.warn('Utilisateur non connecté');
        $scope.user = null;
    });

    // Récupérer tous les événements
    $http.get(`${baseUrl}/api/events`).then(function(response) {
        $scope.events = response.data;
    }, function(error) {
        console.warn('Impossible de récupérer les événements.');
    });

    // Déconnexion
    $scope.logout = function() {
        $http.post(`${baseUrl}/logout`).then(function() {
            $scope.user = null;
            window.location.href = '/';
        }, function(error) {
            console.warn('Erreur lors de la déconnexion.');
        });
    };
});