app.controller('headerCtrl', function ($scope, $http) {
    $scope.header_all_profile = function() {
        $('.all .dropdown-menu').html(header_all_profile);
    }
    
    $scope.header_contact_request = function() {
        alert(12313);
    }
});
