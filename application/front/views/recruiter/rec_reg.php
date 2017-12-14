
<!DOCTYPE html>
<html>
     <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <?php
        if (IS_REC_CSS_MINIFY == '0') {
            ?>
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css'); ?>">
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/recruiter.css'); ?>">-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css'); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/recruiter/rec_common_header.min.css?ver=' . time()); ?>">
        <?php } ?>
    </head>
   <head>
<!-- start head -->

</head>
<!-- END HEAD -->

<!-- start header -->
<!-- END HEADER -->
<body>
    <?php echo $header; ?>
        
   <section>
      <div class="user-midd-section " id="paddingtop_fixed">
         <div class="container">
            <div class="row">
               <div class="col-md-3"></div>
               <div class="clearfix">
                  <div class="job_reg_page_fprm">
                     <?php if($this->uri->segment(3) == 'live-post'){
                         echo '<div class="alert alert-success">Your Post is automatically Post after completing recruiter registation...!</div>';
                     } ?>
                                 
                     <div class="common-form job_reg_main">
                        <h3>Welcome In Recruiter Profile</h3>
                         <?php //echo form_open(base_url('recruiter/reg_insert'), array('id' => 'basicinfo', 'name' => 'basicinfo', 'class' => 'clearfix')); ?>
                        <form id="basicinfo" name="basicinfo" class="clearfix">
                        <fieldset>
                                        <label>First Name<span class="red">*</span>:</label>
                                        <input name="first_name" tabindex="1" autofocus type="text" id="first_name"  placeholder="Enter First Name" value="<?php
                                        if ($firstname) {
                                            echo trim(ucfirst(strtolower($firstname)));
                                        } else {
                                            echo trim(ucfirst(strtolower($userdata[0]['first_name'])));
                                        }
                                        ?>" onfocus="var temp_value = this.value; this.value = ''; this.value = temp_value"/><span id="fullname-error "></span>
                                               <?php echo form_error('first_name'); ?>
                                    </fieldset>
                        <fieldset>
                                        <label>Last Name<span class="red">*</span> :</label>
                                        <input name="last_name" type="text" tabindex="2" id="last_name" placeholder="Enter Last Name"
                                               value="<?php
                                               if ($lastname) {
                                                   echo trim(ucfirst(strtolower($lastname)));
                                               } else {
                                                   echo trim(ucfirst(strtolower($userdata[0]['last_name'])));
                                               }
                                               ?>" id="last_name" /><span id="fullname-error" ></span>
                                               <?php echo form_error('last_name'); ?>
                                    </fieldset>
                        <fieldset class="full-width">
                                        <label>Email address:<span class="red">*</span></label>
                                        <input name="email"  type="text" id="email" tabindex="3" placeholder="Enter Email"  value="<?php
                                        if ($email) {
                                            echo $email;
                                        } else {
                                            echo $userdata[0]['user_email'];
                                        }
                                        ?>" /><span id="email-error" ></span>
                                               <?php echo form_error('email'); ?>
                                    </fieldset>
                        <fieldset class="full-width">
                         <h4>Company Information</h4>
                         </fieldset>
                         <fieldset <?php if ($comp_name) { ?> class="error-msg" <?php } ?>>
                                    <label>Company Name :<span class="red">*</span> </label>
                                    <input name="comp_name" tabindex="4" autofocus type="text" id="comp_name" placeholder="Enter Company Name"  value="<?php
                                    if ($compname) {
                                        echo $compname;
                                    }
                                    ?>" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/><span id="fullname-error"></span>
                                </fieldset>
                                <?php echo form_error('comp_name'); ?>
                                    <fieldset <?php if ($comp_email) { ?> class="error-msg" <?php } ?>>
                                    <label>Company Email:<span class="red">* </span></label>
                                    <input name="comp_email" type="text" tabindex="5" id="comp_email" placeholder="Enter Company Email" value="<?php
                                    if ($compemail) {
                                        echo $compemail;
                                    }
                                    ?>" /><span id="fullname-error"></span>
                                </fieldset>
                                <?php echo form_error('comp_email'); ?>
                       
                        <fieldset class="full-width <?php if ($comp_num) { ?> error-msg <?php } ?>">
                                    <label>Company Number:<span class="optional">(optional)</span></label>
                                    <input name="comp_num"  type="text" id="comp_num" tabindex="6" placeholder="Enter Comapny Number" value="<?php
                                    if ($compnum) {
                                        echo $compnum;
                                    }
                                    ?>"/><span id="email-error"></span>
                                </fieldset>
                                <?php echo form_error('comp_num'); ?>
                        <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                    <label>Country:<span class="red">*</span></label>

                                    <select tabindex="7" autofocus name="country" id="country">
                                        <option value="">Select Country</option>
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
                                    <label>State:<span class="red">*</span> </label>
                                    <select name="state" id="state" tabindex="8">
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
                                <fieldset <?php if ($city) { ?> class="error-msg" <?php } ?> class="full-width">
                                    <label> City:<span class="optional">(optional)</span></label>
                                    <select name="city" id="city" tabindex="9">
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
                                            <option value="">Select City</option>
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

                               
                         
                         <fieldset <?php if ($comp_profile) { ?> class="error-msg" <?php } ?> class="full-width">
                                    <label>Company Profile:<span class="optional">(optional)</span><!-- <span style="color:red">*</span> -->

                                        <textarea tabindex="10" name ="comp_profile" id="comp_profile" rows="4" cols="50" placeholder="Enter Company Profile" style="resize: none;"><?php
                                            if ($comp_profile1) {
                                                echo $comp_profile1;
                                            }
                                            ?></textarea>
                                        <?php ?> 
                                </fieldset>
                         <input type="hidden" id="segment" value="<?php echo  $this->uri->segment(3); ?>">
                         
                         
                         
                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <input title="Register" type="submit" id="submit" name="" value="Register" tabindex="11">
                           </div>
                        </fieldset>
    </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- END CONTAINER -->
 <!-- BEGIN FOOTER -->
        <?php echo $login_footer ?>
        <?php echo $footer; ?>
        <!-- END FOOTER -->
        
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

  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js') ?>"></script>
   <script src="<?php echo base_url('assets/js/jquery.fancybox.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>
        
  <script>
                                        var base_url = '<?php echo base_url(); ?>';
                                        var data1 = <?php echo json_encode($de); ?>;
                                        var data = <?php echo json_encode($demo); ?>;
                                        var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                        var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        
  </script>
        <!-- FIELD VALIDATION JS END -->
   <?php
        if (IS_REC_JS_MINIFY == '0') {
            ?>
     <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/recruiter/search.js'); ?>"></script>
        <script type="text/javascript" src="<?php // echo base_url('assets/js/webpage/recruiter/basic_info.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/recruiter/rec_reg.js'); ?>"></script>
            <?php
        } else {
            ?>
            <!--<script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/webpage/recruiter/rec_basic_info.min.js?ver=' . time()); ?>"></script>-->
        <?php } ?>
</body>
</html>