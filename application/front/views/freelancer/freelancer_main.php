<!DOCTYPE html>
<html class="h_w">
    <head>
        <title>Home | Freelance Profile - Aileensoul</title>
        <?php echo $head; ?>  

    </head>
    <body class="pushmenu-push freelancer_home h_w">
        <?php echo $header; ?>
        <?php
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
        $hire_step = $this->data['hire_step'] = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'free_hire_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        
        $userid = $this->session->userdata('aileenuser');
        $contition_array = array('user_id' => $userid, 'status' => '1', 'is_delete' => '0');
        $apply_step = $this->data['apply_step'] = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'free_post_step', $sortby = '', $orderby = '', $limit = '', $offset = '', $$join_str = array(), $groupby);
        
        ?>
        <section class="h_w">
            <div class="col-md-12  user-section-free-up">
            </div>
            <div class="midd-section freelancer-midd text-center">
                <div class="container">
                    <div class="row">
                        <div class="main_frlancer">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="font-white">I want to hire Freelancer</h2>
                                <?php if ($hire_step[0]['free_hire_step'] == '3') { ?>
                                    <a href="<?php echo base_url('freelance-hire/home'); ?>" class="button" id="freelancer-hire-button">Hire</a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('freelance-hire'); ?>" class="button" id="freelancer-hire-button">Hire</a>
<?php } ?>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2 class="font-white">Apply as Freelancer</h2>
                                <?php if($apply_step[0]['free_post_step'] == '7'){ ?>
                                <a href="<?php echo base_url('freelance-work/home'); ?>" class="button" id="freelancer-apply-button">Apply</a>
                                <?php }else{ ?>
                                <a href="<?php echo base_url('freelance-work'); ?>" class="button" id="freelancer-apply-button">Apply</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
<?php echo $login_footer ?>
            </div>

        </section>

<?php echo $footer; ?>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>

    </body>
</html>