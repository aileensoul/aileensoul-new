<!DOCTYPE html>
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
                                    <h3> Followers</h3>
                                    <div class="contact-frnd-post">
                                        <?php
                                        if (count($userlist) > 0) {
                                            foreach ($userlist as $user) {
                                                ?>
                                                <div class="job-contact-frnd ">
                                                    <div class="profile-job-post-detail clearfix">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-post-location-name">
                                                                <div class="user_lst">
                                                                    <ul>
                                                                        <li class="fl">
                                                                            <div class="follow-img">
                                                                                <?php
                                                                                $followerimage = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_from']))->row()->business_user_image;

                                                                                $followername = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_from']))->row()->company_name;

                                                                                $followerslug = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_from']))->row()->business_slug;
                                                                                ?>
                                                                                <?php if ($followerimage != '') { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $followerslug); ?>">
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $followerimage); ?>" height="50px" width="50px" alt="" >
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $followerslug); ?>">
                                                                                         <?php 
                                          $a =  $followername;
                                          $acr = substr($a, 0, 1);?>
                                            <div class="post-img-userlist">
                                            <?php echo  ucwords($acr)?>
                                            </div>
                                            </a>
                                                                                <?php } ?> 
                                                                            </div>
                                                                        </li>
                                                                        <li class="folle_text">
                                                                            <div class="">
                                                                                <div class="follow-li-text " style="padding: 0;">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $followerslug); ?>"><?php echo ucwords($followername); ?></a></div>
                                                                                <div>
                                                                                    <?php
                                                                                    $categoryid = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_from'], 'status' => 1))->row()->industriyal;
                                                                                    $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
                                                                                    $othercategory = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_from'], 'status' => 1))->row()->other_industrial;
                                                                                    ?>
                                                                                    <a><?php
                                                                                        if ($category) {
                                                                                            echo $category;
                                                                                        } else {
                                                                                            echo $othercategory;
                                                                                        }
                                                                                        ?>
                                                                                    </a>
                                                                                </div>
                                                                        </li>
                                                                        <li class="fr" id ="<?php echo "frfollow" . $user['follow_from']; ?>">
                                                                            <?php
                                                                            $contition_array = array('user_id' => $userid, 'status' => '1');
                                                                            $busdatauser = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                            $contition_array = array('follow_from' => $busdatauser[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2, 'follow_to' => $user['follow_from']);
                                                                            $status_list = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                                                                            if (($status_list[0]['follow_status'] == 0 || $status_list[0]['follow_status'] == ' ' ) && $user['follow_from'] != $busdatauser[0]['business_profile_id']) {
                                                                                ?>
                                                                                <div class="user_btn follow_btn_<?php echo $user['follow_from']; ?>" id= "followdiv">
                                                                                    <button id="<?php echo "follow" . $user['follow_from']; ?>" onClick="followuser_two(<?php echo $user['follow_from']; ?>)">Follow</button>
                                                                                </div> 
                                                                            <?php } else if ($user['follow_from'] == $busdatauser[0]['business_profile_id']) { ?>
                                                                            <?php } else { ?>
                                                                                <div class="user_btn_f follow_btn_<?php echo $user['follow_from']; ?>" id= "unfollowdiv">
                                                                                    <button class="bg_following" id="<?php echo "unfollow" . $user['follow_from']; ?>" onClick="unfollowuser_two(<?php echo $user['follow_from']; ?>)"><span>Following</span></button>
                                                                                </div>   
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing">No Followers Found.</h4>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-1">
                                        </div>
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
                                <input type="hidden" name="hitext" id="hitext" value="7">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image"/>
                                </div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->

        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <!-- script for business autofill -->
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/followers.js'); ?>"></script>
    </body>
</html>