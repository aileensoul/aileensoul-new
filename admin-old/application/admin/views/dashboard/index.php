<!DOCTYPE html>
<html lang="en">
    <?php
    echo $head;
    ?>
    <body>
        <?php
//echo date('F');
//for ($i = 1; $i < 7; $i++) {
//  echo date('F ', strtotime("-$i month"));
//} die(); 
        ?>
        <section id="container" >
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <?php echo $header; ?>

            <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
            <?php
            echo $leftbar;
            ?>

            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">

                    <div class="row">
                        <div class="col-lg-9 main-chart">

                            <div class="row mtbox">
                                
                                <a href="<?php echo site_url('artistic'); ?>"title="email format">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-university"></span>
                                            <h3><?php echo count($art_list); ?></h3>
                                        </div>
                                        <p>Artistic Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('faq'); ?>"title="faq management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-male"></span>
                                            <h3><?php echo count($faq_list); ?></h3>
                                        </div>
                                        <p>FAQ Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('job'); ?>"title="job management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-user"></span>
                                            <h3><?php echo count($job_list); ?></h3>
                                        </div>
                                        <p>JOB Management</p>
                                    </div>
                                </a>
                              
                                <a href="<?php echo site_url('freelancer_hire'); ?>"title="work order">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-money"></span>
                                            <h3><?php echo count($freelancer_list); ?></h3>
                                        </div>
                                        <p>Frelancer Hire Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('stream'); ?>"title="user management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-users"></span>
                                            <h3><?php echo count($stream_list); ?></h3>
                                        </div>
                                        <p>Stream Management</p>
                                    </div>
                                </a> 

                                  <a href="<?php echo site_url('user_management'); ?>"title="email format">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-university"></span>
                                            <h3><?php echo count($user_list); ?></h3>
                                        </div>
                                        <p>USER Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('Recruiter_management'); ?>"title="client management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-male"></span>
                                            <h3><?php echo count($rec_list); ?></h3>
                                        </div>
                                        <p>Recruiter Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('Business_management'); ?>"title="driver management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-user"></span>
                                            <h3><?php echo count($business_list); ?></h3>
                                        </div>
                                        <p>Business Management</p>
                                    </div>
                                </a>
                               
                                <a href="<?php echo site_url('freelancer_post_registration'); ?>"title="work order">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-money"></span>
                                            <h3><?php echo count($freelance_post); ?></h3>
                                        </div>
                                        <p>Freelancer Post Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo site_url('degree'); ?>"title="user management">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-users"></span>
                                            <h3><?php echo count($degree); ?></h3>
                                        </div>
                                        <p>Degree</p>
                                    </div>
                                </a>                  

                                 <a href="<?php echo site_url('business_type'); ?>"title="business type">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-users"></span>
                                            <h3><?php echo count($businesstype); ?></h3>
                                        </div>
                                        <p>Business Type</p>
                                    </div>
                                </a>                 
                                 <a href="<?php echo site_url('industry_type'); ?>"title="industry type">
                                    <div class="col-md-4 col-sm-4 col-xs-6 box0">
                                        <div class="box1">
                                            <span class="fa fa-users"></span>
                                            <h3><?php echo count($industrytype); ?></h3>
                                        </div>
                                        <p>Industry Type</p>
                                    </div>
                                </a>                                                              
                            </div><!-- /row mt -->	

                        </div><!-- /col-lg-9 END SECTION MIDDLE -->


                        <!-- **********************************************************************************************************************************************************
                        RIGHT SIDEBAR CONTENT
                        *********************************************************************************************************************************************************** -->                  

                       <!--  <div class="col-lg-3 ds"> -->
                            <!--COMPLETED ACTIONS DONUTS CHART-->
                            <!-- CALENDAR-->
                           <!--  <div id="calendar" class="mb">
                                <div class="panel green-panel no-margin">
                                    <div class="panel-body">
                                        <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                            <div class="arrow"></div>
                                            <h3 class="popover-title" style="disadding: none;"></h3>
                                            <div id="date-popover-content" class="popover-content"></div>
                                        </div>
                                        <div id="my-calendar"></div>
                                    </div>
                                </div>
                            </div> --><!-- / calendar -->

                        <!-- </div> --><!-- /col-lg-3 -->
                    </div><! --/row -->
                </section>
            </section>

            <!--main content end-->

            <?php
            echo $footer;
            ?>

        </section>

        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('admin/assets/js/jquery-1.8.3.min.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>
        <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('admin/assets/js/jquery.sparkline.js') ?>"></script>


        <!--common script for all pages-->
        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('admin/admin/assets/js/gritter/js/jquery.gritter.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/gritter-conf.js') ?>"></script>

        <!--script for this page-->
         <script src="<?php echo base_url('admin/assets/js/zabuto_calendar.js'); ?>"></script> 
        
        <script type="application/javascript">
            $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
            $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
            action: function () {
            return myDateFunction(this.id, false);
            },
            action_nav: function () {
            return myNavFunction(this.id);
            },
            
            });
            });


            function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
            }
        </script>        
<!--        <script type="application/javascript">
            $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
            $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
            action: function () {
            return myDateFunction(this.id, false);
            },
            action_nav: function () {
            return myNavFunction(this.id);
            },
            ajax: {
            url: "show_data.php?action=1",
            modal: true
            },
            legend: [
            {type: "text", label: "Special event", badge: "00"},
            {type: "block", label: "Regular event", }
            ]
            });
            });


            function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
            }
        </script> -->
    </body>
</html>
