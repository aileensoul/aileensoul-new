
<?php echo $head; ?>

<!--post save success pop up style strat -->

<style type="text/css">
    #popup-form img{display: none;}
</style>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">



<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>



<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>

<?php echo $recruiter_header2_border; ?>



<script type="text/javascript">
    function checkvalue() {
        //alert("hi");
        var searchkeyword = $.trim(document.getElementById('tags').value);
        var searchplace =$.trim(document.getElementById('searchplace').value);
// alert(searchkeyword);
// alert(searchplace);
        if (searchkeyword == "" && searchplace == "") {
            //alert('Please enter Keyword');
            return false;
        }
    }
</script>
<!-- END HEADER -->

<body   class="page-container-bg-solid page-boxed">

    <section class="custom-row">
        <div class="container mt-22" id="paddingtop_fixed">

            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo"></div>
                </div>
                <div class="col-md-12 cover-pic" >
                    <button class="btn btn-success  cancel-result" onclick="">Cancel</button>

                    <button class="btn btn-success upload-result fr" onclick="myFunction()">Save</button>

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
                    <div id="upload-demo-i" ></div>
                </div>
            </div>


            <div class="">
                <div class="" id="row2">
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if($this->uri->segment(3) == $userid){
                    $user_id = $userid;
                    }elseif($this->uri->segment(3) == ""){
                    $user_id = $userid;
                    }else{
                    $user_id = $this->uri->segment(3);
                    }  
                    $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 're_status' => '1');
                    $image = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    //echo "<pre>";print_r($image);
                    $image_ori = $image[0]['profile_background'];
                    if ($image_ori) {
                        ?>
                     
                            <img src="<?php echo base_url($this->config->item('rec_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                        <?php
                    } else {
                        ?>
                       
                            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                    <?php }
                    ?>

                </div>
            </div>
        </div>
  
 

<div class="container tablate-container art-profile">    
    <div class="upload-img">


        <label class="cameraButton"><span class="tooltiptext_rec">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>

    </div>
    <!-- </div>
    -->
    <!-- </div>
    -->   
    <div class="profile-photo">
        <div class="profile-pho">

            <div class="user-pic padd_img">
                <?php if ($recruiterdata[0]['recruiter_user_image'] != '') { ?>
                    <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recruiterdata[0]['recruiter_user_image']); ?>" alt="" >
                <?php } else { ?>
                    <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                <?php } ?>
              
                 <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
            </div>


        </div>
<div class="job-menu-profile mob-block">
        <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata[0]['userid']); ?>"><h3><?php echo $recruiterdata[0]['rec_firstname'] . ' ' . $recruiterdata[0]['rec_lastname']; ?></h3></a>
        <!-- text head start -->
        <div class="profile-text" >

         <?php 
                  
            if ($recruiterdata[0]['designation'] == "") {

               
                ?>
                       
                <a id="designation" class="designation" title="Designation">Designation</a>
            <?php }
             else {
               // echo "hello";
               
                ?> 
            
                <a id="designation" class="designation" title="<?php echo ucwords($recruiterdata[0]['designation']); ?>"><?php echo ucwords($recruiterdata[0]['designation']); ?></a>
            <?php } ?>

        </div>


            

           
        

        <!-- text head end -->
    </div>
        <!-- menubar -->
                                 <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

