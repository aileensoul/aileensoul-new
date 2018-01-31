app.controller('questionDetailsController', function ($scope, $http) {
    questionData();
    function questionData() {
                $('#loader').show();
                $http.get(base_url + "userprofile_page/question_data/?question=" + question).then(function (success) {
                    $('#loader').hide();
                    $scope.questionData = success.data;
                }, function (error) {});
            }
});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});