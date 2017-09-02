<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-hire/freelancer-hire.css'); ?>">
    </head>
    <body class="pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row row4">
                        <div class="col-md-4 col-sm-4 profile-box profile-box-left  animated fadeInLeftBig">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" 
                                               title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">

                                                <?php if ($freehiredata[0]['profile_background'] != '') { ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_hire_bg_thumb_upload_path') . $freehiredata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"  >
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
                                                    <?php
                                                    if ($freehiredata[0]['freelancer_hire_user_image']) {
                                                        ?>
                                                        <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freehiredata[0]['freelancer_hire_user_image']); ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >

                                                        <?php
                                                    } else {
                                                        $fname = $freehiredata[0]['fullname'];
                                                        $lname = $freehiredata[0]['username'];
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
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freehiredata[0]['username']); ?></a>  
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"><?php
                                                        if ($freehiredata[0]['designation']) {
                                                            echo $freehiredata[0]['designation'];
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                    <li><a title="Post" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>

                                <div class="custom_footer_left fw">
                                    <div class="fl">
                                        <ul>
                                            <li><a href=""> About Us </a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="">Contact Us</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a  href="">Blogs</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="">Terms & Condition </a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="">Privacy Policy</a></li>
                                            <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
                                            <li><a href="">Send Us Feedback</a></li>
                                        </ul>
                                    </div>
                                    <div>

                                    </div>

                                </div>

                                <div  class="add-post-button">
                                    <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line("post_project"); ?></a>
                                </div>
                            </div>

                        </div>
                        <?php

                        function text2link($text) {
                            $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                            $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                            $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                            return $text;
                        }
                        ?>
                        <!-- middle div stat -->
                        <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right animated fadeInUp">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3><?php echo $this->lang->line("recommended_freelancer"); ?></h3>
                                    <div class="contact-frnd-post">
                                        <div class="job-contact-frnd">
                                            <!--AJAX DATA...........-->

                                            <!-- body tag inner data end -->
                                            <div class="col-md-1">
                                            </div>
                                        </div>
                                        <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- middle div  -->
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
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<!--        <script src="<?php //echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

    </script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
        var data = <?php echo json_encode($demo); ?>;
        var data1 = <?php echo json_encode($city_data); ?>;
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/recommen_candidate.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_common.js'); ?>"></script>
</body>
</html>