//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

app.controller('DashboardController', function($scope, evenementService)
{
    function loadEvents()
    {
        evenementService.getEvents().then(function(response)
        {
            $scope.events = response.data;
        })
    }
})
loadEvents();
$scope.modifEvent = function(event) 
{
    $scope.modifierEvent = angular.copy(event);
};
$scope.saveEvent = function()
{
    evenementService.updateEvent($scope.modifierEvent).then((function(response)
    {
        alert('L\'événement a été mis à jour');
        loadEvents();
    }
    ));
};


$scope.supprEvent = function(event)
{
    evenementService.deleteEvent(event).then(function(response)
    {
        alert('L\'évenement a été supprimé');
        loadEvents();
    })
}


