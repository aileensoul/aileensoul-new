<!-- start head -->
<?php echo $head; ?>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<!--post save success pop up style strat -->
<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<!-- start header -->
<?php echo $header; ?>
<?php echo $job_header2_border; ?>
<!-- END HEADER -->
<body class="page-container-bg-solid page-boxed">
   <div class="user-midd-section" id="paddingtop_fixed">
      <div class="container" >
         <div class="row">
            <div class="col-md-4 col-sm-4 profile-box profile-box-left">
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
                              <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $jobdata[0]['fname']; ?>">
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
               </div>
            </div>
            <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right">
               <div class="common-form">
                  <div class="job-saved-box">
                     <h3>Recommended Job</h3>
                     <div class="contact-frnd-post">
                        <?php
                           if ($falguni == 1) {
                       
                               if (count($postdetail) > 0 && $postdetail[0][0] != '') {
                          
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
                                             <a href="#" title="<?php echo ucwords($post['post_name']); ?> " class=" post_title" >
                                             <?php echo ucwords($this->common->make_links($post['post_name'])); ?> </a>   
                                          </li>
                                          <li>
                                             <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
                                                $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                             <?php if($countryname || $cityname){ ?>
                                             <div class="fr lction">
                                                <p title="Location"><i class="fa fa-map-marker" aria-hidden="true">
                                                   <?php  if($cityname){echo $cityname;echo ', ';}
                                                      echo $countryname; ?> 
                                                   </i>
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
                                                <?php if ($post['post_description']) {echo $this->common->make_links($post['post_description']);}else{ echo PROFILENA; } ?> 
                                             </p>
                                          </span>
                                       </li>
                                       <li><b>Interview Process</b><span>
                                          <?php if($post['interview_process']){ echo $this->common->make_links($post['interview_process']);} else{echo PROFILENA;}?></span>
                                       </li>
                                       <!-- vishang 14-4 start -->
                                       <li>
                                          <b>Required Experience</b>
                                          <span title="Min - Max">
                                             <p>
                                                <?php 
                                                   if(($post['min_year'] !='0' || $post['min_month'] !='0' || $post['max_month'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
                                                      { 
                                                   echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .'.'.$post['max_month'] . ' Year'." , ". "Fresher can also apply.";
                                                      } 
                                                    
                                                     else
                                                     {
                                                   echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .'.'.$post['max_month'] . ' Year';
                                                          
                                                     }
                                                   
                                                   ?> 
                                             </p>
                                          </span>
                                       </li>
                                       <li><b>Salary</b><span title="Min - Max">
                                          <?php
                                             $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                             
                                             
                                             if ($post['min_sal'] !='' || $post['max_sal'] != ''){echo $post['min_sal']." - ".$post['max_sal'].' '. $currency ." Per Year"; } else { echo PROFILENA;} ?></span>
                                       </li>
                                       <li><b>No of Position</b><span><?php echo $post['post_position']; ?></span>
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
                           elseif ($postdetail[0][0] == '')
                           {
                            ?>
                                 <div class="text-center rio">
                              <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Job Post Not Found.</h4>
                            </div>
                            <?php
                           }
                           else {
                           
                           ?>
                        <div class="text-center rio">
                           <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Job Post Not Found.</h4>
                        </div>
                        <?php
                           }
                           } else { 
                           if (count($postdetail) > 0 && $postdetail[0][0] != '') {
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
                                       <li><?php echo $post['post_name']; ?></li>
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
                                       <li> <b> Skills:</b> <span> 
                                          <?php
                                             $comma = ",";
                                             $k = 0;
                                             $aud = $post['post_skill'];
                                             $aud_res = explode(',', $aud);
                                             foreach ($aud_res as $skill) {
                                                 if ($k != 0) {
                                                     echo $comma;
                                                 }
                                                 $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                             
                                             
                                                 echo $cache_time;
                                                 $k++;
                                             }
                                             ?>       
                                          </span>
                                       </li>
                                       <li><b>Job Description:</b><span><?php echo $post['post_description']; ?></span>
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
                                       <!--<button  class="button" disabled>Applied</button>-->
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
                         elseif ($postdetail[0][0] == '')
                           {
                            ?>
                                 <div class="text-center rio">
                              <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Job Post Not Found.</h4>
                            </div>
                            <?php
                          }
                            else {   
                                ?>

                        <div class="text-center rio">
                           <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Job Post Not Found.</h4>
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
   </div
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
   <!-- Model Popup Close -->
</body>
</html>
<!-- script for skill textbox automatic start-->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- script for skill textbox automatic end -->
<script>
   var data = <?php echo json_encode($demo); ?>;
   //alert(data);
   
   
   $(function () {
       // alert('hi');
       $("#tags").autocomplete({
           source: function (request, response) {
               var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
               response($.grep(data, function (item) {
                   return matcher.test(item.label);
               }));
           },
           minLength: 1,
           select: function (event, ui) {
               event.preventDefault();
               $("#tags").val(ui.item.label);
               $("#selected-tag").val(ui.item.label);
               // window.location.href = ui.item.value;
           }
           ,
           focus: function (event, ui) {
               event.preventDefault();
               $("#tags").val(ui.item.label);
           }
       });
   });
   
</script>
<script>
   var data1= <?php echo json_encode($city_data); ?>;
   //alert(data);
   
           
   $(function() {
       // alert('hi');
   $( "#searchplace" ).autocomplete({
        source: function( request, response ) {
            var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
            response( $.grep( data1, function( item ){
                return matcher.test( item.label );
            }) );
      },
       minLength: 1,
       select: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       }
       ,
       focus: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
       }
   });
   });
     
</script>
<!--  <script>
   //select2 autocomplete start for skill
   $('#searchskills').select2({
   
       placeholder: 'Find Your Skills',
   
       ajax: {
   
           url: "<?php echo base_url(); ?>job/keyskill",
           dataType: 'json',
           delay: 250,
   
           processResults: function (data) {
   
               return {
   
                   results: data
   
   
               };
   
           },
           cache: true
       }
   });
   //select2 autocomplete End for skill
   
   //select2 autocomplete start for Location
   $('#searchplace').select2({
   
       placeholder: 'Find Your Location',
       maximumSelectionLength: 1,
       ajax: {
   
           url: "<?php echo base_url(); ?>job/location",
           dataType: 'json',
           delay: 250,
   
           processResults: function (data) {
   
               return {
   
                   results: data
   
   
               };
   
           },
           cache: true
       }
   });
   //select2 autocomplete End for Location
   
   </script>
   -->
<script>
   //tooltip
   $(document).ready(function () {
       $('[data-toggle="tooltip"]').tooltip();
   
   });
</script>
<!-- popup form edit start -->
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
<!-- for search validation -->
<script type="text/javascript">
   function checkvalue() {
       // alert("hi");
       var searchkeyword = document.getElementById('tags').value;
       var searchplace = document.getElementById('searchplace').value;
       // alert(searchkeyword);
       // alert(searchplace);
       if (searchkeyword == "" && searchplace == "") {
           // alert('Please enter Keyword');
           return false;
       }
   }
   
</script>
<!-- save post start -->
<script type="text/javascript">
   function save_post(abc)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/job_save" ?>',
           data: 'post_id=' + abc,
           success: function (data) {
               $('.' + 'savedpost' + abc).html(data).addClass('saved');
           }
       });
   
   }
</script>
<!-- save post end -->
<!-- apply post start -->
<script type="text/javascript">
   function apply_post(abc, xyz) {
      // alert(abc);
       //alert(xyz);
       //var alldata = document.getElementById("allpost" + abc);
       var alldata = 'all';
       //var user = document.getElementById("userid" + abc);
       var user = xyz;
     //  alert(user);
   
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/job_apply_post" ?>',
   //                            data: 'post_id=' + abc + '&allpost=' + alldata.value + '&userid=' + user.value,
           data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
           success: function (data) {
               $('.savedpost' + abc).hide();
               $('.applypost' + abc).html(data);
               $('.applypost' + abc).attr('disabled', 'disabled');
               $('.applypost' + abc).attr('onclick', 'myFunction()');
               $('.applypost' + abc).addClass('applied');
           }
       });
   }
</script>
<!-- apply post end -->
<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
   function savepopup(id) {
       save_post(id);
   //                        $('.biderror .mes').html("<div class='pop_content'>Your Post is Successfully Saved.<div class='model_ok_cancel'><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal' style='right:235px !important;'>Ok</a></div></div>");
       $('.biderror .mes').html("<div class='pop_content'>Job successfully saved.");
       $('#bidmodal').modal('show');
   }
   function applypopup(postid, userid) {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to apply this job?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
</script>
<!-- all popup close close using esc start -->
<script type="text/javascript">
   $( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       //$( "#bidmodal" ).hide();
       $('#bidmodal').modal('hide');
   }
   });  
   
</script>
<!-- all popup close close using esc end -->