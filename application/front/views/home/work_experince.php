<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$userid= ($this->session->userdata['logged_in']['userid']);
} else {
header("location:../../registration/login");
}
?>
<div>
<div>
	<ul id="mainMenu">	
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
</div>
<!-- left-bar -->
<!-- /top-bar -->
	
	<!-- main content -->
				<h3>
					Work Experience
				</h3>
			<div>
				 <?php echo form_open_multipart(base_url('home/work_insert'), array('id' => 'workexp','name' => 'workexp')); ?>
				 	<?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>

					<div>
						<label>Job Title1:</label>
						<div>
							<input name="jobtitle1" type="text" id="jobtitle1"/>
						</div>
					</div>
					<?php echo form_error('jobtitle1'); ?>
					<div>
						<label>Company Name1:</label>
						<div>
							<input name="companyname1"  type="text" id="comapnyname1"/>
						</div>
					</div>
					<?php echo form_error('companyname1'); ?>
					<div>
						<label>Company Email1:</label>
						<div>
							<input name="companyemail1" type="text" id="companyemail1""/>
						</div>
					</div>
					<?php echo form_error('companyemail1"'); ?>
					<div>
						<label>Company Phone Number:</label>
						<div>
							<input name="companyphone1" type="text" id="companyphone1"/>
						</div>
					</div>
					<?php echo form_error('companyphone1'); ?>
					<div>
						<label>Start Date1:</label>
						<div>
							<input name="startdate1"  type="text" id="startdate1"/>
						</div>
					</div>
					<?php echo form_error('startdate1'); ?>
					<div>
						<label>End Date1:</label>
						<div>
							<input name="enddate1"  type="text" id="enddate1"/>
						</div>
					</div>
					<?php echo form_error('enddate1'); ?>
					<div>
						<label>CTC:</label>
						<div>
							<input name="ctc"  type="text" id="ctc"/><br/><br/>
						</div>
					</div>
					<?php echo form_error('ctc'); ?>
					<div>
						<label>Expected Salary:</label>
						<div>
							<input name="expectedsal"  type="text" id="expectedsal"/><br/><br/>
						</div>
					</div>
					<?php echo form_error('expectedsal'); ?>

					<div>
						<label>Certificate:</label>
						<div>
							<input type="file" name="certificate" id="certificate"><br/><br/>
						</div>
					</div>

					<div>
						<div class="col-md-3">
							<input type="submit"  id="submitworkexp" name="submitworkexp" value="save"><br/><br/>
						</div>
						
				<div >
					<input type="reset" class="btn btn-danger">
				</div>
			</div>

		</form>
	</div>
