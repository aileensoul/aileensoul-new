app.filter('wordFirstCase', function () {
    return function (text) {
        return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});
app.directive("owlCarousel", function () {
    return {
        restrict: 'E',
        link: function (scope) {
            scope.initCarousel = function (element) {
                // provide any default options you want
                var defaultOptions = {
                    loop: true,
                    nav: true,
                    lazyLoad: true,
                    margin: 0,
                    video: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 2
                        },
                        960: {
                            items: 2,
                        },
                        1200: {
                            items: 2
                        }
                    }
                };
                var customOptions = scope.$eval($(element).attr('data-options'));
                // combine the two options objects
                for (var key in customOptions) {
                    defaultOptions[key] = customOptions[key];
                }
                // init carousel
                $(element).owlCarousel(defaultOptions);
            };
        }
    };
});
app.directive('owlCarouselItem', [function () {
        return {
            restrict: 'A',
            link: function (scope, element) {
                // wait for the last item in the ng-repeat then call init
                if (scope.$last) {
                    scope.initCarousel(element.parent());
                }
            }
        };
    }]);
app.controller('userOppoController', function ($scope, $http) {
    getContactSuggetion();
    function getContactSuggetion() {
        $http.get(base_url + "user_opportunities/getContactSuggetion").then(function (success) {
            $scope.contactSuggetion = success.data;
        }, function (error) {});
    }

    $scope.addToContact = function (user_id, contact) {
        $http({
            method: 'POST',
            url: base_url + 'user_opportunities/addToContact',
            data: 'user_id=' + user_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (success) {
            if (success.data.message == 1) {
                var index = $scope.contactSuggetion.indexOf(contact);
                $('#item-' + user_id).remove();
                $('.owl-carousel').trigger('next.owl.carousel');
            }
        });
    }
});


$('#postfiles').on('click', function () {
    var a = document.getElementById('description').value;
    var b = document.getElementById('job_title').value;
    var c = document.getElementById('location').value;
    var d = document.getElementById('field').value;
    document.getElementById("post_opportunity").reset();
    document.getElementById('description').value = a;
    document.getElementById('job_title').value = b;
    document.getElementById('location').value = c;
    document.getElementById('field').value = d;
});
$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});