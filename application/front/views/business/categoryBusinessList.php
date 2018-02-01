<!DOCTYPE html>
<html lang="en" ng-app="businessListApp" ng-controller="businessListController">
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
                        <a class="btn5" href="#">Create Business Profile</a>
                    </div>
                    <div class="search-bnr-text">
                        <h1>Find The Business That Fits Your Life</h1>
                    </div>
                    <div class="search-box">
                        <form>
                            <div class="search-input">
                                <input type="text" placeholder="Company, cat, Production">
                                <input type="text" placeholder="Location">
                                <a href="#" class="btn1">Search</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="left-part">
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Categories</h3>
                        </div>
                        <ul class="search-listing">
                            <li ng-repeat="category in businessCategory">
                                <label class=""><a href="<?php echo base_url('business-profile/category/') ?>{{category.industry_slug}}">{{category.industry_name}}<span class="pull-right">({{category.count}})</span></a></label>
                            </li>
                            <li>
                                <label class=""><a href="<?php echo base_url('business-profile/category/other') ?>">Other<span class="pull-right">({{otherCategoryCount}})</span></a></label>
                            </li>
                        </ul>
                    </div>

                    <div class="custom_footer_left fw">
                        <div class="">
                            <ul>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> About Us 
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> Contact Us
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> Blogs 
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> Privacy Policy 
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> Terms &amp; Condition
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <span class="custom_footer_dot"> · </span> Send Us Feedback
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="middle-part">
                    <div class="page-title">
                        <h3>Search Result</h3>
                    </div>
                    <div class="all-job-box search-business" ng-repeat="business in categoryBusinessList">
                        <div class="search-business-top">
                            <div class="bus-cover">
                                <a href="#"><img src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL ?>{{business.profile_background}}"></a>
                            </div>
                            <div class="all-job-top">
                                <div class="post-img">
                                    <a href="#"><img src="img/commen-img.png"></a>
                                </div>
                                <div class="job-top-detail">
                                    <h5><a href="#" ng-bind="business.company_name"></a></h5>
                                    <h5><a href="#">Business Categories</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <ul class="search-detail">
                                <li><span class="img"><img class="pr10" ng-src="<?php echo base_url('assets/n-images/website.png') ?>"></span> <p class="detail-content"><a href="#">www.aileensoul.com</a></p></li>
                                <li><span class="img"><img class="pr10" ng-src="<?php echo base_url('assets/n-images/location.png') ?>"></span> <p class="detail-content">Ahmedabad,(India)</p></li>
                                <li><span class="img"><img class="pr10" ng-src="<?php echo base_url('assets/n-images/exp.png') ?>"></span><p class="detail-content">5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)...<a href="#"> Read more</a></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right-part">
                    <div class="add-box">
                        <img src="<?php echo base_url('assets/n-images/add.jpg') ?>">
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
                                    var category_id = '<?php echo $category_id; ?>';
                                    var app = angular.module('businessListApp', ['ui.bootstrap']);
        </script>               
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/business/categoryBusinessList.js?ver=' . time()) ?>"></script>
    </body>
</html>