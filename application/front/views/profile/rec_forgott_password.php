<!DOCTYPE html>
<html lang="en">
<head>
  <title>aileen solution</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

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



  <h2>login page</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">forgott password?</button>
   
    <?php
      $form_attribute = array('name' => 'forgot', 'method' => 'post', 'class' => 'forgot_password', 'id' => 'forgot_password');
        echo form_open('profile/forgot_password', $form_attribute);
        ?>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
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
  
</div>


 <script language="javascript" type="text/javascript">
            $(document).ready(function () {
                $('.alert-danger').delay(3000).hide('700');
                $('.alert-success').delay(3000).hide('700');
            });
        </script>
  
</body>
</html>
