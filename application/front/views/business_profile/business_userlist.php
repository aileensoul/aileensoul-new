<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/business.css?ver=' . time()); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profiles/common/mobile.css'); ?>" />  
		</head>
    <body class="page-container-bg-solid page-boxed pushmenu-push user-list">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <div class="container" id="paddingtop_fixed">
            </div>
            <div class="user-midd-section bui_art_left_box">
                <div class="container">
                    <div class="">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt" >
                            <div class="left_fixed">
                            <?php echo $business_left ?>
                            </div>
                        </div>
                        
						<div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="">  
                                <div class="right_side_posrt fl"> 
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>User list</h3>
                                    <div class="contact-frnd-post">
                                        <!-- AJAX DATA... -->
                                    </div>
                                    <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
						<div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 
					
						<div class="fw text-center">
                        <script type="text/javascript" language="javascript">
						  var aax_size='300x250';
						  var aax_pubname = 'aileensoul-21';
						  var aax_src='302';
						</script>
						<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
						</div>
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
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="6">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- script for skill textbox automatic end (option 2)-->
<!--        <script src="<?php // echo base_url('assets/js/jquery-ui.min.js?ver='.time());  ?>"></script>
        <script src="<?php // echo base_url('assets/js/demo/jquery-1.9.1.js?ver='.time());  ?>"></script>
        <script src="<?php // echo base_url('assets/js/demo/jquery-ui-1.9.1.js?ver='.time());  ?>"></script>-->
        <script src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <!-- script for business autofill -->
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/userlist.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
    </body>
</html>