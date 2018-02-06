app.controller('jobController', function ($scope, $http) {
    $scope.title = title;
    $scope.jobCategory = {};
    $scope.jobCity = {};

    function jobCategory() {
        $http.get(base_url + "job_live/jobCategory?limit=24").then(function (success) {
            $scope.jobCategory = success.data;
        }, function (error) {});
    }
    jobCategory();

    function jobCity() {
        $http.get(base_url + "job_live/jobCity?limit=24").then(function (success) {
            $scope.jobCity = success.data;
        }, function (error) {});
    }
    jobCity();
    function jobCompany() {
        $http.get(base_url + "job_live/jobCompany?limit=24").then(function (success) {
            $scope.jobCompany = success.data;
        }, function (error) {});
    }
    jobCompany();
    function otherCategoryCount() {
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