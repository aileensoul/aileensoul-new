
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

<!-- <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-91486853-1', 'auto');
  ga('send', 'pageview');

</script>

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6060111582812113",
    enable_page_level_ads: true
  });
</script>
        -->

<!-- forget passwor script css start --><!-- 

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- forget passwor script css end -->

        <link rel="canonical" href="https://www.aileensoul.com" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/media.css'); ?>"> <link rel="stylesheet" type="text/css" href="<?php echo base_url('partical/common-style.css'); ?>">

        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
      <!--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
 -->
        <link rel="stylesheet" type="text/css" href="partical/css/style_login.css">

        <meta content="" name="author" />
        <link rel="icon" href="">
        <!-- css start -->
        <style type="text/css">


        </style>
    </head>
    <!-- header -->

    <!-- style for span id=notification_count start-->


    <body>
        <header>

             <div class="header3" style="    background-color: #f2f4f4;">
            <div class="container">


                <div class="row">
                    <div class="col-md-4 col-sm-5">
                        <div class="logo" style="    padding: 26px 0;
    padding-left: 79px;"><a href="<?php echo base_url('main') ?>"><!-- <img src="<?php// echo base_url('images/logo.png'); ?>"> --> <span style="color: #87ceff; font-size: 41px;">Aileensoul</span></a></div>
                    </div>
                    <div class="col-md-7 col-sm-7 header-left-menu">

                    <ul class="fr">
                    <li class=""><a class="login_butn"  href="<?php echo base_url('registration'); ?>">Create an account</a></li>


                      
                    </ul>
                     
      </div>                          </div>

                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                        </div>
                    </div>
    </header>
    <section class="buttonset">
        <div id="nav_list"></div>
    </section>

    <!-- header end -->

<section id="section-height" style="height: 660px;">
        <div id="particles-js"></div>

        <div class="banner_cnt_reg text-center clearfix">
            <div class="form">
                <div class="tab-group">
                    <ul>
                        <div class="logo1"><!-- <img src="<?php echo base_url('partical/images/khalilogo.png'); ?>"> --></div>
                        <li class="tab active"><a class="head-ail">Welcome to Aileensoul</a></li>
                    </ul>
                </div>

                <div>

                    <?php
                    if ($this->session->flashdata('error')) {
                        echo $this->session->flashdata('error');
                    }
                    if ($this->session->flashdata('success')) {
                        echo $this->session->flashdata('success');
                    }
                    ?>
                </div>
                <div id="login"> 


                    <form action="<?php echo base_url(); ?>login/check_login" method="post" id="login_form" name="login_form">
                        <div class="login_filed">
                            <div class="field-wrap">
                                <label class="login_label">
                                    Email Address<span class="req">*</span>
                                </label>
                                <input id="user_name"  type="text" name="user_name" autocomplete="off" value="<?php if (isset($_COOKIE['user_name'])) { echo $_COOKIE['user_name']; } ?>" />
                            </div>

                            <div class="field-wrap">
                                <label class="login_label">
                                    Password<span class="req">*</span>
                                </label>
                                <input type="password" id="password" name="password" class="showpassword"  style="position: relative;padding-right: 8%;" 
                                value="<?php if (isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>"/>
                                <input type="hidden" name="hiddenf" id="hiddenf" value="login">
                                
  <label for="password1" style="position: absolute;
    top: 37px;
    right: 6px;" ><img style="height: 20px; width: 20px;" src="images/eye.png"></label>
                                <div class="checkbox2" style="display: block;">

                                    <input type="checkbox" name="remember">
                                    <h6>Remember me</h6>
                                </div>
                                <div class="forgot" style="margin-top: -54px;">
                                    <a  id="myBtn"> <h6>Forgot Password?</h6></a>
                                </div>

                            </div>  
                           

                            <button type="submit" id="btnShow" name="login" value="Login" class="button button-block" style="background:#87ceff!important; background-repeat: no-repeat; background-position: right center">Log In</button>
                            <div class="c_account">
                                <span style="font-size: 14px;">Don't have an account?</span>
                                <a  href="<?php echo base_url('registration'); ?>">Create an account</a>
                            </div>
    

                </div>

            </div>

        </div>
        </form>



        </div>
        </div>


        </div>       

  </section>

  <!-- Modal strat-->

