  <!-- start head -->
<?php  echo $head; ?>

<!--post save success pop up style strat -->


<!--post save success pop up style end -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<!-- END HEAD -->
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>


    <!-- END HEADER -->

<?php
 $returnpage= $_GET['page'];
 if($returnpage == 'job'){
     echo $job_header2_border; 
 }
 elseif($returnpage == 'notification'){
 }
 else{
  echo $recruiter_header2_border; 

 }
?>

<body class="page-container-bg-solid page-boxed custom-border">

    <section class="custom-row">
        <div class="container mt-22" id="paddingtop_fixed">
           
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
        <div id="upload-demo" ></div>
        </div>
        <div class="col-md-12 cover-pic">
        <button class="btn btn-success  cancel-result" onclick="">Cancel</button>
   
        <button class="btn btn-success  upload-result set-btn" onclick="myFunction()">Save</button>

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
        <div id="upload-demo-i"></div>
        </div>
      </div>

     
<div class="">
  <div class="" id="row2">
        <?php
       $userid  = $this->session->userdata('aileenuser');
        if($this->uri->segment(3) == $userid){
            $user_id = $userid;
        }elseif($this->uri->segment(3) == ""){
           $user_id = $userid;
        }else{
            $user_id = $this->uri->segment(3);
        }
            $contition_array = array( 'user_id' => $user_id, 'is_delete' => '0' , 're_status' => '1');
            $image = $this->common->select_data_by_condition('recruiter', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
          
          $image_ori=$image[0]['profile_background'];
           if($image_ori)
           {
            ?>
           
            <img src="<?php echo base_url($this->config->item('rec_bg_main_upload_path'). $image[0]['profile_background']);?>" name="image_src" id="image_src" / >
            <?php
           }
           else
           { ?>
         
            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
         <?php  }
          
            ?>

    </div>
    </div>
</div>
 
        <div class="container tablate-container art-profile">

      
      
      
        <?php if($returnpage == ''){ ?>
        <div class="upload-img">
      <label class="cameraButton"><span class="tooltiptext_rec">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>
          </div>
  
        <?php }?>
    
            <div class="profile-photo">
              <div class="profile-pho">

                <div class="user-pic padd_img">
                                <?php if($recdata[0]['recruiter_user_image'] != '' ){ ?>
                           <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <!-- <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
 -->
                        <?php if($returnpage == ''){ ?>
                         <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                        <?php }?>
                        </div>
                       
                     

                 </div>
           <div class="job-menu-profile mob-block">
                         <a href="javascript:void(0);" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>"><h3><?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?></h3></a>
                            <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                if($returnpage == ''){   
                  if ($recdata[0]['designation'] == "") {
               ?>
                            <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                        
                <a id="designation" class="designation" title="Designation">Designation</a>
            <?php }
             else {
               
                ?> 
                <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                <a id="designation" class="designation" title="<?php echo ucwords($recdata[0]['designation']); ?>"><?php echo ucwords($recdata[0]['designation']); ?></a>
             <?php }
             
             } else {  echo ucwords($recdata[0]['designation']);  }  ?>

                    <!-- The Modal -->
            <!--         <div id="myModal" class="modal">
                      <!-- Modal content --><!-- <div class="col-md-2"></div> -->
                      <!-- <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
                         <?php //echo form_open(base_url('recruiter/recruiter_designation/'), array('id' => 'recdesignation','name' => 'recdesignation', 'class' => 'clearfix')); ?>

  <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php //echo $recdata[0]['designation']; ?>"></fieldset> -->
        <!--  <input type="hidden" name="hitext" id="hitext" value="2">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php// echo form_close();?>
  
                    
                     
                    </div>
                    <div class="col-md-2"></div>
              </div>
             --> 
            </div>
      
  </div>
                    <!-- menubar -->
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

<div class=" right-side-menu art-side-menu padding_less_right right-menu-jr">  
  
               <?php 
               $userid = $this->session->userdata('aileenuser');
               if($recdata[0]['user_id'] == $userid){
               
               ?>     
                <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  
                                  
 <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile'){?> class="active" <?php } ?>>
        <?php if($returnpage == 'job'){?>
     <a title="Details" href="<?php echo base_url('recruiter/rec_profile/'.$this->uri->segment(3).'?page='.$returnpage); ?>">Details</a>
        <?php }else{?>
     <a title="Details" href="<?php echo base_url('recruiter/rec_profile'); ?>">Details</a>
        <?php }?>
                                    </li>



                                    <?php
                                    if(($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'rec_post' || $this->uri->segment(2) == 'rec_profile' || $this->uri->segment(2) == 'add_post' || $this->uri->segment(2) == 'save_candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '' ||  $this->uri->segment(3) != '')) { ?>

                                       <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post'){?> class="active" <?php } ?>>
                                           <?php if($returnpage == 'job'){ ?>
                                           <a title="Post" href="<?php echo base_url('recruiter/rec_post/'.$this->uri->segment(3).'?page='.$returnpage); ?>">Post</a>
                                           <?php } else {?>
                                           <a title="Post" href="<?php echo base_url('recruiter/rec_post'); ?>">Post</a>
                                           <?php }?>
                                    </li>


                                    <?php }?>    

                                    <?php
                                    if(($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'rec_post' || $this->uri->segment(2) == 'rec_profile' || $this->uri->segment(2) == 'add_post' || $this->uri->segment(2) == 'save_candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>

                                    <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate'){?> class="active" <?php } ?>><a title="Saved Candidate" href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved </a>
                                    </li> 
                                                                         
                           


                                    <?php }?>               
</ul>

 <div class="flw_msg_btn fr">
                    <ul>
                    <?php
                    if($this->uri->segment(3) != "" && $this->uri->segment(3) != $userid){ ?>
                       <li> <a href="<?php echo base_url('chat/abc/' . $this->uri->segment(3)); ?>">Message</a> </li>
                        <?php } ?>
                    </ul>
                </div>

</div>

  </div>  


            </div>            
        </div>
        <div  class="add-post-button mob-block">
            <?php if ($returnpage == '') { ?>
                <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
            <?php } ?>
        </div>
            <!-- menubar --> 
    <div class="middle-part container rec_res">
  <div class="job-menu-profile mob-none pt20">
                         <a href="javascript:void(0);" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>"><h5><?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?></h5></a>
                            <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                if($returnpage == ''){   
                  if ($recdata[0]['designation'] == "") {
               ?>
                            <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                        
                <a id="designation" class="designation" title="Designation">Designation</a>
            <?php }
             else {
               
                ?> 
                <!--<a id="myBtn" title="<?php echo ucwords($job[0]['designation']); ?>"><?php echo ucwords($job[0]['designation']); ?></a>-->
                <a id="designation" class="designation" title="<?php echo ucwords($recdata[0]['designation']); ?>"><?php echo ucwords($recdata[0]['designation']); ?></a>
             <?php }
             
             } else {  echo ucwords($recdata[0]['designation']);  }  ?>

                    <!-- The Modal -->
            <!--         <div id="myModal" class="modal">
                      <!-- Modal content --><!-- <div class="col-md-2"></div> -->
                      <!-- <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
                         <?php //echo form_open(base_url('recruiter/recruiter_designation/'), array('id' => 'recdesignation','name' => 'recdesignation', 'class' => 'clearfix')); ?>

  <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php //echo $recdata[0]['designation']; ?>"></fieldset> -->
        <!--  <input type="hidden" name="hitext" id="hitext" value="2">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php// echo form_close();?>
  
                    
                     
                    </div>
                    <div class="col-md-2"></div>
              </div>
             --> 
            </div>
            
  <div  class="add-post-button">
        <?php if($returnpage == '') {?>
        <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter/add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
        <?php } ?>
  </div>
  </div>


            <!-- text head end -->
                      
            
                      <div class="col-md-8 col-sm-12 mob-clear">
                        <div class="common-form">
                            <div class="job-saved-box">
                              
                             <h3>Details  </h3>
                               
<?php

function text2link($text){
    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
    return $text;
  } 

?>  






          
                               
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <div class="profile-job-post-detail clearfix">
                                          
                                            <div class="profile-job-post-title clearfix">
                                                 <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
              <li> <p class="details_all_tital "> Basic Information</p></li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Name</b> <span> 
                                                        <?php 
                   if($recdata[0]['rec_firstname'] || $recdata[0]['rec_lastname'] )
                    { 
                    echo $recdata[0]['rec_firstname'] .'  '. $recdata[0]['rec_lastname'];
                     } 
                    else
                    {
                     echo PROFILENA;
                   }
                   ?> </span>
                                                        </li>
                                                       
                                                      <li> <b>Email </b><span> 
                                                    <?php 

                                                     if($recdata[0]['rec_email'])
                                                      {
                                                        echo $recdata[0]['rec_email'];
                                                      }
                                                      else
                                                      {
                                                     echo PROFILENA; 
                                                      }

                                                        ?> </span>
                                                        </li>


                                                      
                                                            <?php
                                            if ($returnpage == 'job') {
                                                
                                               if($recdata[0]['rec_phone'])
                                                      {
                                                      ?>
                                                       <li><b> Phone Number</b> <span><?php 

                                                        
                                                        echo $recdata[0]['rec_phone']; ?>
                                                      
                                                    </span> </li>

                                                      <?php
                                                      }
                                                   else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['rec_phone'])
                                                      {
                                                      ?>
                                                       <li><b> Phone Number</b> <span><?php 

                                                        
                                                        echo $recdata[0]['rec_phone']; ?>
                                                      
                                                    </span> </li>

                                                      <?php
                                                    }
                                                  
                                                   else
                                                   {
                                                     ?>
                                                      <li><b>Phone Number </b> <span>
                                                       <?php echo PROFILENA; ?></span>
                                                      </li>
                                                   <?php 
                                                    }
                                                   } ?>
                                         
                                                       
                                                    </ul>
                                               
                                                </div>
                                            </div>
                                           <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
              
           <li><p class="details_all_tital ">Company Information</p></li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                         <li> <b>Company Name</b><span><?php 

                                                      if($recdata[0]['re_comp_name'])
                                                      {
                                                        echo $recdata[0]['re_comp_name'];
                                                      }
                                                      else
                                                      {
                                                     echo PROFILENA; 
                                                      }

                                                         ?></span>
                                                        </li>
                                                        <li><b> Company Email Address</b> <span><?php 

                                                    if($recdata[0]['re_comp_email'])
                                                      {
                                                        echo $recdata[0]['re_comp_email'];
                                                      }
                                                      else
                                                      {
                                                     echo PROFILENA; 
                                                      }

                                              ?></span> </li>
                                                  <li> <b>Company Phone Number</b><span> <?php 
                                                               if($recdata[0]['re_comp_phone'])
                                                      {
                                                        echo $recdata[0]['re_comp_phone'];
                                                      }
                                                      else
                                                      {
                                                     echo PROFILENA; 
                                                      }

                                                      ?></span>
                                                        </li>




                                            <?php
                                            if ($returnpage == 'job') {
                                                
                                               if($recdata[0]['re_comp_site'])
                                                      {
                                                      ?>
                                                      <li> <b>Company Website</b><span><a target="_blank"><?php 

                                                        echo $this->common->make_links($recdata[0]['re_comp_site']);
                                                    
                                          
                                                       ?></a></span>
                                                        </li>
                                                      <?php
                                                      }
                                                   else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['re_comp_site'])
                                                      {
                                                      ?>
                                                      <li> <b>Company Website</b><span><a target="_blank"><?php
                                                        echo $this->common->make_links($recdata[0]['re_comp_site']);
                                                
                                                       ?></a></span>
                                                        </li>
                                                      <?php
                                                    }
                                                  
                                                   else
                                                   {
                                                     ?>
                                                      <li><b> Company Website </b> <span>
                                                       <?php echo PROFILENA; ?></span>
                                                      </li>
                                                   <?php 
                                                    }
                                                   } ?>
                                            
                                             <?php
                                            if ($returnpage == 'job') {
                                               if($recdata[0]['re_comp_interview'])
                                                      {
                                                      ?>
                                                      <li> <b>Company Interview Process</b><span> <p> 
                                                     <?php 
                                                       echo $this->common->make_links($recdata[0]['re_comp_interview']); ?>

                                                      </p> </span>
                                                       </li>
                                                         <?php   }
                                                   else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['re_comp_interview'])
                                                      {
                                                      ?>
                                                      <li> <b>Company Interview Process</b><span> <p> 
                                                     <?php 
                                                       echo $this->common->make_links($recdata[0]['re_comp_interview']); ?>

                                                      </p> </span>
                                                       </li>
                                                         <?php   }
                                                  
                                                   else
                                                   {
                                                     ?>
                                                     <li><b>Company Interview Process</b> <span>
                                               <?php echo PROFILENA; ?></span>
                                                        </li>
                                                   <?php 
                                                    }
                                                   } ?>
                                          

                                             <?php
                                            if ($returnpage == 'job') {
                                                if($recdata[0]['re_comp_project'])
                                               {
                                                 ?>
                                               <li><b> Company Best Project</b> <span><p>
                                               <?php 
             
                                                  echo $this->common->make_links($recdata[0]['re_comp_project']);
                                                 ?></p></span> </li>
                                               <?php }

                                                else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['re_comp_project'])
                                                {
                                                    ?>
                                                  <li><b> Company Best Project</b> <span><p>
                                                <?php 
             
                                                 echo $this->common->make_links($recdata[0]['re_comp_project']);
                                                   ?></p></span> </li>
                                                  <?php }                                                  
                                                   else
                                                   {
                                                     ?>
                                                     <li><b>Company Best Project</b> <span>
                                                          <?php echo PROFILENA; ?></span>
                                                        </li>
                                                   <?php 
                                                    }
                                                   } ?>
                                          
                                                   <?php
                                            if ($returnpage == 'job') {
                                                if($recdata[0]['re_comp_activities'])
                                                {
                                                      ?>
                                              <li><b> Other Activities</b> <span>
                                             <p>  <?php 
           
                                              echo $this->common->make_links($recdata[0]['re_comp_activities']);

                                          ?></p> </span> </li>
                                           <?php  }

                                                else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['re_comp_activities'])
                                                {
                                                 ?>
                                                   <li><b> Other Activities</b> <span>
                                                     <p>  <?php 
           
                                                     echo $this->common->make_links($recdata[0]['re_comp_activities']);

                                                     ?></p> </span> </li>
                                                   <?php  }                 
                                                   else
                                                   {
                                                     ?>
                                                     <li><b>Other Activities</b> <span>
                                                          <?php echo PROFILENA; ?></span>
                                                        </li>
                                                   <?php 
                                                    }
                                                   } ?>
                    

      </ul>
                                                </div>
                                                      <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
            
          <li><p class="details_all_tital ">Company Address</p></li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                           <li> <b> Country</b> <span><?php $cache_time = $this->db->get_where('countries',array('country_id' => $recdata[0]['re_comp_country']))->row()->country_name; 

                                                            if($cache_time)
                                                                    {
                                                                         echo $cache_time;
                                                                    }
                                                                    else
                                                                    {
                                                                       echo PROFILENA; 
                                                                    }
                                                                   ?></span>
                                                        </li>
                                                       
                                                        <li> <b>State </b><span> <?php  $cache_time=$this->db->get_where('states',array('state_id' => $recdata[0]['re_comp_state']))->row()->state_name; 
                                                          if($cache_time)
                                                                    {
                                                                         echo $cache_time;
                                                                    }
                                                                    else
                                                                    {
                                                                       echo PROFILENA; 
                                                                    }

                                                         ?> </span>
                                                        </li>

                                                           <?php
                                            if ($returnpage == 'job') {
                                                 if($recdata[0]['re_comp_city'])
                                                          {
                                                        ?>
                                                        <li><b> City</b> <span><?php $cache_time= $this->db->get_where('cities',array('city_id' => $recdata[0]['re_comp_city']))->row()->city_name;  
                                                         if($cache_time)
                                                                    {
                                                                         echo $cache_time;
                                                                    }

                                                                    ?></span> </li>
                                                              <?php  }

                                                else
                                                   {
                                                       echo "";
                                                     }
                                                 }

                                                else
                                                {
                                               if($recdata[0]['re_comp_city'])
                                                          {
                                                        ?>
                                                        <li><b> City</b> <span><?php $cache_time= $this->db->get_where('cities',array('city_id' => $recdata[0]['re_comp_city']))->row()->city_name;  
                                                         if($cache_time)
                                                                    {
                                                                         echo $cache_time;
                                                                    }

                                                                    ?></span> </li>
                                                              <?php  }                
                                                   else
                                                   {
                                                     ?>
                                                     <li><b>City</b> <span>
                                                          <?php echo PROFILENA; ?></span>
                                                        </li>
                                                   <?php 
                                                    }
                                                   } ?>
                    
                                                          <li> <b>Postal Address</b><span> <?php
                                                          if($recdata[0]['re_comp_address'])
                                                                    {
                                                                          echo $recdata[0]['re_comp_address'];
                                                                    }
                                                                    else
                                                                    {
                                                                       echo PROFILENA; 
                                                                    }
                                                            ?> </span>
                                                        </li>

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
             <div class="clearfix"></div>  
    </div>
        
    </section>

