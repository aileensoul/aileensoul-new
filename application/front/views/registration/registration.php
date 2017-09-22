<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register FREE for search Jobs, Hire employee, Freelance and Business Network | Aileensoul.com</title>
        <meta name="description" content="Register into Aileensoul.com for Free, Find job search, Hire employee, Get Freelance work, Grow business network & make Artistic Profiles.">


        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="css/common-style.css">
        <link rel="stylesheet" href="css/style-main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
    </head>
    <body class="registeration">
        <div class="main-inner">
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-3 col-xs-3">
                            <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                        </div>
                        <div class="col-md-8 col-sm-9 col-xs-9">
                            <div class="btn-right pull-right t-r-l">
                                <a href="<?php echo base_url('login'); ?>" class="btn3">Login</a>
                  <!--              <a href="<?php echo base_url('registration'); ?>" class="btn3">creat an account</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <section class="middle-main">
                <div class="container">

                    <div class="form-pd row">
                        <div class="inner-form pt-100">
                            <div class="login">
                                <div class="title">
                                    <h1>Join Aileensoul - It's Free</h1>
                                </div>
                                <form role="form" name="register_form" id="register_form" method="post">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="first_name" id="first_name" tabindex="1" class="form-control input-sm" placeholder="First Name*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="last_name" tabindex="2" id="last_name" class="form-control input-sm" placeholder="Last Name*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email_reg" id="email_reg" tabindex="3" class="form-control input-sm" placeholder="Email Address*">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password_reg" id="password_reg" tabindex="4" class="form-control input-sm" placeholder="Password*">
                                    </div>
                                    <div class="form-group dob">
                                        <label class="d_o_b"> Date Of Birth *:</label>
                                        <!--span class="d_o_b">DOB </span-->
                                        <select class="day" name="selday" id="selday" tabindex="5">
                                            <option value="" disabled selected value>Day</option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <select class="month" name="selmonth" id="selmonth" tabindex="6">
                                            <option value="" disabled selected value>Month</option>
                                            <?php
//                  for($i = 1; $i <= 12; $i++){
                                            ?>
                                            <option value="1">Jan</option>
                                            <option value="2">Feb</option>
                                            <option value="3">Mar</option>
                                            <option value="4">Apr</option>
                                            <option value="5">May</option>
                                            <option value="6">Jun</option>
                                            <option value="7">Jul</option>
                                            <option value="8">Aug</option>
                                            <option value="9">Sep</option>
                                            <option value="10">Oct</option>
                                            <option value="11">Nov</option>
                                            <option value="12">Dec</option>
                                            <?php
                                            //  }
                                            ?>
                                        </select>
                                        <select class="year" name="selyear" id="selyear" tabindex="7">
                                            <option value="" disabled selected value>Year</option>
                                            <?php
                                            for ($i = date('Y'); $i >= 1900; $i--) {
                                                ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group gender-custom">
                                        <select class="gender" name="selgen" id="selgen" tabindex="8">
                                            <option value="" disabled selected value>Gender*</option>
                                            <option value="M">Male</option>
                                            <option value="F">female</option>
                                        </select>
                                    </div>

                                    <p class="clr-c fs12">
                                        By Clicking on create an account button you agree our 
                                        <a tabindex="10" href="<?php echo base_url('main/terms_condition'); ?>">Terms and Condition</a> and <a tabindex="11" href="<?php echo base_url('main/privacy_policy'); ?>">Privacy policy</a>.
                                    </p>
                                    <p>
                                        <button class="btn1" tabindex="9">Create an account</button>
                                    </p>

                                    <div class="sign_in pt10">
                                        <p>
                                            Already have an account ? <a tabindex="12" href="<?php echo base_url('login'); ?>" > Log In </a>
                                        </p>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <footer>
                <div class="container pt-20">
                    <div class="row">

                        <div class="col-md-6 col-sm-8 pull-right col-xs-12">
                            <ul>
                                <li><a href="<?php echo base_url('about_us'); ?>" tabindex="13">About Us</a>|</li>
                                <li><a href="<?php echo base_url('contact_us'); ?>" tabindex="14">Contact Us</a>|</li>
                                <li><a href="<?php echo base_url('blog'); ?>" tabindex="15">Blog</a>|</li>
                                <li><a href="<?php echo base_url('feedback'); ?>" tabindex="16">Send Us Feedback</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-4">
                            © 2017 | by Aileensoul
                        </div>
                    </div>
                </div>
            </footer>
        </div>
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


        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
        <!-- validation for edit email formate form strat -->

        <script>
            $(document).ready(function () {
                $("#register_form").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true,
                        },
                        email_reg: {
                            required: true,
                            remote: {
                                url: "<?php echo site_url() . 'registration/check_email' ?>",
                                type: "post",
                                data: {
                                    email_reg: function () {
                                        // alert("hi");
                                        return $("#email_reg").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                            },
                        },
                        password_reg: {
                            required: true,
                        },
                        selday: {
                            required: true,
                        },
                        selmonth: {
                            required: true,
                        },
                        selyear: {
                            required: true,
                        },
                        selgen: {
                            required: true,
                        }
                    },

                    groups: {
                        selyear: "selyear selmonth selday"
                    },
                    messages:
                            {
                                first_name: {
                                    required: "Please enter first name",
                                },
                                last_name: {
                                    required: "Please enter last name",
                                },
                                email_reg: {
                                    required: "Please enter email address",
                                    remote: "Email address already exists",
                                },
                                password_reg: {
                                    required: "Please enter password",
                                },

                                selday: {
                                    required: "Please enter your birthdate",
                                },
                                selmonth: {
                                    required: "Please enter your birthdate",
                                },
                                selyear: {
                                    required: "Please enter your birthdate",
                                },
                                selgen: {
                                    required: "Please enter your gender",
                                }

                            },
                    submitHandler: submitRegisterForm
                });
                /* register submit */
                function submitRegisterForm()
                {
                    var first_name = $("#first_name").val();
                    var last_name = $("#last_name").val();
                    var email_reg = $("#email_reg").val();
                    var password_reg = $("#password_reg").val();
                    var selday = $("#selday").val();
                    var selmonth = $("#selmonth").val();
                    var selyear = $("#selyear").val();
                    var selgen = $("#selgen").val();

                    var post_data = {
                        'first_name': first_name,
                        'last_name': last_name,
                        'email_reg': email_reg,
                        'password_reg': password_reg,
                        'selday': selday,
                        'selmonth': selmonth,
                        'selyear': selyear,
                        'selgen': selgen,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>registration/reg_insert',
                        data: post_data,
                        beforeSend: function ()
                        {
                            $("#register_error").fadeOut();
                            $("#btn-register").html('Sign Up ...');
                        },
                        success: function (response)
                        {
                            if (response == "ok") {
                                $("#btn-register").html('<img src="<?php echo base_url() ?>images/btn-ajax-loader.gif" /> &nbsp; Sign Up ...');

                                window.location = "<?php echo base_url() ?>dashboard";
                                // setTimeout(' window.location.href = "<?php //echo base_url()  ?>dashboard"; ', 4000);
                            } else {
                                $("#register_error").fadeIn(1000, function () {
                                    $("#register_error").html('<div class="alert alert-danger registration"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                                    $("#btn-register").html('Sign Up');
                                });
                            }
                        }
                    });
                    return false;
                }
            });

        </script>



        <script type="text/javascript">
            //For Scroll page at perticular position js Start
            $(document).ready(function () {

                //  $(document).load().scrollTop(1000);



                $("#email_reg").val('');
                $("#password_reg").val('');

            });
            //For Scroll page at perticular position js End
        </script>


    </body>
</html>