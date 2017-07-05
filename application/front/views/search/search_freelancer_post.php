<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-profile">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="user-img pull-left">
                            <?php if($userdata[0]['user_image'] != ''){ ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="300" width="100" alt="Smiley face" />
                        <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                        <?php } ?>
                        </div>
                        <div class="user-detail pull-left">
                            <h6><?php echo $userdata[0]['first_name'] . $userdata[0]['last_name']; ?></h6>
                            <span>Designation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            if($falguni == 1)
                            {
                                //echo"tank"; die();
                                    // List up all results.
                                    foreach ($freelancerhiredata as $freelancer_key => $freelancer_val)
                                    {
                                        if(count($freelancer_val) > 0){
                                        foreach ($freelancer_val as $freelancerval)
                                        {
                                            ?>

                                        <div>
                                        <?php
                                        $cache_time  =  $this->db->get_where('freelancer_hire_reg',array('user_id' => $freelancerval['user_id']))->row()->freelancer_hire_user_image;
                                        ?>
                                       <a href="<?php echo base_url('freelancer/freelancer_apply_post/'.$freelancerval['user_id']); ?>"><img src="<?php echo base_url(USERIMAGE.$cache_time)?>" style="width:50px;height:50px;"></a>
                                        </div>

                                        <div>

                                         <a href="<?php echo base_url('freelancer/freelancer_apply_post/'.$freelancerval['user_id']); ?>">
                                        <?php 
                                        
                                        echo ucwords($freelancerval['fullname']) . ' ' . ucwords($freelancerval['username']); 
                                        ?></a>
                                        </div>

                                        <div>
                                        <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$freelancerval['req_skill']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?> 
                                         </div>

                                         <div>
                                         <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $freelancerval['city']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?>
                                         </div> 
                                         <?php     
                                        }
                                       
                                    } else{
                                        echo  'no data available';
                                    }}
                               
                            }
                            else
                            {
                                //echo "raval"; die();
                                 if(count($freelancerhiredata) > 0){
                                foreach ($freelancerhiredata as $freelancerval)
                                {

                                    ?>
                                        <div>
                                        <?php
                                        $cache_time  =  $this->db->get_where('freelancer_hire_reg',array('user_id' => $freelancerval['user_id']))->row()->freelancer_hire_user_image;
                                        ?>
                                        <a href="<?php echo base_url('freelancer/freelancer_apply_post/'.$freelancerval['user_id']); ?>"><img src="<?php echo base_url(USERIMAGE.$cache_time)?>" style="width:50px;height:50px;"></a>
                                        </div>

                                        <div>

                                        <a href="<?php echo base_url('freelancer/freelancer_apply_post/'.$freelancerval['user_id']); ?>">
                                        <?php 
                                        
                                        echo ucwords($freelancerval['fullname']) . ' ' . ucwords($freelancerval['username']); 
                                        ?></a>
                                        </div>
                                        
                                        <div>
                                        <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$freelancerval['req_skill']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?> 
                                         </div>

                                         <div>
                                         <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $freelancerval['city']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?>
                                         </div> 
                                         <?php     
                                }
                            }else{
                                echo  'no data available';
                            } }
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
    