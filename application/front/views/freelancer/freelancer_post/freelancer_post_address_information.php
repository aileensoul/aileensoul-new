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
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("apply-regi-title_update"); ?></h3></div>
                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("apply-regi-title"); ?></h3></div>
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
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/basic-information'); ?>"><?php echo $this->lang->line("basic_info"); ?></a></li>
                                        <li <?php if ($this->uri->segment(1) == 'freelancer-work') { ?> class="active init" <?php } ?>><a href="#"><?php echo $this->lang->line("address_info"); ?></a></li>
                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '2') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/professional-information'); ?>"><?php echo $this->lang->line("professional_info"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($freepostdata[0]['free_post_step'] < '3') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-work/rate'); ?>"><?php echo $this->lang->line("rate"); ?></a></li>

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
                                        ?>"><a href="custom-none <?php echo base_url('freelancer-work/portfolio'); ?>"><?php echo $this->lang->line("portfolio"); ?></a></li>
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
                                    <h3><?php echo $this->lang->line("address_info"); ?></h3>
                                    <?php echo form_open(base_url('freelancer/freelancer_post_address_information_insert'), array('id' => 'freelancer_post_addressinfo', 'name' => 'freelancer_post_addressinfo', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e"><?php echo $this->lang->line("filed_required"); ?></span>
                                    </div>
                                    <?php
                                    $country = form_error('country');
                                    $state = form_error('state');
                                    $city = form_error('city');
                                    $pincode = form_error('pincode');
                                    ?> 
                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("country"); ?>:<span class="red">*</span></label>
                                        <select tabindex="1" autofocus name="country" id="country">
                                            <option value=""><?php echo $this->lang->line("select_country"); ?></option>
                                            <?php
                                            if (count($countries) > 0) {
                                                foreach ($countries as $cnt) {
                                                    if ($country1) {
                                                        ?>
                                                        <option value="<?php echo $cnt['country_id']; ?>" <?php if ($cnt['country_id'] == $country1) echo 'selected'; ?>><?php echo $cnt['country_name']; ?></option>

                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select> 
                                        <?php echo form_error('country'); ?>
                                    </fieldset>
                                    <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("state"); ?>:<span class="red">*</span></label>
                                        <select tabindex="2" name="state" id="state">
                                            <?php
                                            if ($state1) {
                                                foreach ($states as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else {
                                                ?>
                                                <option value=""><?php echo $this->lang->line("country_first"); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php echo form_error('state'); ?> 
                                    </fieldset>
                                    <fieldset>
                                        <label><?php echo $this->lang->line("city"); ?>:</label>
                                        <select name="city" tabindex="3" id="city">
                                            <?php
                                            if ($city1) {
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>" <?php if ($cnt['city_id'] == $city1) echo 'selected'; ?>><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            else if ($state1) {
                                                ?>
                                                <option value=""><?php echo $this->lang->line("select_city"); ?></option>
                                                <?php
                                                foreach ($cities as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <option value=""><?php echo $this->lang->line("state_first"); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </fieldset>
                                    <fieldset>
                                        <label><?php echo $this->lang->line("pincode"); ?>:</label>
                                        <input type="text" name="pincode" tabindex="4" placeholder="Enter pincode" value="<?php
                                        if ($pincode1) {
                                            echo $pincode1;
                                        }
                                        ?>">
                                    </fieldset>
                                   
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" name="next" value="Next" tabindex="6">
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
            <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_post_address_information.js?ver='.time()); ?>"></script>
             <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_apply_common.js?ver='.time()); ?>"></script>


        </body>
    </div>
</html>