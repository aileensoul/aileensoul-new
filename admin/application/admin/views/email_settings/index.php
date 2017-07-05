<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>



    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                         <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li class="active">email settings</li>

                 </ol>

                    <!-- end breadcumb -->

                    <h3><i class="fa fa-angle-right"></i> <?php echo $module_name; ?></h3>



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">

                        <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'email_setting', 'id' => 'email_setting', 'class' => 'form-horizontal style-form');

                                echo form_open('email_settings/do_email_settings', $form_attr);

                                

                                ?>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Host Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="host_name" value="<?php echo $host_name ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Out Going Port</label>

                                    <div class="col-sm-7">

                                        <input type="tet" name="out_going_port" value="<?php echo $out_going_port ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="user_name" value="<?php echo $user_name ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Password</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="password" value="<?php echo $password ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Receiver Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" name="receiver_email" value="<?php echo $receiver_email ?>" class="form-control">

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="done col-sm-offset-2 col-sm-10" >

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" /> 

                                </div>

                                </div>

                                

                                </form>

                            </div>

                        </div><!-- col-lg-12-->      	

                    </div><!-- /row -->





                </section><! --/wrapper -->

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

        <script src="<?php echo base_url('admin/assets/js/jquery.sparkline.js') ?>"></script>





        <!--common script for all pages-->

        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>



        <!--script for this page-->

        <script src="<?php echo base_url('admin/assets/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>



        <!--custom switch-->

        <script src="<?php echo base_url('admin/assets/js/bootstrap-switch.js') ?>"></script>



        <!--custom tagsinput-->

        <script src="<?php echo base_url('admin/assets/js/jquery.tagsinput.js') ?>"></script>



        <!--custom checkbox & radio-->



        <script src="<?php echo base_url('admin/assets/js/form-component.js') ?>"></script>    

        <script type="text/javascript">

            $(document).ready(function () {

                $('.alert-success').fadeOut(3000).hide('700');

                $('.alert-danger').fadeOut(3000).hide('700');



            });

        </script>

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#email_setting").validate({

                    rules: {

                        host_name: {

                            required: true

                        },

                        out_going_port: {

                            required: true

                        },

                        user_name: {

                            required: true

                        },

                        password: {

                            required: true

                        },

                        receiver_email: {

                            required: true,

                            email:true

                        }

                    },

                    messages: {

                        host_name: {

                            required: "Please enter host name"

                        },

                        out_going_port: {

                            required: "Please Enter Out Going Port"

                        },

                        user_name: {

                            required: "Please enter user name"

                        },

                        password: {

                            required: "Please enter password"

                        },

                        receiver_email: {

                            required: "Please enter receiver email",

                            email:"Please enter valid receiver email"

                        }

                    },

                });



            });

        </script>

    </body>

</html>

