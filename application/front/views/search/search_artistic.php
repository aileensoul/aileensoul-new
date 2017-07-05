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
                            <!-- <span>Designation</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                     <div class="col-md-3"></div>
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
                                    foreach ($artuserdata as $art_key => $art_val)
                                    {
                                        if(count($art_val) > 0){
                                        foreach ($art_val as $artval)
                                        {
                                            ?>

                                                                         <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                            <!-- <div class="profile-job-post-title-inside clearfix">
                                                <div class="profile-job-post-location-name">
                                                    <ul>
                                                    
<li>
                                        <?php
                                        $cache_time  =  $this->db->get_where('user',array('user_id' => $artval['user_id']))->row()->user_image;
                                        ?>
                                        <div class="fl">
                                       <a href="<?php echo base_url('artistic/art_user_post/'.$artval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE.$cache_time)?>" style="width:50px;height:50px;"> </a></div>
                                       <div class="fl" > 
                                      <h4>
                                        <?php 
                                        
                                        echo $artval['art_name']; 
                                        ?>
                                     </h4>
                                     </div>
                                    </li>  
                                        
                                     </ul>
                                         </div>
                                         </div> -->
                                        
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                    <ul>
                                                    
<li>
                                        <?php
                                        $cache_time  =  $this->db->get_where('user',array('user_id' => $artval['user_id']))->row()->user_image;
                                        ?>
                                        <div class="fl" style="margin-right: 20px;">
                                       <a href="<?php echo base_url('artistic/art_user_post/'.$artval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE.$cache_time)?>" style="width:55px;height:55px;"> </a></div>
                                       <div class="fl" > 
                                       <a href="<?php echo base_url('artistic/art_user_post/'.$artval['user_id']); ?>">
                                      <h4>

                                        <?php 
                                        
                                        echo $artval['art_name']; 
                                        ?>
                                     </h4>
                                     </a>
                                     </div>
                                    </li>  
                                        
                                     </ul>
                                                    </div>
                                                </div>

                                        <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                <li>
                                                <b> Skill</b>
                                      <span>  <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$artval['art_skill']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?> </span>
                                        
</li>
<li><b>Location</b>
               <span>                          <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $artval['art_city']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?></span>
                                         </li>
 
</ul>
</div>
 <!--                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                           <ul>
                                        </ul>
                                         </div>

  -->
                  <div class="profile-job-profile-button clearfix">
                    <!-- <div class="fr profile-job-profile-button ">
                                         
                                            <a href=""><button type="submit" value="Submit">Save User</button></a>
                                        </div> -->
                                        </div></div>
                                         </div>
                                         </div>
                                         <?php     
                                        }
                                       
                                    }else{
                                        echo  'no data available';
                                    } }
                               
                            }
                            else
                            {
                                //echo "raval"; die(); 
                                //echo count($artuserdata); die();
                                
                                foreach ($artuserdata as $art_key => $artval)
                                {
                                        if(count($artval) > 1){

                                    ?>
                                                                
                                        <?php
                                        $cache_time  =  $this->db->get_where('user',array('user_id' => $artval['user_id']))->row()->user_image;
                                        ?>

                                                                      
                                                                         <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title-inside clearfix">
                                                <div class="profile-job-post-location-name">
                                                    <ul>
                                                    
<li>
                                        <a href="<?php echo base_url('artistic/art_user_post/'.$artval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE.$cache_time)?>" style="width:50px;height:50px;"></a>
                                         
                                        <a href="<?php echo base_url('artistic/art_user_post/'.$artval['user_id']); ?>">
                                         <?php 
                                        
                                        echo $artval['art_name']; 
                                        ?></a>
                                  
                                         </li>  
                                     </ul>
                                         </div>
                                         </div>
                                        
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                  <!--                       <ul>   
                                     <li>  
                                   <?php 
                                        
                                        echo $artval['art_name']; 
                                        ?>
                                        </li>
                                   -->      </ul>
                                                    </div>
                                                </div>

                                        <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                <li> <b>Skill</b>
                                       <span> <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$artval['art_skill']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?> 
                                         </span>
                                         </li>
                                        </ul>
                                                    </div>
                                                </div>

                                        <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                        <li><b> Location</b>
                                        <span>
                                        <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $artval['art_city']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?></span>
                                         </li> 

                                         <?php     
                                } else{ echo  'no data available'; } }
                            }
                         ?>
                         </div>
                         </ul>
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
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->
    