<div class="container pt15 main-dashboard">
    <div class="left-part">
        <div class="left-info-box">
            <div class="dash-left-title">
                <h3><i class="fa fa-info-circle"></i> Information</h3>
            </div>
            <table width="100%">
                <tr>
                    <td><i class="fa fa-user"></i></td><td> Prasant Dadhaniya</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user"></i></td><td> SEO Excutive</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user"></i></td><td> Ahmedabad</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user"></i></td><td> It Sector</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user"></i></td><td> 26-11-1990</td>
                </tr>

            </table>
        </div>
        <div class="media-box">
            <div class="dash-left-title">
                <h3><i class="fa fa-camera"></i> Photos</h3>
            </div>
            <div class="media-display">
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>

            </div>
        </div>
        <div class="media-box">
            <div class="dash-left-title">
                <h3><i class="fa fa-video-camera"></i> Video</h3>
            </div>
            <div class="media-display">
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg'); ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>


            </div>
        </div>
        <div class="media-box">
            <div class="dash-left-title">
                <h3><i class="fa fa-music"></i> Audio</h3>
            </div>
            <div class="media-display">
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>


            </div>
        </div>
        <div class="media-box">
            <div class="dash-left-title">
                <h3><i class="fa fa-file-pdf-o"></i> PDF</h3>
            </div>
            <div class="media-display">
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>
                <div class="all-meda">
                    <a href=""><img src="<?php echo base_url('assets/n-images/img1.jpg') ?>"></a>
                </div>


            </div>
        </div>
        <div class="block-1199 fw">
            <div class="add-box">
                <div class="adv-main-view">
                    <img src="<?php echo base_url('assets/n-images/add.jpg') ?>">
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
        <div class="add-post">
            <div class="post-box" data-target="#post-popup" data-toggle="modal">
                <div class="post-img">
                    <?php if ($leftbox_data['user_image'] != '') { ?> 
                        <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                    <?php } else { ?>
                        <img ng-src="<?php echo base_url(NOBUSIMAGE) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                    <?php } ?>
                </div>
                <div class="post-text">
                    Share an opportunity, Article
                </div>
                <!--<span class="post-cam"><i class="fa fa-camera"></i></span>-->
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
                <p class="pull-right">
                    <button type="submit" class="btn1" value="Submit">Post</button>
                </p>
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
        <div class="all_user_post">
            <div class="all-post-box" ng-repeat="post in postData">
                <input type="hidden" name="page_number" class="page_number" ng-class="page_number" ng-model="post.page_number" ng-value="{{post.page_data.page}}">
                <input type="hidden" name="total_record" class="total_record" ng-class="total_record" ng-model="post.total_record" ng-value="{{post.page_data.total_record}}">
                <input type="hidden" name="perpage_record" class="perpage_record" ng-class="perpage_record" ng-model="post.perpage_record" ng-value="{{post.page_data.perpage_record}}">
                <div class="all-post-top">
                    <div class="post-head">
                        <div class="post-img">
                            <img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{post.user_data.user_image}}" ng-if="post.user_data.user_image != ''">
                            <img ng-src="<?php echo NOBUSIMAGE2 ?>" ng-if="post.user_data.user_image == ''">
                        </div>
                        <div class="post-detail">
                            <div class="fw">
                                <a ng-href="<?php echo base_url('profiless/') ?>{{post.user_data.user_slug}}" class="post-name" ng-bind="post.user_data.fullname"></a><span class="post-time">7 hours ago</span>
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
                                <li><a href="javascript:void(0);">Edit Post</a></li>
                                <li><a href="javascript:void(0);" ng-click="deletePost(post.post_data.id, $index)">Delete Post</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post-discription" ng-if="post.post_data.post_for == 'opportunity'">
                        <h5 class="post-title">
                            <p ng-if="post.opportunity_data.opportunity_for"><b>Opportunity for:</b><span ng-bind="post.opportunity_data.opportunity_for"></span></p>
                            <p ng-if="post.opportunity_data.location"><b>Location:</b><span ng-bind="post.opportunity_data.location"></span></p>
                            <p ng-if="post.opportunity_data.field"><b>Field:</b><span ng-bind="post.opportunity_data.field"></span></p>
                        </h5>

                        <div class="post-des-detail" ng-if="post.opportunity_data.opportunity"><b>Opportunity:</b><span ng-bind="post.opportunity_data.opportunity"></span></div>
                    </div>
                    <div class="post-discription" ng-if="post.post_data.post_for == 'simple'">
                        <div class="post-des-detail" ng-if="post.simple_data.description"><span ng-bind-html="post.simple_data.description"></span></div>
                    </div>
                    <div class="post-images" ng-if="post.post_data.total_post_files == '1'">
                        <div class="one-img" ng-repeat="post_file in post.post_file_data" ng-init="$last ? loadMediaElement() : false">
                            <a href="#" ng-if="post_file.file_type == 'image'"><img ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" alt="{{post_file.filename}}"></a>
                            <span  ng-if="post_file.file_type == 'video'"> 
                                <video controls>
                                    <source ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" type="video/mp4">
                                </video>
                                <!--<video controls poster="" class="mejs__player" ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}"></video>-->
                            </span>
                            <span  ng-if="post_file.file_type == 'audio'">
                                <audio controls>
                                    <source ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" type="audio/mp3">
                                </audio>
                                <!--<audio controls ng-src="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}"></audio>-->
                            </span>
                            <a ng-href="<?php echo USER_POST_MAIN_UPLOAD_URL ?>{{post_file.filename}}" target="_blank" title="Click Here" ng-if="post_file.file_type == 'pdf'"><img ng-src="<?php echo base_url('assets/images/PDF.jpg?ver=' . time()) ?>"></a>
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
                                <span><a href="javascript:void(0);">View All (+4)</a></span>
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
                                    <li><a href="javascript:void(0);" ng-click="viewAllComment(post.post_data.id, $index, post)" ng-if="post.post_comment_data.length <= 1" id="comment-icon-{{post.post_data.id}}" class="last-comment"><i class="fa fa-comment-o"></i></a></li>
                                    <li><a href="javascript:void(0);" ng-click="viewLastComment(post.post_data.id, $index, post)" ng-if="post.post_comment_data.length > 1" id="comment-icon-{{post.post_data.id}}" class="all-comment"><i class="fa fa-comment-o"></i></a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <ul class="pull-right bottom-right">
                                    <li class="like-count"><span id="post-like-count-{{post.post_data.id}}" ng-bind="post.post_like_count"></span><span>Like</span></li>
                                    <li class="comment-count"><span class="post-comment-count-{{post.post_data.id}}" ng-bind="post.post_comment_count"></span><span>Comment</span></li>
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
                        <div class="post-comment" ng-repeat="comment in post.post_comment_data">
                            <div class="post-img">
                                <div class="post-img" ng-if="comment.user_image != ''">
                                    <img ng-src="<?php echo USER_THUMB_UPLOAD_URL ?>{{comment.user_image}}">
                                </div>
                                <div class="post-img" ng-if="comment.user_image == ''">
                                    <div class="post-img-mainuser">{{comment.first_name| limitTo:1 | uppercase}}{{comment.last_name| limitTo:1 | uppercase}}</div>
                                </div>
                            </div>
                            <div class="comment-dis">
                                <div class="comment-name"><a ng-bind="comment.username"></a></div>
                                <div class="comment-dis-inner" id="comment-dis-inner-{{comment.comment_id}}" ng-bind-html="comment.comment"></div>
                                <div class="edit-comment" id="edit-comment-{{comment.comment_id}}" style="display:none;">
                                    <div class="comment-input">
                                        <!--<div contenteditable data-directive ng-model="editComment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-change="isMsgBoxEmpty = false" class="editable_text" placeholder="Add a Comment ..." ng-enter="sendEditComment({{comment.comment_id}},$index,post)" id="editCommentTaxBox-{{comment.comment_id}}" ng-focus="setFocus" focus-me="setFocus" onpaste="OnPaste_StripFormatting(event);"></div>-->
                                        <div contenteditable data-directive ng-model="editComment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-change="isMsgBoxEmpty = false" class="editable_text" placeholder="Add a Comment ..." ng-enter="sendEditComment({{comment.comment_id}},$index,post)" id="editCommentTaxBox-{{comment.comment_id}}" ng-focus="setFocus" focus-me="setFocus" role="textbox" spellcheck="true" ng-paste="handlePaste($event)"></div>
                                    </div>
                                    <div class="comment-submit">
                                        <button class="btn2" ng-click="sendEditComment(comment.comment_id)">Comment</button>
                                    </div>
                                </div>
                                <ul class="comment-action">
                                    <li><a href="javascript:void(0);" ng-click="likePostComment(comment.comment_id, post.post_data.id)" ng-if="comment.is_userlikePostComment == '1'" class="like"><i class="fa fa-thumbs-up"></i><span ng-bind="comment.postCommentLikeCount" id="post-comment-like-{{comment.comment_id}}"></span></a></li>
                                    <li><a href="javascript:void(0);" ng-click="likePostComment(comment.comment_id, post.post_data.id)" ng-if="comment.is_userlikePostComment == '0'"><i class="fa fa-thumbs-up"></i><span ng-bind="comment.postCommentLikeCount" id="post-comment-like-{{comment.comment_id}}"></span></a></li>
                                    <li><a href="javascript:void(0);" ng-click="editPostComment(comment.comment_id, post.post_data.id, $parent.$index, $index)">Edit</a></li> 
                                    <li><a href="javascript:void(0);" ng-click="deletePostComment(comment.comment_id, post.post_data.id, $parent.$index, $index, post)">Delete</a></li>
                                    <li><a href="javascript:void(0);" ng-bind="comment.created_date"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="add-comment">
                            <div class="post-img">
                                <?php if ($leftbox_data['user_image'] != '') { ?> 
                                    <img ng-src="<?php echo USER_THUMB_UPLOAD_URL . $leftbox_data['user_image'] . '?ver=' . time() ?>" alt="<?php echo $leftbox_data['first_name'] ?>">  
                                <?php } else { ?>
                                    <img ng-src="<?php echo base_url(NOBUSIMAGE . '?ver=' . time()) ?>" alt="<?php echo $leftbox_data['first_name'] ?>">
                                <?php } ?>

                            </div>
                            <div class="comment-input">
                                <div contenteditable data-directive ng-model="comment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-change="isMsgBoxEmpty = false" class="editable_text" placeholder="Add a Comment ..." ng-enter="sendComment({{post.post_data.id}},$index,post)" id="commentTaxBox-{{post.post_data.id}}" ng-focus="setFocus" focus-me="setFocus" ng-paste="handlePaste($event)"></div>
                            </div>
                            <div class="comment-submit">
                                <button class="btn2" ng-click="sendComment(post.post_data.id, $index, post)">Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Repeated Class Complete -->
        <div class="fw" id="loader" style="text-align:center; display: block;"><img ng-src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) . '?ver=' . time() ?>" alt="Loader" /></div>
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