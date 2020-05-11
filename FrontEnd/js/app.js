/**
 * Start a new application (module)
 */
var app = angular.module("WAI", ["angular.filter", "ngRoute", "ngAnimate", "ngCookies", "angularUtils.directives.dirPagination"]);

app.config([
  "$routeProvider",
  "paginationTemplateProvider",
  "$locationProvider",
  function ($routeProvider, paginationTemplateProvider, $locationProvider) {
    /**
     * html5 mode, Allows the angularJS to use 'clean' urls, no # in url.
     */
    $locationProvider.html5Mode(true);
    /**
     * Defines the routes of the application.
     */
    $routeProvider
      .when("/", {
        templateUrl: "views/partials/home.html",
        controller: "homeController",
      })
      .when("/schedule", {
        templateUrl: "views/partials/schedule.html",
        controller: "scheduleController",
      })
      .when("/login", {
        templateUrl: "views/partials/login.html",
        controller: "loginController",
      })
      .when("/schedule/:id", {
        templateUrl: "views/partials/scheduleDetailed.html",
        controller: "scheduleDetailedController",
      })
      .when("/presentation", {
        templateUrl: "views/partials/presentation.html",
        controller: "presentationController",
      })
      .when("/presentation/:id", {
        templateUrl: "views/partials/presentationSearch.html",
        controller: "presentationDetailedController",
      })
      .when("/presentation/category/:cat", {
        templateUrl: "views/partials/presentation.html",
        controller: "presentationCategoryController",
      })
      .when("/presentation/search/:term", {
        templateUrl: "views/partials/presentationSearch.html",
        controller: "presentationSearchController",
      })
      .when("/presentation/search/:term/category/:cat", {
        templateUrl: "views/partials/presentationSearch.html",
        controller: "presentationSearchCategoryController",
      })
      .when("/about", {
        templateUrl: "views/partials/about.html",
      })
      .otherwise({
        redirectTo: "/",
      });
      paginationTemplateProvider.setPath('./views/template/dirPagination.tpl.html');
  },
]);
