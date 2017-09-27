<!-- start head -->
<?php  echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/recruiter/recruiter.css'); ?>">
    
<!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->

   <!DOCTYPE html>
<html>

<body>

<!-- cover pic start -->

<!-- cover pic end -->
        
        

        
        <div id="paddingtop_fixed">
            <div class="container">
				
                <div class="row">
                    <div class="col-md-2 col-sm-2" ></div>
                    <div class="col-md-7 col-sm-7">
                        <div class="common-form">
           <div class="job-saved-box">
                <h3>Post</h3>
                <div class="contact-frnd-post">
                    <?php
                    foreach ($postdata as $post) {
                        ?>
                        <div class="job-contact-frnd ">
                            <div class="profile-job-post-detail clearfix" id="<?php echo "removepost" . $post['post_id']; ?>">
                                <!-- vishang 14-4 end -->
                                <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details col-md-12">
                                            <ul>
                                                <li class="fr">
                                                    Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('notification/rec_profile/' . $post['user_id']); ?>" title="Post Title"  style="font-size: 19px;font-weight: 600;cursor:default;">
                                                        <?php echo $post['post_name'] ?> </a>     </li>
                                                <li>   
                                                    <div class="fr lction">
                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                            <?php  
                                                            if($cityname)
                                                            { 
                                                            ?>
                                                            <p><i class="fa fa-map-marker" aria-hidden="true">

                                                             
                                                            </i> <?php echo $cityname; ?></p>
                                                            
                                                            <?php
                                                             }

                                                             else{}?> 
                                                    </div>
                                                    <a class="display_inline" title="Company Name" href="<?php echo base_url('notification/rec_profile/' . $post['user_id']); ?>"> <?php echo $post['re_comp_name']; ?> </a>
                                                </li>
                                                <li><a class="display_inline" title="Recruiter Name" href="<?php echo base_url('notification/rec_profile/' . $post['user_id']); ?>"> <?php echo $post['rec_firstname']; ?> </a></li>
                                                <!-- vishang 14-4 end -->    
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                        <ul class="clearfix">
                                            <li> <b> Skills</b> <span> 
                                                <?php
                                   $comma = ", ";
                                                                        $k = 0;
                                                                        $aud = $post['post_skill'];
                                                                        $aud_res = explode(',', $aud);
                                                                        foreach ($aud_res as $skill) {
                                                                            if ($k != 0) {
                                                                                echo $comma;
                                                                            }
                                                                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;


                                                                            echo $cache_time;
                                                                            $k++;
                                                                        }
                                                                        ?>     
                                                
                                                </span>
                                            </li>
                                            <li><b>Other Skill</b><span> <?php if($post['other_skill'] != ''){ echo $post['other_skill']; } else{ echo PROFILENA;} ?></span>
                                            </li>
                                            <li><b>Description</b><span><p><?php echo $post['post_description']; ?></p></span>
                                            </li>
                                            <li><b>Interview Process</b><span><?php echo $post['interview_process']; ?></span>
                                            </li>
                                            <!-- vishang 14-4 start -->
                                            <li>
                                                <b>Require Experience</b>
                                                <span>
                                                    <!--<p><?php if($post['min_year'] !='0' || $post['min_year'] ==''){ echo $post['min_year'].' Year '; } ?> <?php if($post['min_month'] !='0' || $post['min_month'] ==''){ echo $post['min_month']. ' Month'; } ?></p>-->  
                                                    <p><?php if($post['min_year'] !='0' || $post['min_year'] ==''){ echo $post['min_year'] .'.'; } ?> <?php if($post['min_month'] !='0' || $post['min_month'] ==''){ echo $post['min_month']. ' year'; } ?></p>  
                                                </span>
                                            </li>
                                            <li><b>Maximum Salary</b><span><?php echo $post['min_sal']; ?></span>
                                            </li>

                                            <li><b>Minimum Salary</b><span><?php echo $post['max_sal']; ?></span>
                                            </li>

                                            <li><b>No of Position</b><span><?php echo $post['post_position']; ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details col-md-12">
                                          
                                              
                                        </div>
                                    </div-->
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>


            </div>
                        </div>
                    </div>
 
				</div>
			</div>
		</div>
	<footer>

       <?php echo $footer; ?>
	</footer>


</body>

</html>
<!-- script for skill textbox automatic start (option 2)-->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  