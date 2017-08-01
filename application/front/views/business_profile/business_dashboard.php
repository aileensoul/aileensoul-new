<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>" />
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>" />
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
            .login-frm{width:480px !important;}
            /***  buttons  ***/
            .btn1{
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3bb0ac), color-stop(56%, #1b8ab9), color-stop(100%, #1b8ab9)); 
                background: -webkit-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); 
                background: -o-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%);
                background: -ms-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); 
                background: linear-gradient(354deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%); 
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3bb0ac', endColorstr='#1b8ab9',GradientType=0 ); 
                font-size:16px;
                color:#fff;
                padding:5px 25px;
                text-align:center;
                border-radius: 4px;
                border:2px solid #1b8ab9;

            }
            .btn1:hover{
                border:2px solid #1b8ab9;
                color:#fff;
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #1b8ab9), color-stop(56%, #3bb0ac), color-stop(100%, #3bb0ac)); 
                background: -webkit-linear-gradient(96deg, #3bb0ac 0%, #3bb0ac 44%, #1b8ab9 100%); 
                background: -o-linear-gradient(96deg, #3bb0ac 0%, #3bb0ac 44%, #1b8ab9 100%);
                background: -ms-linear-gradient(96deg, #3bb0ac 0%, #3bb0ac 44%, #1b8ab9 100%); 
                background: linear-gradient(354deg, #3bb0ac 0%, #1b8ab9 44%, #1b8ab9 100%); 
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1b8ab9', endColorstr='#3bb0ac',GradientType=0 ); 

            }

            .btn1:focus{
                opacity:0.6;
            }

            .btn2{
                background:#fff;
                font-size:16px;
                color:#1b8ab9;
                padding:8px 25px;
                text-align:center;
                border-radius:4px;
                display:inline-block;
                border:1px solid #fff;
                font-family: 'robotolight';
                line-height:1;
            }
            .btn2:hover{
                border:1px solid #fff;
                background:transparent;
                color:#fff;
                text-decoration:none;
            }
            .btn3{
                font-size:16px;
                color:#fff;
                padding:8px 25px;
                text-align:center;
                border-radius:4px;
                display:inline-block;
                border:1px solid #fff;
                font-family: 'robotolight';
                line-height:1;
            }
            .btn3:hover {
                background: #fff;
                color: #1b83b9;
            }
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
            .login{
                /*background:#fff;*/
                width:100%;
                margin:0 auto;
                border:1px solid #c7c7c7;
                border-radius:5px;
                -webkit-box-shadow: 0px 0px 10px -1px rgba(217,217,217,1);
                -moz-box-shadow: 0px 0px 10px -1px rgba(217,217,217,1);
                box-shadow: 0px 0px 10px -1px rgba(217,217,217,1);
                height: auto !important;
            } 
            .inner-form .login {
                background: #fff !important;
                width: 80%;
                margin: 0 auto;
                border: 1px solid #c7c7c7;
            }
            .login h4{
                color:#1b8ab9;
                background: -webkit-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                padding:15px; 
                text-align:center;
                margin:0;
                color:#1b8ab9;
                border-bottom:1px solid #c7c7c7;
                font-size:28px;
                font-family: 'robotoregular';
            }
            .login form{
                padding:16px 30px 15px;
            }
            .login .form-group input, .login .form-group select, .login .form-group textarea {
                border:none;
                border-bottom:1px solid #d9d9d9;
                border-radius:0px;
                box-shadow:none;
                font-size:15px;
                color:#848484;
                height:35px;
                padding-left: 6px;
            }
            .login .form-group select{
                width:65px;
                margin-right:15px;
                -webkit-appearance: none;
                -moz-appearance:    none;
                appearance:         none;
                position:relative;
                background:url('../img/down-arrow.png') no-repeat;
                background-position:right;   

            }
            .login .form-group select:focus{
                width:65px;
                margin-right:15px;
                -webkit-appearance: none;
                -moz-appearance:    none;
                appearance:         none;
                position:relative;
                background:url('../img/down-arrow-hover.png') no-repeat;
                background-position:right;  
            }

            .login .form-group select.year{
                width:70px;
            }
            .login .form-group select.gender{
                width:100px;
            }
            .form-text{
                font-size:12px;
                color:#3b3a3a;
                padding-top:10px;
                padding-bottom:10px;
            }
            .form-text a{
                color:#b5b5b5;
            }
            .login .btn1{
                display:inline-block;
                width:100%;
            }


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

        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3">
                        <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                    </div>
                    <div class="col-md-8 col-sm-9">
                        <div class="btn-right pull-right">
                            <a href="javascript:void(0);" onclick="login_profile();" class="btn2">Login</a>
                            <a href="javascript:void(0);" onclick="register_profile();" class="btn3">Creat an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <?php echo $business_common_profile; ?>
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
                                        <span><a href="javascript:void(0);" onclick="login_profile();"><h5><i class="fa fa-info-circle" aria-hidden="true"></i>Information</h5></a>
                                        </span>      
                                    </div>
                                    <table class="business_data_table">
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-user"></i></td>
                                            <td class="business_data_td2"><?php echo ucfirst(strtolower($businessdata1[0]['contact_person'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-mobile"></i></td>
                                            <td class="business_data_td2"><span><?php
                                                    if ($businessdata1[0]['contact_mobile'] != '0') {
                                                        echo $businessdata1[0]['contact_mobile'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
                                            <td class="business_data_td2"><span><?php echo $businessdata1[0]['contact_email']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-map-marker"></i></td>
                                            <td class="business_data_td2"><span>
                                                    <?php
                                                    if ($businessdata1[0]['address']) {
                                                        echo $businessdata1[0]['address'];
                                                        echo ",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($businessdata1[0]['city']) {
                                                        echo $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name;
                                                        echo",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($businessdata1[0]['country']) {
                                                        echo $this->db->get_where('countries', array('country_id' => $businessdata1[0]['country']))->row()->country_name;
                                                    }
                                                    ?> 
                                                </span></td>
                                        </tr>
                                        <?php
                                        if ($businessdata1[0]['contact_website']) {
                                            ?>
                                            <tr>
                                                <td class="business_data_td1"><i class="fa fa-globe"></i></td>
                                                <td class="business_data_td2 website"><span><a href="javascript:void(0);" onclick="login_profile();"> <?php echo $businessdata1[0]['contact_website']; ?></a></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-suitcase"></i></td>
                                            <td class="business_data_td2"><span><?php echo $this->common->make_links($businessdata1[0]['details']); ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- user iamges start-->
                            <!--<a href="<?php echo base_url('business-profile/photos/' . $businessdata1[0]['business_slug']) ?>">-->
                            <a href="javascript:void(0);" onclick="login_profile();">
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
                            <a href="javascript:void(0);" onclick="login_profile();">
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
                            <a href="javascript:void(0);" onclick="login_profile();">
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
                            <a href="javascript:void(0);" onclick="login_profile();">
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
                        <div class="col-md-7 custom-right-business">
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            $other_user = $businessdata1[0]['business_profile_id'];
                            $other_user_id = $businessdata1[0]['user_id'];

                            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
                            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                            $loginuser = $userdata[0]['business_profile_id'];
                            $contition_array = array('follow_type' => 2, 'follow_status' => 1);
                            $search_condition = "((follow_from  = '$loginuser' AND follow_to  = ' $other_user') OR (follow_from  = '$other_user' AND follow_to  = '$loginuser'))";
                            $followperson = $this->common->select_data_by_search('follow', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

                            $contition_array = array('contact_type' => 2);
                            $search_condition = "((contact_from_id  = '$userid' AND contact_to_id = ' $other_user_id') OR (contact_from_id  = '$other_user_id' AND contact_to_id = '$userid'))";
                            $contactperson = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

                            if ((count($followperson) == 2) || ($businessdata1[0]['user_id'] == $userid) || (count($contactperson) == 1)) {
                                ?>
                                <div class="post-editor col-md-12">
                                    <div class="main-text-area col-md-12">
                                        <div class="popup-img"> 
                                            <?php if ($businessdata[0]['business_user_image']) { ?><img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                            <?php } else { ?>
                                                <?php
                                                $a = $businessdata[0]['company_name'];
                                                $acr = substr($a, 0, 1);
                                                ?>
                                                <div class="post-img-div">
                                                    <?php echo ucfirst(strtolower($acr)) ?>
                                                </div>
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
                                        <?php echo form_open_multipart(base_url('business-profile/bussiness-profile-post-add/' . 'manage/' . $businessdata1[0]['user_id']), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix dashboard-upload-image-form', 'onsubmit' => "imgval(event)")); ?>
                                        <div class="main-text-area col-md-12"  >
                                            <div class="popup-img-in"> 
                                                <?php
                                                if ($businessdata[0]['business_user_image'] != '') {
                                                    ?>
                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <?php
                                                    $a = $businessdata[0]['company_name'];
                                                    $acr = substr($a, 0, 1);
                                                    ?>
                                                    <div class="post-img-div">
                                                        <?php echo ucfirst(strtolower($acr)) ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                                <textarea id= "test-upload_product" placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
                                                          name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;" tabindex="1"></textarea>
                                                <div class="fifty_val">                   
                                                    <input size=1 value=50 name=text_num class="text_num" readonly> 
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
                                                        <i class=" fa fa-camera upload_icon"  > Photo</i>
                                                        <i class=" fa fa-video-camera upload_icon"> Video </i> 
                                                        <i class="fa fa-music upload_icon"> Audio </i>
                                                        <i class=" fa fa-file-pdf-o upload_icon"> PDF </i>
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
                                <div class='progress' id="progress_div" style="display: none">
                                    <div class='bar' id='bar'></div>
                                    <div class='percent' id='percent'>0%</div>
                                </div>
                                <div class="business-all-post">
                                    <div class="nofoundpost"> 
                                    </div>
                                </div>
                                <!-- middle section start -->
                                <div class="nofoundpost">
                                </div>
                            </div>
                            <!-- business_profile _manage_post end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="5">
                                <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" />
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
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

        <!-- Login  -->
        <div class="modal fade login" id="login" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
                    <div class="modal-body">
                        <div class="col-sm-12 right-main">
                            <div class="right-main-inner">
                                <div class="login-frm">
                                        <div class="title">
                                            <h1 class="ttc">Welcome To Aileensoul</h1>
                                        </div>

                                        <form role="form" name="login_form" id="login_form" method="post">

                                            <div class="form-group">
                                                <input type="email" value="<?php echo $email; ?>" name="email_login" id="email_login" class="form-control input-sm" placeholder="Email Address*">
                                                <div id="error2" style="display:block;">
                                                    <?php
                                                    if ($this->session->flashdata('erroremail')) {
                                                        echo $this->session->flashdata('erroremail');
                                                    }
                                                    ?>
                                                </div>
                                                <div id="errorlogin"></div> 
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password_login" id="password_login" class="form-control input-sm" placeholder="Password*">
                                                <div id="error1" style="display:block;">
                                                    <?php
                                                    if ($this->session->flashdata('errorpass')) {
                                                        echo $this->session->flashdata('errorpass');
                                                    }
                                                    ?>
                                                </div>
                                                <div id="errorpass"></div> 
                                            </div>

                                            <p class="pt-20 ">
                                                <button class="btn1" onclick="login()">Login</button>
                                            </p>

                                            <p class=" text-center">
                                                <a href="javascript:void(0)" data-toggle="modal" onclick="forgot_profile();" id="myBtn">Forgot Password ?</a>
                                            </p>

                                            <p class="pt15 text-center">
                                                Don't have an account? <a href="javascript:void(0);" data-toggle="modal" onclick="register_profile();">Create an account</a>
                                            </p>
                                        </form>

                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Login -->

        <!-- model for forgot password start -->
        <div class="modal fade login" id="forgotPassword" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
                    <div class="modal-body">
                        <div class="col-sm-12 right-main">
                            <div class="right-main-inner">
                                <div class="login-frm">
                                        <div class="title">
                                            <h1 class="ttc">Forgot Password</h1>
                                        </div>
                                        <?php
                                        $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
                                        echo form_open('profile/forgot_password', $form_attribute);
                                        ?>
                                        <div class="form-group">
                                            <input type="email" value="" name="forgot_email" id="forgot_email" class="form-control input-sm" placeholder="Email Address*">
                                            <div id="error2" style="display:block;">
                                                <?php
                                                if ($this->session->flashdata('erroremail')) {
                                                    echo $this->session->flashdata('erroremail');
                                                }
                                                ?>
                                            </div>
                                            <div id="errorlogin"></div> 
                                        </div>
                                        
                                        <p class="pt-20 ">
                                            <input class="btn btn-theme btn1" type="submit" name="submit" value="Submit" style="width:200px; margin-top:15px;" /> 
                                        </p>


                                        </form>

                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- model for forgot password end -->

        <!-- register -->

        <div class="modal fade register-model login" id="register" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
                    <div class="modal-body">
                        <div class="clearfix">
                            <div class="col-md-12 col-sm-12">
                                    <h4>Join Aileensoul - It's Free</h4>
                                    <form role="form" name="register_form" id="register_form" method="post">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input tabindex="5" type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="form-group">
                                                    <input tabindex="6" type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input tabindex="7" type="text" name="email_reg" id="email_reg" class="form-control input-sm" placeholder="Email Address" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input tabindex="8" type="password" name="password_reg" id="password_reg" class="form-control input-sm" placeholder="Password">
                                        </div>
                                        <div class="form-group dob">
                                            <label class="d_o_b"> Date Of Birth :</label>
                                            <select tabindex="9" class="day" name="selday" id="selday">
                                                <option value="" disabled selected value>Day</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <select tabindex="10" class="month" name="selmonth" id="selmonth">
                                                <option value="" disabled selected value>Month</option>
                                                //<?php
//                  for($i = 1; $i <= 12; $i++){
//                  
                                                ?>
                                                <option value="1">Jan</option>
                                                <option value="2">Feb</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Apr</option>
                                                <option value="5">May</option>
                                                <option value="6">Jun</option>
                                                <option value="7">Jul</option>
                                                <option value="8">Aug</option>
                                                <option value="9">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                                //<?php
//                  }
//                  
                                                ?>
                                            </select>
                                            <select tabindex="11" class="year" name="selyear" id="selyear">
                                                <option value="" disabled selected value>Year</option>
                                                <?php
                                                for ($i = date('Y'); $i >= 1900; $i--) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>

                                        </div>
                                        <div class="dateerror" style="color:#f00; display: block;"></div>

                                        <div class="form-group gender-custom">
                                            <select tabindex="12" class="gender"  onchange="changeMe(this)" name="selgen" id="selgen">
                                                <option value="" disabled selected value>Gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>

                                        <p class="form-text">
                                            By Clicking on create an account button you agree our<br class="mob-none">
                                            <a href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('main/privacy_policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>
                                        </p>
                                    </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register -->
        <footer>
            <?php echo $footer; ?>
        </footer>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

        <script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script> 
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
                                                var slug = '<?php echo $slugid; ?>';
        </script>
        <!-- script for login  user valoidtaion start -->
        <script type="text/javascript">
            function login()
            {
                document.getElementById('error1').style.display = 'none';
            }
            //validation for edit email formate form
            $(document).ready(function () {
                /* validation */
                $("#login_form").validate({
                    rules: {
                        email_login: {
                            required: true,
                        },
                        password_login: {
                            required: true,
                        }
                    },
                    messages:
                            {
                                email_login: {
                                    required: "Please enter email address",
                                },
                                password_login: {
                                    required: "Please enter password",
                                }
                            },
                    submitHandler: submitForm
                });
                /* validation */
                /* login submit */
                function submitForm()
                {

                    var email_login = $("#email_login").val();
                    var password_login = $("#password_login").val();
                    var post_data = {
                        'email_login': email_login,
                        'password_login': password_login,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>registration/check_login',
                        data: post_data,
                        dataType: "json",
                        beforeSend: function ()
                        {
                            $("#error").fadeOut();
                            $("#btn1").html('Login ...');
                        },
                        success: function (response)
                        {
                            if (response.data == "ok") {
                                $("#btn1").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Login ...');
                                window.location = "<?php echo base_url() ?>business-profile/dashboard/" + slug;
                            } else if (response.data == "password") {
                                $("#errorpass").html('<label for="email_login" class="error">Please enter a valid password.</label>');
                                document.getElementById("password_login").classList.add('error');
                                document.getElementById("password_login").classList.add('error');
                                $("#btn1").html('Login');
                            } else {
                                $("#errorlogin").html('<label for="email_login" class="error">Please enter a valid email.</label>');
                                document.getElementById("email_login").classList.add('error');
                                document.getElementById("email_login").classList.add('error');
                                $("#btn1").html('Login');
                            }
                        }
                    });
                    return false;
                }
                /* login submit */
            });



        </script>
        <script>

            $(document).ready(function () {

                $.validator.addMethod("lowercase", function (value, element, regexpr) {
                    return regexpr.test(value);
                }, "Email Should be in Small Character");

                $("#register_form").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true,
                        },
                        email_reg: {
                            required: true,
                            email: true,
                            lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                            remote: {
                                url: "<?php echo site_url() . 'registration/check_email' ?>",
                                type: "post",
                                data: {
                                    email_reg: function () {
                                        // alert("hi");
                                        return $("#email_reg").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                        },
                        password_reg: {
                            required: true,
                        },
                        selday: {
                            required: true,
                        },
                        selmonth: {
                            required: true,
                        },
                        selyear: {
                            required: true,
                        },
                        selgen: {
                            required: true,
                        }
                    },

                    groups: {
                        selyear: "selyear selmonth selday"
                    },
                    messages:
                            {
                                first_name: {
                                    required: "Please enter first name",
                                },
                                last_name: {
                                    required: "Please enter last name",
                                },
                                email_reg: {
                                    required: "Please enter email address",
                                    remote: "Email address already exists",
                                },
                                password_reg: {
                                    required: "Please enter password",
                                },

                                selday: {
                                    required: "Please enter your birthdate",
                                },
                                selmonth: {
                                    required: "Please enter your birthdate",
                                },
                                selyear: {
                                    required: "Please enter your birthdate",
                                },
                                selgen: {
                                    required: "Please enter your gender",
                                }

                            },
                    submitHandler: submitRegisterForm
                });
                /* register submit */
                function submitRegisterForm()
                {
                    var first_name = $("#first_name").val();
                    var last_name = $("#last_name").val();
                    var email_reg = $("#email_reg").val();
                    var password_reg = $("#password_reg").val();
                    var selday = $("#selday").val();
                    var selmonth = $("#selmonth").val();
                    var selyear = $("#selyear").val();
                    var selgen = $("#selgen").val();

                    var post_data = {
                        'first_name': first_name,
                        'last_name': last_name,
                        'email_reg': email_reg,
                        'password_reg': password_reg,
                        'selday': selday,
                        'selmonth': selmonth,
                        'selyear': selyear,
                        'selgen': selgen,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    }


                    var todaydate = new Date();
                    var dd = todaydate.getDate();
                    var mm = todaydate.getMonth() + 1; //January is 0!
                    var yyyy = todaydate.getFullYear();

                    if (dd < 10) {
                        dd = '0' + dd
                    }

                    if (mm < 10) {
                        mm = '0' + mm
                    }

                    var todaydate = yyyy + '/' + mm + '/' + dd;
                    var value = selyear + '/' + selmonth + '/' + selday;


                    var d1 = Date.parse(todaydate);
                    var d2 = Date.parse(value);
                    if (d1 < d2) {
                        $(".dateerror").html("Date of birth always less than to today's date.");
                        return false;
                    } else {
                        if ((0 == selyear % 4) && (0 != selyear % 100) || (0 == selyear % 400))
                        {
                            if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                                if (selday == 31) {
                                    $(".dateerror").html("This month has only 30 days.");
                                    return false;
                                }
                            } else if (selmonth == 2) { //alert("hii");
                                if (selday == 31 || selday == 30) {
                                    $(".dateerror").html("This month has only 29 days.");
                                    return false;
                                }
                            }
                        } else {
                            if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                                if (selday == 31) {
                                    $(".dateerror").html("This month has only 30 days.");
                                    return false;
                                }
                            } else if (selmonth == 2) {
                                if (selday == 31 || selday == 30 || selday == 29) {
                                    $(".dateerror").html("This month has only 28 days.");
                                    return false;
                                }
                            }
                        }
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>registration/reg_insert',
                        data: post_data,
                        beforeSend: function ()
                        {
                            $("#register_error").fadeOut();
                            $("#btn1").html('Create an account ...');
                        },
                        success: function (response)
                        {
                            if (response == "ok") {
                                $("#btn-register").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Sign Up ...');
                                window.location = "<?php echo base_url() ?>business-profile/dashboard/" + slug;
                            } else {
                                $("#register_error").fadeIn(1000, function () {
                                    $("#register_error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                                    $("#btn1").html('Create an account');
                                });
                            }
                        }
                    });
                    return false;
                }
            });

        </script>
        <!-- forgot password script end -->
        <script type="text/javascript">
            $(document).ready(function () { //aletr("hii");
                /* validation */
                $("#forgot_password").validate({
                    rules: {
                        forgot_email: {
                            required: true,
                            email: true,
                        }

                    },
                    messages: {
                        forgot_email: {
                            required: "Email Address Is Required.",
                        }
                    },
                });
                /* validation */

            });
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/user_dashboard.js'); ?>"></script>
        <script>
            function login_profile() {
                $('#login').modal('show');
            }
            function register_profile() {
                $('#login').modal('hide');
                $('#register').modal('show');
            }
            function forgot_profile() {
                $('#forgotPassword').modal('show');
            }
        </script>
        <script>
            $(document).on('click', '[data-toggle*=modal]', function () {
                $('[role*=dialog]').each(function () {
                    switch ($(this).css('display')) {
                        case('block'):
                        {
                            $('#' + $(this).attr('id')).modal('hide');
                            break;
                        }
                    }
                });
            });
        </script>

    </body>
</html>
