
<!DOCTYPE html>
<html>
   <head>
<!-- start head -->
<?php echo $head; ?>
<!-- Calender Css Start-->

 <title>Job Profile - Aileensoul.com</title>

<!-- Calender Css End-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
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
                      <?php
                                if ($this->uri->segment(3) == 'live-post') {
                                    echo '<div class="alert alert-success">Your post will be automatically apply successfully after completing this step...!</div>';
                                }
                                ?>
                     <div class="common-form job_reg_main">
                        <h3>Welcome In Job Profile</h3>
                        <?php echo form_open(base_url('job/job_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                        <fieldset>
                           <label >First Name <font  color="red">*</font> :</label>
                             <?php     if ($livepost) { ?>
                                         <input type="hidden" name="livepost" id="livepost" tabindex="5"  value="<?php echo $livepost;?>">
                                    <?php    }
                                        ?>
                           <input type="text" name="first_name" id="first_name" tabindex="1" placeholder="Enter your First Name" style="text-transform: capitalize;" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" value="<?php echo $job[0]['first_name'];?>" maxlength="35">
                           <?php echo form_error('first_name');; ?>
                        </fieldset>
                        <fieldset>
                           <label >Last Name <font  color="red">*</font>:</label>
                           <input type="text" name="last_name" id="last_name" tabindex="2" placeholder="Enter your Last Name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="<?php echo $job[0]['last_name'];?>" maxlength="35">
                           <?php echo form_error('last_name');; ?>
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Email Address <font  color="red">*</font> :</label>
                           <input type="email" name="email" id="email" tabindex="3" placeholder="Enter your Email Address" value="<?php echo $job[0]['user_email'];?>" maxlength="255">
                           <?php echo form_error('email');; ?>
                        </fieldset>
                        <fieldset class="fresher_radio col-xs-12" >
                           <label>Fresher <font  color="red">*</font> : </label>
                           <div class="main_raio">
                              <input type="radio" value="Fresher" tabindex="4" id="test1" name="fresher" class="radio_job" id="fresher" onclick="not_experience()">
                              <label for="test1" class="point_radio" >Yes</label>
                           </div>

                           <div class="main_raio">
                              <input type="radio" tabindex="5" value="Experience" id="test2" class="radio_job" name="fresher" id="fresher" onclick="experience()">
                              <label for="test2" class="point_radio">No</label>
                           </div>
                           <div class="fresher-error"><?php echo form_error('fresher'); ?></div>
                        </fieldset>
                        <fieldset class="full-width">
                            <div id="exp_data" style="display:none;">
                               <label>Total Experience<span class="red">*</span>:</label>
                                                      <select style="width: 45%; margin-right: 4%; float: left;" tabindex="6" autofocus name="experience_year" id="experience_year" tabindex="1" class="experience_year keyskil" onchange="expyear_change();">
                                                         <option value="" selected option disabled>Year</option>
                                                         <option value="0 year">0 year</option>
                                                         <option value="1 year">1 year</option>
                                                         <option value="2 year" >2 year</option>
                                                         <option value="3 year" >3 year</option>
                                                         <option value="4 year">4 year</option>
                                                         <option value="5 year">5 year</option>
                                                         <option value="6 year">6 year</option>
                                                         <option value="7 year">7 year</option>
                                                         <option value="8 year">8 year</option>
                                                         <option value="9 year">9 year</option>
                                                         <option value="10 year">10 year</option>
                                                         <option value="11 year" >11 year</option>
                                                         <option value="12 year">12 year</option>
                                                         <option value="13 year">13 year</option>
                                                         <option value="14 year">14 year</option>
                                                         <option value="15 year">15 year</option>
                                                         <option value="16 year">16 year</option>
                                                         <option value="17 year">17 year</option>
                                                         <option value="18 year">18 year</option>
                                                         <option value="19 year">19 year</option>
                                                         <option value="20 year">20 year</option>
                                                      </select>
                                                    <!--   <?php// echo form_error('experience_year'); ?> -->
                                                      <select style="width: 45%;" name="experience_month" tabindex="7"   id="experience_month" class="experience_month keyskil" onclick="expmonth_click();">
                                                         <option value="" selected option disabled>Month</option>
                                                         <option value="0 month">0 month</option>
                                                         <option value="1 month">1 month</option>
                                                         <option value="2 month">2 month</option>
                                                         <option value="3 month">3 month</option>
                                                         <option value="4 month">4 month</option>
                                                         <option value="5 month">5 month</option>
                                                         <option value="6 month">6 month</option>
                                                         <option value="7 month">7 month</option>
                                                         <option value="8 month">8 month</option>
                                                         <option value="9 month">9 month</option>
                                                         <option value="10 month">10 month</option>
                                                         <option value="11 month">11 month</option>
                                                         <option value="12 month">12 month</option>
                                                      </select>
                                                      <?php echo form_error('experience_month'); ?>
                            </div>
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Job Title<font  color="red">*</font> :</label>
                           <input type="search" tabindex="8" id="job_title" name="job_title" value="" placeholder="Ex:- Sr. Engineer, Jr. Engineer, Software Developer, Account Manager" style="text-transform: capitalize;" onfocus="this.value = this.value;" maxlength="255">
                           <?php echo form_error('job_title'); ?>
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="skills"> Skills<font  color="red">*</font> : </label>
                           <input id="skills2" style="text-transform: capitalize;" name="skills" tabindex="9"  size="90" placeholder="Enter SKills">
                           <?php echo form_error('skills'); ?>
                        </fieldset>
                        <fieldset class="full-width main_select_data">
                           <label>Industry <font  color="red">*</font> :</label>
                           <select name="industry" id="industry" tabindex="10">
                              <option value="" selected="selected">Select industry</option>
                              <?php foreach ($industry as $indu) { ?>
                              <option value="<?php echo $indu['industry_id']; ?>"><?php echo $indu['industry_name']; ?></option>
                              <?php } ?>
                               <option value="<?php echo $other_industry[0]['industry_id']; ?>"><?php echo $other_industry[0]['industry_name']; ?></option>
                           </select>
                           <?php echo form_error('industry');; ?>
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="cities">Preffered location for job<font  color="red">*</font> : </label>
                           <input id="cities2" name="cities"  style="text-transform: capitalize;" size="90" tabindex="11" placeholder="Enter Preferred Cites">
                           <?php echo form_error('cities');; ?>
                        </fieldset>
                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <input title="Register" type="submit" id="submit" name="" value="Register" tabindex="10">
                           </div>
                        </fieldset>
                        <?php echo form_close();?>
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


<!-- <footer>        -->
<?php echo $login_footer ?> 
<?php echo $footer;  ?>
<!-- </footer> -->

 
   <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()) ?>"></script>
   <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>
  
<!-- This Js is used for call popup -->

<!-- This Js is used for call popup -->
 

   <script>
       function experience(){
         document.getElementById('exp_data').style.display = 'block';
       }
       
       function not_experience(){
           var melement = document.getElementById('exp_data');
               
               if(melement.style.display == 'block'){
                   melement.style.display = 'none';
               }
       
       }
       function expyear_change() {
        var experience_year = document.querySelector("#experience_year").value;
        if (experience_year)
        {   $('#experience_month').attr('disabled', false);
            var experience_year = document.getElementById('experience_year').value;
            if (experience_year === '0 year') {
                $("#experience_month option[value='0 month']").attr('disabled', true);
            } else {
                $("#experience_month option[value='0 month']").attr('disabled', false);
            }
        } else
        {
            $('#experience_month').attr('disabled', 'disabled');
        }
}

//function expmonth_click() { 
//        var experience_year = document.querySelector("#experience_year").value;
//        
//        if (experience_year == "")
//        {  
//           
//                $("#experience_month option[value='0 month']").attr('disabled', true);
//           
//        } else
//        {//alert(11100);
//                $("#experience_month option[value='0 month']").attr('disabled', false);
//          //  $('#experience_month').attr('disabled', 'disabled');
//        }
//}



       $(".alert").delay(3200).fadeOut(300);
     var base_url = '<?php echo base_url(); ?>';
  </script>


  <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/job/job_reg.js?ver='.time()); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/job/search_job_reg&skill.js?ver='.time()); ?>"></script>

</body>
</html>