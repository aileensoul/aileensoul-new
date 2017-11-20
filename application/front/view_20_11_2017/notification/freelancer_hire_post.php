
<?php echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">
<?php echo $header; ?>

<body   class="page-container-bg-solid page-boxed ">

    <section>

        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container padding-360">    
                <!--    <div class="upload-img">
                
                <?php if ($returnpage == '') { ?>
                                        <label class="cameraButton"><i class="fa fa-camera" aria-hidden="true"></i>
                                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                                        </label>
                <?php } ?>
                    </div>-->

                <div class="profile-photo">
                    <div class="job-menu-profile">
                        <h5 > <?php echo ucwords($freelancerpostdata[0]['fullname']) . ' ' . ucwords($freelancerpostdata[0]['username']); ?></h5>
                        <div  class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                        </div> 
                    </div>
                    <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                        <div class="common-form">
                            <div class="job-saved-box">

                                <div class="contact-frnd-post">
                                    <?php
                                    if ($freelancerpostdata) {
                                        foreach ($freelancerpostdata as $post) {
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
                                                                                Created Date : <?php
                                                                                echo trim(date('d-M-Y', strtotime($post['created_date'])));
                                                                                ?>
                                                                            </li>
                                                                            <li>
                                                                                <a href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>" title="<?php echo ucwords($post['post_name']); ?>" class="display_inline post_title">
                                                                                    <?php echo ucwords($post['post_name']); ?> </a>   </li>
                                                                            <?php
                                                                            $city = $this->db->select('city')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city;
                                                                            $country = $this->db->select('country')->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country;
                                                                            $cityname = $this->db->select('city_name')->get_where('cities', array('city_id' => $city))->row()->city_name;
                                                                            $countryname = $this->db->select('country_name')->get_where('countries', array('country_id' => $country))->row()->country_name;
                                                                            ?>
                                                                            <li class="created_date"> 
                                                                                <?php if ($cityname || $countryname) { ?>  
                                                                                    <div class="fr lction">
                                                                                        <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" > </i>
                                                                                            <?php
                                                                                            if ($cityname) {
                                                                                                echo $cityname . ",";
                                                                                            }
                                                                                            ?><?php
                                                                                            if ($countryname) {
                                                                                                echo $countryname;
                                                                                            }
                                                                                            ?>
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } ?>

                                                                                <?php
                                                                                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                ?>
                                                                            </li>
                                                                            <li><a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                                </a></li>

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

                                                                        <li><b>Post Description</b><span><p>
                                                                                    <?php
                                                                                    if ($post['post_description']) {
                                                                                        echo $post['post_description'];
                                                                                    } else {
                                                                                        echo PROFILENA;
                                                                                    }
                                                                                    ?> </p></span>
                                                                        </li>
                                                                        <li><b>Rate</b><span>
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
                                                                            <b>Required Experience</b>
                                                                            <span>

                                                                                <p>
                                                                                    <?php
                                                                                    if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                                        if ($post['post_exp_year']) {
                                                                                            echo $post['post_exp_year'];
                                                                                        }
                                                                                        if ($post['post_exp_month']) {

                                                                                            if ($post['post_exp_year'] == '0') {
                                                                                                echo 0;
                                                                                            }
                                                                                            echo ".";
                                                                                            echo $post['post_exp_month'];
                                                                                        }
                                                                                        echo " Year";
                                                                                    } else {
                                                                                        echo PROFILENA;
                                                                                    }
                                                                                    ?> 

                                                                                </p>  

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
                                                                                <!--Last Date :-->
                                                                                <?php
//                                                                                if ($post['post_last_date']) {
//                                                                                    echo date('d-M-Y', strtotime($post['post_last_date']));
//                                                                                } else {
//                                                                                    echo PROFILENA;
//                                                                                }
                                                                                ?>                                                          </li>



                                                                            <!--                                                                            <li class=fr>
                                                                            <?php
                                                                            $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                            $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                            $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                            if ($freelancerapply1) {
                                                                                ?>
                                                                                                                                                                    <a href="javascript:void(0);" class="button applied">Applied</a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                
                                                                                                                                                                    <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)">Apply</a>
                                                                                                                                                                </li> 
                                                                                                                                                                <li>
            <?php
            $userid = $this->session->userdata('aileenuser');

            $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
            $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            if ($data) {
                ?>
                                                                                                                                                                            <a class="saved  button <?php echo 'savedpost' . $post['post_id']; ?>">Saved</a>
                                                                                <?php } else { ?>
                                                                                    
                                                                                                                                                                            <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button">Save</a>
                                                                                    
            <?php } ?>
                                                                            <?php } ?>
                                                                            
                                                                                                                                                        </li>                        -->
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
//                                            }
} else {
    ?>
                                        <div class="art-img-nn">
                                            <div class="art_no_post_img">
                                                <img src="<?php echo base_url('img/free-no1.png') ?>">
                                            </div>
                                            <div class="art_no_post_text">
                                                No Recommended Post Available.
                                            </div>
                                        </div>
<?php }
?> 
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="user-midd-section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </section>
    <!-- <footer> -->
<?php echo $login_footer ?>
    <?php echo $footer; ?>
    <!-- </footer> -->
</body>
</html>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