<div id="myModal" class="modal">

  <!-- Modal content -->

  

  <div class="modal-content">
    <div class="modal-header">

     <?php
        $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
        echo form_open('profile/forgot_password', $form_attribute);
    ?>
      <span class="close">&times;</span>
      <label style="color: #a0b3b0;">Forgot Password</label>
    </div>
    <div class="modal-body">
        <label  style="margin-bottom: 15px; color: #a0b3b0;"> Enter your e-mail address below to get your password.</label>
                                            <input style="" type="text" id="forgot_email" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

    </div>
    <div class="modal-footer ">
      <!--  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
       -->                        <div class="submit_btn">              
       <input class="btn btn-theme" type="submit" name="submit" value="Submit" /> 
       </div>

    </div>
    </form>
  </div>

</div>
                
<!-- model end -->

  <footer style="background-color: #f2f4f4;">
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="padding: 12px;">
                <div class="footer-menu pull-left">
                    <p>&copy; 2017 | by <a href="<?php echo base_url('main'); ?>" style="color: #000033">Aileensoul</a></p>
                </div>
                </div>
                <div class="col-md-6">
                <div class="footer-menu pull-right">
                    <nav>
                        <ul>
                          <li> <b><a class="" href="<?php echo base_url('about_us'); ?>">About Us</a> </b></li>
                                    <li> <b><a class="" href="<?php echo base_url('contact_us'); ?>">Contact Us</a> </b></li>
                                    <li><b><a class="" href="javascript:void(0);">Blog</a> </b></li>
                                    <li> <b><a class="" href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a> </b></li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
        </div>
        </footer>
  </body>
        <!-- scripts -->
        <!-- <script src="<?php //echo base_url('partical/particles.json');   ?>"></script> -->

        <script src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>

        <script src="<?php echo base_url('partical/particles.min.js'); ?>"></script>
        <script src="<?php echo base_url('partical/js/app.js'); ?>"></script>

        <!-- stats.js -->
        <script src="<?php echo base_url('partical/js/lib/stats.js'); ?>"></script>


    </section>

    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>

    <script>

        $(function () {
            $(".showpassword").each(function (index, input) {
                var $input = $(input);
                $('<div class="checkbox2 show" style="display: block;">').append(
                        $("<input type='checkbox' class='showpasswordcheckbox'  id='password1' style=' display: none; '  /></div> ").click(function () {
                    var change = $(this).is(":checked") ? "text" : "password";
                    var rep = $("<input type='" + change + "' />")
                            .attr("id", $input.attr("id"))
                            .attr("name", $input.attr("name"))
                            .attr('class', $input.attr('class'))
                            .val($input.val())
                            .insertBefore($input);
                    $input.remove();
                    $input = rep;
                })
                        ).insertAfter($input);
            });
        });
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        $(".alert-danger").delay(2000).fadeOut(400);
    </script>

    <script src="<?php echo base_url('partical/js/index.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
                                //validation for edit email formate form
                                $(document).ready(function () {
                                    /* validation */
                                    $("#login_form").validate({
                                        rules: {
                                            user_name: {
                                                required: true,
                                               email:true,

                                            },
                                            password: {
                                                required: true,
                                            }
                                        },
                                        messages:
                                                {
                                                    user_name: {
                                                        required: "Email Address Is Required.",
                                                         email:"Please Enter Valid Email Id.",
                                                    },
                                                    password: {
                                                        required: "Password Is Required.",
                                                    }
                                                },
                                    });
                                    /* validation */
                                    
                                });


</script>

</body>

</html>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>