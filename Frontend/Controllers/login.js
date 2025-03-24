$scope.login = function()
{
    $http.post('http://ton-api-symfony.com/api/login', $scope.loginData)
    .then(function(response)
    {
        alert('Te revoilà parmi nous !');
        $location.path('/user');
        localStorage.setItem('token', response.data.token);
    }, function(error){
        console.error('Erreur de connexion : ', error);
    });
};