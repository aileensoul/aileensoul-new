<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$userid= ($this->session->userdata['logged_in']['userid']);
} else {
header("location:../../registration/login");
}
?>


<!-- <?php
echo "Hello <b id='welcome'><i>" . $userid . "</i> !</b>";
echo "<br/>";
echo "<br/>";
?> -->
<div class="wrapper">
<div class="left-bar">
	<ul class="list-unstyled menu-parent" id="mainMenu">	
			<ul class="list-unstyled">
				<li><a href="home/basic_information">Basic information</a></li>
				<li><a href="home/address">Address</a></li>
				<li><a href="home/keyskills">Key Skills</a></li>
				<li><a href="home/applyfor">Apply For</a></li>
				<li><a href="home/work_experince">Work experience</a></li>
				<li><a href="home/qualification">Qualification</a></li>
				<li><a href="home/education">Eduction</a></li>
				<li><a href="home/interests">Interests</a></li>
				<li><a href="home/references">References</a></li>
			</ul>
	</ul>
</div>
<!-- left-bar -->
<!-- /top-bar -->
	
	<!-- main content -->
	<div class="main-content">
		<!-- panel -->
		<div class="panel panel-piluku">
			<div class="panel-heading">
				<h3 class="panel-title">
					Address
				</h3>
			</div>
			<div class="panel-body">
				 <?php echo form_open(base_url('home/address_insert'), array('id' => 'address','name' => 'address')); ?>

				 	<?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>

                                <div>
                                <select name="country" id="country">
							    <option value="">Select Country</option>
							    <?php
							    if(count($countries) > 0){
							    	foreach($countries as $cnt){
							  ?>
							        <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
							   <?php }}
							    ?>
							</select>
							</div>

					
 					<select name="state" id="state">
						<option value="">Select country first</option>
						</select>

						<select name="city" id="city">
						    <option value="">Select state first</option>
						</select>

 						<div>
						<label>Area:</label>
						<div>
							<select name="area" id="area">
       						 <option value="">Select Area</option>
        					</select><span id="area-error"></span>
						</div>
					</div>
					 <?php echo form_error('area'); ?> 
					
					<div>
						<label>Pincode:</label>
						<div>
							<input name="pincode"  type="text" id="pincode" onblur="return phone_no();"/><span id="pincode-error"></span><br/><br/>
						</div>
					</div>
					<?php echo form_error('pincode'); ?>

						<div>
						<label>Address:</label>
							<div>
					<textarea id="address"  name="address" ></textarea><span id="address-error"></span><br/><br/>
						</div>
						<?php echo form_error('address'); ?>
					</div>

					<div>
						<div class="col-md-3">
							<input type="submit" id="submitaddress" name="submitaddress" value="save"><br/><br/>
						</div>
						
				<div >
					<input type="reset" class="btn btn-danger">
				</div>
			</div>

		</form>
		<hr />	
	</div>
</div>
</div>			
</div>  
<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "home/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "home/ajax_data"; ?>',
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
