/**
 * appController, controls the alert bar
 * gives the user feedback on loading progress,
 * and to give the user feedback on search functionality.
 */
app.controller("appController", [
  "$scope",
  function ($scope) {
    $scope.$on("LOAD", function () {
      $scope.alert = true;
      $scope.status = "Loading";
    });
    $scope.$on("UNLOAD", function () {
      $scope.alert = false;
    });
    $scope.$on("SearchNoReturn", function () {
      $scope.status = "No results found";
    });
  },
]);

app.controller("scheduleController", [
  "$scope",
  "dataService",
  function ($scope, dataService) {
    $scope.$emit("LOAD");
    var getSchedule = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.schedule = response.data;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          $scope.$emit("UNLOAD");
        });
    };
    getSchedule("schedule/");
  },
]);

app.controller("scheduleDetailedController", [
  "$scope",
  "dataService",
  "$routeParams",
  function ($scope, dataService, $routeParams) {
    $scope.$emit("LOAD");
    var getScheduleDetailed = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.schedule = response.data;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          $scope.$emit("UNLOAD");
        });
    };
    getScheduleDetailed("schedule/" + $routeParams.id);
  },
]);

app.controller("presentationController", [
  "$scope",
  "dataService",
  function ($scope, dataService) {
    $scope.$emit("LOAD");
    var getPresentation = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.presentations = response.data;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          $scope.$emit("UNLOAD");
        });
    };
    getPresentation("presentations/");

    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };
  },
]);

app.controller("presentationDetailedController", [
  "$scope",
  "dataService",
  "$routeParams",
  function ($scope, dataService, $routeParams) {
    $scope.$emit("LOAD");
    var getScheduleDetailed = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.presentations = response.data;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          $scope.$emit("UNLOAD");
        });
    };
    getScheduleDetailed("presentations/" + $routeParams.id);

    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };
  },
]);

app.controller("presentationSearchController", [
  "$scope",
  "dataService",
  "$routeParams",
  function ($scope, dataService, $routeParams) {
    $scope.$emit("LOAD");
    var getPresentationSearch = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.search = response.data;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          if ($scope.search.length > 0) {
            $scope.$emit("UNLOAD");
          } else {
            $scope.$emit("SearchNoReturn");
          }
        });
    };
    getPresentationSearch("presentations/search/" + $routeParams.term);

    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };
  },
]);
