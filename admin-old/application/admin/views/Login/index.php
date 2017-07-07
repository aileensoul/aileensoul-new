<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="Aileensoul Adminpanel">

        <meta name="keyword" content="Aileensoul Adminpanel">

        <link rel="shortcut icon" href="<?php echo base_url('images/freelancer-bg.jpg') ?>" type="image/x-icon" />

        <title><?php echo $title ?> </title>



        <!-- Bootstrap core CSS -->

        <link href="<?php echo base_url('admin/assets/css/bootstrap.css'); ?>" rel="stylesheet">

        <!--external css-->

        <link href="<?php echo base_url('admin/assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />



        <!-- Custom styles for this template -->

        <link href="<?php echo base_url('admin/assets/css/style.css'); ?>?v=<?php echo time();?>" rel="stylesheet">

        <link href="<?php echo base_url('admin/assets/css/style-responsive.css'); ?>?v=<?php echo time();?>" rel="stylesheet">



    </head>



    <body>

        <!-- **********************************************************************************************************************************************************

        MAIN CONTENT

        *********************************************************************************************************************************************************** -->

        <div id="login-page" class="text-center">

                <a href="http://aileensoul_om/" ><img src="<?php echo base_url('images/logo.png'); ?>" class="logo_image" width="100px" alt="Aileensoul"> </a>       

        
                <div class="login-body">

                    <?php

                $form_attribute = array('name' => 'login', 'method' => 'post', 'class' => 'form-login', 'id' => 'login_form');

                echo form_open('login/authenticate', $form_attribute);

                ?>



                <h2 class="form-login-heading">sign in</h2>

                <div class="login-wrap">

                    <input type="text" name="admin_email" id="admin_email" class="form-control" placeholder="Email id" autofocus>

                    <br>

                    <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Password">

                    <label class="checkbox">

                        <span class="pull-right">

                            <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>



                        </span>

                    </label>

                    <input type="submit" class="btn btn-theme" name="submit" value="Submit" />



                </div>

               <?php echo form_close(); ?>

                <div class="login_error">

                <?php

                if ($this->session->flashdata('error')) {

                    ?>

                    <div class="form-login-error">

                        <?php

                        echo $this->session->flashdata('error');

                        ?>

                    </div>

                    <?php

                }

                ?>

                

                <?php

                if ($this->session->flashdata('success')) {

                    ?>

                    <div class="form-login-error">

                        <?php

                        echo $this->session->flashdata('success');

                        ?>

                    </div>

                    <?php

                }

                ?>

                </div>

                <?php

                $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');

                echo form_open('login/forgot_password', $form_attribute);

                ?>

                <!-- Modal -->

                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">

                    <div class="modal-dialog">

                        <div class="modal-content">

                            <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title">Forgot Password ?</h4>

                            </div>

                            <div class="modal-body">

                                <p>Enter your e-mail address below to get your password.</p>

                                <input type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">



                            </div>

                            <div class="modal-footer">

                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>

                                <input class="btn btn-theme" type="submit" name="submit" value="Submit" />    

                            </div>

                        </div>

                    </div>

                </div>

                <!-- modal -->



                </form>	  	



            </div>

        </div>

        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>



        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>



        <!--BACKSTRETCH-->

        <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.backstretch.min.js') ?>"></script>



        <script>

            $.backstretch('<?php echo base_url('images/freelancer-bg.jpg') ?>', {speed: 500});

        </script>

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () {



                $("#login_form").validate({

                    rules: {

                        admin_email: {

                            required: true,

                            email:true,

                        },

                        admin_password: {

                            required: true,

                        }

                    },

                    messages: {

                        admin_email: {

                            required: "Email Id Is Required.",

                            email:"Please Enter Valid Email Id."

                        },

                        admin_password: {

                            required: "Password Is Required",

                        }



                    },

                });







            });





            //validation for edit email formate form

            $(document).ready(function () {



                $("#forgot_password").validate({

                    rules: {

                        forgot_email: {

                            required: true,

                            email:true

                        }

                    },

                    messages: {

                        forgot_email: {

                            required: "Email Address Required",

                            email:"Please Enter Valid Email ID"

                        }

                    },

                });

            });

        </script>



        <script language="javascript" type="text/javascript">

            $(document).ready(function () {

                $('.alert-danger').delay(3000).hide('700');

                $('.alert-success').delay(3000).hide('700');    

            });

        </script>

    </body>

</html>

