<?php
echo $head;
?>
<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<?php
$returnpage = $_GET['page'];
if ($returnpage == 'recruiter') {
    echo $recruiter_header2_border;
} else {
    echo $job_header2_border;
}
?>

<!-- This style is used for autocomplete start -->
 <style type="text/css">

/* Layout helpers
----------------------------------*/
.ui-helper-hidden {
  display: none;
}
.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.ui-front {
  z-index: 100;
}



/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  cursor: default;
}

.ui-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: block;
  outline: none;
}
.ui-menu .ui-menu {
  position: absolute;
}
.ui-menu .ui-menu-item {
  position: relative;
  margin: 0;
  padding: 3px 1em 3px .4em;
  cursor: pointer;
  min-height: 0; /* support: IE7 */
  /* support: IE10, see #8844 */
  list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
}
.ui-menu .ui-menu-divider {
  margin: 5px 0;
  height: 0;
  font-size: 0;
  line-height: 0;
  border-width: 1px 0 0 0;
}
.ui-menu .ui-state-focus,
.ui-menu .ui-state-active {
  margin: -1px;
}

/* Component containers
----------------------------------*/
.ui-widget {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1.1em;
}
.ui-widget .ui-widget {
  font-size: 1em;
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1em;
}
.ui-widget-content {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_flat_75_ffffff_40x100.png") 50% 50% repeat-x;
  color: #222222;
}
.ui-widget-content a {
  color: #222222;
}
.ui-widget-header {
  border: 1px solid #aaaaaa;
  background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
  color: #222222;
  font-weight: bold;
}
.ui-widget-header a {
  color: #222222;
}

/* Interaction states
----------------------------------*/
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
  border: 1px solid #d3d3d3;
  background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #555555;
}

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
  border: 1px solid #999999;
  background: #dadada url("images/ui-bg_glass_75_dadada_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_glass_65_ffffff_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

  </style>
<!-- This style is used for autocomplete End -->
<body   class="page-container-bg-solid page-boxed">
    <section class="custom-row">
        <div class="container  " id="paddingtop_fixed">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo"></div>
                </div>
                <div class="col-md-12 cover-pic" >
                    <button class="btn btn-success  cancel-result" onclick="" >Cancel</button>
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
                        $image = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        //echo "<pre>"; print_r($image); die();

                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>
                            <img src="<?php echo base_url($this->config->item('job_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
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
        <div class="container tablate-container art-profile  ">
            <?php if ($returnpage == '') { ?>
                <div class="upload-img ">
                    <label class="cameraButton"> <span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                        <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                    </label>
                </div>
            <?php } ?>
            <div class="profile-photo">
                <div class="profile-pho">
                    <div class="user-pic padd_img">
                        <?php if ($job[0]['job_user_image'] != '') { ?>
                            <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $job[0]['job_user_image']); ?>" alt="" >
                        <?php } else { ?>

                            <?php
                            $a = $job[0]['fname'];
                            $words = explode(" ", $a);
                            foreach ($words as $w) {
                                $acronym = $w[0];
                            }
                            ?>
                            <?php
                            $b = $job[0]['lname'];
                            $words = explode(" ", $b);
                            foreach ($words as $w) {
                                $acronym1 = $w[0];
                            }
                            ?>

                            <div class="post-img-user">
                            <?php echo ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                 <!--  <img alt="" class="img-circle" src="<?php //echo base_url(NOIMAGE);  ?>" alt="" /> -->
                        <?php } ?>
              <!--<a href="#popup-form" class="fancybox" title="Update Profile Picture"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>-->
                        <?php if ($returnpage == '') { ?>
                            <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                    <?php } ?>
                    </div>
                    <!--            <div id="popup-form">
<?php // echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix'));  ?>
                                       <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                       <input type="hidden" name="hitext" id="hitext" value="2">
                                       <input type="submit" name="cancel2" id="cancel2" value="Cancel">
                                       <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
<?php // echo form_close();  ?>
                                   </div>-->
                </div>
                <div class="job-menu-profile  mob-block">
                    <a  href="<?php echo site_url('job/job_printpreview/' . $job[0]['user_id']); ?>">
                        <h5 class="profile-head-text"> <?php echo $job[0]['fname'] . ' ' . $job[0]['lname']; ?></h5>
                    </a>
                    <!-- text head start -->
                    <div class="profile-text" >
                        <?php
                        if ($returnpage == '') {
                            if ($job[0]['designation'] == '') {
                                ?>
                             <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                                <a id="designation" class="designation" title="Designation">Current Work</a>
                            <?php } else {
                                ?> 
                                <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                                <a id="designation" class="designation" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>
                            <?php
                            }
                        } else {


                            if ($job[0]['designation'] == '') {
                                ?>
                                <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                                <a id="designation"> <?php echo "Current Work"; ?> </a> 
    <?php } else { ?>
                                <a id="designation"> <?php echo ucwords($job[0]['designation']); ?> </a> <?php }
}
?>

                    </div>
                </div>
