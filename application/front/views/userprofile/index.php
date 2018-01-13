<!DOCTYPE html>
<html lang="en" ng-app="userProfileApp" ng-controller="userProfileController">
    <!--<html lang="en" ng-app="userProfileApp">-->
    <head>
        <base href="/aileensoul-new/" >
        <title ng-bind="title"></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/animate.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/owl.carousel.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css') ?>">

        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css') ?>">

    <body class="main-db">
        <?php echo $header; ?>
        <div ng-view></div>
        <?php echo $footer; ?>

        <!--PROFILE PIC MODEL START-->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>      
                    <div class="modal-body">
                        <div class="mes">
                            <div id="popup-form">

                                <div class="fw" id="profi_loader"  style="display:none; text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" alt="<?php echo 'LOADERIMAGE'; ?>"/></div>
                                <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                                    <div class="fw">
                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one" >
                                    </div>

                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="display:none; width:350px"></div>
                                    </div>
                                    <input type="submit" class="upload-result-one btn1" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--PROFILE PIC MODEL END-->

        <div class="modal fade message-box" id="remove-contact" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div class="pop_content">Do you want to delete all message?<div class="model_ok_cancel"><a class="okbtn" ng-click="delete_all_history(m_a_d_message_to_profile_id)" href="javascript:void(0);" data-dismiss="modal">Yes</a><a class="cnclbtn" href="javascript:void(0);" data-dismiss="modal">No</a></div></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <div style="display:none;" class="modal fade" id="post-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <div class="post-box">
                            <div class="post-img">
                                <img src="<?php echo base_url('assets/n-images/user-pic.jpg') ?>">
                            </div>
                            <div class="post-text">
                                <textarea class="title-text-area" placeholder="Post Opportunity"></textarea>
                            </div>
                            <div class="all-upload">
                                <label for="file-1">
                                    <i class="fa fa-camera upload_icon"><span class="upload_span_icon"> Photo </span></i>
                                    <i class="fa fa-video-camera upload_icon"><span class="upload_span_icon"> Video</span>  </i> 
                                    <i class="fa fa-music upload_icon"> <span class="upload_span_icon">  Audio </span> </i>
                                    <i class="fa fa-file-pdf-o upload_icon"><span class="upload_span_icon"> PDF </span></i>
                                </label>
                            </div>

                        </div>
                        <div class="post-field">
                            <form>
                                <div class="form-group">

                                    <textarea placeholder="FOR WHOM THIS OPPORTUNITY ?&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;Ex:Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, PHP Developer, HR, BDE, CA, Doctor, Freelancer.." cols="10" rows="5" style="resize:none"></textarea>

                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="" placeholder="WHICH LOCATION?&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a;&#x09;&#x09;&#x09;&#x0a; Ex:Mumbai, Delhi, New south wels, London, New York, Captown, Sydeny, Shanghai, Moscow, Paris, Tokyo.. "></textarea>

                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="What is your field?">
                                </div>


                            </form>


                        </div>
                        <div class="text-right fw pt10">
                            <a class="btn1" href="#">Post</a>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>  
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script>
                                var base_url = '<?php echo base_url(); ?>';
                                var user_slug = '<?php echo $this->uri->segment(2); ?>';
                                var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                var app = angular.module("userProfileApp", ["ngRoute"]);
                                var item = '<?php echo $this->uri->segment(1); ?>'
                                        app.controller('userProfileController', function($scope) {

                                        $scope.goMainLink = function(path){
                                        location.href = path;
                                        }

                                        $scope.active = $scope.active == item?'':item;
                                        $scope.makeActive = function(item) {
                                        $scope.active = $scope.active == item?'':item;
                                        }
                                        $scope.segment2 = '<?php echo $this->uri->segment(2); ?>';
                                        $scope.user_slug = '<?php echo $userdata['user_slug']; ?>';
                                        })
                                app.config(function ($routeProvider, $locationProvider) {
                                $routeProvider
                                        .when("/profiless/:name*", {
                                        templateUrl: base_url + "userprofile_page/profile",
                                                controller: 'profilesController'
                                        })
                                        .when("/dashboardd/:name*", {
                                        templateUrl: base_url + "userprofile_page/dashboard"
                                                //   controller: 'basicInfoController'
                                        })
                                        .when("/details/:name*", {
                                        templateUrl: base_url + "userprofile_page/details",
                                                controller: 'detailsController'
                                        })
                                        .when("/contacts/:name*", {
                                        templateUrl: base_url + "userprofile_page/contacts",
                                                controller: 'contactsController'
                                        })
                                        .when("/followers/:name*", {
                                        templateUrl: base_url + "userprofile_page/followers"
                                                //   controller: 'basicInfoController'
                                        })
                                        .when("/following/:name*", {
                                        templateUrl: base_url + "userprofile_page/following"
                                                //   controller: 'basicInfoController'
                                        })
//                    .otherwise({
//                    redirectTo: '/profiles/'
//                    });
                                        $locationProvider.html5Mode(true);
                                });
                                app.controller('profilesController', function ($scope, $http, $location) {
                                $scope.user = {};
                                // PROFEETIONAL DATA
                                getFieldList();
                                function getFieldList() {

                                $http({
                                method: 'POST',
                                        url: base_url + 'userprofile_page/profiles_data',
                                        data: 'u=' + user_id,
                                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .then(function (success) {
                                        details_data = success.data;
                                        $scope.details_data = details_data;
                                        });
                                }


                                $scope.goMainLink = function(path){
                                location.href = path;
                                }

                                });
                                app.controller('detailsController', function ($scope, $http, $location) {
                                $scope.user = {};
                                // PROFEETIONAL DATA
                                getFieldList();
                                function getFieldList() {

                                $http({
                                method: 'POST',
                                        url: base_url + 'userprofile_page/detail_data',
                                        data: 'u=' + user_id,
                                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .then(function (success) {
                                        details_data = success.data;
                                        $scope.details_data = details_data;
                                        });
                                }


                                $scope.goMainLink = function(path){
                                location.href = path;
                                }

                                $scope.makeActive = function(item){
                                $scope.active = $scope.active == item?'':item;
                                }
                                });
                                app.controller('contactsController', function ($scope, $http, $location) {
                                $scope.user = {};
                                var id = 1;
                                $scope.remove = function(index){ //alert(123); return false;
                                $('#remove-contact .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn btn1' id=" + id + " onClick='remove_contacts(" + index + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn btn1' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                //$('.biderror .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id="" onClick='remove_post(1)' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                $('#remove-contact').modal('show');
                                // array.splice(index, 1);
                                }


                                // PROFEETIONAL DATA
                                getFieldList();
                                function getFieldList() {

                                $http({
                                method: 'POST',
                                        url: base_url + 'userprofile_page/contacts_data',
                                        data: 'u=' + user_id,
                                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .then(function (success) {
                                        $scope.contats_data = success.data;
                                        });
                                }


                                $scope.goMainLink = function(path){alert(22);
                                location.href = path;
                                }

                                $scope.goUserprofile = function(path){

                                var base_url = '<?php echo base_url(); ?>';
                                location.href = base_url + 'profiless/' + path;
                                }

                                });
                                function remove_contacts(index){
                                $.ajax({
                                url: base_url + "userprofile_page/removeContacts",
                                        type: "POST",
                                        data: {"id": index},
                                        success: function (data) {
                                        if (data == 1) {
                                        $('#' + index).closest('.custom-user-box').fadeToggle();
                                        }
                                        }
                                });
                                }

                                $uploadCrop1 = $('#upload-demo-one').croppie({
                                enableExif: true,
                                        viewport: {
                                        width: 60,
                                                height: 60,
                                                type: 'square'
                                        },
                                        boundary: {
                                        width: 30,
                                                height: 30
                                        }
                                });
                                $('#upload-one').on('change', function () {
                                document.getElementById('upload-demo-one').style.display = 'block';
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                $uploadCrop1.croppie('bind', {
                                url: e.target.result
                                }).then(function () {
                                console.log('jQuery bind complete');
                                });
                                }
                                reader.readAsDataURL(this.files[0]);
                                });
                                $("#userimage").validate({
                                rules: {
                                profilepic: {
                                required: true,
                                },
                                },
                                        messages: {
                                        profilepic: {
                                        required: "Photo Required",
                                        },
                                        },
                                        submitHandler: profile_pic
                                });
                                function profile_pic() {
//    $('.upload-result-one').on('click', function (ev) {
                                $uploadCrop1.croppie('result', {
                                type: 'canvas',
                                        size: 'viewport'
                                }).then(function (resp) {
                                $.ajax({
                                //url: "/ajaxpro.php", user_image_insert
                                // url: "<?php echo base_url(); ?>freelancer/ajaxpro_test",
                                url: base_url + "userprofile_page/user_image_insert1",
                                        type: "POST",
                                        data: {"image": resp},
                                        beforeSend: function () {
                                        $('#profi_loader').show();
                                        // document.getElementById('profi_loader').style.display = 'block';
                                        },
                                        complete: function () {
                                        //    $document.getElementById('profi_loader').style.display = 'none';
                                        },
                                        success: function (data) {
                                        $('#profi_loader').hide();
                                        $('#bidmodal-2').modal('hide');
                                        $(".profile-img").html(data);
                                        document.getElementById('upload-one').value = null;
                                        document.getElementById('upload-demo-one').value = '';
//                    html = '<img src="' + resp + '" />';
//                    $("#upload-demo-i").html(html);
                                        }
                                });
                                });
//    });
                                }

                                function updateprofilepopup(id) {
                                document.getElementById('upload-demo-one').style.display = 'none';
                                document.getElementById('profi_loader').style.display = 'none';
                                document.getElementById('upload-one').value = null;
                                $('#bidmodal-2').modal('show');
                                }


                                // cover image start

                                function myFunction() {

                                document.getElementById("upload-demo").style.visibility = "hidden";
                                document.getElementById("upload-demo-i").style.visibility = "hidden";
                                document.getElementById('message1').style.display = "block";
                                }


                                function showDiv() {

                                document.getElementById('row1').style.display = "block";
                                document.getElementById('row2').style.display = "none";
                                $(".cr-image").attr("src", "");
                                $("#upload").val('');
                                }


                                $uploadCrop = $('#upload-demo').croppie({
                                enableExif: true,
                                        viewport: {
                                        width: 1250,
                                                height: 350,
                                                type: 'square'
                                        },
                                        boundary: {
                                        width: 1250,
                                                height: 350
                                        }
                                });
                                $('.upload-result').on('click', function (ev) {

                                $uploadCrop.croppie('result', {
                                type: 'canvas',
                                        size: 'viewport'
                                }).then(function (resp) {

                                $.ajax({
                                url: base_url + "userprofile_page/ajaxpro",
                                        type: "POST",
                                        data: {"image": resp},
                                        success: function (data) {
                                        if (data) {
                                        $("#row2").html(data);
                                        document.getElementById('row2').style.display = "block";
                                        document.getElementById('row1').style.display = "none";
                                        document.getElementById('message1').style.display = "none";
                                        document.getElementById("upload-demo").style.visibility = "visible";
                                        document.getElementById("upload-demo-i").style.visibility = "visible";
                                        }
                                        }
                                });
                                });
                                });
                                $('.cancel-result').on('click', function (ev) {

                                document.getElementById('row2').style.display = "block";
                                document.getElementById('row1').style.display = "none";
                                document.getElementById('message1').style.display = "none";
                                $(".cr-image").attr("src", "");
                                });
                                //aarati code start
                                $('#upload').on('change', function () {

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                $uploadCrop.croppie('bind', {
                                url: e.target.result
                                }).then(function () {
                                console.log('jQuery bind complete');
                                });
                                }
                                reader.readAsDataURL(this.files[0]);
                                });
                                $('#upload').on('change', function () {

                                var fd = new FormData();
                                fd.append("image", $("#upload")[0].files[0]);
                                files = this.files;
                                size = files[0].size;
                                // pallavi code start for file type support
                                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){

                                picpopup();
                                document.getElementById('row1').style.display = "none";
                                document.getElementById('row2').style.display = "block";
                                return false;
                                }
                                // file type code end

                                if (size > 26214400)
                                {
                                //show an alert to the user
                                alert("Allowed file size exceeded. (Max. 25 MB)")

                                        document.getElementById('row1').style.display = "none";
                                document.getElementById('row2').style.display = "block";
                                return false;
                                }


//                    $.ajax({
//
//                        url: base_url +"recruiter/image",
//                        type: "POST",
//                        data: fd,
//                        processData: false,
//                        contentType: false,
//                        success: function (response) {
//
//                        }
//                    });
                                });
                                //aarati code end

//cover image end 

        </script>
<!--        <script>
        jQuery(document).ready(function($) {
          var owl = $('.owl-carousel');
          owl.on('initialize.owl.carousel initialized.owl.carousel ' +
            'initialize.owl.carousel initialize.owl.carousel ' +
            'resize.owl.carousel resized.owl.carousel ' +
            'refresh.owl.carousel refreshed.owl.carousel ' +
            'update.owl.carousel updated.owl.carousel ' +
            'drag.owl.carousel dragged.owl.carousel ' +
            'translate.owl.carousel translated.owl.carousel ' +
            'to.owl.carousel changed.owl.carousel',
            function(e) {
              $('.' + e.type)
                .removeClass('secondary')
                .addClass('success');
              window.setTimeout(function() {
                $('.' + e.type)
                  .removeClass('success')
                  .addClass('secondary');
              }, 500);
            });
          owl.owlCarousel({
            loop: true,
            nav: true,
            lazyLoad: true,
            margin: 0,
            video: true,
            responsive: {
              0: {
                items: 1
              },
                              480: {
                items: 2
              },
              540: {
                items: 3
              },
              1200: {
                items: 1,
              },
              1280: {
                items: 2
              }
            }
          });
        });
            // mcustom scroll bar
                    (function($){
                            $(window).on("load",function(){
                                    
                                    $(".custom-scroll").mCustomScrollbar({
                                            autoHideScrollbar:true,
                                            theme:"minimal"
                                    });
                                    
                            });
                    })(jQuery);
                    
                    
              
</script>-->

    </body>
</html>