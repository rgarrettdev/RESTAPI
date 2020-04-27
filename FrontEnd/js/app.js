/**
 * Start a new application (module)
 */
var app = angular.module("WAI", ["angular.filter", "ngRoute", "ngAnimate"]);

app.config([
  "$routeProvider",
  function ($routeProvider) {
    /**
     *
     * Route Info
     *
     */
    $routeProvider
      .when("/", {
        templateUrl: "views/schedule.html",
        controller: "scheduleController",
      })
      .when("/schedule", {
        templateUrl: "views/scheduleDetailed.html",
        controller: "scheduleDetailedController",
      })
      .when("/presentation", {
        templateUrl: "views/presentation.html",
      })
      .when("/about", {
        templateUrl: "views/about.html",
      })
      .otherwise({
        redirectTo: "/",
      });
  },
]);
