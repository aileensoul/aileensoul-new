<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>
    <!-- script for ckeditor start -->
    <script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
    <!-- script for ckeditor end -->
    <style type="text/css">
        /* Style the list */
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
ul.tab li a:hover {background-color: #ddd;}

/* Create an active/current tablink class */
ul.tab li a:focus, .active {background-color: #ccc;}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}




        .tabcontent {
    -webkit-animation: fadeEffect 1s;
    animation: fadeEffect 1s; /* Fading effect takes 1 second */
}

@-webkit-keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes fadeEffect {
    from {opacity: 0;}
    to {opacity: 1;}
}
    </style>
    <link rel="stylesheet" type="text/css" href="css/tab.css">



    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                      <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li><a href="<?php echo site_url('business_management'); ?>">Freelancer Post management</a></li>

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">
                    <div class="col-lg-3"></div>

                        <div class="col-lg-9">

                            <div class="form-panel"

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'add_freelancer_post', 'id' => 'add_freelancer_post', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('freelancer_post_registration/edit_freelancer_post', $form_attr);

                                ?>

                                <ul class="tab">
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Basicinfo')">Basic Information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'addressinfo')">Address Info</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'professionalinfo')">Proessional Info</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'rate')">Rate</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Avability')">ADD Your Avability</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'educationinfo')">Education Info</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Portfolio')">Portfolio</a></li>
                                </ul>

                                 <!-- start Basic Information -->
                            <div id="Basicinfo" class="tabcontent">
                                <div class="form-group">
                                        
                                 <label class="col-sm-2 col-sm-2 control-label"> Select User</label>
                                        
                                 <div class="col-sm-7">
                                            
                                     <select name="user_name" class="form-control">
                                                
                                         <option value="" >.....Select User......</option>
                                               
                                            <?php
                                                if(count($user_list > 0)) {
                                            foreach($user_list as $user) { ?>
                                               
                                             <option value="<?php echo $user['user_id']; ?>"><?php echo $user['first_name']."  ".$user['last_name']; ?></option>
                                                <?php } }?>
                                           
                                            </select>
                                       
                                         </div>
                                
                                        </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Full Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="full_name" name="full_name" value="<?php echo $freelancer_post[0]['freelancer_post_fullname']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Name</label>

                                   <div class="col-sm-7">

                                        <input type="text" id="user_name" name="user_name" value="<?php echo $freelancer_post[0]['freelancer_post_username']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="frelancer_post_email" name="frelancer_post_email" value="<?php echo $freelancer_post[0]['freelancer_post_email']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Skype Id</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="freelancer_post_skypeid" name="freelancer_post_skypeid" value="<?php echo $freelancer_post[0]['freelancer_post_skypeid']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="freelancer_post_number" name="freelancer_post_number" value="<?php echo $freelancer_post[0]['freelancer_post_phoneno']; ?>" class="form-control">

                                    </div>

                                </div>
                                
                               
                            </div>
                            <!-- End Basic Information -->

                            <!-- start Address Info -->

                            <div id="addressinfo" class="tabcontent">
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Country</label>

                                    <div class="col-sm-7">

                                       <select name="country" id="country" class="form-control"> 
                                        <option value="">----------Select Country--------</option>
                                        <?php if(count($countries)>0)
                                        {
                                           foreach ($countries as $cnt){
                                                if($freelancer_post[0]['freelancer_post_country'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>" <?php if($cnt['country_id']==$freelancer_post[0]['freelancer_post_country']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
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
                                        </div>
                                        </div>
                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>
                                    
                                    <div class="col-sm-7">
                                    <select name="state" id="state" class="form-control">
                                    <?php
                                          
                                            foreach($states as $cnt){
                                             if($freelancer_post[0]['freelancer_post_state'])

                                            {

                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$freelancer_post[0]['freelancer_post_state']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
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
                                    </div>
                                    </div>

                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">city</label>

                                    <div class="col-sm-7">
                                        <select name="city" id="city" class="form-control">
                                        <?php
                                          foreach($city as $cnt){

                                                if($freelancer_post[0]['freelancer_post_city'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$freelancer_post[0]['freelancer_post_city']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

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

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Pincode</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="pincode" name="pincode" value="<?php echo $freelancer_post[0]['freelancer_post_pincode']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Postal Address</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'postal_address', 'id' => 'postal_address','value' => html_entity_decode($freelancer_post[0]['freelancer_post_address']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                    </div>

                                </div>
                                
                            </div>
                                <!-- End Address Info -->
                                
                                <!-- start Proessional Info -->
                           
                            <div id="professionalinfo" class="tabcontent">
                            <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Field</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="field" name="field" value="<?php echo $freelancer_post[0]['freelancer_post_field']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">What Is Your Area?</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="area" name="area" value="<?php echo $freelancer_post[0]['freelancer_post_area']; ?>"" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Describe Your Skill In Brief:*</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'skill', 'id' => 'skill','value' => html_entity_decode($freelancer_post[0]['freelancer_post_skill_description']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                       

                                    </div>

                                </div>
                                

                                
                                </div>
                                <!-- End Proessional Info -->
                                <!-- start Rate -->

                                <div id="rate" class="tabcontent">
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Hourly:</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="hourly" value="<?php echo $freelancer_post[0]['freelancer_post_hourly']; ?>"" id="hourly" class="form-control">

                                    </div>

                                </div>
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>

                                    <div class="col-sm-7">
                                    
                                         <input type="text" id="hourly_state" name="hourly_state" value="<?php echo $freelancer_post[0]['freelancer_post_ratestate']; ?>"" class="form-control">
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                

                                </div>
                                <!-- End Rate -->
                                <!-- start ADD Your Avability -->

                                <div id="Avability" class="tabcontent">

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">IN Week</label>

                                    <div class="col-sm-7">

                                       <input type="text" id="in_week" name="in_week" value="<?php echo $freelancer_post[0]['freelancer_post_inweek']; ?>"" class="form-control">


                                    </div>
                                    </div>

                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">IN Day</label>

                                    <div class="col-sm-7">

                                        <<input type="text" id="in_day" name="in_day" value="<?php echo $freelancer_post[0]['freelancer_post_inday']; ?>"" class="form-control">

                                    </div>

                                </div>
                                </div>


                                <!-- End Add ADD Your Avability -->
                                <!-- start of Education Info -->

                                 <div id="educationinfo" class="tabcontent">
                                   <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Degree</label>

                                    <div class="col-sm-7">

                                     <select  name="degree" id="degree" class="form-control">
                                <?php if(count($degree)>0)
                                     {
                                         foreach ($degree as $deg){
                                             if($freelancer_post[0]['freelancer_post_degree'])
                                            {
                                              ?>
                                                 <option value="<?php echo $deg['degree_id']; ?>" <?php if($deg['degree_id']==$freelancer_post[0]['freelancer_post_degree']) echo 'selected';?>><?php echo $deg['degree_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $deg['degree_id']; ?>"><?php echo $deg['degree_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
                                         </select>
                                    
                                         <!-- <input type="text" id="sub_industrial" name="sub_industrial" value="" class="form-control"> -->
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Stream</label>

                                    <div class="col-sm-7">
                                    
                                        <select  name="stream" id="stream" class="form-control">
                                         <?php if(count($stream)>0)
                                     {
                                         foreach ($stream as $str){
                                             if($freelancer_post[0]['freelancer_post_stream'])
                                            {
                                              ?>
                                                 <option value="<?php echo $str['stream_id']; ?>" <?php if($str['stream_id']==$freelancer_post[0]['freelancer_post_stream']) echo 'selected';?>><?php echo $str['stream_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $deg['degree_id']; ?>"><?php echo $deg['degree_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
                                         </select>
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">University</label>

                                    <div class="col-sm-7">
                                    
                                         <select  name="university" id="university" class="form-control">
                                          <?php if(count($university)>0)
                                     {
                                         foreach ($university as $uni){
                                             if($freelancer_post[0]['freelancer_post_univercity'])
                                            {
                                              ?>
                                                 <option value="<?php echo $uni['university_id']; ?>" <?php if($uni['university_id']==$freelancer_post[0]['freelancer_post_univercity']) echo 'selected';?>><?php echo $uni['university_name'];?></option>
                                               <!--  <option value="<?php //echo $cnt['country_id']; ?>"><?php //echo $cnt['country_name']; ?></option> -->
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $deg['degree_id']; ?>"><?php echo $deg['degree_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
                                        
                                         
                                         </select>
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">College</label>

                                    <div class="col-sm-7">
                                    
                                          <select  name="college"> 
                                          <option value="<?php echo $freelancer_post[0]['freelancer_post_collage']; ?>"><?php echo $freelancer_post[0]['freelancer_post_collage']; ?></option>
                                        <option value="">----select College-----</option>
                                        <option value="L.D">L.D</option>
                                        <option value="Nirma">Nirma</option>
                                         <option value="L.D.R.P">L.D.R.P</option>
                                         </select>
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Percentage</label>

                                    <div class="col-sm-7">
                                    
                                         <input type="text" id="percentage" name="percentage" value="<?php echo $freelancer_post[0]['freelancer_post_percentage']; ?>"" class="form-control">
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Year Of Passing</label>

                                    <div class="col-sm-7">
                                    
                                          <select  name="passing_year">
                                          <option value="<?php echo $freelancer_post[0]['freelancer_post_percentage']; ?>"><?php echo $freelancer_post[0]['freelancer_post_percentage']; ?></option> 
                                        <option value="">----select Passing year-----</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                         <option value="2012">2012</option>
                                         <option value="2013">2013</option>
                                         <option value="2014">2014</option>
                                         <option value="2015">2015</option>
                                         <option value="2016">2016</option>
                                         </select>
                                        
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Postal Address</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'freelancer_post_eduaddress', 'id' => 'freelancer_post_eduaddress','value' => html_entity_decode($freelancer_post[0]['freelancer_post_eduaddress']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                    </div>
                                    
                                   
                                </div>
                                </div>
                                        <!-- End of Education Info -->
                                        <!-- start of Portfolio -->

                                         <div id="Portfolio" class="tabcontent">

                                         <div class="form-group">

                                            <label class="col-sm-2 col-sm-2 control-label">Portfolio</label>

                                        <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'Portfolio', 'id' => 'Portfolio','value' => html_entity_decode($freelancer_post[0]['freelancer_post_portfolio']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                         </div>  

                                </div>
                                </div>



                                        <!-- end of Portfolio -->
                                

                                   

                                </div>

                                <div class="done">

                                    <input type="text" name="freelancer_post_reg_id" value="<?php echo $freelancer_post[0]['freelancer_post_reg_id']; ?>" />
                                     <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>
                                </div>

                                <?php  ?>

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

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#add_driver").validate({

                    rules: {

                        admin_name: {

                            required: true,

                        },

                        admin_email: {

                            required: true,

                            email: true,

                            remote: {

                                url: "<?php echo base_url() . 'recruiter_management/check_email' ?>",

                                type: "post",

                                data: {

                                    email: function () {

                                        return $("#user_email").val();

                                    },

                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                                },

                            },

                        },

                        admin_username: {

                            required: true

                        },

                        admin_image: {

                            required: true

                        }

                    },

                    messages: {

                        admin_name: {

                            required: "Please enter admin name",

                        },

                        admin_email: {

                            required: "Please enter driver email",

                            email: "Please enter valid email id",

                            remote: "Email already exists"

                        },

                        admin_username: {

                            required: "Please enter username"

                        },

                        admin_image: {

                            required: "Please select image"

                        }

                    },

                });

            });



             function openinformation(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

        </script>
         <script src="<?php echo base_url('admin/assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "freelancer_post_registration/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "freelancer_post_registration/ajax_data"; ?>',
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

        <!-- CK Editor -->

       <!--  <script type="text/javascript">
            function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}


        </script>

 -->

    </body>

</html>

