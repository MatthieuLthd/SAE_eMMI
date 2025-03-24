app.service('Authentification', function($http)
{
    this.getCurrentUser = function()
    {
        return $http.get('http://ton-api-symfony.com/api/user');
    };

    this.logout = function()
    {
        return $http.post('http://ton-api-symfony.com/api/logout');
    };
});

app.controller('UserController', function($scope, Authentification)
{
    $scope.user = null;

    Authentification.getCurrentUser().then(function(response)
    {
        $scope.user = response.data;
    }, function(error)
{
    console.warn('Utilisateur non connecté');
});
    $scope.logout = function()
    {
    Authentification .logout().then(function()
    {
        $scope.user = null;
        window.location.href = '/';
    }); 
    };
});
