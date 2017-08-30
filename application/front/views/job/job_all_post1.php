<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

      <title><?php echo $title; ?></title>

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css'); ?>">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/job/job.css'); ?>">
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
      <div class="container">
      <div class="row row4">
      <div class="col-md-4 profile-box profile-box-left">
         <div class="">
            <div class="full-box-module">
               <div class="profile-boxProfileCard  module">
                  <div class="profile-boxProfileCard-cover">
                     <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                        href="<?php echo base_url('job/resume'); ?>"
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
                        <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('job/resume/' . $jobdata[0]['user_id']); ?>" title="<?php echo $jobdata[0]['fname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                        <?php
                           if ($jobdata[0]['job_user_image']) {
                               ?>
                        <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $jobdata[0]['job_user_image']); ?>" alt="<?php echo $jobdata[0]['fname']; ?> " >
                        <?php
                           } else {
                               ?>
                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $jobdata[0]['fname']; ?>">
                        <?php
                           }
                           ?>
                        </a>
                     </div>
                     <div class="right_left_box_design ">
                        <span class="profile-company-name ">
                        <span class="profile-company-name ">
                        <a   href="<?php echo site_url('job/resume/' . $jobdata[0]['user_id']); ?>">  <?php echo ucfirst($jobdata[0]['fname']) . ' ' . ucfirst($jobdata[0]['lname']); ?></a>
                        </span>
                        </span>
                        <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                        <div class="profile-boxProfile-name">
                           <a  href="<?php echo base_url('job/resume/' . $jobdata[0]['user_id']); ?>"><?php
                              if (ucwords($jobdata[0]['designation'])) {
                                  echo ucwords($jobdata[0]['designation']);
                              } else {
                                  echo "Current Work";
                              }
                              ?></a>
                        </div>
                        <ul class=" left_box_menubar">
                           <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'resume') { ?> class="active" <?php } ?>>
                              <a class="padding_less_left" title="Details" href="<?php echo base_url('job/resume'); ?>"> Details</a>
                           </li>
                           <?php if (($this->uri->segment(1) == 'search') && ($this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'resume' || $this->uri->segment(2) == 'job_search' || $this->uri->segment(2) == 'saved-job' || $this->uri->segment(2) == 'applied-job') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                           <li <?php if ($this->uri->segment(1) == 'search' && $this->uri->segment(2) == 'saved-job') { ?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/saved-job'); ?>">Saved </a>
                           </li>
                           <li <?php if ($this->uri->segment(1) == 'search' && $this->uri->segment(2) == 'applied-job') { ?> class="active" <?php } ?>><a class="padding_less_right" title="Applied Job" href="<?php echo base_url('job/applied-job'); ?>">Applied </a>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-7 col-sm-7 col-sm-push-4 col-md-push-4">
         <div class="common-form">
            <div class="job-saved-box">
               <h3>
                  Search result of 
                  <?php  if($keyword != "" && $keyword1 == ""){echo '"' .  $keyword . '"';}
                     elseif ($keyword == "" && $keyword1 != "") {
                       echo '"' .  $keyword1 . '"';
                     }
                     else
                     {
                        echo '"' .  $keyword . '"'; echo  " in "; echo '"' .  $keyword1 . '"';
                     }
                     ?>
               </h3>
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
                     if ($falguni == 1) {
                        
                         if (count($postdetail) > 0) {
                          foreach ($postdetail as $post) {
                                 ?> 
                  <div class="job-contact-frnd ">
                     <div class="profile-job-post-detail clearfix" id="<?php echo "postdata" . $post['post_id']; ?>">
                        <div class="profile-job-post-title clearfix search">
                           <div class="profile-job-profile-button clearfix">
                              <div class="profile-job-details col-md-12">
                                 <ul>
                                    <li class="fr">
                                       Created Date: <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                    </li>
                                    <li class="text_overflow">
                                       <a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>" class="post_title" >
                                       <?php 
                                          $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                                          echo  $cache_time; 
                                          ?> </a>   
                                    </li>
                                    <li>
                                       <div class="fr lction">
                                          <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                                             $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                          <?php  
                                             if($cityname || $countryname)
                                             { 
                                             ?>
                                          <p title="Location"><i class="fa fa-map-marker" aria-hidden="true">
                                             <?php  echo $cityname .', '. $countryname; ?> 
                                             </i>
                                          </p>
                                          <?php
                                             }
                                             
                                             else{}?> 
                                       </div>
                                       <?php
                                          $cache_time1= $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name;
                                          ?>
                                       <a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"  title="<?php echo $cache_time1;?>"> <?php  $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;
                                          echo $out;
                                          
                                          ?></a> 
                                    </li>
                                    <li><a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"><?php
                                       $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
                                       
                                           $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;
                                       echo ucwords($cache_time)."".ucwords($cache_time1);
                                         ?></a></li>
                                    <!-- vishang 14-4 end -->    
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
                                       <?php if($post['re_comp_profile'] != ''){?>
                                       <pre>
                                            <?php echo $this->common->make_links($post['re_comp_profile']); ?></pre>
                                       <?php }else{ echo PROFILENA; }?> 
                                    </span>
                                 </li>
                                 <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
                              </ul>
                           </div>
                           <div class="profile-job-profile-button clearfix">
                              <div class="profile-job-details col-md-12">
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
                                    -->
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
                                    <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button save_saved_btn">Savess</a>
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
                     } else {
                     ?>
                  <div class="text-center rio">
                     <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                     <p style="margin-left:4%;text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                     <ul>
                        <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                     </ul>
                  </div>
                  <?php     }
                     } else {
                         if (count($postdetail) > 0) {
                             foreach ($postdetail as $post_key => $post) {
                                 ?> 
                  <div class="job-contact-frnd ">
                     <div class="profile-job-post-detail clearfix" id="<?php echo "postdata" . $post['post_id']; ?>">
                        <div class="profile-job-post-title clearfix search">
                           <div class="profile-job-profile-button clearfix">
                              <div class="profile-job-details col-md-12">
                                 <ul>
                                    <li class="fr">
                                       Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                    </li>
                                    <li class="text_overflow">
                                       <a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>" class="display_inline post_title">
                                       <?php 
                                          $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                                          
                                                                        if($cache_time){
                                                                        echo  $cache_time;
                                                                        }else{
                                                                         echo $post['post_name'];
                                                                        }
                                                                      
                                                                          ?>
                                       </a>                                        
                                    </li>
                                    <li>
                                       <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                                          $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                       <?php if($cityname || $countryname){ ?>
                                       <div class="fr lction">
                                          <p title="Address"><i class="fa fa-map-marker" aria-hidden="true">
                                             <?php if($cityname){echo $cityname .', ';} echo $countryname; ?> 
                                             </i>
                                          </p>
                                       </div>
                                       <?php }?> 
                                       <?php
                                          $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name;
                                            ?>
                                       <a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>" title="<?php echo $cache_time1;?>"> <?php $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;
                                          echo $out;
                                          ?>
                                       </a>
                                    </li>
                                    <li><a href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"><?php
                                       $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
                                        $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;
                                          echo ucwords($cache_time)."  ".ucwords($cache_time1);
                                                                           ?></a></li>
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
                                       <?php if($post['re_comp_profile'] != ''){?>
                                       <pre>
                                            <?php echo $this->common->make_links($post['re_comp_profile']); ?></pre>
                                       <?php }else{ echo PROFILENA; }?> 
                                    </span>
                                 </li>
                                 <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
                              </ul>
                           </div>
                           <div class="profile-job-profile-button clearfix">
                              <div class="profile-job-details col-md-12">
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
                     } else {
                     ?>
                  <div class="text-center rio">
                     <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                     <p style="margin-left:4%;text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                     <ul>
                        <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                     </ul>
                  </div>
                  <?php }
                     }
                     ?>
               </div>
            </div>
         </div>
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
<script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_search.js'); ?>"></script>

</body>
</html>