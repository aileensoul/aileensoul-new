<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css?ver='.time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver='.time()); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php if ($businessdata[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
        <!--<div class="js">-->
<!--            <div id="preloader"></div>-->
            <section>
                <div class="user-midd-section" id="paddingtop_fixed">
                    <div class="common-form1">
                        <div class="col-md-3 col-sm-4"></div>
                        <?php
                        $userid = $this->session->userdata('aileenuser');

                        $contition_array = array('user_id' => $userid, 'status' => '1');
                        $busdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        if ($busdata[0]['business_step'] == 4) {
                            ?>
                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_edit_title"); ?></h3></div>

                        <?php } else {
                            ?>

                            <div class="col-md-6 col-sm-8"><h3><?php echo $this->lang->line("bus_reg_title"); ?></h3></div>
                        <?php } ?>

                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="left-side-bar">
                                    <ul class="left-form-each">
                                        <li <?php if ($this->uri->segment(1) == 'business-profile') { ?> class="active init" <?php } ?>><a href="#"><?php echo $this->lang->line("business_information"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '1') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/contact-information'); ?>"><?php echo $this->lang->line("contact_information"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '2') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/description'); ?>"><?php echo $this->lang->line("description"); ?></a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '3') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/image'); ?>"><?php echo $this->lang->line("business_images"); ?></a></li>

                                    </ul>
                                </div>
                            </div>
                            <!-- middle section start -->
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
                                    <h3>
                                        <?php echo $this->lang->line("business_information"); ?>
                                    </h3>
                                    <?php echo form_open(base_url('business-profile/business-information-insert'), array('id' => 'businessinfo', 'name' => 'businessinfo', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                    </div>
                                    <?php
                                    $companyname = form_error('companyname');
                                    $country = form_error('country');
                                    $state = form_error('state');

                                    $business_address = form_error('business_address');
                                    ?>
                                    <fieldset class="full-width" <?php if ($companyname) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("company_name"); ?>:<span style="color:red">*</span></label>
                                        <input name="companyname" tabindex="1" autofocus type="text" id="companyname" placeholder="<?php echo $this->lang->line("enter_company_name"); ?>" value="<?php
                                        if ($companyname1) {
                                            echo $companyname1;
                                        }
                                        ?>"/>
                                               <?php echo form_error('companyname'); ?>
                                    </fieldset>
                                    <fieldset <?php if ($country) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("country"); ?>:<span style="color:red">*</span></label>
                                        <select name="country" id="country" tabindex="2" >
                                            <option value=""><?php echo $this->lang->line("country"); ?></option>
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
                                        </select><span id="country-error"></span>
                                        <?php echo form_error('country'); ?> 
                                    </fieldset>

                                    <fieldset <?php if ($state) { ?> class="error-msg" <?php } ?>>
                                        <label><?php echo $this->lang->line("state"); ?>:<span style="color:red">*</span></label>
                                        <select name="state" id="state" tabindex="3" >
                                            <?php
                                            foreach ($states as $cnt) {
                                                if ($state1) {
                                                    ?>
                                                    <option value="<?php echo $cnt['state_id']; ?>" <?php if ($cnt['state_id'] == $state1) echo 'selected'; ?>><?php echo $cnt['state_name']; ?></option>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <option value=""><?php echo $this->lang->line("select_country_first"); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select><span id="state-error"></span>
                                        <?php echo form_error('state'); ?>
                                    </fieldset>
                                    <fieldset>
                                        <label> <?php echo $this->lang->line("city"); ?>:</label>
                                        <select name="city" id="city" tabindex="4" >
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
                                                <option value=""><?php echo $this->lang->line("select_state_first"); ?></option>

                                            <?php }
                                            ?>
                                        </select><span id="city-error"></span>

                                    </fieldset>
                                    <fieldset>
                                        <label><?php echo $this->lang->line("pincode"); ?>:</label>
                                        <input name="pincode" tabindex="5"   type="text" id="pincode" placeholder="<?php echo $this->lang->line("enter_pincode"); ?>" value="<?php
                                        if ($pincode1) {
                                            echo $pincode1;
                                        }
                                        ?>">

                                    </fieldset>


                                    <fieldset <?php if ($business_address) { ?> class="error-msg" <?php } ?> class="full-width">
                                        <label><?php echo $this->lang->line("postal_address"); ?>:<span style="color:red">*</span></label>
                                        <textarea name ="business_address" tabindex="6"  id="business_address" rows="4" cols="50" placeholder="<?php echo $this->lang->line("enter_address"); ?>" style="resize: none;"><?php
                                            if ($address1) {
                                                echo $address1;
                                            }
                                            ?></textarea>
                                        <?php echo form_error('business_address'); ?>
                                    </fieldset>
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" name="next" tabindex="7"  value="<?php echo $this->lang->line("next"); ?>">
                                    </fieldset>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <?php echo $footer; ?>
            </footer>
        <!--</div>-->

        <script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
        <!--<script src="<?php // echo base_url('js/jquery-ui.min.js?ver='.time()); ?>"></script>-->
        <!--<script src="<?php // echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>-->
        <!--<script src="<?php // echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
        <!-- POST BOX JAVASCRIPT END --> 
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
            var slug = '<?php echo $slugid; ?>';
            
            var company_name_validation = '<?php echo $this->lang->line('company_name_validation') ?>';
            var country_validation = '<?php echo $this->lang->line('country_validation') ?>';
            var state_validation = '<?php echo $this->lang->line('state_validation') ?>';
            var address_validation = '<?php echo $this->lang->line('address_validation') ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/information.js?ver='.time()); ?>"></script>
    </body>
</html>
