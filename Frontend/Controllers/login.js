var app = angular.module('myApp', []);

app.controller('login', function ($scope, $http) {
    $scope.connexion = {
        email: '',
        password: ''
    };

    $scope.submitForm = function () {
        console.log('Email:', $scope.connexion.email);
        console.log('Password:', $scope.connexion.password);
    
        if (!$scope.connexion.email || !$scope.connexion.password) {
            document.getElementById('error-message').innerText = 'Veuillez remplir tous les champs.';
            return;
        }
    
        // Appel à l'API de connexion
        $http.post('http://localhost/SAE_eMMI/Backend/public/index.php/api/login', {
            email: $scope.connexion.email,
            password: $scope.connexion.password
        }).then(function (response) {
            // Succès
            alert('Connexion réussie !');
            console.log(response.data);
            window.location.href = '../Page/user.html';
        }).catch(function (error) {
            // Erreur
            document.getElementById('error-message').innerText = 'Nom d\'utilisateur ou mot de passe incorrect.';
            console.error(error);
        });
    };
});