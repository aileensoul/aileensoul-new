<?php echo form_open(base_url('profile/new_forgetpassword'), array('id' => 'newpassword','name' => 'newpassword', 'class' => 'clearfix')); ?>
New password: <input type="password" name="new_password" id="new_password" value="">
<input type="hidden" name="usercon" id="usercon" value="<?php echo $userid; ?>">
<input type="submit" name="submitnew" id="submitnew">
</form>


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