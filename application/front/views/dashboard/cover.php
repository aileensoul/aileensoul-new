<!DOCTYPE html>
<html lang="en" class="custom-c">
<head>
  <title>aileensoul</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <link rel="stylesheet" href="css/common-style.css">
  <link rel="stylesheet" href="css/style-main.css">
  <link rel="stylesheet" href="css/style_harshad.css">
  <link rel="stylesheet" href="css/jquery.fancybox.css">
  <link rel="stylesheet" type="text/css" href="css/slider.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
<!--link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" /-->
<link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body class="cover ">

	<?php echo $head; ?>
<?php echo $header; ?>
    
    <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
	<div class="middle-section">
	   <!--verify link start-->
                    
            <?php
            $userid = $this->session->userdata('aileenuser');
            $this->db->select('*');
            $this->db->where('created_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()');
            $this->db->where('user_id', $userid);
            
           $result = $this->db->get('user')->result_array();
         
            //echo "<pre>"; print_r($result);

            if ($userdata[0]['user_verify'] == 0 && count($result) > 0) { //echo "hii"; die();
                ?>

                
                 <div class="profile-text1 animated fadeInDownBig" id="verifydiv">

                

                <div class="alert alert-warning  vs-o">
                <div class="email-verify">
					<span class="email-img"><img src="images/email.png"></span>
                    <span class="main-txt">
                    <span class="as-p">
                       We have send you an activation email address on your email , Click the link in the mail to verify your email address.   
                    </span>
                    <span class="ves_c">
                    <span class="fw-50"> <a class="vert_email " onClick="sendmail(this.id)" id="<?php echo $userdata[0]['user_email']; ?>">Verify Email Address</a></span>
					 <!-- <span class="fw-50"> <a class="chng_email" href="">Change Email Address</a> </span> -->
					 </span>
                   <span class="fr cls-ve" onclick="return closever();"><i class="fa fa-times" aria-hidden="true"></i> </span>
                   </span>
                </div>
                </div>

                </div> 
            <?php }else if($userdata[0]['user_verify'] == 2 && count($result) > 0){

            	$d1 = strtotime($userdata[0]['user_last_login']);
            	$d2 = strtotime(date("Y-m-d H:i:s"));
                $result_var =$d2- $d1;
                $hours = $result_var / 60 /  60;

                

           		if($hours > 24 && $userdata[0]['user_verify'] == 2){
            ?>


                <div class="profile-text1 animated fadeInDownBig" id="verifydiv">

                
                <div class="alert alert-warning  vs-o">
                <div class="email-verify">
					<span class="email-img"><img src="images/email.png"></span>
                    <span class="main-txt">
                    <span class="as-p">
                       We have send you an activation email address on your email , Click the link in the mail to verify your email address.   
                    </span>
                    <span class="ves_c">
                    <span class="fw-50"> <a class="vert_email " onClick="sendmail(this.id)" id="<?php echo $userdata[0]['user_email']; ?>">Verify Email Address</a></span>
					 <span class="fw-50"> <a class="chng_email" href="">Change Email Address</a> </span>
					 </span>
                   <span class="fr cls-ve" onclick="return closever();"><i class="fa fa-times" aria-hidden="true"></i> </span>
                   </span>
                </div>
                </div>

                </div> 
            
            <?php } }?>

        
                         <!--verify link end-->
		<div class="container xs-p0">
                 
			<section class="banner">
				<div class="banner-box">
					<div class="banner-img">


					<div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo"></div>
                </div>
                <div class="col-md-12 cover-pic " >
                    <button class="btn btn-success  cancel-result" onclick="myFunction()">Cancel</button>

                    <button class="btn btn-success  upload-result fr" onclick="myFunction()">Save</button>

                    <div id="message1" style="display:none;">
                        <div class="loader"><div id="floatBarsG">
                                <div id="floatBarsG_1" class="floatBarsG"></div>
                                <div id="floatBarsG_2" class="floatBarsG"></div>
                                <div id="floatBarsG_3" class="floatBarsG"></div>
                                <div id="floatBarsG_4" class="floatBarsG"></div>
                                <div id="floatBarsG_5" class="floatBarsG"></div>
                                <div id="floatBarsG_6" class="floatBarsG"></div>
                                <div id="floatBarsG_7" class="floatBarsG"></div>
                                <div id="floatBarsG_8" class="floatBarsG"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"  style="visibility: hidden; ">
                    <div id="upload-demo-i"></div>
                </div>
            </div>


            <div class="" id="row2">
                   <?php 
                    if ($userdata[0]['profile_background']) {
                        ?>
                        <div class="bg-images">
                            <img src="<?php echo base_url($this->config->item('user_bg_main_upload_path'). $userdata[0]['profile_background']); ?>" name="image_src" id="image_src" / ></div>
                        <?php
                    } else {
                        ?>
                        <div class="bg-images no-cover-upload">
                            <img src="<?php echo WHITEIMAGE; ?>" name="image_src" id="image_src" alt="WHITE IMAGE" /></div>
                    <?php }
                    ?>

                </div>

						
					</div>



					<div class="upload-camera">

						 <!--<a href="#"><img src="img/cam.png"></a>--> 
						  <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span> <i class="fa fa-camera" aria-hidden="true"></i>
						<input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">


					</div>

                                         
					
				</div>
				<div class="left-profile">

				<?php
                $image_ori = $userdata[0]['user_image'];
                if ($image_ori) {
                    ?>
						<div class="profile-photo">

					
                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" alt="" class="main-pic">

						<a class="upload-profile" href="javascript:void(0);" onclick="updateprofilepopup();">
								<img src="img/cam.png">Update Profile Picture</a>
	

						</div>
						<?php }else{?>

						<div class="profile-photo no-image-upload">
							<img src="<?php echo base_url(NOIMAGE); ?>" alt="" class="main-pic"> 
							<a class="upload-profile" href="javascript:void(0);" onclick="updateprofilepopup();">
							<img src="img/u1.png">Update Profile Picture</a>
						</div>

						  <?php } ?>

						<div class="profile-detail">
							<h2> <?php echo ucwords($userdata[0]['first_name']) . ' ' . ucwords($userdata[0]['last_name']); ?></h2>
							<!-- <p>Ahmedabad, Gujarat</p> -->
						</div>
					</div>
			</section>
		</div>
		<div class="sticky-container right-profile">
			<ul class="sticky-right">
				<li>
					<a href="#job-scroll" class="right-menu-box job-r" onclick="return tabindexjob();"><span>Job Profile</span></a>
				</li>
				<li>
					<a href="#rec-scroll" class="right-menu-box rec-r" onclick="return tabindexrec();"> <span>Recruiter Profile</span></a>
				</li>
				<li>
					<a href="#free-scroll" class="right-menu-box free-r" onclick="return tabindexfree();"> <span>Freelance Profile</span></a>
				</li>
				<li>
					<a href="#bus-scroll" class="right-menu-box bus-r" onclick="return tabindexbus();"> <span>Business Profile</span></a>
				</li>
				<li>
					<a href="#art-scroll" class="right-menu-box art-r" onclick="return tabindexart();"> <span>Artistic Profile</span></a>
				</li>
			</ul>
		</div>
		<!--div class="right-profile">
			<ul>
				<li><a href="#job-scroll" class="right-menu-box job-r" onclick="return tabindexjob();"><span>Job Profile</span></a></li>
				<li><a href="#rec-scroll" class="right-menu-box rec-r" onclick="return tabindexrec();"></a></li>
				<li><a href="#free-scroll" class="right-menu-box free-r" onclick="return tabindexfree();"></a></li>
				<li><a href="#bus-scroll" class="right-menu-box bus-r" onclick="return tabindexbus();"></a></li>
				<li><a href="#art-scroll" class="right-menu-box art-r" onclick="return tabindexart();"></a></li>
			</ul>
		</div-->
		<section class="all-profile-custom">
				<div id="job-scroll" class="custom-box odd">
					<div class="custom-width">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="left-box">
									<a href="<?php echo base_url('job'); ?>"><img src="img/i1.png"></a>
								</div>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="right-box">
									<h1><a href="<?php echo base_url('job'); ?>">Job Profile</a></h1>
									<p>Find best job options and connect with recruiters.</p>
									<div class="btns">

										<?php if($job[0]['job_step'] != 10){?>
										<a class="btn-1" href="<?php echo base_url('job'); ?>">Register</a>
										<?php }
											 elseif($job[0]['status'] == '0' && $job[0]['job_step'] == 10){?>

										<a class="btn-1" href="<?php echo base_url('job'); ?>">Active</a>
										<?php }


										else{?> 

										<a class="btn-4" href="<?php echo base_url('job'); ?>">Take me in</a> 

										<?php }?>
										<a data-fancybox data-src="#jop-popup" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
										<!--a data-toggle="modal" data-target="#jop-popup" class="pl20 ml20 hew" href="#">How it works?</a--> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="rec-scroll" class="custom-box even">
					<div class="custom-width">
						<div class="row">
							<div class="col-md-4 pull-right col-sm-4 col-xs-12">
								<div class="left-box">
									<a href="<?php echo base_url('recruiter'); ?>"><img src="img/i2.jpg"></a>
								</div>
							</div>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="right-box">
									<h1><a href="<?php echo base_url('recruiter'); ?>">Recruiter Profile</a></h1>
									<p>Hire quality employees here.</p>
									<div class="btns">
										<a data-fancybox data-src="#rec-popup" href="javascript:;" class="pr20 mr20 hew">How it works?</a>
										

										 <?php if($recrdata[0]['re_step'] != 3){?>

										<a class="btn-1" href="<?php echo base_url('recruiter'); ?>">Register</a>
										<?php }
									 elseif($recrdata[0]['re_status'] == '0' && $recrdata[0]['re_step'] == 3){?>

										<a class="btn-1" href="<?php echo base_url('recruiter'); ?>">Active</a>
										<?php }

										else{?>

										<a class="btn-4" href="<?php echo base_url('recruiter'); ?>">Take me in</a>

										<?php }?>

									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div id="free-scroll" class="custom-box odd">
					<div class="custom-width">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="left-box">
									<a href="<?php echo base_url('freelancer'); ?>"><img src="img/i3.jpg"></a>
								</div>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="right-box">
									<h1><a href="<?php echo base_url('freelancer'); ?>">Freelance Profile</a></h1>
									<p>Hire freelancers and also find freelance work.</p>
									<div class="btns">

									<?php if($hiredata[0]['free_hire_step'] != 3 && $workdata[0]['free_post_step'] != 7){ ?>
										<a class="btn-1" href="<?php echo base_url('freelancer'); ?>">Register</a>
										<?php }
										 elseif(($workdata[0]['status'] == '0' && $workdata[0]['free_post_step'] == 7) || ($hiredata[0]['free_hire_step'] == 3 && $hiredata[0]['status'] == '0')){?>

										<a class="btn-1" href="<?php echo base_url('freelancer'); ?>">Active</a>
										<?php }

										else{?>

										<a class="btn-4" href="<?php echo base_url('freelancer'); ?>">Take me in</a>

										<?php }?>
										<a data-fancybox data-src="#fre-popup" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="bus-scroll" class="custom-box even">
					<div class="custom-width">
						<div class="row">
							<div class="col-md-4 col-sm-4 pull-right col-xs-12">
								<div class="left-box">
									<a href="<?php echo base_url('business_profile'); ?>"><img src="img/i4.jpg"></a>
								</div>
							</div>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="right-box">
									<h1><a href="<?php echo base_url('business_profile'); ?>">Business Profile</a></h1>
									<p>Grow your business network.</p>
									<div class="btns">
										<a data-fancybox data-src="#bus-popup" href="javascript:;" class="pr20 mr20 hew">How it works?</a>
										

										<?php if($busdata[0]['business_step'] != 4){ ?>
										<a class="btn-1" href="<?php echo base_url('business_profile'); ?>">Register</a> 
										<?php }
										 elseif($busdata[0]['status'] == '0' && $busdata[0]['business_step'] == 4){?>

										<a class="btn-1" href="<?php echo base_url('business_profile'); ?>">Active</a>
										<?php }

										else{?>
										<a class="btn-4" href="<?php echo base_url('business_profile'); ?>">Take me in</a> 

										<?php }?>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div id="art-scroll" class="custom-box odd">
					<div class="custom-width">
						<div class="row">
							<div class="col-md-4 col-sm-4">
								<div class="left-box">
									<a href="<?php echo base_url('artistic'); ?>"><img src="img/i5.jpg"></a>
								</div>
							</div>
							<div class="col-md-8 col-sm-8">
								<div class="right-box">
									<h1><a href="<?php echo base_url('artistic'); ?>">Artistic Profile</a></h1>
									<p>Show your art & talent to the world.</p>
									<div class="btns">

										<?php if($artdata[0]['art_step'] != 4){?>
										<a class="btn-1" href="<?php echo base_url('artistic'); ?>">Register</a> 
										<?php }
										 elseif($artdata[0]['status'] == '0' && $artdata[0]['art_step'] == 4){?>

										<a class="btn-1" href="<?php echo base_url('artistic'); ?>">Active</a>
										<?php }

										else{?>
										<a class="btn-4" href="<?php echo base_url('artistic'); ?>">Take me in</a>
										<?php }?>
										<a data-fancybox data-src="#art-popup" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
		 <!-- End  bootstrap-touch-slider Slider -->
		 

    <!-- Modal content-->
		</section>
		
	</div>



	<!-- <footer>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-4">
					© 2017 | by Aileensoul
				</div>
				<div class="col-md-6 col-sm-8">
					<ul>
						<li><a href="#">About Us</a>|</li>
						<li><a href="#">Contact Us</a>|</li>
						<li><a href="#">Blogs</a>|</li>
						<li><a href="#">Send Us Feedback</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer> -->
        
