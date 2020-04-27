app.controller("scheduleController", [
  "$scope",
  "$http",
  "slotService",
  function ($scope, $http, slotService) {
    $http.get("http://localhost:8066/api/schedule/").then(function (response) {
      $scope.schedule = response.data;
    });
    $scope.addSlotsID = function ($slot, $day) {
      $scope.slotsID = $slot;
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
    console.log($scope.slotIDs);
    if (!$scope.slotIDs) {
      console.log("Please select a timeslot on the landing page");
    } else {
      $http
        .get("http://localhost:8066/api/schedule/" + $scope.slotIDs)
        .then(function (response) {
          $scope.schedule = response.data;
        });
    }
  },
]);
