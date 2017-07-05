
<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<?php if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php } ?>
   <!-- END HEADER --> 
<div class="js">
    <body class="page-container-bg-solid page-boxed">
<div id="preloader"></div>
      <section>
      
        <div class="user-midd-section" id="paddingtop_fixed_job">
           <div class="row">
           <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>

             <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($jobdata[0]['job_step'] == 10){ ?>

       <div class="col-md-6 col-sm-8"><h3>You are updating your Job Profile.</h3></div>

            <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Job Profile.</h3></div>
                       <?php }?>
            </div>
            <br>
            <br>
            <br>
            </div>
           
            <div class="container">
                <div class="row row4">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>
                                <li class="custom-none"><a href="<?php echo base_url('job/job_address_update'); ?>">Address</a></li>
                                  <li class="custom-none"><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>

                                  <li class="custom-none"><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('job/job_skill_update'); ?>">Professional Skills</a></li>
                                <!-- <li class="custom-none"><a href="<?php //echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li> -->
                              
                                <li class="custom-none"><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>
                                <li class="custom-none"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>
                                <li class="custom-none"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>
                                <li <?php if($this->uri->segment(1) == 'job'){?> class="active init" <?php } ?>><a href="#">Career Objectives</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
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

                     <div class="clearfix">
                            <div class="common-form common-form_border">
                              <h3>Carrier Objectives</h3>
                             <?php echo form_open(base_url('job/job_carrier_insert'), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform','class'=>'clearfix')); ?>

                                <!-- <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div> -->

                   <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>

                                <fieldset class="full-width">
                                         <label>Carrier Objectives:<!-- <span class="red">*</span> --></label>
										
                                         

                                           <textarea tabindex="1" autofocus name ="carrier" id="carrier" rows="4" cols="50" placeholder="Enter Carrier" style="resize: none;"><?php if($carrier1){ echo $carrier1; } ?></textarea>
                                         <?php echo form_error('carrier'); ?>
                          	         </fieldset>

        <?php

     $userid = $this->session->userdata('aileenuser');


        $contition_array = array('user_id' => $userid, 'is_delete' => 0, 'status' => 1);



        $userdatacon = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
                                    
                                      ?>
                                    <fieldset class="full-width">                           
                                     <b> Declaration: <span class="red">*</span> </b>
                                     <div class="job_carrier_checkbox">
                                     <input type="checkbox" id="checkbox" tabindex="2" name="declaration" value="declaration"  <?php echo ($declaration1 == 'declaration') ? 'checked' : '' ?>>
                                         I here by Declare that all the above Information are true and correct to best of my knowledge                     
                                       
                                        <?php echo form_error('checkbox') ?>
                                    </div>

                                </fieldset> 
                                      

                                 <fieldset class="hs-submit full-width">

<!--                                  <input type="reset">
                                    <input type="submit"  id="previous" name="previous" value="previous">-->
                                    
                                    <input type="submit"  id="submit" name="submit" tabindex="3" value="Submit">
                                   
                                </fieldset>

                                </form>
                            </div>    
                        </div>
                    </div>
                    <!-- middle section end -->

                   
                </div>
            </div>
        </div>
    </section>
    
    <footer>
          <?php echo $footer;  ?>
    </footer>
    
</body>
</html>


<!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<!-- script for skill textbox automatic end -->
<script>

                                        var data = <?php echo json_encode($demo); ?>;

                                        $(function () {
                                            // alert('hi');
                                            $("#tags").autocomplete({
                                                source: function (request, response) {
                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                    response($.grep(data, function (item) {
                                                        return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                                                    event.preventDefault();
                                                    $("#tags").val(ui.item.label);
                                                    $("#selected-tag").val(ui.item.label);
                                                    // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
                                                    event.preventDefault();
                                                    $("#tags").val(ui.item.label);
                                                }
                                            });
                                        });

</script>

                <script>

var data1= <?php echo json_encode($city_data); ?>;
//alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
  
</script>
<!-- for search validation -->
<script type="text/javascript">
    function checkvalue() {
        // alert("hi");
        var searchkeyword = document.getElementById('tags').value;
        var searchplace = document.getElementById('searchplace').value;
        // alert(searchkeyword);
        // alert(searchplace);
        if (searchkeyword == "" && searchplace == "") {
            //alert('Please enter Keyword');
            return false;
        }
    }

</script>

<!-- <script>
//select2 autocomplete start for skill
    $('#searchskills').select2({

        placeholder: 'Find Your Skills',

        ajax: {

            url: "<?php echo base_url(); ?>job/keyskill",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
    $('#searchplace').select2({

        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax: {

            url: "<?php echo base_url(); ?>job/location",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for Location

</script> -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

   <script type="text/javascript">

            //validation for edit email formate form

// $.validator.addMethod("regx", function(value, element, regexpr) {          
//     return regexpr.test(value);
// }, "Only space, only number and only special characters are not allow");

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
            

            $(document).ready(function () { 

                $("#jobseeker_regform").validate({

                    rules: {

                        carrier: {

                            //required: true,
                            regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/

                            //noSpace: true
                           
                        }, 

                         declaration: {

                            required: true,
                           
                        },  
                        
                    },

                    messages: {

                        // carrier: {

                        //    required: "Carrier Is Required.",
                            
                        // },
                         declaration: {

                            required: "click on terms and condition Is Required.",
                            
                        },
                    
                    },

                });
                   });
  </script>
    

<!-- validation end--> 
<script type="text/javascript"> 
 $(".alert").delay(3200).fadeOut(300);
</script>
 <script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script> 
    