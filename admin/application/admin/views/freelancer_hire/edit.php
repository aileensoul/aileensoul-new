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

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>
                        <div>
                    <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'add_driver', 'id' => 'add_driver', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('freelancer_hire/freelancer_hire_edit', $form_attr);

                                ?>



                    <!-- BASIC FORM ELELEMNTS -->

 
 <ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'basicinfo')">Basic Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'address')">Address  Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'proinfo')">Professional Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'payments')">Payments</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'req')">Requirmeant-details</a></li>
  
   
</ul>


 
  <div class="row mt">

       <div id="basicinfo" class="tabcontent">

              <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                                <fieldset>
                                 <select name="fullname" id="fullname">
                                          <option value="">Select Username</option>
                                            <?php
                                            if(count($freelancer) > 0){
                                                foreach($freelancer as $f){
                                          ?>
                                                <option value="<?php echo $f['user_id']; ?>"><?php echo $f['fullname']; ?></option>
                                           <?php }}
                                            ?>
                                        </select>
                                         <?php echo form_error('user'); ?>

                                          </fieldset>

                                <fieldset>
                                    <label>Full Name:<span style="color:red">*</span></label>
                                    <input type="text" name="fname" id="fname" placeholder="Full Name" value="<?php echo $freelancer[0]['fullname'];?>" >
                                </fieldset>
                                 <?php echo form_error('fname'); ?>

                                <fieldset>
                                    <label>User Name:<span style="color:red">*</span></label>
                                    <input type="text" name="uname" id="uname"  placeholder="User Name" value="<?php echo $freelancer[0]['username'];?>" >
                                </fieldset>
                                 <?php echo form_error('uname'); ?>
                                
                                <fieldset>
                                    <label>Email:<span style="color:red">*</span></label>
                                    <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $freelancer[0]['email'];?>" >
                                </fieldset>
                                 <?php echo form_error('email'); ?>

                                <fieldset>
                                    <label>Skype Id:<span style="color:red">*</span></label>
                                    <input type="text" name="skyupid" id="skyupid" placeholder="Skyup Id" value="<?php echo $freelancer[0]['skyupid'];?>">
                                </fieldset>
                                 <?php echo form_error('skyupid'); ?>
                                
                                <fieldset>
                                    <label>Phone Number:<span style="color:red">*</span></label>
                                    <input type="text" name="phone" id="phone"  placeholder="Phone Number" value="<?php echo $freelancer[0]['phone'];?>">
                                </fieldset>
                                 <?php echo form_error('phone'); ?>

                             </div>

                    
                     <div id="address" class="tabcontent">


                          <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>
                                
                                  <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
                                        <label>Country</label>

                                        <select name="country" id="country">
                                          <option value="">Select Country</option>
                                            <?php
                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){
                                          
                                            if($freelancer[0]['country'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>"
                                                  <?php if($cnt['country_id']==$freelancer[0]['country']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
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
                                                if($freelancer[0]['state'])

                                            {
                                                 //echo "hi";die();
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$freelancer[0]['state']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
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
                                                if($freelancer[0]['city'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$freelancer[0]['city']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

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
                                    <input type="text" name="pincode" id="pincode" value="<?php echo $freelancer[0]['pincode'];?>">
                                </fieldset>
                                 <?php echo form_error('pincode'); ?>

                                
                                <fieldset class="col-md-12">
                                    <label>Postal Address:<span style="color:red">*</span></label>

                                    <?php echo form_textarea(array('name' => 'address', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancer[0]['address']))); ?><br>
                                     <!-- <textarea name="address" id="address" placeholder="address" rows="5" cols="40" style="resize:none"/><?php echo $freelancer[0]['address'];?></textarea> -->
                                </fieldset>
                                 <?php echo form_error('address'); ?>

                                
                           
                            </div>

                             <div id="proinfo" class="tabcontent">

                         <fieldset class="col-md-12">
                                    <label>Professional Info:<span style="color:red">*</span></label>


                                    <?php echo form_textarea(array('name' => 'professional_info', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancer[0]['professional_info']))); ?><br>

                                </fieldset>

                            </div>

                          
                <div id="payments" class="tabcontent">

                    <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>
                            <fieldset>
                                    <label>Pay Hourly:<span style="color:red">*</span></label>
                                    <input type="text" name="pay_hourly" id="pay_hourly" value="<?php echo $freelancer[0]['pay_hourly'];?>" placeholder="Enter Pay Hourly">
                                </fieldset>

                                 <?php echo form_error('pay_hourly'); ?>
                                <fieldset>
                                    <label>Fixed Price:<span style="color:red">*</span></label>
                                    <input type="text" name="fixed_price" id="fixed_price" value="<?php echo $freelancer[0]['fixed_price'];?>" placeholder="Enter Fixed Price">
                                </fieldset>
                                 <?php echo form_error('fixed_price'); ?>
                                
     

                        </div>



                               <div id="req" class="tabcontent">

                                      <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>
                            <fieldset>
                                    <label>Fields Of Requirmeant:<span style="color:red">*</span></label>
                                    <input type="text" name="fields_req" id="fields_req" placeholder="Enter Fields Of Requirmeant"  value="<?php echo $freelancer[0]['fields_req'];?>">
                                </fieldset>
                                 <?php echo form_error('fields_req'); ?>

                                <fieldset>
                                    <label>Area Of Requirmeant:<span style="color:red">*</span></label>
                                    <input type="text" name="area_req" id="area_req" placeholder="Area Of Requirmeant"  value="<?php echo $freelancer[0]['area_req'];?>">
                                </fieldset>
                                 <?php echo form_error('area_req"'); ?>

                                <fieldset>
                                    <label>Require Skill:<span style="color:red">*</span></label>
                                    <input type="text" name="req_skill" id="req_skill" placeholder="Require Skill"  value="<?php echo $freelancer[0]['req_skill'];?>">
                                </fieldset>
                                 <?php echo form_error('req_skill'); ?>

                                <fieldset>
                                    <label>Require Experience:<span style="color:red">*</span></label>
                                    <input type="text" name="req_experience" id="req_experience" placeholder="Require Experience"  value="<?php echo $freelancer[0]['req_experience'];?>">
                                </fieldset>
                                 <?php echo form_error('req_experience'); ?>

                                <fieldset>
                                    <label>Require Person:<span style="color:red">*</span></label>
                                    <input type="text" name="req_person" id="req_person" placeholder="Require Person"  value="<?php echo $freelancer[0]['req_person'];?>">
                                </fieldset>
                                 <?php echo form_error('req_person'); ?>
                           
                    
     
                            </div>


                                  
                               <div class="done">

                                   <input type="hidden" name="reg_id" value="<?php echo $freelancer[0]['reg_id'];?>"/>    


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

        <script src="<?php echo base_url('admin/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('admin/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

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
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
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
                url:'<?php echo base_url() . "freelancer_hire/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "freelancer_hire/ajax_data"; ?>',
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

<!-- script for country,state,city end -->


  
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

                $("#add_driver").validate({

                    rules: {

                         fname: {

                            required: true,
                           
                        },

                         uname: {

                            required: true,
                           
                        },
                       
                       email: {

                            required: true,
                            email:true,
                        },
                       
                        phone: {

                            required: true,
                            minlength:10,
                            maxlength:11,
                            number: true,
                           
                        },
                       skyupid: {

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
                       
                        pincode: {

                            required: true,
                            number: true,
                           
                        },
                       address: {

                            required: true,
                           
                        },
                         professional_info: {

                            required: true,
                           
                        },

                         pay_hourly: {

                            required: true,
                             number: true,
                           
                        },

                         fixed_price: {

                            required: true,
                             number: true,
                           
                        },


                         fields_req: {

                            required: true,
                           
                        },

                         area_req: {

                            required: true,
                            
                        },

                         req_skill: {

                            required: true,
                             
                        },
                       
                        req_experience: {

                            required: true,
                               
                        },
                         req_person: {

                            required: true,
                              
                        },
  
                   
                   
                        

                      
                    },

                    messages: {


                      fname: {

                            required: "First name Is Required.",
                            
                        },

                        uname: {

                            required: "User name Is Required.",
                            
                        },

                         email: {

                            required: "Email Address Is Required.",
                             email:"Please Enter Valid Email Id."
                        },

                        skyupid: {

                            required: "Skyupid Is Required.",
                            
                        },
                        phone: {

                            required: "Phone no Is Required.",
                            
                        },

                         country: {

                            required: "Country Is Required.",
                            
                        },

                        state: {

                            required: "State Is Required.",
                            
                        },

                         city: {

                            required: "City Is Required.",
                             
                        },

                        pincode: {

                            required: "Pincode Is Required.",
                            
                        },
                        address: {

                            required: "Address Is Required.",
                            
                        },
                       professional_info: {

                            required: "Professional Information Is Required.",
                            
                        },

                         pay_hourly: {

                            required: "Payment Hourly Is Required.",
                            
                        },

                        fixed_price: {

                            required: "Fixed price Is Required.",
                            
                        },

                         fields_req: {

                            required: "Fields Is Required.",
                            
                        },

                        area_req: {

                            required: "Area Is Required.",
                            
                        },
                        req_skill: {

                            required: "Skill Is Required.",
                            
                        },
                        req_experience: {

                            required: "Experience Is Required.",
                            
                        },
                        req_person: {

                            required: "Person Is Required.",
                            
                        },
                        

                        
                    },

                });
                   });
</script>
<!-- javascript validation End -->




    </body>

</html>

