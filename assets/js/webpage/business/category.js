app.controller('businessCategoryController', function ($scope, $http) {
    $scope.businessAllCategory = {};
    
    function businessAllCategory(){
        $http.get(base_url + "business/businessAllCategory").then(function (success) {
            $scope.businessAllCategory = success.data;
        }, function (error) {});
    }
    businessAllCategory();
    function otherCategoryCount(){
        $http.get(base_url + "business/otherCategoryCount").then(function (success) {
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