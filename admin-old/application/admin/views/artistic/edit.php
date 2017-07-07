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

                                $form_attr = array('name' => 'edit_art', 'id' => 'edit_art', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('artistic/artistic_edit', $form_attr);

                                ?>



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

                             <select name="art_name" id="art">
                                         
                                            <?php
                                            if(count($result) > 0){
                                                foreach($result as $r){
                                          ?>
                                                <option value="<?php echo $result[0]['user_id']; ?>"><?php echo $result[0]['art_name']; ?></option>
                                           <?php }}
                                            ?>
                                        </select>
                                         <?php echo form_error('user'); ?>
                                     

                                </fieldset></br>

                              <?php  
                               
                                foreach ($result  as $r)  
                                { ?>
                                <fieldset>
                                    <label>Name:<span style="color:red">*</span></label>
                                    <input name="firstname" type="text" id="firstname" value="<?php echo $r['art_name'];?>" />
                                </fieldset>
                                <?php echo form_error('firstname'); ?>

                                <fieldset>
                                    <label>E-mail address:<span style="color:red">*</span></label>
                                    <input name="email"  type="text" id="email" value="<?php echo $r['art_email'];?>">
                                </fieldset>
                                <?php echo form_error('email'); ?>

                                <fieldset class="full-width">
                                    <label>Phone number:<span style="color:red">*</span></label>
                                    <input name="phoneno"  type="text" id="phoneno" value="<?php echo $r['art_phnno'];?>">
                                </fieldset>
                                <?php echo form_error('phoneno'); ?>

                               
                                <?php }   ?>

                            </div>
                      
                       <div id="address" class="tabcontent">

                             <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
                                        <label>Country</label>

                                        <select name="country" id="country">
                                          <option value="">Select Country</option>
                                            <?php
                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){
                                          
                                            if($result[0]['art_country'])
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>"
                                                  <?php if($cnt['country_id']==$result[0]['art_country']) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
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
                                                if($result[0]['art_state'])

                                            {
                                                 //echo "hi";die();
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$result[0]['art_state']) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
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
                                                if($result[0]['art_city'])

                                            {
                                                 //echo "hi";die();
                                                 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$result[0]['art_city']) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

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

    <?php  
                               
                                foreach ($result  as $r)  
                                { ?> 
                                <fieldset>
                                    <label>Pincode:<span style="color:red">*</span></label>
                                    <input name="pincode"  type="text" id="pincode" value="<?php echo $r['art_pincode'];?>" onblur="return phone_no();"/><span id="pincode-error"></span>
                                </fieldset>
                                <?php echo form_error('pincode'); ?>

                                <fieldset class="full-width">
                                    <label>Address:<span style="color:red">*</span></label>
                                    <?php echo form_textarea(array('name' => 'address', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($r['art_address']))); ?>
                                <?php echo form_error('address'); ?>
                                </fieldset>

                                
                         <?php }   ?>
                           
                       
                    </div>

                <div id="artinfo" class="tabcontent">

                      <?php  
                               
                                foreach ($result  as $r)  
                                { ?>
                            <fieldset>
                                <label>What is your Art:<span style="color:red">*</span></label>
                                <input name="artname" type="text" id="artname" value="<?php echo $r['art_yourart'];?>"/><span id="artname-error"></span>
                            </fieldset>
<!--                             <?php echo form_error('artname'); ?>
 -->
                            <fieldset>
                                <label>Speciality:<span style="color:red">*</span></label>
                                <input name="Speciality"  type="text" id="Speciality" value="<?php echo $r['art_speciality'];?>"/><span id="Speciality-error"></span>
                            </fieldset>
<!--                             <?php echo form_error('Speciality'); ?>
 -->
                            <fieldset class="full-width">
                                <label>How You are Inspire:<span style="color:red">*</span></label>
                                <input name="inspire"  type="text" id="inspire" value="<?php echo $r['art_inspire'];?>"/>
                            </fieldset>
<!--                             <?php echo form_error('inspire'); ?><br/>
 -->
                            
                            <?php }   ?>


                 </div>


                <div id="portfolio" class="tabcontent">
                          <?php  
                               
                                foreach ($result  as $r)  
                                { ?>
                            <fieldset class="full-width">
                                <?php echo form_textarea(array('name' => 'portfolio', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($r['art_portfolio']))); ?>
                            </fieldset>
                                
                                <?php echo form_error('portfolio'); ?>

                          
                            <?php }   ?>

                 </div>



                <div id="skill" class="tabcontent">



                          <fieldset class="full-width">
                                    <label style="display: block;">Best of mine:<span style="color:red">*</span></label>
                                    <?php
                                    $allowed =  array('gif','png','jpg');
                    
                                    $filename = $result[0]['art_bestofmine'];
                                    
                                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                    
                                    if(!in_array($ext,$allowed) ) 
                                    {      
                                    ?>

                                <video controls >
                                <source src="<?php echo base_url(ARTISTICIMAGE.$result[0]['art_bestofmine']); ?>" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                                </video>
                                <?php
                                 }
                                else
                                {
                                    // echo '<br>';
                                   
                                ?>
                            </fieldset>
                            <fieldset class="full-width">
                            <img src="<?php echo base_url(ARTISTICIMAGE.$result[0]['art_bestofmine'])?>" style="width:100px;height:100px;">
                         <?php } ?>

                                <input name="art_bestofmine" type="file" id="art_bestofmine"/><span id="bestofmine-error"></span>
                            </fieldset>
                <!-- <?php //echo form_error('bestofmine'); ?> -->

                        <fieldset class="full-width">
                            <label>Achievmeant:<span style="color:red">*</span></label>
                            <img src="<?php echo base_url( ARTISTICIMAGE . $result[0]['art_achievement'])?>" style="width:100px;height:100px;">
                            <input name="art_achievmeant"  type="file" id="art_achievmeant"/><span id="achievmeant-error"></span>
                        </fieldset>
                    <!-- <?php //echo form_error('achievmeant'); ?> -->

                        <fieldset class="full-width">
                            <label for="country-suggestions">Skills:<span style="color:red">*</span></label>
                            <input name="skills"  type="text" id="skills" value="<?php echo $result[0]['art_skill'];?>" />
                        </fieldset>
                        <?php //echo form_error('skills'); ?>
                       
                           
                 </div>
                           
                              

                      -        <div class="done">

                                 <input type="hidden" name="art_id" value="<?php echo $result[0]['art_id'];?>"/>    


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

                $("#edit_art").validate({

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
