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
					Basic information
				</h3>
			</div>
			<div class="panel-body">
				 <?php echo form_open(base_url('home/basic_information'), array('id' => 'basicinfo','name' => 'basicinfo')); ?>

				 	<?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                               
					<div>
						<label class="col-sm-2 control-label">First Name:</label>
						<div class="col-sm-8">
							<input name="firstname" type="text" id="firstname" /><span id="fullname-error"></span>
						</div>
					</div>
                <?php echo form_error('firstname'); ?>
                <div>
						<label class="col-sm-2 control-label">Last Name:</label>
						<div class="col-sm-8">
							<input name="lastname" type="text" id="lastname" /><span id="lastname-error"></span>
						</div>
					</div>
                <?php echo form_error('lastname'); ?>
					<div>
						<label class="col-sm-2 control-label">E-mail address:</label>
						<div class="col-sm-8">
							<input name="email"  type="text" id="email" class="form-control"  /><span id="email-error"></span>
						</div>
					</div>
					<?php echo form_error('email'); ?>
					<div>
						<label for="country-suggestions">Phone number:</label>
						<div>
							<input name="phoneno"  type="text" id="phoneno" /><span ></span>
						</div>
					</div>
					<?php echo form_error('phoneno'); ?>
					<div>
						<label>Website:</label>
						<div>
							<input name="website"  type="text" id="website" /><span ></span>
						</div>
					</div>
					
					<div>
						<label>Photo:</label>
						<div>
							<input type="file" name="image" id="image"><br/><br/>
						</div>
					</div>
					<?php echo form_error('image'); ?>

					<div>
						<div class="col-md-3">
							<input type="submit" class="btn btn-success pull-right" id="submit" name="submit" value="save"><br/><br/>
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