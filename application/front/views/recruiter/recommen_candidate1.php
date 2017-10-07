<head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/recruiter/recruiter.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; 
              echo $recruiter_header2_border;
        ?>
        <div id="preloader"></div>
        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->

        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">


                    <div class="col-md-4 profile-box profile-box-left animated fadeInLeftBig"><div class="">
                                <div class="full-box-module">   
      <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover"> 
                                              <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('recruiter/profile'); ?>" tabindex="-1" 
                 aria-hidden="true" rel="noopener">
             <div class="bg-images no-cover-upload">  
               <?php

                $imageee= $this->config->item('rec_bg_thumb_upload_path').$recdata[0]['profile_background'];
           if(file_exists($imageee) && $recdata[0]['profile_background'] != '')
                 {
                   ?>
               <img src="<?php echo base_url($this->config->item('rec_bg_thumb_upload_path') . $recdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>">
                    <!-- box image end -->
                         <?php
                   } else {
                             ?>
                  <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                <?php
                             }
                                 ?>
                                        </a>
                                    </div>
                                    </div>
                                    <div class="profile-boxProfileCard-content clearfix">
                                    <div class="left_side_box_img buisness-profile-txext">
                                        
                                              <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('recruiter/profile/' . $recdata[0]['user_id']); ?>" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                <?php
 $imageee= $this->config->item('rec_profile_thumb_upload_path').$recdata[0]['recruiter_user_image'];
                                              if(file_exists($imageee) && $recdata[0]['recruiter_user_image'] != '') { 
                                            ?>
                       <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image']); ?>" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                   <?php
                              } else {



                                 $a = $recdata[0]['rec_firstname'];
               $acr = substr($a, 0, 1);

                $b = $recdata[0]['rec_lastname'];
               $acr1 = substr($b, 0, 1);
              ?>
              <div class="post-img-profile">
             <?php echo  ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>
              
             </div>
                           
                       <!-- <img src="<?php //echo base_url(NOIMAGE); ?>" alt="<?php //echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>">
                        --> 

                            <?php
                                   }
                             ?>
                                            </a>
                                    </div>
                                    <div class="right_left_box_design ">
                                     <span class="profile-company-name ">
                                               <a href="<?php echo site_url('recruiter/rec_profile'); ?>" title="<?php echo ucfirst(strtolower($recdata['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata['rec_lastname'])); ?>">   <?php echo ucfirst(strtolower($recdata[0]['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata[0]['rec_lastname'])); ?></a>
                                            </span>

                                                 
                                            <div class="profile-boxProfile-name">
                                                <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata1[0]['user_id']); ?>" title="<?php echo ucfirst(strtolower($recruiterdata1[0]['designation'])); ?>">
                                                    <?php
                                                    if (ucfirst(strtolower($recruiterdata1[0]['designation']))) {
                                                        echo ucfirst(strtolower($recruiterdata1[0]['designation']));
                                                    } else {
                                                        echo "Designation";
                                                    }
                                                    ?></a>
                                            </div>
                                               <ul class=" left_box_menubar">
                                               <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'profile') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Details" href="<?php echo base_url('recruiter/profile'); ?>"> Details</a>
                                                </li>                                
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/post'); ?>">Post</a>
                                                </li>
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save-candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" class="padding_less_right" href="<?php echo base_url('recruiter/save-candidate'); ?>">Saved </a>
                                                </li>
                                          
                                            </ul>
                                    </div>
                                    </div>
       </div>                             
    </div>
                               <div  class="add-post-button">

                            <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add-post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Post</a>
                        </div>
                        </div>
                     
                    </div>


<!-- <?php //echo "<pre>"; print_r($postdetail);//die();?> -->
                    <!--- search end -->

                 <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right animated fadeInUp">
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
                                         <div class = "job-contact-frnd">
                                       <!--AJAX DATA START FOR RECOMMAND CANDIDATE-->
                                         </div>
                                       <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
                                    </div>
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    

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

<!-- BEGIN FOOTER -->
<?php echo $footer; ?>
<!-- END FOOTER -->
</body>

</html>

   
    
    
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>


 <script>
          var base_url = '<?php echo base_url(); ?>';
          var skill = '<?php echo  $this->input->get('skills'); ?>';
          var place = '<?php echo  $this->input->get('searchplace'); ?>';
                                              
</script>
        <!-- FIELD VALIDATION JS END -->
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/search.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/rec_search.js'); ?>"></script>