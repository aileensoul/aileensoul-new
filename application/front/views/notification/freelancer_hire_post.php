
<?php echo $head; ?>

   <?php if(IS_NOT_CSS_MINIFY == '0'){ ?>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">

<?php }else{?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/freelancer-hire.css?ver=' . time()); ?>">

<?php }?>
<?php echo $header; ?>

<body   class="page-container-bg-solid page-boxed ">

    <section>

        <div class="user-midd-section" id="paddingtop_fixed">
                   
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
                                                            
                                                            <?php
                                                            $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                            $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                            ?>
                                                            <p>
                                                               
                                                                    <a href="<?php echo base_url('freelance-hire/employer-details/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>
                                                              
                                                                </a></p>
                                                            <p class="loca-exp">
                                                                <span class="location">
                                                                    <?php $city = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->city; ?>
                                                                    <?php $country = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->country; ?>

                                                                    <?php
                                                                    $cityname = $this->db->get_where('cities', array('city_id' => $city))->row()->city_name;
                                                                    $countryname = $this->db->get_where('countries', array('country_id' => $country))->row()->country_name;
                                                                    ?>
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
                                                                        <!--<img class="pr5" src="<?php echo base_url('assets/images/exp.png'); ?>">-->

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
                                                                            // echo $post['post_exp_year'].".".$post['post_exp_month'];
                                                                        }
                                                                        ?> 
                                                                    </span>
                                                                </span>
                                                            </p>
<!--                                                            <p class="pull-right job-top-btn">
                                                                <a href="javascript:void(0);" onClick="create_profile_apply(<?php echo $post['post_id']; ?>)" class= "applypost  btn4"> Apply</a>
                                                            </p>-->
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
<!--                                                            <p class="pull-right">
                                                                <a href="javascript:void(0);" onClick="create_profile_apply(<?php echo $post['post_id']; ?>)" class= "applypost btn4"> Apply</a>
                                                            </p>-->

                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            ?>
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
