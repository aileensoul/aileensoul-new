<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
   -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<!-- This Css is used for call popup -->
<link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />

   

<?php //if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php //} ?>
<!-- END HEADER -->
<!-- This style is used for autocomplete start -->
 <style type="text/css">

/* Layout helpers
----------------------------------*/
.ui-helper-hidden {
  display: none;
}
.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.ui-front {
  z-index: 100;
}



/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  cursor: default;
}

.ui-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: block;
  outline: none;
}
.ui-menu .ui-menu {
  position: absolute;
}
.ui-menu .ui-menu-item {
  position: relative;
  margin: 0;
  padding: 3px 1em 3px .4em;
  cursor: pointer;
  min-height: 0; /* support: IE7 */
  /* support: IE10, see #8844 */
  list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
}
.ui-menu .ui-menu-divider {
  margin: 5px 0;
  height: 0;
  font-size: 0;
  line-height: 0;
  border-width: 1px 0 0 0;
}
.ui-menu .ui-state-focus,
.ui-menu .ui-state-active {
  margin: -1px;
}

/* Component containers
----------------------------------*/
.ui-widget {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1.1em;
}
.ui-widget .ui-widget {
  font-size: 1em;
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1em;
}
.ui-widget-content {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_flat_75_ffffff_40x100.png") 50% 50% repeat-x;
  color: #222222;
}
.ui-widget-content a {
  color: #222222;
}
.ui-widget-header {
  border: 1px solid #aaaaaa;
  background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
  color: #222222;
  font-weight: bold;
}
.ui-widget-header a {
  color: #222222;
}

/* Interaction states
----------------------------------*/
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
  border: 1px solid #d3d3d3;
  background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #555555;
}

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
  border: 1px solid #999999;
  background: #dadada url("images/ui-bg_glass_75_dadada_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_glass_65_ffffff_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

  </style>
