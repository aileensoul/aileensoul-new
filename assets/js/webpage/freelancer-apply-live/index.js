
app.controller('freeapplypostController', function ($scope, $http) {
//    $scope.title = title;
    $scope.freelancerapplypost = {};
    
    function freelancerapplypost(){
        alert("hi");
        $http.get(base_url + "freelancer_apply_live/freelancer_apply_live_post?limit=9").then(function (success) {
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