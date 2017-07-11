<!--start head -->
<?php echo $head; ?>
<!--post save success pop up style strat -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<!--link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /-->
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<!--post save success pop up style end -->
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<?php echo $recruiter_header2_border; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body >
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row row4">
                    <div class="col-md-4 profile-box profile-box-left"><div class="">
                           
                            <div class="full-box-module">    
                                <div class="profile-boxProfileCard  module">
                 <div class="profile-boxProfileCard-cover">     <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('recruiter/rec_profile'); ?>" tabindex="-1" 
                 aria-hidden="true" rel="noopener">
               
                <?php
                 $image_ori = $recruiterdata1[0]['profile_background'];
                if ($image_ori) {
                        //echo "hii"; die();
                                                                                              ?>
                   <!-- box image start -->
               <img src="<?php echo base_url($this->config->item('rec_bg_thumb_upload_path') . $recruiterdata1[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?>">
                    <!-- box image end -->
                         <?php
                   } else {
                             ?>
                  <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?>" >
                                <?php
                             }
                                 ?>
                                        </a>
                                    </div>
                                    <div class="profile-boxProfileCard-content clearfix">
                                        <div class="buisness-profile-txext col-md-4">
                                      <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('recruiter/rec_profile/' . $recruiterdata1[0]['user_id']); ?>" title="<?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                <?php
