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
