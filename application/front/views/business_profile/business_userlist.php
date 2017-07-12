<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <?php echo $business_common; ?>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>User list</h3>
                                    <div class="contact-frnd-post">
                                        <?php foreach ($userlist as $user) { ?>
                                            <div class="job-contact-frnd ">
                                                <div class="profile-job-post-detail clearfix">
                                                    <div class="profile-job-post-title-inside clearfix">
                                                        <div class="profile-job-post-location-name">
                                                            <div class="user_lst"><ul>
                                                                    <li class="fl">
                                                                        <div class="follow-img">
                                                                            <?php if ($user['business_user_image'] != '') { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>">
                                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $user['business_user_image']); ?>" height="50px" width="50px" alt="" >
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>">
                                                                                    <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                                </a>
                                                                            <?php } ?> 
                                                                        </div>
                                                                    </li>
                                                                    <li class="folle_text">
                                                                        <div class="">
                                                                            <div class="follow-li-text " style="padding: 0;">
                                                                                <a title="<?php echo $user['company_name']; ?>" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>"><?php echo $user['company_name']; ?></a>
                                                                            </div>
                                                                            <div>
                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $user['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                                <a><?php
                                                                                    if ($category) {
                                                                                        echo $category;
                                                                                    } else {
                                                                                        echo $user['other_industrial'];
                                                                                    }
                                                                                    ?></a>
                                                                            </div>
                                                                    </li>
                                                                    <li class="<?php echo "fruser" . $user['business_profile_id']; ?> fr">
                                                                        <?php
                                                                        $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $user['business_profile_id']))->row()->follow_status;
                                                                        if ($status == 0 || $status == " ") {
                                                                            ?>
                                                                            <div id= "followdiv " class="user_btn">
                                                                                <button id="<?php echo "follow" . $user['business_profile_id']; ?>" onClick="followuser(<?php echo $user['business_profile_id']; ?>)">
                                                                                    Follow 
                                                                                </button></div>
                                                                        <?php } elseif ($status == 1) { ?>
                                                                            <div id= "unfollowdiv"  class="user_btn" > 
                                                                                <button class="bg_following" id="<?php echo "unfollow" . $user['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $user['business_profile_id']; ?>)">
                                                                                    Following 
                                                                                </button></div>
                                                                        <?php } ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="6">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- script for skill textbox automatic end (option 2)-->
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <!-- script for business autofill -->
        <script type="text/javascript">
            var data = '<?php echo json_encode($demo); ?>';
            var data1 = '<?php echo json_encode($city_data); ?>';
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/userlist.js'); ?>"></script>
    </body>
</html>