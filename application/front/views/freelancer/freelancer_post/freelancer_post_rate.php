<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    </head>
    <div class="js">
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
                            <div class="col-md-6 col-sm-8"><h3>You are updating your Freelancer Profile.</h3></div>

                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3>You are making your Freelancer Profile.</h3></div>
                        <?php } ?>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/basic-information'); ?>">Basic Information</a></li> 

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/address-information'); ?>">Address Information</a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/professional-information'); ?>">Professional Information</a></li>

                                        <li <?php if ($this->uri->segment(1) == 'freelancer-work') { ?> class="active init" <?php } ?>><a href="#">Rate</a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '4') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/avability'); ?>">Add Your Avability</a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '5') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/education'); ?>"> Education</a></li>		    
                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '6') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/portfolio'); ?>">Portfolio</a></li>
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
                                    <h3>Rate</h3>
                                    <?php echo form_open(base_url('freelancer/freelancer_post_rate_insert'), array('id' => 'freelancer_post_rate', 'name' => 'freelancer_post_rate', 'class' => 'clearfix')); ?>
                                    <?php
                                    $hourly = form_error('hourly');
                                    ?>
                                    <fieldset <?php if ($hourly) { ?> class="error-msg" <?php } ?>>
                                        <label>Hourly:</label>
                                        <input type="text" name="hourly" min="1" tabindex="1" autofocus placeholder="Enter hourly Rate"  value="<?php
                                        if ($hourly1) {
                                            echo $hourly1;
                                        }
                                        ?>">
                                               <?php echo form_error('hourly'); ?>
                                    </fieldset>
                                    <fieldset>
                                        <label>Currency:</label>
                                        <select name="state" tabindex="2">
                                            <option value="" selected option disabled>Select your currency</option>

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
                                            <input type="checkbox" tabindex="3" name="fixed_rate" value="1" checked> Work On Fixed Rate<br>
                                            <?php
                                        } else {
                                            ?>
                                            <input type="checkbox" tabindex="3" name="fixed_rate" value="1"> Also Work On Fixed Rate<br>
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
            <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
            <script>
                var data = <?php echo json_encode($demo); ?>;
               var data1 = <?php echo json_encode($city_data); ?>;
            </script>
           <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_post_rate.js'); ?>"></script>
        </body>
    </div>
</html>