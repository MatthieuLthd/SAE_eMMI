//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

app.controller('creerEventController', function($scope, evenementService)
{
    $scope.event = {};   
    $scope.createEvent = function()
    {
        evenementService.createEvent($scope.event)
        .then(function(response)
        {
            alert('Évenement créés !');
            $scope.event = {};  
        });
    };

});