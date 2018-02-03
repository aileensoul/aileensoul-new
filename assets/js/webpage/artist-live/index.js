app.controller('artistController', function ($scope, $http) {
    $scope.artistCategory = {};
    
    function artistCategory(){
        $http.get(base_url + "artistic/artistCategory?limit=9").then(function (success) {
            $scope.artistCategory = success.data;
        }, function (error) {});
    }
    artistCategory();
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