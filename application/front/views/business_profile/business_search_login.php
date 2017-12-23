<!DOCTYPE html>
<html>
    <head>
        <!-- start head -->
        <?php echo $head; ?>
        <!-- END HEAD -->

        <title><?php echo $title; ?></title>
        
        <?php
        if (IS_BUSINESS_CSS_MINIFY == '0') {
            ?>
            <link href="<?php echo base_url('assets/css/fileinput.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/js/themes/explorer/theme.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
            <?php
        } else {
            ?>
            <link href="<?php echo base_url('assets/css_min/fileinput.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/js_min/themes/explorer/theme.css?ver=' . time()) ?>" media="all" rel="stylesheet" type="text/css"/>
        <?php } ?>
       
        
         <?php if (IS_BUSINESS_JS_MINIFY == '0') { ?>
                  <script src="<?php echo base_url('assets/js/plugins/sortable.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/fileinput.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/themes/explorer/theme.js?ver=' . time()) ?>" type="text/javascript"></script>
                    <?php } else { ?>
                  <script src="<?php echo base_url('assets/js_min/plugins/sortable.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js_min/fileinput.js?ver=' . time()) ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js_min/themes/explorer/theme.js?ver=' . time()) ?>" type="text/javascript"></script>
                    <?php } ?>
                    
       
     
   <?php
        if (IS_BUSINESS_CSS_MINIFY == '0') {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/business.css?ver=' . time()); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/1.10.3.jquery-ui.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/business.css?ver=' . time()); ?>">
        <?php } ?>

        <script>
            $(function () {
                var showTotalChar = 200, showChar = "ReadMore", hideChar = "";
                $('.showmore').each(function () {
                    var content = $(this).html();
                    if (content.length > showTotalChar) {
                        var con = content.substr(0, showTotalChar);
                        var hcon = content.substr(showTotalChar, content.length - showTotalChar);
                        var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
                        $(this).html(txt);
                    }
                });
                $(".showmoretxt").click(function () {
                    if ($(this).hasClass("sample")) {
                        $(this).removeClass("sample");
                        $(this).text(showChar);
                    } else {
                        $(this).addClass("sample");
                        $(this).text(hideChar);
                    }
                    $(this).parent().prev().toggle();
                    $(this).prev().toggle();
                    return false;
                });
            });
        </script>   

    </head>
    <!-- END HEAD -->
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
    <body class="page-container-bg-solid page-boxed botton_footer">

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

        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row row4">

                    <div class="col-md-7 col-sm-7 col-sm-push-4 col-md-push-4">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>
                                    Search result of 
                                    <?php
                                    if ($keyword != "" && $keyword1 == "") {
                                        echo '"' . $keyword . '"';
                                    } elseif ($keyword == "" && $keyword1 != "") {
                                        echo '"' . $keyword1 . '"';
                                    } else {
                                        echo '"' . $keyword . '"';
                                        echo " in ";
                                        echo '"' . $keyword1 . '"';
                                    }
                                    ?>
                                </h3>

                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <!--.........AJAX DATA......-->           
                                    </div>
                                    <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
                    <!-- Model Popup Open -->
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

                    <!-- <footer>      -->
                    <?php echo $login_footer ?>   
                        <?php echo $footer; ?>
                    <!-- </footer> -->

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
                                            <h4>Signup first and register in Business Profile</h4>
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
                                                    </select>
                                                </span>
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
                                                    </select></span>
                                                </div>

                                                <p class="form-text">
                                                    By Clicking on create an account button you agree our<br class="mob-none">
                                                    <a href="<?php echo base_url('main/terms-and-condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
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





                    <script>
                                                        var base_url = '<?php echo base_url(); ?>';
                                                        var keyword = '<?php echo $keyword; ?>';
                                                        var keyword1 = '<?php echo $keyword1; ?>';
                                                        var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                                        var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    </script>



                    <?php if (IS_BUSINESS_JS_MINIFY == '0') { ?>
                    <!--<script src="<?php //echo base_url('assets/js/jquery.wallform.js?ver='.time());     ?>"></script>-->
                    <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
                    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
                    <!-- POST BOX JAVASCRIPT END --> 
                    <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/bus_search_login.js?ver=' . time()); ?>"></script>
                    <?php } else { ?>
                    <!--<script src="<?php //echo base_url('assets/js/jquery.wallform.js?ver='.time());     ?>"></script>-->
                    <script src="<?php echo base_url('assets/js_min/bootstrap.min.js?ver=' . time()); ?>"></script>
                    <script type="text/javascript" src="<?php echo base_url('assets/js_min/jquery.validate.min.js?ver=' . time()) ?>"></script>
                    <!-- POST BOX JAVASCRIPT END --> 
                    <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/bus_search_login.min.js?ver=' . time()); ?>"></script>
                    <?php } ?>

                    </body>
                    </html>