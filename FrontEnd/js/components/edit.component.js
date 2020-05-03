app.component("edit", {
    templateUrl: "views/template/edit.tpl.html",
    controller: function filterController($scope, dataTransfer) {

      $scope.$on("showEditor", function () {
        var schedule = dataTransfer.getSchedule();
        $scope.schedule = schedule[0];
        
        $scope.chair = schedule[0]["chair"];
        console.log($scope.chair);
        dataTransfer.resetSchedule();
      })

      $scope.abandonEdit
    },
  });
  