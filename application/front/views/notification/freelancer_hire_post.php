
<?php echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">
<?php echo $header; ?>

<body   class="page-container-bg-solid page-boxed ">

    <section>
        <div class="container">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo" style="width:100%"></div>
                </div>
                <div class="col-md-12 cover-pic" style="padding-top: 25px;text-align: center;">
                    <button class="btn btn-success cancel-result" onclick="" >Cancel</button>
                    <button class="btn btn-success set-btn upload-result " onclick="myFunction()">Upload Image</button>
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
                    <div id="upload-demo-i" style="background:#e1e1e1;width:100%;padding:30px;height:1px;margin-top:30px"></div>
                </div>
            </div>
        </div>
    </div>
</div>   

<div class="container">    
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
            <div  class="add-post-button">
            </div> 
        </div>
        <div class="col-md-7 col-sm-7 all-form-content">
            <div class="common-form">
                <div class="job-saved-box">
                    <h3> Recommended Post</h3>
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
                                                                <li class="fr created_date">
                                                                    Created Date : <?php
                                                                    echo trim(date('d-M-Y', strtotime($post['created_date'])));
                                                                    ?>
                                                                </li>
                                                                <li class="dot_free">
                                                                    <a href="<?php echo base_url('freelancer-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>" title="<?php echo ucwords($post['post_name']); ?>" class="display_inline post_title">
                                                                        <?php echo ucwords($post['post_name']); ?> </a>   </li>
                                                                <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                <li class="created_date"> 
                                                                    <?php if ($cityname || $countryname) { ?>  
                                                                        <div class="fr lction">
                                                                            <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" >                                                                                                       </i>
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


                                                            <!--  <?php if ($post['other_skill']) { ?>
                                                                                         <li><b>Other Skill</b><span><?php echo $post['other_skill']; ?></span>
                                                                                         </li>
                                                            <?php } else { ?>
                                                                                         <li><b>Other Skill</b><span><?php echo "-"; ?></span></li><?php } ?> -->

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
                                                                    Last Date : <?php
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
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
        </body>
        </html>
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
