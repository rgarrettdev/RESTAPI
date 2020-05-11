/**
 * appController, controls the alert bar
 * gives the user feedback on loading progress,
 * and to give the user feedback on search functionality.
 */
app.controller("appController", [
  "$scope",
  "$window",
  "$location",
  function ($scope, $window, $location) {
    $scope.$on("LOAD", function () {
      $scope.infoBar = true;
      $scope.status = "Loading";
    });
    $scope.$on("UNLOAD", function () {
      $scope.infoBar = false;
    });
    $scope.$on("SearchNoReturn", function () {
      $scope.status = "No results found";
    });
    $scope.$on("Login", function () {
      $window.location.reload();
    });
    $scope.isActive = function () {
      $scope.showNavFoot = $location.path() === "/login";
      return $scope.showNavFoot;
    };
  },
]);

app.controller("homeController", [
  "$scope",
  function ($scope) {
    $scope.$emit("UNLOAD");
  },
]);

app.controller("aboutController", [
  "$scope",
  function ($scope) {
    $scope.$emit("UNLOAD");
  },
]);
/**
 * scheduleController runs getSchedule function which returns
 * the schedule for the conference.
 * alerts are controlled by the controller via $emit
 */
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
/**
 * scheduleDetailedController runs getScheduleDetailed function which returns
 * the schedule for a given day. The controller controls when the editor is
 * visible through $broadcast and the placeholder information is set and reset through
 * the dataTransfer service. When the user changes pages through pagination it
 * will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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

    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };

    $scope.editor = function (schedule) {
      dataTransfer.resetSchedule();
      dataTransfer.setSchedule(schedule);
      $scope.$broadcast("showEditor");
      $scope.editorVisible = true;
      var element = document.getElementById("editor");
      element.scrollIntoView({
        behavior: "smooth",
        block: "end",
        inline: "nearest",
      });
    };

    $scope.$on("unshowEditor", function () {
      $scope.editorVisible = false;
    });
    /**
     * Only shows the button that triggers the editor visiblity when an admin
     * is logged in.
     */
    $scope.adminLogin = false;
    if ($cookies.get("isAdmin") == 1) {
      $scope.adminLogin = true;
    }
  },
]);
/**
 * presentationController runs getPresentation function which returns
 * all the presentations. When the user changes pages through pagination it
 * will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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
/**
 * presentationDetailedController runs getScheduleDetailed function which returns
 * the presentation depending on the schedule. When the user changes pages through pagination
 * it will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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
/**
 * presentationCategoryController runs getPresentationCategory function which returns
 * all the presentations in a given category.
 * When the user changes pages through pagination
 * it will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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
/**
 * presentationSearchController runs getPresentationSearch
 * function which returns all the presentations with a given search term.
 *
 * When the user changes pages through pagination
 * it will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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
/**
 * presentationSearchCategoryController runs getPresentationSearchCategory
 * function which returns all the presentations with a given search term and
 * a given category.
 *
 * When the user changes pages through pagination
 * it will the resPost function run, scrolling the user to the top of the page.
 *
 * alerts are controlled by the controller via $emit
 */
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
      "presentations/advanced/" + $routeParams.term + "/" + $routeParams.cat
    );
    $scope.resetPos = function () {
      window.scrollTo(0, 0);
    };
  },
]);
/**
 * loginController, when the user submits the login form
 * the post request is sent. On success the page is refreshed and then the user
 * is sent to the index page.
 *
 * alerts are controlled by the controller through loginAlert, on a failed login
 * attempt the login failed status is alerted to the user.
 */
app.controller("loginController", [
  "$scope",
  "dataService",
  "$location",
  "$cookies",
  "$window",
  function ($scope, dataService, $location, $cookies, $window) {
    $scope.$emit("UNLOAD");
    $scope.loginUser = function () {
      $scope.loginAlert = false;
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
            $window.location = $location.path("/"); //On a sucessful login, redirect to index.
          } else {
            $scope.loginAlert = true;
            $scope.status = "Login Failed: Incorrect Email/Password.";
          }
        });
    };
  },
]);
