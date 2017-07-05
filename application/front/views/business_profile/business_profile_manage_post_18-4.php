<!-- start head -->
<?php  echo $head; ?>


<!--post save success pop up style strat -->
<style>
body {
  font-family: Arial, sans-serif;
  background-size: cover;
  height: 100vh;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}



.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.3);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index: 10;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
    margin: 70px auto;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    width: 30%;
    height: 200px;
    position: relative;
    transition: all 5s ease-in-out;
}

.okk{
  text-align: center;
}

.popup .okbtn {
  position: absolute;
    transition: all 200ms;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    padding: 8px 18px;
    background-color: darkcyan;
    left: 25px;
    margin-top: 15px;
    width: 100px; 
    border-radius: 8px;
}

.popup .cnclbtn {
  position: absolute;
    transition: all 200ms;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    padding: 8px 18px;
    background-color: darkcyan;
    right: 25px;
    margin-top: 15px;
    width: 100px;
    border-radius: 8px;
}

.popup .pop_content {
 text-align: center;
 margin-top: 40px;
  
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

<!--post save success pop up style end -->


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- <link rel="stylesheet" href="<?php //echo base_url('assets/css/croppie.css'); ?>">
 --><style type="text/css" media="screen">
#row2 { overflow: hidden; width: 100%; }
#row2 img { height: 350px;width: 100%; } 
.upload-img { float: right;
    position: relative; margin-top: -135px; right: 50px; }

   label.cameraButton {
  display: inline-block;
  margin: 1em 0;
cursor: pointer;
  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
  opacity: 0.7;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}

/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}
</style>
    <!-- END HEAD -->

    <!-- start header -->
<?php echo $header; ?>

 <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->


 <!-- script for cropiee immage End-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

    <!-- END HEADER -->
   
<?php echo $business_header2?>
   

  <body   class="page-container-bg-solid page-boxed">

    <section>
        <div class="container">
            <!--- select thaya pachhi ave ae -->
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
        <div id="upload-demo" style="width:100%"></div>
        </div>
        <div class="col-md-12 cover-pic" style="padding-top: 25px;text-align: center;">
            <button class="btn btn-success  cancel-result">Cancel</button>
    
        <button class="btn btn-success upload-result" onclick="myFunction()">Upload Image</button>

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
        <div id="upload-demo-i" style="background:#e1e1e1;width:100%;padding:30px;height:1px;margin-top:30px"></div>
        </div>
      </div>

      <!--- select thaya pachhi ave ae end-->
  
