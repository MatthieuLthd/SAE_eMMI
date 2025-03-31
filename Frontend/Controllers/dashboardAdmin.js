app.controller('dashAdminController', function($scope, dashboardAdminService) {
    $scope.nb = {
        totalEvents: 0,
        totalUsers: 0,
        totalInscriptions: 0,
        eventsPerUser: 0
    };

    dashboardAdminService.getNbevent().then(function(response) 
    {
        $scope.nb.evenement = response.data.count; 
    });

    dashboardAdminService.getNbuser().then(function(response) 
    {
        $scope.nb.user = response.data.count;
        $scope.nb.eventsPerUser = $scope.nb.totalUsers > 0 ? ($scope.nb.totalEvents / $scope.nb.totalUsers).toFixed(2) : 0;
    });

    dashboardAdminService.getNbinscrit().then(function(response) 
    {
        $scope.nb.inscription = response.data.count;
    });

    $scope.deleteEvent = function(eventId) {
        dashboardAdminService.deleteEvent(eventId).then(function(response) 
        {
            alert('Événement supprimé avec succès !');
            // Rafraîchir les données après la suppression
            $scope.loadEvents();
        }, function(error) 
        {
            console.error('Erreur lors de la suppression de l\'événement : ', error);
        });
    };
    $scope.activerUser = function(userId)
    {
        dashboardAdminService.activerUser(userId).then(function(response)
    {
            alert('Utilisateur acivé !');
    
    })
    }
    $scope.desactiverUser = function(userId)
    {
        dashboardAdminService.desactiverUser(userId).then(function(response)
    {
            alert('Utilisateur désactivé !');
    
    })
    }
    $scope.deleteUser = function(userId) {
        dashboardAdminService.deleteUser(userId).then(function(response) 
        {
            alert('Utilisateur supprimé !');
            $scope.loadUsers();
        })
    }
});