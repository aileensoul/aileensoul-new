<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Find the Best Jobs, Hiring, Employment and Freelance | Aileensoul.com</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <!-- seo changes start -->
        <!--Need to add following TAG in Header.-->


        <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />

        <link rel="canonical" href="https://www.aileensoul.com" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <meta name="description" content="Aileensoul provides best opportunity where you can Hire, Recruit, Freelance, Busines and find or search jobs of your preference in your required field." />
        <meta name="keywords" content="Hire Freelancers, Freelance Jobs Online, Find Freelance Work, Freelance Jobs, Get Online Work, online freelance jobs, freelance websites, freelance portal, online freelance work, freelance job sites, freelance consulting jobs, hire freelancers online, best freelancing sites, online writing jobs for beginners, top freelance websites, freelance marketplace, jobs, Job search, job vacancies, Job Opportunities in India, jobs in India, job openings, Jobs Recruitment, Apply For Jobs, Find the right Job, online job applications, apply for jobs online, online job search, online jobs india, job posting sites, job seeking sites, job search websites, job websites in india, job listing websites, jobs hiring, how to find a job, employment agency, employment websites, employment vacancies, application for employment, employment in india, searching for a job, job search companies, job search in india, best jobs in india, job agency, job placement agencies, how to apply for a job, jobs for freshers, job vacancies for freshers, recruitment agencies, employment agencies, job recruitment, hiring agencies, hiring websites, recruitment sites, corporate recruiter, career recruitment, online recruitment, executive recruiters, job recruiting companies, online job recruitment, job recruitment agencies, it, recruitment agencies, recruitment websites, executive search firms, sales recruitment agencies, top executive search firms, recruitment services, technical recruiter, recruitment services, job recruitment agency, recruitment career" />
        <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->

        <!-- Add following GoogleAnalytics tracking code in Header.-->

        <!-- seo changes end -->
        <style type="text/css">
            .menu-contact{background-color: #ffffff;}
            #footer{background-color: #cccccc;}
            #section-height{height: 87%;}
           
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                padding-top: 60px;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 80%; /* Could be more or less, depending on screen size */
            }
            /* The Close Button (x) */
            .close {
                position: absolute;
                right: 25px;
                top: 0;
                color: #999999;
                font-size: 35px;
                font-weight: bold;
                opacity: 0.6;
            }

            .close:hover,
            .close:focus {
                color: #d9d9d9;
                cursor: pointer;
            }
            .maindfs{ padding-right: 20px; padding-left: 20px; }
            .background-color-popup{background-color: #ffffff;
                                    padding-left: 0px; padding-right: 0px;}
            .contact-main{font-size: 18px;}
            .copyright-main{font-size: 18px;}
            .fooer-main{background-color: #ffffff;}
        </style>

        <!-- seo changes end -->
        <meta content="" name="author" />
        <link rel="icon" href="">
        <!-- css start -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/common-style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/media.css'); ?>">
        <link rel="stylesheet" type="text/css" href="partical/css/style_login.css">

        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i" rel="stylesheet"> -->
    </head>
    <!-- header -->



    <!-- header -->
    <!-- style for span id=notification_count start-->
    <body class="main-page">

        <header>

            <div class="header3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5 col-sm-5">
                            <div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('images/logo.png'); ?>"></a></div>
                        </div>
                        <div class="col-md-7 col-sm-7 header-left-menu">
                            <div class="pushmenu pushmenu-left">
                                <ul class="fr">


                                    <li><a onclick="document.getElementById('id01').style.display = 'block'" style="width:auto;" href="javascript:void(0)">Login</a></li>

                                    <li><a href="<?php echo base_url('registration'); ?>">Create An Account</a></li>




                                <!-- <li><a href="<?php //echo base_url('contact_us');  ?>">Contact Us</a></li> -->
                                    <!-- header -->            
                                    <!-- Friend Request Start-->
                                    <div>
                                        <div id="id01" class="modal">

                                            <div class="form">
                                                <div class="tab-group">
                                                    <ul >
                                                        <div class="logo1"><img src="<?php echo base_url('partical/images/khalilogo.png'); ?>"></div>
                                                        <li class="tab active"><a class="head-ail">Welcome to Aileensoul</a></li>
                                                    </ul>
                                                </div>

                                                <div>

                                                    <?php
                                                    if ($this->session->flashdata('error')) {
                                                        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                                    }
                                                    if ($this->session->flashdata('success')) {
                                                        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                                    }
                                                    ?>
                                                </div>
                                                <div id="login"> 

                                                    <?php echo form_open('login/check_login'); ?>
                                                    <?php
                                                    //echo "<div class='error_msg'>";
                                                    if (isset($error_message)) {
                                                        echo $error_message;
                                                    }
                                                    echo validation_errors();
                                                    //echo "</div>";
                                                    ?>


                                                    <form action="/" method="post">

                                                        <div class="field-wrap">
                                                            <label class="login_label">
                                                                Email Address or Username<span class="req">*</span>
                                                            </label>
                                                            <input    type="text" required name="user_name" autocomplete="off"/>
                                                        </div>

                                                        <div class="field-wrap">
                                                            <label class="login_label">
                                                                Password<span class="req">*</span>
                                                            </label>
                                                            <input type="password"required name="password" autocomplete="off"/>
                                                        </div>
                                                        <div class="forgot">
                                                            <a data-toggle="modal" href="login.html#myModal"> <h6>Forgot Password?</h6></a>
                                                        </div>


                                                        <?php
                                                        $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
                                                        echo form_open('profile/forgot_password', $form_attribute);
                                                        ?>



                                                        <button type="submit" id="btnShow" name="login" value="Login" class="button button-block" style="background-image: url(partical/images/bg-button.png); background-repeat: no-repeat; background-position: right center">Log In</button>
                                                        <div class="c_account">
                                                            <span style="font-size: 14px;">Don't have an account?</span>
                                                            <a  href="<?php echo base_url('registration'); ?>"><span style="color: #000000; float: right;"><h6> Create an account</h6> </span></a>
                                                        </div>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        <h4 class="modal-title">Forgott Password</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Enter your e-mail address below to get your password.</p>
                                                                        <input type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                                                                        <input class="btn btn-theme" type="submit" name="submit" value="Submit" />    
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div><!-- tab-content -->

                                        </div>

                                        <!-- Friend Request End-->

                                        <!-- END USER LOGIN DROPDOWN -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="buttonset">
            <div id="nav_list"></div>
        </section>

        <!-- header end -->


        <section id="section-height">
            <div id="particles-js"></div>


            <div class="banner_cnt text-center clearfix">

                <img src="<?php echo base_url('partical/img/fullfinal.png'); ?>">



            </div>


            <!-- scripts -->
            <!-- <script src="<?php //echo base_url('partical/particles.json');  ?>"></script> -->

            <script src="<?php echo base_url('partical/particles.min.js'); ?>"></script>
            <script src="<?php echo base_url('partical/js/app.js'); ?>"></script>
            <script src="<?php echo base_url('partical/js/index.js'); ?>"></script>

            <!-- stats.js -->
            <script src="<?php echo base_url('partical/js/lib/stats.js'); ?>"></script>


        </section>

        <footer class="fooer-main">
            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="copyright-main fooer-main"> <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p></div>
                        </div>
                        <div class="col-md-6 col-sm-6 menu-contact fr">
                            <div class="fr  contact-main">
                                <ul>
                                    <li> <b><a class="" href="<?php echo base_url('contact_us'); ?>">Contact Us</a> </b></li>
                                    <li><b><a class="" href="<?php echo base_url('contact_us'); ?>">Blog</a> </b></li>
                                    <li> <b><a class="" href="<?php echo base_url('contact_us'); ?>">Send Us Feedback</a> </b></li>
                                </ul></div>
                        </div>
                    </div>
                </div>
            </div>


        </footer>
    </body>


</html>

<script src="partical/js/index.js"></script>



<script>
// Get the modal
    var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

