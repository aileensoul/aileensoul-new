
<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.css" rel="stylesheet" /> 
<!-- Calender Css Start-->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.datetimepicker.css'); ?>">
<!-- Calender Css End-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">


<style type="text/css">

.date-dropdowns .day, .date-dropdowns .month, .date-dropdowns .year{width: 30%; float: left; margin-right: 5%;}
.date-dropdowns .year{margin-right: 0;}
.example {
    width: 33%;
    min-width: 400px;
    padding: 15px;
    display: inline-block;
    box-sizing: border-box;
    text-align: center;
}

.example:first-of-type {
    position: relative;
    bottom: 35px;
}

/* Example Heading */
.example h2 {
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
    font-size: 1.3em;
    margin: 15px 0;
    color: #4F5462;
}

.example input {
    display: block;
    margin: 0 auto 20px auto;
    width: 150px;
    padding: 8px 10px;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    background: #F2F2F2;
    text-align: center;
    font-size: 1em;
    letter-spacing: 0.02em;
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
}

.example select {
    padding: 10px;
    background: #ffffff;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    margin: 0 3px;
}

.example select.invalid {
    color: #E9403C;
}

.example input[type="submit"] {
    margin-top: 10px;
}

.example input[type="submit"]:hover {
    cursor: pointer;
    background-color: #e5e5e5;
}


</style>
<!-- css for date picker end-->

<!-- start header -->
<?php echo $header; ?>

<?php if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php } ?>
<!-- END HEADER -->
<style type="text/css">
   
</style>
<div class="js">
<body class="page-container-bg-solid page-boxed">
<div id="preloader"></div>
    <section>

        <div class="user-midd-section " id="paddingtop_fixed_job">
            
           <div class="common-form1 ">
             <div class="col-md-3 col-sm-4"></div>

             <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 1){ ?>
                <div class="col-md-6 col-sm-12"><h3>You are updating your Job Profile.</h3></div>
            <?php  }else{

             ?>


                      <div class="col-md-6 col-sm-12"><h3>You are making your Job Profile.</h3></div>

                      <?php }?>
            </div>
            <br>
           
            <div class="container">
                <div class="row row4">
                    <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li  <?php if ($this->uri->segment(1) == 'job') { ?> class="active init" <?php } ?> ><a href="#">Basic Information</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '1') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_address_update'); ?>">Address</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '2') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '3') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '4') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_skill_update'); ?>">Professional Skills</a></li>

                              <!--   <li class="<?php if ($jobdata[0]['job_step'] < '1') {
   // echo "khyati";
} ?>"><a href="<?php //echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li> -->

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '5') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '7') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '8') {
                                echo "khyati";
                            } ?>"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>

                                <li class="custom-none <?php if ($jobdata[0]['job_step'] < '9') {
                                echo "khyati";
                            } ?>"><a href="<?php echo base_url('job/job_carrier_update'); ?>">Career Objectives</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
                    <div class="col-lg-6 col-md-6 col-sm-8">

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
                                <h3>Basic Information</h3>
<?php echo form_open(base_url('job/job_basicinfo_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix')); ?>
                            <!-- <div>
                                <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div> -->

     <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>

<?php
$fname = form_error('fname');
$lname = form_error('lname');
$email = form_error('email');
$phnno = form_error('phnno');
$marital_status = form_error('marital_status');
$nationality = form_error('nationality');
$language = form_error('lan');
$dob = form_error('dob');
$gender = form_error('gender');
?>



                                <fieldset <?php if ($fname) { ?> class="error-msg" <?php } ?>>
                                    <label>First Name :<span class="red">*</span></label>
                                    <input type="text" tabindex="1" autofocus name="fname" id="fname" placeholder="Enter First name" value="<?php if ($fname1) {
                                        echo $fname1;
                                    } else {
                                        echo $job[0]['first_name'];
                                    } ?>"/> <span id="fname-error"> </span>
