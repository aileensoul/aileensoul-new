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
            <div class="container mt-22" id="paddingtop_fixed">

                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result" onclick="">Cancel</button>

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
                        <div id="upload-demo-i" ></div>
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
                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 're_status' => '1');
                        $image = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $image_ori = $this->config->item('rec_bg_main_upload_path') . $image[0]['profile_background'];
                        if (file_exists($image_ori) && $image[0]['profile_background'] != '') {
                            ?>

                            <img src="<?php echo base_url($this->config->item('rec_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>

                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             <?php }
                             ?>

                    </div>
                </div>
            </div>



            <div class="container tablate-container art-profile">    
                <div class="upload-img">


                    <label class="cameraButton"><span class="tooltiptext_rec">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                        <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                    </label>

                </div>
                <!-- </div>
                -->
                <!-- </div>
                -->   
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic padd_img">


                            <?php
                            $imageee = $this->config->item('rec_profile_thumb_upload_path') . $recruiterdata[0]['recruiter_user_image'];
                            if (file_exists($imageee) && $recruiterdata[0]['recruiter_user_image'] != '') {
                                ?>
                                <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recruiterdata[0]['recruiter_user_image']); ?>" alt="" >
                            <?php
                            } else {


                                $a = $recruiterdata[0]['rec_firstname'];
                                $acr = substr($a, 0, 1);

                                $b = $recruiterdata[0]['rec_lastname'];
                                $acr1 = substr($b, 0, 1);
                                ?>
                                <div class="post-img-user">
    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                </div>

<?php } ?>

                            <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                        </div>


                    </div>
                    <div class="job-menu-profile mob-block">
                        <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata[0]['userid']); ?>"><h3><?php echo $recruiterdata[0]['rec_firstname'] . ' ' . $recruiterdata[0]['rec_lastname']; ?></h3></a>
                        <!-- text head start -->
                        <div class="profile-text" >

                            <?php
                            if ($recruiterdata[0]['designation'] == "") {
                                ?>

                                <a id="designation" class="designation" title="Designation">Designation</a>
                            <?php
                            } else {
                                // echo "hello";
                                ?> 

                                <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recruiterdata[0]['designation'])); ?>"><?php echo ucfirst(strtolower($recruiterdata[0]['designation'])); ?></a>
<?php } ?>

                        </div>







                        <!-- text head end -->
                    </div>
                    <!-- menubar -->
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

                        <div class=" right-side-menu art-side-menu padding_less_right right-menu-jr">  

<?php
$userid = $this->session->userdata('aileenuser');
if ($recruiterdata[0]['user_id'] == $userid) {
    ?>     
                                <ul class="current-user pro-fw">

                            <?php } else { ?>
                                    <ul class="pro-fw4">
                                <?php } ?>  
                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>">Details</a>
                                    </li>


<?php if (($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'rec_post' || $this->uri->segment(2) == 'rec_profile' || $this->uri->segment(2) == 'add_post' || $this->uri->segment(2) == 'save_candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                                        </li>


                                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
                                        </li> 
                                        <fa>
                                            </li> 


<?php } ?>   

                                </ul>
                        </div>

                    </div>  
                    <!-- menubar -->                
                </div>                        

            </div>
            <div  class="add-post-button mob-block">
<?php if ($returnpage == '') { ?>
                    <a class="btn btn-3 btn-3b" style="background: -o-linear-gradient(top, rgba(248,48,125,1) 0%, rgba(27,138,185,1) 0%, rgba(190,199,202,1) 90%, rgba(204,204,204,1) 98%, rgba(242,230,235,1) 100%);" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
                <?php } ?>
            </div>

            <div class="middle-part container rec_res">    
                <div class="job-menu-profile mob-none  pt20">
                    <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata[0]['userid']); ?>"><h5><?php echo $recruiterdata[0]['rec_firstname'] . ' ' . $recruiterdata[0]['rec_lastname']; ?></h5></a>
                    <!-- text head start -->
                    <div class="profile-text" >

