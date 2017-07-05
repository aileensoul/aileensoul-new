<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>
    
    <link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet" type="text/css">

    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                        <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li><a href="<?php echo site_url('user_management'); ?>">user management</a></li>

                <li class="active">Edit</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?>   <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">

                        <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                if ($this->session->flashdata('error')) {

                                    echo $this->session->flashdata('error');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'add_user', 'id' => 'edit_user', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('user_management/edit_user', $form_attr);

                                ?>

                                

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Username</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="admin_username" name="username" value="<?php echo $user_details[0]['user_name']; ?> " class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="first_name" name="first_name" value="<?php echo $user_details[0]['first_name']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="last_name" name="last_name" value="<?php echo $user_details[0]['last_name']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="user_email" name="user_email" value="<?php echo $user_details[0]['user_email']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Password</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="admin_name" name="user_password" value="<?php echo $user_details[0]['user_name']; ?>" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">DOB</label>

                                    <div class="col-sm-7">

                                   
                                        <input type="text" id="datepicker" name="dob" value="<?php echo $user_details[0]['dob']; ?>" class="form-control" />
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Gender</label>

                                    <div class="col-sm-7">

                                        <input type="radio" id=gender_male name="user_gender" value="M" <?php if($user_details[0]['user_gender'] == 'M') {?> checked="checked" <?php }?> >Male

                                        <input type="radio" id=gender_male name="user_gender" value="F" <?php if($user_details[0]['user_gender'] == 'F') {?> checked="checked" <?php }?> > Female

                                    </div>

                                </div>

                                
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Profile Image</label>

                                    <div class="col-sm-3">

                                        <input type="file" name="user_image" value="" class="form-control">

                                    </div>

                                    <div class="col-sm-4">

                                    <img src="<?php echo base_url(USERIMAGE.$user_details[0]['user_image']); ?>" style="width: 100px; height: 80px;">

                                    </div>

                                    <div class="col-sm-4">

                                       
                                    </div>
                                    <input type="text" name="user_id" value="<?php echo $user_details[0]['user_id']; ?>" />
                                    <input type="hidden" name="old_image" value="<?php echo$user_details[0]['user_image']; ?>" />
                                    <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />


                                </div>

                                <div class="done">

                                <!-- <input type="hidden" name="old_image" value="<?php echo $user_image; ?>" />     -->

                                

                                

                                </div>

                                </form>

                            </div>

                        </div><!-- col-lg-12-->      	

                    </div><!-- /row -->





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

        <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#edit_admin").validate({

                    rules: {

                        admin_name: {

                            required: true,

                        },

                        admin_email: {

                            required: true,

                            email: true,

                            remote: {

                                url: "<?php echo base_url() . 'user_management/check_email' ?>",

                                type: "post",

                                data: {

                                    email: function () {

                                        return $("#admin_email").val();

                                    },admin_id:<?=$admin_id?>

                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                                },

                            },

                        },

                        admin_username: {

                            required: true,

                        }

                       

                    },

                    messages: {

                        admin_name: {

                            required: "Please enter admin name",

                        },

                        admin_email: {

                            required: "Please enter admin email",

                            email: "Please enter valid email id",

                            remote: "Email already exists"

                        },

                        admin_username: {

                            required: "Please enter username",

                        }

                    },

                });

            });

        </script>

        <!-- CK Editor -->
         <script>
  $( function() {

    $( "#datepicker" ).datepicker();
  } );
  </script> 



    </body>

</html>

