<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sitemap | Aileensoul.com</title>
        <meta name="description" content="Aileensoul.com have something to give this world, Know about us." />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png?ver=' . time()); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <?php
        if ($_SERVER['HTTP_HOST'] != "localhost") {
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
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
                (adsbygoogle = window.adsbygoogle || []).push({
                    google_ad_client: "ca-pub-6060111582812113",
                    enable_page_level_ads: true
                });
        </script>
        <style type="text/css">
            .full_page ul li{
                width: 100% !important;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/common-style.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css?ver=' . time()) ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="site-map" >
        <div class="main-inner ">
            <?php echo $sitemap_header ?>
            <section class="middle-main">
                <div class="container">
                    <!-- html code for inner page  -->
                    <div class="all-site-link">
                        <h2 style="margin-left: -2px;">Freelance Profile</h2>
                        <h3>Freelance Hire</h3>
                        <div class="linkbox full_page">
                            <div class="smap-catbox">
                               <ul class="catbox-right artist-sitemap">
                                    <li style="list-style-type: circle;font-size: 20px;">Login/Register</li>
                                    <li style="padding-bottom: 30px;">Register/Takeme in</li>
                                    <!--<li><a href="<?php echo base_url() ?>freelancer-hire/add-projects" target="_blank">Post a Project</a></li>-->
                                    <li style="margin-left: -20px;padding-left: 38px;font-size: 20px;cursor: text;"><a style="text-transform: none;color: #333;pointer-events: none;" href=""> Post a Project </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="all-site-link cust-link">
                        <h3>Freelance Apply</h3>

                        <ul>
                            <li style="margin-bottom: 35px;list-style-type: none;margin-left: -15px;"><a href="https://www.aileensoul.com/projects">All Freelance Projects</a></li>
                            <li style="list-style-type: none;margin-left: -13px;margin-bottom: 30px;"><h4>Projects by Field</h4></li>
                        
                        </ul>
                        <div class="linkbox">
                           <?php foreach($getFreepostDataByCategory as $key => $value){  ?>
                            <div class="smap-catbox">

                                <div class="catbox-left">
                                    <h5><?php echo $key; ?></h5>
                                </div>
                                <ul class="catbox-right">
                                   <?php foreach($value as $projects){ 
                                       
                                        if ($projects['post_name'] != '') {
                        $text = strtolower($this->common->clean($projects['post_name']));
                    } else {
                        $text = '';
                    } 
                     if ($projects['city_name'] != '') {
                        $cityname = '-vacancy-in-' . strtolower($this->common->clean($projects['city_name']));
                    } else {
                        $cityname = '';
                    }?>
                                    <li><a href="<?php echo base_url('freelancer-hire/project/' . $text . $cityname . '-' . $projects['user_id'] . '-' . $projects['post_id']) ?>"><?php echo $projects['post_name'] . '(' . $projects['fullname'] . ' ' . $projects['username'] . ')'; ?></a></li>
                           <?php } ?>
                                </ul>
                            </div>
                           <?php } ?>

                        </div>
                    </div>

                </div>

            </section>
            <?php
            echo $login_footer
            ?>
        </div>
        <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/aboutus.js'); ?>"></script>
    </body>
</html>