<?php //if($userdata[0]['user_slider'] == 1){?>
	<div id="onload-Modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="main_sl">
				<div class="main_box">
					<div class="imagesl">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
							<div id="first-slider">
								<div id="carousel-example-generic" class="carousel slide carousel-fade" data-interval="false">
									<div id="inner" class="carousel-inner" role="listbox">
										<!-- Item 1 -->
										<div class="item active slide1">
											<div class="center_sl slider-1 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head"> 
													<p> welcome to</p>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_logo.png">
												</div>
											</div>
										 </div> 
										<!-- Item 2 -->
										<div class="item slide2">
											<div class="center_sl main_cl_sl slider-2 slide-text">
												<div data-animation="animated fadeInDownBig" class="imh_logo2">
													<img src="slicing/img_logo.png">
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_2.png">
												</div>
											</div>
										</div>
										<!-- Item 3 -->
										<div class="item slide3">
											<div class="center_sl main_cl_sl slider-3 slide-text">
												<div data-animation="animated fadeInDownBig">
													<h3>Easy to Access</h3>
													<p>You can easily access any profile from main page.</p>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_3.png">
												</div>
											</div>
										</div>
										<!-- Item 4 -->
										<div class="item slide4">
											<div class="center_sl main_cl_sl slider-4 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_4_sl"> 
													<span class="mian_4_hed"> You can easily navigate to one profile to another profile</span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_4.png">
												</div>
											</div>
										</div>
										<!-- End Item 4 -->
										<!-- Item 5 -->
										<div class="item slide5">
											<div class="center_sl main_cl_sl slider-5 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_5_sl"> 
													<span class="mian_4_hed"> You can easily search location vise jobs, employees, freelance projects, business, artists etc.</span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_5.png">
												</div>
											</div>
										</div>
										<!-- End Item 5 -->
										<!-- Item 6 -->
										<div class="item slide6">
											<div class="center_sl main_cl_sl slider-6 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_6_sl"> 
													<span class="mian_4_hed"> Recruiters can post job as per their requirement and find desired employees </span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_6.png">
												</div>
											</div>
										</div>
										<!-- End Item 6 -->
										<!-- Item 7 -->
										<div class="item slide7">
											<div class="center_sl main_cl_sl slider-7 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_7_sl"> 
													<span class="mian_4_hed"> Hire Freelancers and Also Find Freelance Work</span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_7.png">
												</div>
											</div>
										</div>
										<!-- End Item 7 -->
										<!-- Item 8 -->
										<div class="item slide8">
											<div class="center_sl main_cl_sl slider-8 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_8_sl"> 
													<span class="mian_4_hed"> Post your product in business profile with photo/audio/video/pdf</span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_8.png">
												</div>
											</div>
										</div>
										<!-- End Item 8 -->
										<!-- Item 9 -->
										<div class="item slide9">
											<div class="center_sl main_cl_sl slider-9 slide-text">
												<div  class=""> 
													<div data-animation="animated fadeInDownBig" class="sld-9-top">
														<p>You will get notifications related to any new update.</p>
													</div>
													<div data-animation="animated fadeInDownBig" class="sld-9-bottom">
														<p>You can also send and receive contact request in business profile.</p>
													</div>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_9.png">
												</div>
											</div>
										</div>
										<!-- End Item 9 -->
										<!-- Item 10 -->
										<div class="item slide10">
											<div class="center_sl main_cl_sl slider-10 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_10_sl"> 
													<span class="mian_4_hed"> Post your artistic talent and crearivity with photo/audio/video/pdf </span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_10.png">
												</div>
											</div>
										</div>
										<!-- End Item 10 -->
										<!-- Item 11 -->
										<div class="item slide11">
											<div class="center_sl main_cl_sl slider-11 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_11_sl"> 
													<span class="mian_4_hed"> You can also like, comment and follow in business and artistic profiles
													</span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_11.png">
												</div>
											</div>
										</div>
										<!-- End Item 11 -->
										<!-- Item 12 -->
										<div class="item slide12">
											<div class="center_sl main_cl_sl slider-12 slide-text">
												<div class="text_sl_head main_12_sl"> 
													<span data-animation="animated fadeInDownBig" class="mian_4_hed" >Recruiter and job seeker can send and receive messages.
															Freelancer and employer, artist to artist and users within business 
															network can also message each other. </span>
												</div>
												<div data-animation="animated fadeInUpBig" class="imh_logo">
													<img src="slicing/img_screen_12.png">
												</div>
											</div>
										</div>
										<!-- End Item 12 -->
										<!-- Item 13 -->
										<div class="item slide13">
											<div class="center_sl main_cl_sl slider-13 slide-text">
												<div data-animation="animated fadeInDownBig" class="text_sl_head main_13_sl"> 
													<span class="mian_4_hed"> Easily responsive in all device
													</span>
												</div>
												<div class="imh_logo">
													<img class="img1" data-animation="animated fadeInUpBig" src="slicing/sld13-1.png">
													<img class="img2" data-animation="animated fadeInRightBig" src="slicing/sld13-2.png">
													<img class="img3" data-animation="animated fadeInLeftBig" src="slicing/sld13-3.png">
												</div>
											</div>
										</div>
										<!-- End Item 13 -->
										<!-- Item 14 -->
										<div class="item slide14">
											<div class="center_sl main_cl_sl slider-14 slide-text">
												<div data-animation="animated fadeInDownBig" class="imh_logo">
													<img src="slicing/latsgo.png">
												</div>
												<div data-animation="animated fadeInUpBig" class="text_sl_head main_6_sl"> 
													<span class="mian_4_hed"> demo@gmail.com</span>
													<p>Welcome In Aileensoul</p>
													<p>
														<a class="btn-go" href="">Let's Go</a>
													</p>
												</div>
											</div>
										</div>
										<!-- End Item 14 -->
    
									</div>
									<!-- End Wrapper for slides-->
									<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
										<i class="fa fa-angle-left"></i><span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
										<i class="fa fa-angle-right"></i><span class="sr-only">Next</span>
									</a>
								</div>
							</div>
					</div>
					<!--div class="bottom_section fw">
						<div class="fw">

						<div class="ld_sl"></div>
						</div>
						<div class="lfar_sl">
							<a href="#carousel-example-generic" role="button" data-slide="next" class="next-btn"><img src="slicing/img_arrow.png"></a>
						</div>
					</div-->
					<div class="bottom_section fw" id="temp_btn">
						<div class="fw" id="temp_btn1">
							<div class="ld_sl"></div>
						</div>
						<div class="lfar_sl">
							<a href="#carousel-example-generic" role="button" data-slide="prev"  class="next-btn pull-left abc_left" id="right_img"><img src="slicing/right-arrow.png" ></a>
							<a href="#carousel-example-generic" role="button" data-slide="next"  class="next-btn pull-right" id="left_img"><img src="slicing/img_arrow.png" > </a>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php //} ?>

	
	<!--  how it work popup  -->
	<div style="display:none;" class="how-it-popup" id="jop-popup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title">How It Works ?</h1>
				</div>
				<div class="modal-body">
					<div class=""> 
						<div class="col-md-6 col-sm-6 pro_img">
							<h3>Job Profile</h3>
							<img src="img/how-it.png">
						</div>
						<div class="col-md-6 col-sm-6 por_content">
							<ul>
								<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
								<li><img src="img/p2.png"><span class="pro-text"><span class="count">2.</span><span class="text">Get job recommendation as per your skills</span></span></li>
								<li><img src="img/p3.png"><span class="pro-text"><span class="count">3.</span><span class="text">Shortlist - Save - Apply for the job</span></span></li>
								<li><img src="img/p4.png"><span class="pro-text"><span class="count">4.</span><span class="text">Connect with the recruiter and view recruiter's profile.</span></span></li>
							</ul>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">

					<?php if($job[0]['job_step'] != 10){?>
					<a class="btn-4" href="<?php echo base_url('job'); ?>">Register Now</a>
					<?php }else{?>
					<a class="btn-4" href="<?php echo base_url('job'); ?>">Take me in</a>
					<?php }?>

				</div>
			</div>
		</div>
	</div>
	<div style="display:none;" class="how-it-popup" id="rec-popup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h1 class="modal-title">How It Works ?</h1>
				</div>
				<div class="modal-body">
					<div class=""> 
						<div class="col-md-6 col-sm-6 pro_img">
							<h3>Recruiter Profile</h3>
							<img src="img/how-it.png">
						</div>
						<div class="col-md-6 col-sm-6 por_content">
							<ul>
								<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
								<li><img src="img/p5.png"><span class="pro-text"><span class="count">2.</span><span class="text">Post job and see recommended candidates</span></span></li>
								<li><img src="img/p6.png"><span class="pro-text"><span class="count">3.</span><span class="text">Invite from applied candidates for an interview</span></span></li>
								<li><img src="img/p4.png"><span class="pro-text"><span class="count">4.</span><span class="text">Connect with job seekers and view their profiles.</span></span></li>
							</ul>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">

					 <?php if($recrdata[0]['re_step'] != 3){?>
					<a class="btn-4" href="<?php echo base_url('recruiter'); ?>">Register Now</a>
					<?php }else{?>
					<a class="btn-4" href="<?php echo base_url('recruiter'); ?>">Take me in</a>

					<?php }?>

				</div>
			</div>
		</div>
	</div>
	
	<div style="display:none;" class="how-it-popup" id="fre-popup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h1 class="modal-title">How It Works ?</h1>
				</div>
				<div class="modal-body">
					<div class=""> 
						<div class="col-md-6 col-sm-6 pro_img">
							<h3>Freelance Profile</h3>
							<img src="img/how-it.png">
						</div>
						<div class="col-md-6 col-sm-6 por_content">
							<div class="card">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Apply</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hire</a></li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home">
											<ul>
												<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
												<li><img src="img/p7.png"><span class="pro-text"><span class="count">2.</span><span class="text">Get freelance work as per your skills</span></span></li>
												<li><img src="img/p3.png"><span class="pro-text"><span class="count">3.</span><span class="text">Shortlist - save - apply for freelance work </span></span></li>
												<li><img src="img/p8.png"><span class="pro-text"><span class="count">4.</span><span class="text">Chat with the employer.</span></span></li>
											</ul>
										</div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
											<ul>
												<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
												<li><img src="img/p10.png"><span class="pro-text"><span class="count">2.</span><span class="text">Post a project and see recommended freelancers. </span></span></li>
												<li><img src="img/p3.png"><span class="pro-text"><span class="count">3.</span><span class="text">Select from applied freelancers for your project </span></span></li>
												<li><img src="img/p8.png"><span class="pro-text"><span class="count">4.</span><span class="text">Chat with freelancer.</span></span></li>
											</ul>
										</div>
                                       
                                    </div>
							</div>
							
							
						</div>
					</div>
				</div>
				<div class="modal-footer">

					<?php if($hiredata[0]['free_hire_step'] != 3 && $workdata[0]['free_post_step'] != 7){ ?>
					<a class="btn-4" href="<?php echo base_url('freelancer'); ?>">Register Now</a>

					<?php }else{?>
					<a class="btn-4" href="<?php echo base_url('freelancer'); ?>">Take me in</a>


					<?php }?>
				</div>
			</div>
		</div>
	</div>

	<div style="display:none;" class="how-it-popup" id="bus-popup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h1 class="modal-title">How It Works ?</h1>
				</div>
				<div class="modal-body">
					<div class=""> 
						<div class="col-md-6 col-sm-6 pro_img">
							<h3>Business Profile</h3>
							<img src="img/how-it.png">
						</div>
						<div class="col-md-6 col-sm-6 por_content">
							<ul>
								<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
								<li><img src="img/p4.png"><span class="pro-text"><span class="count">2.</span><span class="text">Build business network.</span></span>
								</li>
							</ul>
							<div class="sub-text">
								<p>Get all news feed about your business category and of business you follow</p>
								<p>You can add to your contacts and grow your business network</p>
								<p>You can upload your products photos and also like and comment on other photos</p>
							</div>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">

					<?php if($busdata[0]['business_step'] != 4){ ?>
					<a class="btn-4" href="<?php echo base_url('business_profile'); ?>">Register Now</a>
					<?php }else{?>
                    <a class="btn-4" href="<?php echo base_url('business_profile'); ?>">Take me in</a>
					<?php }?>

				</div>
			</div>
		</div>
	</div>

	<div style="display:none;" class="how-it-popup" id="art-popup">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
					<h1 class="modal-title">How It Works ?</h1>
				</div>
				<div class="modal-body">
					<div class=""> 
						<div class="col-md-6 col-sm-6 pro_img">
							<h3>Artistic Profile</h3>
							<img src="img/how-it.png">
						</div>
						<div class="col-md-6 col-sm-6 por_content">
							<ul>
								<li><img src="img/p1.png"><span class="pro-text"><span class="count">1.</span><span class="text">Register</span></span></li>
								<li><img src="img/p9.png"><span class="pro-text"><span class="count">2.</span><span class="text">You can upload photos/videos/audios and pdf of your art/talent.</span></span>
								</li>
							</ul>
							<div class="sub-text">
								<p>Get all news feed about your artistic category and of the various arts you follow</p>
								
							</div>
							
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<?php if($artdata[0]['art_step'] != 4){?>
					<a class="btn-4" href="<?php echo base_url('artistic'); ?>">Register Now</a>
					<?php }else{?>
					<a class="btn-4" href="<?php echo base_url('artistic'); ?>">Take me in</a>

					<?php }?>

				</div>
			</div>
		</div>
	</div>


