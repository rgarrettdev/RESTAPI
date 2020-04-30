app.component("search", {
  templateUrl: "views/template/search.tpl.html",
  controller: function searchController($scope) {
    $scope.master = "";
    $scope.reset = function () {
      $scope.search = angular.copy($scope.master);
      $scope.category = angular.copy($scope.master);
    };
    $scope.dropDownSearchFilter = {
      option: "paper",
      options: [
        "miscellaneous",
        "keynote",
        "break",
        "paper",
        "course",
        "altchi",
        "SIG",
        "casestudy",
        "Competition",
        "Awards",
        "panel",
        "interactivity",
        "DC",
        "SDC",
        "lbw",
        "videoshowcase",
      ],
    };
    $scope.reset();
  },
});
