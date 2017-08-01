<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    </head>
    <!--<div class="js">-->
        <body>
            <div id="preloader"></div>
            <?php echo $header; ?>
            <?php
            if ($freehiredata[0]['free_hire_step'] == '3') {
                echo $freelancer_hire_header2_border;
            }
            ?>
            <section>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        $contition_array = array('user_id' => $userid, 'status' => '1');
                        $freehiredata = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        if ($freehiredata[0]['free_hire_step'] == 3) {
                            ?>
                            <div class="col-md-6 col-sm-6"><h3><?php echo $this->lang->line("hire-regi-title_update"); ?></h3></div>
                        <?php } else {
                            ?>
                            <div class="col-md-6 col-sm-6"><h3><?php echo $this->lang->line("hire-regi-title"); ?></h3></div>
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
                                        <li class="custom-none "> <a href="<?php echo base_url('freelancer-hire/basic-information'); ?>"><?php echo $this->lang->line("basic_info"); ?></a></li>
                                        <li <?php if ($this->uri->segment(1) == 'freelancer-hire') { ?> class="active init" <?php } ?>><a href="#"><?php echo $this->lang->line("address_info"); ?></a></li>
                                        <li class="custom-none  <?php
                                        if ($freehiredata[0]['free_hire_step'] < '2') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('freelancer-hire/professional-information'); ?>"><?php echo $this->lang->line("professional_info"); ?></a></li>
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
                                    <?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_address_info_insert'), array('id' => 'address_info', 'name' => 'address_info', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e"><?php echo $this->lang->line("filed_required"); ?></span>
                                    </div>
                                    <?php
                                    $country = form_error('country');
                                    $state = form_error('state');
                                    $address = form_error('address');
                                    ?>
                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("country"); ?>:<span class="red">*</span></label>
                                        <select tabindex="1"  name="country" id="country" autofocus>
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
                                    <?php ?>
                                    <fieldset>
                                        <label><?php echo $this->lang->line("pincode"); ?>:</label>
                                        <input type="text" name="pincode" tabindex="4" id="pincode" placeholder="Enter Pincode"  value="<?php
                                        if ($pincode1) {
                                            echo $pincode1;
                                        }
                                        ?>">
                                    </fieldset>
                                    <?php ?>
                                    
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" tabindex="6" name="next" value="Next">
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
            <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
            <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
            <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

            <script type="text/javascript">
                var base_url = '<?php echo base_url(); ?>';
                var data = <?php echo json_encode($demo); ?>;
                var data1 = <?php echo json_encode($city_data); ?>;
            </script>
            <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_address_info.js'); ?>"></script>
        </body>
    <!--</div>-->
</html>