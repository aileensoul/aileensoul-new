     <head> 
       <link rel="stylesheet" type="text/css" href="css/style_login.css">
       <link rel="stylesheet" type="text/css" href="css/common-style.css">
       <link rel="stylesheet" type="text/css" href="css/media.css">
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php // echo base_url('js/script.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php //echo base_url('js/select2_new.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script> 
     </head>



<body class="main_bdy_c">
<header>
    
        <div class="header3">
    <div class="container">
    <div class="row">
    <div class="header-login-main">
  <div class="col-md-6 col-sm-5 col-xs-6">
                        <div class="logo"><a tabindex="-200" href="<?php echo base_url('main') ?>"><!-- <img src="<?php// echo base_url('images/logo.png'); ?>"> --> <span >Aileensoul</span></a></div>
                    </div>
 
           <div class="col-md-6 col-sm-7  col-xs-6 header-left-menu">
                   <ul class="fr">
                 <!--    <li class=""><a class="login_butn"  href="<?php echo base_url('login') ?>">Login</a></li> -->
                    <li class=""><a  class="login_butn button6" tabindex="8"  href="<?php echo base_url('registration') ?>">Create an account</a></li>
                      
                    </ul>

                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                        </div>
                        </div>
    </div>    
    </div>
     
    </div>


</header>
   <div class="container">
        <div class="row">
          <div class="col-md-12">
          <div class="main_reg_form">
        
            <div class="abt_a">
              <h1><span>Welcome to Aileensoul</span></h1>
            </div>
       
             <?php   if ($this->session->flashdata('error')) 
               {

                      // echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';

                      echo $this->session->flashdata('error');



                }
                if ($this->session->flashdata('success'))
                 {
                         echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                }
               
         ?>
      

                    <form action="<?php echo base_url(); ?>login/check_login" method="post" id="login_form" name="login_form">
                     
                          <fieldset class="col-md-12 col-sm-12 col-xs-12 lgn-s">
                          <label>Email Address</label>
                                <input  id="user_name" tabindex="1" placeholder="Enter Email Address"  type="text" name="user_name" autocomplete="off" autofocus />
                            </fieldset>


                            <fieldset class="col-md-12 col-sm-12 col-xs-12 lgn-s">
                                 <label>Password</label>
                                <input  type="password" id="password" tabindex="2" placeholder="Enter Password" name="password" class="showpassword"  style="padding-right: 8%;" 
                               />
                            </fieldset>
                            <fieldset class="col-md-12 col-sm-12 col-xs-12">
                             <div class="checkbox2" style="display: block;">

                                    <input type="checkbox" name="remember">
                                    <h6>Remember me</h6>
                                </div>
                                    <div class="forgot" style="margin-top: -54px;">
                                    <a  id="myBtn"  data-toggle="modal" data-target="#myModal"> <h6>Forgot Password?</h6></a>
                               
                                    </div>

                            </fieldset>
                   
 
  
<fieldset class="col-md-12 col-sm-12 col-xs-12">
     <button type="submit" id="btnShow" name="login" value="Login" tabindex="3" class="button button-block vfhh" style="background:#1b8ab8!important; background-repeat: no-repeat; background-position: right center; margin-top: 0px; ">Log In</button>
                           
</fieldset>
    
<fieldset class="col-md-12 col-sm-12 col-xs-12">
     <div class="c_account">
                                <span>Don't have an account?</span>
                                <a  href="<?php echo base_url('registration'); ?>">Create an account</a>
                            </div>
</fieldset>
               
            </div>

          </div> 
</div>           
</div>
    
</form>
               <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
       <div class="modal-content"  style="    width: 100%;">
    <div class="modal-header" style="    width: 100%;
    text-align: center;">

    <?php
        $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
        echo form_open('profile/forgot_password', $form_attribute);
    ?>
    
      <span class="close">&times;</span>
      <label style="color: #a0b3b0;">Forgot Password</label>
    </div>
    <div class="modal-body" style="    width: 100%;
    text-align: center;">
        <label  style="margin-bottom: 15px; color: #a0b3b0;"> Enter your e-mail address below to get your password.</label>
                                            <input style="" type="text" name="forgot_email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

    </div>
    <div class="modal-footer ">
      <!--  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
       -->                        <div class="submit_btn">              <input class="btn btn-theme" type="submit" name="submit" value="Submit" /> 
       </div>
    </div>
       </form>
  </div>
      <!-- Modal content end-->
    </div>
  </div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="padding-bottom: 1px!important; padding: 12px;">
                <div class="footer-menu pull-left">
                    <p style="color: #fff;">&copy; 2017 | by <a href="#" style="color: #fff;">Aileensoul</a></p>
                </div>
                </div>
                <div class="col-md-6">
                <div class="footer-menu pull-right">
                    <nav>
                        <ul>
                          <li> <b><a class="" tabindex="4" href="<?php echo base_url('about_us'); ?>">About Us</a> </b></li>
                                    <li> <b><a class="" tabindex="5" href="<?php echo base_url('contact_us'); ?>">Contact Us</a> </b></li>
                                    <li><b><a tabindex="6" class="" href="javascript:void(0);">Blog</a> </b></li>
                                    <li> <b><a class="" tabindex="7" href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a> </b></li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
        </div>
        </footer>
</body>

<script type="text/javascript">
  $(document).ready(function () {
          /* validation */
          $("#login_form").validate({
              rules: {
                  user_name: {
                      required: true,
                        },
                   password: {
                          required: true,
                            }
                        },
            messages:  {
                    user_name: {
                    required: "Email Address Is Required.",
                      },

                    password: {
                    required: "Password Is Required.",
                           }
                   },
                });
            /* validation */
                                    
          });


</script>

<!-- script for remove flash session message after some time Start -->
<script type="text/javascript">
$(document).ready(function(){
        setTimeout(function() {
          $('.alert-danger').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    });
</script>
<!-- script for remove flash session message after some time End -->

<!-- validation script Start-->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<!-- validation script End-->


