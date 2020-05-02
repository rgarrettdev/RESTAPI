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
      console.log(apiRequest);
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
    this.postUserLogin = function (request) {
      var promise = $q.defer(), //The promise
        apiRequest = baseUrl + "login/"; //Request
      console.log(apiRequest);
      if (request == undefined) {
        return promise.promise;
      } else {
        data = {
          email: request.email,
          password: request.password
        }
        console.log(data);
        $http.post(apiRequest,data)
          .then(function (response) {
            promise.resolve(response);
          })
          .catch(function (err) {
            promise.reject(err);
          });
        return promise.promise;
      }

    };
  },
]);


