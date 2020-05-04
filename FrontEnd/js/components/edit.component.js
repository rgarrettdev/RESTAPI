app.component("edit", {
    templateUrl: "views/template/edit.tpl.html",
    controller: function filterController($scope, dataTransfer, dataService, $window) {

      $scope.$on("showEditor", function () {
        var schedule = dataTransfer.getSchedule();
        $scope.schedule = schedule[0];
        
        $scope.chair = schedule[0]["chair"];
        console.log($scope.chair);
      })
      $scope.abandonEdit = function () {
        $scope.$emit("unshowEditor");
        dataTransfer.resetSchedule();
      }
      $scope.saveEdit = function () {
        dataService
        .putApiRequest($scope)
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
          console.log("Updated");
          $window.location.reload();
        });
        };
      },
  });
  