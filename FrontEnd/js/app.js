/**
 * Start a new application (module)
 */
var app = angular.module("WAI", ["angular.filter", "ngRoute", "ngAnimate", "ngCookies", "angularUtils.directives.dirPagination"]);

app.config([
  "$routeProvider",
  "paginationTemplateProvider",
  "$locationProvider",
  function ($routeProvider, paginationTemplateProvider, $locationProvider) {

    $locationProvider.html5Mode(true);
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
      .when("/schedule/:id", {
        templateUrl: "views/scheduleDetailed.html",
        controller: "scheduleDetailedController",
      })
      .when("/presentation", {
        templateUrl: "views/presentation.html",
        controller: "presentationController",
      })
      .when("/presentation/:id", {
        templateUrl: "views/presentationDetailed.html",
        controller: "presentationDetailedController",
      })
      .when("/presentation/category/", {
        templateUrl: "views/presentationCategory.html",
        controller: "presentationCategoryController",
      })
      .when("/presentation/search/:term", {
        templateUrl: "views/presentationSearch.html",
        controller: "presentationSearchController",
      })
      .when("/presentation/search/:srch/category/:cat", {
        templateUrl: "views/presentationSearchCategory.html",
        controller: "presentationSearchCategoryController",
      })
      .when("/about", {
        templateUrl: "views/about.html",
      })
      .otherwise({
        redirectTo: "/",
      });
      paginationTemplateProvider.setPath('./views/template/dirPagination.tpl.html');
  },
]);
