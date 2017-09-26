<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<!--        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/recruiter/recruiter.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
    </head> <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css') ;?>" />
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php //if ($recdata[0]['re_step'] == 3) { ?>
            <?php //echo $recruiter_header2_border; ?>
        <?php //} ?>
        <?php
 $returnpage= $_GET['page'];
 if($returnpage == 'job'){
     echo $job_header2_border; 
 }
 elseif($recdata[0]['re_step'] == 3){
  echo $recruiter_header2_border; 
 }
 elseif($returnpage == 'notification'){

 }
?>
        <div id="preloader"></div>
        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="container mt-22" id="paddingtop_fixed">

                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic">
                        <button class="btn btn-success  cancel-result" onclick="">Cancel</button>

                        <button class="btn btn-success  upload-result set-btn" onclick="myFunction()">Save</button>

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
                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 're_status' => '1');
                        $image = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $image_ori = $this->config->item('rec_bg_main_upload_path') . $image[0]['profile_background'];
                        if (file_exists($image_ori) && $image[0]['profile_background'] != '') {
                            ?>

                            <img src="<?php echo base_url($this->config->item('rec_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>

                             <div class="bg-images no-cover-upload">
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             </div>
                             <?php }
                             ?>

                    </div>
                </div>
            </div>

            <div class="container tablate-container art-profile">




                <?php if ($returnpage == '') { ?>
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
                            $imageee = $this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image'];
                            if (file_exists($imageee) && $recdata[0]['recruiter_user_image'] != '') {
                                ?>
                                <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image']); ?>" alt="" >
                                <?php
                            } else {
                                $a = $recdata[0]['rec_firstname'];
                                $acr = substr($a, 0, 1);

                                $b = $recdata[0]['rec_lastname'];
                                $acr1 = substr($b, 0, 1);
                                ?>
                                <div class="post-img-user">
                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                </div>
                            <?php } ?>
                            <?php if ($returnpage == '') { ?>
                                <a class="cusome_upload" href="javascript:void(0);" onclick="updateprofilepopup();"><img src="<?php echo base_url(); ?>img/cam.png"> Update Profile Picture</a>
                            <?php } ?>
                        </div>
                    </div>
                    <!--PROFILE PIC CODE END-->
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>"><h3><?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?></h3></a>
                        <!-- text head start -->
                        <div class="profile-text" >




                            <?php 
                            if ($returnpage == '') {
                                if ($recdata[0]['designation'] == '') {
                                    ?>
                <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else {
                                    ?> 
                 <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                                    <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>"><?php echo ucfirst(strtolower($recdata[0]['designation'])); ?></a>
                                    <?php
                                }
                            } else {


                                if ($recdata[0]['designation'] == '') {
                                    ?>
                                    <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else {  ?>
                                    <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>"> <?php echo ucfirst(strtolower($recdata[0]['designation'])); ?></a> <?php
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <!-- menubar -->
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

                        <div class=" right-side-menu art-side-menu padding_less_right job_edit_pr right-menu-jr">  

                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($recdata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">

                                    <?php } else { ?>
                                    <ul class="pro-fw4">
<?php } ?>  

                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'profile') { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'job') { ?>
                                            <a title="Details" href="<?php echo base_url('recruiter/profile/' . $this->uri->segment(3) . '?page=' . $returnpage); ?>">Details</a>
                                        <?php } else { ?>
                                            <a title="Details" href="<?php echo base_url('recruiter/profile'); ?>">Details</a>
<?php } ?>
                                    </li>



<?php if (($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'post' || $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'add-post' || $this->uri->segment(2) == 'save-candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '' || $this->uri->segment(3) != '')) { ?>

                                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'post') { ?> class="active" <?php } ?>>
                                            <?php if ($returnpage == 'job') { ?>
                                                <a title="Post" href="<?php echo base_url('recruiter/post/' . $this->uri->segment(3) . '?page=' . $returnpage); ?>">Post</a>
                                            <?php } else { ?>
                                                <a title="Post" href="<?php echo base_url('recruiter/post'); ?>">Post</a>
    <?php } ?>
                                        </li>


                                    <?php } ?>    

<?php if (($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'post' || $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'add-post' || $this->uri->segment(2) == 'save-candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save-candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" href="<?php echo base_url('recruiter/save-candidate'); ?>">Saved </a>
                                        </li> 




<?php } ?>               
                                </ul>

                              
                                            <?php if ($this->uri->segment(3) != "" && $this->uri->segment(3) != $userid) { ?>
                                      <div class="flw_msg_btn fr">
                                    <ul>      
                                    <li>
                                                <?php
                                                $returnpage = $_GET['page'];

                                                if ($returnpage == "job") {
                                                    ?>

                                                    <a href="<?php echo base_url('chat/abc/1/2/' . $this->uri->segment(3)); ?>">Message</a>
    <?php } else { ?>
                                                    <a href="<?php echo base_url('chat/abc/2/1/' . $this->uri->segment(3)); ?>">Message</a>

    <?php } ?>




                                            </li> 
   </ul>
                                </div>
 <?php } ?>  
                        </div>

                    </div>  


                </div>            
            </div>
            <div  class="add-post-button mob-block">
                <?php if ($returnpage == '') { ?>
                    <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add-post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
<?php } ?>
            </div>
            <!-- menubar --> 
            <div class="middle-part container rec_res">
                <div class="job-menu-profile  mob-none ">
                    <a href="javascript:void(0);" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>"><h3><?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?></h3></a>
                    <!-- text head start -->
                    <div class="profile-text" >

                        <?php
                        if ($returnpage == '') {
                            if ($recdata[0]['designation'] == "") {
                                ?>

                                <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php
                            } else {
                                ?> 
                                <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                                <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>"><?php echo ucfirst(strtolower($recdata[0]['designation'])); ?></a>
                            <?php
                            }
                        } else {
                           if ($recdata[0]['designation'] == '') {
                                    ?>
                                    <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else {  ?>
                                    <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>"> <?php echo ucfirst(strtolower($recdata[0]['designation'])); ?></a> <?php
                                }
                        }
                        ?>

                    </div>

                    <div  class="add-post-button">
                        <?php if ($returnpage == '') { ?>
                            <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add-post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
<?php } ?>
                    </div>
                </div>
                <!-- text head end -->

                <div class="col-md-7 col-sm-12 mob-clear">
                    <div class="common-form">
                        <div class="job-saved-box">

                            <h3>Details  </h3>

                            <?php

                            function text2link($text) {
                                $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                return $text;
                            }
                            ?>  
                            <div class="contact-frnd-post">
                                <div class="job-contact-frnd ">
                                    <div class="profile-job-post-detail clearfix">
                                        <div class="profile-job-post-title clearfix">
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li> <p class="details_all_tital "> Basic Information</p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Name</b> <span> 
                                                                <?php
                                                                if ($recdata[0]['rec_firstname'] || $recdata[0]['rec_lastname']) {
                                                                    echo $recdata[0]['rec_firstname'] . '  ' . $recdata[0]['rec_lastname'];
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?> </span>
                                                        </li>

                                                        <li> <b>Email </b><span> 
                                                                <?php
                                                                if ($recdata[0]['rec_email']) {
                                                                    echo $recdata[0]['rec_email'];
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?> </span>
                                                        </li>



                                                        <?php
                                                        if ($returnpage == 'job') {

                                                            if ($recdata[0]['rec_phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $recdata[0]['rec_phone']; ?>

                                                                    </span> </li>

                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['rec_phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $recdata[0]['rec_phone']; ?>

                                                                    </span> </li>

                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Phone Number </b> <span>
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

                                                            <li><p class="details_all_tital ">Company Information</p></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b>Company Name</b><span><?php
                                                                if ($recdata[0]['re_comp_name']) {
                                                                    echo $recdata[0]['re_comp_name'];
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?></span>
                                                        </li>
                                                        <li><b> Company Email Address</b> <span><?php
                                                                if ($recdata[0]['re_comp_email']) {
                                                                    echo $recdata[0]['re_comp_email'];
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?></span> </li>
                                                        <li> <b>Company Phone Number</b><span> <?php
                                                                if ($recdata[0]['re_comp_phone']) {
                                                                    echo $recdata[0]['re_comp_phone'];
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?></span>
                                                        </li>




                                                        <?php
                                                        if ($returnpage == 'job') {

                                                            if ($recdata[0]['re_comp_site']) {
                                                                ?>
                                                                <li> <b>Company Website</b><span><a target="_blank"><?php
                                                                    echo $this->common->rec_profile_links($recdata[0]['re_comp_site']);
                                                                ?></a></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['re_comp_site']) {
                                                                ?>
                                                                <li> <b>Company Website</b><span><a target="_blank"><?php
                                                                    echo $this->common->rec_profile_links($recdata[0]['re_comp_site']);
                                                                ?></a></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b> Company Website </b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <li> <b> Country</b> <span><?php
                                                                $cache_time = $this->db->get_where('countries', array('country_id' => $recdata[0]['re_comp_country']))->row()->country_name;

                                                                if ($cache_time) {
                                                                    echo $cache_time;
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?></span>
                                                        </li>

                                                        <li> <b>State </b><span> <?php
                                                                $cache_time = $this->db->get_where('states', array('state_id' => $recdata[0]['re_comp_state']))->row()->state_name;
                                                                if ($cache_time) {
                                                                    echo $cache_time;
                                                                } else {
                                                                    echo PROFILENA;
                                                                }
                                                                ?> </span>
                                                        </li>

                                                        <?php
                                                        if ($returnpage == 'job') {
                                                            if ($recdata[0]['re_comp_city']) {
                                                                ?>
                                                                <li><b> City</b> <span><?php
                                                                        $cache_time = $this->db->get_where('cities', array('city_id' => $recdata[0]['re_comp_city']))->row()->city_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        }
                                                                        ?></span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['re_comp_city']) {
                                                                ?>
                                                                <li><b> City</b> <span><?php
                                                                        $cache_time = $this->db->get_where('cities', array('city_id' => $recdata[0]['re_comp_city']))->row()->city_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        }
                                                                        ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>City</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                        <?php
                                                        if ($returnpage == 'job') {
                                                            if ($recdata[0]['re_comp_sector']) {
                                                                ?>
                                                                <li><b>Skill/Sector I Hire For</b><span><pre><?php echo $this->common->make_links($recdata[0]['re_comp_sector']); ?></pre></span></li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['re_comp_sector']) {
                                                                ?>
                                                                <li><b>Skill/Sector I Hire For</b><span><pre><?php echo $this->common->make_links($recdata[0]['re_comp_sector']); ?></pre></span></li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Skill/Sector I  Hire For</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                        <?php
                                                        if ($returnpage == 'job') {
                                                            if ($recdata[0]['re_comp_profile']) {
                                                                ?>
                                                                <li><b>Company Profile</b> <span><pre>
                                                                            <?php
                                                                echo $this->common->make_links($recdata[0]['re_comp_profile']);
                                                                ?></pre></span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['re_comp_profile']) {
                                                                ?>
                                                                <li><b>Company Profile</b> <span><pre>
                                                                            <?php
                                                                echo $this->common->make_links($recdata[0]['re_comp_profile']);
                                                                ?></pre></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Company Profile</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($returnpage == 'job') {
                                                            if ($recdata[0]['re_comp_activities']) {
                                                                ?>
                                                                <li><b> Other Activities</b> <span>
                                                                        <pre>  <?php
                                                                echo $this->common->make_links($recdata[0]['re_comp_activities']);
                                                                ?></pre> </span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['re_comp_activities']) {
                                                                ?>
                                                                <li><b> Other Activities</b> <span>
                                                                        <pre>  <?php
                                                                echo $this->common->make_links($recdata[0]['re_comp_activities']);
                                                                ?></pre> </span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Other Activities</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($returnpage == 'job') {
                                                            if ($recdata[0]['comp_logo']) {
                                                                ?>
                                                                <li><b>Company Logo</b> <span>
                                                                        <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['comp_logo']) ?>"  style="width:100px;height:100px;" class="job_education_certificate_img" >
                                                                    </span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($recdata[0]['comp_logo']) {
                                                                ?>
                                                                <li><b>Company Logo</b> <span>
                                                                        <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['comp_logo']) ?>"  style="width:100px;height:100px;" class="job_education_certificate_img" >

                                                                    </span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Company Logo</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>



                                                    </ul>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="clearfix"></div>  
            </div>
			

            <!-- MIDDLE SECTION END-->
        </section>
        <!-- END CONTAINER -->

        <!--PROFILE PIC MODEL START-->
      <div class="modal fade message-box" id="bidmodal-2" role="dialog">
         <div class="modal-dialog modal-lm">
            <div class="modal-content">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>      
               <div class="modal-body">
                  <span class="mes">
                     <div id="popup-form">

                        <div class="fw" id="profi_loader"  style="display:none;" style="text-align:center;" ><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
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
        <!-- BEGIN FOOTER -->
<?php echo $footer; ?>
        <!-- END FOOTER -->
        <!-- FIELD VALIDATION JS START -->
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script> 
        <!--<script type="text/javascript" src="<?php //echo base_url('js/jquery.validate.js'); ?>"></script>-->
       <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js?ver='.time()); ?>"></script>
        <script>
                                    var base_url = '<?php echo base_url(); ?>';
                                    //var data1 = <?php// echo json_encode($de); ?>;
                                   // var data = <?php //echo json_encode($demo); ?>;
                                    var jobdata = <?php echo json_encode($jobtitle); ?>;
                                    var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                    var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <!-- FIELD VALIDATION JS END -->
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/search.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/rec_profile.js'); ?>"></script>


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