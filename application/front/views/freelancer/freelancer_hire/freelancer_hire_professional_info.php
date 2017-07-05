<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->

   

<?php echo $header; ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">



<!-- pallavi code start 15-4 -->
   <?php if ($freehiredata[0]['free_hire_step'] == '3'){ 
     echo $freelancer_hire_header2_border; } ?>
<!-- pallavi code end 15-4 -->
<div class="js">
<body>
	<div id="preloader"></div>
	<section>
		
		<div class="user-midd-section" id="paddingtop_fixed">
			<div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>
                      
             <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $freehiredata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($freehiredata[0]['free_hire_step'] == 3){  ?>

           <div class="col-md-6 col-sm-6"><h3>You are updating your Freelancer Profile.</h3></div>  

                <?php }else{

             ?>
                      <div class="col-md-6 col-sm-6"><h3>You are making your Freelancer Profile.</h3></div>
                       <?php }?>
                      
            </div>
            <br>
            <br>
            <br>
            <div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="left-side-bar">
                                                    <ul class="left-form-each">
							<li class="custom-none"><a href="<?php echo base_url('freelancer_hire/freelancer_hire_basic_info'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('freelancer_hire/freelancer_hire_address_info'); ?>">Address Information</a></li>
                                <li <?php if($this->uri->segment(1) == 'freelancer_hire'){?> class="active init" <?php } ?>><a href="#">Professional Information</a></li>

                                
								
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
						<div class="common-form common-form_border ">
							<h3>Proessional Information</h3>
							<?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_professional_info_insert'), array('id' => 'professional_info1','name' => 'professional_info','class' => 'clearfix')); ?>

                     <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div>


                     	 <?php
                         $professional_info =  form_error('professional_info');
                         ?>  
								
                            	<fieldset class="full-width">
									<label>Professional Info:<span class="red">*</span></label>
									
									<textarea tabindex="1" autofocus name ="professional_info" id="professional_info" rows="6" cols="50" placeholder="Enter Professional Information" style="resize: none;overflow: auto;"><?php if($professional_info1){ echo $professional_info1; } ?></textarea>
									 <?php echo form_error('professional_info'); ?> 
									 
								</fieldset>
								<fieldset style="margin-top: 4%"" class="hs-submit full-width">
                                    

                                    
                                    <input type="submit" tabindex="2" id="next" name="next" value="Submit">
                                   
                                   
                                </fieldset>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		
		<?php echo $footer;  ?>
	</footer>
	
</body>
</div>
</html>

 <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>


   

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


 

<script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword = $.trim(document.getElementById('tags').value);
                            var searchplace = $.trim(document.getElementById('searchplace').value);
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>


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

<!-- <script> 

                        //select2 autocomplete start for Location
                        $('#searchplace').select2({

                            placeholder: 'Find Your Location',
                            maximumSelectionLength: 1,

                            ajax: {

                                url: "<?php echo base_url(); ?>freelancer/location",
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

                    </script> -->
<!-- pallavi 15-4 -->


<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});

});
</script>
<script type="text/javascript">
//alert(123);
            //validation for edit email formate form

jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");

$.validator.addMethod("regx", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Only space, only number and only specila characters are not allow");




            $(document).ready(function () { 

                $("#professional_info1").validate({

                    rules: {

                        professional_info: {

                            required: true,
                             regx:/^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]/

                            //noSpace: true
                           
                        },

                    },

                    messages: {

                        professional_info: {

                            required: "Professional Information Is Required."
                            
                        },
                    },

                });
                   });
  </script>
<script type="text/javascript"> 
 $(".alert").delay(3200).fadeOut(300);
</script>
