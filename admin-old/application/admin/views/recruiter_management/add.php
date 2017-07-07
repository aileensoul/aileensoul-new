<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>
   
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

                <li><a href="<?php echo site_url('recruiter_management'); ?>">Recruiter management</a></li>

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

                                $form_attr = array('name' => 'add_recruiter', 'id' => 'add_recruiter', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('recruiter_management/add_recruiter', $form_attr);

                                ?>

                                <ul class="tab">
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'basicinformation')">Basic Information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'companyinformation')">Company Information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'companyaddress')">Company Address</a></li>
                                </ul>

                            <div id="basicinformation" class="tabcontent">
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

                                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="first_name" name="first_name" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="last_name" name="last_name" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">E-mail Address</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="e_mail" name="e_mail" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Phone number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="phone_number" name="phone_number" value="" class="form-control">

                                    </div>

                                </div>

                               
                            </div>

                            <div id="companyinformation" class="tabcontent">
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_name" name="company_name" value="" class="form-control">

                                    </div>

                                </div> 
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="comapny_email" name="company_email" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_number" name="company_number" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Website</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_website" name="company_website" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Interview</label>

                                    <div class="col-sm-7">


                                        <?php echo form_textarea(array('name' => 'company_interview', 'id' => 'company_interview', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                            </div>

                            <div id="companyaddress" class="tabcontent">
                                
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
                                        <!-- <input type="text" id="country" name="country" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>

                                    <div class="col-sm-7">
                                    <select name="state" class="form-control" id="state">
                                       <option value="">Select country first</option>
                                    </select>
                                        
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">City</label>

                                    <div class="col-sm-7">
                                    <select name="city" class="form-control" id="city">
                                       <option value="">Select state first</option>
                                    </select>
                                        
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Postal Address</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'postaladdress', 'id' => 'postaladdress', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Best Project</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'best_project', 'id' => 'best_project', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Other Activites</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'other_activites', 'id' => 'other_activites', 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                       <!--  <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                </div>
                                

                                    <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>

                                </div>

                                <div class="done">

                                

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

        <script>

            // start script start for tabing
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
    // end script start for tabing
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
                url:'<?php echo base_url() . "recruiter_management/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "recruiter_management/ajax_data"; ?>',
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
<script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#add_recruiter").validate({
                    rules: {

                        first_name:{
                            required:true
                        },
                        user_name:{
                            required:true
                        },
                        last_name:{
                            required:true
                        },
                        e_mail:{
                            required:true
                        },
                        phone_number:{
                            required:true
                        },
                       company_name:{
                        required:true
                       },
                       company_number:{
                        required:true
                       },
                       company_interview:{
                        required:true
                       },
                       country:{
                        required:true
                       },
                       postaladdress:{
                        required:true
                       },
                       comapny_email:{
                        required:true
                       }
                    },

                    ignore : [],

                    messages: {
                        
                        first_name:{
                            required:"First Name is required."
                        },
                        user_name:{
                            required:"Please select User Name."
                        },
                        last_name:{
                            required:"Last name is required."
                        },
                        e_mail:{
                            required:"E-mail is required."
                        },
                        phone_number:{
                            required:"Phone number is required."
                        },
                        company_name:{
                            required:"Company name is required."
                        },
                        company_number:{
                            required:"Company number is required."
                        },
                        company_interview:{
                            required:"company Interview Process is required. "
                        },
                        country:{
                            required:"Please select country."
                        },
                        postaladdress:{
                            required:"Company Postal address is required."
                        },
                        comapny_email:{
                            required:"Company Email is required."
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

