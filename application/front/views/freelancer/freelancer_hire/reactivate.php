<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reactivate</title>
        <?php echo $head; ?>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chat.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
    </head>
    <body>
        <?php echo $header; ?>
        <div class="container" id="paddingtop_fixed">
            <div class="row">
                <center> 
                    <div class="reactivatebox">
                        <div class="reactivate_header">
                            <center><h2>Are you sure you want to reactive your freelancer_hire profile?</h2></center>
                        </div>
                        <div class="reactivate_btn_y">
                            <a href="<?php echo base_url('freelancer-hire/reactivate'); ?>">Yes</a>
                        </div>
                        <div class="reactivate_btn_n">
                            <a href="<?php echo base_url('dashboard'); ?>">No</a>
                        </div>
                        <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>



