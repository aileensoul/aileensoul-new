<!DOCTYPE html>
<html lang="en" ng-app="searchApp" ng-controller="searchController">
    <head>
        <title>Aileensoul</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/css/animte.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/font-awesome.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/owl.carousel.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css') ?>">
    </head>
    <body class="search-page">
        <?php echo $header_profile ?>
        <div class="middle-section">
            <div class="container">
                <?php echo $n_leftbar; ?>
                <div class="middle-part">
                    <div class="no-data-box">
                        <h3>Search result of "<?php echo $search_keyword ?>" </h3>
                        <div class="no-data-content">
                            <p><img src="<?php echo base_url('assets/n-images/no-data.png') ?>"></p>
                            <p class="pt20">Oops No Data Found.</p>
                            <p class="">
                                <span>We couldn't find what you were looking for.
                                    <span>Make sure you used the right keywords.</span>
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="availabel-data-box">
                        <h3 class="border-bottom-none">Search result of "<?php echo $search_keyword ?>" </h3>
                    </div>
                    <div class="availabel-data-box">
                        <h3>Profiles </h3>
                        <div class="search-profiles">
                            <div class="profile-img">
                                <a href="#"><img src="n-images/user-pic.jpg"></a>
                            </div>
                            <div class="profile-data">
                                <p><a href="#">Profile Name</a></p>
                                <span>IT sector</span>
                                <span>Retailer</span>
                                <span>Ahmedabad, India</span>
                            </div>
                            <div class="profile-btns">
                                <a href="#" class="btn1">Following</a>
                                <a href="#" class="btn3">Message</a>
                                <a href="#" class="btn1">Add to contact</a>
                            </div>
                        </div>
                        <div class="search-profiles">
                            <div class="profile-img">
                                <a href="#"><img src="n-images/user-pic.jpg"></a>
                            </div>
                            <div class="profile-data">
                                <p><a href="#">Profile Name</a></p>
                                <span>IT sector</span>
                                <span>Retailer</span>
                                <span>Ahmedabad, India</span>
                            </div>
                            <div class="profile-btns">
                                <a href="#" class="btn1">Following</a>
                                <a href="#" class="btn3">Message</a>
                                <a href="#" class="btn1">Add to contact</a>
                            </div>
                        </div>
                    </div>
                    <div class="availabel-data-box">
                        <h3>Posts </h3>
                        <div class="p10">
                            <div class="all-post-box">
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
                                            <img src="img/img1.jpg">
                                        </div>
                                    </div>
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
        <!--  poup modal  -->
        <div style="display:none;" class="modal fade" id="post-popup1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <form>
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="img/user-pic.jpg">
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
                                <div class="post-box-bottom">
                                    <ul>
                                        <li>
                                            <a href="" data-target="#post-popup" data-toggle="modal">
                                                <img src="img/post-op.png"><span>Post Opportunity</span>
                                            </a>
                                        </li>
                                        <li class="pl15">
                                            <a href="article.html">
                                                <img src="img/article.png"><span>Post Article</span>
                                            </a>
                                        </li>
                                        <li class="pl15">
                                            <a href="" data-target="#ask-question" data-toggle="modal">
                                                <img src="img/ask-qustion.png"><span>Ask Quastion</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="pull-right">
                                        <button type="submit" class="btn1" value="Submit">Post</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="display:none;" class="modal fade" id="post-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <form>
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="img/user-pic.jpg">
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

                                <div id="content" class="form-group">
                                    <label>FOR WHOM THIS OPPORTUNITY ?<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <textarea rows="1" max-rows="5" placeholder="Ex:Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, PHP Developer, HR, BDE, CA, Doctor, Freelancer.." cols="10" style="resize:none"></textarea>

                                </div>
                                <div class="form-group">
                                    <label>WHICH LOCATION?<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <textarea type="text" class="" placeholder="Ex:Mumbai, Delhi, New south wels, London, New York, Captown, Sydeny, Shanghai, Moscow, Paris, Tokyo.. "></textarea>

                                </div>
                                <div class="form-group">
                                    <label>What is your field?<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <select>
                                        <option>What is your field</option>
                                        <option>IT</option>
                                        <option>Teacher</option>
                                        <option>Sports</option>
                                    </select>
                                </div>





                            </div>
                            <div class="text-right fw pt10 pb20 pr15">
                                <button type="submit" class="btn1"  value="Submit">Post</button> 
                            </div>
                        </form>
                    </div>



                </div>
            </div>

        </div>
        <div style="display:none;" class="modal fade" id="ask-question" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <form>
                            <div class="post-box">
                                <div class="post-img">
                                    <img src="img/user-pic.jpg">
                                </div>
                                <div class="post-text">
                                    <textarea class="title-text-area" placeholder="Ask Quastion"></textarea>
                                </div>
                                <div class="all-upload">
                                    <label for="file-1">
                                        <i class="fa fa-camera upload_icon"><span class="upload_span_icon"> Add Screenshot </span></i>
                                        <i class="fa fa fa-link upload_icon"><span class="upload_span_icon"> Add Link</span>  </i> 

                                    </label>
                                </div>

                            </div>
                            <div class="post-field">

                                <div class="form-group">
                                    <label>Add Description<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <textarea rows="1" max-rows="5" placeholder="Add Description" cols="10" style="resize:none"></textarea>

                                </div>
                                <div class="form-group">
                                    <label>Related Categories<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <input type="text" class="" placeholder="Related Categories">

                                </div>
                                <div class="form-group">
                                    <label>From which field the Question asked?<span class="pull-right"><img src="img/tooltip.png"></span></label>
                                    <select>
                                        <option>What is your field</option>
                                        <option>IT</option>
                                        <option>Teacher</option>
                                        <option>Sports</option>
                                    </select>
                                </div>





                            </div>
                            <div class="text-right fw pt10 pb20 pr15">
                                <button type="submit" class="btn1"  value="Submit">Post</button> 
                            </div>
                        </form>
                    </div>



                </div>
            </div>

        </div>
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
        <script>
                    $('#content').on('change keyup keydown paste cut', 'textarea', function () {
                        $(this).height(0).height(this.scrollHeight);
                    }).find('textarea').change();
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <script src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script src="<?php echo base_url('assets/js/ng-tags-input.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/angular/angular-tooltips.min.js?ver=' . time()); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
        <script>
                    var base_url = '<?php echo base_url(); ?>';
                    var user_slug = '<?php echo $this->uri->segment(2); ?>';
                    var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                    
                    var app = angular.module("searchApp", ['ngRoute', 'ui.bootstrap', 'ngTagsInput', 'ngSanitize']);
        </script>
        <script src="<?php echo base_url('assets/js/webpage/user/user_header_profile.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/user/user_search.js?ver=' . time()) ?>"></script>
    </body>
</html>