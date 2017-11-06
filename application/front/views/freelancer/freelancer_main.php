<!DOCTYPE html>
<html class="h_w">
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  

    </head>
    <body class="pushmenu-push freelancer_home h_w">
        <?php echo $header; ?>
        <section class="h_w">
            <div class="col-md-12  user-section-free-up">
            </div>
            <div class="midd-section freelancer-midd text-center">
                <div class="container">
                    <div class="row">
                        <div class="main_frlancer">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="font-white">I want to hire Freelancer</h2>
                                <a href="<?php echo base_url('freelancer-hire'); ?>" class="button" id="freelancer-hire-button">Hire</a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="font-white">Apply as Freelancer</h2>
                                <a href="<?php echo base_url('freelancer-work'); ?>" class="button" id="freelancer-apply-button">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
            <?php echo $login_footer ?>
            <?php echo $footer; ?>
            <!--            <div class="copyright">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                    </div>
                                </div>
                            </div>
                        </div>-->
       

        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>

    </body>
</html>