<!-- This style is used for autocomplete End -->
<body class="page-container-bg-solid page-boxed">
   <div id="preloader"></div>
   <section>
      <div class="user-midd-section" id="paddingtop_fixed_job">
      <div class="common-form1">
         <div class="col-md-3 col-sm-4"></div>
         <?php
            $userid = $this->session->userdata('aileenuser');
            
            $contition_array = array('user_id' => $userid, 'status' => '1');
            $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            
            if ($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 6) { ?>
         <div class="col-md-6 col-sm-8">
            <h3>You are updating your Job Profile.</h3>
         </div>
         <?php } else {
            ?>
         <div class="col-md-6 col-sm-8">
            <h3>You are making your Job Profile.</h3>
         </div>
         <?php } ?>
         <br>
         <br>
      </div>
      <br>
      <div class="container">
      <div class="row">

          <?php echo $job_left; ?>
          
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
                  <!--          <div>
                              <span style="color:#7f7f7e;">( </span><span  class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                           </div> -->
                           <?php //echo $userdata[0]['experience']; die(); ?> 
                           <label for="Fresher">
                           <input type="checkbox" id="fresher" name="radio" value="Fresher" <?php echo ($userdata[0]['experience'] == 'Fresher') ? 'checked' : '' ?>>
                           Fresher&nbsp;&nbsp;
                           </label>
                           
                    <!-- <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div>    -->     
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
                           <!-- <div>
                              <span style="color:#7f7f7e;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                           </div> -->
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
                                    ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/>&nbsp;&nbsp;&nbsp; <!-- <span id="jobtitle-error"> </span> -->
                                 <?php echo form_error('jobtitle'); ?>
                                 </span>
                                 <label style="   margin-top: 6px; ">Organization Name:<span class="red">*</span></label>
                                 <input type="text" name="companyname[]" id="companyname"  class="companyname" placeholder="Enter Organization Name" value="<?php
                                    if ($companyname1) {
                                        echo $companyname1;
                                    }
                                    ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; <!-- <span id="companyname-error"> </span> -->
                                 <?php echo form_error('companyname'); ?>
                                 <label style="  margin-top: 6px;  ">Organization Email:</label>
                                 <input type="text" name="companyemail[]" tabindex="4" id="companyemail" class="companyemail" placeholder="Enter Organization Email" value="<?php
                                    if ($companyemail1) {
                                        echo $companyemail1;
                                    }
                                    ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; <!-- <span id="companyemail-error"> </span> -->
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
                                                        <!--  <a href="<?php //echo base_url('job/creat_pdf_workexp/'.$workdata[$x]['work_id']) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; font-size: 3em; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

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
                           <!--                                     <input type="reset">
                              <input type="submit"  id="previous" name="previous" value="previous">-->

                                <fieldset class="hs-submit full-width"> 
                           <input style="" type="submit"  tabindex="8" id="next" name="next" value="Save"  >
                                 </fieldset>
                           <!--<input type="submit"  id="add_workexp" name="add_workexp" value="Add More Work Expierence">--> 
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
                                 ?>" maxlength="255"/>&nbsp;&nbsp;&nbsp; <!-- <span id="jobtitle-error"> </span> -->
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
                              <!--   </fieldset>
                                 <fieldset >  -->
                              <label style="  margin-top: 6px; ">Organization Phone:</label>
                              <input type="text" name="companyphn[]" id="companyphn" class="companyphn" placeholder="Enter Organization Phone" value="<?php
                                 if ($companyphn1) {
                                     echo $companyphn1;
                                 }
                                 ?>"   maxlength="15"/>&nbsp;&nbsp;&nbsp; <span id="companyphn-error"> </span>
                              <?php echo form_error('companyphn'); ?>
                              <!--  </fieldset>
                                 <fieldset class="full-width"> -->
                              <label style="      margin-top: -14px;  display: block;">Experience Certificate:</label>
                              <input style="width: 50%; display: inline-block;" type="file" name="certificate[]" id="certificate" class="certificate" placeholder="CERTIFICATE" />&nbsp;&nbsp;&nbsp; 
                              <?php
                                 if ($work_certificate1) {
                                     ?>
                              <div class="img_work_exp" style="">
                              <?php
                                                   $ext = explode('.',$work_certificate1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                        <!--  <a href="<?php //echo base_url('job/creat_pdf_workexp/'.$workdata[$x]['work_id'].'/experience') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

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
                              <!--  </fieldset> -->
                           </div>
                           <!-- <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div> -->
                           <!--clone div End-->
                           <div class="hs-submit full-width fl" style="width: 100%; text-align: center;">
                              <input type="button" id="btnAdd" value=" + ">
                              <input type="button" id="btnRemove" value=" - " disabled="disabled">
                           </div>
                           <fieldset class="hs-submit full-width"> 
                              <input style="" type="submit" id="next" name="next" value="Save" onclick="document.getElementById('experience1')[0].style.display = 'block';">
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
                        
                     
                        
                        
                        <?php // echo form_open_multipart(base_url('job/job_work_exp_insert'), array('id' => 'jobseeker_regform2','name' => 'jobseeker_regform2','class'=>'clearfix'));    ?>         
                        <!--<input type="submit" id="previous" name="previous" value="previous">-->
                        <?php // echo form_close();    ?>                                 
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
</body>
</html>

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
<!--  <script type="text/javascript" src="<?php //echo base_url('js/jquery.validate1.15.0..min.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script> 

<!-- This Js is used for call popup -->
 <!-- <script src="<?php //echo base_url('js/bootstrap.min.js'); ?>"></script>  -->
 <!--new script for jobtitle,company and skill start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill  end-->

<!--new script for jobtitle,company and skill start for mobile view-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill for mobile view end-->

<!--new script for cities start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end-->

<!--new script for cities start mobile view-->
  <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end mobile view-->
<script type="text/javascript">
   function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }
   }
   
</script>

<script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>
<script type="text/javascript">

// $('#input1 .experience_year').on('change', function(){
//     if($(this).val()){
     
       
//        $('#input1 .experience_month').attr('disabled', false);
//     }else{
      
//         $('#input1 .experience_month').attr('disabled', 'disabled');
//     }
// });
function expyear_change(){

     var num = $('.clonedInput').length;
   //  alert(num);
    
if(num==1)
{
       
       var experience_year =  document.getElementById('experience_year').value;
       //first if is used for disble exp_month disable
       if(experience_year)
       {
          $('#experience_month').attr('disabled', false);
          //this if is used for disable 0 month disable
         if(experience_year==='0 year'){
           $("#experience_month option[value='0 month']").attr('disabled',true);} 
         else{
           $("#experience_month option[value='0 month']").attr('disabled',false);}
        }
         else
         {
           $('#experience_month').attr('disabled', 'disabled');
         }
}

if(num==2)
{
     
        var experience_year =  document.getElementById('experience_year').value;
         var experience_year2 =  document.getElementById('experience_year2').value;

  if(experience_year)
  {
          $('#experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month').attr('disabled', 'disabled');
  }
        
  if(experience_year2)
  {
          $('#experience_month2').attr('disabled', false);

          if(experience_year2==='0 year'){
           $("#experience_month2 option[value='0 month']").attr('disabled',true);} 
          else{
           $("#experience_month2 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month2').attr('disabled', 'disabled');
  }
}
      
if(num==3)
{
        var experience_year =  document.getElementById('experience_year').value;
        var experience_year2 =  document.getElementById('experience_year2').value;
        var experience_year3 =  document.getElementById('experience_year3').value;
  if(experience_year)
  {
          $('#experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month option[value='0 month']").attr('disabled',false);
         }
  }
  else
  {
           $('#experience_month').attr('disabled', 'disabled');
  }

if(experience_year2)
  {
          $('#experience_month2').attr('disabled', false);

        if(experience_year2==='0 year'){
           $("#experience_month2 option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month2 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month2').attr('disabled', 'disabled');
  }

if(experience_year3)
  {
          $('#experience_month3').attr('disabled', false);

        if(experience_year3==='0 year'){
           $("#experience_month3 option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month3 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month3').attr('disabled', 'disabled');
  }
}

if(num==4)
{
        var experience_year =  document.getElementById('experience_year').value;
        var experience_year2 =  document.getElementById('experience_year2').value;
        var experience_year3 =  document.getElementById('experience_year3').value;
        var experience_year4 =  document.getElementById('experience_year4').value;

  if(experience_year)
  {
          $('#experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month').attr('disabled', 'disabled');
  }

if(experience_year2)
  {
          $('#experience_month2').attr('disabled', false);
          
        if(experience_year2==='0 year'){
           $("#experience_month2 option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month2 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month2').attr('disabled', 'disabled');
  }
 
 if(experience_year3)
  {
          $('#experience_month3').attr('disabled', false);
         
          if(experience_year3==='0 year'){
           $("#experience_month3 option[value='0 month']").attr('disabled',true);} 
          else{
           $("#experience_month3 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month3').attr('disabled', 'disabled');
  }

if(experience_year4)
  {
          $('#experience_month4').attr('disabled', false);

          if(experience_year4==='0 year'){
           $("#experience_month4 option[value='0 month']").attr('disabled',true);} 
          else{
           $("#experience_month4 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month4').attr('disabled', 'disabled');
  }
}

if(num==5)
{
        var experience_year =  document.getElementById('experience_year').value;
        var experience_year2 =  document.getElementById('experience_year2').value;
        var experience_year3 =  document.getElementById('experience_year3').value;
        var experience_year4 =  document.getElementById('experience_year4').value;
        var experience_year5 =  document.getElementById('experience_year5').value;
  
  if(experience_year)
  {
          $('#experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month').attr('disabled', 'disabled');
  }

if(experience_year2)
  {
          $('#experience_month2').attr('disabled', false);

        if(experience_year2==='0 year'){
           $("#experience_month2 option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month2 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month2').attr('disabled', 'disabled');
  }

if(experience_year3)
  {
          $('#experience_month3').attr('disabled', false);

        if(experience_year3==='0 year'){
          $("#experience_month3 option[value='0 month']").attr('disabled',true);} 
        else{
           $("#experience_month3 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month3').attr('disabled', 'disabled');
  }

if(experience_year4)
  {
          $('#experience_month4').attr('disabled', false);

        if(experience_year4==='0 year'){
           $("#experience_month4 option[value='0 month']").attr('disabled',true);}
        else{
           $("#experience_month4 option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#experience_month4').attr('disabled', 'disabled');
  } 
  
  if(experience_year5)
  {
          $('#experience_month5').attr('disabled', false);
      
        if(experience_year5==='0 year'){
           $("#experience_month5 option[value='0 month']").attr('disabled',true);}
        else{
           $("#experience_month5 option[value='0 month']").attr('disabled',false);} 
    }
  else
  {
           $('#experience_month5').attr('disabled', 'disabled');
  }

    }
  
}


function expyear_change_edittime(){

     var num = $('.clonedInput').length;

if(num==1)
{
       var experience_year = document.querySelector("#input1 #experience_year").value;
       
if(experience_year)
  {
          $('#input1 #experience_month').attr('disabled', false);

        var experience_year =  document.getElementById('experience_year').value;
         if(experience_year==='0 year'){
           $("#input1 #experience_month option[value='0 month']").attr('disabled',true);} 
         else{
           $("#input1 #experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#input1 #experience_month').attr('disabled', 'disabled');
  }
}

if(num==2)
{
   
        var experience_year =  document.querySelector("#input1 #experience_year").value;
         var experience_year2 =  document.querySelector("#input2 #experience_year").value;
        
  if(experience_year)
  {
          $('#input1 #experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#input1 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input1 #experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#input1 #experience_month').attr('disabled', 'disabled');
  }
    
  if(experience_year2)
  {
          $('#input2 #experience_month').attr('disabled', false);      
          if(experience_year2==='0 year'){
           $("#input2 #experience_month option[value='0 month']").attr('disabled',true);} 
          else{
           $("#input2 #experience_month option[value='0 month']").attr('disabled',false);}
    }
  else
  {
           $('#input2 #experience_month').attr('disabled', 'disabled');
  }
}
      
if(num==3)
{
        var experience_year =  document.querySelector("#input1 #experience_year").value;
        var experience_year2 =  document.querySelector("#input2 #experience_year").value;
        var experience_year3 = document.querySelector("#input3 #experience_year").value;

  if(experience_year)
  {
          $('#input1 #experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#input1 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input1 #experience_month option[value='0 month']").attr('disabled',false);
         }
  }
  else
  {
           $('#input1 #experience_month').attr('disabled', 'disabled');
  }

  if(experience_year2)
  {
          $('#input2 #experience_month').attr('disabled', false);

        if(experience_year2==='0 year'){
           $("#input2 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input2 #experience_month option[value='0 month']").attr('disabled',false);}
    }
  else
  {
           $('#input2 #experience_month').attr('disabled', 'disabled');
  }

if(experience_year3)
  {
          $('#input3 #experience_month').attr('disabled', false);

        if(experience_year3==='0 year'){
           $("#input3 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input3 #experience_month option[value='0 month']").attr('disabled',false);}
    }
  else
  {
           $('#input3 #experience_month').attr('disabled', 'disabled');
  }
}

if(num==4)
{
        var experience_year =  document.querySelector("#input1 #experience_year").value;
        var experience_year2 =  document.querySelector("#input2 #experience_year").value;
        var experience_year3 =  document.querySelector("#input3 #experience_year").value;
        var experience_year4 = document.querySelector("#input4 #experience_year").value;

   if(experience_year)
  {
          $('#input1 #experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#input1 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input1 #experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#input1 #experience_month').attr('disabled', 'disabled');
  }
 
  if(experience_year2)
  {
          $('#input2 #experience_month').attr('disabled', false);         
        if(experience_year2==='0 year'){
           $("#input2 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input2 #experience_month option[value='0 month']").attr('disabled',false);}
  }
  else
  {
           $('#input2 #experience_month').attr('disabled', 'disabled');
  }
   
 if(experience_year3)
  {
          $('#input3 #experience_month').attr('disabled', false);       
          if(experience_year3==='0 year'){
           $("#input3 #experience_month option[value='0 month']").attr('disabled',true);} 
          else{
           $("#input3 #experience_month option[value='0 month']").attr('disabled',false);}
   }
  else
  {
           $('#input3 #experience_month').attr('disabled', 'disabled');
  }

 if(experience_year4)
  {
          $('#input4 #experience_month').attr('disabled', false);

          if(experience_year4==='0 year'){
           $("#input4 #experience_month option[value='0 month']").attr('disabled',true);} 
          else{
           $("#input4 #experience_month option[value='0 month']").attr('disabled',false);}
    }
  else
  {
           $('#input4 #experience_month').attr('disabled', 'disabled');
  }
}

if(num==5)
{
        var experience_year =  document.querySelector("#input1 #experience_year").value;
        var experience_year2 =  document.querySelector("#input2 #experience_year").value;
        var experience_year3 =  document.querySelector("#input3 #experience_year").value;
        var experience_year4 =  document.querySelector("#input4 #experience_year").value;
        var experience_year5 =  document.querySelector("#input5 #experience_year").value;

 if(experience_year)
  {
          $('#input1 #experience_month').attr('disabled', false);

        if(experience_year==='0 year'){
           $("#input1 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input1 #experience_month option[value='0 month']").attr('disabled',false);}
   }
  else
  {
           $('#input1 #experience_month').attr('disabled', 'disabled');
  }

 if(experience_year2)
  {
          $('#input2 #experience_month').attr('disabled', false);

        if(experience_year2==='0 year'){
           $("#input2 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input2 #experience_month option[value='0 month']").attr('disabled',false);}
   }
  else
  {
           $('#input2 #experience_month').attr('disabled', 'disabled');
  }

 if(experience_year3)
  {
          $('#input3 #experience_month').attr('disabled', false);

        if(experience_year3==='0 year'){
          $("#input3 #experience_month option[value='0 month']").attr('disabled',true);} 
        else{
           $("#input3 #experience_month option[value='0 month']").attr('disabled',false);}
   }
  else
  {
           $('#input3 #experience_month').attr('disabled', 'disabled');
  }

 if(experience_year4)
  {
          $('#input4 #experience_month').attr('disabled', false);

        if(experience_year4==='0 year'){
           $("#input4 #experience_month option[value='0 month']").attr('disabled',true);}
        else{
           $("#input4 #experience_month option[value='0 month']").attr('disabled',false);} 
   }
  else
  {
           $('#input4 #experience_month').attr('disabled', 'disabled');
  }

 if(experience_year5)
  {
        $('#input5 #experience_month').attr('disabled', false);         
        if(experience_year5==='0 year'){
           $("#input5 #experience_month option[value='0 month']").attr('disabled',true);}
        else{
           $("#input5 #experience_month option[value='0 month']").attr('disabled',false);} 
   }
  else
  {
           $('#input5 #experience_month').attr('disabled', 'disabled');
  }
}
}

</script>

</script>




<script type="text/javascript">
 
   $(document).ready(function () {
   
  
   $.validator.addMethod("regx1", function(value, element, regexpr) {          
   //return value == '' || value.trim().length != 0; 
   if(!value) 
   {
   return true;
   }
   else
   {
   return regexpr.test(value);
   }
   // return regexpr.test(value);
   }, "Only space, only number and only special characters are not allow");

//PHONE NUMBER VALIDATION FUNCTION   
   $.validator.addMethod("matches", function(value, element, regexpr) {          
   //return value == '' || value.trim().length != 0; 
   if(!value) 
   {
   return true;
   }
   else
   {
   return regexpr.test(value);
   }
   // return regexpr.test(value);
   }, "Phone number is not in proper format");
  //PHONE NUMBER VALIDATION FUNCTION END

   
       $("#jobseeker_regform1").validate({
   
           ignore: ":hidden",
   
           rules: {
   
               'jobtitle[]': {
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                   //noSpace: true
               },
               'companyname[]': {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                   //noSpace: true
               },
              
                'experience_year[]': {
       
                  //require_from_group: [1, ".keyskil"] 
                    required:true 
                      }, 
   
                'experience_month[]': {
       
                   //require_from_group: [1, ".keyskil"]
                
                     required:true 
                   },
   
               'companyemail[]': {
                   email: true,
               },
                'companyphn[]': {

                          //  number: true,
                            minlength: 8,
                           maxlength:15,
                          matches: /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/,                   
                        },
               // 'companyphn[]': {
                    
               //     regx: /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/
               // },
           },
           messages: {
   
               'jobtitle[]': {
   
                   required: "Job title Is Required.",
               },
               'companyname[]': {
   
                   required: "Company name Is Required.",
               },
               'experience_year[]': {
   
                 //require_from_group: "You must either fill out 'month' or 'year'"
                  required: "Experience Year Is Required.",
               },
                'experience_month[]': {
   
             // require_from_group: "You must either fill out 'month' or 'year'"
                 required: "Experience Month Is Required.",
               },
               'companyemail[]': {
   
                   email: "Please Enter Valid Email Id.",
               },
   
               //  'companyphn[]': {
               //      matches: "Enter proper.",
               // },
           }
   
       });
   });
</script>
<script type="text/javascript">                     
   $(document).ready(function () {
   
   $.validator.addMethod("regx", function(value, element, regexpr) {          
   return regexpr.test(value);
   }, "Only space, only number and only special characters are not allow");
   
                       
   
                           $("#jobseeker_regform").validate({
   
                               ignore: ":hidden",
   
                               rules: {
   
                                   'radio': {
                                       required: true,
                                      
                                       //noSpace: true
                                   }  
                                   
                               },
                               messages: {
   
                                   'radio': {
   
                                       required: "Please Tick mark Fresher or Fill Experiance",
                                   },
                                   
                                   
                                  
                               }
   
                           });
                       });
                   
</script>
<!--javascript for fresher and experience radio button End -->
<!-- Clone input type start-->
<script>
   $('#btnRemove').attr('disabled', 'disabled');
   $('#btnAdd').click(function () {
       var num = $('.clonedInput').length;

       var newNum = new Number(num + 1);
      
       if (newNum > 5)
       {
           $('#btnAdd').attr('disabled', 'disabled');
           alert("You Can add only 5 fields");
           return false;
       }

  


       // new code end
       var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
        
       newElem.children('.exp_data').attr('id', 'exp_data' + newNum).attr('name', 'exp_data[]').attr('value', 'new');
       newElem.children('.experience_year').attr('id', 'experience_year' + newNum).attr('name', 'experience_year[]').val();
       newElem.children('.experience_month').attr('id', 'experience_month' + newNum).attr('name', 'experience_month[]').val();
       newElem.children('.jobtitle').attr('id', 'jobtitle' + newNum).attr('name', 'jobtitle[]');
       newElem.children('.companyname').attr('id', 'companyname' + newNum).attr('name', 'companyname[]');
       newElem.children('.companyemail').attr('id', 'companyemail' + newNum).attr('name', 'companyemail[]');
       newElem.children('.companyphn').attr('id', 'companyphn' + newNum).attr('name', 'companyphn[]');
       newElem.children('.certificate').attr('id', 'certificate' + newNum).attr('name', 'certificate[]').val();
       $('#input' + num).after(newElem);
       $('#btnRemove').removeAttr('disabled', 'disabled');
       $('#input' + newNum + ' .experience_year').val('');
       $('#input' + newNum + ' .experience_month').val('');
       $('#input'+newNum+ ' .experience_month').attr("disabled", "disabled");
      $('#input'+newNum+' .certificate').val('');
        //$('#input' + newNum + '.certificate').replaceWith($("#certificate"+ newNum).val('').clone(true));
   
       $('#input' + newNum + ' .hs-submit').remove();
       $("#input" + newNum + ' img').remove();
       $("#input" + newNum + ' .img_work_exp').remove();

       
   });
   
   $('#btnRemove').on('click', function () {
   
       var num = $('.clonedInput').length;
       if (num - 1 == <?php echo $clone_mathod_count; ?>)
       {
   
           $('#btnRemove').attr('disabled', 'disabled');
       }
       $('.clonedInput').last().remove();
   });
   $('#btnAdd').on('click', function () {
   
       $('.clonedInput').last().add().find("input:text").val("");
   });
</script>
<!-- Clone input type End-->
<script>
   function openCity(evt, cityName) {
       var i, tabcontent, tablinks;
       tabcontent = document.getElementsByClassName("tabcontent1");
       for (i = 0; i < tabcontent.length; i++) {
           tabcontent[i].style.display = "none";
       }
       tablinks = document.getElementsByClassName("tablinks");
       for (i = 0; i < tablinks.length; i++) {
           tablinks[i].className = tablinks[i].className.replace(" active2", "");
       }
       document.getElementById(cityName).style.display = "block";
       evt.currentTarget.className += " active2";
   }
   
   // Get the element with id="defaultOpen" and click on it
  // document.getElementById("defaultOpen").click();
</script>
<script type="text/javascript">
   $(".alert").delay(3200).fadeOut(300);
</script>
<style type="text/css">
   .job_work_experience_main_div{
   margin-top: 10px;
   border-bottom: 2px solid #d9d9d9;
   margin-bottom: 20px;
   }
</style>
<script type="text/javascript">

//DELETE JOB WORK EXP CLONE START
   function delete_job_work(work_id,certificate) {

      $.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Work Experience?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
  
    $('.message #delete').on('click', function () {

       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/job_work_delete" ?>',
           data: 'work_id=' + work_id+ '&certificate=' + certificate,
          // dataType: "html",
           success: function (data) {
               if(data == 1)
               {
                   $.fancybox.close();
                   $('.job_work_edit_' + work_id).remove();
                 
               }
                
           }
       });//$.ajax end
       });
   }
//DELETE JOB WORK EXP CLONE END


</script>
<style type="text/css">
   .hs-submit img{
   display: none !important;
   }
</style>
<script type="text/javascript">
   jQuery(document).ready(function($) {  
   
   // site preloader -- also uncomment the div in the header and the css style for #preloader
   $(window).load(function(){
   $('#preloader').fadeOut('slow',function(){$(this).remove();});
   });
   });



//script for click on - change to + Start
    $(document).ready(function () {
          
      $('#toggle').on('click', function(){
    
            if($('#panel-heading').hasClass('active')){

                      $('#panel-heading').removeClass('active');

            }else{
                      //$('#one').addClass('in');
                      $('#panel-heading').addClass('active');

                       $('#panel-heading1').removeClass('active');
            }
        });

      $('#toggle1').on('click', function(){
    
            if($('#panel-heading1').hasClass('active')){
                      $('#panel-heading1').removeClass('active');
            }else{
                      $('#panel-heading1').addClass('active');
                       $('#panel-heading').removeClass('active');
            }
        }); 

    });
  //script for click on - change to + End

</script>
<style type="text/css">
   #experience_month-error{margin-top: 0px;margin-right: 35px;}
   #experience_year-error{margin-top: 39px;margin-right: 35px;}
   #jobtitle-error{margin-right: 35px; margin-top: 0px;}
   #companyname-error{margin-right: 35px; margin-top: 0px;}
</style>

<script>

//for  Work Experience  certificate start
$(document).ready(function(){
    $(document).on('change', '#input1 .certificate', function() {
         
        var image =  document.querySelector("#input1 .certificate").value;
     
        if(image != '')
        { 
             var image_ext = image.split('.').pop();
             var allowesimage = ['jpg','png','jpeg','gif','pdf'];
             var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
            if(foundPresentImage == false)
            {
                $("#input1 .bestofmine_image_degree").html("Please select only Image file & Pdf File.");
                return false;  
            }
            else
            {
                $("#input1 .bestofmine_image_degree").html(" ");
                return true;
            }
        }      
    });
    $("#jobseeker_regform1").submit(function(){
            var text = $('#input1 .bestofmine_image_degree').text();
            if(text=="Please select only Image file & Pdf File.")
            {     
                return false;
            }
            else
            {  
                return true;
            }

        });

    $(document).on('change', '#input2 .certificate', function() {
         
        var image =  document.querySelector("#input2 .certificate").value;
        if(image != '')
        { 
             var image_ext = image.split('.').pop();
             var allowesimage = ['jpg','png','jpeg','gif','pdf'];
             var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
            if(foundPresentImage == false)
            {
                $("#input2 .bestofmine_image_degree").html("Please select only Image file & Pdf File.");
                return false;  
            }
            else
            {
                $("#input2 .bestofmine_image_degree").html(" ");
                return true;
            }
        }      
    });
    $("#jobseeker_regform1").submit(function(){
            var text = $('#input2 .bestofmine_image_degree').text();
            if(text=="Please select only Image file & Pdf File.")
            {     
                return false;
            }
            else
            {  
                return true;
            }

        });



    $(document).on('change', '#input3 .certificate', function() {
        var image =  document.querySelector("#input3 .certificate").value;
      
      
        if(image != '')
        { 
             var image_ext = image.split('.').pop();
             var allowesimage = ['jpg','png','jpeg','gif','pdf'];
             var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
            if(foundPresentImage == false)
            {
                $("#input3 .bestofmine_image_degree").html("Please select only Image file & Pdf File.");
                return false;  
            }
            else
            {
                $("#input3 .bestofmine_image_degree").html(" ");
                return true;
            }
        }      
    });
    $("#jobseeker_regform1").submit(function(){
            var text = $('#input3 .bestofmine_image_degree').text();
            if(text=="Please select only Image file & Pdf File.")
            {     
                return false;
            }
            else
            {  
                return true;
            }

        });

   $(document).on('change', '#input4 .certificate', function() {
         
        var image =  document.querySelector("#input4 .certificate").value;
       
        if(image != '')
        { 
             var image_ext = image.split('.').pop();
             var allowesimage = ['jpg','png','jpeg','gif','pdf'];
             var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
            if(foundPresentImage == false)
            {
                $("#input4 .bestofmine_image_degree").html("Please select only Image file & Pdf File.");
                return false;  
            }
            else
            {
                $("#input4 .bestofmine_image_degree").html(" ");
                return true;
            }
        }      
    });
    $("#jobseeker_regform1").submit(function(){
            var text = $('#input4 .bestofmine_image_degree').text();
            if(text=="Please select only Image file & Pdf File.")
            {     
                return false;
            }
            else
            {  
                return true;
            }

        });

    $(document).on('change', '#input5 .certificate', function() {
         
        var image =  document.querySelector("#input5 .certificate").value;
      
        if(image != '')
        { 
             var image_ext = image.split('.').pop();
             var allowesimage = ['jpg','png','jpeg','gif','pdf'];
             var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
            if(foundPresentImage == false)
            {
                $("#input5 .bestofmine_image_degree").html("Please select only Image file & Pdf File.");
                return false;  
            }
            else
            {
                $("#input5 .bestofmine_image_degree").html(" ");
                return true;
            }
        }      
    });
    $("#jobseeker_regform1").submit(function(){
            var text = $('#input5 .bestofmine_image_degree').text();
            if(text=="Please select only Image file & Pdf File.")
            {     
                return false;
            }
            else
            {  
                return true;
            }

        });
});
//for Work Experience certificate End


//DELETE WORK EXPERIENCE CERTIFICATE START
function delete_workexp(work_id,certificate) {
 
$.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Experience Certificate?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
 
      $('.message #delete').on('click', function () {
         $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/delete_workexp" ?>',
           data: 'work_id=' + work_id+ '&certificate=' + certificate,
           success: function (data) {

               if (data == 1) 
               {
                  $.fancybox.close();   
                  $('.job_work_edit_'+work_id+' .img_work_exp a').remove();
                  $('.job_work_edit_'+work_id+' .img_work_exp img').remove();
                  $('.job_work_edit_'+work_id+'  #work_certi').remove();
               }
               
           }
       });

             });
          }
//DELETE WORK EXPERIENCE CERTIFICATE END
</script>
