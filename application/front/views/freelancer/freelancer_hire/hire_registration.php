
<!DOCTYPE html>
<html>
    <head>
        <!-- start head -->
        <?php echo $head; ?>
        <!-- Calender Css Start-->

        <title>Freelancer Profile - Aileensoul.com</title>

        <!-- Calender Css End-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-apply.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver=' . time()); ?>">
        <!-- This Css is used for call popup -->


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


            /*second*/

        </style>

    </head>
    <!-- END HEAD -->

    <!-- start header -->
    <?php echo $header; ?>
    <!-- END HEADER -->
    <body>
        <section>
            <div class="user-midd-section " id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="clearfix">
                            <div class="job_reg_page_fprm">

                                <div class="common-form job_reg_main">
                                    <h3>Welcome In Employer Profile</h3>
                                    <?php echo form_open(base_url('freelancer/hire_registation_insert'), array('id' => 'freelancerhire_regform', 'name' => 'freelancerhire_regform', 'class' => 'clearfix')); ?>
                                    <fieldset>
                                        <label >First Name <font  color="red">*</font> :</label>                          
                                        <input type="text" name="firstname" id="firstname" tabindex="1" placeholder="Enter first name" style="text-transform: capitalize;" onfocus="var temp_value = this.value; this.value = ''; this.value = temp_value" value="<?php echo  $userdata[0]['first_name']; ?>" maxlength="35">
                                        <?php
                                        echo form_error('firstname');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Last Name <font  color="red">*</font>:</label>
                                        <input type="text" name="lastname" id="lastname" tabindex="2" placeholder="Enter last name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="<?php echo $userdata[0]['last_name']; ?>" maxlength="35">
                                        <?php
                                        echo form_error('lastname');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Email Address <font  color="red">*</font> :</label>
                                        <input type="email" name="email_reg1" id="email_reg1" tabindex="3" placeholder="Enter email address" value="<?php  echo $userdata[0]['user_email']; ?>" maxlength="255">
                                        <?php
                                        echo form_error('email');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Phone number:<span class="optional">(optional)</span></label>
                                        <input type="text" name="phoneno" id="phoneno" tabindex="4" placeholder="Enter phone number" value="" maxlength="255">
                                       
                                    </fieldset>

                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label>Country:<span style="color:red">*</span></label>								
                                        <select name="country" id="country" tabindex="5">
                                            <option value="">Select country</option>
                                            <?php
                                            if (count($countries) > 0) {
                                                foreach ($countries as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select><span id="country-error"></span>
                                        <?php echo form_error('country'); ?>
                                    </fieldset> 

                                    <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                        <label>state:<span style="color:red">*</span></label>
                                        <select name="state" id="state" tabindex="6">
                                            <?php
                                            if ($state1) {
                                                foreach ($states as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else {
                                                ?>
                                                <option value="">Select country first</option>
                                                <?php
                                            }
                                            ?>
                                        </select><span id="state-error"></span>
                                        <?php echo form_error('state'); ?>
                                    </fieldset> 

                                    <fieldset class="fw" <?php if ($city) { ?> class="error-msg" <?php } ?>>
                                        <label> City:<span style="color:red">*</span></label>
                                        <select name="city" id="city" tabindex="7">
                                            <?php
                                            if ($city1) {
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else if ($state1) {
                                                ?>
                                                <option value="">Select city</option>
                                                <?php
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value="">Select state first</option>
                                                <?php
                                            }
                                            ?>
                                        </select><span id="city-error"></span>
                                        <?php echo form_error('city'); ?>
                                    </fieldset>                              

                                      <fieldset class="full-width <?php if ($professional_info) { ?> error-msg <?php } ?>">
                                    <label><?php echo $this->lang->line("professional_info"); ?>:<span class="optional">(optional)</span></label>
                                    <textarea tabindex="8"  name ="professional_info" tabindex="8" id="professional_info" rows="4" cols="50" placeholder="Enter professional information" style="resize: none;overflow: auto;" onpaste="OnPaste_StripFormatting(this, event);" onfocus="var temp_value = this.value; this.value = ''; this.value = temp_value"></textarea>
                                    <?php echo form_error('professional_info'); ?> 
                                </fieldset>

                                    <fieldset class=" full-width">
                                        <div class="job_reg">
                                           <!--<input type="reset">-->
                                            <input title="Register" type="submit" id="submit"  tabindex="9" name="" value="Register">
                                        </div>
                                    </fieldset>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END CONTAINER -->

        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror custom-message in" id="bidmodal" role="dialog"  >
            <div class="modal-dialog modal-lm" >
                <div class="modal-content message">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
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
                                            <a href="<?php echo base_url('main/terms-and-condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('privacy-policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>
                                                                                        <!--<p class="next">Next</p>-->
                                        </p>
                                        <div class="sign_in pt10">
                                            <p>
                                                Already have an account ? <a tabindex="12" onClick="login_profile_apply(<?php echo $post['post_id']; ?>)" href="javascript:void(0);"> Log In </a>
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
        
        
        <!-- <footer>        -->
        <?php echo $login_footer ?> 
        <?php echo $footer; ?>
        <!-- </footer> -->
        <script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/hire_registration.js?ver=' . time()); ?>"></script>

        <script>
//                                        var get_csrf_token_name = '<?php //echo $this->security->get_csrf_token_name(); ?>';
//                                        var csrf_hash = '<?php //echo $this->security->get_csrf_hash(); ?>';
                                        var base_url = '<?php echo base_url(); ?>';
                                        var site = '<?php echo base_url(); ?>';
                                        var user_session = '<?php echo $this->session->userdata('aileenuser'); ?>';
        </script>



<script type="text/javascript">

$('select').on('change', function() {
  if ($(this).val()){ 
    $(this).css('color', 'black');
  } 
  else{ 
     $(this).css('color', '#acacac');
  }
})

</script>
    </body>
</html>