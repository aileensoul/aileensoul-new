<!--sidebar start-->
<aside>
	<div id="sidebar"  class="nav-collapse ">
		<!-- sidebar menu start-->
		<ul class="sidebar-menu" id="nav-accordion">
			<!-- <p class="centered">
				<a href="
					<?php echo site_url('settings'); ?>">
					<?php                    if ($loged_in_user[0]['admin_role'] == 1) {                        ?>
					<img src="
						<?php echo site_url() . $this->config->item('profile_main_image') . $admin_image; ?>" class="img-circle" width="80">
						<?php                    } else {                        ?>
						<img src="
							<?php echo site_url() . $this->config->item('admin_thumb_upload_path') . $admin_image; ?>" class="img-circle" width="80">
							<?php                    }                    ?>
						</a>
					</p> -->

					<img src="<?php echo base_url('images/logo.png'); ?>" class="logo_image" width="100px" alt="Aileensoul">       

        
					<h5 class="centered">
						<?php echo $admin_name ?>
					</h5>
					<li class="mt">
						<a 
							<?php if ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?>  href="
							<?php echo site_url('dashboard'); ?>" title="Dashboard">
							<i class="fa fa-dashboard"></i>
							<span>Dashboard</span>
						</a>
					</li>
                                  
							
						
					
				
					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'settings' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('settings') ?>" title="Account settings">
							<i class="fa fa-wrench"></i>
							<span>Account settings</span>
						</a>
					</li>

					
						<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'sitesetting' || $this->uri->segment(1) == 'sem' || $this->uri->segment(1) == 'pages' || $this->uri->segment(1) == 'email_settings' || $this->uri->segment(1) == 'email_template' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="<?php echo site_url('sem'); ?>" title="Site Settings">
							<i class="fa fa-laptop"></i>
							<span>System Settings</span>
						</a>
						</li>
						
	
					
					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'contact_us' || $this->uri->segment(1) == 'contact_us' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="<?php echo site_url('contact_us'); ?>" title="inquiry">
							<i class="fa fa-university"></i>
							<span>Contact Us</span>
						</a>
						</li>


						<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'feedback' || $this->uri->segment(1) == 'feedback' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="<?php echo site_url('feedback'); ?>" title="inquiry">
							<i class="fa fa-university"></i>
							<span>Feedback</span>
						</a>
						</li>


					<li><a href="#">Management</a>
        			<ul class="sub">
					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'faq' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('faq'); ?>" title="FAQ Management">
							<i class="fa fa-users"></i>
							<span>FAQ Management</span>
						</a>
					</li>


					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'job' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('job'); ?>" title="Job Management">
							<i class="fa fa-users"></i>
							<span>Job Management</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'artistic' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('artistic'); ?>" title="artistic Management">
							<i class="fa fa-users"></i>
							<span>Artistic Management</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'freelancer_hire' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('freelancer_hire'); ?>" title="artistic Management">
							<i class="fa fa-users"></i>
							<span>Freelancer hire</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'freelancer_post_registration' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class="" 
							<?php } ?> href="
							<?php echo site_url('freelancer_post_registration'); ?>" title="freelancer_post_registration">
							<i class="fa fa-users"></i>
							<span>Freelancer Post</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'user_management' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('user_management'); ?>" title="recruiter_management">
							<i class="fa fa-users"></i>
							<span>User Management</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'recruiter_management' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""    
							<?php } ?> href="
							<?php echo site_url('recruiter_management'); ?>" title="Recruiter Management">
							<i class="fa fa-users"></i>
							<span>Recruiter Management</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'business_management' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('business_management'); ?>" title="business_management">
							<i class="fa fa-users"></i>
							<span>Business Management</span>
						</a>
					</li>

					 </ul>
    				</li>

					
					
    				<li><a href="#">Type</a>
        			<ul class="sub">

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'stream' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('stream'); ?>" title="degree stream Management">
							<i class="fa fa-users"></i>
							<span> stream </span>
						</a>
					</li>


					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'degree' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="
							<?php echo site_url('degree'); ?>" title="degree">
							<i class="fa fa-users"></i>
							<span>Degree</span>
						</a>
					</li>

					<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'business_type' || $this->uri->segment(1) == '' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""  
							<?php } ?> href="<?php echo site_url('business_type'); ?>" title="business_type">
							<i class="fa fa-university"></i>
							<span>Business Type</span>
						</a>
					</li>

						<li class="sub-menu">
						<a 
							<?php if ($this->uri->segment(1) == 'industry_type' || $this->uri->segment(1) == '' || $this->uri->segment(1) == '') { ?> class="active" 
							<?php } else { ?> class=""   
							<?php } ?> href="<?php echo site_url('industry_type'); ?>" title="business_type">
							<i class="fa fa-university"></i>
							<span>Industry Type</span>
						</a>
						</li>
					
					 </ul>
    				</li>


				
					
						
							
			</div>
		</aside>
		<!--sidebar end-->


s<link href="/admin/assets/css/menu-vertical.css" rel="stylesheet" type="text/css" />
<script src="/admin/assets/js/menu-vertical.js" type="text/javascript"></script>