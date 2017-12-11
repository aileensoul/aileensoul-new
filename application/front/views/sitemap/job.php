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
        <link rel="stylesheet" href="<?php echo base_url('assets/css/common-style.css?ver=' . time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css?ver=' . time()) ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body class="site-map" >
        <div class="main-inner">
            <?php echo $sitemap_header ?>
            <section class="middle-main">
                <div class="container">
                    <!-- html code for inner page  -->
                    <div class="all-site-link cust-link">
                        <!-- <h3>Job Profile <span>Categories</span></h3> -->
                        <h2>Job Profile</h2>
                       <ul>
                            <li style="margin-bottom: 35px;list-style-type: none;margin-left: -14px;"><a href="https://www.aileensoul.com/jobs">All Jobs</a></li>
                        </ul>
                        <div class="all-site-link ">
                     
                        
                     <h3 style="padding-bottom: 15px;">Job Posts by Location</h3>
                        <div class="linkbox">
                        </div>
                           
                        </div>
                        <div class="linkbox">
<?php
                            foreach ($getJobDataByLocation as $key => $value) {
                                ?>
                                <div class="smap-catbox">
                                    <div class="catbox-left">
                                        <h5><?php echo $key ?></h5>
                                    </div>
                                    <ul class="catbox-right">
                                        <?php foreach ($value as $business) {
                                            
                                            if ($business['post_name'] != '') {
                        $text = strtolower($this->common->clean($business['post_name']));
                    } else {
                        $text = '';
                    } 
                     if ($business['city_name'] != '') {
                        $cityname = '-vacancy-in-' . strtolower($this->common->clean($business['city_name']));
                    } else {
                        $cityname = '';
                    }?>
                                        <li><a href="<?php echo base_url('recruiter/jobpost/' . $text . $cityname . '-' . $business['user_id'] . '-' . $business['post_id']) ?>" target="_blank"><?php echo $business['post_name'] . '(' . $business['re_comp_name'] . ")"; ?></a></li>    
                                        <?php } ?>
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

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