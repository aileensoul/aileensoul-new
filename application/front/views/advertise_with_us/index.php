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
<html lang="en">
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
        <?php } else { ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/bootstrap.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/animte.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/font-awesome.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/owl.carousel.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/jquery.mCustomScrollbar.min.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/component.css?ver=' . time()); ?>" />
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-commen.css?ver=' . time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/n-css/n-style.css?ver=' . time()); ?>">
        <?php } ?>
    </head>
    <body class="main-db add-with-us">
        <div class="web-header">
            <header class="custom-header">
                <div class="header animated fadeInDownBig">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 left-header">
                                <h2 class="logo"><a href="#">Aileensoul</a></h2>
                                <!--form>
                                        <input type="text" name="search" placeholder="Search..">
                                </form-->
                            </div>
                            <div class="col-md-6 col-sm-6 right-header text-right">
                                <a href="#" class="btn6">Login</a>
                                <a href="#" class="btn7">Create an account</a>
                            </div>

                        </div>
                    </div>
                </div>

            </header>

        </div>

        <div class="mobile-header">
            <header class="">
                <div class="header animated fadeInDownBig">
                    <div class="container">

                        <div class="left-header">
                            <h2 class="logo"><a href="#"><img src="<?php echo base_url('assets/n-images/mob-logo.png') ?>"></a></h2>
                            <div class="search-mob-block">
                                <div class="">
                                    <a href="#search">
                                        <input type="search" id="tags1" class="tags" name="skills" value="" placeholder="Job Title,Skill,Company" />
                                    </a>
                                </div>
                                <div id="search">
                                    <form method="get">
                                        <div class="new-search-input">
                                            <input type="search" id="tags1" class="tags" name="skills" value="" placeholder="Job Title,Skill,Company" />
                                            <input type="search" id="searchplace1" class="searchplace" name="searchplace" value="" placeholder="Find Location" />

                                        </div>
                                        <div class="new-search-btn">
                                            <button type="button" class="close-new btn">Cancel</button>
                                            <button type="submit"  id="search_btn" class="btn btn-primary" onclick="return check();">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="right-header">
                                <ul>
                                    <li class="dropdown user-id">
                                        <a href="#" class="dropdown-toggle user-id-custom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="usr-img"><img src="img/user-pic.jpg"></span><span class="pr-name"></span></a>

                                        <ul class="dropdown-menu profile-dropdown">
                                            <li>Account</li>
                                            <li><a href="#"><i class="fa fa-cog"></i> Setting</a></li>
                                            <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

            </header>
            <div class="sub-header">
                <div class="container">
                    <div class="row">

                        <ul class="sub-menu">

                            <li>
                                <a href="#"><i class="fa fa-home" aria-hidden="true"></i> Artistic Profile</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope" aria-hidden="true"></i><span class="none-sub-menu"> Message</span>
                                    <span class="noti-box">1</span>
                                </a>

                            </li>

                            <li class="dropdown user-id">
                                <a href="#" class="dropdown-toggle user-id-custom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span class="pr-name"><span class="none-sub-menu"> Account</span></span></a>

                                <ul class="dropdown-menu account">
                                    <li>Account</li>
                                    <li><a href="#"><i class="fa fa-cog"></i> Setting</a></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul>


                    </div>
                </div>

            </div>






            <div class="mob-bottom-menu">
                <ul>
                    <li>
                        <a href="opportunities.html"><img src="n-images/op-bottom.png"></a>
                    </li>
                    <li id="add-contact" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="n-images/add-contact-bottom.png">
                            <span class="noti-box">1</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="n-images/message-bottom.png">
                            <span class="noti-box">1</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="n-images/noti-bottom.png">
                            <span class="noti-box">1</span>
                        </a>
                    </li>
                    <li>
                        <button id="showRight"><img src="n-images/mob-menu.png"></button>
                    </li>


                </ul>
            </div>
        </div>

        <div class="middle-section">

            <div class="add-banner">
                <img src="<?php echo base_url('assets/n-images/add-with-us.jpg') ?>">
            </div>
            <div class="container">
                <div class="add-form">
                    <h3>Advertise With Us</h3>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="First Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Email Address">
                                </div>

                            </div>
                        </div>




                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea placeholder="Your Requirement"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="" class="btn1">Send</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/classie.js"></script>
        
    </body>
</html>