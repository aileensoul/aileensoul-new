<html>
<head>
<title><?php echo $title; ?></title>
<?php echo $head; ?>
 <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()); ?>" />
<link href="<?php echo base_url('css/fileinput.css?ver='.time());?>" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('js/themes/explorer/theme.css?ver='.time()); ?>" media="all" rel="stylesheet" type="text/css"/>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/artistic/artistic.css?ver='.time()); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css?ver='.time()) ;?>" />
<body>
<?php echo $header; ?>
 <?php echo $art_header2_border; ?>
<div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
   <div class="container">
      <div class="row">
        <div class="col-md-4 fixed_art profile-box profile-box-custom fixed_left_side animated fadeInDownBig">
            <div class="">
                     <?php echo $left_artistic; ?> 
            </div>
         </div>
         <div class="col-md-7 col-sm-12 col-md-push-4 custom-right-business animated fadeInUp">
            <div class="common-form">
               <div class="job-saved-box">
                  <h3 style="background-color: #fff; text-align: center; color: #003; border-bottom: 1px solid #d9d9d9;">
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
                  <!--        <div class="contact-frnd-post"> -->
                  <div class="job-contact-frnd ">

                 <!-- AJAX DATA... -->
                 <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

      <!-- bid model start -->

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

<div class="modal fade message-box" id="likeusermodal" role="dialog">
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

<footer>
<?php echo $footer; ?>
        </footer>


<script src="<?php echo base_url('js/jquery-2.0.3.min.js?ver='.time()); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/plugins/sortable.js?ver='.time()); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/fileinput.js?ver='.time()); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/themes/explorer/theme.js?ver='.time()); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="<?php echo base_url('js/jquery.highlite.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/fb_login.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver='.time()); ?>"></script>
 <script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';      
var data = <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
var keyword = '<?php echo $keyword; ?>';
var keyword1 = '<?php echo $keyword1; ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/recommen_candidate.js?ver='.time()); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>
</body>
</html>