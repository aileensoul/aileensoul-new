<?php $pages = $_GET['page']; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $title; ?>
        </title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <!-- This Css is used for call popup start -->
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" /> 
        <!--call popup end-->
        <!-- Calender Css Start-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.datetimepicker.css'); ?>">
        <!-- Calender Css End-->
        <!-- css for date picker start-->
        <style type="text/css">
            .date-dropdowns .day, .date-dropdowns .month, .date-dropdowns .year{width: 30%; float: left; margin-right: 5%;}
            .date-dropdowns .year{margin-right: 0;}
            .example {
                width: 33%;
                min-width: 400px;
                padding: 15px;
                display: inline-block;
                box-sizing: border-box;
                text-align: center;
            }

            .example:first-of-type {
                position: relative;
                bottom: 35px;
            }

            /* Example Heading */
            .example h2 {
                font-family: "Roboto Condensed", helvetica, arial, sans-serif;
                font-size: 1.3em;
                margin: 15px 0;
                color: #4F5462;
            }

            .example input {
                display: block;
                margin: 0 auto 20px auto;
                width: 150px;
                padding: 8px 10px;
                border: 1px solid #CCCCCC;
                border-radius: 3px;
                background: #F2F2F2;
                text-align: center;
                font-size: 1em;
                letter-spacing: 0.02em;
                font-family: "Roboto Condensed", helvetica, arial, sans-serif;
            }

            .example select {
                padding: 10px;
                background: #ffffff;
                border: 1px solid #CCCCCC;
                border-radius: 3px;
                margin: 0 3px;
            }

            .example select.invalid {
                color: #E9403C;
            }

            .example input[type="submit"] {
                margin-top: 10px;
            }

            .example input[type="submit"]:hover {
                cursor: pointer;
                background-color: #e5e5e5;
            }


        </style>
        <!-- css for date picker end-->
    </head>
    <body class="pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2; ?>
        <section>
            <div>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="row"></div>
                    <div class="container">
                        <div class="col-md-3"></div>
                        <div class="col-md-7 col-sm-7">
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
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>Post Your Project</h3>
                                    <?php echo form_open(base_url('freelancer/freelancer_add_post_insert'), array('id' => 'postinfo', 'name' => 'postinfo', 'class' => 'clearfix form_addedit', 'onsubmit' => "imgval()")); ?>
                                    <div>
                                        <h4 class="freelancer_editpost_title"> Project Description</h4></div>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> 
                                        <span style="color:#7f7f7e">Indicates required field</span>
                                    </div>
                                    <?php
                                    $post_name = form_error('post_name');
                                    $skills = form_error('skills');
                                    $post_desc = form_error('post_desc');
                                    ?>
                                    <fieldset class="full-width" <?php if ($post_name) { ?> class="error-msg" <?php } ?>>
                                        <label >Post Title:<span style="color:red">*</span></label>                 
                                        <input name="post_name" type="text" maxlength="100" id="post_name" autofocus tabindex="1" placeholder="Enter Post Name"/>
                                        <span id="fullname-error"></span>
                                        <?php echo form_error('post_name'); ?>
                                    </fieldset>
                                    <fieldset class="full-width">
                                        <label>Post Description :<span style="color:red">*</span></label>
                                        <textarea style="resize: none;height: 22%;overflow: auto;" name="post_desc" id="post_desc" placeholder="Enter Description" tabindex="2" onpaste="OnPaste_StripFormatting(this, event);"></textarea>
                                        <?php echo form_error('post_desc'); ?>
                                    </fieldset>
                                    <fieldset class="full-width" <?php if ($fields_req) { ?> class="error-msg" <?php } ?>>
                                        <label>Fields Of Requirement:<span style="color:red">*</span></label>
                                        <select tabindex="3" name="fields_req" id="fields_req">
                                            <option  value="" selected option disabled>Select Fields of Requirement</option>
                                            <?php
                                            if (count($category) > 0) {
                                                foreach ($category as $cnt) {
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
                                        </select>
                                        <?php echo form_error('fields_req'); ?>
                                    </fieldset>
                                    <fieldset class="full-width" <?php if ($skills) { ?> class="error-msg" <?php } ?>>
                                        <label>Skills of Requirements:<span style="color:red">*</span></label>
                                        <select tabindex="4" class="keyskil" name="skills[]" id="skills" multiple="multiple" style="cursor: default;"></select>
                                        <span id="fullname-error"></span>
                                        <?php echo form_error('skills'); ?>
                                    </fieldset>
                                    <fieldset class="full-width" <?php if ($other_skill) { ?> class="error-msg" <?php } ?> >
                                <label class="control-label">Other Skill:<!-- <span style="color:red">*</span> --></label>
                                        <input name="other_skill" class="keyskil"  type="text" id="other_skill" tabindex="5" placeholder="Enter Your Other Skill" />
                                        <span id="fullname-error"></span>
                                        <?php echo form_error('other_skill'); ?>
                                    </fieldset>
                                    <fieldset class="full-width two-select-box fullwidth_experience" <?php if ($month) { ?> class="error-msg" <?php } ?> class="two-select-box"> 
                                        <label>Experience:</label>
                                        <select tabindex="6" name="year" id="year">
                                            <option value="" selected option disabled>Year</option>
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

                                        <select class="margin-month " tabindex="7" name="month" id="month">
                                            <option value="" selected option disabled>Month</option>
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
                                    <fieldset class="col-md-12">  
                                        <b><h2 class="freelancer_editpost_title">Payment For Freelancer : </h2></b>
                                    </fieldset>
                                    <fieldset style="padding-left: 8px;" class="col-md-4" <?php if ($rate) { ?> class="error-msg" <?php } ?> >
                                        <label  class="control-label">Rate:<span style="color:red">*</span></label>
                                        <input tabindex="8" name="rate" type="number" id="rate" placeholder="Enter Your rate" min='1'/>
                                        <span id="fullname-error"></span>
                                        <?php echo form_error('rate'); ?>
                                    </fieldset>
                                    <fieldset class="col-md-4" <?php if ($csurrency) { ?> class="error-msg" <?php } ?> class="two-select-box"> 
                                        <label>Currency:<span class="red">*</span></label>
                                        <select tabindex="9" name="currency" id="currency">
                                            <option  value="" selected option disabled>Select Currency</option>
                                            <?php foreach ($currency as $cur) { ?>
                                                <option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['currency_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('currency'); ?>
                                    </fieldset>
                                    <fieldset class="col-md-4">
                                        <label> Work Type</label>  <input type="radio" tabindex="10" class="worktype_minheight" name="rating" value="0" checked> Hourly
                                        <input type="radio"  name="rating" value="1"> Fixed
                                        <?php echo form_error('rating'); ?>
                                    </fieldset>
                                    <fieldset class="col-md-6" <?php if ($est_time) { ?> class="error-msg" <?php } ?>>
                                        <label>Estimated time of project:</label>
                                        <input tabindex="11" name="est_time" type="text" id="est_time" placeholder="Enter Estimated time in month/year" /><span id="fullname-error"></span>
                                        <?php echo form_error('est_time'); ?>
                                    </fieldset>           
                                    <fieldset <?php if ($last_date) { ?> class="error-msg" <?php } ?>>
                                        <label>Last date for apply:<span style="color:red">*</span></label>
                                        <input type="hidden" id="example2">
                                        <?php echo form_error('last_date'); ?> 
                                    </fieldset>
                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label>Country:<span style="color:red">*</span></label>
                                        <select tabindex="13" name="country" id="country">
                                            <option value="" selected option disabled>Select Country</option>
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
                                    <fieldset>
                                        <label>State:<span style="color:red">*</span></label>
                                        <select tabindex="13" name="state" id="state">
                                            <?php ?>
                                            <option value="" selected option disabled>Select country first</option>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <label> City:</label>
                                        <select tabindex="14" name="city" id="city">
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
                                                <option value="">Select State first</option>

                                                <?php
                                            }
                                            ?>
                                        </select><span id="city-error"></span>
                                        <?php echo form_error('city'); ?>
                                    </fieldset>
                                    <div class="fr">           
                                        <fieldset class="hs-submit full-width">
                                            <input type="hidden" value="<?php echo $pages; ?>" name="page" id="page">
                                            <?php if (($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'freelancerlancer_edit_post')) { ?>
                                                <a class="add_post_btnc"  onclick="return leave_page(9)">Cancel</a>
                                            <?php } else { ?>
                                                <a class="add_post_btnc" <?php if ($pages == 'professional') { ?> href="<?php echo base_url('freelancer/recommen_candidate'); ?>" <?php } else { ?> href="javascript:history.back()"  <?php } ?>>Cancel</a>
                                            <?php } ?>
                                            <input type="submit" tabindex="15" id="submit"  class="add_post_btns" name="submit" value="Post">    
                                        </fieldset>
                                    </div>  
                                    <?php echo form_close(); ?>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
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
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>

        <!-- This Js is used for call popup -->
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <!-- Calender JS Start-->
        <script src="<?php echo base_url('js/jquery.date-dropdowns.js'); ?>"></script>
        <!-- Calender Js End-->
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>">
        </script> 


        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;

            // LEAVE PAGE ON ADD AND EDIT POST PAGE START
            function leave_page(clicked_id)
            {
                var post_name = document.getElementById('post_name').value;
                var post_desc = document.getElementById('post_desc').value;
                var fields_req = document.getElementById('fields_req').value;
                var skills = document.getElementById('skills').value;
                var other_skill = document.getElementById('other_skill').value;
                var year = document.getElementById('year').value;
                var month = document.getElementById('month').value;
                var rate = document.getElementById('rate').value;
                var currency = document.getElementById('currency').value;
                var est_time = document.getElementById('est_time').value;
                var datepicker = document.getElementById('example2').value;
                var country = document.getElementById('country').value;
                var city = document.getElementById('city').value;
                var searchkeyword = $.trim(document.getElementById('tags').value);
                var searchplace = $.trim(document.getElementById('searchplace').value);
                var page = document.getElementById('page').value;
                if (post_name == "" && post_desc == "" && fields_req == "" && skills == "" && other_skill == "" && year == "" && month == "" && rate == "" && currency == "" && est_time == "" && datepicker == "" && country == "" && city == "")
                {
                    if (clicked_id == 1)
                    {
                        location.href = '<?php echo base_url('freelancer-hire/home'); ?>';
                    }
                    if (clicked_id == 2)
                    {
                        location.href = '<?php echo base_url('freelancer-hire/employer-details'); ?>';
                    }
                    if (clicked_id == 3)
                    {
                        location.href = '<?php echo base_url('freelancer-hire/basic-information'); ?>';
                    }
                    if (clicked_id == 4)
                    {
                        if (searchkeyword == "" && searchplace == "")
                        {
                            return checkvalue_search;
                        } else
                        {

                            if (searchkeyword == "")
                            {
                                location.href = '<?php echo base_url() ?>freelancer-hire/search/' + 0 + '/' + searchplace;

                            } else if (searchplace == "")
                            {
                                location.href = '<?php echo base_url() ?>freelancer-hire/search/' + searchkeyword + '/' + 0;
                            } else
                            {
                                location.href = '<?php echo base_url() ?>freelancer-hire/search/' + searchkeyword + '/' + searchplace;
                            }
                        }
                    }
                    if (clicked_id == 5)
                    {
                        location.href = '<?php echo base_url('dashboard') ?>';
                    }
                    if (clicked_id == 6)
                    {
                        location.href = '<?php echo base_url() . 'profile' ?>';
                    }
                    if (clicked_id == 7)
                    {
                        location.href = '<?php echo base_url('registration/changepassword') ?>';
                    }
                    if (clicked_id == 8)
                    {
                        location.href = '<?php echo base_url('dashboard/logout') ?>';
                    }
                    if (clicked_id == 9)
                    {
                        if (page == 'professional') {
                            location.href = '<?php echo base_url('freelancer/recommen_candidate'); ?>';
                        } else {
                            location.href = 'javascript:history.back()';
                        }

                    }

                } else
                {
                    return home(clicked_id, searchkeyword, searchplace);
                }
            }
            function home(clicked_id, searchkeyword, searchplace) {
                $('.biderror .mes').html("<div class='pop_content'> Do you want to leave this page?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile(" + clicked_id + ',' + '"' + searchkeyword + '"' + ',' + '"' + searchplace + '"' + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                $('#bidmodal').modal('show');
            }

            function home_profile(clicked_id, searchkeyword, searchplace) {
                var url, data;
                if (clicked_id == 4) {
                    url = '<?php echo base_url() . "freelancer-hire/search" ?>';
                    data = 'id=' + clicked_id + '&skills=' + searchkeyword + '&searchplace=' + searchplace;
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function (data) {
                        if (clicked_id == 1)
                        {
                            window.location = "<?php echo base_url('freelancer-hire/home'); ?>";
                        } else if (clicked_id == 2)
                        {
                            window.location = "<?php echo base_url('freelancer-hire/employer-details'); ?>";
                        } else if (clicked_id == 3)
                        {
                            window.location = "<?php echo base_url('freelancer-hire/basic-information'); ?>";
                        } else if (clicked_id == 4)
                        {
                            if (searchkeyword == "")
                            {
                                window.location = "<?php echo base_url() ?>freelancer-hire/search/" + 0 + "/" + searchplace;

                            } else if (searchplace == "")
                            {
                                window.location = "<?php echo base_url() ?>freelancer-hire/search/" + searchkeyword + "/" + 0;
                            } else
                            {
                                window.location = "<?php echo base_url() ?>freelancer-hire/search/" + searchkeyword + "/" + searchplace;
                            }
                        } else if (clicked_id == 5)
                        {
                            window.location = "<?php echo base_url('dashboard') ?>";
                        } else if (clicked_id == 6)
                        {
                            window.location = "<?php echo base_url() . 'profile' ?>";
                        } else if (clicked_id == 7)
                        {
                            window.location = "<?php echo base_url('registration/changepassword') ?>";
                        } else if (clicked_id == 8)
                        {
                            window.location = "<?php echo base_url('dashboard/logout') ?>";
                        } else if (clicked_id == 9)
                        {
                            location.href = 'javascript:history.back()';
                        } else
                        {
                            alert("edit profilw");
                        }

                    }
                });
            }
            // LEAVE PAGE ON ADD AND EDIT POST PAGE END 
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_add_post.js'); ?>"></script>    

        <style type="text/css">
            #skills-error{margin-top: 42px;}
            #example2-error{margin-top: 41px;}
        </style>
    </body>
</html>