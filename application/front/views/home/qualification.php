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
					Qualification
				</h3>
			</div>
			<div class="panel-body">
				 <?php echo form_open(base_url('home/qualification_insert'), array('id' => 'qualification','name' => 'qualification')); ?>
					
					<div>
						<label>Qualification:</label>
							<div>
					<textarea id="qualification"  name="qualification"></textarea><br/><br/>
						</div>
						<?php echo form_error('qualification'); ?><br/><br/>
Certifications, accreditions etc. that you have received<br/><br/>
					</div>
						<div class="col-md-3">
							<input type="submit" id="submitqualification" name="submitqualification" value="save"><br/><br/>
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