<?php
if ($recruiterdata[0]['designation'] == "") {
    ?>

                            <a id="designation" class="designation" title="Designation">Designation</a>
                        <?php
                        } else {
                            // echo "hello";
                            ?> 

                            <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recruiterdata[0]['designation'])); ?>"><?php echo ucfirst(strtolower($recruiterdata[0]['designation'])); ?></a>
                        <?php } ?>

                    </div>




                    <div  class="add-post-button">
<?php if ($returnpage == '') { ?>
                            <a class="btn btn-3 btn-3b" style="background: -o-linear-gradient(top, rgba(248,48,125,1) 0%, rgba(27,138,185,1) 0%, rgba(190,199,202,1) 90%, rgba(204,204,204,1) 98%, rgba(242,230,235,1) 100%);" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
<?php } ?>
                    </div>



                    <!-- text head end -->
                </div>
                <!-- <?php //echo "<pre>"; print_r($recdata);die(); ?> -->
                <div class="col-md-7 col-sm-12 mob-clear">
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3>Saved Candidate</h3>
                            <div class="contact-frnd-post">

<?php
               
if ($savedata) {
    foreach ($savedata as $rec) {


        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('from_id' => $userid, 'save_id' => $rec['save_id']);
        $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        if ($userdata[0]['status'] != 1) {
            ?>
                                            <div class="job-contact-frnd ">
                                                <div class="profile-job-post-detail clearfix" id="<?php echo "removeuser" . $userdata[0]['save_id']; ?>">

                                                    <div class="profile-job-post-title-inside clearfix">


                                                        <div class="profile-job-profile-button clearfix"> 



                                                            <div class="profile-job-post-location-name-rec">
                                                                <div style="display: inline-block; float: left;">
                                                                    <div class="buisness-profile-pic-candidate" >
                                                                                                    <!-- <rash code 12-4 start> -->

            <?php
            $imageee = $this->config->item('job_profile_thumb_upload_path') . $rec['job_user_image'];
            if (file_exists($imageee) && $rec['job_user_image'] != '') {
                ?>
                                                                            <a href="<?php echo base_url('job/job_printpreview/' . $rec['userid'] . '?page=recruiter'); ?>" title="<?php echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?>"> 
                                                                                <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $rec['job_user_image']); ?>" alt="<?php echo $rec[0]['fname'] . ' ' . $rec[0]['lname']; ?>"></a>
                                                                            <?php
                                                                        } else {
                                                                            ?> 
                                                                                <!-- <a href="<?php //echo base_url('job/job_printpreview/' . $rec['userid'].'?page=recruiter'); ?>" title="<?php ///echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?>"> 
                                                                            -->
                <?php
                $a = $rec['fname'];
                $acr = substr($a, 0, 1);

                $b = $rec['lname'];
                $acr1 = substr($b, 0, 1);
                ?>
                                                                            <div class="post-img-profile">
                                                                            <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                                                            </div>



                              <!--  <img src="<?php //echo base_url(NOIMAGE); ?>" alt="<?php //echo $rec[0]['fname']. ' ' . $rec[0]['lname']; ?>"> </a>
                                                                            -->     

                <?php
            }
            ?>

                            <!-- <rash code 12-4 end> -->

                                                                    </div>
                                                                </div>


                                                                <div class="designation_rec_1 fl ">
                                                                    <ul>
                                                                        <li> 
                                                                            <a class="post_name"  href="<?php echo base_url('job/job_printpreview/' . $rec['userid'] . '?page=recruiter'); ?>" title="<?php echo $rec[0]['fname'] . ' ' . $rec[0]['lname']; ?>">
            <?php echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?></a>
                                                                        </li>

                                                                        <li style="display: block;">

                                                                            <a class="post_designation"  href="javascript:void(0)" title=" <?php echo $rec['designation']; ?>">
            <?php
            if ($rec['designation']) {
                ?>
                <?php echo $rec['designation']; ?>
                <?php
            } else {
                ?>
                                                                                    <?php echo "Designation"; ?>
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

                                                    <div class="profile-job-post-title clearfix">

                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">

            <?php
            if ($rec['work_job_title']) {
                $contition_array = array('status' => 'publish', 'title_id' => $rec['work_job_title']);
                $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                ?>
                                                                    <li> <b> Job Title</b> <span>
                <?php echo $jobtitle[0]['name']; ?>
                                                                        </span>
                                                                    </li>

                                                                <?php } ?>

                                                                <?php
                                                                if ($rec['keyskill']) {
                                                                    $detailes = array();
                                                                    $work_skill = explode(',', $rec['keyskill']);
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
                                                                if ($rec['work_job_industry']) {
                                                                    $contition_array = array('industry_id' => $rec['work_job_industry']);
                                                                    $industry = $this->common->select_data_by_condition('job_industry', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    ?>
                                                                    <li> <b> Industry</b> <span>
                                                                    <?php echo $industry[0]['industry_name']; ?>
                                                                        </span>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php
                                                                if ($rec['work_job_city']) {
                                                                    $cities = array();
                                                                    $work_city = explode(',', $rec['work_job_city']);
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
                                                                $contition_array = array('user_id' => $rec['userid'], 'experience' => 'Experience', 'status' => '1');

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

                                                                            if ($rec['experience'] == 'Fresher') {
                                                                                ?>
                                                                        <li> <b> Total Experience</b>
                                                                            <span><?php echo $rec['experience']; ?></span>
                                                                        </li>
                                                                            <?php
                                                                            } //if complete
                                                                        }//else complete
                                                                        ?>                                                              


                                                                <?php if ($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']) { ?>
                                                                    <li>
                                                                        <b>Degree</b><span>
                                                                    <?php
                                                                    $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                                                                            $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                            if ($cache_time) {
                                                                                echo $cache_time;
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </li>
            <?php
            } elseif ($rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']) {
                ?>
                                                                    <li>
                                                                        <b>Degree</b><span>


                                                                            <?php
                                                                            $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                if ($cache_time) {
                    echo $cache_time;
                } else {
                    echo PROFILENA;
                }
                ?>
                                                                        </span>
                                                                    </li>


            <?php } elseif ($row['board_higher_secondary'] && $rec['degree']) {
                ?>

                                                                    <li>
                                                                        <b>Degree</b><span>
                                                                            <?php
                                                                            $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                                                                    $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                    if ($cache_time) {
                                                                        echo $cache_time;
                                                                    } else {
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } else if ($rec['board_secondary'] && $rec['degree']) {
                                                                            ?>
                                                                    <li>
                                                                        <b>Degree</b><span>
                <?php
                $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                if ($cache_time) {
                    echo $cache_time;
                } else {
                    echo PROFILENA;
                }
                ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } elseif ($rec['board_primary'] && $rec['degree']) { ?>
                                                                    <li>
                                                                        <b>Degree</b><span>
                <?php
                $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                                                                            $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                            if ($cache_time) {
                                                                                echo $cache_time;
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } elseif ($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary']) { ?>
                                                                    <li><b>Board of Higher Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>
                <?php echo $rec['percentage_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>


                                                                        <?php } elseif ($rec['board_secondary'] && $rec['board_higher_secondary']) { ?>
                                                                    <li><b>Board of Higher Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>
                <?php echo $rec['percentage_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } elseif ($rec['board_primary'] && $rec['board_higher_secondary']) { ?>


                                                                    <li><b>Board of Higher Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>
                                                                    <?php echo $rec['percentage_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>


            <?php } elseif ($rec['board_primary'] && $rec['board_secondary']) { ?>

                                                                    <li><b>Board of Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Secondary</b>
                                                                        <span>
                <?php echo $rec['percentage_secondary']; ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } elseif ($rec['degree']) { ?>

                                                                    <li>
                                                                        <b>Degree</b><span>


                <?php
                $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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
                                                                            $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                            if ($cache_time) {
                                                                                echo $cache_time;
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </li>

                                                                        <?php } elseif ($rec['board_higher_secondary']) { ?>

                                                                    <li><b>Board of Higher Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Higher Secondary</b>
                                                                        <span>
                <?php echo $rec['percentage_higher_secondary']; ?>
                                                                        </span>
                                                                    </li>


                                                                        <?php } elseif ($rec['board_secondary']) { ?> 

                                                                    <li><b>Board of Secondary</b>
                                                                        <span>
                                                                            <?php echo $rec['board_secondary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Secondary</b>
                                                                        <span>
                <?php echo $rec['percentage_secondary']; ?>
                                                                        </span>
                                                                    </li>

            <?php } elseif ($rec['board_primary']) { ?>

                                                                    <li><b>Board of Primary</b>
                                                                        <span>
                <?php echo $rec['board_primary']; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li><b>Percentage of Primary</b>
                                                                        <span>
                <?php echo $rec['percentage_primary']; ?>
                                                                        </span>
                                                                    </li>

            <?php } ?>

                                                                <li><b>E-mail</b><span>
                                                                        <?php
                                                                        if ($rec['email']) {
                                                                            echo $rec['email'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></span>
                                                                </li>

                                                                <?php
                                                                if ($rec['phnno']) {
                                                                    ?>
                                                                    <li><b>Mobile Number</b><span>
                                                                            <?php
                                                                            echo $rec['phnno'];
                                                                            ?></span>
                                                                    </li>
                                                                            <?php
                                                                        }
                                                                        ?>



                                                            </ul>
                                                        </div>
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="apply-btn fr" >
                                                                        <?php $userid = $this->session->userdata('aileenuser');
                                                                        if ($userid != $rec['userid']) {
                                                                            ?>
                                                                    <a href="<?php echo base_url('chat/abc/2/1/' . $rec['userid']); ?>">Message</a>
                                                                    <!--<a href="#popup1" class="button">Remove Candidate </a>-->
                                                                    <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $rec['save_id'] ?>)">Remove</a>
            <?php } ?>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                                        <?php }
                                                                    ?>
                                        </div>
                                                                <?php }
                                                            } else {
                                                                ?>
                                    <div class="art-img-nn">
                                        <div class="art_no_post_img">

                                            <img src="<?php echo base_url('img/job-no1.png') ?>">

                                        </div>
                                        <div class="art_no_post_text">
                                            No Saved Candidate  Available.
                                        </div>
                                    </div>
                                                    <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- MIDDLE SECTION END-->
        </section>
        <!-- END CONTAINER -->

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
        <!-- BID MODAL END -->
        <!-- BEGIN FOOTER -->
<?php echo $footer; ?>
        <!-- END FOOTER -->
        <!-- FIELD VALIDATION JS START -->
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script>

        <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>

        <!-- THIS SCRIPT ALWAYS PUT UNDER FANCYBOX JS-->
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script> 

        <!--SCRIPT FOR DATE START-->

        <script src="<?php echo base_url('js/jquery.date-dropdowns.js'); ?>"></script>

        <script>
                                                        var base_url = '<?php echo base_url(); ?>';
                                                        var data1 = <?php echo json_encode($de); ?>;
                                                        var data = <?php echo json_encode($demo); ?>;
                                                        var jobdata = <?php echo json_encode($jobtitle); ?>;
                                                        var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                                        var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <!-- FIELD VALIDATION JS END -->
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/search.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/saved_candidate.js'); ?>"></script>


        <style type="text/css">

            .keyskill_border_active {
                border: 3px solid #f00 !important;

            }
            #skills-error{margin-top: 40px !important;}

            #minmonth-error{    margin-top: 40px; margin-right: 9px;}
            #minyear-error{margin-top: 42px !important;margin-right: 9px;}
            #maxmonth-error{margin-top: 42px !important;margin-right: 9px;}
            #maxyear-error{margin-top: 42px !important;margin-right: 9px;}

            #minmonth-error{margin-top: 39px !important;}
            #minyear-error{margin-top: auto !important;}
            #maxmonth-error{margin-top: 39px !important;}
            #maxyear-error{margin-top: auto !important;}
            #example2-error{margin-top: 40px !important}


        </style>
    </body>
</html>