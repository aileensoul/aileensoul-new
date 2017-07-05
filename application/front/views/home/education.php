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
	</ul>
</div>
<!-- left-bar -->
<!-- /top-bar -->
	
	<!-- main content -->
				<h3>
					Education
				</h3>
			<div>
				 <?php echo form_open(base_url('home/education_insert'), array('id' => 'education','name' => 'education')); ?>
				 	<!-- <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?> -->

					<div>
						<label>Degree:</label>
						<div>
							<select name="degree" id="degree">
       						 <option value="">Select Degree</option>
        					</select><span id="state-error"></span>
						</div>
					</div>
					<!-- <?php echo form_error('degree'); ?> -->
					<div>
						<label>Stream:</label>
						<div>
							<select name="stream" id="stream">
       						 <option value="">Select Stream</option>
        					</select>
						</div>
					</div>
					<!-- <?php echo form_error('stream'); ?> -->
					<div>
						<label>Univercity Name:</label>
						<div>
							<input name="univercityname"  type="text" id="univercityname"/>
						</div>
					</div>
					<?php echo form_error('univercityname'); ?>
					<div>
						<label>Institute Name:</label>
						<div>
							<input name="institutename"  type="text" id="institutename"/>
						</div>
					</div>
					<?php echo form_error('institutename'); ?>

					<div>
						<label>Grade:</label>
						<div>
							<select name="grade" id="grade">
       						 <option value="">Select Stream</option>
       						 <option value="A">A</option>
       						 <option value="B">B</option>
       						 <option value="C">C</option>
       						 <option value="D">D</option>
        					</select>
						</div>
					</div>
					 <?php echo form_error('grade'); ?> 

					<div>
						<label>Year of Passing:</label>
						<div>
							<input name="yearpassing"  type="text" id="yearpassing"/>
						</div>
					</div>
					<?php echo form_error('yearpassing'); ?>
					<div>
						<label>Percentage:</label>
						<div>
							<input name="percentage"  type="text" id="percentage"/><br/><br/>
						</div>
					</div>
					<?php echo form_error('percentage'); ?>
					<div>
						<label>Certificate:</label>
						<div>
							<input type="file" name="certi_edu" id="certi_edu"><br/><br/>
						</div>
					</div>
					<?php echo form_error('certi_edu'); ?>
					<div>
						<div class="col-md-3">
							<input type="submit"  id="submitedu" name="submitedu" value="save"><br/><br/>
						</div>
						
				<div >
					<input type="reset" class="btn btn-danger">
				</div>
			</div>

		</form>
	</div>
