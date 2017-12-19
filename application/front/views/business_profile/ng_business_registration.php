<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head_profile_reg; ?>  
        <?php
        if (IS_BUSINESS_CSS_MINIFY == '0') {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/business.css?ver=' . time()); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/business_profile/business-common.min.css?ver=' . time()); ?>">
        <?php } ?>
        <style type="text/css">
            span.error{
                background: none;
                color: red !important;
                padding: 0px 10px !important;
                position: absolute;
                right: 8px;
                z-index: 8;
                line-height: 15px;
                padding-right: 0px!important;
                font-size: 11px!important;
            }
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-left > .nav-tabs > li {
                float: none;
            }
            .form_submit{
                opacity: 0.5 !important;
                pointer-events: none !important;
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
                .no-login .dob .error{bottom:-25px;}
            .no-login .gender-custom .error{bottom:-25px;}
            .no-login .job-saved-box{margin-bottom:15px;}
            .no-login .job-post-detail{margin-bottom:0;}
            .no-login .login p{font-size:14px; margin-bottom:9px;}
            .no-login .btn1{padding: 5px 20px; font-size:16px !important;}
            .no-login .inner-form1{width:560px;}
            .no-login.modal-open{overflow-y:auto;}
        </style>

    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push reg-form" ng-app="busRegApp" ng-controller="busRegController">
        <?php echo $header; ?>
        <?php if ($business_common_data[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
        <section>
            <?php
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $busdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($busdata[0]['business_step'] == 4) {
                ?> <div class="user-midd-section" id="paddingtop_fixed">
            <?php } else { ?>
                    <div class="user-midd-section" id="paddingtop_make_fixed">
                    <?php } ?>
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php /*
                          if ($busdata[0]['business_step'] == 4) {
                          ?>
                          <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_edit_title"); ?></h3></div>
                          <?php } else {
                          ?>
                          <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_title"); ?></h3></div>
                          <?php } */ ?>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 fw">
                                <div class="all-edit-profile-box business-profile">
                                    <div class="all-edit-tab">
                                        <div class="edit-progress-box">
                                            <div class="progress-line"></div>
                                            <div class="progress-line-filled"></div>
                                        </div>
                                        <ul class="left-form-each-ul">
                                            <input ng-model="busRegStep" type="hidden" value="" id="busRegStep">
                                            <li id="left-form-each-li-1">
                                                <a href="#business_information" ng-click="tab_active(1)" data-toggle="tab">
                                                    <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/basic-info.png'); ?>"></span><span class="edit-form-name">Business Information</span>
                                                </a>
                                            </li>
                                            <?php if ($business_common_data[0]['business_step'] >= '1' && $business_common_data[0]['business_step'] != '') { ?>
                                                <li id="left-form-each-li-2">
                                                    <a href="#contact_information" ng-click="tab_active(2);" data-toggle="tab">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/contact-info.png'); ?>"></span><span class="edit-form-name">Contact Information</span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li id="left-form-each-li-2"><a href="javascript:void(0);">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/contact-info.png'); ?>"></span><span class="edit-form-name">Contact Information</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($business_common_data[0]['business_step'] > '1' && $business_common_data[0]['business_step'] != '') { ?>
                                                <li id="left-form-each-li-3">
                                                    <a href="#description" ng-click="tab_active(3)" data-toggle="tab">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/discription.png'); ?>"></span><span class="edit-form-name">Description</span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li id="left-form-each-li-3">
                                                    <a href="javascript:void(0);">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/discription.png'); ?>"></span><span class="edit-form-name">Description</span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($business_common_data[0]['business_step'] > '2' && $business_common_data[0]['business_step'] != '') { ?>    
                                                <li id="left-form-each-li-4">
                                                    <a href="#business_image" ng-click="tab_active(4)" data-toggle="tab">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/upload-img.png'); ?>"></span><span class="edit-form-name">Business Images</span>
                                                    </a>
                                                </li>
                                            <?php } else { ?>
                                                <li id="left-form-each-li-4">
                                                    <a href="javascript:void(0);">
                                                        <span class="edit-pro-box"><img src="<?php echo base_url('assets/img/upload-img.png'); ?>"></span><span class="edit-form-name">Business Images</span>
                                                    </a>
                                                </li>
                                            <?php } ?> 
                                        </ul>
                                    </div>
                                    <div class="all-edit-form">
                                        <div class="common-form common-form_border">
                                            <div class="tab-content">
                                                <div class="tab-pane" id="business_information">                
                                                    <div class="">
                                                        <h3>
                                                            <?php echo $this->lang->line("business_information"); ?>
                                                        </h3>
                                                        <form name="businessinfo" id="businessinfo" class="clearfix" ng-submit="submitbusinessinfoForm()" ng-validate="busInfoValidate">
                                                            <fieldset class="full-width ">
                                                                <label>Company name:<span style="color:red">*</span></label>
                                                                <input name="companyname"  ng-model="user.companyname" tabindex="1" autofocus type="text" id="companyname" placeholder="Enter company name" value="" />
                                                                <span ng-show="errorCompanyName" class="error">{{errorCompanyName}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Country:<span style="color:red">*</span></label>
                                                                <select name="country" ng-model="user.country_id" ng-change="onCountryChange()" id="country" tabindex="2">
                                                                    <option value="" selected="selected">Country</option>
                                                                    <option data-ng-repeat='countryItem in countryList' value='{{countryItem.country_id}}'>{{countryItem.country_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorCountry" class="error">{{errorCountry}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>State:<span style="color:red">*</span></label>
                                                                <select name="state" ng-model="user.state_id" ng-change="onStateChange()" id="state" tabindex="3" ng-init="user.state_id = stateList[0].state_id">
                                                                    <option value="">Select State</option>
                                                                    <option data-ng-repeat='stateItem in stateList' value='{{stateItem.state_id}}' ng-selected="user.state_id == stateItem.state_id">{{stateItem.state_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorState" class="error">{{errorState}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label> City<span class="optional">(optional)</span>:</label>
                                                                <select name="city" ng-model="user.city_id" id="city" tabindex="4">
                                                                    <option value="">Select City</option>
                                                                    <option data-ng-repeat='cityItem in cityList' value='{{cityItem.city_id}}'>{{cityItem.city_name}}</option>             
                                                                </select>
                                                                <span ng-show="errorCity" class="error">{{errorCity}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Pincode<span class="optional">(optional)</span>:</label>
                                                                <input name="pincode" ng-model="user.pincode" tabindex="5"   type="text" id="pincode" placeholder="Enter pincode" value="">
                                                                <span ng-show="errorPincode" class="error">{{errorPincode}}</span>
                                                            </fieldset>
                                                            <fieldset class="full-width ">
                                                                <label>Postal address:<span style="color:red">*</span></label>
                                                                <input name="business_address" ng-model="user.business_address" tabindex="6" autofocus type="text" id="business_address" placeholder="Enter address" style="resize: none;" value=""/>
                                                                <span ng-show="errorPostalAddress" class="error">{{errorPostalAddress}}</span>                                                                        
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width" style="position: relative;">
                                                                <input type="submit"  id="next" name="next" tabindex="7" value="Next" >
                                                                <div class="loader-cust" ng-show="loader_show"> </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div> 
                                                <div class="tab-pane" id="contact_information"> 
                                                    <div class="">
                                                        <h3>
                                                            Contact Information
                                                        </h3>
                                                        <form name="contactinfo" ng-submit="submitcontactinfoForm()" id="contactinfo" class="clearfix" ng-validate="conInfoValidate">
                                                            <fieldset>
                                                                <label>Contact person:<span style="color:red">*</span></label>
                                                                <input name="contactname" ng-model="user.contactname" tabindex="1" autofocus type="text" id="contactname" placeholder="Enter contact name" value=""/>
                                                                <span ng-show="errorContactName" class="error">{{errorContactName}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact mobile:<span style="color:red">*</span></label>
                                                                <input name="contactmobile" ng-model="user.contactmobile" tabindex="2" autofocus type="text" id="contactmobile" placeholder="Enter contact mobile" value=""/>
                                                                <span ng-show="errorContactMobile" class="error">{{errorContactMobile}}</span>
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact email:<span style="color:red">*</span></label>
                                                                <input name="email" ng-model="user.email" tabindex="3" autofocus type="text" id="email" placeholder="Enter contact email" value=""/>
                                                                <span ng-show="errorEmail" class="error">{{errorEmail}}</span>                                                                        
                                                            </fieldset>
                                                            <fieldset>
                                                                <label>Contact website<span class="optional">(optional)</span>:</label>
                                                                <input name="contactwebsite" ng-model="user.contactwebsite" tabindex="4" autofocus type="url" id="contactwebsite" placeholder="Enter contact email" value=""/>
                                                                <span class="website_hint" style="font-size: 13px; color: #1b8ab9;">Note : <i>Enter website url with http or https</i></span>                                 
                                                                <span ng-show="errorContactWebsite" class="error">{{errorContactWebsite}}</span>                      
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width" style="position: relative;">
                                                                <input type="submit"  id="next" name="next" tabindex="5"  value="Next">
                                                                <div class="loader-cust" ng-show="loader_show"> </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="description"> 
                                                    <div class="">
                                                        <h3>
                                                            Description
                                                        </h3>
                                                        <form name="businessdis" ng-submit="submitdescriptionForm()" id="businessdis" class="clearfix" ng-validate="desValidate">
                                                            <div class="fw">
                                                                <fieldset>
                                                                    <label>Business type:<span style="color:red">*</span></label>
                                                                    <select name="business_type" ng-model="user.business_type" ng-change="busSelectCheck(this)" id="business_type" tabindex="1">
                                                                        <option value="" selected="selected">Select Business type</option>
                                                                        <option ng-repeat='businessType in business_type' value='{{businessType.type_id}}'>{{businessType.business_name}}</option>             
                                                                        <option ng-option value="0" id="busOption">Other</option>    
                                                                    </select>
                                                                    <span ng-show="errorBusinessType" class="error">{{errorBusinessType}}</span>
                                                                </fieldset>  
                                                                <div id="busDivCheck" ng-if="user.business_type == '0'">
                                                                    <fieldset class="half-width" id="other-business">
                                                                        <label> Other business type: <span style="color:red;" >*</span></label>
                                                                        <input type="text" name="bustype" ng-model="user.bustype"  tabindex="3"  id="bustype" value="<?php echo $other_business; ?>" ng-required="true">
                                                                        <span ng-show="errorOtherBusinessType" class="error">{{errorOtherBusinessType}}</span>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="fw">
                                                                <fieldset>
                                                                    <label>Category:<span style="color:red">*</span></label>
                                                                    <select name="industriyal" ng-model="user.industriyal" ng-change="indSelectCheck(this)" id="industriyal" tabindex="2">
                                                                        <option ng-option value="" selected="selected">Select Industry type</option>
                                                                        <option ng-repeat='caegoryType in industry_type' value='{{caegoryType.industry_id}}'>{{caegoryType.industry_name}}</option>             
                                                                        <option ng-option value="0" id="indOption">Other</option>
                                                                    </select>
                                                                    <span ng-show="errorCategory" class="error">{{errorCategory}}</span>
                                                                </fieldset>  

                                                                <div id="indDivCheck" ng-if="user.industriyal == '0'">
                                                                    <fieldset class="half-width" id="other-category">
                                                                        <label> Other category:<span style="color:red;" >*</span></label>
                                                                        <input type="text" name="indtype" ng-model="user.indtype" id="indtype" tabindex="4"  value="<?php echo $other_industry; ?>" ng-required="true">
                                                                        <span ng-show="errorOtherCategory" class="error">{{errorOtherCategory}}</span>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <fieldset class="full-width">
                                                                <label>Details of your business:<span style="color:red">*</span></label>
                                                                <textarea name="business_details" ng-model="user.business_details" id="business_details" rows="4" tabindex="5"  cols="50" placeholder="Enter business detail" style="resize: none;"></textarea>
                                                                <span ng-show="errorBusinessDetails" class="error">{{errorBusinessDetails}}</span>
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="hs-submit full-width" style="position: relative;">
                                                                <input type="submit"  id="next" name="next" value="Next" tabindex="6" >
                                                                <div class="loader-cust" ng-show="loader_show"> </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="tab-pane" id="business_image"> 
                                                    <div class="">
                                                        <h3>Business Images</h3>
                                                        <form name="businessimage" ng-submit="submitbusImageForm()" id="businessimage" class="clearfix" ng-validate="imageValidate">
                                                            <fieldset class="full-width">
                                                                <label>Business images<span class="optional">(optional)</span>:</label>
                                                                <input type="file" file-input="files" ng-file-model="user.image1" tabindex="1" name="image1[]" accept="image/*" id="image1" multiple/> 
                                                                <span ng-show="errorImage" class="error">{{errorImage}}</span>                                                                        
                                                            </fieldset>
                                                            <input type="hidden" name="busreg_step" ng-model="user.busreg_step" id="busreg_step" tabindex="4"  value="">
                                                            <fieldset class="full-width">
                                                                <div class="bus_image" style="color:#f00; display: block;"></div> 
                                                                <div class="bus_image_prev"></div> 
                                                            </fieldset>
                                                            <fieldset class = "hs-submit full-width">
                                                                <input type = "submit" id = "submit" name = "submit" tabindex = "2" value = "Submit">
                                                                <div class="loader-cust" ng-show="loader_show"> </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/tabs -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>

                  <!-- register -->

        <div class="modal fade login register-model" id="register" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content inner-form1">
                    <!-- <button type="button" class="modal-close" data-dismiss="modal">&times;</button>          -->
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
                                       <span> <select tabindex="9" class="day" name="selday" id="selday">
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
                                        <span>
                                        <select tabindex="12" class="gender"  onchange="changeMe(this)" name="selgen" id="selgen">
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
                                    <div class="sign_in pt10">
                                        <p>
                                            Already have an account ? <a tabindex="12" onclick="login_data();" href="javascript:void(0);"> Log In </a>
                                        </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- Model Popup Close -->


 <!-- Login  -->
        <div class="modal login fade" id="login" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content login-frm">
                    <!-- <button type="button" class="modal-close" data-dismiss="modal">&times;</button>          -->
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

         <div id="forgotPassword" class="modal">
                <div class="modal-content md-2">
                    <?php
                    $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
                    echo form_open('profile/forgot_password', $form_attribute);
                    ?>
                    <div class="modal-header" style=" text-align: center;">
                        <button type="button" class="modal-close" data-dismiss="modal">&times;</button>  
                        <label style="color: #a0b3b0;">Forgot Password</label>
                    </div>
                    <div class="modal-body" style="text-align: center;padding: 15px!important;">
                        <label  style="margin-bottom: 15px; color: #a0b3b0;"> Enter your e-mail address below to get your password.</label>
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
                    <div class="modal-footer ">
                        <div class="submit_btn">              
                            <input class="btn btn-theme btn1" type="submit" name="submit" value="Submit" style="width:200px; margin-top:15px;" onclick="submit_forgot();"/> 
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        <!-- model for forgot password end -->


        <?php echo $login_footer ?>
        <?php echo $footer; ?>
          <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/angular-validate.min.js?ver=' . time()) ?>"></script>
      
        <script>
        var base_url = '<?php echo base_url(); ?>';
        var slug = '<?php echo $slugid; ?>';
        var reg_uri = '<?php echo $reg_uri ?>';
        var company_name_validation = '<?php echo $this->lang->line('company_name_validation') ?>';
       var country_validation = '<?php echo $this->lang->line('country_validation') ?>';
       var state_validation = '<?php echo $this->lang->line('state_validation') ?>';
       var address_validation = '<?php echo $this->lang->line('address_validation') ?>';
       var profile_login = '<?php echo $profile_login; ?>';
       var user_id = '<?php echo $this->session->userdata('aileenuser');?>';
        </script>
        <script>

jQuery(document).ready(function ($) {

    if(profile_login == 'live'){

        $('#register').modal('show');
  }

});

function login_data() { 
                $('#login').modal('show');
                $('#register').modal('hide');

}

function forgot_profile() {
                $('#forgotPassword').modal('show');
}
 function register_profile() {
                $('#login').modal('hide');
                $('#register').modal('show');
}


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
                                //url: "<?php echo site_url() . 'registration/check_email' ?>",
                                url: base_url + "registration/check_email",
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
                       // url: '<?php echo base_url() ?>registration/reg_insert',
                        url: base_url + "registration/reg_insert",
                        dataType: 'json',
                        data: post_data,
                        beforeSend: function ()
                        {
                            $("#register_error").fadeOut();
                            $("#btn1").html('Create an account ...');
                        },
                        success: function (response)
                        {
                            if (response.okmsg == "ok") {  
                               //  $('#register').modal('hide');
                              //  window.location = "<?php echo base_url()?>artist/profile";
                               window.location = base_url + "business-profile/business-information";

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


function submit_forgot(){
   
   var x = document.getElementById("forgot_email").value;
   if(x != ''){
    $('#forgotPassword').modal('hide');
    event.preventDefault();
  }
}

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
                        //url: '<?php echo base_url() ?>registration/user_check_login',
                        url: base_url + "registration/user_check_login",
                        data: post_data,
                        dataType: "json",
                        beforeSend: function ()
                        {
                            $("#error").fadeOut();
                            $("#btn1").html('Login');
                        },
                        success: function (response)
                        { 
                            if (response.data == "ok") {                              
                                window.location = base_url + "business-profile/business-information";                              
                            }else if (response.is_artistic == 1) {
                                window.location = base_url + "business-profile/business-information";
                               // window.location = "<?php echo base_url() ?>artist/profile";
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




                    // Defining angularjs application.
                    var busRegApp = angular.module('busRegApp', ['ngValidate']);
                    busRegApp.directive("fileInput", function ($parse) {
                        return{
                            link: function ($scope, element, attrs) {
                                element.on("change", function (event) {
                                    var files = event.target.files;
                                    $parse(attrs.fileInput).assign($scope, element[0].files);
                                    $scope.$apply();
                                });
                            }
                        }
                    });
                    busRegApp.controller('busRegController', function ($scope, $http) {
                        $scope.user = {};
                        $scope.countryList = undefined;
                        $scope.stateList = undefined;
                        $scope.cityList = undefined;
                        $scope.loader_show = false;
                        $scope.tab_active = function (data) {
                            var title;
                            var url;
                            if (data == 1) {
                                history.pushState('Business information', 'Business information', 'business-information');
                                activeBusinessInformation();
                            } else if (data == 2) {
                                history.pushState('Contact information', 'Contact information', 'contact-information');
                                activeContactInformation();
                            } else if (data == 3) {
                                history.pushState('Description', 'Description', 'description');
                                activeDescription();
                            } else if (data == 4) {
                                history.pushState('Business image', 'Business image', 'image');
                                activeImage();
                            }
                            if (typeof (history.pushState) != "undefined") {
                                var obj = {Title: title, Url: url};
                                history.pushState(obj, obj.Title, obj.Url);
                                $(".common-form_border").load(url);
                            } else {
                                alert("Browser does not support HTML5.");
                            }
                        }

                        function activeBusinessInformation() {
                            $('.progress-line-filled').removeClass('step1 step2 step3 step4');
                            $('.progress-line-filled').addClass('step1');
                            $('ul.left-form-each-ul li').removeClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-1').addClass('active filled-box');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(1)').addClass('active');
                            getCountry();
                            getBusinessInformation();
                        }
                        function activeContactInformation() {
                            $('.progress-line-filled').removeClass('step1 step2 step3 step4');
                            $('.progress-line-filled').addClass('step2');
                            $('ul.left-form-each-ul li').removeClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-1').addClass('filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-2').addClass('active filled-box');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(2)').addClass('active');
                            getContactInformation();
                        }
                        function activeDescription() {
                            $('.progress-line-filled').removeClass('step1 step2 step3 step4');
                            $('.progress-line-filled').addClass('step3');
                            $('ul.left-form-each-ul li').removeClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-3').addClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-1').addClass('filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-2').addClass('filled-box');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(3)').addClass('active');
                            getDescription();
                        }
                        function activeImage() {
                            $('.progress-line-filled').removeClass('step1 step2 step3 step4');
                            $('.progress-line-filled').addClass('step4');
                            $('ul.left-form-each-ul li').removeClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-4').addClass('active filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-1').addClass('filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-2').addClass('filled-box');
                            $('ul.left-form-each-ul li#left-form-each-li-3').addClass('filled-box');
                            $('.tab-content .tab-pane').removeClass('active');
                            $('.tab-content .tab-pane:nth-child(4)').addClass('active');
                            getImage();
                        }
                        if (reg_uri == 'business-information') {
                            activeBusinessInformation();
                        } else if (reg_uri == 'contact-information') {
                            activeContactInformation();
                        } else if (reg_uri == 'description') {
                            activeDescription();
                        } else if (reg_uri == 'image') {
                            activeImage();
                        }
                        $(window).bind('popstate', function () {
                            window.location.href = window.location.href;
                        });
                        function getCountry() {
                            $http({
                                method: 'GET',
                                url: base_url + 'business_profile_registration/getCountry',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                $scope.countryList = data;
                            });
                        }
                        $scope.getCountry = function () {
                            getCountry();
                        };
                        function select_color_change() {
                            var selected_val = $('select').val();
                            if (selected_val == '') {
                                $('select').css('color', '#acacac');
                            } else {
                                $('select').css('color', 'black');
                            }
                        }

                        function onCountryChange(country_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getStateByCountryId',
                                data: {countryId: country_id}
                            }).success(function (data) {
                                $scope.stateList = data;
                                $("#state").find("option").eq(0).remove();
                                select_color_change();
                            });
                        }
                        function onCountryChange1(country_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getStateByCountryId',
                                data: {countryId: country_id}
                            }).success(function (data) {
                                if (angular.isDefined($scope.user.state_id)) {
                                    delete $scope.user.state_id;
                                }
                                $scope.user.state_id = "";
                                $scope.stateList = data;
                                //$("#state").find("option").eq(0).remove();
                                select_color_change();
                            });
                        }

                        $scope.onCountryChange = function () {
                            $scope.countryIdVal = $scope.user.country_id;
                            onCountryChange1($scope.countryIdVal);
                            //$("#city").find("option").eq(0).remove();
                            $scope.user.city_id = "";
                        };
                        function onStateChange(state_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getCityByStateId',
                                data: {stateId: state_id}
                            }).success(function (data) {
                                $scope.cityList = data;
                            });
                        }
                        function onStateChange1(state_id = '') {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getCityByStateId',
                                data: {stateId: state_id}
                            }).success(function (data) {
                                if (angular.isDefined($scope.user.city_id)) {
                                    delete $scope.user.city_id;
                                }
                                $scope.cityList = data;
                            });
                        }

                        $scope.onStateChange = function () {
                            $scope.stateIdVal = $scope.user.state_id;
                            onStateChange1($scope.stateIdVal);
                        };
                        function getBusinessInformation() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getBusinessInformation',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                if (data[0]) {
                                    onCountryChange(data[0].country);
                                    onStateChange(data[0].state);
                                    $scope.user.companyname = data[0].company_name;
                                    $scope.user.country_id = data[0].country;
                                    $scope.user.state_id = data[0].state;
                                    $scope.user.city_id = data[0].city;
                                    $scope.user.pincode = data[0].pincode;
                                    $scope.user.business_address = data[0].address;
                                    $scope.user.busreg_step = data[0].business_step;
                                    $scope.busRegStep = data[0].business_step;
                                }
                            });
                        }
                        $scope.getBusinessInformation = function () {
                            getBusinessInformation();
                        };
                        function getContactInformation() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getContactInformation',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                if (data[0]) {
                                    $scope.user.contactname = data[0].contact_person;
                                    $scope.user.contactmobile = data[0].contact_mobile;
                                    $scope.user.email = data[0].contact_email;
                                    $scope.user.contactwebsite = data[0].contact_website;
                                    $scope.user.busreg_step = data[0].business_step;
                                } else {
                                    $scope.tab_active(1);
                                    activeBusinessInformation();
                                }
                            });
                        }
                        ;
                        $scope.getContactInformation = function () {
                            getContactInformation();
                        };
                        function getDescription() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getDescription',
                                headers: {'Content-Type': 'application/json'},
                            }).success(function (data) {
                                if (data['userdata'][0]) {
                                    if (data['userdata'][0].business_step >= '2') {
                                        $scope.user.business_type = data['userdata'][0].business_type;
                                        $scope.user.industriyal = data['userdata'][0].industriyal;
                                        $scope.user.business_details = data['userdata'][0].details;
                                        $scope.user.bustype = data['userdata'][0].other_business_type;
                                        $scope.user.indtype = data['userdata'][0].other_industrial;
                                        $scope.user.busreg_step = data['userdata'][0].business_step;
                                        $scope.business_type = data['business_type'];
                                        $scope.industry_type = data['industriyaldata'];
                                    } else if (data['userdata'][0].business_step == '1') {
                                        $scope.tab_active(2);
                                        activeContactInformation();
                                    } else {
                                        $scope.tab_active(1);
                                        activeBusinessInformation();
                                    }
                                } else {
                                    $scope.tab_active(1);
                                    activeBusinessInformation();
                                }
                            });
                        }
                        ;
                        $scope.getDescription = function () {
                            getDescription();
                        };
                        function getImage() {
                            $http({
                                method: 'POST',
                                url: base_url + 'business_profile_registration/getImage',
                            }).success(function (data) {
                                if (data.business_step >= '3') {
                                    $('.bus_image_prev').html(data['busImageDetail']);
                                } else if (data.business_step == '2') {
                                    $scope.tab_active(3);
                                    activeDescription();
                                } else if (data.business_step == '1') {
                                    $scope.tab_active(2);
                                    activeContactInformation();
                                } else {
                                    $scope.tab_active(1);
                                    activeBusinessInformation();
                                }
                            });
                        }
                        ;
                        $scope.getImage = function () {
                            getImage();
                        };
                        //validation for edit email formate form
                        $.validator.addMethod("regx", function (value, element, regexpr) {
                            if (!value)
                            {
                                return true;
                            } else
                            {
                                return regexpr.test(value);
                            }
                        }, "Only space, only number and only special characters are not allow");
                        $.validator.addMethod("regx1", function (value, element, regexpr) {
                            if (!value)
                            {
                                return true;
                            } else
                            {
                                return regexpr.test(value);
                            }
                        }, "You can use letters(a-z), numbers, and periods.");
                        $scope.busInfoValidate = {
                            rules: {
                                companyname: {
                                    required: true,
                                    regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                                },
                                country: {
                                    required: true,
                                },
                                state: {
                                    required: true,
                                },
                                business_address: {
                                    required: true,
                                    regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                                }
                            },
                            messages: {
                                companyname: {
                                    required: company_name_validation,
                                },
                                country: {
                                    required: country_validation,
                                },
                                state: {
                                    required: state_validation,
                                },
                                business_address: {
                                    required: address_validation,
                                }
                            }
                        };
                        // calling our submit function.
                        $scope.submitbusinessinfoForm = function () {
                            if ($scope.businessinfo.validate()) {
                                // Posting data to php file
                                angular.element('#businessinfo #next').addClass("form_submit");
                                $scope.loader_show = true;
                                $http({
                                    method: 'POST',
                                    url: base_url + 'business_profile_registration/ng_bus_info_insert',
                                    data: $scope.user, //forms user object
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .success(function (data) {
                                            if (data.errors) {
                                                // Showing errors.
                                                $scope.errorCompanyName = data.errors.companyname;
                                                $scope.errorCountry = data.errors.country;
                                                $scope.errorState = data.errors.state;
                                                $scope.errorCity = data.errors.city;
                                                $scope.errorPincode = data.errors.pincode;
                                                $scope.errorPostalAddress = data.errors.business_address;
                                            } else {
                                                if (data.is_success == '1') {
                                                    angular.element('#businessinfo #next').removeClass("form_submit");
                                                    $scope.loader_show = false;
                                                    activeContactInformation();
                                                    $scope.tab_active(2);
                                                    $("li#left-form-each-li-2 a").attr({
                                                        href: "#contact_information",
                                                        'data-toggle': "tab",
                                                        'ng-click': "getContactInformation(); tab_active(2);"
                                                    });
                                                } else {
                                                    return false;
                                                }
                                            }
                                        });
                            } else {
                                return false;
                            }

                        };
                        $.validator.addMethod("regx2", function (value, element, regexpr) {
                            if (!value)
                            {
                                return true;
                            } else
                            {
                                return regexpr.test(value);
                            }
                        }, "please enter valid mobile number.");
                        $scope.conInfoValidate = {
                            rules: {
                                contactname: {
                                    required: true,
                                    regx: /^[a-zA-Z\s]*[a-zA-Z]/
                                },
                                contactmobile: {
                                    required: true,
                                    number: true,
                                    minlength: 8,
                                    maxlength: 15,
                                    regx2: /^[1-9][0-9]*/
                                },
                                email: {
                                    required: true,
                                    email: true,
                                    //    regx1: /^[a-zA-Z0-9.@]+$/
                                }
                            },
                            messages: {
                                contactname: {
                                    required: "Person name is required.",
                                },
                                contactmobile: {
                                    required: "Mobile number is required.",
                                },
                                email: {
                                    required: "Email id is required.",
                                    email: "Please enter valid email id.",
                                }
                            }
                        };
                        $scope.submitcontactinfoForm = function () {
                            if ($scope.contactinfo.validate()) {
                                // Posting data to php file
                                angular.element('#contactinfo #next').addClass("form_submit");
                                $scope.loader_show = true;
                                $http({
                                    method: 'POST',
                                    url: base_url + 'business_profile_registration/ng_contact_info_insert',
                                    data: $scope.user, //forms user object
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .success(function (data) {
                                            if (data.errors) {
                                                // Showing errors.
                                                $scope.errorContactName = data.errors.contactname;
                                                $scope.errorContactMobile = data.errors.contactmobile;
                                                $scope.errorEmail = data.errors.email;
                                                $scope.errorCity = data.errors.city;
                                                $scope.errorContactWebsite = data.errors.contactwebsite;
                                            } else {
                                                if (data.is_success == '1') {
                                                    angular.element('#contactinfo #next').removeClass("form_submit");
                                                    $scope.loader_show = false;
                                                    activeDescription();
                                                    $scope.tab_active(3);
                                                    $("li#left-form-each-li-3 a").attr({
                                                        href: "#description",
                                                        'data-toggle': "tab",
                                                        'ng-click': "getDescription(); tab_active(3)"
                                                    });
                                                } else {
                                                    return false;
                                                }
                                                //$scope.message = data.message;
                                            }
                                        });
                            } else {
                                return false;
                            }

                        };
                        $scope.desValidate = {
                            rules: {
                                business_type: {
                                    required: true,
                                },
                                industriyal: {
                                    required: true,
                                },
                                business_details: {
                                    required: true,
                                    regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                                },
                            },
                            messages: {
                                business_type: {
                                    required: "Business type is required.",
                                },
                                industriyal: {
                                    required: "Industrial is required.",
                                },
                                business_details: {
                                    required: "Business details is required.",
                                },
                            }
                        };
                        $scope.submitdescriptionForm = function () {
                            if ($scope.businessdis.validate()) {
                                // Posting data to php file
                                angular.element('#businessdis #next').addClass("form_submit");
                                $scope.loader_show = true;
                                $http({
                                    method: 'POST',
                                    url: base_url + 'business_profile_registration/ng_description_insert',
                                    data: $scope.user, //forms user object
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .success(function (data) {
                                            if (data.errors) {
                                                // Showing errors.
                                                $scope.errorBusinessType = data.errors.business_type;
                                                $scope.errorCategory = data.errors.industriyal;
                                                $scope.errorOtherBusinessType = data.errors.bustype;
                                                $scope.errorOtherCategory = data.errors.indtype;
                                                $scope.errorBusinessDetails = data.errors.business_details;
                                            } else {
                                                if (data.is_success == '1') {
                                                    angular.element('#businessdis #next').removeClass("form_submit");
                                                    $scope.loader_show = false;
                                                    activeImage();
                                                    $scope.tab_active(4);
                                                    $("li#left-form-each-li-4 a").attr({
                                                        href: "#business_image",
                                                        'data-toggle': "tab",
                                                        'ng-click': "getImage(); tab_active(4)"
                                                    });
                                                } else {
                                                    return false;
                                                }
                                                //$scope.message = data.message;
                                            }
                                        });
                            } else {
                                return false;
                            }

                        };
                        $scope.submitbusImageForm = function () {
                            var form_data = new FormData();
                            angular.element('#businessimage #next').addClass("form_submit");
                            $scope.loader_show = true;
                            angular.forEach($scope.files, function (file) {
                                form_data.append('image1[]', file);
                            });
                            $http.post(base_url + 'business_profile_registration/ng_image_insert', form_data,
                                    {
                                        transformRequest: angular.identity,
                                        headers: {'Content-Type': undefined, 'Process-Data': false}
                                    }).success(function (data) {
                                if (data.errors) {
                                    // Showing errors.
                                    $scope.errorImage = data.errors.image1;
                                } else {
                                    if (data.is_success == '1') {
                                        angular.element('#businessimage #next').removeClass("form_submit");
                                        $scope.loader_show = false;
                                        window.location.href = base_url + 'business-profile/home';
                                    } else {
                                        return false;
                                    }
                                }
                            });
                        }
                    });
                    function delete_bus_image(image_id) {
                        $.ajax({
                            type: 'POST',
                            url: base_url + "business_profile_registration/bus_img_delete",
                            data: 'image_id=' + image_id,
                            success: function (data) {
                                if (data) {
                                    $('.job_work_edit_' + image_id).remove();
                                }
                            }
                        });
                    }
                    $('select').on('change', function () {
                        if ($(this).val()) {
                            $(this).css('color', 'black');
                        } else {
                            $(this).css('color', '#acacac');
                        }
                    });
                    $(document).ready(function () {
                        var selected_val = $('select').val();
                        if (selected_val == '') {
                            $('select').css('color', '#acacac');
                        } else {
                            $('select').css('color', 'black');
                        }
                    });
        </script>
<?php
if (IS_BUSINESS_JS_MINIFY == '0') {
    ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/business-profile/information.js?ver=' . time()); ?>"></script>
                                                                                                                                                                                                                                                                                                                                                                                                                                    <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>-->
        <?php } else {
            ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js_min/webpage/business-profile/information.min.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/business-profile/common.min.js?ver=' . time()); ?>"></script>
<?php }
?>
    </body>
</html>
