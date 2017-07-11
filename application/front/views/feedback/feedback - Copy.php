<!-- start head -->
<?php  echo $head; ?>
 <!-- END HEAD -->
 
<body>
		<header>
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-5">
						<div class="logo">
						<a href="<?php echo base_url(); ?>"><img src="../images/logo-white.png"></a></div>
					</div>
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
 					<div class="common-form">
                            <h3>Send Us Feedback</h3>
        
                   <form id="feedbackform " class="clearfix" method="post" enctype="multipart/form-data" action="<?php echo base_url('feedback/feedback_insert'); ?>">
     
	
                <fieldset >
                   <label>Enter Your E-mail<span style="color:red">*</span></label>
                   <input type="text"  name="contact_email" id="contact_email" placeholder="Enter  Email"> <span id="contact_email-error"> </span>
                 
              </fieldset>
               <br>
               <br><br><br>
            <fieldset>
                   <label>Subject<span style="color:red">*</span></label>
                   <input type="text" name="contact_subject" id="contact_subject" placeholder="Enter Subject"> <span id="contact_subject-error"> </span>
            
              </fieldset>

            <fieldset class="full-width">
                   <label>Description<span style="color:red">*</span></label>
                   <textarea name="contact_message" class="description " id="contact_message" ></textarea>
                    <span id="contact_subject-error"> </span>
            
              </fieldset>
         <fieldset class="hs-submit full-width">
                                    <input type="submit"  id="submit" name="submit" value="submit">
                                   
            </fieldset>

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
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="footer-logo">
							<a href="index.html"><img src="images/logo-white.png"></a>
						</div>
						<ul>
							<li> Ahmedabad-380015</li>
							<li><a href="mailto:AileenSoul@gmail.com">AileenSoul@gmail.com</a></li>
							<li><?php echo $cnt[0]['site_email']; ?></li>
						</ul>
					</div>
				</div>
			</div>
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
