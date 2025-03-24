var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider)
{
    $routeProvider
    .when('/user', 
        {
            templateUrl: 'user.html',
            controller: 'UserController'
        })
        .otherwise
        ({
            redirecto:'/'
        });
});