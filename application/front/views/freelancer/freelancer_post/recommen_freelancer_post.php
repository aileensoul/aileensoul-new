<!DOCTYPE html>
<html>
    <head><title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver='.time()); ?>">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">-->
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver='.time()) ?>" />
		
                <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-apply/freelancer-apply.css?ver='.time()); ?>">
    </head>
    <body>
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <!--COVER PIC START-->
                        <div class="col-md-4 profile-box  animated fadeInLeftBig profile-box-left"><div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                <?php
                                                if ($freepostdata[0]['profile_background'] != '') {
                                                    ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo FREE_HIRE_BG_ORIGINAL_UPLOAD_URL . $freepostdata[0]['profile_background']; ?>" class="bgImage" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>" >
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>"  >
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">
                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" 
                                                   href="<?php echo base_url('freelancer-work/freelancer-details/' . $freepostdata[0]['user_id']); ?>" title="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                       <?php
                                                       if ($freelancerdata[0]['freelancer_post_user_image']) {
                                                           ?>
                                                        <div class="data_img_2">
                                                            <img src="<?php echo FREE_POST_PROFILE_THUMB_UPLOAD_URL . $freepostdata[0]['freelancer_post_user_image']; ?>" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>" >
                                                        </div>
                                                        <?php
                                                    } else {
                                                        $fname = $freepostdata[0]['freelancer_post_fullname'];
                                                        $lname = $freepostdata[0]['freelancer_post_username'];
                                                        $sub_fname = substr($fname, 0, 1);
                                                        $sub_lname = substr($lname, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
                                                            <?php echo ucfirst(strtolower($sub_fname)) .  ucfirst(strtolower($sub_lname)); ?>
                                                        </div> 
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo ucwords($freepostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freepostdata[0]['freelancer_post_username']); ?></a>
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('freelancer-work/freelancer-details'); ?>">
                                                        <?php
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
                            </div>
                        </div>
                        <!--COVER PIC END-->
                        <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right animated fadeInUp">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>Search result of 
                                        <?php
                                        if ($keyword != "" && $keyword1 == "") {
                                            echo '"' . $keyword . '"';
                                        } elseif ($keyword == "" && $keyword1 != "") {
                                            echo '"' . $keyword1 . '"';
                                        } else {
                                            echo '"' . $keyword . '"';
                                            echo " and ";
                                            echo '"' . $keyword1 . '"';
                                        }
                                        ?></h3>
                                    <div class="contact-frnd-post">
                                       
                                      <!--....................AJAX DATA..............-->
                                      <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
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
        <!-- script for skill textbox automatic start (option 2)-->
        <script src="<?php echo base_url('js/jquery.wallform.js?ver='.time()); ?>"></script>
        <!--<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>-->
       
        </script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var skill = '<?php echo  $this->input->get('skills'); ?>';
            var place = '<?php echo  $this->input->get('searchplace'); ?>';
            var button = '<?php echo  $this->input->get('search_submit'); ?>';
           
        </script>
        <!-- script for skill textbox automatic end -->
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_apply_search_result.js?ver='.time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_apply_common.js?ver='.time()); ?>"></script>
    </body>
</html>



