<!DOCTYPE html>
<html>
    <head>
        <?php echo $head; ?>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style-main.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/recruiter.css'); ?>">
    </head>
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
        .ttc{text-transform:capitalize !important; text-align: center;}
        /*.login-frm{width:480px !important;}*/
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
    <body class="page-container-bg-solid page-boxed no-login freeh3 cust-add-live">
           <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-3 col-xs-4 left-header fw-479">
                        <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                    </div>
                    <div class="col-md-8 col-sm-9 col-xs-8 right-header fw-479">
                        <div class="btn-right pull-right">
                            <a href="javascript:void(0);" onclick="login_profile();" class="btn2">Login</a>
                            <a href="javascript:void(0);" onclick="register_profile();" class="btn3">Creat an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-sm-1"> 
                            <div  class="add-post-button">


                            </div></div>
                        <div class="col-md-8 col-sm-10">

                            <div>
                                <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                            </div> 

                            <div class="common-form custom-form">
                                    <h3 class="col-chang"><?php echo $this->lang->line("project_post"); ?></h3>

                                    <div class="job-saved-box">

                                        <?php echo form_open(base_url('freelancer/freelancer_add_post_insert'), array('id' => 'postinfo', 'name' => 'postinfo', 'class' => 'clearfix form_addedit', 'onsubmit' => "imgval()")); ?>

                                        <!--                                    <div>
                                                                                <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> 
                                                                                <span style="color:#7f7f7e"><?php //ceho $this->lang->line("filed_required");    ?></span>
                                                                            </div>-->
                                        <?php
                                        $post_name = form_error('post_name');
                                        $skills = form_error('skills');
                                        $post_desc = form_error('post_desc');
                                        ?>
                                        <div class="custom-add-box">
                                            <h3 class="freelancer_editpost_title"><?php echo $this->lang->line("project_description"); ?></h3>
                                            <div class="p15 fw">
                                                <fieldset class="full-width" <?php if ($post_name) { ?> class="error-msg" <?php } ?>>
                                                    <label ><?php echo $this->lang->line("project_title"); ?>:<span style="color:red">*</span></label>                 
                                                    <input name="post_name" type="text" maxlength="100" id="post_name" autofocus tabindex="1" placeholder="Enter project name"/>
                                                    <span id="fullname-error"></span>
                                                    <?php echo form_error('post_name'); ?>
                                                </fieldset>
                                                <fieldset class="full-width">
                                                    <label><?php echo $this->lang->line("project_description"); ?> :<span style="color:red">*</span></label>
                                                    <textarea class="add-post-textarea" name="post_desc" id="post_desc" placeholder="Enter description" tabindex="2" onpaste="OnPaste_StripFormatting(this, event);"></textarea>
                                                    <?php echo form_error('post_desc'); ?>
                                                </fieldset>
                                                <fieldset class="full-width" <?php if ($skills) { ?> class="error-msg" <?php } ?>>
                                                    <label><?php echo $this->lang->line("skill_of_requirement"); ?>:<span style="color:red">*</span></label>
                                                    <input id="skills2" name="skills" tabindex="3" size="90" placeholder="Enter skills">
                                                    <span id="fullname-error"></span>
                                                    <?php echo form_error('skills'); ?>
                                                </fieldset>
                                                <fieldset class="full-width" <?php if ($fields_req) { ?> class="error-msg" <?php } ?>>
                                                    <label><?php echo $this->lang->line("field_of_requirement"); ?>:<span style="color:red">*</span></label>
                                                    <select tabindex="4" name="fields_req" id="fields_req" class="field_other">
                                                        <option  value="" selected option disabled><?php echo $this->lang->line("select_filed"); ?></option>
                                                        <?php
                                                        if (count($category_data) > 0) {
                                                            foreach ($category_data as $cnt) {
                                                                if ($fields_req1) {
                                                                    ?>
                                                                    <option value="<?php echo $cnt['category_id']; ?>" <?php if ($cnt['category_id'] == $fields_req1) echo 'selected'; ?>><?php echo $cnt['category_name']; ?></option>
                                                                    <?php
                                                                }
                                                                else {
                                                                    ?>
                                                                    <option value="<?php echo $cnt['category_id']; ?>"><?php echo $cnt['category_name']; ?></option> 
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <option value="<?php echo $category_otherdata[0]['category_id']; ?> "><?php echo $category_otherdata[0]['category_name']; ?></option>
                                                    </select>
                                                    <?php echo form_error('fields_req'); ?>
                                                </fieldset>
                                                <!--                                    <fieldset class="full-width" <?php if ($other_skill) { ?> class="error-msg" <?php } ?> >
<label class="control-label"><?php echo $this->lang->line("other_skill"); ?>:</label>
<input name="other_skill" class="keyskil"  type="text" id="other_skill" tabindex="5" placeholder="Enter Your Other Skill" />
<span id="fullname-error"></span>
                                                <?php echo form_error('other_skill'); ?>
</fieldset>-->

                                                <fieldset class="full-width two-select-box fullwidth_experience" <?php if ($month) { ?> class="error-msg" <?php } ?> class="two-select-box"> 
                                                    <label><?php echo $this->lang->line("required_experiance"); ?>:<span class="optional">(optional)</span></label>
                                                    <select tabindex="5" name="year" id="year">
                                                        <option value="" selected option disabled><?php echo $this->lang->line("year"); ?></option>
                                                        <option value="0">0 Year</option>
                                                        <option value="1">1 Year</option>
                                                        <option value="2">2 Year</option>
                                                        <option value="3">3 Year</option>
                                                        <option value="4">4 Year</option>
                                                        <option value="5">5 Year</option>
                                                        <option value="6">6 Year</option>
                                                        <option value="7">7 Year</option>
                                                        <option value="8">8 Year</option>
                                                        <option value="9">9 Year</option>
                                                        <option value="10">10 Year</option>
                                                        <option value="11">11 Year</option>
                                                        <option value="12">12 Year</option>
                                                        <option value="13">13 Year</option>
                                                        <option value="14">14 Year</option>
                                                        <option value="15">15 Year</option>
                                                        <option value="16">16 Year</option>
                                                        <option value="17">17 Year</option>
                                                        <option value="18">18 Year</option>
                                                        <option value="19">19 Year</option>
                                                        <option value="20">20 Year</option>
                                                    </select>
                                                    <span id="fullname-error"></span>
                                                    <?php echo form_error('year'); ?>

                                                    <select class="margin-month " tabindex="6" name="month" id="month">
                                                        <option value="" selected option disabled><?php echo $this->lang->line("month"); ?></option>
                                                        <option value="0">0 Month</option>
                                                        <option value="1">1 Month</option>
                                                        <option value="2">2 Month</option>
                                                        <option value="3">3 Month</option>
                                                        <option value="4">4 Month</option>
                                                        <option value="5">5 Month</option>
                                                        <option value="6">6 Month</option>
                                                    </select>
                                                    <?php echo form_error('month'); ?>
                                                </fieldset>
                                                <fieldset class="col-md-6 pl10" <?php if ($est_time) { ?> class="error-msg" <?php } ?>>
                                                    <label><?php echo $this->lang->line("time_of_project"); ?>:<span class="optional">(optional)</span></label>
                                                    <input tabindex="7" name="est_time" type="text" id="est_time" placeholder="Enter estimated time in month/year" /><span id="fullname-error"></span>
                                                    <?php echo form_error('est_time'); ?>
                                                </fieldset>           
                                                <fieldset <?php if ($last_date) { ?> class="error-msg" <?php } ?>>
                                                    <label><?php echo $this->lang->line("last_date_apply"); ?>:<span style="color:red">*</span></label>
                                                    <input type="hidden" id="example2">
                                                    <?php echo form_error('last_date'); ?> 
                                                </fieldset>


                                            </div>
                                        </div>
                                        <div class="custom-add-box">
                                            <h3 class="freelancer_editpost_title"><?php echo $this->lang->line("payment"); ?></h3>
                                            <div class="p15 fw">
                                                <fieldset  class="col-md-6 pl10" <?php if ($rate) { ?> class="error-msg" <?php } ?> >
                                                    <label  class="control-label"><?php echo $this->lang->line("rate"); ?>:<span class="optional">(optional)</span></label>
                                                    <input tabindex="11" name="rate" type="text" id="rate" placeholder="Enter your rate"/>
                                                    <span id="fullname-error"></span>
                                                    <?php echo form_error('rate'); ?>
                                                </fieldset>
                                                <fieldset class="col-md-6" <?php if ($csurrency) { ?> class="error-msg" <?php } ?> class="two-select-box"> 
                                                    <label><?php echo $this->lang->line("currency"); ?>:<span class="optional">(optional)</span></label>
                                                    <select tabindex="12" name="currency" id="currency">
                                                        <option  value="" selected option disabled><?php echo $this->lang->line("select_currency"); ?></option>
                                                        <?php foreach ($currency as $cur) { ?>
                                                            <option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['currency_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <?php echo form_error('currency'); ?>
                                                </fieldset>
                                                <fieldset class="col-md-12 pl10 work_type_custom">
                                                    <label class=""><?php echo $this->lang->line("work_type"); ?>:<span class="optional">(optional)</span></label><input type="radio" tabindex="13" class="worktype_minheight" name="rating" value="0" checked> Hourly
                                                    <input type="radio" tabindex="14"  name="rating" value="1"> Fixed
                                                    <?php echo form_error('rating'); ?>
                                                </fieldset>
                                                <fieldset class="hs-submit half-width">
                                                    <input type="hidden" value="<?php echo $pages; ?>" name="page" id="page">
                                                    <?php if (($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>
                                                        <a class="add_post_btnc"  onclick="return leave_page(9)"><?php echo $this->lang->line("cancel"); ?></a>
                                                    <?php } else { ?>
                                                        <a class="add_post_btnc" <?php if ($pages == 'professional') { ?> href="<?php echo base_url('freelancer-hire/home'); ?>" <?php } else { ?> href="javascript:history.back()"  <?php } ?>>Cancel</a>
                                                    <?php } ?>
                                                    <input type="submit" tabindex="18" id="submit"  class="add_post_btns" name="submit" value="Post">    
                                                </fieldset>

                                                <?php echo form_close(); ?>


                                            </div>
                                        </div>
                                        <!--									<div class="custom-add-box">
                                                                                                                        <h3 class="freelancer_editpost_title">Location</h3>
                                                                                                                        <div class="p15 fw">
                                                                                                                                <fieldset class="fw" <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                                                                                                                        <label><?php echo $this->lang->line("country"); ?>:<span style="color:red">*</span></label>
                                                                                                                                        <select tabindex="15" name="country" id="country">
                                                                                                                                                <option value="" selected option disabled><?php echo $this->lang->line("select_country"); ?></option>
                                        <?php
                                        if (count($countries) > 0) {
                                            foreach ($countries as $cnt) {
                                                if ($country1) {
                                                    ?>
                                                                                                                                                                                                            <option value="<?php echo $cnt['country_id']; ?>" <?php if ($cnt['country_id'] == $country1) echo 'selected'; ?>><?php echo $cnt['country_name']; ?></option>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                                                                                                                                                                            <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                                                                                                                        </select><span id="country-error"></span>
                                        <?php echo form_error('country'); ?>
                                                                                                                                </fieldset>
                                                                                                                                <fieldset class="fw">
                                                                                                                                        <label><?php echo $this->lang->line("state"); ?>:<span style="color:red">*</span></label>
                                                                                                                                        <select tabindex="16" name="state" id="state">
                                        <?php ?>
                                                                                                                                                <option value="" selected option disabled><?php echo $this->lang->line("country_first"); ?></option>
                                                                                                                                        </select>
                                                                                                                                </fieldset>
                                                                                                                                <fieldset class="fw">
                                                                                                                                        <label><?php echo $this->lang->line("city"); ?>:</label>
                                                                                                                                        <select tabindex="17" name="city" id="city">
                                        <?php
                                        if ($city1) {
                                            foreach ($cities as $cnt) {
                                                ?>
                                                                                                                                                                                        <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>
                                                <?php
                                            }
                                        }
                                        else {
                                            ?>
                                                                                                                                                                    <option value=""><?php echo $this->lang->line("state_first"); ?></option>
                                                    
                                            <?php
                                        }
                                        ?>
                                                                                                                                        </select><span id="city-error"></span>
                                        <?php echo form_error('city'); ?>
                                                                                                                                </fieldset>
                                                                                                                                <fieldset class="hs-submit half-width">
                                                                                                                                        <input type="hidden" value="<?php echo $pages; ?>" name="page" id="page">
                                        <?php if (($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>
                                                                                                                                                            <a class="add_post_btnc"  onclick="return leave_page(9)"><?php echo $this->lang->line("cancel"); ?></a>
                                        <?php } else { ?>
                                                                                                                                                            <a class="add_post_btnc" <?php if ($pages == 'professional') { ?> href="<?php echo base_url('freelancer-hire/home'); ?>" <?php } else { ?> href="javascript:history.back()"  <?php } ?>>Cancel</a>
                                        <?php } ?>
                                                                                                                                        <input type="submit" tabindex="18" id="submit"  class="add_post_btns" name="submit" value="Post">    
                                                                                                                                </fieldset>
                                                                                                                        
                                        <?php echo form_close(); ?>
                                                                                                                                
                                                                                                                        </div>
                                                                                                                </div>   -->
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
                <!-- MIDDLE SECTION END-->
        </section>
        
<!--        Login  
        <div class="modal fade login" id="login1" role="dialog">
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

                                        <form role="form" name="login_form_not" id="login_form_not" method="post">

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
         Login -->
         
           <!-- Login for submit post data -->
        <div class="modal fade login" id="login" role="dialog">
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
             <div class="modal fade register-model login" id="register_profile" role="dialog">
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
                                            <span> <select tabindex="9" class="day1" name="selday" id="selday">
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
                                                <select tabindex="10" class="month1" name="selmonth" id="selmonth">
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
                                                <select tabindex="11" class="year1" name="selyear" id="selyear">
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
                                            By Clicking on create an account button you agree our
                                            <a href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a href="<?php echo base_url('main/privacy_policy'); ?>">Privacy policy</a>.
                                        </p>
                                        <p>
                                            <button tabindex="13" class="btn1">Create an account</button>
                                                                                        <!--<p class="next">Next</p>-->
                                        </p>
                                        <div class="sign_in pt10">
                                            <p>
                                                Already have an account ? <a tabindex="12" onClick="login_profile();" href="javascript:void(0);"> Log In </a>
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
        <!-- Login -->

                <!-- register -->

      
        <!-- register -->
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
        
        <script src="<?php echo base_url('assets/js/jquery.date-dropdowns.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
             <script>

                                                var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                                var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                                var base_url = '<?php echo base_url(); ?>';
                                                var postslug = '<?php echo $this->uri->segment(3); ?>';
                                                 var jobdata = <?php echo json_encode($jobtitle); ?>;


        </script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/recruiter/add_post_login.js?ver=' . time()); ?>"></script>
    </body>
</html>