

<!-- main content -->
				<h3>
					PrintPreview
				</h3>
			<div>
				
					<div>
						<label>First Name:<?php echo $job[0]['fname'];?></label>
					</div>

					 <div>
						<label>Last Name:<?php echo $job[0]['lname'];?></label>
					</div>

					<div>
						<label>Email Id:<?php echo $job[0]['email'];?></label>
					</div>


					<div>
						<label>Phone Number:<?php echo $job[0]['phnno'];?></label>
					</div>

					<div>
						<label>Marital Status:<?php echo $job[0]['marital_status'];?></label>
					</div>

					<div>
						<label>Nationality:<?php echo $job[0]['nationality'];?></label>
					</div>

					<div>
						<label>Language Known:<?php echo $job[0]['language'];?></label>
					</div>

					<div>
						<label>Date of Birth:<?php echo $job[0]['dob'];?></label>
					</div>

					<div>
						<label>Gender:<?php echo $job[0]['gender'];?></label>
					</div>
					
					<div>
						<label>Country: 
						<?php $cache_time  =  $this->db->get_where('countries',array('country_id' => $job[0]['country_id']))->row()->country_name;  
						echo $cache_time; 
						?></label>
					</div>

					<div>
						<label>State: 
						<?php $cache_time  =  $this->db->get_where('states',array('state_id' => $job[0]['state_id']))->row()->state_name;  
						echo $cache_time; ?>
							
						</label>
					</div>

					<div>
						<label>City:
						<?php $cache_time  =  $this->db->get_where('cities',array('city_id' => $job[0]['city_id']))->row()->city_name;  
						echo $cache_time; ?>
						</label>
					</div>

					<div>
						<label>Address:<?php echo $job[0]['address'];?></label>
					</div>

					<div>
						<label>Pincode:<?php echo $job[0]['pincode'];?></label>
					</div>

					<div>
					<?php
						
						$aud=$job[0]['keyskill'];
						$aud_res=explode(',',$aud);

						
						
						
						?>
						<label>Key Skills:	</label>
						<?php
						
						foreach ($aud_res as $skill)
								{
						
									$cache_time  =  $this->db->get_where('skill',array('skill_id' => $skill))->row()->skill;  
									echo $cache_time; 
									echo " "; 

								}
								?>
						</div>

						
						
					<div>
						<?php
						$aud=$job[0]['ApplyFor'];
						$aud_res=explode(',',$aud);
						?>
						<label>Apply For:</label>

						<?php
						
						foreach ($aud_res as $skill)
								{
						
									$cache_time  =  $this->db->get_where('skill',array('skill_id' => $skill))->row()->skill;  
									echo $cache_time; 
									echo " "; 

								}
								?>

					</div>

					<div>
						<label>Degree:<?php echo $job[0]['degree'];?></label>
					</div>

					<div>
						<label>Stream:<?php echo $job[0]['stream'];?></label>
					</div>

					<div>
						<label>Univercity:<?php echo $job[0]['university'];?></label>
					</div>

					<div>
						<label>College Name:<?php echo $job[0]['college'];?></label>
					</div>

					<div>
						<label>Grade:<?php echo $job[0]['grade'];?></label>
					</div>

					<div>
						<label>Percentage:<?php echo $job[0]['percentage'];?></label>
					</div>

					<div>
						<label>Passing Year:<?php echo $job[0]['pass_year'];?></label>
					</div>
					
					
					 <!-- JOBEDUCERTIFICATE DEFINE IN CONSTANT.PHP FILE-->
					<div>
						<label>Education Image:<img src="<?php echo base_url(JOBEDUCERTIFICATE.$job[0]['edu_certificate'])?>" style="width:100px;height:100px;"></label>
					</div>
					

					<div>
						<label>Job Title:<?php echo $job[0]['jobtitle'];?></label>
					</div>

					<div>
						<label>Company Name:<?php echo $job[0]['companyname'];?></label>
					</div>
					
					<div>
						<label>Company Email:<?php echo $job[0]['companyemail'];?></label>
					</div>

					<div>
						<label>Comapny Phone Number:<?php echo $job[0]['companyphn'];?></label>
					</div>

					<div>
						<label>Experience:
						
						<?php 
						if ($job[0]['experience'] == "Fresher")
						{
							
							echo $job[0]['experience'];
						}
						else
						{
							if ($job[0]['experience_year'] == "0 year")
							{
								echo $job[0]['experience_month'];
							}
							else
							{
								echo $job[0]['experience_year']; 
								echo "&nbsp"; 
								echo $job[0]['experience_month'];
							}
						}
						?>
							
						</label>
					</div>

					 
					 <!-- JOBWORKCERTIFICATE DEFINE IN CONSTANT.PHP FILE-->
					<div>
						<label>Work Image:<img src="<?php echo base_url( JOBWORKCERTIFICATE.$job[0]['work_certificate'])?>" style="width:100px;height:100px;"></label>
					</div>

				<div>
						<label>Extra Curricular Activity:<?php echo $job[0]['curricular'];?></label>
				</div>

				<div>
						<label>Interest:<?php echo $job[0]['interest'];?></label>
				</div>

				 <div>
						<label>Reference:<?php echo $job[0]['reference'];?></label>
				</div> 

				 <div>
						<label>Carrier Objective:<?php echo $job[0]['carrier'];?></label>
				</div> 
					
				
			</div>