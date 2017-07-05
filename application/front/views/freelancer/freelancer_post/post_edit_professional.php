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
							<li><a href="<?php echo base_url('edit_freelancer_post'); ?>">Basic Information</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_address'); ?>">Address Information</a></li>
								<li <?php if($this->uri->segment(1) == 'edit_freelancer_post'){?> class="active" <?php } ?>><a href="#">Professional Information</a></li>
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
							<h3>Proessional Information</h3>
							<?php echo form_open(base_url('edit_freelancer_post/post_edit_professional_insert'), array('id' => 'post_edit_address','name' => 'post_edit_address','class' => 'clearfix')); ?>

                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                            <?php
	                         $field =  form_error('field');
	                         $area =  form_error('area'); 

                         ?>
                            <fieldset <?php if($field) {  ?> class="error-msg" <?php } ?>>
								<label>Field:<span style="color:red">*</span></label>
								<input type="text" name="field" value="<?php echo $freelancerpostdata[0]['freelancer_post_field'] ?>">
								<?php echo form_error('field'); ?>
							</fieldset>
							<fieldset <?php if($area) {  ?> class="error-msg" <?php } ?>>
									<label>What Is Your Skills?:<span style="color:red">*</span></label>
									<input type="text" name="area" value="<?php echo $freelancerpostdata[0]['freelancer_post_area'] ?>">
									<?php echo form_error('area'); ?>
							</fieldset>
                            <fieldset class="full-width">
								<label>Describe Your Skill In Brief:<span style="color:red">*</span></label>
								<?php echo form_textarea(array('name' => 'interview', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancerpostdata[0]['freelancer_post_skill_description']))); ?><br>
									
								<?php echo form_error('skill_description'); ?>
							</fieldset>
                            <fieldset class="hs-submit full-width">
								<input type="submit" name="edit_professional" value="Save">
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

	<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
</body>
</html>