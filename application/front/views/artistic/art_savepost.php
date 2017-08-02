<!-- start head -->
<?php echo $head; ?>


<!--post save success pop up style strat -->

<!--post save success pop up style end -->



<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">


    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>


<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<?php echo $art_header2; ?>

    <!-- END HEADER -->

<body   class="page-container-bg-solid page-boxed">

    <section>
        <div class="container" id="paddingtop_fixed">
       
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
        <div id="upload-demo" ></div>
        </div>
        <div class="col-md-12 cover-pic">
           <button class="btn btn-success cancel-result" onclick="">cancel</button>
        <button class="btn btn-success upload-result" onclick="myFunction2()">Upload Image</button>

        <div id="message1" style="display:none;">
        <div class="loader"><div id="floatBarsG">
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
        </div>
        <div class="col-md-12"  style="visibility: hidden; ">
        <div id="upload-demo-i" ></div>
        </div>
      </div>

     
<div class="container">
  <div class="row" id="row2">
        <?php
        $userid  = $this->session->userdata('aileenuser');
            $contition_array = array( 'user_id' => $userid, 'is_delete' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
            $image_ori=$image[0]['profile_background'];
           if($image_ori)
           {
            ?>
            <div class="bg-images">
             <img src="<?php echo base_url(ARTBGIMAGE . $image[0]['profile_background']);?>" name="image_src" id="image_src" / ></div>
            <?php
           }
           else
           { ?>
         <div class="bg-images">
            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / ></div>
         <?php  }
          
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
       
            </div>
               
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic">
                        <?php if($artisticdata[0]['art_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(ARTISTICIMAGE . $artisticdata[0]['art_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>

                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="2">
                        <input type="submit" name="cancel2" id="cancel2" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                    </form>
                </div>

                    </div>
                    
                    <div class="profile-main-rec-box-menu  col-md-12 padding_les">

  <div class="left-side-menu col-md-1">  </div>
  <div class="right-side-menu col-md-8">
                                    <ul>

                                    
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_manage_post'); ?>"> Dashboard</a>
                                    </li>


                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/artistic_profile'); ?>"> Details</a>
                                    </li>

                               
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_savepost'); ?>">Saved Post </a>
                                    </li>

                    <?php
                          $userid = $this->session->userdata('aileenuser');
                          if($artisticdata[0]['user_id'] == $userid)
                          { 
                          ?>               

                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/userlist'); ?>">Userlist</a>
                                    </li>

                          <?php }?>

                          <?php
                      $userid = $this->session->userdata('aileenuser'); 
                       if($artisticdata[0]['user_id'] == $userid)
                       { 
                        ?>
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a  style="padding: 12px 15px 2px 15px" href="<?php echo base_url('artistic/followers'); ?>">Followers  <br>(<?php echo (count($followerdata)); ?>)</a>
                                    </li>
                          <?php }else{

        $artregid = $artisticdata[0]['art_id'];
        $contition_array = array('follow_to' => $artregid, 'follow_status' =>'1',  'follow_type' =>'1');
        $followerotherdata = $this->data['followerotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                              ?> 
                              <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a style="padding: 12px 15px 2px 15px" href="<?php echo base_url('artistic/followers/'.$artisticdata[0]['user_id']); ?>">Followers <br> (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>

                            <?php }?> 
  
                              <?php
                            if($artisticdata[0]['user_id'] == $userid){ 
                            ?>        
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a style="padding: 12px 15px 2px 15px" href="<?php echo base_url('artistic/following'); ?>">Following<br>  (<?php echo (count($followingdata)); ?>)</a>
                                    </li>
                                    <?php }else{

$artregid = $artisticdata[0]['art_id'];
$contition_array = array('follow_from' => $artregid, 'follow_status' =>'1',  'follow_type' =>'1');
$followingotherdata = $this->data['followingotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                      ?>
                                  <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a style="padding: 12px 15px 2px 15px" href="<?php echo base_url('artistic/following/'.$artisticdata[0]['user_id']); ?>">Following<br>  (<?php echo (count($followingotherdata)); ?>)</a>
                                    </li> 
                                  <?php }?>  

                                   
                                    
                                </ul>
</div>

<div class="col-md-2 padding_les">
<div class="flw_msg_btn">
<ul>
<li><a>Follow</a></li>
<li>
  <a>Message</a></li>

</ul>
</div>
</div>

  </div>  
    <!-- menubar -->                
  </div>                    <div class="job-menu-profile">
                          <a href="<?php echo site_url('artistic/art_manage_post/'.$artisticdata[0]['user_id']); ?>"><h5><?php echo ucwords($artisticdata[0]['art_name']) .' '.  ucwords($artisticdata[0]['art_lastname']); ?></h5></a>
                             <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                     if($artisticdata[0]['designation'] == '')
                     {
                     ?>
                     <a id="myBtn">Designation</a>
                     <?php }else{?> 
                      <a id="myBtn"><?php echo ucwords($artisticdata[0]['designation']); ?></a>
                      <?php }?>
                  

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                      <!-- Modal content --><div class="col-md-2"></div>
                      <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
                         <?php echo form_open(base_url('artistic/art_designation/'), array('id' => 'artdesignation','name' => 'artdesignation', 'class' => 'clearfix')); ?>

  <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php echo $artisticdata[0]['designation']; ?>">
<?php echo form_error('designation'); ?>
  </fieldset>
         <input type="hidden" name="hitext" id="hitext" value="4">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php echo form_close();?>
  
                    
                     
                    </div>
                    <div class="col-md-2"></div>
              </div>
            </div>
            
            <!-- text head end -->

                      </div>

                      <div class="col-md-7 col-sm-7" id="falguni">
<div class="common-form">
 <div class="job-saved-box">

<h3 >Saved Post</h3>
 <div class="contact-frnd-post">
 <div class="job-contact-frnd ">


          <?php
 foreach($art_data as $row)
 { 

$userid = $this->session->userdata('aileenuser');
       $contition_array = array('user_id'=> $userid,'post_id' => $row['art_post_id'],'is_delete' =>0);

$userdata =  $this->common->select_data_by_condition('art_post_save', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
                            
if($userdata[0]['post_save'] == 1)
{ 

?>
                    <div class="profile-job-post-detail clearfix" id="<?php echo "removepostdata" . $userdata[0]['save_id']; ?>">
                    <div class=" post-design-box">

<!-- pop up box start-->
<div id="<?php echo "popup3" . $userdata[0]['save_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      Are You Sure want to delete this post?.

      <p class="okk"><a class="okbtn" id="<?php echo $userdata[0]['save_id']; ?>" onClick="remove_post(this.id)" href="#">OK</a></p>

      <p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->
                    <div class="post-design-top col-md-12" >  
                    <div class="post-design-pro-img">
                    <?php 
                 $userimage =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_user_image; 
                 ?> 
                    <img src="<?php echo base_url(ARTISTICIMAGE .  $userimage);?>" name="image_src" id="image_src" /> 
                    </div>


                      <div class="post-design-name fl">
                      <ul>

                      <?php 
                 $firstname =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_name;
                 $lastname =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_lastname; 
                 ?>
                        <li><a href="<?php echo base_url('artistic/art_manage_post/'.$row['user_id']); ?>"><h6> <?php echo ucwords($firstname) . ucwords($lastname) ;?></h6></a></li>
                        <li ><div class="post-design-product"><?php echo $row['art_post']?><span><?php  echo date('d-M-Y',strtotime($row['created_date'])); ?></span></div></li>
                       <!--  <li><a href="">T-Shirt</a></li> -->
                      </ul> 
                      </div>  
  <div class="dropdown1">

<a onClick="myFunction1(<?php echo $row['art_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
  <div id="<?php echo "myDropdown" . $row['art_post_id']; ?>" class="dropdown-content1">
   

   <a href="<?php echo "#popup3" . $userdata[0]['save_id']; ?>"><i class="fa fa-bookmark" aria-hidden="true"></i>Remove Post</a>


    <a href="<?php echo base_url('artistic/artistic_contactperson/'.$row['user_id'].''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>

  </div>
</div>


              <div class="post-design-desc show" style="padding-bottom: 10px;">
 <?php echo $row['art_description']; ?>

                     </div> 
                </div>


               
                 <div class="post-design-mid col-md-12" >  
                
                <!-- multiple image code  start-->

                      <div class="mange_post_image">
              <?php
 
              $contition_array = array('post_id' => $row['art_post_id'], 'is_deleted' =>'1', 'image_type' => '1');
            $artmultiimage = $this->data['artmultiimage'] =  $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
                  ?>
  
                  <?php  if(count($artmultiimage) == 1) { ?>

                 <?php $allowed =  array('gif','png','jpg');
                  $allowespdf = array('pdf');
                  $allowesvideo = array('mp4','3gp');
                  $allowesaudio = array('mp3');
                  $filename = $artmultiimage[0]['image_name'];
                  $ext = pathinfo($filename, PATHINFO_EXTENSION); 
                 
                  if(in_array($ext,$allowed)){ ?>

            <!-- one image start -->
                <div id="basic-responsive-image" style="height: 100%; width: 100%;">
                <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$artmultiimage[0]['image_name']))?>" style="width: 100%; height: 100%;"> </a>
                </div>
          <!-- one image end -->

                 <?php  }elseif(in_array($ext,$allowespdf)){ ?>

        <!-- one pdf start -->
                 <div>
                <a href="<?php echo base_url('artistic/creat_pdf/'.$artmultiimage[0]['image_id']) ?>">PDF</a>
                </div>
          <!-- one pdf end -->

                 <?php  }elseif(in_array($ext,$allowesvideo)){ ?>

          <!-- one video start -->
                   <div>
                  <video width="320" height="240" controls>
                  <source src="<?php echo base_url(ARTPOSTIMAGE.$artmultiimage[0]['image_name']); ?>" type="video/mp4">
                    <source src="movie.ogg" type="video/ogg">
                    Your browser does not support the video tag.
                   </video>
                   </div>
              <!-- one video end -->

                  <?php }elseif(in_array($ext,$allowesaudio)){ ?>

            <!-- one audio start -->
                  <div>
                  <audio width="120" height="100" controls>

                  <source src="<?php echo base_url(ARTPOSTIMAGE.$artmultiimage[0]['image_name']); ?>" type="audio/mp3">
                  <source src="movie.ogg" type="audio/ogg">
                    Your browser does not support the audio tag.
                                                      
                    </audio>

                    </div>

          <!-- one audio end -->

                  <?php } ?>
      
                  <?php   } elseif(count($artmultiimage) == 2){ ?>

                  <?php 
                    foreach ($artmultiimage as $multiimage) {
                    ?>

              <!-- two image start -->
                     <div  id="two_save_images_art" >
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img class="two-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style="width: 100%; height: 100%;"> </a>
                    </div>

              <!-- two image end -->
                  <?php }?>

                  <?php  }elseif(count($artmultiimage) == 3){ ?>


                 
                    <!-- three image start -->
                     <div id="three_images_art" >
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$artmultiimage[0]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>
                       <div  id="three_images_2_art">
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$artmultiimage[1]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>
                    <div  id="three_images_2_art">
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$artmultiimage[2]['image_name']))?>" style="width: 100%; height:100%; "> </a>
                    </div>

                  <!-- three image end -->
              

                  <?php  }elseif(count($artmultiimage) == 4){ ?>


                  <?php 
                    foreach ($artmultiimage as $multiimage) {
                    ?>

                    <!-- four image start -->
                     <div id="responsive_save-images-breakpoints" style="   ">
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style="width: 100%; height: 100%;"> </a>

                    </div>

                    <!-- four image end -->

                  <?php }?>


                  <?php }elseif(count($artmultiimage) > 4){  ?>



                  <?php 

                    $i = 0;
                    foreach ($artmultiimage as $multiimage) {
                    ?>

                    <!-- five image start -->
                    <div>
                     <div id="responsive-save_images_2-breakpoints">
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$multiimage['image_name']))?>" style=""> </a>
                    </div>
                    </div>

                    <!-- five image end -->

                  <?php

                  $i++;
                  if($i == 3) break;
                   }?>
<!-- this div view all image start -->
                   <div>
                         <div id="responsive-save_images_3-breakpoints" >
                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>"><img src="<?php echo base_url(ARTPOSTIMAGE. str_replace(" ","_",$artmultiimage[3]['image_name']))?>" style=" width: 100%; height: 100%;"> </a></div>

    <div class="save_images_view_more" >


                    <a href="<?php echo base_url('artistic/postnewpage/'.$row['art_post_id']) ?>">View All (+<?php echo (count($artmultiimage) - 4); ?>)</a>
                    </div>

                    </div>
<!-- this div view all image end -->


                 <?php } ?>
                 <div>
                   

                 </div>

                    </div>
              <!-- multiple image code end -->
                     
                </div>
                <div class="post-design-like-box col-md-12">
                <div class="post-design-menu">
                  <ul>
                    <li class="<?php echo 'likepost' . $row['art_post_id']; ?>">
                    <a id="<?php echo $row['art_post_id']; ?>" onClick="post_like(this.id)">

                      <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('art_post_id' => $row['art_post_id'], 'status' =>'1');
          $artlike =   $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artlike[0]['art_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>

                    <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>

                    <?php }else{
                        ?>
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>

                     <span>
                      <?php
                        if($row['art_likes_count'] > 0){
                       echo $row['art_likes_count'];
                        } 
                       ?>
                      </span>
                      </a>
                    </li>

                    <li>
                     <?php 

          $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
           $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

                                   ?>
                    <a  onClick="commentall1(this.id)" id="<?php echo $row['art_post_id']; ?>"><i class="fa fa-comment-o" aria-hidden="true">
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
<div id="<?php echo "popuplike" . $row['art_post_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      
      <?php 


$contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['art_like_user'];
$countlike = $commnetcount[0]['art_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);


      foreach ($likelistarray as $key => $value) {
       
$art_fname1 =  $this->db->get_where('art_reg',array('user_id' => $value, 'status' => 1))->row()->art_name;

$art_lname1 =  $this->db->get_where('art_reg',array('user_id' => $value, 'status' => 1))->row()->art_lastname;
      ?>

      <a href="<?php echo base_url('artistic/art_manage_post/'.$value); ?>">
      <?php echo ucwords($art_fname1); echo "&nbsp;"; echo ucwords($art_lname1); ?>
        
      </a>

<?php }?>

<p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->
<div style="    /* margin: 0px; */    padding-top: 6px;
    padding-bottom: 6px;
    border-top: 1px solid #efefef;
    display: inline-block;
    width: 100%;
    /* word-spacing: -2px; */">
                        <a  href="<?php echo "#popuplike" . $row['art_post_id']; ?>">
                        <?php

$contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['art_like_user'];
$countlike = $commnetcount[0]['art_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);

$art_fname =  $this->db->get_where('art_reg',array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;

$art_lname =  $this->db->get_where('art_reg',array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                        ?>


<div class="fl" style=" padding-left: 22px;" >

<?php echo ucwords($art_fname); echo "&nbsp;"; echo ucwords($art_lname); echo "&nbsp;"; ?>

</div>

<?php

if(count($likelistarray) > 1) {
?>
<div class="fl" style="padding-right: 5px;">
<?php  echo "and"; ?>
</div>

<div><?php echo $countlike; ?>  <?echo "others"; ?></div>


<?php }?>
</a>
</div>
<!-- like user list end -->

                <div class="art-all-comment col-md-12">
                  

<!-- all comment start-->
                       <div id="<?php echo "fourcomment1" . $row['art_post_id']; ?>" style="display:none">

                                    <?php 

                                    $contition_array = array('art_post_id' =>  $row['art_post_id'], 'status' =>'1');
        $artdata =   $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data='*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($artdata){
                                      foreach($artdata as $rowdata)
                                        { 

                 $artname =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id']))->row()->art_name;?>
<div class="all-comment-comment-box">
 <div class="post-design-pro-comment-img"> 
                  <?php 
                 $art_userimage =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                 ?>

                 <img  src="<?php echo base_url(ARTISTICIMAGE . $art_userimage);?>"  alt="">
                  </div>
<div class="comment-name">
                                        <b>
                                       <?php echo $artname; echo '</br>';
                                        ?>
                                        </b>
                                        </div>

                                        <div class="comment-details"  id= "<?php echo "showcomment3" . $rowdata['artistic_post_comment_id']; ?>">
                                       <?php  echo $rowdata['comments']; echo '</br>';
                                       ?>
                                       </div>
                                      

                                        <input type="text" name="editcomment3" id="<?php echo "editcomment3" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>">

                                        <button id="<?php echo "editsubmit3" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment3(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Comment</button>
 <div class="art-comment-menu-design"> 
     
<div class="comment-details-menu" id="<?php echo 'likecomment' . $rowdata['artistic_post_comment_id']; ?>">
                                <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like(this.id)">

            <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' =>'1');
          $artcommentlike =   $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>
                      <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                      <?php }else{
                        ?>
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>

                                  <span>
                                       <?php
                                       if($rowdata['artistic_comment_likes_count']){
                                        echo $rowdata['artistic_comment_likes_count']; 
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
                                     <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_editbox3(this.id)" class="editbox">Edit
                                      </a>
    </div>

    <?php }?>

 

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $art_userid =  $this->db->get_where('art_post',array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $art_userid == $userid){ 
             ?>  
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
                                     <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['art_post_id']; ?>">
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                      </span>
                                      </a>

                                  </div>
                <?php }?>
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
     <p>  <?php
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?>

                                       </p></div>
                                       </div>
                                       </div>
                                        <?php    } 

                                           }else{ echo 'No comments Available!!!';} ?>
                 
                                    </div>


                                    <div  id="<?php echo "threecomment1" . $row['art_post_id']; ?>" style="display:block">
                                                <div class="<?php echo 'insertcomment' . $row['art_post_id']; ?>">
                                                <?php 

                                    $contition_array = array('art_post_id' =>  $row['art_post_id'], 'status' =>'1');
        $artdata =   $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data='*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($artdata){
                                      foreach($artdata as $rowdata)
                                        {
                                          $artname =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id']))->row()->art_name;?>
                                          <div class="all-comment-comment-box">
   <div class="post-design-pro-comment-img"> 
                  <?php 
                 $art_userimage =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                 ?>

                 <img  src="<?php echo base_url(ARTISTICIMAGE . $art_userimage);?>"  alt="">
                  </div>
<div class="comment-name">
  <b>
                                        <?php echo $artname; echo '</br>'; ?>
                                        </b></div>

                                        <div class="comment-details" id= "<?php echo "showcomment4" . $rowdata['artistic_post_comment_id']; ?>">
                                        <?php
                                        echo $rowdata['comments']; echo '</br>';
                                        ?>
                                        </div>
  <div class="col-md-12">
                                        <div class="col-md-10">    
                                        <input type="text" name="editcomment4" id="<?php echo "editcomment4" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>">
</div>

                                        <div class="col-md-2 comment-edit-button">
                                        
                                        <button id="<?php echo "editsubmit4" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment4(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Comment</button>

                                       </div>

</div>
                                   
                      
 <div class="art-comment-menu-design"> 
<div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['artistic_post_comment_id']; ?>">
                                  <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like1(this.id)">

                                   <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' =>'1');
          $artcommentlike =   $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>

                        <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                    <?php }else{
                    ?>
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>
                        <span>
                       <?php 
                       if($rowdata['artistic_comment_likes_count'] > 0){
                       echo $rowdata['artistic_comment_likes_count'];
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
                                     
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_editbox4(this.id)" class="editbox4">Edit
                                      </a>
                                       </div>
<?php }?>

 

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $art_userid =  $this->db->get_where('art_post',array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $art_userid == $userid){ 
             ?>

            <span role="presentation" aria-hidden="true"> · </span>

<div class="comment-details-menu">
                                     
                                      <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['art_post_id']; ?>">
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                      </span>
                                      </a>

                                        </div>
               <?php }?>
                                        <span role="presentation" aria-hidden="true"> · </span>

<div class="comment-details-menu">
                                         <p> <?php 
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?>
                                           </p></div></div>
                                       </div>

                                         <?php }
                                       }
                                      ?>
                                               
                                                </div>
                                                </div>
                                                <!-- khyati changes end -->
                                                
<!-- all comment end-->


                </div>
                <div class="post-design-commnet-box col-md-12">
                
                  <div class="post-design-proo-img" > 
                  <?php 
                  $userid  = $this->session->userdata('aileenuser'); 
                 $art_userimage =  $this->db->get_where('art_reg',array('user_id' => $userid, 'status' => 1))->row()->art_user_image;
                 ?>

                 <img  src="<?php echo base_url(ARTISTICIMAGE . $art_userimage);?>"  alt="">
                  </div>


                  <div class="">
                  <div class="col-md-10 inputtype-comment">
                  <input type="text" name="post_comment"  id="<?php echo "post_comment1" . $row['art_post_id']; ?>" placeholder="Type Comment ..." value= "">
                                                 <?php echo form_error('post_comment'); ?>
                                            </div>
                                              <div class="col-md-1 comment-edit-butn">                   
                <button id="<?php echo $row['art_post_id']; ?>" onClick="insert_comment1(this.id)">Comment</button>
                </div>


      </div>
      </div>

     </div>
     </div>
        <?php
            }   
                 }
        ?>
</div>

</div>

                                        <div class="col-md-1">
                                        </div>
                                    
                                </div>


                </div>

            </div>
        </div>

        </div>

        

        <div class="user-midd-section">
            <div class="container">
                <div class="row">

                    
                    
                            </div>
                        </div>
                    </div>
    </section>
    

</body>

</html>

<!-- script for skill textbox automatic start (option 2)-->
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/3.3.0/select2.js'); ?>"></script>

 
<!--  textbox automatic end (option 2) -->

  <script>
  $( function() {

    var complex = <?php echo json_encode($demo); ?>;
    

    var availableTags = complex; 
    $( "#tags" ).autocomplete({ 
      source: availableTags
    });
  } );
  </script>

<script>
//select2 autocomplete start for skill
$('#searchskills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/keyskill",
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
//select2 autocomplete End for skill

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/location",
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
 

<!-- popup form edit END -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
 <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#artdesignation").validate({

                    rules: {

                        designation: {

                            required: true,
                         
                        },

                        
                        
                    },

                    messages: {

                        designation: {

                            required: "Designation Is Required.",
                            
                        },

                        
                },

                });
                   });
  </script>

 <!-- post like script start -->

<script type="text/javascript">
function post_like(clicked_id)
{
    
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/like_post" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ 
                    $('.' + 'likepost' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--post like script end -->

<!-- comment like script start -->

<script type="text/javascript">
function comment_like(clicked_id)
{
   
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/like_comment" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ 
                    $('#' + 'likecomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>


<script type="text/javascript">
function comment_like1(clicked_id)
{
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/like_comment1" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ 
                    $('#' + 'likecomment1' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--comment like script end -->

<!-- comment delete script start -->

<script type="text/javascript">
function comment_delete(clicked_id)
{
    
     var post_delete = document.getElementById("post_delete");
    
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/delete_comment" ?>',
                 data:'post_id='+clicked_id + '&post_delete='+post_delete.value,
                success:function(data){ 

                 

                    $('.' + 'insertcomment' + post_delete.value).html(data);
                    
                }
            }); 
}
</script>

<!--comment delete script end -->


<!-- comment insert script start -->

<script type="text/javascript">
function insert_comment(clicked_id)
{
    var post_comment = document.getElementById("post_comment" +clicked_id);
   
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/insert_comment" ?>',
                 data:'post_id='+clicked_id + '&comment='+post_comment.value,
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                    $('.' + 'insertcomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<script type="text/javascript">
function insert_comment1(clicked_id)
{
    var post_comment = document.getElementById("post_comment1" +clicked_id);
   
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/insert_comment" ?>',
                 data:'post_id='+clicked_id + '&comment='+post_comment.value,
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                    $('.' + 'insertcomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--comment insert script end -->

<!-- comment edit script start -->

<!-- comment edit box start-->
<script type="text/javascript">
    
    function comment_editbox(clicked_id){ 
        document.getElementById('editcomment' + clicked_id).style.display='block';
        document.getElementById('showcomment' + clicked_id).style.display='none';
        document.getElementById('editsubmit' + clicked_id).style.display='block';
        
}

function comment_editbox2(clicked_id){  
        document.getElementById('editcomment2' + clicked_id).style.display='block';
        document.getElementById('showcomment2' + clicked_id).style.display='none';
        document.getElementById('editsubmit2' + clicked_id).style.display='block';
        
}
function comment_editbox3(clicked_id){  
        document.getElementById('editcomment3' + clicked_id).style.display='block';
        document.getElementById('showcomment3' + clicked_id).style.display='none';
        document.getElementById('editsubmit3' + clicked_id).style.display='block';
        
}
function comment_editbox4(clicked_id){  
        document.getElementById('editcomment4' + clicked_id).style.display='block';
        document.getElementById('showcomment4' + clicked_id).style.display='none';
        document.getElementById('editsubmit4' + clicked_id).style.display='block';
        
}

</script>

<!--comment edit box end-->

<!-- comment edit insert start -->

<script type="text/javascript">
function edit_comment(abc)
{ 

   var post_comment_edit = document.getElementById("editcomment" + abc);
   
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

                  
         document.getElementById('editcomment' + abc).style.display='none';
       document.getElementById('showcomment' + abc).style.display='block';
       document.getElementById('editsubmit' + abc).style.display='none';
                    
                    $('#' + 'showcomment' + abc).html(data);


                    
                }
            }); 
  
}
</script>


<script type="text/javascript">
function edit_comment2(abc)
{ 

   var post_comment_edit = document.getElementById("editcomment2" + abc);
 
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

                  
         document.getElementById('editcomment2' + abc).style.display='none';
       document.getElementById('showcomment2' + abc).style.display='block';
       document.getElementById('editsubmit2' + abc).style.display='none';
                    
                    $('#' + 'showcomment2' + abc).html(data);


                    
                }
            }); 
 
}
</script>
<script type="text/javascript">
function edit_comment3(abc)
{ 

   var post_comment_edit = document.getElementById("editcomment3" + abc);
 
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

                  
         document.getElementById('editcomment3' + abc).style.display='none';
       document.getElementById('showcomment3' + abc).style.display='block';
       document.getElementById('editsubmit3' + abc).style.display='none';
                    
                    $('#' + 'showcomment3' + abc).html(data);


                    
                }
            }); 
 
}
</script>
<script type="text/javascript">
function edit_comment4(abc)
{ 

   var post_comment_edit = document.getElementById("editcomment4" + abc);
 
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

                  
         document.getElementById('editcomment4' + abc).style.display='none';
       document.getElementById('showcomment4' + abc).style.display='block';
       document.getElementById('editsubmit4' + abc).style.display='none';
                    
                    $('#' + 'showcomment4' + abc).html(data);


                    
                }
            }); 
 
}
</script>


