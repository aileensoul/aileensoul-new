<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<body class="page-container-bg-solid page-boxed">
    <section>
        <div class="user-midd-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-sm-8">

                        <!-- <?php
                        //echo form_open('search/execute_search');
                        //echo form_input(array('name'=>'searchskills','placeholder'=>'search your skills')); echo "<br/> <br/>";
                        //echo form_input(array('name'=>'searchplace','placeholder'=>'search your location')); echo "<br/> <br/>";
                        //echo form_submit('search_submit','Submit'); 
                        ?>
 <br/><br/> -->
                        <div>
                            <?php
                            if ($falguni == 1) {
                                // List up all results.
                                foreach ($businessuserdata as $business_key => $business_val) {  //echo count($business_val) ; die();
                                    if (count($business_val) > 1) {
                                        foreach ($business_val as $businessval) {
                                            ?>

                                            <div>
                                                <?php
                                                $cache_time = $this->db->get_where('user', array('user_id' => $businessval['user_id']))->row()->user_image;
                                                ?>
                                                <a href="<?php echo base_url('business_profile/business_user_post/' . $businessval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE . $cache_time) ?>" style="width:50px;height:50px;"> </a>
                                            </div>

                                            <div>
                                                <a href="<?php echo base_url('business_profile/business_user_post/' . $businessval['user_id']); ?>">
                                                    <?php
                                                    echo $businessval['contact_person'];
                                                    ?></a>
                                            </div>

                                            <div>
                                                <!-- <?php
                                                //echo $artval['art_skill'];

                                                $searchskill = explode(',', $artval['art_skill']);
                                                foreach ($searchskill as $value) {

                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $value))->row()->skill;
                                                    // print_r($cache_time);die();
                                                    //foreach ($cache_time as $value) {
                                                    echo $cache_time;
                                                    echo",";
                                                }
                                                ?>  -->
                                                <?php
                                                $businesstype = $this->db->get_where('business_type', array('type_id' => $businessval['business_type']))->row()->business_type;
                                                echo $businesstype;
                                                ?>
                                            </div>

                                            <div>
                                                <!-- <?php
                                                $cache_time = $this->db->get_where('cities', array('city_id' => $artval['art_city']))->row()->city_name;
                                                echo $cache_time;
                                                ?> -->
                                                <?php
                                                $industriyal = $this->db->get_where('industry_type', array('industry_id' => $businessval['industriyal']))->row()->industry_name;

                                                echo $industriyal;
                                                ?>
                                            </div> 

                                            <div>
                                                <?php
                                                $subindustriyal = $this->db->get_where('sub_industry_type', array('sub_industry_id' => $businessval['subindustriyal']))->row()->sub_industry_name;

                                                echo $subindustriyal;
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo 'no data available';
                                    }
                                }
                            } else {

                                foreach ($businessuserdata as $business_key => $business_val) {  //echo count($business_val); die();
                                    if (count($business_val) > 0) {

                                        foreach ($business_val as $businessval) {
                                            ?>
                                            <div>
                                                <?php
                                                $cache_time = $this->db->get_where('user', array('user_id' => $businessval['user_id']))->row()->user_image;
                                                ?>
                                                <a href="<?php echo base_url('business_profile/business_user_post/' . $businessval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE . $cache_time) ?>" style="width:50px;height:50px;"> </a>
                                            </div>

                                            <div>
                                                <a href="<?php echo base_url('business_profile/business_user_post/' . $businessval['user_id']); ?>">
                                                    <?php
                                                    echo $businessval['contact_person'];
                                                    ?></a>
                                            </div>

                                            <div>
                                                <?php
                                                $businesstype = $this->db->get_where('business_type', array('type_id' => $businessval['business_type']))->row()->business_type;
                                                echo $businesstype;
                                                ?>
                                            </div>

                                            <div>
                                                <!--  <?php
                                                //echo $artval['art_skill'];

                                                $searchskill = explode(',', $artval['art_skill']);
                                                foreach ($searchskill as $value) {

                                                    $cache_time = $this->db->get_where('skill', array('skill_id' => $value))->row()->skill;
                                                    // print_r($cache_time);die();
                                                    //foreach ($cache_time as $value) {
                                                    echo $cache_time;
                                                    echo",";
                                                }
                                                ?>  -->

                                                <?php
                                                $industriyal = $this->db->get_where('industry_type', array('industry_id' => $businessval['industriyal']))->row()->industry_name;

                                                echo $industriyal;
                                                ?>
                                            </div>

                                            <div>
                                                <!-- <?php
                                                $cache_time = $this->db->get_where('cities', array('city_id' => $artval['art_city']))->row()->city_name;
                                                echo $cache_time;
                                                ?> -->
                                                <?php
                                                $subindustriyal = $this->db->get_where('sub_industry_type', array('sub_industry_id' => $businessval['subindustriyal']))->row()->sub_industry_name;

                                                echo $subindustriyal;
                                                ?>
                                            </div> 
                                            <?php
                                        }
                                    } else {
                                        echo "no data found";
                                    }
                                }echo"<br/>";
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->