<?php echo form_error('fname'); ?>
                                </fieldset>

                                <fieldset <?php if ($lname) { ?> class="error-msg" <?php } ?>>  
                                    <label>Last Name :<span class="red">*</span> </label>
                                    <input type="text" name="lname" tabindex="2"  id="lname" placeholder="Enter Last name" value="<?php if ($lname1) {
    echo $lname1;
} else {
    echo $job[0]['last_name'];
} ?>"/> <span id="lname-error"> </span>
<?php echo form_error('lname'); ?>
                                </fieldset>

                                <fieldset <?php if ($email) { ?> class="error-msg" <?php } ?>>
                                    <label>Email Address :<span class="red">*</span> </label>
                                    <input type="email" name="email" id="email" tabindex="3" placeholder="Enter Email Address"  value="<?php if ($email1) {
    echo $email1;
} else {
    echo $job[0]['user_email'];
} ?>"/> <span id="email-error"> </span>
                                        <?php echo form_error('email'); ?>
                                </fieldset>

                                <fieldset <?php if ($phnno) { ?> class="error-msg" <?php } ?>>
                                    <label>Phone Number :</label>
                                    <input type="text" name="phnno" id="phnno" tabindex="4" placeholder="Enter Phone Number" value="<?php if ($phnno1) {
                                            echo $phnno1;
                                        } ?>" /> <span id="phnno-error"> </span>
                                        <?php echo form_error('phnno'); ?>
                                </fieldset>

                                <fieldset <?php if ($marital_status) { ?> class="error-msg" <?php } ?>>
                                    <label>Marital Status :<span class="red">*</span> </label>
                                    <input type="radio" name="marital_status" tabindex="5" value="married" id="marital_status"  <?php echo ($marital_status1 == 'married') ? 'checked' : '' ?>>
                    <span class="radio_check_text">Married</span>
                                    
                                    <input type="radio" name="marital_status" tabindex="6" value="unmarried" id="marital_status" <?php echo ($marital_status1 == 'unmarried') ? 'checked' : '' ?>  > 
                    <span class="radio_check_text">Unmarried</span>

                                    <span id="marital_status-error"> </span>
                                        <?php echo form_error('marital_status'); ?>
                                </fieldset>

                                <fieldset <?php if ($nationality) { ?> class="error-msg" <?php } ?>>
                                    <label>Nationality:<span class="red">*</span></label>

                                    <select name="nationality" id="nationality" tabindex="7">

                                        <option value="" selected option disabled>--Select--</option>
