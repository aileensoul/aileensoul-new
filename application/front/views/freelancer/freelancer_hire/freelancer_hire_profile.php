<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <style type="text/css">
            #popup-form img{display: none;}
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        if ($returnpage == 'freelancer_post') {
            echo $freelancer_post_header2_border;
        } else {
            echo $freelancer_hire_header2_border;
        }
        ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result" onclick="" >Cancel</button>
                        <button class="btn btn-success set-btn upload-result " onclick="myFunction()">Save</button>
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
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             <?php }
                             ?>
                    </div>
                </div>
            </div>
            <div class="container tablate-container  art-profile">    

                <?php if ($returnpage == '') { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                <?php } ?>



                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php if ($freelancerhiredata[0]['freelancer_hire_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freelancerhiredata[0]['freelancer_hire_user_image']); ?>" alt="" >
                            <?php } else { ?>
                                <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <?php if ($returnpage == '') { ?>
                                <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);">
                            <h3> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freelancerhiredata[0]['username']); ?></h3>
                        </a>
                        <div class="profile-text">

                            <?php
                            if ($returnpage == '') {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else { ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    Designation
                                <?php } else {
                                    ?>
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                    </div>

                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr">  
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freelancerhiredata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">

                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Employer Details" href="<?php echo base_url('freelancer-hire/employer-details/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>">Employer Details</a> <?php } else { ?> <a title="Employer Details" href="<?php echo base_url('freelancer-hire/employer-details'); ?>">Employer Details</a> <?php } ?>
                                    </li>
                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer_save')) { ?> class="active" <?php } ?>> 
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Post"  href="<?php echo base_url('freelancer-hire/projects/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>">Projects</a><?php } else { ?><a title="Post" href="<?php echo base_url('freelancer-hire/projects'); ?>">Post</a><?php } ?>
                                    </li>
                                    <?php
                                    if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'projects' || $this->uri->segment(2) == 'employer-details' || $this->uri->segment(2) == 'add-projects' || $this->uri->segment(2) == 'freelancer-save') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) {
                                        ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>">Saved Freelancer</a>
                                        </li>
                                    <?php } ?>
                                </ul>                          
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($userid != $this->uri->segment(3)) {
                                    if ($this->uri->segment(3) != "") {
                                        ?>
                                        <div class="flw_msg_btn fr">
                                            <ul>
                                                <li> <a href="<?php echo base_url('chat/abc/' . $this->uri->segment(3).'/3/4'); ?>">Message</a> </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>


                <?php if ($returnpage == '') { ?>
                    <div  class="add-post-button mob-block">
                        <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Post Project</a>

                    </div>
                <?php } ?>
                <div class="middle-part container">          
                    <div class="job-menu-profile mob-none pt20">
                        <a href="javascript:void(0);">
                            <h5> <?php echo ucwords($freelancerhiredata[0]['fullname']) . ' ' . ucwords($freelancerhiredata[0]['username']); ?></h5>
                        </a>
                        <div class="profile-text">

                            <?php
                            if ($returnpage == '') {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else { ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    Designation
                                <?php } else {
                                    ?>
                                    <a   title=" <?php echo ucwords($freelancerhiredata[0]['designation']); ?>">
                                        <?php echo ucwords($freelancerhiredata[0]['designation']); ?> </a>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <div  class="add-post-button">
                            <?php if ($returnpage == '') { ?>
                                <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Post Project</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mob-clear">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Employer Details</h3>
                                <?php

                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?>                              
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li> <p class="details_all_tital "> Basic Information</p> </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Name</b> <span> <?php echo $freelancerhiredata[0]['fullname'] . ' ' . $freelancerhiredata[0]['username']; ?> </span>
                                                        </li>

                                                        <li> <b>Email </b><span> <?php echo $freelancerhiredata[0]['email']; ?></span>
                                                        </li>



                                                        <?php
                                                        if ($returnpage == 'freelancer_post') {
                                                            if ($freelancerhiredata['skyupid']) {
                                                                ?>
                                                                <li> <b>Skype Id</b> <span> <?php echo $freelancerhiredata[0]['skyupid']; ?> </span>
                                                                </li> 
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerhiredata[0]['skyupid']) {
                                                                ?>
                                                                <li> <b>Skype Id</b> <span> <?php echo $freelancerhiredata[0]['skyupid']; ?> </span>
                                                                </li> 
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Skype Id</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($returnpage == 'freelancer_post') {
                                                            if ($freelancerhiredata[0]['phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $freelancerhiredata[0]['phone']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerhiredata[0]['phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $freelancerhiredata[0]['phone']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Phone Number</b> <span>
                                                                <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                    </ul>
                                                </div>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li> <p class="details_all_tital "> Address</p> </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $freelancerhiredata[0]['country']))->row()->country_name; ?> </span>
                                                            </li>

                                                            <li> <b>State </b><span><?php
                                                                    echo
                                                                    $this->db->get_where('states', array('state_id' => $freelancerhiredata[0]['state']))->row()->state_name;
                                                                    ?> </span>
                                                            </li>

                                                            <?php
                                                            if ($returnpage == 'freelancer_post') {
                                                                if ($freelancerhiredata[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $freelancerhiredata[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerhiredata[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $freelancerhiredata[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b>City</b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($returnpage == 'freelancer_post') {
                                                                if ($freelancerhiredata[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode </b><span><?php echo $freelancerhiredata[0]['pincode']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerhiredata[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode </b><span><?php echo $freelancerhiredata[0]['pincode']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b>Pincode</b> <span>
                                                                    <?php echo PROFILENA; ?></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <li> <b>Postal Address </b><span><p> <?php echo $freelancerhiredata[0]['address']; ?> 
                                                                    </p></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li><p class="details_all_tital ">Professional Information</p></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b>Professional Information </b> <span> 
                                                                    <pre>  <?php echo $this->common->make_links($freelancerhiredata[0]['professional_info']); ?> 
                                                                    </pre></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                                <div class="profile-job-post-title clearfix">
                                                </div>
                                            </div>
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
                                <input type="hidden" name="hitext" id="hitext" value="4">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image"/>

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
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>         
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
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_profile.js'); ?>"></script>
    </body>
</html>