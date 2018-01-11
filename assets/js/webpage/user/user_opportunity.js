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
app.directive('fileInput', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            $(element).fileinput({
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'JPG', 'jpeg', 'JPEG', 'PNG', 'png', 'gif', 'GIF', 'psd', 'PSD', 'bmp', 'BMP', 'tiff', 'TIFF', 'iff', 'IFF', 'xbm', 'XBM', 'webp', 'WebP', 'HEIF', 'heif', 'BAT', 'bat', 'BPG', 'bpg', 'SVG', 'svg', 'mp4', 'mp3', 'pdf'],
                overwriteInitial: false,
                maxFileSize: 1000000,
                maxFilesNum: 10,
                //allowedFileTypes: ['image','video', 'flash'],
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                }
            });
        }
    };
});
app.controller('userOppoController', function ($scope, $http) {
    getContactSuggetion();
    function getContactSuggetion() {
        $http.get(base_url + "user_opportunities/getContactSuggetion").then(function (success) {
            $scope.contactSuggetion = success.data;
        }, function (error) {});
    }
    $scope.postFiles = function () {
        var a = document.getElementById('description').value;
        var b = document.getElementById('job_title').value;
        var c = document.getElementById('location').value;
        var d = document.getElementById('field').value;
        document.getElementById("post_opportunity").reset();
        document.getElementById('description').value = a;
        document.getElementById('job_title').value = b;
        document.getElementById('location').value = c;
        document.getElementById('field').value = d;
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

// POST UPLOAD START
$(document).ready(function () {
    var bar = $('.progress-bar');
    var percent = $('.sr-only');
    var options = {
        beforeSend: function () {
            $('body').removeClass('modal-open');
            document.getElementById("progress_div").style.display = "block";
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
            document.getElementById("myModal").style.display = "none";
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
            $('#myBtn').prop('onclick', null).off('click');
        },
        success: function () {
        },
        complete: function (response) {
            $("#myBtn").on("click", modelopen);
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
            $('.art_no_post_avl').hide();
            document.getElementById('test-upload-product').value = '';
            document.getElementById('test-upload-des').value = '';
            document.getElementById('file-1').value = '';
            $("input[name='text_num']").val(50);
            $(".file-preview-frame").hide();
            document.getElementById("progress_div").style.display = "none";
            $(".business-all-post").prepend(response.responseText);
            $('video, audio').mediaelementplayer();
            var nb = $('.post-design-box').length;
            if (nb == 0) {
                $("#dropdownclass").addClass("no-post-h2");
            } else {
                document.getElementById("art_no_post_avl").style.display = "none";
                $("#dropdownclass").removeClass("no-post-h2");
            }
            $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top - 100}, 150);
            check_no_post_data();
        }
    };
    $("#post_opportunity").ajaxForm(options);
});
// POST UPLOAD END




$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});