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
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_address'); ?>">Address Info</a></li>
								<li><a href="<?php echo base_url('edit_freelancer_post/post_edit_professional'); ?>">Professional Info</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_rate'); ?>">Rate</a></li>
                                <li><a href="<?php echo base_url('edit_freelancer_post/post_edit_avability'); ?>">Add Your Avability</a></li>
								<li <?php if($this->uri->segment(1) == 'edit_freelancer_post'){?> class="active" <?php } ?>><a href="#"> Education</a></li>		    
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
							<h3>Education Info</h3>
                          <?php echo form_open(base_url('edit_freelancer_post/post_edit_education_insert'), array('id' => 'freelancer_post_education','name' => 'freelancer_post_education','class' => 'clearfix')); ?>

                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                            <?php
	                         $degree =  form_error('degree');
	                         $stream =  form_error('stream');
	                         $univercity =  form_error('univercity');
	                         $collage =  form_error('collage');
	                         $percentage =  form_error('percentage'); 
	                         $passingyear =  form_error('passingyear');
	                         $address =  form_error('address'); 

                         ?>
                                <fieldset <?php if($degree) {  ?> class="error-msg" <?php } ?>>
									<label>Degree:<span style="color:red">*</span></label>
									 <select name="degree">
									  <option value="<?php echo $freelancerpostdata[0]['freelancer_post_degree'] ?>"><?php echo $freelancerpostdata[0]['freelancer_post_degree'] ?></option>
 									 <option value="B.tech">B.tech</option>
                                      </select>
                                      <?php echo form_error('degree'); ?> 
							    </fieldset>
							    <fieldset <?php if($stream) {  ?> class="error-msg" <?php } ?>>
									<label>Stream:<span style="color:red">*</span></label>
									 <select name="stream">
									 <option value="<?php echo $freelancerpostdata[0]['freelancer_post_stream'] ?>"><?php echo $freelancerpostdata[0]['freelancer_post_stream'] ?></option>
 									 <option value="Computer">Computer</option>
                                      </select>
                                      <?php echo form_error('stream'); ?>  
							    </fieldset>
                                 <fieldset <?php if($univercity) {  ?> class="error-msg" <?php } ?>>
									<label>University:<span style="color:red">*</span></label>
									 <select name="univercity">
									 <option value="<?php echo $freelancerpostdata[0]['freelancer_post_univercity'] ?>"><?php echo $freelancerpostdata[0]['freelancer_post_univercity'] ?></option>
 									 <option value="Saurashtra University">Saurashtra University</option>
                                      </select>
                                      <?php echo form_error('univercity'); ?> 
							    </fieldset>
                                 <fieldset <?php if($collage) {  ?> class="error-msg" <?php } ?>>
									<label>College:<span style="color:red">*</span></label>
									 <select name="collage">
									 <option value="<?php echo $freelancerpostdata[0]['freelancer_post_collage'] ?>"><?php echo $freelancerpostdata[0]['freelancer_post_collage'] ?></option>
 									 <option value="L.D.R.P">L.D.R.P</option>
                                      </select>
                                      <?php echo form_error('collage'); ?> 
							    </fieldset>
						        <fieldset <?php if($percentage) {  ?> class="error-msg" <?php } ?>>
									<label>Percentage:<span style="color:red">*</span></label>
									<input type="text" name="percentage" value="<?php echo $freelancerpostdata[0]['freelancer_post_percentage'] ?>">
									<?php echo form_error('percentage'); ?>
								</fieldset>
                        		<fieldset <?php if($passingyear) {  ?> class="error-msg" <?php } ?>>
									<label>Year Of Passing:<span style="color:red">*</span></label>
									 <select name="passingyear">
									 <option value="<?php echo $freelancerpostdata[0]['freelancer_post_passingyear'] ?>"><?php echo $freelancerpostdata[0]['freelancer_post_passingyear'] ?></option>
 									 <option value="2010">2010</option>
 									 <option value="2011">2011</option>
                                      </select> 
                                      <?php echo form_error('passingyear'); ?>
							    </fieldset>
								<fieldset class="full-width">
									<label>Postal Address:<span style="color:red">*</span></label>

									<?php echo form_textarea(array('name' => 'interview', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($freelancerpostdata[0]['freelancer_post_eduaddress']))); ?>
									<?php echo form_error('address'); ?>
								</fieldset>
                                <fieldset class="hs-submit full-width">
									<input type="submit" name="education_submit" value="Save">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<div class="footer text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-logo">
							<a href="<?php echo base_url('dashboard') ?>"><img src="images/logo-white.png"></a>
						</div>
						<ul>
							<li>E-912 Titanium City Center Anandngar Ahmedabad-380015</li>
							<li><a href="mailto:AileenSoul@gmail.com">AileenSoul@gmail.com</a></li>
							<li>+91 903-353-8102</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
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