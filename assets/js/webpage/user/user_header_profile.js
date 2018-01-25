app.controller('headerCtrl', function ($scope, $http) {
    $scope.header_all_profile = function() {
        $('.all .dropdown-menu').html(header_all_profile);
    }
    
    $scope.header_contact_request = function() {
        $http({
            method: 'POST',
            url: base_url + 'userprofile/contact_request',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (success) {
            details_data = success.data;
            $scope.details_data = details_data;
        });
    }
});
