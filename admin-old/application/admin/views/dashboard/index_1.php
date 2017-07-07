<!DOCTYPE html>
<html lang="en">
    <?php
    echo $head;
    ?>
    <body>

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

                                <a href="<?php echo base_url('settings'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-wrench"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>Setting</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('sem'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-facebook"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>SEM</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('seo'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-bullhorn"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>SEO</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('pages'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-file"></span>
                                            <h3><?php echo count($pages_list); ?></h3>
                                        </div>
                                        <p>pages</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('email_settings'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-envelope"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>Email Setting</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('email_template'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-envelope-o"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>Email Format</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('company_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-university"></span>
                                            <h3><?php echo count($company_list); ?></h3>
                                        </div>
                                        <p>Company Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('client_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-male"></span>
                                            <h3><?php echo count($clients_list); ?></h3>
                                        </div>
                                        <p>Client Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('driver_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-user"></span>
                                            <h3><?php echo count($driver_list); ?></h3>
                                        </div>
                                        <p>Driver Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('truck_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-truck"></span>
                                            <h3><?php echo count($truck_list); ?></h3>
                                        </div>
                                        <p>Truck Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('work_order'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-money"></span>
                                            <h3><?php echo count($work_orders_list); ?></h3>
                                        </div>
                                        <p>Work Order Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('user_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-users"></span>
                                            <h3><?php echo count($user_list); ?></h3>
                                        </div>
                                        <p>Admin User Management</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('activity_logs'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-child"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>Activity Logs</p>
                                    </div>
                                </a>
                                <a href="<?php echo base_url('invoice_management'); ?>">
                                    <div class="col-md-2 col-sm-2 box0">
                                        <div class="box1">
                                            <span class="fa fa-file-text"></span>
                                            <h3>&nbsp;</h3>
                                        </div>
                                        <p>Invoice Management</p>
                                    </div>
                                </a>
                            </div><!-- /row mt -->	


                            <div class="row mt">
                                <!-- SERVER STATUS PANELS -->
                                <div class="col-md-4 col-sm-4 mb">
                                    <div class="white-panel pn">
                                        <div class="white-header">
                                            <h5>TOP COMPANY</h5>
                                        </div>
                                        <?php
                                        if (isset($top_company[1])) {
                                            ?>
                                            <p><img src="<?php echo base_url() . '../uploads/company/thumbs/' . $top_company[1]['company_image'] ?>" alt="<?php echo $top_company[1]['company_name']; ?>" class="img-circle" width="80"></p>
                                            <p><b><?php echo $top_company[1]['company_name'] ?></b></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="small mt">MEMBER SINCE</p>
                                                    <p><?php echo date('Y', strtotime($top_company[1]['company_created_date'])); ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="small mt">WORK ORDER</p>
                                                    <p><?php echo $top_company[0]['value_occurrence'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- /col-md-4-->


                                <div class="col-md-4 col-sm-4 mb">
                                    <div class="white-panel pn">
                                        <div class="white-header">
                                            <h5>TOP CLIENT</h5>
                                        </div>
                                        <?php
                                        if (isset($top_client[1])) {
                                            ?>
                                            <p><img src="<?php echo base_url() . '../uploads/client/thumbs/' . $top_client[1]['client_image'] ?>" alt="<?php echo $top_client[1]['client_name']; ?>" class="img-circle" width="80"></p>
                                            <p><b><?php echo $top_client[1]['client_name'] ?></b></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="small mt">MEMBER SINCE</p>
                                                    <p><?php echo date('Y', strtotime($top_client[1]['client_created_date'])); ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="small mt">WORK ORDER</p>
                                                    <p><?php echo $top_client[0]['value_occurrence'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- /col-md-4 -->

                                <div class="col-md-4 mb">
                                    <!-- WHITE PANEL - TOP USER -->
                                    <div class="white-panel pn">
                                        <div class="white-header">
                                            <h5>TOP DRIVER</h5>
                                        </div>
                                        <?php
                                        if (isset($top_driver[1])) {
                                            ?>
                                            <p><img src="<?php echo base_url() . '../uploads/driver/thumbs/' . $top_driver[1]['driver_image'] ?>" alt="<?php echo $top_driver[1]['driver_name']; ?>" class="img-circle" width="80"></p>
                                            <p><b><?php echo $top_driver[1]['driver_name'] ?></b></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="small mt">MEMBER SINCE</p>
                                                    <p><?php echo date('Y', strtotime($top_driver[1]['driver_create_date'])); ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="small mt">WORK ORDER</p>
                                                    <p><?php echo $top_driver[0]['value_occurrence'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div><!-- /col-md-4 -->


                            </div><!-- /row -->


                            <div class="row mt">
                                <!--CUSTOM CHART START -->
                                <div class="border-head">
                                    <h3>CLIENTS</h3>
                                </div>
                                <div class="custom-bar-chart">
                                    <ul class="y-axis">
                                        <li><span>100.000</span></li>
                                        <li><span>80.000</span></li>
                                        <li><span>60.000</span></li>
                                        <li><span>40.000</span></li>
                                        <li><span>20.000</span></li>
                                        <li><span>0</span></li>
                                    </ul>
                                    <div class="bar">
                                        <div class="title">JAN</div>
                                        <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
                                    </div>
                                    <div class="bar ">
                                        <div class="title">FEB</div>
                                        <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
                                    </div>
                                    <div class="bar ">
                                        <div class="title">MAR</div>
                                        <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
                                    </div>
                                    <div class="bar ">
                                        <div class="title">APR</div>
                                        <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
                                    </div>
                                    <div class="bar">
                                        <div class="title">MAY</div>
                                        <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
                                    </div>
                                    <div class="bar ">
                                        <div class="title">JUN</div>
                                        <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
                                    </div>
                                    <div class="bar">
                                        <div class="title">JUL</div>
                                        <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
                                    </div>
                                </div>
                                <!--custom chart end-->
                            </div><!-- /row -->	

                        </div><!-- /col-lg-9 END SECTION MIDDLE -->


                        <!-- **********************************************************************************************************************************************************
                        RIGHT SIDEBAR CONTENT
                        *********************************************************************************************************************************************************** -->                  

                        <div class="col-lg-3 ds">
                            <!--COMPLETED ACTIONS DONUTS CHART-->
							<?php
							if(count($current_workorder) > 0)
							{
							?>
                            <h3>CURRENT WORK ORDER</h3>

                            <?php
                            foreach ($current_workorder as $workorder) {

                                $company_name = $workorder['company_name'];
                                $client_name = $workorder['client_name'];
                                $wo_create_date = timespan(strtotime($workorder['wo_created_date']), time()) . " ago";
                                ?>

                                <!-- First Action -->
                                <div class="desc">
                                    <div class="thumb">
                                        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                    <div class="details">
                                        <p><muted><?php echo $wo_create_date; ?> </muted><br/>
                                        <a href="#"><?php echo $workorder['wo_name']; ?></a> Work Order Generate for <?php echo $client_name; ?> by <?php echo $company_name; ?> on <?php echo $workorder['wo_date']; ?>  <br/>
                                        </p>
                                    </div>
                                </div>
                                <?php
                            }
							}
                            ?>
							<?php
							if(count($recent_company) > 0 )
							{
							?>
                            <!-- USERS ONLINE SECTION -->
                            <h3>RECENT COMPANIES</h3>
                            <?php
                            foreach ($recent_company as $company) {
                                ?>
                                <div class="desc">
                                    <div class="thumb">
                                        <img class="img-circle" alt="<?php echo $company['company_name']; ?>" src="<?php echo base_url() . '../uploads/company/thumbs/' . $company['company_image'] ?>" width="35px" height="35px" align="">
                                    </div>
                                    <div class="details">
                                        <p><a href="<?php echo base_url('company_management') ?>"><?php echo $company['company_name'] ?></a></p>
                                    </div>
                                </div>
                                <?php
                            }
							}
                            ?>

                            <!-- CALENDAR-->
                            <div id="calendar" class="mb">
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
                            </div><!-- / calendar -->

                        </div><!-- /col-lg-3 -->
                    </div><! --/row -->
                </section>
            </section>

            <!--main content end-->

            <?php
            echo $footer;
            ?>

        </section>

        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script class="include" type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/jquery.sparkline.js') ?>"></script>


        <!--common script for all pages-->
        <script src="<?php echo base_url('assets/js/common-scripts.js') ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('assets/js/gritter/js/jquery.gritter.js') ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/gritter-conf.js') ?>"></script>

        <!--script for this page-->
        <script src="<?php echo base_url('assets/js/zabuto_calendar.js'); ?>"></script>	

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
        </script>
    </body>
</html>
