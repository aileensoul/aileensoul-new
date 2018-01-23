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
app.directive('fileInput', function ($parse) {
    return {
        restrict: 'A',
        link: function ($scope, element, attrs) {
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
            element.on("change", function (event) {
                var files = event.target.files;
                $parse(attrs.fileInput).assign($scope, element[0].files);
                $scope.$apply();
            });
        }
    };
});

// AUTO SCROLL MESSAGE DIV FIRST TIME END
app.directive('ngEnter', function () {			// custom directive for sending message on enter click
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13 && !event.shiftKey) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});
app.directive("editableText", function () {
    return {
        controller: 'EditorController',
        restrict: 'C',
        replace: true,
        transclude: true,
    };
});
app.controller('EditorController', ['$scope', function ($scope) {
        $scope.handlePaste = function (e) {
            e.preventDefault();
            e.stopPropagation();
            var value = e.originalEvent.clipboardData.getData("Text");
            document.execCommand('inserttext', false, value);
        };
    }]);

app.directive('scrollableContainer', function ($window, $document, $http) {
    return {
        link: function ($scope, element, attrs) {
            $(window).on('scroll', function () {
//                if ($(window).scrollTop() >= ($(document).height() - $(window).height()) * 0.7) {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                    //var post_index = $(".post_index:last").val();
                    var page = $(".page_number:last").val();
                    var total_record = $(".total_record").val();
                    var perpage_record = $(".perpage_record").val();
                    if (parseInt(perpage_record * page) <= parseInt(total_record)) {
                        var available_page = total_record / perpage_record;
                        available_page = parseInt(available_page, 10);
                        var mod_page = total_record % perpage_record;
                        if (mod_page > 0) {
                            available_page = available_page + 1;
                        }
                        //if ($(".page_number:last").val() <= $(".total_record").val()) {
                        if (parseInt(page) <= parseInt(available_page)) {
                            var pagenum = parseInt($(".page_number:last").val()) + 1;
                            getUserPost(pagenum);
                        }
                    }
                }
            });
            function getUserPost(pagenum = '') {
                $('#loader').show();
                $http.get(base_url + "user_post/getUserPost?page=" + pagenum).then(function (success) {
                    $('#loader').hide();
                    for (var i in success.data) {
                        $scope.postData.push(success.data[i]);
                    }
                    $('video,audio').mediaelementplayer(/* Options */);
                }, function (error) {});
            }
        }
    };
});


