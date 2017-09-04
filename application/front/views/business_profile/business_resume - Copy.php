<!-- START HEAD -->
<style type="text/css">
    #popup-form img{display: none;}
</style>
<?php echo $head; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<!-- END HEAD -->
<!-- START HEADER -->
<?php echo $header; ?>
<!-- END HEADER -->
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<?php echo $business_header2_border ?>
<body class="page-container-bg-solid page-boxed">
    <section>
        <div class="container" id="paddingtop_fixed">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo" ></div>
                </div>
                <div class="col-md-12 cover-pic" >
                    <button class="btn btn-success cancel-result" onclick="">Cancel</button>
                    <button class="btn btn-success upload-result fr" onclick="myFunction()">Save</button>
                    <div id="message1" style="display:none;">
                        <div id="floatBarsG">
                            <div id="floatBarsG_1" class="floatBarsG"></div>
                            <div id="floatBarsG_2" class="floatBarsG"></div>
                            <div id="floatBarsG_3" class="floatBarsG"></div>
                            <div id="floatBarsG_4" class="floatBarsG"></div>
                            <div id="floatBarsG_5" class="floatBarsG"></div>
                            <div id="floatBarsG_6" class="floatBarsG"></div>
                            <div id="floatBarsG_7" class="floatBarsG"></div>
                            <div id="floatBarsG_8" class="floatBarsG"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"  style="visibility: hidden; ">
                    <div id="upload-demo-i"></div>
                </div>
            </div>
            <div class="container">
                <div class="row" id="row2">
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($this->uri->segment(3) == $userid) {
                        $user_id = $userid;
                    } elseif ($this->uri->segment(3) == "") {
                        $user_id = $userid;
                    } else {
                        $user_id = $this->db->get_where('business_profile', array('business_slug' => $this->uri->segment(3)))->row()->user_id;
                    }
                    $contition_array = array('user_id' => $user_id, 'is_deleted' => '0', 'status' => '1');
                    $image = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                    $image_ori = $image[0]['profile_background'];
                    if ($image_ori) {
                        ?>
                        <img src="<?php echo base_url($this->config->item('bus_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                        <?php
                    } else {
                        ?>
                             <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                         <?php }
                         ?>
                </div>
            </div>
        </div>
    </div>
