<!--start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
   <?php if($artdata[0]['art_step'] == 4){?>
    <?php echo $art_header2_border; }?>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    <!-- END HEADER -->
    <div class="js">
    <body class="page-container-bg-solid page-boxed">
    <div id="preloader"></div>


      <section>
        <div class="user-midd-section" id="paddingtop_fixed">
           <div class="common-form1">
             <div class="row">
             <div class="col-md-3 col-sm-4"></div>


              <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $artdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($artdata[0]['art_step'] == 4){ ?>


        <div class="col-md-6 col-sm-8"><h3>You are updating your Artistic Profile.</h3></div>
             <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Artistic Profile.</h3></div>
                        <?php }?>
            </div>
         </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('artistic/art_basic_information_update'); ?>">Basic Information</a></li>

                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active init" <?php } ?>><a href="#">Address</a></li>

                                <li class="custom-none <?php if($artdata[0]['art_step'] < '2'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/art_information'); ?>">Art Information</a></li>

                                <li class="custom-none <?php if($artdata[0]['art_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/art_portfolio'); ?>">Portfolio</a></li>

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
                                        }?>
                    </div>

                        <div class="common-form common-form_border">
                         <h3>
                           Address
                        </h3>
                       
                            <?php echo form_open(base_url('artistic/art_address_insert'), array('id' => 'address','name' => 'address', 'class' => 'clearfix')); ?>
<!-- 
                            <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div> -->


                            <?php
                             $country =  form_error('country');
                             $state =  form_error('state');
                             //$address =  form_error('address');
                         ?>
                                <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
								<label>Country:<span style="color:red">*</span></label>
								
        								<select name="country" id="country" tabindex="1" autofocus>
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
								    <label>state:<span style="color:red">*</span></label>
    								<select name="state" id="state" tabindex="2">
        							<?php
                                          if($state1)

                                            {
                                            foreach($states as $cnt){
                                                 
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$state1) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
                                              
                                                <?php
                                                } }
                                              
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
                               

                                <fieldset>
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
								

                                <fieldset <?php if($pincode) {  ?> class="error-msg" <?php } ?>>
									<label>Pincode:</label>
									<input name="pincode"  type="text" id="pincode" tabindex="4" placeholder="Enter Pincode" value="<?php if($pincode1){ echo $pincode1; } ?>"/><span id="pincode-error"></span>
                                    <?php echo form_error('pincode'); ?>
									</fieldset>
								

									<!-- <fieldset class="full-width">
									<label>Postal Address:<span style="color:red">*</span></label>
								

                                <textarea id="textarea" name="address" tabindex="5" style="resize: none;min-height: 18%;"><?php //if($address1){ echo $address1; } ?></textarea>
                                    <?php //echo form_error('address'); ?>
                                    <label id="address-error"></label>

                                
								</fieldset>  -->

                                 <fieldset class="hs-submit full-width">
                                    

                                   
                                  <!--   <a href="<?php //echo base_url('artistic/art_basic_information_update'); ?>">Previous</a> -->
                                    
                                    <input type="submit"  id="next" name="next" tabindex="6" value="Next">
                                   
                                </fieldset>

                            </form>
                        </div>
                    </div>

                    <!-- middle section end -->

                </div>
            </div>
        </div>
    </section>
   <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    

</div>

<footer>
        
        <?php echo $footer;  ?>
    </footer>

 <!-- <script type="text/javascript">
     var textarea = document.getElementById("textarea");

textarea.onkeyup = function(evt) {
    this.scrollTop = this.scrollHeight;
}
 </script> -->

  <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
  
  <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<!-- script for skill textbox automatic end (option 2)-->
<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($city_data); ?>;
// alert(data);

        
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
<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($city_data); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
});
  
</script>

<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($city_data); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
});
  
</script>
<script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword =$.trim(document.getElementById('tags').value);
                            var searchplace = $.trim(document.getElementById('searchplace').value);
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>

<script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>
 <!-- <script>
//select2 autocomplete start for skill
                                                $('#searchskills').select2({

                                                    placeholder: 'Find Your Skills',

                                                    ajax: {

                                                        url: "<?php echo base_url(); ?>artistic/keyskill",
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

                                                        url: "<?php echo base_url(); ?>artistic/location",
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
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>



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
                url:'<?php echo base_url() . "artistic/ajax_data"; ?>',
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

<script type="text/javascript">

            //validation for edit email formate form


// jQuery.validator.addMethod("noSpace", function(value, element) { 
//       return value == '' || value.trim().length != 0;  
//     }, "No space please and don't leave it empty");

// $.validator.addMethod("regx", function(value, element, regexpr) {          
//     //return value == '' || value.trim().length != 0; 
//      if(!value) 
//             {
//                 return true;
//             }
//             else
//             {
//                   return regexpr.test(value);
//             }
//      // return regexpr.test(value);
// }, "Only space, only number and only special characters are not allow");


            $(document).ready(function () { 

                $("#address").validate({

                    rules: {

                        country: {

                            required: true,
                         
                        },

                         state: {

                            required: true,
                            
                          
                        },
                      
                        // address: {

                        //     required: true,
                        //        regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                        //     //noSpace: true
                            
                        // },
                        
                      

                    },

                    messages: {

                        country: {

                            required: "Country Is Required.",
                            
                        },

                        state: {

                            required: "State Is Required.",
                            
                        },
                       
                        // address: {

                        //     required: "Address Is Required.",
                            
                        // },

                       
                },

                });
                   });
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

</body>
</html>

