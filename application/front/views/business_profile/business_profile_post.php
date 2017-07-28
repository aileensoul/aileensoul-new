<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui-1-12-1.css'); ?>"> <!-- DOWNLOAD FROM : href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" -->
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <!-- START HEADER -->
        <?php echo $header; ?>
        <!-- END HEADER -->
        <?php echo $business_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4  animated fadeInLeftBig profile-box profile-box-custom">
                            <div class="">
                                <?php echo $business_left; ?>
                                <div class="full-box-module_follow">
                                    <!-- follower list start  -->  
                                    <div class="common-form">
                                        <h3 class="user_list_head">User List
                                        </h3>
                                        <div class="seeall">
                                            <a href="<?php echo base_url('business-profile/userlist/' . $businessdata[0]['business_slug']); ?>">All User
                                            </a>
                                        </div>
                                    </div>
                                    <!-- GET USER FOLLOE SUGESSION LIST START [AJAX DATA DISPLAY UNDER profile-boxProfileCard_follow CLASS]-->
                                    <div class="profile-boxProfileCard_follow  module">

                                    </div>
                                    <!-- GET USER FOLLOE SUGESSION LIST START -->
                                    <!-- follower list end  -->
                                </div>
                            </div>
                            <br>
                            <div id="result"></div>   
                        </div>
                        <!-- popup start -->
                        <!-- Trigger/Open The Modal -->
                        <!-- <div id="myBtn">Open Modal</div>-->
                        <!-- The Modal -->
                        <div id="myModal" class="modal-post">
                            <!-- Modal content -->
                            <div class="modal-content-post">
                                <span class="close1">&times;
                                </span>
                                <div class="post-editor col-md-12 post-edit-popup" id="close">
                                    <?php // echo form_open_multipart(base_url('business_profile/business_profile_addpost_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix', 'onsubmit' => "return imgval(event)")); ?>
<?php echo form_open_multipart(base_url('business-profile/bussiness-profile-post-add'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "return imgval(event)")); ?>
                                    <div class="main-text-area col-md-12" >
                                        <div class="popup-img-in"> 
                                            <?php
                                            if ($businessdata[0]['business_user_image'] != '') {
                                                ?>
                                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                                <?php
                                            } else {
                                                ?>
                                                <?php 
                                          $a = $businessdata[0]['company_name'];
                                          $acr = substr($a, 0, 1);?>
                                            <div class="post-img-div">
                                            <?php echo  ucwords($acr)?>
                                            </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                            <textarea id="test-upload-product" placeholder="<?php echo $this->lang->line("post_your_product"); ?>"  onKeyPress=check_length(this.form); onKeyUp=check_length(this.form); onKeyDown=check_length(this.form); onblur=check_length(this.form);  name=my_text rows=4 cols=30 class="post_product_name" style=" position: relative;" tabindex="1"></textarea>
                                            <div class="fifty_val">                       
                                                <input size=1 value=50 name=text_num class="text_num"  readonly> 
                                            </div>
                                            <div class="camera_in padding-left padding_les_left camer_h">
                                                <i class=" fa fa-camera" >
                                                </i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                        <textarea id="test-upload-des" name="product_desc" class="description" placeholder="Enter Description" tabindex="2"></textarea>
                                    </div>
                                    <div class="print_privew_post">
                                    </div>
                                    <div class="preview">
                                    </div>
                                    <div id="data-vid" class="large-8 columns">
                                    </div>
                                    <h2 id="name-vid">
                                    </h2>
                                    <p id="size-vid">
                                    </p>
                                    <p id="type-vid">
                                    </p>
                                    <div class="popup-social-icon">
                                        <ul class="editor-header">
                                            <li>
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                                    </div>
                                                </div>
                                                <label for="file-1">
                                                    <i class=" fa fa-camera upload_icon" > Photo</i>
                                                    <i class=" fa fa-video-camera upload_icon" > Video </i> 
                                                    <i class="fa fa-music upload_icon" > Audio </i>
                                                    <i class=" fa fa-file-pdf-o upload_icon"   > PDF </i>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr margin_btm">
                                        <button type="submit"  value="Submit">Post
                                        </button>    
                                    </div>
<?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- popup end -->  
                        <?php
                        if ($this->session->flashdata('error')) {
                            echo $this->session->flashdata('error');
                        }
                        ?>

                        <div class="col-md-7 col-sm-12 col-md-push-4 custom-right-business  animated fadeInUp">
                            <div class="post-editor col-md-12">
                                <div class="main-text-area col-md-12">
                                    <div class="popup-img"> 
                                        <?php if ($businessdata[0]['business_user_image']) { ?>
                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                        <?php } else { ?>
                                            <?php 
                                          $a = $businessdata[0]['company_name'];
                                          $acr = substr($a, 0, 1);?>
                                            <div class="post-img-div">
                                            <?php echo  ucwords($acr)?>
                                            </div>
<?php } ?>
                                    </div>
                                    <div id="myBtn"  class="editor-content popup-text">
                                        <span> <?php echo $this->lang->line("post_your_product"); ?></span> 
                                        <div class="padding-left padding_les_left camer_h">
                                            <i class="fa fa-camera"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- body content start-->
                            <!-- ALL POST DATA DISPLAY IN TO business-all-post CLASS AFTER CALL AJAX -->
                            <!--                      video tag   khytai chndge 8-7    <div>
                            <video width="100%" height="350" controls>
                         <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                        <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/ogg">
                             Your browser does not support the video tag.
                                 </video>
                        </div>-->
                            <div class='progress' id="progress_div">
                                <div class='bar' id='bar'></div>
                                <div class='percent' id='percent'>0%</div>
                            </div>
                            <div class="business-all-post">
                                <div class="nofoundpost"> 
                                </div>
                                <!-- no post found div end -->
                            </div>
                        </div>
                    </div>
                </div>

        </section>
        <footer>
<?php echo $footer; ?>
        </footer>
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;
                    </button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->

        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="likeusermodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close1" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->


        <!-- Bid-modal for this modal appear or not start -->
        <div class="modal fade message-box" id="post" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bid-modal for this modal appear or not  Popup Close -->

        <div class="modal fade message-box" id="postedit" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script> 
        <!-- POST BOX JAVASCRIPT START --> 
        <script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
        <!-- POST BOX JAVASCRIPT END --> 
        <script>
                                                var base_url = '<?php echo base_url(); ?>';
                                                var data = <?php echo json_encode($demo); ?>;
                                                var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/home.js'); ?>"></script>
    </body>
</html>