<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
<?php echo form_open_multipart(base_url('dashboard/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image"/>
</div>
                        <!--<input type="hidden" name="hitext" id="hitext" value="3">-->
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
<?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Bid-modal-2  -->

<!-- model for popup start -->
<div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                        <div class="modal-dialog modal-lm">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- model for popup -->
					
<!--  onload popup  -->

<!-- end onload popup  -->
<script type="text/javascript">
    $(window).load(function(){        
		$('#onload-Modal').modal('show').fadeIn("slow");
		//$('#onload-Modal').fancybox().trigger('click'); 
    }); 
	$(document).ready(function () {
        $("body").click(function (event) {
            //$("#onload-Modal").modal('hide').fadeOut("slow");
            //$(".modal").css('display','none');
            //$("#onload-Modal").fadeOut("slow");

           // event.stopPropagation();
			//$("#onload-Modal").fadeOut('slow');
			//$("#onload-Modal").removeClass("in").fadeOut('slow');
        });

    });
	  
</script>

<script type="text/javascript">
    
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) { 
        //$( "#bidmodal" ).hide();
         $("#jop-popup").fadeOut(200);
         $("#jop-popup").removeClass("in");

      $("#jop-popup").attr("aria-hidden","true");
        //$('#jop-popup').modal('hide');
    }
}); 

