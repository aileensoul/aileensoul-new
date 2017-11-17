
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
                              <?php   if ($this->uri->segment(3) == 'live-post') {
                            echo '<div class="alert alert-success">You  will be automatically apply successfully after completing of Freelancer profile ...!</div>';
                        }
                        ?>
                                <div class="common-form job_reg_main">
                                    <h3>Welcome In Freelancer Profile</h3>
                                    <?php echo form_open(base_url('freelancer/registation_insert/'.$this->uri->segment(4)), array('id' => 'freelancer_regform', 'name' => 'freelancer_regform', 'class' => 'clearfix')); ?>
                                    <fieldset>
                                        <label >First Name <font  color="red">*</font> :</label>                          
                                        <input type="text" name="firstname" id="firstname" tabindex="1" placeholder="Enter first name" style="text-transform: capitalize;" onfocus="var temp_value = this.value; this.value = ''; this.value = temp_value" value="<?php echo $art[0]['first_name']; ?>" maxlength="35">
                                        <?php
                                        echo form_error('firstname');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Last Name <font  color="red">*</font>:</label>
                                        <input type="text" name="lastname" id="lastname" tabindex="2" placeholder="Enter last name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="" maxlength="35">
                                        <?php
                                        echo form_error('lastname');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Email Address <font  color="red">*</font> :</label>
                                        <input type="email" name="email" id="email" tabindex="3" placeholder="Enter email address" value="<?php echo $job[0]['user_email']; ?>" maxlength="255">
                                        <?php
                                        echo form_error('email');
                                        ;
                                        ?>
                                    </fieldset>
                                    <fieldset>
                                        <label >Phone number:<span class="optional">(optional)</span></label>
                                        <input type="text" name="phoneno" id="phoneno" tabindex="4" placeholder="Enter phone number" value="<?php echo $job[0]['user_email']; ?>" maxlength="255">
                                        <?php
                                        echo form_error('email');
                                        ;
                                        ?>
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

                                    <fieldset class="full-width" <?php if ($field) { ?> class="error-msg" <?php } ?>>
                                        <?php if ($livepostid) { ?>
                                            <input type="hidden" name="livepostid" id="livepostid" tabindex="8"  value="<?php echo $livepostid; ?>">
                                        <?php }
                                        ?>
                                        <label><?php echo $this->lang->line("your_field"); ?>:<span class="red">*</span></label> 

                                        <select tabindex="8" name="field" id="field" class="field_other">
                                            <option value=""><?php echo $this->lang->line("select_filed"); ?></option>
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
                                        <?php echo form_error('field'); ?>
                                    </fieldset>

                                    <fieldset  <?php if ($area) { ?> class="error-msg" <?php } ?> class="full-width">
                                        <label> <?php echo $this->lang->line("your_skill"); ?>:<span class="red">*</span></label>
                                        <input id="skills1" name="skills" tabindex="9"   placeholder="Enter skills" value="<?php
                                        if ($skill_2) {
                                            echo $skill_2;
                                        }
                                        ?>">
                                               <?php echo form_error('area'); ?>
                                    </fieldset>

                                    <fieldset  class="full-width" <?php if ($experience_year) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("total_experiance"); ?> :<span class="red">*</span></label>  <select name="experience_year" placeholder="Year" tabindex="10" id="experience_year" class="experience_year col-md-5 day" onchange="return check_yearmonth();" style="margin-right: 4%;">

                                            <option value="" selected option disabled><?php echo $this->lang->line("year"); ?></option>
                                            <option value="0 year"  <?php if ($experience_year1 == "0 year") echo 'selected'; ?>>0 Year</option>
                                            <option value="1 year"  <?php if ($experience_year1 == "1 year") echo 'selected'; ?>>1 Year</option>
                                            <option value="2 year"  <?php if ($experience_year1 == "2 year") echo 'selected'; ?>>2 Year</option>
                                            <option value="3 year"  <?php if ($experience_year1 == "3 year") echo 'selected'; ?>>3 Year</option>
                                            <option value="4 year"  <?php if ($experience_year1 == "4 year") echo 'selected'; ?>>4 Year</option>
                                            <option value="5 year"  <?php if ($experience_year1 == "5 year") echo 'selected'; ?>>5 Year</option>
                                            <option value="6 year"  <?php if ($experience_year1 == "6 year") echo 'selected'; ?>>6 Year</option>
                                            <option value="7 year"  <?php if ($experience_year1 == "7 year") echo 'selected'; ?>>7 Year</option>  
                                            <option value="8 year"  <?php if ($experience_year1 == "8 year") echo 'selected'; ?>>8 Year</option>
                                            <option value="9 year"  <?php if ($experience_year1 == "9 year") echo 'selected'; ?>>9 Year</option> 
                                            <option value="10 year"  <?php if ($experience_year1 == "10 year") echo 'selected'; ?>>10 Year</option>
                                            <option value="11 year"  <?php if ($experience_year1 == "11 year") echo 'selected'; ?>>11 Year</option> 
                                            <option value="12 year"  <?php if ($experience_year1 == "12 year") echo 'selected'; ?>>12 Year</option>
                                            <option value="13 year"  <?php if ($experience_year1 == "13 year") echo 'selected'; ?>>13 Year</option> 
                                            <option value="14 year"  <?php if ($experience_year1 == "14 year") echo 'selected'; ?>>14 Year</option>
                                            <option value="15 year"  <?php if ($experience_year1 == "15 year") echo 'selected'; ?>>15 Year</option>
                                            <option value="16 year"  <?php if ($experience_year1 == "16 year") echo 'selected'; ?>>16 Year</option>
                                            <option value="17 year"  <?php if ($experience_year1 == "17 year") echo 'selected'; ?>>17 Year</option>
                                            <option value="18 year"  <?php if ($experience_year1 == "18 year") echo 'selected'; ?>>18 Year</option>
                                            <option value="19 year"  <?php if ($experience_year1 == "19 year") echo 'selected'; ?>>19 Year</option>
                                            <option value="20 year"  <?php if ($experience_year1 == "20 year") echo 'selected'; ?>>20 Year</option>

                                        </select>


                                        <select name="experience_month" tabindex="11" id="experience_month" placeholder="Month" class="experience_month col-md-5 day" onchange="return check_yearmonth();" >
                                            <option value="" selected option disabled><?php echo $this->lang->line("month"); ?></option>
                                            <option value="0 month"  <?php if ($experience_month1 == "0 month") echo 'selected'; ?>>0 Month</option>
                                            <option value="1 month"  <?php if ($experience_month1 == "1 month") echo 'selected'; ?>>1 Month</option>
                                            <option value="2 month"  <?php if ($experience_month1 == "2 month") echo 'selected'; ?>>2 Month</option>
                                            <option value="3 month"  <?php if ($experience_month1 == "3 month") echo 'selected'; ?>>3 Month</option>
                                            <option value="4 month"  <?php if ($experience_month1 == "4 month") echo 'selected'; ?>>4 Month</option>
                                            <option value="5 month"  <?php if ($experience_month1 == "5 month") echo 'selected'; ?>>5 Month</option>
                                            <option value="6 month"  <?php if ($experience_month1 == "6 month") echo 'selected'; ?>>6 Month</option>
                                            <option value="7 month"  <?php if ($experience_month1 == "7 month") echo 'selected'; ?>>7 Month</option>
                                            <option value="8 month"  <?php if ($experience_month1 == "8 month") echo 'selected'; ?>>8 Month</option>
                                            <option value="9 month"  <?php if ($experience_month1 == "9 month") echo 'selected'; ?>>9 Month</option>
                                            <option value="10 month"  <?php if ($experience_month1 == "10 month") echo 'selected'; ?>>10 Month</option>
                                            <option value="11 month"  <?php if ($experience_month1 == "11 month") echo 'selected'; ?>>11 Month</option>
                                            <option value="12 month"  <?php if ($experience_month1 == "12 month") echo 'selected'; ?>>12 Month</option>

                                        </select>  
                                        <?php echo form_error('experience_year'); ?>

                                    </fieldset>


                                    <fieldset class=" full-width">
                                        <div class="job_reg">
                                           <!--<input type="reset">-->
                                            <input title="Register" tabindex="12" type="submit" id="submit" name="" value="Register">
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
 <!-- Bid-modal for other field start  -->
        <div class="modal fade message-box biderror custom-message" id="bidmodal2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content message">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>
                    <!--                    <div class="message" style="width:300px;">-->
                    <h2>Add Field</h2>         
                    <input type="text" name="other_field" id="other_field" onkeypress="return remove_validation()">
                    <div class="fw"><a id="field" class="btn">OK</a></div>
                    <!--                    </div>-->
                </div>
            </div>
        </div>
        <!-- Model for other field Popup Close -->


        <!-- <footer>        -->
        <?php echo $login_footer ?> 
        <?php echo $footer; ?>
        <!-- </footer> -->
        <script  type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()) ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/registation.js?ver=' . time()); ?>"></script>

        <script>
                                            var base_url = '<?php echo base_url(); ?>';
                                            var site = '<?php echo base_url(); ?>';
        </script>
    </body>
</html>