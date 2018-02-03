app.controller('artistCategoryController', function ($scope, $http) {
    $scope.artistAllCategory = {};
    function artistAllCategory(){
        $http.get(base_url + "artistic/artistAllCategory").then(function (success) {
            $scope.artistAllCategory = success.data;
        }, function (error) {});
    }
    artistAllCategory();
    function otherCategoryCount(){
        $http.get(base_url + "artistic/otherCategoryCount").then(function (success) {
            $scope.otherCategoryCount = success.data;
        }, function (error) {});
    }
    otherCategoryCount();
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});