<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['username']);
$userid= ($this->session->userdata['logged_in']['userid']);
} else {
header("location:../../registration/login");
}
?>

<!-- main content -->
				<h3>
					PrintPreview
				</h3>
			<div>
				 <?php echo form_open(base_url('home/printpreview'), array('id' => 'printpreview','name' => 'printpreview')); ?>
				 <?php  
        			 foreach ($result  as $r)  
         			{  
            	?>
            		<!-- <div>
						<label>User Photo:<?php echo $r->image;?></label>
					</div> -->
					<div>
						<label>Image:<?php echo $r->image;?></label>
					</div>
					<div>
						<label>First Name:<?php echo $r->user_name;?></label>
					</div>
					<div>
						<label>Last Name:<?php echo $r->last_name;?></label>
					</div>
					<div>
						<label>Email Id:<?php echo $r->emailid;?></label>
					</div>
					<div>
						<label>Phone Number:<?php echo $r->phone_no;?></label>
					</div>
					<div>
						<label>Website:<?php echo $r->website;?></label>
					</div>
					<div>
						<label>Country:<?php echo $r->country_id;?></label>
					</div>
					<div>
						<label>State:<?php echo $r->state_id;?></label>
					</div>
					<div>
						<label>City:<?php echo $r->city_id;?></label>
					</div>
					<div>
						<label>Area:<?php echo $r->area_id;?></label>
					</div>
					<div>
						<label>Address:<?php echo $r->address;?></label>
					</div>
					<div>
						<label>Pincode:<?php echo $r->pincode;?></label>
					</div>
					<div>
						<label>Key Skills:<?php echo $r->keyskills;?></label>
					</div>
					<div>
						<label>Apply For:<?php echo $r->applyfor;?></label>
					</div>
					<div>
						<label>Job Title:<?php echo $r->jobtitle1;?></label>
					</div>
					<div>
						<label>Company Name:<?php echo $r->companyname1;?></label>
					</div>
					<div>
						<label>Company Email:<?php echo $r->companyemail;?></label>
					</div>
					<div>
						<label>Comapny Number:<?php echo $r->companyphone;?></label>
					</div>
					<div>
						<label>Starting Date:<?php echo $r->startdate1;?></label>
					</div>
					<div>
						<label>Ending Date:<?php echo $r->enddate1;?></label>
					</div>
					<div>
						<label>CTC:<?php echo $r->ctc;?></label>
					</div>
					<div>
						<label>Expected Salary:<?php echo $r->expectedsal;?></label>
					</div>
					<div>
						<label>Qualification:<?php echo $r->qualification;?></label>
					</div>
					<div>
						<label>Degree:<?php echo $r->degree;?></label>
					</div>
					<div>
						<label>Stream:<?php echo $r->stream;?></label>
					</div>
					<div>
						<label>Univercity:<?php echo $r->univercityname;?></label>
					</div>
					<div>
						<label>Institute:<?php echo $r->institutename;?></label>
					</div>
					<div>
						<label>Grade:<?php echo $r->grade;?></label>
					</div>
					<div>
						<label>Passing Year:<?php echo $r->yearpassing;?></label>
					</div>
					<div>
						<label>Percentage:<?php echo $r->percentage;?></label>
					</div>
					<div>
						<label>Interests:<?php echo $r->interests;?></label>
					</div>
					<div>
						<label>References:<?php echo $r->references;?></label>
					</div><br/><?php }   ?> 
					<div>
						<div>
							<input type="submit"  id="printpreview" name="printpreview" value="PrintPreview"><br/><br/>
						</div>	
				<div >
					<button> <a href="home" style="text-decoration: none;">Edit Resume</a></button>
				</div>
			</div>

		</form>
	</div>
