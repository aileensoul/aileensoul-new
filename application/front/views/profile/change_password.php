
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Grow Business Network|Hiring|Search Jobs|Freelance Work|It's Free|Aileensoul</title>
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
         <link rel="stylesheet" href="<?php echo base_url() ?>css/common-style.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/style-main.css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />
        
        <script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
    </head>
    <body class="contact">

        <div class="main-inner">

            <?php echo $forgetpassword_header; ?>
          <section class="middle-main">
    <div class="container">
      <div class="form-pd row">

 
<?php  
                                       if ($this->session->flashdata('error')) {
                                           echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                       }
                                      
                                       
                                ?>

<?php echo form_open(base_url('profile/checkredirect/'. $user_changeid), array('id' => 'codecheck','name' => 'codecheck', 'class' => 'clearfix')); ?>
 <div class="inner-form login-frm otp_lform">
          <div class="login fw">
<!-- main box -->
          <div class="main_otp_box fw">

<!-- header small -->
          <div class="main_otp_box_head">
            <h3>Enter Verification Code </h3>
          </div>
<!-- header small -->

<!-- middele data -->
      <div class="main_otp_box_middle">
  Please check your email for the verification code.Your verification code has been sent to<a><?php echo $emailid[0]['user_email'] ?></a>
 Please enter verification code here to verify your account.


 <div class="main_otp_box_middle_submit">
   
 <input type="text" name="code" id="code" value="" placeholder="Enter Code">
<!-- <input type="hidden" name="userid" id="userid" value="<?php echo $user_changeid; ?>"> -->
 </div>
</div>

<!-- middele data -->


<div class="otp_bottom fw">
<!-- <div class="fl otp_bottom_link">
  <a href="">Resend Verification Code</a>
</div> -->
<div class="fr otp_bottom_submit">  
<input type="submit" name="sublitcode" value="Continue" id="submitcode">
 <input type="reset" name="" id="cancel" class="cancel_password" value="Cancel">
</div>
  
</div>

</div>
<!-- main box -->

</div>
</div>
    <?php echo form_close(); ?>
    </div>
    </div>
</div>
</section>
</div>
</body>
</html>




<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>

<script type="text/javascript">
$(document).ready(function () { //alert("hii");
          /* validation */
          $("#codecheck").validate({
              rules: {
                  code: {
                      required: true,
                      minlength: 6,
                      maxlength: 6,
                      remote: {
                                      url: "<?php echo site_url() . 'profile/code_check/' . $user_changeid ?>",
                                      type: "post",
                                      data: {
                                     email_reg: function () {
                                     // alert("hi");
                                        return $("#code").val();
                                    },
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                },
                              },
                        }
                  
                        },
            messages:  {
                    code: {
                    required: "Code Is Required.",
                    minlength: "Your code is 6 character long",
                    maxlength: "Your code is 6 character long",
                    remote: "You enter some text doesn't match your code.Please try right code.",
                      }

                    
                   },
                });
            /* validation */
                                    
          });
</script>