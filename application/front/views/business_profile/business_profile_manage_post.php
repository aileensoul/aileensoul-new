<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css?ver=' . time()); ?>" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css?ver=' . time()); ?>" />
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css?ver=' . time()); ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css?ver=' . time()); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css?ver=' . time()); ?>" />
        <!--<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver=' . time()) ?>" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver=' . time()); ?>" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver=' . time()); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css'); ?>" />
        <style type="text/css">
            .two-images, .three-image, .four-image{
                height: auto !important;
            }
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <?php echo $business_common; ?>
            <div class="text-center tab-block">
                <div class="container mob-inner-page">
                    <a href="<?php echo base_url('business-profile/photos/' . $business_data[0]['business_slug']) ?>">
                        Photo
                    </a>
                    <a href="<?php echo base_url('business-profile/videos/' . $business_data[0]['business_slug']) ?>">
                        Video
                    </a>
                    <a href="<?php echo base_url('business-profile/audios/' . $business_data[0]['business_slug']) ?>">
                        Audio
                    </a>
                    <a href="<?php echo base_url('business-profile/pdf/' . $business_data[0]['business_slug']) ?>">
                        PDf
                    </a>
                </div>
            </div>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 profile-box-custom">
                            <div class="full-box-module business_data">
                                <div class="profile-boxProfileCard  module">
                                    <div class="head_details1">
                                        <span><a href="<?php echo base_url('business-profile/details/' . $business_data[0]['business_slug']); ?>"><h5><i class="fa fa-info-circle" aria-hidden="true"></i>Information</h5></a>
                                        </span>      
                                    </div>
                                    <table class="business_data_table">
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-user"></i></td>
                                            <td class="business_data_td2"><?php echo ucfirst(strtolower($business_data[0]['contact_person'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-mobile"></i></td>
                                            <td class="business_data_td2"><span><?php
                                                    if ($business_data[0]['contact_mobile'] != '0') {
                                                        echo $business_data[0]['contact_mobile'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
                                            <td class="business_data_td2"><span><?php echo $business_data[0]['contact_email']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-map-marker"></i></td>
                                            <td class="business_data_td2"><span>
                                                    <?php
                                                    if ($business_data[0]['address']) {
                                                        echo $business_data[0]['address'];
                                                        echo ",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($business_data[0]['city']) {
                                                        echo $this->db->get_where('cities', array('city_id' => $business_data[0]['city']))->row()->city_name;
                                                        echo",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($business_data[0]['country']) {
                                                        echo $this->db->get_where('countries', array('country_id' => $business_data[0]['country']))->row()->country_name;
                                                    }
                                                    ?> 
                                                </span></td>
                                        </tr>
                                        <?php
                                        if ($business_data[0]['contact_website']) {
                                            ?>
                                            <tr>
                                                <td class="business_data_td1"><i class="fa fa-globe"></i></td>
                                                <td class="business_data_td2 website"><span><a target="_blank" href="<?php echo $business_data[0]['contact_website']; ?>"> <?php echo $business_data[0]['contact_website']; ?></a></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-suitcase"></i></td>
                                            <td class="business_data_td2"><span><?php echo nl2br($this->common->make_links($business_data[0]['details'])); ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- user iamges start-->
                            <a href="<?php echo base_url('business-profile/photos/' . $business_data[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module buisness_he_module" >
                                        <div class="head_details">
                                            <h5><i class="fa fa-camera" aria-hidden="true"></i>   Photos</h5>
                                        </div>
                                        <div class="bus_photos">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- user images end-->
                            <!-- user video start-->
                            <a href="<?php echo base_url('business-profile/videos/' . $business_data[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module">
                                        <table class="business_data_table">
                                            <div class="head_details">
                                                <h5><i class="fa fa-video-camera" aria-hidden="true"></i>Video</h5>
                                            </div>
                                            <div class="bus_videos">
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- user video emd-->
                            <!-- user audio start-->
                            <a href="<?php echo base_url('business-profile/audios/' . $business_data[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module">
                                        <div class="head_details1">
                                            <h5><i class="fa fa-music" aria-hidden="true"></i>Audio</h5>
                                        </div>
                                        <table class="business_data_table">
                                            <div class="bus_audios"> 
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- user audio end-->
                            <!-- user pdf  start-->
                            <a href="<?php echo base_url('business-profile/pdf/' . $business_data[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module buisness_he_module" >
                                        <div class="head_details">
                                            <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</h5>
                                        </div>      
                                        <div class="bus_pdf"></div>
                                    </div>
                                </div>
                            </a>
                            <!-- user pdf  end-->
                        </div>
                        <div class="col-md-6 custom-right-business">
                            <?php
                            
                            if ($is_eligable_for_post == 1) {
                                ?>
                                <div class="post-editor col-md-12">
                                    <div class="main-text-area col-md-12">
                                        <div class="popup-img"> 
                                            
                                            <?php if ($business_data[0]['business_user_image']) { ?>
                                                <?php if (!file_exists($this->config->item('bus_profile_main_upload_path') . $business_data[0]['business_user_image'])) { 
                                                    ?>
                                                    <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                <?php } else {
                                                    ?>
                                                    <img  src="<?php echo  BUS_PROFILE_THUMB_UPLOAD_URL. $business_data[0]['business_user_image']; ?>"  alt="">
                                                <?php } ?>
                                            <?php } else { ?>
                                                <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                            <?php } ?>
                                        </div>
                                        <div id="myBtn1"  class="editor-content popup-text">
                                            <span>Post Your Product....</span>
                                            <div class="padding-left padding_les_left camer_h">
                                                <i class=" fa fa-camera">
                                                </i> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- The Modal -->
                            <div id="myModal3" class="modal-post">
                                <!-- Modal content -->
                                <div class="modal-content-post">
                                    <span class="close3">&times;</span>
                                    <div class="post-editor post-edit-popup" id="close">
                                        <?php echo form_open_multipart(base_url('business-profile/bussiness-profile-post-add/' . 'manage/' . $business_data[0]['user_id']), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix dashboard-upload-image-form', 'onsubmit' => "imgval(event)")); ?>
                                        <div class="main-text-area col-md-12"  >
                                            <div class="popup-img-in"> 
                                                <?php
                                                if ($business_data[0]['business_user_image'] != '') {
                                                    ?>
                                                    <?php
                                                    if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $business_data[0]['business_user_image'])) {
                                                        ?>
                                                        <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                    <?php } else {
                                                        ?>


                                                        <img  src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL . $business_data[0]['business_user_image']; ?>"  alt="">

                                                    <?php } ?>

                                                    <?php
                                                } else {
                                                    ?>
                                                    <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                                <textarea id= "test-upload_product" placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
                                                          name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;" tabindex="1"></textarea>
                                                <div class="fifty_val">                   
                                                    <input size=1 value=50 name=text_num class="text_num" disabled="disabled"> 
                                                </div>
                                                <div class="padding-left camera_in camer_h" ><i class=" fa fa-camera " ></i> </div>
                                            </div>
                                        </div>
                                        <div class="row"></div>
                                        <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                            <textarea id="test-upload_des" name="product_desc" class="description" placeholder="Enter Description" tabindex="2"></textarea>
                                            <output id="list"></output>
                                        </div>
                                        <div class="print_privew_post">
                                        </div>
                                        <div class="preview"></div>
                                        <div id="data-vid" class="large-8 columns">
                                            <!--video will be inserted here.-->
                                        </div>
                                        <h2 id="name-vid"></h2>
                                        <p id="size-vid"></p>
                                        <p id="type-vid"></p>
                                        <div class="popup-social-icon">
                                            <ul class="editor-header">
                                                <li>
                                                    <div class="col-md-12"> <div class="form-group">
                                                            <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                                        </div></div>
                                                    <label for="file-1">
                                                        <i class=" fa fa-camera upload_icon"  ><span class="upload_span_icon"> Photo </span> </i>
                                                        <i class=" fa fa-video-camera upload_icon"> <span class="upload_span_icon">Video </span> </i> 
                                                        <i class="fa fa-music upload_icon"><span class="upload_span_icon"> Audio</span> </i>
                                                        <i class=" fa fa-file-pdf-o upload_icon"><span class="upload_span_icon"> PDF </span></i>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr margin_btm">
                                            <button type="submit"  value="Submit">Post</button>    
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
                            <div class="fw">
                                <!--                                <div class='progress' id="progress_div" style="display: none">
                                                                    <div class='bar' id='bar'></div>
                                                                    <div class='percent' id='percent'>0%</div>
                                                                </div>-->

                                <div class="bs-example">
                                    <div class="progress progress-striped" id="progress_div">
                                        <div class="progress-bar" style="width: 0%;">
                                            <span class="sr-only">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="business-all-post">
                                    <!--                                    <div class="nofoundpost"> 
                                                                        </div>-->
                                </div>
                                <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver=' . time()) ?>" /></div>
                                <!-- middle section start -->
                                <!--                                <div class="nofoundpost">
                                                                </div>-->
                            </div>
                            <!-- business_profile _manage_post end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade message-box" id="likeusermodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close1" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box" id="post" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
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
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Bid-modal for this modal appear or not start -->
        <div class="modal fade message-box" id="query" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="query" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bid-modal for this modal appear or not  Popup Close -->
        <footer>
            <?php echo $footer; ?>
        </footer>
        <script src="<?php echo base_url('js/jquery.wallform.js?ver=' . time()); ?>"></script>

<!--        <script src="<?php echo base_url('js/jquery-ui.min.js?ver=' . time()); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js?ver=' . time()); ?>"></script> 
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js?ver=' . time()); ?>"></script> -->
        <script src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver=' . time()); ?>"></script>

        <script type = "text/javascript" src="<?php echo base_url('js/jquery.form.3.51.js?ver=' . time()) ?>"></script> 
        <script src="<?php echo base_url('js/mediaelement-and-player.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/plugins/sortable.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/fileinput.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/fr.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/es.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('dragdrop/themes/explorer/theme.js?ver=' . time()); ?>"></script>

        <!-- POST BOX JAVASCRIPT END --> 
        <script>
                                                    var base_url = '<?php echo base_url(); ?>';
                                                    var slug = '<?php echo $slugid; ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/dashboard.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url('js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
    </body>
</html>
