<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>

      <style>
body {font-family: "Lato", sans-serif;}

ul.tab {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Float the list items side by side */
ul.tab li {float: left;}

/* Style the links inside the list items */
ul.tab li a {
    display: inline-block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.tab li a:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>






    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                        <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li><a href="<?php echo site_url('job'); ?>">job management</a></li>

                <li class="active">Edit</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?>   <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  


                         <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'edit_job', 'id' => 'edit_job', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('job/edit_insert', $form_attr);

                                ?>



                    <!-- BASIC FORM ELELEMNTS -->

 <ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'basicinfo')">Basic Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'address')">Address</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'qualification')">Eduction Qualification</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'skill')">Professional Skill</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'applyfor')">Apply For</a></li>
  
   <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'exp')">Work Experience</a></li>
 
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'curricular')">Extra Curricular Activities</a></li>
   <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'reference')">interest & Reference</a></li>
    <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'carrier')">Carrier Objective</a></li>
</ul>


 
  <div class="row mt">

        <div id="basicinfo" class="tabcontent">              
                   
                                        <h1>Basic Information</h1><br><br>
                                  <fieldset>
                                         <select name="fname" id="user">
                                          <option value="">Select Username</option>
                                            <?php
                                            if(count($job) > 0){
                                                foreach($job as $j){
                                          ?>
                                                <option value="<?php echo $j['user_id']; ?>"><?php echo $j['fname']; ?></option>
                                           <?php }}
                                            ?>
                                        </select>
                                         <?php echo form_error('user'); ?>
                                        </fieldset><br><br>

                                       <fieldset>
                                        <label>First Name <span style="color:red">*</span></label>
                                         <input type="text" name="fname" id="fname" placeholder="Enter Firstname" value="<?php echo $job[0]['fname'];?>"/>&nbsp;&nbsp;&nbsp; <span id="fname-error"> </span>
                                        <?php echo form_error('fname'); ?>
                                        </fieldset><br><br>

                                      <fieldset>
                                        <label>Last Name <span style="color:red">*</span></label>
                                         <input type="text" name="lname"  id="lname" placeholder="Enter Lastname" value="<?php echo $job[0]['lname'];?>"/>&nbsp;&nbsp;&nbsp; <span id="lname-error"> </span>
                                        <?php echo form_error('lname'); ?>
                                        </fieldset><br><br>

                                      <fieldset>
                                        <label>Email Address <span style="color:red">*</span></label>
                                         <input type="text" name="email" id="email" placeholder="Enter Email Address" value="<?php echo $job[0]['email'];?>"/>&nbsp;&nbsp;&nbsp; <span id="email-error"> </span>
                                         <?php echo form_error('email'); ?>
                                        </fieldset><br><br>

                                        <fieldset>
                                        <label>Phone Number <span style="color:red">*</span></label>
                                         <input type="text" name="phnno" id="phnno" placeholder="Enter Phone Number" value="<?php echo $job[0]['phnno'];?>"/>&nbsp;&nbsp;&nbsp; <span id="phnno-error"> </span>
                                         <?php echo form_error('phnno'); ?>
                                        </fieldset><br><br>
                        

                                    <fieldset <?php if($marital_status) {  ?> class="error-msg" <?php } ?>>
                                    <label>Marital Status <span style="color:red">*</span></label>
                                    <input type="radio" name="marital_status" value="married" id="marital_status"  <?php echo ($job[0]['marital_status']=='married')?'checked':'' ?>>Married
                                    <input type="radio" name="marital_status" value="unmarried" id="marital_status" <?php echo ($job[0]['marital_status']=='unmarried')?'checked':'' ?>  >Unmarried
                                    <!-- <input type="radio" name="marital_status" value="divorced" id="marital_status">Divorced -->
                                      <span id="marital_status-error"> </span>
                                      <?php echo form_error('marital_status'); ?>
                                </fieldset>

                                         <fieldset <?php if($nationality) {  ?> class="error-msg" <?php } ?>>
                                        <label>Nationality</label>

                                        <select name="nationality" id="nationality">
                                          <option value="">Select Nationality</option>
                                            <?php
                                             
                                            if(count($nation) > 0){
                                                foreach($nation as $cnt){
                                          
                                            if($job[0]['nation_id'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['nation_id']; ?>"
                                                  <?php if($cnt['nation_id']==$job[0]['nation_id']) echo 'selected';?>><?php echo $cnt['nation_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $cnt['nation_id']; ?>"><?php echo $cnt['nation_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>

                                            
                                        </select>
                                         <?php echo form_error('nationality'); ?>
                                    </fieldset>

                                       

                                        <fieldset>
                                        <label>Language Known:</label>
                                        <input type="checkbox" name="language[]" value="gujarati">Gujarati
                                        <input type="checkbox" name="language[]" value="hindi">Hindi
                                        <input type="checkbox" name="language[]" value="english">English
                                         <?php echo form_error('language'); ?>
                                        </fieldset><br><br>



                                          
                                
                                        <fieldset>
                                        <label>Date of Birth<span style="color:red">*</span></label>
                                         <input type="text" name="dob" id="datepicker" placeholder="Enter Date of Birth" value="<?php echo $job[0]['dob'];?>"/>&nbsp;&nbsp;&nbsp; <span id="dob-error"> </span>
                                         <?php echo form_error('dob'); ?>
                                       </fieldset><br><br>

                                    <fieldset <?php if($gender) {  ?> class="error-msg" <?php } ?>>
                                    <label>Gender<span style="color:red">*</span></label>
                                    <input type="radio" name="gender" value="male" id="gender" <?php echo ($job[0]['gender']=='male')?'checked':'' ?>>Male
                                    <input type="radio" name="gender" value="female" id="gender" <?php echo ($job[0]['gender']=='female')?'checked':'' ?> >Female
                                       <span id="gender-error"> </span>
                                      <?php echo form_error('gender'); ?>
                                </fieldset>
                          

</div>
                                <div id="address" class="tabcontent">

                            <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
                                
                                 
                                        <h1>Address</h1><br><br>
                                         <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
                                        <label>Country</label>

                                        <select name="country" id="country">
                                          <option value="">Select Country</option>
                                            <?php


                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){
                                          
                                            if($job[0]['country_id'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>"
                                                  <?php if($cnt['country_id']==$job[0]['country_id']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>

                                            
                                        </select>
                                         <?php echo form_error('country'); ?>
                                    </fieldset>

                                    <fieldset <?php if($state) {  ?> class="error-msg" <?php } ?>>
                                        <label>State</label>
                                        <select name="state" id="state">
                                        <?php
                                          
                                            foreach($states as $cnt){
                                                if($job[0]['state_id'])

                                            {
                                                 //echo "hi";die();
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$job[0]['state_id']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                              
                                                else
                                                {
                                            ?>
                                                 <option value="">Select country first</option>
                                                  <?php
                                            
                                            }}
                                            ?>
                                        
                                        </select>
                                         <?php echo form_error('state'); ?>
                                    </fieldset>

                                    <fieldset <?php if($city) {  ?> class="error-msg" <?php } ?>>
                                        <label>City</label>
                                        <select name="city" id="city">
                                        <?php
                                          foreach($cities as $cnt){
                                                if($job[0]['city_id'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$freelancer[0]['city_id']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

                                                <?php
                                                }
                                              
                                                else
                                                {
                                            ?>
                                        <option value="">Select state first</option>

                                         <?php
                                            
                                            }}
                                            ?>
                                        </select>
                                        <?php echo form_error('city'); ?>
                                    </fieldset>

                                        
                                     <fieldset>
                                        <label>Pincode:<span style="color:red">*</span></label>
                                         <input type="text" name="pincode" id="pincode" placeholder="pincode" value="<?php echo $job[0]['pincode'];?>"/>&nbsp;&nbsp;&nbsp; <span id="pincode-error"> </span>
                                         <?php echo form_error('pincode'); ?>
                                        </fieldset>

                                     <fieldset>
                                        <label>Address:<span style="color:red">*</span></label>

                                          <?php echo form_textarea(array('name' => 'address', 'id' => 'address','value' => html_entity_decode($job[0]['address']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                         <?php echo form_error('address'); ?>
                                       </fieldset>

                               
                                </div>

                <div id="qualification" class="tabcontent">


                                  <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
                                
                              
                           <h1>Education</h1><br><br>

                            <fieldset <?php if($degree) {  ?> class="error-msg" <?php } ?>>
                                        <label>Degree</label>

                                        <select name="degree" id="degree">
                                          <option value="">Select degree</option>
                                            <?php


                                            if(count($degree_data) > 0){
                                                foreach($degree_data as $cnt){
                                          
                                            if($job[0]['degree'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['degree_id']; ?>"
                                                  <?php if($cnt['degree_id']==$job[0]['degree']) echo 'selected';?>><?php echo $cnt['degree_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>

                                            
                                        </select>
                                         <?php echo form_error('degree'); ?>
                                    </fieldset>

                                    <fieldset <?php if($stream) {  ?> class="error-msg" <?php } ?>>
                                        <label>Stream</label>
                                        <select name="stream" id="stream">
                                        <?php
                                          
                                            foreach($stream_data as $cnt){
                                                if($job[0]['stream'])

                                            {
                                                 //echo "hi";die();
                                              ?>

                                                 <option value="<?php echo $cnt['stream_id']; ?>" <?php if($cnt['stream_id']==$job[0]['stream_id']) echo 'selected';?>><?php echo $cnt['stream_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                              
                                                else
                                                {
                                            ?>
                                                 <option value="">Select country first</option>
                                                  <?php
                                            
                                            }}
                                            ?>
                                        
                                        </select>
                                         <?php echo form_error('stream'); ?>
                                    </fieldset>

                            
                                      <fieldset <?php if($univercity) {  ?> class="error-msg" <?php } ?>>
                                      <label>University:<span style="color:red">*</span></label>
                                       <select name="university" id="university">
                                       <option value="">Select your Univercity</option>


                                           <?php
                                        if(count($uni) > 0){
                                        foreach($uni as $cnt){

                                          if($job[0]['university'])
                                            {
                                      ?>
                                            <option value="<?php echo $cnt['university_id']; ?>" <?php if($cnt['university_id']==$job[0]['university']) echo 'selected';?>><?php echo $cnt['university_name'];?></option>
                                       <?php
                                      }
                                      else
                                      {

                                      ?>
                                        <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>

                                        <?php 
                                      }
                                    }}
                                      ?>
                                      </select>
                                      <?php echo form_error('univercity'); ?> 
                                      </fieldset>


                                      <fieldset>
                                        <label>College:<span style="color:red">*</span></label>
                                        <input type="text" name="college" id="college" placeholder="Enter college" value="<?php echo $job[0]['college'];?>"/>&nbsp;&nbsp;&nbsp; 
           
                                      
                                         <?php echo form_error('college'); ?>
                                        </fieldset><br><br>

                                      <fieldset>
                                        <label>Grade:<span style="color:red">*</span></label>
                                         <input type="text" name="grade" id="grade" placeholder="Enter Grade" value="<?php echo $job[0]['grade'];?>">
                                         <?php echo form_error('grade'); ?>
                                    </fieldset>

                                       <fieldset>
                                       <label>Percentage:<span style="color:red">*</span></label>
                                       <input type="number" name="percentage" id="percentage" placeholder="Enter Percentage"  value="<?php echo $job[0]['percentage']; ?>" />
                                         <?php echo form_error('percentage'); ?>
                                    </fieldset>
                                    

                                        <fieldset <?php if($pass_year) {  ?> class="error-msg" <?php } ?>>
                                        <label>Year of Passing:<span style="color:red">*</span></label>
                                         <select name="pass_year" id="pass_year" >
                                          <option value="" selected option disabled>--SELECT--</option>
                                         
                                          <?php 
                                          $curYear = date('Y');   
                                      
                                          for($i=$curYear; $i>=1900; $i--)
                                          {
                                            if($pass_year1)
                                             // echo ('hi');
                                            {
                                            ?>

                                              <option value="<?php echo $i ?>" <?php if($i==$pass_year1) echo 'selected';?>><?php echo $i?></option>


                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                              <option value="<?php echo $i ?>"><?php echo $i?></option>
                                        <?php
                                        }
                                          }
                                          ?> 
                                         
                                          </select>
                                         <?php echo form_error('pass_year'); ?>
                                    </fieldset>


                                       <fieldset>
                                        <label>Education Certificate</label>
                                         <input type="file" name="certificate" id="certificate" placeholder="EDUCATION CERTIFICATE" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>
                                           <img src="<?php echo base_url( JOBEDUCERTIFICATE . $job[0]['edu_certificate'])?>" style="width:100px;height:100px;">
                                            <input type="text" name="old_image" value="<?php echo $job[0]['edu_certificate']; ?>" />
                                        <?php echo form_error('certificate'); ?>
                                        <</fieldset><br><br>
                                
                            

                        </div>


                            <div id="skill" class="tabcontent">


                             <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>

                               
                                        <table>
                                        <h1>Keyskills</h1><br><br>
                                        <tr>
                                        <label>keyskills<span style="color:red">*</span></label>
                                         <input type="text" name="keyskill" id="keyskill" placeholder="KEYSKILL" value="<?php echo $job[0]['keyskill'];?>"/>&nbsp;&nbsp;&nbsp; <span id="keyskill-error"> </span>
                                        <?php echo form_error('keyskill'); ?>
                                        </tr><br><br>

                                </table>
                            </div>



                                <div id="applyfor" class="tabcontent">
                              <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>

                                <table>
                                        <h1>Apply For</h1><br><br>
                                        <tr>
                                        <label>Apply For<span style="color:red">*</span></label>
                                         <input type="text" name="ApplyFor" id="ApplyFor" placeholder="APPLY FOR" value="<?php echo $job[0]['ApplyFor'];?>" />&nbsp;&nbsp;&nbsp; <span id="ApplyFor-error"> </span>
                                        <?php echo form_error('ApplyFor'); ?>
                                        </tr><br><br>

                                </table>
                            </div>

                              
                                <div id="exp" class="tabcontent">

                             <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
                                
                                 <table>
                                        <h1>Work Experience</h1><br><br>
                                        <tr>
                                        <label>Job Title<span style="color:red">*</span></label>
                                         <input type="text" name="jobtitle" id="jobtitle" placeholder="Enter Job Title" value="<?php echo $job[0]['jobtitle'];?>"/>&nbsp;&nbsp;&nbsp; <span id="jobtitle-error"> </span>
                                        <?php echo form_error('jobtitle'); ?>
                                        </tr><br><br>

                                        <tr>

                                        <tr>
                                        <label>Company Name<span style="color:red">*</span></label>
                                         <input type="text" name="companyname" id="companyname" placeholder="Enter Company Name" value="<?php echo $job[0]['companyname'];?>" />&nbsp;&nbsp;&nbsp; <span id="companyname-error"> </span>
                                        <?php echo form_error('companyname'); ?>
                                        </tr><br><br>

                                        <tr>

                                        <tr>
                                        <label>Company Email<span style="color:red">*</span></label>
                                         <input type="text" name="companyemail" id="companyemail" placeholder="Enter Company Email" value="<?php echo $job[0]['companyemail'];?>"/>&nbsp;&nbsp;&nbsp; <span id="companyemail-error"> </span>
                                        <?php echo form_error('companyemail'); ?>
                                        </tr><br><br>

                                        <tr>

                                        <tr>
                                        <label>Company Phone<span style="color:red">*</span></label>
                                         <input type="text" name="companyphn" id="companyphn" placeholder="Enter Company Phone" value="<?php echo $job[0]['companyphn'];?>"/>&nbsp;&nbsp;&nbsp; <span id="companyphn-error"> </span>
                                        <?php echo form_error('companyphn'); ?>
                                        </tr><br><br>

                                        <label>Fresher? &nbsp;&nbsp; </label>
                                            <label for="Fresher">
                                            <input type="radio" id="fresher" name="radio" value="Fresher" checked="checked" />
                                            Fresher&nbsp;&nbsp;
                                        </label>
                                        <label for="Experience">
                                            <input type="radio" id="experience" name="radio" value="Experience" />
                                            Experience
                                        </label>
                                         <?php echo form_error('radio'); ?>
                                        <hr />
                                        <div id="experience1" style="display: none">
                                           <label>Experience<span style="color:red">*</span></label>
                                         <select name="experience_year" id="experience_year">
                                          <option value="" selected option disabled>Year</option>
                                          <option value="0 year">0</option>
                                          <option value="1 year">1</option>
                                        </select>
                                       

                                         <select name="experience_month" id="experience_month">
                                          <option value="" selected option disabled>Month</option>
                                          <option value="1 month">1</option>
                                          <option value="2 month">2</option>
                                        </select>
                                         
                                        </div>

                                        <br><br>
                                        <?php echo form_error('experience_year'); ?>
                                        <?php echo form_error('experience_month'); ?>
                                        

                                        <tr>
                                        <label>Experience Certificate</label>
                                         <input type="file" name="certificate" id="certificate" placeholder="CERTIFICATE" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>
                                           <img src="<?php echo base_url( JOBWORKCERTIFICATE . $job[0]['work_Certificate'])?>" style="width:100px;height:100px;">
                                            <input type="hidden" name="old_image1" value="<?php echo $job[0]['old_image1']; ?>" />

                                        <?php echo form_error('certificate'); ?>
                                        </tr><br><br>

                                </table>

                                </div>


                            <div id="curricular" class="tabcontent">
                             <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
                            
 <table>
                                        <h1>Extra Curricular Activities</h1><br><br>
                                        <tr>
                                        <label>Curricular Activities <span style="color:red">*</span></label>
                                        
                                          <?php echo form_textarea(array('name' => 'curricular', 'id' => 'curricular', 'class' => "ckeditor",'value' => html_entity_decode($job[0]['curricular']), 'placeholder' => "Enter Curricular Activities")); ?>
                                        <?php echo form_error('curricular'); ?>
                                        </tr><br><br>

                                           
                                </table>
                          
                         </div>

                         <div id="reference" class="tabcontent">


                           <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
 <table>
                                        <h1>Interest & References</h1><br><br>

                                         <tr>
                                        <label>Interest:<span style="color:red">*</span></label>
                                        
                                           <?php echo form_textarea(array('name' => 'interest', 'id' => 'interest','value' => html_entity_decode($job[0]['interest']), 'class' => "ckeditor",'placeholder' => "Enter Interest")); ?>

                                         <?php echo form_error('interest'); ?>
                                        </tr><br><br>

                                         <tr>
                                        <label>References:<span style="color:red">*</span></label>
                                         
                                           <?php echo form_textarea(array('name' => 'reference', 'id' => 'reference','value' => html_entity_decode($job[0]['reference']), 'class' => "ckeditor",'placeholder' => "Enter Reference")); ?>

                                         <?php echo form_error('reference'); ?>
                                        </tr><br><br>

                                </table>

                        </div>

                            <div id="carrier" class="tabcontent">

                          <div>
                                <span style="color:red">Fields marked with asterisk (*) are mandatory</span>
                            </div>
                               <table>
                                        <h1>Carrier Objectives</h1><br><br>
                                        <tr>
                                        <label>Carrier Objectives<span style="color:red">*</span></label>
                                        
                                           <?php echo form_textarea(array('name' => 'carrier', 'id' => 'carrier','value' => html_entity_decode($job[0]['carrier']), 'class' => "ckeditor",'placeholder' => "Enter Carrier")); ?>

                                        <?php echo form_error('carrier'); ?>
                                        </tr>

                                        <br><br><br><br>
       
                                </table>

                                    </div>

                               <div class="done">

                                 <input type="hidden" name="job_id" value="<?php echo $job[0]['job_id'];?>"/>    


                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>

                                </div>


                                </form>

                            </div>

                        </div><!-- col-lg-12-->         

                    </div><!-- /row -->










                   



                  




                </section><!--wrapper -->

            </section><!-- /MAIN CONTENT -->



            <!--main content end-->



            <?php echo $footer; ?>



        </section>



        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('admin/assets/js/jquery.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.sparkline.js') ?>"></script>





        <!--common script for all pages-->

        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>



        <!--script for this page-->

        <script src="<?php echo base_url('admin/assets/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>



        <!--custom switch-->

        <script src="<?php echo base_url('admin/assets/js/bootstrap-switch.js') ?>"></script>



        <!--custom tagsinput-->

        <script src="<?php echo base_url('admin/assets/js/jquery.tagsinput.js') ?>"></script>



        <!--custom checkbox & radio-->



        <script src="<?php echo base_url('admin/assets/js/form-component.js') ?>"></script>    

        <script type="text/javascript">

            $(document).ready(function () {

                $('.alert-success').fadeOut(3000).hide('700');

                $('.alert-danger').fadeOut(3000).hide('700');

            });

        </script>

        <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>

       
        <script>
function openCity(evt, jobreg) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(jobreg).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

<!-- script for country,state,city start -->
  <script src="<?php echo base_url('admin/assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job/ajax_data"; ?>',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select city first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select state first</option>');
            $('#city').html('<option value="">Select city first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job/ajax_data"; ?>',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select city first</option>'); 
        }
    });
});
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('#degree').on('change',function(){ 
        var degreeID = $(this).val();
        if(degreeID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job/ajax_data1"; ?>',
                data:'degree_id='+degreeID,
                success:function(html){
                    $('#stream').html(html);
                     
                }
            }); 
        }
        else{
            $('#stream').html('<option value="">Select degree first</option>');
             
        }
    });
    
    
});
</script>

  
    <script type="text/javascript">
    $(function () {
        $("input[name='radio']").click(function () {
            if ($("#experience").is(":checked")) {
                $("#experience1").show();
            } else {
                $("#experience1").hide();
            }
        });
    });
</script>


        <!-- CK Editor -->


        <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

      <!-- javascript validation start -->
   <script type="text/javascript">

           

            $(document).ready(function () { 

                $("#edit_job").validate({

                    rules: {

                        fname: {

                            required: true,
                           
                        },

                         lname: {

                            required: true,
                           
                        },
                       
                       email: {

                            required: true,
                            email:true,
                        },
                       
                        phnno: {

                            required: true,
                            minlength:10,
                            maxlength:11,
                            number: true,
                           
                        },
                       marital_status: {

                            required: true,
                           
                        },
                        nationality: {

                            required: true,
                           
                        },
                        language: {

                            required: true,
                           
                        },
                        dob: {

                            required: true,
                           
                        },
                        gender: {

                            required: true,
                           
                        },  
                          country: {

                            required: true,
                           
                        },

                         state: {

                            required: true,
                           
                        },
                       
                        city: {

                            required: true,
                            
                        },
                       
                        address: {

                            required: true,
                           
                        },
                       pincode: {

                            required: true,
                            number: true,
                           
                        },
                         degree: {

                            required: true,
                           
                        },

                         stream: {

                            required: true,
                           
                        },
                       
                        university: {

                            required: true,
                            
                        },
                       
                        college: {

                            required: true,
                           
                        },
                       grade: {

                            required: true,
                           
                        },
                        percentage: {

                            required: true,
                           
                        },
                        pass_year: {

                            required: true,
                           
                        },

                         keyskill: {

                            required: true,
                           
                        },   
                        ApplyFor: {

                            required: true,
                           
                        },   
                        

                        jobtitle: {

                            required: true,
                           
                        }, 
                        companyname: {

                            required: true,
                           
                        }, 
                        companyemail: {

                            required: true,
                            email: true,
                           
                        }, 
                        companyphn: {

                            required: true,
                             minlength:10,
                             maxlength:11,
                             number: true
                           
                        }, 
                        exp: {

                            required: true,
                           
                        },   
                        exp_year: {

                            required: true,
                           
                        },   
                        exp_month: {

                            required: true,
                           
                        }, 
                         curricular: {

                            required: true,
                           
                        }, 

                          interest: {

                            required: true,
                           
                        }, 
                        reference: {

                            required: true,
                           
                        }, 
                         carrier: {

                            required: true,
                           
                        }, 
                   
                      
                    },

                    messages: {

                        fname: {

                            required: "First name Is Required.",
                            
                        },

                        lname: {

                            required: "Last name Is Required.",
                            
                        },

                         email: {

                            required: "Email Address Is Required.",
                             email:"Please Enter Valid Email Id."
                        },

                        phnno: {

                            required: "Phone no Is Required.",
                            
                        },
                        marital_status: {

                            required: "Marital Status Is Required.",
                            
                        },
                        nationality: {

                            required: "Nationality Is Required.",
                            
                        },
                        language: {

                            required: "Language  Is Required.",
                            
                        },
                        dob: {

                            required: "Date of Birth Is Required.",
                            
                        },
                       gender: {

                            required: "Gender no Is Required.",
                            
                        },
                           country: {

                            required: "Country Is Required.",
                            
                        },

                        state: {

                            required: "State Is Required.",
                            
                        },

                         city: {

                            required: "City  Is Required.",
                             
                        },

                        address: {

                            required: "Address  Is Required.",
                            
                        },
                        pincode: {

                            required: "Pincode Is Required.",
                            
                        },

                         degree: {

                            required: "Degree Is Required.",
                            
                        },

                        stream: {

                            required: "Stream Is Required.",
                            
                        },

                         university: {

                            required: "University  Is Required.",
                             
                        },

                        college: {

                            required: "College Is Required.",
                            
                        },
                        grade: {

                            required: "Grade Is Required.",
                            
                        },
                        percentage: {

                            required: "Percentage Is Required.",
                            
                        },
                         pass_year: {

                            required: "Pass_year Is Required.",
                            
                        },

                        keyskill: {

                            required: "Keyskill Is Required.",
                            
                        },
                         degree: {

                            ApplyFor: "ApplyFor Is Required.",
                            
                        },
                        jobtitle: {

                            required: "Job title Is Required.",
                            
                        },
                        companyname: {

                            required: "Company name Is Required.",
                            
                        },
                        companyemail: {

                            required: "Company Email Is Required.",
                            
                        },
                        companyphn: {

                             required: "Comapny Phone Is Required.",
                            
                        },
                        exp: {

                             required: "Experience Is Required.",
                            
                        },
                        exp_year: {

                            required: "Experience year Is Required.",
                            
                        },
                        exp_month: {

                             required: "Experience month Is Required.",
                            
                        },
                         curricular: {

                            ApplyFor: "Curricular Is Required.",
                            
                        },
                         interest: {

                            ApplyFor: "Interest Is Required.",
                            
                        },

                        reference: {

                            ApplyFor: "Reference Is Required.",
                            
                        },


                        carrier: {

                            ApplyFor: "Carrier Is Required.",
                            
                        },
                    

                    },

                });
                   });
</script>
<!-- javascript validation End -->





    </body>

</html>

