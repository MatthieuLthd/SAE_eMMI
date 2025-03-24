app.controller('DashboardController', function($scope, evenementService)
{
    $scope.events = 
    [
        {id:'', title:'',description:'',location:'',date:''},
        {id:'', title:'',description:'',location:'',date:''},
    ];

    $scope.editingEvent = null;

    $scope.editingEvent = function(event)
    {
        $scope.editingEvent = angular.copy(event);
    };
    
    $scope.saveEvent = function()
    {
        evenementService.updateEvent($scope.editingEvent).then(function(response)
        {
            alert('L\'évènement à été modifé');
        }
    )
    }
})