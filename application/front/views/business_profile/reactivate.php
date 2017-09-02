<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reactivate</title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver=' . time()); ?>">
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <!-- http://bootsnipp.com/snippets/4jXW -->
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
                            <center><h2> Are you sure you want to reactive your business profile?</h2></center>
                        </div>
                        <div class="reactivate_btn_y">
                            <a href="<?php echo base_url('business_profile/reactivate'); ?>">Yes</a>

                        </div>
                        <div class="reactivate_btn_n">
                            <a href="<?php echo base_url('dashboard'); ?>">No</a>
                        </div>
                        <script src="<?php echo base_url('js/fb_login.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" defer="defer" src="<?php echo base_url('js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>



