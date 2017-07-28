<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
        <style type="text/css">
            #popup-form img{display: none;}
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success cancel-result" onclick="" ><?php echo $this->lang->line("cancel"); ?></button>

                        <button class="btn btn-success set-btn upload-result " onclick="myFunction()"><?php echo $this->lang->line("save"); ?></button>

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
                        $image = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>
                            <img src="<?php echo base_url($this->config->item('free_hire_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
                             <?php }
                             ?>
                    </div>
                </div>
            </div>
            <div class="container tablate-container  art-profile">    

                <?php if ($returnpage == '') { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext"><?php echo $this->lang->line("upload_cover_photo"); ?></span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                    <!-- cover image end-->
                <?php } ?>
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic padd_img">
                            <?php if ($freehiredata[0]['freelancer_hire_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freehiredata[0]['freelancer_hire_user_image']); ?>" alt="" >
                            <?php } else { ?>
                                <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i><?php echo $this->lang->line("update_profile_picture"); ?></a>

                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);">   <h3> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freehiredata[0]['username']); ?></h3></a>
                        <div class="profile-text">
                            <?php
                            if ($freehiredata[0]['designation'] == '') {
                                ?>
                                <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>

                            <?php } else { ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freehiredata[0]['designation']); ?>"><?php echo ucwords($freehiredata[0]['designation']); ?></a>                <?php } ?>
                        </div>
                    </div>         
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr">  

                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freehiredata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">

                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>                                    
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details" href="<?php echo base_url('freelancer-hire/employer-details'); ?>">Employer Details</a>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'employer-details' || $this->uri->segment(2) == 'add-projects' || $this->uri->segment(2) == 'freelancer-save') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                                        <li rel="stylesheet" type="text/css" href="" <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'projects')) { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('freelancer-hire/projects'); ?>">Projects</a>
                                        </li>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>">Saved Freelancer</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="add-post-button mob-block">
                <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line("post_project"); ?></a>
            </div>
        </div>
        <div class="middle-part container">
            <div class="job-menu-profile mob-none pt20">
                <a href="javascript:void(0);">   <h5> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freehiredata[0]['username']); ?></h5></a>
                <div class="profile-text">
                    <?php
                    if ($freehiredata[0]['designation'] == '') {
                        ?>
                        <a id="designation" class="designation" title="Designation"><?php echo $this->lang->line("designation"); ?></a>

                    <?php } else { ?> 
                        <a id="designation" class="designation" title="<?php echo ucwords($freehiredata[0]['designation']); ?>"><?php echo ucwords($freehiredata[0]['designation']); ?></a>  <?php } ?>
                </div>
                <div  class="add-post-button">
                    <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line("post_project"); ?></a>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 mob-clear">
                <div class="common-form">
                    <div class="job-saved-box">
                        <h3><?php echo $this->lang->line("saved_freelancer"); ?></h3>
                        <div class="contact-frnd-post">
                            <?php
                            if ($postdata) {
                                foreach ($postdata as $rec) {
                                    ?> 
                                    <!-- <div class="job-contact-frnd"> -->
                                    <div class="job-contact-frnd">
                                        <div id="<?php echo "removeapply" . $rec['save_id'] ?>">
                                            <div class="profile-job-post-detail clearfix">
                                                <div class="profile-job-post-title-inside clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-post-location-name-rec">

                                                            <div style="display: inline-block; float: left;">
                                                                <div  class="buisness-profile-pic-candidate">
                                                                    <?php
                                                                    if ($rec['freelancer_post_user_image']) {
                                                                        ?>
                                                                        <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $rec['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']); ?>">
                                                                            <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $rec['freelancer_post_user_image']); ?>" alt="<?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"> </a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="<?php echo base_url('freelancer-work/freelancer-details/' . $rec['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']); ?>">
                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']); ?>"> </a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            <div class="designation_rec" style="float: left;">
                                                                <ul>

                                                                    <li>
                                                                        <a  class="post_name" href="<?php echo base_url('freelancer-work/freelancer-details/' . $rec['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']); ?>">
                                                                            <?php echo ucwords($rec['freelancer_post_fullname']) . ' ' . ucwords($rec['freelancer_post_username']); ?>
                                                                        </a></li>

                                                                    <li style="display: block;"> <a href="#">
                                                                            <?php
                                                                            if ($rec['designation']) {
                                                                                echo $rec['designation'];
                                                                            } else {
                                                                                echo "Designation";
                                                                            }
                                                                            ?> </a> </li>

                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="profile-job-post-title clearfix">

                                                    <div class="profile-job-profile-menu">

                                                        <ul class="clearfix">
                                                            <li><b><?php echo $this->lang->line("skill"); ?></b><span>
                                                                    <?php
                                                                    $comma = " , ";
                                                                    $k = 0;
                                                                    $aud = $rec['freelancer_post_area'];
                                                                    $aud_res = explode(',', $aud);

                                                                    if (!$rec['freelancer_post_area']) {
                                                                        echo $rec['freelancer_post_otherskill'];
                                                                    } else if (!$rec['freelancer_post_otherskill']) {
                                                                        foreach ($aud_res as $skill) {
                                                                            if ($k != 0) {
                                                                                echo $comma;
                                                                            }
                                                                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;

                                                                            echo $cache_time;

                                                                            $k++;
                                                                        }
                                                                    } else if ($rec['freelancer_post_area'] && $rec['freelancer_post_otherskill']) {

                                                                        foreach ($aud_res as $skill) {
                                                                            if ($k != 0) {
                                                                                echo $comma;
                                                                            }
                                                                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;

                                                                            echo $cache_time;

                                                                            $k++;
                                                                        } echo "," . $rec['freelancer_post_otherskill'];
                                                                    }
                                                                    ?>       </span>

                                                            </li>
                                                            <?php $cityname = $this->db->get_where('cities', array('city_id' => $rec['freelancer_post_city']))->row()->city_name; ?>

                                                            <li><b><?php echo $this->lang->line("location"); ?></b><span> <?php
                                                                    if ($cityname) {
                                                                        echo $cityname;
                                                                    } else {
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?></span></li>
                                                            <li><b><?php echo $this->lang->line("skill_description"); ?></b><span><p>
                                                                        <?php
                                                                        if ($rec['freelancer_post_skill_description']) {
                                                                            echo $rec['freelancer_post_skill_description'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></p></span>
                                                            </li>

                                                            <li><b><?php echo $this->lang->line("avaiability"); ?></b><span>
                                                                    <?php
                                                                    if ($rec['freelancer_post_work_hour']) {
                                                                        echo $rec['freelancer_post_work_hour'] . "  " . "Hours per week ";
                                                                    } else {
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?></span>
                                                            </li>
                                                            <li><b><?php echo $this->lang->line("rate"); ?></b><span>
                                                                    <?php
                                                                    if ($rec['freelancer_post_hourly']) {
                                                                        $currency = $this->db->get_where('currency', array('currency_id' => $rec['freelancer_post_ratestate']))->row()->currency_name;
                                                                        if ($rec['freelancer_post_fixed_rate'] == '1') {
                                                                            $rate_type = 'Fixed';
                                                                        } else {
                                                                            $rate_type = 'Hourly';
                                                                        }
                                                                        echo $rec['freelancer_post_hourly'] . "   " . $currency . "  " . $rate_type;
                                                                    } else {
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </li>
                                                            <li><b><?php echo $this->lang->line("total_experiance"); ?></b><span>
                                                                    <?php
                                                                    if ($rec['freelancer_post_exp_year'] || $rec['freelancer_post_exp_month']) {

                                                                        if ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] == '') {
                                                                            echo "1 year";
                                                                        } elseif ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] == '0 year') {
                                                                            echo "1 year";
                                                                        } elseif ($rec['freelancer_post_exp_month'] == '12 month' && $rec['freelancer_post_exp_year'] != '') {
                                                                            $year = explode(' ', $rec['freelancer_post_exp_year']);
                                                                            // echo $year;
                                                                            $totalyear = $year[0] + 1;
                                                                            echo $totalyear . " year";
                                                                        } elseif ($rec['freelancer_post_exp_year'] != '' && $rec['freelancer_post_exp_month'] == '') {
                                                                            echo $rec['freelancer_post_exp_year'];
                                                                        } elseif ($rec['freelancer_post_exp_year'] != '' && $rec['freelancer_post_exp_month'] == '0 month') {

                                                                            echo $rec['freelancer_post_exp_year'];
                                                                        } else {

                                                                            echo $rec['freelancer_post_exp_year'] . ' ' . $rec['freelancer_post_exp_month'];
                                                                        }
                                                                    } else {
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?></span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="apply-btn fr">
                                                            <?php
                                                            $userid = $this->session->userdata('aileenuser');
                                                            if ($userid != $rec['user_id']) {
                                                                ?>
                                                                <a href="<?php echo base_url('chat/abc/' . $rec['user_id'].'/3/4'); ?>"><?php echo $this->lang->line("message"); ?></a>
                                                                <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $rec['save_id'] ?>)"><?php echo $this->lang->line("remove"); ?></a>
                                                            <?php } ?>
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
                                    <h4 class="page-heading  product-listing"><?php echo $this->lang->line("no_saved_freelancer"); ?></h4>
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
    <!-- model for popup -->
    <!-- Bid-modal-2  -->
    <div class="modal fade message-box" id="bidmodal-2" role="dialog">
        <div class="modal-dialog modal-lm">
            <div class="modal-content">
                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                <div class="modal-body">
                    <span class="mes">
                        <div id="popup-form">
                            <?php echo form_open_multipart(base_url('freelancer/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                            <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                            <input type="hidden" name="hitext" id="hitext" value="3">
                            <div class="popup_previred">
                                <img id="preview" src="#" alt="your image" />
                            </div>
                            <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                            <?php echo form_close(); ?>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Model Popup Close -->
    <!-- Model Popup Open -->
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
    <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>">
    </script>
    <script>
        var base_url = '<?php echo base_url(); ?>';
        var data = <?php echo json_encode($demo); ?>;
        var data1 = <?php echo json_encode($city_data); ?>;
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_save.js'); ?>"></script>





</body>
</html>