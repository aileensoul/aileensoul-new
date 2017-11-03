<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">

    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        //echo $returnpage;die();
        if ($this->session->userdata('aileenuser') != $recliveid) {
            echo $freelancer_post_header2_border;   
        } elseif ($freelancr_user_data[0]['free_hire_step'] == 3) {
            echo $freelancer_hire_header2_border;
        } elseif ($this->session->userdata('aileenuser') == $recliveid) {
            echo $freelancer_hire_header2_border;
        } else {
            
        }
        ?>

        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row4">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt"><div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" onclick="login_profile();" tabindex="-1" 
                                               aria-hidden="true" rel="noopener">
                                            <?php }else{?>
                                                <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelancer-hire/employer-details/'.$recliveid.'?page=freelancer_post'); ?>" onclick="login_profile();" tabindex="-1" 
                                               aria-hidden="true" rel="noopener">
                                            <?php }?>
                                                <div class="bg-images no-cover-upload"> 
                                                    <?php
                                                    // $image_ori = $this->config->item('rec_bg_thumb_upload_path') . $freelancr_user_data[0]['profile_background'];

                                                    if ($freelancr_user_data[0]['profile_background'] != '') {
                                                        ?>
                                                        <!-- box image start -->
                                                        <img src="<?php echo FREE_HIRE_BG_THUMB_UPLOAD_URL . $freelancr_user_data[0]['profile_background']; ?>" class="bgImage" alt="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>">
                                                        <!-- box image end -->
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" >
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">
                                                <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                  <?php   }else{ ?>
                                                    <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details/'.$recliveid.'?page=freelancer_post'); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                    <?php }
                                                    $fname = $freelancr_user_data[0]['fullname'];
                                                    $lname = $freelancr_user_data[0]['username'];
                                                    $sub_fname = substr($fname, 0, 1);
                                                    $sub_lname = substr($lname, 0, 1);

                                                    if ($freelancr_user_data[0]['freelancer_hire_user_image']) {
                                                        if (IMAGEPATHFROM == 'upload') {
                                                            if (!file_exists($this->config->item('free_hire_profile_main_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image'])) {
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                </div>
                                                            <?php } else {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freelancr_user_data[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freelancr_user_data[0]['fullname'] . " " . $freelancr_user_data[0]['username']; ?>" > 
                                                                <?php
                                                            }
                                                        } else {
                                                            $filename = $this->config->item('free_hire_profile_main_upload_path') . $freelancr_user_data[0]['freelancer_hire_user_image'];
                                                            $s3 = new S3(awsAccessKey, awsSecretKey);
                                                            $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                            if ($info) {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freelancr_user_data[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freelancr_user_data[0]['fullname'] . " " . $freelancr_user_data[0]['username']; ?>" >
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
                                                    <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                    <?php }else{?>
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details/'.$recliveid.'?page=freelancer_post'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                    <?php }?>
                                                </span>

                                                <?php //$category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;  ?>
                                                <div class="profile-boxProfile-name">
                                                    <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>">
                                                    <?php  }else{?>
                                                        <a href="<?php echo base_url('freelancer-hire/employer-details/'.$recliveid.'?page=freelancer_post'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data[0]['designation'])); ?>">
                                                    <?php } ?>
                                                    <?php
                                                        if (ucfirst(strtolower($freelancr_user_data[0]['designation']))) {
                                                            echo ucfirst(strtolower($freelancr_user_data[0]['designation']));
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <?php if($this->session->userdata('aileenuser') == $recliveid){  ?>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                    <?php }else{?>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details/'.$recliveid.'?page=freelancer_post'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                    <?php }?>
                                                    <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                                    <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <?php }else{?>
                                                    <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects/'.$recliveid.'?page=freelancer_post'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <?php }?>
                                                    <?php if($this->session->userdata('aileenuser') == $recliveid){ ?>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                 <?php  } ?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <div class="tablate-potrat-add">
                                    <div class="fw text-center pt10">
                                        <script type="text/javascript">
                                            (function () {
                                                if (window.CHITIKA === undefined) {
                                                    window.CHITIKA = {'units': []};
                                                }
                                                ;
                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                var placement_id = window.CHITIKA.units.length;
                                                window.CHITIKA.units.push(unit);
                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                            }());
                                        </script>
                                        <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>
<?php echo $postdata[0]['post_name']; ?>
                                    </h3>
                                    <?php

                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?> 
                                    <div class="contact-frnd-post">
                                         <?php
          foreach ($postdata as $post) {
                        ?>
						<div class="job-contact-frnd">
                                            <div class="profile-job-post-detail clearfix" id="<?php echo "removeapply" . $post['post_id']; ?>">
                                                <div class="profile-job-post-title-inside clearfix">
                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details col-md-12">
                                                                <ul>
                                                                    <li class="fr">
                                                                        Created Date : <?php
                                                                        echo trim(date('d-M-Y', strtotime($post['created_date'])));
                                                                        ?>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" title="<?php echo ucwords(text2link($post['post_name'])); ?>" class="post_title ">
                                                                            <?php echo ucwords($post['post_name']); ?> </a>   </li>


                                                                    <?php
                                                                    $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                    $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                    ?>
                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>

                                                                    <li>
                                                                        <?php if ($this->session->userdata('aileenuser') != $recliveid) { ?>
                                                                            <a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                            </a>

                                                                            <?php if ($cityname || $countryname) { ?>
                                                                                <div class="fr lction display_inline">

                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                                                        <?php if ($cityname) { ?> 
                                                                                            <?php echo $cityname . ","; ?>
                                                                                        <?php } ?>
                                                                                        <?php echo $countryname; ?></p>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } else { ?>
                                                                            <a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id']); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                            </a> 
                                                                            <?php if ($cityname || $countryname) { ?>
                                                                                <div class="fr lction display_inline">

                                                                                    <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"> </i><?php if ($cityname) { ?>
                                                                                            <?php echo $cityname . ","; ?>
                                                                                        <?php } ?>
                                                                                        <?php echo $countryname; ?></p>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b> Field</b> <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>

                                                                    </span>
                                                                </li>
                                                                <li> <b> Skills</b> <span> 
                                                                        <?php
                                                                        $comma = " , ";
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


                                                                <!--  <?php if ($post['post_other_skill']) { ?>
                                                                                     <li><b>Other Skill</b><span><?php echo $post['post_other_skill']; ?></span>
                                                                                     </li>
                                                                <?php } else { ?>
                                                                                     <li><b>Other Skill</b><span><?php echo "-"; ?></span></li><?php } ?> -->

                                                                <li><b>Post Description</b><span><pre>
                                                                            <?php
                                                                            if ($post['post_description']) {
                                                                                echo $this->common->make_links($post['post_description']);
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></pre></span>
                                                                </li>
                                                                <li><b>Rate</b><span>
                                                                        <?php
                                                                        if ($post['post_rate']) {
                                                                            echo $post['post_rate'];
                                                                            echo "&nbsp";
                                                                            echo $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                                            echo "&nbsp";
                                                                            if ($post['post_rating_type'] == 0) {
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
                                                                    <b>Required Experience</b>
                                                                    <span>
                                                                        <?php
                                                                        if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                            if ($post['post_exp_year']) {
                                                                                echo $post['post_exp_year'];
                                                                            }
                                                                            if ($post['post_exp_month']) {
                                                                                if ($post['post_exp_year'] == '' || $post['post_exp_year'] == '0') {
                                                                                    echo 0;
                                                                                }
                                                                                echo ".";
                                                                                echo $post['post_exp_month'];
                                                                            }
                                                                            echo " Year";
                                                                            // echo $post['post_exp_year'].".".$post['post_exp_month'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?> 
                                                                    </span>
                                                                </li>
                                                                <li><b>Estimated Time</b><span> <?php
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
                                                                <ul><li class="job_all_post last_date">
                                                                        Last Date : <?php
                                                                        if ($post['post_last_date']) {
                                                                            echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?>                                                          </li>

                                                                    <a href="javascript:void(0);" onClick="login_profile_apply(<?php echo $post['post_id']; ?>)" class= "applypost  button"> Apply</a>
                        
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                        <?php
                    }
                    ?>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- MIDDLE SECTION END -->
                    </section>
                    <!-- END CONTAINER -->

                    <!-- BEGIN FOOTER -->
                    <!--PROFILE PIC MODEL START-->
                    <div class="modal fade message-box" id="bidmodal-2" role="dialog">
                        <div class="modal-dialog modal-lm">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>      
                                <div class="modal-body">
                                    <span class="mes">
                                        <div id="popup-form">

                                            <div class="fw" id="profi_loader"  style="display:none;" style="text-align:center;" ><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                            <form id ="userimage" name ="userimage" class ="clearfix" enctype="multipart/form-data" method="post">
                                                <div class="col-md-5">
                                                    <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="upload-one" >
                                                </div>

                                                <div class="col-md-7 text-center">
                                                    <div id="upload-demo-one" style="display:none;" style="width:350px"></div>
                                                </div>
                                                <input type="submit" class="upload-result-one" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                            </form>

                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--PROFILE PIC MODEL END-->
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
                    <!-- START FOOTER -->
                    <footer>
<?php echo $footer; ?>
                    </footer>
                    </body>
                   
                    <!-- END FOOTER -->

                    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
                    <!-- FIELD VALIDATION JS START -->
                    <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/project_live.js?ver=' . time()); ?>"></script>
                    <script  type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>
<?php
if (IS_REC_JS_MINIFY == '0') {
    ?>
                        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>  

                        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver=' . time()); ?>"></script>
                        <?php
                    } else {
                        ?>
                        <script type="text/javascript" defer="defer" src="<?php echo base_url('assets/js_min/croppie_bootstrap_validate.min.js?ver=' . time()); ?>"></script>
<?php } ?>

                    <script>
                                            var base_url = '<?php echo base_url(); ?>';
                                            var data1 = <?php echo json_encode($de); ?>;
                                            var data = <?php echo json_encode($demo); ?>;
                                            var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
                                            var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
                                            var id = '<?php echo $this->uri->segment(3); ?>';
                                            var return_page = '<?php echo $_GET['page']; ?>';



                                            function removepopup(id) {

                                                $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this project?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                                $('#bidmodal').modal('show');
                                            }

                                            //remove post start

                                            function remove_post(abc)
                                            {

                                                $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url() . "freelancer/remove_post" ?>',
                                                    data: 'post_id=' + abc,
                                                    success: function (data) {
                                                        $('#' + 'removeapply' + abc).html(data);
                                                        $('#' + 'removeapply' + abc).parent().removeClass();

                                                        var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                                                        if (numItems == '0') {
                                                            // var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Project Found.</h4></div>";
                                                            var nodataHtml = '<div class="art-img-nn"><div class="art_no_post_img"><img src="../img/free-no1.png"></div><div class="art_no_post_text">No Project Found</div></div>';
                                                            $('.contact-frnd-post').html(nodataHtml);

                                                        }


                                                    }
                                                });

                                            }
                    </script>

 </html>    