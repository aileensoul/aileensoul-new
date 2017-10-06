<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()) ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-apply/freelancer-apply.css?ver='.time()); ?>">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">-->
    </head>
  
        <body>
            <div id="preloader"></div>
            <?php echo $header; ?>
            <?php
            if ($freepostdata[0]['user_id'] && $freepostdata[0]['free_post_step'] == '7') {
                echo $freelancer_post_header2_border;
            }
            ?>
            <section>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        $contition_array = array('user_id' => $userid, 'status' => '1');
                        $freepostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        if ($freepostdata[0]['free_post_step'] == 7) {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("apply-regi-title_update"); ?></h3></div>

                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("apply-regi-title"); ?></h3></div>
                        <?php } ?>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/basic-information'); ?>"><?php echo $this->lang->line("basic_info"); ?></a></li> 

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/address-information'); ?>"><?php echo $this->lang->line("address_info"); ?></a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/professional-information'); ?>"><?php echo $this->lang->line("professional_info"); ?></a></li>

                                        <li <?php if ($this->uri->segment(1) == 'freelancer-work') { ?> class="active init" <?php } ?>><a href="javascript:void(0);"><?php echo $this->lang->line("rate"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '4') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/avability'); ?>"><?php echo $this->lang->line("add_avability"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '5') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/education'); ?>"><?php echo $this->lang->line("education"); ?></a></li>		    
                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '6') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/portfolio'); ?>"><?php echo $this->lang->line("portfolio"); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div>
                                    <?php
                                    if ($this->session->flashdata('error')) {
                                        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                    }
                                    if ($this->session->flashdata('success')) {
                                        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="common-form common-form_border">
                                    <h3><?php echo $this->lang->line("rate"); ?></h3>
                                    <?php echo form_open(base_url('freelancer/freelancer_post_rate_insert'), array('id' => 'freelancer_post_rate', 'name' => 'freelancer_post_rate', 'class' => 'clearfix')); ?>
                                    <?php
                                    $hourly = form_error('hourly');
                                    ?>
                                    <fieldset <?php if ($hourly) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("hourly"); ?>:</label>
                                        <input type="number" name="hourly" min="1" id="hourly" tabindex="1" autofocus placeholder="Enter hourly rate"  value="<?php
                                        if ($hourly1) {
                                            echo $hourly1;
                                        }
                                        ?>"onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
                                               <?php echo form_error('hourly'); ?>
                                    </fieldset>
                                    <fieldset>
                                        <label><?php echo $this->lang->line("currency"); ?>:</label>
                                        <select name="state" tabindex="2">
                                            <option value="" selected option disabled><?php echo $this->lang->line("select_currency"); ?></option>

                                            <?php
                                            if (count($currency) > 0) {
                                                foreach ($currency as $cnt) {
                                                    if ($currency1) {
                                                        ?>
                                                        <option value="<?php echo $cnt['currency_id']; ?>" <?php if ($cnt['currency_id'] == $currency1) echo 'selected'; ?>><?php echo $cnt['currency_name']; ?></option>
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <option value="<?php echo $cnt['currency_id']; ?>"><?php echo $cnt['currency_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select> 
                                        <?php ?>
                                    </fieldset>
                                    <fieldset>
                                        <?php
                                        if ($fixed_rate1 == 1) {
                                            ?>
                                            <input type="checkbox" tabindex="3" name="fixed_rate" value="1" checked><?php echo $this->lang->line("fixed_rate"); ?><br>
                                            <?php
                                        } else {
                                            ?>
                                            <input type="checkbox" tabindex="3" name="fixed_rate" value="1"><?php echo $this->lang->line("also_work_fixed"); ?><br>
                                            <?php
                                        }
                                        ?>
                                    </fieldset>
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" name="next" tabindex="4" value="Next">
                                    </fieldset>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <?php echo $footer; ?>
            </footer>
            <script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
            <!--<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver='.time()); ?>"></script>
            <script>
                var base_url = '<?php echo base_url(); ?>';
             
            </script>
            
           <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_post_rate.js?ver='.time()); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_apply_common.js?ver='.time()); ?>"></script>
        </body>
</html>