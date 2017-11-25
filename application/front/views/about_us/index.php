<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About Aileensoul.com and its vision and mission</title>
        <meta name="description" content="Aileensoul.com have something to give this world, Know about us." />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png?ver='.time()); ?>">
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
        <link rel="stylesheet" href="<?php echo base_url('assets/css/common-style.css?ver='.time()) ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style-main.css?ver='.time()) ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        

    </head>
    <body class="about-us">
        <div class="main-inner">
           <div class="terms-con-cus">
            <header class="terms-con bg-none">
                <div class="overlaay">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-3">
                                <h2 class="logo"><a href="<?php echo base_url(); ?>">Aileensoul</a></h2>
                            </div>
                            <div class="col-md-8 col-sm-9">
                                <div class="btn-right pull-right">
                                <?php if(!$this->session->userdata('aileenuser')) {?>
                                    <a href="<?php echo base_url('login'); ?>" class="btn2">Login</a>
                                    <a href="<?php echo base_url('registration'); ?>" class="btn3">Create an account</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div  style="text-align: center;padding: 175px;">
            <section class="">
                <div class="main-comtai">
                    <!-- <h1>Terms and Conditions</h1> -->
                    <h2 style="font-size: 50px;color: #ffffff;padding-bottom: 40px;">About Us</h2>
                    <p class="" style="font-size: 30px;color: #ffffff;">We provide platform & opportunities to every person in the world to make their career.</p>
                </div>
            </section>
            </div>
            </div>
        </div>
            <section class="middle-main">
                <div class="container">
                    <div class="pt10">
                        <div class="titlea">
                            <h1 class="pb20">What is Aileensoul</h1>
                        </div>
                        <div class="about-content">
                            Aileensoul is dedicated purely towards providing relentless and free platform to everyone. We provide a diversified platform for every kind of person. You can hire, recruit, and find a job of your preference in your required field. You can also find freelancing work from our site. Aileensoul targets every kind of population be it a person from artistic field or a person working in a contemporary setup. Beginning from hiring a housemaid to hiring an employ for your business, Aileensoul has it all. Any person looking for any kind of job or wants to showcase his/her artistic talent are free to create their profile. We want the gap that exists between the employer and employee to be fulfilled and hence creating a vast platform for employment as well as different services. 
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
                            <h1 class="pb20">Our Mission</h1>
                        </div>
                        <div class="about-content">
                            Career is the most important aspect in every person's life and we want to add value to the society by providing a platform to each and every person in the world & help them grow their career.

                      <br>
                       
                            AileenSoul works with a mission to free this world from unemployment and poverty, hereby touching everyone's lives.

                        </div>
                       
                    </div>
                </div>





                <div class="container">
                    <div class="pt10">
                        <div class="titlea">
                            <h1 class="pb20">Our Team</h1>
                        </div>
                       <div class="about-content">
                           Coming together is a beginning, staying together is progress, and working together is success.<br>
                    -Henry Ford 
                        </div>
                        <div class="all-tem">
                           <ul class="">
                            <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/NishaRaj.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Nisha Raj</h4>
                                    <p>Content Head</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/YatinBelani.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Yatin Belani</h4>
                                    <p>Project Manager</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/Shashvat.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Shashwat Barbhaya</h4>
                                    <p>Business Manager</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/himanshuSadadiya.jpeg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Himanshu Sadadiya</h4>
                                    <p>AWS Architect/Devops Expert</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/AnkitMakadiya.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Ankit Makadiya</h4>
                                    <p>Technical Head</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/KhyatiRaval.jpeg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Khyati Raval </h4>
                                    <p>Sr. Web Developer</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/nikunj.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Nikunj Bhalodiya </h4>
                                    <p>Software Tester</p>
                                </div>
                             </li>

                                <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/Harshad.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Harshad Patoliya</h4>
                                    <p>Sr. Web Designer</p>
                                </div>
                             </li>

                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/PRASHANT.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Prashant Dadhaniya</h4>
                                    <p>Sr. SEO Executive</p>
                                </div>
                             </li>

                                <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/JayPatel.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Jay Patel</h4>
                                    <p>Jr. SEO Executive</p>
                                </div>
                             </li>

                                <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/PallaviPanalia.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Pallavi Panaliya</h4>
                                    <p>Jr. Web Developer</p>
                                </div>
                             </li>

                                

                             </ul>


                              <ul class="">
                            <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/Dhavalshah.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Dhaval Shah</h4>
                                    <p>Jr. Web Designer</p>
                                </div>
                             </li>


                             <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/FalguniTank.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Falguni Tank</h4>
                                    <p>Jr. Web Developer</p>
                                </div>
                             </li>

                         </ul>

                          <ul class="Main-im">
                            <li class="img-custom">
                                <div class="team-1">
                                    <img src="assets/img/ShahDhaval.jpg">
                                </div>
                                 <div class="text-custom">
                                    <h4>Dhaval Shah</h4>
                                    <p>CEO</p>
                                </div>
                             </li>
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