<!-- model for popup start -->
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
                    <!-- model for popup -->
    
    <div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
                        <?php echo form_open_multipart(base_url('recruiter/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="2">
                        <div class="popup_previred">
                                                <img id="preview" src="#" alt="your image" />
                        </div>

                        <!-- <input type="submit" name="cancel3" id="cancel2" value="Cancel"> -->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                        <?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<!-- 
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->

 <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
   
       <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
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


  <script type="text/javascript">
function checkvalue(){
   //alert("hi");
  var searchkeyword=$.trim(document.getElementById('tags').value);
  var searchplace=$.trim(document.getElementById('searchplace').value);
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
     //alert('Please enter Keyword');
    return false;
  }
}
  
</script>

<!-- <script>
//select2 autocomplete start for skill

//select2 autocomplete End for skill

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
         maximumSelectionLength: 1,
        ajax:{

         
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
 -->
  <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function removepopup(id) {
        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>
  <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
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

  // <?php //echo "hi"; ?>

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


 <script type="text/javascript">
   
 $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});
   
 </script>   

 <script type="text/javascript">
//For Scroll page at perticular position js Start
$(document).ready(function(){
 
//  $(document).load().scrollTop(1000);
     
    $('html,body').animate({scrollTop:265}, 100);

});
//For Scroll page at perticular position js End
</script>                           