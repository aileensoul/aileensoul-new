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
                    <div class="col-md-3"></div>
                    <div class="col-md-7 col-sm-8">
                    
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
                                    foreach ($recruiterdata as $recruiter_key => $recruiter_val)
                                    {
                                        if(count($recruiter_val) > 0){
                                        foreach ($recruiter_val as $recruiterval)
                                        {
                                            ?>

                                                                         <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                        
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                    <ul>
                                                    
<li>
                                        <?php
                                        $cache_time  =  $this->db->get_where('job_reg',array('user_id' => $recruiterval['user_id']))->row()->job_user_image;
                                        ?>
                                        <div class="fl">
                                       <a href="<?php echo base_url('job/job_user/'.$recruiterval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE.$recruiterval['job_user_image'])?>" style="width:50px;height:50px;"> </a>
                                           </div>
                                           <div class="fl" style="padding-left: 20px;" >
                                          <a href="<?php echo base_url('job/job_user/'.$recruiterval['user_id']); ?>"> <h5> <?php 
                                        
                                        echo ucwords($recruiterval['fname']) . ' ' . ucwords($recruiterval['lname']); 
                                        ?></h5></a>
                                        </div>
                                   
    </li>
    </ul>
    </div>
    </div>

                                           <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                     <li> <b> Skill</b> <span> <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$recruiterval['ApplyFor']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?>
                                         </span> 
                                         </li>
                                          <li>
                                            <b> Location </b>
                                            <span>

                                                                                  <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $recruiterval['city_id']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?>
                                                                    </span>  </li>
                                         </ul>



                                         </div>
 
                                         <?php
    $userid  = $this->session->userdata('aileenuser');
        $contition_array = array('from_id' => $userid,'to_id'=> $recruiterval['user_id']);
        $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       

if($data[0]['status'] != 0 || $data[0]['status'] == '')
 {
?> 

                                                                                         <div class="profile-job-profile-button clearfix">
                                                           <div class="fr profile-job-profile-button ">
                                         
                                            <a href="<?php echo base_url('recruiter/save_search_user/'  .$recruiterval['user_id'].'/'. $data[0]['save_id'] ); ?>"><button type="submit" value="Submit">Save User</button></a>
                                          

                                          </div>
    </div>
    </div>
    </div>
    </div>
                                         <?php 
                                          } 
                                         else{
                                        ?>

                                          <a href=" "><button>Saved User</button></a> <br>
                                         <?php 
                                        }    
                                        }
                                       
                                    } else{ echo  'no data available'; }}
                               
                            }
                            else
                            {
                                //echo "tank"; die();
                                //echo "falguni"; die();
                                foreach ($recruiterdata as $recruiterval)
                                {

                                    if(count($recruiterval) > 0){
                                    ?>
                                        <div>
                                        <?php
                                        $cache_time  =  $this->db->get_where('job_reg',array('user_id' => $recruiterval['user_id']))->row()->job_user_image;
                                        ?>
                                      
                                                                         <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                        
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                    <ul>
                                                    
                                            <li>
                                             <div class="fl">
                                       
                                        <a href="<?php echo base_url('job/job_user/'.$recruiterval['user_id']); ?>"> <img src="<?php echo base_url(USERIMAGE.$recruiterval['job_user_image'])?>" style="width:50px;height:50px;"> </a>
                                        </div>

                                        <div class="fl">
                                        <a href="<?php echo base_url('job/job_user/'.$recruiterval['user_id']); ?>">
                                        <?php 
                                        echo ucwords($recruiterval['fname']) . ' ' . ucwords($recruiterval['lname']); 
                                        ?></a>
                                        </div>
                                        
                                        </li>
    </ul>
    </div>
    </div>

                                           <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                     <li>   <?php
                                        //echo $artval['art_skill'];

                                        $searchskill = explode(',',$recruiterval['ApplyFor']);
                                        foreach ($searchskill as $value) {
                                         
                                        $cache_time  =  $this->db->get_where('skill',array('skill_id' => $value))->row()->skill; 
                                       // print_r($cache_time);die();
                                        //foreach ($cache_time as $value) {
                                         echo $cache_time; echo","; 
                                         } 
                                         ?> 
                                          </li>
                                          <li>
    

                                         <div>
                                        <?php
                                        $cache_time  =  $this->db->get_where('cities',array('city_id' => $recruiterval['city_id']))->row()->city_name;  
                                        echo $cache_time; 
                                        ?>
                                         </div> 
                                         </li>
                                         </ul>
                                         </div>
<?php
    $userid  = $this->session->userdata('aileenuser');
        $contition_array = array('from_id' => $userid,'to_id'=> $recruiterval['user_id']);
        $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
       

if($data[0]['status'] != 0 || $data[0]['status'] == '')
 {
?>                                                   <div class="profile-job-profile-button clearfix">
                                                           <div class="fr profile-job-profile-button ">
                                          <a href="<?php echo base_url('recruiter/save_search_user/'  . $recruiterval['user_id'].'/'. $data[0]['save_id'] ); ?>"><button type="submit" value="Submit">Save User</button></a> </div>
                                          </div>
                                          </div>
                                         <?php 
                                          } 
                                         else{
                                        ?>

                                          <a href=""><button>Saved User</button></a> <br>
                                         <?php
                                         }     
                                }else{  echo  'no data available'; }
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
    