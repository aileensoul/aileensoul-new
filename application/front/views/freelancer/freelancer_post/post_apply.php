<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
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
                                                   if ($freepostdata[0]['profile_background'] != '') {
                                                       ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_post_bg_thumb_upload_path') . $freepostdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>" >
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
                                                   href="<?php echo base_url('freelancer/freelancer_post_profile/' . $freelancerdata[0]['user_id']); ?>" title="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                       <?php
                                                       if ($freelancerdata[0]['freelancer_post_user_image']) {
                                                           ?>
                                                        <div class="">
                                                            <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $freelancerdata[0]['freelancer_post_user_image']); ?>" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                        </div>
                                                        <?php
                                                    } else {
                                                        $fname = $freelancerdata[0]['freelancer_post_fullname'];
                                                        $lname = $freelancerdata[0]['freelancer_post_username'];
                                                        $sub_fname = substr($fname, 0, 1);
                                                        $sub_lname = substr($lname, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
                                                            <?php echo ucfirst(strtolower($sub_fname)) . "  " . ucfirst(strtolower($sub_lname)); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>"><?php echo ucwords($userdata[0]['first_name']) . ' ' . ucwords($userdata[0]['last_name']); ?></a>
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
                            </div>
                        </div>
                        <!-- cover pic end -->
                        <div class="col-md-7 col-sm-7 animated fadeInUp col-md-push-4 col-sm-push-4 custom-right">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3><?php echo $this->lang->line("recommended_project"); ?></h3>
                                    <div class="contact-frnd-post">
                                        <?php
                                        if ($postdetail) {
                                            foreach ($postdetail as $post_key => $post_value) {
                                                foreach ($post_value as $post) {
                                                    ?>
                                                    <div class="job-post-detail clearfix">
                                                        <div class="job-contact-frnd ">
                                                            <div class="profile-job-post-detail clearfix margin_btm"  id="<?php echo "removeapply" . $post['post_id']; ?>">
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul>
                                                                                    <li class="fr">
                                                                                        <?php echo $this->lang->line("created_date"); ?> : <?php echo trim(date('d-M-Y', strtotime($post['created_date']))); ?>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>" title="<?php echo ucwords($post['post_name']); ?>" class="display_inline post_title">
                                                                                            <?php echo ucwords($post['post_name']); ?> </a>   </li>
                                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                                    <li> 
                                                                                        <?php if ($cityname || $countryname) { ?>  
                                                                                            <div class="fr lction">
                                                                                                <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" >
                                                                                                        <?php
                                                                                                        if ($cityname) {
                                                                                                            echo $cityname . ",";
                                                                                                        }
                                                                                                        ?><?php
                                                                                                        if ($countryname) {
                                                                                                            echo $countryname;
                                                                                                        }
                                                                                                        ?></i></a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <?php
                                                                                        $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                        $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                        ?>
                                                                                    </li>
                                                                                    <li><a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="profile-job-profile-menu">
                                                                            <ul class="clearfix">
                                                                                <li> <b> <?php echo $this->lang->line("field"); ?></b> 
                                                                                    <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>
                                                                                    </span>
                                                                                </li>
                                                                                <li> <b> <?php echo $this->lang->line("skill"); ?></b> <span> 
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
                                                                                <li><b><?php echo $this->lang->line("project_description"); ?></b><span><p>
                                                                                            <?php
                                                                                            if ($post['post_description']) {
                                                                                                echo $post['post_description'];
                                                                                            } else {
                                                                                                echo PROFILENA;
                                                                                            }
                                                                                            ?> </p></span>
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
                                                                                        <p>
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
                                                                                        </p>  
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
                                                                                <ul><li class="job_all_post last_date">
                                                                                        <?php echo $this->lang->line("last_date"); ?> : <?php
                                                                                        if ($post['post_last_date']) {
                                                                                            echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?>                                                          </li>
                                                                                    <li class=fr>
                                                                                        <?php
                                                                                        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                                        $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                        if ($freelancerapply1) {
                                                                                            ?>
                                                                                            <a href="javascript:void(0);" class="button applied"><?php echo $this->lang->line("applied"); ?></a>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)"><?php echo $this->lang->line("apply"); ?></a>
                                                                                        </li> 
                                                                                        <li>
                                                                                            <?php
                                                                                            $userid = $this->session->userdata('aileenuser');
                                                                                            $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                                                                            $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                            if ($data) {
                                                                                                ?>
                                                                                                <a class="saved  button <?php echo 'savedpost' . $post['post_id']; ?>"><?php echo $this->lang->line("saved"); ?></a>
                                                                                            <?php } else { ?>

                                                                                                <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button"><?php echo $this->lang->line("save"); ?></a>
                                                                                            <?php } ?>
                                                                                        <?php } ?>

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
                                            }
                                        } else {
                                            ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing" ><?php echo $this->lang->line("no_recommen_project"); ?></h4>
                                            </div>
                                        <?php }
                                        ?> 
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
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>">
        </script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var data1 = <?php echo json_encode($city_data); ?>;
            var data = <?php echo json_encode($demo); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-apply/post_apply.js'); ?>"></script>
    </body>               
</html>