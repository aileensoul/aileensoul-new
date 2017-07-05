<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/media.css'); ?>">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i" rel="stylesheet"> 
</head>
<body>
	<header>
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-5">
						<div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="images/logo.png"></a></div>
					</div>
					<div class="col-md-8 col-sm-7">
						<ul>
							<li><a href="<?php echo base_url('dashboard') ?>">Dashborad</a></li>
							<li><a href="#">Notification <i class="fa fa-bell-slash-o" aria-hidden="true"></i></a></li>
							<li><a href="#">Inbox <i class="fa fa-commenting" aria-hidden="true"></i></a></li>
							<li><a href="#">Friend Request <i class="fa fa-user" aria-hidden="true"></i></a></li>
							<li><a href="#">Masari Odedara <i class="fa fa-angle-down" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="freelancer-banner">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<form>
						<h2>Find your job here</h2>
							<fieldset><input type="text" name="" placeholder="Enter your keyword....">
							</fieldset>
							<fieldset><input type="text" name="" placeholder="Find Location">
							</fieldset>
							<fieldset class="submit"><input type="submit" value="Search">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="user-midd-section" id="paddingtop_fixed">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="left-side-bar">
							<ul>
							<li><a href="<?php echo base_url('edit_freelancer_post'); ?>">Basic Info</a></li>
                                <li <?php if($this->uri->segment(1) == 'edit_freelancer_post'){?> class="active" <?php } ?>><a href="#">Address Info</a></li>
								<li><a href="<?php echo base_url('edit_freelancer_post/post_edit_professional'); ?>">Professional Info</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_rate'); ?>">Rate</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_avability'); ?>">ADD Your Avability</a></li>
								<li><a href="<?php echo base_url('edit_freelancer_post/post_edit_education'); ?>"> Education</a></li>		    
								<li><a href="<?php echo base_url('edit_freelancer_post/post_edit_portfolio'); ?>">Portfolio</a></li>
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
							<h3>Address Info</h3>
                            <?php echo form_open(base_url('edit_freelancer_post/post_edit_address_insert'), array('id' => 'post_edit_address','name' => 'post_edit_address','class' => 'clearfix')); ?>

                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 
                            <?php
	                         $country =  form_error('country');
	                         $state =  form_error('state');
	                         $city =  form_error('city');
	                         $postaladdress =  form_error('postaladdress');
	                         $pincode =  form_error('pincode'); 

                         ?> 
								
                                <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
									<label>Country:<span style="color:red">*</span></label>
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
                                      <?php echo form_error('country'); ?>
							    </fieldset>

							    <fieldset <?php if($state) {  ?> class="error-msg" <?php } ?>>
									<label>State:<span style="color:red">*</span></label>
									 <select name="state" id="state">
 									 <option value="">Select country first</option>
                                      </select>
                                      <?php echo form_error('state'); ?> 
							    </fieldset>
								
                                <fieldset <?php if($city) {  ?> class="error-msg" <?php } ?>>
									<label>City:<span style="color:red">*</span></label>
									<select name="city" id="city">
    								<option value="">Select state first</option>
									</select>
									<?php echo form_error('city'); ?>
								</fieldset>

                                <fieldset <?php if($pincode) {  ?> class="error-msg" <?php } ?>>
									<label>Pincode:<span style="color:red">*</span></label>
									<input type="text" name="pincode" value="<?php echo $freelancerpostdata[0]['freelancer_post_pincode']?>">
									<?php echo form_error('pincode'); ?>
								</fieldset>
								
								<fieldset class="full-width">
									<label>Postal Address:<span style="color:red">*</span></label>

									<?php echo form_textarea(array('name' => 'interview', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancerpostdata[0]['freelancer_post_address']))); ?><br>
									
									<?php echo form_error('postaladdress'); ?>
								</fieldset>
								
                                <fieldset class="hs-submit full-width">
									
									<input type="submit" name="" value="Save">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "edit_freelancer_post/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "edit_freelancer_post/ajax_data"; ?>',
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
	<footer>
		
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
					</div>
					<div class="col-md-6 col-sm-6">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
</body>
</html>