<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-main.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">
		
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        //echo $returnpage;die();
        if ($this->session->userdata('aileenuser') != $recliveid) {
            echo $freelancer_hire_header2_border;
        } elseif ($freelancr_user_data[0]['free_hire_step'] == 3) {
            echo $freelancer_hire_header2_border;
        } elseif ($this->session->userdata('aileenuser') == $recliveid) {
           echo $freelancer_hire_header2_border;
        }else{
           
        }
        ?>

        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="container mt-22" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" style="width:100%"></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result" onclick="">Cancel</button>

                        <button class="btn btn-success set-btn upload-result " onclick="myFunction()">Save</button>

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
                        <div id="upload-demo-i" ></div>
                    </div>
                </div>
                <div class="">
                    <div class="" id="row2">
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($recliveid == $userid) {
                            $user_id = $userid;
                        } elseif ($recliveid == "") {
                            $user_id = $userid;
                        } else {
                            $user_id = $recliveid;
                        }

                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                        $image = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $image_ori = $this->config->item('free_hire_bg_main_upload_path') . $image[0]['profile_background'];
                        if (file_exists($image_ori) && $image[0]['profile_background'] != '') {
                            ?>

                            <img src="<?php echo base_url($this->config->item('free_hire_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" />
                            <?php
                        } else {
                            ?>

                            <div class="bg-images no-cover-upload">
                                <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
                            </div>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>
            <div class="container tablate-container art-profile">    
                <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext_rec">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                <?php } ?>
                <div class="profile-photo">
                    <!--PROFILE PIC CODE START-->

                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php
                            $imageee = $this->config->item('free_hire_profile_thumb_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image'];
                            if (file_exists($imageee) && $freelancr_user_data[0]['freelancer_hire_user_image'] != '') {
                                ?>
                                <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image']); ?>" alt="" >
                                <?php
                            } else {
                                $fname = $freelancr_user_data[0]['fullname'];
                                $lname = $freelancr_user_data[0]['username'];
                                $sub_fname = substr($fname, 0, 1);
                                $sub_lname = substr($lname, 0, 1);
                                ?>
                                <div class="post-img-user">
                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>

                                </div>
                            <?php } ?>
                            <?php if ($returnpage == '') { ?>
                                <a href="javascript:void(0);" class="cusome_upload" onclick="updateprofilepopup();"><img src="<?php echo base_url(); ?>assets/img/cam.png"> Update Profile Picture</a>
                            <?php } ?>
                        </div>
                    </div>

                    <!--PROFILE PIC CODE END-->
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);" title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>"><h3><?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?></h3></a>
                        <div class="profile-text" >
                            <?php
                            if ($returnpage == '') {
                                if ($freelancr_user_data[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php } else {
                                    ?> 
                                    <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>"><?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?></a> 
                                    <?php
                                }
                            } else {
                                if ($freelancr_user_data[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php } else { ?>
                                    <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>"> <?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?></a> <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- menubar -->
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right right-menu-jr">  
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freelancr_user_data[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw4">
                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Employer Details" href="<?php echo base_url('freelancer-hire/employer-details/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>"><?php echo $this->lang->line("employer_details"); ?></a> <?php } else { ?> <a title="Employer Details" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"><?php echo $this->lang->line("employer_details"); ?></a> <?php } ?>
                                    </li>
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'projects')) { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Projects" href="<?php echo base_url('freelancer-hire/projects/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>"> Projects</a> <?php } else { ?> <a title="Projects" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a> <?php } ?>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'project' || $this->uri->segment(2) == 'employer-details' || $this->uri->segment(2) == 'add-projects' || $this->uri->segment(2) == 'freelancer-save') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) != '')) { ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved_freelancer"); ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="flw_msg_btn fr">
                                    <ul>
                                        <?php if ($this->uri->segment(3) != "" && $this->session->userdata('aileenuser') != $recliveid) { ?>
                                            <li>
                                                <?php
                                                $returnpage = $_GET['page'];
                                                if ($this->session->userdata('aileenuser') != $recliveid) {
                                                    ?>
                                                    <a href="<?php echo base_url('chat/abc/3/4/' . $recliveid); ?>">Message</a>
                                                <?php } ?>
                                            <!--<a href="<?php echo base_url('chat/abc/2/1/' . $recliveid); ?>">Message</a>-->

                                            </li>  <?php } ?>
                                    </ul>
                                </div>
                        </div>
                    </div>  
                    <!-- menubar -->    
                </div>                       
            </div> <div  class="add-post-button mob-block">
                <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?>
                    <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Post Project</a>
                <?php } ?>
            </div>
            <div class="middle-part container rec_res">
                <div class="job-menu-profile mob-none  ">
                    <a href="javascript:void(0);" title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>"><h3><?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?></h3></a>
                    <!-- text head start -->
                    <div class="profile-text" >
                        <?php
                        if ($returnpage == '') {
                            //echo "hii";
                            if ($freelancr_user_data[0]['designation'] == "") {
                                ?>
                                <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($postdataone[0]['designation'])); ?>"><?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?></a>
                                <?php
                            }
                        } else {
                            echo ucfirst(strtolower($postdataone['designation']));
                        }
                        ?>
                    </div>
                    <div  class="add-post-button">
                        <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?>
                            <a class="btn btn-3 btn-3b" id="rec_post_job1" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post Project</a>
                        <?php } ?>
                    </div>

                </div>
                <div class="col-md-7 col-sm-12 mob-clear">
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3>Projects</h3>
                            <div class="contact-frnd-post">

                                <?php

                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?>                                    
                                <?php
                                if ($postdata) {
                                    foreach ($postdata as $post) {
                                        $userid = $this->session->userdata('aileenuser');
                                        ?>
                                        <div class="job-contact-frnd ">
                                            <div class="profile-job-post-detail clearfix" id="<?php echo "removeapply" . $post['post_id']; ?>">
                                                <div class="profile-job-post-title-inside clearfix">
                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details col-md-12">
                                                                <ul>
                                                                    <li class="fr">
                                                                        Created Date : <?php
                                                                        echo trim(date('d-M-Y', strtotime($post['created_date'])));
                                                                        ?>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" title="<?php echo ucwords(text2link($post['post_name'])); ?>" class="post_title ">
                                                                            <?php echo ucwords($post['post_name']); ?> </a>   </li>


                                                                    <?php
                                                                    $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                    $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                    ?>
                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>

                                                                    <li>
                                                                        <?php if ($returnpage == 'freelancer_post') { ?>
                                                                            <a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                            </a>

                                                                            <?php if ($cityname || $countryname) { ?>
                                                                                <div class="fr lction display_inline">

                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                                        <?php if ($cityname) { ?> 
                                                                                            <?php echo $cityname . ","; ?>
                                                                                        <?php } ?>
                                                                                        <?php echo $countryname; ?></p>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } else { ?>
                                                                            <a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id']); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                            </a> 
                                                                            <?php if ($cityname || $countryname) { ?>
                                                                                <div class="fr lction display_inline">

                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"> </i><?php if ($cityname) { ?>
                                                                                            <?php echo $cityname . ","; ?>
                                                                                        <?php } ?>
                                                                                        <?php echo $countryname; ?></p>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b> Field</b> <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>

                                                                    </span>
                                                                </li>
                                                                <li> <b> Skills</b> <span> 
                                                                        <?php
                                                                        $comma = " , ";
                                                                        $k = 0;
                                                                        $aud = $post['post_skill'];
                                                                        $aud_res = explode(',', $aud);

                                                                        if (!$post['post_skill']) {

                                                                            echo $post['post_other_skill'];
                                                                        } else if (!$post['post_other_skill']) {
                                                                            foreach ($aud_res as $skill) {
                                                                                if ($k != 0) {
                                                                                    echo $comma;
                                                                                }
                                                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                echo $cache_time;
                                                                                $k++;
                                                                            }
                                                                        } else if ($post['post_skill'] && $post['post_other_skill']) {

                                                                            foreach ($aud_res as $skill) {
                                                                                if ($k != 0) {
                                                                                    echo $comma;
                                                                                }
                                                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                echo $cache_time;
                                                                                $k++;
                                                                            } echo "," . $post['post_other_skill'];
                                                                        }
                                                                        ?>     

                                                                    </span>
                                                                </li>


                                                                <!--  <?php if ($post['post_other_skill']) { ?>
                                                                                     <li><b>Other Skill</b><span><?php echo $post['post_other_skill']; ?></span>
                                                                                     </li>
                                                                <?php } else { ?>
                                                                                     <li><b>Other Skill</b><span><?php echo "-"; ?></span></li><?php } ?> -->

                                                                <li><b>Post Description</b><span><pre>
                                                                            <?php
                                                                            if ($post['post_description']) {
                                                                                echo $this->common->make_links($post['post_description']);
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></pre></span>
                                                                </li>
                                                                <li><b>Rate</b><span>
                                                                        <?php
                                                                        if ($post['post_rate']) {
                                                                            echo $post['post_rate'];
                                                                            echo "&nbsp";
                                                                            echo $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                                            echo "&nbsp";
                                                                            if ($post['post_rating_type'] == 0) {
                                                                                echo "Hourly";
                                                                            } else {
                                                                                echo "Fixed";
                                                                            }
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></span>
                                                                </li>

                                                                <li>
                                                                    <b>Required Experience</b>
                                                                    <span>
                                                                        <?php
                                                                        if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                            if ($post['post_exp_year']) {
                                                                                echo $post['post_exp_year'];
                                                                            }
                                                                            if ($post['post_exp_month']) {
                                                                                if ($post['post_exp_year'] == '' || $post['post_exp_year'] == '0') {
                                                                                    echo 0;
                                                                                }
                                                                                echo ".";
                                                                                echo $post['post_exp_month'];
                                                                            }
                                                                            echo " Year";
                                                                            // echo $post['post_exp_year'].".".$post['post_exp_month'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?> 
                                                                    </span>
                                                                </li>
                                                                <li><b>Estimated Time</b><span> <?php
                                                                        if ($post['post_est_time']) {
                                                                            echo $post['post_est_time'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></span>
                                                                </li>


                                                            </ul>
                                                        </div>
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details col-md-12">
                                                                <ul><li class="job_all_post last_date">
                                                                        Last Date : <?php
                                                                        if ($post['post_last_date']) {
                                                                            echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>                                                          </li>


                                                                    <li>
                                                                        <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?><a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $post['post_id'] ?>)">Remove</a>
                                                                        </li>  
                                                                        <li>
                                                                            <a class="button" href="<?php echo base_url('freelancer-hire/edit-projects/' . $post['post_id']); ?>" >Edit </a>
                                                                        </li>                   
                                                                        <li class=fr>
                                                                            <a class="button" href="<?php echo base_url('freelancer-hire/freelancer-applied/' . $post['post_id']); ?>" >Applied person :<?php echo count($this->common->select_data_by_id('freelancer_apply', 'post_id', $post['post_id'], $data = '*', $join_str = array())); ?></a>
                                                                        <?php } else { ?>
                                                                            <?php
                                                                            $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                            $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                            $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                            if ($freelancerapply1) {
                                                                                ?>
                                                                                <a href="javascript:void(0);" class="button applied">Applied</a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <input type="hidden" id="<?php echo 'allpost' . $post['post_id']; ?>" value="all">

                                                                                <input type="hidden" id="<?php echo 'userid' . $post['post_id']; ?>" value="<?php echo $post['user_id']; ?>">
                                                                                               <!-- <a class="applypost button" href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)">Apply</a> -->
                                                                                <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $this->session->userdata('aileenuser'); ?>)">Apply</a>
                                                                            </li> 
                                                                            <li>
                                                                                <?php
                                                                                $userid = $this->session->userdata('aileenuser');

// $contition_array = array('from_id' => $userid, 'to_id' => $post['user_id'],'save_type' => 2,'status'=> 0);
// $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                                $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                                                                $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                                if ($data) {
                                                                                    ?>
                                                                                    <a class="saved  button <?php echo 'savedpost' . $post['post_id']; ?>">Saved</a>
                                                                                <?php } else { ?>
                                                                                    <input type="hidden" name="saveuser"  id="saveuser" value= "<?php echo $data[0]['save_id']; ?>"> 
                                                                                    <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> applypost button">Save</a>

                                                                                <?php } ?>
                                                                            <?php } ?>

                                                                        </li>                        



                                                                    <?php } ?>
                                                                    </li>      

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

                                                <img src="<?php echo base_url('/assets/img/free-no.png') ?>">

                                            </div>
                                            <div class="art_no_post_text">
                                                No project Available.
                                            </div>
                                        </div>
                                    <?php }
                                    ?> 

                                    <div class="col-md-1">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <!-- MIDDLE SECTION END -->
        </section>
        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <!--PROFILE PIC MODEL START-->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>      
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">

                                <div class="fw" id="profi_loader"  style="display:none;" style="text-align:center;" ><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                                    <div class="col-md-5">
                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one" >
                                    </div>

                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="display:none;" style="width:350px"></div>
                                    </div>
                                    <input type="submit" class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                </form>

                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--PROFILE PIC MODEL END-->
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
        <!-- START FOOTER -->
        <footer>
            <?php echo $footer; ?>
        </footer>
        <!-- END FOOTER -->

<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <!-- FIELD VALIDATION JS START -->
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/project_live.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>
        <?php
        if (IS_REC_JS_MINIFY == '0') {
            ?>
            <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>  

            <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
            <?php
        } else {
            ?>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/croppie_bootstrap_validate.min.js?ver=' . time()); ?>"></script>
        <?php } ?>

        <script>
                                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                                        var data1 = <?php echo json_encode($de); ?>;
                                                                                        var data = <?php echo json_encode($demo); ?>;
                                                                                        var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                                                                        var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                                                        var id = '<?php echo $this->uri->segment(3); ?>';
                                                                                        var return_page = '<?php echo $_GET['page']; ?>';



                                                                                        function removepopup(id) {
                                                                                         
                                                                                            $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this project?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                                                                            $('#bidmodal').modal('show');
                                                                                        }

                                                                                        //remove post start

                                                                                        function remove_post(abc)
                                                                                        {

                                                                                            $.ajax({
                                                                                                type: 'POST',
                                                                                                url: '<?php echo base_url() . "freelancer/remove_post" ?>',
                                                                                                data: 'post_id=' + abc,
                                                                                                success: function (data) {
                                                                                                    $('#' + 'removeapply' + abc).html(data);
                                                                                                    $('#' + 'removeapply' + abc).parent().removeClass();

                                                                                                    var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                                                                                                    if (numItems == '0') {
                                                                                                       // var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Project Found.</h4></div>";
                                                                                                        var nodataHtml = '<div class="art-img-nn"><div class="art_no_post_img"><img src="../img/free-no1.png"></div><div class="art_no_post_text">No Project Found</div></div>';
                                                                                                        $('.contact-frnd-post').html(nodataHtml);

                                                                                                    }


                                                                                                }
                                                                                            });

                                                                                        }
        </script>



    </body>
</html>