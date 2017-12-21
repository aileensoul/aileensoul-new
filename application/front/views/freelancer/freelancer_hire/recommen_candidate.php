<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">
    </head>
    <body class="pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container padding-360">
                    <div class="row4">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" 
                                               title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">

                                                <?php if ($freehiredata[0]['profile_background'] != '') { ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo FREE_HIRE_BG_THUMB_UPLOAD_URL . $freehiredata[0]['profile_background']; ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname']. " ".$freehiredata[0]['username'];  ?>" >
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="data_img bg-images no-cover-upload">
                                                        <img alt="No Image" src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage">
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
                                                    <?php
                                                    $fname = $freehiredata[0]['fullname'];
                                                    $lname = $freehiredata[0]['username'];
                                                    $sub_fname = substr($fname, 0, 1);
                                                    $sub_lname = substr($lname, 0, 1);

                                                    if ($freehiredata[0]['freelancer_hire_user_image']) {
                                                        if (IMAGEPATHFROM == 'upload') {
                                                            if (!file_exists($this->config->item('free_hire_profile_main_upload_path') . $freehiredata[0]['freelancer_hire_user_image'])) {
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                </div>
                                                            <?php } else {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freehiredata[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" > 
                                                                <?php
                                                            }
                                                        } else {
                                                            $filename = $this->config->item('free_hire_profile_main_upload_path') . $freehiredata[0]['freelancer_hire_user_image'];
                                                            $s3 = new S3(awsAccessKey, awsSecretKey);
                                                            $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                            if ($info) {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freehiredata[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >
                                                            <?php } else {
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                </div> 
                                                                <?php
                                                            }
                                                        }
                                                    } else {
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
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => '1'))->row()->industry_name; ?>
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
                                                    <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                

     <?php echo $left_footer; ?>

                                <div  class="add-post-button">
                                    <a title="Post Project" class="btn btn-3 btn-3b" id ="Fh-post-project" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line("post_project"); ?></a>
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
                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
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
                                        <div class="fw" id="loader" style="text-align:center;"><img alt="loader" src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- middle div  -->
                        <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 

                        <div class="all-profile-box">
                                <div class="all-pro-head">
                                    <h4>Profiles<a title="All" href="<?php echo base_url('profiles/') . $this->session->userdata('aileenuser_slug'); ?>" class="pull-right">All</a></h4>
                                </div>
                                <ul class="all-pr-list">
                                    <li>
                                        <a title="Job Profile" href="<?php echo base_url('job'); ?>">
                                            <div class="all-pr-img">
                                                <img alt="Job Profile" src="<?php echo base_url('assets/img/i1.jpg'); ?>">
                                            </div>
                                            <span>Job Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Recruiter Profile" href="<?php echo base_url('recruiter'); ?>">
                                            <div class="all-pr-img">
                                                <img alt="Recruiter Profile" src="<?php echo base_url('assets/img/i2.jpg'); ?>">
                                            </div>
                                            <span>Recruiter Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Freelancer Profile" href="<?php echo base_url('freelancer'); ?>">
                                            <div class="all-pr-img">
                                                <img alt="Freelancer Profile" src="<?php echo base_url('assets/img/i3.jpg'); ?>">
                                            </div>
                                            <span>Freelance Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Business Profile" href="<?php echo base_url('business-profile'); ?>">
                                            <div class="all-pr-img">
                                                <img alt="Business Profile" src="<?php echo base_url('assets/img/i4.jpg'); ?>">
                                            </div>
                                            <span>Business Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a title="Artistic Profile" href="<?php echo base_url('artist'); ?>">
                                            <div class="all-pr-img">
                                                <img alt="Artistic Profile" src="<?php echo base_url('assets/img/i5.jpg'); ?>">
                                            </div>
                                            <span>Artistic Profile</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    

                    </div>
                </div>
            </div>
        </section>
        <?php echo $footer; ?>
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
        <script>
                                            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/recommen_candidate.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>
    </body>
</html>