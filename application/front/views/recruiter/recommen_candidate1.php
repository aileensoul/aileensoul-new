<!-- start head -->

<?php echo $head; ?>
<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
<!--post save success pop up style strat -->

<!--post save success pop up style end -->


<!-- start header -->
<?php echo $header; ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<!-- END HEADER -->
<?php echo $recruiter_header2_border; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    </head>
    <body>

        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">


                    <div class="col-md-4 profile-box profile-box-left"><div class="">
                                <div class="full-box-module">   
      <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover"> 
                                              <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('recruiter/rec_profile'); ?>" tabindex="-1" 
                 aria-hidden="true" rel="noopener">
               
                <?php
                 $image_ori = $recdata[0]['profile_background'];
                if ($image_ori) {
                        //echo "hii"; die();
                                                                                              ?>
                   <!-- box image start -->
               <img src="<?php echo base_url($this->config->item('rec_bg_thumb_upload_path') . $recdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>">
                    <!-- box image end -->
                         <?php
                   } else {
                             ?>
                  <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                <?php
                             }
                                 ?>
                                        </a>
                                    </div>
                                    <div class="profile-boxProfileCard-content clearfix">
                                    <div class="left_side_box_img buisness-profile-txext">
                                        
                                              <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('recruiter/rec_profile/' . $recdata[0]['user_id']); ?>" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                <?php
//echo "<pre>"; print_r($recruiterdata1); die();
                                                if ($recdata[0]['recruiter_user_image'] != '') {
                                                    // echo "hii"; die();
                                                    ?>
                       <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image']); ?>" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                   <?php
                              } else {
                           ?>
                       <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>">
                            <?php
                                   }
                             ?>
                                            </a>
                                    </div>
                                    <div class="right_left_box_design ">
                                     <span class="profile-company-name ">
                                                <a href="<?php echo site_url('recruiter/rec_profile'); ?>" title="<?php echo $recdata['rec_firstname'] . ' ' . $recdata['rec_lastname']; ?>">   <?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?></a>
                                            </span>

                                                 
                                            <div class="profile-boxProfile-name">
                                                <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata1[0]['user_id']); ?>" title="<?php echo ucwords($recruiterdata1[0]['designation']); ?>">
                                                    <?php
                                                    if (ucwords($recruiterdata1[0]['designation'])) {
                                                        echo ucwords($recruiterdata1[0]['designation']);
                                                    } else {
                                                        echo "Designation";
                                                    }
                                                    ?></a>
                                            </div>
                                               <ul class=" left_box_menubar">
                                               <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>"> Details</a>
                                                </li>                                
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                                                </li>
                                                <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" class="padding_less_right" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
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


<!-- <?php //echo "<pre>"; print_r($postdetail);//die();?> -->
                    <!--- search end -->

                 <div class="col-md-7 col-sm-7 col-md-push-4 col-sm-push-4 custom-right">
                        <div class="common-form">
                            <div class="job-saved-box">

                                <h3>
                                  Search result of 
                                  <?php  if($keyword != "" && $keyword1 == ""){echo '"' .  $keyword . '"';}
                                  elseif ($keyword == "" && $keyword1 != "") {
                                    echo '"' .  $keyword1 . '"';
                                  }
                                  else
                                  {
                                     echo '"' .  $keyword . '"'; echo  " and "; echo '"' .  $keyword1 . '"';
                                  }
              ?>
                                </h3>
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">

    <!-- <?php //echo "<pre>"; print_r($postdetail);die(); ?> -->                                    

