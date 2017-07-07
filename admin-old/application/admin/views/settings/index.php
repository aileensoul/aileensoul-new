 <!DOCTYPE html>

<html lang="en">



    <!-- Mirrored from blacktie.co/demo/premium/dashgum/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jun 2016 05:43:52 GMT -->

    <?php

    echo $head;

    ?>

    <body>



        <section id="container" >

            <!-- **********************************************************************************************************************************************************

            TOP BAR CONTENT & NOTIFICATIONS

            *********************************************************************************************************************************************************** -->

            <?php

            echo $header;

            ?>



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

            

        <!--/.row-->

                <section class="wrapper site-min-height">

                    <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li class="active">settings</li>

                 </ol>

                    <!-- end breadcumb -->

                    <h3><i class="fa fa-angle-right"></i> <?php echo $module_name; ?></a></h3>

                    <div class="row mt dta">



                        <div class="col-lg-12 mt set_data">		

                            <div class="row content-panel">

                                

                                

                                <?php

                                if($this->session->flashdata('error'))

                                {

                                    echo $this->session->flashdata('error');

                                }

                                 if($this->session->flashdata('success'))

                                {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                

                                <div class="panel-heading">

                                    <ul class="nav nav-tabs nav-justified">

                                        <li class="active">

                                            <a data-toggle="tab"  href="#overview"><i class="fa fa-user"></i> Edit Profile</a>

                                        </li>

                                        <li>

                                            <a data-toggle="tab" href="#contact" class="contact-map"><i class="fa fa-key"></i> Change Password</a>

                                        </li>

                                        <li>

                                            <a data-toggle="tab" href="#edit"><i class="fa fa-cog"></i> Site Settings</a>

                                        </li>

                                    </ul>

                                </div><!--panel-heading -->



                                <div class="panel-body">

                                    <div class="tab-content">

                                        <div id="overview" class="tab-pane active">

                                            <div class="row">



                                                <div class="col-lg-8 col-lg-offset-2 detailed mt">

                                                    <h4 class="mb">Edit Profile</h4>

                                                    <?php

                                                    $form_attr = array('name' => 'profile', 'id' => 'profile', 'class' => 'form-horizontal style-form');

                                                    echo form_open_multipart('settings/edit_profile', $form_attr);


                                                    ?>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Admin Name</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="admin_name" value="<?php echo $admin_name; ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Admin Email</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="admin_email" value="<?php echo $admin_email; ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Profile Image</label>

                                                        <div class="col-sm-7">
                                                        
                                                            <input type="file" name="admin_image" class="form-control" value="<?php echo $admin_image; ?>">
                                                             <img src="<?php echo base_url(ADMINIMAGE. $admin_image);?>" style="width:100px;height:100px;">



                                                        </div>

                                                    </div>



                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label"></label>

                                                        <div class="col-sm-10">

                                                            



                                                        </div>

                                                    </div>

                                                    <div class="done">

                                                    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>" />

                                                    <div class="col-sm-offset-2 col-sm-10" style="padding-left: 5px;"><input type="hidden" name="old_image" value="<?php echo $old_image; ?>" />

                                                    <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                                    <button type="reset" class="btn btn-default btn_my">Reset</button></div>

                                                    <input type="hidden" name="redirect_url" id="redirect_url" value="<?php

                                                    if (isset($_SERVER['HTTP_REFERER'])) {

                                                        echo $_SERVER['HTTP_REFERER'];

                                                    }

                                                    ?>" />

                                                    </div>

                                                    </form>

                                                </div><!--col-lg-8 -->

                                            </div><!--row -->

                                        </div> <!--tab-pane -->



                                     <div id="contact" class="tab-pane">

                                            <div class="row">



                                                <div class="col-lg-8 col-lg-offset-2 detailed mt">

                                                    <h4 class="mb">Change Password</h4>

                                                    <?php

                                                    $form_attr = array('name' => 'change_password', 'id' => 'change_password', 'class' => 'form-horizontal style-form');

                                                    echo form_open('settings/do_change_password', $form_attr);

                                                    ?>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Old Password</label>

                                                        <div class="col-sm-7">

                                                            <input type="password" name="old_password" id="old_password" value="" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">New Password</label>

                                                        <div class="col-sm-7">

                                                            <input type="password" name="new_password" id="new_password" value="" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Confirm Password</label>

                                                        <div class="col-sm-7">

                                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="done col-sm-offset-2 col-sm-10" style="padding-left: 5px;">

                                                    <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

  <button type="reset" class="btn btn-default btn_my">Reset</button>

                                                    </div>

                                                    </form>

                                                </div><!--col-lg-8 -->

                                            </div><!--row -->

                                        </div> <!--tab-pane -->




                                        <div id="edit" class="tab-pane">                                            <div class="row">



                                                <div class="col-lg-8 col-lg-offset-2 detailed mt">

                                                    <h4 class="mb">Site Settings</h4>

                                                    <?php

                                                    $form_attr = array('name' => 'site_setting', 'id' => 'site_setting', 'class' => 'form-horizontal style-form');

                                                    echo form_open('settings/do_site_settings', $form_attr);

                                                    ?>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Site Name</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="site_name" value="<?php echo $site_name ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Site Url</label>

                                                        <div class="col-sm-7">

                                                            <input type="tet" name="site_url" value="<?php echo $site_url ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Site Owner</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="site_owner" value="<?php echo $site_owner ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Site Email</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="site_email" value="<?php echo $site_email ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="form-group">

                                                        <label class="col-sm-2 col-sm-2 control-label">Site Phone</label>

                                                        <div class="col-sm-7">

                                                            <input type="text" name="site_mobile" value="<?php echo $site_mobile ?>" class="form-control">

                                                        </div>

                                                    </div>

                                                    <div class="done col-sm-offset-2 col-sm-10" style="padding-left: 5px;">

                                                    <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                                     <button type="reset" class="btn btn-default btn_my">Reset</button>

                                                    </div>

                                                    </form>

                                                </div><!--col-lg-8 -->

                                            </div><!--row -->

                                        </div> <!--tab-pane -->

                                    </div><!--tab-content -->



                                </div><!--panel-body -->



                            </div><!-- col-lg-12 -->

                        </div><!--row -->

                    </div><!--container -->



                </section><!--wrapper -->

            </section><!-- /MAIN CONTENT -->



            <!--main content end-->

<?php echo $footer; ?>



        </section>



        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('admin/assets/js/jquery.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>

        <!--common script for all pages-->

        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>

        <!--script for this page-->

        <!-- MAP SCRIPT - ALL CONFIGURATION IS PLACED HERE - VIEW OUR DOCUMENTATION FOR FURTHER INFORMATION -->

    <!--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&amp;sensor=false"></script>

    

            <script>    

            $('.contact-map').click(function(){

            

                //google map in tab click initialize

                function initialize() {

                    var myLatlng = new google.maps.LatLng(40.6700, -73.9400);

                    var mapOptions = {

                        zoom: 11,

                        scrollwheel: false,

                        center: myLatlng,

                        mapTypeId: google.maps.MapTypeId.ROADMAP

                    }

                    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                    var marker = new google.maps.Marker({

                        position: myLatlng,

                        map: map,

                        title: 'DashGum Admin Theme!'

                    });

                }

                google.maps.event.addDomListener(window, 'click', initialize);

            });

            </script>    -->



        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () {



                $("#change_password").validate({

                    rules: {

                        old_password: {

                            required: true,

                            remote: {

                                url: "<?php echo base_url() . 'settings/check_oldpassword' ?>",

                                type: "post",

                                data: {

                                    old_password: function () {

                                        var old_password =   $("#old_password").val();

                                        return old_password;

                                    },

                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                                },

                            },

                        },

                        new_password: {

                            required: true,

                        },

                        confirm_password: {

                            required: true,

                            equalTo: "#new_password"

                        }

                    },

                    messages: {

                        old_password: {

                            required: "Old Password Is Required",

                            remote:"Old Password Is Not Correct."

                        },

                        new_password: {

                            required: "New Password Is Required",

                        },

                        confirm_password: {

                            required: "Confirm Password Is Required",

                            equalTo: "New Password And Confirm Password Not Match"

                        }

                    },

                });



            });

        </script>

        <script type="text/javascript">

            $(document).ready(function () {

                $(".alert-danger").fadeOut(3000).hide("1000");

                $(".alert-success").fadeOut(3000).hide("1000");

            });

        </script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#profile").validate({

                    rules: {

                        admin_email: {

                            required:true,

                            email: true,

                        },

                        admin_name: {

                            required: true,

                        }

                    },

                    messages: {

                        admin_email: {

                            required:"Please enter email id",

                            email: "Please enter a valid email address",

                        },

                        admin_name: {

                            email: "Please enter a admin name",

                        }

                    },

                });



            });

        </script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#site_setting").validate({

                    rules: {

                        site_email: {

                            required: true,

                            email: true,

                        },

                        site_url: {

                            url: true,

                        },

                        site_name: {

                            required: true,

                        },

                        site_owner: {

                            required: true,

                        },

                        site_mobile: {

                            required: true,

                        }



                    },

                    messages: {

                        site_email: {

                            required: "Please enter email id",

                            email: "Please enter a valid email address",

                        },

                        site_url: {

                            url: "Please enter valid url",

                        },

                        site_name: {

                            required: "Please enter a valid email address",

                        },

                        site_owner: {

                            required: "Please enter site owner",

                        },

                        site_mobile: {

                            required: "Please enter mobile number",

                        }

                    },

                });



            });

        </script>



    </body>



    <!-- Mirrored from blacktie.co/demo/premium/dashgum/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Jun 2016 05:43:55 GMT -->

</html>

