<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-apply.css?ver=' . time()); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        if ($returnpage == 'freelancer_hire') {
            echo $freelancer_hire_header2_border;
        } else {
            echo $freelancer_post_header2_border;
        }
        ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result set-btn" ><?php echo $this->lang->line("cancel"); ?></button>
                        <button class="btn btn-success set-btn upload-result"><?php echo $this->lang->line("save"); ?></button>
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

                <div class="">
                    <div class="" id="row2">
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($this->uri->segment(3) == $userid) {
                            $user_id = $userid;
                        } elseif ($this->uri->segment(3) == "") {
                            $user_id = $userid;
                        } else {
                            $user_id = $this->uri->segment(3);
                        }
                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                        $image = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>

                            <img src="<?php echo FREE_POST_BG_MAIN_UPLOAD_URL . $image[0]['profile_background']; ?>" name="image_src" id="image_src" / >
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
                <?php if ($returnpage == '' && $freelancerpostdata[0]['user_id'] == $userid) { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext"><?php echo $this->lang->line("upload_cover_photo"); ?></span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                <?php } ?>
                
                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php
                            $fname = $freelancerpostdata[0]['freelancer_post_fullname'];
                            $lname = $freelancerpostdata[0]['freelancer_post_username'];
                            $sub_fname = substr($fname, 0, 1);
                            $sub_lname = substr($lname, 0, 1);
                            if ($freelancerpostdata[0]['freelancer_post_user_image']) {
                              
                                if (IMAGEPATHFROM == 'upload') {
                                 
                                    if (!file_exists($this->config->item('free_post_profile_main_upload_path') . $freelancerpostdata[0]['freelancer_post_user_image'])) { 
                                        ?>
                                        <div class="post-img-user">
                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                        </div>
                                    <?php } else {
                                      
                                        ?>
                                        <img src="<?php echo FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image']; ?>" alt="user_image" >        
                                        <?php
                                    }
                                } else {
                                  
                                    $filename = $this->config->item('free_post_profile_main_upload_path') . $freelancerpostdata[0]['freelancer_post_user_image'];
                                    $s3 = new S3(awsAccessKey, awsSecretKey);
                                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                    if ($info) {
                                        ?>
                                        <img src="<?php echo FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image']; ?>" alt="" >
                                    <?php } else { ?>
                                        <div class="post-img-user">
                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                 
                                ?>
                                <div class="post-img-user">
                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                </div>
                            <?php } ?>
                            <?php if ($returnpage == '' && $freelancerpostdata[0]['user_id'] == $userid) { ?>
                                <a href="javascript:void(0);" class="cusome_upload" onclick="updateprofilepopup();"><img  src="<?php echo base_url('assets/img/cam.png'); ?>"><?php echo $this->lang->line("update_profile_picture"); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);">   <h3> <?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?></h3></a>
                        <div class="profile-text">
                            <?php
                            if ($returnpage == '' && $freelancerpostdata[0]['user_id'] == $userid) {
                                if ($freelancerpostdata[0]['designation'] == "") {
                                    ?> 
                                    <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                                    <?php
                                } else {
                                    ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerpostdata[0]['designation']); ?>"><?php echo ucwords($freelancerpostdata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerpostdata[0]['designation'] == '') {
                                    ?>
                                    <?php echo $this->lang->line("designation"); ?>
                                <?php } else { ?>
                                    <?php echo ucwords($freelancerpostdata[0]['designation']); ?>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr"> 
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freelancerpostdata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">
                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details')) { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'freelancer_hire') { ?>
                                            <a title="Freelancer Details" href="<?php echo base_url('freelancer-work/freelancer-details/') . $this->uri->segment(3) . '?page=freelancer_hire'; ?>">Details</a><?php } else { ?><a title="Freelancer Details" href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo $this->lang->line("freelancer_details"); ?></a><?php } ?>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details' || $this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'freelancer_save_post' || $this->uri->segment(2) == 'applied-projects') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'saved-projects')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelancer-work/saved-projects'); ?>"><?php echo $this->lang->line("saved_projects"); ?></a> </li>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'applied-projects')) { ?> class="active" <?php } ?>><a title="Applied  Post" href="<?php echo base_url('freelancer-work/applied-projects'); ?>"><?php echo $this->lang->line("applied_projects"); ?></a> </li>
                                    <?php } ?>
                                </ul>

                                <?php
                                if (is_numeric($this->uri->segment(3))) {
                                    $id = $this->uri->segment(3);
                                } else {
                                    $id = $this->db->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $this->uri->segment(3), 'status' => 1))->row()->user_id;
                                }
                                $userid = $this->session->userdata('aileenuser');
                                $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_type' => 2, 'status' => '0');
                                $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                if ($userid != $this->uri->segment(3)) {
                                    if ($this->uri->segment(3) != "") {
                                        ?>
                                        <div class="flw_msg_btn fr">
                                            <ul>
                                                <?php
                                                if (!$data) {
                                                    ?> 

                                                    <li>
                                                        <a id="<?php echo $id; ?>" onClick="savepopup(<?php echo $id; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $id ?>">
                                                            <?php echo $this->lang->line("save"); ?>
                                                        </a> 

                                                    </li> <?php } else { ?>
                                                    <li> 
                                                        <a class="saved butt_rec <?php echo 'saveduser' . $id; ?> "><?php echo $this->lang->line("saved"); ?></a>
                                                    </li> <?php
                                                }
                                                ?>
                                                <li>
                                                    <?php
                                                    $returnpage = $_GET['page'];
                                                    if ($returnpage == 'freelancer_hire') {
                                                        ?>
                                                        <a href="<?php echo base_url('chat/abc/3/4/' . $id); ?>"><?php echo $this->lang->line("message"); ?></a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo base_url('chat/abc/4/3/' . $id); ?>"><?php echo $this->lang->line("message"); ?></a>
                                                    <?php }
                                                    ?>

                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="middle-part container pt10">
                <div class="job-menu-profile mob-none pt-20">
                    <a href="javascript:void(0);">   <h3> <?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?></h3></a>
                    <div class="profile-text pt5">
                        <?php
                        if ($returnpage == '' && $freelancerpostdata[0]['user_id'] == $userid) {
                            if ($freelancerpostdata[0]['designation'] == "") {
                                ?> 
                                <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freelancerpostdata[0]['designation']); ?>"><?php echo ucwords($freelancerpostdata[0]['designation']); ?></a>
                                <?php
                            }
                        } else {
                            if ($freelancerpostdata[0]['designation'] == "") {
                                ?>
                                <?php echo $this->lang->line("designation"); ?>
                            <?php } else { ?>
                                <?php echo ucwords($freelancerpostdata[0]['designation']); ?>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 mob-clear">
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3><?php echo $this->lang->line("freelancer_details"); ?> </h3>
                            <div class=" fr rec-edit-pro">
                                <?php

                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($freelancerpostdata[0]['user_id'] === $userid) {
                                    ?>
                                    <ul>
                                    </ul>
                                <?php } ?>
                            </div> 
                            <div class="contact-frnd-post">
                                <div class="job-contact-frnd ">
                                    <div class="profile-job-post-detail clearfix">
                                        <div class="profile-job-post-title clearfix">
                                            <div class="profile-job-profile-button clearfix">
                                                <div class="profile-job-details">
                                                    <ul>
                                                        <li><p class="details_all_tital "><?php echo $this->lang->line("basic_info"); ?></p> </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-profile-menu">
                                                <ul class="clearfix">
                                                    <li> <b><?php echo $this->lang->line("name"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_fullname'] . '  ' . $freelancerpostdata[0]['freelancer_post_username']; ?> </span>
                                                    </li>
                                                    <li> <b><?php echo $this->lang->line("email"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_email']; ?> </span>
                                                    </li>
                                                    <?php
                                                    if ($returnpage == 'freelancer_hire') {
                                                        if ($freelancerpostdata[0]['freelancer_post_phoneno']) {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_phoneno']; ?></span> </li>
                                                            <?php
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        if ($freelancerpostdata[0]['freelancer_post_phoneno']) {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_phoneno']; ?></span> </li> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($returnpage == 'freelancer_hire') {
                                                        if ($freelancerpostdata[0]['freelancer_post_skypeid']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skype_id"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_skypeid']; ?> </span>
                                                            </li> 
                                                            <?php
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        if ($freelancerpostdata[0]['freelancer_post_skypeid']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skype_id"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_skypeid']; ?> </span>
                                                            </li> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("skype_id"); ?></b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("address"); ?></p> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b><?php echo $this->lang->line("country"); ?></b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $freelancerpostdata[0]['freelancer_post_country']))->row()->country_name; ?></span>
                                                        </li>
                                                        <li> <b><?php echo $this->lang->line("state"); ?></b><span> <?php
                                                                echo
                                                                $this->db->get_where('states', array('state_id' => $freelancerpostdata[0]['freelancer_post_state']))->row()->state_name;
                                                                ?> </span>
                                                        </li>
                                                        <?php
                                                        if ($returnpage == 'freelancer_hire') {
                                                            if ($freelancerpostdata[0]['freelancer_post_city']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span><?php
                                                                        echo
                                                                        $this->db->get_where('cities', array('city_id' => $freelancerpostdata[0]['freelancer_post_city']))->row()->city_name;
                                                                        ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerpostdata[0]['freelancer_post_city']) {
                                                                    ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span><?php
                                                                        echo
                                                                        $this->db->get_where('cities', array('city_id' => $freelancerpostdata[0]['freelancer_post_city']))->row()->city_name;
                                                                        ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($returnpage == 'freelancer_hire') {
                                                            if ($freelancerpostdata[0]['freelancer_post_pincode']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("pincode"); ?></b><span><?php echo $freelancerpostdata[0]['freelancer_post_pincode']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerpostdata[0]['freelancer_post_pincode']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("pincode"); ?></b><span><?php echo $freelancerpostdata[0]['freelancer_post_pincode']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("pincode"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?></span>
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
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("professional_info"); ?></p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <?php $categoryname = $this->db->get_where('category', array('category_id' => $freelancerpostdata[0]['freelancer_post_field']))->row()->category_name; ?>
                                                        <li> <b><?php echo $this->lang->line("field"); ?></b> <span> <?php echo $categoryname; ?> </span>
                                                        </li>
                                                        <?php
                                                        if ($freelancerpostdata[0]['freelancer_post_area']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skill"); ?></b><span>
                                                                    <?php
                                                                    $aud = $freelancerpostdata[0]['freelancer_post_area'];
                                                                    $aud_res = explode(',', $aud);
                                                                    foreach ($aud_res as $skill) {

                                                                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                        $skill1[] = $cache_time;
                                                                    }
                                                                    $listFinal = implode(', ', $skill1);

                                                                    if (!$listFinal) {

                                                                        echo $freelancerpostdata[0]['freelancer_post_otherskill'];
                                                                    } else if (!$freelancerpostdata[0]['freelancer_post_otherskill']) {

                                                                        echo $listFinal;
                                                                    } else if ($listFinal && $freelancerpostdata[0]['freelancer_post_otherskill']) {
                                                                        echo $listFinal . ',' . $freelancerpostdata[0]['freelancer_post_otherskill'];
                                                                    }
                                                                    ?>     
                                                                </span>
                                                            </li>
                                                        <?php } ?>

                                                        <li><b><?php echo $this->lang->line("skill_description"); ?></b> <span> <pre><?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_skill_description']); ?> </pre> </span> </li>

                                                        <li><b><?php echo $this->lang->line("total_experiance"); ?></b> <span>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_exp_month'] == '12 month' && $freelancerpostdata[0]['freelancer_post_exp_year'] == '0 year') {
                                                                    echo "1 year";
                                                                } elseif ($freelancerpostdata[0]['freelancer_post_exp_year'] != '0 year' && $freelancerpostdata[0]['freelancer_post_exp_month'] == '12 month') {
                                                                    $month = explode(' ', $freelancerpostdata[0]['freelancer_post_exp_year']);
                                                                    $year = $month[0];
                                                                    $years = $year + 1;
                                                                    echo $years . " Years";
                                                                } else {
                                                                    echo $freelancerpostdata[0]['freelancer_post_exp_year'] . ' ' . $freelancerpostdata[0]['freelancer_post_exp_month'];
                                                                }
                                                                ?>
                                                            </span> </li>  
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                            if ($returnpage == 'freelancer_hire') {
                                                $currancy = $this->db->get_where('currency', array('currency_id' => $freelancerpostdata[0]['freelancer_post_ratestate']))->row()->currency_name;
                                                if ($freelancerpostdata[0]['freelancer_post_hourly'] != "" && $freelancerpostdata[0]['freelancer_post_ratestate'] != "") {
                                                    ?>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("rate"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_hourly']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_hourly'] . '  ' . $currancy; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_fixed_rate'] == 1) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("also_work_fixed"); ?></b> 
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div> <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("rate"); ?></p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_hourly']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_hourly'] . '  ' . $currancy; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span>  <?php echo PROFILENA; ?> </span>
                                                                </li>
                                                            <?php } ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_fixed_rate'] == 1) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("also_work_fixed"); ?></b> 
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                            <?php
                                            if ($returnpage == 'freelancer_hire') {
                                                if ($freelancerpostdata[0]['freelancer_post_job_type'] != "" || $freelancerpostdata[0]['freelancer_post_work_hour'] != "") {
                                                    ?>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("avaibility"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_job_type']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("timing"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_job_type']; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }

                                                                if ($freelancerpostdata[0]['freelancer_post_work_hour']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_work_hour']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?> 
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("avaibility"); ?></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_job_type']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("timing"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_job_type']; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b>Timing<?php echo $this->lang->line("timing"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            if ($freelancerpostdata[0]['freelancer_post_work_hour']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_work_hour']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($returnpage == 'freelancer_hire') {
                                                if ($freelancerpostdata[0]['freelancer_post_degree'] != "" || $freelancerpostdata[0]['freelancer_post_stream'] != "" || $freelancerpostdata[0]['freelancer_post_univercity'] != "" || $freelancerpostdata[0]['freelancer_post_percentage'] != "" || $freelancerpostdata[0]['freelancer_post_passingyear'] != "") {
                                                    ?> 
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("education"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_degree']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("degree"); ?></b> <span><?php echo $this->db->get_where('degree', array('degree_id' => $freelancerpostdata[0]['freelancer_post_degree']))->row()->degree_name; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_stream']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("stream"); ?></b><span> <?php echo $this->db->get_where('stream', array('stream_id' => $freelancerpostdata[0]['freelancer_post_stream']))->row()->stream_name; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_univercity']) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("university"); ?></b> <span><?php echo $this->db->get_where('university', array('university_id' => $freelancerpostdata[0]['freelancer_post_univercity']))->row()->university_name; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_collage']) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("college"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_collage']; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_percentage']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("percentage"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_percentage'] . " %"; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_passingyear']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("year_passing"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_passingyear']; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("education"); ?></p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_degree']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("degree"); ?></b> <span><?php echo $this->db->get_where('degree', array('degree_id' => $freelancerpostdata[0]['freelancer_post_degree']))->row()->degree_name; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("degree"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }

                                                            if ($freelancerpostdata[0]['freelancer_post_stream']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("stream"); ?></b><span> <?php echo $this->db->get_where('stream', array('stream_id' => $freelancerpostdata[0]['freelancer_post_stream']))->row()->stream_name; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("stream"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_univercity']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("university"); ?></b> <span><?php echo $this->db->get_where('university', array('university_id' => $freelancerpostdata[0]['freelancer_post_univercity']))->row()->university_name; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("university"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_collage']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("college"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_collage']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("college"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_percentage']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("percentage"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_percentage'] . " %"; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("percentage"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_passingyear']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("year_passing"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_passingyear']; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("year_passing"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($returnpage == 'freelancer_hire') {
                                                if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "" || $freelancerpostdata[0]['freelancer_post_portfolio'] != "") {
                                                    ?> 
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li><p class="details_all_tital "><?php echo $this->lang->line("portfolio"); ?></p> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">

                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "") {
                                                                $allowespdf = array('pdf');
                                                                $filename = $freelancerpostdata[0]['freelancer_post_portfolio_attachment'];
                                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                                if (in_array($ext, $allowespdf)) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("attach"); ?></b><span>
                                                                            <div class="free_attc">
                                                                                <a href="<?php echo base_url('freelancer/pdf/' . $freelancerpostdata[0]['user_id']) ?>">
                                                                                    <img src="<?php echo base_url('assets/images/PDF.jpg') ?>" > 
                                                                                </a>
                                                                        </span>

                                                                    </li>
                                                                <?php } ?>

                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_portfolio']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("descri"); ?></b> <span><pre>
                                                                            <?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_portfolio']); ?> </pre></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>

                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("portfolio"); ?></p> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <?php
                                                        if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "") {
                                                            $allowespdf = array('pdf');
                                                            $filename = $freelancerpostdata[0]['freelancer_post_portfolio_attachment'];
                                                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                            if (in_array($ext, $allowespdf)) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("attach"); ?></b><span>
                                                                        <div class="free_attc">
                                                                            <a href="<?php echo base_url('freelancer/pdf/' . $freelancerpostdata[0]['user_id']) ?>">
                                                                                <img src="<?php echo base_url('assets/images/PDF.jpg') ?>" > 
                                                                            </a>
                                                                    </span>
                                                                </li>
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("attach"); ?></b><span> 
                                                                    <?php echo PROFILENA; ?>
                                                                </span>

                                                            </li>
                                                            <?php
                                                        }

                                                        if ($freelancerpostdata[0]['freelancer_post_portfolio']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("descri"); ?></b> <span><p>
                                                                        <?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_portfolio']); ?> </p></span>
                                                            </li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("descri"); ?></b><span> 
                                                                    <?php echo PROFILENA; ?>
                                                                </span>
                                                            </li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
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
            <?php echo $login_footer ?>
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
                                <div class="fw" id="profi_loader"  style="display:none;" style="text-align:center;" ><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                                    <?php //echo form_open_multipart(base_url('freelancer/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix'));       ?>
                                    <div class="col-md-5">
                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one">
                                    </div>
                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="width:350px"></div>
                                    </div>
                                    <input type="submit" class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                </form>
                                <?php //echo form_close();       ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->

        <script  src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>">
        </script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>">
        </script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_post_profile.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_common.js?ver=' . time()); ?>"></script>

    </body>
</html>