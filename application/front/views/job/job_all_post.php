<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css'); ?>">
   </head>
   <!-- END HEAD -->
   <!-- Start HEADER -->
   <?php 
      echo $header; 
      echo $job_header2_border;  
      ?>
   <!-- END HEADER -->
   <body class="page-container-bg-solid page-boxed">
      <div class="user-midd-section" id="paddingtop_fixed">
         <div class="container" >
            <div class="row">
               <div class="col-md-4 col-sm-4 profile-box profile-box-left animated fadeInLeftBig">
                  <div class="">
                     <div class="full-box-module">
                        <div class="profile-boxProfileCard  module">
                           <div class="profile-boxProfileCard-cover">
                              <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                 href="<?php echo base_url('job/job_printpreview'); ?>"
                                 tabindex="-1"
                                 aria-hidden="true"
                                 rel="noopener">
                                 <?php
                                    if ($jobdata[0]['profile_background'] != '') {
                                                                                     ?>
                                 <!-- box image start -->
                                 <img src="<?php echo base_url($this->config->item('job_bg_thumb_upload_path') . $jobdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $jobdata[0]['fname']; ?>" >
                                 <!-- box image end -->
                                 <?php
                                    } else {
                                        ?>
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $jobdata[0]['fname']; ?>">
                                 <?php
                                    }
                                    ?>
                              </a>
                           </div>
                           <div class="profile-boxProfileCard-content clearfix">
                              <div class="left_side_box_img buisness-profile-txext">
                                 <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>" title="<?php echo $jobdata[0]['fname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                    <?php
                                       if ($jobdata[0]['job_user_image']) {
                                           ?>
                                    <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $jobdata[0]['job_user_image']); ?>" alt="<?php echo $jobdata[0]['fname']; ?> " >
                                    <?php
                                       } else {
                                       
                                        ?>
                                    <div class="data_img_2">
                                       <?php 
                                          $a = $jobdata[0]['fname'];
                                          $words = explode(" ", $a);
                                          foreach ($words as $w) {
                                            $acronym .= $w[0];
                                            }?>
                                       <?php 
                                          $b = $jobdata[0]['lname'];
                                          $words = explode(" ", $b);
                                          foreach ($words as $w) {
                                            $acronym1 .= $w[0];
                                            }?>
                                       <div>
                                          <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                                       </div>
                                    </div>
                                    <?php
                                       }
                                       ?>
                                 </a>
                              </div>
                              <div class="right_left_box_design ">
                                 <span class="profile-company-name ">
                                 <span class="profile-company-name ">
                                 <a   href="<?php echo site_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>">  <?php echo ucfirst($jobdata[0]['fname']) . ' ' . ucfirst($jobdata[0]['lname']); ?></a>
                                 </span>
                                 </span>
                                 <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                 <div class="profile-boxProfile-name">
                                    <a  href="<?php echo base_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>"><?php
                                       if (ucwords($jobdata[0]['designation'])) {
                                           echo ucwords($jobdata[0]['designation']);
                                       } else {
                                           echo "Current Work";
                                       }
                                       ?></a>
                                 </div>
                                 <ul class=" left_box_menubar">
                                    <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_printpreview') { ?> class="active" <?php } ?>>
                                       <a class="padding_less_left" title="Details" href="<?php echo base_url('job/job_printpreview'); ?>"> Details</a>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                                    <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_save_post') { ?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/job_save_post'); ?>">Saved </a>
                                    </li>
                                    <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_applied_post') { ?> class="active" <?php } ?>><a class="padding_less_right" title="Applied Job" href="<?php echo base_url('job/job_applied_post'); ?>">Applied </a>
                                    </li>
                                    <?php } ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="edi_origde">
                        <?php
                           if($count_profile == 100)
                           {
                           ?>
                        <div class="edit_profile_progress complete_profile">
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
                        <div class="edit_profile_progress">
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
                     </div>
                     <div class="custom_footer_left fw">
          <div class="fl">
            <ul>
              <li><a href=""> About Us </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Contact Us</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a  href="">Blogs</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Terms & Condition </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Privacy Policy</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Send Us Feedback</a></li>
            </ul>
          </div>
        <div>
          
        </div>

        </div>
                  </div>
               </div>
               <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right animated fadeInUp">
                  <div class="common-form">
                     <div class="job-saved-box">
                        <h3>Recommended Job</h3>
                        <div class="contact-frnd-post">
                           <?php
                              if ($falguni == 1) {
                              
                                
                              if (count($postdetail) > 0) { 
                                      foreach ($postdetail as $postdetail1) {
                                          foreach ($postdetail1 as $post) {
                                          ?> 
                           <div class="job-contact-frnd ">
                              <div class="profile-job-post-detail clearfix" id="<?php echo "applypost" . $post['app_id']; ?>">
                                 <!-- vishang 14-4 end -->
                                 <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-md-12 col-xs-12  padding_job_rs">
                                          <ul>
                                             <li class="fr date_re">
                                                Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                             </li>
                                             <li>
                                                <?php
                                                   $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                                                   ?>
                                                <a href="javascript:void(0);" title="<?php echo  $cache_time; ?> " class=" post_title" >
                                                <?php 
                                                   if($cache_time){
                                                   echo  $cache_time;
                                                   }else{
                                                    echo $post['post_name'];
                                                   }
                                                   
                                                     ?> </a>   
                                             </li>
                                             <li>
                                                <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                                                   $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                <?php if($countryname || $cityname){ ?>
                                                <div class="fr lction">
                                                   <p title="Location"><i class="fa fa-map-marker" aria-hidden="true">
                                                      </i>
                                                      <?php  if($cityname){echo $cityname;echo ', ';}
                                                         echo $countryname; ?>
                                                   </p>
                                                </div>
                                                <?php }?>
                                                <?php
                                                   $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name; ?>
                                                <a class="job_companyname "    href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>" title="<?php echo $cache_time1;?>"><?php
                                                   $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;       
                                                   echo $out;
                                                      ?></a>
                                             </li>
                                             <li><a class="display_inline" title="Recruiter Name" href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"><?php
                                                $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
                                                
                                                $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;
                                                echo ucwords($cache_time)."  ".ucwords($cache_time1);
                                                 ?></a></li>
                                             <!-- vishang 14-4 end -->    
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                       <ul class="clearfix">
                                          <li> <b> Skills</b> <span> 
                                             <?php
                                                $comma = ",";
                                                $k = 0;
                                                $aud = $post['post_skill'];
                                                $aud_res = explode(',', $aud);
                                                
                                                if(!$post['post_skill']){
                                                
                                                 echo $post['other_skill'];
                                                
                                                }else if(!$post['other_skill']){
                                                
                                                
                                                 foreach ($aud_res as $skill) {
                                                  if ($k != 0) {
                                                     echo $comma;
                                                 }
                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                                echo $cache_time;
                                                $k++;
                                                }
                                                
                                                
                                                }else if($post['post_skill'] && $post['other_skill']){
                                                 foreach ($aud_res as $skill) {
                                                  if ($k != 0) {
                                                     echo $comma;
                                                 }
                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                                echo $cache_time;
                                                $k++;
                                                }echo ',' . $post['other_skill'];}
                                                ?>       
                                             </span>
                                          </li>
                                          <li>
                                             <b>Job Description</b>
                                             <span>
                                                <p>
                                                   <?php if ($post['post_description']) { ?> 
                                                <pre> <?php echo $this->common->make_links($post['post_description']);  ?> </pre>
                                                <?php }else{ echo PROFILENA; } ?> 
                                                </p>
                                             </span>
                                          </li>
                                          <li>
                                             <b>Interview Process</b>
                                             <span>
                                                <?php if($post['interview_process']){ ?> 
                                                <pre> <?php  echo $this->common->make_links($post['interview_process']);} else{echo PROFILENA;}?> </pre>
                                             </span>
                                          </li>
                                          <li>
                                             <b>Required Experience</b>
                                             <span>
                                                <p title="Min - Max">
                                                   <?php 
                                                      if(($post['min_year'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
                                                      { 
                                                      
                                                      
                                                         echo $post['min_year'].' Year - '.$post['max_year'] .' Year'." , ".   "Fresher can also apply.";
                                                           } 
                                                       else if(($post['min_year'] !='0' || $post['max_year'] !='0'))
                                                            {
                                                         echo $post['min_year'].' Year - '.$post['max_year'] . ' Year';
                                                              }
                                                            else
                                                          {
                                                            echo "Fresher";
                                                      
                                                            }
                                                      
                                                            ?> 
                                                </p>
                                             </span>
                                          </li>
                                          <li><b>Salary</b><span title="Min - Max" >
                                             <?php
                                                $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                
                                                if($post['min_sal'] || $post['max_sal']) {
                                                echo $post['min_sal']." - ".$post['max_sal'].' '. $currency . ' '. $post['salary_type']; } 
                                                else { echo PROFILENA;} ?></span>
                                          </li>
                                          <li><b>No of Position</b><span><?php echo $post['post_position'].' '. 'Position'; ?></span>
                                          </li>
                                          <li><b>Industry Type</b> <span>
                                             <?php
                                                $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                                                   echo $cache_time;
                                                 ?>
                                             </span> 
                                          </li>
                                          <?php if ($post['degree_name'] != '' || $post['other_education'] != '') { ?>
                                          <li> <b>Education Required</b> <span> 
                                             <?php
                                                $comma = ", ";
                                                $k = 0;
                                                $edu = $post['degree_name'];
                                                $edu_nm = explode(',', $edu);
                                                
                                                if(!$post['degree_name']){
                                                
                                                    echo $post['other_education'];
                                                
                                                }else if(!$post['other_education']){
                                                
                                                
                                                    foreach ($edu_nm as $edun) {
                                                 if ($k != 0) {
                                                    echo $comma;
                                                }
                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                                
                                                
                                                echo $cache_time;
                                                    $k++;
                                                }
                                                
                                                
                                                }else if($post['degree_name'] && $post['other_education']){
                                                foreach ($edu_nm as $edun) {
                                                 if ($k != 0) {
                                                    echo $comma;
                                                }
                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                                
                                                
                                                echo $cache_time;
                                                    $k++;
                                                } echo ",". $post['other_education']; }
                                                ?>     
                                             </span>
                                          </li>
                                          <?php }
                                             else
                                             { ?>
                                          <li><b>Education Required</b><span>
                                             <?php
                                                echo PROFILENA; ?>
                                             </span>
                                          </li>
                                          <?php      }
                                             ?>
                                          <li>
                                             <b>Employment Type</b>
                                             <span>
                                                <?php if($post['emp_type'] != ''){?>
                                                <pre>
                                            <?php echo $this->common->make_links($post['emp_type']).'  Job'; ?></pre>
                                                <?php }else{ echo PROFILENA; }?> 
                                             </span>
                                          </li>
                                          <li>
                                             <b>Company Profile</b>
                                             <span>
                                                <?php 
                                                   $currency = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_profile;
                                                   
                                                                                   if($currency != ''){?>
                                                <pre>
                                            <?php echo $this->common->make_links($currency); ?></pre>
                                                <?php }else{ echo PROFILENA; }?> 
                                             </span>
                                          </li>
                                       </ul>
                                    </div>
                                    <div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-md-12 col-xs-12">
                                          <ul>
                                          <li class="job_all_post last_date">
                                             Last Date : <?php if($post['post_last_date'] != "0000-00-00"){ echo date('d-M-Y',strtotime($post['post_last_date'])); }else{ echo PROFILENA;} ?>
                                          </li>
                                          <?php
                                             $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                             
                                             $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                             $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             if ($jobsave) {
                                                ?>
                                          <a href="javascript:void(0);" class="button applied">Applied</a>
                                          <?php
                                             } else {
                                                  ?>
                                          <li class="fr"> 
                                             <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)">Apply</a>
                                          </li>
                                          <li class="fr">
                                             <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                    $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                                 $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                
                                                   if ($jobsave) {
                                                          ?>
                                             <a class="button saved save_saved_btn">Saved</a>
                                             <?php } else { ?>       
                                             <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button save_saved_btn">Save</a>
                                             <?php } ?>
                                          </li>
                                          <?php
                                             }
                                             ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-1">
                              </div>
                           </div>
                           <?php
                              }
                              }
                              } 
                              
                              else {
                              
                              ?>
                           <div class="art-img-nn">
                              <div class="art_no_post_img">
                                 <img src="<?php echo base_url('img/job-no.png')?>">
                              </div>
                              <div class="art_no_post_text">
                                 No  Recommended Post Available.
                              </div>
                           </div>
                           <?php
                              }
                              } else { 
                              
                               if (count($postdetail) > 0) {
                                  foreach ($postdetail as $post_key => $postdetail1){
                                   foreach ($postdetail1 as $post) {
                                      ?> 
                           <div class="job-contact-frnd ">
                              <div class="profile-job-post-detail clearfix" id="<?php echo "applypost" . $post['app_id']; ?>">
                                 <div class="profile-job-post-title-inside clearfix">
                                    <div class="profile-job-post-location-name">
                                       <ul>
                                          <li><a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id']); ?>"><?php
                                             $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
                                             
                                             echo $cache_time;
                                             ?></a></li>
                                          <li>
                                             <?php
                                                $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                                                ?>
                                             <a href="javascript:void(0);" title="<?php echo  $cache_time; ?> " class=" post_title" >
                                             <?php 
                                                if($cache_time){
                                                echo  $cache_time;
                                                }else{
                                                 echo $post['post_name'];
                                                }
                                                  ?> 
                                             </a>   
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                       <div class="profile-job-details col-xs-12">
                                          <ul>
                                             <li>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year"; ?>"><i class="fa fa-star-o" aria-hidden="true"></i>       <?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year"; ?></a>
                                             </li>
                                             <li>
                                                <div class="fr lction">
                                                   <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                                                      $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                   <?php  
                                                      if($cityname || $countryname)
                                                      { 
                                                      ?>
                                                   <p><i class="fa fa-map-marker" aria-hidden="true">
                                                      <?php  echo $cityname .', '. $countryname; ?> 
                                                      </i>
                                                   </p>
                                                   <?php
                                                      }
                                                      
                                                      else{}?> 
                                                </div>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                       <ul class="clearfix">
                                          <li> <b> Skills</b> <span> 
                                             <?php
                                                $comma = ", ";
                                                $k = 0;
                                                $aud = $post['post_skill'];
                                                $aud_res = explode(',', $aud);
                                                
                                                if(!$post['post_skill']){
                                                
                                                 echo $post['other_skill'];
                                                
                                                }else if(!$post['other_skill']){
                                                
                                                
                                                 foreach ($aud_res as $skill) {
                                                  if ($k != 0) {
                                                     echo $comma;
                                                 }
                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                                echo $cache_time;
                                                $k++;
                                                }
                                                
                                                
                                                }else if($post['post_skill'] && $post['other_skill']){
                                                 foreach ($aud_res as $skill) {
                                                  if ($k != 0) {
                                                     echo $comma;
                                                 }
                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                
                                                echo $cache_time;
                                                $k++;
                                                }echo ',' . $post['other_skill'];}
                                                ?>       
                                             </span>
                                          </li>
                                          <li>
                                             <b>Job Description</b>
                                             <span>
                                                <p>
                                                   <?php if ($post['post_description']) { ?> 
                                                <pre> <?php echo $this->common->make_links($post['post_description']);  ?> </pre>
                                                <?php }else{ echo PROFILENA; } ?> 
                                                </p>
                                             </span>
                                          </li>
                                          <li>
                                             <b>Interview Process</b>
                                             <span>
                                                <?php if($post['interview_process']){ ?> 
                                                <pre> <?php  echo $this->common->make_links($post['interview_process']);} else{echo PROFILENA;}?> </pre>
                                             </span>
                                          </li>
                                          <li>
                                             <b>Required Experience</b>
                                             <span>
                                                <p title="Min - Max">
                                                   <?php 
                                                      if(($post['min_year'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
                                                      { 
                                                      
                                                      
                                                         echo $post['min_year'].' Year - '.$post['max_year'] .' Year'." , ".   "Fresher can also apply.";
                                                           } 
                                                       else if(($post['min_year'] !='0' || $post['max_year'] !='0'))
                                                            {
                                                         echo $post['min_year'].' Year - '.$post['max_year'] . ' Year';
                                                              }
                                                            else
                                                          {
                                                            echo "Fresher";
                                                      
                                                            }
                                                      
                                                            ?> 
                                                </p>
                                             </span>
                                          </li>
                                          <li><b>Salary</b><span title="Min - Max" >
                                             <?php
                                                $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                
                                                if($post['min_sal'] || $post['max_sal']) {
                                                echo $post['min_sal']." - ".$post['max_sal'].' '. $currency . ' '. $post['salary_type']; } 
                                                else { echo PROFILENA;} ?></span>
                                          </li>
                                          <li><b>No of Position</b><span><?php echo $post['post_position'].' '. 'Position'; ?></span>
                                          </li>
                                          <li><b>Industry Type</b> <span>
                                             <?php
                                                $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                                                   echo $cache_time;
                                                 ?>
                                             </span> 
                                          </li>
                                          <?php if ($post['degree_name'] != '' || $post['other_education'] != '') { ?>
                                          <li> <b>Education Required</b> <span> 
                                             <?php
                                                $comma = ", ";
                                                $k = 0;
                                                $edu = $post['degree_name'];
                                                $edu_nm = explode(',', $edu);
                                                
                                                if(!$post['degree_name']){
                                                
                                                    echo $post['other_education'];
                                                
                                                }else if(!$post['other_education']){
                                                
                                                
                                                    foreach ($edu_nm as $edun) {
                                                 if ($k != 0) {
                                                    echo $comma;
                                                }
                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                                
                                                
                                                echo $cache_time;
                                                    $k++;
                                                }
                                                
                                                
                                                }else if($post['degree_name'] && $post['other_education']){
                                                foreach ($edu_nm as $edun) {
                                                 if ($k != 0) {
                                                    echo $comma;
                                                }
                                                $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;
                                                
                                                
                                                echo $cache_time;
                                                    $k++;
                                                } echo ",". $post['other_education']; }
                                                ?>     
                                             </span>
                                          </li>
                                          <?php }
                                             else
                                             { ?>
                                          <li><b>Education Required</b><span>
                                             <?php
                                                echo PROFILENA; ?>
                                             </span>
                                          </li>
                                          <?php      }
                                             ?>
                                          <li>
                                             <b>Employment Type</b>
                                             <span>
                                                <?php if($post['emp_type'] != ''){?>
                                                <pre>
                                            <?php echo $this->common->make_links($post['emp_type']).'  Job'; ?></pre>
                                                <?php }else{ echo PROFILENA; }?> 
                                             </span>
                                          </li>
                                          <li>
                                             <b>Company Profile</b>
                                             <span>
                                                <?php 
                                                   $currency = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_profile;
                                                   
                                                                                   if($currency != ''){?>
                                                <pre>
                                            <?php echo $this->common->make_links($currency); ?></pre>
                                                <?php }else{ echo PROFILENA; }?> 
                                             </span>
                                          </li>
                                          <div class="pull-right">
                                             <?php echo $post['created_date']; ?>
                                          </div>
                                       </ul>
                                    </div>
                                    <div class="profile-job-profile-button clearfix">
                                       <div>
                                          <?php
                                             $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                             
                                             $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                             $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             
                                             if ($jobsave[0]['job_save'] == 1) {
                                                 ?>
                                          <a href="javascript:void(0);" class="applied button">Applied</a>
                                          <?php
                                             } else {
                                                 ?>                                                    
                                          <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id']; ?>,<?php echo $post['user_id']; ?>)">Apply</a>   
                                          <?php
                                             $userid = $this->session->userdata('aileenuser');
                                             $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                             $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             
                                             if ($jobsave) {
                                                 ?>
                                          <a class="button">Saved</a>
                                          <?php } else { ?>                   
                                          <a onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button">Save</a>
                                          <?php } ?>
                                          <?php
                                             }
                                             ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-1">
                              </div>
                           </div>
                           <?php
                              } 
                              }
                              }
                               else {   
                                   ?>
                           <div class="art-img-nn">
                              <div class="art_no_post_img">
                                 <img src="<?php echo base_url('img/job-no.png')?>">
                              </div>
                              <div class="art_no_post_text">
                                 No  Recommended Post Available.
                              </div>
                           </div>
                           <?php
                              }
                              }
                              
                              ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <div class="">
      </div>
      </section>
      <!-- Model Popup Open -->
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
<footer>        
<?php echo $footer;  ?>
</footer>

<!-- script for skill textbox automatic start-->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- script for skill textbox automatic end -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/raphael-min.js
'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/progressloader.js'); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
    var count_profile_value='<?php echo $count_profile_value;?>';
    var count_profile='<?php echo $count_profile;?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_all_post.js'); ?>"></script>

</body>
</html>