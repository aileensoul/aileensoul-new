<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css?ver=' . time()); ?>">
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver=' . time()); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver=' . time()); ?>">
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css') ;?>" />
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
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3" style="width: 22%;"></div>
                        <div class="col-md-7 col-sm-7">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>Details </h3> 
                                    <div class=" fr rec-edit-pro">
                                        <?php

                                        function text2link($text) {
                                            $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                            $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                            $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                            return $text;
                                        }
                                        ?>      
                                    </div> 
                                    <div class="contact-frnd-post">
                                        <div class="job-contact-frnd ">
                                            <div class="profile-job-post-detail clearfix">
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital"> Basic Information</p> 
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b>Comapny Name</b> <span> <?php echo $businessdata1[0]['company_name']; ?> </span></li>
                                                            <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $businessdata1[0]['country']))->row()->country_name; ?> </span></li>
                                                            <li> <b>State</b>
                                                                <span> <?php echo $this->db->get_where('states', array('state_id' => $businessdata1[0]['state']))->row()->state_name; ?> </span>
                                                            </li>
                                                            <?php
                                                            if ($businessdata1[0]['user_id'] == $userid) {
                                                                if ($businessdata1[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> 
                                                                        <span><?php echo $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name; ?></span> 
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b> City</b> <span>
                                                                            <?php echo PROFILENA; ?>
                                                                        </span> </li>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($businessdata1[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($businessdata1[0]['user_id'] == $userid) {
                                                                if ($businessdata1[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b> Pincode:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($businessdata1[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span></li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <li> <b>Postal Address</b><span> <?php echo $businessdata1[0]['address']; ?> </span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital"> Contact Information</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b> Contact Person</b> <span> <?php echo $businessdata1[0]['contact_person']; ?> </span>
                                                                </li>
                                                                <?php
                                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                                    if ($businessdata1[0]['contact_mobile']) {
                                                                        ?>
                                                                        <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <li><b> Contact Mobile </b> <span><?php echo PROFILENA; ?></span> </li>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    if ($businessdata1[0]['contact_mobile']) {
                                                                        ?>
                                                                        <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <li><b> Contact Email</b> <span><?php echo $businessdata1[0]['contact_email']; ?></span> </li>
                                                                <?php
                                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                                    if ($businessdata1[0]['contact_website']) {
                                                                        ?>
                                                                        <li> <b>Contact Website</b><span>
                                                                                <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
                                                                        </li>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <li><b> Contact Website:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    if ($businessdata1[0]['contact_website']) {
                                                                        ?>
                                                                        <li> <b>Contact Website</b><span>
                                                                                  <!--<a href="https://<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $this->common->make_links($businessdata1[0]['contact_website']); ?></a></span>-->
                                                                                <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
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
                                                                    <li>
                                                                        <p class="details_all_tital">Professional Information</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b>Buisness  Type </b> <span><?php
                                                                        $business_typename = $this->db->get_where('business_type', array('type_id' => $businessdata1[0]['business_type']))->row()->business_name;
                                                                        if ($business_typename) {
                                                                            echo $business_typename;
                                                                        } else {
                                                                            echo $businessdata1[0]['other_business_type'];
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                                <li> <b>Category</b><span><?php
                                                                        $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                                                                        if ($category) {
                                                                            echo $category;
                                                                        } else {
                                                                            echo $businessdata1[0]['other_industrial'];
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                                <li><b>Details Of Your buisness </b> 
                                                                    <span>
                                                                        <p> <?php echo nl2br($this->common->make_links($businessdata1[0]['details']));
                                                                        ?></p>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li><p class="details_all_tital">Business Images</p> </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <div  class="buisness-profile-pic">
                                                                <?php
                                                                if (count($busimagedata) > 0) {
                                                                    if (count($busimagedata) > 3) {
                                                                        $i = 1;
                                                                        $k = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            if ($i <= 2) {
                                                                                ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">          
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                    </div>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i2">  
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                        <div class="view_bui"> 
                                                                                            <a   id="myBtn">view all</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            } $i++;
                                                                            $k++;
                                                                            if ($i == 4) {
                                                                                break;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $i = 1;
                                                                        $k = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            if ($i <= 2) {
                                                                                ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">          <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(1)" class="hover-shadow cursor">
                                                                                    </div>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">  
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                        <!-- <div class="view_bui"> <a >view all</a></div> -->


                                                                                    </div>

                                                                                </div>



                                                                                <?php
                                                                            } $i++;
                                                                            $k++;
                                                                            if ($i == 4) {
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <span style="padding: 8px;"><h7>No Image Available</h7> 

                                                                        <?php
                                                                        $userid = $this->session->userdata('aileenuser');

                                                                        if ($businessdata1[0]['user_id'] == $userid) {
                                                                            ?>
                                                                            <a href="<?php echo base_url('business_profile/image') ?>">Add Images</a>

                                                                        <?php } ?>

                                                                    </span>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="modal fade modal_popup" id="myModal" role="dialog" style="z-index: 1003">
                                                                    <div class="modal-dialog" style="width: 88%;">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Business Images</h4>
                                                                            </div>
                                                                            <div class="modal-body popup-img-popup">
                                                                                <div>
                                                                                    <?php
                                                                                    $j = 1;
                                                                                    foreach ($busimagedata as $imagemul) {
                                                                                        ?>
                                                                                        <div class="bui_popup_img"> 
                                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $imagemul['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $j; ?>)" class="hover-shadow cursor">   </div> 
                                                                                        <?php
                                                                                        $j++;
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div id="myModal1" class="modal2" style="padding-top: 7%;">


                                                                    <div class="modal-content2"> 
                                                                        <span class="close2 cursor" onclick="closeModal()">&times;</span>  
                                                                        <?php
                                                                        $i = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            ?>
                                                                            <div class="mySlides">
                                                                                <div class="numbertext"><?php echo $i ?> / <?php echo count($busimagedata); ?></div>
                                                                                <div class="slider_img">
                                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_main_upload_path') . $image['image_name']); ?> " >
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                            $i++;
                                                                        }
                                                                        ?>

                                                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                                                        <div class="caption-container">
                                                                            <p id="caption"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- popup -->
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
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
                                                <?php echo form_open_multipart(base_url('business-profile/user-image-change'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                                <input type="hidden" name="hitext" id="hitext" value="4">
                                                <div class="popup_previred">
                                                    <img id="preview" src="#" alt="your image"/>
                                                </div>
                                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                                <?php echo form_close(); ?>
                                            </div>
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

                        <!-- Model Popup Close -->
                        <?php echo $footer; ?>
                        <!-- script for skill textbox automatic start (option 2)-->
                        <!--<script src="<?php // echo base_url('js/jquery-ui.min.js?ver='.time());  ?>"></script>-->
                        <!--<script src="<?php // echo base_url('js/demo/jquery-1.9.1.js?ver='.time());  ?>"></script>-->
                        <!--<script src="<?php // echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time());  ?>"></script>-->
                        <script src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>
                        <script src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver=' . time()); ?>"></script>
                        <!-- script for business autofill -->
                        <script>
                                                            var base_url = '<?php echo base_url(); ?>';
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
                        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/followers.js?ver=' . time()); ?>"></script>
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
                        <script type="text/javascript" defer="defer" src="<?php echo base_url('js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>                        
                        </body>
                        </html>
