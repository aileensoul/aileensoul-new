<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        
        <link href="<?php echo base_url('css/jquery-ui.css?ver=' . time()) ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <!-- Calender Css Start-->
        <link rel="stylesheet" href="<?php echo base_url('css/jquery.fancybox.css?ver='.time()) ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css?ver=' . time()); ?>">
        <!-- Calender Css End-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-hire/freelancer-hire.css?ver=' . time()); ?>">

    </head>
    <body class="page-container-bg-solid page-boxed">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-7 col-sm-8 animated fadeInLeftBig">
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
                                <h3 class="h3_edit"><?php echo $this->lang->line("edit_project"); ?></h3>
                                <?php echo form_open(base_url('freelancer/freelancer_edit_post_insert/' . $freelancerpostdata[0]['post_id']), array('id' => 'postinfo', 'name' => 'postinfo', 'class' => 'clearfix form_addedit')); ?>
                                <div>
                                    <h4 class="freelancer_editpost_title"><?php echo $this->lang->line("project_description"); ?></h4>
                                </div>
<!--                                <div class="indiavte_freelancer">
                                    <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> 
                                    <span style="color:#7f7f7e"><?php //echo $this->lang->line("filed_required"); ?></span>
                                </div> -->
                                <fieldset class="full-width">
                                    <label><?php echo $this->lang->line("project_title"); ?>:<span style="color:red">*</span></label>
                                    <input name="post_name" type="text" id="post_name" maxlength="100" tabindex="1" autofocus placeholder="Enter Post Name" value="<?php echo $freelancerpostdata[0]['post_name'] ?> " onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/>
                                    <span id="fullname-error"></span>                        
                                    <?php echo form_error('post_name'); ?>
                                </fieldset>
                                <fieldset class="full-width">
                                    <label><?php echo $this->lang->line("project_description"); ?>:<span style="color:red">*</span></label>
                                    <textarea style="resize: none;height: 22%;overflow: auto;" tabindex="2" name="post_desc" id="post_desc" placeholder="Enter Description"><?php echo $freelancerpostdata[0]['post_description']; ?></textarea>
                                    <?php echo form_error('post_desc'); ?>
                                </fieldset>
                                <fieldset class="full-width" <?php if ($fields_req) { ?> class="error-msg" <?php } ?>>
                                    <label><?php echo $this->lang->line("field_of_requirement"); ?>:<span style="color:red">*</span></label>
                                    <select tabindex="3" name="fields_req" id="fields_req" class="field_other">
                                        <option value="" selected option disabled><?php echo $this->lang->line("select_filed"); ?></option>
                                        <?php
                                        if (count($category_data) > 0) {
                                            foreach ($category_data as $cnt) {
                                                if ($freelancerpostdata[0]['post_field_req']) {
                                                    ?>
                                                    <option value="<?php echo $cnt['category_id']; ?>" <?php if ($cnt['category_id'] == $freelancerpostdata[0]['post_field_req']) echo 'selected'; ?>><?php echo $cnt['category_name']; ?></option>
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
                                <fieldset class="full-width" <?php if ($post_skill) { ?> class="error-msg" <?php } ?>>
                                    <label><?php echo $this->lang->line("skill_of_requirement"); ?>:<span style="color:red">*</span></label>
                                    <input id="skills2" name="skills"  tabindex="4"  size="90" placeholder="Enter SKills" value="<?php if($skill_2){echo $skill_2;} ?>">
                                    <?php echo form_error('skills'); ?>
                                </fieldset>
<!--                                <fieldset class="full-width" <?php if ($other_skill) { ?> class="error-msg" <?php } ?> >
                                    <label class="control-label"><?php echo $this->lang->line("other_skill"); ?>:</label>
                                    <input name="other_skill" tabindex="5" type="text" id="other_skill" class="keyskil" placeholder="Enter Your Other Skill" value="<?php echo $freelancerpostdata[0]['post_other_skill']; ?>" />
                                    <span id="fullname-error"></span>
                                    <?php echo form_error('other_skill'); ?>
                                </fieldset>-->
                                <fieldset class="full-width two-select-box fullwidth_experience"> 
                                    <label>Experience:</label>

                                    <select name="year" id="year" tabindex="5">
                                        <option value="" selected option disabled><?php echo $this->lang->line("year"); ?></option>
                                        <option value="0" <?php if ($freelancerpostdata[0]['post_exp_year'] == "0") echo 'selected="selected"'; ?>>0 Year</option>
                                        <option value="1" <?php if ($freelancerpostdata[0]['post_exp_year'] == "1") echo 'selected="selected"'; ?>>1 Year</option>
                                        <option value="2" <?php if ($freelancerpostdata[0]['post_exp_year'] == "2") echo 'selected="selected"'; ?>>2 Year</option>
                                        <option value="3" <?php if ($freelancerpostdata[0]['post_exp_year'] == "3") echo 'selected="selected"'; ?>>3 Year</option>
                                        <option value="4" <?php if ($freelancerpostdata[0]['post_exp_year'] == "4") echo 'selected="selected"'; ?>>4 Year</option>
                                        <option value="5" <?php if ($freelancerpostdata[0]['post_exp_year'] == "5") echo 'selected="selected"'; ?>>5 Year</option>
                                        <option value="6" <?php if ($freelancerpostdata[0]['post_exp_year'] == "6") echo 'selected="selected"'; ?>>6 Year</option>
                                        <option value="7" <?php if ($freelancerpostdata[0]['post_exp_year'] == "7") echo 'selected="selected"'; ?>>7 Year</option>
                                        <option value="8" <?php if ($freelancerpostdata[0]['post_exp_year'] == "8") echo 'selected="selected"'; ?>>8 Year</option>
                                        <option value="9" <?php if ($freelancerpostdata[0]['post_exp_year'] == "9") echo 'selected="selected"'; ?>>9 Year</option>
                                        <option value="10" <?php if ($freelancerpostdata[0]['post_exp_year'] == "10") echo 'selected="selected"'; ?>>10 Year</option>
                                        <option value="11" <?php if ($freelancerpostdata[0]['post_exp_year'] == "11") echo 'selected="selected"'; ?>>11 Year</option>
                                        <option value="12" <?php if ($freelancerpostdata[0]['post_exp_year'] == "12") echo 'selected="selected"'; ?>>12 Year</option>
                                        <option value="13" <?php if ($freelancerpostdata[0]['post_exp_year'] == "13") echo 'selected="selected"'; ?>>13 Year</option>
                                        <option value="14" <?php if ($freelancerpostdata[0]['post_exp_year'] == "14") echo 'selected="selected"'; ?>>14 Year</option>
                                        <option value="15" <?php if ($freelancerpostdata[0]['post_exp_year'] == "15") echo 'selected="selected"'; ?>>15 Year</option>
                                        <option value="16" <?php if ($freelancerpostdata[0]['post_exp_year'] == "16") echo 'selected="selected"'; ?>>16 Year</option>
                                        <option value="17" <?php if ($freelancerpostdata[0]['post_exp_year'] == "17") echo 'selected="selected"'; ?>>17 Year</option>
                                        <option value="18" <?php if ($freelancerpostdata[0]['post_exp_year'] == "18") echo 'selected="selected"'; ?>>18 Year</option>
                                        <option value="19" <?php if ($freelancerpostdata[0]['post_exp_year'] == "19") echo 'selected="selected"'; ?>>19 Year</option>
                                        <option value="20" <?php if ($freelancerpostdata[0]['post_exp_year'] == "20") echo 'selected="selected"'; ?>>20 Year</option>
                                    </select>
                                    <span id="fullname-error"></span>
                                    <?php echo form_error('year'); ?>

                                    <select name="month" style="margin-left: 8px;" tabindex="6" id="month">
                                        <option value="" selected option disabled><?php echo $this->lang->line("month"); ?></option>
                                        <option value="0" <?php if ($freelancerpostdata[0]['post_exp_month'] == "0") echo 'selected="selected"'; ?>>0 Month</option>
                                        <option value="1" <?php if ($freelancerpostdata[0]['post_exp_month'] == "1") echo 'selected="selected"'; ?>>1 Month</option>
                                        <option value="2" <?php if ($freelancerpostdata[0]['post_exp_month'] == "2") echo 'selected="selected"'; ?>>2 Month</option>
                                        <option value="3" <?php if ($freelancerpostdata[0]['post_exp_month'] == "3") echo 'selected="selected"'; ?>>3 Month</option>
                                        <option value="4" <?php if ($freelancerpostdata[0]['post_exp_month'] == "4") echo 'selected="selected"'; ?>>4 Month</option>
                                        <option value="5" <?php if ($freelancerpostdata[0]['post_exp_month'] == "5") echo 'selected="selected"'; ?>>5 Month</option>
                                        <option value="6"<?php if ($freelancerpostdata[0]['post_exp_month'] == "6") echo 'selected="selected"'; ?>>6 Month</option>
                                    </select>
                                    <?php echo form_error('month'); ?>

                                </fieldset>
                                <fieldset class="col-md-12">  
                                    <b><h2 class="freelancer_editpost_title"><?php echo $this->lang->line("payment"); ?>: </h2></b>
                                </fieldset>
                                <fieldset style="padding-left: 8px;" class="col-md-4" <?php if ($rate) { ?> class="error-msg" <?php } ?> >
                                    <label class="control-label"><?php echo $this->lang->line("rate"); ?>:</label>
                                    <input name="rate" type="number" id="rate" tabindex="7" placeholder="Enter Your rate" value="<?php echo $freelancerpostdata[0]['post_rate']; ?>" />
                                    <span id="fullname-error"></span>
                                    <?php echo form_error('rate'); ?>
                                </fieldset>
                                <fieldset class=" col-md-4"> 
                                    <label><?php echo $this->lang->line("currency"); ?>:</label>
                                    <select name="currency" id="currency" tabindex="8">
                                        <option value="" selected option disabled><?php echo $this->lang->line("select_currency"); ?></option>
                                        <?php
                                        if (count($currency) > 0) {
                                            foreach ($currency as $cur) {
                                                if ($freelancerpostdata[0]['post_currency']) {
                                                    ?>
                                                    <option value="<?php echo $cur['currency_id']; ?>" <?php if ($cur['currency_id'] == $freelancerpostdata[0]['post_currency']) echo 'selected'; ?>><?php echo $cur['currency_name']; ?></option>
                                                <?php }else {
                                                    ?>
                                                    <option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['currency_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('currency'); ?>
                                </fieldset>
                                <fieldset class="col-md-4">
                                    <label><?php echo $this->lang->line("work_type"); ?></label>
                                    <input type="radio" name="rating" tabindex="9" <?php if ($freelancerpostdata[0]['post_rating_type'] == 0) { ?> checked <?php } ?> value="0" > Hourly
                                    <input type="radio" name="rating" tabindex="10"  <?php if ($freelancerpostdata[0]['post_rating_type'] == 1) { ?> checked <?php } ?> value ="1"> Fixed
                                    <?php echo form_error('rating'); ?>
                                </fieldset>
                                <fieldset>
                                    <label><?php echo $this->lang->line("time_of_project"); ?>:</label>
                                    <input name="est_time" type="text" tabindex="11" id="est_time" placeholder="Enter Estimated time in month/year" value="<?php echo $freelancerpostdata[0]['post_est_time'] ?> "/>
                                    <span id="fullname-error"></span>
                                    <?php echo form_error('post_name'); ?>
                                </fieldset>
                                <fieldset <?php if ($last_date) { ?> class="error-msg" <?php } ?>>
                                    <label><?php echo $this->lang->line("last_date_apply"); ?>:<span style="color:red">*</span></label>
                                    <input type="hidden" id="example2">
                                    <?php echo form_error('last_date'); ?> 
                                </fieldset>
                                <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                    <label><?php echo $this->lang->line("country"); ?>:<span style="color:red">*</span></label>
                                    <select name="country" id="country" tabindex="15">
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
                                <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                    <label><?php echo $this->lang->line("state"); ?>:<span class="red">*</span></label>
                                    <select tabindex="16" name="state" id="state">
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
                                            <option value=""><?php echo $this->lang->line("country_first"); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('state'); ?>
                                </fieldset>
                                <fieldset>
                                    <label><?php echo $this->lang->line("city"); ?>:</label>
                                    <select name="city" id="city" tabindex="17">
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
                                            <option value=""><?php echo $this->lang->line("select_city"); ?></option>
                                            <?php
                                            foreach ($cities as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option value=""><?php echo $this->lang->line("state_first"); ?></option>

                                            <?php
                                        }
                                        ?>
                                    </select><span id="city-error"></span>
                                    <?php echo form_error('city'); ?>
                                </fieldset>
                                <fieldset class="hs-submit half-width">
                                    <?php if (($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>
                                        <a class="add_post_btnc" onclick="return leave_page(9)"><?php echo $this->lang->line("cancel"); ?></a>
                                    <?php } else { ?>

                                        <a class="add_post_btnc"  href="javascript:history.back()"><?php echo $this->lang->line("cancel"); ?></a>
                                    <?php } ?>
                                    <input type="submit" tabindex="18" id="submit" class="add_post_btns" name="submit" value="Save">
                                </fieldset>
                                <?php echo form_close(); ?>
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
        <script src="<?php echo base_url('js/jquery.wallform.js?ver=' . time()); ?>"></script>
        <!--<script src="<?php //echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
        <script src="<?php echo base_url('js/jquery.fancybox.js?ver='.time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js?ver=' . time()); ?>"></script> 
        <script src="<?php echo base_url('js/jquery.date-dropdowns.js?ver=' . time()); ?>">
        </script>

        <script>
            var base_url = '<?php echo base_url(); ?>';
            var date_picker1 = '<?php echo date('Y-m-d', strtotime($freelancerpostdata[0]['post_last_date'])); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_edit_post.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>

        <script type="text/javascript">
            //Leave Page on add and edit post page start
            function leave_page(clicked_id)
            {
                var searchkeyword = $.trim(document.getElementById('tags').value);
                var searchplace = $.trim(document.getElementById('searchplace').value);
                if (clicked_id == 4)
                {
                    if (searchkeyword == "" && searchplace == "")
                    {
                        return checkvalue_search;
                    }

                }

                return home(clicked_id, searchkeyword, searchplace);

            }

            function home(clicked_id, searchkeyword, searchplace) {
                if(clicked_id == 5)
                {
                     $('.header ul li #abody ul li a').click(function () {

                            var all_clicked_href = $(this).attr('href');
                        $('.biderror .mes').html("<div class='pop_content'> Do you want to leave this page?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile(" + clicked_id + ',' + '"' + searchkeyword + '"' + ',' + '"' + searchplace + '"' + ',' + '"' + all_clicked_href + '"' + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        $('#bidmodal').modal('show');
                        return false;

                         });
                }
                else{
                $('.biderror .mes').html("<div class='pop_content'>Do you want to discard your changes?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile(" + clicked_id + ',' + '"' + searchkeyword + '"' + ',' + '"' + searchplace + '"' + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                $('#bidmodal').modal('show');
                return false;
            }

            }

            function home_profile(clicked_id, searchkeyword, searchplace,all_clicked_href) {
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
                           // document.getElementById('acon').style.display = 'block !important';
                            window.location = all_clicked_href;
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
            //Leave Page on add and edit post page End
        </script>


        <script>
           
        </script>
        <style type="text/css">
            #example2-error{margin-top: 42px!important;}
        </style>


    </body>
</html>