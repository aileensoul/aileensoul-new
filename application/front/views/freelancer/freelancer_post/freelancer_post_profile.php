<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-apply.css?ver=' . time()); ?>">
       <?php if(!$this->session->userdata('aileenuser')){ ?>
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
                background: #1b8ab9 !important;
                padding:8px 25px;
                text-align:center;
                border-radius:4px;
                display:inline-block;
                border:1px solid #fff;
                font-weight: normal;
                font-family: 'robotolight';
                line-height:1;
            }
            .btn3:hover {
                background: #fff !important;
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
            .no-login .left_side_posrt label{margin-bottom: 6px;}
            .no-login .left_side_posrt  a {color: #5c5c5c;}
            .no-login .left_side_posrt  a:hover{color: #1b8ab9 !important;}
            .job_active{color: #1b8ab9 !important;}
            .no-login .left_side_posrt .lbpos input{width: 10% !important; }
            .profile-boxProfileCard-cover{width: 100%;border:none;padding-left: 10px;float: left;height: auto;}
            .profile-boxProfileCard-cover a{color: black;}
            .profile-boxProfileCard-cover a:hover{color: #1b8ab9;}
            .title h1{font-family: 'robotoregular';font-size: 38px;color: #1b8ab9;background: -webkit-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%);background-clip: border-box;-webkit-background-clip: text;-webkit-text-fill-color: transparent;position: relative;margin-bottom: 20px;/*text-transform: capitalize;*/}
            .full-box-module{width: 100%;float: left;}
            .profile-boxProfileCard{border: none;}
            .d_o_b{color: #848484;font-size: 10px;font-weight: normal;line-height: 1;margin-bottom: 0;padding-left: 5px; width: 100%;}       
            .title{text-align:center;margin: 0 auto;border-bottom: 1px solid #c7c7c7;border-top-left-radius: 5px;  border-top-right-radius: 5px;}
            .title h1{font-family: 'robotoregular';display:inline-block;text-align:center;font-size:38px;color:#1b8ab9;
                      background: -webkit-linear-gradient(96deg, #1b8ab9 0%, #1b8ab9 44%, #3bb0ac 100%);
                      -webkit-background-clip: text;
                      -webkit-text-fill-color: transparent;
                      position:relative;margin-bottom:20px;text-transform:capitalize;}
            .sign_in{width:100%; text-align:center;}
            .sign_in p a:hover{text-decoration:underline;}
            .login p a:hover{text-decoration:underline; color:#337ab7;}
            #forgot_password .modal-header label{color: #1b8ab9 !important; margin-bottom: 0px;}
            #forgot_password .modal-body label{color: #5b5b5b !important;}
            #forgot_password .submit_btn{text-align:center;}
            .modal-content{padding: 0px !important;width: 560px;}
            .sign_in p{font-size:14px; margin-bottom:9px;}
            .md-2{
                width: 450px!important;
                margin: 0 auto; 
                top: 50%; position: absolute; left: 50%;
                -ms-transform: translate(-50%,-50%);
                -webkit-transform: translate(-50%,-50%);
                -moz-transform: translate(-50%,-50%);
                -o-transform: translate(-50%,-50%);
                transform: translate(-50%,-50%);}
            /*second*/
            /*second*/

        </style>
       <?php } ?>
    </head>
    <body class="page-container-bg-solid page-boxed botton_footer">
        <?php if($this->session->userdata('aileenuser')){ echo $header; }else{ ?>
               <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 col-xs-4 left-header fw-479">
                        <h2 class="logo"><a title="Aileensoul" href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-8 right-header fw-479">
                        <div class="btn-right pull-right">
                            <a title="Login" href="javascript:void(0);" onclick="login_profile();" class="btn2">Login</a>
                            <a title="Create an account" href="javascript:void(0);" onclick="create_profile();" class="btn3">Create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
            
     <?php    } ?>
        <?php
        // $returnpage = $_GET['page'];
        if($this->session->userdata('aileenuser')){
        if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
            echo $freelancer_hire_header2_border;
        } else {
            echo $freelancer_post_header2_border;
        }
        }
        ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result set-btn" ><?php echo $this->lang->line("cancel"); ?></button>
                        <button class="btn btn-success set-btn upload-result"><?php echo $this->lang->line("save"); ?></button>
                        <div id="message1" style="display:none;">
                            <div id="floatBarsG">
                                <div id="floatBarsG_1" class="floatBarsG"></div>
                                <div id="floatBarsG_2" class="floatBarsG"></div>
                                <div id="floatBarsG_3" class="floatBarsG"></div>
                                <div id="floatBarsG_4" class="floatBarsG"></div>
                                <div id="floatBarsG_5" class="floatBarsG"></div>
                                <div id="floatBarsG_6" class="floatBarsG"></div>
                                <div id="floatBarsG_7" class="floatBarsG"></div>
                                <div id="floatBarsG_8" class="floatBarsG"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"  style="visibility: hidden; ">
                        <div id="upload-demo-i"></div>
                    </div>
                </div>

                <div class="">
                    <div class="" id="row2">
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($this->uri->segment(3) == $userid) {
                            $user_id = $userid;
                        } elseif ($this->uri->segment(3) == "") {
                            $user_id = $userid;
                        } else {
                            if (is_numeric($this->uri->segment(3))) {
                                $user_id = $this->uri->segment(3);
                            } else {
                                $user_id = $this->db->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $this->uri->segment(3), 'status' => '1'))->row()->user_id;
                            }
                            // $user_id = $this->uri->segment(3);
                        }
                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                        $image = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>

                        <img alt="<?php echo $freelancerpostdata[0]['freelancer_post_fullname']." ".$freelancerpostdata[0]['freelancer_post_username']; ?>" src="<?php echo FREE_POST_BG_MAIN_UPLOAD_URL . $image[0]['profile_background']; ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>
                                 <div class="bg-images no-cover-upload">
                                     <img alt="No Image" src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
                            </div>

                        <?php }
                        ?>

                    </div>
                </div>
            </div>
            <div class="container tablate-container art-profile">    
                <?php if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext"><?php echo $this->lang->line("upload_cover_photo"); ?></span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                <?php } ?>

                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php
                            $fname = $freelancerpostdata[0]['freelancer_post_fullname'];
                            $lname = $freelancerpostdata[0]['freelancer_post_username'];
                            $sub_fname = substr($fname, 0, 1);
                            $sub_lname = substr($lname, 0, 1);
                            if ($freelancerpostdata[0]['freelancer_post_user_image']) {

                                if (IMAGEPATHFROM == 'upload') {

                                    if (!file_exists($this->config->item('free_post_profile_main_upload_path') . $freelancerpostdata[0]['freelancer_post_user_image'])) {
                                        ?>
                                        <div class="post-img-user">
                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                        </div>
                                    <?php } else {
                                        ?>
                                        <img src="<?php echo FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image']; ?>" alt="<?php echo $freelancerpostdata[0]['freelancer_post_fullname']." ".$freelancerpostdata[0]['freelancer_post_username']; ?>" >        
                                        <?php
                                    }
                                } else {

                                    $filename = $this->config->item('free_post_profile_main_upload_path') . $freelancerpostdata[0]['freelancer_post_user_image'];
                                    $s3 = new S3(awsAccessKey, awsSecretKey);
                                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                    if ($info) {
                                        ?>
                                        <img src="<?php echo FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerpostdata[0]['freelancer_post_user_image']; ?>" alt="<?php echo $freelancerpostdata[0]['freelancer_post_fullname']." ".$freelancerpostdata[0]['freelancer_post_username']; ?>" >
                                    <?php } else { ?>
                                        <div class="post-img-user">
                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class="post-img-user">
                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                </div>
                            <?php } ?>
                            <?php if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) { ?>
                                        <a title="update Profile pic" href="javascript:void(0);" class="cusome_upload" onclick="updateprofilepopup();"><img alt="Update profile pic"  src="<?php echo base_url('assets/img/cam.png'); ?>"><?php echo $this->lang->line("update_profile_picture"); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
                        <a title="<?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?>" href="javascript:void(0);">   <h3> <?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?></h3></a>
                        <div class="profile-text">
                            <?php
                            if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) {
                                if ($freelancerpostdata[0]['designation'] == "") {
                                    ?> 
                                    <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                                    <?php
                                } else {
                                    ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerpostdata[0]['designation']); ?>"><?php echo ucwords($freelancerpostdata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerpostdata[0]['designation'] == '') {
                                    ?>
                                    <?php echo $this->lang->line("designation"); ?>
                                <?php } else { ?>
                                    <?php echo ucwords($freelancerpostdata[0]['designation']); ?>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr"> 
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freelancerpostdata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">
                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelance-work') && ($this->uri->segment(2) == 'freelancer-details')) { ?> class="active" <?php } ?>>
                                        <?php if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) { ?>
                                            <a title="Freelancer Details" href="<?php echo base_url('freelance-work/freelancer-details/') . $this->uri->segment(3); ?>">Details</a><?php } else { ?><a title="Freelancer Details" href="<?php echo base_url('freelance-work/freelancer-details'); ?>"><?php echo $this->lang->line("freelancer_details"); ?></a><?php } ?>
                                    </li>
                                    <?php
                                    $id = $this->db->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $this->uri->segment(3), 'status' => '1'))->row()->user_id;
                                    if (($this->uri->segment(1) == 'freelance-work') && ($this->uri->segment(2) == 'freelancer-details' || $this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'freelancer_save_post' || $this->uri->segment(2) == 'applied-projects') && ($id == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) {
                                        ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelance-work') && ($this->uri->segment(2) == 'saved-projects')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelance-work/saved-projects'); ?>"><?php echo $this->lang->line("saved_projects"); ?></a> </li>
                                        <li <?php if (($this->uri->segment(1) == 'freelance-work') && ($this->uri->segment(2) == 'applied-projects')) { ?> class="active" <?php } ?>><a title="Applied  Post" href="<?php echo base_url('freelance-work/applied-projects'); ?>"><?php echo $this->lang->line("applied_projects"); ?></a> </li>
                                    <?php } ?>
                                </ul>

                                <?php
                                if (is_numeric($this->uri->segment(3))) {
                                    $id = $this->uri->segment(3);
                                } else {
                                    $id = $this->db->get_where('freelancer_post_reg', array('freelancer_apply_slug' => $this->uri->segment(3), 'status' => '1'))->row()->user_id;
                                }
                                $userid = $this->session->userdata('aileenuser');
//                                echo $id. "<br>";
//                                echo $userid;
                                $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_type' => '2');
                                $data = $this->common->select_data_by_condition('save', $contition_array, $data = 'status', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                //  echo "<pre>"; print_r($data); die();
                                if($this->session->userdata('aileenuser')){
                                if ($userid != $id) {
                                    if ($this->uri->segment(3) != "") {
                                        ?>
                                        <div class="flw_msg_btn fr">
                                            <ul>
                                                <?php
                                                if ($data[0]['status'] == '1' || $data[0]['status'] == '') {

                                                    if ($_GET['post_id']) {
                                                        ?> 
                                                        <li>
                                                            <a title="shortlist" id="<?php echo $id; ?>" onClick="shortlistpopup(<?php echo $id; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $id ?>"> Shortlist </a> 

                                                        </li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a title="save" id="<?php echo $id; ?>" onClick="savepopup(<?php echo $id; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $id ?>">
                                                                <?php echo $this->lang->line("save"); ?>
                                                            </a> 

                                                        </li> <?php
                                                    }
                                                } elseif ($data[0]['status'] == '0') {
                                                    ?>
                                                    <li> 
                                                        <a title="Saved" class="saved butt_rec <?php echo 'saveduser' . $id; ?> "><?php echo $this->lang->line("saved"); ?></a>
                                                    </li> <?php } else {
                                                    ?>
                                                    <li> 
                                                        <a title="Shortlisted" class="saved butt_rec <?php echo 'saveduser' . $id; ?> ">Shortlisted</a>
                                                    </li> 
                                                <?php }
                                                ?>
                                                <li>
                                                    <input type="hidden" id="<?php echo 'hideenpostid'; ?>" value= "<?php echo $_GET['page']; ?>">
                                                    <?php
                                                    //  $returnpage = $_GET['page'];
                                                    if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                        ?>
                                                    <a title="Message" href="<?php echo base_url('chat/abc/3/4/' . $id); ?>"><?php echo $this->lang->line("message"); ?></a>
                                                    <?php } else { ?>
                                                        <a title="Message" href="<?php echo base_url('chat/abc/4/3/' . $id); ?>"><?php echo $this->lang->line("message"); ?></a>
                                                    <?php }
                                                    ?>

                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                }
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="middle-part container pt10">
                <div class="job-menu-profile mob-none pt-20">
                    <a title="<?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?>" href="javascript:void(0);">   <h3> <?php echo ucwords($freelancerpostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerpostdata[0]['freelancer_post_username']); ?></h3></a>
                    <div class="profile-text pt5">
                        <?php
                        if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) {
                            if ($freelancerpostdata[0]['designation'] == "") {
                                ?> 
                                <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freelancerpostdata[0]['designation']); ?>"><?php echo ucwords($freelancerpostdata[0]['designation']); ?></a>
                                <?php
                            }
                        } else {
                            if ($freelancerpostdata[0]['designation'] == "") {
                                ?>
                                <?php echo $this->lang->line("designation"); ?>
                            <?php } else { ?>
                                <?php echo ucwords($freelancerpostdata[0]['designation']); ?>

                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 col-xs-12 mob-clear">
                    <?php
                    if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) {
                        if ($count_profile == 100) {
                            if ($freepostdata[0]['progressbar'] == 0) {
                                ?>

                                <div class="mob-progressbar" >
                                    <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                                    <p class="mob-edit-pro">

                                        <a title="Successfully Completed" href="javascript:void(0);"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Successfully Completed</a>      


                                    </p>
                                    <div class="progress skill-bar ">
                                        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo($count_profile); ?>" aria-valuemin="0" aria-valuemax="100">
                                            <span class="skill"><i class="val"><?php echo(round($count_profile)); ?>%</i></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="mob-progressbar" >
                                <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                                <p class="mob-edit-pro">


                                    <a title="Edit Profile" href="<?php echo base_url('freelance-work/basic-information') ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Profile</a>


                                </p>
                                <div class="progress skill-bar ">
                                    <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuenow="<?php echo($count_profile); ?>" aria-valuemin="0" aria-valuemax="100">
                                        <span class="skill"><i class="val"><?php echo(round($count_profile)); ?>%</i></span>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3><?php echo $this->lang->line("freelancer_details"); ?> </h3>
                            <div class=" fr rec-edit-pro">
                                <?php

                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($freelancerpostdata[0]['user_id'] === $userid) {
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
                                                        <li><p class="details_all_tital "><?php echo $this->lang->line("basic_info"); ?></p> </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-profile-menu">
                                                <ul class="clearfix">
                                                    <li> <b><?php echo $this->lang->line("name"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_fullname'] . '  ' . $freelancerpostdata[0]['freelancer_post_username']; ?> </span>
                                                    </li>
                                                    <li> <b><?php echo $this->lang->line("email"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_email']; ?> </span>
                                                    </li>
                                                    <?php
                                                    if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                        if ($freelancerpostdata[0]['freelancer_post_phoneno']) {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_phoneno']; ?></span> </li>
                                                            <?php
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        if ($freelancerpostdata[0]['freelancer_post_phoneno']) {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_phoneno']; ?></span> </li> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("phone_no"); ?></b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                        if ($freelancerpostdata[0]['freelancer_post_skypeid']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skype_id"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_skypeid']; ?> </span>
                                                            </li> 
                                                            <?php
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        if ($freelancerpostdata[0]['freelancer_post_skypeid']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skype_id"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_skypeid']; ?> </span>
                                                            </li> 
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li><b><?php echo $this->lang->line("skype_id"); ?></b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("address"); ?></p> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b><?php echo $this->lang->line("country"); ?></b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $freelancerpostdata[0]['freelancer_post_country']))->row()->country_name; ?></span>
                                                        </li>
                                                        <li> <b><?php echo $this->lang->line("state"); ?></b><span> <?php
                                                                echo
                                                                $this->db->get_where('states', array('state_id' => $freelancerpostdata[0]['freelancer_post_state']))->row()->state_name;
                                                                ?> </span>
                                                        </li>
                                                        <?php
                                                        if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                            if ($freelancerpostdata[0]['freelancer_post_city']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span><?php
                                                                        echo
                                                                        $this->db->get_where('cities', array('city_id' => $freelancerpostdata[0]['freelancer_post_city']))->row()->city_name;
                                                                        ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerpostdata[0]['freelancer_post_city']) {
                                                                    ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span><?php
                                                                        echo
                                                                        $this->db->get_where('cities', array('city_id' => $freelancerpostdata[0]['freelancer_post_city']))->row()->city_name;
                                                                        ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                <li><b><?php echo $this->lang->line("city"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                            if ($freelancerpostdata[0]['freelancer_post_pincode']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("pincode"); ?></b><span><?php echo $freelancerpostdata[0]['freelancer_post_pincode']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerpostdata[0]['freelancer_post_pincode']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("pincode"); ?></b><span><?php echo $freelancerpostdata[0]['freelancer_post_pincode']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("pincode"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("professional_info"); ?></p></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <?php $categoryname = $this->db->get_where('category', array('category_id' => $freelancerpostdata[0]['freelancer_post_field']))->row()->category_name; ?>
                                                        <li> <b><?php echo $this->lang->line("field"); ?></b> <span> <?php echo $categoryname; ?> </span>
                                                        </li>
                                                        <?php
                                                        if ($freelancerpostdata[0]['freelancer_post_area']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("skill"); ?></b><span>
                                                                    <?php
                                                                    $aud = $freelancerpostdata[0]['freelancer_post_area'];
                                                                    $aud_res = explode(',', $aud);
                                                                    foreach ($aud_res as $skill) {

                                                                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                        $skill1[] = $cache_time;
                                                                    }
                                                                    $listFinal = implode(', ', $skill1);

                                                                    if (!$listFinal) {

                                                                        echo $freelancerpostdata[0]['freelancer_post_otherskill'];
                                                                    } else if (!$freelancerpostdata[0]['freelancer_post_otherskill']) {

                                                                        echo $listFinal;
                                                                    } else if ($listFinal && $freelancerpostdata[0]['freelancer_post_otherskill']) {
                                                                        echo $listFinal . ',' . $freelancerpostdata[0]['freelancer_post_otherskill'];
                                                                    }
                                                                    ?>     
                                                                </span>
                                                            </li>
                                                        <?php } ?>

                                                        <li><b><?php echo $this->lang->line("skill_description"); ?></b> <span> <pre><?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_skill_description']); ?> </pre> </span> </li>

                                                        <li><b><?php echo $this->lang->line("total_experiance"); ?></b> <span>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_exp_month'] == '12 month' && $freelancerpostdata[0]['freelancer_post_exp_year'] == '0 year') {
                                                                    echo "1 year";
                                                                } elseif ($freelancerpostdata[0]['freelancer_post_exp_year'] != '0 year' && $freelancerpostdata[0]['freelancer_post_exp_month'] == '12 month') {
                                                                    $month = explode(' ', $freelancerpostdata[0]['freelancer_post_exp_year']);
                                                                    $year = $month[0];
                                                                    $years = $year + 1;
                                                                    echo $years . " Years";
                                                                } else {
                                                                    echo $freelancerpostdata[0]['freelancer_post_exp_year'] . ' ' . $freelancerpostdata[0]['freelancer_post_exp_month'];
                                                                }
                                                                ?>
                                                            </span> </li>  
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                            if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                $currancy = $this->db->get_where('currency', array('currency_id' => $freelancerpostdata[0]['freelancer_post_ratestate']))->row()->currency_name;
                                                if ($freelancerpostdata[0]['freelancer_post_hourly'] != "" && $freelancerpostdata[0]['freelancer_post_ratestate'] != "0") {
                                                    ?>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("rate"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_hourly']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_hourly'] . '  ' . $currancy; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_fixed_rate'] == 1) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("also_work_fixed"); ?></b> 
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div> <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("rate"); ?></p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_hourly']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_hourly'] . '  ' . $currancy; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("hourly"); ?></b> <span>  <?php echo PROFILENA; ?> </span>
                                                                </li>
                                                            <?php } ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_fixed_rate'] == 1) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("also_work_fixed"); ?></b> 
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                            <?php
                                            if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                if ($freelancerpostdata[0]['freelancer_post_job_type'] != "" || $freelancerpostdata[0]['freelancer_post_work_hour'] != "") {
                                                    ?>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("avaibility"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_job_type']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("timing"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_job_type']; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }

                                                                if ($freelancerpostdata[0]['freelancer_post_work_hour']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_work_hour']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?> 
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("avaibility"); ?></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_job_type']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("timing"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_job_type']; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b>Timing<?php echo $this->lang->line("timing"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            if ($freelancerpostdata[0]['freelancer_post_work_hour']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span> <?php echo $freelancerpostdata[0]['freelancer_post_work_hour']; ?></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("working_hours_week"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                if ($freelancerpostdata[0]['freelancer_post_degree'] != "0" || $freelancerpostdata[0]['freelancer_post_stream'] != "0" || $freelancerpostdata[0]['freelancer_post_univercity'] != "0" || $freelancerpostdata[0]['freelancer_post_percentage'] != "" || $freelancerpostdata[0]['freelancer_post_passingyear'] != "0") {
                                                    ?> 
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital "><?php echo $this->lang->line("education"); ?></p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_degree']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("degree"); ?></b> <span><?php echo $this->db->get_where('degree', array('degree_id' => $freelancerpostdata[0]['freelancer_post_degree']))->row()->degree_name; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_stream']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("stream"); ?></b><span> <?php echo $this->db->get_where('stream', array('stream_id' => $freelancerpostdata[0]['freelancer_post_stream']))->row()->stream_name; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_univercity']) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("university"); ?></b> <span><?php echo $this->db->get_where('university', array('university_id' => $freelancerpostdata[0]['freelancer_post_univercity']))->row()->university_name; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_collage']) {
                                                                    ?>
                                                                    <li><b><?php echo $this->lang->line("college"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_collage']; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_percentage']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("percentage"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_percentage'] . " %"; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                                <?php
                                                                if ($freelancerpostdata[0]['freelancer_post_passingyear']) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("year_passing"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_passingyear']; ?> </span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital "><?php echo $this->lang->line("education"); ?></p>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_degree']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("degree"); ?></b> <span><?php echo $this->db->get_where('degree', array('degree_id' => $freelancerpostdata[0]['freelancer_post_degree']))->row()->degree_name; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("degree"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }

                                                            if ($freelancerpostdata[0]['freelancer_post_stream']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("stream"); ?></b><span> <?php echo $this->db->get_where('stream', array('stream_id' => $freelancerpostdata[0]['freelancer_post_stream']))->row()->stream_name; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("stream"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_univercity']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("university"); ?></b> <span><?php echo $this->db->get_where('university', array('university_id' => $freelancerpostdata[0]['freelancer_post_univercity']))->row()->university_name; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("university"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_collage']) {
                                                                ?>
                                                                <li><b><?php echo $this->lang->line("college"); ?></b> <span><?php echo $freelancerpostdata[0]['freelancer_post_collage']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("college"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_percentage']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("percentage"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_percentage'] . " %"; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("percentage"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_passingyear']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("year_passing"); ?></b><span> <?php echo $freelancerpostdata[0]['freelancer_post_passingyear']; ?> </span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("year_passing"); ?></b> <span>
                                                                        <?php echo PROFILENA; ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            if ($freelancerpostdata['0']['user_id'] != $this->session->userdata('aileenuser')) {
                                                if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "" || $freelancerpostdata[0]['freelancer_post_portfolio'] != "") {
                                                    ?> 
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li><p class="details_all_tital "><?php echo $this->lang->line("portfolio"); ?></p> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">

                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "") {
                                                                $allowespdf = array('pdf');
                                                                $filename = $freelancerpostdata[0]['freelancer_post_portfolio_attachment'];
                                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                                if (in_array($ext, $allowespdf)) {
                                                                    ?>
                                                                    <li> <b><?php echo $this->lang->line("attach"); ?></b><span>
                                                                            <div class="free_attc">
                                                                                <a title="pdf" href="<?php echo base_url('freelancer/pdf/' . $freelancerpostdata[0]['user_id']) ?>">
                                                                                    <img alt="PDF" src="<?php echo base_url('assets/images/PDF.jpg') ?>" > 
                                                                                </a>
                                                                        </span>

                                                                    </li>
                                                                <?php } ?>

                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($freelancerpostdata[0]['freelancer_post_portfolio']) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("descri"); ?></b> <span><pre>
                                                                            <?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_portfolio']); ?> </pre></span>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                            ?>

                                                        </ul>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li><p class="details_all_tital "><?php echo $this->lang->line("portfolio"); ?></p> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <?php
                                                        if ($freelancerpostdata[0]['freelancer_post_portfolio_attachment'] != "") {
                                                            $allowespdf = array('pdf');
                                                            $filename = $freelancerpostdata[0]['freelancer_post_portfolio_attachment'];
                                                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                            if (in_array($ext, $allowespdf)) {
                                                                ?>
                                                                <li> <b><?php echo $this->lang->line("attach"); ?></b><span>
                                                                        <div class="free_attc">
                                                                            <a title="pdf" href="<?php echo base_url('freelancer/pdf/' . $freelancerpostdata[0]['user_id']) ?>">
                                                                                <img alt="pdf" src="<?php echo base_url('assets/images/PDF.jpg') ?>" > 
                                                                            </a>
                                                                    </span>
                                                                </li>
                                                            <?php } ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("attach"); ?></b><span> 
                                                                    <?php echo PROFILENA; ?>
                                                                </span>

                                                            </li>
                                                            <?php
                                                        }

                                                        if ($freelancerpostdata[0]['freelancer_post_portfolio']) {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("descri"); ?></b> <span><p>
                                                                        <?php echo $this->common->make_links($freelancerpostdata[0]['freelancer_post_portfolio']); ?> </p></span>
                                                            </li>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <li> <b><?php echo $this->lang->line("descri"); ?></b><span> 
                                                                    <?php echo PROFILENA; ?>
                                                                </span>
                                                            </li>
                                                        <?php }
                                                        ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($freelancerpostdata['0']['user_id'] == $this->session->userdata('aileenuser')) {
                    if ($count_profile == 100) {
                        if ($freepostdata[0]['progressbar'] == 0) {
                            ?>
                            <div class="edit_profile_progress edit_pr_bar complete_profile">
                                <div class="progre_bar_text">
                                    <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                                </div>
                                <div class="count_main_progress">
                                    <div class="circles">
                                        <div class="second circle-1 ">
                                            <div class="true_progtree">
                                                <img alt="Completed" src="<?php echo base_url("assets/img/true.png"); ?>">
                                            </div>
                                            <div class="tr_text">
                                                Successfully Completed
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="edit_profile_progress edit_pr_bar">
                            <div class="progre_bar_text">
                                <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                            </div>
                            <div class="count_main_progress">
                                <div class="circles">
                                    <div class="second circle-1">
                                        <div>
                                            <strong></strong>
                                            <a title="Edit Profile" href="<?php echo base_url('freelance-work/basic-information') ?>" class="edit_profile_job">Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </section>
        <?php echo $login_footer ?>
        <?php echo $footer; ?>
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
                                <div class="fw" id="profi_loader"  style="display:none;" style="text-align:center;" ><img alt="loader" src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                                    <?php //echo form_open_multipart(base_url('freelancer/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix'));            ?>
                                    <div class="fw">
                                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one">
                                    </div>
                                    <div class="col-md-7 text-center">
                                        <div id="upload-demo-one" style="width:350px"></div>
                                    </div>
                                    <input type="submit" class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                </form>
                                <?php //echo form_close();            ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- register -->

        <div class="modal fade register-model login" id="register" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content inner-form1">
                    <!--<button type="button" class="modal-close" data-dismiss="modal">&times;</button>-->       
                    <div class="modal-body">
                        <div class="clearfix">
                            <div class="">
                                <div class="title"><h1>Sign up First and Register in Employer Profile</h1></div>
                                <div class="main-form">
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
                                            <span><select tabindex="9" class="day" name="selday" id="selday">
                                                    <option value="" disabled selected value>Day</option>
                                                    <?php
                                                    for ($i = 1; $i <= 31; $i++) {
                                                        ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select></span>
                                            <span>
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
                                                </select></span>
                                            <span>
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
                                            </span>
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
                                            By Clicking on create an account button you agree our
                                            <a title="Terms and Condition" href="<?php echo base_url('terms-and-condition'); ?>">Terms and Condition</a> and <a title="Privacy policy" href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>
                                                                                        <!--<p class="next">Next</p>-->
                                        </p>
                                        <div class="sign_in pt10">
                                            <p>
                                                Already have an account ? <a title=" Log In" tabindex="12" onClick="login_profile();" href="javascript:void(0);"> Log In </a>
                                            </p>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register -->

        <!-- Login  -->
        <div class="modal fade login" id="login" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content login-frm">
                    <!--<button type="button" class="modal-close" data-dismiss="modal">&times;</button>-->       
                    <div class="modal-body">
                        <div class="right-main">
                            <div class="right-main-inner">
                                <div class="">
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
                                            <a title="Forgot Password" href="javascript:void(0)" data-toggle="modal" onclick="forgot_profile();" id="myBtn">Forgot Password ?</a>
                                        </p>

                                        <p class="pt15 text-center">
                                            Don't have an account? <a title="Create an account" class="db-479" href="javascript:void(0);" data-toggle="modal" onclick="register_profile();">Create an account</a>
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
                <div class="modal-content login-frm">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <div class="right-main">
                            <div class="right-main-inner">
                                <div class="">
                                    <div id="forgotbuton"></div> 
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

                                    <p class="pt-20 text-center">
                                        <input class="btn btn-theme btn1" type="submit" name="submit" value="Submit" style="width:105px; margin:0px auto;" /> 
                                    </p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script  src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>
        <script  src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/progressloader.js?ver=' . time()); ?>">
        </script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var user_session = '<?php echo $this->session->userdata('aileenuser'); ?>';
            var segment3 = '<?php echo $this->uri->segment(3); ?>'
            var count_profile_value = '<?php echo $count_profile_value; ?>';
            var count_profile = '<?php echo $count_profile; ?>';
        </script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_post_profile.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_common.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/progressbar.js?ver=' . time()); ?>"></script>
    </body>
</html>