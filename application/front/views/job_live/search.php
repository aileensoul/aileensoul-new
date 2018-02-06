<!DOCTYPE html>
<html lang="en" ng-app="artistSearchListApp" ng-controller="artistSearchListController">
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
            <?php echo $search_banner; ?>
            <div class="container">
                <div class="left-part">
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Categories</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li ng-repeat="category in jobCategory">
                                <label class=""><a href="<?php echo base_url('job/category/') ?>{{category.industry_slug}}"><span ng-bind="category.industry_name | capitalize"></span><span class="pull-right" ng-bind="'(' + category.count + ')'"></span></a></label>
                            </li>
                        </ul>
<!--                        <p class="text-right p10"><a href="#">More Categories</a></p>-->
                    </div>
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Cities</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li ng-repeat="city in jobCity">
                                <label class=""><a href="<?php echo base_url('job/city/') ?>{{city.slug}}"><span ng-bind="city.city_name | capitalize"></span><span class="pull-right" ng-bind="'(' + city.count + ')'"></span></a></label>
                            </li>
                        </ul>
                        <!--<p class="text-right p10"><a href="#">More Categories</a></p>-->
                    </div>
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Company</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li ng-repeat="company in jobCompany">
                                <label class=""><a href="<?php echo base_url('job/company/') ?>{{company.company_slug}}"><span ng-bind="company.company_name | capitalize"></span><span class="pull-right" ng-bind="'(' + company.count + ')'"></span></a></label>
                            </li>
                        </ul>
                        <!--<p class="text-right p10"><a href="#">More Categories</a></p>-->
                    </div>
                    <div class="left-search-box list-type-bullet">
                        <div class="">
                            <h3>Top Skills</h3>
                        </div>
                        <ul class="search-listing custom-scroll">
                            <li ng-repeat="skill in jobSkill">
                                <label class=""><a href="<?php echo base_url('job/skill/') ?>{{skill.skill_slug}}"><span ng-bind="skill.skill | capitalize"></span><span class="pull-right" ng-bind="'(' + skill.count + ')'"></span></a></label>
                            </li>
                        </ul>
                        <!--<p class="text-right p10"><a href="#">More Categories</a></p>-->
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
                                                <input type="checkbox" name="posting_period[]" value="1"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 7 Days
                                                <input type="checkbox"  name="posting_period[]" value="2"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 15 Days
                                                <input type="checkbox"  name="posting_period[]" value="3"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">Last 45 Days
                                                <input type="checkbox"  name="posting_period[]" value="4"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="control control--checkbox">More than 45 Days
                                                <input type="checkbox"  name="posting_period[]" value="5"/>
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
                                                    <input type="checkbox" name="experience[]" value="1"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">1 to 2 year
                                                    <input type="checkbox" name="experience[]" value="2"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">2 to 3 year
                                                    <input type="checkbox" name="experience[]" value="3"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">3 to 4 year
                                                    <input type="checkbox" name="experience[]" value="4"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">4 to 5 year
                                                    <input type="checkbox" name="experience[]" value="5"/>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="control control--checkbox">More than 5 year
                                                    <input type="checkbox" name="experience[]" value="6"/>
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
                        <h3>Search Result</h3>
                    </div>
                    <div class="all-job-box search-business" ng-repeat="artist in artistList">
                        <div class="search-business-top">
                            <div class="bus-cover no-cover-upload">
                                <a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-if="artist.profile_background"><img ng-src="<?php echo ART_BG_MAIN_UPLOAD_URL ?>{{artist.profile_background}}"></a>
                                <a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-if="!artist.profile_background"><img ng-src="<?php echo BASEURL . WHITEIMAGE ?>"></a>
                            </div>
                            <div class="all-job-top">
                                <div class="post-img">
                                    <a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-if="artist.art_user_image"><img ng-src="<?php echo ART_PROFILE_THUMB_UPLOAD_URL ?>{{artist.art_user_image}}"></a>
                                    <a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-if="!artist.art_user_image"><img ng-src="<?php echo BASEURL . NOARTIMAGE ?>"></a>
                                </div>
                                <div class="job-top-detail">
                                    <h5><a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-bind="artist.fullname | capitalize"></a></h5>
                                    <h5 ng-if="artist.art_category"><a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-bind="artist.art_category | capitalize"></a></h5>
                                    <h5 ng-if="!artist.art_category"><a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}" ng-bind="artist.other_skill | capitalize"></a></h5>
                                </div>
                            </div>
                        </div>
                        <div class="all-job-middle">
                            <ul class="search-detail">
                                <li><span class="img"><img class="pr10" ng-src="<?php echo base_url('assets/n-images/location.png') ?>"></span> <p class="detail-content"><span ng-bind="artist.city"></span><span ng-if="artist.city">,(</span><span ng-bind="artist.country"></span><span ng-if="artist.city">)</span></p></li>
                                <li ng-if="artist.art_desc_art"><span class="img"><img class="pr10" ng-src="<?php echo base_url('assets/n-images/exp.png') ?>"></span><p class="detail-content">{{artist.art_desc_art| limitTo:110}}...<a href="<?php echo BASEURL ?>artist/dashboard/{{artist.slug}}"> Read more</a></p></li>
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
        
        <script>
                                    var base_url = '<?php echo base_url(); ?>';
                                    var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                    var title = '<?php echo $title; ?>';
                                    var header_all_profile = '<?php echo $header_all_profile; ?>';
                                    var q = '<?php echo $q; ?>';
                                    var l = '<?php echo $l; ?>';
                                    var app = angular.module('artistSearchListApp', ['ui.bootstrap']);
        </script>   
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/artist-live/searchArtist.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/artist-live/search.js?ver=' . time()) ?>"></script>
    </body>
</html>