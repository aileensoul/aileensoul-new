app.controller('freeapplypostController', function ($scope, $http) {
//    $scope.title = title;
    $scope.freelancerapplypost = {};
    freelancerapplypost();
    function freelancerapplypost(){
        $http.get(base_url + "freelancer_apply_live/freelancer_apply_live_post").then(function (success) {
            $scope.freepostapply = success.data;
        }, function (error) {});
    }
   
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});