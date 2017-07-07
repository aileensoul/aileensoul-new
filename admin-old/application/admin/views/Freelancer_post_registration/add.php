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

                                echo form_open_multipart('freelancer_post_registration/add_freelancer', $form_attr);

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
                                            
                                     <select name="user_name" class="form-control" id="user_name">
                                                
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

                                        <input type="text" id="full_name" name="full_name" value="" class="form-control">

                                    </div>
                                     <?php echo form_error('full_name'); ?>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Name</label>

                                   <div class="col-sm-7">

                                        <input type="text" id="add_user_name" name="add_user_name" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="frelancer_post_email" name="frelancer_post_email" value="" class="form-control">

                                    </div>
                                    
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Skype Id</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="freelancer_post_skypeid" name="freelancer_post_skypeid" value="" class="form-control">

                                    </div>
                                   
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Phone Number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="freelancer_post_number" name="freelancer_post_number" value="" class="form-control">

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
                                            foreach ($countries as $country){

                                            ?>
                                        <option value="<?php echo $country['country_id'];  ?>" > <?php echo $country['country_name']; ?> </option> 
                                        <?php }}?>
                                        </select>
                                       
                                        </div>
                                        </div>
                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>

                                    <div class="col-sm-7">
                                    <select name="state" id="state" class="form-control">
                                    <option value="">Select country first</option>
                                    </select>
                                    
                                    </div>
                                    </div>

                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">city</label>

                                    <div class="col-sm-7">
                                        <select name="city" id="city" class="form-control">
                                        <option value="">Select state first</option>
                                        </select>
                                      

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Pincode</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="pincode" name="pincode" value="" class="form-control">

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

                                        <input type="text" id="field" name="field" value="" class="form-control">

                                    </div>
                                    
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">What Is Your Area?</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="area" name="area" value="" class="form-control">

                                    </div>
                                    
                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Describe Your Skill In Brief:*</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'skill', 'id' => 'skill', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                    </div>
                                     
                                </div>
                                

                                
                                </div>
                                <!-- End Proessional Info -->
                                <!-- start Rate -->

                                <div id="rate" class="tabcontent">
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Hourly:</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="hourly" value="" id="hourly" class="form-control">

                                    </div>
                                    
                                </div>
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>

                                    <div class="col-sm-7">
                                    
                                         <input type="text" id="hourly_state" name="hourly_state" value="" class="form-control">
                                        
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

                                       <input type="text" id="in_week" name="in_week" value="" class="form-control">
                                    </div>
                                    
                                    </div>

                                    <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">IN Day</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="in_day" name="in_day" value="" class="form-control">

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
                                        <option value="">----select degree-----</option>
                                         <?php if(count($degree)>0)
                                        {
                                            foreach ($degree as $deg){

                                            ?>
                                        <option value="<?php echo $deg['degree_id'];  ?>" > <?php echo $deg['degree_name']; ?> </option> 
                                        <?php }}?>
                                         </select>
                                    
                                         <!-- <input type="text" id="sub_industrial" name="sub_industrial" value="" class="form-control"> -->
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>
                                    
                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Stream</label>

                                    <div class="col-sm-7">
                                    
                                        <select  name="stream" id="stream" class="form-control"> 
                                    <option value="">----select stream-----</option>
                                        
                                         
                                         </select>
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>
                                    <?php echo form_error('stream'); ?>
                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">University</label>

                                    <div class="col-sm-7">
                                    
                                         <select  name="university" id="university" class="form-control"> 
                                        <option value="">----select University-----</option>
                                        <?php if(count($university)>0)
                                        {
                                            foreach ($university as $uni){

                                            ?>
                                        <option value="<?php echo $uni['university_id'];  ?>" > <?php echo $uni['university_name']; ?> </option> 
                                        <?php }}?>
                                         
                                         </select>
                                        
                                        

                                    </div>
                                     <?php echo form_error('university'); ?>
                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">College</label>

                                    <div class="col-sm-7">
                                        <input type="text" id="college" name="college" value="" class="form-control">

                                    </div>
                                    
                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Percentage</label>

                                    <div class="col-sm-7">
                                    
                                         <input type="text" id="percentage" name="percentage" value="" class="form-control">
                                        
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>
                                    
                                </div>
                                  <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Year Of Passing</label>

                                    <div class="col-sm-7">
                                    
                                          <select  name="passing_year" id="passing_year"> 
                                        <optio value="">----select Passing year-----</optio>
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

                                        <?php echo form_textarea(array('name' => 'postal_address', 'id' => 'postal_address', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                    </div>
                                    
                                    
                                </div>
                                </div>
                                        <!-- End of Education Info -->
                                        <!-- start of Portfolio -->

                                         <div id="Portfolio" class="tabcontent">

                                         <div class="form-group">

                                            <label class="col-sm-2 col-sm-2 control-label">Portfolio</label>

                                        <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'Portfolio', 'id' => 'Portfolio', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                         </div>  
                                          
                                </div>
                                </div>



                                        <!-- end of Portfolio -->
                                

                                   

                                </div>

                                <div class="done">

                                
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

        <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>

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


$('#degree').on('change',function(){
    var degreeID=$(this).val();
    if(degreeID){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()."freelancer_post_registration/ajax_data"; ?>',
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

<script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#add_freelancer_post").validate({
                    rules: {

                        full_name:{
                            required:true
                        },
                        user_name:{
                            required:true
                        },
                        add_user_name:{
                            required:true
                        },
                        frelancer_post_email:{
                            required:true
                        },
                        freelancer_post_skypeid:{
                            required:true
                        },
                        freelancer_post_number:{
                            required:true
                        },
                        country:{
                            required:true
                        },
                        pincode:{
                            required:true
                        },
                        postal_address:{
                            required:true
                        },
                        field:{
                            required:true
                        },
                        area:{
                            required:true
                        },
                        skill:{
                            required:true
                        },
                        hourly:{
                            required:true
                        },
                        hourly_state:{
                            required:true
                        },
                        in_week:{
                            required:true
                        },
                        in_day:{
                            required:true
                        },
                        degree:{
                            required:true
                        },
                        stream:{
                            required:true
                        },
                        university:{
                            required:true
                        },
                        college:{
                            required:true
                        },
                        percentage:{
                            required:true
                        },
                        passing_year:{
                            required:true
                        },
                        postal_address:{
                            required:true
                        },
                        Portfolio:{
                            required:true
                        }
                       
                    },

                    ignore : [],


                    messages: {
                        
                        full_name:{
                            required:"Full Name is required."
                        },
                        user_name:{
                            required:"Please select user name."
                        },
                        add_user_name:{
                             required:"Please Write username."
                        },
                        frelancer_post_email:{
                            required:"Freelancer Email id is required."
                        },
                        freelancer_post_skypeid:{
                            required:"Skype id is required."
                        },
                        freelancer_post_number:{
                            required:"Please Write add your Number."
                        },
                        country:{
                            required:"Select Country."
                        },
                        pincode:{
                            required:"Pincode is required."
                        },
                        postal_address:{
                            required:"Postal address is required."
                        },
                        field:{
                            required:"Please Write field."
                        },
                        area:{
                            required:"Please describe your area."
                        },
                        skill:{
                            required:"Please describe your skill."
                        },
                        hourly:{
                            required:"Write hourly rate."
                        },
                        hourly_state:{
                            required:"hourly rate is required."
                        },
                        in_week:{
                            required:"Write your weekly Avability."
                        },
                        in_day:{
                            required:"Write your daily Avability."},
                        degree:{
                            required:"Please select your degree."
                        },
                        stream:{
                            required:"Please select your stream"
                        },
                        university:{
                            required:"Please select your university."
                        },
                        college:{
                            required:"Please select your college."
                        },
                        percentage:{
                            required:"Please Write percentage"
                        },
                        passing_year:{
                            required:"Select your passing year."
                        },
                        postal_address:{
                            required:"Write your  postal address"
                        },
                        Portfolio:{
                            required:"Portfolio is required."
                        }
                       

                        

                    },

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

