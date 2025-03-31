//Tous les rêquetes sont faites, il faut juste que tu rajoutes l'url de l'api.

app.service('CommentService', function($http) {
    this.addComment = function(commentData) {
        return $http.post('/api/comments', commentData);
    };

    this.getComments = function(idEvent) {
        return $http.get('/api/comments/' + idEvent);
    };
});
