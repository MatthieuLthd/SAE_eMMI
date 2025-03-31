
//Tous les rêquetes http sont faites, il faut juste que tu rajoutes l'url de l'api.


app.service('evenementService', function($http)
{
    this.createEvent = function(event)
    {
      let formData = new FormData();
      formData.append('title', event.titre);
      formData.append('date', event.date);
      formData.append('description', event.description);
      // formData.append('image', event.image);
      formData.append('location', event.location);  
      
      return $http.post('http://localhost:8000/api/events', formData, //les infos sont envyés dans la table events, c pour créer une évenèment

      {
        headers: {'content-Type': undefined }
      });
    };
});