<div class=" right-side-menu art-side-menu padding_less_right right-menu-jr">  
  
                <?php 
               $userid = $this->session->userdata('aileenuser');
               if($recruiterdata[0]['user_id'] == $userid){
               
               ?>     
                <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  
                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>">Details</a>
                    </li>


                    <?php if (($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'rec_post' || $this->uri->segment(2) == 'rec_profile' || $this->uri->segment(2) == 'add_post' || $this->uri->segment(2) == 'save_candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                        </li>


                        <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
                        </li> 
                        <fa>
                            </li> 


                        <?php } ?>   

                </ul>
            </div>

        </div>  
        <!-- menubar -->                
    </div>                        

</div>
 <div  class="add-post-button mob-block">
        <?php if($returnpage == '') {?>
        <a class="btn btn-3 btn-3b" style="background: -o-linear-gradient(top, rgba(248,48,125,1) 0%, rgba(27,138,185,1) 0%, rgba(190,199,202,1) 90%, rgba(204,204,204,1) 98%, rgba(242,230,235,1) 100%);" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
        <?php } ?>
  </div>

        <div class="middle-part container rec_res">    
<div class="job-menu-profile mob-none  pt20">
        <a href="<?php echo site_url('recruiter/rec_profile/' . $recruiterdata[0]['userid']); ?>"><h5><?php echo $recruiterdata[0]['rec_firstname'] . ' ' . $recruiterdata[0]['rec_lastname']; ?></h5></a>
        <!-- text head start -->
        <div class="profile-text" >

         <?php 
                  
            if ($recruiterdata[0]['designation'] == "") {

               
                ?>
                       
                <a id="designation" class="designation" title="Designation">Designation</a>
            <?php }
             else {
               // echo "hello";
               
                ?> 
            
                <a id="designation" class="designation" title="<?php echo ucwords($recruiterdata[0]['designation']); ?>"><?php echo ucwords($recruiterdata[0]['designation']); ?></a>
            <?php } ?>

        </div>


            

            <div  class="add-post-button">
        <?php if($returnpage == '') {?>
        <a class="btn btn-3 btn-3b" style="background: -o-linear-gradient(top, rgba(248,48,125,1) 0%, rgba(27,138,185,1) 0%, rgba(190,199,202,1) 90%, rgba(204,204,204,1) 98%, rgba(242,230,235,1) 100%);" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
        <?php } ?>
  </div>
  
        

        <!-- text head end -->
    </div>
<!-- <?php //echo "<pre>"; print_r($recdata);die(); ?> -->
    <div class="col-md-8 col-sm-12 mob-clear">
        <div class="common-form">
            <div class="job-saved-box">
                <h3>Saved Candidate</h3>
                <div class="contact-frnd-post">
                   
                        <?php
//                        echo '<pre>';
//                        print_r($recdata);
//                        exit;
                        if ($recdata) {
                            foreach ($recdata as $rec) {


                                $userid = $this->session->userdata('aileenuser');
                                $contition_array = array('from_id' => $userid, 'save_id' => $rec['save_id']);
                                $userdata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                if ($userdata[0]['status'] != 1) {
                                    ?>
 <div class="job-contact-frnd ">
     <div class="profile-job-post-detail clearfix" id="<?php echo "removeuser" . $userdata[0]['save_id']; ?>">

     <div class="profile-job-post-title-inside clearfix">
                                        

     <div class="profile-job-profile-button clearfix"> 

                                               

                  <div class="profile-job-post-location-name-rec">
                 <div style="display: inline-block; float: left;">
<div class="buisness-profile-pic-candidate" >
                                <!-- <rash code 12-4 start> -->

                  <?php
                 if ($rec['job_user_image']) {
                    ?>
               <a href="<?php echo base_url('job/job_printpreview/' . $rec['userid'].'?page=recruiter'); ?>" title="<?php echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?>"> 
               <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $rec['job_user_image']); ?>" alt="<?php echo $rec[0]['fname']. ' ' . $rec[0]['lname']; ?>"></a>
                     <?php
                       } else {
                          ?> 
               <a href="<?php echo base_url('job/job_printpreview/' . $rec['userid'].'?page=recruiter'); ?>" title="<?php echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?>"> 
               <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $rec[0]['fname']. ' ' . $rec[0]['lname']; ?>"> </a>
                       <?php
                      }
                   ?>

                <!-- <rash code 12-4 end> -->

                                 </div>
                                </div>

                               
                <div class="designation_rec_1 fl ">
             <ul>
                <li> 
      <a class="post_name"  href="<?php echo base_url('job/job_printpreview/' . $rec['userid'].'?page=recruiter'); ?>" title="<?php echo $rec[0]['fname']. ' ' . $rec[0]['lname']; ?>">
        <?php echo $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->fname . ' ' . $this->db->get_where('job_reg', array('user_id' => $rec['to_id']))->row()->lname; ?></a>
                 </li>
   
          <li style="display: block;">

                <a class="post_designation"  href="javascript:void(0)" title=" <?php echo $rec['designation']; ?>">
                 <?php
               if ($rec['designation']) {
                    ?>
              <?php echo $rec['designation']; ?>
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

                                        <div class="profile-job-post-title clearfix">
                                          
                                            <div class="profile-job-profile-menu">
                                                <ul class="clearfix">
                 <?php $contition_array = array('user_id' => $rec['userid'], 'type' => 3, 'status' => 1);
        unset($other_skill);
        //echo "<pre>"; print_r($other_skill);
            $other_skill = $this->common->select_data_by_condition('skill', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r($other_skill);
             ?>            

                                         <li> <b> Skill</b> <span>
                                                        <?php
                        
                         $aud = $rec['keyskill'];
                         $aud_res = explode(',', $aud);
                         

                         if(!$rec['keyskill']){
                          echo "otherskill";

                          foreach ($other_skill as $sk) {
                         $sk2[] = $sk['skill']; 
                         
                          }
                       $otherfinal = implode(', ', $sk2);
                       echo $otherfinal;
                       $otherfinal=null;
                        unset($sk2);

                         }else if(!$other_skill){
                          //echo "skill";


                          foreach ($aud_res as $skill) {

                  $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                        $skillsss[] = $cache_time;
                    }

                    $listskill = implode(', ', $skillsss);



                    echo $listskill;
                    $listskill ==null;
                     unset($skillsss);
                         }else if($rec['keyskill'] && $other_skill){

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

                  <?php if($rec['experience'] != 'Fresher'){?>
<?php 
$contition_array =array('user_id' => $rec['userid'], 'experience' => 'Experience', 'status' => '1');

        
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
            }   ?>
               </span>
                </li>
                <?php } else {?>
                <li> <b> Total Experience</b>
              <span> <?php echo $rec['experience']; ?>  </span>
                </li>
                <?php }?>
             

                                                                 <?php
                                                                $countryname = $this->db->get_where('countries', array('country_id' => $rec['country_id']))->row()->country_name;
                                                                $cityname = $this->db->get_where('cities', array('city_id' => $rec['city_id']))->row()->city_name;
                                                                ?>

                <li><b>Location</b> <span>
               <?php  if($cityname){echo $cityname;echo ', ';}
                                             echo $countryname;
                                              ?> 
                
                     </span></li>

 <?php if($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']){ ?>
            <li>
              <b>Degree</b><span>
              <?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                     $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                             if ($cache_time) {
                                      echo $cache_time;
                                               } else {
                                                 echo PROFILENA;
                                                      }
                                                                        
                   ?>
                 </span>
              </li>
             <?php }
              elseif($rec['board_secondary'] && $rec['board_higher_secondary'] && $rec['degree']){
                ?>
               <li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                     $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                    if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>


                <?php }
              elseif($row['board_higher_secondary'] && $rec['degree']){?>

              <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>

              <?php } else if($rec['board_secondary'] && $rec['degree']){
             ?>
               <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                   $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                              if ($cache_time) {
                                  echo $cache_time;
                                          } else {
                                              echo PROFILENA;
                                              }
                                                                        
                   ?>
                 </span>
              </li>

             <?php } elseif($rec['board_primary'] && $rec['degree']){?>
               <li>
              <b>Degree</b><span>
<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                                                                        $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                                                                        if ($cache_time) {
                                                                            echo $cache_time;
                                                                        } else {
                                                                            echo PROFILENA;
                                                                        }
                                                                        
                   ?>
                 </span>
              </li>

             <?php } elseif($rec['board_primary'] && $rec['board_secondary'] && $rec['board_higher_secondary']){?>
             <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $rec['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $rec['percentage_higher_secondary'];?>
                </span>
                </li>


              <?php } elseif($rec['board_secondary'] && $rec['board_higher_secondary']){ ?>
             <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $rec['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $rec['percentage_higher_secondary'];?>
                </span>
                </li>

               <?php } elseif($rec['board_primary'] && $rec['board_higher_secondary']){ ?>


<li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $rec['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $rec['percentage_higher_secondary'];?>
                </span>
                </li>


                 <?php }elseif($rec['board_primary'] && $rec['board_secondary']){?>

 <li><b>Board of Secondary</b>
                <span>
                  <?php echo $rec['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $rec['percentage_secondary'];?>
                </span>
                </li>

                 <?php } elseif($rec['degree']){?>

<li>
              <b>Degree</b><span>
            

<?php 
               $cache_time = $this->db->get_where('degree', array('degree_id' => $rec['degree']))->row()->degree_name;
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

                 $cache_time = $this->db->get_where('stream', array('stream_id' => $rec['stream']))->row()->stream_name;
                              if ($cache_time) {
                                             echo $cache_time;
                                            } else {
                                             echo PROFILENA;
                                               }
                                                                        
                   ?>
                 </span>
              </li>

                  <?php }elseif($rec['board_higher_secondary']){?>

                <li><b>Board of Higher Secondary</b>
                <span>
                  <?php echo $rec['board_higher_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Higher Secondary</b>
                <span>
                  <?php echo $rec['percentage_higher_secondary'];?>
                </span>
                </li>


                  <?php }elseif($rec['board_secondary']){?> 

  <li><b>Board of Secondary</b>
                <span>
                  <?php echo $rec['board_secondary'];?>
                </span>
                </li>
                <li><b>Percentage of Secondary</b>
                <span>
                  <?php echo $rec['percentage_secondary'];?>
                </span>
                </li>

                  <?php } elseif($rec['board_primary']){?>

 <li><b>Board of Primary</b>
                <span>
                  <?php echo $rec['board_primary'];?>
                </span>
                </li>
                <li><b>Percentage of Primary</b>
                <span>
                  <?php echo $rec['percentage_primary'];?>
                </span>
                </li>

                  <?php }else{?> <li> No Education </li> <?php }?>
 
                                                              <li><b>E-mail</b><span>
                                                                    <?php
                                                                    if($rec['email'])
                                                                    {
                                                                    echo $rec['email'];
                                                                    }
                                                                    else
                                                                        {echo PROFILENA; }
                                                                    ?></span>
                                                                </li>

                                                                <li><b>Mobile Number</b><span>
                                                                    <?php
                                                                     if($rec['phnno'])
                                                                    {
                                                                          echo $rec['phnno'];
                                                                    }
                                                                    else{
                                                                        echo PROFILENA;
                                                                    }
                                                                    ?></span>
                                                                </li>



                                                </ul>
                                            </div>
                                            <div class="profile-job-profile-button clearfix">
                                                <div class="apply-btn fr" >
                                     <?php $userid = $this->session->userdata('aileenuser');
                                     if($userid != $rec['userid']){ ?>
                                             <a href="<?php echo base_url('chat/abc/' . $rec['userid']); ?>">Message</a>
                                       <!--<a href="#popup1" class="button">Remove Candidate </a>-->
                                                    <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $rec['save_id'] ?>)">Remove</a>
                                     <?php } ?>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } ?>
                         </div>
                           <?php  }
                        } else { ?>
                            <div class="text-center rio">
                                <h4 class="page-heading  product-listing" >No Saved Candidate Found.</h4>
                            </div>
                            <?php } ?>
                        </div>

            </div>
        </div>
    </div>
        </div>
    </section>

<!-- Model Popup Close -->
  <div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
                        <?php echo form_open_multipart(base_url('recruiter/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="3">
<div class="popup_previred">
                        <img id="preview" src="#" alt="your image" />
</div>
                      <!--   <input type="submit" name="cancel3" id="cancel2" value="Cancel"> -->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                        <?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
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
</body>

</html>



<!-- script for skill textbox automatic end (option 2)-->

<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
   

<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
 
 <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />

<script>

var data= <?php echo json_encode($demo); ?>;
//alert(data);

        
$(function() {
    // alert('hi');
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
    // alert('hi');
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


 <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function removepopup(id) {
        $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this candidate?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_user(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>

<!-- <script>
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
 --><script>
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


<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        //setTimeout(function () { location.reload(1); }, 5000);

    }

   function showDiv() {
        //alert(hi);
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
         $("#upload").val('');
    }
</script>


<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1250,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 1250,
            height: 350
        }
    });



    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

            $.ajax({
                url: "<?php echo base_url() ?>recruiter/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    if (html) {
                        window.location.reload();
                    }
                }
            });

        });
    });

    $('.cancel-result').on('click', function (ev) {

        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";


    });

//aarati code start
    $('#upload').on('change', function () {
           //alert("hello");


        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);



    });

    $('#upload').on('change', function () {

        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);

        files = this.files;
        size = files[0].size;
 // pallavi code start for file type support
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    picpopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    return false;
  }
  // file type code end


        if (size > 26214400)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 25 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            return false;
        }


        $.ajax({

            url: "<?php echo base_url(); ?>recruiter/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {

            }
        });
    });

