

<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->

   

<?php echo $header; ?>

<link rel="stylesheet" href="<?php echo base_url('css/select2-4.0.3.min.css'); ?>">

<body>
	
	<section>
		<div class="user-midd-section" id="paddingtop_fixed">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="left-side-bar">
							<ul>
							<li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_basic_info'); ?>">Basic Information</a></li>

                                <li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_address_info'); ?>">Address Information</a></li>

								<li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_professional_info'); ?>">Professional Information</a></li>

                                <li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_payment'); ?>">Payment For Freelancer</a></li>
                                
							    <li <?php if($this->uri->segment(1) == 'freelancer_hire'){?> class="active" <?php } ?>><a href="#">Requirmeant-details</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-md-9 col-sm-9">
					<div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>

						<div class="common-form">
							<h3>Requirement Details</h3>
							 <?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_requirement_detail_insert'), array('id' => 'requirement_info','name' => 'requirement_info','class' => 'clearfix')); ?>

                      <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                      <?php
                         $fields_req =  form_error('fields_req');
                         $area_req =  form_error('area_req');
                         $req_skill =  form_error('req_skill');
    ?>
                <fieldset <?php if($fields_req) {  ?> class="error-msg" <?php } ?>>
                  <label>Fields Of Requirmeant:<span style="color:red">*</span></label>
                   <select name="fields_req" id="fields_req">
                  <option value="">Select Fields of Requirement</option>
                  <?php
                                            if(count($category) > 0){
                                                foreach($category as $cnt){
                                          
                                            if($fields_req1)
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['category_id']; ?>" <?php if($cnt['category_id']==$fields_req1) echo 'selected';?>><?php echo $cnt['category_name'];?></option>
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                              
                                                  <option value="<?php echo $cnt['category_id']; ?>"><?php echo $cnt['category_name'];?></option> 
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
              </select>
              <?php echo form_error('fields_req'); ?>
                  </fieldset>


                 <fieldset <?php if($area_req) {  ?> class="error-msg" <?php } ?>>
                  <label>Area Of Requirmeant:<span style="color:red">*</span></label>
                   <select name="area_req" id="area_req">
                  <?php
                                          if($area_req1)

                                            {
                                            foreach($subcategory as $cnt){
                                                
    
                                              ?>

                                                 <option value="<?php echo $cnt['sub_category_id']; ?>" <?php if($cnt['sub_category_id']==$area_req1) echo 'selected';?>><?php echo $cnt['sub_category_name'];?></option>
    
                                                <?php
                                                } }
                                              
                                                else
                                                {
                                            ?>
                                                 <option value="">Select Fields Of Requirmeant first</option>
                                                  <?php
                                            
                                            }
                                            ?>
                </select>
                <?php echo form_error('area_req'); ?>
                  </fieldset>


    						

                    <fieldset <?php if($req_skill) {  ?> class="error-msg" <?php } ?>>
									<label>Require Skill:<span style="color:red">*</span></label>
		

									 <select class="" name="req_skill[]" id="req_skill" multiple="multiple" required>

            
                                	</select>
									<?php echo form_error('req_skill'); ?>
								</fieldset>
								 

    
                  <fieldset>
									<label>Require Experience:</label>
									<input type="text" name="req_experience" id="req_experience" placeholder="Enter Experience" value="<?php if($req_experience1){ echo $req_experience1; } ?>">
									 <?php  ?>
								</fieldset>
								

                  <fieldset>
									<label>Require Person:</label>
									<input type="text" name="req_person" id="req_person" placeholder="Enter Person" value="<?php if($req_person1){ echo $req_person1; } ?>">
									<?php ?>
								</fieldset>
								 
                                
								<fieldset class="hs-submit full-width">
                           

                                    <input type="reset">
                                     <a href="<?php echo base_url('freelancer_hire/freelancer_hire_payment'); ?>">Previous</a>
                                    
                                    <input type="submit"  id="submit" name="submit" value="submit">
                                    
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
</html>



  <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>



<script type="text/javascript">
$(document).ready(function(){
    $('#fields_req').on('change',function(){ 
        var categoryID = $(this).val();
        if(categoryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "freelancer_hire/ajax_data"; ?>',
                data:'category_id='+categoryID,
                success:function(html){
                    $('#area_req').html(html);
                    
                }
            }); 
        }else{
            $('#area_req').html('<option value="">Select Field of Requirement first</option>');
             
        }
    });
    
});
</script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#requirement_info").validate({

                    rules: {

                        fields_req: {

                            required: true,
                           
                        },

                         area_req: {

                            required: true,
                            
                        },

                         req_skill: {

                            required: true,
                             
                        },
                       
                    },

                    messages: {

                        fields_req: {

                            required: "Fields Is Required.",
                            
                        },

                        area_req: {

                            required: "Area Is Required.",
                            
                        },
                        req_skill: {

                            required: "Skill Is Required.",
                            
                        },

                    },

                });
                   });
  </script>

  <!-- script for skill textbox automatic start (option 2)-->

<script src="<?php echo base_url('js/select2-4.0.3.min.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>
//select2 autocomplete start for skill
$('#req_skill').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>freelancer_hire/keyskill",
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

</script>
