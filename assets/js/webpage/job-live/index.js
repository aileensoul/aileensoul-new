app.controller('jobController', function ($scope, $http) {
    $scope.title = title;
    $scope.jobCategory = {};
    $scope.jobCity = {};
    $scope.jobCompany = {};
    $scope.jobSkill = {};
    $scope.latestJob = {};

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
    function jobSkill() {
        $http.get(base_url + "job_live/jobSkill?limit=24").then(function (success) {
            $scope.jobSkill = success.data;
        }, function (error) {});
    }
    jobSkill();
    function latestJob() {
        $http({
            method: 'POST',
            url: base_url + 'job_live/latestJob',
            data: '',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    $scope.latestJob = success.data;
                });
    }
    latestJob();
    
    $scope.applyJobFilter = function(){
        alert(12123132);
    }
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});