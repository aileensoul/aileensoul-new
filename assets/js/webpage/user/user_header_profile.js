app.controller('headerCtrl', function ($scope, $http) {
    $scope.header_all_profile = function() {
        alert(header_all_profile);
        $('.dropdown-menu').html(header_all_profile);
    }
});
