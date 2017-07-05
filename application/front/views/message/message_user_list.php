
<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-profile">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="user-img pull-left">
                            <?php if($userdata[0]['user_image'] != ''){ ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="50" width="50" alt="Smiley face" />
                        <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                        <?php } ?>
                        </div>
                        <div class="user-detail pull-left">
                            <h6><?php echo $userdata[0]['first_name'] . $userdata[0]['last_name']; ?></h6>
                            <span>Designation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                                <li><a href="message">Message</a></li>
                                <!-- <li><a href="<?php echo base_url('job/job_address'); ?>">Address</a></li> -->
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
                    <div class="col-md-6 col-sm-8">
                        <div class="job-post-detail clearfix">
                            <div class="exper-location">
                               <center> <span>Messaage</span></center>
                            </div>

                            <div class="job-about">
                            

                            <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>

                               <div>

                                <?php

                                    foreach ($user_list as $value) {
                                         
                                     
                                    echo $value['user_id'];
                                    echo $value['first_name']; echo"<br/>";
                                    ?>

                                    <button><a href="<?php echo base_url('message/message_chat/'.$value['user_id'].''); ?>">Send Message</a></td></button><br/>

                                <?php
                                }
                                    ?>
                               </div> 

                               
                            </div>    
                        </div>
                    </div>
                    <!-- middle section end -->

                    <!-- Role model section start-->
                    <!-- <div class="col-md-3 col-sm-12">
                        <div class="role-model">
                            <div class="role-model-title">
                                Role Model
                            </div>
                            <div class="role-model-img">
                                <img src="../images/sunny-deol.jpg">
                            </div>
                            <div class="role-model-detail">
                                <h6>Sunny Deol</h6>
                                <span>acter</span>
                                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas.</p>
                            </div>
                        </div>
                    </div> -->
                    <!-- Role model section End-->
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <!-- footer start -->
    <footer>
        <!-- <div class="footer text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-logo">
                            <a href="index.html"><img src="images/logo-white.png"></a>
                        </div>
                        <ul>
                            <li>E-912 Titanium City Center Anandngar Ahmedabad-380015</li>
                            <li><a href="mailto:AileenSoul@gmail.com">AileenSoul@gmail.com</a></li>
                            <li>+91 903-353-8102</li>
                        </ul>
                    </div>
                </div>
            </div> -->
        <!-- </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <?php echo $footer;?>
    </footer>
    
</body>
</html>


    <!-- footer end -->
    <!-- end footer -->
    