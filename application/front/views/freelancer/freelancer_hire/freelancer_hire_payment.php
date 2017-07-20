<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->

   

<?php echo $header; ?>

<body>
	
	<section>
		
		<div class="user-midd-section" id="paddingtop_fixed">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3">
						<div class="left-side-bar">
							<ul>
							<li><a href="<?php echo base_url('freelancer-hire/basic-information'); ?>">Basic Information</a></li>

                                <li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_address_info'); ?>">Address Information</a></li>

								<li><a href="<?php echo base_url('freelancer_hire/freelancer_hire_professional_info'); ?>">Professional Information</a></li>

                                <li <?php if($this->uri->segment(1) == 'freelancer_hire'){?> class="active" <?php } ?>><a href="#">Payment For Freelancer</a></li>

							    <li class="<?php if($freehiredata[0]['free_hire_step'] < '4'){echo "khyati";}?>"><a href="<?php echo base_url('freelancer_hire/freelancer_hire_requirement_detail'); ?>">Requirmeant-details</a></li>
								
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
							<h3>Payment For Freelancer</h3>
							

						 <?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_payment_insert'), array('id' => 'payment_info','name' => 'payment_info','class' => 'clearfix')); ?>

                    <!--  <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> -->
                     <?php
                         $pay_hourly =  form_error('pay_hourly');
                         $fixed_price =  form_error('fixed_price');
                         

                         ?>

                            <fieldset <?php if($pay_hourly) {  ?> class="error-msg" <?php } ?> >
									<label>Pay Hourly:</label>
									<input type="text" name="pay_hourly" id="pay_hourly" placeholder="Enter Pay Hourly"  value="<?php if($pay_hourly1){ echo $pay_hourly1; } ?>">
									 
								</fieldset>

								

                                <fieldset <?php if($fixed_price) {  ?> class="error-msg" <?php } ?> >
									<label>Fixed Price:</label>
									<input type="text" name="fixed_price" id="fixed_price" placeholder="Enter FIxed Price"  value="<?php if($fixed_price1){ echo $fixed_price1; } ?>">
									
								</fieldset>
					  			
								<fieldset class="hs-submit full-width">
                                    

                                     <input type="reset">
                                     <a href="<?php echo base_url('freelancer_hire/freelancer_hire_professional_info'); ?>">Previous</a>
                                     
                                    <input type="submit"  id="next" name="next" value="Next">
                                   
                                   
                                </fieldset>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
	<?php echo $footer;  ?>
		</div>
	</footer>
</body>
</html>

  <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#payment_info").validate({

                    rules: {

                        pay_hourly: {

                            //required: true,
                             number: true,
                           
                        },

                         fixed_price: {

                            //required: true,
                             number: true,
                           
                        },
                       
                       
                    },

                    messages: {


                    },

                });
                   });
  </script>
