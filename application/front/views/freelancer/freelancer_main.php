<!DOCTYPE html>
<html class="h_w">
    <head>
        <title>Home | Freelance Profile - Aileensoul</title>
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
                                <a href="<?php echo base_url('freelance-hire');?>" class="button" id="freelancer-hire-button">Hire</a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="font-white">Apply as Freelancer</h2>
                                <a href="<?php echo base_url('freelance-work'); ?>" class="button" id="freelancer-apply-button">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
       
            <?php echo $footer; ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>

    </body>
</html>