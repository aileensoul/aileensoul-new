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
                             <li class="custom-none"><a href="<?php echo base_url('recruiter/company_info_form'); ?>">Company Information</a></li>
                             <li <?php if($this->uri->segment(1) == 'recruiter'){?> class="active init" <?php } ?>><a href="#">Company Address</a></li>
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
                      <h3>Company Address</h3>
                 <?php echo form_open(base_url('recruiter/comp_address_store'), array('id' => 'basicinfo','name' => 'basicinfo','class' => 'clearfix')); ?>

                              <!-- <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field </span>
                                </div> -->

                   <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>
                     

                    <?php
                         $country =  form_error('country');
                         $state =  form_error('state');
                         $city =  form_error('city');
                         $postal_address =  form_error('postal_address');
                         

                         ?>
                                
                    <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
                        <label>Country:<span class="red">*</span></label>
                                
                                        <select tabindex="1" autofocus name="country" id="country">
                                        <option value="">Select Country</option>
                                         <?php
                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){
                                          
                                            if($country1)
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>" <?php if($cnt['country_id']==$country1) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
                                             
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
                                    </select><span id="country-error"></span>
                                 <?php echo form_error('country'); ?>
                    </fieldset>

                   <fieldset <?php if($state) {  ?> class="error-msg" <?php } ?>>
                        <label>State:<span class="red">*</span></label>
                        <select name="state" id="state" tabindex="2">
                         <?php
                                           if($state1){
                                            foreach($states as $cnt)

                                            {
                                               
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$state1) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
                                              
                                                <?php
                                                }
                                              }
                                                else
                                                {
                                            ?>
                                                 <option value="">Select country first</option>
                                                  <?php
                                            
                                            }
                                            ?>
                                        
                        </select><span id="state-error"></span>
                        <?php echo form_error('state'); ?>
                 </fieldset>
                     

                      <fieldset <?php if($city) {  ?> class="error-msg" <?php } ?> class="full-width">
                        <label> City:</label>
                                    <select name="city" id="city" tabindex="3">
                                     <?php
                                    
                                                if($city1)

                                            {
                                                foreach($cities as $cnt){ 
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$city1) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

                                                <?php
                                                } }
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

                                                else
                                                {
                                            ?>
                                        <option value="">Select state first</option>

                                         <?php
                                            
                                            }
                                            ?>
                                    </select><span id="city-error"></span>
                                    <?php echo form_error('city'); ?> 
                    </fieldset>
                    
                    <fieldset <?php if($postal_address) {  ?> class="error-msg" <?php } ?> class="full-width">
                        <label> Postal address:<span class="red">*</span></label>
                        <textarea name="postal_address" id="postal_address" tabindex="4" rows="4" cols="50"  placeholder="Enter Address" style="resize: none;"><?php if($postal_address1){ echo $postal_address1; } ?></textarea>                        
                        <?php echo form_error('postal_address'); ?> 
                    </fieldset>

                    
                     <fieldset class="hs-submit full-width">
                                   

                                
                                   
                                    <input type="submit"  id="submit" name="submit" tabindex="5" value="Submit">
                                    
                    </fieldset>

                  
            </div>
             </form>
                   
                    <!--- middle section end -->
                       
                       
                        
                       
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
    <script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>


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
<!-- script for country,state,city start -->

<!-- <script type="text/javascript">
var jquery_validate_min = $.noConflict(true);
</script> -->

<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        //alert(countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job_profile/ajax_data"; ?>',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job_profile/ajax_data"; ?>',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
<!-- script for country,state,city end -->


 <script type="text/javascript">

            //validation for edit email formate form
            jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");

            $.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Only space, only number and only specila characters are not allow");

            $(document).ready(function () { 

                $("#basicinfo").validate({

                    rules: {

                        country: {

                            required: true,
                           
                        },

                        state: {

                            required: true,
                           
                        },
                       
                        
                       
                        postal_address:{
                            required:true,
                            regx:/^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]/
                           // noSpace: true
                           
                       },

                        
                            
                    },

                    messages: {

                        country: {

                            required: "First name Is Required.",
                            
                        },

                        state: {

                            required: "Last name Is Required.",
                            
                        },

                       

                        postal_address: {

                            required: "Postal Address Is Required.",
                            
                        },

                        
                    },

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
