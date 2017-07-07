  <!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>



    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                    <h3><i class="fa fa-angle-right"></i> <?php echo $module_name; ?></h3>



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">

                        <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $page_name; ?></h4>

                                <?php

                                if ($this->session->flashdata('site_setting_success')) {

                                    echo $this->session->flashdata('site_setting_success');

                                }

                                ?>

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



                                <input type="submit" class="btn btn-theme" name="submit" value="Submit" />



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

                $("#site_setting").validate({

                    rules: {

                        site_email: {

                            email: true

                        },

                        site_url: {

                            url: true

                        }

                    },

                    messages: {

                        site_email: {

                            email: "Please enter a valid email address"

                        },

                        site_url: {

                            url: "Please Enter valid Url"

                        }

                    },

                });



            });

        </script>

    </body>

</html>

