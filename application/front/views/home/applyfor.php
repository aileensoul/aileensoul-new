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
					Apply For
				</h3>
			</div>
			<div class="panel-body">
				 <?php echo form_open(base_url('home/applyfor_insert'), array('id' => 'applyfor','name' => 'applyfor')); ?>

				 	<?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
					
					<div>
						<label>Apply For:</label>
						<div>
							<input name="applyfor"  type="text" id="applyfor" ><br/><br/>
						</div>
					</div>
					<?php echo form_error('applyfor'); ?>

					<div>
						<div class="col-md-3">
							<input type="submit" id="submitapplyfor" name="submitapplyfor" value="save"><br/><br/>
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