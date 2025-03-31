app.service('EventService', function($http)
{
    this.updateEvent = function(event)
    {
        return $http.put('http://localhost:8000/api/events/' + event.id, event);
    },
    this.getEvents = function()
    {
        return $http.get('http://localhost:8000/api/events');
    }
    this.deleteEvent = function(event)
    {
        return $http.delete('http://localhost:8000/api/events/' + eventId);
    }
})