<!--- select thai ne ave ae pelaj -->
<div class="container">
  <div class="row" id="row2">
        <?php
        $userid  = $this->session->userdata('aileenuser');
            $contition_array = array( 'user_id' => $userid, 'is_deleted' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
            $image_ori=$image[0]['profile_background'];
           if($image_ori)
           {
            ?>
            <div class="bg-images">
            <img src="<?php echo base_url(BUSBGIMG . $businessdata1[0]['profile_background']);?>" name="image_src" id="image_src" / ></div>
            <?php
           }
           else
           { ?>
         <div class="bg-images">
            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / ></div>
      <?php     }
          
            ?>

    </div>
    </div>
</div>
  </div>
  </div>   

    <div class="container">


    <?php
    $userid = $this->session->userdata('aileenuser');
    if($businessdata1[0]['user_id'] == $userid) {
    ?>    
      <div class="upload-img">
      
        
        <label class="cameraButton"><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>


<!--- select thai ne ave ae pelaj puru -->
                
            </div>
           
           <?php }?>
            <div class="profile-photo">
            <div class="buisness-menu">
              <div class="profile-pho-bui">

                <div class="user-pic">
                        <?php if($businessdata1[0]['business_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $businessdata1[0]['business_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>

                            <?php
    $userid = $this->session->userdata('aileenuser');
    if($businessdata1[0]['user_id'] == $userid) {
    ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

<?php }?>
                        </div>
                        
                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="5">
                        <input type="submit" name="cancel5" id="cancel5" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                     <?php  echo form_close();?>
                </div>

                </div>

                <div class="bui-menu-profile col-md-10">

                  

                    <h4 class="profile-head-text"><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata1[0]['business_slug'].''); ?>"> <?php echo ucwords($businessdata1[0]['company_name']); ?></a></h4>

                    <h4 class="profile-head-text_dg"><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata1[0]['business_slug'].''); ?>"> 


                   <?php
                   if($businessdata1[0]['industriyal']){ 
                   echo  
                    $this->db->get_where('industry_type',array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                  }
                    if($businessdata1[0]['other_industrial']){
                      echo ucwords($businessdata1[0]['other_industrial']);
                    } 

                     ?>

                      
                    </a></h4>

                    <?php 
                    $userid  = $this->session->userdata('aileenuser'); 
                    if($businessdata1[0]['user_id'] != $userid){
                      ?>
                   <div class="msg_flw_btn_2">
            <div  class="fr msg_flw_btn">

            <div class="<?php echo "fr" . $businessdata1[0]['business_profile_id']; ?>">

    <?php

     $userid = $this->session->userdata('aileenuser');

      $contition_array = array('user_id' => $userid, 'status' => '1');

    $bup_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     $status  =  $this->db->get_where('follow',array('follow_type' => 2, 'follow_from' => $bup_id[0]['business_profile_id'], 'follow_to'=>$businessdata1[0]['business_profile_id'] ))->row()->follow_status; 
    //echo "<pre>"; print_r($status); die();

if($status == 0 || $status == " "){?>
  <div class="msg_flw_btn_1" id= "followdiv">
      <button  id="<?php echo "follow" . $businessdata1[0]['business_profile_id']; ?>" onClick="followuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Follow</button>
    </div>
 <?php }elseif($status == 1){ ?>
    <div class="msg_flw_btn_1" id= "unfollowdiv">
      <button id="<?php echo "unfollow" . $businessdata1[0]['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Following </button>
    </div>
<?php }?>
     </div> 
     <a href="<?php echo base_url('chat/abc/'.$businessdata1[0]['user_id']); ?>">Message</a>
   </div>

   


                </div>
                <?php }?>
              </div>
                <!-- PICKUP -->
                                   <!-- menubar --><div class="buisness-data-menu  col-md-12 ">

<div class="left-side-menu col-md-1" style="width: 13%;">   </div>
        
       <div class="profile-main-box-buis-menu  col-md-9">  
 <ul class="">
 
                                     
                                     
                                  <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_manage_post/'.$businessdata1[0]['business_slug']); ?>">Dashboard</a>
                                    </li>

                                     <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_resume'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata1[0]['business_slug']); ?>"> Details</a>
                                    </li>
                              
     <?php
    $userid = $this->session->userdata('aileenuser');
    if($businessdata1[0]['user_id'] == $userid) {
    ?> 

                             <!--  <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_save_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_save_post'); ?>">Saved Post</a>
                                    </li> -->

                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/userlist'); ?>">Userlist</a>
                                    </li>


                         <?php }?>

                         <?php
                  $userid = $this->session->userdata('aileenuser');
                   if($businessdata1[0]['user_id'] == $userid) {
                    ?> 


                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/followers/'.$businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($businessfollowerdata)); ?>)</a>
                                    </li>
                                    

                          <?php }else{

            $businessregid = $businessdata1[0]['business_profile_id'];
        $contition_array = array('follow_to' => $businessregid, 'follow_status' =>'1',  'follow_type' =>'2');
        $followerotherdata = $this->data['followerotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                            ?> 
                          <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/followers/'.$businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>

                          <?php }?>

                          <?php
                  $userid = $this->session->userdata('aileenuser');
                   if($businessdata1[0]['user_id'] == $userid) {
                    ?>          
                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/following/'.$businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($businessfollowingdata)); ?>)</a>
                                    </li>
                                    <?php }else{
      $businessregid = $businessdata1[0]['business_profile_id'];
        $contition_array = array('follow_from' => $businessregid, 'follow_status' =>'1',  'follow_type' =>'2');
        $followerotherdata = $this->data['followerotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        ?>
                          <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/following/'.$businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>
                                    <?php }?>
                                    
                                </ul>

</div>
<div class="col-md-2"></div>
</div>

              <!-- pickup -->
            </div>
            </div>
        </div>
       </div>
        
  
  </div>



        
        
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                   
                    <div class="col-md-3">

  <div  class="add-post-button">
   
      
        <a class="btn btn-3 btn-3b" title="You Can Hire From Here"  href="<?php echo base_url('recruiter'); ?>"> <i class="fa fa-plus" aria-hidden="true"></i>  Recruitment </a>
  </div>
                                
                    
   </div>
                     


</div>

               </div>
<div class="user-midd-section">
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                     <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">

 <div class="head_details1">
             <span><h5><i class="fa fa-info-circle" aria-hidden="true"></i> Information</h5>
</span>      </div>
         <table class="business_data_table">
          <tr>
           <td class="business_data_td1"><i class="fa fa-user"></i></td>
           <td class="business_data_td2"><?php echo ucwords($businessdata1[0]['contact_person']); ?></td>
           </tr>
           <tr>
           <td class="business_data_td1"><i class="fa fa-mobile"></i></td>
           <td class="business_data_td2"><span><?php echo $businessdata1[0]['contact_mobile']; ?></span></td>
           </tr>

           <tr>
           <td class="business_data_td1"><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
           <td class="business_data_td2"><span><?php echo $businessdata1[0]['contact_email']; ?></span></td>
           </tr>


           <tr>
           <td class="business_data_td1 "><i class="fa fa-map-marker"></i></td>
           <td class="business_data_td2"><span>

           <?php 
           if($businessdata1[0]['address']){
           echo $businessdata1[0]['address']; echo ",";
           } 
           ?> 
           <?php 
           if($businessdata1[0]['city']){
           echo  $this->db->get_where('cities',array('city_id' => $businessdata1[0]['city']))->row()->city_name; echo",";
           } 
           ?> 
            <?php
             if($businessdata1[0]['country']){
            echo  $this->db->get_where('countries',array('country_id' => $businessdata1[0]['country']))->row()->country_name;  
              }
            ?> 

           </span></td>
           </tr>
           <?php 

           if($businessdata1[0]['contact_website']){
           ?>
           <tr>
           <td class="business_data_td1"><i class="fa fa-globe"></i></td>
           <td class="business_data_td2"><span><a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span></td>
           </tr>

           <?php }?>
           <tr>
           <td class="business_data_td1"><i class="fa fa-suitcase"></i></td>
           <td class="business_data_td2"><span><?php echo $businessdata1[0]['details']; ?></span></td>
           </tr>
         </table>
      </div>
    </div>


<!-- user iamges start-->

  <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module buisness_he_module" style="">

 <div class="head_details">
          <a href="<?php echo base_url('business_profile/business_photos/'.$businessdata1[0]['business_slug']) ?>">   <h5><i class="fa fa-camera" aria-hidden="true"></i>   Photos</h5></a>
  </div>

        <?php

          $contition_array = array('user_id' => $businessdata1[0]['user_id']);
         $businessimage = $this->data['businessimage'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           
            foreach ($businessimage as $val) {
             
            

              $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' =>'1', 'image_type' => '2');
            $busmultiimage = $this->data['busmultiimage'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

              $multipleimage[] = $busmultiimage;
             }

                  ?>
              <?php   

                $allowed =  array('gif','png','jpg');
              
                foreach ($multipleimage as $mke => $mval) {
                  
                  foreach ($mval as $mke1 => $mval1) {
                      $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                     if(in_array($ext,$allowed)){
                   $singlearray[] = $mval1;
                     }
                  }
                } 
                ?>


              <?php 
               if($singlearray) {
              ?>

             <?php 
             $i=0;
             foreach ($singlearray as $mi) {
              
             
             ?>
              <div class="image_profile">

              <img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$mi['image_name']))?>" alt="img1">

              </div>
             <?php $i++;
             if($i==6) break; }?>


            <?php } else{?>
                  Photos Not Available

                 <?php }?>
           
     </div>
     </div>

<!-- user images end-->


  <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">
<table class="business_data_table">
 <div class="head_details">
           <a href="<?php echo base_url('business_profile/business_videos/'.$businessdata1[0]['business_slug']) ?>"><h5><i class="fa fa-video-camera" aria-hidden="true"></i>Video</h5></a>
  </div>


           <?php

          $contition_array = array('user_id' => $businessdata1[0]['user_id']);
         $busvideo = $this->data['busvideo'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

          
            foreach ($busvideo as $val) {
             
            

              $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' =>'1', 'image_type' => '2');
            $busmultivideo = $this->data['busmultivideo'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

              $multiplevideo[] = $busmultivideo;
             }  

                  ?>
              <?php   

                $allowesvideo = array('mp4','3gp');
              
                foreach ($multiplevideo as $mke => $mval) {
                  
                  foreach ($mval as $mke1 => $mval1) {
                      $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                     if(in_array($ext,$allowesvideo)){ 
                   $singlearray1[] = $mval1;
                     }
                  }
                } 
                ?>

               <?php  if($singlearray1) {   ?>
           <tr>

           <?php if($singlearray1[0]['image_name']){?>
             <td class="image_profile"> 
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[0]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
            </td>
          <?php }?>

          <?php if($singlearray1[1]['image_name']){?>
             <td class="image_profile">
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[1]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
             </td>
          <?php }?>
        <?php if($singlearray1[2]['image_name']){?>
             <td class="image_profile">
                  <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[2]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
            </td>
        <?php }?>
           </tr>
        <tr>

        <?php if($singlearray1[3]['image_name']){?>
             <td class="image_profile"> 
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[3]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
              </td>
         <?php }?>
         <?php if($singlearray1[4]['image_name']){?>
             <td class="image_profile">
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[4]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
             </td>
          <?php }?>
          <?php if($singlearray1[5]['image_name']){?>
             <td class="image_profile">
                  <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray1[5]['image_name']); ?>" type="video/mp4">
                <source src="movie.ogg" type="video/ogg">
                Your browser does not support the video tag.
                 </video>
            </td>
         <?php }?>
           </tr>
           <?php }else{ ?>
           Video Not Available
           <?php }?>
        </table>
     </div>
                </div>
                <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">

 <div class="head_details1">
                  <a href="<?php echo base_url('business_profile/business_audios/'.$businessdata1[0]['business_slug']) ?>"><h5><i class="fa fa-music" aria-hidden="true"></i>Audio</h5></a>
      </div>
         <table class="business_data_table">
           <?php

          $contition_array = array('user_id' => $businessdata1[0]['user_id']);
         $busaudio = $this->data['busaudio'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

          
            foreach ($busaudio as $val) {
             
            

            $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' =>'1', 'image_type' => '2');
            $busmultiaudio = $this->data['busmultiaudio'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

              $multipleaudio[] = $busmultiaudio;
             }  

                  ?>
              <?php   

                $allowesaudio = array('mp3');
              
                foreach ($multipleaudio as $mke => $mval) {
                  
                  foreach ($mval as $mke1 => $mval1) {
                      $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);
                    
                     if(in_array($ext,$allowesaudio)){ 
                   $singlearray2[] = $mval1;
                     }
                  }
                } 
                ?>

               <?php  if($singlearray2) {   ?>
           <tr>

           <?php if($singlearray2[0]['image_name']){?>
             <td class="image_profile"> 
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[0]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
            </td>
          <?php }?>

          <?php if($singlearray2[1]['image_name']){?>
             <td class="image_profile">
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[1]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
             </td>
          <?php }?>
        <?php if($singlearray2[2]['image_name']){?>
             <td class="image_profile">
                  <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[2]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
            </td>
        <?php }?>
           </tr>
        <tr>

        <?php if($singlearray2[3]['image_name']){?>
             <td class="image_profile"> 
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[3]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
              </td>
         <?php }?>
         <?php if($singlearray2[4]['image_name']){?>
             <td class="image_profile">
                 <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[4]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
             </td>
          <?php }?>
          <?php if($singlearray2[5]['image_name']){?>
             <td class="image_profile">
                  <video  controls>
                <source src="<?php echo base_url(ARTPOSTIMAGE.$singlearray2[5]['image_name']); ?>" type="audio/mp3">
                <source src="movie.ogg" type="audio/mp3">
                Your browser does not support the audio tag.
                 </video>
            </td>
         <?php }?>
           </tr>
           <?php }else{ ?>
           Audio Not Available
           <?php }?>
        </table>
         
      </div>
    
    </div>

      <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module buisness_he_module" style="">

 <div class="head_details">
          <a href="<?php echo base_url('business_profile/business_pdf/'.$businessdata1[0]['user_id']) ?>">   <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</h5></a>
      </div>      
              <?php

          $contition_array = array('user_id' => $businessdata1[0]['user_id']);
         $businessimage = $this->data['businessimage'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

           
            foreach ($businessimage as $val) {
             
            

              $contition_array = array('post_id' => $val['business_profile_post_id'], 'is_deleted' =>'1', 'image_type' => '2');
            $busmultipdf = $this->data['busmultipdf'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

              $multiplepdf[] = $busmultipdf;
             }

                  ?>
              <?php   

                $allowed =  array('pdf');
              
                foreach ($multiplepdf as $mke => $mval) {
                  
                  foreach ($mval as $mke1 => $mval1) {
                      $ext = pathinfo($mval1['image_name'], PATHINFO_EXTENSION);

                     if(in_array($ext,$allowed)){
                   $singlearray3[] = $mval1;
                     }
                  }
                } 
                ?>


              <?php 
               if($singlearray3) {
              ?>

             <?php 
             $i=0;
             foreach ($singlearray3 as $mi) {
              
             
             ?>
              <div class="image_profile">


            <a href="<?php echo base_url('business_profile/creat_pdf/'.$singlearray3[0]['image_name']) ?>">PDF</a>

              </div>
             <?php $i++;
             if($i==6) break; }?>


            <?php } else{?>
                  Pdf Not Available

                 <?php }?>
           
                 
           
     </div>
     </div>              
      </div>

<!-- popup start -->
<div class="col-md-7 col-sm-7 "  >

 <div class="post-editor col-md-12">
                                <div class="main-text-area col-md-12">
                                <div class="popup-img col-md-1"> <img  src="<?php echo base_url(USERIMAGE . $businessdata1[0]['business_user_image']);?>"  alt="">
 </div>
 <div id="myBtn1"  class="editor-content col-md-11 popup-text" contenteditable>
        <span> Post Your Product....</span> 
      <!--  <span class="fr">
        <input type="file" id="FileID" style="display:none;">
         <label for="FileID"><i class=" fa fa-camera fa"  style=" margin: 8px; cursor:pointer">  </i>
         </label>
          </span>     
       -->
     </div>
    </div>
    <div class="fr">
     <a href="" class="button">Post</a></div>
      </div>
</div>

<!-- The Modal -->
<div id="myModal3" class="modal-post">

  <!-- Modal content -->
  <div class="modal-content-post">
   <span class="close3">&times;</span>
  
   <div class="post-editor col-md-12">
   
    <?php echo form_open_multipart(base_url('business_profile/business_profile_addpost_insert/'), array('id' => 'artpostform','name' => 'artpostform', 'class' => 'clearfix')); ?>

                                <div class="main-text-area col-md-12"  style="border-bottom: 5px solid #ced5df;">
                                <div class="popup-img col-md-1"> <img  src="<?php echo base_url(USERIMAGE . $businessdata1[0]['business_user_image']);?>"  alt="">
 </div>
 <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
        <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
         <textarea placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
 name=my_text rows=4 cols=30 class="post_product_name" style="height:  10%;"></textarea>
  <div style="display: none;">                        
<input size=1 value=50 name=text_num style="width: 52px;" readonly> 
       </div>
      
     </div>
    <!--   <span class="fr">

    <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->
<div class="col-md-1"><i class=" fa fa-camera "  style="margin: 0px;
    font-size: 27px;
    cursor: pointer;
    /* margin-right: -38px; */
    margin-top: 20px;"></i> </div>

 </div>
<div  id="text  class="editor-content" class=" col-md-12 popup-textarea" >
      <textarea name="product_desc" class="description" placeholder="Enter Description"></textarea>

      <output id="list"></output>
</div>
<div class="print_privew_post">
  
</div>
 <div class="preview"></div>
 <div id="data-vid" class="large-8 columns">
            <!--video will be inserted here.-->
        </div>

           <h2 id="name-vid"></h2>
         <p id="size-vid"></p>
         <p id="type-vid"></p>
   
<div class="popup-social-icon">
  <ul class="editor-header">
   
                      <li><input type="file" id="file-es" style="display:none;" id="files" accept="image/*" name="postattach[]" multiple style="display:block;">
                                    <label for="file-es"><i class=" fa fa-camera "  style=" margin: 8px; cursor:pointer"> Photo </i> </label>
                                    </li>

                                     <li><input type="file" id="the-video-file-field" accept="video/*" style="display:none;" id="files" name="postattach[]" multiple style="display:block;">
                                    <label for="the-video-file-field"><i class=" fa fa-video-camera"  style=" margin: 8px; cursor:pointer"> Video </i> </label>
                                    </li>
                                    
        <li>
                                
  <label for="upload" ><i class="fa fa-music "  style=" margin: 8px; cursor:pointer" accept="audio/*"> Audio </i></label>
  <input type="file" name="upload" id="upload" class="upload" style="display:none;" "/>

                               </li>
                                
                                
                                 <li><input type="file" id="file-es" style="display:none;" id="files" accept="application/pdf"  name="postattach[]" multiple style="display:block;">
                                    <label for="file-es"><i class=" fa fa-file-pdf-o fa-2x"  style=" margin: 8px; cursor:pointer"> PDF </i></label>
                                    </li>
                             
                                    </ul>
     

</div>
    <div class="fr">
     <button type="submit"  value="Submit">POST</button>    </div>
     <?php echo form_close(); ?>
      </div>
  </div>
</div>
<!-- popup end -->
<div class="col-md-7 col-sm-7 "  >
                    <!-- middle section start -->
             



<?php

function text2link($text){
    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
    return $text;
  } 

?>
 <?php


//echo "<pre>"; print_r($business_profile_data); die();
  foreach($business_profile_data as $row) { ?>

                            <div class="job-post-detail clearfix" id="<?php echo "removeownpost" . $row['business_profile_post_id']; ?>">
  


<!-- pop up box start-->
<div id="popup1" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      Your Post is Successfully Saved.
      <p class="okk"><a class="okbtn" href="#">Ok</a></p>
    </div>

  </div>
</div>
<!-- pop up box end-->




  <!-- pop up box start-->
<div id="<?php echo "popup2" . $row['business_profile_post_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      Are You Sure want to delete this post?.

      <p class="okk"><a class="okbtn" id="<?php echo $row['business_profile_post_id']; ?>" onClick="remove_ownpost(this.id)" href="#">Yes</a></p>

      <p class="okk"><a class="cnclbtn" href="#">No</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->


 <div class=" post-design-box">
                    <div class="post-design-top col-md-12" >  
                    <div class="post-design-pro-img"> 
                    <?php

                    $userid = $this->session->userdata('aileenuser');

                 $userimage =  $this->db->get_where('business_profile',array('user_id' => $row['user_id']))->row()->business_user_image; 
                 ?>
                    <img src="<?php echo base_url(USERIMAGE .  $userimage);?>" name="image_src" id="image_src" />
                     </div>


                      <div class="post-design-name fl">
                      <ul>

                      <?php 
                 $companyname =  $this->db->get_where('business_profile',array('user_id' => $row['user_id']))->row()->company_name;

                 $slugname =  $this->db->get_where('business_profile',array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;

                $categoryid =  $this->db->get_where('business_profile',array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;

                
                 $category =  $this->db->get_where('industry_type',array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;

                  ?>
                    <li><div class="post-design-product"><a style="    font-size: 18px;
    line-height: 24px; font-weight: 600; color: #000033; margin-bottom: 4px; " href="<?php echo base_url('business_profile/business_resume/'.$slugname); ?>"><?php echo ucwords($companyname); ?> <span  style="font-weight: 400;""><?php echo date('d-M-Y',strtotime($row['created_date'])); ?> </span> </a></div></li>
                     

                        <li> <a style=" color: #000033; font-weight: 400;"> <div class="post-design-product"><a><?php echo ucwords($category); ?> </a></div></li>
                       
                       <li>
                     
                       </li> 

                      </ul> 
                      </div>  
<div class="dropdown2">
<a onClick="myFunction(<?php echo $row['business_profile_post_id']; ?>)" class="dropbtn2 dropbtn2 fa fa-ellipsis-v"></a>
  <div id="<?php echo "myDropdown" . $row['business_profile_post_id']; ?>" class="dropdown-content2">

    
    <?php 
    if($this->session->userdata('aileenuser') == $row['user_id']){?> 


     <a href="<?php echo "#popup2" . $row['business_profile_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>

    <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>

       <?php } else{?>
    <!-- <a href="<?php //echo "#popup5" . $row['business_profile_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a> -->


    <!-- <?php

  $userid  = $this->session->userdata('aileenuser'); 
  $contition_array = array('user_id' => $userid, 'business_save' => '1', 'post_id ' => $row['business_profile_post_id']);
         $businesssave = $this->data['businesssave']  = $this->common->select_data_by_condition('business_profile_save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
         if($businesssave){

?>

   <a><i class="fa fa-bookmark" aria-hidden="true"></i>Saved Post</a>

<?php }else{?>

   <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="save_post(this.id)" href="#popup1" class="<?php echo 'savedpost' . $row['business_profile_post_id']; ?>"><i class="fa fa-bookmark" aria-hidden="true"></i>  Save Post</a> 

<?php }?> -->

    <a href="<?php echo base_url('business_profile/business_profile_contactperson/'.$row['user_id']. ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
<?php }?>
  </div>
</div>




<div class="post-design-desc ">
  <div id="<?php echo 'editpostdata' . $row['business_profile_post_id']; ?>" style="display:block;">
                          <a  style="margin-bottom: 0px;     font-size: 16px"><?php echo text2link($row['product_name']);?></a>
                         </div>

                         <div id="<?php echo 'editpostbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                         <input type="text" id="<?php echo 'editpostname' . $row['business_profile_post_id']; ?>" name="editpostname" value="<?php echo $row['product_name'];?>">
                         </div>
<span class="show"> 

  <div id="<?php echo 'editpostdetails' . $row['business_profile_post_id']; ?>" style="display:block;">
  <?php print text2link($row['product_description']); ?>
  </div>

  <div id="<?php echo 'editpostdetailbox' . $row['business_profile_post_id']; ?>" style="display:none;">

  <textarea id="<?php echo 'editpostdesc' . $row['business_profile_post_id']; ?>" name="editpostdesc"><?php echo $row['product_description'];?>
  </textarea> 
  </div>

  <button id="<?php echo "editpostsubmit" . $row['business_profile_post_id']; ?>" style="display:none" onClick="edit_postinsert(<?php echo $row['business_profile_post_id']; ?>)">EditPost</button>
  

   </span>


                     </div> 
                </div>


                 <div class="post-design-mid col-md-12" >  
              

 <!-- multiple image code  start-->
  
                 <div class="mange_post_image">
              <?php
 
              $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' =>'1', 'image_type' => '2');
            $businessmultiimage = $this->data['businessmultiimage'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
                  ?>
  
                  <?php  if(count($businessmultiimage) == 1) { ?>

                 <?php $allowed =  array('gif','png','jpg');
                  $allowespdf = array('pdf');
                  $allowesvideo = array('mp4','3gp');
                  $allowesaudio = array('mp3');
                  $filename = $businessmultiimage[0]['image_name'];
                  $ext = pathinfo($filename, PATHINFO_EXTENSION); 
                 
                  if(in_array($ext,$allowed)){ ?>

            <!-- one image start -->
                <div id="basic-responsive-image" style="height: 50%; width: 100%;">
                <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$businessmultiimage[0]['image_name']))?>" style="width: 100%; height: 100%;"> </a>
                </div>
          <!-- one image end -->

                 <?php  }elseif(in_array($ext,$allowespdf)){ ?>

        <!-- one pdf start -->
                 <div>
                <a href="<?php echo base_url('business_profile/creat_pdf/'.$businessmultiimage[0]['image_id']) ?>">PDF</a>
                </div>
          <!-- one pdf end -->

                 <?php  }elseif(in_array($ext,$allowesvideo)){ ?>

          <!-- one video start -->
                   <div>
                  <video width="320" height="240" controls>
                  <source src="<?php echo base_url(ARTPOSTIMAGE.$businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                   </video>
                   </div>
              <!-- one video end -->

                  <?php }elseif(in_array($ext,$allowesaudio)){ ?>

            <!-- one audio start -->
                  <div>
                  <audio width="120" height="100" controls>

                  <source src="<?php echo base_url(ARTPOSTIMAGE.$businessmultiimage[0]['image_name']); ?>" type="audio/mp3">
                  <source src="movie.ogg" type="audio/ogg">
                    Your browser does not support the audio tag.
                                                      
                    </audio>

                    </div>

          <!-- one audio end -->

                  <?php } ?>
      
                  <?php   } elseif(count($businessmultiimage) == 2){ ?>

                  <?php 
                    foreach ($businessmultiimage as $multiimage) {
                    ?>

              <!-- two image start -->
                    <div  id="two_manage_images_art" >
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img class="two-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style="width: 100%; height: 100%;"> </a>
                    </div>

              <!-- two image end -->
                  <?php }?>

                  <?php  }elseif(count($businessmultiimage) == 3){ ?>


                 
                    <!-- three image start -->
                     <div id="three_images_art" >
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$businessmultiimage[0]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>
                     <div  id="three_images_2_art">
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$businessmultiimage[1]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>
                        <div  id="three_images_2_art">
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$businessmultiimage[2]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>

                  <!-- three image end -->
              

                  <?php  }elseif(count($businessmultiimage) == 4){ ?>


                  <?php 
                    foreach ($businessmultiimage as $multiimage) {
                    ?>

                    <!-- four image start -->
                       <div id="responsive_manage-images-breakpoints" style="   ">
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style="width: 100%; height: 100%;"> </a>

                    </div>

                    <!-- four image end -->

                  <?php }?>


                  <?php }elseif(count($businessmultiimage) > 4){  ?>



                  <?php 

                    $i = 0;
                    foreach ($businessmultiimage as $multiimage) {
                    ?>

                    <!-- five image start -->
                    <div>
                        <div id="responsive-manage_images_2-breakpoints">
                        <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style=""> </a>
                    </div>
                    </div>

                    <!-- five image end -->

                  <?php

                  $i++;
                  if($i == 3) break;
                   }?>
<!-- this div view all image start -->
                   <div>
                  <div id="responsive-manage_images_3-breakpoints" >
                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$businessmultiimage[3]['image_name']))?>" style=" width: 100%; height: 100%;"> </a></div>


                   <div class="manage_images_view_more" >


                    <a href="<?php echo base_url('business_profile/postnewpage/'.$row['business_profile_post_id']) ?>">View All (+<?php echo (count($businessmultiimage) - 4);?>)</a>
                    </div>

                    </div>
<!-- this div view all image end -->


                 <?php } ?>
                 <div>
                   

                 </div>

                    </div>



                 <!-- multiple image code  end-->

              
                </div>
                <div class="post-design-like-box col-md-12">
                <div class="post-design-menu">
                  <ul>
                    <li class="<?php echo 'likepost' . $row['business_profile_post_id']; ?>">
                    <a id="<?php echo $row['business_profile_post_id']; ?>"   onClick="post_like(this.id)">
             <?php 
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('business_profile_post_id' =>  $row['business_profile_post_id'], 'status' =>'1');
          $active =   $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');

            $likeuser = $this->data['active'][0]['business_like_user'];
            $likeuserarray = explode(',', $active[0]['business_like_user']);

                 if(!in_array($userid, $likeuserarray)){
             ?>               

                    <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>

                    <?php }else{?> 
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    <?php }?>

                    <span>
                                       <?php 

                                       if($row['business_likes_count'] > 0){
                                       echo $row['business_likes_count']; 
                                      }
                                       ?>
                                      </span>
                                      </a>
                        </li>

                         <li class="<?php echo "insertcount" . $row['business_profile_post_id']; ?>">
                                  <?php 

                              $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' =>'0');
                               $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

                                                       ?>

                    <a  onClick="commentall(this.id)" id="<?php echo $row['business_profile_post_id']; ?>"><i class="fa fa-comment-o" aria-hidden="true"> 
                    <?php 
                    if(count($commnetcount) > 0){
                    echo count($commnetcount); 
                   }else{}
                    ?>
                     </i> 
                    </a>
                    </li> 
                  </ul>

</div>
</div>

<!-- like user list start -->

<!-- pop up box start-->
<div id="<?php echo "popuplike" . $row['business_profile_post_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      
      <?php 


$contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['business_like_user'];
$countlike = $commnetcount[0]['business_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);


      foreach ($likelistarray as $key => $value) {
       
$business_fname1 =  $this->db->get_where('business_profile',array('user_id' => $value, 'status' => 1))->row()->company_name;

      ?>

      <a href="<?php echo base_url('business_profile/business_resume/'.$value); ?>">
      <?php echo ucwords($business_fname1); ?>
        
      </a>

<?php }?>

<p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->
<div style="    /* margin: 0px; */    padding-top: 6px;
    padding-bottom: 6px;/*
    border-top: 1px solid #efefef;*/
    display: inline-block;
    width: 100%;
    /* word-spacing: -2px; */">
                        <a  href="<?php echo "#popuplike" . $row['business_profile_post_id']; ?>">
                        <?php

$contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['business_like_user'];
$countlike = $commnetcount[0]['business_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);

$business_fname1 =  $this->db->get_where('business_profile',array('user_id' => $value, 'status' => 1))->row()->company_name;

                        ?>

<div class="fl" style=" padding-left: 22px;" >


<?php echo ucwords($business_fname1);  echo "&nbsp;"; ?>

</div>

<?php

if(count($likelistarray) > 1) {
?>
<div class="fl" style="padding-right: 5px;">
<?php  echo "and"; ?>
</div>

<b style="padding-left: 5px;"><?php echo $countlike; echo "others"; ?> </b>


<?php }?>
</a>
</div>
<!-- like user list end -->



<!-- all comment start-->

<div class="art-all-comment col-md-12">
  
              <div id="<?php echo "fourcomment" . $row['business_profile_post_id']; ?>" style="display:none;">

                                            <?php 

                       $contition_array = array('business_profile_post_id' =>  $row['business_profile_post_id'], 'status' =>'1');
        $busienssdata =   $this->data['busienssdata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array , $data='*', $sortby = 'business_profile_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($busienssdata){
                                      foreach($busienssdata as $rowdata)
                                        { 

                 $companyname =  $this->db->get_where('business_profile',array('user_id' => $rowdata['user_id']))->row()->company_name; ?>
                                       
<div class="all-comment-comment-box">
 <div class="post-design-pro-comment-img"> 
  <?php 
                 $business_userimage =  $this->db->get_where('business_profile',array('user_id' => $row['user_id'], 'status' => 1))->row()->business_user_image;
                 ?>
                  <img  src="<?php echo base_url(USERIMAGE . $business_userimage);?>"  alt="">
 </div>
<div class="comment-name">
                                       <b><?php echo $companyname; echo '</br>';
                                        ?></b> </div>
                                        <div class="comment-details" id= "<?php echo "showcomment2" . $rowdata['business_profile_post_comment_id']; ?>" style="display:block">
                                       <?php  echo text2link($rowdata['comments']); echo '</br>';
                                       ?>
                                          </div>
                                      
 <div class="col-md-12">
                                        <div class="col-md-10">
                                  
                                  <input type="text" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>" id="<?php echo "editcomment2" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>" onClick="commentedit2(this.name)">

</div>  <div class="col-md-2 comment-edit-button">

                                        <button id="<?php echo "editsubmit2" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment2(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Comment</button>

                                     </div>

</div>
<div class="art-comment-menu-design"> 
 
                                          <div class="comment-details-menu" id="<?php echo 'likecomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                     
                            <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_like(this.id)">


                             <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' =>'1');
          $businesscommentlike =   $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>
                            <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                            <?php }else{?>

                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>

                            <?php }?>
                            <span>
                                       <?php 
                                       if($rowdata['business_comment_likes_count'] > 0){
                                       echo $rowdata['business_comment_likes_count']; 
                                     }
                                       ?>
                                      </span>
                                      </a>
</div>

<?php
                    $userid  = $this->session->userdata('aileenuser');
                      if($rowdata['user_id'] == $userid){ 
                           ?>
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">

                                      <div id="<?php echo 'editcommentbox2' . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                     <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox2(this.id)" class="editbox">Edit
                                      </a>
                                      </div>

                                      <div id="<?php echo 'editcancle2' . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                      <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle2(this.id)">Cancle
                                      </a>
                                      </div>
</div>

<?php }?>

 

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $business_userid =  $this->db->get_where('business_profile_post',array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $business_userid == $userid){ 
             ?>
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">

                                     <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['business_profile_post_id']; ?>">
                                      <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                      </span>
                                      </a></div>

<?php }?>

<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">


   <p> <?php
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?>
</p></div>   </div>
                                       </div>

                                        <?php    } 

                                           }else{ echo 'No comments Available!!!';} ?>
                                            </div>

                                 <!-- khyati changes start -->
                                                <div  id="<?php echo "threecomment" . $row['business_profile_post_id']; ?>" style="display:block">
                                               <div class="<?php echo 'insertcomment' . $row['business_profile_post_id']; ?>">

                                                <?php 

                                    $contition_array = array('business_profile_post_id' =>  $row['business_profile_post_id'], 'status' =>'1');

        $businessprofiledata =   $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array , $data='*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($businessprofiledata){
                                      foreach($businessprofiledata as $rowdata)
                                        {
                                          $companyname =  $this->db->get_where('business_profile',array('user_id' => $rowdata['user_id']))->row()->company_name;
                                     ?>
                                     <div class="all-comment-comment-box">
 <div class="post-design-pro-comment-img"> 
            <?php 
                 $business_userimage =  $this->db->get_where('business_profile',array('user_id' => $row['user_id'], 'status' => 1))->row()->business_user_image;
                 ?>
                  <img  src="<?php echo base_url(USERIMAGE . $business_userimage);?>"  alt="">
                  </div>
<div class="comment-name">

<b><?php   echo $companyname; echo '</br>'; ?></b>
</div>
                                        <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['business_profile_post_comment_id']; ?>">
                                        <?php
                                        echo text2link($rowdata['comments']); echo '</br>';
                                        ?>
                                        </div>
<div class="col-md-12">
                                        <div class="col-md-10">
 
                                        <input type="text" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>" id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>"  onClick="commentedit(this.name)">
</div>

                                          <div class="col-md-2 comment-edit-button">
                                       
                                        
                                        <button id="<?php echo "editsubmit" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Comment</button>

                                   
</div>
</div>
 <div class="art-comment-menu-design"> 

                                      
<div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['business_profile_post_comment_id']; ?>">
                                       
                              <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_like1(this.id)">

                                        <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' =>'1');
          $businesscommentlike =   $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>
                            <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                            <?php }else{?>

                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>

                            <?php }?>
                                         <span>
                                       <?php 
                                       if($rowdata['business_comment_likes_count']){
                                       echo $rowdata['business_comment_likes_count'];
                                       } 
                                       ?>
                                      </span>
                                      </a>
                                      </div>

<?php
                    $userid  = $this->session->userdata('aileenuser');
                      if($rowdata['user_id'] == $userid){ 
                           ?>

<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">

                                    <div id="<?php echo 'editcommentbox' . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                      <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                      </a>
                                      </div>

                                      <div id="<?php echo 'editcancle' . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                      <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancle
                                      </a>
                                      </div>
                                      
    </div>


    <?php }?>

 

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $business_userid =  $this->db->get_where('business_profile_post',array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $business_userid == $userid){ 
             ?> 
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
                                      <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['business_profile_post_id']; ?>">
                                      <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                      </span>
                                      </a>
                                          </div>

<?php }?>
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
    <p> <?php 
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?>

</p></div>
</div>
</div>
                                         <?php }
                                       }
                                      ?>
                                                  
                                                </div>
                                                </div>
                                               
                                                <!-- khyati changes end -->

<!-- all comment end -->



                  </div>
                <div class="post-design-commnet-box col-md-12">
                
                  <div class="post-design-proo-img"> 
                <?php 

                $userid = $this->session->userdata('aileenuser');

                 $business_userimage =  $this->db->get_where('business_profile',array('user_id' => $row['user_id'], 'status' => 1))->row()->business_user_image;
                 ?>
                  <img  src="<?php echo base_url(USERIMAGE . $business_userimage);?>"  alt="">
                   </div>


               

                  
                  <div class="">
                  <div class="col-md-10 inputtype-comment" style="padding-left: 7px;">
                   <input type="text" name="<?php echo $row['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $row['business_profile_post_id']; ?>" placeholder="Add a Comment ..." value= "" onClick="entercomment(this.name)">
                  <?php echo form_error('post_comment'); ?> </div>
                 
                        <div class="col-md-1 comment-edit-butn">                   
                            <button id="<?php echo $row['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button>
                            </div>
                  </div>

      </div>
     </div>

 </div>
               <?php }?>
</div>
<!-- business_profile _manage_post end -->

</div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    <footer>
        
        <?php echo $footer; ?>
    </footer>

</body>

</html>


<!-- tabing script start -->

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->

<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<!-- script for skill textbox automatic start-->
 <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
 <!-- script for cropiee immage start-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- script for skill textbox automatic end-->




<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active2", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active2";
    
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>


  

<!-- script for skill textbox automatic end (option 2)-->


<!-- script for business autofill -->
<script>
  $( function() {

    var complex = <?php echo json_encode($demo); ?>;
   
    var availableTags = complex; 
    $( "#tags" ).autocomplete({ 
      source: availableTags
    });
  } );
  </script> 
  <!-- end of business search auto fill -->
<script>

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
         maximumSelectionLength: 1,
        ajax:{

         
          url: "<?php echo base_url(); ?>business_profile/location",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
             

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location

</script>

<!-- tabing script end -->
<!-- footer end -->


<!-- cover image start -->
<script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   document.getElementById('message1').style.display = "block";

  
   
   }
  

   function showDiv() {
   document.getElementById('row1').style.display = "block";
   document.getElementById('row2').style.display = "none";
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
      url: "https://www.aileensoul.com/business_profile/ajaxpro",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
        html = '<img src="' + resp + '" />';
         if(html)
{
  window.location.reload();
}
     
      }
    });

  });
});

//aarati code start
$('#upload').on('change', function () { 
  
  
  
  var reader = new FileReader();
  
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);

    

});

$('#upload').on('change', function () { 
  
  var fd = new FormData();
 fd.append( "image", $("#upload")[0].files[0]);

 files = this.files;
     size = files[0].size;

     

     if (size > 4194304)
        {
           //show an alert to the user
           alert("Allowed file size exceeded. (Max. 4 MB)")

           document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            
          
           //reset file upload control
           return false;
        }

    $.ajax({

        url: "<?php echo base_url(); ?>business_profile/imagedata",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success:function(response){
         

        }
      });
  });

//aarati code end
</script>
<!-- cover image end -->


<!-- like comment ajax data start-->

<!-- post like script start -->

<script type="text/javascript">
function post_like(clicked_id)
{
    //alert(clicked_id);
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/like_post" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ //alert('.' + 'likepost' + clicked_id);
                    $('.' + 'likepost' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--post like script end -->

<!-- comment insert script start -->

<script type="text/javascript">
function insert_comment(clicked_id)
{
    var post_comment = document.getElementById("post_comment" + clicked_id);
   //alert(clicked_id);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/insert_comment" ?>',
                 data:'post_id='+clicked_id + '&comment='+post_comment.value,
                 dataType: "json",
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                   

                     $('.' + 'insertcount' + clicked_id).html(data.count);
                     $('.' + 'insertcomment' + clicked_id).html(data.comment);
                    
                }
            }); 
}
</script>

<!-- insert comment using enter -->
<script type="text/javascript">

function entercomment(clicked_id)
{
 
  $(document).ready(function() {
  $('#post_comment' + clicked_id).keypress(function(e) {
    
      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#post_comment' + clicked_id).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/insert_comment" ?>',
                 data:'post_id='+clicked_id + '&comment='+val,
                 dataType: "json",
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                   
                    $('.' + 'insertcount' + clicked_id).html(data.count);
                    $('.' + 'insertcomment' + clicked_id).html(data.comment);
                    
                }
            });  
      //alert(val);
    }        
  });
});

}
</script>


