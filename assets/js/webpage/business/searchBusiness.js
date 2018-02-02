app.controller('searchBusinessController', function ($scope, $http) {
    $scope.searchSubmit = function () {
        var business = $scope.sb.business.toLowerCase().replace(' ', '+');
        var location = $scope.sb.location.toLowerCase().replace(' ', '+');
        if (business == '' || location == '') {
            return false;
        }
        window.location = base_url + 'business-profile/search?q=' + business + '&l=' + location;
    }
});