<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <style type="text/css">
            #popup-form img{display: none;}
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed">
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2; ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success cancel-result" onclick="" ><?php echo $this->lang->line("cancel"); ?></button>
                        <button class="btn btn-success set-btn upload-result" onclick="myFunction()"><?php echo $this->lang->line("save"); ?></button>
                        <div id="message1" style="display:none;">
                            <div id="floatBarsG">
                                <div id="floatBarsG_1" class="floatBarsG"></div>
                                <div id="floatBarsG_2" class="floatBarsG"></div>
                                <div id="floatBarsG_3" class="floatBarsG"></div>
                                <div id="floatBarsG_4" class="floatBarsG"></div>
                                <div id="floatBarsG_5" class="floatBarsG"></div>
                                <div id="floatBarsG_6" class="floatBarsG"></div>
                                <div id="floatBarsG_7" class="floatBarsG"></div>
                                <div id="floatBarsG_8" class="floatBarsG"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12"  style="visibility: hidden; ">
                        <div id="upload-demo-i" ></div>
                    </div>
                </div>
                <div class="">
                    <div class="" id="row2">
                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($this->uri->segment(3) == $userid) {
                            $user_id = $userid;
                        } elseif ($this->uri->segment(3) == "") {
                            $user_id = $userid;
                        } else {
                            $user_id = $this->uri->segment(3);
                        }
                        $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                        $image = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>
                            <img src="<?php echo base_url($this->config->item('free_post_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             <?php }
                             ?>
                    </div>
                </div>
            </div>
            <div class="container tablate-container art-profile">
                <div class="upload-img">
                    <label class="cameraButton"><span class="tooltiptext"><?php echo $this->lang->line("upload_cover_photo"); ?></span><i class="fa fa-camera" aria-hidden="true"></i>
                        <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                    </label>
                </div>
                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php if ($jobdata[0]['freelancer_post_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $jobdata[0]['freelancer_post_user_image']); ?>" alt="" >
                                <?php
                            } else {
                                $fname = $freepostdata[0]['freelancer_post_fullname'];
                                $lname = $freepostdata[0]['freelancer_post_username'];
                                $sub_fname = substr($fname, 0, 1);
                                $sub_lname = substr($lname, 0, 1);
                                ?>
                                <div class="post-img-user">
                                    <?php echo ucfirst(strtolower($sub_fname)) . "  " . ucfirst(strtolower($sub_lname)); ?>
                                </div>
                            <?php } ?>
                            <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i><?php echo $this->lang->line("update_profile_picture"); ?></a>
                        </div>

                    </div>
                    <div class="job-menu-profile mob-block ">
                        <a href="javascript:void(0);">
                            <h3> <?php echo ucwords($freepostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freepostdata[0]['freelancer_post_username']); ?></h3>
                        </a>
                        <div class="profile-text">
                            <?php
                            if ($freepostdata[0]['designation'] == "") {
                                ?>
                                <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freepostdata[0]['designation']); ?>"><?php echo ucwords($freepostdata[0]['designation']); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr">
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freepostdata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">
                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details')) { ?> class="active" <?php } ?>><a title="Freelancer Details" href="<?php echo base_url('freelancer-work/freelancer-details'); ?>">
                                            <?php echo $this->lang->line("freelancer_details"); ?></a>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details' || $this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'saved-projects' || $this->uri->segment(2) == 'applied-projects') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'saved-projects')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelancer-work/saved-projects'); ?>"><?php echo $this->lang->line("saved_projects"); ?></a>
                                        </li>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'applied-projects')) { ?> class="active" <?php } ?>><a title="Applied Post" href="<?php echo base_url('freelancer-work/applied-projects'); ?>"><?php echo $this->lang->line("applied_projects"); ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="middle-part container">
                <div class="job-menu-profile mob-none pt20">
                    <a href="javascript:void(0);">
                        <h5> <?php echo ucwords($freepostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freepostdata[0]['freelancer_post_username']); ?></h5>
                    </a>
                    <div class="profile-text">
                        <?php
                        if ($freepostdata[0]['designation'] == "") {
                            ?>
                            <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>
                            <?php
                        } else {
                            ?> 
                            <a id="designation" class="designation" title="<?php echo ucwords($freepostdata[0]['designation']); ?>"><?php echo ucwords($freepostdata[0]['designation']); ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 mob-clear">
                    <div class="common-form">
                        <div class="job-saved-box">
                            <h3><?php echo $this->lang->line("applied_projects"); ?></h3>
                            <div class="contact-frnd-post">
                                <?php
                                if ($postdata) {

                                    foreach ($postdata as $post) {
                                        ?>
                                        <div class="job-detail clearfix" id="<?php echo "removeapply" . $post['app_id']; ?>">
                                            <div class="job-contact-frnd">
                                                <div class="profile-job-post-detail clearfix" id="<?php echo "removeapplyq" . $post['post_id']; ?>">
                                                    <div class="profile-job-post-title-inside clearfix">
                                                        <div class="profile-job-post-title clearfix margin_btm">
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-details col-md-12">
                                                                    <ul>
                                                                        <li class="fr">
                                                                            <?php echo $this->lang->line("applied_date"); ?> : <?php
                                                                            if ($post['modify_date'] != 0000 - 00 - 00) {
                                                                                echo date('d-M-Y', strtotime($post['modify_date']));
                                                                            } else {
                                                                                echo date('d-M-Y', strtotime($post['created_date']));
                                                                            }
                                                                            ?>
                                                                        </li>
                                                                        <li>
                                                                            <a href="#" title="<?php echo ucwords($this->common->make_links($post['post_name'])); ?>" class="post_title">
                                                                                <?php echo ucwords($this->common->make_links($post['post_name'])); ?> </a>   
                                                                        </li>
                                                                        <?php
                                                                        $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                        $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                        ?>
                                                                        <li>
                                                                            <a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                            </a>
                                                                            <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                            <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                            <?php if ($cityname || $countryname) { ?>
                                                                                <div class="fr lction">
                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true">  <?php
                                                                                            if ($cityname) {
                                                                                                echo $cityname . ",";
                                                                                            }
                                                                                            ?><?php
                                                                                            if ($countryname) {
                                                                                                echo $countryname;
                                                                                            }
                                                                                            ?></i></p>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="profile-job-profile-menu">
                                                                <ul class="clearfix">
                                                                    <li> <b><?php echo $this->lang->line("field"); ?></b> <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>
                                                                        </span>
                                                                    </li>
                                                                    <li> <b><?php echo $this->lang->line("skill"); ?></b> <span> 
                                                                            <?php
                                                                            $comma = ", ";
                                                                            $k = 0;
                                                                            $aud = $post['post_skill'];
                                                                            $aud_res = explode(',', $aud);

                                                                            if (!$post['post_skill']) {

                                                                                echo $post['post_other_skill'];
                                                                            } else if (!$post['post_other_skill']) {

                                                                                foreach ($aud_res as $skill) {
                                                                                    if ($k != 0) {
                                                                                        echo $comma;
                                                                                    }
                                                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                    echo $cache_time;
                                                                                    $k++;
                                                                                }
                                                                            } else if ($post['post_skill'] && $post['post_other_skill']) {
                                                                                foreach ($aud_res as $skill) {
                                                                                    if ($k != 0) {
                                                                                        echo $comma;
                                                                                    }
                                                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                    echo $cache_time;
                                                                                    $k++;
                                                                                } echo "," . $post['post_other_skill'];
                                                                            }
                                                                            ?>     
                                                                        </span>
                                                                    </li>
                                                                    <li>
                                                                        <b><?php echo $this->lang->line("project_description"); ?></b>
                                                                        <span>
                                                                            <p>
                                                                                <?php
                                                                                if ($post['post_description']) {
                                                                                    echo $this->common->make_links($post['post_description']);
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?> 
                                                                            </p>
                                                                        </span>
                                                                    </li>
                                                                    <li><b><?php echo $this->lang->line("rate"); ?></b><span>
                                                                            <?php
                                                                            if ($post['post_rate']) {
                                                                                echo $post['post_rate'];
                                                                                echo "&nbsp";
                                                                                echo $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                                                echo "&nbsp";
                                                                                if ($post['post_rating_type'] == 1) {
                                                                                    echo "Hourly";
                                                                                } else {
                                                                                    echo "Fixed";
                                                                                }
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>
                                                                    </li>
                                                                    <li>
                                                                        <b><?php echo $this->lang->line("required_experiance"); ?></b>
                                                                        <span>
                                                                            <?php
                                                                            if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                                if ($post['post_exp_year']) {
                                                                                    echo $post['post_exp_year'];
                                                                                }
                                                                                if ($post['post_exp_month']) {

                                                                                    if ($post['post_exp_year'] == '0' || $post['post_exp_year'] == '') {
                                                                                        echo 0;
                                                                                    }
                                                                                    echo ".";
                                                                                    echo $post['post_exp_month'];
                                                                                } else {
                                                                                    echo "." . "0";
                                                                                }
                                                                                echo " Year";
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?> 
                                                                        </span>
                                                                    </li>
                                                                    <li><b><?php echo $this->lang->line("estimated_time"); ?></b><span> <?php
                                                                            if ($post['post_est_time']) {
                                                                                echo $post['post_est_time'];
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-details col-md-12">
                                                                    <ul>
                                                                        <li class="job_all_post last_date">
                                                                            <?php echo $this->lang->line("last_date"); ?> : <?php
                                                                            if ($post['post_last_date']) {
                                                                                echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?>                                                          
                                                                        </li>
                                                                        <li class=fr>
                                                                            <a href="javascript:void(0);" class="button fr" onclick="removepopup(<?php echo $post['app_id']; ?>)">Remove<?php echo $this->lang->line("remove"); ?></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="text-center rio">
                                        <h4 class="page-heading  product-listing" ><?php echo $this->lang->line("no_applied_projects"); ?></h4>
                                    </div>
                                <?php }
                                ?>   
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
                       <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('freelancer/user_image_add'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" />
                                </div>
                                <input type="hidden" name="hitext" id="hitext" value="1">
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save"  >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- model for popup start -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                    <div class="modal-body">
                       <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>">
        </script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/freelancer_applied_post.js'); ?>"></script>

    </body>
</html>