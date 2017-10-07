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
              <li class="fr date_re">
                  Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
               </li>
     
              <li class="">
              <a class="post_title" href="javascript:void(0)" title="Post Title">
               <?php 
                                              $cache_time = $this->db->get_where('job_title', array('title_id' => $post['post_name']))->row()->name;
                                              if($cache_time)
                                              {
                                                  echo  $cache_time;
                                              }
                                              else
                                              {
                                                echo $post['post_name'];
                                              }
                                           ?>  </a>     
              </li>
     
             <li>  
             <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;
            $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?> 

            <?php  
             if($cityname || $countryname)
               { 
                ?>

            <div class="fr lction">
            <p title="Location"><i class="fa fa-map-marker" aria-hidden="true"></i>

            <?php if($cityname){
            echo $cityname .', ';}?>
            <?php 
             echo $countryname; ?> 
            </p>
                  
            </div>
             <?php
             }




            ?>
           <a class="display_inline" title="<?php echo $post['re_comp_name']?>" href="javascript:void(0)">
            <?php   $out = strlen($post['re_comp_name']) > 40 ? substr($post['re_comp_name'],0,40)."..." : $post['re_comp_name'];
             echo $out;?> </a>
              </li>
              <li class="fw"><a class="display_inline" title="Recruiter Name" href="javascript:void(0)"> <?php echo ucfirst(strtolower($post['rec_firstname'])).' '.ucfirst(strtolower($post['rec_lastname'])); ?> </a></li>
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

                            if(!$post['post_skill']){

                                echo $post['other_skill'];

                            }else if(!$post['other_skill']){


                                foreach ($aud_res as $skill) {
                            
                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;

                            if($cache_time != " "){                                                                                                                                                                                                                                              
                                if ($k != 0) {
                                echo $comma;
                                 
                            }echo $cache_time;
                             $k++;  }
                            }


                            }else if($post['post_skill'] && $post['other_skill']){
                            foreach ($aud_res as $skill) {
                             if ($k != 0) {
                                echo $comma;
                            }
                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;


                            echo $cache_time;
                                $k++;
                            } echo ",". $post['other_skill']; }
                        ?>     
                                                
                                                </span>
                                            </li>
                                            <!-- <li><b>Other Skill</b><span> <?php if($post['other_skill'] != ''){ echo $post['other_skill']; } else{ echo PROFILENA;} ?></span>
                                            </li> -->
                                            <li><b>Job Description</b><span><pre><?php echo $this->common->make_links($post['post_description']); ?></pre></span>
                                            </li>
                                            <li><b>Interview Process</b><span>
                                            

                                            <?php if($post['interview_process'] != ''){?>
                                            <pre>
                                            <?php echo $this->common->make_links($post['interview_process']); ?></pre>
                                               <?php }else{ echo PROFILENA; }?> 

                                            </span>
                                            </li>

                                            <!-- vishang 14-4 start -->
                                              <li>
                                                <b>Required Experience</b>
<!--                                                 <span>
                                                   <p title="Min - Max">
                                                       <?php 


//                                                            if(($post['min_year'] !='0' || $post['max_year'] !='0') && ($post['fresher'] == 1))
//                                                            { 
// 
//
//                                                               echo $post['min_year'].' Year - '.$post['max_year'] .' Year'." , ".   "Fresher can also apply.";
//                                                                 } 
//                                                             else if(($post['min_year'] !='0' || $post['max_year'] !='0'))
//                                                                  {
//                                                               echo $post['min_year'].' Year - '.$post['max_year'] . ' Year';
//                                                                    }
//                                                                  else
//                                                                {
//                                                                  echo "Fresher";
//         
//                                                                  }

                                                                  ?> 
    
                                                                  </p>  
                                                                  </span>-->
                                                                  </li>


                                             <li><b>Salary</b><span title="Min - Max" >
                                         <?php


            $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;

          if($post['min_sal'] || $post['max_sal']) {
          echo $post['min_sal']." - ".$post['max_sal'].' '. $currency . ' '. $post['salary_type']; } 
          else { echo PROFILENA;} ?></span>
                                            </li>
                                          


                   <li><b>No of Position</b><span><?php echo $post['post_position'].' '. 'Position'; ?></span>
                 </li>

                  <li><b>Industry Type</b> <span>
                                                                  <?php
                                                                      $cache_time = $this->db->get_where('job_industry', array('industry_id' => $post['industry_type']))->row()->industry_name;
                                                                         echo $cache_time;
                                                                       ?>
                                                                         </span> 
                                                                  </li>

                          

<?php if ($post['degree_name'] != '' || $post['other_education'] != '') { ?>

    <li> <b>Education Required</b> <span> 
  

                                                                 
                             <?php
                            $comma = ", ";
                            $k = 0;
                            $edu = $post['degree_name'];
                            $edu_nm = explode(',', $edu);

                            if(!$post['degree_name']){

                                echo $post['other_education'];

                            }else if(!$post['other_education']){


                                foreach ($edu_nm as $edun) {
                             if ($k != 0) {
                                echo $comma;
                            }
                            $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;


                            echo $cache_time;
                                $k++;
                            }


                            }else if($post['degree_name'] && $post['other_education']){
                            foreach ($edu_nm as $edun) {
                             if ($k != 0) {
                                echo $comma;
                            }
                            $cache_time = $this->db->get_where('degree', array('degree_id' => $edun))->row()->degree_name;


                            echo $cache_time;
                                $k++;
                            } echo ",". $post['other_education']; }
                        ?>     
                                                
                                                </span>
                                            </li>

                                            <?php }

                                            else
                                            { ?>

                                            <li><b>Education Required</b><span>
                                            <?php
                                              echo PROFILENA; ?>
                                              </span>
                                            </li>
                                      <?php      }
                                            ?>                   <li><b>Employment Type</b><span>
                                            

                                            <?php if($post['emp_type'] != ''){?>
                                            <pre>
                                            <?php echo $this->common->make_links($post['emp_type']).'  Job'; ?></pre>
                                               <?php }else{ echo PROFILENA; }?> 

                                            </span>
                                            </li>

                                            <li><b>Company Profile</b><span>
                                            

                                            <?php if($post['re_comp_profile'] != ''){?>
                                            <pre>
                                            <?php echo $this->common->make_links($post['re_comp_profile']); ?></pre>
                                               <?php }else{ echo PROFILENA; }?> 

                                            </span>
                                            </li>
                                          

                 </ul>
                 </div>
                            
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
  