//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.

app.controller('CommentaireController', function($scope, CommentService) {
    $scope.comments = [];
    $scope.newComment = { id_event: 1, content: '' };

    $scope.loadComments = function() {
        CommentService.getComments($scope.newComment.id_event).then(function(response) {
            $scope.comments = response.data;
        });
    };

    $scope.submitComment = function() {
        CommentService.addComment($scope.newComment).then(function(response) {
            alert('Commentaire envoyé !');
            $scope.newComment.content = ''; // Mise à 0 du champ
            $scope.loadComments(); // Rafraîchir la liste des commentaires
        });
    };

    // Charger les commentaires au chargement de la page
    $scope.loadComments();
});
