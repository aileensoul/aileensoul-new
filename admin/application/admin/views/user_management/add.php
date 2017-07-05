
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

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



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

                                $form_attr = array('name' => 'add_driver', 'id' => 'add_user', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('user_management/add_insert', $form_attr);

                                ?>

                                

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Username</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="admin_username" name="username" value="" class="form-control">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">First Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="first_name" name="first_name" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Last Name</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="last_name" name="last_name" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Email</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="user_email" name="user_email" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Password</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="user_password" name="user_password" value="" class="form-control">

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">DOB</label>

                                    <div class="col-sm-7">

                                   
                                        <input type="text" id="datepicker" name="dob" value="" class="form-control" />
                                        <!-- <input type="text" id="admin_name" name="admin_name" value="" class="form-control"> -->

                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">Gender</label>

                                    <div class="col-sm-7">

                                        <input type="radio" id=gender_male name="user_gender" value="M" > Male

                                        <input type="radio" id=gender_male name="user_gender" value="F" > Female

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">User Image</label>

                                    <div class="col-sm-4">

                                        <input type="file" name="user_image" value="" id="user_image" class="form-control">

                                      <!--   <span class="help-block"><i>Admin Image Upload Size : 200px X 200px </i></span> -->

                                    </div>
                                    <div class="form-group">

                                   <div class="col-sm-5">

                                    <div class="col-sm-7">

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>
                                    </div>

                                </div>



                                </div>

                                <!-- <div> -->
                                <!-- <div class="done">
                                <input type="submit" name="submit" value="submit">

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>

                                </div> -->

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
        <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

    <script type="text/javascript">

            $(document).ready(function () {

                $("#add_user").validate({
                    rules: {

                        username:{
                            required:true
                        },
                        first_name:{
                            required:true
                        },
                        last_name:{
                            required:true
                        },
                        user_email:{
                            required:true
                        },
                        user_password:{
                            required:true
                        },
                       datepicker:{
                        required:true
                       },
                       gender_male:{
                        required:true
                       },
                       user_image:{
                        required:true
                       },
                       
                       
                    },

                    ignore : [],

                    messages: {
                        
                        username:{
                            required:"User Name is required."
                        },
                        first_name:{
                            required:"First Name is required."
                        },
                        last_name:{
                            required:"Last name is required."
                        },
                        user_email:{
                            required:"E-mail is required."
                        },
                        user_password:{
                            required:"Password is required."
                        },
                        datepicker:{
                            required:"Date is required."
                        },
                        gender_male:{
                            required:"Gender is required."
                        },
                        user_image:{
                            required:"User image  required. "
                        },

                    },

                });

            });
</script>

       
        <script>
  $( function() {

    $( "#datepicker" ).datepicker();
  } );
  </script>

        <!-- CK Editor -->



    </body>

</html>

