/**
 * appController, controls the alert bar
 * gives the user feedback on loading progress,
 * and to give the user feedback on search functionality.
 */
app.controller("appController", [
  "$scope",
  "$window",
  function ($scope, $window) {
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
    $scope.$on("Login", function () {
      $window.location.reload();
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
            $scope.schedule = response.result.data.result;
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
  "$cookies",
  "dataTransfer",
  function ($scope, dataService, $routeParams, $cookies, dataTransfer) {
    $scope.$emit("LOAD");
    var getScheduleDetailed = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.schedule = response.result.data.result;
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

    $scope.editor = function (schedule) {
      dataTransfer.resetSchedule();
      console.log(schedule);
      dataTransfer.setSchedule(schedule);
      $scope.$broadcast("showEditor");
      $scope.editorVisible = true;

    };

    $scope.$on("unshowEditor", function () {
      console.log(true);
      $scope.editorVisible = false;
    })

    $scope.adminLogin = false;
    if ($cookies.get("isAdmin") == 1) {
      $scope.adminLogin = true;
    }
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
            $scope.presentations = response.result.data.result;
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
            $scope.search = response.result.data.result;
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

app.controller("presentationCategoryController", [
  "$scope",
  "dataService",
  "$routeParams",
  function ($scope, dataService, $routeParams) {
    $scope.$emit("LOAD");
    var getPresentationCategory = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.presentations = response.result.data.result;
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          if ($scope.presentations.length > 0) {
            $scope.$emit("UNLOAD");
          } else {
            $scope.$emit("SearchNoReturn");
          }
        });
    };
    getPresentationCategory("presentations/category/" + $routeParams.cat);

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
            $scope.search = response.result.data.result;
            console.log($scope.search);
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

app.controller("presentationSearchCategoryController", [
  "$scope",
  "dataService",
  "$routeParams",
  function ($scope, dataService, $routeParams) {
    $scope.$emit("LOAD");
    var getPresentationSearchCategory = function (request) {
      dataService
        .getApiRequest(request)
        .then(
          function (response) {
            $scope.search = response.result.data.result;
            console.log($scope.search);
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

    getPresentationSearchCategory(
      "presentations/search/" + $routeParams.term + "/" + $routeParams.cat
    );
    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };
  },
]);

app.controller("loginController", [
  "$scope",
  "dataService",
  "$location",
  "$cookies",
  function ($scope, dataService, $location, $cookies) {
    $scope.loginUser = function () {
      dataService
        .postApiRequest($scope.user)
        .then(
          function (response) {
            console.log(response);
          },
          function (err) {
            $scope.status = "Unable to load data " + err;
          },
          function (notify) {
            console.log(notify);
          }
        )
        .finally(function () {
          if ($cookies.get("loggedIn") == 1) {
            $scope.$emit("Login");
            window.location = $location.path("/"); //On a sucessful login, redirect to index.
          } else {
            console.log("Invalid");
          }
        });
    };
  },
]);
