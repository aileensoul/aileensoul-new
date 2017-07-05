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

                <li><a href="<?php echo site_url('business_management'); ?>">business management</a></li>

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

                                $form_attr = array('name' => 'add_business', 'id' => 'add_business', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('business_management/edit_business', $form_attr);

                                ?>

                                <ul class="tab">
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Businessinformation')">Business information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Contactinformation')">Contact information</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Description')">Description</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'Images')">Images</a></li>
                            <li><a href="javascript:void(0)" class="tablinks" onclick="openinformation(event,'AddMore')">Add More</a></li>
                                </ul>

                                 <!-- start Business information -->
                            <div id="Businessinformation" class="tabcontent">
                                
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Company Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="company_name" name="company_name" value="<?php echo $business[0]['company_name']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Country</label>

                                    <div class="col-sm-7">

                                       <select name="country" id="country" class="form-control"> 
                                        <option value="">----------Select Country--------</option>
                                        <?php if(count($countries)>0)
                                        {
                                            foreach ($countries as $cnt){
                                                if($business[0]['country'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>" <?php if($cnt['country_id']==$business[0]['country']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
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
                                                if($business[0]['state'])

                                            {

                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$business[0]['state']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
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

                                        <!-- <input type="text" id="state" name="state" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">City</label>

                                    <div class="col-sm-7">

                                        <select name="city" id="city" class="form-control">
                                       <?php
                                          foreach($city as $cnt){

                                                if($business[0]['city'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$business[0]['city']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

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

                                    <label class="col-sm-2 col-sm-2 control-label">Pincode</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="pincode" name="pincode" value="<?php echo $business[0]['pincode']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Postal Address</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'company_address', 'id' => 'company_address','value' => html_entity_decode($business[0]['address']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                    </div>

                                </div>

                               
                            </div>
                            <!-- End Business information -->

                            <!-- start Contact information -->

                            <div id="Contactinformation" class="tabcontent">
                                 <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Contact Person</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="contact_person" name="contact_person" value="<?php echo $business[0]['contact_person']; ?>" class="form-control">

                                    </div>

                                </div> 
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Contact Mobile</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="contact_mobile" name="contact_mobile" value="<?php echo $business[0]['contact_mobile']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Contact Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="contact_email" name="contact_email" value="<?php echo $business[0]['contact_email']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Contact Website</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="contact_website" name="contact_website" value="<?php echo $business[0]['contact_website']; ?>" class="form-control">

                                    </div>

                                </div>
                                
                            </div>
                                <!-- End Contact information -->
                                <!-- start Description -->
                           
                            <div id="Description" class="tabcontent">
                            <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Business Type</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="business_type" name="business_type" value="<?php echo $business[0]['business_type']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Industriyal</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="Industriyal" name="Industriyal" value="<?php echo $business[0]['industriyal']; ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Sub Industriyal</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="sub_industrial" name="sub_industrial" value="<?php echo $business[0]['subindustriyal']; ?>" class="form-control">

                                    </div>

                                </div>
                                
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Details of your business</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'business_detail', 'id' => 'business_detail','value' => html_entity_decode($business[0]['details']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>

                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                
                                
                                </div>
                                <!-- End Description -->
                                <!-- start Images -->

                                <div id="Images" class="tabcontent">
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Images</label>

                                     <div class="col-sm-3">

                                        <input type="file" name="business_image" value="" class="form-control">

                                    </div>

                                    <div class="col-sm-4">

                                    <img src="<?php echo base_url(BUSINESSIMAGE.$business[0]['business_profile_image']); ?>" style="width: 100px; height: 80px;">

                                    </div>
                                </div>

                                </div>
                                <!-- End Images -->
                                <!-- start Add More -->

                                <div id="AddMore" class="tabcontent">
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Add More</label>

                                    <div class="col-sm-7">

                                        <?php echo form_textarea(array('name' => 'add_more', 'id' => 'add_more', 'value' => html_entity_decode($business[0]['addmore']), 'class' => "ckeditor",'placeholder' => "Enter Address")); ?>


                                    </div>

                                </div>


                                <!-- End Add More -->
                                

                                   

                                </div>

                                <div class="done">
                                    <input type="text" name="rec_id" value="<?php echo $business[0]['business_profile_id']; ?>" />

                                    <input type="hidden" name="old_image" value="<?php echo$business[0]['business_profile_image']; ?>" />

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

