<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php if ($businessdata[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
        <div class="js">
            <div id="preloader"></div>
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
                            <div class="col-md-6 col-sm-8"><h3>You are updating your Business Profile.</h3></div>

                        <?php } else {
                            ?>

                            <div class="col-md-6 col-sm-8"><h3>You are making your Business Profile.</h3></div>
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
                                        <li class="custom-none"><a href="<?php echo base_url('business-profile/business-information-update'); ?>">Business Information</a></li> 

                                        <li <?php if ($this->uri->segment(1) == 'business-profile') { ?> class="active init" <?php } ?>><a href="#">Contact Information</a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '2') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/description'); ?>">Description</a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '3') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/image'); ?>">Business Images</a></li>

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
                                        Contact Information
                                    </h3>

                                    <?php echo form_open(base_url('business-profile/contact-information-insert'), array('id' => 'contactinfo', 'name' => 'contactinfo', 'class' => 'clearfix')); ?>

                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                    </div>

                                    <?php
                                    $contactname = form_error('contactname');
                                    $contactmobile = form_error('contactmobile');
                                    $contactemail = form_error('email');
                                    $contactwebsite = form_error('contactwebsite');
                                    ?>

                                    <fieldset <?php if ($contactname) { ?> class="error-msg" <?php } ?>>
                                        <label>Contact Person:<span style="color:red">*</span></label>
                                        <input name="contactname" tabindex="1" autofocus type="text" id="contactname" placeholder="Enter contact Name" value="<?php
                                        if ($contactname1) {
                                            echo $contactname1;
                                        }
                                        ?>"/>
                                               <?php echo form_error('contactname'); ?>
                                    </fieldset>


                                    <fieldset <?php if ($contactmobile) { ?> class="error-msg" <?php } ?>>
                                        <label>Contact Mobile:</label>
                                        <input name="contactmobile" type="text" tabindex="2"  id="contactmobile" placeholder="Enter contact Mobile" value="<?php
                                        if ($contactmobile1) {
                                            echo $contactmobile1;
                                        }
                                        ?>"/>
                                               <?php echo form_error('contactmobile'); ?> 
                                    </fieldset>



                                    <fieldset <?php if ($contactemail) { ?> class="error-msg" <?php } ?>>
                                        <label>Contact Email:<span style="color:red">*</span></label>
                                        <input name="email" type="text" id="email" tabindex="3"  placeholder="Enter Contact Email" value="<?php
                                        if ($contactemail1) {
                                            echo $contactemail1;
                                        }
                                        ?>"/>
                                               <?php echo form_error('email'); ?>
                                    </fieldset>


                                    <fieldset>
                                        <label>Contact Website:</label>
                                        <input name="contactwebsite" type="url" id="contactwebsite" tabindex="4"  placeholder="Enter Contact website" value="<?php
                                        if ($contactwebsite1) {
                                            echo $contactwebsite1;
                                        }
                                        ?>"/>
                                        <span class="website_hint" style="font-size: 13px; color: #1b8ab9;">Note : <i>Enter website url with http or https</i></span>                                 
                                    </fieldset>


                                    <fieldset class="hs-submit full-width">



                                        <input tabindex="5"  type="submit"  id="next" name="next" value="Next">


                                    </fieldset>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php echo $footer; ?>

        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
        <!-- POST BOX JAVASCRIPT END --> 
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
            var slug = '<?php echo $slugid; ?>';
            var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/contact_info.js'); ?>"></script>
    </body>
</html>
