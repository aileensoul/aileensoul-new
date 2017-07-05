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
								
							<li><a href="<?php echo base_url('freelancer_hire_edit/freelancer_hire_basic_info'); ?>">Basic Information</a></li>
                                <li><a href="<?php echo base_url('freelancer_hire_edit/freelancer_hire_address_info'); ?>">Address Information</a></li>
								<li <?php if($this->uri->segment(1) == 'freelancer_hire_edit'){?> class="active" <?php } ?>><a href="#">Professional Information</a></li>
                               <li><a href="<?php echo base_url('freelancer_hire_edit/freelancer_hire_payment'); ?>">Payments</a></li>
							    <li><a href="<?php echo base_url('freelancer_hire_edit/freelancer_hire_requirement_detail'); ?>">Requirmeant-details</a></li>
								
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
							<?php echo form_open_multipart(base_url('freelancer_hire_edit/freelancer_hire_professional_info_edit'), array('id' => 'address_info','name' => 'address_info','class' => 'clearfix')); ?>

                     <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                     <?php
                         $professional_info =  form_error('professional_info');
                         ?>
								
                            <fieldset class="full-width">
								<label>Professional Information:<span style="color:red">*</span></label>
								<?php echo form_textarea(array('name' => 'professional_info', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancer[0]['professional_info']))); ?>
							</fieldset>
								<fieldset class="hs-submit full-width">
								<input type="submit" name="" value="Submit">
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