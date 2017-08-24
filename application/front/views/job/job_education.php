<!-- start head -->
<?php echo $head; ?> 
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-job-style.css'); ?>">
<!-- This Css is used for call popup -->
<link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
<?php //if($jobdata[0]['job_step'] == 10){ ?>
<!-- <?php //echo $job_header2_border; ?>
 --><?php //} ?>
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
<div class="js">
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
            
            if ($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 3) { ?>
         <div class="col-md-6 col-sm-8">
            <h3>You are updating your Job Profile.</h3>
         </div>
         <?php  } else {
            ?>
         <div class="col-md-6 col-sm-8">
            <h3>You are making your Job Profile.</h3>
         </div>
         <?php } ?>
      </div>
      <br>
      <br>
      <br>
      <div class="container">
      <div class="row row4">

          <?php echo $job_left; ?>
          
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
            <div class="common-form">
               <div class="job-saved-boxe_2" >
                  <div class="edu_tab fw">
                     <h3>Educational  Qualification</h3>


                     <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="panel-group wrap" id="bs-collapse">

                           <div class="panel">
                              <div <?php if($this->uri->segment(3) =="primary"){ ?> class="panel-heading active" <?php }else{ ?> class="panel-heading" <?php } ?> id="panel-heading">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#bs-collapse" href="#one" id="toggle">
                                    Primary
                                    </a>
                                 </h4>
                              </div>
                              <div id="one" <?php if($this->uri->segment(3) =="primary"){ ?> class="panel-collapse collapse in"<?php }else{ ?> class="panel-collapse collapse" <?php } ?>>

                                 <div class="panel-body">
                                    <section id="section1">
                                       <article class="none_aaaart">
                                          <?php echo form_open_multipart(base_url('job/job_education_primary_insert'), array('id' => 'jobseeker_regform_primary', 'name' => 'jobseeker_regform_primary', 'class' => 'clearfix')); ?>
                                          <?php
                                             $contition_array = array('user_id' => $userid, 'status' => 1);
                                             $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             //echo '<pre>'; print_r($jobdata); die();
                                             $board_primary1 = $jobdata[0]['board_primary'];
                                             // echo $board_primary1; die();
                                             $school_primary1 = $jobdata[0]['school_primary'];
                                             $percentage_primary1 = $jobdata[0]['percentage_primary'];
                                             $pass_year_primary1 = $jobdata[0]['pass_year_primary'];
                                             $edu_certificate_primary1 = $jobdata[0]['edu_certificate_primary'];
                                             ?>
                                          <fieldset class="full-width">
                                             <h6>Board :<span style="color:red">*</span></h6>
                                             <input type="text" tabindex="1" autofocus name="board_primary" id="board_primary" placeholder="Enter Board" value="<?php
                                                if ($board_primary1) {
                                                    echo $board_primary1;
                                                }
                                                ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                          </fieldset>
                                          <fieldset class="full-width">
                                             <h6>School :<span class="red">*</span></h6>
                                             <input type="text" name="school_primary" tabindex="2" id="school_primary" placeholder="Enter School Name" value="<?php
                                                if ($school_primary1) {
                                                    echo $school_primary1;
                                                }
                                                ?>" maxlength="255">
                                          </fieldset>
                                          <fieldset class="full-width">
                                             <h6>Percentage :<span class="red">*</span></h6>
                                             <input type="text" name="percentage_primary" tabindex="3" id="percentage_primary" placeholder="Enter Percentage"  value="<?php
                                                if ($percentage_primary1) {
                                                    echo $percentage_primary1;
                                                }
                                                ?>" maxlength="5" />
                                          </fieldset>
                                          <fieldset class="full-width">
                                             <h6>Year Of Passing :<span style="color:red">*</span></h6>
                                             <select name="pass_year_primary" id="pass_year_primary" tabindex="4" class="pass_year_primary" >
                                                <option value="" selected option disabled>--SELECT--</option>
                                                <?php
                                                   $curYear = date('Y');
                                                   
                                                   for ($i = $curYear; $i >= 1900; $i--) {
                                                       if ($pass_year_primary1) {
                                                           ?>
                                                <option value="<?php echo $i ?>" <?php if ($i == $pass_year_primary1) echo 'selected'; ?>><?php echo $i ?></option>
                                                <?php
                                                   }
                                                   else {
                                                       ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                                   }
                                                   }
                                                   ?> 
                                             </select>
                                          </fieldset>
                                          <fieldset class="full-width" id="primary_remove">
                                             <h6>Education Certificate:</h6>
                                             <input  type="file" name="edu_certificate_primary" tabindex="5" id="edu_certificate_primary" class="edu_certificate_primary" placeholder="CERTIFICATE" multiple="" />
                                             <div class="bestofmine_image_primary" style="color:#f00; display: block;"></div>
                                             <?php
                                                if ($edu_certificate_primary1) {
                                                   $ext = explode('.',$edu_certificate_primary1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                    <div class="dele_highrt">
                                                        <!--  <a class="fl" href="<?php //echo base_url('job/creat_pdf_primary/'.$jobdata[0]['edu_id'].'/primary') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red;" aria-hidden="true"></i></a> -->
                                                         <a title="open pdf" class="fl" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate_primary1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red;" aria-hidden="true"></i></a>

                                                      <div style="float: left;" id="primary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                  <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input  type="button" id="delete_job_edu" value="Delete" style="display: none;" onClick="delete_primary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_primary1; ?>')">
                                                </div>
                                             </div>
                                             </div>

                                                      <?php
                                                      }
                                                      else
                                                      {
                                                    ?>
                                           <div class="dele_highrt">
                                             <img class="fl" src="<?php echo base_url($this->config->item('job_edu_thumb_upload_path')  . $edu_certificate_primary1) ?>"  style="width:100px;height:100px;" class="job_education_certificate_img" >
                                               <div style="float: left;" id="primary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                  <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input  type="button" id="delete_job_edu" value="Delete" style="display: none;" onClick="delete_primary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_primary1; ?>')">
                                                </div>
                                             </div>
                                           </div> 
                                             <?php
                                                }
                                             }
                                                 ?>
                                          </fieldset>

                                         <!--  <?php if($edu_certificate_primary1)
                                                 {
                                          ?>
                                           <div style="float: left;" id="primary_certi">
                                                <div class="hs-submit full-width fl">
                                                   <input  type="button" style="padding: 6px 18px 6px;min-width: 0;font-size: 14px" value="Delete" onClick="delete_primary('<?php echo $jobdata[0]['edu_id']; ?>','<?php //echo $edu_certificate_primary1; ?>')">
                                                </div>
                                             </div>

                                          <?php
                                                }
                                          ?> -->
                                         <!--  <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div> -->
                                          <div class="fr job_education_submitbox">
                                             <input type="hidden" name="image_hidden_primary" value="<?php
                                                if ($edu_certificate_primary1) {
                                                 echo $edu_certificate_primary1;
                                                     }
                                                     ?>">
                                             <br>

                                             <button class="submit_btn" tabindex="6">Save</button>
                                             <fieldset class="hs-submit full-width" style="">
                                                <!--input type="button" tabindex="7" id="next" name="next" value="Next" style="font-size: 16px;min-width: 120px;" onclick="return next_page()"-->
                                             </fieldset>
                                          </div>
                                          <?php echo form_close(); ?>
                                       </article>
                                    </section>
                                 </div>
                              </div>
                           </div>
                           <!-- end of panel -->
                           <div class="panel">
                              <div  <?php if($this->uri->segment(3) =="secondary"){ ?> class="panel-heading active" <?php }else{ ?> class="panel-heading" <?php } ?>  id="panel-heading1">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#bs-collapse" href="#two" id="toggle1">
                                    Secondary
                                    </a>
                                 </h4>
                              </div>
                              <div id="two" <?php if($this->uri->segment(3) =="secondary"){ ?> class="panel-collapse collapse in"<?php }else{ ?> class="panel-collapse collapse" <?php } ?> >
                                 <div class="panel-body">
                                    <section id="section2">
                                       <?php echo form_open_multipart(base_url('job/job_education_secondary_insert'), array('id' => 'jobseeker_regform_secondary', 'name' => 'jobseeker_regform_secondary', 'class' => 'clearfix')); ?>
                                       <?php
                                          $contition_array = array('user_id' => $userid, 'status' => 1);
                                          $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                          
                                          $board_secondary1 = $jobdata[0]['board_secondary'];
                                          $school_secondary1 = $jobdata[0]['school_secondary'];
                                          $percentage_secondary1 = $jobdata[0]['percentage_secondary'];
                                          $pass_year_secondary1 = $jobdata[0]['pass_year_secondary'];
                                          $edu_certificate_secondary1 = $jobdata[0]['edu_certificate_secondary'];
                                          ?>
                                       <fieldset class="full-width">
                                          <h6>Board :<span style="color:red">*</span></h6>
                                          <input type="text" tabindex="1" autofocus  name="board_secondary" id="board_secondary" placeholder="Enter Board" value="<?php
                                             if ($board_secondary1) {
                                                 echo $board_secondary1;
                                             }
                                             ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>School :<span class="red">*</span></h6>
                                          <input type="text" name="school_secondary" tabindex="2" id="school_secondary" placeholder="Enter School Name" value="<?php
                                             if ($school_secondary1) {
                                                 echo $school_secondary1;
                                             }
                                             ?>" maxlength="255">
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>Percentage :<span class="red">*</span></h6>
                                          <input type="text" name="percentage_secondary" tabindex="3" id="percentage_secondary" placeholder="Enter Percentage"  value="<?php
                                             if ($percentage_secondary1) {
                                                 echo $percentage_secondary1;
                                             }
                                             ?>"  maxlength="5" />
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>Year Of Passing :<span class="red">*</span></h6>
                                          <select name="pass_year_secondary" tabindex="4" id="pass_year_secondary" class="pass_year_secondary" >
                                             <option value="" selected option disabled>--SELECT--</option>
                                             <?php
                                                $curYear = date('Y');
                                                
                                                for ($i = $curYear; $i >= 1900; $i--) {
                                                    if ($pass_year_secondary1) {
                                                        ?>
                                             <option value="<?php echo $i ?>" <?php if ($i == $pass_year_secondary1) echo 'selected'; ?>><?php echo $i ?></option>
                                             <?php
                                                }
                                                else {
                                                    ?>
                                             <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                             <?php
                                                }
                                                }
                                                ?> 
                                          </select>
                                       </fieldset>
                                       <fieldset class="full-width" id="secondary_remove">
                                          <h6>Education Certificate:</h6>
                                          <input type="file" tabindex="6" name="edu_certificate_secondary" id="edu_certificate_secondary" class="edu_certificate_secondary" placeholder="CERTIFICATE" multiple="" />
                                          <div class="bestofmine_image_secondary" style="color:#f00; display: block;"></div>

                                           <?php
                                                if ($edu_certificate_secondary1) {
                                                   $ext = explode('.',$edu_certificate_secondary1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                   <div class="dele_highrt">
                                                         <!-- <a class="fl" href="<?php //echo base_url('job/creat_pdf_secondary/'.$jobdata[0]['edu_id'].'/secondary') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; " aria-hidden="true"></i></a> -->

                                                          <a title="open pdf" class="fl" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate_secondary1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red;" aria-hidden="true"></i></a>

                                                <div style="float: left;" id="secondary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                   <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input id="delete_job_edu"  type="button" style="display: none;" value="Delete" onClick="delete_secondary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_secondary1; ?>')">
                                                </div>
                                             </div>

                                             </div>
                                                      <?php
                                                      }
                                                      else
                                                      {
                                                    ?>
                                                     <div class="dele_highrt">
                                              <img src="<?php echo base_url($this->config->item('job_edu_thumb_upload_path')  . $edu_certificate_secondary1) ?>" style="width:100px;height:100px;" class="job_education_certificate_img ">

                                                <div style="float: left;" id="secondary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                   <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input id="delete_job_edu"  type="button" style="display: none;" value="Delete" onClick="delete_secondary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_secondary1; ?>')">
                                                </div>
                                             </div>
</div>

                                             <?php
                                                }
                                             }
                                          ?>

                                       </fieldset>

                                       <!--  <?php if($edu_certificate_secondary1)
                                                 {
                                          ?>
                                           <div style="float: left;" id="secondary_certi">
                                                <div class="hs-submit full-width fl">
                                                   <input  type="button" style="padding: 6px 18px 6px;min-width: 0;font-size: 14px" value="Delete" onClick="delete_secondary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_secondary1; ?>')">
                                                </div>
                                             </div>

                                          <?php
                                                }
                                          ?> -->
                                             <!-- <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div> -->
                                       <div class="fr job_education_submitbox">
                                          <input type="hidden" name="image_hidden_secondary" value="<?php
                                             if ($edu_certificate_secondary1) {
                                                  echo $edu_certificate_secondary1;
                                                  }
                                                 ?>">
                                          <button class="submit_btn" tabindex="7">Save</button>
                                          <br>
                                          <fieldset class="hs-submit full-width" style="">
                                             <!--input type="button" id="next" name="next" tabindex="8" value="Next" style="font-size: 16px;min-width: 120px;" onclick="next_page1()"-->
                                          </fieldset>
                                       </div>
                                       <?php echo form_close(); ?>
                                       </article>
                                    </section>
                                 </div>
                              </div>
                           </div>
                           <!-- end of panel -->
                           <div class="panel">
                              <div <?php if($this->uri->segment(3) =="higher-secondary"){ ?> class="panel-heading active" <?php }else{ ?> class="panel-heading" <?php } ?> id="panel-heading2">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#bs-collapse" href="#three" id="toggle2">
                                    Higher secondary
                                    </a>
                                 </h4>
                              </div>
                              <div id="three"  <?php if($this->uri->segment(3) =="higher-secondary"){ ?> class="panel-collapse collapse in" <?php }else{ ?> class="panel-collapse collapse" <?php } ?> >
                                 <div class="panel-body">
                                    <section id="section3">
                                       <?php echo form_open_multipart(base_url('job/job_education_higher_secondary_insert'), array('id' => 'jobseeker_regform_higher_secondary', 'name' => 'jobseeker_regform_higher_secondary', 'class' => 'clearfix')); ?>
                                       <?php
                                          $contition_array = array('user_id' => $userid, 'status' => 1);
                                          $jobdata = $this->data['jobdata'] = $this->common->select_data_by_condition('job_add_edu', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                          
                                          $board_higher_secondary1 = $jobdata[0]['board_higher_secondary'];
                                          $stream_higher_secondary1 = $jobdata[0]['stream_higher_secondary'];
                                          $school_higher_secondary1 = $jobdata[0]['school_higher_secondary'];
                                          $percentage_higher_secondary1 = $jobdata[0]['percentage_higher_secondary'];
                                          $pass_year_higher_secondary1 = $jobdata[0]['pass_year_higher_secondary'];
                                          $edu_certificate_higher_secondary1 = $jobdata[0]['edu_certificate_higher_secondary'];
                                          ?>
                                       <fieldset class="full-width">
                                          <h6>Board :<span class="red">*</span></h6>
                                          <input type="text" tabindex="1" autofocus name="board_higher_secondary" id="board_higher_secondary" placeholder="Enter Board" value="<?php
                                             if ($board_higher_secondary1) {
                                                 echo $board_higher_secondary1;
                                             }
                                             ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>Stream :<span class="red">*</span></h6>
                                          <input type="text" name="stream_higher_secondary" tabindex="2" id="stream_higher_secondary" placeholder="Enter Stream" value="<?php
                                             if ($stream_higher_secondary1) {
                                                 echo $stream_higher_secondary1;
                                             }
                                             ?>" maxlength="255">
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>School :<span class="red">*</span></h6>
                                          <input type="text" name="school_higher_secondary" tabindex="3" id="school_higher_secondary" placeholder="Enter School Name" value="<?php
                                             if ($school_higher_secondary1) {
                                                 echo $school_higher_secondary1;
                                             }
                                             ?>" maxlength="255">
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>Percentage :<span class="red">*</span></h6>
                                          <input type="text" tabindex="4" name="percentage_higher_secondary" id="percentage_higher_secondary" placeholder="Enter Percentage"  value="<?php
                                             if ($percentage_higher_secondary1) {
                                                 echo $percentage_higher_secondary1;
                                             }
                                             ?>"  maxlength="5" />
                                       </fieldset>
                                       <fieldset class="full-width">
                                          <h6>Year Of Passing :<span class="red">*</span></h6>
                                          <select tabindex="5" name="pass_year_higher_secondary" id="pass_year_higher_secondary" class="pass_year_higher_secondary" >
                                             <option value="" selected option disabled>--SELECT--</option>
                                             <?php
                                                $curYear = date('Y');
                                                
                                                for ($i = $curYear; $i >= 1900; $i--) {
                                                    if ($pass_year_higher_secondary1) {
                                                        ?>
                                             <option value="<?php echo $i ?>" <?php if ($i == $pass_year_higher_secondary1) echo 'selected'; ?>><?php echo $i ?></option>
                                             <?php
                                                }
                                                else {
                                                    ?>
                                             <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                             <?php
                                                }
                                                }
                                                ?> 
                                          </select>
                                       </fieldset>
                                       <fieldset class="full-width" id="higher_secondary_remove">
                                          <h6>Education Certificate:</h6>
                                          <input type="file" name="edu_certificate_higher_secondary" id="edu_certificate_higher_secondary" class="edu_certificate_higher_secondary" placeholder="CERTIFICATE" multiple="" tabindex="6" />
                                          <div class="bestofmine_image_higher_secondary" style="color:#f00; display: block;"></div>
                                          <?php
                                                if ($edu_certificate_higher_secondary1) {
                                                   ?>
                                                   
                                             <?php
                                                   $ext = explode('.',$edu_certificate_higher_secondary1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                       <div class="dele_highrt">
                                                         <!-- <a class="fl" href="<?php //echo base_url('job/creat_pdf_higher_secondary/'.$jobdata[0]['edu_id'].'/higher-secondary') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red;" aria-hidden="true"></i></a> -->
                                                         
                                                      <a title="open pdf" class="fl" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate_higher_secondary1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red;" aria-hidden="true"></i></a>


                                                          <div style="float: left;" id="higher_secondary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input  type="button" style="display: none;" value="Delete" id="delete_job_edu" onClick="delete_higher_secondary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_higher_secondary1; ?>')">
                                                </div>
                                             </div>

</div>

                                                      <?php
                                                      }
                                                      else
                                                      {
                                                    ?>
                                              
                                              <div class="dele_highrt">
                                               <img src="<?php echo base_url($this->config->item('job_edu_thumb_upload_path')  . $edu_certificate_higher_secondary1) ?>" style="width:100px;height:100px;" class="job_education_certificate_img">
                                              
                                              
                                              <div style="float: left;" id="higher_secondary_certi" class="tsecondary_certi">
                                                <div class="hs-submit full-width fl">
                                                   <label for="delete_job_edu"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                   <input  type="button" id="delete_job_edu" style="display: none;" value="Delete" onClick="delete_higher_secondary('<?php echo $jobdata[0]['edu_id']; ?>','<?php echo $edu_certificate_higher_secondary1; ?>')">
                                                </div>
                                             
                                             </div>
                                             </div>

                                             <?php
                                                }
                                             }
                                          ?>

                                       </fieldset>

                                     <!--  -->
                                        <!--   <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div>
 -->
                                       <div class="fr job_education_submitbox">
                                          <input type="hidden"  tabindex="8" name="image_hidden_higher_secondary" value="<?php
                                             if ($edu_certificate_higher_secondary1) {
                                                 echo $edu_certificate_higher_secondary1;
                                             }
                                             ?>">
                                          <button class="submit_btn" tabindex="9">Save</button>
                                          <br>
                                          <fieldset class="hs-submit full-width" style="">
                                             <!--input type="button" tabindex="10" id="next" name="next" value="Next" style="font-size: 16px;min-width: 120px;" onclick="next_page2()"-->
                                          </fieldset>
                                       </div>
                                       <?php echo form_close(); ?>
                                       </article>
                                    </section>
                                 </div>
                              </div>
                           </div>
                           <!-- end of panel -->
                           <div class="panel">
                              <div <?php if($this->uri->segment(3) =="graduation"){ ?> class="panel-heading active" <?php }else{ ?> class="panel-heading" <?php } ?>  id="panel-heading3">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#bs-collapse" href="#four" id="toggle3">
                                    Graduation / Post Graduation
                                    </a>
                                 </h4>
                              </div>
                              <div id="four" <?php if($this->uri->segment(3) =="graduation"){ ?> class="panel-collapse collapse in" <?php }else{ ?> class="panel-collapse collapse" <?php } ?> >
                                 <div class="panel-body">
                                    <section id="section4">
                                       <?php echo form_open_multipart(base_url('job/job_education_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix border_none')); ?>
                                       <?php
                                          $predefine_data = 1;
                                          if ($jobgrad) {
                                              $count = count($jobgrad);
                                            //  echo"<pre>";print_r($count);die();
                                              for ($x = 0; $x < $count; $x++) {
                                          
                                                  $degree1 = $jobgrad[$x]['degree'];
                                                  $stream1 = $jobgrad[$x]['stream'];
                                                  $university1 = $jobgrad[$x]['university'];
                                                  $college1 = $jobgrad[$x]['college'];
                                                  $grade1 = $jobgrad[$x]['grade'];
                                                  $percentage1 = $jobgrad[$x]['percentage'];
                                                  $pass_year1 = $jobgrad[$x]['pass_year'];
                                                  $degree_sequence = $jobgrad[$x]['degree_sequence'];
                                                  $stream_sequence = $jobgrad[$x]['stream_sequence'];
                                                  $edu_certificate1 = $jobgrad[$x]['edu_certificate']; 
                                          
                                                  $y = $x + 1;
                                          
                                                 // echo "<pre>"; print_r($degree1); die();
                                                  
                                                  if ($count == 0) {
                                                      $predefine_data = 1;
                                                  } else {
                                                      $predefine_data = $count;
                                                  }
                                                  ?>   
                                       <div id="input<?php echo $y ?>" style="margin-bottom:4px;" class="clonedInput job_work_edit_<?php echo $jobgrad[$x]['job_graduation_id']?>">
                                          <input type="hidden" name="education_data[]" value="old" class="exp_data" id="exp_data<?php echo $y; ?>">
                                          <div class="job_work_experience_main_div">
                                             <!--   <fieldset class="full-width"> -->
                                             <h6>Degree :<span class="red">*</span></h6>
                                             <select name="degree[]" id="degree1" tabindex="1" autofocus class="degree">
                                                <option value="" Selected option disabled="">Select your Degree</option>
                                                <?php
                                                   //if(count($degree_data) > 0){ //echo"hii";die();
                                                          if ($degree1) {
                                                          
                                                     foreach ($degree_data as $cnt) {
                                                             ?>
                                                <option value="<?php echo $cnt['degree_id']; ?>" <?php if ($cnt['degree_id'] == $degree1) echo 'selected'; ?>><?php echo $cnt['degree_name']; ?></option>
                                                <?php
                                                   }
                                                   }
                                                   else {
                                                   //echo "string"; die();
                                                   ?>
                                                <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name']; ?></option>
                                                <?php
                                                   }
                                                   ?>
        <option value="<?php echo $degree_otherdata[0]['degree_id']; ?> "><?php echo $degree_otherdata[0]['degree_name']; ?></option>  
                                             </select>
                                             <?php echo form_error('degree'); ?>
                                             <!--    </fieldset> -->
                                             <?php
                                             
           $contition_array = array('is_delete' => '0', 'degree_id' => $degree1);
          $search_condition = "((status = '2' AND user_id = $userid) OR (status = '1'))";
           $stream_data = $this->data['$stream_data'] = $this->common->select_data_by_search('stream', $search_condition, $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = 'stream_name');
                                                
                                      
                                                
                                                ?>
                                             <!--     <fieldset class="full-width"> -->
                                             <h6>Stream :<span class="red">*</span></h6>
                                             <!--    <?php   if ($stream1) { echo "hi";} ?> -->
                                             <select name="stream[]" id="stream1"  tabindex="2" class="stream" >
                                                <option value="" selected option disabled>Select Degree First</option>
                                                <?php
                                                   if ($stream1) {
                                                   
                                                   // echo "hi"; die();
                                                   foreach ($stream_data as $cnt) {  
                                                   ?>
                                                <option value="<?php echo $cnt['stream_id']; ?>" <?php if ($cnt['stream_id'] == $stream1) echo 'selected'; ?>><?php echo $cnt['stream_name'];?></option>
                                                <?php
                                                   }
                                                   }
                                                    
                                                        else {
                                                         // echo "hello"; die();
                                                        ?>
                                                <option value="" selected option disabled>Select Degree First</option>
                                                <?php
                                                   }
                                                   
                                                   ?>
                                                ?>
                                             </select>
                                             <?php echo form_error('stream'); ?> 
                                             <!--  </fieldset>      
                                                <fieldset class="full-width"> -->
                                             <h6>University :<span class="red">*</span></h6>
                                            
                                             <select name="university[]" id="university1" tabindex="3" class="university">
                                                <option value="" selected option disabled>Select your University</option>
                                                <?php
                                                   if (count($university_data) > 0) {
                                                   foreach ($university_data as $cnt) {
                                                   if ($university1) {
                                                            ?>
                                                <option value="<?php echo $cnt['university_id']; ?>" <?php if ($cnt['university_id'] == $university1) echo 'selected'; ?>><?php echo $cnt['university_name']; ?></option>
                                                <?php
                                                   }
                                                   else {
                                                   ?>
                                                <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>
                                                <?php
                                                   }
                                                   }
                                                   }
                                                   ?>
                <option value="<?php echo $university_otherdata[0]['university_id']; ?> "><?php echo $university_otherdata[0]['university_name']; ?></option>  
                                             </select>
                                             <?php echo form_error('univercity'); ?>
                                             <!-- </fieldset>      
                                                <fieldset class="full-width"> -->
                                             <h6>College :<span class="red">*</span></h6>
                                             <input type="text" name="college[]" id="college1" tabindex="4" class="college" placeholder="Enter College" value="<?php
                                                if ($college1) {
                                                 echo $college1;
                                                     }
                                                     ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                             <?php echo form_error('college'); ?>
                                             <!-- </fieldset>
                                                <fieldset class="full-width"> -->
                                             <h6>
                                                Grade :<!-- <span class="red">*</span> -->
                                             </h6>
                                             <input type="text" name="grade[]" id="grade1" class="grade" tabindex="5" placeholder="Enter Grade" value="<?php
                                                if ($grade1) {
                                                echo $grade1;
                                                     }
                                                 ?>" maxlength="3">
                                             <?php echo form_error('grade'); ?>
                                             <!--   </fieldset>
                                                <fieldset class="full-width"> -->
                                             <h6>Percentage :<span class="red">*</span></h6>
                                             <input type="text" name="percentage[]" id="percentage1" class="percentage" tabindex="6" placeholder="Enter Percentage"  value="<?php
                                                if ($percentage1) {
                                                   echo $percentage1;
                                                  }
                                                  ?>" maxlength="5"/>
                                             <?php echo form_error('percentage'); ?>
                                             <h6>Year Of Passing :<span class="red">*</span></h6>
                                             <select name="pass_year[]" id="pass_year1" tabindex="8" class="pass_year" >
                                                <option value="" selected option disabled>--SELECT--</option>
                                                <?php
                                                   $curYear = date('Y');
                                                   for ($i = $curYear; $i >= 1900; $i--) {
                                                   if ($pass_year1) {
                                                    ?>
                                                <option value="<?php echo $i ?>" <?php if ($i == $pass_year1) echo 'selected'; ?>><?php echo $i ?></option>
                                                <?php
                                                   }
                                                   else {
                                                     ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                                <?php
                                                   }
                                                       }
                                                    ?> 
                                             </select>
                                             <?php echo form_error('pass_year'); ?>
                                             <!--   </fieldset>
                                                <fieldset class="full-width"> -->
                                             <h6>Education Certificate:</h6>
                                             <input style="" type="file" name="certificate[]" id="certificate1" tabindex="7" class="certificate" placeholder="CERTIFICATE" multiple="" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>
                                             <div class="bestofmine_image_degree" style="color:#f00; display: block;"></div>
                                              <?php
                                                if ($edu_certificate1) {
                                                   ?>
                                          <div class="img_work_exp" style=" margin-top: 14px;" >
                                                   <?php
                                                   $ext = explode('.',$edu_certificate1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                         <!-- <a class="fl" href="<?php// echo base_url('job/creat_pdf_graduation/'.$jobgrad[$x]['job_graduation_id'].'/graduation') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                         <a title="open pdf" class="fl" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                      <?php
                                                      }//if($ext[1] == 'pdf')
                                                      else
                                                      {
                                                    ?>

                                                    
                                               <img class="fl" src="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate1) ?>" style="width:100px;height:100px;" class="job_education_certificate_img">
                                             <?php
                                                }//else end
                                                ?>
                                                </div>
                                          <?php
                                             }//if ($edu_certificate1) rnd
                                          ?>

                                           <?php if($edu_certificate1)
                                                 {
                                          ?>

                                           <div style="float: left;" id="graduation_certi">
                                                <div class="hs-submit full-width fl">
                                              
                                                   <input  type="button" class="datad_delete"   value="" onClick="delete_graduation('<?php echo $jobgrad[$x]['job_graduation_id']; ?>','<?php echo $edu_certificate1; ?>')">
                                                </div>
                                             </div>

                                          <?php
                                                }
                                          ?>


                                             <?php echo form_error('certificate'); ?>
                                             <input type="hidden" name="image_hidden_degree<?php echo $jobgrad[$x]['job_graduation_id']; ?>" value="<?php
                                                if ($edu_certificate1) {
                                                echo $edu_certificate1;
                                                }
                                                ?>">
                                             <?php if ($y != 1) {
                                                ?>
                                             <div style="float: left;">
                                                <div class="hs-submit full-width fl">
                                                   <input  type="button" style="padding: 6px 18px 6px;min-width: 0;font-size: 14px" value="Delete" onclick="delete_job_exp('<?php echo $jobgrad[$x]['job_graduation_id']; ?>','<?php echo $edu_certificate1; ?>')">
                                                </div>
                                             </div>
                                             <?php } ?>
                                          </div>
                                         <!--  <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div> -->
                                          <hr>
                                       </div>
                                       <?php
                                          }
                                          ?>
                                       
                                       <div class="fr img_remove">
                                          <input  style="font-size: 14px;" class="job_edu_graduation_submit_btn" tabindex="8" type="Submit"  id="next" name="next" value="Save">
                                          <!--<input type="submit"  id="add_edu" name="add_edu" value="Add More Education">--> 
                                       </div>
                                       <div class="display_inline_block" >
                                          <div class="fr img_remove job_edu_graduation_removebox" >
                                             <input class="job_edu_graduation_removebtn" type="button" id="btnRemove" name="btnRemove"  value=" - "   />
                                          </div>
                                          <div class="fr img_remove" >
                                             <input type="button" id="btnAdd"  name="btnAdd" class="job_edu_graduation_addbtn"  value=" + ">
                                          </div>
                                       </div>
                                       <fieldset class="hs-submit full-width job_edu_graduation_nextbtnbox">
                                       </fieldset>
                                       <?php
                                          } else {
                                              ?>
                                       <!--clone div start-->              
                                       <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                                          <!-- <fieldset class=""> -->
                                          <h6>Degree :<span class="red">*</span></h6>
                                          <select name="degree[]" id="degree1" class="degree">
                                             <option value="" Selected option disabled="">Select your Degree</option>
                                             <?php
                                                foreach ($degree_data as $cnt) {
                                                    if ($degree1) {
                                                        ?>
                                             <option value="<?php echo $cnt['degree_id']; ?>" <?php if ($cnt['degree_id'] == $degree1) echo 'selected'; ?>><?php echo $cnt['degree_name']; ?></option>
                                             <?php
                                                }
                                                else {
                                                    ?>
                                             <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name']; ?></option>
                                             <?php
                                                }
                                                //}
                                                }
                                                ?>
    <option value="<?php echo $degree_otherdata[0]['degree_id']; ?> "><?php echo $degree_otherdata[0]['degree_name']; ?></option> 

                                          </select>
                                          <?php echo form_error('degree'); ?>
                                          <!--     </fieldset>
                                             <fieldset class=""> -->
                                          <h6>Stream :<span class="red">*</span></h6>
                                          <select name="stream[]" id="stream1" class="stream" >
                                             
                                             <?php
                                                if ($stream1) {
                                                    foreach ($stream_data as $cnt) {
                                                        ?>
                                             <option value="<?php echo $cnt['stream_id']; ?>" <?php if ($cnt['stream_id'] == $stream1) echo 'selected'; ?>><?php echo $cnt['stream_name']; ?></option>
                                             <?php
                                                }
                                                }
                                                else {
                                                ?>
                                             <option value="" selected option disabled>Select Degree First</option>
                                             <?php
                                                }
                                                ?>
                                          </select>
                                          <?php echo form_error('stream'); ?> 
                                          <!-- </fieldset>      
                                             <fieldset class=""> -->
                                          <h6>University :<span class="red">*</span></h6>
                                
                                          <select name="university[]" id="university1" class="university">
                                             <option value="" selected option disabled>Select your University </option>
                                             <?php
                                                if (count($university_data) > 0) {
                                                    foreach ($university_data as $cnt) {
                                                
                                                        if ($university1) {
                                                            ?>
                                             <option value="<?php echo $cnt['university_id']; ?>" <?php if ($cnt['university_id'] == $university1) echo 'selected'; ?>><?php echo $cnt['university_name']; ?></option>
                                             <?php
                                                }
                                                else {
                                                    ?>
                                             <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>
                                             <?php
                                                }
                                                }
                                                }

                                                ?>
                        <option value="<?php echo $university_otherdata[0]['university_id']; ?> "><?php echo $university_otherdata[0]['university_name']; ?></option>    
                                          </select>
                                          <?php echo form_error('univercity'); ?> 
                                          <!--  </fieldset>      
                                             <fieldset class=""> -->
                                          <h6>College :<span class="red">*</span></h6>
                                          <input type="text" name="college[]" id="college1" class="college" placeholder="Enter College" value="<?php
                                             if ($college1) {
                                                 echo $college1;
                                             }
                                             ?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                          <?php echo form_error('college'); ?>    
                                          <!--    </fieldset>
                                             <fieldset class=""> -->
                                          <h6>
                                             Grade :<!-- <span class="red">*</span> -->
                                          </h6>
                                          <input type="text" name="grade[]" id="grade1" class="grade" placeholder="Enter Grade" value="<?php
                                             if ($grade1) {
                                                 echo $grade1;
                                             }
                                             ?>" maxlength="3">
                                          <?php echo form_error('grade'); ?>
                                          <!-- </fieldset>
                                             <fieldset class=""> -->
                                          <h6>Percentage :<span class="red">*</span></h6>
                                          <input type="text" name="percentage[]" id="percentage1" class="percentage" placeholder="Enter Percentage"  value="<?php
                                             if ($percentage1) {
                                                 echo $percentage1;
                                             }
                                             ?>" maxlength="5"/>
                                          <?php echo form_error('percentage'); ?>
                                          <!--    </fieldset>
                                             <fieldset class=""> -->
                                          <h6>Year Of Passing :<span class="red">*</span></h6>
                                          <select name="pass_year[]" id="pass_year1" class="pass_year" >
                                             <option value="" selected option disabled>--SELECT--</option>
                                             <?php
                                                $curYear = date('Y');
                                                
                                                for ($i = $curYear; $i >= 1900; $i--) {
                                                    if ($pass_year1) {
                                                        ?>
                                             <option value="<?php echo $i ?>" <?php if ($i == $pass_year1) echo 'selected'; ?>><?php echo $i ?></option>
                                             <?php
                                                }
                                                else {
                                                    ?>
                                             <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                             <?php
                                                }
                                                }
                                                ?> 
                                          </select>
                                          <?php echo form_error('pass_year'); ?>
                                          <!--  </fieldset>
                                             <fieldset class="full-width"> -->
                                          <h6>Education Certificate:</h6>
                                          <input type="file" name="certificate[]" id="certificate1" class="certificate" placeholder="CERTIFICATE" multiple="" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>
                                          <div class="bestofmine_image_degree" style="color:#f00; display: block;"></div>
                                           <?php
                                                if ($edu_certificate1) {

                                                   $ext = explode('.',$edu_certificate1);
                                                   if($ext[1] == 'pdf')
                                                      { 
                                                   ?>
                                                        <!--  <a href="<?php //echo base_url('job/creat_pdf_graduation/'.$jobgrad[$x]['job_graduation_id'].'/graduation') ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a> -->

                                                          <a title="open pdf" class="fl" href="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate1) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                      <?php
                                                      }
                                                      else
                                                      {
                                                    ?>
                                                <img src="<?php echo base_url($this->config->item('job_edu_main_upload_path') . $edu_certificate1) ?>" style="width:100px;height:100px;">
                                             <?php
                                                }
                                             }
                                          ?>

                                          <?php echo form_error('certificate'); ?>
                                          <!--  </fieldset> -->
                                       </div>
                                       <!--clone div End-->
                                       <div class="fl job_edu_graduation_addbtnbox" >
                                          <input type="button" id="btnAdd" class="job_edu_graduation_addbtn" value=" + " /><br>
                                       </div>
                                       <div class="fl">
                                          <input type="button" id="btnRemove" class="job_edu_graduation_removebtn" value=" - "   />
                                       </div>
                                       <div class="fr job_edu_graduation_submitposition">
                                          <input type="Submit"  id="next" name="next" value="Save" class="job_edu_graduation_submitbtn" style="padding: 5px 9px;margin-right: 0px;">
                                       </div>
                                       <br>
                                       <?php
                                          }
                                          ?>
                                       <?php echo form_close(); ?>
                                       </article>
                                    </section>
                                 </div>
                              </div>
                           </div>
                           <!-- end of panel -->
                           <fieldset class="hs-submit full-width"  style="">
                              <?php if( $jobdata || $jobgrad)
                                 {
                                 ?>
                              <input type="button" id="next" name="next" value="Next" style="font-size: 16px;min-width: 120px;margin-right: 0px;"  onclick="next_page_edit()">
                              <?php
                                 }
                                 else
                                 {
                                     ?>
                              <input type="button" id="next" name="next" value="Next" style="font-size: 16px;min-width: 120px;margin-right: 0px;" onclick="next_page()">
                              <?php } ?>
                           </fieldset>
                        </div>
                        <!-- end of #bs-collapse  -->
                     </div>
                     <!-- end of container -->        
                     <!--  xyx -->
                     <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                     </div>
                     <!-- panel-group -->
                  </div>
               </div>
               <!-- next button start -->
               <!-- <fieldset class="hs-submit full-width">
                  <input type="button"  id="next" name="next" value="Next" onclick="next_page()">
                  
                   </fieldset> -->
               <!-- next button end -->
            </div>
         </div>
      </div>
   </section>
   <!-- Bid-modal  -->
   <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
      <div class="modal-dialog modal-lm">
         <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
            <div class="modal-body">
               <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
               <span class="mes"></span>
            </div>
         </div>
      </div>
   </div>
   <!-- Model Popup Close -->
   <footer>
</body>
</html>
<!-- Calender JS Start-->
<!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- This Js is used for call popup -->
<script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
<!-- This Js is used for call popup -->
<!-- <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
   -->                    
<!-- script for skill textbox automatic end -->
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
<!-- for search validation -->
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

<!-- duplicate div -->
<!-- <script type="text/javascript" src="<?php //echo base_url('js/app.js') ?>"></script> 
 --><!-- duplicate div end -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<!--validation for edit email formate form-->
<script type="text/javascript">
   $().ready(function () {
   
   jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
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
   
   
       $("#jobseeker_regform_primary").validate({
   
           rules: {
   
               board_primary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_primary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_primary: {
   
                   required: true,
                  // range: [1, 100],
                   //pattern: /^[A-Za-z]{0,}$/
                      // minlength: 1,
                      // maxlength: 5,
                   // pattern: /^[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)$/
                   number:true,
                    pattern_primary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
                  // pattern1: /^[0-9]{1,2}(\.[0-9]{0,1})?$/
   
               },
   
               pass_year_primary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_primary: {
   
                   required: "Board Is Required.",
   
               },
   
               school_primary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_primary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage",
                   
   
               },
   
               pass_year_primary: {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });
   
   //pattern validation at percentage start//
   $.validator.addMethod("pattern_primary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage Between 1-100 Only");
   
   //pattern validation at percentage end//
</script>
<script type="text/javascript">
   $().ready(function () {
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
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
   
   
       $("#jobseeker_regform_secondary").validate({
   
           rules: {
   
               board_secondary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_secondary: {
   
                   required: true,
                  // range: [1, 100],
                   //pattern: /^[A-Za-z]{0,}$/
                      // minlength: 1,
                      // maxlength: 5,
                   // pattern: /^[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)$/
                   number:true,
                    pattern_secondary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
                  // pattern1: /^[0-9]{1,2}(\.[0-9]{0,1})?$/
               },
   
               pass_year_secondary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_secondary: {
   
                   required: "Board Is Required.",
   
               },
   
               school_secondary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_secondary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
               },
   
               pass_year_secondary: {
   
                   required: "Passing Year Is Required.",
   
               },
   
           }
   
       });
   });
   
   //pattern validation at percentage start//
   $.validator.addMethod("pattern_secondary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   
   //pattern validation at percentage end//
</script>
<script type="text/javascript">
   $().ready(function () {
   
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");
   
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
   
   
       $("#jobseeker_regform_higher_secondary").validate({
   
           rules: {
   
               board_higher_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
               stream_higher_secondary: {
   
                   required: true,
                    regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               school_higher_secondary: {
   
                   required: true,
                   regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
   
               percentage_higher_secondary: {
   
                    required: true,
                
                   number:true,
                    pattern_higher_secondary: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
                 
   
               },
   
               pass_year_higher_secondary: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               board_higher_secondary: {
   
                   required: "Board Is Required.",
   
               },
               stream_higher_secondary: {
   
                   required: "Stream Is Required",
   
               },
   
               school_higher_secondary: {
   
                   required: "School Is Required.",
   
               },
   
               percentage_higher_secondary: {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
   
               },
   
               pass_year_higher_secondary: {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });
   
   //pattern validation at percentage start//
   $.validator.addMethod("pattern_higher_secondary", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   
   //pattern validation at percentage end//
</script>
<script type="text/javascript">
   $().ready(function () {
   
       jQuery.validator.addMethod("noSpace", function(value, element) { 
   return value == '' || value.trim().length != 0;  
   }, "No space please and don't leave it empty");

    //    jQuery.validator.addMethod('selectcheck', function (value) {
    //    alert(value);
    //      if(value == '463')
    //      {
    //         alert(hi);
    //        // return value;
    //      }
    //      else
    //      {
    //         alert(hi1);
    //         //return true;
    //      }
       
    // }, "other is not valide");
    $.validator.addMethod("valueNotEquals", function(value, element, arg){ 
      if(arg == value)
      { 
         if(($.fancybox.open()))
         {
                  
               if($('#input1 #university1').hasClass('error') )
               {
                     
             
                     $("#input1 .university").removeClass("error");
                     $('label.error').remove();
                    return true;     
                }

          
         }

         return false;
      }
      else
      {
         return true;
      }
 }, "Other Option Selection Is Not Valid");

   
   $.validator.addMethod("regx", function(value, element, regexpr) {          
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
   }, "This is not Proper Format of Grade");
   
       $("#jobseeker_regform").validate({
   
           rules: {
   
               'degree[]': {
   
                   required: true,
   
               },
   
               'stream[]': {
   
                   required: true,
   
               },
   
               'university[]': {
   
                   required: true,
                    valueNotEquals: 463,
                  //selectcheck:true,
   
               },
   
               'college[]': {
   
                   required: true,
                     regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
   
               },
                'grade[]': {
   
                   //regx:/^[A-Za-z+-]*$/
                   // regx:/^[A-Za-z{1,2}+-{1}]*$/
                   regx:/^(?:[ABCD][+-]?|AB[+-]?|[ABCD][+][+]|[AW]?F)$/
               
                },
               'percentage[]': {
   
                   required: true,
                  // range: [1, 100],
                   //pattern: /^[A-Za-z]{0,}$/
                      // minlength: 1,
                      // maxlength: 5,
                   // pattern: /^[+-]?([0-9]+([.][0-9]*)?|[.][0-9]+)$/
                   number:true,
                    pattern_degree: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/
                  // pattern1: /^[0-9]{1,2}(\.[0-9]{0,1})?$/
               },
               'pass_year[]': {
   
                   required: true,
                   
               },
   
           },
   
           messages: {
   
               'degree[]': {
   
                   required: "Degree Is Required.",
   
               },
   
               'stream[]': {
   
                   required: "Stream Is Required.",
   
               },
   
               'university[]': {
   
                   required: "University Is Required.",
   
               },
   
               'college[]': {
   
                   required: "College Is Required.",
   
               },
               // 'grade[]': {
   
               //     required: "Grade Is Required.",
   
               // },
               'percentage[]': {
   
                   required: "Percentage Is Required.",
                    minlength: "Please Select Percentage Between 1-100 Only",
                    maxlength: "Please Select Percentage Between 1-100 Only",
   
               },
               'pass_year[]': {
   
                   required: "Year Of Passing Is Required.",
   
               },
   
           }
   
       });
   });
   
    //pattern validation at percentage start//
   $.validator.addMethod("pattern_degree", function(value, element, param) {
   if (this.optional(element)) {
   return true;
   }
   if (typeof param === "string") {
   param = new RegExp("^(?:" + param + ")$");
   }
   return param.test(value);
   }, "Please Select Percentage In Proper Format");
   //pattern validation at percentage end//
</script>
<!-- Clone input type start-->
<script>
   $('#btnRemove').attr('disabled', 'disabled');
   
   $('#btnAdd').click(function () {
       var num = $('.clonedInput').length;
       var newNum = new Number(num + 1);
       //alert(newNum);
   
       if (newNum > 5)
       {
   
           $('#btnAdd').attr('disabled', 'disabled');
           alert("You Can add only 5 fields");
           return false;
   
       }
      
         
      var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);
      var $clone = $('#input' + num).clone();
    //  $clone.find('input').val('');
     // $clone.find('select').val('0');
     
       newElem.children('.education_data').attr('id', 'education_data' + newNum).attr('name', 'education_data[]').attr('value', 'new');
       newElem.children('.degree').attr('id', 'degree' + newNum).attr('name', 'degree[]');
       newElem.children('.stream').attr('id', 'stream' + newNum).attr('name', 'stream[]');
       newElem.children('.university').attr('id', 'university' + newNum).attr('name', 'university[]');
       newElem.children('.college').attr('id', 'college' + newNum).attr('name', 'college[]');
       newElem.children('.grade').attr('id', 'grade' + newNum).attr('name', 'grade[]');
       newElem.children('.percentage').attr('id', 'percentage' + newNum).attr('name', 'percentage[]');
       newElem.children('.pass_year').attr('id', 'pass_year' + newNum).attr('name', 'pass_year[]');
       newElem.children('.certificate').attr('id', 'certificate' + newNum).attr('name', 'certificate[]');
   
       $('#input' + num).after(newElem);
       $('#btnRemove').removeAttr('disabled', 'disabled');
       $('#input' + newNum + ' #pass_year1').val('');   
       $('#input' + newNum + ' .degree').val(''); 
       $('#input' + newNum + ' .stream').val('');
       $('#input' + newNum + ' .university').val(''); 
       $('#input' + newNum + ' #percentage1').val(''); 
     
      $('#input' + newNum + '.certificate').replaceWith($("#certificate"+ newNum).val('').clone(true));
   
       $('#input' + newNum + ' .exp_data').val(''); 
       $('#input' + newNum + ' .hs-submit').remove();    
       $("#input" + newNum + ' img').remove();
        });
   
   
   $('#btnRemove').on('click', function () {
   
       var num = $('.clonedInput').length;
   
       if (num - 1 == <?php echo $predefine_data; ?>)
       {
   
           $('#btnRemove').attr('disabled', 'disabled');
   
   
       }
       $('.clonedInput').last().remove();
   
   });
   
   // $('#btnRemove').on('click', function() {
   //     $('.clonedInput').last().remove();
   
   
   // });
   
   
   $('#btnAdd').on('click', function () {
   
       $('.clonedInput').last().add().find("input:text").val("");
   
   
   
   });
</script>
<!-- Clone input type End-->
<!-- stream change depend on degeree start-->
<script>
   $(document).on('change', '#input1 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input1 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
    $(document).on('change', '#input2 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input2 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
     $(document).on('change', '#input3 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input3 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
      $(document).on('change', '#input4 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input4 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
   
       $(document).on('change', '#input5 select.degree', function (event) {
                   var aa = $(this).attr('id');
                   var lastChar = aa.substr(aa.length - 1);
                   var degreeID = $('option:selected', this).val();   
                   if (degreeID) {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "job/ajax_data"; ?>',
                           data: 'degree_id=' + degreeID,
                           success: function (html) {
                               $("#input5 #stream"+ lastChar).html(html); }
                       });
                   } else {$('#stream' + lastChar).html('<option value="">Select Degree first</option>');
                   }
               });
           
</script>
<!-- stream change depend on degree End-->

<script type="text/javascript">
   $(".alert").delay(3200).fadeOut(300);
</script>

<script type="text/javascript">

//Click on University other option process Start 
   $(document).on('change', '#input1 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');   

   $('.message #univer').on('click', function () {

      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><div class="fw text-center"><button data-fancybox-close="" class="btn">OK</button></div></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input1 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input2 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input2 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input3 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input3 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input4 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input4 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   
   $(document).on('change', '#input5 .university', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                   $('.university').html(response.select1);
                                   $('#input5 .university').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
//Click on University other option process End 

//Click on Degree other option process Start 
   $(document).on('change', '#input1 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input1 .degree').html(response.select);
                                    $('#input1 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input2 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input2 .degree').html(response.select);
                                    $('#input2 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input3 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input3 .degree').html(response.select);
                                    $('#input3 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input4 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input4 .degree').html(response.select);
                                    $('#input4 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   
   $(document).on('change', '#input5 .degree', function (event) {
      var item=$(this);
      var degree=(item.val());
      
      if(degree == 54)
      {
            $.fancybox.open('<div class="message"><h2>Add Degree</h2><input type="text" name="other_degree" id="other_degree"><h2>Add Stream</h2><select name="other_stream" id="other_stream" class="other_stream">  <option value="" Selected option disabled>Select your Stream</option><?php foreach ($stream_alldata as $stream){?><option value="<?php echo $stream['stream_id']; ?>"><?php echo $stream['stream_name']; ?></option><?php } ?>  <option value="<?php echo $stream_otherdata[0]['stream_id']; ?> "><?php echo $stream_otherdata[0]['stream_name']; ?></option> </select><a id="univer" class="btn">OK</a></div>');
             $('.message #univer').on('click', function () {
                 var degree = document.querySelector(".message #other_degree").value;
                 var stream = document.querySelector(".message #other_stream").value;     
           if (stream == '' || degree == '')
           {
               if(degree == '' && stream != '')
               {
                    $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if(stream == '' && degree != '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
               if (stream == '' && degree == '')
               {
                  $.fancybox.open('<div class="message"><h2>Empty Degree and Empty Stream are not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
               }
                return false;
           }
           else
            {   
                var $textbox = $('.message').find('input[type="text"]'),
                textVal  = $textbox.val();
                var selectbox_stream = $('.message').find(":selected").text()
               
                $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_degree" ?>',
                          dataType: 'json',
                          data: 'other_degree=' + textVal+ '&other_stream=' + selectbox_stream,
                          success: function (response) {
                     
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Degree already available in Degree Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Degree is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.degree').html(response.select1);
                                    $('#input5 .degree').html(response.select);
                                    $('#input5 .stream').html(response.select2);      
                              }
                          }
                      });
                  }
                  });
       }
   });
   

 $(document).on('change', '.message #other_stream', function (event) {

var item1=$(this);
var other_stream=(item1.val());
 
 if(other_stream == 61)
{
    $.fancybox.open('<div class="message1"><h2>Add Stream</h2><input type="text" name="other_degree1" id="other_degree1"><a id="univer1" class="btn">OK</a></div>');

      $('.message1 #univer1').on('click', function () {
      var $textbox1 = $('.message1').find('input[type="text"]'),
      textVal1  = $textbox1.val();

       $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "job/job_other_stream" ?>',
                          data: 'other_stream=' + textVal1,
                          success: function (response) {
                       
                               if(response == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written Stream already available in  Stream Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty Stream is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                    $('.message #other_stream').html(response);
                              }
                          }
                      });
    
      });
}
       
       }); 
//Click on Degree other option process End
</script>
<!-- script start for next button -->
<script type="text/javascript">
   function next_page()
   {
   
   //alert(clicked_id);
    
    var board_primary = document.getElementById('board_primary').value;
    var school_primary = document.getElementById('school_primary').value;
    var percentage_primary = document.getElementById('percentage_primary').value;
    var pass_year_primary = document.getElementById('pass_year_primary').value;
   
   var board_secondary = document.getElementById("board_secondary").value;
   var school_secondary = document.getElementById("school_secondary").value;
   var percentage_secondary = document.getElementById("percentage_secondary").value;
   var pass_year_secondary = document.getElementById("pass_year_secondary").value;
   
   var board_higher_secondary = document.getElementById("board_higher_secondary").value;
   var stream_higher_secondary = document.getElementById("stream_higher_secondary").value;
   var school_higher_secondary = document.getElementById("school_higher_secondary").value;
   var percentage_higher_secondary = document.getElementById("percentage_higher_secondary").value;
   var pass_year_higher_secondary = document.getElementById("pass_year_higher_secondary").value;
   
   var num = $('.clonedInput').length;
   
   if(num==1 || num<6)
   {
        
           var degree1 = document.querySelector("#input1 .degree").value;
           var stream1 = document.querySelector("#input1 .stream").value;
           var university1 = document.querySelector("#input1 .university").value;
           var college1 = document.querySelector("#input1 .college").value;
           var percentage1 = document.querySelector("#input1 .percentage").value;
           var pass_year1 = document.querySelector("#input1 .pass_year").value;
          
   }
   if(num==2 || (num>1 && num<6))
   {    
           var degree2= document.querySelector("#input2 .degree").value;
           var stream2 = document.querySelector("#input2 .stream").value;
           var university2 = document.querySelector("#input2 .university").value;
           var college2 = document.querySelector("#input2 .college").value;
           var percentage2 = document.querySelector("#input2 .percentage").value;
           var pass_year2 = document.querySelector("#input2 .pass_year").value;
   }
   
   if(num==3 || (num>2 && num<6))
   {    
       var degree3 = document.querySelector("#input3 .degree").value;
       var stream3 = document.querySelector("#input3 .stream").value;
       var university3 = document.querySelector("#input3 .university").value;
       var college3 = document.querySelector("#input3 .college").value;
       var percentage3 = document.querySelector("#input3 .percentage").value;
       var pass_year3 = document.querySelector("#input3 .pass_year").value;
   }
   
   if(num==4 || (num>3 && num<6))
   {     
       var degree4= document.querySelector("#input4 .degree").value;
       var stream4 = document.querySelector("#input4 .stream").value;
       var university4 = document.querySelector("#input4 .university").value;
       var college4 = document.querySelector("#input4 .college").value;
       var percentage4 = document.querySelector("#input4 .percentage").value;
       var pass_year4 = document.querySelector("#input4 .pass_year").value;
   }
   
   if(num==5)
   {  
       var degree5 = document.querySelector("#input5 .degree").value;
       var stream5 = document.querySelector("#input5 .stream").value;
       var university5 = document.querySelector("#input5 .university").value;
       var college5 = document.querySelector("#input5 .college").value;
       var percentage5 = document.querySelector("#input5 .percentage").value;
       var pass_year5 = document.querySelector("#input5 .pass_year").value;
   }
   
   //for clonedInput length 1 start
   if(num==1)
   {
     
        
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '')
    {
         
       $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
          
    }
          
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {   
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
              
           }
           else if(degree1!='' ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
                $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
           else
           {
              $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data </h2><button data-fancybox-close="" class="btn">OK</button></div>');
               
           }
       }
       
       else
       {
            $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="")
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>'); 
       }
   }
   
   
      }
   //for clonedInput length 1 end
   
   //for clonedInput length 2 start
   if(num==2)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '')
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data </h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 2 end
   
   //for clonedInput length 3 start
   if(num==3)
   {
      
      
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '')
    {
       $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');    
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 3 end
   
   //for clonedInput length 4 start
   if(num==4)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '' && degree4=="" &&  stream4 == '' && university4 == '' && college4 == '' && percentage4 == '' && pass_year4 == '')
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' )
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
            
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="" && degree4!="" && stream4!="" && university4!="" && college4!="" &&  percentage4!="" && pass_year4!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 4 end
   
   //for clonedInput length 5 start
   if(num==5)
   {
      
          
    if(board_primary=="" && school_primary=="" && percentage_primary=="" && pass_year_primary=="" && school_secondary == '' && percentage_secondary == '' && pass_year_secondary == '' && board_secondary == '' && board_higher_secondary == '' && stream_higher_secondary == '' && school_higher_secondary == '' && percentage_higher_secondary == '' && pass_year_higher_secondary == '' && degree1=="" &&  stream1 == '' && university1 == '' && college1 == '' && percentage1 == '' && pass_year1 == '' && degree2=="" &&  stream2 == '' && university2 == '' && college2 == '' && percentage2 == '' && pass_year2 == '' && degree3=="" &&  stream3 == '' && university3 == '' && college3 == '' && percentage3 == '' && pass_year3 == '' && degree4=="" &&  stream4 == '' && university4 == '' && college4 == '' && percentage4 == '' && pass_year4 == '' && degree5=="" &&  stream5 == '' && university5 == '' && college5 == '' && percentage5 == '' && pass_year5 == '' )
    {
         $.fancybox.open('<div class="message"><h2>Must fill out any of four</h2><button data-fancybox-close="" class="btn">OK</button></div>');
    }
    
   else if(board_primary!="" || school_primary!="" || percentage_primary!="" || pass_year_primary!="")
   {
       if(board_primary!="" && school_primary!="" && percentage_primary!="" && pass_year_primary!="")
       {
           if(school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '' || board_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Primary Education to  fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
   
   else if(board_secondary!="" || school_secondary!="" || percentage_secondary!="" || pass_year_secondary!="")
   {
       if(board_secondary!="" && school_secondary!="" && percentage_secondary!="" && pass_year_secondary!="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary != '' || stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( board_higher_secondary!="" || stream_higher_secondary !="" || school_higher_secondary !="" || percentage_higher_secondary !="" || pass_year_higher_secondary !="")
   {
       if(board_higher_secondary!="" && stream_higher_secondary!="" && school_higher_secondary!="" && percentage_higher_secondary!="" && pass_year_higher_secondary !="")
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(degree1!="" ||  stream1 != '' || university1 != '' || college1 != '' ||  percentage1 != '' || pass_year1 != '' || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Higher Secondary Education to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   else if( degree1!="" || stream1 !="" || university1 !="" || college1 !="" ||  percentage1 !="" || pass_year1 !="" || degree2!="" ||  stream2 != '' || university2 != '' || college2 != '' ||  percentage2 != '' || pass_year2 != '' || degree3!="" ||  stream3 != '' || university3 != '' || college3 != '' ||  percentage3 != '' || pass_year3 != '' || degree4!="" ||  stream4 != '' || university4 != '' || college4 != '' ||  percentage4 != '' || pass_year4 != '' || degree5!="" ||  stream5 != '' || university5 != '' || college5 != '' ||  percentage5 != '' || pass_year5 != '')
   {
       if(degree1!="" && stream1!="" && university1!="" && college1!="" &&  percentage1!="" && pass_year1!="" && degree2!="" && stream2!="" && university2!="" && college2!="" &&  percentage2!="" && pass_year2!="" && degree3!="" && stream3!="" && university3!="" && college3!="" &&  percentage3!="" && pass_year3!="" && degree4!="" && stream4!="" && university4!="" && college4!="" &&  percentage4!="" && pass_year4!="" && degree5!="" && stream5!="" && university5!="" && college5!="" &&  percentage5!="" && pass_year5!="" )
       {
           if(board_primary != '' || school_primary != '' || percentage_primary != '' || pass_year_primary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Primary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_secondary != '' || school_secondary != '' || percentage_secondary != '' || pass_year_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else if(board_higher_secondary!="" ||  stream_higher_secondary != '' || school_higher_secondary != '' || percentage_higher_secondary != '' || pass_year_higher_secondary != '')
           {
               $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Higher Secondary Education field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
           else
           {
               $.fancybox.open('<div class="message"><h2>Please press submit button of Graduation to fulfil data</h2><button data-fancybox-close="" class="btn">OK</button></div>');
           }
       }
       
       else
       {
           $.fancybox.open('<div class="message"><h2>Please complete mendatory detail of Graduation field</h2><button data-fancybox-close="" class="btn">OK</button></div>');
       }
   }
   
   
      }
   //for clonedInput length 5 end
   
   }
   
   //edit time next page
   function next_page_edit() {
   
       $.fancybox.open('<div class="message"><h2>Do you want to leave this page?</h2><a class="mesg_link" href="<?php echo base_url() ?>job/job_project_update">OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
   }
      
     
</script>
<script type="text/javascript">
   $(".alert").delay(3200).fadeOut(300);
</script>
<!--                    <style type="text/css">   
   .clonedInput{  
       border-bottom: 2px solid #060606;   
   } 
   </style>-->
<script type="text/javascript">
     
function delete_job_exp(grade_id,certificate) {

      $.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Graduation Detail?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');

  $('.message #delete').on('click', function () {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/job_edu_delete" ?>',
           data: 'grade_id=' + grade_id+ '&certificate=' + certificate,
           // dataType: "html",
           success: function (data) {
               if (data == 1) {
                   $.fancybox.close();
                   $('.job_work_edit_' + grade_id).remove();
               }
             // window.location.reload();
           }
       });
        });
   }

   //DELETE PRIMARY CERTIFICATE START
function delete_primary(edu_id,certificate) {
  
$.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Primary Education Certificate?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
 
      $('.message #delete').on('click', function () {
         $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/delete_primary" ?>',
           data: 'edu_id=' + edu_id+ '&certificate=' + certificate,
           success: function (data) {

               if (data == 1) 
               {
                  $.fancybox.close();      
                  $('#primary_remove a').remove();
                  $('#primary_remove img').remove();
                  $('#primary_certi').remove();
               }
             
           }
       });

             });
          }
   //DELETE PRIMARY CERTIFICATE END

//DELETE SECONDARY CERTIFICATE START
function delete_secondary(edu_id,certificate) {
  
$.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Secondary Education Certificate?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
 
      $('.message #delete').on('click', function () {
         $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/delete_secondary" ?>',
           data: 'edu_id=' + edu_id+ '&certificate=' + certificate,
           success: function (data) {

               if (data == 1) 
               {
                  $.fancybox.close();      
                  $('#secondary_remove a').remove();
                  $('#secondary_remove img').remove();
                  $('#secondary_certi').remove();
               }
               
           }
       });

             });
          }
//DELETE SECONDARY CERTIFICATE END

//DELETE SECONDARY HIGHER CERTIFICATE START
function delete_higher_secondary(edu_id,certificate) {
  
$.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Higher Secondary Education Certificate?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
 
      $('.message #delete').on('click', function () {
         $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/delete_higher_secondary" ?>',
           data: 'edu_id=' + edu_id+ '&certificate=' + certificate,
           success: function (data) {

               if (data == 1) 
               {
                  $.fancybox.close();      
                  $('#higher_secondary_remove a').remove();
                  $('#higher_secondary_remove img').remove();
                  $('#higher_secondary_certi').remove();
               }
               
           }
       });

             });
          }
//DELETE SECONDARY HIGHER CERTIFICATE END

//DELETE DEGREE CERTIFICATE START
function delete_graduation(edu_id,certificate) {
  
$.fancybox.open('<div class="message"><h2>Are you sure you want to Delete this Degree Certificate?</h2><a id="delete" class="mesg_link btn" >OK</a><button data-fancybox-close="" class="btn">Cancel</button></div>');
 
      $('.message #delete').on('click', function () {
         $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "job/delete_graduation" ?>',
           data: 'edu_id=' + edu_id+ '&certificate=' + certificate,
           success: function (data) {

               if (data == 1) 
               {
                  $.fancybox.close();   
                  $('.job_work_edit_'+edu_id+' .img_work_exp a').remove();
                  $('.job_work_edit_'+edu_id+' .img_work_exp img').remove();
                  $('.job_work_edit_'+edu_id+'  #graduation_certi').remove();
               }
               
           }
       });

             });
          }
//DELETE DEGREE CERTIFICATE END

</script>
<style type="text/css">
   .job_work_experience_main_div{
   margin-top: 10px;
   /* border-bottom: 2px solid #d9d9d9;*/
   /*margin-bottom: 20px;*/
   display: inline-block;
   }
   .img_remove img{display: none!important;}
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
                         // $('#one').removeClass('in'); 
                         //  $('#toggle').addClass('collapsed');
   
             }else{
                       //$('#one').addClass('in');
                       $('#panel-heading').addClass('active'); 
                        // $('#one').addClass('in'); 
                        //  $('#toggle').removeClass('collapsed');
                        $('#panel-heading1').removeClass('active');
                        $('#panel-heading2').removeClass('active');
                        $('#panel-heading3').removeClass('active');
             }
         });
   
       $('#toggle1').on('click', function(){
     
             if($('#panel-heading1').hasClass('active')){
                       $('#panel-heading1').removeClass('active');
             }else{
                       $('#panel-heading1').addClass('active');
                        $('#panel-heading').removeClass('active');
                         $('#panel-heading2').removeClass('active');
                        $('#panel-heading3').removeClass('active');
             }
         }); 
   
        $('#toggle2').on('click', function(){
     
             if($('#panel-heading2').hasClass('active')){
                       $('#panel-heading2').removeClass('active');
             }else{
                       $('#panel-heading2').addClass('active');
                        $('#panel-heading').removeClass('active');
                         $('#panel-heading1').removeClass('active');
                        $('#panel-heading3').removeClass('active');
             }
         }); 
   
         $('#toggle3').on('click', function(){
     
             if($('#panel-heading3').hasClass('active')){
                       $('#panel-heading3').removeClass('active');
             }else{
                       $('#panel-heading3').addClass('active');
                        $('#panel-heading').removeClass('active');
                         $('#panel-heading1').removeClass('active');
                        $('#panel-heading2').removeClass('active');
             }
         }); 
   
     });
   
   
   //script for click on - change to + End
   
   //script for only jpg png image upload start
   
   //for primary Education certificate start
   $(document).ready(function(){
     $('#edu_certificate_primary').change(function(e){
         var image = document.getElementById("edu_certificate_primary").value;
         if(image != '')
         { 
              var image_ext = image.split('.').pop();
              var allowesimage = ['jpg','png','jpeg','gif','pdf'];
              var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
             if(foundPresentImage == false)
             {
                 $(".bestofmine_image_primary").html("Please select only Image file & Pdf File.");
                 return false;  
             }
             else
             {
                 $(".bestofmine_image_primary").html(" ");
                 return true;
             }
         }      
     });
     $("#jobseeker_regform_primary").submit(function(){
             var text = $('.bestofmine_image_primary').text();
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
   //for primary Education certificate End
   
   //for Secondary Education certificate start
   $(document).ready(function(){
     $('#edu_certificate_secondary').change(function(e){    
         var image = document.getElementById("edu_certificate_secondary").value;
         if(image != '')
         { 
              var image_ext = image.split('.').pop();
              var allowesimage = ['jpg','png','jpeg','gif','pdf'];
              var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
             if(foundPresentImage == false)
             {
                 $(".bestofmine_image_secondary").html("Please select only Image file & Pdf File.");
                 return false;  
             }
             else
             {
                 $(".bestofmine_image_secondary").html(" ");
                 return true;
             }
         }      
     });
     $("#jobseeker_regform_secondary").submit(function(){
             var text = $('.bestofmine_image_secondary').text();
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
   //for Secondary Education certificate End
   
   //for Higher Secondary Education certificate start
   $(document).ready(function(){
     $('#edu_certificate_higher_secondary').change(function(e){
         var image = document.getElementById("edu_certificate_higher_secondary").value;
         if(image != '')
         { 
              var image_ext = image.split('.').pop();
              var allowesimage = ['jpg','png','jpeg','gif','pdf'];
              var foundPresentImage = $.inArray(image_ext, allowesimage) > -1;
             if(foundPresentImage == false)
             {
                 $(".bestofmine_image_higher_secondary").html("Please select only Image file & Pdf File.");
                 return false;  
             }
             else
             {
                 $(".bestofmine_image_higher_secondary").html(" ");
                 return true;
             }
         }      
     });
     $("#jobseeker_regform_higher_secondary").submit(function(){
             var text = $('.bestofmine_image_higher_secondary').text();
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
   //for Higher Secondary Education certificate End
   
   //for Degree certificate start
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
     $("#jobseeker_regform").submit(function(){
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
     $("#jobseeker_regform").submit(function(){
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
     $("#jobseeker_regform").submit(function(){
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
     $("#jobseeker_regform").submit(function(){
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
     $("#jobseeker_regform").submit(function(){
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
   //for Degree certificate End

   
   //script for only jpg png image upload start
</script>

