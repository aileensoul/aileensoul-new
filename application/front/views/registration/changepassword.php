<!-- start head -->
<?php echo $head; ?>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<!--post save success pop up style strat -->

  



<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />



<!-- start header -->
<?php echo $header; ?>


<!-- END HEADER -->
<body>
        <div class="padd_set">
        <div class="container">
        <div class="row">
        <div class="col-md-12">
                
                         <div class="col-lg-3 col-md-4 col-sm-4">
                        <div class="padd_set">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li>  <a href="<?php echo base_url() . 'profile' ?>">Edit Profile</a></li>

                                <li  <?php if ($this->uri->segment(2) == 'changepassword') { ?> class="active init" <?php } ?>> <a href="<?php echo base_url('registration/changepassword') ?>">Change Password </a></li>

                                


                            </ul>
                        </div>
                        </div>
                    </div>

                
                <div class="col-md-7 col-sm-8">
                    <div class="change-password">
    
        <div class="change-password-box">
        <h4>Change Password</h4>
            <!-- <input action="action" type="button" value="Back" class="back-btn" onclick="history.back();" /> -->
            <?php echo form_open(base_url('registration/changepassword_insert'), array('id' => 'regform','name' => 'regform','class' => 'clearfix')); ?>
                
                <fieldset class="full-width">
                    <label>Old Password <span style="color:red">*</span></label>
                    <input type="password" name="oldpassword"  id="oldpassword" placeholder="Old Password" /> <span id="password1-error"> </span>
                    <?php
                          //echo "<div class='error_msg'>";
                          if (isset($error_message1)) {
                          echo $error_message1;
                          }
                          //echo validation_errors();
                       echo form_error('oldpassword');
                           //echo "</div>";
                      ?>
                 
                </fieldset>
                <fieldset class="full-width">
                    <label>New Password <span style="color:red">*</span></label>
                    <input type="password" name="password1"  id="password1" placeholder="New Password" /> <span id="password1-error"> </span>
                    <?php echo form_error('password1'); ?>
                </fieldset>
                <fieldset class="full-width">
                    <label>Confirm Password<span style="color:red">*</span></label>
                    <input type="password" name="password2"  id="password2" placeholder="Confirm Password" /> <span id="password2-error"> </span>
                    <?php echo form_error('password2'); ?>
                </fieldset>
                <fieldset class="hs-submit full-width">

                    <input type="reset"  value="Cancel" name="cancel">
                    <input type="submit"  value="Save" name="submit">
                    
                </fieldset>
            </form>
        	</div>
    	</div>
		</div>

             </div>
             
             </div>
             </div>
        </div>
     
</body>
</html>