$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
         $("#rec-popup").fadeOut(200);
         $("#rec-popup").removeClass("in");
      $("#rec-popup").attr("aria-hidden","true");

      	
         //$('#rec-popup').modal('hide');
         
    }
}); 
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
       
         $("#fre-popup").fadeOut(200);
         $("#fre-popup").removeClass("in");

      $("#fre-popup").attr("aria-hidden","true");


        // $('#fre-popup').modal('hide');
         
    }
});
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
         $('#bus-popup').fadeOut(200);
         $("#bus-popup").removeClass("in");
      $("#bus-popup").attr("aria-hidden","true");


      	
         //$('#bus-popup').modal('hide');
         
    }
}); 
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
       
         $('#art-popup').fadeOut(200);
         $("#art-popup").removeClass("in");
      $("#art-popup").attr("aria-hidden","true");
         


        // $('#art-popup').modal('hide');
    }
});  

</script>


<script>

//THIS SCRIPT IS USED FOR CHANGE SLIDE WHILE CLICK ON IMAGE BUTTON START
$( document ).ready(function() {

var slides = document.querySelectorAll('.main_box #inner .item');
var slides1 = document.querySelectorAll('.main_box #temp_btn #temp_btn1 .ld_sl');

var currentSlide = 0;
var currentSlide_width=0;

 $('#left_img').click(function (event) 
 {

 	event.preventDefault();

//set time out is used for disable and enable arrow for some time
 	setTimeout(function(){
            $('#left_img').addClass('custom-disabled');
            //....and whatever else you need to do
    }, 30);

    	setTimeout(function(){
            $('#left_img').removeClass('custom-disabled');
            //....and whatever else you need to do
    }, 2000);

    setTimeout(function(){
            $('#right_img').addClass('custom-disabled');
            //....and whatever else you need to do
    }, 30);

    setTimeout(function(){
            $('#right_img').removeClass('custom-disabled');
            //....and whatever else you need to do
    }, 2000);


 	$('#right_img').removeClass('abc_left');
 	$('#right_img').addClass('abc_show');
 	
    /*slides[currentSlide].className = 'item';*/
    currentSlide = (currentSlide+1)%slides.length;
    /*slides[currentSlide].className = 'item active';*/
    

    slides1[currentSlide_width].className = 'ld_sl';
    currentSlide_width = (currentSlide_width+1)%slides1.length;
    slides1[currentSlide_width].className = 'ld_sl sld-width-'+(currentSlide+1);

 	if((currentSlide+1)==slides.length)
 	{
 		$('#left_img').addClass('abc');
 	}

  });

  $('#right_img').click(function (event) 
 {
 	event.preventDefault();
 	
 	setTimeout(function(){
            $('#left_img').addClass('custom-disabled');
            //....and whatever else you need to do
    }, 30);

    	setTimeout(function(){
            $('#left_img').removeClass('custom-disabled');
            //....and whatever else you need to do
    }, 2000);

 	setTimeout(function(){
            $('#right_img').addClass('custom-disabled');
            //....and whatever else you need to do
    }, 30);

    setTimeout(function(){
            $('#right_img').removeClass('custom-disabled');
            //....and whatever else you need to do
    }, 2000);

    /*slides[currentSlide].className = 'item';*/
    currentSlide = (currentSlide-1)%slides.length;
    /*slides[currentSlide].className = 'item active';*/
    if(currentSlide == 0)
    {
    	$('#right_img').removeClass('abc_show');
    	$('#right_img').addClass('abc_left');
    }

    if(currentSlide == 12)
    {
    	$('#left_img').removeClass('abc');
    }
    
    slides1[currentSlide_width].className = 'ld_sl';
    currentSlide_width = (currentSlide_width-1)%slides1.length;
    slides1[currentSlide_width].className = 'ld_sl sld-width-'+(currentSlide+1);
	
 	
  });
 
});
//THIS SCRIPT IS USED FOR CHANGE SLIDE WHILE CLICK ON IMAGE BUTTON END
	
	// scroll top
	$(document).ready(function(){
	  // Add smooth scrolling to all links
	  $(".right-profile ul li a").on('click', function(event) {

		// Make sure this.hash has a value before overriding default behavior
		if (this.hash !== "") {
		  // Prevent default anchor click behavior
		  event.preventDefault();

		  // Store hash
		  var hash = this.hash;

		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
	   
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
	});
	
</script>


<!-- script for profile pic strat -->
<script type="text/javascript">
    

     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'block';
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profilepic").change(function(){
        // pallavi code for not supported file type 15/06/2017
      profile = this.files;
      //alert(profile);
      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
       //alert('not an image');
        $('#profilepic').val('');
         picpopup();
         return false;
          }else{
          readURL(this);}

          // end supported code 
    });