<?php echo $job_menubar; ?>   
            </div>
        </div>
        <div class="middle-part container res-job-print  ">
            <div class="job-menu-profile job_edit_menu mob-none">
               <a  href="javascript: void(0);" title="<?php echo $job[0]['fname'] . ' ' . $job[0]['lname']; ?>">
                    <h3 class="profile-head-text">
                        <!--  <?php echo ucfirst($job[0]['fname']); ?> -->
                    <?php echo ucfirst($job[0]['fname']) . ' ' . ucfirst($job[0]['lname']); ?> 
                    </h3>
                </a>
                <div class="profile-text" >
                    <?php
                    if ($returnpage == '') {
                        if ($job[0]['designation'] == '') {
                            ?>
                           <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                            <a id="designation" class="designation" title="Designation">Current Work</a>
                        <?php } else {
                            ?> 
                            <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                            <a id="designation" class="designation" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>
    <?php
    }
} else {


    if ($job[0]['designation'] == '') {
        ?>
                            <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                            <a id="designation"> <?php echo "Current Work"; ?> </a> 
    <?php } else { ?>
                            <a id="designation"> <?php echo ucwords($job[0]['designation']); ?> </a> <?php }
}
?>

                </div>
                   
            </div>
            <div class="col-md-7 col-sm-12 mob-clear">
				<div class="mob-progressbar <?php if($count_profile == 100){?>temp<?php } ?>">
					<p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
					<p class="mob-edit-pro">

            <?php if($count_profile == 100)
              {
            ?>
            <a href="javascript:void(0);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Successfully Completed</a>      
            <?php
              }
              else
              {
             ?>

						<a href="<?php echo base_url('job/job_basicinfo_update')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</a>

            <?php
              }
            ?>
					</p>
					<div class="progress skill-bar ">
						<div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo($count_profile);?>" aria-valuemin="0" aria-valuemax="100">
							<span class="skill"><i class="val"><?php echo(round($count_profile));?>%</i></span>
						</div>
					</div>
					
					
				</div>
                <div class="">
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3>Details</h3>
                            <div class=" fr rec-edit-pro">
                                <ul>
                                </ul>
                            </div>
							<div class="contact-frnd-post">
                                <div class="job-contact-frnd ">
                                    <div class="profile-job-post-detail clearfix">
                                        <div class="profile-job-post-title-inside clearfix">
                                        </div>
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
                                                <ul class="clearfix " >
                                                    <li> <b> Name </b> <span> <?php echo ucfirst($job[0]['fname']); ?> <?php echo ucfirst($job[0]['lname']); ?></span>
                                                    </li>
                                                    <li> <b>Email </b><span> <?php echo $job[0]['email']; ?> </span>
                                                    </li>
													<?php
                                                    if ($returnpage == 'recruiter') {

                                                        if ($job[0]['phnno']) {
                                                            ?>
                                                    <li><b> Phone Number</b> <span><?php echo $job[0]['phnno']; ?></span> </li>
                                                            <?php
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        if ($job[0]['phnno']) {
                                                            ?>
                                                    <li><b> Phone Number</b> <span><?php echo $job[0]['phnno']; ?></span> </li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                    <li><b> Phone Number</b> <span>
                                                                    <?php
                                                                    echo PROFILENA;
                                                                }
                                                            }
                                                            ?>
                                                        </span>
                                                    </li>
													<?php
                                                    if ($returnpage == 'recruiter') {

                                                        if ($job[0]['language']) 
                                                        {
                                                    ?>
                                                    <li> <b>Language </b><span>  
                                                    <?php
                                                            $aud = $job[0]['language'];

                                                            $aud_res = explode(',', $aud);
                                                            foreach ($aud_res as $lan) {

                                                                $cache_time = $this->db->get_where('language', array('language_id' => $lan))->row()->language_name;
                                                                $language1[] = $cache_time;
                                                            }
                                                            $listFinal = implode(', ', $language1);
                                                            echo $listFinal;
                                                            ?>
                                                                
                                                    </span>
                                                    </li>
                                                    <?php
                                                        }else {
                                                            echo "";
                                                        }
                                                    } 

                                                    else
                                                    {
                                                   
                                                    ?>
                                                    <li> <b>Language</b>
                                                    <span> 
                                                    <?php 
                                                        if($job[0]['language'])
                                                        {
                                                            $aud = $job[0]['language'];

                                                            $aud_res = explode(',', $aud);
                                                            foreach ($aud_res as $lan) {

                                                                $cache_time = $this->db->get_where('language', array('language_id' => $lan))->row()->language_name;
                                                                $language1[] = $cache_time;
                                                            }
                                                            $listFinal = implode(', ', $language1);
                                                            echo $listFinal;
                                                        }
                                                        else
                                                         echo PROFILENA;
                                                      
                                                        }
                                                        ?>
                                                    </span>                                               </li>

                                                     <?php
                                                    if ($returnpage == 'recruiter') {

                                                        if ($job[0]['dob'] != '0000-00-00') 
                                                        {
                                                    ?>
                                                    <li> <b>Date Of Birth</b><span>  
                                              
                                                           <?php echo date('d/m/Y', strtotime($job[0]['dob'])); 
                                                           ?>
                                                          
                                                                
                                                    </span>
                                                    </li>
                                                    <?php
                                                        }else {
                                                            echo "";
                                                        }
                                                    } 

                                                    else
                                                    {
                                                   
                                                    ?>
                                                    <li> <b>Date Of Birth</b>
                                                    <span> 
                                                    <?php 
                                                        if($job[0]['dob'] != '0000-00-00')
                                                        {
                                                             echo date('d/m/Y', strtotime($job[0]['dob'])); 
                                                        }
                                                        else
                                                         echo PROFILENA;
                                                      
                                                        }
                                                        ?>
                                                    </span>                                               </li>

                                                    <?php
                                                    if ($returnpage == 'recruiter') {

                                                        if ($job[0]['gender']) 
                                                        {
                                                    ?>
                                                    <li> <b>Gender</b><span>  
                                              
                                                           <?php echo $job[0]['gender']; ?>
                                                          
                                                                
                                                    </span>
                                                    </li>
                                                    <?php
                                                        }else {
                                                            echo "";
                                                        }
                                                    } 

                                                    else
                                                    {
                                                   
                                                    ?>
                                                    <li> <b>Gender</b>
                                                    <span> 
                                                    <?php 
                                                        if($job[0]['gender'])
                                                        {
                                                              echo $job[0]['gender']; 
                                                        }
                                                        else
                                                         echo PROFILENA;
                                                      
                                                        }
                                                        ?>
                                                    </span>                                               </li>

                                                     <?php
                                                        if ($returnpage == 'recruiter') {

                                                            if ($job[0]['city_id']) {
                                                                ?>
                                                                <li><b> City</b> <span><?php
                                                        $cache_time = $this->db->get_where('cities', array('city_id' => $job[0]['city_id']))->row()->city_name;
                                                        echo $cache_time;
                                                                ?></span> </li>
                                                                        <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($job[0]['city_id']) {
                                                                ?>
                                                                <li><b> City</b> <span><?php
                                                                $cache_time = $this->db->get_where('cities', array('city_id' => $job[0]['city_id']))->row()->city_name;
                                                                echo $cache_time;
                                                                ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b> City</b> <span>
                                                                        <?php
                                                                echo PROFILENA;
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($returnpage == 'recruiter') {

                                                            if ($job[0]['pincode']) {
                                                                ?></span>
                                                                </li>
                                                                <li> <b>Pincode </b><span><?php echo $job[0]['pincode']; ?></span>
                                                                </li>
                                                                        <?php
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                } else {
                                                                    if ($job[0]['pincode']) {
                                                                        ?>
                                                                <li> <b>Pincode </b><span><?php echo $job[0]['pincode']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b>Pincode </b><span>
                                                                <?php
                                                                echo PROFILENA;
                                                            }
                                                        }
                                                        ?>
                                                            </span>
                                                        </li>

                                                        <?php
                                                        if ($returnpage == 'recruiter') {

                                                            if ($job[0]['address']) {
                                                        ?>
                                                        <li> <b>Address </b><span><pre><?php echo $job[0]['address']; ?></pre></span>
                                                        </li>
                                                        <?php
                                                                    } else {
                                                                        echo "";
                                                                    }
                                                                } 
                                                                else 
                                                                {
                                                                    if ($job[0]['address']) {
                                                                        ?>

                                                                         <li> <b>Address </b><span><pre><?php echo $job[0]['address']; ?></pre></span>
                                                                        </li>
                                                                        <?php
                                                                        }else {
                                                                ?>
                                                                <li> <b>Address </b><span>
                                                                <?php
                                                                echo PROFILENA;
                                                            }
                                                        }
                                                        ?>
                                                            </span>
                                                        </li>
												</ul>
											
											</div>
										
										</div>
										
										 <?php
											  if($returnpage != 'recruiter' && ($job_edu[0]['board_primary'] == "" && $job_edu[0]['board_secondary'] == "" && $job_edu[0]['board_higher_secondary'] == "" && $job_graduation[0]['degree'] == "" ))
												{
											?>
											<div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p class="details_all_tital"> Education
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url('job/job_education_update');?>">Click Here To fill Up Education Detail</a>
                                                        </div>
                                                        </ul>
                                                </div>
                                            </div>
											    <?php 
												} else
													{
										if(($job_edu || $job_graduation) || ($returnpage == 'recruiter'&& ($job_edu || $job_graduation)))
										{
										?>
										<div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p class="details_all_tital"> Education
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <div class="profile-job-profile-menu " id="job_education">
                                                    <ul class="clearfix">
												
												 <!--Primary Start-->
												<?php
                                                        if ($job_edu) {
                                                            if ($job_edu[0]['board_primary']) {
                                                 ?>
												 
                                                        <div class="text-center">
                                                             <h5 class="head_title">Primary Education</h5>
                                                        </div>
														 <li> <b>Board </b><span> <?php echo $job_edu[0]['board_primary']; ?></span>
                                                         </li>
                                                          <li> <b>School </b><span> <?php echo $job_edu[0]['school_primary']; ?></span>
                                                         </li>
                                                          <li> <b>Percentage </b><span> <?php echo $job_edu[0]['percentage_primary']; ?>%</span>
                                                          </li>
                                                           <li> <b>Year of Passing </b><span> <?php echo $job_edu[0]['pass_year_primary']; ?></span>
                                                           </li>
													<?php
															if ($job_edu[0]['edu_certificate_primary'] != "") {
													?>
															<li>
                                                            <b>Education Certificate </b>
                                                              <span>
																	<?php
																	if ($job_edu[0]['edu_certificate_primary']) {
																	$ext = explode('.', $job_edu[0]['edu_certificate_primary']);
																	if ($ext[1] == 'pdf') {
																	?>
                                                                     <!--  <a href="<?php //echo base_url('job/creat_pdf_primary/' . $job_edu[0]['edu_id'] . '/print') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                              <a title="open pdf" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $job_edu[0]['edu_certificate_primary']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                                       <?php
                                                                           } else {
                                                                        ?>
                                                                       <a class="example-image-link" href="<?php echo base_url($this->config->item('job_edu_thumb_upload_path') . $job_edu[0]['edu_certificate_primary']) ?>" data-lightbox="example-1">certificate </a>
                    <?php
                }//else complete
            }//if ($job_edu[0]['edu_certificate_primary']) complete
            ?>

                                                                            </span>
                                                            </li>
															 <div id="fade" onClick="lightbox_close();"></div>
																		
													<?php
															}//if($job_edu[0]['edu_certificate_primary']) end
													?>
													
												<?php
															}//if($job_edu[0]['board_primary']) end
														}//if($job_edu) end
												?>
                                                 <!--Primary End-->
												 
												<!--Secondary Start-->
												<?php
                                                       if ($job_edu[0]['board_secondary']) {
                                                ?>
													<div class="text-center">
                                                        <h5 class="head_title">Secondary Education</h5>
                                                    </div>
													<li> <b>Board </b><span> <?php echo $job_edu[0]['board_secondary']; ?></span>
                                                    </li>
													<li> <b>School </b><span> <?php echo $job_edu[0]['school_secondary']; ?></span>
													</li>
                                                    <li> <b>Percentage </b><span> <?php echo $job_edu[0]['percentage_secondary']; ?>%</span>
                                                    </li>
                                                    <li> <b>Year of Passing </b><span> <?php echo $job_edu[0]['pass_year_secondary']; ?></span>
                                                    </li>
													<?php
                                                        if ($job_edu[0]['edu_certificate_secondary'] != "") {
                                                    ?>
													<li>
                                                        <b>Education Certificate </b>
                                                        <span>
													<?php
														if ($job_edu[0]['edu_certificate_secondary']) {
															$ext = explode('.', $job_edu[0]['edu_certificate_secondary']);
															if ($ext[1] == 'pdf') {
													?>
                                                        <!-- <a href="<?php //echo base_url('job/creat_pdf_secondary/' . $job_edu[0]['edu_id'] . '/print') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                         <a title="open pdf" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $job_edu[0]['edu_certificate_secondary']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                    <?php
                                                        } else {
                                                    ?>
                                                        <a class="example-image-link" href="<?php echo base_url($this->config->item('job_edu_thumb_upload_path') . $job_edu[0]['edu_certificate_secondary']) ?>" data-lightbox="example-1">certificate </a>
                                                    <?php
																}
														}
                                                    ?>

                                                       </span>
                                                    </li>
													<?php
														}// if ($job_edu[0]['edu_certificate_secondary'] != "")end
													?>
												<?php
														}//if($job_edu[0]['board_secondary']) end
												?>
												<!--Secondary End-->
												
												<!-- Higher Secondary Start-->
												<?php
													if($job_edu[0]['board_higher_secondary']) {
												?>
													<div class="text-center">
                                                        <h5 class="head_title">Higher secondary Education</h5>
                                                    </div>
													
													<li> <b>Board </b><span> <?php echo $job_edu[0]['board_higher_secondary']; ?></span>
                                                    </li>
													
                                                    <li> <b>Stream</b><span> <?php echo $job_edu[0]['stream_higher_secondary']; ?></span>
                                                    </li>
                                                    <li> <b>School </b><span> <?php echo $job_edu[0]['school_higher_secondary']; ?></span>
                                                    </li>
                                                    <li> <b>Percentage </b><span> <?php echo $job_edu[0]['percentage_higher_secondary']; ?>%</span>
                                                    </li>
                                                    <li> <b>Year of Passing </b><span> <?php echo $job_edu[0]['pass_year_higher_secondary']; ?></span>
                                                    </li>
													
													<?php
                                                        if ($job_edu[0]['edu_certificate_higher_secondary'] != "") {
                                                    ?>
													
													<li>
                                                        <b>Education Certificate </b>
														<span>
													  
                                                    <?php
                                                        if ($job_edu[0]['edu_certificate_higher_secondary']) 
														{
                                                            $ext = explode('.', $job_edu[0]['edu_certificate_higher_secondary']);
                                                            if ($ext[1] == 'pdf') {
                                                    ?>
                                                            <!-- <a href="<?php //echo base_url('job/creat_pdf_higher_secondary/' . $job_edu[0]['edu_id'] . '/print') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
 -->
                                                              <a title="open pdf" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $job_edu[0]['edu_certificate_higher_secondary']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                    <?php
                                                        } else {
                                                    ?>
															<a class="example-image-link" href="<?php echo base_url($this->config->item('job_edu_thumb_upload_path') . $job_edu[0]['edu_certificate_higher_secondary']) ?>" data-lightbox="example-1">certificate </a>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
														</span>
                                                    </li>
                                                     <li>
                                                        <div>
                                                            <a class="example-image-link" style="width: 200px; height: 200px;" href="http://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg" data-lightbox="example-1"></a>
                                                            <a class="example-image-link" style="width: 200px; height: 200px;" href="http://localhost/aileensoul/uploads/user_bg/main/16711487_1337552009638693_3483784836973951976_n.jpg" data-lightbox="example-1"></a>
                                                        </div>
                                                    </li>
													<?php
														}// if ($job_edu[0]['edu_certificate_higher_secondary'] != "") end
													?>
												<?php
													}//if($job_edu[0]['board_higher_secondary']) End
												?>
												<!-- Higher Secondary End-->
												
												<!-- Degree Start -->
												<?php if ($job_graduation) 
													{ 
												?>
													<div class="text-center">
                                                        <h5 class="head_title">Graduation</h5>
                                                    </div>
													
													<?php
                                                        $i = 1;
                                                        foreach ($job_graduation as $graduation) {
															if ($graduation['degree']) {
                                                    ?>
													
                                                    <div id="gra<?php echo $i; ?>" class="tabcontent data_exp">
                                                    <li> <b> Degree</b> 
													<span>
														
                                                    <?php
                                                        $cache_time = $this->db->get_where('degree', array('degree_id' => $graduation['degree']))->row()->degree_name;
                                                        echo $cache_time;
                                                    ?> 
													</span>
                                                     </li>
                                                    <li> <b>Stream </b>
													<span>
                                                    <?php
                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $graduation['stream']))->row()->stream_name;
                                                        echo $cache_time;
                                                    ?>
                                                    </span>
                                                    </li>
                                                                            
													<li><b> University</b> 
													<span>
													<?php
														$cache_time = $this->db->get_where('university', array('university_id' => $graduation['university']))->row()->university_name;
														echo $cache_time;
													?>
                                                    </span> 
                                                    </li>
													
                                                    <li> <b>College  </b><span><?php echo $graduation['college']; ?></span>
                                                    </li>
													
                                                    <?php
                                                        if ($returnpage == 'recruiter') 
														{

                                                            if ($graduation['grade']) 
															{
                                                    ?>
													
                                                    <li> <b>Grade </b><span><?php echo $graduation['grade']; ?></span>
                                                    </li>
                                                    <?php
                                                            } else 	{
                                                                         echo "";
                                                                    }
                                                        } 
														else 
														{
                                                            if ($graduation['grade'])
															{
                                                    ?>
													<li> <b>Grade </b><span><?php echo $graduation['grade']; ?></span>
                                                    </li>
													<?php
															} 
															else 
															{
													?>
                                                    <li><b> Grade</b> 
													<span>
                                                    <?php
                                                        echo PROFILENA;
                                                            }
                                                        }//else complete
                                                    ?>
                                                    </span>
                                                    </li>
													
                                                    <li> <b>Percentage </b><span><?php echo $graduation['percentage']; ?>%</span>
                                                    </li>
													
                                                    <li> <b>Year Of Passing </b><span><?php echo $graduation['pass_year']; ?></span>
                                                    </li>
													
												<?php
													if ($graduation['edu_certificate'] != "") 
													{
												?>
                                                    <li><b>Education Certificate </b> 
                                                    <span>  
                                                    <?php
														$ext = explode('.', $graduation['edu_certificate']);
                                                        if ($ext[1] == 'pdf') {
                                                    ?>
                                                       <!--  <a href="<?php //echo base_url('job/creat_pdf_graduation/' . $graduation['job_graduation_id'] . '/print') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                         <a title="open pdf" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $graduation['edu_certificate']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                <?php
                                                        } else {
                                                ?>
                                                        <a class="example-image-link" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $graduation['edu_certificate']) ?>" data-lightbox="example-1">certificate <?php echo $new; ?></a>
                                                <?php
                                                        }
                                                ?>

													</span>
													</li>
                                                <?php
                                                    }//if($graduation['edu_certificate'] != "")end
                                                ?>
												
                                               </div>
                                                <?php
                                                    }
                                                    $i++;
                                                    }//For loop end
                                                ?> 

											<div class="tab pagi_exp" style="">
                                                <?php 	if (count($job_graduation) > 1) 
														{ 
												?>
															<button class="tablinks  " onclick="openCity(event, 'gra1')">1</button>
												<?php 	} ?>
												
												<?php	if (count($job_graduation) >= 2) 
														{ 
												?>
                                                            <button class="tablinks" onclick="openCity(event, 'gra2')">2</button>
															
												<?php 	} 
														if (count($job_graduation) >= 3) 
														{ 
												?>
                                                            <button class="tablinks" onclick="openCity(event, 'gra3')">3</button>
												<?php 	} 
												?>
												
												<?php 	if (count($job_graduation) >= 4) 
														{ 
												?>
                                                            <button class="tablinks" onclick="openCity(event, 'gra4')">4</button>
                                                <?php 	} 
												?>
                                                <?php 	if (count($job_graduation) >= 5) 
														{
												?>
                                                            <button class="tablinks" onclick="openCity(event, 'gra5')">5</button>
                                                <?php 	} 
												?>
											</div>
												 <?php
													}//if ($job_graduation) end
												 ?>
												<!-- Degree End -->
											</ul><!-- Above all data put -->
                                            </div><!-- profile-job-profile-menu primary-->
                                          </div><!-- profile-job-post-title clearfix -->
										<?php
										}
											}//education else part end
									if($returnpage != 'recruiter' && ($job[0]['project_name'] == "" && $job[0]['project_duration'] == "" && $job[0]['project_description'] == "" && $job[0]['training_as'] == "" && $job[0]['training_duration'] == "" && $job[0]['training_organization'] == "" ))
                 
        {
													?>
													 <div class="profile-job-post-title-inside clearfix">
                </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p class="details_all_tital"> Project And Training / Internship
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url('job/job_project_update');?>">Click Here To fill Up Project And Training / Internship Detail</a>
                                                        </div>
                                                        </ul>
                                                </div>
                                            </div>
           
            <?php 
        }
            else
            {
                if(($job[0]['project_name'] != "" || $job[0]['project_duration'] != "" || $job[0]['project_description'] != "" || $job[0]['training_as'] != "" || $job[0]['training_duration'] != "" || $job[0]['training_organization'] != "") || ($returnpage == 'recruiter'&& ($job[0]['project_name'] != "" || $job[0]['project_duration'] != "" || $job[0]['project_description'] != "" || $job[0]['training_as'] != "" || $job[0]['training_duration'] != "" || $job[0]['training_organization'] != "")))
                {
        ?>
                                                                 <!--khyati 22-5 chanegs end-->
                                                                        
                                                                        <?php
                                                                        if ($returnpage == 'recruiter') {


                                                                            if ($job[0]['project_name'] != "" || $job[0]['project_duration'] != "" || $job[0]['project_description'] != "" || $job[0]['training_as'] != "" || $job[0]['training_duration'] != "" || $job[0]['training_organization'] != "") {
                                                                                ?>
                                                            <div class="profile-job-post-title clearfix">
                                                                <div class="profile-job-profile-button clearfix">
                                                                    <div class="profile-job-details">

                                                                     
                                                                        <ul>
                                                                    
                                                                            <li>
                                                                                <p class="details_all_tital">Project And Training / Internship</p>
                                                                            </li>
                                                                        </ul>
                                                               

                                                                    </div>
                                                                </div>
                                                                <div class="profile-job-profile-menu">
                                                                    <ul class="clearfix">

                                                                        <?php if($job[0]['project_name'] != "" || $job[0]['project_duration'] != "" || $job[0]['project_description'] != "")
                                                                        {
                                                                        ?>
                                                                        <li>
                                                                        

                                                                            <div class="text-center">
                                                                                <h5 class="head_title">Project</h5>
                                                                            </div>
                                                                        </li>
                                                                         <?php
                                                                         }
                                                                         ?>

                                                                        <?php
                                                                        if ($job[0]['project_name']) {
                                                                            ?>
                                                                            <li> <b> Project Name (Title)</b> <span><?php echo $job[0]['project_name']; ?></span>
                                                                            </li>
                                                                            <?php
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($job[0]['project_duration']) {
                                                                            ?>
                                                                            <li> <b>Duration</b><span><?php echo $job[0]['project_duration']; ?> month</span>
                                                                            </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($job[0]['project_description']) {
                                                                ?>
                                                                            <li><b>Project Description</b> <span><pre><?php echo $this->common->make_links($job[0]['project_description']); ?></pre></span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?><br>

                                                             <?php if($job[0]['training_as'] != "" || $job[0]['training_duration'] != "" || $job[0]['training_organization'] != "")
                                                                    {
                                                                ?>
                                                                        <li>

                                                                            <div class="text-center">
                                                                                <h5 class="head_title">Training / Internship</h5>
                                                                            </div>
                                                                        </li>
                                                                    <?php } ?>

        <?php
        if ($job[0]['training_as']) {
            ?>
                                                                            <li> <b>Intern / Trainee As </b><span><?php echo $this->common->make_links($job[0]['training_as']); ?></span>
                                                                            </li>
            <?php
        } else {
            echo "";
        }
        ?>
                                                                        <?php
                                                                        if ($job[0]['training_duration']) {
                                                                            ?>
                                                                            <li> <b>Duration</b><span> <?php echo $job[0]['training_duration']; ?> month</span>
                                                                            </li>
                                                                            <?php
                                                                        } else {
                                                                            echo "";
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($job[0]['training_organization']) {
                                                                            ?>
                                                                            <li> <b>Name of Organization</b><span> <?php echo $this->common->make_links($job[0]['training_organization']); ?></span>
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

                                                                    if ($job[0]['project_name'] != "" || $job[0]['project_duration'] != "" || $job[0]['project_description'] != "" || $job[0]['training_as'] != "" || $job[0]['training_duration'] != "" || $job[0]['training_organization'] != "") {
                                                                        ?>
                                                            <div class="profile-job-post-title clearfix">
                                                                    <div class="profile-job-profile-button clearfix">
                                                                        <div class="profile-job-details">
                                                                            <ul>
                                                                                <li>
                                                                                    <p class="details_all_tital">Project And Training / Internship</p>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="profile-job-profile-menu">
                                                                        <ul class="clearfix">

                                                                            <li>
                                                                                <div class="text-center">
                                                                                    <h5 class="head_title">Project</h5>
                                                                                </div>
                                                                            </li>

                                                                        <?php
                                                                        if ($job[0]['project_name']) {
                                                                            ?>
                                                                                <li> <b> Project Name (Title)</b> <span><?php echo $job[0]['project_name']; ?></span>
                                                                                </li>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                                <li><b> Project Name (Title)</b> <span>
                                                                            <?php
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>
        <?php
        if ($job[0]['project_duration']) {
            ?>
                                                                                    </span>
                                                                                </li>
                                                                                <li> <b>Duration</b><span><?php echo $job[0]['project_duration']; ?> month</span>
                                                                                </li>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                                <li><b> Duration</b> <span>
                                                                            <?php
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if ($job[0]['project_description']) {
                                                                            ?>
                                                                                    </span>
                                                                                </li>
                                                                                <li><b>Project Description</b> <span><pre><?php echo $this->common->make_links($job[0]['project_description']); ?></pre></span> </li>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                                <li><b> Project Description</b> <span>
                                                                    <?php
                                                                    echo PROFILENA;
                                                                }
                                                                ?>
                                                                                    <br>

                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                <div class="text-center">
                                                                                    <h5 class="head_title">Training / Internship</h5>
                                                                                </div>
                                                                            </li>

        <?php
        if ($job[0]['training_as']) {
            ?>
                                                                                <li> <b>Intern / Trainee As </b><span><?php echo $this->common->make_links($job[0]['training_as']); ?></span>
                                                                                </li>
            <?php
        } else {
            ?>
                                                                                <li><b>Intern / Trainee As</b> <span>
            <?php
            echo PROFILENA;
        }
        ?>
        <?php
        if ($job[0]['training_duration']) {
            ?></span>
                                                                                </li>
                                                                                <li> <b>Duration</b><span> <?php echo $job[0]['training_duration']; ?> month</span>
                                                                                </li>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <li><b>Duration</b> <span>
                                                                                <?php
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>
                                                                                    <?php
                                                                                    if ($job[0]['training_organization']) {
                                                                                        ?>
                                                                                    </span>
                                                                                </li>
                                                                                <li> <b>Name of Organization</b><span> <?php echo $this->common->make_links($job[0]['training_organization']); ?></span>
                                                                                </li>
            <?php
        } else {
            ?>
                                                                                <li><b>Name of Organization</b> <span>
                                                                                <?php
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
																	</div><!-- profile-job-post-title clearfix -->
													
											<?php
																	}
																}
				}
		}
		?>
		<div class="profile-job-post-title clearfix">
                                                                <div class="profile-job-profile-button clearfix">
                                                                    <div class="profile-job-details">
                                                                        <ul>
                                                                            <li>
                                                                                <p class="details_all_tital"> Work Area</p>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
																<div class="profile-job-profile-menu">
                                                                    <ul class="clearfix">
                                                                            <?php
                                                                            if ($job[0]['work_job_title']) {
                                                                                $contition_array = array('status' => 'publish', 'title_id' => $job[0]['work_job_title']);
                                                                                $jobtitle = $this->common->select_data_by_condition('job_title', $contition_array, $data = 'name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                ?>
                                                                            <li> <b> Job Title</b> <span>
    <?php echo $jobtitle[0]['name']; ?>
                                                                                </span>
                                                                            </li>

<?php } ?>
                                                                    <?php
                                                                    if ($job[0]['keyskill']) {
                                                                    
                                                                        ?>
                                                                            <li> <b> Skills</b> <span>
                                                                       
                                                                <?php

                                                            $comma = ", ";
                                                            $k = 0;
                                                            $aud = $job[0]['keyskill'];
                                                            $aud_res = explode(',', $aud);
                                                            foreach ($aud_res as $skill) {
                                                                if ($k != 0) 
                                                                {
                                                                         echo $comma;

                                                                }

                                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                 
                                                                  echo $cache_time;
                                                                  $k++;
                                                               
                                                            }

                                                            ?>

                                                                                </span>
                                                                            </li>
                                                                            <?php } ?>

                                                                            <?php
                                                                            if ($job[0]['work_job_industry']) {
                                                                                $contition_array = array('industry_id' => $job[0]['work_job_industry']);
                                                                                $industry = $this->common->select_data_by_condition('job_industry', $contition_array, $data = 'industry_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                ?>
                                                                            <li> <b> Industry</b> <span>
    <?php echo $industry[0]['industry_name']; ?>
                                                                                </span>
                                                                            </li>
                                                                    <?php } ?>
                                                                    <?php
                                                                    if ($job[0]['work_job_city']) {
                                                                        // $work_city = explode(',', $job[0]['work_job_city']);
                                                                        // foreach ($work_city as $city) {
                                                                        //     $contition_array = array('city_id' => $city);
                                                                        //     $citydata = $this->common->select_data_by_condition('cities', $contition_array, $data = 'city_id,city_name', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str5 = '', $groupby = '');
                                                                        //     if ($citydata) {
                                                                        //         $cities[] = $citydata[0]['city_name'];
                                                                        //     }
                                                                        // }
                                                                        ?>
                                                                            <li> <b> Preferred Cites</b> <span>
    <?php //echo implode(',', $cities); ?>                                         
     <?php

                    $comma = ", ";
                    $k = 0;
                    $aud = $job[0]['work_job_city'];
                    $aud_res = explode(',', $aud);
                    $count= 0;
                  
                    foreach ($aud_res as $city) 
                    {
                        
                    if ($k != 0 && $count != count($aud_res)) 
                    {
                            echo $comma;
                             //echo $k;
                    }

                $cache_time = $this->db->get_where('cities', array('city_id' => $city))->row()->city_name;
                                                                 
                echo $cache_time;
                $count=  $k++; 
                $k++;      
                                                    
                }

    ?>               
                                                                                </span>
                                                                            </li>
                                                                    <?php } ?> 
                                                                    </ul>
                                                                </div>
                                                           
		</div><!-- profile-job-post-title clearfix -->
		
		<!-- Experience Part Start-->
		<?php if ($job[0]['experience'] == "Experience" ) 
		{ 
          ?>
		        <div class="profile-job-post-title clearfix">
                                                                   
                                                                           <?php

                                                                                if($job[0]['experience'] == "Experience" && $job_work[0]['jobtitle'] == "" && $returnpage != 'recruiter')
                                                                                {
                                                                            ?>
                                                                     <div class="profile-job-post-title-inside clearfix">
                                                                    </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p class="details_all_tital">Work Experience
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                 <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <div class="text-center">
                                                            <a href="<?php echo base_url('job/job_work_exp_update');?>">Click Here To fill Up Work Experience Detail</a>
                                                        </div>
                                                        </ul>
                                                </div>
                                            </div>

                                                                            <?php
                                                                                }
                                                                                else
                                                                                {


                                                                                ?>

                                                            <?php if ($job_work) { ?>
                                                             <div class="profile-job-profile-button clearfix">
                                                                        <div class="profile-job-details">
                                                                            <ul>
                                                                                <li>
                                                                                    <p class="details_all_tital"> Work Experience</p>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                        <div class="profile-job-profile-menu" id="job_workexp">
                                                                            <ul>
                                                                                <li>
                                                                                    <b> Total Experience </b>
                                                                                    <span>

                                                                                <?php
                                                                                $total_work_year = 0;
                                                                                $total_work_month = 0;
                                                                                foreach ($job_work as $work1) {

                                                                                    $total_work_year += $work1['experience_year'];
                                                                                    $total_work_month += $work1['experience_month'];
                                                                                }
                                                                                //echo  $total_work_year;
                                                                                //echo   $total_work_month;

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
                                                                            }
                                                                            ?> 
                                                                                </span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
    <?php
}
    $total_work_year = 0;
    $total_work_month = 0;
    $i = 6;

    foreach ($job_work as $work) {
        ?>
                                                                        <div id="work<?php echo $i; ?>" class="tabcontent data_exp">
                                                                            <div class="profile-job-profile-menu" id="job_workexp">
                                                                                <ul class="clearfix job_paddtop">
        <?php
        if ($work['experience'] == "Experience") {
            ?>           
                                                                                        <li> <b> Job Title </b> <span> <?php echo $work['jobtitle']; ?> </span>
                                                                                        </li>
            <?php
        }
        if ($work['experience'] == "Experience") {
            ?> 
                                                                                        <li> <b>Company Name </b><span><?php echo $work['companyname']; ?></span>
                                                                                        </li>
                                                                            <?php
                                                                        }


                                                                        if ($returnpage == 'recruiter') {

                                                                            if ($work['experience'] == "Experience" && $work['companyemail']) {
                                                                                ?>
                                                                                            <li><b> Company Email Address </b> <span><?php echo $work['companyemail']; ?></span> </li>
                                                                                                <?php
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                        } else {
                                                                                            if ($work['experience'] == "Experience" && $work['companyemail']) {
                                                                                                ?>
                                                                                            <li><b> Company Email Address </b> <span><?php echo $work['companyemail']; ?></span> </li>
                                                                                                <?php
                                                                                            } else if ($job_work[0]['experience'] == "Fresher") {
                                                                                                echo "";
                                                                                            } else {
                                                                                                ?>
                                                                                            <li><b> Company Email Address</b> <span>
                                                                                                <?php
                                                                                                echo PROFILENA;
                                                                                            }
                                                                                        }



                                                                                        if ($returnpage == 'recruiter') {

                                                                                            if ($work['experience'] == "Experience" && $work['companyphn']) {
                                                                                                ?>
                                                                                                </span></li><li> <b>Company Phone Number </b><span> <?php echo $work['companyphn']; ?></span>
                                                                                            </li>
                                                                                                <?php
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                        } else {
                                                                                            if ($work['experience'] == "Experience" && $work['companyphn']) {
                                                                                                ?>
                                                                                            <li> <b>Company Phone Number </b><span> <?php echo $work['companyphn']; ?></span>
                                                                                            </li>
                                                                                                <?php
                                                                                            } else if ($job_work[0]['experience'] == "Fresher") {
                                                                                                echo "";
                                                                                            } else {
                                                                                                ?>
                                                                                            <li><b>Company Phone Number</b> <span>
                                                                                                <?php
                                                                                                echo PROFILENA;
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                        <?php if ($job_work[0]['experience'] != "Fresher") {
                                                                                            ?>
                                                                                            </span></li>
                                                                                        <li> <b>Experience </b><span>
            <?php
            if ($work['experience_year'] == "0 year" && $work['experience_month'] == "12 month") {
                echo "1 Year";
            } elseif ($work['experience_year'] != "0 year" && $work['experience_month'] == "12 month") {

                $month1 = explode(' ', $work['experience_year']);
                $year1 = $month1[0];
                $years1 = $year1 + 1;
                echo $years1 . " Years";
            } else {
                echo $work['experience_year'];
                echo "&nbsp";
                echo $work['experience_month'];
            }
        }
        ?></span>
                                                                                    </li>
                                                                                    <?php
                                                                                    if ($work['work_certificate'] != "") {
                                                                                        ?>
                                                                                        <li><b>Experience Certificate </b> 
                                                                                            <span>

                                                                                        <?php
                                                                                        $ext = explode('.', $work['work_certificate']);
                                                                                        if ($ext[1] == 'pdf') {
                                                                                            ?>
                                                                                                    <!-- <a href="<?php //echo base_url('job/creat_pdf_workexp/' . $work['work_id']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                                                                     <a title="open pdf" href="<?php echo base_url($this->config->item('job_work_main_upload_path') . $work['work_certificate']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                                    <a class="example-image-link" href="<?php echo base_url($this->config->item('job_work_main_upload_path') . $work['work_certificate']) ?>" data-lightbox="example-1">certificate</a>
                                                                                            <?php
                                                                                        }
                                                                                        ?>

                                                                                            </span>
                                                                                        </li>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </ul>
                                                                                    <?php
                                                                                    $total_work_year += $work['experience_year'];
                                                                                    $total_work_month += $work['experience_month'];
                                                                                    ?>
                                                                            </div>
                                                                        </div>
                                                                                    <?php
                                                                                    $i++;
                                                                                }
                                                                                ?>
                                                                
                                                                <!--khyati chnages 22-5 start--> 
                                                                                        <?php if ($job_work[0]['experience'] != "Fresher") {
                                                                                            ?>                                  
                                                                    <div class="tab pagi_exp">
                                                                                            <?php if (count($job_work) > 1) { ?>   
                                                                            <button class="tablinks" onclick="openCity(event, 'work6')">1</button>
                                                                                            <?php } if (count($job_work) >= 2) { ?>
                                                                            <button class="tablinks" onclick="openCity(event, 'work7')">2</button>
                                                                                            <?php } if (count($job_work) >= 3) { ?>
                                                                            <button class="tablinks" onclick="openCity(event, 'work8')">3</button>
                                                                                            <?php } if (count($job_work) >= 4) { ?>
                                                                            <button class="tablinks" onclick="openCity(event, 'work9')">4</button>
        <?php } if (count($job_work) >= 5) { ?>
                                                                            <button class="tablinks" onclick="openCity(event, 'work10')">5</button>
                                                                                    <?php } ?>
                                                                    </div>
                                                                                <?php } ?>
                                                               
																<!-- abc --->
                                                            </div><!--profile-job-post-title clearfix -->
                                                            <!--khyati 22-5 chanegs end--> 
		  <?php
		}
		 else {

                                                                                if($job[0]['experience'] == 'Fresher')
                                                                                {
		?>
		 <div class="profile-job-post-title clearfix">
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-details">
                                                                    <ul>
                                                                        <li>
                                                                            <p class="details_all_tital"> Work Experience</p>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="profile-job-profile-menu">
                                                                <ul class="clearfix">
                                                                    <li> <b> Work Experience</b><span>Fresher</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div><!--profile-job-post-title clearfix -->
		<?php
																				}
		 }
		 ?>
											<!-- test -->
								</div>
								
							</div>
						</div>
						</div>
					</div>	

                </div>
            </div>
						
						

<?php 

if(!($returnpage))
        {
            if($count_profile == 100)
            {
?>
     <div class="edit_profile_progress edit_pr_bar complete_profile">
        <div class="progre_bar_text">
            <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>

        </div>
        <div class="count_main_progress">
            <div class="circles">


<div class="second circle-1 ">
    <div class="true_progtree">
    <img src="<?php echo base_url("img/true.png"); ?>">
    </div>
    <div class="tr_text">
        Successfully Completed
    </div>
</div>
</div>
</div>
</div>
    <?php
    }
       
 else
    {
        ?>

 <div class="edit_profile_progress edit_pr_bar">
        <div class="progre_bar_text">
            <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>

        </div>
        <div class="count_main_progress">
            <div class="circles">
  <div class="second circle-1">
  <div>
      <strong></strong>
      <a href="<?php echo base_url('job/job_basicinfo_update')?>" class="edit_profile_job">Edit Profile
      </a>
      </div>
      </div>
     

   


  </div>
         </div>
        </div> 
         <?php
        }
        ?>
<?php
        }
?>
                   
        </div>

          


        <div class="clearfix"></div>
    </section>
    <!-- Bid-modal-2  -->
    <div class="modal fade message-box" id="bidmodal-2" role="dialog">
        <div class="modal-dialog modal-lm">
            <div class="modal-content">
                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                <div class="modal-body">
                    <span class="mes">
                        <div id="popup-form">
<?php echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                            <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                            <img id="preview" src="#" alt="your image" style="border: 2px solid rgb(204, 204, 204); display: none; margin: 0 auto; margin-top: 5px;padding: 5px;"/>
                            <input type="hidden" name="hitext" id="hitext" value="2">
                            <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                            <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" style="margin-top:32px!important;">
                                                                <?php echo form_close(); ?>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Popup Close -->
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
    <?php
 
?>

</body>
</html>
<!-- script for skill textbox automatic start-->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- <script src="<?php echo base_url('js/light-box/lightbox-plus-jquery.min.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script> 
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('css/lightbox.min.css'); ?>">
<!-- script for skill textbox automatic end (option 2)-->
 <!--new script for jobtitle,company and skill start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill  end-->

<!--new script for jobtitle,company and skill start for mobile view-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill for mobile view end-->

<!--new script for cities start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end-->

<!--new script for cities start mobile view-->
  <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end mobile view-->
<script type="text/javascript">
    function check() {
        var keyword = $.trim(document.getElementById('tags1').value);
        var place = $.trim(document.getElementById('searchplace1').value);
        if (keyword == "" && place == "") {
            return false;
        }
    }
</script>
<!-- <script>
//location.reload(1); return false;
//select2 autocomplete start for skill
$('#searchskills').select2({

placeholder: 'Find Your Skills',

ajax: {

url: "<?php echo base_url(); ?>job/keyskill",
dataType: 'json',
delay: 250,

processResults: function (data) {

return {
//alert(data);

results: data


};

},
cache: true
}
});
// select2 autocomplete End for skill

// select2 autocomplete start for Location
$('#searchplace').select2({

placeholder: 'Find Your Location',
maximumSelectionLength: 1,
ajax: {

url: "<?php echo base_url(); ?>job/location",
dataType: 'json',
delay: 250,

processResults: function (data) {

return {
//alert(data);

results: data


};

},
cache: true
}
});
// //select2 autocomplete End for Location

</script> -->
<script>
    // Get the modal

    var modal = document.getElementById('myModal');

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<!-- crop image js start--> 
<!-- crop image js End--> 
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
    //validation for edit email formate form

    $(document).ready(function () {

        $("#jobdesignation").validate({

            rules: {

                designation: {

                    required: true,

                },

            },

            messages: {

                designation: {

                    required: "Designation Is Required.",

                },

            },

        });
    });
</script>
<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        //  setTimeout(function () { location.reload(1); }, 5000);

    }


    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
    }
</script>
<script type="text/javascript">
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
                url: "<?php echo base_url(); ?>job/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    if (html) {
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

    //aarati code start
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

        //alert(size);

        // pallavi code start for file type support
        if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            //alert('not an image');
            picpopup();

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            return false;
        }
        // file type code end


        if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            //alert('not an image');
            picpopup();

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            return false;
        }

        if (size > 4194304)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 4 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            return false;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>job/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
            }
        });
    });

    //aarati code end
</script>
<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>
<!-- for search validation -->
<script type="text/javascript">
    function checkvalue() {

        var searchkeyword = $.trim(document.getElementById('tags').value);
        var searchplace = $.trim(document.getElementById('searchplace').value);

        if (searchkeyword == "" && searchplace == "") {
            return false;
        }
    }

</script>
<!-- end search validation -->
<script>
    function divClicked() {
        var divHtml = $(this).html();
        var editableText = $("<textarea />");
        editableText.val(divHtml);
        $(this).replaceWith(editableText);
        editableText.focus();
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }

    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<a>");
        if (html.match(/^\s*$/) || html == '') {
            html = "Current Work";
        }
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(divClicked);

        $.ajax({
            url: "<?php echo base_url(); ?>job/ajax_designation",
            type: "POST",
            data: {"designation": html},
            success: function (response) {
            }
        });
    }

    $(document).ready(function () {
        $("a.designation").click(divClicked);
    });
</script> 
<!-- save post start -->
<script type="text/javascript">
    //               function save_user(abc)
    //                     {
    //        var saveid = document.getElementById("hideenuser" + abc);
    //             $.ajax({
    //     type: 'POST',
    //     url: '<?php //echo base_url() . "recruiter/save_search_user"  ?>',
    //     data: 'user_id=' + abc + '&save_id=' + saveid.value,
    //     success: function (data) {
    // $('.' + 'saveduser' + abc).html(data).addClass('saved');
    //                             }
    //                         });
    //                     }


    function save_user(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "recruiter/save_search_user" ?>',
            data: 'user_id=' + abc,
            success: function (data) {
                $('.' + 'saveduser' + abc).html(data).addClass('butt_rec');


            }
        });

    }

</script>
<!-- save post end-->
<script>
    function savepopup(id) {
        save_user(id);

        $('.biderror .mes').html("<div class='pop_content'>Candidate successfully saved.");


        $('#bidmodal').modal('show');
    }
</script>
<script type="text/javascript">
    $(".alert").delay(3200).fadeOut(300);
</script>
<!-- script for profile pic strat -->
<script type="text/javascript">
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
        //alert(profile);
        if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            //alert('not an image');
            $('#profilepic').val('');
            picpopup();
            return false;
        } else {
            readURL(this);
        }

    });
</script>
<!-- script for profile pic end -->
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
</script>
<script type="text/javascript">
    function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<style>
    #work6 {
        display: block;
    }
    #gra1 {
        display: block;
    }
</style>
<script>
    function picpopup() {


        $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
        $('#bidmodal').modal('show');
    }
</script>
<script type="text/javascript">
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            //$( "#bidmodal" ).hide();
            $('#bidmodal-2').modal('hide');
        }
    });
</script>   
<script type="text/javascript">
    //For Scroll page at perticular position js Start
    $(document).ready(function () {

        //  $(document).load().scrollTop(1000);

        $('html,body').animate({scrollTop: 265}, 100);

        $('.complete_profile').fadeIn('fast').delay(5000).fadeOut('slow');
		$('.edit_profile_job').fadeIn('slow').delay(5000);
		$('.tr_text').fadeIn('slow').delay(500);
		$('.true_progtree img').fadeIn('slow').delay(500);
		$('.temp').fadeIn('fast').delay(5000).fadeOut('slow');
		$('.progress .progress-bar').css("width",
            function() {
                return $(this).attr("aria-valuenow") + "%";
            }
        )
   

    });
    //For Scroll page at perticular position js End
	

</script>

<script type="text/javascript" src="<?php echo base_url('js/progressloader.js'); ?>"></script>


<script type="text/javascript">
	
    /* Examples */
(function($) {
 

  /*
   * Example 2:
   *
   * - default gradient
   * - listening to `circle-animation-progress` event and display the animation progress: from 0 to 100%
   */
  $('.second.circle-1').circleProgress({
    value: <?php echo $count_profile_value;?>
	}).on('circle-animation-progress', function(event, progress) {
    $(this).find('strong').html(Math.round(<?php echo $count_profile;?> * progress) + '<i>%</i>');
  });

  
})(jQuery);

</script>
<style type="text/css">
 
@media (max-height: 600px), (max-width: 480px) {
  .credits {
    position: inherit;
  }
}

</style>