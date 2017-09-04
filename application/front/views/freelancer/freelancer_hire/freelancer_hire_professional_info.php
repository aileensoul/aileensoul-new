<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-hire/freelancer-hire.css?ver='.time()); ?>">
    </head>
<!--    <div class="js">-->
        <body>
<!--            <div id="preloader"></div>-->
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
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-hire/basic-information'); ?>"><?php echo $this->lang->line("basic_info"); ?></a></li>

                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-hire/address-information'); ?>"><?php echo $this->lang->line("address_info"); ?></a></li>
                                        <li <?php if ($this->uri->segment(1) == 'freelancer-hire') { ?> class="active init" <?php } ?>><a href="#"><?php echo $this->lang->line("professional_info"); ?></a></li>
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
                                <div class="common-form common-form_border ">
                                    <h3><?php echo $this->lang->line("professional_info"); ?></h3>
                                    <?php echo form_open_multipart(base_url('freelancer_hire/freelancer_hire_professional_info_insert'), array('id' => 'professional_info1', 'name' => 'professional_info', 'class' => 'clearfix')); ?>
                                    <div>
                                        <span style="color:#7f7f7e;padding-left: 8px;">( </span><span class="red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e"><?php echo $this->lang->line("filed_required"); ?></span>
                                    </div>
                                    <?php
                                    $professional_info = form_error('professional_info');
                                    ?> 
                                    <fieldset class="full-width">
                                        <label><?php echo $this->lang->line("profess_info"); ?>:<span class="red">*</span></label>
                                        <textarea tabindex="1" autofocus name ="professional_info" id="professional_info" rows="6" cols="50" placeholder="Enter Professional Information" style="resize: none;overflow: auto;" onpaste="OnPaste_StripFormatting(this, event);" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"><?php
                                            if ($professional_info1) {
                                                echo $professional_info1;
                                            }
                                            ?></textarea>
                                        <?php echo form_error('professional_info'); ?> 
                                    </fieldset>
                                    <fieldset style="margin-top: 4%"" class="hs-submit full-width">
                                        <input type="submit" tabindex="2" id="next" name="next" value="Submit">
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
            <!--<script src="<?php //echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver='.time()); ?>"></script>
            <script type="text/javascript">
                var base_url = '<?php echo base_url(); ?>';
                            
            </script>
           
            <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_professional_info.js?ver='.time()); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_common.js?ver='.time()); ?>"></script>
          
        </body>
    <!--</div>-->
</html>