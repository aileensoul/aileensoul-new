<?php echo $head; ?>
<?php 
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php echo $title; ?></title>  
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css?ver='.time()); ?>">
	   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
   </head>
   <!--header start-->
   <?php echo $header; ?>
   <!--header End-->
   <body>
      <div class="container" id="paddingtop_fixed">
         <div class="row">
            <center>
               <div class="reactivatebox">
                  <div class="reactivate_header">
                     <center>
                        <h2>Are you sure you want to reactive your job profile? </h2>
                     </center>
                  </div>
                  <div class="reactivate_btn_y">
                     <a href="<?php echo base_url('job/reactivate'); ?>">Yes</a>
                  </div>
                  <div class="reactivate_btn_n">
                     <a href="<?php echo base_url('profiles/') . $this->session->userdata('aileenuser_slug'); ?>">No</a>
                  </div>
               </div>
            </center>
         </div>
      </div>

<!-- <footer>     -->    
<?php echo $footer;  ?>
<!-- </footer> -->
    
     <script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>

   </body>
</html>