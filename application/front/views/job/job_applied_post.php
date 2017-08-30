<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

      <title><?php echo $title; ?></title>

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
   <body  class="page-container-bg-solid page-boxed custom-border">
      <section class="custom-row">
         <div class="container" id="paddingtop_fixed_job">
            <div class="row" id="row1" style="display:none;">
               <div class="col-md-12 text-center">
                  <div id="upload-demo" ></div>
               </div>
               <div class="col-md-12 cover-pic" >
                  <button class="btn btn-success  cancel-result" onclick="" >Cancel</button>
                  <button class="btn btn-success  set-btn upload-result" onclick="myFunction()">Save</button>
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
                      if($this->uri->segment(3) == $userid){
                      $user_id = $userid;
                      }elseif($this->uri->segment(3) == ""){
                      $user_id = $userid;
                      }else{
                      $user_id = $this->uri->segment(3);
                       }
                     $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                     $image = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                     
                     $image_ori = $image[0]['profile_background'];
                     if ($image_ori) {
                         ?>
                  <img src="<?php echo base_url($this->config->item('job_bg_main_upload_path')  . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
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
               <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
               <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
               </label>
            </div>
            <div class="profile-photo">
               <div class="profile-pho">
                  <div class="user-pic padd_img">
                     <?php 
                        if ($jobdata[0]['job_user_image'] != '') { ?>
                     <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $jobdata[0]['job_user_image']); ?>" alt="" >
                     <?php } else { ?>
                     <?php
                        $a = $jobdata[0]['fname'];
                               $words = explode(" ", $a);
                               foreach ($words as $w) {
                                 $acronym = $w[0];
                                 }?>
                     <?php 
                        $b = $jobdata[0]['lname'];
                        $words = explode(" ", $b);
                        foreach ($words as $w) {
                          $acronym1 = $w[0];
                          }?>
                     <div class="post-img-user">
                        <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                     </div>
                     <?php } ?>
                     <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                  </div>
               </div>
               <div class="job-menu-profile mob-block">
                  <a  href="<?php echo site_url('job/resume/' . $jobdata[0]['user_id']); ?>">
                     <h3 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h3>
                  </a>
                  <!-- text head start -->
                  <div class="profile-text" >
                     <?php
                        if ($jobdata[0]['designation'] == '') {
                            ?>
                     <a id="designation" class="designation" title="Designation">Current Work</a>
                     <?php } else {
                        ?> 
                     <a id="designation" class="designation" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>
                     <?php } ?>
                  </div>
               </div>
               <?php echo $job_menubar; ?>   
            </div>
         </div>
         <div class="middle-part container padding_set_res ">
            <div class="job-menu-profile job_edit_menu mob-none" >
               <a  href="<?php echo site_url('job/resume/' . $jobdata[0]['user_id']); ?>">
                  <h3 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h3>
               </a>
               <div class="profile-text" >
                  <!-- text head start -->
                  <div class="profile-text" >
                     <?php
                        if ($jobdata[0]['designation'] == '') {
                            ?>
                     <a id="designation" class="designation" title="Designation">Current Work</a>
                     <?php } else {
                        ?> 
                     <a id="designation" class="designation" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>
                     <?php } ?>
                  </div>
                  <!-- text head end -->
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
                     <a href="<?php echo base_url('job/basic-information')?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</a>
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
               <div class="common-form">
                  <div class="job-saved-box">
                     <h3>Applied Job</h3>
                     <div class="contact-frnd-post">
                        <?php
                           if (count($postdetail) != '0') {
                               foreach ($postdetail as $post) {
                                   ?> 
                        <div class="job-contact-frnd ">
                           <div class="profile-job-post-detail clearfix" id="<?php echo "removeapply" . $post['app_id']; ?>">
                              <div class="profile-job-post-title clearfix">
                                 <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details col-md-12 col-xs-12">
                                       <ul>
                                          <li class="fr date_re">
                                             Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                          </li>
                                          <li>
                                             <a title="Post Title" class=" post_title" href="#" >
                                             <?php $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
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
                                             <?php  if($cityname || $countryname){ ?>
                                             <div class="fr lction">
                                                <p title="location">
                                                   <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                   <?php if($cityname){ echo $cityname .', ';} echo $countryname; ?> 
                                                </p>
                                             </div>
                                             <?php }?> 
                                             <?php
                                                $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name; ?>
                                             <a  class="job_companyname" href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"  title="<?php echo $cache_time1;?>"><?php
                                                $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;       
                                                echo $out;
                                                
                                                ?></a>
                                          </li>
                                          <li><a title="Recruiter Name" class="display_inline" href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"><?php
                                             $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
                                              $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;
                                             echo ucwords($cache_time)."  ".ucwords($cache_time1);
                                                   ?></a>
                                          </li>
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
                                    </ul>
                                 </div>
                                 <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details col-md-12 col-xs-12">
                                       <ul>
                                       <li class="job_all_post last_date">
                                          Last Date :<?php if($post['post_last_date'] != "0000-00-00"){ echo date('d-M-Y',strtotime($post['post_last_date'])); }else{ echo PROFILENA;} ?>
                                       </li>
                                       <?php
                                          $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                          
                                          $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                          $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                          ?>
                                       <li class="fr">
                                          <!--<a href="#popup1" class="button">Remove</a>-->
                                          <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $post['app_id'] ?>)">Remove</a>
                                       </li>
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
                        <div class="art-img-nn">
                           <div class="art_no_post_img">
                              <img src="<?php echo base_url('img/job-no.png')?>">
                           </div>
                           <div class="art_no_post_text">
                              No  Applied Post Available.
                           </div>
                        </div>
                        <?php
                           }
                           ?> 
                     </div>
                     <div class="col-md-1">
                     </div>
                  </div>
               </div>
            </div>
            <?php
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
                           <a href="<?php echo base_url('job/basic-information')?>" class="edit_profile_job">Edit Profile
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
                        <div class="popup_previred">
                           <img id="preview" src="#" alt="your image" />
                        </div>
                        <input type="hidden" name="hitext" id="hitext" value="3">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                        <?php echo form_close(); ?>
                     </div>
                  </span>
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
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<!-- script for skill textbox automatic end-->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/raphael-min.js
'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/progressloader.js'); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
    var count_profile_value='<?php echo $count_profile_value;?>';
    var count_profile='<?php echo $count_profile;?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_applied_post.js'); ?>"></script>

</body>
</html>