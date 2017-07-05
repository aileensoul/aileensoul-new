<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$userid= ($this->session->userdata['logged_in']['userid']);
} else {
header("location:../../registration/login");
}
?>

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
					Interests
				</h3>
			</div>
			<div class="panel-body">
				 <?php echo form_open(base_url('home/interests_insert'), array('id' => 'interests','name' => 'interests')); ?>
					<?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
					<div>
						<label>Interests:</label>
							<div>
					<textarea id="interests"  name="interests" placeholder="Put Your interests"></textarea><br/><br/>
						</div>
						<?php echo form_error('interests'); ?><br/><br/>
					</div>
						<div class="col-md-3">
							<input type="submit" id="submitinterests" name="submitinterests" value="save"><br/><br/>
						</div>
						
				<div >
					<input type="reset">
				</div>
			</div>

		</form>
		<hr />	
	</div>
</div>
</div>			
</div>  