
<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->

 <!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed_job">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                                 <li><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>

                                <li><a href="<?php echo base_url('job/job_address_update'); ?>">Address</a></li>

                                  <li><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>


                                  <li><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li><a href="<?php echo base_url('job/job_skill_update'); ?>">Professional Skills</a></li>

                                <li><a href="<?php echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li>
                              
                                <li <?php if($this->uri->segment(1) == 'job'){?> class="active" <?php } ?>><a href="#">Work Experience</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '7'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '7'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '7'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_carrier_update'); ?>">Carrier Objectives</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
                    <div class="col-md-6 col-sm-8">

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

                        <div class="clearfix">
                            <div class="common-form">
                                <h3>Work Experience</h3>
                            <?php echo form_open_multipart(base_url('job/job_add_workexp_insert'), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform','class'=>'clearfix')); ?>

                            <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>

                                <?php
                                 $jobtitle =  form_error('jobtitle');
                                 $companyname =  form_error('companyname');
                                 $experience_month =  form_error('experience_month');
                                 $certificate =  form_error('certificate');
                                 $interest =  form_error('interest');
                                
                                ?>

                                     <fieldset class="col-md-12" <?php if($experience_month) {  ?> class="error-msg" <?php } ?>>
                                        
      

                                       
                                        <fieldset class="two-select-box">
                                           <label>Experience<span style="color:red">*</span></label>
                                         <select name="experience_year" id="experience_year" class="experience_year">
                                          <option value="" selected option disabled>Year</option>
                                          <option value="0 year"  <?php if($experience_year1=="0 year") echo 'selected';?>>0</option>
                                          <option value="1 year"  <?php if($experience_year1=="1 year") echo 'selected';?>>1</option>
                                            <option value="2 year"  <?php if($experience_year1=="2 year") echo 'selected';?>>2</option>
                                          <option value="3 year"  <?php if($experience_year1=="3 year") echo 'selected';?>>3</option>
                                            <option value="4 year"  <?php if($experience_year1=="4 year") echo 'selected';?>>4</option>
                                          <option value="5 year"  <?php if($experience_year1=="5 year") echo 'selected';?>>5</option>
                                            <option value="6 year"  <?php if($experience_year1=="6 year") echo 'selected';?>>6</option>
                                          <option value="7 year"  <?php if($experience_year1=="7 year") echo 'selected';?>>7</option>  
                                          <option value="8 year"  <?php if($experience_year1=="8 year") echo 'selected';?>>8</option>
                                          <option value="9 year"  <?php if($experience_year1=="9 year") echo 'selected';?>>9</option> 
                                           <option value="10 year"  <?php if($experience_year1=="10 year") echo 'selected';?>>10</option>
                                          <option value="11 year"  <?php if($experience_year1=="11 year") echo 'selected';?>>11</option> 
                                           <option value="12 year"  <?php if($experience_year1=="12 year") echo 'selected';?>>12</option>
                                          <option value="13 year"  <?php if($experience_year1=="13 year") echo 'selected';?>>13</option> 
                                           <option value="14 year"  <?php if($experience_year1=="14 year") echo 'selected';?>>14</option>
                                          <option value="15 year"  <?php if($experience_year1=="15 year") echo 'selected';?>>15</option>
                                            <option value="16 year"  <?php if($experience_year1=="16 year") echo 'selected';?>>16</option>
                                          <option value="17 year"  <?php if($experience_year1=="17 year") echo 'selected';?>>17</option>
                                          <option value="18 year"  <?php if($experience_year1=="18 year") echo 'selected';?>>18</option>
                                          <option value="19 year"  <?php if($experience_year1=="19 year") echo 'selected';?>>19</option>
                                          <option value="20 year"  <?php if($experience_year1=="20 year") echo 'selected';?>>20</option>

                                        </select>
                                       

                                         <select name="experience_month" id="experience_month" class="experience_month">
                                          <option value="" selected option disabled>Month</option>
                                          <option value="1 month"  <?php if($experience_month1=="1 month") echo 'selected';?>>1</option>
                                          <option value="2 month"  <?php if($experience_month1=="2 month") echo 'selected';?>>2</option>
                                          <option value="3 month"  <?php if($experience_month1=="3 month") echo 'selected';?>>3</option>
                                          <option value="4 month"  <?php if($experience_month1=="4 month") echo 'selected';?>>4</option>
                                          <option value="5 month"  <?php if($experience_month1=="5 month") echo 'selected';?>>5</option>
                                          <option value="6 month"  <?php if($experience_month1=="6 month") echo 'selected';?>>6</option>

                                        </select>
                                      </fieldset>
                                      
                                        <?php echo form_error('experience_year'); ?>
                                        <?php echo form_error('experience_month'); ?>

                                          <fieldset <?php if($jobtitle) {  ?> class="error-msg" <?php } ?>>
                                         <label>Job Title<span style="color:red">*</span></label>
                                         <input type="text" name="jobtitle"  class="jobtitle" id="jobtitle"  placeholder="Enter Job Title" value="<?php if($jobtitle1){echo $jobtitle1; } ?>"/>&nbsp;&nbsp;&nbsp; <span id="jobtitle-error"> </span>
                                        <?php echo form_error('jobtitle'); ?>
                                    </fieldset>



                                <fieldset <?php if($companyname) {  ?> class="error-msg" <?php } ?>>
                                       <label>Company Name<span style="color:red">*</span></label>
                                         <input type="text" name="companyname" id="companyname"  class="companyname" placeholder="Enter Company Name" value="<?php if($companyname1){ echo $companyname1; } ?>"/>&nbsp;&nbsp;&nbsp; <span id="companyname-error"> </span>
                                        <?php echo form_error('companyname'); ?>
                                </fieldset>   


                                  <fieldset <?php if($companyemail) {  ?> class="error-msg" <?php } ?>> 
                                        <label>Company Email</label>
                                         <input type="text" name="companyemail" id="companyemail" class="companyemail" placeholder="Enter Company Email" value="<?php if($companyemail1){ echo $companyemail1; } ?>"/>&nbsp;&nbsp;&nbsp; <span id="companyemail-error"> </span>
                                       
                                    </fieldset>

                                       <fieldset <?php if($companyphn) {  ?> class="error-msg" <?php } ?>> 
                                        <label>Company Phone</label>
                                         <input type="text" name="companyphn" id="companyphn" class="companyphn" placeholder="Enter Company Phone" value="<?php if($companyphn1){ echo $companyphn1; } ?>"/>&nbsp;&nbsp;&nbsp; <span id="companyphn-error"> </span>
                                        <?php echo form_error('companyphn'); ?>
                                     </fieldset>

                                     <fieldset class="full-width"> 
                                       <label>Experience Certificate</label>
                                         <input type="file" name="certificate" id="certificate" class="certificate" placeholder="CERTIFICATE" />&nbsp;&nbsp;&nbsp; 

                                         <?php 

                                         if($work_certificate1)
                                         {
                                          ?>
                                       
                                      <img src="<?php echo base_url( JOBWORKCERTIFICATE.$work_certificate1)?>" style="width:100px;height:100px;">
                                  
                                      <?php 
                                    }
                                    ?>

                                         <span id="certificate-error"> </span>
                                        <?php echo form_error('certificate'); ?>
                                    </fieldset> 
                                  

                                    </fieldset>


                                  
                                     <fieldset class="hs-submit full-width left_nest">
                                     <!--<input type="reset">-->
                                    
                                       <input type="submit"  id="next" name="next" value="Submit">
                                     

                                </fieldset>

                                 </form> 


                            </div>    
                        </div>
                    </div>

                    <!-- middle section end -->

                    
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
   
</body>
</html>

   
   


  <script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
  <!-- duplicate div -->
  <script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/app.js') ?>"></script>
  <!-- duplicate div end -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

   <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 
            
                $("#jobseeker_regform").validate({

                    rules: {

                        jobtitle: {
                            required: true,
                           
                        }, 
                        companyname: {

                            required: true,
                           
                        }, 
                       
                         
                        experience_year: {

                            required: true,
                           
                        },   
                         

                         companyemail: {
                            email:true,
                        },

                       companyphn: {

                            minlength:10,
                            maxlength:11,
                            number: true,
                           
                        },
                    },

                    messages: {

                        jobtitle: {

                            required: "Job title Is Required.",
                            
                        },
                        companyname: {

                            required: "Company name Is Required.",
                            
                        },
                        
                        
                       experience_year: {

                            required: "Experience year Is Required.",
                            
                        },
                      
                        companyemail: {

                             email:"Please Enter Valid Email Id.",
                             
                        },
                        companyphn: {

                            required: "Phone no Is Required.",
                            
                        },

                    }

                });
                   });
  </script>
    
 <!--javascript for fresher and experience radio button End -->
<script type="text/javascript"> 
 $(".alert").delay(3200).fadeOut(300);
</script>
 