</script>

<!-- script for profile pic end -->

<!-- popup for file type -->
  <script>
         function picpopup() {           
            $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
            $('#bidmodal').modal('show');
                        }
                    </script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#userimage").validate({

                    rules: {

                        profilepic: {

                            required: true,
                         
                        },
  

                    },

                    messages: {

                        profilepic: {

                            required: "Photo Required",
                            
                        },

                },

                });
                   });
  </script>


<script>
                    function updateprofilepopup(id) {
                        $('#bidmodal-2').modal('show');
                    }
</script>



  <script type="text/javascript">
// all popup close close using esc start
    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

     $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  
    //all popup close close using esc end
</script>


<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        // setTimeout(function () { location.reload(1); }, 9000);

    }


    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
    }
</script>


<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1250,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 1250,
            height: 350
        }
    });



    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {


            $.ajax({
                //url: "https://www.aileensoul.com/dashboard/ajaxpro",
                url: "<?php echo base_url() ?>dashboard/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    if (html) {
                        window.location.reload();
                    }
                    //  $("#kkk").html(html);
                }
            });

        });
    });

    $('.cancel-result').on('click', function (ev) {
        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";
    });
    //aarati code start
    $('#upload').on('change', function () {
        var reader = new FileReader();
        //alert(reader);
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);



    });

    $('#upload').on('change', function () {

        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);

        files = this.files;
        size = files[0].size;

        //alert(size);

        // pallavi code start for file type support
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    picpopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    return false;
  }
  // file type code end

        if (size > 10485760)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 10 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            // window.location.href = "https://www.aileensoul.com/dashboard"
            //reset file upload control
            return false;
        }

        $.ajax({

            url: "<?php echo base_url(); ?>dashboard/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                //alert(response);

            }
        });
    });

