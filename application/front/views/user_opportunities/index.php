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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dragdrop/fileinput.css?ver=' . time()); ?>">
        <link href="<?php echo base_url('assets/dragdrop/themes/explorer/theme.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/ng-tags-input.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css?ver=' . time()) ?>">
        <style type="text/css">
            .progress-bar{
                background:linear-gradient(354deg,#1b8ab9 0,#1b8ab9 44%,#3bb0ac 100%)!important
            }
            .progress{
                position:relative;
                width:100%;
                border:1px solid #ddd;
                padding:1px;
                border-radius:3px;
                height:23px
            }
            .bar{
                background-color:#1b8ab9;
                width:0;
                height:20px;
                border-radius:3px
            }
            .percent{
                position:absolute;
                display:inline-block;
                top:3px;
                left:48%
            }
            .bs-example .sr-only{
                position:inherit;
                width:45px;
                height:20px
            }
        </style>
    </head>
    <body>
        <?php echo $header_profile; ?>
        <div class="middle-section">
            <div class="container">
                <?php echo $n_leftbar; ?>
                <div class="middle-part">
                    <div class="add-post">
                        <div class="post-box" data-target="#opportunity-popup" data-toggle="modal">
                            <div class="post-img">
                                <?php if ($leftbox_data['user_image'] != '') { ?> 
                                    <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                <?php } else { ?>
                                    <img ng-src="<?php echo base_url(NOBUSIMAGE) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                <?php } ?>
                            </div>
                            <div class="post-text">
                                Post Opportunity
                            </div>
                            <span class="post-cam"><i class="fa fa-camera"></i></span>
                        </div>
                    </div>
                    <div class="bs-example">
                        <div class="progress progress-striped" id="progress_div" style="display: none;">
                            <div class="progress-bar" style="width: 0%;">
                                <span class="sr-only">0%</span>
                            </div>
                        </div>
                    </div>
                    <!-- Repeated Class Start -->
                    <div class="all-post-box" ng-repeat="post in postData">
                        <div class="all-post-top">
                            <div class="post-head">
                                <div class="post-img">
                                    <img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{post.user_data.user_image}}" ng-if="post.user_data.user_image != ''">
                                    <img ng-src="<?php echo NOBUSIMAGE2 ?>" ng-if="post.user_data.user_image == ''">
                                </div>
                                <div class="post-detail">
                                    <div class="fw">
                                        <a href="#" class="post-name" ng-bind="post.user_data.fullname"></a><span class="post-time">7 hours ago</span>
                                    </div>
                                    <div class="fw">
                                        <span class="post-designation" ng-if="post.user_data.title_name != ''" ng-bind="post.user_data.title_name"></span>
                                        <span class="post-designation" ng-if="post.user_data.title_name == ''" ng-bind="post.user_data.degree_name"></span>
                                        <span class="post-designation" ng-if="post.user_data.title_name == null && post.user_data.degree_name == null" ng-bind="CURRENT WORK"></span>
                                    </div>
                                </div>
                                <div class="post-right-dropdown dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img ng-src="<?php echo base_url('assets/n-images/right-down.png') ?>" alt="Right Down"></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="post-discription">
                                <h5 class="post-title">
                                    <p ng-if="post.opportunity_data.opportunity_for"><b>Opportunity for:</b><span ng-bind="post.opportunity_data.opportunity_for"></span></p>
                                    <p ng-if="post.opportunity_data.location"><b>Location:</b><span ng-bind="post.opportunity_data.location"></span></p>
                                    <p ng-if="post.opportunity_data.field"><b>Field:</b><span ng-bind="post.opportunity_data.field"></span></p>
                                </h5>

                                <div class="post-des-detail" ng-if="post.opportunity_data.opportunity"><b>Opportunity:</b><span ng-bind="post.opportunity_data.opportunity"></span></div>
                            </div>
                            <div class="post-images" ng-if="post.post_data.total_post_files == '1'">
                                <div class="one-img" ng-repeat="post_file in post.post_file_data">
                                    <a href="#"><img ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                    <video ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'video'"></video>
                                    <audio ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'audio'"></audio>
                                    <a href="" title="Click Here"><img ng-src="<?php echo base_url('assets/') ?>n-images/img1.jpg" ng-if="post.post_file_data.file_type == 'pdf'"></a>
                                </div>
                            </div>
                            <div class="post-images" ng-if="post.post_data.total_post_files == '2'">
                                <div class="two-img" ng-repeat="post_file in post.post_file_data">
                                    <a href="#"><img ng-src="<?php echo USER_POST_RESIZE1_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                </div>
                            </div>
                            <div class="post-images" ng-if="post.post_data.total_post_files == '3'">
                                <span ng-repeat="post_file in post.post_file_data">
                                    <div class="three-img-top" ng-if="$index == '0'">
                                        <a href="#"><img ng-src="<?php echo USER_POST_RESIZE4_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                    </div>
                                    <div class="two-img" ng-if="$index == '1'">
                                        <a href="#"><img ng-src="<?php echo USER_POST_RESIZE1_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                    </div>
                                    <div class="two-img" ng-if="$index == '2'">
                                        <a href="#"><img ng-src="<?php echo USER_POST_RESIZE1_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                    </div>
                            </div>
                            </span>
                            <div class="post-images four-img" ng-if="post.post_data.total_post_files >= '4'">
                                <div class="two-img" ng-repeat="post_file in post.post_file_data | limitTo:4">
                                    <a href="#"><img ng-src="<?php echo USER_POST_RESIZE2_UPLOAD_URL ?>{{post_file.filename}}" ng-if="post_file.file_type == 'image'" alt="{{post_file.filename}}"></a>
                                    <div class="view-more-img" ng-if="$index == '3' && post.post_data.total_post_files > '4'">
                                        <span>View All (+4)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="post-bottom">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <ul class="bottom-left">
                                            <li>
                                                <a href="javascript:void(0)" id="post-like-{{post.post_data.id}}" ng-click="post_like(post.post_data.id)" ng-if="post.is_userlikePost == '1'" class="like"><i class="fa fa-thumbs-up"></i></a>
                                                <a href="javascript:void(0)" id="post-like-{{post.post_data.id}}" ng-click="post_like(post.post_data.id)" ng-if="post.is_userlikePost == '0'"><i class="fa fa-thumbs-up"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-comment-o"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <ul class="pull-right bottom-right">
                                            <li class="like-count"><span id="post-like-count-{{post.post_data.id}}" ng-bind="post.post_like_count"></span><span>Like</span></li>
                                            <li class="comment-count"><span class="post-comment-count">5</span><span>Comment</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                <div class="like-other-box">
                                    <a href="#" ng-bind="post.post_like_data" id="post-other-like-{{post.post_data.id}}"></a>
                            </div>
                        </div>
                        <div class="all-post-bottom">
                            <div class="comment-box">
                                <div class="post-comment">
                                    <div class="post-img">
                                        <img ng-src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
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

                                <div class="add-comment">
                                    <div class="post-img">
                                        <img ng-src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                    </div>
                                    <div class="comment-input">
                                        <div contenteditable data-directive ng-model="comment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-change="isMsgBoxEmpty = false" class="editable_text" placeholder="Add a Comment ..." ng-enter="sendComment({{post.post_data.id}})" id="commentTaxBox-{{post.post_data.id}}" ng-focus="setFocus" focus-me="setFocus"></div>
                                    </div>
                                    <div class="comment-submit">
                                        <button class="btn2" ng-click="sendComment(post.post_data.id)">Comment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Repeated Class Complete -->

                </div>

                <div class="right-part">
                    <div class="add-box">
                        <img ng-src="<?php echo base_url('assets/n-images/add.jpg') ?>">
                    </div>
                    <div class="all-contact">
                        <h4>Contacts<a href="#" class="pull-right">All</a></h4>
                        <div class="all-user-list">
                            <data-owl-carousel class="owl-carousel" data-options="">
                                <div owl-carousel-item="" ng-repeat="contact in contactSuggetion" class="item">
                                    <div class="item" id="item-{{contact.user_id}}">
                                        <div class="post-img" ng-if="contact.user_image != ''">
                                            <img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{contact.user_image}}">
                                        </div>
                                        <div class="post-img" ng-if="contact.user_image == ''">
                                            <div class="post-img-mainuser">{{contact.first_name| limitTo:1 | uppercase}}{{contact.last_name| limitTo:1 | uppercase}}</div>
                                        </div>
                                        <div class="user-list-detail">
                                            <p class="contact-name"><a href="#" ng-bind="(contact.first_name | limitTo:1 | uppercase) + (contact.first_name.substr(1) | lowercase)"></a></p>
                                            <p class="contact-designation">
                                                <a href="#" ng-if="contact.title_name != ''">{{contact.title_name| uppercase}}</a>
                                                <a href="#" ng-if="contact.title_name == ''">{{contact.degree_name| uppercase}}</a>
                                                <a href="#" ng-if="contact.title_name == null && contact.degree_name == null">CURRENT WORK</a>
                                            </p>
                                        </div>
                                        <button class="follow-btn" ng-click="addToContact(contact.user_id, contact)">Add to contact</button>
                                    </div>
                                </div>
                            </data-owl-carousel>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:none;" class="modal fade" id="opportunity-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <?php echo form_open_multipart(base_url('user_opportunities/post_opportunity'), array('id' => 'post_opportunity', 'name' => 'post_opportunity', 'ng-submit' => "post_opportunity_check(event)")); ?>
                        <div class="post-box">
                            <div class="post-img">
                                <?php if ($leftbox_data['user_image'] != '') { ?> 
                                    <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] . '?ver=' . time() ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                <?php } else { ?>
                                    <img ng-src="<?php echo base_url(NOBUSIMAGE . '?ver=' . time()) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                <?php } ?>
                            </div>
                            <div class="post-text">
                                <textarea name="description" ng-model="description" id="description" class="title-text-area" placeholder="Post Opportunity"></textarea>
                            </div>
                            <div class="all-upload">
                                <div class="form-group">
                                    <input file-input type="file" ng-model="fileInput" id="fileInput" name="postfiles[]" data-overwrite-initial="false" data-min-file-count="2"  multiple style="display: none;">
                                </div>
                                <label for="fileInput" ng-click="postFiles()">
                                    <i class="fa fa-camera upload_icon"><span class="upload_span_icon"> Photo </span></i>
                                    <i class="fa fa-video-camera upload_icon"><span class="upload_span_icon"> Video</span>  </i> 
                                    <i class="fa fa-music upload_icon"> <span class="upload_span_icon">  Audio </span> </i>
                                    <i class="fa fa-file-pdf-o upload_icon"><span class="upload_span_icon"> PDF </span></i>
                                </label>
                            </div>
                        </div>
                        <div class="post-field">
                            <div class="form-group">
                                <tags-input ng-model="job_title" display-property="name" placeholder="FOR WHOM THIS OPPORTUNITY?" replace-spaces-with-dashes="false" template="title-template" on-tag-added="onKeyup()">
                                    <auto-complete source="loadJobTitle($query)" min-length="0" load-on-focus="false" load-on-empty="false" max-results-to-show="32" template="title-autocomplete-template"></auto-complete>
                                </tags-input>
                                <script type="text/ng-template" id="title-template">
                                    <div class="tag-template"><div class="right-panel"><span>{{$getDisplayText()}}</span><a class="remove-button" ng-click="$removeTag()">&#10006;</a></div></div>
                                </script>
                                <script type="text/ng-template" id="title-autocomplete-template">
                                    <div class="autocomplete-template"><div class="right-panel"><span ng-bind-html="$highlight($getDisplayText())"></span></div></div>
                                </script>
                            </div>

                            <div class="form-group">
                                <tags-input ng-model="location" display-property="city_name" placeholder="WHICH LOCATION?" replace-spaces-with-dashes="false" template="location-template" on-tag-added="onKeyup()">
                                    <auto-complete source="loadLocation($query)" min-length="0" load-on-focus="false" load-on-empty="false" max-results-to-show="32" template="location-autocomplete-template"></auto-complete>
                                </tags-input>
                                <script type="text/ng-template" id="location-template">
                                    <div class="tag-template"><div class="right-panel"><span>{{$getDisplayText()}}</span><a class="remove-button" ng-click="$removeTag()">&#10006;</a></div></div>
                                </script>
                                <script type="text/ng-template" id="location-autocomplete-template">
                                    <div class="autocomplete-template"><div class="right-panel"><span ng-bind-html="$highlight($getDisplayText())"></span></div></div>
                                </script>
                            </div>
                            <div class="form-group">
                                <!--<input name="field" id="field" type="text" placeholder="What is your field?" autocomplete="off">-->
                                <select name="field" ng-model="field" id="field" ng-change="other_field(this)">
                                    <option value="" selected="selected">Select your field</option>
                                    <option data-ng-repeat='fieldItem in fieldList' value='{{fieldItem.industry_id}}'>{{fieldItem.industry_name}}</option>             
                                    <option value="0">Other</option>
                                </select>
                            </div>
                            <div class="form-group" ng-if="field == '0'">
                                <input type="text" class="form-control" ng-model="otherField" placeholder="Enter other field" ng-required="true" autocomplete="off">
                            </div>
                        </div>
                        <div class="text-right fw pt10">
                            <button type="submit" class="btn1"  value="Submit">Post</button>    
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box biderror" id="posterrormodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="posterror-modal-close" data-dismiss="modal">&times;
                    </button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box" id="post" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('assets/js/jquery.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/owl.carousel.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.form.3.51.js?ver=' . time()) ?>"></script> 
        <script src="<?php echo base_url('assets/dragdrop/js/plugins/sortable.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/fileinput.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/locales/fr.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/js/locales/es.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/dragdrop/themes/explorer/theme.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/as-videoplayer/build/mediaelement-and-player.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/as-videoplayer/demo.js?ver=' . time()); ?>"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script data-semver="0.13.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
        <script src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
        <script src="<?php echo base_url('assets/js/ng-tags-input.min.js?ver=' . time()); ?>"></script>

        <script>
                                    var base_url = '<?php echo base_url(); ?>';
                                    var slug = '<?php echo $slugid; ?>';
                                    var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                    var title = '<?php echo $title; ?>';
                                    var app = angular.module('userOppoApp', ['ui.bootstrap', 'ngTagsInput']);
        </script>

        <script src="<?php echo base_url('assets/js/webpage/user/user_opportunity.js?ver=' . time()) ?>"></script>
    </body>
</html>