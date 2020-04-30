app.service("dataService", [
  "$q",
  "$http",
  function ($q, $http) {
    /**
     * Var to hold base url
     */
    var baseUrl = "http://localhost:8066/api/";
    /**
     * method to promise when fulfilled calls the then method on success.
     */
    this.getApiRequest = function (request) {
      var promise = $q.defer(), //The promise
        apiRequest = baseUrl + request; //Request

      $http
        .get(apiRequest)
        .then(function (response) {
          promise.resolve({
            result: response.data,
          });
        })
        .catch(function (err) {
          promise.reject(err);
        });
      return promise.promise;
    };
  },
]);
