<?php
$s3 = new S3(awsAccessKey, awsSecretKey);
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dragdrop/fileinput.css?ver=' . time()); ?>" />
            <link href="<?php echo base_url('assets/dragdrop/themes/explorer/theme.css?ver=' . time()); ?>" media="all" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/artistic.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/as-videoplayer/build/mediaelementplayer.css'); ?>" />      
        <style type="text/css">
            .two-images, .three-image, .four-image{
                height: auto !important;
            }
            .mejs__overlay-button {
                background-image: url("https://www.aileensoul.com/assets/as-videoplayer/build/mejs-controls.svg");
            }
            .mejs__overlay-loading-bg-img {
                background-image: url("https://www.aileensoul.com/assets/as-videoplayer/build/mejs-controls.svg");
            }
            .mejs__button > button {
                background-image: url("https://www.aileensoul.com/assets/as-videoplayer/build/mejs-controls.svg");
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-main.css'); ?>" />
        <style type="text/css">
            .two-images, .three-image, .four-image{
                height: auto !important;
            }
        </style>
        <style>
            /***  commen css  ***/
            .p0{padding: 0;} .p5{padding: 5px;} .p10{padding: 10px;} .p15{padding: 15px;} .p20{padding: 20px;}
            .pr0{padding-right: 0;} .pr5{padding-right: 5px;} .pr10{padding-right: 10px;} .pr15{padding-right: 15px;} .pr20{padding-right: 20px;}
            .pl0{padding-left: 0;} .pl5{padding-left: 5px;} .pl10{padding-left: 10px;} .pl15{padding-left: 15px;} .pl20{padding-left: 20px;}
            .pt0{padding-top: 0;} .pt5{padding-top: 5px;} .pt10{padding-top: 10px;} .pt15{padding-top: 15px;} .pt20{padding-top: 20px;}
            .pb0{padding-bottom: 0;} .pb5{padding-bottom: 5px;} .pb10{padding-bottom: 10px;} .pb15{padding-bottom: 15px;} .pb20{padding-bottom: 20px;}
            .main-inner .btn-right .btn3:hover{text-decoration: none;}

            .fs12{font-size:12px;}

            .pb0{padding-bottom: 0;} .pb5{padding-bottom: 5px;} .pb10{padding-bottom: 10px;} .pb15{padding-bottom: 15px;} 
            .pb20{padding-bottom: 20px;}


            .fs12{font-size:12px;}
            .red{color:#ff0000;}
            .ttc{text-transform:capitalize !important;}

            /***  buttons  ***/

            .clr-c a{color:#999;}
            .main-login{
                background-color:#fff;
            }
            .login-frm .login form{padding: 16px 60px 15px;}
            /***  header  ***/
            header{
                z-index: 10;
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                background: -moz-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); /* ff3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3bb0ac), color-stop(56%, #1b8ab9), color-stop(100%, #1b8ab9)); /* safari4+,chrome */
                background: -webkit-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); /* safari5.1+,chrome10+ */
                background: -o-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); /* opera 11.10+ */
                background: -ms-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); /* ie10+ */
                background: linear-gradient(354deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); /* w3c */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3bb0ac', endColorstr='#1b8ab9',GradientType=0 ); /* ie6-9 */
                padding:15px 0;
            }
            header .logo a{
                color:#fff;
            }
            header .logo a:focus, header .logo a:hover {
                text-decoration:none;
            }
            header h2{
                margin:0; 
                font-weight:bold;
            }
            .header-login .input{       
                width:28%;      
                float:left;     
                margin-right:20px;      
            }
            .header-login input{
                background:transparent;
                border:none;
                border-bottom:1px solid #fff;
                border-radius:0px;
                box-shadow:none;
                font-size:14px;
                color:#fff;
                height:32px;

            }
            .header-login input:focus{
                box-shadow:none;
            }
            .header-login .btn1{
                font-size:15px;
                padding-top:8px;
                padding-bottom:8px;
                line-height:1;
                background:none;
                color:#fff;
                border:1px solid #fff;
            }
            .header-login .btn1:hover{
                background:#fff;
                color:#1b8ab9;
                border:1px solid #fff;
            }
            .header-login input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
                color: #ddd;
            }
            .header-login input::-moz-placeholder { /* Firefox 19+ */
                color: #ddd;
            }
            .header-login input:-ms-input-placeholder { /* IE 10+ */
                color: #ddd;
            }
            .header-login input:-moz-placeholder { /* Firefox 18- */
                color: #ddd;
            }
            .header-login .f-pass{
                color:#fff;
                padding-left:10px;
            } 
            .header-login .f-pass:hover{
                text-decoration:underline;
            }
            a:hover{
                /*text-decoration:none;*/
            }
            /*.pt-100{padding-top: 100px;}*/
            /***  middle part  ***/
            /*.middle-main{height:90vh;}*/

            .main-login .middle-main{
                padding:100px 0;
                background:url('../img/bg.png') no-repeat;
                background-size:100%;

            }
            .main-login .middle-main .container{height:100%; position:relative;}
            .top-middle{
                padding:45px 0 10px 50px;
                min-height:190px;
            }
            .top-middle h3{
                font-size:30px; 
                color:#505050; 
                line-height:1.5;
                margin:0;
            }
            .top-middle .output {
                display:none;
            }
            .top-middle .active:after {
                content: '_';
            }
            /***  login form css  ***/


            /*onclick*/
            .form-group textarea:focus {
                border-bottom: 1px solid #1b8ab9 !important;
                color: #1b8ab9!important;
            }
            /* label focus color */
            .form-group textarea[type=text]:focus + label {
                color: #1b8ab9!important;
            }
            /* label underline focus color */
            .form-group textarea[type=text]:focus {
                border-bottom: 1px solid #1b8ab9;
                color: #1b8ab9!important;

            }
            .form-group input:focus {
                border-bottom: 1px solid #1b8ab9 !important;
                color: #1b8ab9!important;
            }
            /* label focus color */
            .form-group input[type=text]:focus + label {
                color: #1b8ab9!important;
            }
            /* label underline focus color */
            .form-group input[type=text]:focus {
                border-bottom: 1px solid #1b8ab9;
                color: #1b8ab9!important;

            }
            .form-group input::-webkit-input-placeholder {
                color: #999;
            }
            textarea:focus::-webkit-input-placeholder
            {
                color:    #1b8ab9;
            }

            .form-group input:focus::-webkit-input-placeholder {
                color: #1b8ab9;
            }
            /* Firefox < 19 */

            .form-group input:focus:-moz-placeholder {
                color: #1b8ab9;
            }
            /* Firefox > 19 */

            .form-group input:focus::-moz-placeholder {
                color: #1b8ab9;
            }

            /* Internet Explorer 10 */

            .form-group input:focus:-ms-textarea-placeholder {
                color: #1b8ab9;
            }
            /*second*/
            .login{width:100%;}

        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push no-login">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 col-xs-4 fw-479">
                        <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-8 fw-479">
                        <div class="btn-right pull-right">
                            <a href="javascript:void(0);" onclick="login_profile();" class="btn2">Login</a>
                            <a href="javascript:void(0);" onclick="register_profile();" class="btn3">Creat an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <?php echo $artistic_common_profile; ?>
            <div class="text-center tab-block">
                <div class="container mob-inner-page">
                    <a href="javascript:void(0);" onclick="login_profile();">
                        Photo
                    </a>
                    <a href="javascript:void(0);" onclick="login_profile();">
                        Video
                    </a>
                    <a href="javascript:void(0);" onclick="login_profile();">
                        Audio
                    </a>
                    <a href="javascript:void(0);" onclick="login_profile();">
                        PDf
                    </a>
                </div>
            </div>
        <div class="user-midd-section art-inner">
            <div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-7 col-sm-12 col-xs-12 mob-plr0">
        <div class="common-form">
            <div class="job-saved-box">
                <h3>Details</h3>
                <div class=" fr rec-edit-pro">
