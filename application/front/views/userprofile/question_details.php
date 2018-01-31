<!DOCTYPE html>
<html lang="en" ng-app="questionDetailsApp" ng-controller="questionDetailsController">
    <head>
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
    </head>
    <body class="profile-db">
        <?php echo $header_profile ?>
        <div class="middle-section middle-section-banner">
            <div class="container pt20">
                <?php echo $n_leftbar ?>
                <div class="middle-part">
                    <div class="all-post-box" ng-repeat="question in questionData">
                        <div class="all-post-top">
                            <div class="post-head">
                                <div class="post-img">
                                    <img src="img/user-pic.jpg">
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


                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="img/right-down.png"></a>

                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                    </ul>

                                </div>
                            </div>
                            <div class="post-discription">


                                <div class="post-des-detail">
                                    <p><b>Question:</b> What is lorem ipsum??</p>
                                    <p><b>Description:</b> I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works. I dont know about lorem ispum and how it works.</p>
                                    <p><b>Categories:</b> #category</p>
                                    <p><b>Field:</b> #category</p>
                                    <p><b>Link:</b> <a href="#">www.aileensoul.com</a></p>
                                </div>
                            </div>
                            <div class="post-images">
                                <div class="one-img">
                                    <img src="img/img1.jpg">
                                </div>
                            </div>
                            <div class="post-bottom">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-5">
                                        <ul class="bottom-left">
                                            <li><a class="ripple" href="javascript:void(0);"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a class="ripple" href="javascript:void(0);"><i class="fa fa-comment-o"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-7">
                                        <ul class="pull-right bottom-right">
                                            <li class="like-count">1<span>Like</span></li>
                                            <li class="comment-count">5<span>Answers</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="like-other-box">
                                <a href="#">xyz and 5 others</a>
                            </div>
                        </div>
                        <div class="ans-text"><span>Answers</span></div>
                        <div class="all-post-bottom">

                            <div class="comment-box">

                                <div class="post-comment">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">
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
                                        <img src="img/user-pic.jpg">
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
                                        <img src="img/user-pic.jpg">
                                    </div>
                                    <div class="comment-input">
                                        <input type="text" placeholder="Add a Answers ...">
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
                    <div class="custom-user-add">
                        <img src="<?php echo base_url('assets/n-images/add.jpg')?>">
                    </div>
                </div>


            </div>
        </div>

        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <script src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script src="<?php echo base_url('assets/js/ng-tags-input.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/angular/angular-tooltips.min.js?ver=' . time()); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
        <script>
                                var base_url = '<?php echo base_url(); ?>';
                                var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                var question = '<?php echo $question_id ?>';
                                
                                var app = angular.module("questionDetailsApp", ['ngRoute','ui.bootstrap', 'ngTagsInput', 'ngSanitize']);
        </script>
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/user/question_details.js?ver=' . time()) ?>"></script>
        
        
    </body>
</html>