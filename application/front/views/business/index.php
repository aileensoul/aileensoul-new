<!DOCTYPE html>
<html lang="en" ng-app="businessApp" ng-controller="businessController">
    <head>
        <title ng-bind="title"></title>
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
    <body class="profile-main-page">
        <?php echo $header_profile; ?>
        <div class="middle-section middle-section-banner">
            <div class="search-banner">
                <div class="container">
                    <div class="text-right pt20">
                        <a class="btn5" href="<?php echo base_url('business-profile/business-information') ?>">Create Business Profile</a>
                    </div>
                    <div class="search-bnr-text">
                        <h1>Find The Business That Fits Your Life</h1>
                    </div>
                    <div class="search-box">
                        <form>
                            <div class="search-input">
                                <input type="text" placeholder="Company, Cat, Products">
                                <input type="text" placeholder="Location">
                                <a href="#" class="btn1">Search</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="container pt20">
                <div class="custom-width-box">
                    <div class="pt20 pb20">
                        <div class="center-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="cat-box">
                            <ul>
                                <li ng-repeat="category in businessCategory">
                                    <a href="<?php echo base_url('business-profile/category/') ?>{{category.industry_slug}}">
                                        <img src="<?php echo base_url('assets/n-images/car.png') ?>">
                                        <p>{{category.industry_name}}<span>({{category.count}})</span><p>

                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('business-profile/category/other') ?>">
                                        <img src="<?php echo base_url('assets/n-images/car.png') ?>">
                                        <p>Other<span>({{otherCategoryCount}})</span><p>
                                    </a>
                                </li>
                            </ul>
                            <p class="text-center"><a href="<?php echo base_url('business-profile/category') ?>" class="btn-1">View More</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container pt20">
                <div class="custom-width-box">
                    <div class="pt20 pb20">
                        <div class="center-title">
                            <h3>What is Business </h3>

                        </div>
                    </div>
                    <div class="row pt20 pb20">
                        <div class="col-md-6 col-sm-6 pull-right">
                            <div class="content-img text-center">
                                <img src="<?php echo base_url('assets/n-images/img1.jpg') ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p>Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                            <p>
                                <br>
                                Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                        </div>
                    </div>
                    <div class="row pt20 pb20">
                        <div class="col-md-6 col-sm-6">
                            <div class="content-img text-center">
                                <img src="<?php echo base_url('assets/n-images/img1.jpg') ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p>Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                            <p>
                                <br>
                                Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                        </div>
                    </div>
                    <div class="row pt20 pb20">
                        <div class="col-md-6 col-sm-6 pull-right">
                            <div class="content-img text-center">
                                <img src="<?php echo base_url('assets/n-images/img1.jpg') ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <p>Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                            <p>
                                <br>
                                Aileensoul is a new-age career-oriented portal that provides a host of free services to a diverse audience in relation to job search, hiring, freelancing, business networking and a platform to showcase one’s artistic abilities and talent to the world. The highly sophisticated and tech-enabled website delivers its unique and comprehensive range of offerings through focused service profiles that include its one of a kind ‘Recruiter Profile’, which empowers recruiters to reach out to and interact with qualified and deserving candidates in a completely new and innovative way. </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-bnr">
                <div class="bnr-box">
                    <img src="<?php echo base_url('assets/n-images/img2.jpg') ?>">
                    <div class="content-bnt-text">
                        <h1>Lorem Ipsum is a dummy text</h1>
                        <p><a href="#" class="btn5">Create Business Profile</a></p>
                    </div>
                </div>
            </div>
            <div class="container pt20">
                <div class="custom-width-box">
                    <div class="pt20 pb20">
                        <div class="center-title">
                            <h3>How it works </h3>
                            <p>Lorem ipsum is dummy text</p>
                        </div>
                    </div>
                    <div class="it-works-img pt20 pb20">
                        <img src="<?php echo base_url('assets/n-images/img3.jpg') ?>">
                    </div>

                    <div class="related-article pt20">
                        <div class="center-title">
                            <h3>Related Article</h3>

                        </div>
                        <div class="row pt10">
                            <div class="col-md-4">
                                <div class="rel-art-box">
                                    <img src="<?php echo base_url('assets/n-images/art-post.jpg') ?>">
                                    <div class="rel-art-name">
                                        <a href="#">Article Name</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="rel-art-box">
                                    <img src="<?php echo base_url('assets/n-images/art-post.jpg') ?>">
                                    <div class="rel-art-name">
                                        <a href="#">Article Name</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="rel-art-box">
                                    <img src="<?php echo base_url('assets/n-images/art-post.jpg') ?>">
                                    <div class="rel-art-name">
                                        <a href="#">Article Name</a>
                                    </div>
                                </div>
                            </div>
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
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
            var title = '<?php echo $title; ?>';
            var header_all_profile = '<?php echo $header_all_profile; ?>';
            var app = angular.module('businessApp', ['ui.bootstrap']);
        </script>               
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/business/index.js?ver=' . time()) ?>"></script>
    </body>
</html>