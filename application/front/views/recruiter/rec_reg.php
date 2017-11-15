
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
                           <label >First Name <font  color="red">*</font> :</label>
                        
                                         
                                    
                           <input type="text" name="first_name" id="first_name" tabindex="1" placeholder="Enter your First Name" style="text-transform: capitalize;"  maxlength="35">
                           
                        </fieldset>
                        <fieldset>
                           <label >Last Name <font  color="red">*</font>:</label>
                           <input type="text" name="last_name" id="last_name" tabindex="2" placeholder="Enter your Last Name" style="text-transform: capitalize;"  maxlength="35">
                          
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