//aarati code end
</script>

<!-- cover image end -->


<!-- remove save post start -->

<script type="text/javascript">
    function remove_user(abc)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "recruiter/remove_candidate" ?>',
            data: 'save_id=' + abc,
            success: function (data) {

                $('#' + 'removeuser' + abc).html(data);
                $('#' + 'removeuser' + abc).parent().removeClass();
                var numItems = $('.contact-frnd-post .job-contact-frnd').length;

                if (numItems == '0') {
                    var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Candidate Found.</h4></div>";
                    $('.contact-frnd-post').html(nodataHtml);
                }


            }
        });

    }
</script>

<!-- remove save post end

<!-- remove  post end -->
<!-- <script src="<?php //echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function removepopup(id) {
        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id="+ id +" onClick='remove_user(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
</script> -->

<script>
                            function divClicked() {
                                var divHtml = $(this).html();
                                var editableText = $("<textarea/>");
                                editableText.val(divHtml);
                                $(this).replaceWith(editableText);
                                editableText.focus();
                                // setup the blur event for this new textarea
                                editableText.blur(editableTextBlurred);
                            }

                            function editableTextBlurred() {
                                var html = $(this).val();
                                var viewableText = $("<a>");
                                if (html.match(/^\s*$/) || html == '') { 
                                html = "Designation";
                                }
                                viewableText.html(html);
                                $(this).replaceWith(viewableText);
                                // setup the click event for this new div
                                viewableText.click(divClicked);

                                $.ajax({
                                    url: "<?php echo base_url(); ?>recruiter/ajax_designation",
                                    type: "POST",
                                    data: {"designation": html},
                                    success: function (response) {

                                    }
                                });
                            }

                            $(document).ready(function () {
                                $("a.designation").click(divClicked);
                            });
                        </script>


<!-- script for profile pic strat -->
<script type="text/javascript">
    

     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'block';
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profilepic").change(function(){
       // pallavi code for not supported file type 10/06/2017
      profile = this.files;
      //alert(profile);
      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
       //alert('not an image');
        $('#profilepic').val('');
         picpopup();
         return false;
          }else{
          readURL(this);}

          // end supported code 
    });
</script>

<!-- script for profile pic end -->


<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#userimage").validate({

                    rules: {

                        profilepic: {

                            required: true,
                         
                        },
  

                    },

                    messages: {

                        profilepic: {

                            required: "Photo Required",
                            
                        },

                },

                });
                   });
  </script>
  <script>
                        function picpopup() {
                            
                      
            $('.biderror .mes').html("<div class='pop_content'>Only image Type is Supported");
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


$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});
 </script>
 <!-- all popup close close using esc end -->
 <script type="text/javascript">
//For Scroll page at perticular position js Start
$(document).ready(function(){
 
//  $(document).load().scrollTop(1000);
     
    $('html,body').animate({scrollTop:265}, 100);

});
//For Scroll page at perticular position js End
</script>