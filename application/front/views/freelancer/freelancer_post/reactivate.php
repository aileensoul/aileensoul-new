<?php echo $head; ?>
<?php echo $header; ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reactivate</title>
        <!-- http://bootsnipp.com/snippets/4jXW -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/chat.css" />
    </head>
    <body>
        <div class="container" id="paddingtop_fixed">
            <div class="row">
                <center> 
                    <div class="reactivatebox">
                        <div class="reactivate_header">
                            <center><h2>Are you sure you want to reactive your freelancer_apply profile?</h2></center>
                        </div>
                        <div class="reactivate_btn_y">
                            <a href="<?php echo base_url('freelancer/reactivate'); ?>">Yes</a>
                        </div>
                        <div class="reactivate_btn_n">
                            <a href="<?php echo base_url('dashboard'); ?>">No</a>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>



