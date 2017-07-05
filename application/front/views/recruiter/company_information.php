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
    <div class="js">
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
                                
                                <li class="custom-none"><a href="<?php echo base_url('recruiter/rec_basic_information'); ?>">Basic Information</a></li>
                             <li <?php if($this->uri->segment(1) == 'recruiter'){?> class="active init" <?php } ?>><a href="#">Company Information</a></li>
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
                                }
                                ?>
                    </div>
                     <!--- middle section start -->
			    <div class="common-form common-form_border">
                <h3>Company Information</h3>
				 <?php echo form_open(base_url('recruiter/company_info_store'), array('id' => 'basicinfo','name' => 'basicinfo','class' => 'clearfix')); ?>
                                

				 	<div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>


                    <?php
                         $comp_name =  form_error('comp_name');
                         $comp_email =  form_error('comp_email');
                         $comp_num =  form_error('comp_num');
                         $comp_project =  form_error('comp_project'); 
                        $other_activities =  form_error('other_activities');

                         ?>
                                
					<fieldset <?php if($comp_name) {  ?> class="error-msg" <?php } ?>>
						<label>Company Name:<span class="red">*</span></label>
						<input name="comp_name" tabindex="1" autofocus type="text" id="comp_name" placeholder="Enter Company Name"  value="<?php if($compname){ echo $compname; } ?>"/><span id="fullname-error"></span>
					</fieldset>
                    <?php echo form_error('comp_name'); ?>

                    <fieldset <?php if($comp_email) {  ?> class="error-msg" <?php } ?>>
						<label>Company Email:<span class="red">*</span></label>
							<input name="comp_email" type="text" tabindex="2" id="comp_email" placeholder="Enter Company Email" value="<?php if($compemail){ echo $compemail; } ?>" /><span id="fullname-error"></span>
					</fieldset>
                <?php echo form_error('comp_email'); ?>

					<fieldset <?php if($comp_num) {  ?> class="error-msg" <?php } ?>>
						<label>Company Number:</label>
						<input name="comp_num"  type="text" id="comp_num" tabindex="3" placeholder="Enter Comapny Number" value="<?php if($compnum){ echo $compnum; } ?>"/><span id="email-error"></span>
					</fieldset>
					<?php echo form_error('comp_num'); ?>

					<fieldset>
						<label>Company Website:</span></label>				
						<input name="comp_site"  type="text" id="comp_url" tabindex="4" placeholder="Enter Comapny Website" value="<?php if($compweb){ echo $compweb; } ?>" /><span ></span>
					</fieldset>
					

					<fieldset class="full-width">
						<label for="country-suggestions">Interview Process:</span></label>
                      

                         <textarea name ="interview" id="varmailformat" rows="4" cols="50" tabindex="5" placeholder="Enter Interview Process" style="resize: none;"><?php if($compservices){ echo $compservices; } ?></textarea>
                                      
					</fieldset>
					
                    <fieldset <?php if($comp_project) {  ?> class="error-msg" <?php } ?> class="full-width">
                        <label>Company best project:<!-- <span style="color:red">*</span> -->

                        <textarea tabindex="5" name ="comp_project" id="comp_project" rows="4" cols="50" placeholder="Enter Company Project" style="resize: none;"><?php if($comp_project1){ echo $comp_project1; } ?></textarea>
                        <?php ?> 
                    </fieldset>

                   

                    <fieldset <?php if($other_activities) {  ?> class="error-msg" <?php } ?> class="full-width">
                        <label>Other activities:<!-- <span style="color:red">*</span> --></label>
                       

                        <textarea name ="other_activities" tabindex="6" id="other_activities" rows="4" cols="50" placeholder="Enter Other Activities" style="resize: none;"><?php if($other_activities1){ echo $other_activities1; } ?></textarea>
                       
                    </fieldset>

					<fieldset class="hs-submit full-width">
                                   
                                  
                                    <input type="submit"  id="next" name="next" tabindex="7" value="Next">
                                 
                                    
                     </fieldset>
			</div>

		</form>		
	
                      </div>
                  
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <!-- footer start -->
    <?php echo $footer; ?>

  
     <!-- footer end -->
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

 <!-- <script type="text/javascript">
var jquery_validate_min = $.noConflict(true);
</script> -->

  <script type="text/javascript">

            //validation for edit email formate form

jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");


$.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Number, space and special character are not allowed");


            $(document).ready(function () { 

                $("#basicinfo").validate({

                    rules: {

                        comp_name: {

                            required: true,
                            regx:/^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]/
                            //noSpace: true
                           
                        },

                        
                       
                       comp_email: {

                            required: true,
                            email:true,
                             remote: {
                                url: "<?php echo site_url() . 'recruiter/check_email_com' ?>",
                                type: "post",
                                data: {
                                    email: function () {
                                        return $("#comp_email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                        },
                       
                        comp_num:{
                            
                            //minlength:10,
                            //maxlength:11,
                            number: true
                       },

                       
                    },

                    messages: {

                        comp_name: {

                            required: "Company Name Is Required.",
                            
                        },

                       

                         comp_email: {

                            required: "Email Address Is Required.",
                             email:"Please Enter Valid Email Id.",
                             remote: "Email already exists"
                        },

                        comp_num: {

                            required: "Phone no Is Required.",
                            
                        },
                        
                      
                        
                      
                    },

                });
                   });


  </script>
  <script>

                                        var data = <?php echo json_encode($demo); ?>;
//alert(data);
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
