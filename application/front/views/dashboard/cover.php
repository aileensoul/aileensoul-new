<!DOCTYPE html>
<html lang="en">
    <head>
        <title>aileensoul</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/common-style.css">
        <link rel="stylesheet" href="css/style-main.css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
      <!--link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" /-->
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <?php
            } else if ($userdata[0]['user_verify'] == 2 && count($result) > 0) {

                $d1 = strtotime($userdata[0]['user_last_login']);
                $d2 = strtotime(date("Y-m-d H:i:s"));
                $result_var = $d2 - $d1;
                $hours = $result_var / 60 / 60;



                if ($hours > 24 && $userdata[0]['user_verify'] == 2) {
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

    <?php }
} ?>


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
                                $userid = $this->session->userdata('aileenuser');
                                $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
                                $image = $this->common->select_data_by_condition('user', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                $image_ori = $image[0]['profile_background'];
                                if ($image_ori) {
                                    ?>
                                    <div class="bg-images">
                                        <img src="<?php echo base_url($this->config->item('user_bg_main_upload_path') . $userdata[0]['profile_background']); ?>" name="image_src" id="image_src" / ></div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="bg-images">
                                        <img src="<?php echo WHITEIMAGE; ?>" name="image_src" id="image_src" alt="WHITE IMAGE" /></div>
<?php }
?>

                            </div>

                                 <?php if ($userdata[0]['profile_background']) { ?>
                                <img src="<?php echo base_url($this->config->item('user_bg_main_upload_path') . $userdata[0]['profile_background']); ?>" name="image_src" id="image_src" class="main-cover"/ >

                            <?php } else { ?>
                                     <img src="<?php echo WHITEIMAGE; ?>" name="image_src" id="image_src" alt="WHITE IMAGE" class="main-cover" />

<?php } ?>

                        </div>



                        <div class="upload-camera">

                                                 <!--<a href="#"><img src="img/cam.png"></a>--> 
                            <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span> <i class="fa fa-camera" aria-hidden="true"></i>
                                <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">


                                </div>


                                <div class="left-profile">
                                    <div class="profile-photo">

                                        <?php
                                        $image_ori = $userdata[0]['user_image'];
                                        if ($image_ori) {
                                            ?>
                                            <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" alt="" class="main-pic">

                                        <?php } else { ?>

                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="" class="main-pic"> 
<?php } ?>

                                        <a class="upload-profile" href="javascript:void(0);" onclick="updateprofilepopup();">
                                            <img src="img/cam.png">Update Profile Picture</a>


                                    </div>
                                    <div class="profile-detail">
                                        <h2> <?php echo ucwords($userdata[0]['first_name']) . ' ' . ucwords($userdata[0]['last_name']); ?></h2>
                                        <!-- <p>Ahmedabad, Gujarat</p> -->
                                    </div>
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
                                    <a href="<?php echo base_url('job'); ?>"><img src="img/i1.jpg"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="right-box">
                                    <h1><a href="<?php echo base_url('job'); ?>">Job Profile</a></h1>
                                    <p>Find best job options and connect with recruiters.</p>
                                    <div class="btns">

                                        <?php if ($job[0]['job_step'] != 10) { ?>
                                            <a class="btn-1" href="<?php echo base_url('job'); ?>">Register</a>
<?php } else { ?> 

                                            <a class="btn-4" href="<?php echo base_url('job'); ?>">Take me in</a> 

<?php } ?>

                                        <a data-toggle="modal" data-target="#jop-popup" class="pl20 ml20 hew" href="#">How it works?</a> 
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
                                        <a data-toggle="modal" data-target="#rec-popup" class="pr20 mr20 hew" href="#">How it works?</a> 

                                        <?php if ($recrdata[0]['re_step'] != 3) { ?>

                                            <a class="btn-1" href="<?php echo base_url('recruiter'); ?>">Register</a>
<?php } else { ?>

                                            <a class="btn-4" href="<?php echo base_url('recruiter'); ?>">Take me in</a>

<?php } ?>

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

                                        <?php if ($hiredata[0]['free_hire_step'] != 3 && $workdata[0]['free_post_step'] != 7) { ?>
                                            <a class="btn-1" href="<?php echo base_url('freelancer'); ?>">Register</a>
<?php } else { ?>

                                            <a class="btn-4" href="<?php echo base_url('freelancer'); ?>">Take me in</a>

<?php } ?>


                                        <a data-toggle="modal" data-target="#fre-popup" class="pl20 ml20 hew" href="#">How it works?</a> 
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
                                        <a data-toggle="modal" data-target="#bus-popup" class="pr20 mr20 hew" href="#">How it works?</a>

                                        <?php if ($busdata[0]['business_step'] != 4) { ?>
                                            <a class="btn-1" href="<?php echo base_url('business_profile'); ?>">Register</a> 
                                        <?php } else { ?>
                                            <a class="btn-4" href="<?php echo base_url('business_profile'); ?>">Take me in</a> 

<?php } ?>
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

                                        <?php if ($artdata[0]['art_step'] != 4) { ?>
                                            <a class="btn-1" href="<?php echo base_url('artistic'); ?>">Register</a> 
                                        <?php } else { ?>
                                            <a class="btn-4" href="<?php echo base_url('artistic'); ?>">Take me in</a>
<?php } ?>

                                        <a data-toggle="modal" data-target="#art-popup" class="pl20 ml20 hew" href="#">How it works?</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        <!--  how it work popup  -->
        <div class="modal fade how-it-popup" id="jop-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" class="class pull-right">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
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

                        <?php if ($job[0]['job_step'] != 10) { ?>
                            <a class="btn-2" href="<?php echo base_url('job'); ?>">Register Now</a>
                        <?php } else { ?>
                            <a class="btn-4" href="<?php echo base_url('job'); ?>">Take me in</a>
<?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade how-it-popup" id="rec-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" class="class pull-right">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
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

                        <?php if ($recrdata[0]['re_step'] != 3) { ?>
                            <a class="btn-2" href="<?php echo base_url('recruiter'); ?>">Register Now</a>
                        <?php } else { ?>
                            <a class="btn-4" href="<?php echo base_url('recruiter'); ?>">Take me in</a>

<?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade how-it-popup" id="fre-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" class="class pull-right">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
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
                                                <li><img src="img/p3.png"><span class="pro-text"><span class="count">3.</span><span class="text">Shortlist - save - apply for freelance work </span></span></li>
                                                <li><img src="img/p8.png"><span class="pro-text"><span class="count">4.</span><span class="text">Chat with the employer.</span></span></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <?php if ($hiredata[0]['free_hire_step'] != 3 && $workdata[0]['free_post_step'] != 7) { ?>
                            <a class="btn-2" href="<?php echo base_url('freelancer'); ?>">Register Now</a>

<?php } else { ?>
                            <a class="btn-4" href="<?php echo base_url('freelancer'); ?>">Take me in</a>


<?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade how-it-popup" id="bus-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" class="class pull-right">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
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

                        <?php if ($busdata[0]['business_step'] != 4) { ?>
                            <a class="btn-2" href="<?php echo base_url('business_profile'); ?>">Register Now</a>
                        <?php } else { ?>
                            <a class="btn-4" href="<?php echo base_url('business_profile'); ?>">Take me in</a>
<?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade how-it-popup" id="art-popup">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="#" data-dismiss="modal" class="class pull-right">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
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
                        <?php if ($artdata[0]['art_step'] != 4) { ?>
                            <a class="btn-2" href="<?php echo base_url('artistic'); ?>">Register Now</a>
                        <?php } else { ?>
                            <a class="btn-4" href="<?php echo base_url('artistic'); ?>">Take me in</a>

<?php } ?>

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

<?php echo $footer; ?>
        <script type="text/javascript">

            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $("#jop-popup").fadeOut(200);
                    //$('#jop-popup').modal('hide');
                }
            });

            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $("#rec-popup").fadeOut(200);

                    //$('#rec-popup').modal('hide');

                }
            });
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();

                    $("#fre-popup").fadeOut(200);

                    // $('#fre-popup').modal('hide');

                }
            });
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $('#bus-popup').fadeOut(200);

                    //$('#bus-popup').modal('hide');

                }
            });
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();

                    $('#art-popup').fadeOut(200);

                    // $('#art-popup').modal('hide');
                }
            });

        </script>


        <script>
            $(document).ready(function () {

                // hover
                /*$(function(){
                 $(".dropdown").hover(            
                 function() {
                 $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                 $(this).toggleClass('open');
                 //$('b', this).toggleClass("caret caret-up");                
                 },
                 function() {
                 $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                 $(this).toggleClass('open');
                 //$('b', this).toggleClass("caret caret-up");                
                 });
                 });*/




            });

            // scroll top
            $(document).ready(function () {
                // Add smooth scrolling to all links
                $(".right-profile ul li a").on('click', function (event) {

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
                        }, 800, function () {

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

            $("#profilepic").change(function () {
                // pallavi code for not supported file type 15/06/2017
                profile = this.files;
                //alert(profile);
                if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    //alert('not an image');
                    $('#profilepic').val('');
                    picpopup();
                    return false;
                } else {
                    readURL(this);
                }

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
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $('#bidmodal-2').modal('hide');
                }
            });

            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
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
                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
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

            function tabindexjob() {


                $("#job-scroll").addClass("tabindex");


                $("#rec-scroll").removeClass("tabindex");
                $("#free-scroll").removeClass("tabindex");
                $("#bus-scroll").removeClass("tabindex");
                $("#art-scroll").removeClass("tabindex");

            }
            function tabindexrec() {


                $("#rec-scroll").addClass("tabindex");


                $("#job-scroll").removeClass("tabindex");
                $("#free-scroll").removeClass("tabindex");
                $("#bus-scroll").removeClass("tabindex");
                $("#art-scroll").removeClass("tabindex");

            }
            function tabindexfree() {


                $("#free-scroll").addClass("tabindex");


                $("#rec-scroll").removeClass("tabindex");
                $("#job-scroll").removeClass("tabindex");
                $("#bus-scroll").removeClass("tabindex");
                $("#art-scroll").removeClass("tabindex");

            }
            function tabindexbus() {


                $("#bus-scroll").addClass("tabindex");


                $("#rec-scroll").removeClass("tabindex");
                $("#free-scroll").removeClass("tabindex");
                $("#job-scroll").removeClass("tabindex");
                $("#art-scroll").removeClass("tabindex");

            }
            function tabindexart() {


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
                        $('.biderror .mes').html("<div class='pop_content'>Email send Successfully.");
                        $('#bidmodal').modal('show');
                        window.open(response);
                    }
                });
            }
        </script>




        <script type="text/javascript">

            function closever() {



                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>dashboard/closever',
                    success: function (response) {

                        $('#verifydiv').hide();
                    }
                })


            }

        </script>


        <script type="text/javascript">
            //on hover click class add and class remove start
            $(".odd").hover(function () {
                $('.even').addClass("even-custom");
            }, function () {
                $('.even').removeClass("even-custom");
            });
        //on hover click class add and class remove End

        </script>




    </body>
</html>