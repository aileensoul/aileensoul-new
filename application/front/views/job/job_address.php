<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">

<?php if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php } ?>
<!-- END HEADER -->
<div class="js">
<body class="page-container-bg-solid page-boxed">
<div id="preloader"></div>

    <section>

        <div class="user-midd-section" id="paddingtop_fixed_job">
            
          <div class="common-form1">
          <div class="row">
             <div class="col-md-3 col-sm-4"></div>
             <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 2){ ?>
<div class="col-md-6 col-sm-8"><h3>You are updating your Job Profile.</h3></div>

            <?php }else{

             ?>

                      <div class="col-md-6 col-sm-8"><h3>You are making your Job Profile.</h3></div>

                      <?php }?>
            </div>
            <br>
           
            </div>

            <div class="container">
                <div class="row row4">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                
                                <li class="custom-none"><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>

                                <li  <?php if ($this->uri->segment(1) == 'job') { ?> class="active init" <?php } ?>><a href="#">Address</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '2') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '3') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '4') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_skill_update'); ?>">Professional Skills</a></li>

                                <!-- <li class="<?php
                                if ($jobdata[0]['job_step'] < '5') {
                                   // echo "khyati";
                                }
                                ?>"><a href="<?php// echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li> -->

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '5') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '7') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '8') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '9') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_carrier_update'); ?>">Career Objectives</a></li>
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
                                <h3>Address</h3>
                                <?php echo form_open(base_url('job/job_address_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                                  <div>

                                   <!-- <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div> -->

        <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>
                   

                             
                                <div class="text-center">
      <h5 class="head_title">Present Address</h5>
  </div>

                                <?php
                                $country = form_error('country');
                                $state = form_error('state');
                                $city = form_error('city');
                                $address = form_error('address');
                                $pincode = form_error('pincode');
                                $country_permenant = form_error('country_permenant');
                                $state_permenant = form_error('state_permenant');
                                $city_permenant = form_error('city_permenant');
                                $address_permenant = form_error('address_permenant');
                                $pincode_permenant = form_error('pincode_permenant');
                                ?>
                                
                                <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                    <label>Country:<span class="red">*</span> </label>
                                    <select name="country" tabindex="1" autofocus id="country">
                                        <option value="">Select Country</option>
                                        <?php
                                        if (count($countries) > 0) {
                                            foreach ($countries as $cnt) {

                                                if ($country1) {
                                                    ?>
                                                    <option value="<?php echo $cnt['country_id']; ?>" <?php if ($cnt['country_id'] == $country1) echo 'selected'; ?>><?php echo $cnt['country_name']; ?></option>

                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>


                                    </select>
                                    <?php echo form_error('country'); ?>
                                </fieldset>

                                <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                    <label>State:<span class="red">*</span></label>
                                    <select name="state" id="state" tabindex="2">
                                        <?php
                                        if ($state1) {
                                            foreach ($states as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>

                                                <?php
                                            }
                                        }

                                        else {
                                            ?>
                                            <option value="">Select country first</option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <?php echo form_error('state'); ?>
                                </fieldset>

                                <fieldset <?php if ($city) { ?> class="error-msg" <?php } ?>>
                                    <label>City :</label>
                                    <select tabindex="3" name="city" id="city">
                                        <?php
                                        if ($city1) {
                                            ?>
                                            <option value="">Select City</option>
                                            <?php
                                            foreach ($cities as $cnt) {
                                                ?>
                                                  
                                                <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        }
                                        else if($state1)
                                        {
                                            ?>
                                            <option value="">Select City</option>
                                            <?php
                                            foreach ($cities as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        }

                                        else {
                                            ?>
                                            <option value="">Select state first</option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('city'); ?>
                                </fieldset>

                                <fieldset <?php if ($pincode) { ?> class="error-msg" <?php } ?>>
                                    <label>Pincode :</label>
                                    <input type="text" tabindex="4" name="pincode" id="pincode" placeholder="Enter Pincode" value="<?php
                                    if ($pincode1) {
                                        echo $pincode1;
                                    }
                                    ?>"/> <span id="pincode-error"> </span>
                                           <?php echo form_error('pincode'); ?>
                                </fieldset>

                                <fieldset class="full-width">
                                    <label>Postal Address: <span class="red">*</span> </label>

                                    <textarea name ="address" tabindex="5" id="address" rows="4" cols="50" placeholder="Enter Address" style="resize: none;"><?php
                                        if ($address1) {
                                            echo $address1;
                                        }
                                        ?></textarea>
                                    <?php echo form_error('address'); ?>
                                </fieldset>


                                <fieldset class="hs-submit full-width">
                                <input type="button" class="job_address_btn"  tabindex="6" value="copy" onClick="copy()"/>
                                </fieldset>
                                <div class="text-center fw">
                                      <h5 class="head_title">Permenant Address</h5>
                                  </div>

                                <fieldset <?php if ($country_permenant) { ?> class="error-msg" <?php } ?>>
                                    <label>Country:<span class="red">*</span> </label>
                                    <select name="country_permenant"  id="country_permenant">
                                        <option value="">Select Country</option>
                                        <?php
                                        if (count($countries) > 0) {
                                            foreach ($countries as $cnt) {

                                                if ($country1_permenant) {
                                                    ?>
                                                    <option value="<?php echo $cnt['country_id']; ?>" <?php if ($cnt['country_id'] == $country1_permenant) echo 'selected'; ?>><?php echo $cnt['country_name']; ?></option>

                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>


                                    </select>
                                    <?php echo form_error('country_permenant'); ?>
                                </fieldset>

                                <fieldset <?php if ($state_permenant) { ?> class="error-msg" <?php } ?>>
                                    <label>State:<span class="red">*</span> </label>
                                    <select name="state_permenant" id="state_permenant">
                                        <?php
                                        if ($state1_permenant) {
                                            foreach ($states_per as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1_permenant) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>

                                                <?php
                                            }
                                        }

                                        else {
                                            ?>
                                            <option value="">Select country first</option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <?php echo form_error('state_permenant'); ?>
                                </fieldset>

                                <fieldset <?php if ($city_permenant) { ?> class="error-msg" <?php } ?>>
                                    <label>City :</label>
                                    <select name="city_permenant" id="city_permenant">
                                        <?php
                                        if ($city1_permenant) {
                                            ?>
                                              <option value="">Select City</option>
                                              <?php
                                            foreach ($cities_per as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1_permenant) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        }
                                          else if($state1_permenant)
                                        {
                                            ?>
                                            <option value="">Select City</option>
                                            <?php
                                            foreach ($cities_per as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        }

                                        else {
                                            ?>
                                            <option value="">Select state first</option>

                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo form_error('city_permenant'); ?>
                                </fieldset>

                                <fieldset <?php if ($pincode_permenant) { ?> class="error-msg" <?php } ?>>
                                    <label>Pincode :</label>
                                    <input type="text" name="pincode_permenant" id="pincode_permenant" placeholder="Enter Pincode" value="<?php
                                    if ($pincode1_permenant) {
                                        echo $pincode1_permenant;
                                    }
                                    ?>"/> <span id="pincode-error"> </span>
                                           <?php echo form_error('pincode_permenant'); ?>
                                </fieldset>

                                <fieldset class="full-width">
                                    <label>Postal Address:<span class="red">*</span> </label>

                                    <textarea name ="address_permenant" id="address_permenant" rows="4" cols="50" placeholder="Enter Address" style="resize: none;"><?php
                                        if ($address1_permenant) {
                                            echo $address1_permenant;
                                        }
                                        ?></textarea>
                                    <?php echo form_error('address_permenant'); ?>
                                </fieldset>

                                <fieldset class="hs-submit full-width">

<!--                                        <input type="reset">
                                        <input type="submit"  id="previous" name="previous" value="previous">-->
                                    <input type="submit"  id="next" name="next" tabindex="7" value="Next">


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


</body>
</html>


<!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
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

                                        var data1 = <?php echo json_encode($city_data); ?>;

                                        $(function () {
                                            // alert('hi');
                                            $("#searchplace").autocomplete({
                                                source: function (request, response) {
                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                    response($.grep(data1, function (item) {
                                                        return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                                                    event.preventDefault();
                                                    $("#searchplace").val(ui.item.label);
                                                    $("#selected-tag").val(ui.item.label);
                                                    // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
                                                    event.preventDefault();
                                                    $("#searchplace").val(ui.item.label);
                                                }
                                            });
                                        });

</script>

<!-- for search validation -->
<script type="text/javascript">
   function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
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

</script>
 -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<!-- script for click on copy button to get similar value Start -->
<script type="text/javascript">
    function copy() {
        var country = document.getElementById("country");
        var country_permenant = document.getElementById("country_permenant");
        country_permenant.value = country.value;
        // alert(country.value);
        // alert(country_permenant.value);

        //var state = document.getElementById("state").value;
        var state = document.getElementById('state').innerHTML;
        var state1 = document.getElementById("state").value;
        //alert( document.getElementById('state').innerHTML);
        var state_permenant = document.getElementById("state_permenant");
        state_permenant.innerHTML = state;
        state_permenant.value = state1;
        //alert(state);
        //alert(state_permenant.innerHTML);

        var city = document.getElementById('city').innerHTML;
        var city1 = document.getElementById("city").value;
        //alert( document.getElementById('state').innerHTML);
        var city_permenant = document.getElementById("city_permenant");
        city_permenant.innerHTML = city;
        city_permenant.value = city1;

        var pincode = document.getElementById("pincode");
        var pincode_permenant = document.getElementById("pincode_permenant");
        pincode_permenant.value = pincode.value;

        var address = document.getElementById("address");
        var address_permenant = document.getElementById("address_permenant");
        address_permenant.value = address.value;

    }


</script>
<!-- script for click on copy button to get similar value  end -->

<!-- script for country,state,city start -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#country').on('change', function () {
            var countryID = $(this).val();
            //alert(countryID);
            if (countryID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "job_profile/ajax_data"; ?>',
                    data: 'country_id=' + countryID,
                    success: function (html) {
                        $('#state').html(html);

                        //$('#state_permenant').html(html);
                        $('#city').html('<option value="">Select state first</option>');
                    }
                });
            } else {
                $('#state').html('<option value="">Select country first</option>');
                $('#city').html('<option value="">Select state first</option>');
            }
        });

        $('#state').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "job_profile/ajax_data"; ?>',
                    data: 'state_id=' + stateID,
                    success: function (html) {

                        $('#city').html(html);
                    }
                });
            } else {
                $('#city').html('<option value="">Select state first</option>');
            }
        });
    });
</script>
<!-- script for country,state,city end -->

<!-- script for country,state,city copy start -->
<!-- <script type="text/javascript">
    $(document).ready(function () {
        
    });
</script> -->
<!-- script for country,state,city copy end -->




<!-- <script type="text/javascript">

    
    $(document).ready(function () {

        
    });
</script> -->


<script>

    var complex = <?php echo json_encode($selectdata); ?>;
    $("#lan").select2().select2('val', complex)

</script>
<!-- script for Language textbox automatic end (option 2)-->
<script type="text/javascript">
    $(".alert").delay(3200).fadeOut(300);

    $(".formSentMsg").delay(3200).fadeOut(300);
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});



//validation for edit email formate form

    jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");

    $.validator.addMethod("regx", function(value, element, regexpr) {          
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

    $.validator.addMethod("reg_candidate", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Pin Number Is Not Proper");


$("#jobseeker_regform").validate({

            rules: {

                country: {

                    required: true,

                },

                state: {

                    required: true,

                },

                address: {

                    required: true,
                    regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                    //noSpace: true

                },

                country_permenant: {

                    required: true,

                },

                state_permenant: {

                    required: true,

                },

                address_permenant: {

                    required: true,
                    regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //noSpace: true

                },
                pincode: {
                    number:true,
                    reg_candidate:/^-?(([0-9]{0,100}))$/
                   
                },
                pincode_permenant: {
                   number:true,
                   reg_candidate:/^-?(([0-9]{0,100}))$/
                },

            },

            messages: {

                country: {

                    required: "Country Is Required.",

                },

                state: {

                    required: "State Is Required.",

                },

                address: {

                    required: "Address  Is Required.",

                },

                country_permenant: {

                    required: "Country Is Required.",

                },

                state_permenant: {

                    required: "State Is Required.",

                },

                address_permenant: {

                    required: "Address  Is Required.",

                },


            },

        });



$('#country_permenant').on('change', function () {
            var countryID = $(this).val();
           // alert(countryID);

            if (countryID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "job_profile/ajax_data"; ?>',
                    data: 'country_id=' + countryID,
                    success: function (html) {
                        $('#state_permenant').html(html);
                        $('#city_permenant').html('<option value="">Select state first</option>');
                    }
                });
            } else {
                $('#state_permenant').html('<option value="">Select country first</option>');
                $('#city_permenant').html('<option value="">Select state first</option>');
            }
        });

        $('#state_permenant').on('change', function () {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "job_profile/ajax_data"; ?>',
                    data: 'state_id=' + stateID,
                    success: function (html) {
                        $('#city_permenant').html(html);
                    }
                });
            } else {
                $('#city_permenant').html('<option value="">Select state first</option>');
            }
        });



});

// disable spacebar js start
$(window).load(function(){
$("#pincode").on("keydown", function (e) {
return e.which !== 32;
});
}); 

$(window).load(function(){
$("#pincode_permenant").on("keydown", function (e) {
return e.which !== 32;
});
}); 
// disable spacebar js end
</script>