<!--comment edit insert script end -->

<!-- hide and show data start-->
<script type="text/javascript">
  function commentall(abc){ 
 

   var x = document.getElementById('threecomment'+ abc);
   var y = document.getElementById('fourcomment'+ abc);
    if (x.style.display === 'block' && y.style.display === 'none') {
        x.style.display = 'none';
        y.style.display = 'block';
 
    } else {
        x.style.display = 'block';
        y.style.display = 'none';
    }

  }
</script>


<script type="text/javascript">
  function commentall1(abc){ 
 

   var x = document.getElementById('threecomment1'+ abc);
   var y = document.getElementById('fourcomment1'+ abc);
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
     
<!-- cover image start -->
<script>
function myFunction2() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   document.getElementById('message1').style.display = "block";

   //setTimeout(function () { location.reload(1); }, 5000);
   
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
      url: "https://www.aileensoul.com/artistic/ajaxpro",
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

    $.ajax({

        url: "<?php echo base_url(); ?>artistic/image",
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
<script>
$(function() {
var showTotalChar = 270, showChar = "Further", hideChar = "less";
$('.show').each(function() {
var content = $(this).text();
if (content.length > showTotalChar) {
var con = content.substr(0, showTotalChar);
var hcon = content.substr(showTotalChar, content.length - showTotalChar);
var txt= con +  '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
$(this).html(txt);
}
});
$(".showmoretxt").click(function() {
if ($(this).hasClass("sample")) {
$(this).removeClass("sample");
$(this).text(showChar);
} else {
$(this).addClass("sample");
$(this).text(hideChar);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
</script>

<!-- remove save post start -->

<script type="text/javascript">
   function remove_post(abc)
   {  

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/art_remove_save" ?>',
                data:'save_id='+abc,
                success:function(data){ 
                
                 $('#' + 'removepostdata' + abc).html(data);
                 

                }
            }); 
        
}
</script>

<!-- remove save post end -->

<!-- remove save post start -->

<script type="text/javascript">
   function remove_ownpost(abc)
   {  

      $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/art_deletepost" ?>',
                data:'art_post_id='+abc,
                //alert(data);
                success:function(data){ 
                
                 $('#' + 'removepost' + abc).html(data);
                 

                }
            }); 
        
}
</script>

<!-- remove save post end -->