</div>   
<div class="container tablate-container">
    <?php
    $userid = $this->session->userdata('aileenuser');
    if ($businessdata1[0]['user_id'] == $userid) {
        ?>
        <div class="upload-img">
            <label class="cameraButton"> <span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
            </label>
        </div>
    <?php } ?>
    <!-- coer image end-->
    <div class="profile-photo">
        <div class="buisness-menu">
            <div class="profile-pho-bui">
                <div class="user-pic">
                    <?php if ($businessdata1[0]['business_user_image'] != '') { ?>
                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata1[0]['business_user_image']); ?>" alt="" >
                    <?php } else { ?>
                        <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                    <?php } ?>
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($businessdata1[0]['user_id'] == $userid) {
                        ?>                                                                                                                        <!-- <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a> -->
                        <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                    <?php } ?>
                </div>
            </div>
            <div class="business-profile-right">
                <div class="bui-menu-profile">
                    <h4 class="profile-head-text"><a href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug'] . ''); ?>"> <?php echo ucwords($businessdata1[0]['company_name']); ?></a></h4>
                    <h4 class="profile-head-text_dg"><a href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug'] . ''); ?>"> 
                            <?php
                            if ($businessdata1[0]['industriyal']) {
                                echo $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                            }
                            if ($businessdata1[0]['other_industrial']) {
                                echo ucwords($businessdata1[0]['other_industrial']);
                            }
                            ?>
                        </a></h4>
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($businessdata1[0]['user_id'] != $userid) {
                        ?> 
                        <div id="contact_per">
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            $busotherid = $this->uri->segment(3);
                            $contition_array = array('business_slug' => $busotherid, 'status' => '1');
                            $busineslug = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                            $busuid = $busineslug[0]['user_id'];

                            $contition_array = array('contact_type' => 2);
                            $search_condition = "((contact_to_id = '$busuid' AND contact_from_id = ' $userid') OR (contact_from_id = '$busuid' AND contact_to_id = '$userid'))";
                            $contactperson = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');
                            ?>

                            <?php if ($contactperson[0]['status'] == 'cancel' || $contactperson[0]['status'] == '' || $contactperson[0]['status'] == 'reject') { ?>
                                <a href="#" onclick="return contact_person(<?php echo $businessdata1[0]['user_id']; ?>);" style="cursor: pointer;">

                                <?php } elseif ($contactperson[0]['status'] == 'pending' || $contactperson[0]['status'] == 'confirm') { ?>   
                                    <a onclick="return contact_person_model(<?php echo $businessdata1[0]['user_id']; ?>,<?php echo "'" . $contactperson[0]['status'] . "'"; ?>)" style="cursor: pointer;">
                                    <?php } ?>
                                    <div class="">
                                        <div id="ripple" class="centered" >
                                            <div class="circle"><span href="" class="add_r_c"><i class="fa fa-user-plus"  aria-hidden="true"></i></span></div>
                                        </div>
                                        <div class="addtocont">
                                            <span class="ft-13"><i class="icon-user"></i>
                                                <?php if ($contactperson[0]['status'] == 'cancel') { ?> Add to contact <?php } elseif ($contactperson[0]['status'] == 'pending') {
                                                    ?> Cancel request <?php } elseif ($contactperson[0]['status'] == 'confirm') {
                                                    ?> In your contact <?php } elseif ($contactperson[0]['status'] == 'reject') {
                                                    ?> Add to contact <?php } else {
                                                    ?> Add to contact <?php } ?>                            
                                            </span>
                                        </div>
                                    </div>
                                </a>
                        </div>
                    <?php } ?>
                </div>
                <!-- PICKUP -->
                <!-- menubar -->
                <div class="business-data-menu padding_less_right ">
                    <div class="profile-main-box-buis-menu">  
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($businessdata1[0]['user_id'] == $userid) {
                            ?>     
                            <ul class="current-user bpro-fw6">
                            <?php } else { ?>
                                <ul class="bpro-fw">
                                <?php } ?>  
                                <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'dashboard') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('business-profile/dashboard/' . $businessdata1[0]['business_slug']); ?>">Dashboard</a></li>
                                <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'details') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug']); ?>"> Details</a></li>
                                <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'contacts') { ?> class="active" <?php } ?>><a title="Contacts" href="<?php echo base_url('business-profile/contacts/' . $businessdata1[0]['business_slug']); ?>"> Contacts</a></li>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('business-profile/userlist/' . $businessdata1[0]['business_slug']); ?>">Userlist</a></li>
                                <?php } ?>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business-profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($businessfollowerdata)); ?>)</a></li>
                                    <?php
                                } else {
                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_to' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business-profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($followerotherdata)); ?>)</a></li>
                                <?php } ?>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?>          
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business-profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($businessfollowingdata)); ?>)</a>
                                    </li>
                                    <?php
                                } else {
                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_from' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?>
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business-profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($businessdata1[0]['user_id'] != $userid) {
                                ?>
                                <div class="flw_msg_btn fr top_follow">
                                    <ul>
                                        <li>
                                            <div class="<?php echo "fr" . $businessdata1[0]['business_profile_id']; ?>">
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                $contition_array = array('user_id' => $userid, 'status' => '1');
                                                $bup_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $bup_id[0]['business_profile_id'], 'follow_to' => $businessdata1[0]['business_profile_id']))->row()->follow_status;
                                                $logslug = $this->db->get_where('business_profile', array('user_id' => $userid))->row()->business_slug;
                                                if ($logslug != $this->uri->segment(3)) {
                                                    if ($status == 0 || $status == " ") {
                                                        ?>
                                                        <div class="msg_flw_btn_1" id= "followdiv">
                                                            <button id="<?php echo "follow" . $businessdata1[0]['business_profile_id']; ?>" onClick="followuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Follow</button>
                                                        </div>
                                                    <?php } elseif ($status == 1) { ?>
                                                        <div class="msg_flw_btn_1" id= "unfollowdiv">
                                                            <button class="bg_following"  id="<?php echo "unfollow" . $businessdata1[0]['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Following </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>         
                                            </li>
                                            <li>
                                                <a  href="<?php echo base_url('chat/abc/' . $businessdata1[0]['user_id']); ?>">Message</a></li>
                                        <?php } ?>
                                    </ul>   
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
            <!-- pickup -->
        </div>
    </div>
</div>
</div>
</div>
<div class="user-midd-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="width: 22%;"></div>
            <div class="col-md-7 col-sm-7">
                <div class="common-form">
                    <div class="job-saved-box">
                        <h3>Details </h3> 
                        <div class=" fr rec-edit-pro">
                            <?php

                            function text2link($text) {
                                $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                return $text;
                            }
                            ?>      
                        </div> 
                        <div class="contact-frnd-post">
                            <div class="job-contact-frnd ">
                                <div class="profile-job-post-detail clearfix">
                                    <div class="profile-job-post-title clearfix">
                                        <div class="profile-job-profile-button clearfix">
                                            <div class="profile-job-details">
                                                <ul>
                                                    <li>
                                                        <p class="details_all_tital"> Basic Information</p> 
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="profile-job-profile-menu">
                                            <ul class="clearfix">
                                                <li> <b>Comapny Name</b> <span> <?php echo $businessdata1[0]['company_name']; ?> </span></li>
                                                <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $businessdata1[0]['country']))->row()->country_name; ?> </span></li>
                                                <li> <b>State</b>
                                                    <span> <?php echo $this->db->get_where('states', array('state_id' => $businessdata1[0]['state']))->row()->state_name; ?> </span>
                                                </li>
                                                <?php
                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                    if ($businessdata1[0]['city']) {
                                                        ?>
                                                        <li><b> City</b> 
                                                            <span><?php echo $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name; ?></span> 
                                                        </li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><b> City</b> <span>
                                                                <?php echo PROFILENA; ?>
                                                            </span> </li>
                                                        <?php
                                                    }
                                                } else {
                                                    if ($businessdata1[0]['city']) {
                                                        ?>
                                                        <li><b> City</b> <span><?php
                                                                echo
                                                                $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name;
                                                                ?></span> </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                    if ($businessdata1[0]['pincode']) {
                                                        ?>
                                                        <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span> </li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li><b> Pincode:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                        <?php
                                                    }
                                                } else {
                                                    if ($businessdata1[0]['pincode']) {
                                                        ?>
                                                        <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li> <b>Postal Address</b><span> <?php echo $businessdata1[0]['address']; ?> </span></li>
                                            </ul>
                                        </div>
                                        <div class="profile-job-post-title clearfix">
                                            <div class="profile-job-profile-button clearfix">
                                                <div class="profile-job-details">
                                                    <ul>
                                                        <li>
                                                            <p class="details_all_tital"> Contact Information</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-profile-menu">
                                                <ul class="clearfix">
                                                    <li> <b> Contact Person</b> <span> <?php echo $businessdata1[0]['contact_person']; ?> </span>
                                                    </li>
                                                    <?php
                                                    if ($businessdata1[0]['user_id'] == $userid) {
                                                        if ($businessdata1[0]['contact_mobile']) {
                                                            ?>
                                                            <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b> Contact Mobile </b> <span><?php echo PROFILENA; ?></span> </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($businessdata1[0]['contact_mobile']) {
                                                            ?>
                                                            <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <li><b> Contact Email</b> <span><?php echo $businessdata1[0]['contact_email']; ?></span> </li>
                                                    <?php
                                                    if ($businessdata1[0]['user_id'] == $userid) {
                                                        if ($businessdata1[0]['contact_website']) {
                                                            ?>
                                                            <li> <b>Contact Website</b><span>
                                                                    <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
                                                            </li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b> Contact Website:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($businessdata1[0]['contact_website']) {
                                                            ?>
                                                            <li> <b>Contact Website</b><span>
                                                                      <!--<a href="https://<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $this->common->make_links($businessdata1[0]['contact_website']); ?></a></span>-->
                                                                    <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="profile-job-post-title clearfix">
                                            <div class="profile-job-profile-button clearfix">
                                                <div class="profile-job-details">
                                                    <ul>
                                                        <li>
                                                            <p class="details_all_tital">Professional Information</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-profile-menu">
                                                <ul class="clearfix">
                                                    <li> <b>Buisness  Type </b> <span><?php
                                                            $business_typename = $this->db->get_where('business_type', array('type_id' => $businessdata1[0]['business_type']))->row()->business_name;
                                                            if ($business_typename) {
                                                                echo $business_typename;
                                                            } else {
                                                                echo $businessdata1[0]['other_business_type'];
                                                            }
                                                            ?></span>
                                                    </li>
                                                    <li> <b>Category</b><span><?php
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                                                            if ($category) {
                                                                echo $category;
                                                            } else {
                                                                echo $businessdata1[0]['other_industrial'];
                                                            }
                                                            ?></span>
                                                    </li>
                                                    <li><b>Details Of Your buisness </b> 
                                                        <span>
                                                            <p> <?php echo $this->common->make_links($businessdata1[0]['details']);
                                                            ?></p>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> 
                                        <div class="profile-job-post-title clearfix">
                                            <div class="profile-job-profile-button clearfix">
                                                <div class="profile-job-details">
                                                    <ul>
                                                        <li><p class="details_all_tital"> Images</p> </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-profile-menu">
                                                <div  class="buisness-profile-pic">
                                                    <?php
                                                    if (count($busimagedata) > 0) {
                                                        if (count($busimagedata) > 3) {
                                                            $i = 1;
                                                            $k = 1;
                                                            foreach ($busimagedata as $image) {
                                                                if ($i <= 2) {
                                                                    ?>
                                                                    <div class="column1">
                                                                        <div class="bui_res_i">          
                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal();currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="column1">
                                                                        <div class="bui_res_i">  
                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal();currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                            <div class="view_bui"> 
                                                                                <a id="myBtn">view all</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                } $i++;
                                                                $k++;
                                                                if ($i == 4) {
                                                                    break;
                                                                }
                                                            }
                                                        } else {
                                                            $i = 1;
                                                            $k = 1;
                                                            foreach ($busimagedata as $image) {
                                                                if ($i <= 2) {
                                                                    ?>
                                                                    <div class="column1">
                                                                        <div class="bui_res_i">          <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="column1">
                                                                        <div class="bui_res_i">  
                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal();currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                            <div class="view_bui"> <a >view all</a></div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                } $i++;
                                                                $k++;
                                                                if ($i == 4) {
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <span style="padding: 8px;"><h7>No Image Available</h7> <a href="<?php echo base_url('business_profile/image') ?>">Add Images</a> </span>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="modal fade modal_popup" id="myModal" role="dialog" style="z-index: 1003">
                                                        <div class="modal-dialog" style="width: 88%;">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Images</h4>
                                                                </div>
                                                                <div class="modal-body popup-img-popup">
                                                                    <div>
                                                                        <?php
                                                                        $j = 1;
                                                                        foreach ($busimagedata as $imagemul) {
                                                                            ?>
                                                                            <div class="bui_popup_img"> 
                                                                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $imagemul['image_name']); ?>"  onclick="openModal();currentSlide(<?php echo $j; ?>)" class="hover-shadow cursor">   </div> 
                                                                            <?php
                                                                            $j++;
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="myModal1" class="modal2" style="padding-top: 7%;">
                                                        <div class="modal-content2"> 
                                                            <span class="close2 cursor" onclick="closeModal()">&times;</span>  
                                                            <?php
                                                            $i = 1;
                                                            foreach ($busimagedata as $image) {
                                                                ?>
                                                                <div class="mySlides">
                                                                    <div class="numbertext"><?php echo $i ?> / <?php echo count($busimagedata); ?></div>
                                                                    <div class="slider_img">
                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_main_upload_path') . $image['image_name']); ?> " >
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $i++;
                                                            }
                                                            ?>
                                                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                                            <div class="caption-container">
                                                                <p id="caption"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
            <footer>
                <footer>
                    <?php echo $footer; ?>
                </footer>
                <!-- Bid-modal  -->
                <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                    <div class="modal-dialog modal-lm">
                        <div class="modal-content">
                            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                            <div class="modal-body">
                                <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
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
                                        <input type="hidden" name="hitext" id="hitext" value="4">
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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
                <!-- script for skill textbox automatic end (option 2)-->
                <!-- script for business autofill -->
                <script>

                                                                var data = <?php echo json_encode($demo); ?>;
                                                                $(function () {
                                                                    $("#tags").autocomplete({
                                                                        source: function (request, response) {
                                                                            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                            response($.grep(data, function (item) {
                                                                                return matcher.test(item.label);
                                                                            }));
                                                                        },
                                                                        minLength: 1,
                                                                        select: function (event, ui) {
                                                                            event.preventDefault();
                                                                            $("#tags").val(ui.item.label);
                                                                            $("#selected-tag").val(ui.item.label);
                                                                            // window.location.href = ui.item.value;
                                                                        }
                                                                        ,
                                                                        focus: function (event, ui) {
                                                                            event.preventDefault();
                                                                            $("#tags").val(ui.item.label);
                                                                        }
                                                                    });
                                                                });

                </script>


                <script>

                    var data1 = <?php echo json_encode($city_data); ?>;
                    $(function () {
                        $("#searchplace").autocomplete({
                            source: function (request, response) {
                                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                response($.grep(data1, function (item) {
                                    return matcher.test(item.label);
                                }));
                            },
                            minLength: 1,
                            select: function (event, ui) {
                                event.preventDefault();
                                $("#searchplace").val(ui.item.label);
                                $("#selected-tag").val(ui.item.label);
                                // window.location.href = ui.item.value;
                            }
                            ,
                            focus: function (event, ui) {
                                event.preventDefault();
                                $("#searchplace").val(ui.item.label);
                            }
                        });
                    });

                </script>
                <script type="text/javascript">
                    function checkvalue() {
                        var searchkeyword = $.trim(document.getElementById('tags').value);
                        var searchplace = $.trim(document.getElementById('searchplace').value);
                        if (searchkeyword == "" && searchplace == "") {
                            return false;
                        }
                    }
                </script>
                <!-- end of business search auto fill -->
                <script type="text/javascript">
                    function updateprofilepopup(id) {
                        $('#bidmodal-2').modal('show');
                    }

                    //select2 autocomplete start for Location
                    $('#searchplace').select2({
                        placeholder: 'Find Your Location',
                        maximumSelectionLength: 1,
                        ajax: {
                            url: "<?php echo base_url(); ?>business_profile/location",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    results: data
                                };
                            },
                            cache: true
                        }
                    });
                    /* select2 autocomplete End for Location */
                    /* cover image start */
                    function myFunction() {
                        document.getElementById("upload-demo").style.visibility = "hidden";
                        document.getElementById("upload-demo-i").style.visibility = "hidden";
                        document.getElementById('message1').style.display = "block";
                    }
                    function showDiv() {
                        document.getElementById('row1').style.display = "block";
                        document.getElementById('row2').style.display = "none";
                    }

                    $uploadCrop = $('#upload-demo').croppie({
                        enableExif: true,
                        viewport: {
                            width: 1250,
                            height: 350,
                            type: 'square'
                        },
                        boundary: {
                            width: 1250,
                            height: 350
                        }
                    });
                    $('.upload-result').on('click', function (ev) {
                        $uploadCrop.croppie('result', {
                            type: 'canvas',
                            size: 'viewport'
                        }).then(function (resp) {

                            $.ajax({
                                url: "<?php echo base_url() ?>business_profile/ajaxpro",
                                type: "POST",
                                data: {"image": resp},
                                success: function (data) {
                                    html = '<img src="' + resp + '" />';
                                    if (html)
                                    {
                                        window.location.reload();
                                    }
                                }
                            });
                        });
                    });
                    $('.cancel-result').on('click', function (ev) {
                        document.getElementById('row2').style.display = "block";
                        document.getElementById('row1').style.display = "none";
                        document.getElementById('message1').style.display = "none";
                    });

                    $('#upload').on('change', function () {

                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $uploadCrop.croppie('bind', {
                                url: e.target.result
                            }).then(function () {
                                console.log('jQuery bind complete');
                            });

                        }
                        reader.readAsDataURL(this.files[0]);
                    });
                    $('#upload').on('change', function () {

                        var fd = new FormData();
                        fd.append("image", $("#upload")[0].files[0]);

                        files = this.files;
                        size = files[0].size;
                        // pallavi code start for file type support
                        if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                            picpopup();
                            document.getElementById('row1').style.display = "none";
                            document.getElementById('row2').style.display = "block";
                            $("#upload").val('');
                            return false;
                        }
                        // file type code end
                        if (size > 4194304)
                        {
                            //show an alert to the user
                            alert("Allowed file size exceeded. (Max. 4 MB)")
                            document.getElementById('row1').style.display = "none";
                            document.getElementById('row2').style.display = "block";
                            //reset file upload control
                            return false;
                        }
                        $.ajax({
                            url: "<?php echo base_url(); ?>business_profile/imagedata",
                            type: "POST",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                            }
                        });
                    });
                    /* cover image end */

                    /* follow user script start */
                    function followuser(clicked_id)
                    {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url() . "business_profile/follow" ?>',
                            data: 'follow_to=' + clicked_id,
                            success: function (data) {
                                $('.' + 'fr' + clicked_id).html(data);
                            }
                        });
                    }
                    /* follow user script end */
                    /* Unfollow user script start */
                    function unfollowuser(clicked_id)
                    {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url() . "business_profile/unfollow" ?>',
                            data: 'follow_to=' + clicked_id,
                            success: function (data) {
                                $('.' + 'fr' + clicked_id).html(data);
                            }
                        });
                    }
                    /* Unfollow user script end */
                    /* script for profile pic strat */
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                document.getElementById('preview').style.display = 'block';
                                $('#preview').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#profilepic").change(function () {
                        profile = this.files;
                        if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                            $('#profilepic').val('');
                            picpopup();
                            return false;
                        } else {
                            readURL(this);
                        }
                    });
                    /* script for profile pic end */

                    function openModal() {
                        document.getElementById('myModal1').style.display = "block";
                    }
                    function closeModal() {
                        document.getElementById('myModal1').style.display = "none";
                    }
                    var slideIndex = 1;
                    showSlides(slideIndex);

                    function plusSlides(n) {
                        showSlides(slideIndex += n);
                    }

                    function currentSlide(n) {
                        showSlides(slideIndex = n);
                    }

                    function showSlides(n) {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("demo");
                        var captionText = document.getElementById("caption");
                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                        captionText.innerHTML = dots[slideIndex - 1].alt;
                    }
                </script>
                <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
                <script type="text/javascript">
                    //validation for edit email formate form
                    $(document).ready(function () {
                        $("#userimage").validate({
                            rules: {
                                profilepic: {
                                    required: true,
                                },
                            },
                            messages: {
                                profilepic: {
                                    required: "Photo Required",
                                },
                            },
                        });
                    });
                    function contact_person(clicked_id) {
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url() . "business_profile/contact_person" ?>',
                            data: 'toid=' + clicked_id,
                            success: function (data) {
                                $('#contact_per').html(data);
                            }
                        });
                    }

                    function picpopup() {
                        $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
                        $('#bidmodal').modal('show');
                    }


                    $(document).ready(function () {
                        $("#myBtn").click(function () {
                            $("#myModal").modal();
                        });
                    });

                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            $('#bidmodal-2').modal('hide');
                        }
                    });

                    /* scroll page script start */
                    //For Scroll page at perticular position js Start
                    $(document).ready(function () {
                        $('html,body').animate({scrollTop: 330}, 500);
                    });
                    //For Scroll page at perticular position js End
                    /* scroll page script end */

                    function contact_person_model(clicked_id, status) {
                        if (status == 'pending') {
                            $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        } else if (status == 'confirm') {

                            $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        }
                    }
                    /* all popup close close using esc start */
                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            closeModal();
                        }
                    });
                    /* all popup close close using esc end */
                </script>
                </body>
                </html>
