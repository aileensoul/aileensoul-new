<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

      <title><?php echo $title; ?></title>

      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
    	  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
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
      <div class="container padding-360">
      <div class="row4">
      <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
         <div class="">
            <div class="full-box-module">
               <div class="profile-boxProfileCard  module">
                  <div class="profile-boxProfileCard-cover <?php if($jobdata[0]['profile_background'] == ''){echo "bg-images no-cover-upload";}?>">
                     <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                        href="<?php echo base_url('job/resume'); ?>"
                        tabindex="-1"
                        aria-hidden="true"
                        rel="noopener">
                          <div class="bg-images no-cover-upload"> 
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
                  </div>
                  <div class="profile-boxProfileCard-content clearfix">
                     <div class="left_side_box_img buisness-profile-txext">
                        <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('job/resume/' . $jobdata[0]['slug']); ?>" title="<?php echo $jobdata[0]['fname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                        <?php
                           if ($jobdata[0]['job_user_image']) {
                               ?>
                        <div class="left_iner_img_profile"><img src="<?php echo JOB_PROFILE_THUMB_UPLOAD_URL . $jobdata[0]['job_user_image']; ?>" alt="<?php echo $jobdata[0]['fname']; ?> " ></div>
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
			<div class="tablate-potrat-add">
								<div class="fw text-center pt10">
									<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
									<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
								</div>
							</div>
		 
		 </div>
      </div>
      <div class="custom-right-art mian_middle_post_box animated fadeInUp">
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
				<div class="mob-add">
								<div class="fw text-center pt10 pb5">
									<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
									<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
								</div>
							</div>
                            <div class="job-contact-frnd ">
                              <!--.........AJAX DATA......-->           
                            </div>
                         <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver='.time()) ?>" /></div>
				</div>

            </div>
         </div>
      </div>
	  <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 
					
							<div class="fw text-center">
								<script type="text/javascript">
									  ( function() {
										if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
										var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":300,"height":250,"sid":"Chitika Default"};
										var placement_id = window.CHITIKA.units.length;
										window.CHITIKA.units.push(unit);
										document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
									}());
									</script>
								<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
								<div class="fw pt10 text-right">
									<a href="https://www.chitika.com/publishers/apply?refid=aileensoul"><img src="https://images.chitika.net/ref_banners/300x250_hidden_ad.png" /></a>
								</div>
							</div>
							
						</div>
						<div class="tablate-add">

                            <script type="text/javascript">
						  ( function() {
							if (window.CHITIKA === undefined) { window.CHITIKA = { 'units' : [] }; };
							var unit = {"calltype":"async[2]","publisher":"Aileensoul","width":160,"height":600,"sid":"Chitika Default"};
							var placement_id = window.CHITIKA.units.length;
							window.CHITIKA.units.push(unit);
							document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
						}());
						</script>
						<script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
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
      
        
<?php echo $footer;  ?>


<!-- script for skill textbox automatic start-->
<!--<script src="<?php //echo base_url('assets/js/jquery-ui.min.js?ver='.time()); ?>"></script>-->

<script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>

<script>
    var base_url = '<?php echo base_url(); ?>';
    var skill = '<?php echo  $keyword; ?>';
    var skill = skill.replace('-', ' ');
    var place = '<?php echo  $keyword1; ?>';
    var place = place.replace('-', ' ');
    
    
           
//           if(skill == ""){
//            var  searchurl = 'jobs-in-' + place;
//             
//           } else if(place == ""){
//             var  searchurl = skill + '-jobs';
//              
//           }else{ 
//             var  searchurl =  skill + '-jobs-in-' + place;
//              
//           }
       
       
</script>

<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/job/job_search.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/job/search_common.js?ver='.time()); ?>"></script>

</body>
</html>