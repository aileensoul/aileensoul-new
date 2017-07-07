<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>
    <!-- script for ckeditor start -->
    <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>
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

                                echo form_open_multipart('recruiter_management/edit_recruiter', $form_attr);

                                ?>

                                <ul class="tab">
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event,'basicinformation')">Basic Information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event,'companyinformation')">Company Information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event,'companyaddress')">Company Address</a></li>
                                </ul>

                            <div id="basicinformation" class="tabcontent">
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

                                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="first_name" name="first_name" value="<?php echo $recruiter[0]['rec_firstname']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="last_name" name="last_name" value="<?php echo $recruiter[0]['rec_lastname'];?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">E-mail Address</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="e-mail" name="e-mail" value="<?php echo $recruiter[0]['rec_email'];?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Phone number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="phone_number" name="phone_number" value="<?php echo $recruiter[0]['rec_phone'];?>" class="form-control">

                                    </div>

                                </div>

                               
                            </div>

                            <div id="companyinformation" class="tabcontent">
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_name" name="company_name" value="<?php echo $recruiter[0]['re_comp_name']; ?>" class="form-control">

                                    </div>

                                </div> 
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="comapny_email" name="company_email" value="<?php echo $recruiter[0]['re_comp_email'];?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Number</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_number" name="company_number" value="<?php echo $recruiter[0]['re_comp_phone'];?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Website</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_website" name="company_website" value="<?php echo $recruiter[0]['re_comp_site'];?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Interview</label>

                                    <div class="col-sm-7">


                                        <?php echo form_textarea(array('name' => 'company_interview', 'id' => 'company_interview', 'value' => html_entity_decode($recruiter[0]['re_comp_project']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>
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
                                        <?php
                                          
                                            foreach($countries as $cnt){
                                                if($recruiter[0]['re_comp_country'])

                                            {

                                              ?>

                                                 <option value="<?php echo $cnt['country_id']; ?>" <?php if($cnt['country_id']==$recruiter[0]['re_comp_country']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
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

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">State</label>

                                    <div class="col-sm-7">

                                       <select name="state" class="form-control" id="state">
                                       <?php
                                          
                                            foreach($states as $cnt){
                                                if($recruiter[0]['re_comp_state'])

                                            {

                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$recruiter[0]['re_comp_state']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
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

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">City</label>

                                    <div class="col-sm-7">
                                        <select name="city" class="form-control" id="city">
                                      <?php
                                          foreach($city as $cnt){

                                                if($recruiter[0]['re_comp_city'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$recruiter[0]['re_comp_city']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

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

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Postal Address</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'postaladdress', 'id' => 'postaladdress', 'value' => html_entity_decode($recruiter[0]['re_comp_address']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Best Project</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'best_project', 'id' => 'best_project','value' => html_entity_decode($recruiter[0]['re_comp_project']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Other Activites</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'other_activites', 'id' => 'other_activites', 'value' => html_entity_decode($recruiter[0]['re_comp_activities']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                       <!--  <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                </div>
                                
                                    <input type="text" name="rec_id" value="<?php echo $recruiter[0]['rec_id']; ?>" />
                                    <!-- <input type="hidden" name="old_image" value="<?php echo $user_image; ?>" /> -->
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

        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>

        <script src="<?php echo base_url('assets/js/jquery.sparkline.js') ?>"></script>





        <!--common script for all pages-->

        <script src="<?php echo base_url('assets/js/common-scripts.js') ?>"></script>



        <!--script for this page-->

        <script src="<?php echo base_url('assets/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>



        <!--custom switch-->

        <script src="<?php echo base_url('assets/js/bootstrap-switch.js') ?>"></script>



        <!--custom tagsinput-->

        <script src="<?php echo base_url('assets/js/jquery.tagsinput.js') ?>"></script>



        <!--custom checkbox & radio-->



        <script src="<?php echo base_url('assets/js/form-component.js') ?>"></script>    

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

                                url: "<?php echo base_url() . 'user_management/check_email' ?>",

                                type: "post",

                                data: {

                                    email: function () {

                                        return $("#admin_email").val();

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


            // start scritp for tabing 
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
    // end of scritp for tabing 
}

        </script>
        <!-- script for country, state and city -->
        <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
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
        <!-- script for country, state and city -->
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