//aarati code end
</script>
<!-- cover image end -->

<script type="text/javascript">
	
	function tabindexjob(){


		 $("#job-scroll").addClass("tabindex");


		 $("#rec-scroll").removeClass("tabindex");
		 $("#free-scroll").removeClass("tabindex");
		 $("#bus-scroll").removeClass("tabindex");
		 $("#art-scroll").removeClass("tabindex");
		
	}
	function tabindexrec(){


		 $("#rec-scroll").addClass("tabindex");


		 $("#job-scroll").removeClass("tabindex");
		 $("#free-scroll").removeClass("tabindex");
		 $("#bus-scroll").removeClass("tabindex");
		 $("#art-scroll").removeClass("tabindex");
		
	}
	function tabindexfree(){


		 $("#free-scroll").addClass("tabindex");


		 $("#rec-scroll").removeClass("tabindex");
		 $("#job-scroll").removeClass("tabindex");
		 $("#bus-scroll").removeClass("tabindex");
		 $("#art-scroll").removeClass("tabindex");
		 
	}
	function tabindexbus(){


		 $("#bus-scroll").addClass("tabindex");


		 $("#rec-scroll").removeClass("tabindex");
		 $("#free-scroll").removeClass("tabindex");
		 $("#job-scroll").removeClass("tabindex");
		 $("#art-scroll").removeClass("tabindex");
		 
	}
	function tabindexart(){


		 $("#art-scroll").addClass("tabindex");


		 $("#rec-scroll").removeClass("tabindex");
		 $("#free-scroll").removeClass("tabindex");
		 $("#bus-scroll").removeClass("tabindex");
		 $("#job-scroll").removeClass("tabindex");
		 
	}
