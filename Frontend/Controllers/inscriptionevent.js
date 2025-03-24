var app = angular.module('myApp', []);

app.controller('InscriptionEventController', function ($scope, $http)
{
    $scope.formData = {};

    $scope.submitForm = function()
    {
        $http.post('http://ton-api-symfony.com/api/formulaire',$scope.formData)
        .then(function(response)
        {
            alert('Inscription validée ! À bientôt');

        },
    function(errors)
    {
        console.errors('Inscription invalide, réessaye.', errors)

    });
    };

});