<script type="text/javascript">
function insert_comment1(clicked_id)
{
    var post_comment = document.getElementById("post_comment1" + clicked_id);
   //alert(clicked_id);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/insert_comment1" ?>',
                 data:'post_id='+clicked_id + '&comment='+post_comment.value,
                 dataType: "json",
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                    

                     $('.' + 'insertcount' + clicked_id).html(data.count);
                     $('.' + 'insertcomment1' + clicked_id).html(data.comment);
                    
                }
            }); 
}
</script>


<!-- insert comment using enter -->
<script type="text/javascript">

function entercomment1(clicked_id)
{
 
  $(document).ready(function() {
  $('#post_comment1' + clicked_id).keypress(function(e) {

      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#post_comment1' + clicked_id).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);


      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/insert_comment1" ?>',
                 data:'post_id='+clicked_id + '&comment='+val,
                 dataType: "json",
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                   

                     $('.' + 'insertcount' + clicked_id).html(data.count);
                     $('.' + 'insertcomment1' + clicked_id).html(data.comment);
                    
                }
            }); 
      //alert(val);
    }        
  });
});

}
</script>


<!--comment insert script end -->


<!-- hide and show data start-->
<script type="text/javascript">
  function commentall(clicked_id){ //alert("xyz");
 
  //alert(clicked_id);
   var x = document.getElementById('threecomment' + clicked_id);
   var y = document.getElementById('fourcomment'+ clicked_id);
    if (x.style.display === 'block' && y.style.display === 'none') {
        x.style.display = 'none';
        y.style.display = 'block';
 
    } else {
        x.style.display = 'block';
        y.style.display = 'none';
    }

  }
