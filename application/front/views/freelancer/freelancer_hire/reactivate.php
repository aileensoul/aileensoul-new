<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Reactivate</title>
        <?php echo $head; ?>
       
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profiles/freelancer-hire/freelancer-hire.css'); ?>">
    </head>
    <body>
        <?php echo $header; ?>
        <div class="container" id="paddingtop_fixed">
            <div class="row">
                <center> 
                    <div class="reactivatebox">
                        <div class="reactivate_header">
                            <center><h2><?php echo $this->lang->line("reactive_massage"); ?></h2></center>
                        </div>
                        <div class="reactivate_btn_y">
                            <a href="<?php echo base_url('freelancer-hire/reactivate'); ?>"><?php echo $this->lang->line("yes"); ?></a>
                        </div>
                        <div class="reactivate_btn_n">
                            <a href="<?php echo base_url('dashboard'); ?>"><?php echo $this->lang->line("no"); ?></a>
                        </div>
                     
                    </div>
                </center>
            </div>
        </div>
    </body>
</html>



