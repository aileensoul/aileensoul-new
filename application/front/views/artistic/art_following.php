<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<?php echo $head; ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/artistic/artistic.css'); ?>">
</head>
<body   class="page-container-bg-solid page-boxed">
<?php echo $header; ?>
<?php echo $art_header2_border; ?>
    <section class="custom-row">
    <?php echo $artistic_common; ?>
<div class="user-midd-section art-inner">
    <div class="container">
<div class="col-md-3">  
</div>
                      <div class="col-md-7 col-sm-12 follow_mid">
                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div> 
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Following</h3>
                                 <div class="contact-frnd-post">
                                 
                                        <div class="col-md-1">
                                        </div>
                                    </div>  
                                     <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>                
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
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
 <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="7">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image" />
     </div>                   <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
</form>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->
<footer>
 <?php echo $footer;  ?>
  </footer>
 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
 <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script>
var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;
var data1= <?php echo json_encode($de); ?>;
var slug_id = '<?php echo $artisticdata[0]['user_id']; ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/following.js'); ?>"></script>
 </body>
</html>