</script>
<!-- hide and show data end-->


<!-- comment like script start -->

<script type="text/javascript">
function comment_like(clicked_id)
{
    //alert(clicked_id);
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/like_comment" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ //alert('.' + 'likepost' + clicked_id);
                    $('#' + 'likecomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>


<script type="text/javascript">
function comment_like1(clicked_id)
{
    //alert(clicked_id);
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/like_comment1" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ //alert('.' + 'likepost' + clicked_id);
                    $('#' + 'likecomment1' + clicked_id).html(data);
                    
                }
            }); 
}
</script>
<!--comment like script end -->

<script type="text/javascript">
function comment_delete(clicked_id)
{
    
     var post_delete = document.getElementById("post_delete");
     //alert(post_delete.value);
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/delete_comment" ?>',
                 data:'post_id='+clicked_id + '&post_delete='+post_delete.value,
                 dataType: "json",
                success:function(data){ //alert('.' + 'insertcomment' + clicked_id);

                 // document.getElementById('editcomment' + clicked_id).style.display='none';
       //document.getElementById('showcomment' + clicked_id).style.display='block';
       //document.getElementById('editsubmit' + clicked_id).style.display='none';

                    $('.' + 'insertcomment' + post_delete.value).html(data.comment);

                     $('.' + 'insertcount' + clicked_id).html(data.count);
                    
                    
                }
            }); 
}


