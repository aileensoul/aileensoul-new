<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact Us by filling given form</title>
        <meta name="description" content="Contact us for any concern and query regarding Aileensoul.com platform." />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php
        if($_SERVER['HTTP_HOST'] != "localhost"){
        ?>
        <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />
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
        <link rel="stylesheet" href="assets/css/common-style.css">
        <link rel="stylesheet" href="assets/css/style-main.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
        
        <script src="<?php echo base_url('assets/js/jquery.fancybox.js'); ?>"></script>
    </head>
    <body class="contact">
        <div class="main-inner">
            <?php echo $login_header; ?>
            <section class="middle-main">
                <div class="container">
                    <div id="contactsucc"></div>
                    <div class="form-pd row">
                        <div class="inner-form">
                            <div class="login">
                                <div class="title">
                                    <h1>Contact us</h1>
                                </div>
                                <form role="form" name="contact_form" id="contact_form" method="post">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="contact_name" id="contact_name" class="form-control input-sm" placeholder="First Name*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="contactlast_name" id="contactlast_name" class="form-control input-sm" placeholder="Last Name*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="contact_email" id="contact_email" class="form-control input-sm" placeholder="Email Address*">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="contact_subject" id="contact_subject" class="form-control input-sm" placeholder="Subject*">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" id="contact_message" name="contact_message" class="form-control" placeholder="Message*"></textarea>

                                    </div>
                                    <p class="pb15">
                                        <span class="red">*</span>All fields are mendatory
                                    </p>
                                    <p>
                                        <button class="btn1">Submit</button>
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <?php echo $login_footer; ?>
</div>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/contactus.js'); ?>"></script>
</body>
</html>