//echo "<pre>"; print_r($recruiterdata1); die();
                                                if ($recruiterdata1[0]['recruiter_user_image'] != '') {
                                                    // echo "hii"; die();
                                                    ?>
                       <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recruiterdata1[0]['recruiter_user_image']); ?>" alt="<?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?>" >
                                   <?php
                              } else {
                           ?>
                       <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?>">
                            <?php
                                   }
                             ?>
                                            </a>
                                        </div>
                                        <div class="profile-box-user  profile-text-bui-user  fr col-md-9">
                                            <span class="profile-company-name ">
                                                <a href="<?php echo site_url('recruiter/rec_profile'); ?>" title="<?php echo $recruiterdata1['rec_firstname'] . ' ' . $recruiterdata1['rec_lastname']; ?>">   <?php echo $recruiterdata1[0]['rec_firstname'] . ' ' . $recruiterdata1[0]['rec_lastname']; ?></a>
                                            </span>
                                            <div class="profile-boxProfile-name">
                                                <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata1[0]['user_id']); ?>" title="<?php echo ucwords($recruiterdata1[0]['designation']); ?>">
                                                    <?php
                                                    if (ucwords($recruiterdata1[0]['designation'])) {
                                                        echo ucwords($recruiterdata1[0]['designation']);
                                                    } else {
                                                        echo "Designation";
                                                    }
                                                    ?></a></div>
                                        </div>
                                        <div class="profile-box-rec-menu  col-md-12">
                                            <ul class="">
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>"> Details</a>
                                                </li>                                
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                                                </li>
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div  class="add-post-button">
                            <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Post</a>
                        </div>
                        </div>
                      
                    </div>
                    <!--- search end -->
                    <div class="col-md-7 col-sm-7 all-form-content fixed_left">
                        <div class="common-form ">
                            <div class="job-saved-box">
                                <h3>Recommended Candidate</h3>
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <!-- khyati start -->
                                        <?php
                                       // echo "<pre>"; print_r($candidatejob);die();
                                        if ($candidatejob) {
                                            foreach ($candidatejob as $canrow) {

                                              foreach($canrow as $row){
                                                ?>
                                                <div class="profile-job-post-detail clearfix">
      <div class="profile-job-post-title-inside clearfix">
          <div class="profile-job-profile-button clearfix">
                                                            <!-- pop up box start-->
               <div id="popup1" class="overlay">
                 <div class="popup">
                  <div class="pop_content">
                     Your User is Successfully Saved.
                  <p class="okk"><a class="okbtn" href="#">Ok</a></p>
                   </div>
                    </div>
                      </div>
                                                            <!-- pop up box end-->
     <div class="profile-job-post-location-name-rec">
          <div style="display: inline-block; float: left;">
             <div  class="buisness-profile-pic-candidate">
               <?php
                if ($row['job_user_image']) {
               ?>
           <a href="<?php echo base_url('job/job_printpreview/' . $row['iduser'].'?page=recruiter'); ?>" title=" <?php echo $row['fname'] . ' ' . $row['lname']; ?>"> 
           <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $row['job_user_image']); ?>" alt="<?php echo $row[0]['fname'] . ' ' . $row[0]['lname']; ?>">
            </a>
             <?php
            } else {
              ?>
              <a href="<?php echo base_url('job/job_printpreview/' . $row['iduser'].'?page=recruiter'); ?>" title=" <?php echo $row['fname'] . ' ' . $row['lname']; ?>"> 
           <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $row[0]['fname'] . ' ' . $row[0]['lname']; ?>"> </a>
             <?php
                }
               ?>
           </div>
       </div>
   
       <div class="designation_rec fl">
          <ul>
       <li>
      <a  class="post_name" href="<?php echo base_url('job/job_printpreview/' . $row['iduser'].'?page=recruiter'); ?>" title=" <?php echo $row['fname'] . ' ' . $row['lname']; ?>">
       <?php echo ucwords($row['fname']) . ' ' . ucwords($row['lname']); ?></a>
      </li>
      
      <li style="display: block;">
        <a  class="post_designation" href="<?php echo base_url('job/job_printpreview/' . $row['iduser'].'?page=recruiter'); ?>" title="<?php echo $row['designation']; ?>">
            <?php
              if ($row['designation']) {
             ?>
            <?php echo $row['designation']; ?>
               <?php
           } else {
                  ?>
            <?php echo "Designation"; ?>
                <?php
               }
                   ?> 
           </a>
       </li>
    </ul>
      </div>
     </div>
       </div>
         </div>
    
    <?php $contition_array = array('user_id' => $row['iduser'], 'type' => 3, 'status' => 1);
        unset($other_skill);
        //echo "<pre>"; print_r($other_skill);
            $other_skill = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($other_skill);
             ?>
         <div class="profile-job-post-title clearfix">
             <div class="profile-job-profile-menu">
                <ul>
                     
                <li><b>Skills</b>
                       <span>
                      <?php
                        
                         $aud = $row['keyskill'];
                         $aud_res = explode(',', $aud);
                         

                         if(!$row['keyskill']){
                          echo "otherskill";

                          foreach ($other_skill as $sk) {
                         $sk2[] = $sk['skill']; 
                         
                          }
                       $otherfinal = implode(', ', $sk2);
                       echo $otherfinal;
                       
                        unset($sk2);

                         }else if(!$other_skill){
                          //echo "skill";


                          foreach ($aud_res as $skill) {

                  $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $skillsss[] = $cache_time;
                    }

                    $listskill = implode(', ', $skillsss);

                    echo $listskill;
                     unset($skillsss);
                         }else if($row['keyskill'] && $other_skill){

                         // echo "helll000";
                          foreach ($aud_res as $skillboth) {

                  $cache_time = $this->db->get_where('skill', array('skill_id' => $skillboth))->row()->skill;
                        $skilldddd[] = $cache_time;
                    }
                    $listFinal = implode(', ', $skilldddd);
                   // echo $listFinal;

                                  foreach ($other_skill as $osil) {
                         $skill2[] = $osil['skill']; 
                         
                          }
                       $listFinalother = implode(', ', $skill2);
                      // echo $listFinalother;


                    echo $listFinal .',' . $listFinalother; 
                    //$listFinal==null;
                   // $listFinalother==null;
                     unset($skill2);
                     unset($skilldddd);
                  }
                 // var_dump($otherskill);
                 //$otherskill=null;
                                   ?>       
                    </span>
                                                                    </li>
                                                                    
                                                               <!--  <?php
                                                                if ($row['other_skill']) {
                                                                    ?>
                                                                    <li><b>Other Skill</b><span>
                                                                            <?php echo $row['other_skill']; ?>
                                                                        </span></li>
                                                                    <?php
                                                                }
                

                                                                ?> -->

  <?php 
$contition_array =array('user_id' => $row['iduser'], 'experience' => 'Experience', 'status' => '1');

        //echo "<pre>"; print_r($other_skill);
            $experiance = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            

            $total_work_year=0;
            $total_work_month=0;
            foreach ($experiance as $work1) {

            $total_work_year+=$work1['experience_year'];
            $total_work_month+=$work1['experience_month'];
            }
             ?>
          <li> <b> Total Experience</b>
              <span>
                   <?php
              if($total_work_month == '12 month' && $total_work_year =='0 year'){
                echo "1 year";
            }
            elseif($total_work_year !='0 year' && $total_work_month == '12 month'){
                 $month = explode(' ', $total_work_year);
                                                $year=$month[0];
                                                $years=$year + 1;
                                                echo $years." Years";
            }
            else{
                echo $total_work_year; echo "&nbsp"; echo "Year";
            echo "&nbsp";
            echo $total_work_month; echo "&nbsp"; echo "Month";
            }
                                                                        ?>
                                                                    </span>
                                                                </li>
                                                                <?php
                                                                $countryname = $this->db->get_where('countries', array('country_id' => $row['country_id']))->row()->country_name;
                                                                $cityname = $this->db->get_where('cities', array('city_id' => $row['city_id']))->row()->city_name;
                                                                ?>
                                                                <li><b>Location</b> <span>
                                                                          <?php  if($cityname){echo $cityname;echo ', ';}
                                                                        echo $countryname;
                                                                         ?> 
                                                                    </span></li>
            <?php if($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']){ ?>
            <li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>
             <?php }
              elseif($row['board_primary'] && $row['board_secondary'] && $row['board_higher_secondary']){
                ?>
                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $row['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $row['percentage_higher_secondary'];?>
                </span>
                </li>
                <?php }
              elseif($row['board_primary'] && $row['board_secondary']){?>

              <li><b>Board of Secondary</b>
                <span>
                  <?php echo $row['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $row['percentage_secondary'];?>
                </span>
                </li>
              <?php } else if($row['board_primary'] && $row['board_higher_secondary']){
             ?>
                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $row['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $row['percentage_higher_secondary'];?>
                </span>
                </li>

             <?php } elseif($row['board_secondary'] && $row['board_higher_secondary']){?>
                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $row['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $row['percentage_higher_secondary'];?>
                </span>
                </li>

             <?php } elseif($row['board_primary'] && $row['degree']){?>
             <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>


              <?php } elseif($row['board_secondary'] && $row['degree']){ ?>
              <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                   $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                              if ($cache_time) {
                                  echo $cache_time;
                                          } else {
                                              echo PROFILENA;
                                              }
                                                                        
                   ?>
                 </span>
              </li>


               <?php } elseif($row['board_higher_secondary'] && $row['degree']){ ?>


<li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>


                 <?php }elseif($row['board_secondary'] && $row['board_higher_secondary'] && $row['degree']){?>

<li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                     $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                                    if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>

                 <?php } elseif($row['degree']){?>

<li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $row['degree']))->row()->degree_name;
                            if ($cache_time) {
                                             echo $cache_time;
                                             } else {
                                                 echo PROFILENA;
                                                                        }
                                                                      ?>

               </span>
               </li>
               <li><b>Stream</b>
                 <span>
                   <?php

                 $cache_time = $this->db->get_where('stream', array('stream_id' => $row['stream']))->row()->stream_name;
                              if ($cache_time) {
                                             echo $cache_time;
                                            } else {
                                             echo PROFILENA;
                                               }
                                                                        
                   ?>
                 </span>
              </li>

                  <?php }elseif($row['board_higher_secondary']){?>

                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $row['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $row['percentage_higher_secondary'];?>
                </span>
                </li>


                  <?php }elseif($row['board_secondary']){?> 

  <li><b>Board of Secondary</b>
                <span>
                  <?php echo $row['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $row['percentage_secondary'];?>
                </span>
                </li>

                  <?php } elseif($row['board_primary']){?>

 <li><b>Board of Primary</b>
                <span>
                  <?php echo $row['board_primary'];?>
                </span>
                </li>
                <li><b>Percentage of Primary</b>
                <span>
                  <?php echo $row['percentage_primary'];?>
                </span>
                </li>

                  <?php }else{?> <li> No Education </li> <?php }?>
                                                                
                                                                <li><b>E-mail</b><span>
                                                                        <?php
                                                                        if ($row['email']) {
                                                                            echo $row['email'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                                <li><b>Mobile Number</b><span>
                                                                        <?php
                                                                        if ($row['phnno']) {
                                                                            echo $row['phnno'];
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="profile-job-profile-button clearfix">
       <div class="apply-btn fr">
   <?php
 $userid = $this->session->userdata('aileenuser');
$contition_array = array('from_id' => $userid, 'to_id' => $row['iduser'], 'save_type' => 1, 'status' => '0');
$data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                
 if($userid != $row['iduser']){       
 if (!$data) {
     ?> 
                     
    <a href="<?php echo base_url('chat/abc/' . $row['iduser']); ?>">Message</a> 

<!--                     <a href="#">Invite</a>-->

             <input type="hidden" id="<?php echo 'hideenuser' . $row['iduser']; ?>" value= "<?php echo $data[0]['save_id']; ?>">
               
              <a id="<?php echo $row['iduser']; ?>" onClick="savepopup(<?php echo $row['iduser']; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $row['iduser']; ?>">Save</a>

                <?php
            } else {
                 ?>
    <a href="<?php echo base_url('chat/abc/' . $row['iduser']); ?>">Message</a> 

    <a class="saved">Saved </a> 
                                                        <?php } }
        ?> 
                                                            </div> </div>
                                                        <!--  <div class="profile-job-profile-button clearfix">
                                                               
                                                              </div> -->
                                                    </div>
                                                </div>
                                                <?php
                                            }}
                                        } else {
                                            ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">No Recommended Candidate Found.</h4>
                                            </div>
<?php }
?>
                                        <!-- khyati end -->
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <footer>

<?php echo $footer; ?>
                    </footer>
                    <!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                        <div class="modal-dialog modal-lm">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->
                    </body>
                    </html>

                    <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
                    <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
                    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
                    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
                    <!-- script for skill textbox automatic end (option 2)--> 
                    <script>
                                                            var data = <?php echo json_encode($demo); ?>;
//alert(data);
                                                            $(function () {
// alert('hi');
                                                                $("#tags").autocomplete({
                                                                    source: function (request, response) {
                                                                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                        response($.grep(data, function (item) {
                                                                            return matcher.test(item.label);
                                                                        }));
                                                                    },
                                                                    minLength: 1,
                                                                    select: function (event, ui) {
                                                                        event.preventDefault();
                                                                        $("#tags").val(ui.item.label);
                                                                        $("#selected-tag").val(ui.item.label);
                                                                        // window.location.href = ui.item.value;
                                                                    }
                                                                    ,
                                                                    focus: function (event, ui) {
                                                                        event.preventDefault();
                                                                        $("#tags").val(ui.item.label);
                                                                    }
                                                                });
                                                            });
                    </script>
                    <script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword = document.getElementById('tags').value;
                            var searchplace = document.getElementById('searchplace').value;
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //    alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>
                    <script>
                        //select2 autocomplete start for skill
                        $('#searchskills').select2({
                            placeholder: 'Find Your Skills',
                            ajax: {
                                url: "<?php echo base_url(); ?>recruiter/keyskill",
                                dataType: 'json',
                                delay: 250,
                                processResults: function (data) {
                                    return {
                                        //alert(data);
                                        results: data
                                    };
                                },
                                cache: true
                            }
                        });
                        //select2 autocomplete End for skill
                        //select2 autocomplete start for Location
                        $('#searchplace').select2({
                            placeholder: 'Find Your Location',
                            maximumSelectionLength: 1,
                            ajax: {
                                url: "<?php echo base_url(); ?>recruiter/location",
                                dataType: 'json',
                                delay: 250,
                                processResults: function (data) { //alert(data);
                                    return {
                                       
                                        results: data
                                    };
                                },
                                cache: true
                            }
                        });
                        //select2 autocomplete End for Location
                    </script>
                    <script>
                        // Get the modal
                        var modal = document.getElementById('myModal');
                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtn");
                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        // When the user clicks the button, open the modal 
                        btn.onclick = function () {
                            modal.style.display = "block";
                        }
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal.style.display = "none";
                        }
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    </script>
                    <!-- Cover Image upload Start--> 
                    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
                    <script>
                        $(document).ready(function ()
                        {
                            /* Uploading Profile BackGround Image */
                            $('body').on('change', '#bgphotoimg', function ()
                            {
                                $("#bgimageform").ajaxForm({target: '#timelineBackground',
                                    beforeSubmit: function () {},
                                    success: function () {
                                        $("#timelineShade").hide();
                                        $("#bgimageform").hide();
                                    },
                                    error: function () {
                                    }}).submit();
                            });
                            /* Banner position drag */
                            $("body").on('mouseover', '.headerimage', function ()
                            {
                                var y1 = $('#timelineBackground').height();
                                var y2 = $('.headerimage').height();
                                $(this).draggable({
                                    scroll: false,
                                    axis: "y",
                                    drag: function (event, ui) {
                                        if (ui.position.top >= 0)
                                        {
                                            ui.position.top = 0;
                                        } else if (ui.position.top <= y1 - y2)
                                        {
                                            ui.position.top = y1 - y2;
                                        }
                                    },
                                    stop: function (event, ui)
                                    {
                                    }
                                });
                            });
                            /* Bannert Position Save*/
                            $("body").on('click', '.bgSave', function ()
                            {
                                var id = $(this).attr("id");
                                var p = $("#timelineBGload").attr("style");
                                var Y = p.split("top:");
                                var Z = Y[1].split(";");
                                var dataString = 'position=' + Z[0];
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url('recruiter/image_saveBG_ajax'); ?>",
                                    data: dataString,
                                    cache: false,
                                    beforeSend: function () { },
                                    success: function (html)
                                    {
                                        if (html)
                                        {
                                            window.location.reload();
                                            $(".bgImage").fadeOut('slow');
                                            $(".bgSave").fadeOut('slow');
                                            $("#timelineShade").fadeIn("slow");
                                            $("#timelineBGload").removeClass("headerimage");
                                            $("#timelineBGload").css({'margin-top': html});
                                            return false;
                                        }
                                    }
                                });
                                return false;
                            });
                        });
                    </script>
                    <!-- Cover Image upload Start--> 
                    <!-- save post start -->
            <script type="text/javascript">
                  function save_user(abc)
                        {
           var saveid = document.getElementById("hideenuser" + abc);
           alert(saveid);
                $.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "recruiter/save_search_user" ?>',
        data: 'user_id=' + abc + '&save_id=' + saveid.value,
        success: function (data) {
    $('.' + 'saveduser' + abc).html(data).addClass('saved');
                                }
                            });
                        }
                    </script>
                    <!-- save post end-->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
                   
                    <script>
                        function savepopup(id) {

                  
                            save_user(id);
                      
            $('.biderror .mes').html("<div class='pop_content'>Candidate successfully saved.");
            $('#bidmodal').modal('show');
                        }
                    </script>