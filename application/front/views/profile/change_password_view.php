


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grow Business Network|Hiring|Search Jobs|Freelance Work|It's Free|Aileensoul</title>
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="../css/common-style.css">
        <link rel="stylesheet" href="../css/style-main.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
    </head>
    <body class="contact">

        <div class="main-inner">

            <?php echo $login_header; ?>
          <section class="middle-main">
    <div class="container">
      <div class="form-pd row">
<?php echo form_open(base_url('profile/new_forgetpassword'), array('id' => 'newpassword','name' => 'newpassword', 'class' => 'clearfix')); ?>

 <div class="inner-form login-frm otp_lform">
          <div class="login fw">
<!-- main box -->
          <div class="main_otp_box fw">

<!-- header small -->
          <div class="main_otp_box_head">
            <h3>Create a new password </h3>
          </div>
<!-- header small -->

<!-- middele data -->
      <div class="main_otp_box_middle">
 Enter your new password here. It should be a combination of letter,numerical and special character


 <div class="main_otp_box_middle_submit">
   <label>New Password</label>
 <input type="password" name="new_password" id="new_password" value="" placeholder="Enter new password">
<input type="hidden" name="usercon" id="usercon" value="<?php echo $userid; ?>">

<span>
  <input type="submit" name="" value="hide">
  <input type="submit" name="" value="?">
</span>
 </div>
</div>

<!-- middele data -->


<div class="otp_bottom fw">

<div class="fr otp_bottom_submit"> 
 <input type="submit" name="submitnew" id="submitnew" value="Save">
 <input type="submit" name="" id="cancel" class="cancel_password" value="Cancel">
 </div>
  
</div>

</div>
<!-- main box -->

</div>
</div>
<!--  <input type="password" name="new_password" id="new_password" value="">
<input type="hidden" name="usercon" id="usercon" value="<?php //echo $userid; ?>">
<input type="submit" name="submitnew" id="submitnew"> -->
  <?php echo form_close(); ?>
    </div>
    </div>
</div>
</section>
</div>
</body>
</html>

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () { //alert("hii");
          /* validation */
          $("#newpassword").validate({
              rules: {
                  new_password: {
                      required: true,
                        }
                  
                        },
            messages:  {
                    new_password: {
                    required: "Password Is Required.",
                      }

                    
                   },
                });
            /* validation */
                                    
          });
</script>