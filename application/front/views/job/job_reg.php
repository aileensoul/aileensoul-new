<!DOCTYPE html>
<html>
   <head>
<!-- start head -->
<?php echo $head; ?>
<!-- Calender Css Start-->

 <title>Job Profile - Aileensoul.com</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.datetimepicker.css?ver='.time()); ?>">
<!-- Calender Css End-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/job/job.css?ver='.time()); ?>">

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
                     <div class="common-form job_reg_main">
                        <h3>Welcome In Job Profile</h3>
                        <?php echo form_open(base_url('job/job_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                        <fieldset>
                           <label >First Name <font  color="red">*</font> :</label>
                           <input type="text" name="first_name" id="first_name" tabindex="1" placeholder="Enter your First Name" style="text-transform: capitalize;" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" value="<?php echo $job[0]['first_name'];?>" maxlength="35">
                        </fieldset>
                        <fieldset>
                           <label >Last Name <font  color="red">*</font>:</label>
                           <input type="text" name="last_name" id="last_name" tabindex="2" placeholder="Enter your Last Name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="<?php echo $job[0]['last_name'];?>" maxlength="35">
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Email Address <font  color="red">*</font> :</label>
                           <input type="email" name="email" id="email" tabindex="3" placeholder="Enter your Email Address" value="<?php echo $job[0]['user_email'];?>" maxlength="255">
                        </fieldset>
                        <fieldset class="fresher_radio col-xs-12" >
                           <label>Fresher <font  color="red">*</font> : </label>
                           <div class="main_raio">
                              <input type="radio" value="Fresher" tabindex="" id="test1" name="fresher" class="radio_job" id="fresher">
                              <label for="test1" class="point_radio" >Yes</label>
                           </div>
                           <div class="main_raio">
                              <input type="radio" tabindex="" value="Experience" id="test2" class="radio_job" name="fresher" id="fresher" checked>
                              <label for="test2" class="point_radio">No</label>
                           </div>
                        </fieldset>
                        <fieldset class="full-width">
                           <label >Job Title<font  color="red">*</font> :</label>
                           <input type="search" tabindex="6" id="job_title" name="job_title" value="" placeholder="Ex:- Sr. Engineer, Jr. Engineer, Software Developer, Account Manager" style="text-transform: capitalize;" onfocus="this.value = this.value;" maxlength="255">
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="skills"> Skills<font  color="red">*</font> : </label>
                           <input id="skills2" style="text-transform: capitalize;" name="skills" tabindex="7"  size="90" placeholder="Enter SKills">
                        </fieldset>
                        <fieldset class="full-width main_select_data">
                           <label>Industry <font  color="red">*</font> :</label>
                           <select name="industry" id="industry" tabindex="8">
                              <option value="">Select industry</option>
                              <?php foreach ($industry as $indu) { ?>
                              <option value="<?php echo $indu['industry_id']; ?>"><?php echo $indu['industry_name']; ?></option>
                              <?php } ?>
                           </select>
                        </fieldset>
                        <fieldset class="full-width fresher_select main_select_data" >
                           <label for="cities">Preffered location for job<font  color="red">*</font> : </label>
                           <input id="cities2" name="cities"  style="text-transform: capitalize;" size="90" tabindex="9" placeholder="Enter Preferred Cites">
                        </fieldset>
                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <input type="submit" id="submit" name="" value="Register" tabindex="10">
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

<footer>        
<?php echo $footer;  ?>
</footer>

 <!-- script for skill textbox automatic start -->
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>
<!-- script for skill textbox automatic end -->
   <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver='.time()); ?>"></script>
   <script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>"></script>
  

   <script>
     var base_url = '<?php echo base_url(); ?>';
  </script>


  <script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_reg.js?ver='.time()); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/webpage/job/search_job_reg&skill.js?ver='.time()); ?>"></script>

</body>
</html>