function comment_delete1(clicked_id)
{
    
     var post_delete1 = document.getElementById("post_delete1" + clicked_id);
     
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/delete_comment1" ?>',
                 data:'post_id='+clicked_id + '&post_delete='+post_delete1.value,
                 dataType: "json",
                success:function(data){

                    $('.' + 'insertcomment1' + post_delete1.value).html(data.comment);
                    
                     $('.' + 'insertcount' + clicked_id).html(data.count);
                   
                }
            }); 
}
</script>

<!--comment delete script end -->

<!-- comment edit box start-->
<script type="text/javascript">
    
    function comment_editbox(clicked_id){ //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
        document.getElementById('editcomment' + clicked_id).style.display='block';
        document.getElementById('showcomment' + clicked_id).style.display='none';
        document.getElementById('editsubmit' + clicked_id).style.display='block';

        document.getElementById('editcommentbox' + clicked_id).style.display='none';
        document.getElementById('editcancle' + clicked_id).style.display='block';
        
}

function comment_editcancle(clicked_id){ 

        document.getElementById('editcommentbox' + clicked_id).style.display='block';
        document.getElementById('editcancle' + clicked_id).style.display='none';

        document.getElementById('editcomment' + clicked_id).style.display='none';
       document.getElementById('showcomment' + clicked_id).style.display='block';
       document.getElementById('editsubmit' + clicked_id).style.display='none';
   
} 

