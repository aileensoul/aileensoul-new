
<?php echo $head; ?>

<?php if (IS_NOT_CSS_MINIFY == '0') { ?>  
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">

<?php } else { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/freelancer-hire.css?ver=' . time()); ?>">

<?php } ?>
<?php echo $header; ?>

<body   class="page-container-bg-solid page-boxed ">

    <section>

        <div class="user-midd-section" id="paddingtop_fixed">
<<<<<<< HEAD
                <div class="container padding-360">
                    <div class="row4">
                           <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelance-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" 
                                               title="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>">

                                                <?php if ($freehiredata['profile_background'] != '') { ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo FREE_HIRE_BG_THUMB_UPLOAD_URL . $freehiredata['profile_background']; ?>" class="bgImage" alt="<?php echo $freehiredata['fullname']. " ".$freehiredata['username'];  ?>" >
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

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelance-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>">
                                                    <?php
                                                    $fname = $freehiredata['fullname'];
                                                    $lname = $freehiredata['username'];
                                                    $sub_fname = substr($fname, 0, 1);
                                                    $sub_lname = substr($lname, 0, 1);

                                                    if ($freehiredata['freelancer_hire_user_image']) {
                                                        if (IMAGEPATHFROM == 'upload') {
                                                            if (!file_exists($this->config->item('free_hire_profile_main_upload_path') . $freehiredata['freelancer_hire_user_image'])) {
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                                </div>
                                                            <?php } else {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freehiredata['freelancer_hire_user_image']; ?>" alt="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>" > 
                                                                <?php
                                                            }
                                                        } else {
                                                            $filename = $this->config->item('free_hire_profile_main_upload_path') . $freehiredata['freelancer_hire_user_image'];
                                                            $s3 = new S3(awsAccessKey, awsSecretKey);
                                                            $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                            if ($info) {
                                                                ?>
                                                                <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freehiredata['freelancer_hire_user_image']; ?>" alt="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>" >
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
                                                    <a href="<?php echo base_url('freelance-hire/employer-details'); ?>" title="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>"> <?php echo ucwords($freehiredata['fullname']) . ' ' . ucwords($freehiredata['username']); ?></a>  
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => '1'))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a href="<?php echo base_url('freelance-hire/employer-details'); ?>" title="<?php echo $freehiredata['fullname'] . " " . $freehiredata['username']; ?>"><?php
                                                        if ($freehiredata['designation']) {
                                                            echo $freehiredata['designation'];
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelance-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                    <li><a title="Projects" href="<?php echo base_url('freelance-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelance-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                

     <?php echo $left_footer; ?>

            

                        </div>
                          <div class="inner-right-part">
                                        <div class="page-title">
                                            <h3>
                                                <?php
                                                echo $freelancerpostdata[0]['post_name'];
                                                ?>
                                            </h3>
                                        </div>
                                        <?php
                                        if (count($freelancerpostdata) > 0) {
                                            foreach ($freelancerpostdata as $post) {
                                                ?>
                                                <div class="all-job-box job-detail">
                                                    <div class="all-job-top">
                                                        <div class="job-top-detail">
                                                            <h5><a href="javascript:void(0);"><?php echo $post['post_name']; ?></a></h5>
                                                            
=======

<div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <?php
                                            $hire_user = $this->common->select_data_by_id('freelancer_hire_reg', 'user_id', $this->session->userdata('aileenuser'), $data = 'user_id', $join_str = array());
                                            $post_user = $this->common->select_data_by_id('freelancer_post', 'post_id', $postid, $data = 'user_id', $join_str = array());
                                            ?>
                                                <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelance-hire/employer-details'); ?>"  aria-hidden="true" rel="noopener">
                                                    <?php } else if ($hire_user) { ?>
                                                    <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="javascript:void(0);" aria-hidden="true" rel="noopener">
                                                        <?php
                                                    } else {
                                                        if (is_numeric($recliveid)) {
                                                            $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                        } else {
                                                            $slug = $recliveid;
                                                        }
                                                        ?>
                                                        <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>"  tabindex="-1" 
                                                           aria-hidden="true" rel="noopener">
                                                            <?php } ?>
                                                        <div class="bg-images no-cover-upload"> 
>>>>>>> 58977c3a3e4e7d4a6a2bab1f98dcb9efb73ee77b
                                                            <?php
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
                                                                <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelance-hire/employer-details'); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                    <?php } else if ($hire_user) { ?>
                                                                    <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="javascript:void(0);"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                        <?php
                                                                    } else {
                                                                        if (is_numeric($recliveid)) {
                                                                            $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                                        } else {
                                                                            $slug = $recliveid;
                                                                        }
                                                                        ?>
                                                                        <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>"  title="<?php echo $freelancr_user_data[0]['fullname'] . ' ' . $freelancr_user_data[0]['username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                                            <?php
                                                                        }
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
                                                                            <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                <a href="<?php echo base_url('freelance-hire/employer-details'); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                                            <?php } else if ($hire_user) { ?>
                                                                                <a title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
                                                                                <?php
                                                                            } else {
                                                                                if (is_numeric($recliveid)) {
                                                                                    $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                                                } else {
                                                                                    $slug = $recliveid;
                                                                                }
                                                                                ?>
                                                                                <a href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>"  title="<?php echo ucfirst(strtolower($freelancr_user_data['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data['username'])); ?>">   <?php echo ucfirst(strtolower($freelancr_user_data[0]['fullname'])) . ' ' . ucfirst(strtolower($freelancr_user_data[0]['username'])); ?></a>
<?php } ?>
                                                                        </span>

                                                                            <?php //$category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;        ?>
                                                                        <div class="profile-boxProfile-name">
                                                                                <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                <a href="<?php echo base_url('freelance-hire/employer-details'); ?>"  title="<?php echo $freelancr_user_data[0]['designation']; ?>">
                                                                                    <?php } else if ($hire_user) { ?>
                                                                                    <a class="eventnone" title="<?php echo $freelancr_user_data[0]['designation']; ?>">
                                                                                        <?php
                                                                                    } else {
                                                                                        if (is_numeric($recliveid)) {
                                                                                            $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                                                        } else {
                                                                                            $slug = $recliveid;
                                                                                        }
                                                                                        ?>
                                                                                        <a href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>"  title="<?php echo $freelancr_user_data[0]['designation']; ?>">
                                                                                        <?php } ?>
                                                                                        <?php
                                                                                        if (ucfirst(strtolower($freelancr_user_data[0]['designation']))) {
                                                                                            echo $freelancr_user_data[0]['designation'];
                                                                                        } else {
                                                                                            echo "Designation";
                                                                                        }
                                                                                        ?></a>
                                                                                    </div>
                                                                                    <ul class=" left_box_menubar">

                                                                                        <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelance-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                        <?php } else if ($hire_user) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="javascript:void(0);" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                            <?php
                                                                                        } else {
                                                                                            if (is_numeric($recliveid)) {
                                                                                                $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                                                            } else {
                                                                                                $slug = $recliveid;
                                                                                            }
                                                                                            ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                                                        <?php } ?>
                                                                                        <?php if ($this->session->userdata('aileenuser') == $post_user[0]['user_id']) { ?>
                                                                                            <li><a title="Projects" href="<?php echo base_url('freelance-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                        <?php } else if ($hire_user) { ?>
                                                                                            <li><a title="Projects" href="javascript:void(0);"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                            <?php
                                                                                        } else {
                                                                                            if (is_numeric($recliveid)) {
                                                                                                $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $recliveid))->row()->freelancer_hire_slug;
                                                                                            } else {
                                                                                                $slug = $recliveid;
                                                                                            }
                                                                                            ?>
                                                                                            <li><a title="Projects" href="<?php echo base_url('freelance-hire/projects/' . $slug); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                                                        <?php } ?>
                                                                                        <?php if ($this->session->userdata('aileenuser') == $recliveid) { ?>
                                                                                            <li <?php if (($this->uri->segment(1) == 'freelance-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelance-hire/freelancer-save'); ?>">Saved</a></li>
<?php } ?>

                                                                                    </ul>

                                                                                    </div>

                                                                                    </div>
                                                                                    </div>



            <?php
            if (count($freelancerpostdata) > 0) {
                foreach ($freelancerpostdata as $post) {
                    ?>
                    <div class="inner-right-part">
                        <div class="page-title">
                            <h3>
                                <?php
                                echo $freelancerpostdata[0]['post_name'];
                                ?>
                            </h3>
                        </div>
                        <div class="all-job-box job-detail">
                            <div class="all-job-top">
                                <div class="job-top-detail">
                                    <h5><a href="javascript:void(0);"><?php echo $post['post_name']; ?></a></h5>

                                    <?php
                                    $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                    $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                    $slug = $this->db->select('freelancer_hire_slug')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->freelancer_hire_slug;
                                    ?>
                                    <p>

                                        <a href="<?php echo base_url('freelance-hire/employer-details/' . $slug); ?>"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>

                                        </a></p>
                                    <p class="loca-exp">
                                        <span class="location">
                                            <?php $city = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city; ?>
                                            <?php $country = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country; ?>

                                            <?php
                                            $cityname = $this->db->get_where('cities', array('city_id' => $city))->row()->city_name;
                                            $countryname = $this->db->get_where('countries', array('country_id' => $country))->row()->country_name;
                                            ?>
<<<<<<< HEAD
                                            <div class="art-img-nn">
                                                <div class="art_no_post_img">
                                                    <img src="' . base_url() . 'img/job-no.png">

                                                </div>
                                                <div class="art_no_post_text">
                                                    No  Post Available.
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
            </div>
        </div>
=======
                                            <span>

                                                <?php
                                                if ($cityname || $countryname) {
                                                    if ($cityname) {
                                                        echo $cityname . ', ';
                                                    }
                                                    echo $countryname . " (Location)";
                                                }
                                                ?>
                                            </span>
                                        </span>
                                    </p>
                                    <p class="loca-exp">
                                        <span class="exp">
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
                                                    echo " Year" . " (Required Experience)";
                                                }
                                                ?> 
                                            </span>
                                        </span>
                                    </p>

                                </div>
                            </div>
                            <div class="detail-discription">
                                <div class="all-job-middle">
                                    <ul>
                                        <li>
                                            <b>Project description</b>
                                            <span>
                                                <pre><?php echo $this->common->make_links($post['post_description']); ?></pre>
                                            </span>
                                        </li>
                                        <li>
                                            <b>Key skill</b>
                                            <span>  <?php
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
                                        <li><b>Field of Requirements</b>
                                            <span> 
                                                <?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>
                                            </span>
                                        </li>
                                        <li><b>Rate</b>
                                            <span>  <?php
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
                                                ?>
                                            </span>
                                        </li>

                                        <li><b>Estimated Time</b>
                                            <span>
                                                <?php
                                                if ($post['post_est_time']) {
                                                    echo $post['post_est_time'];
                                                } else {
                                                    echo PROFILENA;
                                                }
                                                ?>   
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                                <div class="all-job-bottom">
                                    <span class="job-post-date"><b>Posted on:  </b><?php echo date('d-M-Y', strtotime($post['created_date'])); ?></span>


                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="inner-right-part cust-border">
                    <div class="art-img-nn">
                        <div class="art_no_post_img">
                            <img src=" <?php echo base_url('assets/img/job-no.png'); ?>">
                        </div>
                        <div class="art_no_post_text">
                            No  Project Available.
                        </div>
                    </div>
                </div>

            <?php } ?>


>>>>>>> 58977c3a3e4e7d4a6a2bab1f98dcb9efb73ee77b
        </div>
    </section>
    <?php echo $login_footer ?>
    <?php echo $footer; ?>
</body>
</html>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
