<!DOCTYPE html>
<html lang="en" ng-app="userProfileApp" ng-controller="userProfileController">
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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dragdrop/fileinput.css?ver=' . time()); ?>">
        <link href="<?php echo base_url('assets/dragdrop/themes/explorer/theme.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/as-videoplayer/build/mediaelementplayer.css?ver=' . time()); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/ng-tags-input.min.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-commen.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/n-css/n-style.css') ?>">
    </head>
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
                        <form id="post_something" name="post_something" ng-submit="post_something_check(event)">
                            <div class="post-box">
                                <div class="post-img">
                                    <?php if ($leftbox_data['user_image'] != '') { ?> 
                                        <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] . '?ver=' . time() ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                    <?php } else { ?>
                                        <img ng-src="<?php echo base_url(NOBUSIMAGE . '?ver=' . time()) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                    <?php } ?>
                                </div>
                                <div class="post-text">
                                    <textarea name="description" ng-model="sim.description" id="description" class="title-text-area" placeholder="Write something here..."></textarea>
                                </div>
                                <div class="all-upload">
                                    <div class="form-group">
                                        <input file-input="files" ng-file-model="sim.postfiles" type="file" id="fileInput1" name="postfiles[]" data-overwrite-initial="false" data-min-file-count="2"  multiple style="display: none;">
                                    </div>
                                    <label for="fileInput1" ng-click="postFiles()">
                                        <i class="fa fa-camera upload_icon"><span class="upload_span_icon"> Photo </span></i>
                                        <i class="fa fa-video-camera upload_icon"><span class="upload_span_icon"> Video</span>  </i> 
                                        <i class="fa fa-music upload_icon"> <span class="upload_span_icon">  Audio </span> </i>
                                        <i class="fa fa-file-pdf-o upload_icon"><span class="upload_span_icon"> PDF </span></i>
                                    </label>
                                </div>
                                <div class="post-box-bottom">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" data-target="#opportunity-popup" data-toggle="modal">
                                                <img src="<?php echo base_url('assets/n-images/post-op.png') ?>"><span>Post Opportunity</span>
                                            </a>
                                        </li>
                                        <li class="pl15">
                                            <a href="article.html">
                                                <img src="<?php echo base_url('assets/n-images/article.png') ?>"><span>Post Article</span>
                                            </a>
                                        </li>
                                        <li class="pl15">
                                            <a href="javascript:void(0);" data-target="#ask-question" data-toggle="modal">
                                                <img src="<?php echo base_url('assets/n-images/ask-qustion.png') ?>"><span>Ask Quastion</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="post_for" ng-model="sim.post_for" class="form-control" value="">
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
        <div style="display:none;" class="modal fade" id="opportunity-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">×</button>
                    <div class="post-popup-box">
                        <form id="post_opportunity" name="post_opportunity" ng-submit="post_opportunity_check(event)">
                            <div class="post-box">
                                <div class="post-img">
                                    <?php if ($leftbox_data['user_image'] != '') { ?> 
                                        <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] . '?ver=' . time() ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                    <?php } else { ?>
                                        <img ng-src="<?php echo base_url(NOBUSIMAGE . '?ver=' . time()) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                    <?php } ?>
                                </div>
                                <div class="post-text">
                                    <textarea name="description" ng-model="opp.description" id="description" class="title-text-area" placeholder="Post Opportunity"></textarea>
                                </div>
                                <div class="all-upload">
                                    <div class="form-group">
                                        <input file-input="files" ng-file-model="opp.postfiles" type="file" id="fileInput" name="postfiles[]" data-overwrite-initial="false" data-min-file-count="2"  multiple style="display: none;">
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
                                <div id="content" class="form-group">
                                    <label>FOR WHOM THIS OPPORTUNITY ?<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" tooltips tooltip-append-to-body="true" tooltip-close-button="true" tooltip-side="right" tooltip-hide-trigger="click" tooltip-template="I'm a tooltip that is kwjnefk jnkwjenfkjnk kjwnekjn kjwnekfjn kjwenfkjnkwjnekfjnwkejnf kjwnef bounded on body!" alt="tooltip"></span></label>
                                    <tags-input ng-model="opp.job_title" display-property="name" placeholder="Ex:Seeking Opportunity, CEO, Enterpreneur, Founder, Singer, Photographer, PHP Developer, HR, BDE, CA, Doctor, Freelancer.." replace-spaces-with-dashes="false" template="title-template" on-tag-added="onKeyup()">
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
                                    <label>WHICH LOCATION?<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" alt="tooltip"></span></label>
                                    <tags-input ng-model="opp.location" display-property="city_name" placeholder="Ex:Mumbai, Delhi, New south wels, London, New York, Captown, Sydeny, Shanghai, Moscow, Paris, Tokyo.." replace-spaces-with-dashes="false" template="location-template" on-tag-added="onKeyup()">
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
                                    <label>What is your field?<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" alt="tooltip"></span></label>
                                    <!--<input name="field" id="field" type="text" placeholder="What is your field?" autocomplete="off">-->
                                    <select name="field" ng-model="opp.field" id="field" ng-change="other_field(this)">
                                        <option value="" selected="selected">Select your field</option>
                                        <option data-ng-repeat='fieldItem in fieldList' value='{{fieldItem.industry_id}}'>{{fieldItem.industry_name}}</option>             
                                        <option value="0">Other</option>
                                    </select>
                                </div>
                                <div class="form-group" ng-if="field == '0'">
                                    <input type="text" class="form-control" ng-model="opp.otherField" placeholder="Enter other field" ng-required="true" autocomplete="off">
                                </div>
                                <input type="hidden" name="post_for" ng-model="opp.post_for" class="form-control" value="">
                            </div>
                            <div class="text-right fw pt10 pb20 pr15">
                                <button type="submit" class="btn1"  value="Submit">Post</button>    
                            </div>
                            <?php // echo form_close(); ?>
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
                                    <?php if ($leftbox_data['user_image'] != '') { ?> 
                                        <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] . '?ver=' . time() ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                    <?php } else { ?>
                                        <img ng-src="<?php echo base_url(NOBUSIMAGE . '?ver=' . time()) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                    <?php } ?>
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
                                    <label>Add Description<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" alt="tooltip"></span></label>
                                    <textarea rows="1" max-rows="5" placeholder="Add Description" cols="10" style="resize:none"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Related Categories<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" alt="tooltip"></span></label>
                                    <input type="text" class="" placeholder="Related Categories">
                                </div>
                                <div class="form-group">
                                    <label>From which field the Question asked?<span class="pull-right"><img ng-src="<?php echo base_url('assets/n-images/tooltip.png') ?>" alt="tooltip"></span></label>
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
        <div class="modal fade message-box" id="delete_model" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div class="pop_content">Do you want to delete this comment?<div class="model_ok_cancel"><a class="okbtn btn1" ng-click="deleteComment(c_d_comment_id, c_d_post_id, c_d_parent_index, c_d_index, c_d_post)" href="javascript:void(0);" data-dismiss="modal">Yes</a><a class="cnclbtn btn1" href="javascript:void(0);" data-dismiss="modal">No</a></div></div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box" id="delete_post_model" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div class="pop_content">Do you want to delete this post?<div class="model_ok_cancel"><a class="okbtn btn1" ng-click="deletedPost(p_d_post_id, p_d_index)" href="javascript:void(0);" data-dismiss="modal">Yes</a><a class="cnclbtn btn1" href="javascript:void(0);" data-dismiss="modal">No</a></div></div>
                        </span>
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
        <script src="<?php echo base_url('assets/js/angular/angular-tooltips.min.js?ver=' . time()); ?>"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
        <script>
                                var base_url = '<?php echo base_url(); ?>';
                                var user_slug = '<?php echo $this->uri->segment(2); ?>';
                                var user_id = '<?php echo $this->session->userdata('aileenuser'); ?>';
                                var item = '<?php echo $this->uri->segment(1); ?>';
                                var live_slug = '<?php echo $this->session->userdata('aileenuser_slug'); ?>';
                                var segment2 = '<?php echo $this->uri->segment(2); ?>';
                                var user_data_slug = '<?php echo $userdata['user_slug']; ?>';
                                var to_id = '<?php echo $to_id; ?>';
                                var contact_value = '<?php echo $contact_value; ?>';
                                var contact_status = '<?php echo $contact_status; ?>';
                                var contact_id = '<?php echo $contact_id; ?>';
                                var follow_value = '<?php echo $follow_value; ?>';
                                var follow_status = '<?php echo $follow_status; ?>';
                                var follow_id = '<?php echo $follow_id; ?>';
                                var is_userPostCount = '<?php echo $is_userPostCount; ?>';
                                
                                var app = angular.module("userProfileApp", ['ngRoute','ui.bootstrap', 'ngTagsInput', 'ngSanitize']);
        </script>
        <script src="<?php echo base_url('assets/js/webpage/user/user_profile.js?ver=' . time()) ?>"></script>
    </body>
</html>