function comment_editbox2(clicked_id){ //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
        document.getElementById('editcomment2' + clicked_id).style.display='block';
        document.getElementById('showcomment2' + clicked_id).style.display='none';
        document.getElementById('editsubmit2' + clicked_id).style.display='block';

        document.getElementById('editcommentbox2' + clicked_id).style.display='none';
        document.getElementById('editcancle2' + clicked_id).style.display='block';
        
}

function comment_editcancle2(clicked_id){ 

        document.getElementById('editcommentbox2' + clicked_id).style.display='block';
        document.getElementById('editcancle2' + clicked_id).style.display='none';

        document.getElementById('editcomment2' + clicked_id).style.display='none';
       document.getElementById('showcomment2' + clicked_id).style.display='block';
       document.getElementById('editsubmit2' + clicked_id).style.display='none';
   
} 

function comment_editbox3(clicked_id){ //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
        document.getElementById('editcomment3' + clicked_id).style.display='block';
        document.getElementById('showcomment3' + clicked_id).style.display='none';
        document.getElementById('editsubmit3' + clicked_id).style.display='block';

        document.getElementById('editcommentbox3' + clicked_id).style.display='none';
        document.getElementById('editcancle3' + clicked_id).style.display='block';
        
}

function comment_editcancle3(clicked_id){ 

        document.getElementById('editcommentbox3' + clicked_id).style.display='block';
        document.getElementById('editcancle3' + clicked_id).style.display='none';

        document.getElementById('editcomment3' + clicked_id).style.display='none';
       document.getElementById('showcomment3' + clicked_id).style.display='block';
       document.getElementById('editsubmit3' + clicked_id).style.display='none';
   
} 

