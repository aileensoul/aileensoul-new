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
            <div class="sm-header">
                <header class="terms-con bg-none">
                    <div class="overlaay">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-sm-3">
                                    <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                                </div>
                                <div class="col-md-8 col-sm-9">
                                    <div class="btn-right pull-right">
                                        <?php if (!$this->session->userdata('aileenuser')) { ?>
                                            <a href="<?php echo base_url('login'); ?>" class="btn2">Login</a>
                                            <a href="<?php echo base_url('registration'); ?>" class="btn3">Create an account</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
				<div class="site-map-all-profile">
					<div class="container">
						<h1 class="text-center">Sitemap</h1>
						<div class="fw text-center">
							<ul>
								<li><a href="#">Job Profile</a></li>
								<li><a href="#">Recruiter Profile</a></li>
								<li><a href="#">Freelance Profile</a></li>
								<li><a href="#">Business Profile</a></li>
								<li><a href="#">Artistic Profile</a></li>
							</ul>
						</div>

					</div>
				</div>
            </div>
			
            <section class="middle-main">
				
					
			<div class="site-map-img">
				<img src="assets/img/sitemap.jpg">
			</div>
                <div class="container">
					
					<!-- html code for inner page  --->
					<div class="all-site-link">
						<h3>Business Profile <span>Categories</span></h3>
						<div class="linkbox">
							
							<div class="smap-catbox">
								<div class="catbox-left">
									<h5>IT</h5>
								</div>
								<ul class="catbox-right">
									
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
								</ul>
							</div>
							<div class="smap-catbox">
								<div class="catbox-left">
									<h5>Bueaty</h5>
								</div>
								<ul class="catbox-right">
									
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
								</ul>
							</div>
							<div class="smap-catbox">
								<div class="catbox-left">
									<h5>Business</h5>
								</div>
								<ul class="catbox-right">
									
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
									<li><a href="#">url-link.html</a></li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- end html code for inner page  --->
                    <div class="pt10">
                        <div class="titlea">
                            <h1 class="pb20">Sitemap</h1>
                        </div>
                        <div class="about-content">
                            <ul>
                                <?php
                                foreach($business_profile as $profile){
                                ?>
                                <li><a href="<?php echo base_url('business-profile/dashboard/'.$profile['business_slug']) ?>"><?php echo $profile['company_name']; ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
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