app.controller('searchController', function ($scope, $http) {
    searchData();
    function searchData() {
        $http({
            method: 'POST',
            url: base_url + 'user_post/searchData',
            data: 'searchKeyword=' + searchKeyword,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (success) {
            $scope.searchProfileData = success.data.profile;
            $scope.searchPostData = success.data.post;
        });
    }
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});