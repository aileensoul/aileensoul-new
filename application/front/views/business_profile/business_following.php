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
                        <div class="col-md-3"></div>
                        <div class="col-md-8 col-sm-8">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3> Following</h3>
                                    <div class="contact-frnd-post">
                                        <?php if (count($userlist) > 0) { ?>
                                            <?php foreach ($userlist as $user) { ?>
                                                <div class="job-contact-frnd" id="<?php echo "removefollow" . $user['follow_to']; ?>">
                                                    <div class="profile-job-post-detail clearfix">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-post-location-name">
                                                                <div class="user_lst">
                                                                    <ul>
                                                                        <li class="fl">
                                                                            <div class="follow-img">

                                                                            <?php 
                                                                    $companyname= $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->company_name; ?>
                                                                                <?php $slug = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->business_slug; ?>
                                                                                <?php if ($this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->business_user_image != '') { ?>


                            <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slug); ?>">
                                
                                 <?php 

                                 $uimage = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->business_user_image;

if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $uimage)) {
                                                                $a = $companyname;
                                                                $acr = substr($a, 0, 1);
                                                                ?>
                                                                <div class="post-img-userlist">
                                                                    <?php echo ucfirst(strtolower($acr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->business_user_image); ?>" height="50px" width="50px" alt="" >

                                <?php }?>
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slug); ?>">
                                                                                        <?php 
                                          $a = $companyname;
                                          $acr = substr($a, 0, 1);?>
                                            <div class="post-img-userlist">
                                            <?php echo  ucfirst(strtolower($acr))?>
                                            </div>
                                                                                    <?php } ?> 
                                                                            </div>
                                                                        </li>
                                                                        <li class="folle_text">
                                                                            <div class="">
                                                                                <div class="follow-li-text " style="padding: 0;">
                                                                                    <a title="" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slug); ?>"><?php echo $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to']))->row()->company_name; ?></a></div>
                                                                                <div>
                                                                                    <?php
                                                                                    $categoryid = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to'], 'status' => 1))->row()->industriyal;
                                                                                    $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
                                                                                    $othercategory = $this->db->get_where('business_profile', array('business_profile_id' => $user['follow_to'], 'status' => 1))->row()->other_industrial;
                                                                                    ?>
                                                                                    <a><?php
                                                                                        if ($category) {
                                                                                            echo $category;
                                                                                        } else {
                                                                                            echo $othercategory;
                                                                                        }
                                                                                        ?></a>
                                                                                </div>
                                                                        </li>
                                                                        <?php
                                                                        $userid = $this->session->userdata('aileenuser');
                                                                        if ($businessdata1[0]['user_id'] == $userid) {
                                                                            ?>
                                                                            <li class="fr <?php echo "fruser" . $user['follow_to']; ?>">
                                                                                <?php
                                                                                $contition_array = array('follow_from' => $businessdata1[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2, 'follow_to' => $user['follow_to']);
                                                                                $status = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                                                                                if ($status[0]['follow_status'] == 1) {
                                                                                    ?>
                                                                                    <div class="user_btn" id= "unfollowdiv">
                                                                                        <button class="bg_following" id="<?php echo "unfollow" . $user['follow_to']; ?>" onClick="unfollowuser_list(<?php echo $user['follow_to']; ?>)"><span>Following</span></button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </li>
                                                                        <?php } else { ?>
                                                                            <li class="fr">
                                                                                <?php
                                                                                $contition_array = array('user_id' => $userid, 'status' => '1');
                                                                                $busdatauser = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                $contition_array = array('follow_from' => $busdatauser[0]['business_profile_id'], 'follow_status' => 1, 'follow_type' => 2, 'follow_to' => $user['follow_to']);
                                                                                $status_list = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                                                                                if (($status_list[0]['follow_status'] == 0 || $status_list[0]['follow_status'] == ' ' ) && $user['follow_to'] != $busdatauser[0]['business_profile_id']) {
                                                                                    ?>
                                                                                    <div class="user_btn follow_btn_<?php echo $user['follow_to']; ?>" id= "followdiv">
                                                                                        <button id="<?php echo "follow" . $user['follow_to']; ?>" onClick="followuser_two(<?php echo $user['follow_to']; ?>)">Follow</button>
                                                                                    </div> 
                                                                                <?php } else if ($user['follow_to'] == $busdatauser[0]['business_profile_id']) { ?>
                                                                                <?php } else { ?>
                                                                                    <div class="user_btn_f follow_btn_<?php echo $user['follow_to']; ?>" id= "unfollowdiv">
                                                                                        <button id="<?php echo "unfollow" . $user['follow_to']; ?>" onClick="unfollowuser_two(<?php echo $user['follow_to']; ?>)"><span>Following</span></button>
                                                                                    </div>   
                                                                                <?php } ?>
                                                                            </li>
                                                                        <?php } ?> 
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="art-img-nn">
                                    <div class="art_no_post_img">

                                        <img src="<?php echo base_url('img/bui-no.png') ?>">

                                    </div>
                                    <div class="art_no_post_text">
                                        No Following Available.
                                    </div>
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
                                <input type="hidden" name="hitext" id="hitext" value="8">
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


        <!-- script for skill textbox automatic start (option 2)-->
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <!-- script for skill textbox automatic end (option 2)-->
        <!-- script for business autofill -->
        <script>
                                                                                            var base_url = '<?php echo base_url(); ?>';
                                                                                            var data = <?php echo json_encode($demo); ?>;
                                                                                            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/following.js'); ?>"></script>
    </body>
</html>