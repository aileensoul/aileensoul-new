<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()) ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css?ver='.time()); ?>">
        <script src="<?php echo base_url('js/fb_login.js?ver='.time()); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver='.time()); ?>">
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css') ;?>" />
    
<style type="text/css">
    [contenteditable=true]:empty:before{
  content: attr(placeholder);
  display: block;
  font-size: 14px; /* For Firefox */
}
</style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php if ($businessdata[0]['business_step'] == 4) { ?>
            <?php echo $business_header2_border; ?>
        <?php } ?>
<!--        <div class="js">
            <div id="preloader"></div>-->
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

                                        <li class="custom-none"><a href="<?php echo base_url('business-profile/contact-information'); ?>">Contact Information</a></li>

                                        <li <?php if ($this->uri->segment(1) == 'business-profile') { ?> class="active init" <?php } ?>><a href="#">Description</a></li>

                                        <li class="custom-none <?php
                                        if ($businessdata[0]['business_step'] < '3') {
                                            echo "khyati";
                                        }
                                        ?>"><a href="<?php echo base_url('business-profile/image'); ?>">Business Images</a></li>
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
                                    <h3>
                                        Description
                                    </h3>
                                    <?php echo form_open(base_url('business-profile/description-insert'), array('id' => 'businessdis', 'name' => 'businessdis', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                    </div>
                                    <?php
                                    $business_type = form_error('business_type');
                                    $industriyal = form_error('industriyal');
                                    $subindustriyal = form_error('subindustriyal');
                                    $business_details = form_error('business_details');
                                    ?> 
                                    <fieldset <?php if ($business_type) { ?> class="error-msg" <?php } ?>>
                                        <label>Business Type:<span style="color:red">*</span></label>
                                        <select name="business_type" tabindex="1" autofocus id="business_type" onchange="busSelectCheck(this);">
                                            <!-- <option value="" selected option disabled>Select Business type</option> -->
                                            <?php
                                            if ($business_type1) {
                                                $businessname = $this->db->get_where('business_type', array('type_id' => $business_type1))->row()->business_name;
                                                ?>
                                                <option value="<?php echo $business_type1; ?>"><?php echo $businessname; ?></option>
                                                <?php
                                                foreach ($businesstypedata as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['type_id']; ?>"><?php echo $cnt['business_name']; ?></option>

                                                <?php } ?>
                                                <option id="busOption" value="0" <?php
                                                if ($business_type1 == 0) {
                                                    echo "selected";
                                                }
                                                ?>>Other</option>
                                                        <?php
                                                    } else {
                                                        if (count($businesstypedata) > 0) {
                                                            ?>
                                                    <option value="" <?php
                                                    if ($business_type1 == '') {
                                                        echo "selected";
                                                    }
                                                    ?>>Select Business Type</option>
                                                            <?php foreach ($businesstypedata as $cnt) {
                                                                ?>

                                                        <option value="<?php echo $cnt['type_id']; ?>"><?php echo $cnt['business_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <option id="busOption" value="0" <?php
                                                if ($business_type1 == '0') {
                                                    echo "selected";
                                                }
                                                ?>>Other</option>
                                                    <?php }
                                                    ?>
                                        </select>
                                        <?php echo form_error('business_type'); ?>
                                    </fieldset>
                                    <fieldset <?php if ($industriyal) { ?> class="error-msg" <?php } ?>>
                                        <label>Category:<span style="color:red">*</span></label>
                                        <select name="industriyal" tabindex="2"  id="industriyal" onchange="indSelectCheck(this);">
                                            <!-- <option id="indOption" value="0" <?php
                                            if ($industriyal1 == 0) {
                                                echo "selected";
                                            }
                                            ?>>Any Other</option> -->  
                                            <?php
                                            if ($industriyal1) {
                                                $industryname = $this->db->get_where('industry_type', array('industry_id' => $industriyal1))->row()->industry_name;
                                                ?>
                                                <option value="<?php echo $industriyal1; ?>"><?php echo $industryname; ?></option>
                                                <?php
                                                foreach ($industriyaldata as $cnt) {
                                                    ?>
                                                    <option value="<?php echo $cnt['industry_id']; ?>"><?php echo $cnt['industry_name']; ?></option>
                                                <?php }
                                                ?>
                                                <option id="indOption" value="0" <?php
                                                if ($industriyal1 == 0) {
                                                    echo "selected";
                                                }
                                                ?>>Other</option>  
                                                        <?php
                                                    } else {
                                                        ?>
                                                <option value="" <?php
                                                if ($industriyal1 == '') {
                                                    echo "selected";
                                                }
                                                ?>>Select Category</option>
                                                        <?php
                                                        if (count($industriyaldata) > 0) {
                                                            foreach ($industriyaldata as $cnt) {
                                                                ?>

                                                        <option value="<?php echo $cnt['industry_id']; ?>"><?php echo $cnt['industry_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <option id="indOption" value="0" <?php
                                                if ($industriyal1 == '0') {
                                                    echo "selected";
                                                }
                                                ?>>Other</option>

                                            <?php }
                                            ?>
                                        </select>

                                        <?php echo form_error('industriyal'); ?>
                                    </fieldset>
                                    <div id="busDivCheck" <?php if ($business_type1 != 0) { ?>style="display:none" <?php } ?>>
                                        <fieldset <?php if ($subindustrial) { ?> class="error-msg" <?php } ?> class="half-width" id="other-business" style="display:none;">
                                            <?php if ($business_type1 == 0) { ?>        <!-- <label id="bustype">Add Here Your Other Business type:<span style="color:red;" >*</span></label> --> <?php } ?>
                                            <label> Other Business Type: <span style="color:red;" >*</span></label>
                                            <input type="text" name="bustype"  tabindex="3"  id="bustype" value="<?php echo $other_business; ?>" style="<?php
                                            if ($business_type1 != 0) {
                                                echo 'display: none';
                                            }
                                            ?>" required="">
                                                   <?php echo form_error('subindustriyal'); ?>
                                        </fieldset>
                                    </div>
                                    <div id="indDivCheck" <?php if ($industriyal1 != 0) { ?>style="display:none" <?php } ?>>
                                        <fieldset <?php if ($subindustrial) { ?> class="error-msg" <?php } ?> class="half-width" id="other-category" style="display:none;">
                                            <?php if ($industriyal1 == 0) { ?>    <!--  <label id="indtype">Add Here Your Other Category type:<span style="color:red">*</span></label> --> <?php } ?>
                                            <label> Other Category:<span style="color:red;" >*</span></label>
                                            <input type="text" name="indtype" id="indtype" tabindex="4"  value="<?php echo $other_industry; ?>" 
                                                   style="<?php
                                                   if ($industriyal1 != 0) {
                                                       echo 'display: none';
                                                   }
                                                   ?>" required="">
                                                   <?php echo form_error('subindustriyal'); ?>
                                        </fieldset>
                                    </div>
                                    <fieldset <?php if ($business_details) { ?> class="error-msg" <?php } ?> class="full-width">
                                        <label>Details of your business:<span style="color:red">*</span></label>
                                        <div contenteditable="true" name="business_details" id="business_details" rows="4" tabindex="5"  cols="50" placeholder="Enter Business Detail" style="resize: none;"><?php
                                            if ($business_details1) {
                                                echo $business_details1;
                                            }
                                            ?></div>
                                        <?php echo form_error('business_details'); ?>
                                    </fieldset>
                                    <fieldset class="hs-submit full-width">
                                        <input type="submit"  id="next" name="next" value="Next" tabindex="6" >
                                    </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!--</div>-->
        <footer>
            <?php echo $footer; ?>
        </footer>
        <script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
<!--        <script src="<?php // echo base_url('js/jquery-ui.min.js?ver='.time()); ?>"></script>
        <script src="<?php // echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>
        <script src="<?php // echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>-->

        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
        <!-- POST BOX JAVASCRIPT END --> 
        <script>
                                                    var base_url = '<?php echo base_url(); ?>';
                                                    var slug = '<?php echo $slugid; ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/description.js?ver='.time()); ?>"></script>
        <script type="text/javascript" defer="defer" src="<?php echo base_url('js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
    </body>
</html>