<?php
if (count($nation) > 0) {
    foreach ($nation as $cnt) {

        if ($nationality1) {
            ?>

                                                    <option value="<?php echo $cnt['nation_id']; ?>" <?php if ($cnt['nation_id'] == $nationality1) echo 'selected'; ?>><?php echo $cnt['nation_name']; ?></option>

                                                <?php
                                            }
                                            else {
                                                ?>

                                                    <option value="<?php echo $cnt['nation_id']; ?>"><?php echo $cnt['nation_name']; ?></option>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                    </select>

                                    <?php echo form_error('nationality'); ?>
                                </fieldset>

                                <fieldset id="erroe_nn" <?php if ($language) { ?> class="error-msg" <?php } ?>>
                                    <label>Languages Known:<span class="red">*</span></label> 

             <select name="language[]" id ="lan" multiple="multiple" style="width: 100%"  tabindex="8">
                     <option></option>

<?php foreach ($language1 as $language) { ?>
                         <option value="<?php echo $language['language_id']; ?>"><?php echo $language['language_name']; ?></option>
<?php } ?>

                                    </select>


<?php echo form_error('lan'); ?>

        
                                </fieldset>
                                <fieldset <?php if ($dob) { ?> class="error-msg" <?php } ?>>
                                    <label>Date of Birth:<span class="red">*</span></label>
                                
                                 <input type="hidden" id="datepicker">
                                    <!-- <input type="text" name="dob" id="datepicker" placeholder="dd-MM-yyyy" tabindex="9"  autocomplete="off" value="<?php
                                    // if($dob1){
                                       // echo date('d/m/Y',strtotime($dob1));}
                                       // else{

                                         //  echo date('d/m/Y',strtotime($job[0]['user_dob']));  } ?>" > -->


<?php echo form_error('dob'); ?>

                                </fieldset>

                                <fieldset <?php if ($gender) { ?> class="error-msg" <?php } ?>>
                                    <label>Gender:<span class="red">*</span></label>
                                    <input type="radio" name="gender" value="male" id="gender" tabindex="9" <?php if($gender1){if($gender1 == 'male') { echo 'checked' ; }}
                                    else { if($job[0]['user_gender'] == 'M'){ echo 'checked' ; }}
                                       
                                    ?>>Male
                                    <input type="radio" name="gender" value="female" id="gender" tabindex="9" <?php  if($gender1){if($gender1 == 'female') { echo 'checked' ; }}
                                    else { if($job[0]['user_gender'] == 'F'){echo 'checked' ; }}
                                       
                                    ?> >Female
                                    <span id="gender-error"> </span>
<?php echo form_error('gender'); ?>
                                </fieldset>

                                <fieldset class="hs-submit full-width">

                              <!--<input type="reset">-->
                                    <input type="submit"  id="next" name="next" value="Next" tabindex="10">


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
    <!-- END CONTAINER -->


</body>
</html>

<!-- Calender JS Start-->

<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

 -->





 <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
 



<script src="<?php echo base_url('js/jquery.datetimepicker.full.js'); ?>"></script>

<script type="text/javascript">
    $('#datepicker').datetimepicker({
        //yearOffset:222,
       
        startDate: "2013/02/14",
        lang: 'ch',
        timepicker: false,
        format: 'd/m/Y',
        formatDate: 'Y/m/d'
                //minDate:'-1970/01/02', // yesterday is minimum date
                //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });

</script>
<!-- Calender Js End-->
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

</script> -->


<!-- Field Validation Js Start -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>

<!-- Field Validation Js End -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.js"></script>


<!-- javascript validation start -->
<script type="text/javascript">

    $(document).ready(function () {

 // jQuery.validator.addMethod("noSpace", function(value, element) { 
 //      return value == '' || value.trim().length != 0;  
 //    }, "No space please and don't leave it empty");


$.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Number, space and special character are not allowed");

$.validator.addMethod("regx2", function(value, element, regexpr) {          
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
},"character & letters are not allow & space are not allow in the begining");
// for date validtaion start

jQuery.validator.addMethod("isValid", function (value, element) {

var todaydate = new Date();
var dd = todaydate.getDate();
var mm = todaydate.getMonth()+1; //January is 0!
var yyyy = todaydate.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

   var todaydate = yyyy+'-'+mm+'-'+dd;

    var one = new Date(value).getTime();
    var second = new Date(todaydate).getTime();
   
    return one <= second;
}, "Last date should be Less than Or equal to today date");

//date validation end

        $("#jobseeker_regform").validate({

            ignore: ".language",
            rules: {

                fname: {

                    required: true,
                   regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                    //noSpace: true

                },

                lname: {

                    required: true,
                    regx2:/^[^-\s][a-zA-Z_\s-]+$/,
                    //noSpace: true

                },

                email: {

                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo site_url() . 'job/check_email' ?>",
                        type: "post",
                        data: {
                            email: function () {

                                return $("#email").val();
                            },
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        },
                    },
                },

                phnno: {

                            number: true,
                           minlength: 8,
                           maxlength:15
                            
                            
                        },
                        
                marital_status: {

                    required: true,

                },
                nationality: {

                    required: true,

                },
                'language[]': {

                    required: true,

                },
                dob: {

                    required: true,
                    isValid: 'Last date should be Less than Or equal to today date',
                },
                gender: {

                    required: true,

                },
            },

            messages: {

                fname: {

                    required: "First name Is Required.",

                },

                lname: {

                    required: "Last name Is Required.",

                },

                email: {

                    required: "Email Address Is Required.",
                    email: "Please Enter Valid Email Id.",
                    remote: "Email already exists"
                },
                phnno:{
                             required:"Phone Number Is Required.",
                    },

                marital_status: {

                    required: "Marital Status Is Required.",

                },
                nationality: {

                    required: "Nationality Is Required.",

                },
                'language[]': {

                    required: "Language  Is Required.",

                },
                dob: {

                    required: "Date of Birth Is Required.",

                },
                gender: {

                    required: "Gender Is Required.",

                },

            },

        });
    });
</script>
<!-- javascript validation End -->

<!-- script for Language textbox automatic end (option 2)-->
<script type="text/javascript">
$(document).ready(function () {
   
    var complex = <?php echo json_encode($selectdata); ?>;
    if(complex)
    {
         $("#lan").select2({
         placeholder: "Select a Language",
         }).select2('val', complex);
    }
    else
    {
         $("#lan").select2({
         placeholder: "Select a Language",
 
        });
    }

//     $("#lan").select2({
//         placeholder: "Select a Language",
//     }).select2('val', complex);

});


</script>
<!-- <script>

   // var complex = <?php echo json_encode($selectdata); ?>;
    $("#lan").select2().select2('val', complex)

</script> -->
<!-- script for Language textbox automatic end (option 2)-->
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


<script src="<?php echo base_url('js/jquery.date-dropdowns.js'); ?>"></script>
<script>
$(function() {
                

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

var today = yyyy;

var date_picker ='<?php echo date('Y-m-d',strtotime($job[0]['user_dob']));?>';
var  date_picker_edit='<?php echo date('Y-m-d',strtotime($dob1));?>';

if(date_picker_edit=="1970-01-01"){
 
     $("#datepicker").dateDropdowns({
                    submitFieldName: 'dob',
                    submitFormat: "yyyy-mm-dd",
                    minYear: 1821,
                    maxYear: today,
                    defaultDate: date_picker,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //startDate: today,
 
                });   
}
else if(date_picker=="1970-01-01"){

                $("#datepicker").dateDropdowns({
                    submitFieldName: 'dob',
                    submitFormat: "yyyy-mm-dd",
                    minYear: 1821,
                    maxYear: today,
                    defaultDate: date_picker_edit,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //startDate: today,

                });   
}else if(!date_picker){

                $("#datepicker").dateDropdowns({
                    submitFieldName: 'dob',
                    submitFormat: "yyyy-mm-dd",
                    minYear: 1821,
                    maxYear: today,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //defaultDate: date_picker
                    //startDate: today,

                });  
     } 
                
            });
</script>



<style type="text/css">
    .date-dropdowns label{margin-top: 42px !important;}
</style>