function comment_editbox4(clicked_id){ //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
        document.getElementById('editcomment4' + clicked_id).style.display='block';
        document.getElementById('showcomment4' + clicked_id).style.display='none';
        document.getElementById('editsubmit4' + clicked_id).style.display='block';

        document.getElementById('editcommentbox4' + clicked_id).style.display='none';
        document.getElementById('editcancle4' + clicked_id).style.display='block';
        
}

function comment_editcancle4(clicked_id){ 

        document.getElementById('editcommentbox4' + clicked_id).style.display='block';
        document.getElementById('editcancle4' + clicked_id).style.display='none';

        document.getElementById('editcomment4' + clicked_id).style.display='none';
       document.getElementById('showcomment4' + clicked_id).style.display='block';
       document.getElementById('editsubmit4' + clicked_id).style.display='none';
   
} 

</script>

<!--comment edit box end-->

<!-- comment edit insert start -->

<script type="text/javascript">
function edit_comment(abc)
{ //alert('editsubmit' + abc);

   var post_comment_edit = document.getElementById("editcomment" + abc);
   //alert(post_comment.value);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment' + abc).style.display='none';
       document.getElementById('showcomment' + abc).style.display='block';
       document.getElementById('editsubmit' + abc).style.display='none';

       document.getElementById('editcommentbox' + abc).style.display='block';
        document.getElementById('editcancle' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment' + abc).html(data);


                    
                }
            }); 
   //window.location.reload();
}
</script>


<script type="text/javascript">

function commentedit(abc)
{  
 
 
  $(document).ready(function() {
  $('#editcomment' + abc).keypress(function(e) {
    

      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#editcomment' + abc).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
      
      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+val,
                   success:function(data){ //alert('falguni');

                  
         document.getElementById('editcomment' + abc).style.display='none';
       document.getElementById('showcomment' + abc).style.display='block';
       document.getElementById('editsubmit' + abc).style.display='none';

       document.getElementById('editcommentbox' + abc).style.display='block';
        document.getElementById('editcancle' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment' + abc).html(data);


                    
                }
            }); 
      //alert(val);
    }        
  });
});

}
</script>

<script type="text/javascript">
function edit_comment2(abc)
{ //alert('editsubmit' + abc);

   var post_comment_edit = document.getElementById("editcomment2" + abc);
   //alert(post_comment.value);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment2' + abc).style.display='none';
       document.getElementById('showcomment2' + abc).style.display='block';
       document.getElementById('editsubmit2' + abc).style.display='none';

       document.getElementById('editcommentbox2' + abc).style.display='block';
        document.getElementById('editcancle2' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment2' + abc).html(data);


                    
                }
            }); 
   //window.location.reload();
}
</script>


