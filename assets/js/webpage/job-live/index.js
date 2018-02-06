app.controller('jobController', function ($scope, $http) {
    $scope.title = title;
    $scope.jobCategory = {};
    
    function jobCategory(){
        $http.get(base_url + "job_live/jobCategory?limit=24").then(function (success) {
            $scope.jobCategory = success.data;
        }, function (error) {});
    }
    jobCategory();
    function otherCategoryCount(){
        $http.get(base_url + "job_live/otherCategoryCount").then(function (success) {
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