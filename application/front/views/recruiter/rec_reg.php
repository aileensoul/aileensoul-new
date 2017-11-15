
<!DOCTYPE html>
<html>
   <head>
<!-- start head -->
<!-- Calender Css Start-->

 <title>Recruiter Profile - Aileensoul.com</title>




<link rel="icon" href="http://localhost/aileensoul-new/assets/images/favicon.png?ver=1510731321">
<!-- CSS START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/common-style.css?ver=1510731321'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/media.css?ver=1510731321'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/animate.css?ver=1510731321'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver=1510731321'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">

<!-- Calender Css End-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css'); ?>">
</head>
<!-- END HEAD -->

<!-- start header -->
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
                        <h3>Welcome In Recruiter Profile</h3>
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
                                        <input name="last_name" type="text" tabindex="2" placeholder="Enter Last Name"
                                               value="<?php
                                               if ($lastname) {
                                                   echo trim(ucfirst(strtolower($lastname)));
                                               } else {
                                                   echo trim(ucfirst(strtolower($userdata[0]['last_name'])));
                                               }
                                               ?>" id="last_name" /><span id="fullname-error" ></span>
                                               <?php echo form_error('last_name'); ?>
                                    </fieldset>
                                </div>
                                <div class="fw">

                                    <fieldset>
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
                        
                       

                         <h3>Company Information</h3>
                          <fieldset>
                                    <label>Company Name :<span class="red">*</span> </label>
                                    <input name="comp_name" tabindex="3" autofocus type="text" id="comp_name" placeholder="Enter your Company Name">
                                </fieldset>

                        <fieldset class="half-width">
                           <label >Email Address <font  color="red">*</font> :</label>
                           <input type="email" name="email" id="email" tabindex="4" placeholder="Enter your Email Address"  maxlength="255">
                      
                        </fieldset>
                       
                        <fieldset class="full-width">
                           <label >Number<font  color="red">*</font> :</label>
                           <input type="search" tabindex="5" id="job_title" name="job_title" value="" placeholder="Enter Your Number" style="text-transform: capitalize;"  maxlength="255">
                        
                        </fieldset>
                        <fieldset class="">
                                    <label>Country:<span class="red">*</span></label>

                                    <select tabindex="5" autofocus name="country" id="country">
                                        <option value="">Select Country</option>
                                       
                                                    <option value=""></option>

                                                    <option value=""></option>
                                           
                                    </select>
                                </fieldset>

                                <fieldset class="">
                                    <label>State:<span class="red">*</span> </label>
                                    <select name="state" id="state" tabindex="6" >
                                        

                                                <option value=""></option>

                                            <option value="">Select country first</option>
                                    </select>
                                </fieldset>


                                <fieldset class="full-width">
                                    <label> City:<span class="optional">(optional)</span></label>
                                    <select name="city" id="city" tabindex="7">
                                    
                                                <option value=""></option>
                                            <option value="">Select City</option>
                                           

                                                <option value=""></option>
                                            <option value="">Select state first</option>

                                    </select>
                                </fieldset>
                                  <fieldset class="full-width">
                                    <label>Company Profile:<span class="optional">(optional)</span>

                                        <textarea tabindex="8" name ="comp_profile" id="comp_profile" rows="4" cols="50" placeholder="Enter Company Profile" style="resize: none;">
                                          </textarea>
                                    
                                </fieldset>

                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <input title="Register" type="submit" id="submit" name="" value="Register" tabindex="9">
                           </div>
                        </fieldset>
   
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



</body>
</html>