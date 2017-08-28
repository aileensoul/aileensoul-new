<!DOCTYPE html>
<html>
<head>
<title><?php echo "Home - Aileensoul.com"; ?></title>
<?php echo $head; ?>
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
<link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css'); ?>">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
   <body>
   <?php echo $header; ?>
   <?php echo $art_header2_border; ?>
      <div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
      <div class="container">
      <div class="row">
      <div class="profile-art-box profile-box-custom col-md-4 fixed_left_side animated fadeInLeftBig" >
         <?php ?>
<?php echo $left_artistic; ?>
          <!-- <div class="full-box-module_follow fixed_right_display_none">
          
            <div class="common-form">
               <h3 class="user_list_head">User List</h3>
               <div class="seeall">
                  <a href="<?php //echo base_url('artistic/userlist'); ?>">All User</a>
               </div>
               <div class="profile-boxProfileCard_follow  module">     
               </div>
             
            </div>
         </div> -->
         <div class="custom_footer_left fw">
          <div class="fl">
            <ul>
              <li><a href="<?php echo base_url('about_us'); ?>"> About Us </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="<?php echo base_url('blog'); ?>">Blogs</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Terms &amp; Condition </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Privacy Policy</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a></li>
            </ul>
          </div>
        <div>
          
        </div>

        </div>
      </div>
      <div class="col-md-7 col-sm-12 col-md-push-4 fixed_middle_side  custom-right-art animated fadeInUp">
         <div class="post-editor col-md-12">
            <div class="main-text-area col-md-12">
               <div class="popup-img">
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
<img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">
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
                             <div class="nofoundpost"> 
                             </div>
                             </div>

                             <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url() ?>images/loader.gif" /></div>
      </div>
      <div class="col-md-3 fixed_right_side animated fadeInRightBig fixed_right_display">
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
                     <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">
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
                           <input size=1 class="text_num" tabindex="-500" value=50 name=text_num readonly> 
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
                           <i class=" fa fa-camera upload_icon"  > Photo</i>
                           <i class=" fa fa-video-camera upload_icon"  > Video </i>
                           <i class="fa fa-music upload_icon "  > Audio </i>
                           <i class=" fa fa-file-pdf-o upload_icon"  > PDF </i>
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
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script>
<script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
var complex = <?php echo json_encode($selectdata); ?>;
var textarea = document.getElementById("textarea");
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/home.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js'); ?>"></script>


</body>
</html>
