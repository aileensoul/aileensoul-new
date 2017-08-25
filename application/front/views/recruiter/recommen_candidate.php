<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php if ($recdata[0]['re_step'] == 3) { ?>
            <?php echo $recruiter_header2_border; ?>
        <?php } ?>
        <div id="preloader"></div>
        <!-- START CONTAINER -->
        <section>
              <!-- MIDDLE SECTION START -->
             <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 profile-box profile-box-left animated fadeInLeftBig"><div class="">

                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('recruiter/rec_profile'); ?>" tabindex="-1" 
                                               aria-hidden="true" rel="noopener">

                                                <?php
                                                $image_ori = $this->config->item('rec_bg_thumb_upload_path') . $recdata[0]['profile_background'];

                                                if ($recdata[0]['profile_background'] != '' && file_exists($image_ori)) {
                                                    ?>

                                                    <!-- box image start -->
                                                    <img src="<?php echo base_url($this->config->item('rec_bg_thumb_upload_path') . $recdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>">
                                                    <!-- box image end -->
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('recruiter/rec_profile/' . $recdata[0]['user_id']); ?>" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                    <?php

                                                    $image_profile = $this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image'];

                                                    if ($recdata[0]['recruiter_user_image'] != '' && file_exists($image_profile)) {
                                                        ?>
                                                        <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image']); ?>" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                                        <?php
                                                    } else {


                                                        $a = $recdata[0]['rec_firstname'];
                                                        $acr = substr($a, 0, 1);

                                                        $b = $recdata[0]['rec_lastname'];
                                                        $acr1 = substr($b, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
                                                            <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo site_url('recruiter/rec_profile'); ?>" title="<?php echo ucfirst(strtolower($recdata['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata['rec_lastname'])); ?>">   <?php echo ucfirst(strtolower($recdata[0]['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata[0]['rec_lastname'])); ?></a>
                                                </span>

                                                <?php //$category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a href="<?php echo site_url('recruiter/rec_profile/' . $recdata[0]['user_id']); ?>" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>">
                                                        <?php
                                                        if (ucfirst(strtolower($recdata[0]['designation']))) {
                                                            echo ucfirst(strtolower($recdata[0]['designation']));
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>"> Details</a>
                                                    </li>                                
                                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                                                    </li>
                                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" class="padding_less_right" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <?php if (($candidatejob != NULL) || ($recruiterdata != NULL)) { ?>
                                    <div  class="add-post-button">
                                        <a class="btn btn-3 btn-3b"  href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
                                    </div> <?php } ?>
                            </div>

                        </div>
                        <!--- search end -->


                        <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right animated fadeInUp">
                            <div class="common-form ">
                                <div class="job-saved-box">
<?php if (($candidatejob != NULL) || ($recruiterdata != NULL)) { ?>
                                        <h3>
                                            Recommended Candidate
                                        </h3>
<?php } ?>
                                    <div class="contact-frnd-post">
                                        <div class="job-contact-frnd ">
                                            <!-- khyati start -->
<?php
//                                      
if ($candidatejob) {
    foreach ($candidatejob as $row) {

        //foreach($canrow as $row){
        ?>
                                                    <div class="profile-job-post-detail clearfix">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-profile-button clearfix">
                                                                <!-- pop up box start-->
                                                                <div id="popup1" class="overlay">
                                                                    <div class="popup">
                                                                        <div class="pop_content">
                                                                            Your User is Successfully Saved.
                                                                            <p class="okk"><a class="okbtn" href="#">Ok</a></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- pop up box end-->
                                                                <div class="profile-job-post-location-name-rec">
                                                                    <div style="display: inline-block; float: left;">
                                                                        <div  class="buisness-profile-pic-candidate">
        <?php
        $imagee = $this->config->item('job_profile_thumb_upload_path') . $row['job_user_image'];

        if (file_exists($imagee) && $row['job_user_image'] != '') {
            ?>
                                                                                <a href="<?php echo base_url('job/job_printpreview/' . $row['iduser'] . '?page=recruiter'); ?>" title=" <?php echo $row['fname'] . ' ' . $row['lname']; ?>"> 
                                                                                    <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $row['job_user_image']); ?>" alt="<?php echo $row[0]['fname'] . ' ' . $row[0]['lname']; ?>">
                                                                                </a>
                                                                                <?php
                                                                            } else {


                                                                                $a = $row['fname'];
                                                                                $acr = substr($a, 0, 1);

                                                                                $b = $row['lname'];
                                                                                $acr1 = substr($b, 0, 1);
                                                                                ?>
                                                                                <div class="post-img-profile">
                                                                                <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                                                                </div>
                                                                              <!--    <a href="<?php //echo base_url('job/job_printpreview/' . $row['iduser'].'?page=recruiter'); ?>" title=" <?php //echo $row['fname'] . ' ' . $row['lname']; ?>"> 
                                                                              <img src="<?php //echo base_url(NOIMAGE); ?>" alt="<?php //echo $row[0]['fname'] . ' ' . $row[0]['lname']; ?>"> </a>
                                                                   
                                                                                -->
            <?php
        }
        ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="designation_rec fl">
                                                                        <ul>
                                                                            <li>
                                                                                <a  class="post_name" href="<?php echo base_url('job/job_printpreview/' . $row['iduser'] . '?page=recruiter'); ?>" title=" <?php echo $row['fname'] . ' ' . $row['lname']; ?>">
        <?php echo ucfirst(strtolower($row['fname'])) . ' ' . ucfirst(strtolower($row['lname'])); ?></a>
                                                                            </li>

                                                                            <li style="display: block;">
                                                                                <a  class="post_designation" href="javascript:void(0)" title="<?php echo $row['designation']; ?>">
                                                                                    <?php
                                                                                    if ($row['designation']) {
                                                                                        ?>
            <?php echo $row['designation']; ?>
            <?php
        } else {
            ?>
                                                                                        <?php echo "Current Work"; ?>
                                                                                        <?php
                                                                                    }
                                                                                    ?> 
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

        <?php
        $contition_array = array('user_id' => $row['iduser'], 'type' => 3, 'status' => 1);
        unset($other_skill);
        //echo "<pre>"; print_r($other_skill);
        $other_skill = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        //echo "<pre>"; print_r($other_skill);
        ?>
                                                        <div class="profile-job-post-title clearfix">
                                                            <div class="profile-job-profile-menu">
                                                                <ul class="clearfix">

                                                        <?php
                                                        if ($row['work_job_title']) {
                                                            $contition_array = array('status' => 'publish', 'title_id' => $row['work_job_title']);
                                                            $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            ?>
                                                                        <li> <b> Job Title</b> <span>
                                                                        <?php echo $jobtitle[0]['name']; ?>
                                                                            </span>
                                                                        </li>

                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($row['keyskill']) {
                                                                                $detailes = array();
                                                                                $work_skill = explode(',', $row['keyskill']);
                                                                                foreach ($work_skill as $skill) {
                                                                                    $contition_array = array('skill_id' => $skill);
                                                                                    $skilldata = $this->common->select_data_by_condition('skill', $contition_array, $data = 'skill_id,skill', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                                                                                    $detailes[] = $skilldata[0]['skill'];
                                                                                }
                                                                                ?>
                                                                        <li> <b> Skills</b> <span>
                                                                        <?php echo implode(',', $detailes); ?>
                                                                            </span>
                                                                        </li>
                                                                            <?php } ?>

        <?php
        if ($row['work_job_industry']) {
            $contition_array = array('industry_id' => $row['work_job_industry']);
            $industry = $this->common->select_data_by_condition('job_industry', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            ?>
                                                                        <li> <b> Industry</b> <span>
                                                                        <?php echo $industry[0]['industry_name']; ?>
                                                                            </span>
                                                                        </li>
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($row['work_job_city']) {
                                                                                $cities = array();
                                                                                $work_city = explode(',', $row['work_job_city']);
                                                                                foreach ($work_city as $city) {
                                                                                    $contition_array = array('city_id' => $city);
                                                                                    $citydata = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                                                                                    if ($citydata) {
                                                                                        $cities[] = $citydata[0]['city_name'];
                                                                                    }
                                                                                }
                                                                                ?>
                                                                        <li> <b> Preferred Cites</b> <span>
                                                                        <?php echo implode(',', $cities); ?>                                                        
                                                                            </span>
                                                                        </li>
                                                                            <?php } ?> 


                                                                    <?php
                                                                    $contition_array = array('user_id' => $row['iduser'], 'experience' => 'Experience', 'status' => '1');

                                                                    //echo "<pre>"; print_r($other_skill);
                                                                    $experiance = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    //echo  $experiance[0]['experience'];

                                                                    if ($experiance[0]['experience_year'] != '') {
                                                                        ?>
                                                                        <?php
                                                                        $total_work_year = 0;
                                                                        $total_work_month = 0;
                                                                        foreach ($experiance as $work1) {

                                                                            $total_work_year += $work1['experience_year'];
                                                                            $total_work_month += $work1['experience_month'];
                                                                        }
                                                                        ?>
                                                                        <li> <b> Total Experience</b>
                                                                            <span>
                                                                        <?php
                                                                        if ($total_work_month == '12 month' && $total_work_year == '0 year') {
                                                                            echo "1 year";
                                                                        } else {
                                                                            $month = explode(' ', $total_work_year);
                                                                            //print_r($month);
                                                                            $year = $month[0];
                                                                            $y = 0;
                                                                            for ($i = 0; $i <= $y; $i++) {
                                                                                if ($total_work_month >= 12) {
                                                                                    $year = $year + 1;
                                                                                    $total_work_month = $total_work_month - 12;
                                                                                    $y++;
                                                                                } else {
                                                                                    $y = 0;
                                                                                }
                                                                            }


                                                                            echo $year;
                                                                            echo "&nbsp";
                                                                            echo "Year";
                                                                            echo "&nbsp";
                                                                            if ($total_work_month != 0) {
                                                                                echo $total_work_month;
                                                                                echo "&nbsp";
                                                                                echo "Month";
                                                                            }
                                                                        }
                                                                        ?>
                                                                            </span>
                                                                        </li>
                                                                            <?php
                                                                            } else {

                                                                                if ($row['experience'] == 'Fresher') {
                                                                                    ?>
                                                                            <li> <b> Total Experience</b>
                                                                                <span><?php echo $row['experience']; ?></span>
                                                                            </li>
                                                                                <?php
                                                                                } //if complete
                                                                            }//else complete
                                                                            ?>
                                                                    <?php
                                                                    //  $countryname = $this->db->get_where('countries', array('country_id' => $row['country_id']))->row()->country_name;
                                                                    // $cityname = $this->db->get_where('cities', array('city_id' => $row['city_id']))->row()->city_name;
                                                                    ?>
                                                                        <!--   <li><b>Location</b> <span>
        <?php
        //if($cityname){echo $cityname;echo ', ';}
        //echo $countryname;
        ?> 
                                                                                       </span></li> -->


                                                                    <?php if ($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']) { ?>
                                                                        <li>
                                                                            <b>Degree</b><span>
                                                                        <?php
                                                                        $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </li>
                                                                            <?php
                                                                            } elseif ($row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']) {
                                                                                ?>
                                                                        <li>
                                                                            <b>Degree</b><span>


                                                                                <?php
                                                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </li>


                                                                            <?php } elseif ($row['board_higher_secondary'] && $row['degree']) {
                                                                                ?>

                                                                        <li>
                                                                            <b>Degree</b><span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </li>

        <?php } else if ($row['board_secondary'] && $row['degree']) {
            ?>
                                                                        <li>
                                                                            <b>Degree</b><span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
            <?php
            $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
            if ($cache_time) {
                echo $cache_time;
            } else {
                echo PROFILENA;
            }
            ?>
                                                                            </span>
                                                                        </li>

        <?php } elseif ($row['board_primary'] && $row['degree']) { ?>
                                                                        <li>
                                                                            <b>Degree</b><span>
                                                                                <?php
                                                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                                if ($cache_time) {
                                                                                    echo $cache_time;
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
                                                                        <?php
                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>
                                                                            </span>
                                                                        </li>

                                                                            <?php } elseif ($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary']) { ?>
                                                                        <li><b>Board of Higher Secondary</b>
                                                                            <span>
            <?php echo $row['board_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Higher Secondary</b>
                                                                            <span>
                                                                                <?php echo $row['percentage_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>


                                                                            <?php } elseif ($row['board_secondary'] && $row['board_higher_secondary']) { ?>
                                                                        <li><b>Board of Higher Secondary</b>
                                                                            <span>
            <?php echo $row['board_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Higher Secondary</b>
                                                                            <span>
                                                                                <?php echo $row['percentage_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>

        <?php } elseif ($row['board_primary'] && $row['board_higher_secondary']) { ?>


                                                                        <li><b>Board of Higher Secondary</b>
                                                                            <span>
            <?php echo $row['board_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Higher Secondary</b>
                                                                            <span>
                                                                                <?php echo $row['percentage_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>


                                                                            <?php } elseif ($row['board_primary'] && $row['board_secondary']) { ?>

                                                                        <li><b>Board of Secondary</b>
                                                                            <span>
                                                                        <?php echo $row['board_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Secondary</b>
                                                                            <span>
                                                                                <?php echo $row['percentage_secondary']; ?>
                                                                            </span>
                                                                        </li>

                                                                            <?php } elseif ($row['degree']) { ?>

                                                                        <li>
                                                                            <b>Degree</b><span>


                                                                        <?php
                                                                        $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>

                                                                            </span>
                                                                        </li>
                                                                        <li><b>Stream</b>
                                                                            <span>
                                                                        <?php
                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>
                                                                            </span>
                                                                        </li>

                                                                            <?php } elseif ($row['board_higher_secondary']) { ?>

                                                                        <li><b>Board of Higher Secondary</b>
                                                                            <span>
            <?php echo $row['board_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Higher Secondary</b>
                                                                            <span>
                                                                                <?php echo $row['percentage_higher_secondary']; ?>
                                                                            </span>
                                                                        </li>


                                                                            <?php } elseif ($row['board_secondary']) { ?> 

                                                                        <li><b>Board of Secondary</b>
                                                                            <span>
            <?php echo $row['board_secondary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Secondary</b>
                                                                            <span>
            <?php echo $row['percentage_secondary']; ?>
                                                                            </span>
                                                                        </li>

        <?php } elseif ($row['board_primary']) { ?>

                                                                        <li><b>Board of Primary</b>
                                                                            <span>
            <?php echo $row['board_primary']; ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><b>Percentage of Primary</b>
                                                                            <span>
            <?php echo $row['percentage_primary']; ?>
                                                                            </span>
                                                                        </li>

        <?php } ?>

                                                                    <li><b>E-mail</b><span>
                                                                            <?php
                                                                            if ($row['email']) {
                                                                                echo $row['email'];
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>
                                                                    </li>

                                                                            <?php
                                                                            if ($row['phnno']) {
                                                                                ?>
                                                                        <li><b>Mobile Number</b><span>
                                                                                <?php
                                                                                echo $row['phnno'];
                                                                                ?></span>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="apply-btn fr">
                                                                            <?php
                                                                            $userid = $this->session->userdata('aileenuser');
                                                                            $contition_array = array('from_id' => $userid, 'to_id' => $row['iduser'], 'save_type' => 1, 'status' => '0');
                                                                            $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                            if ($userid != $row['iduser']) {
                                                                                if (!$data) {
                                                                                    ?> 

                                                                            <a href="<?php echo base_url('chat/abc/2/1/' . $row['iduser']); ?>">Message</a> 

                                                                            <!--                     <a href="#">Invite</a>-->

                                                                            <input type="hidden" id="<?php echo 'hideenuser' . $row['iduser']; ?>" value= "<?php echo $data[0]['save_id']; ?>">

                                                                            <a id="<?php echo $row['iduser']; ?>" onClick="savepopup(<?php echo $row['iduser']; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $row['iduser']; ?>">Save</a>

                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="<?php echo base_url('chat/abc/2/1/' . $row['iduser']); ?>">Message</a> 

                                                                            <a class="saved">Saved</a> 
                                                                        <?php }
                                                                    }
                                                                    ?> 
                                                                </div> </div>
                                                            <!--  <div class="profile-job-profile-button clearfix">
                                                                   
                                                                  </div> -->
                                                        </div>
                                                    </div>
        <?php
    }
    //} 
} elseif ($recruiterdata == NULL) {
    ?>
                                                <div class="text-center rio" style="border: none;">
                                                    <div class="no-post-title">
                                                        <h4 class="page-heading  product-listing" style="border:0px;">Let's create your job post.</h4>
                                                        <h4 class="page-heading  product-listing" style="border:0px;"> It will takes only few minutes.</h4>
                                                    </div>
                                                    <div  class="add-post-button add-post-custom">
                                                        <a class="btn btn-3 btn-3b"  href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
                                                    </div> 
                                                </div>
                                                            <?php
                                                            } else {
                                                                ?>
                                                <div class="art-img-nn">
                                                    <div class="art_no_post_img">

                                                        <img src="<?php echo base_url('img/job-no1.png') ?>">

                                                    </div>
                                                    <div class="art_no_post_text">
                                                        No Recommended  Candidate  Available.
                                                    </div>
                                                </div>
<?php }
?>




                                            <!-- khyati end -->
                                            <div class="col-md-1">
                                            </div>
                                        </div>
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
       <!-- BID MODAL START -->
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
      <!-- BID MODAL END-->
      <!-- START FOOTER -->
        <footer>
     <?php echo $footer; ?>
        </footer>
        <!-- END FOOTER -->
        
         
        <!-- FIELD VALIDATION JS START -->
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
        <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>

        <script>
                                                                var base_url = '<?php echo base_url(); ?>';
                                                                var data1 = <?php echo json_encode($de); ?>;
                                                                var data = <?php echo json_encode($demo); ?>;
                                                                var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                                                var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <!-- FIELD VALIDATION JS END -->

    </body>
</html>