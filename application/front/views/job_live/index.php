<!DOCTYPE html>
<html lang="en" ng-app="jobApp" ng-controller="jobController">
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
            <?php echo $search_banner ?>
            <div class="container">
                <div class="left-part">
                    <div class="left-search-box">
                        <div class="">
                            <h3>Top Categories</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li ng-repeat="category in jobCategory">
                                <label class="control control--checkbox"><span ng-bind="category.industry_name"></span><span class="pull-right" ng-bind="'(' + category.count + ')'"></span>
                                    <input type="checkbox" ng-value="{{category.industry_id}}"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                        </ul>
<!--                        <p class="text-right p10"><a href="#">More Categories</a></p>-->
                    </div>
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Cities</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li>
                                <label class=""><a href="#">IT<span class="pull-right">(50)</span></a></label>
                            </li>
                        </ul>
                        <p class="text-right p10"><a href="#">More Categories</a></p>
                    </div>
                    <div class="left-search-box">
                        <div class="">
                            <h3>Top Company</h3>
                        </div>
                        <ul class="search-listing">
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>
                            <li>
                                <label class="control control--checkbox">IT<span class="pull-right">(50)</span>
                                    <input type="checkbox"/>
                                    <div class="control__indicator"></div>
                                </label>
                            </li>

                        </ul>
                        <p class="text-right p10"><a href="#">More Categories</a></p>
                    </div>
                    <div class="left-search-box">
                        <div class="accordion" id="accordion2">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <h3><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Posting Period</a></h3>
                                </div>
                                <div id="collapseOne" class="accordion-body collapse">
                                    <ul class="search-listing">
                                        <li>
                                            <label class="control control--checkbox">Today
                                                <input type="checkbox"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 7 Days
                                                <input type="checkbox"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 15 Days
                                                <input type="checkbox"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 45 Days
                                                <input type="checkbox"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">More than 45 Days
                                                <input type="checkbox"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="left-search-box">
                        <div class="accordion" id="accordion3">
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <h3><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsetwo">Experience</a></h3>
                                </div>
                                <div id="collapsetwo" class="accordion-body collapse">
                                    <div class="accordion-inner">
                                        <ul class="search-listing">
                                            <li>
                                                <label class="control control--checkbox">0 to 1 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">1 to 2 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">2 to 3 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">3 to 4 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">4 to 5 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">More than 5 year
                                                    <input type="checkbox"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                        </div>
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
                        <h3>Letest Job</h3>
                    </div>
                    <div class="all-job-box">
                        <div class="all-job-top">
                            <div class="post-img">
                                <a href="#"><img src="img/commen-img.png"></a>
                            </div>
                            <div class="job-top-detail">
                                <h5><a href="#">UI Developer/Front End Developer</a></h5>
                                <p><a href="#">Enterprise Solution Inc</a></p>
                                <p><a href="#">Vivek Panday</a></p>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <p class="pb5">
                                <span class="location">
                                    <span><img class="pr5" src="img/location.png">Ahmedabad,(India)</span>
                                </span>
                                <span class="exp">
                                    <span><img class="pr5" src="img/exp.png">3 year - 7 year (freshers can also apply)</span>
                                </span>
                            </p>
                            <p>
                                5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)  Advanced knowledge of web basics (Javascript, HTML, CSS, Ajax, JSON) ........
                            </p>

                        </div>
                        <div class="all-job-bottom">
                            <span class="job-post-date"><b>Posted on:</b>12-Nov-2017</span>
                            <p class="pull-right">
                                <a href="#" class="btn4">Save</a>
                                <a href="#" class="btn4">Apply</a>
                            </p>

                        </div>
                    </div>
                    <div class="all-job-box">
                        <div class="all-job-top">
                            <div class="post-img">
                                <a href="#"><img src="img/commen-img.png"></a>
                            </div>
                            <div class="job-top-detail">
                                <h5><a href="#">UI Developer/Front End Developer</a></h5>
                                <p><a href="#">Enterprise Solution Inc</a></p>
                                <p><a href="#">Vivek Panday</a></p>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <p class="pb5">
                                <span class="location">
                                    <span><img class="pr5" src="img/location.png">Ahmedabad,(India)</span>
                                </span>
                                <span class="exp">
                                    <span><img class="pr5" src="img/exp.png">3 year - 7 year (freshers can also apply)</span>
                                </span>
                            </p>
                            <p>
                                5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)  Advanced knowledge of web basics (Javascript, HTML, CSS, Ajax, JSON) ........
                            </p>

                        </div>
                        <div class="all-job-bottom">
                            <span class="job-post-date"><b>Posted on:</b>12-Nov-2017</span>
                            <p class="pull-right">
                                <a href="#" class="btn4">Save</a>
                                <a href="#" class="btn4">Apply</a>
                            </p>

                        </div>
                    </div>

                    <div class="all-job-box">
                        <div class="all-job-top">
                            <div class="post-img">
                                <a href="#"><img src="img/commen-img.png"></a>
                            </div>
                            <div class="job-top-detail">
                                <h5><a href="#">UI Developer/Front End Developer</a></h5>
                                <p><a href="#">Enterprise Solution Inc</a></p>
                                <p><a href="#">Vivek Panday</a></p>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <p class="pb5">
                                <span class="location">
                                    <span><img class="pr5" src="img/location.png">Ahmedabad,(India)</span>
                                </span>
                                <span class="exp">
                                    <span><img class="pr5" src="img/exp.png">3 year - 7 year (freshers can also apply)</span>
                                </span>
                            </p>
                            <p>
                                5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)  Advanced knowledge of web basics (Javascript, HTML, CSS, Ajax, JSON) ........
                            </p>

                        </div>
                        <div class="all-job-bottom">
                            <span class="job-post-date"><b>Posted on:</b>12-Nov-2017</span>
                            <p class="pull-right">
                                <a href="#" class="btn4">Save</a>
                                <a href="#" class="btn4">Apply</a>
                            </p>

                        </div>
                    </div>
                    <div class="all-job-box">
                        <div class="all-job-top">
                            <div class="post-img">
                                <a href="#"><img src="img/commen-img.png"></a>
                            </div>
                            <div class="job-top-detail">
                                <h5><a href="#">UI Developer/Front End Developer</a></h5>
                                <p><a href="#">Enterprise Solution Inc</a></p>
                                <p><a href="#">Vivek Panday</a></p>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <p class="pb5">
                                <span class="location">
                                    <span><img class="pr5" src="img/location.png">Ahmedabad,(India)</span>
                                </span>
                                <span class="exp">
                                    <span><img class="pr5" src="img/exp.png">3 year - 7 year (freshers can also apply)</span>
                                </span>
                            </p>
                            <p>
                                5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)  Advanced knowledge of web basics (Javascript, HTML, CSS, Ajax, JSON) ........
                            </p>

                        </div>
                        <div class="all-job-bottom">
                            <span class="job-post-date"><b>Posted on:</b>12-Nov-2017</span>
                            <p class="pull-right">
                                <a href="#" class="btn4">Save</a>
                                <a href="#" class="btn4">Apply</a>
                            </p>

                        </div>
                    </div>
                    <div class="all-job-box">
                        <div class="all-job-top">
                            <div class="post-img">
                                <a href="#"><img src="img/commen-img.png"></a>
                            </div>
                            <div class="job-top-detail">
                                <h5><a href="#">UI Developer/Front End Developer</a></h5>
                                <p><a href="#">Enterprise Solution Inc</a></p>
                                <p><a href="#">Vivek Panday</a></p>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <p class="pb5">
                                <span class="location">
                                    <span><img class="pr5" src="img/location.png">Ahmedabad,(India)</span>
                                </span>
                                <span class="exp">
                                    <span><img class="pr5" src="img/exp.png">3 year - 7 year (freshers can also apply)</span>
                                </span>
                            </p>
                            <p>
                                5+ years experience desired Proficiency with one or more of the modern front end frameworks (Angular, React, Vue)  Advanced knowledge of web basics (Javascript, HTML, CSS, Ajax, JSON) ........
                            </p>

                        </div>
                        <div class="all-job-bottom">
                            <span class="job-post-date"><b>Posted on:</b>12-Nov-2017</span>
                            <p class="pull-right">
                                <a href="#" class="btn4">Save</a>
                                <a href="#" class="btn4">Apply</a>
                            </p>

                        </div>
                    </div>


                </div>

                <div class="right-part">
                    <div class="add-box">
                        <img src="img/add.jpg">
                    </div>
                    <div class="all-contact">
                        <h4>Contacts<a href="#" class="pull-right">All</a></h4>
                        <div class="all-user-list">
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
                                </div>
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
                                </div>
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
                                </div>
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
                                </div>
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
                                </div>
                                <div class="item">
                                    <div class="post-img">
                                        <img src="img/user-pic.jpg">

                                    </div>
                                    <div class="user-list-detail">
                                        <p class="contact-name"><a href="#">Prasant Dadhaniya </a></p>
                                        <p class="contact-designation"><a href="#">SEO Executive</a></p>
                                    </div>
                                    <button class="follow-btn">Add to contact</button>
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
            var q = '';
            var l = '';
            var app = angular.module('jobApp', ['ui.bootstrap']);
        </script>               
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/job-live/searchJob.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/job-live/index.js?ver=' . time()) ?>"></script>
    </body>
</html>