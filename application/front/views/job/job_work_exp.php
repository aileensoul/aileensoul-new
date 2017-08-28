<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

       <title>Work Experience - Aileensoul.com</title>

      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
      <!-- This Css is used for call popup -->
      <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css'); ?>">
   </head>
   <!-- END HEAD -->
   <!-- Start HEADER -->
   <?php 
      echo $header; 
      echo $job_header2_border;  
      ?>
   <!-- END HEADER -->
   <body class="page-container-bg-solid page-boxed">
      <div id="preloader"></div>
      <section>
         <div class="user-midd-section" id="paddingtop_fixed_job">
         <div class="common-form1">
            <div class="col-md-3 col-sm-4"></div>
            <div class="col-md-6 col-sm-8">
               <h3>You are updating your Job Profile.</h3>
            </div>
            <br>
            <br>
         </div>
         <br>
         <div class="container">
         <div class="row">
            <!-- Job leftbar start-->
            <?php echo $job_left; ?>
            <!-- Job leftbar End-->
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
                  <div class="col-md-12 col-sm-12 ">
                     <div class="clearfix">
                        <div class="common-form common-form_border">
                           <h3>Work Experience </h3>
                           <div class="work_exp fw">
                              <div class="">
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-group wrap" id="bs-collapse">
                                       <div class="panel">
                                          <div  id="panel-heading" <?php if($userdata[0]['experience'] == 'Fresher'){ ?> class="panel-heading active" <?php } else if($userdata[0]['experience'] == ''){?> class="panel-heading" <?php }else{?> class="panel-heading" <?php } ?>>
                                             <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#bs-collapse" href="#one" id="toggle" >
                                                Fresher
                                                </a>
                                             </h4>
                                          </div>
                                          <div id="one"  <?php if($userdata[0]['experience'] == 'Experience'){ ?> class="panel-collapse collapse" <?php }else if($userdata[0]['experience'] == ''){?> class="panel-collapse collapse" <?php }else{?> class="panel-collapse collapse in" <?php } ?>>
                                             <div class="panel-body">
                                                <?php echo form_open_multipart(base_url('job/job_work_exp_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                                
                                                <label for="Fresher">
                                                <input type="checkbox" id="fresher" name="radio" value="Fresher" <?php echo ($userdata[0]['experience'] == 'Fresher') ? 'checked' : '' ?>>
                                                Fresher&nbsp;&nbsp;
                                                </label>
                                                <fieldset class="hs-submit full-width left_nest">
                                                   <input type="submit" id="next" tabindex="2" name="next" value="Save">
                                                </fieldset>
                                                <?php echo form_close(); ?>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- end of panel -->
                                       <div class="panel">
                                          <div  id="panel-heading1"  <?php if($userdata[0]['experience'] == 'Experience'){ ?> class="panel-heading active" <?php } else if($userdata[0]['experience'] == ''){?>  class="panel-heading" <?php }else{?> class="panel-heading" <?php } ?>>
                                             <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#bs-collapse" href="#two" id="toggle1" >
                                                Experience
                                                </a>
                                             </h4>
                                          </div>
                                          <div id="two"   <?php if($userdata[0]['experience'] == 'Fresher'){ ?> class="panel-collapse collapse" <?php } else if($userdata[0]['experience'] == ''){?> class="panel-collapse collapse"<?php }else{?> class="panel-collapse collapse in" <?php } ?>>
                                             <div class="panel-body">
                                                <?php echo form_open_multipart(base_url('job/job_work_exp_insert'), array('id' => 'jobseeker_regform1', 'name' => 'jobseeker_regform1', 'class' => 'clearfix')); ?>       
                                  
                                                <!--UPDATE TIME-->
                                                <?php
                                                   $clone_mathod_count = 1;
                                                   if ($workdata) {
                                                   
                                                       $count = count($workdata);
                                                   
                                                       if ($count == 0) {
                                                           // this is use for javascript
                                                           $clone_mathod_count = 1;
                                                       } else {
                                                           $clone_mathod_count = $count;
                                                       }
                                                   
                                                       for ($x = 0; $x < $count; $x++) {
                                                   
                                                           $experience_year1 = $workdata[$x]['experience_year'];
                                                           $experience_month1 = $workdata[$x]['experience_month'];
                                                           $jobtitle1 = $workdata[$x]['jobtitle'];
                                                           $companyname1 = $workdata[$x]['companyname'];
                                                           $companyemail1 = $workdata[$x]['companyemail'];
                                                           $companyphn1 = $workdata[$x]['companyphn'];
                                                   
                                                           $work_certificate1 = $workdata[$x]['work_certificate'];
                                                           $y = $x + 1;
                                                   
                                                           ?>
                                                <input type="hidden" name="exp_data[]" value="old" class="exp_data" id="exp_data<?php echo $y; ?>">
                                                <div id="input<?php echo $y; ?>" style="margin-bottom:4px;" class="clonedInput job_work_edit_<?php echo $workdata[$x]['work_id']?>">
                                                   <div class="job_work_experience_main_div">
                                                      <label>Experience:<span class="red">*</span></label>
                                                      <select style="width: 45%; margin-right: 43px; float: left;" tabindex="1" autofocus name="experience_year[]" id="experience_year" class="experience_year keyskil" onchange="expyear_change_edittime();">
                                                         <option value="" selected option disabled>Year</option>
                                                         <option value="0 year"  <?php if ($experience_year1 == "0 year") echo 'selected'; ?>>0 year</option>
                                                         <option value="1 year"  <?php if ($experience_year1 == "1 year") echo 'selected'; ?>>1 year</option>
                                                         <option value="2 year"  <?php if ($experience_year1 == "2 year") echo 'selected'; ?>>2 year</option>
                                                         <option value="3 year"  <?php if ($experience_year1 == "3 year") echo 'selected'; ?>>3 year</option>
                                                         <option value="4 year"  <?php if ($experience_year1 == "4 year") echo 'selected'; ?>>4 year</option>
                                                         <option value="5 year"  <?php if ($experience_year1 == "5 year") echo 'selected'; ?>>5 year</option>
                                                         <option value="6 year"  <?php if ($experience_year1 == "6 year") echo 'selected'; ?>>6 year</option>
                                                         <option value="7 year"  <?php if ($experience_year1 == "7 year") echo 'selected'; ?>>7 year</option>
                                                         <option value="8 year"  <?php if ($experience_year1 == "8 year") echo 'selected'; ?>>8 year</option>
                                                         <option value="9 year"  <?php if ($experience_year1 == "9 year") echo 'selected'; ?>>9 year</option>
                                                         <option value="10 year"  <?php if ($experience_year1 == "10 year") echo 'selected'; ?>>10 year</option>
                                                         <option value="11 year"  <?php if ($experience_year1 == "11 year") echo 'selected'; ?>>11 year</option>
                                                         <option value="12 year"  <?php if ($experience_year1 == "12 year") echo 'selected'; ?>>12 year</option>
                                                         <option value="13 year"  <?php if ($experience_year1 == "13 year") echo 'selected'; ?>>13 year</option>
                                                         <option value="14 year"  <?php if ($experience_year1 == "14 year") echo 'selected'; ?>>14 year</option>
                                                         <option value="15 year"  <?php if ($experience_year1 == "15 year") echo 'selected'; ?>>15 year</option>
                                                         <option value="16 year"  <?php if ($experience_year1 == "16 year") echo 'selected'; ?>>16 year</option>
                                                         <option value="17 year"  <?php if ($experience_year1 == "17 year") echo 'selected'; ?>>17 year</option>
                                                         <option value="18 year"  <?php if ($experience_year1 == "18 year") echo 'selected'; ?>>18 year</option>
                                                         <option value="19 year"  <?php if ($experience_year1 == "19 year") echo 'selected'; ?>>19 year</option>
                                                         <option value="20 year"  <?php if ($experience_year1 == "20 year") echo 'selected'; ?>>20 year</option>
                                                      </select>
                                                      <select style="width: 45%;" name="experience_month[]" tabindex="2"   id="experience_month" class="experience_month keyskil">
                                                         <option value="" selected option disabled>Month</option>
                                                         <option value="0 month"  <?php if ($experience_month1 == "0 month") echo 'selected'; if ($experience_year1 == "0 year") echo 'selected option disabled'; ?>>0 month</option>
                                                         <option value="1 month"  <?php if ($experience_month1 == "1 month") echo 'selected'; ?>>1 month</option>
                                                         <option value="2 month"  <?php if ($experience_month1 == "2 month") echo 'selected'; ?>>2 month</option>
                                                         <option value="3 month"  <?php if ($experience_month1 == "3 month") echo 'selected'; ?>>3 month</option>
                                                         <option value="4 month"  <?php if ($experience_month1 == "4 month") echo 'selected'; ?>>4 month</option>
                                                         <option value="5 month"  <?php if ($experience_month1 == "5 month") echo 'selected'; ?>>5 month</option>
                                                         <option value="6 month"  <?php if ($experience_month1 == "6 month") echo 'selected'; ?>>6 month</option>
                                                         <option value="7 month"  <?php if ($experience_month1 == "7 month") echo 'selected'; ?>>7 month</option>
                                                         <option value="8 month"  <?php if ($experience_month1 == "8 month") echo 'selected'; ?>>8 month</option>
                                                         <option value="9 month"  <?php if ($experience_month1 == "9 month") echo 'selected'; ?>>9 month</option>
                                                         <option value="10 month"  <?php if ($experience_month1 == "10 month") echo 'selected'; ?>>10 month</option>
                                                         <option value="11 month"  <?php if ($experience_month1 == "11 month") echo 'selected'; ?>>11 month</option>
                                                         <option value="12 month"  <?php if ($experience_month1 == "12 month") echo 'selected'; ?>>12 month</option>
                                                      </select>
                                                      <?php echo form_error('experience_year'); ?>
                                                      <?php echo form_error('experience_month'); ?>
                                                      <label  style="    margin-top: 6px;">Job Title:<span class="red">*</span></label>
                                                      <input type="text" name="jobtitle[]" tabindex="3"  class="jobtitle" id="jobtitle"  placeholder="Enter Job Title" value="<?php
                                                         if ($jobtitle1) {
                                                             echo $jobtitle1;
                                                         }
                                                         ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/>&nbsp;&nbsp;&nbsp;
                                                      <?php echo form_error('jobtitle'); ?>
                                                      </span>
                                                      <label style="   margin-top: 6px; ">Organization Name:<span class="red">*</span></label>
                                                      <input type="text" name="companyname[]" id="companyname"  class="companyname" placeholder="Enter Organization Name" value="<?php
                                                         if ($companyname1) {
                                                             echo $companyname1;
                                                         }
                                                         ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; 
                                                      <?php echo form_error('companyname'); ?>
                                                      <label style="  margin-top: 6px;  ">Organization Email:</label>
                                                      <input type="text" name="companyemail[]" tabindex="4" id="companyemail" class="companyemail" placeholder="Enter Organization Email" value="<?php
                                                         if ($companyemail1) {
                                                             echo $companyemail1;
                                                         }
                                                         ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; 
                                                      <label style="  margin-top: 6px;  ">Organization Phone:</label>
                                                      <input type="text" name="companyphn[]" id="companyphn" class="companyphn" placeholder="Enter Organization Phone" tabindex="5" value="<?php
                                                         if ($companyphn1) {
                                                             echo $companyphn1;
                                                         }
                                                         ?>"  maxlength="15" />&nbsp;&nbsp;&nbsp; <span id="companyphn-error"> </span>
                                                      <?php echo form_error('companyphn'); ?>
                                                      <label style="    margin-top: -14px; display: block;">Experience Certificate:</label>
                                                      <input style="width:100%;  margin-bottom: 50px; display: inline-block;" type="file" name="certificate[]" id="certificate" tabindex="6" class="certificate fl" placeholder="CERTIFICATE" />
                                                      <div class="bestofmine_image_degree" style="color:#f00; display: block;"></div>
                                                      &nbsp;&nbsp;&nbsp; 
                                                      <?php
                                                         if ($work_certificate1) {
                                                             ?>
                                                      <div class="img_work_exp fl" style=" " >
                                                         <?php
                                                            $ext = explode('.',$work_certificate1);
                                                            if($ext[1] == 'pdf')
                                                               { 
                                                            ?>
                                                        
                                                         <a title="open pdf" href="<?php echo base_url($this->config->item('job_work_main_upload_path') . $work_certificate1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                         <?php
                                                            }//if($ext[1] == 'pdf')
                                                            else
                                                            {
                                                            ?>
                                                         <img src="<?php echo base_url($this->config->item('job_work_main_upload_path'). $work_certificate1) ?>" style="width:100px;height:100px;">
                                                         <?php
                                                            }//else end
                                                            ?>
                                                      </div>
                                                      <?php
                                                         }//if $work_certificate1 end
                                                         ?>
                                                      <?php if($work_certificate1)
                                                         {
                                                         ?>
                                                      <div style="float: left;" id="work_certi">
                                                         <div class="hs-submit full-width fl">
                                                            <input  type="button" class="delete_graduation"  value="" onClick="delete_workexp('<?php echo $workdata[$x]['work_id']; ?>','<?php echo $work_certificate1; ?>')">
                                                         </div>
                                                      </div>
                                                      <?php
                                                         }
                                                         ?>
                                                      <span id="certificate-error"> </span>
                                                      <?php echo form_error('certificate'); ?>
                                                      <input type="hidden" name="image_hidden_certificate[]" value="<?php
                                                         if ($work_certificate1) {
                                                             echo $work_certificate1;
                                                         }
                                                         ?>">
                                                      <?php if ($y != 1) {
                                                         ?>
                                                      <div class="hs-submit full-width fl " style="margin-top: 29px;">
                                                         <input class="delete_btn" style="min-width: 70px;" type="button" value="Delete" onclick="delete_job_work('<?php echo $workdata[$x]['work_id']; ?>','<?php echo $work_certificate1; ?>')">
                                                      </div>
                                                      <?php } ?>
                                                   </div>
                                                </div>
                                                <?php
                                                   }
                                                   ?>
                                                <div class="hs-submit full-width fl"  style=" width: 100%; text-align: center;">
                                                   <input type="button" tabindex="6" id="btnAdd" value=" + ">
                                                   <input type="button" tabindex="7" id="btnRemove" value=" - " disabled="disabled">
                                                </div>
                                             
                                                <fieldset class="hs-submit full-width"> 
                                                   <input style="" type="submit"  tabindex="8" id="next" name="next" value="Save"  >
                                                </fieldset>
                                               
                                                <?php
                                                   }
                                                   //INSERT TIME
                                                    else {
                                                       ?>
                                                <!--clone div start-->              
                                                <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                                                   <label>Experience:<span class="red">*</span></label>
                                                   <select style="width:45%; float: left; margin-right: 43px;" name="experience_year[]" id="experience_year" class="experience_year keyskil" onchange="expyear_change();">
                                                      <option value="" selected option disabled>Year</option>
                                                      <option value="0 year"  <?php if ($experience_year1 == "0 year") echo 'selected'; ?>>0 year</option>
                                                      <option value="1 year"  <?php if ($experience_year1 == "1 year") echo 'selected'; ?>>1 year</option>
                                                      <option value="2 year"  <?php if ($experience_year1 == "2 year") echo 'selected'; ?>>2 year</option>
                                                      <option value="3 year"  <?php if ($experience_year1 == "3 year") echo 'selected'; ?>>3 year</option>
                                                      <option value="4 year"  <?php if ($experience_year1 == "4 year") echo 'selected'; ?>>4 year</option>
                                                      <option value="5 year"  <?php if ($experience_year1 == "5 year") echo 'selected'; ?>>5 year</option>
                                                      <option value="6 year"  <?php if ($experience_year1 == "6 year") echo 'selected'; ?>>6 year</option>
                                                      <option value="7 year"  <?php if ($experience_year1 == "7 year") echo 'selected'; ?>>7 year</option>
                                                      <option value="8 year"  <?php if ($experience_year1 == "8 year") echo 'selected'; ?>>8 year</option>
                                                      <option value="9 year"  <?php if ($experience_year1 == "9 year") echo 'selected'; ?>>9 year</option>
                                                      <option value="10 year"  <?php if ($experience_year1 == "10 year") echo 'selected'; ?>>10 year</option>
                                                      <option value="11 year"  <?php if ($experience_year1 == "11 year") echo 'selected'; ?>>11 year</option>
                                                      <option value="12 year"  <?php if ($experience_year1 == "12 year") echo 'selected'; ?>>12 year</option>
                                                      <option value="13 year"  <?php if ($experience_year1 == "13 year") echo 'selected'; ?>>13 year</option>
                                                      <option value="14 year"  <?php if ($experience_year1 == "14 year") echo 'selected'; ?>>14 year</option>
                                                      <option value="15 year"  <?php if ($experience_year1 == "15 year") echo 'selected'; ?>>15 year</option>
                                                      <option value="16 year"  <?php if ($experience_year1 == "16 year") echo 'selected'; ?>>16 year</option>
                                                      <option value="17 year"  <?php if ($experience_year1 == "17 year") echo 'selected'; ?>>17 year</option>
                                                      <option value="18 year"  <?php if ($experience_year1 == "18 year") echo 'selected'; ?>>18 year</option>
                                                      <option value="19 year"  <?php if ($experience_year1 == "19 year") echo 'selected'; ?>>19 year</option>
                                                      <option value="20 year"  <?php if ($experience_year1 == "20 year") echo 'selected'; ?>>20 year</option>
                                                   </select>
                                                   <select style="width:46%;" name="experience_month[]" id="experience_month" class="experience_month keyskil" disabled>
                                                      <option value="" selected option disabled>Month</option>
                                                      <option value="0 month"  <?php if ($experience_month1 == "0 month") echo 'selected'; ?>>0 month</option>
                                                      <option value="1 month"  <?php if ($experience_month1 == "1 month") echo 'selected'; ?>>1 month</option>
                                                      <option value="2 month"  <?php if ($experience_month1 == "2 month") echo 'selected'; ?>>2 month</option>
                                                      <option value="3 month"  <?php if ($experience_month1 == "3 month") echo 'selected'; ?>>3 month</option>
                                                      <option value="4 month"  <?php if ($experience_month1 == "4 month") echo 'selected'; ?>>4 month</option>
                                                      <option value="5 month"  <?php if ($experience_month1 == "5 month") echo 'selected'; ?>>5 month</option>
                                                      <option value="6 month"  <?php if ($experience_month1 == "6 month") echo 'selected'; ?>>6 month</option>
                                                      <option value="7 month"  <?php if ($experience_month1 == "7 month") echo 'selected'; ?>>7 month</option>
                                                      <option value="8 month"  <?php if ($experience_month1 == "8 month") echo 'selected'; ?>>8 month</option>
                                                      <option value="9 month"  <?php if ($experience_month1 == "9 month") echo 'selected'; ?>>9 month</option>
                                                      <option value="10 month"  <?php if ($experience_month1 == "10 month") echo 'selected'; ?>>10 month</option>
                                                      <option value="11 month"  <?php if ($experience_month1 == "11 month") echo 'selected'; ?>>11 month</option>
                                                      <option value="12 month"  <?php if ($experience_month1 == "12 month") echo 'selected'; ?>>12 month</option>
                                                   </select>
                                                   <?php echo form_error('experience_year'); ?>
                                                   <?php echo form_error('experience_month'); ?>
                                                   <label style="    margin-top: 6px;">Job Title:<span class="red">*</span></label>
                                                   <input type="text" name="jobtitle[]"  class="jobtitle" id="jobtitle"  placeholder="Enter Job Title" value="<?php
                                                      if ($jobtitle1) {
                                                          echo $jobtitle1;
                                                      }
                                                      ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; 
                                                   <?php echo form_error('jobtitle'); ?>
                                                   </span>
                                                   <label style=" margin-top: 6px;  ">Organization Name:<span class="red">*</span></label>
                                                   <input type="text" name="companyname[]" id="companyname"  class="companyname" placeholder="Enter Organization Name" value="<?php
                                                      if ($companyname1) {
                                                          echo $companyname1;
                                                      }
                                                      ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; 
                                                   <?php echo form_error('companyname'); ?>
                                                   <label style="   margin-top: 6px; ">Organization Email:</label>
                                                   <input type="text" name="companyemail[]" id="companyemail" class="companyemail" placeholder="Enter Organization Email" value="<?php
                                                      if ($companyemail1) {
                                                          echo $companyemail1;
                                                      }
                                                      ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; <span id="companyemail-error"> </span>
                                                  
                                                   <label style="  margin-top: 6px; ">Organization Phone:</label>
                                                   <input type="text" name="companyphn[]" id="companyphn" class="companyphn" placeholder="Enter Organization Phone" value="<?php
                                                      if ($companyphn1) {
                                                          echo $companyphn1;
                                                      }
                                                      ?>"   maxlength="15"/>&nbsp;&nbsp;&nbsp; <span id="companyphn-error"> </span>
                                                   <?php echo form_error('companyphn'); ?>
                                                 
                                                   <label style="      margin-top: -14px;  display: block;">Experience Certificate:</label>
                                                   <input style="width: 50%; display: inline-block;" type="file" name="certificate[]" id="certificate" class="certificate" placeholder="CERTIFICATE" />
                                                    <div class="bestofmine_image_degree" style="color:#f00; display: block;"></div>&nbsp;&nbsp;&nbsp; 

                                                   <?php
                                                      if ($work_certificate1) {
                                                          ?>
                                                   <div class="img_work_exp" style="">
                                                      <?php
                                                         $ext = explode('.',$work_certificate1);
                                                         if($ext[1] == 'pdf')
                                                            { 
                                                         ?>
                                                     
                                                      <a title="open pdf" href="<?php echo base_url($this->config->item('job_work_main_upload_path') . $work_certificate1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                      <?php
                                                         }//if($ext[1] == 'pdf')
                                                         else
                                                         {
                                                         ?>
                                                      <img src="<?php echo base_url($this->config->item('job_work_main_upload_path'). $work_certificate1) ?>" style="width:100px;height:100px;">
                                                      <?php
                                                         }//else end
                                                         ?>
                                                   </div>
                                                   <?php
                                                      }
                                                      ?>
                                                   <span id="certificate-error"> </span>
                                                   <?php echo form_error('certificate'); ?>
                                                   
                                                </div>
                                               
                                                <div class="hs-submit full-width fl" style="width: 100%; text-align: center;">
                                                   <input type="button" id="btnAdd" value=" + ">
                                                   <input type="button" id="btnRemove" value=" - " disabled="disabled">
                                                </div>
                                                <fieldset class="hs-submit full-width"> 
                                                   <input style="" type="submit" id="next" name="next" value="Save">
                                                </fieldset>
                                                <?php echo form_close(); ?> 
                                             </div>
                                          </div>
                                       </div>
                                       <!-- end of panel -->
                                    </div>
                                    <!-- end of #bs-collapse  -->
                                 </div>
                              </div>
                              <!-- end of container -->
                           </div>                             
                           <?php
                              }
                              ?>
                        </div>
                     </div>
                  </div>
                  <!-- middle section end -->
               </div>
            </div>
         </div>
      </section>
      <!-- END CONTAINER -->

<footer>        
<?php echo $footer;  ?>
</footer>

<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- This Js is used for call popup -->
<script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
<!-- duplicate div end -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script> 
<!-- This Js is used for call popup -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script> 


<script>
    var base_url = '<?php echo base_url(); ?>';
    var clone_mathod_count='<?php echo $clone_mathod_count; ?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_work_exp.js'); ?>"></script>

 </body>
</html>