</script>
<script>
    function sendmail(abc) {  

//alert(abc);

        $.ajax({

            url: "<?php echo base_url(); ?>registration/res_mail",
            type: "POST",
            data: 'user_email=' + abc,
            success: function (response) { 
                 $('.biderror .mes').html("<div class='pop_content'>Email sent Successfully.");
                 $('#bidmodal').modal('show');
                 window.open(response);
            }
        });
    }
</script>




<script type="text/javascript">

function closever(){ 



     $.ajax({
           type: 'POST',
           url: '<?php echo base_url() ?>dashboard/closever',
            success: function (response){

            	$('#verifydiv').hide();
            }
         })


}

</script>


<script type="text/javascript">
	//on hover click class add and class remove start
$(".odd").hover(function() {
    $('.even').addClass("even-custom");
}, function() {
    $('.even').removeClass("even-custom");
});
//on hover click class add and class remove End


</script>

 <script>

(function( $ ) {

    //Function to animate slider captions 
    function doAnimations( elems ) {
		//Cache the animationend event in a variable
		var animEndEv = 'webkitAnimationEnd animationend';
		
		elems.each(function () {
			var $this = $(this),
				$animationType = $this.data('animation');
			$this.addClass($animationType).one(animEndEv, function () {
				$this.removeClass($animationType);
			});
		});
	}
	
	//Variables on page load 
	var $myCarousel = $('#carousel-example-generic'),
		$firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
		
	//Initialize carousel 
	$myCarousel.carousel();
	
	//Animate captions in first slide on page load 
	doAnimations($firstAnimatingElems);
	
	//Pause carousel  
	$myCarousel.carousel('pause');
	
	
	//Other slides to be animated on carousel slide event 
	$myCarousel.on('slide.bs.carousel', function (e) {
		var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
		doAnimations($animatingElems);
	});  
    $('#carousel-example-generic').carousel({
        interval:3000,
        pause: "false"
    });
	
})(jQuery);	



</script>

</body>
</html>