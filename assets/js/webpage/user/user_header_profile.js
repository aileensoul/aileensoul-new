app.controller('headerCtrl', function ($scope, $http) {
    $scope.header_all_profile = function() {
        $('.dropdown-menu').html(header_all_profile);
    }
});
