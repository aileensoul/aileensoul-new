<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    <!-- start header -->
<?php echo $header; ?>

<?php if($recdata[0]['re_step'] == 3){?>
    <?php echo $recruiter_header2_border; ?>
<?php }?>
    <!-- END HEADER -->
   
    <body class="page-container-bg-solid page-boxed">
<div id="preloader"></div>
      <section>
       
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>

             <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 're_status' => '1');
             $recdata = $this->common->select_data_by_condition('recruiter', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($recdata[0]['re_step'] == 3){ ?>
 <div class="col-md-6 col-sm-8"><h3>You are updating your Recruiter Profile.</h3></div>

            <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Recruiter Profile.</h3></div>

            <?php }?>
            </div>
            <br>
            <br>           
            <br>
            <div class="container">
                <div class="row row4">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                
                            <li <?php if($this->uri->segment(1) == 'recruiter'){?> class="active init" <?php } ?>><a href="#">Basic Information</a></li>
                            
                             <li  class="custom-none <?php if($recdata[0]['re_step'] < '1'){echo "khyati";}?>"><a href="<?php echo base_url('recruiter/company_info_form'); ?>">Company Information</a></li>
                            
                             <li class="custom-none <?php if($recdata[0]['re_step'] < '2'){echo "khyati";}?>"><a href="<?php echo base_url('recruiter/rec_comp_address'); ?>">Company Address</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8">

                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>

                    <!--- middle section start -->
                     <div class="common-form common-form_border">
                     <h3>Basic Information</h3>
                 <?php echo form_open(base_url('recruiter/basic_information'), array('id' => 'basicinfo','name' => 'basicinfo','class' => 'clearfix')); ?>

                            

        <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>

                                
                    <fieldset>
                        <label>First Name:<span class="red">*</span></label>
                        <input name="first_name" tabindex="1" autofocus type="text" id="first_name"  placeholder="Enter First Name" value="<?php if($firstname){ echo $firstname; } else{ echo $userdata[0]['first_name']; } ?>" /><span id="fullname-error "></span>
                        <?php echo form_error('first_name'); ?>
                    </fieldset>
                    

                    <fieldset>
                        <label>Last Name:<span class="red">*</span></label>
                      <input name="last_name" type="text" tabindex="2" placeholder="Enter Last Name"
                      value="<?php if($lastname){ echo $lastname; } else{echo $userdata[0]['last_name'];} ?>" id="last_name" /><span id="fullname-error" ></span>
                      <?php echo form_error('last_name'); ?>
                    </fieldset>
                    

                    <fieldset>
                        <label>E-mail address:<span class="red">*</span></label>
                        <input name="email"  type="text" id="email" tabindex="3" placeholder="Enter Email"  value="<?php if($email){ echo $email; } else{echo $userdata[0]['user_email'];}?>" /><span id="email-error" ></span>
                        <?php echo form_error('email'); ?>
                    </fieldset>
                    
                    <fieldset>
                        <label>Phone number:</label>
                        <input name="phoneno" placeholder="Enter Phone Number" tabindex="4" value="<?php if($phone){ echo $phone; } ?>" type="text" id="phoneno"  /><span ></span>
                        <?php echo form_error('phoneno'); ?>
                    </fieldset>
                    

                    <fieldset class="hs-submit full-width">

                                 
                                    <input type="submit"  id="next" name="next" tabindex="5" value="Next">
                                  
                                    
                                </fieldset>
             </form>
            </div>
                    
                </div>
            </div>
        </div>
        </div>
      </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->


    <!-- Field Validation Js start -->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<!-- <script type="text/javascript" src="<?php //echo base_url('js/jquery.validate.js'); ?>"></script> -->
<!-- Field Validation Js End -->

<!-- <script>
                        
                        //select2 autocomplete start for Location
                        $('#searchplace').select2({
                            placeholder: 'Find Your Location',
                            maximumSelectionLength: 1,
                            ajax: {
                                url: "<?php echo base_url(); ?>recruiter/location",
                                dataType: 'json',
                                delay: 250,
                                processResults: function (data) {
                                    return {
                                        //alert(data);
                                        results: data
                                    };
                                },
                                cache: true
                            }
                        });
                        //select2 autocomplete End for Location


                    </script>


 --> 
<!--  <script type="text/javascript">
var jquery_validate = $.noConflict(true);
</script>
 -->

 <script type="text/javascript">

            //validation for edit email formate form

    //          jQuery.validator.addMethod("noSpace", function(value, element) { 
    //   return value == '' || value.trim().length != 0;  
    // }, "No space please and don't leave it empty");


    $.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Number, space and special character are not allowed");

            $(document).ready(function () { 

                //alert(111);

                $("#basicinfo").validate({

                    rules: {

                        first_name: {

                            required: true,
                            regx:/^[a-zA-Z]+$/,
                            //noSpace: true
                           
                        },

                         last_name: {

                            required: true,
                            regx:/^[a-zA-Z]+$/,
                            //noSpace: true
                           
                        },
                       
                      email: {
                            required: true,
                           
                            email: true,
                            remote: {
                                url: "<?php echo site_url() . 'recruiter/check_email' ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                        },

                        phoneno: {

                            number: true,
                             minlength: 8,
                           maxlength:15
                            
                            
                        },
                       
                    },

                    messages: {

                        first_name: {

                            required: "First name Is Required.",
                            
                        },

                        last_name: {

                            required: "Last name Is Required.",
                            
                        },

                         email: {
                            required: "Email id is required",
                            email: "Please enter valid email id",
                            remote: "Email already exists"
                        },

                        phoneno: {

                            required: "Phone Number Is Required.",
                            //phoneno: "Enter valid number.",
                        },
                       
                      

                    },

                });
                   });


  </script>
  <script>

                                        var data1 = <?php echo json_encode($de); ?>;

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
<script type="text/javascript">
function checkvalue(){
   //alert("hi");
  var searchkeyword=$.trim(document.getElementById('tags').value);
  var searchplace=$.trim(document.getElementById('searchplace').value);
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
     //alert('Please enter Keyword');
    return false;
  }
}
  
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script>
