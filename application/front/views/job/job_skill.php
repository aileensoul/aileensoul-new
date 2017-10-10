<!DOCTYPE html>
<html>
   <head>
      <!-- start head -->
      <?php  echo $head; ?>
      <!-- END HEAD -->

      <title><?php echo $title; ?></title>

    
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/recruiter.css?ver='.time()); ?>">

<!-- This Css is used for call popup -->
<link rel="stylesheet" href="<?php echo base_url('css/jquery.fancybox.css?ver='.time()); ?>" />

   </head>
   <!-- END HEAD -->
   <!-- Start HEADER -->
   <?php 
      echo $header; 
      echo $job_header2_border;  
      ?>
   <!-- END HEADER -->
   <div class="js">
   <body class="page-container-bg-solid page-boxed">
      <section>
         <div class="user-midd-section" id="paddingtop_fixed_job">
            <div class="common-form1">
               <div class="col-md-3 col-sm-4"></div>
               <div class="col-md-6 col-sm-8">
                  <h3>You are updating your Job Profile.</h3>
               </div>
            </div>
           
            <div class="container">
               <div class="row row4">
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
                        <div class="common-form common-form_border">
                           <h3>Work Area</h3>
                           <?php echo form_open(base_url('job/job_skill_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix', 'onsubmit' => "imgval()")); ?>
                           <fieldset class="full-width">
                              <label >Job Title<font  color="red">*</font>:</label>
                              <input type="search" style="text-transform: capitalize;" tabindex="1" id="job_title" name="job_title" value="<?php echo $work_title; ?>" placeholder="Ex:- Sr. Engineer, Jr. Engineer, Software Developer, Account Manager" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                              <?php echo form_error('job_title'); ?>
                           </fieldset>
                           <fieldset class="full-width fresher_select main_select_data" >
                              <label for="skills"> Skills<font  color="red">*</font>: </label>
                              <input id="skills2" style="text-transform: capitalize;" value="<?php echo $work_skill; ?>" name="skills"  size="90" tabindex="2">
                              <?php echo form_error('skills'); ?>
                           </fieldset>
                           <fieldset class="full-width main_select_data">
                              <label>Industry <font  color="red">*</font>:</label>
                              <select name="industry" id="industry" tabindex="3">
                                 <option value="">Select industry</option>
                                 <?php foreach ($industry as $indu) { ?>
                                 <option value="<?php echo $indu['industry_id']; ?>" <?php if($indu['industry_id'] == $work_industry){ echo "selected"; } ?>><?php echo $indu['industry_name']; ?></option>
                                 
                                 <?php } ?>
                                    <option value="<?php echo $other_industry[0]['industry_id']; ?>"><?php echo $other_industry[0]['industry_name']; ?></option>  
                              </select>
                              <?php echo form_error('industry'); ?>
                           </fieldset>
                           <fieldset class="full-width fresher_select main_select_data" >
                              <label for="cities">Preffered loation for job<font  color="red">*</font>: </label>
                              <input id="cities2"  style="text-transform: capitalize;" value="<?php echo $work_city; ?>" name="cities"  size="90" tabindex="4">
                              <?php echo form_error('cities'); ?>
                           </fieldset>
                           <fieldset class="hs-submit full-width">
                              <input type="submit"  id="next" name="next" tabindex="5" value="Save">
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

<footer>        
<?php echo $footer;  ?>
</footer>

       
      <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>

     <!-- This Js is used for call popup -->
         <script src="<?php echo base_url('js/jquery.fancybox.js?ver='.time()); ?>"></script>
      <!-- This Js is used for call popup -->
      
      <script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js?ver='.time()); ?>"></script>
      <script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>"></script>
      <script>
         var base_url = '<?php echo base_url(); ?>';
      </script>

      <script type="text/javascript" src="<?php echo base_url('js/webpage/job/job_skill.js?ver='.time()); ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('js/webpage/job/search_common.js?ver='.time()); ?>"></script>
       <script type="text/javascript" src="<?php echo base_url('js/webpage/job/search_job_reg&skill.js?ver='.time()); ?>"></script>
      
   </body>
</html>