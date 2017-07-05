<!-- start head -->
<?php  echo $head; ?>
 <!-- END HEAD -->
 
<body>
		<header>
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-5">
						<div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('images/logo-white.png'); ?>"></a></div>
					<div class="col-md-8 col-sm-7">
						
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="user-midd-section">
			<div class="container">
				<div class="row">
					 <div class="col-md-2"></div>
          <div class="col-md-8">
 					<div class="common-form about_btm">
                            <h3>ABOUT US:</h3>
        
                   <form id="feedbackform " class="clearfix" method="post" enctype="multipart/form-data" >
     
			<div class="about_us_text">
			
			Aileensoul is dedicated purely towards providing relentless and free platform to everyone.
			 We provide a diversified platform for every kind of person. You can hire, recruit, and find a job of your preference in your required field. You can also find freelancing work from our site. Aileensoul targets every kind of population be it a person from artistic field or a person working in a contemporary setup. Beginning from hiring a housemaid to hiring an employ for your business, Aileensoul has it all. Any person looking for any kind of job or wants to showcase his/her artistic talent are free to create their profile. We want the gap that exists between the employer and employee to be fulfilled and hence creating a vast platform for employment as well as different services. </div>
        </form>
    </div>
		</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="">
		<div class="footer text-center">
			
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
					</div>
					<div class="col-md-6 col-sm-6">
						<!-- <ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						</ul> -->
					</div>
				</div>
			</div>
		</div>
	</footer>
	
</body>

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#feedbackform").validate({ 

                    rules: { 

                        contact_email: {

                            required: true,
                            email: true,

                        },


                        contact_subject: {
                            required: true,
                            
                        },

                        contact_message: {
                            required: true,
                            
                        },

                         },

                    messages: {

                        contact_email: {

                            required: "Email Is Required.",
                            email: "Type email in valid format",
                            
                        },

                        

                        contact_subject: {
                            required: "Subject is required",
                            
                        },

                        contact_message: {
                            required: "Description is required",
                            
                        },
                        

                    },

                });
                   });
  </script>

</html>
