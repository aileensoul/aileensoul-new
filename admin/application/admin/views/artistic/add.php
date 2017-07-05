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

                <li><a href="<?php echo site_url('artistic'); ?>">Artistic management</a></li>

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

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

                                echo form_open_multipart('artistic/add_insert', $form_attr);

                                ?>



                    <!-- BASIC FORM ELELEMNTS -->

 <ul class="tab">
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'basicinfo')">Basic Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'address')">Address</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'artinfo')">Art Information</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'portfolio')">Portfolio</a></li>
  <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'skill')">Skill</a></li>
  
   
</ul>


 
  <div class="row mt">

        <div id="basicinfo" class="tabcontent">


        <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 


                              <fieldset>

                             <select name="user_name" id="user">
                                          <option value="">Select Username</option>
                                            <?php
                                            if(count($users) > 0){
                                                foreach($users as $user){
                                          ?>
                                                <option value="<?php echo $user['user_id']; ?>"><?php echo $user['user_name']; ?></option>
                                           <?php }}
                                            ?>
                                        </select>
                                         <?php echo form_error('user'); ?>
                                     

                                </fieldset></br>


                                <fieldset>
                                    <label>Name:<span style="color:red">*</span></label>
                                    <input name="firstname" type="text" id="firstname" placeholder="Enter Name" />
                                </fieldset> </br>
                                <?php echo form_error('firstname'); ?>
                                <fieldset>
                                    <label>E-mail address:<span style="color:red">*</span></label>
                                    <input name="email"  type="text" id="email" placeholder="Enter E-mail address">
                                </fieldset> </br>
                                <?php echo form_error('email'); ?>

                                <fieldset class="full-width">
                                    <label>Phone number:<span style="color:red">*</span></label>
                                    <input name="phoneno"  type="text" id="phoneno" placeholder="Enter Phone number">
                                </fieldset> </br>
                                <?php echo form_error('phoneno'); ?><br/>
             
             
