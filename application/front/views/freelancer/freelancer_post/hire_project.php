<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">

    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push freeh3">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        //echo $returnpage;die();
        if ($this->session->userdata('aileenuser') != $recliveid) {
            echo $freelancer_post_header2_border;
        } elseif ($freelancr_user_data[0]['free_hire_step'] == 3) {
            echo $freelancer_hire_header2_border;
        } elseif ($this->session->userdata('aileenuser') == $recliveid) {
            echo $freelancer_hire_header2_border;
        } else {
            
        }
        ?>

        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container padding-360">
                    <div class="row4">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt"><div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <?php
                                            $hire_user = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $this->session->userdata('aileenuser'), $data = 'user_id', $join_str = array());
                                            $post_user = $this->common->select_data_by_id('freelancer_post', 'post_id', $postid, $data = 'user_id', $join_str = array());
                                            ?>
                                            <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  aria-hidden="true" rel="noopener">
                                                <?php } else if ($hire_user) { ?>
                                                    <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="javascript:void(0);" aria-hidden="true" rel="noopener">
                                                    <?php } else { ?>
                                                        <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelancer-hire/employer-details/' . $recliveid . '?page=freelancer_post'); ?>" onclick="login_profile();" tabindex="-1" 
                                                           aria-hidden="true" rel="noopener">
                                                           <?php } ?>
                                                        <div class="bg-images no-cover-upload"> 
                                                            <?php
                                                            // $image_ori = $this->config->item('rec_bg_thumb_upload_path') . $freelancr_user_data[0]['profile_background'];

                                                            if ($freelancr_user_data[0]['profile_background'] != '') {
                                                                ?>
                                                                <!-- box image start -->
                                                                <img src="<?php echo FREE_HIRE_BG_THUMB_UPLOAD_URL . $freelancr_user_data[0]['profile_background']; ?>" class="bgImage" alt="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>">
                                                                <!-- box image end -->
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" >
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </a>
                                                    </div>
                                                    <div class="profile-boxProfileCard-content clearfix">
                                                        <div class="left_side_box_img buisness-profile-txext">
                                                            <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                <?php } else if ($hire_user) { ?>
                                                                    <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="javascript:void(0);"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                    <?php } else {
                                                                        ?>
                                                                        <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details/' . $recliveid . '?page=freelancer_post'); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                            <?php
                                                                        }
                                                                        $fname = $freelancr_user_data[0]['fullname'];
                                                                        $lname = $freelancr_user_data[0]['username'];
                                                                        $sub_fname = substr($fname, 0, 1);
                                                                        $sub_lname = substr($lname, 0, 1);

                                                                        if ($freelancr_user_data[0]['freelancer_hire_user_image']) {
                                                                            if (IMAGEPATHFROM == 'upload') {
                                                                                if (!file_exists($this->config->item('free_hire_profile_main_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image'])) {
                                                                                    ?>
                                                                                    <div class="post-img-profile">
                                                                                        <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                                    </div>
                                                                                <?php } else {
                                                                                    ?>
                                                                                    <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freelancr_user_data[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freelancr_user_data[0]['fullname'] . " " . $freelancr_user_data[0]['username']; ?>" > 
                                                                                    <?php
                                                                                }
                                                                            } else {
                                                                                $filename = $this->config->item('free_hire_profile_main_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image'];
                                                                                $s3 = new S3(awsAccessKey, awsSecretKey);
                                                                                $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                                                if ($info) {
                                                                                    ?>
                                                                                    <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freelancr_user_data[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freelancr_user_data[0]['fullname'] . " " . $freelancr_user_data[0]['username']; ?>" >
                                                                                <?php } else {
                                                                                    ?>
                                                                                    <div class="post-img-profile">
                                                                                        <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                                    </div> 
                                                                                    <?php
                                                                                }
                                                                            }
                                                                        } else {
                                                                            ?>
                                                                            <div class="post-img-profile">
                                                                                <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                    </div>
                                                                    <div class="right_left_box_design ">
                                                                        <span class="profile-company-name ">
                                                                            <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                                            <?php } else if ($hire_user) { ?>
                                                                                <a href="javascript:void(0);"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('freelancer-hire/employer-details/' . $recliveid . '?page=freelancer_post'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                                            <?php } ?>
                                                                        </span>

                                                                        <?php //$category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;    ?>
                                                                        <div class="profile-boxProfile-name">
                                                                            <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>">
                                                                                <?php } else if ($hire_user) { ?>
                                                                                    <a href="javascript:void(0);"  title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>">
                                                                                    <?php } else { ?>
                                                                                        <a href="<?php echo base_url('freelancer-hire/employer-details/' . $recliveid . '?page=freelancer_post'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>">
                                                                                        <?php } ?>
                                                                                        <?php
                                                                                        if (ucfirst(strtolower($freelancr_user_data[0]['designation']))) {
                                                                                            echo ucfirst(strtolower($freelancr_user_data[0]['designation']));
                                                                                        } else {
                                                                                            echo "Designation";
                                                                                        }
                                                                                        ?></a>
                                                                                    </div>
                                                                                    <ul class=" left_box_menubar">

                                                                                        <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                        <?php } else if ($hire_user) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="javascript:void(0);" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                        <?php } else { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details/' . $recliveid . '?page=freelancer_post'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                        <?php } ?>
                                                                                        <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                            <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                        <?php } else if ($hire_user) { ?>
                                                                                            <li><a title="Projects" href="javascript:void(0);"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                        <?php } else { ?>
                                                                                            <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects/' . $recliveid . '?page=freelancer_post'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                        <?php } ?>
                                                                                        <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                                                        <?php } ?>

                                                                                    </ul>
                                                                                    </div>

                                                                                    </div>
                                                                                    </div>                             
                                                                                    </div>

                                                                                    </div>
                                                                                    </div>
                                                                                    <?php
                                                                                    $applyuser = $this->common->select_data_by_id('freelancer_post_reg', 'user_id', $this->session->userdata('aileenuser'), $data = 'user_id', $join_str = array());
                                                                                    if ($applyuser) {
                                                                                        ?>?>
                                                                                        <div class="inner-right-part">
                                                                                            <div class="page-title">
                                                                                                <h3>
                                                                                                    <?php
                                                                                                    echo $postdata[0]['post_name'];
                                                                                                    ?>
                                                                                                </h3>
                                                                                            </div>
                                                                                            <?php
                                                                                            if (count($postdata) > 0) {
                                                                                                foreach ($postdata as $post) {
                                                                                                    ?>
                                                                                                    <div class="all-job-box job-detail">
                                                                                                        <div class="all-job-top">
                                                                                                            <div class="job-top-detail">
                                                                                                                <h5><a href="javascript:void(0);"><?php echo $post['post_name']; ?></a></h5>
                                                                                                                <?php
                                                                                                                $postuser = $this->common->select_data_by_id('freelancer_post', 'post_id', $post['post_id'], $data = 'user_id', $join_str = array());
                                                                                                                $hireuser = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $this->session->userdata('aileenuser'), $data = 'user_id', $join_str = array());
                                                                                                                ?>
                                                                                                                <?php
                                                                                                                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                                                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                                                ?>
                                                                                                                <p>
                                                                                                                    <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                        <a href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id']); ?>"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>
                                                                                                                    <?php } else if ($hireuser) { ?>
                                                                                                                        <a href="javascript:void(0);"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>
                                                                                                                    <?php } else { ?>
                                                                                                                        <a href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>
                                                                                                                    <?php } ?>
                                                                                                                    </a></p>
                                                                                                                <p class="loca-exp">
                                                                                                                    <span class="location">
                                                                                                                        <?php $city = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city; ?>
                                                                                                                        <?php $country = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country; ?>

                                                                                                                        <?php
                                                                                                                        $cityname = $this->db->get_where('cities', array('city_id' => $city))->row()->city_name;
                                                                                                                        $countryname = $this->db->get_where('countries', array('country_id' => $country))->row()->country_name;
                                                                                                                        ?>
                                                                                                                        <span>

                                                                                                                            <?php
                                                                                                                            if ($cityname || $countryname) {
                                                                                                                                if ($cityname) {
                                                                                                                                    echo $cityname . ', ';
                                                                                                                                }
                                                                                                                                echo $countryname . " (Location)";
                                                                                                                            }
                                                                                                                            ?>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p class="loca-exp">
                                                                                                                    <span class="exp">
                                                                                                                        <span>
                                                                                                                            <!--<img class="pr5" src="<?php echo base_url('assets/images/exp.png'); ?>">-->

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
                                                                                                                                echo " Year" . " (Required Experience)";
                                                                                                                                // echo $post['post_exp_year'].".".$post['post_exp_month'];
                                                                                                                            }
                                                                                                                            ?> 
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </p>
                                                                                                                <p class="pull-right job-top-btn">

                                                                                                                    <?php
                                                                                                                    if ($postuser[0]['user_id'] != $this->session->userdata('aileenuser')) {
                                                                                                                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => '0', 'user_id' => $this->session->userdata('aileenuser'));
                                                                                                                        $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                                                        if ($freelancerapply1) {
                                                                                                                            ?>
                                                                                                                            <a href="javascript:void(0);" class="btn4 applied">Applied</a>
                                                                                                                        <?php } else if ($applyuser) { ?>
                                                                                                                            <a href="javascript:void(0);"  class= "applypost btn4"  onClick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id']; ?>)"> Apply</a>

                                                                                                                        <?php } else { ?> 
                                                                                                                            <a href="<?php echo base_url('freelancer-work/profile/live-post/' . $post['post_id']); ?>"  class= "applypost btn4"> Apply</a>
                                                                                                                        <?php } ?>

                                                                                                                        <?php
                                                                                                                    }
                                                                                                                    ?>

                                                                                                                    <!--                                                    <a href="#" class="btn4">Save</a>
                                                                                                                                                                                                <a href="#" class="btn4">Apply</a>-->
                                                                                                                </p>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="detail-discription">
                                                                                                            <div class="all-job-middle">
                                                                                                                <ul>
                                                                                                                    <li>
                                                                                                                        <b>Project discription</b>
                                                                                                                        <span>
                                                                                                                            <pre><?php echo $this->common->make_links($post['post_description']); ?></pre>
                                                                                                                        </span>
                                                                                                                    </li>
                                                                                                                    <li>
                                                                                                                        <b>Key skill</b>
                                                                                                                        <span>  <?php
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
                                                                                                                    <li><b>Field of Requirements</b>
                                                                                                                        <span> 
                                                                                                                            <?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>
                                                                                                                        </span>
                                                                                                                    </li>
                                                                                                                    <li><b>Rate</b>
                                                                                                                        <span>  <?php
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
                                                                                                                            ?>
                                                                                                                        </span>
                                                                                                                    </li>

                                                                                                                    <li><b>Estimated Time</b>
                                                                                                                        <span>
                                                                                                                            <?php
                                                                                                                            if ($post['post_est_time']) {
                                                                                                                                echo $post['post_est_time'];
                                                                                                                            } else {
                                                                                                                                echo PROFILENA;
                                                                                                                            }
                                                                                                                            ?>   
                                                                                                                        </span>
                                                                                                                    </li>

                                                                                                                </ul>
                                                                                                            </div>
                                                                                                            <div class="all-job-bottom">
                                                                                                                <span class="job-post-date"><b>Posted on:  </b><?php echo date('d-M-Y', strtotime($post['created_date'])); ?></span>
                                                                                                                <p class="pull-right">
                                                                                                                    <?php
                                                                                                                    if ($postuser[0]['user_id'] != $this->session->userdata('aileenuser')) {
                                                                                                                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => '0', 'user_id' => $this->session->userdata('aileenuser'));
                                                                                                                        $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                                                        if ($freelancerapply1) {
                                                                                                                            ?>
                                                                                                                            <a href="javascript:void(0);" class="btn4 applied">Applied</a>
                                                                                                                        <?php } else if ($applyuser) { ?>
                                                                                                                            <a href="javascript:void(0);"  class= "applypost btn4"  onClick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id']; ?>)"> Apply</a>

                                                                                                                        <?php } else { ?> 
                                                                                                                            <a href="<?php echo base_url('freelancer-work/profile/live-post/' . $post['post_id']); ?>"  class= "applypost btn4"> Apply</a>
                                                                                                                        <?php } ?>

                                                                                                                        <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                    <!--                                                    <a href="#" class="btn4">Save</a>
                                                                                                                                                                        <a href="#" class="btn4">Apply</a>-->
                                                                                                                </p>

                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                }
                                                                                            } else {
                                                                                                ?>
                                                                                                <div class="art-img-nn">
                                                                                                    <div class="art_no_post_img">
                                                                                                        <img src="' . base_url() . 'img/job-no.png">

                                                                                                    </div>
                                                                                                    <div class="art_no_post_text">
                                                                                                        No  Post Available.
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                        </div>

                                                                                    <?php } else { ?>
                                                                                        <div class="col-md- col-sm-12 mob-clear">
                                                                                            <div class="common-form">
                                                                                                <div class="job-saved-box">
                                                                                                    <h3>Freelancer</h3>
                                                                                                    <div class="contact-frnd-post">
                                                                                                        <div class="art-img-nn">
                                                                                                            <div class="art_no_post_img">
                                                                                                                <img src="/assets/img/free-no.png">
                                                                                                            </div>
                                                                                                            <div class="art_no_post_text">   You must have a freelancer  profile for applying to this post </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <!-- sortlisted employe -->
                                                                                    <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser') || $applyuser) { ?>
                                                                                        <?php if ($shortlist) {
                                                                                            ?>
                                                                                            <div class="sort-emp-mainbox">
                                                                                                <h3>
                                                                                                    Shortlisted Freelancer
                                                                                                </h3>

                                                                                                <div class="sort-emp">
                                                                                                    <?php foreach ($shortlist as $user) { ?>
                                                                                                        <div class="sort-emp-box">
                                                                                                            <div class="sort-emp-img">
                                                                                                                <?php
                                                                                                                $fname = $user['freelancer_post_fullname'];
                                                                                                                $lname = $user['freelancer_post_username'];
                                                                                                                $sub_fname = substr($fname, 0, 1);
                                                                                                                $sub_lname = substr($lname, 0, 1);
                                                                                                                if ($user['freelancer_post_user_image']) {
                                                                                                                    if (IMAGEPATHFROM == 'upload') {
                                                                                                                        if (!file_exists($this->config->item('free_post_profile_main_upload_path') . $user['freelancer_post_user_image'])) {
                                                                                                                            ?>
                                                                                                                            <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                                <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['freelancer_apply_slug'] . '?page=freelancer_hire'); ?>">
                                                                                                                                    <div class="post-img-user">
                                                                                                                                        <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                                                                                    </div>
                                                                                                                                </a>
                                                                                                                            <?php } else { ?>
                                                                                                                                <div class="post-img-user">
                                                                                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                                                                                </div>
                                                                                                                            <?php } ?>
                                                                                                                        <?php } ?>
                                                                                                                        <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                            <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['freelancer_apply_slug'] . '?page=freelancer_hire'); ?>">
                                                                                                                                <img src="<?php echo FREE_POST_PROFILE_THUMB_UPLOAD_URL . $user['freelancer_post_user_image']; ?>" alt="" > </a>
                                                                                                                        <?php } else { ?>
                                                                                                                            <a href="javascript: void(0);">
                                                                                                                                <img src="<?php echo FREE_POST_PROFILE_THUMB_UPLOAD_URL . $user['freelancer_post_user_image']; ?>" alt="" > </a>
                                                                                                                        <?php } ?>
                                                                                                                        <?php
                                                                                                                    } else {
                                                                                                                        $filename = $this->config->item('free_post_profile_main_upload_path') . $user['freelancer_post_user_image'];
                                                                                                                        $s3 = new S3(awsAccessKey, awsSecretKey);
                                                                                                                        $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                                                                                        if ($info) {
                                                                                                                            ?>
                                                                                                                            <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                                <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['freelancer_apply_slug'] . '?page=freelancer_hire'); ?>">
                                                                                                                                    <img src="<?php echo FREE_POST_PROFILE_THUMB_UPLOAD_URL . $user['freelancer_post_user_image']; ?>" alt="" > </a>
                                                                                                                            <?php } else { ?>
                                                                                                                                <a href="javascript:void(0);">
                                                                                                                                    <img src="<?php echo FREE_POST_PROFILE_THUMB_UPLOAD_URL . $user['freelancer_post_user_image']; ?>" alt="" > </a>
                                                                                                                            <?php } ?>
                                                                                                                        <?php } else { ?>
                                                                                                                            <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                                <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['freelancer_apply_slug'] . '?page=freelancer_hire'); ?>" >
                                                                                                                                    <div class="post-img-user">
                                                                                                                                        <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>

                                                                                                                                    </div>
                                                                                                                                </a>
                                                                                                                            <?php } else { ?>
                                                                                                                                <div class="post-img-user">
                                                                                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>

                                                                                                                                </div>
                                                                                                                            <?php } ?>
                                                                                                                            <?php
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    ?>
                                                                                                                    <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                        <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['user_id'] . '?page=freelancer_hire'); ?>">
                                                                                                                            <div class="post-img-user">
                                                                                                                                <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?> 
                                                                                                                            </div>
                                                                                                                        </a>
                                                                                                                    <?php } else { ?>
                                                                                                                        <div class="post-img-user">
                                                                                                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?> 
                                                                                                                        </div>
                                                                                                                    <?php } ?>
                                                                                                                <?php } ?>
            <!--<img src="https://aileensoulimages.s3.amazonaws.com/uploads/business_profile/thumbs/1505729142.png">-->
                                                                                                            </div>
                                                                                                            <div class="sort-emp-detail">
                                                                                                                <h4>
                                                                                                                    <?php if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                                                                                                        <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $user['user_id'] . '?page=freelancer_hire'); ?>"><?php echo $user['freelancer_post_fullname'] . " " . $user['freelancer_post_username']; ?></a>
                                                                                                                    <?php } else { ?>
                                                                                                                        <a href="javascript:void(0);"><?php echo $user['freelancer_post_fullname'] . " " . $user['freelancer_post_username']; ?></a>
                                                                                                                    <?php } ?>
                                                                                                                </h4>
                                                                                                                <p><?php
                                                                                                                    if ($user['designation']) {
                                                                                                                        echo $user['designation'];
                                                                                                                    } else {
                                                                                                                        echo "Designation";
                                                                                                                    }
                                                                                                                    ?></p>
                                                                                                            </div>
                                                                                                            <div class="sort-emp-msg">
                                                                                                                <?php
                                                                                                                $login_id = $this->session->userdata('aileenuser');
                                                                                                                $user_data = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $login_id, $data = 'user_id', $join_str = array());
                                                                                                                if ($postuser[0]['user_id'] == $this->session->userdata('aileenuser')) {
                                                                                                                    ?>
                                                                                                                    <a class="btn1" href = "<?php echo base_url('chat/abc/3/4/' . $user['user_id']); ?>">
                                                                                                                        Message
                                                                                                                    </a>
                                                                                                                <?php } ?>
                                                                                                                <!--                                                                                                <a href="#" class="btn1">Message</a>-->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <?php } ?>
                                                                                                </div>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 

                                                                                        <div class="fw text-center">
                                                                                            <script type="text/javascript">
                                                                                                (function () {
                                                                                                    if (window.CHITIKA === undefined) {
                                                                                                        window.CHITIKA = {'units': []};
                                                                                                    }
                                                                                                    ;
                                                                                                    var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                                                                    var placement_id = window.CHITIKA.units.length;
                                                                                                    window.CHITIKA.units.push(unit);
                                                                                                    document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                                                                                }());
                                                                                            </script>
                                                                                            <script type="text/javascript" src="//cdn.chitika.net/getads.js"></script>
                                                                                            <div class="fw pt10">
                                                                                                <a href="https://www.chitika.com/publishers/apply?refid=aileensoul"><img src="https://images.chitika.net/ref_banners/300x250_hidden_ad.png" /></a>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="tablate-add">

                                                                                        <script type="text/javascript">
                                                                                                (function () {
                                                                                                    if (window.CHITIKA === undefined) {
                                                                                                        window.CHITIKA = {'units': []};
                                                                                                    }
                                                                                                    ;
                                                                                                    var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 160, "height": 600, "sid": "Chitika Default"};
                                                                                                    var placement_id = window.CHITIKA.units.length;
                                                                                                    window.CHITIKA.units.push(unit);
                                                                                                    document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                                                                                }());
                                                                                        </script>
                                                                                        <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
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
                                                                                    <?php echo $footer; ?>
                                                                                    </body>

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

                                                                                    </html>    