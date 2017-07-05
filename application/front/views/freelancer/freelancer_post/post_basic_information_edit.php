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
		<div class="user-midd-section">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="left-side-bar">
					<ul>
							<li <?php if($this->uri->segment(1) == 'edit_freelancer_post'){?> class="active" <?php } ?>><a href="#">Basic Info</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_address'); ?>">Address Info</a></li>
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
							<h3>Basic Information</h3>
							
							<?php echo form_open(base_url('edit_freelancer_post/post_basic_information_edit_insert'), array('id' => 'freelancer_post_basicinfo_edit','name' => 'freelancer_post_basicinfo_edit','class' => 'clearfix')); ?>
                           
                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                            <?php
	                         $fullname =  form_error('fullname');
	                         $username =  form_error('username');
	                         $skypeid =  form_error('skypeid');
	                         $email =  form_error('email');
	                         $phoneno =  form_error('phoneno'); 

                         ?>

								<fieldset <?php if($fullname) {  ?> class="error-msg" <?php } ?>>
									<label>Full Name:<span style="color:red">*</span></label>
									<input type="text" name="fullname" value="<?php echo $freelancerpostdata[0]['freelancer_post_fullname'];?>">
									<?php echo form_error('fullname'); ?>
								</fieldset>

								<fieldset <?php if($username) {  ?> class="error-msg" <?php } ?>>
									<label>User Name:<span style="color:red">*</span></label>
									<input type="text" name="username" value="<?php echo $freelancerpostdata[0]['freelancer_post_username'];?>">
									<?php echo form_error('username'); ?>
								</fieldset>

                                <fieldset <?php if($email) {  ?> class="error-msg" <?php } ?>>
									<label>Email:<span style="color:red">*</span></label>
									<input type="text" name="email" value="<?php echo $freelancerpostdata[0]['freelancer_post_email'];?>">
									<?php echo form_error('email'); ?>
								</fieldset>

                                <fieldset <?php if($skypeid) {  ?> class="error-msg" <?php } ?>>
									<label>Skype Id</label>
									<input type="text" name="skypeid" value="<?php echo $freelancerpostdata[0]['freelancer_post_skypeid'];?>">
									<?php echo form_error('skypeid'); ?>
								</fieldset>
								
								<fieldset <?php if($phoneno) {  ?> class="error-msg" <?php } ?> class="full-width">
									<label>Phone Number:<span style="color:red">*</span></label>
									<input type="text" name="phoneno" value="<?php echo $freelancerpostdata[0]['freelancer_post_phoneno'];?>">
									<?php echo form_error('phoneno'); ?>
								</fieldset>
								
								<fieldset class="hs-submit full-width">
									
									<input type="submit" name="post_freelancer_edit" value="Save">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
</body>
</html>