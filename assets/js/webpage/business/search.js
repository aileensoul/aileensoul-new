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
    function searchBusiness(){
        $http.get(base_url + "business/searchBusinessData/" + business + "/" + location).then(function (success) {
            $scope.searchBusiness = success.data;
        }, function (error) {});
    }
    searchBusiness();
    
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});