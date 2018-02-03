app.controller('businessListController', function ($scope, $http) {
    $scope.businessCategory = {};
    function businessCategory(){
        $http.get(base_url + "business/businessCategory?limit=24").then(function (success) {
            $scope.businessCategory = success.data;
        }, function (error) {});
    }
    businessCategory();
    function otherCategoryCount(){
        $http.get(base_url + "business/otherCategoryCount").then(function (success) {
            $scope.otherCategoryCount = success.data;
        }, function (error) {});
    }
    otherCategoryCount();
    function categoryBusinessList(){
        $http.get(base_url + "business/businessListByCategory/" + category_id).then(function (success) {
            $scope.businessList = success.data;
        }, function (error) {});
    }
    categoryBusinessList();
    
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});