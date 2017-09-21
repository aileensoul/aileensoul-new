<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login into Aileensoul.com</title>
        <meta name="description" content="Login to Aileensoul.com dashboard and get updates on your profiles." />
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="keywords" content="Hire Freelancers, Freelance Jobs Online, Find Freelance Work, Freelance Jobs, Get Online Work, online freelance jobs, freelance websites, freelance portal, online freelance work, freelance job sites, freelance consulting jobs, hire freelancers online, best freelancing sites, online writing jobs for beginners, top freelance websites, freelance marketplace, jobs, Job search, job vacancies, Job Opportunities in India, jobs in India, job openings, Jobs Recruitment, Apply For Jobs, Find the right Job, online job applications, apply for jobs online, online job search, online jobs india, job posting sites, job seeking sites, job search websites, job websites in india, job listing websites, jobs hiring, how to find a job, employment agency, employment websites, employment vacancies, application for employment, employment in india, searching for a job, job search companies, job search in india, best jobs in india, job agency, job placement agencies, how to apply for a job, jobs for freshers, job vacancies for freshers, recruitment agencies, employment agencies, job recruitment, hiring agencies, hiring websites, recruitment sites, corporate recruiter, career recruitment, online recruitment, executive recruiters, job recruiting companies, online job recruitment, job recruitment agencies, it, recruitment agencies, recruitment websites, executive search firms, sales recruitment agencies, top executive search firms, recruitment services, technical recruiter, recruitment services, job recruitment agency, recruitment career" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="css/common-style.css">
        <link rel="stylesheet" href="css/style-main.css">

        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
    </head>

    <body>
        <div class="main-inner">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-3">
                            <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                        </div>
                        <div class="col-md-8 col-sm-9">
                            <div class="btn-right pull-right">

                                <a href="<?php echo base_url('registration'); ?>" class="btn3">Create an account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="middle-main">
                <div class="container">
                    <div class="form-pd row">


                        <div id="error1" style="display:block;">

                            <?php
                            if ($this->session->flashdata('error')) {
                                echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                            }
                            if ($this->session->flashdata('success')) {
                                echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                            }
                            ?>

                        </div>





                        <!--         <div id="error"></div>-->

                        <div class="inner-form login-frm">
                            <div class="login">
                                <div class="title">
                                    <h1 class="ttc">Welcome To Aileensoul</h1>
                                </div>

                                <form role="form" name="login_form" id="login_form" method="post">

                                    <div class="form-group">
                                        <input type="email" value="<?php echo $email; ?>" name="email_login" id="email_login" class="form-control input-sm" placeholder="Email Address*">
                                        <div id="error2" style="display:block;">
                                            <?php
                                            if ($this->session->flashdata('erroremail')) {
                                                echo $this->session->flashdata('erroremail');
                                            }
                                            ?>
                                        </div>
                                        <div id="errorlogin"></div> 
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_login" id="password_login" class="form-control input-sm" placeholder="Password*">
                                        <div id="error1" style="display:block;">
<?php
if ($this->session->flashdata('errorpass')) {
    echo $this->session->flashdata('errorpass');
}
?>
                                        </div>
                                        <div id="errorpass"></div> 
                                    </div>

                                    <p class="pt-20 ">
                                        <button class="btn1" onclick="login()">Login</button>
                                    </p>

                                    <p class=" text-center">
                                        <a href="javascript:void(0)" id="myBtn">Forgot Password ?</a>
                                    </p>

                                    <p class="pt15 text-center">
                                        Don't have an account? <a href="<?php echo base_url('registration'); ?>">Create an account</a>
                                    </p>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </section>


            <!-- model for forgot password start -->


            <div id="myModal" class="modal">
                <div class="modal-content md-2">


