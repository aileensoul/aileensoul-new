<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/profiles/freelancer-apply/freelancer-apply.css?ver='.time()); ?>">
       
        <style type="text/css">
            /* img{display: none;}*/
        </style>
    </head>
    <!--<div class="js">-->
        <body>
            <!--<div id="preloader"></div>-->
            <?php echo $header; ?>
            <?php
            if ($freepostdata[0]['user_id'] && $freepostdata[0]['free_post_step'] == '7') {
                echo $freelancer_post_header2_border;
            }
            ?>
            <section class="custom-row">
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
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/rate'); ?>"><?php echo $this->lang->line("rate"); ?></a></li>
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/avability'); ?>"><?php echo $this->lang->line("add_avability"); ?></a></li>
                                        <li class="custom-none"><a href="<?php echo base_url('freelancer-work/education'); ?>"><?php echo $this->lang->line("education"); ?></a></li>           
                                        <li <?php if ($this->uri->segment(1) == 'freelancer-work') { ?> class="active init" <?php } ?>><a href="javascript:void(0);"><?php echo $this->lang->line("portfolio"); ?></a></li>
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
                                    <h3><?php echo $this->lang->line("portfolio"); ?></h3>
                                    <form name="freelancer_post_portfolio" method="post" id="freelancer_post_portfolio" 
                                          class="clearfix"  enctype="multipart/form-data" >
                                        <fieldset> 
                                            <label><?php echo $this->lang->line("attach"); ?>:</label>
                                            <input type="file" name="portfolio_attachment" id="portfolio_attachment" class="portfolio_attachment" tabindex="1" autofocus placeholder="Portfolio attachment" multiple="" />&nbsp;&nbsp;&nbsp; 
                                            <span id ="filename" class="file_name_pdf"><?php echo $portfolio_attachment1; ?></span><span class="file_name"></span>
                                            <div class="portfolio_image" style="color:#f00; display: block;"></div>
                                            <?php if ($portfolio_attachment1) { ?>
                                                <div style="visibility:show;" id ="pdffile">
                                                    <?php $userid = $this->session->userdata('aileenuser'); ?>
                                                    <a href="<?php echo base_url('freelancer/pdf/' . $userid) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>
                                                    <a style="position: absolute; cursor:pointer;" onclick="delpdf();"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </div>
                                            <?php } ?>
                                            <input type="hidden" tabindex="2" name="image_hidden_portfolio" id="image_hidden_portfolio" value="<?php
                                            if ($portfolio_attachment1) {
                                                echo $portfolio_attachment1;
                                            }
                                            ?>">
                                        </fieldset>   
                                        <fieldset class="full-width">
                                            <label><?php echo $this->lang->line("descri"); ?>:</label>
                                            <div tabindex="2" style="width: 93%"  class="editable_text"  contenteditable="true" name ="portfolio" id="portfolio123" rows="4" cols="50" placeholder="Enter portfolio detail" style="resize: none;" onpaste="OnPaste_StripFormatting(this, event);"><?php
                                                if ($portfolio1) {
                                                    echo $portfolio1;
                                                }
                                                ?>
                                            </div>
                                            <?php echo form_error('portfolio'); ?> 
                                        </fieldset>
                                        <input type="hidden" tabindex="2" name="free_step" id="free_step" value="<?php echo $free_post_step; ?>">
                                        <fieldset class="hs-submit full-width">
                                            <input type="submit"  id="submit" tabindex="4" name="submit" value="Submit" onclick="return portfolio_form_submit(event);" >
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
            <!--<script src="<?php echo base_url('assets/js/jquery-ui.min.js'); ?>"></script>-->
            </script>
            <script>
                var base_url = '<?php echo base_url(); ?>';
               
            </script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_post_portfolio.js?ver='.time()); ?>"></script>
             <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_common.js?ver='.time()); ?>"></script>
        </body>
    <!--</div>-->
</html>