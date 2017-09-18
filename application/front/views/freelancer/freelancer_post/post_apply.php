<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()) ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-apply/freelancer-apply.css?ver='.time()); ?>">
        <!--<script src="<?php //echo base_url('js/fb_login.js'); ?>"></script>-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2_border; ?>
        <section>
            <div class="user-midd-section " id="paddingtop_fixed">
                <div class="container">
                    <div class="row row4">
                        <div class="col-md-4 col-sm-4 animated fadeInLeftBig profile-box profile-box-left">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>"
                                               tabindex="-1"
                                               aria-hidden="true"
                                               rel="noopener">
                                                   <?php
                                                   if ($freelancerdata[0]['profile_background'] != '') {
                                                       ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_post_bg_thumb_upload_path') . $freelancerdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>"  >
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">
                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" 
                                                   href="<?php echo base_url('freelancer-work/freelancer-details'); ?>" title="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                       <?php
                                                       if ($freelancerdata[0]['freelancer_post_user_image']) {
                                                           ?>
                                                        <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $freelancerdata[0]['freelancer_post_user_image']); ?>" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                        <?php
                                                    } else {
                                                        $fname = $freelancerdata[0]['freelancer_post_fullname'];
                                                        $lname = $freelancerdata[0]['freelancer_post_username'];
                                                        $sub_fname = substr($fname, 0, 1);
                                                        $sub_lname = substr($lname, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
                                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo ucwords($freelancerdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerdata[0]['freelancer_post_username']); ?></a>
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php
                                                        if ($freepostdata[0]['designation']) {
                                                            echo ucwords($freepostdata[0]['designation']);
                                                        } else {
                                                            echo $this->lang->line("designation");
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details')) { ?> class="active" <?php } ?>><a  class="padding_less_left"  title="freelancer Details" href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo $this->lang->line("details"); ?></a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'saved-projects')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelancer-work/saved-projects'); ?>"><?php echo $this->lang->line("saved"); ?></a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'applied-projects')) { ?> class="active" <?php } ?>><a title="Applied Post"  class="padding_less_right"  href="<?php echo base_url('freelancer-work/applied-projects'); ?>"><?php echo $this->lang->line("applied"); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <div class="custom_footer_left fw">
                                    <div class="fl">
                                        <ul>
                                            <li><a href="javascript:void(0);"> About Us </a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="javascript:void(0);">Contact Us</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a  href="javascript:void(0);">Blogs</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="javascript:void(0);">Terms & Condition </a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="javascript:void(0);">Privacy Policy</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="javascript:void(0);">Send Us Feedback</a></li>
                                        </ul>
                                    </div>
                                    <div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- cover pic end -->
                        <div class="col-md-7 col-sm-7 animated fadeInUp col-md-push-4 col-sm-push-4 custom-right">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3><?php echo $this->lang->line("recommended_project"); ?></h3>
                                    <div class="contact-frnd-post">
                                        <!--.............AJAX DATA............-->
                                        <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver=' . time()) ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>

        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
        <!--<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
        <script src="<?php echo base_url('js/bootstrap.min.js?ver='.time()); ?>">
        </script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/post_apply.js?ver='.time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_apply_common.js?ver='.time()); ?>"></script>
    </body>               
</html>