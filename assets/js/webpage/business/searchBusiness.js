app.controller('searchBusinessController', function ($scope, $http) {
    $scope.searchSubmit = function () {
        var business = $scope.sb.business.toLowerCase();
        var location = $scope.sb.location.toLowerCase();
        if (business == '' || location == '') {
            return false;
        }
        window.location.href = business + '-business-in-' + location.toLowerCase();
    }
});