<?php
$userid = $this->session->userdata('aileenuser');

if ($artisticdata[0]['user_id'] === $userid) {
    ?>
    <ul>
    </ul>
<?php } ?>
                </div> 
                <div class="contact-frnd-post">
                    <div class="job-contact-frnd ">
                        <div class="profile-job-post-detail clearfix">
                            <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
            <p class="details_all_tital "> Basic Information</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                        <li> <b>First Name</b> <span> <?php echo $artisticdata[0]['art_name']; ?> </span>
                                        </li>
                                        <li> <b>Last Name</b> <span> <?php echo $artisticdata[0]['art_lastname']; ?> </span>
                                        </li>
                                        <li> <b>Email </b><span> <?php echo $artisticdata[0]['art_email']; ?> </span>
                                        </li>
                                         <?php if($artisticdata[0]['art_phnno']){ ?>
                                            <li><b> Phone Number</b> <span><?php echo $artisticdata[0]['art_phnno']; ?></span> </li>
                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Phone Number</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
                                    </ul>
                                </div>
                                <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details">
                                            <ul>
                                                <li>
                    <p class="details_all_tital ">Contact Address</p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                        <ul class="clearfix">
                                            <li> <b> Country</b> <span> <?php echo $this->db->select('country_name')->get_where('countries', array('country_id' => $artisticdata[0]['art_country']))->row()->country_name; ?> </span>
                                            </li>
                                            <li> <b>State </b><span> <?php echo
$this->db->select('state_name')->get_where('states', array('state_id' => $artisticdata[0]['art_state']))->row()->state_name;
?> </span>
<?php if($artisticdata[0]['art_city']){?>
                                        </li>
                                            <li><b> City</b> <span><?php echo
$this->db->select('city_name')->get_where('cities', array('city_id' => $artisticdata[0]['art_city']))->row()->city_name;
?></span> </li>
<?php }  else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b> City</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
    <?php if($artisticdata[0]['art_pincode']){ ?>
                                            <li> <b>Pincode </b><span> <?php echo $artisticdata[0]['art_pincode']; ?></span>
                                            </li>
                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Pincode</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
        </ul>
    </div>
                                </div>
                                <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details">
                                            <ul>
                                                <li>
             <p class="details_all_tital "> Art Information</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                        <ul class="clearfix">
                                            <li> <b>Art category </b> <span>
<?php
            $art_othercategory = $this->db->select('other_category')->get_where('art_other_category', array('other_category_id' => $artisticdata[0]['other_skill']))->row()->other_category;

                                    $category = $artisticdata[0]['art_skill'];
                                    $category = explode(',' , $category);

                                    foreach ($category as $catkey => $catval) {
                                       $art_category = $this->db->select('art_category')->get_where('art_category', array('category_id' => $catval))->row()->art_category;
                                       $categorylist[] = ucwords($art_category);
                                     } 

                                    $listfinal1 = array_diff($categorylist, array('Other'));
                                    $listFinal = implode(',', $listfinal1);
                                       
                                    if(!in_array(26, $category)){
                                     echo $listFinal;
                                   }else if($artisticdata[0]['art_skill'] && $artisticdata[0]['other_skill']){

                                    $trimdata = $listFinal .','.ucwords($art_othercategory);
                                    echo trim($trimdata, ',');
                                   }
                                   else{
                                     echo ucwords($art_othercategory);  
                                  }
 
?>     
</span>
 </li>
                                            <?php if($artisticdata[0]['art_yourart']){ ?>

                                            <li> <b> Speciality in Art </b> <span> <?php echo $artisticdata[0]['art_yourart']; ?> </span>
                                            </li>
                                    <?php }else{
                                      if($artisticdata[0]['user_id'] == $userid){ 
                                      ?>
                                      <li> <b> Speciality in Art </b> <span> <?php echo PROFILENA; ?> </span>
                                            </li>

                                    <?php } else{ ?>

                                    <?php } }?>
                                    
                                <?php if($artisticdata[0]['art_desc_art']){ ?>
                                          <li><b> Description of your art</b> <span><?php echo $this->common->make_links($artisticdata[0]['art_desc_art']); ?></span> </li>
                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Description of your art</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
                                        <?php if($artisticdata[0]['art_inspire']){?>
                                         <li><b> How You are Inspire</b> <span><?php echo $artisticdata[0]['art_inspire']; ?></span> </li>
                                         <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>How You are Inspire</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>  
</ul>
                                    </div>
                                </div> 
                            </div> 
                            <?php if($artisticdata[0]['user_id'] == $userid){?>
                            <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
                <p class="details_all_tital ">Portfolio</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                      <li><b>Attachment</b> 
                                        <span>
                                         <?php
if ($artisticdata[0]['art_bestofmine']) {
    ?>
 <div class="buisness-profile-pic pdf">
    <?php
    $allowespdf = array('pdf'); 
    $filename = $artisticdata[0]['art_bestofmine'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
   if (in_array($ext, $allowespdf)) { ?>
<?php if (!file_exists($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine'])) {
   echo "Pdf not available."
    ?>
<?php }else{  ?>
        <a href="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>"><i style="color: red; font-size:22px;" class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
<?php }?>
         <?php
         } ?>  
         </div>
<?php } else {
    echo PROFILENA;
    } ?>
    </span>
    </li>
<li> <b>Details of Portfolio </b> 
<span> 
<?php if($artisticdata[0]['art_portfolio']){?>
 <?php echo $this->common->make_links($artisticdata[0]['art_portfolio']); ?>
<?php } else{
echo PROFILENA;
} ?>
</span></li>
</ul></div>
</div>
<?php }else{
   if(trim($artisticdata[0]['art_bestofmine']) == '' && trim($artisticdata[0]['art_portfolio']) == '') {}else{ ?>
    <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
                <p class="details_all_tital ">Portfolio</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                    <?php if ($artisticdata[0]['art_bestofmine']) {
    ?>  
 <li><b>Attachment</b>                                          
<span>
<div class="buisness-profile-pic">
    <?php 
    $allowespdf = array('pdf');
    $filename = $artisticdata[0]['art_bestofmine'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (in_array($ext, $allowespdf)) { ?>
<?php if (!file_exists($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine'])) {
   echo "Pdf not available."
    ?>
<?php }else{ ?>
        <a href="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>">PDF</a>
<?php }?>
         <?php
         } ?></div></span></li>
<?php }?>          
 <li> <b>Details of Portfolio </b> 
<span> 
    <?php if($artisticdata[0]['art_portfolio']){?>
    <?php echo $this->common->make_links($artisticdata[0]['art_portfolio']); ?>
    <?php }else{
       echo PROFILENA;
                    } ?>
</span></li>
</ul></div>
</div>
<?php } }?></div> 
</div></div></div>
</div></div></div>
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
                               <div class="col-md-5">

                               <!--  <div class="user_profile"></div> -->

                               <div class="fw" id="loaderfollow" style="text-align:center; display: none;"><img src="<?php echo base_url('assets/images/loader.gif?ver='.time()) ?>" /></div>

                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one">
                                    </div>
                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="width:350px; display: none"></div>
                                    </div>
                                <input type="submit"  class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                                </form>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
<!-- Model Popup Close -->
<footer>
<?php echo $footer; ?>
</footer>
<!-- script for skill textbox automatic start (option 2)-->
<script  src="<?php echo base_url('assets/js/croppie.js?ver='.time()); ?>"></script>
<script  src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>

<script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()); ?>"></script>
<script>
var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
var slug = '<?php echo $artid; ?>';
</script>
<script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/artistic_common.js?ver='.time()); ?>"></script>
<script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/details.js?ver='.time()); ?>"></script>
 </body>
</html>
