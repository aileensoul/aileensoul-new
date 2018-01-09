<!DOCTYPE html>
<html lang="en" ng-app="userOppoApp" ng-controller="userOppoController">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/bootstrap.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/animate.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/font-awesome.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/owl.carousel.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css?ver=' . time()) ?>">
    </head>
    <body>
        <?php echo $header_profile; ?>
        <div class="middle-section">
            <div class="container">
                <?php echo $n_leftbar; ?>
                <div class="middle-part">
                    <div class="add-post">
                        <div class="post-box" data-target="#post-popup" data-toggle="modal">
                            <div class="post-img">
                                <?php if ($leftbox_data['user_image'] != '') { ?> 
                                    <img src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                <?php } else { ?>
                                    <img src="<?php echo base_url(NOBUSIMAGE) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                <?php } ?>
                            </div>
                            <div class="post-text">
                                Post Opportunity
                            </div>
                            <span class="post-cam"><i class="fa fa-camera"></i></span>
                        </div>
                    </div>
                    <div class="all-post-box">
                        <div class="all-post-top">
                            <div class="post-head">
                                <div class="post-img">
                                    <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                </div>
                                <div class="post-detail">
                                    <div class="fw">
                                        <a href="#" class="post-name">Prasant Dadhaniya</a><span class="post-time">7 hours ago</span>
                                    </div>
                                    <div class="fw">
                                        <span class="post-designation">SEO Executive</span>
                                    </div>
                                </div>
                                <div class="post-right-dropdown dropdown">


                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/') ?>n-images/right-down.png"></a>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                    </ul>

                                </div>
                            </div>
                            <div class="post-discription">
                                <h5 class="post-title">
                                    <p><b>Opportunity for:</b> Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, Developer, HR, BDE, CA, Doctor..</p>
                                    <p><b>Location:</b> Ex:Mumbai, Delhi, New south wels, London, New York, Captown, Sydeny, Shanghai, Moscow, Paris, Tokyo..</p>
                                </h5>

                                <div class="post-des-detail">
                                    <b>Opportunity:</b> This webpage requires data that you entered earlier in order to be properly displayed. You can send this data again, but by doing so you will repeat any action this page previously performed.
                                    Press the reload button to resubmit the data needed to load the page.
                                </div>
                            </div>
                            <div class="post-images">
                                <div class="one-img">
                                    <img src="<?php echo base_url('assets/') ?>n-images/img1.jpg">
                                </div>
                            </div>
                            <!-- CONDITIONAL DIV -->
                            <div class="post-images">
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                            </div>
                            <!-- CONDITIONAL DIV -->
                            <!-- CONDITIONAL DIV -->
                            <div class="post-images">
                                <div class="three-img-top">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                            </div>
                            <!-- CONDITIONAL DIV -->
                            <!-- CONDITIONAL DIV -->
                            <div class="post-images four-img">
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                </div>
                                <div class="two-img">
                                    <a href="#"><img src="<?php echo base_url('assets/') ?>n-images/img1.jpg"></a>
                                    <div class="view-more-img">
                                        <span>View All (+5)</span>
                                    </div>
                                </div>
                            </div>
                            <!-- CONDITIONAL DIV -->
                            <div class="post-bottom">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <ul class="bottom-left">
                                            <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a href="#"><i class="fa fa-comment-o"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <ul class="pull-right bottom-right">
                                            <li class="like-count">1<span>Like</span></li>
                                            <li class="comment-count">5<span>Comment</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="like-other-box">
                                <a href="#">xyz and 5 others</a>
                            </div>
                        </div>
                        <div class="all-post-bottom">
                            <div class="comment-box">
                                <div class="post-comment">
                                    <div class="post-img">
                                        <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                    </div>
                                    <div class="comment-dis">
                                        <div class="comment-name"><a>Sarasvati Musical Shop</a></div>
                                        <div class="comment-dis-inner">nice click.....</div>
                                        <ul class="comment-action">
                                            <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a href="#">Edit</a></li>
                                            <li><a href="#">Delete</a></li>
                                            <li><a href="#">13 minutes ago</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="post-comment">
                                    <div class="post-img">
                                        <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                    </div>
                                    <div class="comment-dis">
                                        <div class="comment-name"><a>Sarasvati Musical Shop</a></div>
                                        <div class="comment-dis-inner">However, most attention in this field is given to crop varieties and to crop wild relatives. Cultivated varieties can be broadly classified into “modern varieties” and “farmer's or traditional varieties”. </div>
                                        <ul class="comment-action">
                                            <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a href="#">Edit</a></li>
                                            <li><a href="#">Delete</a></li>
                                            <li><a href="#">13 minutes ago</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="add-comment">
                                    <div class="post-img">
                                        <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                    </div>
                                    <div class="comment-input">
                                        <input type="text" placeholder="Add a Comment ...">
                                    </div>
                                    <div class="comment-submit">
                                        <button class="btn2">Comment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-part">
                    <div class="add-box">
                        <img src="<?php echo base_url('assets/n-images/add.jpg') ?>">
                    </div>
                    <div class="all-contact">
                        <h4>Contacts<a href="#" class="pull-right">All</a></h4>
                        <div class="all-user-list">
                            <data-owl-carousel class="owl-carousel" data-options="{navigation: true, pagination: false, rewindNav : false}">
                                <div owl-carousel-item="" ng-repeat="item in items1" class="item">
                                    <div class="item">
                                        <div class="post-img" ng-if="item.user_image != ''">
                                            <img src="<?php echo USER_THUMB_UPLOAD_URL ?>{{item.user_image}}">
                                        </div>
                                        <div class="post-img" ng-if="item.user_image == ''">
                                            <div class="post-img-mainuser">{{item.first_name | limitTo:1 | uppercase}}{{item.last_name | limitTo:1 | uppercase}}</div>
                                        </div>
                                        <div class="user-list-detail">
                                            <p class="contact-name"><a href="#" ng-bind="(item.first_name | limitTo:1 | uppercase) + (item.first_name.substr(1) | lowercase)"></a></p>
                                            <p class="contact-designation"><a href="#" ng-if="item.degree_name != ''">{{item.title_name}}CEO</a></p>
                                            <p class="contact-designation"><a href="#" ng-if="item.degree_name == ''">{{item.degree_name}}</a></p>
                                        </div>
                                        <button class="follow-btn">Add to contact</button>
                                    </div>
                                </div>
                            </data-owl-carousel>
                        </div>
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
                                <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
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
        <script src="<?php echo base_url('assets/js/jquery.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>

        <script>
                                            var base_url = '<?php echo base_url(); ?>';
                                            var slug = '<?php echo $slugid; ?>';
                                            var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                            var title = '<?php echo $title; ?>';
                                            var app = angular.module('userOppoApp', ['ui.bootstrap']);
                                            app.controller('userOppoController', function ($scope, $http) {

                                                getContactSuggetion();
                                                function getContactSuggetion() {
                                                    $http.get(base_url + "user_opportunities/getContactSuggetion").then(function (success) {
                                                        $scope.items1 = success.data;
                                                    }, function (error) {});
                                                }
                                            });
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
        </script>
        <script type="text/javascript">
            // mcustom scroll bar
            (function ($) {
                $(window).on("load", function () {

                    $(".custom-scroll").mCustomScrollbar({
                        autoHideScrollbar: true,
                        theme: "minimal"
                    });
                });
            })(jQuery);
        </script>

    </body>
</html>