<?php
$form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
echo form_open('profile/forgot_password', $form_attribute);
?>

                    <div class="modal-header" style="width: 100%; text-align: center;">

                        <span class="close">&times;</span>
                        <label style="color: #1b8ab9;">Forgot Password</label>
                    </div>


                    <div class="modal-body" style="    width: 100%;
                         text-align: center;">
                        <label  style="margin-bottom: 15px; color: #5b5b5b;"> Enter your e-mail address below to get your password.</label>
                        <input style="" type="text" name="forgot_email" id="forgot_email" placeholder="Email Address*" autocomplete="off" class="form-control placeholder-no-fix">

                    </div>

                    <div class="modal-footer ">
                        <!--  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                        -->  
                        <div class="submit_btn text-center">              
                            <input class="btn btn-theme btn1" type="submit" name="submit" value="Submit" /> 
                        </div>
                    </div>

                    </form>

                </div>
            </div>
            <!-- model for forgot password end -->



            <footer>
                <div class="container pt-20">
                    <div class="row">

                        <div class="col-md-6 col-sm-8 pull-right col-xs-12">
                            <ul>
                                <li><a href="<?php echo base_url('about_us'); ?>">About Us</a>|</li>
                                <li><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a>|</li>
                                <li><a href="<?php echo base_url('blog'); ?>">Blog</a>|</li>
                                <li><a href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-4">
                            © 2017 | by Aileensoul
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-3.2.1.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery-ui.min-1.12.1.js?ver=' . time()); ?>"></script>  
        <script>
                                            $(document).ready(function () {

                                                // text animation effect 
                                                var $lines = $('.top-middle h3.text-effect');
                                                $lines.hide();
                                                var lineContents = new Array();

                                                var terminal = function () {

                                                    var skip = 0;
                                                    typeLine = function (idx) {
                                                        idx == null && (idx = 0);
                                                        var element = $lines.eq(idx);
                                                        var content = lineContents[idx];
                                                        if (typeof content == "undefined") {
                                                            $('.skip').hide();
                                                            return;
                                                        }
                                                        var charIdx = 0;

                                                        var typeChar = function () {
                                                            var rand = Math.round(Math.random() * 150) + 25;

                                                            setTimeout(function () {
                                                                var char = content[charIdx++];
                                                                element.append(char);
                                                                if (typeof char !== "undefined")
                                                                    typeChar();
                                                                else {
                                                                    element.append('<br/><span class="output">' + element.text().slice(9, -1) + '</span>');
                                                                    element.removeClass('active');
                                                                    typeLine(++idx);
                                                                }
                                                            }, skip ? 0 : rand);
                                                        }
                                                        content = '' + content + '';
                                                        element.append(' ').addClass('active');
                                                        typeChar();
                                                    }

                                                    $lines.each(function (i) {
                                                        lineContents[i] = $(this).text();
                                                        $(this).text('').show();
                                                    });

                                                    typeLine();
                                                }

                                                terminal();
                                            });
        </script>


        <!-- script for login  user valoidtaion start -->

        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
        <script type="text/javascript">

                                            function login()
                                            {
                                                document.getElementById('error1').style.display = 'none';
                                            }
                                            //validation for edit email formate form
                                            $(document).ready(function () {
                                                /* validation */
                                                $("#login_form").validate({
                                                    rules: {
                                                        email_login: {
                                                            required: true,
                                                        },
                                                        password_login: {
                                                            required: true,
                                                        }
                                                    },
                                                    messages:
                                                            {
                                                                email_login: {
                                                                    required: "Please enter email address",
                                                                },
                                                                password_login: {
                                                                    required: "Please enter password",
                                                                }
                                                            },
                                                    submitHandler: submitForm
                                                });
                                                /* validation */
                                                /* login submit */
                                                function submitForm()
                                                {

                                                    var email_login = $("#email_login").val();
                                                    var password_login = $("#password_login").val();
                                                    var post_data = {
                                                        'email_login': email_login,
                                                        'password_login': password_login,
                                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                                                    }
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: '<?php echo base_url() ?>registration/check_login',
                                                        data: post_data,
                                                        dataType: "json",
                                                        beforeSend: function ()
                                                        {
                                                            $("#error").fadeOut();
                                                            $("#btn-login").html('Login ...');
                                                        },
                                                        success: function (response)
                                                        {
                                                            if (response.data == "ok") {
                                                                $("#btn-login").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Login ...');

                                                                window.location = "<?php echo base_url() ?>dashboard";

                                                                //setTimeout(' window.location.href = "<?php //echo base_url()  ?>home"; ', 4000);
                                                                // setTimeout(' window.location.href = ""; ', 4000);
                                                            } else if (response.data == "password") {

                                                                //$("#error").fadeIn(1000, function () {

                                                                //document.getElementById('error1').style.display = 'none';
                                                                //         $("#error").html('<div class="alert alert-danger"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Please enter valid password' + ' !</div>');
                                                                $("#errorpass").html('<label for="email_login" class="error">Please enter a valid password.</label>');
                                                                document.getElementById("password_login").classList.add('error');
                                                                document.getElementById("password_login").classList.add('error');
                                                                $("#btn-login").html('Login');
                                                                //    }); 

                                                            } else {
                                                                //   document.getElementById('error1').style.display = 'none';
                                                                //         $("#error").html('<div class="alert alert-danger"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + 'Please enter valid password' + ' !</div>');
                                                                $("#errorlogin").html('<label for="email_login" class="error">Please enter a valid email.</label>');
                                                                document.getElementById("email_login").classList.add('error');
                                                                document.getElementById("email_login").classList.add('error');
                                                                $("#btn-login").html('Login');
                                                            }
                                                        }
                                                    });
                                                    return false;
                                                }
                                                /* login submit */
                                            });



        </script>


        <!-- login validtaion and submit end -->



        <!-- forgot password script start -->


        <script>
            // Get the modal
            var modal = document.getElementById('myModal');

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function () {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

        <!-- forgot password script end -->
        <script type="text/javascript">
            $(document).ready(function () { //aletr("hii");
                /* validation */
                $("#forgot_password").validate({
                    rules: {
                        forgot_email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "<?php echo site_url() . 'profile/check_emailforget' ?>",
                                type: "post",
                                data: {
                                    email_reg: function () {
                                        // alert("hi");
                                        return $("#forgot_email").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },

                        }

                    },
                    messages: {
                        forgot_email: {
                            required: "Email Address Is Required.",
                            remote: "Email address not exists",

                        }


                    },
                });
                /* validation */

            });
        </script>

        <script type="text/javascript">
            //$(".alert").delay(3200).fadeOut(300);
        </script>

        <script type="text/javascript">
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    $("#myModal").hide();
                }
            });
        </script>

    </body>
</html>