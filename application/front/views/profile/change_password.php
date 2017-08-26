
<?php  
                                       if ($this->session->flashdata('error')) {
                                           echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                       }
                                      
                                       
                                ?>

<?php echo form_open(base_url('profile/code_check'), array('id' => 'codecheck','name' => 'codecheck', 'class' => 'clearfix')); ?>
Code: <input type="text" name="code" id="code" value="">
<input type="hidden" name="userid" id="userid" value="<?php echo $user_changeid; ?>">
<input type="submit" name="sublitcode" id="submitcode">
</form>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function () { //alert("hii");
          /* validation */
          $("#codecheck").validate({
              rules: {
                  code: {
                      required: true,
                      minlength: 6,
                      maxlength: 6
                        }
                  
                        },
            messages:  {
                    code: {
                    required: "Code Is Required.",
                  	minlength: "Your code is 6 character long",
                  	maxlength: "Your code is 6 character long",
                      }

                    
                   },
                });
            /* validation */
                                    
          });
</script>