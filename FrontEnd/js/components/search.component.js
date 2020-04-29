app.component('search', {
    templateUrl: "views/template/search.tpl.html",
    controller: function searchController($scope) {
        $scope.master="";
        $scope.reset = function() {
            $scope.search = angular.copy($scope.master);
        }
        $scope.reset();
    }
})