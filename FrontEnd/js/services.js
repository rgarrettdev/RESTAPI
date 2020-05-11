app.service("dataService", [
  "$q",
  "$http",
  function ($q, $http) {
    /**
     * Var to hold base url
     */
    var baseUrl = "http://localhost:80/api/";
    /**
     * method to promise when fulfilled calls the then method on success.
     */
    this.getApiRequest = function (request) {
      var promise = $q.defer(), //The promise
        apiRequest = baseUrl + request; //Request
      $http
        .get(apiRequest, {cache:true})
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
    /**
     * post method when fulfilled calls the then method on success.
     */
    this.postApiRequest = function (request) {
      var promise = $q.defer(), //The promise
        apiRequest = baseUrl + "login"; //Request
      if (request == undefined) {
        return promise.promise;
      } else {
        data = {
          email: request.email,
          password: request.password,
        };
        $http
          .post(apiRequest, data)
          .then(function (response) {
            promise.resolve(response);
          })
          .catch(function (err) {
            promise.reject(err);
          });
        return promise.promise;
      }
    };
    /**
     * put method when fulfilled calls the then method on success.
     */
    this.putApiRequest = function (request) {
      var promise = $q.defer(), //The promise
        apiRequest = baseUrl + "schedule/update/" + request.schedule.id; //Request
      if (request == undefined) {
        return promise.promise;
      } else {
        data = {
          chair: request.update,
          id: request.schedule.id,
        };
        $http
          .put(apiRequest, data)
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
/**
 * This factory allows data to transfer between
 * contollers. Specfically the edit component controller
 * (editController)
 * and scheduleDetailed controller.
 */
app.factory("dataTransfer", function () {
  var data = [];

  var setSchedule = function (newObj) {
    data.push(newObj);
  };
  var getSchedule = function () {
    return data;
  }

  var resetSchedule = function () {
    data = [];
  }

  return {
    setSchedule: setSchedule,
    getSchedule: getSchedule,
    resetSchedule: resetSchedule,
  };
});
