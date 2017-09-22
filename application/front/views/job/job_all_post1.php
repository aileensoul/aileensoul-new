<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

      <title><?php echo $title; ?></title>

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css?ver='.time()); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
      <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()); ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css?ver='.time()); ?>">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/job/job.css?ver='.time()); ?>">
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
                  <div class="profile-boxProfileCard-cover <?php if($jobdata[0]['profile_background'] == ''){echo "bg-images no-cover-upload";}?>">
                     <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                        href="<?php echo base_url('job/resume'); ?>"
                        tabindex="-1"
                        aria-hidden="true"
                        rel="noopener">
                        <?php
                           if ($jobdata[0]['profile_background'] != '') {
                                                                            ?>
                        <!-- box image start -->
                        <img src="<?php echo JOB_BG_MAIN_UPLOAD_URL . $jobdata[0]['profile_background']; ?>" class="bgImage" alt="" >
                        <!-- box image end -->
                        <?php
                           } else {
                               ?>
                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="">
                        <?php
                           }
                           ?>
                     </a>
                  </div>
                  <div class="profile-boxProfileCard-content clearfix">
                     <div class="left_side_box_img buisness-profile-txext">
                        <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('job/resume/' . $jobdata[0]['slug']); ?>" title="<?php echo $jobdata[0]['fname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                        <?php
                           if ($jobdata[0]['job_user_image']) {
                               ?>
                        <img src="<?php echo JOB_PROFILE_THUMB_UPLOAD_URL . $jobdata[0]['job_user_image']; ?>" alt="<?php echo $jobdata[0]['fname']; ?> " >
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
                        <a   href="<?php echo site_url('job/resume/' . $jobdata[0]['slug']); ?>">  <?php echo ucfirst($jobdata[0]['fname']) . ' ' . ucfirst($jobdata[0]['lname']); ?></a>
                        </span>
                        </span>
                        <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                        <div class="profile-boxProfile-name">
                           <a  href="<?php echo base_url('job/resume/' . $jobdata[0]['slug']); ?>"><?php
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
                           <?php if (($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'resume' || $this->uri->segment(2) == 'search' || $this->uri->segment(2) == 'saved-job' || $this->uri->segment(2) == 'applied-job') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                           <li <?php if ($this->uri->segment(1) == 'search' && $this->uri->segment(2) == 'saved-job') { ?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/saved-job'); ?>">Saved </a>
                           </li>
                           <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'applied-job') { ?> class="active" <?php } ?>><a class="padding_less_right" title="Applied Job" href="<?php echo base_url('job/applied-job'); ?>">Applied </a>
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-7 col-sm-7 col-sm-push-4 col-md-push-4 custom-right">
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
                            <div class="job-contact-frnd ">
                              <!--.........AJAX DATA......-->           
                            </div>
                         <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
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
<script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/jquery.highlite.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
    var skill = '<?php echo  $this->input->get('skills'); ?>';
    var place = '<?php echo  $this->input->get('searchplace'); ?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_search.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/job/search_common.js?ver='.time()); ?>"></script>

</body>
</html>