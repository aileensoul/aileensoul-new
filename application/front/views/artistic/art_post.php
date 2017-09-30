<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<?php echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css?ver='.time()); ?>">
<link href="<?php echo base_url('dragdrop/themes/explorer/theme.css?ver='.time()); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/artistic/artistic.css?ver='.time()); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css?ver='.time()) ;?>" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      
   </head>
   <body>
   <?php echo $header; ?>
   <?php echo $art_header2_border; ?>
      <div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
      <div class="container art_container">
      <div class="">
      <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt" >
      <div class="left_fixed"> 
         <?php ?>
<?php echo $left_artistic; ?>
          <div class="full-box-module_follow fixed_right_display_none">
          
            <div class="common-form">
               <h3 class="user_list_head">User List</h3>
               <div class="seeall">
                  <a href="<?php //echo base_url('artistic/userlist'); ?>">All User</a>
               </div>
               <div class="profile-boxProfileCard_follow_mobile  module">     
               </div>
             
            </div>
         </div>

         <div class="custom_footer_left fw">
          <div class="fl">
             <ul>
             <li><a href="<?php echo base_url('about-us'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> About Us </a></li>
              
              <li><a href="<?php echo base_url('contact-us'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Contact Us</a></li>
              
              <li><a href="<?php echo base_url('blog'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Blogs</a></li>
              
              <li><a href="<?php echo base_url('terms-and-condition'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Terms &amp; Condition </a></li>
              
              <li><a href="<?php echo base_url('privacy-policy'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Privacy Policy</a></li>
              
              <li><a href="<?php echo base_url('feedback'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Send Us Feedback</a></li>
            </ul>
          </div>
        <div>
          
        </div>

        </div>
      </div>
     </div> 
      <div class=" custom-right-art mian_middle_post_box animated fadeInUp">
		     
		<div class="right_side_posrt fl"> 
         <div class="post-editor col-md-12">
            <div class="main-text-area col-md-12">
               <div class="popup-img">
                <a href="<?php echo base_url('artistic/dashboard/' . $artisticdata[0]['slug']) ?>">
                  <?php
                     $userimage = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     $userimageposted = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     ?>
                     <?php if($artisticdata[0]['art_user_image']){?>
                      <?php 
if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class= "post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>
<img  src="<?php echo ART_PROFILE_THUMB_UPLOAD_URL . $artisticdata[0]['art_user_image']; ?>"  alt="">
                  <?php }?>
                  <?php }else{
                    $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                    ?>
                          <div class= "post-img-div">
                            <?php echo  ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)); ?>
                            </div>
                  <?php }?>
                </a>
               </div>
               <div id="myBtn"  class="editor-content popup-text">
                  <span > Post Your Art....</span> 
                  <div class="padding-left padding_les_left camer_h">
                     <i class=" fa fa-camera" >
                     </i> 
                  </div>
               </div>
            </div>
         </div>
          <div class="bs-example">
                                <div class="progress progress-striped" id="progress_div">
                                    <div class="progress-bar" style="width: 0%;">
                                        <span class="sr-only">0%</span>
                                    </div>
                                </div>
         </div>
                             <div class="art-all-post">
                            
                             </div>
                              <div class="nofoundpost"> 
                             </div>

                             <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
       </div>
      
		

    </div> 
	<div class="right_middle_side_posrt animated fadeInRightBig fixed_right_display" id="hideuserlist" >
     
         <div class="full-box-module_follow" style="margin-top: 0px;">
            <!-- follower list start  -->  
            <div class="common-form">
               <h3 class="user_list_head">User List</h3>
               <div class="seeall">
                  <a href="<?php echo base_url('artistic/userlist'); ?>">All User</a>
               </div>
               <div class="profile-boxProfileCard_follow  module">     
               </div>
               <!-- follower list end  -->
            </div>
         </div>
     
      </div>
  <!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal-limit" role="dialog">
                        <div class="modal-dialog modal-lm deactive">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal" id="common-limit">&times;</button>       
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->
      <!-- Bid-modal  -->
      <div class="modal fade message-box biderror" id="bidmodal" role="dialog"  >
         <div class="modal-dialog modal-lm" >
            <div class="modal-content">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
               <div class="modal-body">
                  <span class="mes"></span>
               </div>
            </div>
         </div>
      </div>
      <!-- Model Popup Close -->
      <!-- Bid-modal-2  -->
      <div class="modal fade message-box" id="likeusermodal" role="dialog" >
         <div class="modal-dialog modal-lm">
            <div class="modal-content">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
               <div class="modal-body">
                  <span class="mes">
                  </span>
               </div>
            </div>
         </div>
      </div>
      <!-- Model Popup Close -->
       <!-- Bid-modal for this modal appear or not start -->
            <div class="modal fade message-box" id="post" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="post" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade message-box" id="postedit" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="postedit" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bid-modal for this modal appear or not  Popup Close -->
    <!-- The Modal -->
         <div id="myModal" class="modal-post">
            <!-- Modal content -->
            <div class="modal-content-post">
               <span class="close1">&times;</span>
                  <div class="post-editor col-md-12 post-edit-popup" id="close">
                  <?php echo form_open_multipart(base_url('artistic/art_post_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "return imgval(event)")); ?>
                  <div class="main-text-area " >
                     <div class="popup-img-in "> 
                     <?php if($artisticdata[0]['art_user_image']){?>
                   <?php 
if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>
                     <img  src="<?php echo ART_PROFILE_THUMB_UPLOAD_URL . $artisticdata[0]['art_user_image']; ?>"  alt="">
                     <?php }?>
                     <?php }else{?>
                                  <?php 
                         $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);?>
                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)); ?>
                            </div>
                     <?php }?>
                     </div>
                     <div id="myBtn"  class="editor-content col-md-10 popup-text" >
                        <textarea id= "test-upload_product" placeholder="Post Your Art...."   onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); onKeyup=check_length(this.form); onblur="check_length(this.form)" name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;"></textarea>
                        <div class="fifty_val">                       
                           <input size=1 class="text_num" tabindex="-500" value=50 name=text_num disabled="disabled"> 
                        </div>
                      <div class="padding-left padding_les_left camer_h">
                        <i class=" fa fa-camera" >
                        </i> 
                     </div>
                       </div>
                  </div>
                  <div class="row"></div>
                  <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                     <textarea id="test-upload_des" name="product_desc" class="description" placeholder="Enter Description"></textarea>
                     <output id="list"></output>
                  </div>
                  <div class="popup-social-icon">
                     <ul class="editor-header">
                        <li>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="visibility:hidden;">
                              </div>
                           </div>
                           <label for="file-1">
                           <i class=" fa fa-camera upload_icon"  ><span class="upload_span_icon"> Photo</span></i>
                           <i class=" fa fa-video-camera upload_icon"  ><span class="upload_span_icon"> Video </span></i>
                           <i class="fa fa-music upload_icon "  ><span class="upload_span_icon"> Audio </span></i>
                           <i class=" fa fa-file-pdf-o upload_icon"  > <span class="upload_span_icon">PDF </span></i>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <div class="fr">
                     <button type="submit"  value="Submit">Post</button>    
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
<footer>
<?php echo $footer; ?>
</footer>
<script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/jquery.form.3.51.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/mediaelement-and-player.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js?ver='.time()); ?>"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
var complex = <?php echo json_encode($selectdata); ?>;
var textarea = document.getElementById("textarea");
 var no_artistic_post_html = '<?php echo $no_artistic_post_html ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/home.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>


</body>
</html>
