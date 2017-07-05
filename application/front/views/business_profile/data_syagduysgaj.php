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
            <img src="<?php echo base_url(BUSBGIMG . $image[0]['profile_background']);?>" name="image_src" id="image_src" / ></div>
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
      <div class="upload-img">
      
        
        <label class="cameraButton"><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>


<!--- select thai ne ave ae pelaj puru -->
                
            </div>
           
            <div class="profile-photo">
            <div class="buisness-menu">
              <div class="profile-pho-bui">

                <div class="user-pic">
                        <?php if($businessdata[0]['business_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>
                        
                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="5">
                        <input type="submit" name="cancel5" id="cancel5" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                     <?php  echo form_close( );?>
                </div>

                </div>

                <div class="bui-menu-profile col-md-10">

                  

                    <h4 class="profile-head-text"><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata[0]['user_id'].''); ?>"> <?php echo ucwords($businessdata[0]['company_name']); ?></a></h4>
                   
              </div>
                <!-- PICKUP -->
                                   <!-- menubar --><div class="buisness-data-menu  col-md-12 ">

<div class="left-side-menu col-md-2">   </div>
        
       <div class="profile-main-box-buis-menu fr col-md-9">  
 <ul class="">
 
                                     <?php 
                                if(($this->uri->segment(1) == 'business_profile') && ($this->uri->segment(2) == 'business_profile_post' || $this->uri->segment(2) == 'business_resume' || $this->uri->segment(2) == 'business_profile_manage_post' || $this->uri->segment(2) == 'business_profile_save_post' || $this->uri->segment(2) == 'userlist' 
                                    || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>


                                 
                                    <?php }?>
                                     
 <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>">Dashboard</a>
                                    </li>

                                     <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_resume'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata[0]['business_slug']); ?>"> Details</a>
                                    </li>
                                    
                              <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_save_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_save_post'); ?>">Saved Post</a>
                                    </li>

                               
                                  
                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/userlist'); ?>">Userlist</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/followers'); ?>">Followers  (<?php echo (count($businessfollowerdata)); ?>)</a>
                                    </li>
                                    
                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/following'); ?>">Following  (<?php echo (count($businessfollowingdata)); ?>)</a>
                                    </li>

                                 
                                </ul>

</div>

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
     <div class="profile-boxProfileCard  module buisness_he_module" style="height: 47%;">

 <div class="head_details">
          <a href="<?php echo base_url('business_profile/business_photos/'.$businessdata[0]['user_id']) ?>">   <h5><i class="fa fa-camera" aria-hidden="true"></i>   Photos</h5></a>
      </div>      
              <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
              <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
               <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 
           
     </div>
     </div>
  <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">
<table class="business_data_table">
 <div class="head_details">
           <a href="<?php echo base_url('business_profile/business_videos/'.$businessdata[0]['user_id']) ?>"><h5><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</h5></a>
           </div>
           <tr>
             <td class="image_profile"> 
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
              
                  </video>
              </td>

             <td class="image_profile">
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
                 
                  </video>
             </td>
             <td class="image_profile">
                  <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
               
                  </video>
            </td>

           </tr>
        <tr>
             <td class="image_profile"> 
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
              
                  </video>
              </td>

             <td class="image_profile">
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
                 
                  </video>
             </td>
             <td class="image_profile">
                  <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
               
                  </video>
            </td>

           </tr>
        </table>

     </div>
                </div>
                 <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">

 <div class="head_details1">
                  <a href="<?php echo base_url('business_profile/business_audios/'.$businessdata[0]['user_id']) ?>"><h5><i class="fa fa-music" aria-hidden="true"></i>Audio</h5></a>
      </div>
         <table class="business_data_table">
           <tr>
             <td class="image_profile"> 
               <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
              </td>

             <td class="image_profile">
                <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
             </td>
             <td class="image_profile">
                 <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
            </td>

           </tr>
             <tr>
             <td class="image_profile"> 
                <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
              </td>

             <td class="image_profile">
                 <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
             </td>
             <td class="image_profile">
                 <audio controls>
  <source src="horse.ogg" type="audio/ogg">
  <source src="horse.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
            </td>

           </tr>
         </table>
      </div>
    
    </div>

              <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module buisness_he_module" style="height: 47%;">

 <div class="head_details">
          <a href="<?php echo base_url('business_profile/business_pdf/'.$businessdata[0]['user_id']) ?>">   <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Pdf</h5></a>
      </div>      
              <div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div>
              <div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div><div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div><div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div><div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div><div class="image_profile"><object data="your.pdf" type="application/pdf" >
      
   </object></div>
                 
           
     </div>
     </div>       
      </div>

<!-- popup start -->
<div class="col-md-7 col-sm-7 "  >
</div>
</div>
</div>