app.controller('userOppoController', function ($scope, $http) {
    $scope.opp = {};
    $scope.sim = {};
    $scope.ask = {};
    $scope.postData = {};
    $scope.opp.post_for = 'opportunity';
    $scope.sim.post_for = 'simple';
    $scope.ask.post_for = 'question';
    getUserPost();
    function getUserPost(pagenum = '') {
        $('#loader').show();
        $http.get(base_url + "user_post/getUserPost?page=" + pagenum).then(function (success) {
            $('#loader').hide();
            $scope.postData = success.data;
            check_no_post_data();
            $('video,audio').mediaelementplayer(/* Options */);
        }, function (error) {});
    }

    getFieldList();
    function getFieldList() {
        $http.get(base_url + "general_data/getFieldList").then(function (success) {
            $scope.fieldList = success.data;
        }, function (error) {});
    }
    
    
    getContactSuggetion();
    function getContactSuggetion() {
        $http.get(base_url + "user_post/getContactSuggetion").then(function (success) {
            $scope.contactSuggetion = success.data;
        }, function (error) {});
    }
    $scope.job_title = [];
    $scope.loadJobTitle = function ($query) {
        return $http.get(base_url + 'user_post/get_jobtitle', {cache: true}).then(function (response) {
            var job_title = response.data;
            return job_title.filter(function (title) {
                return title.name.toLowerCase().indexOf($query.toLowerCase()) != -1;
            });
        });
    };
    $scope.location = [];
    $scope.loadLocation = function ($query) {
        return $http.get(base_url + 'user_post/get_location', {cache: true}).then(function (response) {
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
        var job_title = $scope.opp.job_title;
        var location = $scope.opp.location;
        var fileInput1 = document.getElementById("fileInput").value;
        if ((fileInput1 == '') && (description == '' || job_title.length == '0' || location.length == '0'))
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

                        /*if (product_name == '') {
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
                         } */

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

                        /*if (product_name == '') {
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
                         } */
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

            var form_data = new FormData();
            angular.forEach($scope.files, function (file) {
                form_data.append('postfiles[]', file);
            });
            form_data.append('description', $scope.opp.description);
            form_data.append('field', $scope.opp.field);
            form_data.append('job_title', JSON.stringify($scope.opp.job_title));
            form_data.append('location', JSON.stringify($scope.opp.location));
            form_data.append('post_for', $scope.opp.post_for);

            $('body').removeClass('modal-open');
            $("#opportunity-popup").modal('hide');


            $http.post(base_url + 'user_post/post_opportunity', form_data,
                    {
                        transformRequest: angular.identity,

                        headers: {'Content-Type': undefined, 'Process-Data': false}
                    })
                    .then(function (success) {
                        if (success) {
                            $scope.opp.description = '';
                            $scope.opp.job_title = '';
                            $scope.opp.location = '';
                            $scope.opp.field = '';
                            $scope.opp.postfiles = '';
                            document.getElementById('fileInput').value = '';
                            $scope.postData.splice(0, 0, success.data[0]);
                            $('video, audio').mediaelementplayer();
                        }
                    });
        }
    }
    
     $scope.IsVisible = false;
            $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisible = $scope.IsVisible ? false : true;
            }
    
    
    $scope.QuestionList = function () {
            $http({
            method: 'POST',
                    url: base_url + 'general_data/searchQuestionList',
                    data: 'q=' + $scope.ask.ask_que,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                    .then(function (success) {
                    data = success.data;
                    $scope.queSearchResult = data;
                    });
            }
        

    $scope.ask_question_check = function (event) {
        var field = document.getElementById("ask_field").value;
        var description = document.getElementById("ask_que").value;
        var description = description.trim();
        var fileInput = document.getElementById("screenshot").files;
        var fileInput1 = document.getElementById("screenshot").value;
        if ((field == '') || (description == ''))
        {
            $('#post .mes').html("<div class='pop_content'>Ask question and Field is required.");
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
            var length = fileInput.length;
            var vfirstname = fileInput[0].name;
            var ext = vfirstname.split('.').pop();
            var ext1 = vfirstname.split('.').pop();
            var allowedExtensions = ['jpg', 'JPG', 'jpeg', 'JPEG', 'PNG', 'png', 'gif', 'GIF', 'psd', 'PSD', 'bmp', 'BMP', 'tiff', 'TIFF', 'iff', 'IFF', 'xbm', 'XBM', 'webp', 'WebP', 'HEIF', 'heif', 'BAT', 'bat', 'BPG', 'bpg', 'SVG', 'svg'];
            var foundPresent = $.inArray(ext, allowedExtensions) > -1;
            if (foundPresent == true)
            {
                var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;

            }
            var form_data = new FormData();
            form_data.append('screenshot',$scope.ask.postfiles);
            form_data.append('question', $scope.ask.ask_que);
            form_data.append('description', $scope.ask.ask_description);
            form_data.append('field', $scope.ask.ask_field);
            form_data.append('other_field', $scope.ask.otherField);
            form_data.append('category', JSON.stringify($scope.ask.related_category));
            form_data.append('weblink', $scope.ask.web_link);
            form_data.append('post_for', $scope.ask.post_for);

            $('body').removeClass('modal-open');
            $("#opportunity-popup").modal('hide');
            $("#ask-question").modal('hide');
            $http.post(base_url + 'user_post/post_opportunity', form_data,
                    {
                        transformRequest: angular.identity,

                        headers: {'Content-Type': undefined, 'Process-Data': false}
                    })
                    .then(function (success) { 
                        if (success) {
                            $scope.opp.description = '';
                            $scope.opp.job_title = '';
                            $scope.opp.location = '';
                            $scope.opp.field = '';
                            $scope.opp.postfiles = '';
                            document.getElementById('fileInput').value = '';
                            $scope.postData.splice(0, 0, success.data[0]);
                            $('video, audio').mediaelementplayer();
                        }
                    });
        }
    }


    // POST SOMETHING UPLOAD START

    $scope.post_something_check = function (event) {

        var fileInput = document.getElementById("fileInput1").files;
        var description = document.getElementById("description").value;
        var description = description.trim();
        var fileInput1 = document.getElementById("fileInput1").value;
        if (fileInput1 == '' && description == '')
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

                        /*if (product_name == '') {
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
                         } */

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

                        /*if (product_name == '') {
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
                         } */
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

            var form_data = new FormData();
            angular.forEach($scope.files, function (file) {
                form_data.append('postfiles[]', file);
            });
            form_data.append('description', $scope.sim.description);
            form_data.append('post_for', $scope.sim.post_for);

            $('body').removeClass('modal-open');
            $("#post-popup").modal('hide');


            $http.post(base_url + 'user_post/post_opportunity', form_data,
                    {
                        transformRequest: angular.identity,
                        headers: {'Content-Type': undefined, 'Process-Data': false}
                    })
                    .then(function (success) {
                        if (success) {
                            $scope.sim.description = '';
                            $scope.sim.postfiles = '';
                            document.getElementById('fileInput1').value = '';
                            $scope.postData.splice(0, 0, success.data[0]);
                            $('video, audio').mediaelementplayer();
                        }
                    });
        }
    }

    $scope.loadMediaElement = function ()
    {
        $('video,audio').mediaelementplayer(/* Options */);
    };

    $scope.addToContact = function (user_id, contact) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/addToContact',
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

    $scope.post_like = function (post_id) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/likePost',
            data: 'post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (success) {
            if (success.data.message == 1) {
                if (success.data.is_newLike == 1) {
                    $('#post-like-' + post_id).addClass('like');
                    $('#post-like-count-' + post_id).html(success.data.likePost_count);
                    if (success.data.likePost_count == '0') {
                        $('#post-other-like-' + post_id).html('');
                    } else {
                        $('#post-other-like-' + post_id).html(success.data.post_like_data);
                    }
                } else if (success.data.is_oldLike == 1) {
                    $('#post-like-' + post_id).removeClass('like');
                    $('#post-like-count-' + post_id).html(success.data.likePost_count);
                    if (success.data.likePost_count == '0') {
                        $('#post-other-like-' + post_id).html('');
                    } else {
                        $('#post-other-like-' + post_id).html(success.data.post_like_data);
                    }
                }
            }
        });
    }

    $scope.sendComment = function (post_id, index, post) {
        var commentClassName = $('#comment-icon-' + post_id).attr('class').split(' ')[0];
        var comment = $('#commentTaxBox-' + post_id).html();
        //comment = comment.replace(/^(<br\s*\/?>)+/, '');
        comment = comment.replace(/&nbsp;/gi, " ");
        comment = comment.replace(/<br>$/, '');
        comment = comment.replace(/&gt;/gi, ">");
        comment = comment.replace(/&/g, "%26");
        if (comment) {
            $scope.isMsg = true;
            $http({
                method: 'POST',
                url: base_url + 'user_post/postCommentInsert',
                data: 'comment=' + comment + '&post_id=' + post_id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                    .then(function (success) {
                        data = success.data;
                        if (data.message == '1') {
                            if (commentClassName == 'last-comment') {
                                $scope.postData[index].post_comment_data.splice(0, 1);
                                $scope.postData[index].post_comment_data.push(data.comment_data[0]);
                                $('.post-comment-count-' + post_id).html(data.comment_count);
                                $('.editable_text').html('');
                            } else {
                                $scope.postData[index].post_comment_data.push(data.comment_data[0]);
                                $('.post-comment-count-' + post_id).html(data.comment_count);
                                $('.editable_text').html('');
                            }
                        }
                    });
        } else {
            $scope.isMsgBoxEmpty = true;
        }
    }

    $scope.viewAllComment = function (post_id, index, post) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/viewAllComment',
            data: 'post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    data = success.data;
                    $scope.postData[index].post_comment_data = data.all_comment_data;
                });

    }

    $scope.viewLastComment = function (post_id, index, post) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/viewLastComment',
            data: 'post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    data = success.data;
                    $scope.postData[index].post_comment_data = data.comment_data;
                });

    }
    $scope.deletePostComment = function (comment_id, post_id, parent_index, index, post) {
        $scope.c_d_comment_id = comment_id;
        $scope.c_d_post_id = post_id;
        $scope.c_d_parent_index = parent_index;
        $scope.c_d_index = index;
        $scope.c_d_post = post;

        $('#delete_model').modal('show');
    }

    $scope.deleteComment = function (comment_id, post_id, parent_index, index, post) {
        var commentClassName = $('#comment-icon-' + post_id).attr('class').split(' ')[0];
        $http({
            method: 'POST',
            url: base_url + 'user_post/deletePostComment',
            data: 'comment_id=' + comment_id + '&post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    data = success.data;
                    if (commentClassName == 'last-comment') {
                        $scope.postData[parent_index].post_comment_data.splice(0, 1);
                        $scope.postData[parent_index].post_comment_data.push(data.comment_data[0]);
                        $('.post-comment-count-' + post_id).html(data.comment_count);
                        $('.editable_text').html('');
                    } else {
                        $scope.postData[parent_index].post_comment_data.splice(index, 1);
                        $('.post-comment-count-' + post_id).html(data.comment_count);
                        $('.editable_text').html('');
                    }
                });
    }

    $scope.likePostComment = function (comment_id, post_id) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/likePostComment',
            data: 'comment_id=' + comment_id + '&post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    data = success.data;
                    if (data.message == '1') {
                        if (data.is_newLike == 1) {
                            $('#post-comment-like-' + comment_id).parent('a').addClass('like');
                            $('#post-comment-like-' + comment_id).html(data.commentLikeCount);
                        } else if (data.is_oldLike == 1) {
                            $('#post-comment-like-' + comment_id).parent('a').removeClass('like');
                            $('#post-comment-like-' + comment_id).html(data.commentLikeCount);
                        }

                    }
                });
    }
    $scope.editPostComment = function (comment_id, post_id, parent_index, index) {
        var editContent = $('#comment-dis-inner-' + comment_id).html();
        $('#edit-comment-' + comment_id).show();
        $('#editCommentTaxBox-' + comment_id).html(editContent);
        $('#comment-dis-inner-' + comment_id).hide();
    }

    $scope.sendEditComment = function (comment_id) {
        var comment = $('#editCommentTaxBox-' + comment_id).html();
        comment = comment.replace(/&nbsp;/gi, " ");
        comment = comment.replace(/<br>$/, '');
        comment = comment.replace(/&gt;/gi, ">");
        comment = comment.replace(/&/g, "%26");
        if (comment) {
            $scope.isMsg = true;
            $http({
                method: 'POST',
                url: base_url + 'user_post/postCommentUpdate',
                data: 'comment=' + comment + '&comment_id=' + comment_id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            })
                    .then(function (success) {
                        data = success.data;
                        if (data.message == '1') {
                            $('#comment-dis-inner-' + comment_id).show();
                            $('#comment-dis-inner-' + comment_id).html(comment);
                            $('#edit-comment-' + comment_id).html();
                            $('#edit-comment-' + comment_id).hide();
                        }
                    });
        } else {
            $scope.isMsgBoxEmpty = true;
        }
    }
    $scope.deletePost = function (post_id, index) {
        $scope.p_d_post_id = post_id;
        $scope.p_d_index = index;

        $('#delete_post_model').modal('show');
    }
    $scope.deletedPost = function (post_id, index) {
        $http({
            method: 'POST',
            url: base_url + 'user_post/deletePost',
            data: 'post_id=' + post_id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
                .then(function (success) {
                    data = success.data;
                    if (data.message == '1') {
                        $scope.postData.splice(index, 1);
                    }
                });
    }

    function check_no_post_data() {
        var numberPost = $scope.postData.length;
        if (numberPost == 0) {
            $('.all_user_post').html(no_user_post_html);
        }
    }

});

$(window).on("load", function () {
    $(".custom-scroll").mCustomScrollbar({
        autoHideScrollbar: true,
        theme: "minimal"
    });
});