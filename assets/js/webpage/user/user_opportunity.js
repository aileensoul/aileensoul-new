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

    getFieldList();
    function getFieldList() {
        $http.get(base_url + "general_data/getFieldList").then(function (success) {
            $scope.fieldList = success.data;
        }, function (error) {});
    }
    getContactSuggetion();
    function getContactSuggetion() {
        $http.get(base_url + "user_opportunities/getContactSuggetion").then(function (success) {
            $scope.contactSuggetion = success.data;
        }, function (error) {});
    }
    $scope.job_title = [];
    $scope.loadJobTitle = function ($query) {
        return $http.get(base_url + 'user_opportunities/get_jobtitle', {cache: true}).then(function (response) {
            var job_title = response.data;
            return job_title.filter(function (title) {
                return title.name.toLowerCase().indexOf($query.toLowerCase()) != -1;
            });
        });
    };
    $scope.location = [];
    $scope.loadLocation = function ($query) {
        return $http.get(base_url + 'user_opportunities/get_location', {cache: true}).then(function (response) {
            var location_data = response.data;
            return location_data.filter(function (location) {
                return location.city_name.toLowerCase().indexOf($query.toLowerCase()) != -1;
            });
        });
    };

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
    $scope.post_opportunity_check = function (event) {

        var fileInput = document.getElementById("fileInput").files;
        var description = document.getElementById("description").value;
        var description = description.trim();
        var job_title = $scope.job_title;
        var location = $scope.location;
        var fileInput = document.getElementById("fileInput").value;
        if ((fileInput == '') && (description == '' || job_title.length == '0' || location.length == '0'))
        {
            $('#post .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
            $('#post').modal('show');
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    $('#posterrormodal').modal('hide');
                    $('.modal-post').show();
                }
            });
            event.preventDefault();
            return false;
        } else {
            for (var i = 0; i < fileInput.length; i++)
            {
                var vname = fileInput[i].name;
                var vfirstname = fileInput[0].name;
                var ext = vfirstname.split('.').pop();
                var ext1 = vname.split('.').pop();
                var allowedExtensions = ['jpg', 'JPG', 'jpeg', 'JPEG', 'PNG', 'png', 'gif', 'GIF', 'psd', 'PSD', 'bmp', 'BMP', 'tiff', 'TIFF', 'iff', 'IFF', 'xbm', 'XBM', 'webp', 'WebP', 'HEIF', 'heif', 'BAT', 'bat', 'BPG', 'bpg', 'SVG', 'svg'];
                var allowesvideo = ['mp4', 'webm', 'mov', 'MP4'];
                var allowesaudio = ['mp3'];
                var allowespdf = ['pdf'];

                var foundPresent = $.inArray(ext, allowedExtensions) > -1;
                var foundPresentvideo = $.inArray(ext, allowesvideo) > -1;
                var foundPresentaudio = $.inArray(ext, allowesaudio) > -1;
                var foundPresentpdf = $.inArray(ext, allowespdf) > -1;

                if (foundPresent == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;
                    if (foundPresent1 == true && fileInput.length <= 10) {
                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#posterrormodal').modal('show');
                        setInterval('window.location.reload()', 10000);
                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                $('#posterrormodal').modal('hide');
                                $('.modal-post').show();
                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentvideo == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowesvideo) > -1;
                    if (foundPresent1 == true && fileInput.length == 1) {
                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#posterrormodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                $('#posterrormodal').modal('hide');
                                $('.modal-post').show();
                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentaudio == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowesaudio) > -1;
                    if (foundPresent1 == true && fileInput.length == 1) {

                        if (product_name == '') {
                            $('.biderror .mes').html("<div class='pop_content'>You have to add audio title.");
                            $('#posterrormodal').modal('show');
                            //setInterval('window.location.reload()', 10000);

                            $(document).on('keydown', function (e) {
                                if (e.keyCode === 27) {
                                    //$( "#bidmodal" ).hide();
                                    $('#posterrormodal').modal('hide');
                                    $('.modal-post').show();
                                }
                            });
                            event.preventDefault();
                            return false;
                        }

                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#posterrormodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                $('#posterrormodal').modal('hide');
                                $('.modal-post').show();
                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentpdf == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowespdf) > -1;
                    if (foundPresent1 == true && fileInput.length == 1) {

                        if (product_name == '') {
                            $('.biderror .mes').html("<div class='pop_content'>You have to add pdf title.");
                            $('#posterrormodal').modal('show');
                            setInterval('window.location.reload()', 10000);

                            $(document).on('keydown', function (e) {
                                if (e.keyCode === 27) {
                                    $('#posterrormodal').modal('hide');
                                    $('.modal-post').show();
                                }
                            });
                            event.preventDefault();
                            return false;
                        }
                    } else {
                        if (fileInput.length > 10) {
                            $('.biderror .mes').html("<div class='pop_content'>You can not upload more than 10 files at a time.");
                        } else {
                            $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        }
                        $('#posterrormodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                $('#posterrormodal').modal('hide');
                                $('.modal-post').show();

                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentvideo == false) {

                    $('.biderror .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files..");
                    $('#posterrormodal').modal('show');
                    setInterval('window.location.reload()', 10000);

                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            $('#posterrormodal').modal('hide');
                            $('.modal-post').show();

                        }
                    });
                    event.preventDefault();
                    return false;
                }
            }
            
        }
    }
    // POST UPLOAD START

    var bar = $('.progress-bar');
    var percent = $('.sr-only');
    var options = {
        data: {job_title: $scope.job_title, location: $scope.location},
        beforeSend: function () {
            $('body').removeClass('modal-open');
            document.getElementById("progress_div").style.display = "block";
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
            $("#opportunity-popup").modal('hide');
        },
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
            $('.btn1').prop('onclick', null).off('click');
        },
        success: function () {
        },
        complete: function (response) {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
            document.getElementById('description').value = '';
            document.getElementById('job_title').value = '';
            document.getElementById('location').value = '';
            document.getElementById('field').value = '';
            document.getElementById('fileInput').value = '';
            $("input[name='text_num']").val(50);
            $(".file-preview-frame").hide();
            document.getElementById("progress_div").style.display = "none";
            $(".all-post-box").prepend(response.responseText);
            $('video, audio').mediaelementplayer();
            var nb = $('.post-design-box').length;
            if (nb == 0) {
                $("#dropdownclass").addClass("no-post-h2");
            } else {
                document.getElementById("art_no_post_avl").style.display = "none";
                $("#dropdownclass").removeClass("no-post-h2");
            }
//            $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top - 100}, 150);
//            check_no_post_data();
        }
    };
    $("#post_opportunity").ajaxForm(options);
    // POST UPLOAD END 

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

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});