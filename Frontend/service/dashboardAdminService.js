app.service('dashboardAdminService', function($http)
{
    this.getNbevent = function()
    {
        return $http.get('http://ton-api-symfony.com/api/events'); // mettre  l'url de l'api, ça corresponds à la table events
    };
    this.getNbuser = function()
    {
        return $http.get('http://ton-api-symfony.com/api/users'); // mettre  l'url de l'api, ça corresponds à la table users
    };
    this.getNbinscrit = function()
    {
        return $http.get('http://ton-api-symfony.com/api/inscription'); // mettre  l'url de l'api, ça corresponds à la table inscription à un évenement
    };
    this.deleteEvent = function(eventId) {
        return $http.delete('http://ton-api-symfony.com/api/events/' + eventId); // mettre  l'url de l'api, ça corresponds à la table inscription à un évenement
    };
    this.activerUser = function(userId) {
        return $http.put('http://ton-api-symfony.com/api/user/' + userId); // mettre  l'url de l'api, ça corresponds à la table user
    };
    this.desactiverUser = function(userId) {
        return $http.put('http://ton-api-symfony.com/api/user/' + userId); // mettre  l'url de l'api, ça corresponds à la table user
    };
    this.deleteUser = function(userId) {
        return $http.delete('http://ton-api-symfony.com/api/users/' + userId); // mettre  l'url de l'api, ça corresponds à la table user
    };
})
