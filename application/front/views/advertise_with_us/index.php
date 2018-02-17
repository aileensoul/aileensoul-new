<!DOCTYPE html>
<?php
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
    header("HTTP/1.1 304 Not Modified");
    exit();
}

$format = 'D, d M Y H:i:s \G\M\T';
$now = time();

$date = gmdate($format, $now);
header('Date: ' . $date);
header('Last-Modified: ' . $date);

$date = gmdate($format, $now + 30);
header('Expires: ' . $date);

header('Cache-Control: public, max-age=30');
?>
<html lang="en" class="add-wi-us">
    <head>
        <title>Advertise With Us - Aileensoul</title>
        <meta name="description" content="Promote your business with Aileensoul.com" />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png?ver=' . time()); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php
        if ($_SERVER['HTTP_HOST'] == "www.aileensoul.com") {
            ?>

            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-91486853-1', 'auto');
                ga('send', 'pageview');

            </script>
            <meta name="msvalidate.01" content="41CAD663DA32C530223EE3B5338EC79E" />
            <?php
        }
        ?>
        <?php
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        ?>
        <link rel="canonical" href="<?php echo $actual_link ?>" />
        <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />
        <?php if (IS_OUTSIDE_CSS_MINIFY == '0') { ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/bootstrap.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/animte.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/font-awesome.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/owl.carousel.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/component.css?ver=' . time()); ?>" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-commen.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-style.css?ver=' . time()); ?>">
            <link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css?ver='.time()) ?>">
        <?php } else { ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/bootstrap.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/animte.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/font-awesome.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/owl.carousel.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/component.css?ver=' . time()); ?>" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-commen.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-style.css?ver=' . time()); ?>">
            <link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css?ver='.time()) ?>">
        <?php } ?>
    </head>
    <body class="main-db add-with-us">
        <div class="web-header">
            <header class="custom-header">
                <div class="header animated fadeInDownBig">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 left-header">
                                <h2 class="logo"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/img/logo-name.png') ?>"></a></h2>
								
                                <!--form>
                                        <input type="text" name="search" placeholder="Search..">
                                </form-->
                            </div>
                            <div class="col-md-6 col-sm-6 right-header text-right">
                                <?php if (!$this->session->userdata('aileenuser')) { ?>
                                    <a href="<?php echo base_url('login'); ?>" class="btn6">Login</a>
                                    <a href="<?php echo base_url('registration'); ?>" class="btn7">Create an account</a>
                                <?php } ?>
                            </div>
                         </div>
                    </div>
                </div>

            </header>

        </div>


        <div class="middle-section">

            <div class="add-banner">
                <img src="<?php echo base_url('assets/n-images/add-with-us.jpg') ?>" alt="Advertise With Us">
                <h1>Promote Your Business With Aileensoul</h1>
            </div>
            <section class="middle-main">
                <div class="container">
                    <div class="pt10">
                        <div class="titlea">
                            <h2 class="pb20" style="font-size: 40px;line-height:45px;color: #1b8ab9;padding-top: 20px;">How to Advertise with us ?</h2>
                        </div>
                        <div class="about-content">
                          <p>
                            <img class="pull-right" src="<?php echo base_url('assets/img/HowtoAdvertiseWithUs.jpg') ?>">
                            <b>Steps</b>:-<br>
                            <ul class="cust-step">
                                <li>Discuss your Requirement.</li>
                                <li>Choose a perticular package.</li>
                                <li>Accept the Agreement.</li>
                                <li>Proceed with the payment.</li>
                                <li>Your advertisement will be displayed.</li>
                            </ul>
                            
                            
                            
                            
                            
                         </p>    
                        
                        </div>
                       <!--  <p class="text-center"><img src="<?php //echo base_url('assets/img/message.png'); ?>"></p> -->
                        <!-- <div class="text-center">
                            <ul class="mail-sent">
                                <li><a title="Email us" href="mailto:hr@aileensoul.com">hr@aileensoul.com</a></li>
                                <li><a title="Email us" href="mailto:info@aileensoul.com">info@aileensoul.com</a></li>
                                <li><a title="Email us" href="mailto:inquiry@aileensoul.com">inquiry@aileensoul.com</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>


   <div class="container">
                    <div class="pt10">
                        <div class="titlea">
                            <h1 class="pb20">How your advertise Display?</h1>
                        </div>
                        <div class="about-content">
                          <p>
                            <img class="pull-left" src="<?php echo base_url('assets/img/Advertisedisplay.jpg') ?>">
                            Founded in 2017, Aileensoul is a new age portal that amalgamates a variety of career-oriented services into a single unified platform with an aim to address the needs of  jobseekers, recruiters, business professionals, freelancers and artists - all under one roof! Introduced to fulfil one of the most fundamental and important aspects of an individual’s life - one’s desire to land a rewarding and successful career for himself or herself - Aileensoul’s futuristic platform serves to launch and advance the careers of first-time jobseekers, experienced business 
                         </p>    
                        
                        </div>
                       <!--  <p class="text-center"><img src="<?php //echo base_url('assets/img/message.png'); ?>"></p> -->
                        <!-- <div class="text-center">
                            <ul class="mail-sent">
                                <li><a title="Email us" href="mailto:hr@aileensoul.com">hr@aileensoul.com</a></li>
                                <li><a title="Email us" href="mailto:info@aileensoul.com">info@aileensoul.com</a></li>
                                <li><a title="Email us" href="mailto:inquiry@aileensoul.com">inquiry@aileensoul.com</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>



            <div class="container">
                <div class="add-form">
                    <h3>Advertise With Us</h3>
					
                    <form name="advertise" id="advertise" method="POST">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="firstname" name="firstname" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="lastname" name="lastname"  placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" id="email" name="email" placeholder="Email Address">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea id="message" name="message" placeholder="Your Requirement"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <input type="submit" class="btn1" id="submit" name="submit" value="Submit">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
				<p class="text-center more-support">For more support <a href="mailto:inquiry@aileensoul.com">inquiry@aileensoul.com</a>
			</div>
        </div>
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog"  >
            <div class="modal-dialog modal-lm" >
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $login_footer ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js?ver=<?php echo time(); ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
        <script src="<?php echo base_url('assets/js/webpage/advertise.js?ver=' . time()); ?>); ?>"></script>
    </body>
</html>