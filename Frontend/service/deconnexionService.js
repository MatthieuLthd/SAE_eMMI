app.service('deconnexionService', function($http, $window)
{
    this.deconnexion = function()
    {
        return $https.post('http://localhost:8000/api/logout');

        $window.location.href = '/index.html';
    }
})