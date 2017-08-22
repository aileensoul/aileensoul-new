<!-- start head -->
<?php echo $head; ?>
<!--post save success pop up style strat -->

<style type="text/css">
    #popup-form img{display: none;}
</style>


<!-- END HEAD -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>



<body   class="page-container-bg-solid page-boxed custom-border">
    <!-- start header -->
<?php echo $header; ?>
<!-- End header -->

<!-- END HEADER -->
<?php echo $job_header2_border; ?>

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
        <a  href="<?php echo site_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>"><h3 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h3></a>
        <!-- text head start -->

        <div class="profile-text" >

            <?php
            if ($jobdata[0]['designation'] == '') {
                ?>
                        <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                <a id="designation" class="designation" title="Designation">Current Work</a>
            <?php } else {
                ?> 
                    <!--<a id="myBtn" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>-->
                <a id="designation" class="designation" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>

            <?php } ?>
            </div>


          
        </div>

        <!-- menubar -->
<!-- 
        <div class="profile-main-rec-box-menu  col-md-12 ">

            <div class="left-side-menu ">  </div>
            <div class="right-side-menu col-md-9 padding_less_right">  
                <ul class="">
                    <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_printpreview') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('job/job_printpreview'); ?>"> Details</a>
                    </li>
                    <?php if (($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                       
                        <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_save_post') { ?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/job_save_post'); ?>">Saved </a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_applied_post') { ?> class="active" <?php } ?>><a title="Applied Job" href="<?php echo base_url('job/job_applied_post'); ?>">Applied </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div> -->
        <?php echo $job_menubar; ?>   
    </div>
    
    </div> 
    <div class="middle-part container padding_set_res ">
    <div class="job-menu-profile job_edit_menu mob-none" >
        <a  href="<?php echo site_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>"><h3 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h3></a>
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
                                           
                                             
                        ?> </a>   </li>

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
                                                <?php if ($post['post_description']) { ?> <pre> <?php echo $this->common->make_links($post['post_description']);  ?> </pre> <?php }else{ echo PROFILENA; } ?> 
                                             </p>
                                          </span>
                                       </li>
                                       <li><b>Interview Process</b><span>
                                          <?php if($post['interview_process']){ ?> <pre> <?php  echo $this->common->make_links($post['interview_process']);} else{echo PROFILENA;}?> </pre> </span>
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
                                             <li><b>Employment Type</b><span>
                                            

                                            <?php if($post['emp_type'] != ''){?>
                                            <pre>
                                            <?php echo $this->common->make_links($post['emp_type']).'  Job'; ?></pre>
                                               <?php }else{ echo PROFILENA; }?> 

                                            </span>
                                            </li>



                                             <li><b>Company Profile</b><span>
                                            

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
                                                    Last Date :<?php if($post['post_last_date'] != "0000-00-00"){ echo date('d-M-Y',strtotime($post['post_last_date'])); }else{ echo PROFILENA;} ?></li>

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
                <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
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
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                        <?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->
</body>

</html>
<!-- script for skill textbox automatic start-->
 <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
    
     <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
     <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">


<!-- script for skill textbox automatic end-->

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

<!-- popup form edit END -->
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
                url: "<?php echo base_url() ?>job/ajaxpro",
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
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    savepopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    return false;
  }
  // file type code end
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
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

<!-- remove apply post start -->

<script type="text/javascript">
    function remove_post(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "job/job_delete_apply" ?>',
            data: 'app_id=' + abc,
            success: function (data) {
                $('#' + 'removeapply' + abc).html(data);
                $('#' + 'removeapply' + abc).parent().removeClass();
                var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                if (numItems == '0') {
           
                    var nodataHtml = "<div class='art-img-nn'><div class='art_no_post_img'><img src='<?php echo base_url('img/job-no.png')?>''></div><div class='art_no_post_text'>No  Applied Post Available</div></div>";
                    $('.contact-frnd-post').html(nodataHtml);
                }
            }
        });

    }
</script>


 


<!-- remove apply post end -->

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
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function removepopup(id) {
        $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this job?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        //$('#bidmodal').modal('show');
        $('#bidmodal').modal('show').fadeIn("slow");
		/*$('#bidmodal').click(function (event) {
            $(".modal").fadeIn("slow");
        });*/
    }
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>
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
    
    $("#profilepic").change(function(){
      
        profile = this.files;
      //alert(profile);
      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
       //alert('not an image');
        $('#profilepic').val('');
         picpopup();
         return false;
          }else{
          readURL(this);}

    });
</script>

<!-- script for profile pic end -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
  
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
  <script>
                        function picpopup() {
                            
                      
            $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
            $('#bidmodal').modal('show');
                        }
                    </script>


                    <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide').fadeOut("slow");
    }
});  


     $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide').fadeOut("slow");
    }
});  

 </script>
 <!-- all popup close close using esc end -->


 <script type="text/javascript">
//For Scroll page at perticular position js Start
$(document).ready(function(){
 
//  $(document).load().scrollTop(1000);
     
    $('.complete_profile').fadeIn('fast').delay(5000).fadeOut('slow');
    $('.temp').fadeIn('fast').delay(5000).fadeOut('slow');
	$('.edit_profile_job').fadeIn('slow').delay(5000);
	$('.tr_text').fadeIn('slow').delay(500);
	$('.true_progtree img').fadeIn('slow').delay(500);
	$('.progress .progress-bar').css("width",
            function() {
                return $(this).attr("aria-valuenow") + "%";
            }
        )

});
//For Scroll page at perticular position js End
</script><!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js"></script> -->
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