</div>
                      
                       <div id="address" class="tabcontent">


                        <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                                <fieldset>
                <label>Country:<span style="color:red">*</span></label>
                
                        <select name="country" id="country">
                          <option value="">Select Country</option>
                          <?php
                          if(count($countries) > 0){
                          foreach($countries as $cnt){
                          ?>
                            <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                        <?php }}
                        ?>
                      </select><span id="country-error"></span>
                   
                  </fieldset> </br>
                                <?php echo form_error('country'); ?>

                                <fieldset>
                    <label>state:<span style="color:red">*</span></label>
                    <select name="state" id="state">
                      <option value="">Select country first</option>
                    </select><span id="state-error"></span>
                </fieldset> </br>
                                <?php echo form_error('state'); ?>

                                <fieldset>
                    <label> City:<span style="color:red">*</span></label>
                  <select name="city" id="city">
                    <option value="">Select state first</option>
                  </select><span id="city-error"></span>
                </fieldset> </br>
                <?php echo form_error('city'); ?>
                                <fieldset>
                  <label>Pincode:<span style="color:red">*</span></label>
                  <input name="pincode"  type="text" id="pincode" placeholder="Enter Pincode" /><span id="pincode-error"></span>
                  </fieldset> </br>
                <?php echo form_error('pincode'); ?>

                  <fieldset class="full-width">
                  <label>Address:<span style="color:red">*</span></label>
                
                <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'class' => 'ckeditor', 'value' => '')); ?><br>

               
                <?php echo form_error('address'); ?>
                </fieldset> </br>

                            

                                </div>

                <div id="artinfo" class="tabcontent">

                   <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>
                                <fieldset>
                                    <label>What is your Art:<span style="color:red">*</span></label>
                                    <input name="artname" type="text" id="artname" placeholder="Enter Art" /><span id="artname-error"></span>
                                </fieldset> </br>
                                <?php echo form_error('artname'); ?>

                                <fieldset>
                                    <label>Speciality:<span style="color:red">*</span></label>
                                    <input name="Speciality"  type="text" id="Speciality" placeholder="Enter Speciality" /><span id="Speciality-error"></span>
                                
                                </fieldset> </br>
                                <?php echo form_error('Speciality'); ?>

                                <fieldset class="full-width">
                                    <label>How You are Inspire:<span style="color:red">*</span></label>
                                
                                    <input name="inspire"  type="text" id="inspire" placeholder="Enter Inspire" /><span ></span>
                                
                                </fieldset> </br>
                                <?php echo form_error('inspire'); ?><br/>

                                 
                        </div>


                            <div id="portfolio" class="tabcontent">


                                <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 
                                
                                <fieldset class="full-width">
                                    <label>Put your education & experiences:<span style="color:red">*</span></label>

                                    <?php echo form_textarea(array('name' => 'portfolio', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => '')); ?><br>

                                    
                                </fieldset> </br>
                                
                                <?php echo form_error('portfolio'); ?><br/>
                           
                            </div>


                                <div id="skill" class="tabcontent">

                                  <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 
                                <fieldset>
                                    <label>Best of mine:<span style="color:red">*</span></label>
                                    <input type="file" name="art_bestofmine" id="art_bestofmine" placeholder="Enter Best of mine" /><span id="bestofmine-error"></span>
                                </fieldset> </br>
                                 <?php echo form_error('art_bestofmine'); ?> 

                                <fieldset>
                                    <label>Achievmeant:<span style="color:red">*</span></label>
                                    <input name="art_achievement"  type="file" id="art_achievement" placeholder="Enter Achievmeant" /><span id="achievmeant-error"></span>
                                </fieldset> </br>
                               <?php echo form_error('art_achievement'); ?> 

                                <fieldset class="full-width">
                                    <label>Skills:<span style="color:red">*</span></label>
                                    <input name="skills"  type="text" id="skills" placeholder="Enter Skills" /><span id="skills-error"></span>
                                </fieldset> </br>
                                 <?php echo form_error('skills'); ?> 


                            
                            </div>

                              

                                    

                               <div class="done">

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

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

       
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
                url:'<?php echo base_url() . "artistic/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "artistic/ajax_data"; ?>',
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

                       firstname: {

                            required: true,
                             
                           
                        },

                         email: {

                            required: true,
                            email: true,
                          
                        },
                       phoneno: {

                            required: true,
                            number: true,
                            minlength:10,
                            maxlength:11,
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

                        artname: {

                            required: true,
                         
                        },

                         Speciality: {

                            required: true,
                            
                          
                        },
                       inspire: {

                            required: true,
                            
                        },
                         artportfolio: {

                            required: true,
                         
                        },

                        skills: {

                            required: true,
                         
                        },

                         bestofmine: {

                            required: true,
                            
                          
                        },
                        achievmeant: {

                            required: true,
                            
                        },
                        

                      
                    },

                    messages: {

                         firstname: {

                            required: "First name Is Required.",
                            
                        },

                        email: {

                            required: "Email Is Required.",
                            
                        },
                        phoneno: {

                            required: "Phoneno Is Required.",
                            
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
                        address: {

                            required: "Address Is Required.",
                            
                        },
                        pincode: {

                            required: "Pincode Is Require",
                    },

                     artname: {

                            required: "Art name Is Required.",
                            
                        },

                        Speciality: {

                            required: "Speciality Is Required.",
                            
                        },
                        inspire: {

                            required: "Inspire Is Required.",
                            
                        },
                        artportfolio: {

                            required: "Art Portfolio Is Required.",
                            
                        },
                        skills: {

                            required: "Skills Is Required.",
                            
                        },

                        bestofmine: {

                            required: "Best of mine Is Required.",
                            
                        },
                        achievmeant: {

                            required: "Achievmeant Is Required.",
                            
                        },

                    },

                });
                   });
</script>
<!-- javascript validation End -->





    </body>

</html>

