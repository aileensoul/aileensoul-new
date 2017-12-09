<!DOCTYPE html>
<html>
    <head><title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-apply.css?ver=' . time()); ?>">
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
            .no-login .left_side_posrt label{margin-bottom: 6px;}
            .no-login .left_side_posrt  a {color: #5c5c5c;}
            .no-login .left_side_posrt  a:hover{color: #1b8ab9 !important;}
            .job_active{color: #1b8ab9 !important;}
            .no-login .left_side_posrt .lbpos input{width: 10% !important; }
            .no-login .left_side_posrt .profile-boxProfileCard-cover{height: 210px;border: none;}
            /*second*/

        </style>
    </head>
    <body>
        <?php //echo $header; ?>
        <?php //echo $freelancer_post_header2_border; ?>
        <?php
        $userid = $this->session->userdata('aileenuser');
        if (!$userid) {
            ?>
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
            <?php
        } else {
            echo $header;
        }
        ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="">
                        <!--COVER PIC START-->
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="full-box-module">   
                                <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover"> 
                                        <a href="<?php echo base_url("projects-project"); ?>" >All Projects</a>
                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Accounting-Consulting-project"); ?>" <?php if ($keyword1 == 'Accounting-Consulting') { ?> class="job_active" <?php } ?>>Accounting & Consulting Projects</a>
                                        </label>
                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Admin-Support-project"); ?>" <?php if ($keyword1 == 'Admin-Support') { ?> class="job_active" <?php } ?>>Admin Support Projects</a>
                                        </label>
                                        <label for="City" class="lbpos fw"> 
                                            <a href="<?php echo base_url("Customer-Service-project"); ?>" <?php if ($keyword1 == 'Customer-Service') { ?> class="job_active" <?php } ?>>Customer Service Projects</a>
                                        </label>
                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Data-Science-Analytics-project"); ?>" <?php if ($keyword1 == 'Data-Science-Analytics') { ?> class="job_active" <?php } ?>>Data Science & Analytics Projects</a>
                                        </label>
                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Design-Creative-project"); ?>" <?php if ($keyword1 == 'Design-Creative') { ?> class="job_active" <?php } ?>>Design & Creative  Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Engineering-Architecture-project"); ?>" <?php if ($keyword1 == 'Engineering-Architecture') { ?> class="job_active" <?php } ?>>Engineering & Architecture Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Legal-project"); ?>" <?php if ($keyword1 == 'Legal') { ?> class="job_active" <?php } ?>>Legal Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Sales-Marketing-project"); ?>" <?php if ($keyword1 == 'Sales-Marketing') { ?> class="job_active" <?php } ?>>Sales & Marketing Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Translation-project"); ?>" <?php if ($keyword1 == 'Pune') { ?> class="job_active" <?php } ?>>Translation Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("WebsiteMobileSoftware-DevelopmentIT-Networking-project"); ?>" <?php if ($keyword1 == 'Pune') { ?> class="job_active" <?php } ?>>Website,Mobile,Software Development,IT & Networking Projects</a>
                                        </label>

                                        <label for="City" class="lbpos fw">
                                            <a href="<?php echo base_url("Writing-Content-project"); ?>" <?php if ($keyword1 == 'Pune') { ?> class="job_active" <?php } ?>>Writing & Content Projects</a>
                                        </label>

                                    </div>
                                </div>

                            </div> 
                        </div>
                        <!--COVER PIC END-->
                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="page-title">
                                <h3>
                                    Search result of 
                                        <?php
                                        if($keyword == "" && $keyword1 == ""){
                                            echo "All Projects";
                                        }
                                        elseif ($keyword != "" && $keyword1 == "") {
                                            echo '"' . $keyword . '"';
                                        } elseif ($keyword == "" && $keyword1 != "") {
                                            echo '"' . $keyword1 . '"';
                                        } else {
                                            echo '"' . $keyword . '"';
                                            echo " In ";
                                            echo '"' . $keyword1 . '"';
                                        }
                                        ?>
                                </h3>
                            </div>
                            <div class="job-contact-frnd1">
                                <div class="loader"><p style="text-align:center;"><img class="loader" src="<?php echo base_url('assets/images/loading.gif'); ?>"/></p></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
        <!-- Login  For Apply Post-->
        <div class="modal fade login" id="login_apply" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content login-frm">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <div class="right-main">
                            <div class="right-main-inner">
                                <div class="">
                                    <div class="title">
                                        <h1 class="ttc">Welcome To Aileensoul</h1>
                                    </div>

                                    <form role="form" name="login_form_apply" id="login_form_apply" method="post">

                                        <div class="form-group">
                                            <input type="email" value="<?php echo $email; ?>" name="email_login_apply" id="email_login_apply" class="form-control input-sm email_login" placeholder="Email Address*">
                                            <div id="error2" style="display:block;">
                                                <?php
                                                if ($this->session->flashdata('erroremail')) {
                                                    echo $this->session->flashdata('erroremail');
                                                }
                                                ?>
                                            </div>
                                            <div id="errorlogin_apply"></div> 
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_login_apply" id="password_login_apply" class="form-control input-sm password_login" placeholder="Password*">
                                            <input type="hidden" name="password_login_postid" id="password_login_postid" class="form-control input-sm post_id_login">

                                            <div id="error1" style="display:block;">
                                                <?php
                                                if ($this->session->flashdata('errorpass')) {
                                                    echo $this->session->flashdata('errorpass');
                                                }
                                                ?>
                                            </div>
                                            <div id="errorpass_apply"></div> 
                                        </div>

                                        <p class="pt-20 ">
                                            <button class="btn1" >Login</button>
                                        </p>

                                        <p class=" text-center">
                                            <a href="javascript:void(0)" data-toggle="modal" onclick="forgot_profile();" id="myBtn">Forgot Password ?</a>
                                        </p>

                                        <p class="pt15 text-center">
                                            Don't have an account? <a class="db-479" href="javascript:void(0);" data-toggle="modal" onclick="register_profile();">Create an account</a>
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

        <!--        <div class="modal fade register-model login" id="register" role="dialog">
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
                                                <span><select tabindex="10" class="month" name="selmonth" id="selmonth">
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
                                                <span><select tabindex="12" class="gender"  onchange="changeMe(this)" name="selgen" id="selgen">
                                                        <option value="" disabled selected value>Gender</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </span>
                                            </div>
        
                                            <p class="form-text">
                                                By Clicking on create an account button you agree our<br class="mob-none">
                                                <a href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
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
                </div>-->
        <!-- register -->
        <?php echo $footer; ?>
        <!-- script for skill textbox automatic start (option 2)-->
        <script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script  src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>

        <!-- forgot password script end -->
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
        <!-- register -->

        <div class="modal fade register-model login" id="register" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content inner-form1">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <div class="clearfix">
                            <div class="">
                                <div class="title"><h1>Join Aileensoul - It's Free</h1></div>
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
                                            <input type="hidden" name="password_login_postid" id="password_login_postid" class="form-control input-sm post_id_login">
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
                                            By Clicking on create an account button you agree our
                                            <a href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>

                                        </p>
                                        <div class="sign_in pt10">
                                            <p>
                                                Already have an account ? <a tabindex="12" id ="postid" onClick="login_profile_apply(<?php echo $post['post_id']; ?>)" href="javascript:void(0);"> Log In </a>
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
        <!-- register for apply start-->

        <div class="modal fade register-model login" id="register_apply" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <div class="clearfix">
                            <div class="col-md-12 col-sm-12">
                                <h4>Join Aileensoul - It's Free</h4>
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
                                            <input type="hidden" name="password_login_postid" id="password_login_postid" class="form-control input-sm post_id_login">
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
                                            <a href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>
                                                                                        <!--<p class="next">Next</p>-->
                                        </p>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- register for apply end -->

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
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var skill = '<?php echo $keyword; ?>';
            // var skill = skill.replace('-', ' ');
            var place = '<?php echo $keyword1; ?>';
            var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';

//            var skill = '<?php echo $this->input->get('skills'); ?>';
//            var place = '<?php echo $this->input->get('searchplace'); ?>';
//            var button = '<?php echo $this->input->get('search_submit'); ?>';

        </script>
        <!-- script for skill textbox automatic end -->
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_search_result.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_common.js?ver=' . time()); ?>"></script>
        <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/apply_search.js?ver=' . time()); ?>"></script>
    </body>
</html>



