app.component("navigation", {
  templateUrl: "views/template/navigation.tpl.html",
  controller: function navController($scope, $cookies, dataService) {
      $scope.login = false;
    if ($cookies.get("loggedIn") == 1) {
      $scope.login = true;
    }
    $scope.logout = function () {
      $scope.login = false;
      $request = "logout";
      dataService
      .getApiRequest($request)
      .then(
        function (response) {
          $scope.loggedOutStatus = response.result.data.result;
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
  },
});
