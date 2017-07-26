<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo $title; ?>
        </title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     
    </head>  
    <body>
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 profile-box profile-box-left  animated fadeInLeftBig"><div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" 
                                               title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
                                                   <?php
                                                   if ($freehiredata[0]['profile_background'] != '') {
                                                       ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_hire_bg_thumb_upload_path') . $freehiredata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"  >
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">
                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>""  tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
                                                    <?php
                                                    if ($freehiredata[0]['freelancer_hire_user_image']) {
                                                        ?>
                                                        <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freehiredata[0]['freelancer_hire_user_image']); ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
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
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" > Details</a></li>
                                                    <li><a title="Post" href="<?php echo base_url('freelancer-hire/projects'); ?>">Projects</a></li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>">Saved</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <div  class="add-post-button">
                                    <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Post</a>
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
                        <div class="col-md-7 col-sm-7 col-md-push-4 custom-right col-sm-push-4 animated fadeInUp">
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
                                            echo " In ";
                                            echo '"' . $keyword1 . '"';
                                        }
                                        ?></h3>
                                    <div class="contact-frnd-post">
                                        <div class="job-contact-frnd ">
                                            <?php
                                            if ($freelancerpostdata) {
                                                foreach ($freelancerpostdata as $row) {
                                                    ?> 
                                                    <div class="profile-job-post-detail clearfix search">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="profile-job-post-location-name-rec">
                                                                    <div style="display: inline-block; float: left;">
                                                                        <div  class="buisness-profile-pic-candidate">
                                                                            <?php
                                                                            if ($row['freelancer_post_user_image']) {
                                                                                ?>
                                                                                <a style="margin-right: 4px;" href="<?php echo base_url('freelancer-work/freelancer-details/' . $row['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>">
                                                                                    <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $row['freelancer_post_user_image']); ?>" alt="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>" > </a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <a style="margin-right: 4px;" href="<?php echo base_url('freelancer-work/freelancer-details/' . $row['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>">
                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"> </a>
                                                                                <?php
                                                                            }
                                                                            ?>

                                                                        </div></div>
                                                                    <div class="designation_rec" style="float: left;">
                                                                        <ul>
                                                                            <li>
                                                                                <a style="margin-right: 4px;" href="<?php echo base_url('freelancer-work/freelancer-details/' . $row['user_id'] . '?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"><h6>
                                                                                        <?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?></h6>
                                                                                </a>
                                                                            </li>

                                                                            <li style="display: block;" ><a href="#"> <?php
                                                                                    if ($row['designation']) {
                                                                                        echo $row['designation'];
                                                                                    } else {
                                                                                        echo "Designation";
                                                                                    }
                                                                                    ?> </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                        <div class="profile-job-post-title clearfix">
                                                            <div class="profile-job-profile-menu">
                                                                <ul class="clearfix">
                                                                    <li><b>Skills</b><span>
                                                                            <?php
                                                                            $aud = $row['freelancer_post_area'];
                                                                            $aud_res = explode(',', $aud);
                                                                            if (!$row['freelancer_post_area']) {
                                                                                echo $row['freelancer_post_otherskill'];
                                                                            } elseif (!$row['freelancer_post_otherskill']) {

                                                                                foreach ($aud_res as $skill) {

                                                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                    $skillsss[] = $cache_time;
                                                                                }
                                                                                $listskill = implode(', ', $skillsss);

                                                                                echo $listskill;
                                                                                unset($skillsss);
                                                                            } elseif ($row['freelancer_post_area'] && $row['freelancer_post_otherskill']) {

                                                                                foreach ($aud_res as $skillboth) {

                                                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $skillboth))->row()->skill;
                                                                                    $skilldddd[] = $cache_time;
                                                                                }

                                                                                $listFinal = implode(', ', $skilldddd);
                                                                                echo $listFinal . "," . $row['freelancer_post_otherskill'];
                                                                                unset($skilldddd);
                                                                            }
                                                                            ?>   </span>    

                                                                    </li>
                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $row['freelancer_post_city']))->row()->city_name; ?>
                                                                    <li><b>Location</b><span> <?php
                                                                            if ($cityname) {
                                                                                echo $cityname;
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span></li>
                                                                    <li><b>Skill Description</b> <span> <p>
                                                                                <?php
                                                                                if ($row['freelancer_post_skill_description']) {
                                                                                    echo $row['freelancer_post_skill_description'];
                                                                                } else {
                                                                                    echo PROFILENA;
                                                                                }
                                                                                ?></p></span>
                                                                    </li>

                                                                    <li><b>Avaiability</b><span>
                                                                            <?php
                                                                            if ($row['freelancer_post_work_hour']) {
                                                                                echo $row['freelancer_post_work_hour'] . "  " . "Hours per week ";
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>
                                                                    </li>
                                                                    <li><b>Rate Hourly</b> <span>
                                                                            <?php
                                                                            if ($row['freelancer_post_hourly']) {
                                                                                $currency = $this->db->get_where('currency', array('currency_id' => $row['freelancer_post_ratestate']))->row()->currency_name;

                                                                                if ($row['freelancer_post_fixed_rate'] == '1') {
                                                                                    echo $row['freelancer_post_hourly'] . "   " . $currency . " (Also work on fixed Rate)";
                                                                                } else {
                                                                                    echo $row['freelancer_post_hourly'] . "   " . $currency;
                                                                                }
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>

                                                                    </li>
                                                                    <li><b>Total Experience</b>
                                                                        <span> <?php
                                                                            if ($row['freelancer_post_exp_year'] || $row['freelancer_post_exp_month']) {
                                                                                if ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] == '') {
                                                                                    echo "1 year";
                                                                                } elseif ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] == '0 year') {
                                                                                    echo "1 year";
                                                                                } elseif ($row['freelancer_post_exp_month'] == '12 month' && $row['freelancer_post_exp_year'] != '') {
                                                                                    $year = explode(' ', $row['freelancer_post_exp_year']);
                                                                                    // echo $year;
                                                                                    $totalyear = $year[0] + 1;
                                                                                    echo $totalyear . " year";
                                                                                } elseif ($row['freelancer_post_exp_year'] != '' && $row['freelancer_post_exp_month'] == '') {
                                                                                    echo $row['freelancer_post_exp_year'];
                                                                                } elseif ($row['freelancer_post_exp_year'] != '' && $row['freelancer_post_exp_month'] == '0 month') {

                                                                                    echo $row['freelancer_post_exp_year'];
                                                                                } else {

                                                                                    echo $row['freelancer_post_exp_year'] . ' ' . $row['freelancer_post_exp_month'];
                                                                                }
                                                                            } else {
                                                                                echo PROFILENA;
                                                                            }
                                                                            ?></span>
                                                                    </li>
                                                                    <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
                                                                </ul>
                                                            </div>

                                                            <div class="profile-job-profile-button clearfix">
                                                                <div class="apply-btn fr">
                                                                    <?php
                                                                    $userid = $this->session->userdata('aileenuser');
                                                                    $contition_array = array('from_id' => $userid, 'to_id' => $row['user_id'], 'save_type' => 2, 'status' => '0');
                                                                    $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    ?>
                                                                    <?php if ($userid != $row['user_id']) { ?>
                                                                        <a href="<?php echo base_url('chat/abc/' . $row['user_id'] . '/3/4'); ?>">Message</a>

                                                                        <?php
                                                                        if (!$data) {
                                                                            ?> 
                                                                            <input type="hidden" id="<?php echo 'hideenuser' . $row['user_id']; ?>" value= "<?php echo $data[0]['save_id']; ?>">

                                                                            <a id="<?php echo $row['user_id']; ?>" onClick="savepopup(<?php echo $row['user_id']; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $row['user_id']; ?>">Save</a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a class="saved">Saved </a> 
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="text-center rio">
                                                    <h4 class="page-heading  product-listing" >No Recommended Freelancer Found.</h4>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="col-md-1">
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
        <!-- script for skill textbox automatic end (option 2)-->
        <script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script> 
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>">
        </script>
       
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($de); ?>
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_search_result.js'); ?>"></script>
    </body>
</html>