<!-- @nk!t 7-4-2017 start -->
                                        <?php
                                        if ($postdetail) {
                                            ?>
<!-- @nk!t 7-4-2017 end -->
<?php
                                            foreach ($postdetail as $p) {
                                                ?>

                                                <div class="profile-job-post-detail clearfix ">

                                                  <div id="popup1" class="overlay">
                                                            <div class="popup">

                                                                <div class="pop_content">
                                                                    Candidate Successfully Saved.
                                                                    <p class="okk"><a class="okbtn" href="#">Ok</a></p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <div class="profile-job-post-title-inside clearfix">
           <div class="profile-job-profile-button clearfix">
             <div class="profile-job-post-location-name-rec">


               <div style="display: inline-block; float: left;">
             
                <div  class="buisness-profile-pic-candidate ">
                <?php
                if ($p['job_user_image']) {
               ?>
           <a href="<?php echo base_url('job/job_printpreview/' . $p['iduser'].'?page=recruiter'); ?>" title=" <?php echo $p['fname'] . ' ' . $p['lname']; ?>"> 
           <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path')  . $p['job_user_image']); ?>" alt="<?php echo $p[0]['fname'] . ' ' . $p[0]['lname']; ?>">
            </a>
             <?php
            } else {
              ?>
              <a href="<?php echo base_url('job/job_printpreview/' . $p['iduser'].'?page=recruiter'); ?>" title=" <?php echo $p['fname'] . ' ' . $p['lname']; ?>"> 
           <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $p[0]['fname'] . ' ' . $p[0]['lname']; ?>"> </a>
             <?php
                }
               ?>                      </div>
                  </div> 


            <div class="designation_rec" style="float: left;">
                <ul>
                         

                     <li>
                   <a style=" font-size: 19px;
         font-weight: 600;" href="<?php echo base_url('job/job_printpreview/' . $p['iduser'].'?page=recruiter'); ?>">
                   <?php echo ucwords($p['fname']) . ' ' . ucwords($p['lname']); 
                  
                   ?>
                     
                 </a></li>

            <li style="display: block;"><a href="javascript:void(0)">  <?php
                  if ($p['designation']) {
                          ?>
                      <?php echo $p['designation']; ?>
                                                     
                   <?php
                    } else {
                     ?>
                   <?php echo "Designation"; ?>
                 <?php
                    }
                  ?> </a>  </li>
            
          </ul>
        </div>

      </div>
       </div>
       </div>

        <div class="profile-job-post-title clearfix search1">

                                                        <div class="profile-job-profile-menu  search ">

                 <ul class="clearfix">
              
                              <?php
                               if ($p['keyskill']) {  ?>
                           <li><b>Skills</b>
                              <span>  <?php
                                      $comma = ", ";
                                       $k = 0;
                                       $aud = $p['keyskill'];
                                       $aud_res = explode(',', $aud);
                                       foreach ($aud_res as $skill) {
                                          if ($k != 0) {
                                                   echo $comma;
                                                        }
                             $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                              echo $cache_time;
                                  $k++;
                                 }  ?>       
                        </span>
                         </li>
                        <?php } ?>

                                                 <?php
                                                 if ($p['other_skill']) {
                                                         ?>
                                                                    
                                                   <li><b>Other Skill</b>
                                          <span> <?php echo $p['other_skill']; ?></span>
                                                     </li>
                                                      <?php } ?>

      <?php if($p['experience'] != 'Fresher'){ ?>
    <?php 
       $contition_array =array('user_id' => $p['iduser'], 'experience' => 'Experience', 'status' => '1');

       $experiance = $this->common->select_data_by_condition('job_add_workexp', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


            $total_work_year=0;
            $total_work_month=0;
            foreach ($experiance as $work1) {

            $total_work_year+=$work1['experience_year'];
            $total_work_month+=$work1['experience_month'];
            }

                  ?>
                 <li> <b> Total Experience </b>
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
            }   ?>

                
              </span> </li> <?php } else{ ?> 
              <li> <b> Total Experience </b>
               <span> <?php echo $p['experience']; ?> </span> </li>
              <?php }?>

      <?php
             $countryname = $this->db->get_where('countries', array('country_id' => $p['country_id']))->row()->country_name;
              $cityname = $this->db->get_where('cities', array('city_id' => $p['city_id']))->row()->city_name;
         ?>


             <li><b>Location</b> 

       <span> <?php if($cityname){echo $cityname;echo ', ';}
                         echo $countryname; ?></span></li>

          <?php if($p['board_primary'] && $p['board_secondary'] && $p['board_higher_secondary'] && $p['degree']){ ?>
            <li>
              <b>Degree</b><span>
              <?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                     $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                             if ($cache_time) {
                                      echo $cache_time;
                                               } else {
                                                 echo PROFILENA;
                                                      }
                                                                        
                   ?>
                 </span>
              </li>
             <?php }
              elseif($p['board_secondary'] && $p['board_higher_secondary'] && $p['degree']){
                ?>
               <li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                     $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                                    if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>


                <?php }
              elseif($p['board_higher_secondary'] && $p['degree']){?>

              <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>

              <?php } else if($p['board_secondary'] && $p['degree']){
             ?>
               <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                   $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                              if ($cache_time) {
                                  echo $cache_time;
                                          } else {
                                              echo PROFILENA;
                                              }
                                                                        
                   ?>
                 </span>
              </li>

             <?php } elseif($p['board_primary'] && $p['degree']){?>
               <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>

             <?php } elseif($p['board_primary'] && $p['board_secondary'] && $p['board_higher_secondary']){?>
             <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $p['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $p['percentage_higher_secondary'];?>
                </span>
                </li>


              <?php } elseif($p['board_secondary'] && $p['board_higher_secondary']){ ?>
             <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $p['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $p['percentage_higher_secondary'];?>
                </span>
                </li>

               <?php } elseif($p['board_primary'] && $p['board_higher_secondary']){ ?>


<li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $p['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $p['percentage_higher_secondary'];?>
                </span>
                </li>


                 <?php }elseif($p['board_primary'] && $p['board_secondary']){?>

 <li><b>Board of Secondary</b>
                <span>
                  <?php echo $p['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $p['percentage_secondary'];?>
                </span>
                </li>

                 <?php } elseif($p['degree']){?>

<li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $p['degree']))->row()->degree_name;
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

                 $cache_time = $this->db->get_where('stream', array('stream_id' => $p['stream']))->row()->stream_name;
                              if ($cache_time) {
                                             echo $cache_time;
                                            } else {
                                             echo PROFILENA;
                                               }
                                                                        
                   ?>
                 </span>
              </li>

                  <?php }elseif($p['board_higher_secondary']){?>

                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $p['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $p['percentage_higher_secondary'];?>
                </span>
                </li>


                  <?php }elseif($p['board_secondary']){?> 

  <li><b>Board of Secondary</b>
                <span>
                  <?php echo $p['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $p['percentage_secondary'];?>
                </span>
                </li>

                  <?php } elseif($p['board_primary']){?>

 <li><b>Board of Primary</b>
                <span>
                  <?php echo $p['board_primary'];?>
                </span>
                </li>
                <li><b>Percentage of Primary</b>
                <span>
                  <?php echo $p['percentage_primary'];?>
                </span>
                </li>

                  <?php }else{?> <li> No Education </li> <?php }?>
                                                                
                               

  <li><b>E-mail</b><span>
        <?php if($p['email']){
             echo $p['email']; }
             else{
              echo PROFILENA;
             }
           ?></span>
   </li>

  <li><b>Mobile Number</b>
       <span> 
        <?php if($p['phnno']){
             echo $p['phnno']; } 
             else{
               echo PROFILENA;
             }
         ?></span>
     </li>




                                                                <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">

                                                                <input type="hidden" name="search" id="search1
                                                                       " value="<?php echo $keyword1; ?>">

                                                            </ul>
                                                        </div>

                                                        <div class="profile-job-profile-button clearfix">
      <div class="apply-btn fr">
   <?php
 $userid = $this->session->userdata('aileenuser');
$contition_array = array('from_id' => $userid, 'to_id' => $p['iduser'], 'save_type' => 1, 'status' => '0');
$data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                
 if($userid != $p['iduser']){       
 if (!$data) {
     ?> 
                     
    <a href="<?php echo base_url('chat/abc/' . $p['iduser']); ?>">Message</a> 

<!--                     <a href="#">Invite</a>-->

             <input type="hidden" id="<?php echo 'hideenuser' . $p['iduser']; ?>" value= "<?php echo $data[0]['save_id']; ?>">
                <!-- <a id="<?php echo $row['user_id']; ?>" onClick="save_user(this.id)" href="#popup1" class="<?php echo 'saveduser' . $row['user_id']; ?>">Save User</a> -->
              <a id="<?php echo $p['iduser']; ?>" onClick="savepopup(<?php echo $p['iduser']; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $p['iduser']; ?>">Save</a>

                <?php
            } else {
                 ?>
    <a href="<?php echo base_url('chat/abc/' . $p['iduser']); ?>">Message</a> 
<!--    <a href="#">Invite</a>   -->
    <a class="saved">Saved </a> 
                                                        <?php } }
        ?> 
                                                            </div>  </div>

                                                        <!--  <div class="profile-job-profile-button clearfix">
                                                               
                                                              </div> -->


                                                    </div>
                                                </div>



                                            <?php }
                                            ?>
                                            <!-- @nk!t 7-4-2017 start -->
                                            <?php
                                        } else {
                                            ?>
                                            <div class="text-center rio">
                                                <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                                                <p style="margin-left:4%;text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                                                <ul>
                                                    <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                                                </ul>
                                            </div>
<?php } ?>
                                        <!-- @nk!t 7-4-2017 start -->
                                        <!-- khyati end -->
                                        <div class="col-md-1">
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
    <footer>

<?php echo $footer; ?>


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
    


<script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script>


<script>

var data= <?php echo json_encode($demo); ?>;
//alert(data);

        
$(function() {
    //alert('data');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($de); ?>;
//alert(data);

        
$(function() {
    //alert('data');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
  
</script>


<script type="text/javascript">
    function checkvalue() {
alert("hi");
  var searchkeyword =$.trim(document.getElementById('tags').value);
        var searchplace = $.trim(document.getElementById('searchplace').value);
        
// alert(searchkeyword);
// alert(searchplace);
        if (searchkeyword == "" && searchplace == "") {
       //     alert('Please enter Keyword');
            return false;
        }
    }

      function checkvalue_search() {
        alert("hello");
       
        var searchkeyword =$.trim(document.getElementById('tags').value);
        var searchplace = $.trim(document.getElementById('searchplace').value);
        
        if (searchkeyword == "" && searchplace == "") 
        {
          //  alert('Please enter Keyword');
            return false;
        }
    }

</script>


  

<script type="text/javascript">
    var text = document.getElementById("search").value;
//alert(text);

    $(".search").highlite({

        text: text



    });
</script>
<script type="text/javascript">

    var text = document.getElementById("search1").value;
    alert(text);

    $(".search1").highlite({

        text: text

    });

</script>


<!-- script for skill textbox automatic end (option 2)-->



<!-- script for skill textbox automatic end (option 2)-->


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

            processResults: function (data) {

                return {
                    //alert(data);

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
<script type="text/javascript">
                  function save_user(abc)
                        {
           var saveid = document.getElementById("hideenuser" + abc);
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


                    <!-- all popup close close using esc start -->
 <script type="text/javascript">

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  
 
 </script>
 <!-- all popup close close using esc end-->
