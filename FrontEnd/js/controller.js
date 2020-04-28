app.controller("appController", [
  "$scope",
  function ($scope) {
    $scope.$on("LOAD", function () {
      $scope.loading = true;
    });
    $scope.$on("UNLOAD", function () {
      $scope.loading = false;
    });
  },
]);

app.controller("scheduleController", [
  "$scope",
  "$http",
  "slotService",
  function ($scope, $http, slotService) {
    $scope.$emit("LOAD");
    $http
      .get("http://localhost:8066/api/schedule/")
      .then(function (response) {
        $scope.schedule = response.data;
      })
      .finally(function () {
        $scope.$emit("UNLOAD");
      });
    $scope.addSlotsID = function (slot) {
      $scope.slotsID = slot;
      slotService.set($scope.slotsID);
    };
  },
]);

app.controller("scheduleDetailedController", [
  "$scope",
  "$http",
  "slotService",
  function ($scope, $http, slotService) {
    $scope.slotIDs = slotService.get();
    $scope.$emit("LOAD");
    if (!$scope.slotIDs) {
      console.log("Please select a timeslot on the landing page");
    } else {
      $http
        .get("http://localhost:8066/api/schedule/" + $scope.slotIDs)
        .then(function (response) {
          $scope.schedule = response.data;
        })
        .finally(function () {
          $scope.$emit("UNLOAD");
        });
    }
  },
]);

app.controller("presentationController", [
  "$scope",
  "$http",
  function ($scope, $http, ) {
    $scope.$emit("LOAD");
    $http
      .get("http://localhost:8066/api/presentations/")
      .then(function (response) {
        $scope.presentations = response.data;
      })
      .finally(function () {
        $scope.$emit("UNLOAD");
      });
  }
]);

app.controller("presentationSearchController",["$scope","$http","$routeParams", function ($scope, $http, $routeParams) {
  $scope.$emit("LOAD");
    $http
      .get("http://localhost:8066/api/presentations/search/" + $routeParams.term)
      .then(function (response) {
        $scope.search = response.data;
      })
      .finally(function () {
        $scope.$emit("UNLOAD");
      });
}]);
