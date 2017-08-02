<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grow Business Network|Hiring|Search Jobs|Freelance Work|It's Free|Aileensoul</title>
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="css/common-style.css">
        <link rel="stylesheet" href="css/style-main.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
    </head>
    <body>
        <div class="main-inner" class="feedback">
            <?php
            echo $login_header
            ?>
            <section class="middle-main">
                <div class="container">
                    <div class="form-pd row">
                        <div id="feedbacksucc"></div>
                        <div class="inner-form">
                            <div class="login">
                                <div class="title">
                                    <h1>Send us feedback</h1>
                                </div>
                                <form role="form" name="feedback_form" id="feedback_form" method="post">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="feedback_firstname" id="feedback_firstname" class="form-control input-sm" placeholder="First Name*">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="feedback_lastname" id="feedback_lastname" class="form-control input-sm" placeholder="Last Name*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="feedback_email" id="feedback_email" class="form-control input-sm" placeholder="Email Address*">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="feedback_subject" id="feedback_subject" class="form-control input-sm" placeholder="Subject*">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="text" id="feedback_message" name="feedback_message" class="form-control" placeholder="Message*"></textarea>
                                    </div>
                                    <p class="pb15">
                                        <span class="red">*</span>All fields are mendatory
                                    </p>
                                    <p>
                                        <button class="btn1">Submit</button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php echo $login_footer ?>
        </div>
        <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/feedback.js'); ?>"></script>
    </body>
</html>