<script type="text/javascript">

function commentedit2(abc)
{ 
  $(document).ready(function() {
  $('#editcomment2' + abc).keypress(function(e) {
  
      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#editcomment2' + clicked_id).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
      
      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+val,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment2' + abc).style.display='none';
       document.getElementById('showcomment2' + abc).style.display='block';
       document.getElementById('editsubmit2' + abc).style.display='none';

       document.getElementById('editcommentbox2' + abc).style.display='block';
        document.getElementById('editcancle2' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment2' + abc).html(data);


                    
                }
            }); 
   
      //alert(val);
    }        
  });
});

}
</script>

<script type="text/javascript">
function edit_comment3(abc)
{ //alert('editsubmit' + abc);

   var post_comment_edit = document.getElementById("editcomment3" + abc);
   //alert(post_comment.value);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment3' + abc).style.display='none';
       document.getElementById('showcomment3' + abc).style.display='block';
       document.getElementById('editsubmit3' + abc).style.display='none';

       document.getElementById('editcommentbox3' + abc).style.display='block';
        document.getElementById('editcancle3' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment3' + abc).html(data);


                    
                }
            }); 
   //window.location.reload();
}
</script>


<script type="text/javascript">

function commentedit3(abc)
{ 
  $(document).ready(function() {
  $('#editcomment3' + abc).keypress(function(e) {
   

      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#editcomment3' + clicked_id).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
      
      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+val,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment3' + abc).style.display='none';
       document.getElementById('showcomment3' + abc).style.display='block';
       document.getElementById('editsubmit3' + abc).style.display='none';

       document.getElementById('editcommentbox3' + abc).style.display='block';
        document.getElementById('editcancle3' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment3' + abc).html(data);


                    
                }
            }); 
   
      //alert(val);
    }        
  });
});

}
</script>

<script type="text/javascript">
function edit_comment4(abc)
{ //alert('editsubmit' + abc);

   var post_comment_edit = document.getElementById("editcomment4" + abc);
   //alert(post_comment.value);
   //alert(post_comment.value);
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment4' + abc).style.display='none';
       document.getElementById('showcomment4' + abc).style.display='block';
       document.getElementById('editsubmit4' + abc).style.display='none';

       document.getElementById('editcommentbox4' + abc).style.display='block';
        document.getElementById('editcancle4' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment4' + abc).html(data);


                    
                }
            }); 
   //window.location.reload();
}
</script>

<script type="text/javascript">

function commentedit4(abc)
{ 
  $(document).ready(function() {
  $('#editcomment4' + abc).keypress(function(e) {
    
      if (e.keyCode == 13 && !e.shiftKey) {
                var val = $('#editcomment4' + clicked_id).val();
                e.preventDefault();

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
      
      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+val,
                   success:function(data){ //alert('falguni');

                  //  $('input').each(function(){
                  //     $(this).val('');
                  // }); 
         document.getElementById('editcomment4' + abc).style.display='none';
       document.getElementById('showcomment4' + abc).style.display='block';
       document.getElementById('editsubmit4' + abc).style.display='none';

       document.getElementById('editcommentbox4' + abc).style.display='block';
        document.getElementById('editcancle4' + abc).style.display='none';
                     //alert('.' + 'showcomment' + abc);
                    $('#' + 'showcomment4' + abc).html(data);


                    
                }
            }); 
   
      //alert(val);
    }        
  });
});

}
</script>

<!-- hide and show data start for save post-->
<script type="text/javascript">
  function commentall1(clicked_id){ //alert("xyz");
 
  //alert(clicked_id);
   var x = document.getElementById('threecomment1' + clicked_id);
   var y = document.getElementById('fourcomment1'+ clicked_id);
    if (x.style.display === 'block' && y.style.display === 'none') {
        x.style.display = 'none';
        y.style.display = 'block';
 
    } else {
        x.style.display = 'block';
        y.style.display = 'none';
    }

  }
</script>
<!-- hide and show data end-->

<!-- like comment ajax data end-->
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction1(clicked_id) {
    document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn1')) {

    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction(clicked_id) {
    document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn2')) {

    var dropdowns = document.getElementsByClassName("dropdown-content2");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<!-- drop down script zalak end -->

<!-- edit post start -->

<script type="text/javascript">
   function editpost(abc)
   { 

   
                  
       document.getElementById('editpostdata' + abc).style.display='none';
       document.getElementById('editpostbox' + abc).style.display='block';
       document.getElementById('editpostdetails' + abc).style.display='none';
       document.getElementById('editpostdetailbox' + abc).style.display='block';
       document.getElementById('editpostsubmit' + abc).style.display='block';

        
}
</script>


<script type="text/javascript">
   function edit_postinsert(abc)
   { 

    var editpostname = document.getElementById("editpostname" + abc);
    var editpostdetails = document.getElementById("editpostdesc" + abc);

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/edit_post_insert" ?>',
                data:'business_profile_post_id='+abc + '&product_name='+editpostname.value + '&product_description='+editpostdetails.value,
                dataType: "json",
                   success:function(data){ 
                
            document.getElementById('editpostdata' + abc).style.display='block'; 
            document.getElementById('editpostbox' + abc).style.display='none';
            document.getElementById('editpostdetails' + abc).style.display='block';
            document.getElementById('editpostdetailbox' + abc).style.display='none';

            document.getElementById('editpostsubmit' + abc).style.display='none';
          
                 $('#' + 'editpostdata' + abc).html(data.title);
                 $('#' + 'editpostdetails' + abc).html(data.description);

                }
            }); 
        
}
</script>


<!-- edit post end -->


<!-- remove save post start -->

<script type="text/javascript">
   function remove_post(abc)
   {  

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/business_profile_delete" ?>',
                data:'save_id='+abc,
                success:function(data){ 
                
                 $('#' + 'removepostdata' + abc).html(data);
                 

                }
            }); 
        
}
</script>


<!-- remove save post start -->

<script type="text/javascript">
   function remove_ownpost(abc)
   {  

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/business_profile_deletepost" ?>',
                data:'business_profile_post_id='+abc,
                success:function(data){ 
                
                 $('#' + 'removeownpost' + abc).html(data);
                 

                }
            }); 
        
}
</script>

<!-- remove save post end -->

<script>
// Get the modal
var modal = document.getElementById('myModal2');

// Get the button that opens the modal
var btn = document.getElementById("myBtn1");

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

<script>
// Get the modal
var modal = document.getElementById('myModal3');

// Get the button that opens the modal
var btn = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close3")[0];

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


<!-- save post start -->

<script type="text/javascript">
   function save_post(abc)
   {  

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "business_profile/business_profile_save" ?>',
                data:'business_profile_post_id='+abc,
                success:function(data){ 
                
                 $('.' + 'savedpost' + abc).html(data);
                 

                }
            }); 
        
}
</script>

<!-- save post end -->


<!-- follow user script start -->

<script type="text/javascript">
function followuser(clicked_id)
{
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/follow" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 

               $('.' + 'fr' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!-- follow user script end -->


<!-- Unfollow user script start -->

<script type="text/javascript">
function unfollowuser(clicked_id)
{
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "business_profile/unfollow" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 

               $('.' + 'fr' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!-- Unfollow user script end -->

<script language=JavaScript>
<!--
function check_length(my_form)
{
maxLen = 50; // max number of characters allowed
if (my_form.my_text.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
var msg = "You have reached your maximum limit of characters allowed";
alert(msg);
// Reached the Maximum length so trim the textarea
  my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
 }
else{ // Maximum length not reached so update the value of my_text counter
  my_form.text_num.value = maxLen - my_form.my_text.value.length;
}
}
//-->
</script>

