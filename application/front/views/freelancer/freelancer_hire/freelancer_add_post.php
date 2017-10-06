<?php $pages = $_GET['page']; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $title; ?>
        </title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver=' . time()); ?>">
        <!-- This Css is used for call popup start -->
        <link rel="stylesheet" href=<?php echo base_url('css/bootstrap.min.css?ver=' . time()); ?> /> 
        <!--call popup end-->
        <!-- Calender Css Start-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css?ver=' . time()); ?>">
        <!-- Calender Css End-->
        <link rel="stylesheet" href="<?php echo base_url('css/jquery.fancybox.css?ver='.time()) ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-hire/freelancer-hire.css?ver=' . time()); ?>">
    </head>
    <body class="pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="container">
                        <div class="row">
                        <div class="col-md-2 col-sm-1"></div>
                        <div class="col-md-8 col-sm-10 animated fadeInLeftBig">
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
								<h3><?php echo $this->lang->line("project_post"); ?></h3>
							
                                <div class="job-saved-box">
                                    
                                    <?php echo form_open(base_url('freelancer/freelancer_add_post_insert'), array('id' => 'postinfo', 'name' => 'postinfo', 'class' => 'clearfix form_addedit', 'onsubmit' => "imgval()")); ?>
									
<!--                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> 
                                        <span style="color:#7f7f7e"><?php //ceho $this->lang->line("filed_required"); ?></span>
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
												<input name="post_name" type="text" maxlength="100" id="post_name" autofocus tabindex="1" placeholder="Enter Project Name"/>
												<span id="fullname-error"></span>
												<?php echo form_error('post_name'); ?>
											</fieldset>
											<fieldset class="full-width">
												<label><?php echo $this->lang->line("project_description"); ?> :<span style="color:red">*</span></label>
												<textarea class="add-post-textarea" name="post_desc" id="post_desc" placeholder="Enter Description" tabindex="2" onpaste="OnPaste_StripFormatting(this, event);"></textarea>
												<?php echo form_error('post_desc'); ?>
											</fieldset>
											<fieldset class="full-width" <?php if ($skills) { ?> class="error-msg" <?php } ?>>
												<label><?php echo $this->lang->line("skill_of_requirement"); ?>:<span style="color:red">*</span></label>
												<input id="skills2" name="skills" tabindex="3" size="90" placeholder="Enter SKills">
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
												<label><?php echo $this->lang->line("required_experiance"); ?>:</label>
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
												<label><?php echo $this->lang->line("time_of_project"); ?>:</label>
												<input tabindex="7" name="est_time" type="text" id="est_time" placeholder="Enter Estimated time in month/year" /><span id="fullname-error"></span>
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
												<label  class="control-label"><?php echo $this->lang->line("rate"); ?>:</label>
												<input tabindex="11" name="rate" type="number" id="rate" placeholder="Enter Your rate" min='1'/>
												<span id="fullname-error"></span>
												<?php echo form_error('rate'); ?>
											</fieldset>
											<fieldset class="col-md-6" <?php if ($csurrency) { ?> class="error-msg" <?php } ?> class="two-select-box"> 
												<label><?php echo $this->lang->line("currency"); ?>:</label>
												<select tabindex="12" name="currency" id="currency">
													<option  value="" selected option disabled><?php echo $this->lang->line("select_currency"); ?></option>
													<?php foreach ($currency as $cur) { ?>
														<option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['currency_name']; ?></option>
													<?php } ?>
												</select>
												<?php echo form_error('currency'); ?>
											</fieldset>
											<fieldset class="col-md-12 pl10 work_type_custom">
												<label class=""><?php echo $this->lang->line("work_type"); ?>:</label><input type="radio" tabindex="13" class="worktype_minheight" name="rating" value="0" checked> Hourly
												<input type="radio" tabindex="14"  name="rating" value="1"> Fixed
												<?php echo form_error('rating'); ?>
											</fieldset>
											
											
										</div>
									</div>
									<div class="custom-add-box">
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
									</div>   
                                </div>
                                <div class="col-md-1">
                                </div>
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
        <!--<script src="<?php //echo base_url('js/jquery.js?ver=' . time()); ?>"></script>-->
        <script src="<?php echo base_url('js/jquery.wallform.js?ver=' . time()); ?>"></script>
        <!-- Calender JS Start-->
        <script src="<?php echo base_url('js/jquery.date-dropdowns.js?ver=' . time()); ?>"></script>
        
        <!-- Calender Js End-->
        <script src="<?php echo base_url('js/jquery.fancybox.js?ver='.time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js?ver=' . time()); ?>">
        </script> 


        <script>
            var base_url = '<?php echo base_url(); ?>';

            // LEAVE PAGE ON ADD AND EDIT POST PAGE START
            function leave_page(clicked_id)
            {

                var post_name = document.getElementById('post_name').value;
                var post_desc = document.getElementById('post_desc').value;
                var fields_req = document.getElementById('fields_req').value;
                var skills = document.getElementById('skills2').value;
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
                if (post_name == "" && post_desc == "" && fields_req == "" && skills == "" && year == "" && month == "" && rate == "" && currency == "" && est_time == "" && datepicker == "" && country == "" && city == "")
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
                        document.getElementById('acon').style.display = 'block !important';
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
                            location.href = '<?php echo base_url('freelancer-hire/home'); ?>';
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

                if (clicked_id == 5)
                {
                    $('.header ul li #abody ul li a').click(function () {

                        var all_clicked_href = $(this).attr('href');
                        $('.biderror .mes').html("<div class='pop_content'> Do you want to leave this page?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile(" + clicked_id + ',' + '"' + searchkeyword + '"' + ',' + '"' + searchplace + '"' + ',' + '"' + all_clicked_href + '"' + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        $('#bidmodal').modal('show');
                        return false;

                    });
                } else
                {
                    $('.biderror .mes').html("<div class='pop_content'> Do you want to leave this page?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile(" + clicked_id + ',' + '"' + searchkeyword + '"' + ',' + '"' + searchplace + '"' + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                    $('#bidmodal').modal('show');
                    return false;
                }


            }

            function home_profile(clicked_id, searchkeyword, searchplace, all_clicked_href) {
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
            // LEAVE PAGE ON ADD AND EDIT POST PAGE END 
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_add_post.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>

        <style type="text/css">
            #skills-error{margin-top: 42px;}
            #example2-error{margin-top: 41px;}
        </style>

    </body>
</html>