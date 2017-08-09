<!--start head -->
<?php echo $head; ?>
<style type="text/css">
   #popup-form img{display: none;}
</style>
<!--post save success pop up style end -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.jMosaic.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- script for cropiee immage End-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);
        
       $('html,body').animate({scrollTop:265}, 100);
   
   });
   //For Scroll page at perticular position js End
</script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<!-- END HEADER -->
<?php echo $art_header2_border; ?>
<body   class="page-container-bg-solid page-boxed">
   <section class="custom-row">
      <div class="container" id="paddingtop_fixed_art">
         <div class="row" id="row1" style="display:none;">
            <div class="col-md-12 text-center">
               <div id="upload-demo"></div>
            </div>
            <div class="col-md-12 cover-pic" >
               <button class="btn btn-success cancel-result">Cancel</button>
               <button class="btn btn-success set-btn upload-result" onclick="myFunction()">Save</button>
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
                  $userid = $this->session->userdata('aileenuser');
                  if ($this->uri->segment(3) == $userid) {
                      $user_id = $userid;
                  } elseif ($this->uri->segment(3) == "") {
                      $user_id = $userid;
                  } else {
                      $user_id = $this->uri->segment(3);
                  }
                  $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                  $image = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                  
                  $image_ori = $image[0]['profile_background'];
                  if ($image_ori) {
                      ?>
               <div class="bg-images">
                  <img src="<?php echo base_url($this->config->item('art_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" />
               </div>
               <?php
                  } else {
                      ?>
               <div class="bg-images">
                  <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
               </div>
               <?php }
                  ?>
            </div>
         </div>
      </div>
      </div>
      </div>   


<div class="container tablate-container art-profile"> 
         <?php
            $userid = $this->session->userdata('aileenuser');
            if ($artisticdata[0]['user_id'] == $userid) {
                ?>     
         <div class="upload-img">
            <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
            </label>
         </div>
         <?php } ?>
            
            <div class="profile-photo">
   <div class="buisness-menu">

                    <div class="profile-pho-bui">

                        <div class="user-pic">
                  <?php if ($artisticdata[0]['art_user_image'] != '') { ?>

                   <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-user">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>
                  <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>" alt="" >

                  <?php }?>

                  <?php } else { ?>

                  <?php 
                          $a = $artisticdata[0]['art_name'];
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artisticdata[0]['art_lastname'];
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-user">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       
                  <!-- <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" /> -->


                  <?php } ?>
                  <?php
                     $userid = $this->session->userdata('aileenuser');
                     if ($artisticdata[0]['user_id'] == $userid) {
                         ?>
                  <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                  <?php } ?>
               </div>
            </div>

                          
    <div class="business-profile-right">
                        <div class="bui-menu-profile">


                            <div class="profile-left">
                            <h4 class="profile-head-text">
          <a href="<?php echo base_url('artistic/art_manage_post/' . $artisticdata[0]['user_id'] . ''); ?>"> 
          <?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?> </a>
</h4>

       <h4 class="profile-head-text_dg">
            <?php
                if ($artisticdata[0]['designation'] == '') {
                    ?>

                    <?php if ($artisticdata[0]['user_id'] == $userid) { ?>
                        <a id="designation" class="designation" title="Designation">Current Work    </a>

                    <?php } else{?>
                    <a>Current Work </a>
                    <?php }?>

                <?php } else { ?> 

                    <?php if ($artisticdata[0]['user_id'] == $userid) { ?>

                        <a id="designation" class="designation" title="<?php echo ucfirst(strtolower($artisticdata[0]['designation'])); ?>">
                            <?php echo ucfirst(strtolower($artisticdata[0]['designation'])); ?>

                        </a>

                                        <!-- <a id="myBtn"><?php echo ucwords($artisticdata[0]['designation']); ?></a> -->
                    <?php } else { ?>
                        <a><?php echo ucfirst(strtolower($artisticdata[0]['designation'])); ?></a>
                    <?php } ?>

                <?php } ?>

            </h4>
            </div>
         </div>
            <!-- PICKUP -->
            <!-- menubar -->
      <div class="business-data-menu padding_less_right ">

                            <div class="profile-main-box-buis-menu ml0"> 
             <?php 
               $userid = $this->session->userdata('aileenuser');
               if($artisticdata[0]['user_id'] == $userid){
               
               ?>     
           <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  
                     <li  class="active" <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_manage_post/' . $artisticdata[0]['user_id']); ?>"> Dashboard</a>
                     </li>
                     <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/artistic_profile/' . $artisticdata[0]['user_id']); ?>"> Details</a>
                     </li>
                     <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($artisticdata[0]['user_id'] == $userid) {
                            ?> 
                    <!--  <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/userlist'); ?>">Userlist<br> (<?php echo (count($userlistcount)); ?>)</a>
                     </li> -->
                     <?php } ?>
                     <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($artisticdata[0]['user_id'] == $userid) {
                            ?>
                     <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/followers'); ?>">Followers  <br> (<?php echo ($flucount); ?>)</a>
                     </li>
                     <?php
                        } else {
                        
                            $artregid = $artisticdata[0]['art_id'];
                            $contition_array = array('follow_to' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
                            $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


                            foreach ($followerotherdata as $followkey) {

                      $contition_array = array('art_id' => $followkey['follow_from'], 'status' => '1');
                      $artaval = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                      if($artaval){

                      $countdata[] =  $artaval;
                         }
                     }
                       $count = count($countdata);

                            ?> 
                     <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a  href="<?php echo base_url('artistic/followers/' . $artisticdata[0]['user_id']); ?>">Followers  <br> (<?php echo ($count); ?>)</a>
                     </li>
                     <?php } ?> 
                     <?php
                        if ($artisticdata[0]['user_id'] == $userid) {
                            ?>        
                     <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/following'); ?>">Following  <br> (<?php echo ($countfr); ?>)</a>
                     </li>
                     <?php
                        } else {
                        
                            $artregid = $artisticdata[0]['art_id'];
                            $contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
                            $followingotherdata = $this->data['followingotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');


                     foreach ($followingotherdata as $followkey) {

                      $contition_array = array('art_id' => $followkey['follow_to'], 'status' => '1');
                      $artaval = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                      if($artaval){

                      $countfo[] =  $artaval;
                         }
                     }
                       $countfo = count($countfo);

                       
                            ?>
                     <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a  href="<?php echo base_url('artistic/following/' . $artisticdata[0]['user_id']); ?>">Following <br>  (<?php echo ($countfo); ?>)</a>
                     </li>
                     <?php } ?>  
                  </ul>
                    <?php
                  $userid = $this->session->userdata('aileenuser');
                  if ($artisticdata[0]['user_id'] != $userid) {
                      ?>
           
                  <div class="flw_msg_btn fr">
                     <ul>
                        <li class="<?php echo "fruser" . $artisticdata[0]['art_id']; ?>">
                           <?php
                              $userid = $this->session->userdata('aileenuser');
                              
                              $contition_array = array('user_id' => $userid, 'status' => '1');
                              
                              $bup_id = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                              
                              $status = $this->db->get_where('follow', array('follow_type' => 1, 'follow_from' => $bup_id[0]['art_id'], 'follow_to' => $artisticdata[0]['art_id']))->row()->follow_status;
                              //echo "<pre>"; print_r($status); die();
                              
                              if ($status == 0 || $status == " ") {
                                  ?>
                           <div id= "followdiv">
                              <button id="<?php echo "follow" . $artisticdata[0]['art_id']; ?>" onClick="followuser(<?php echo $artisticdata[0]['art_id']; ?>)">Follow</button>
                           </div>
                           <?php } elseif ($status == 1) { ?>
                           <div id= "unfollowdiv">
                              <button class="bg_following" id="<?php echo "unfollow" . $artisticdata[0]['art_id']; ?>" onClick="unfollowuser(<?php echo $artisticdata[0]['art_id']; ?>)"> Following</button>
                           </div>
                           <?php } ?>
                        </li>
                        <li>
                           <a href="<?php echo base_url('chat/abc/' . $artisticdata[0]['user_id'].'/6/6'); ?>">Message</a>
                        </li>
                     </ul>
                  </div>
              
               <?php
                  }
                  ?>
               </div>
             
            </div>
            <!-- pickup -->
         </div>  
</div>


          
         <div class="container art-custom">
     
      </div>
      <div class=" " >
         <div class="user-midd-section grybod" >
            <div  class="col-sm-12 border_tag padding_low_data padding_les" >
               <div class="padding_less main_art" >
                  <div class="top-tab">
                     <ul class="nav nav-tabs tabs-left remove_tab">
                        <li class="active"> <a href="<?php echo base_url('artistic/art_photos/' . $artisticdata[0]['user_id']) ?>" data-toggle="tab"><i class="fa fa-camera" aria-hidden="true"></i>   Photos</a></li>
                        <li> <a href="<?php echo base_url('artistic/art_videos/' . $artisticdata[0]['user_id']) ?>" data-toggle="tab"><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</a></li>
                        <li><a href="<?php echo base_url('artistic/art_audios/' . $artisticdata[0]['user_id']) ?>" data-toggle="tab"><i class="fa fa-music" aria-hidden="true"></i>  Audio</a></li>
                        <li>    <a href="<?php echo base_url('artistic/art_pdf/' . $artisticdata[0]['user_id']) ?>" data-toggle="tab"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Pdf</a></li>
                     </ul>
                  </div>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active" id="home">
                        <div class="common-form">
                           <div class="">
                              <div class="all-box">
                                 <ul>
                                    <!-- <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li>
                                       
                                       <li>
                                       <img src="http://localhost/aileensoul/uploads/business_post/thumbs/file_1496664178_jh179.jpg">
                                       </li> -->
                                    <?php
                                       $i = 1;
                                       
                                       $allowed = array('gif', 'png', 'jpg');
                                       foreach ($artistic_data as $mke => $mval) {
                                       
                                           $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);
                                       
                                           if (in_array($ext, $allowed)) {
                                               $databus[] = $mval;
                                           }
                                       }
                                       
                                       if ($databus) {
                                           ?>
                                    <div class="pictures">
                                       <?php foreach ($databus as $data) {
                                          ?>
                                       <li>
                                          <div class="pht_ph_dash">                                                      <img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $data['image_name']) ?>" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor"/>
                                          </div>
                                       </li>
                                       <?php
                                          $i++;
                                          }
                                          ?>x
                                    </div>
                                    <?php } else { ?>
                                  <div class="art_no_pva_avl">
         <div class="art_no_post_img">
          <img src="<?php echo base_url('images/020-c.png'); ?>"  >
         </div>
         <div class="art_no_post_text1">
           No Photos Available.
         </div>
       </div>
                                    <?php }
                                       ?>
                                 </ul>
                              </div>
                              <div class="module_art_phtos">
                                 <!-- khyati changes start -->
                                 <!-- khyati changes end -->
                                 
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
      </div><script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
      </div>
      </div>
      </div>
      </div>



     <div id="myModal1" class="modal2">
                                    <div class="modal-content2">
                                       <span class="close2 cursor" onclick="closeModal()">&times;</span>
                                       <!-- khyati chnages start-->
                                       <?php
                                          $i = 1;
                                          
                                          $allowed = array('gif', 'png', 'jpg');
                                          foreach ($artistic_data as $mke => $mval) {
                                          
                                              $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);
                                          
                                              if (in_array($ext, $allowed)) {
                                                  $databus1[] = $mval;
                                              }
                                          }
                                          
                                          foreach ($databus1 as $artdata) {
                                              ?>
                                       <div class="mySlides">
                                          <div class="numbertext"><?php echo $i ?> / <?php echo count($databus1) ?></div>
                                          <div class="slider_img_p">
                                             <img src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artdata['image_name']) ?>">
                                          </div>
                                          <!-- 8-5 post art_post page data comment design start -->
                                      <!--     <div class="post-design-like-box col-md-12"> -->
                                             <!--                                                        <div class="post-design-menu">
                                                like comment div start 
                                                <ul class="col-md-6">
                                                
                                                   <li class="<?php echo 'likepostimg' . $artdata['image_id']; ?>">
                                                       <a id="<?php echo $artdata['image_id']; ?>" class="ripple like_h_w" onClick="post_likeimg(this.id)">
                                                
                                                           <?php
                                                   $userid = $this->session->userdata('aileenuser');
                                                   $contition_array = array('post_image_id' => $artdata['image_id'], 'user_id' => $userid, 'is_unlike' => 0);
                                                   
                                                   $activedata = $this->data['activedata'] = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   
                                                   if ($activedata) {
                                                       ?>
                                                               <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
                                                           <?php } else { ?>
                                                               <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                                                <?php } ?>
                                                
                                                
                                                           <span class="<?php echo 'likeimage' . $artdata['image_id']; ?>"> <?php
                                                   $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => 0);
                                                   $likecount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   
                                                   //                                                                            if ($likecount) {
                                                   //                                                                                echo count($likecount);
                                                   //                                                                            }
                                                   //                                                                            ?>
                                                
                                                           </span>
                                                       </a>
                                                   </li>
                                                   <li id="<?php echo "insertcountimg" . $artdata['image_id']; ?>" style="visibility:show">
                                                
                                                       <?php
                                                   $contition_array = array('post_image_id' => $artdata['image_id'], 'is_delete' => '0');
                                                   $commnetcount = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   //  echo '<pre>'; print_r($commnetcount);
                                                   ?>
                                                
                                                       <a onClick="commentallimg(this.id)" id="<?php echo $artdata['image_id']; ?>">
                                                           <i class="fa fa-comment-o" aria-hidden="true">
                                                               <?php
                                                   //                                                                            if (count($commnetcount) > 0) {
                                                   //                                                                                echo count($commnetcount);
                                                   //                                                                            }
                                                                                                                               ?>
                                                           </i> 
                                                       </a>
                                                   </li>
                                                </ul>
                                                
                                                <ul class="col-md-6 like_cmnt_count">
                                                
                                                <li>
                                                   <div class="like_cmmt_space like_count_ext_img<?php echo $artdata['image_id']; ?>">
                                                       <span class="comment_count" > 
                                                           <?php
                                                   if (count($commnetcount) > 0) {
                                                       echo count($commnetcount); ?>
                                                                
                                                           </span> 
                                                       <span> Comment</span>
                                                                   <?php }
                                                   ?> 
                                                   </div>
                                                </li>
                                                
                                                <li>
                                                   <div class="<?php echo 'comnt_count_ext_img' . $artdata['image_id']; ?>">
                                                       <span class="comment_like_count"> 
                                                          <?php
                                                   if (count($likecount) > 0) { 
                                                       echo count($likecount); ?>
                                                      </span> 
                                                       <span> Like</span>
                                                   <?php  }
                                                   ?> 
                                                      
                                                   </div>
                                                </li>
                                                </ul>
                                                like comment div end 
                                                </div>-->
                                         <!--  </div> -->
                                          <!-- like user list start -->
                                          <!-- pop up box start-->
                                          <?php
                                             //                                                    $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => '0');
                                             //                                                    $commnetlike = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             //                                                   // if (count($commnetlike) > 0) {
                                                                                                     ?>
                                          <div class="likeduserlistimg<?php echo $artdata['image_id']; ?>">
                                             <!--                                                            <?php
                                                $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                // echo '<pre>'; print_r($commnetcount);
                                                //                                                            foreach ($commnetcount as $comment) {
                                                //                                                                $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
                                                //                                                                $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_lastname;
                                                //                                                                ?>
                                                <?php //} ?>
                                                pop up box end
                                                <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $artdata['image_id']; ?>);">
                                                <?php
                                                   //                                                                $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => '0');
                                                   //                                                                $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = 'post_image_like_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   //
                                                   //
                                                   //                                                                $art_fname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_name;
                                                   //                                                                $art_lname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_lastname;
                                                   //                                                                ?>
                                                <div class="like_one_other">
                                                    <?php
                                                   //                                                                    if ($userid == $commnetcount[0]['user_id']) {
                                                   //
                                                   //                                                                        echo "You";
                                                   //                                                                    } else {
                                                   //                                                                        echo ucwords($art_fname);
                                                   //                                                                        echo "&nbsp;";
                                                   //                                                                        echo ucwords($art_lname);
                                                   //                                                                        echo "&nbsp;";
                                                   //                                                                    }
                                                                                                                       ?>
                                                    <?php
                                                   //                                                                    if (count($commnetcount) > 1) {
                                                   //                                                                        echo "and ";
                                                   //                                                                        echo '' . count($commnetcount) - 1 . '';
                                                   //                                                                        echo "&nbsp;";
                                                   //                                                                        echo "others";
                                                   //                                                                    }
                                                                                                                       ?>
                                                </div>
                                                </a>-->
                                          </div>
                                          <?php
                                             //    }
                                                 ?>
                                          <div class="<?php echo "likeusernameimg" . $artdata['image_id']; ?>" id="<?php echo "likeusernameimg" . $artdata['image_id']; ?>" style="display:none">
                                             <?php
                                                $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = 'post_image_like_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                // echo '<pre>'; print_r($commnetcount);
                                                foreach ($commnetcount as $comment) {
                                                    $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_name;
                                                    $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $comment['user_id'], 'status' => 1))->row()->art_lastname;
                                                    ?>
                                             <?php } ?>
                                             <!-- pop up box end-->
                                             <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $artdata['image_id']; ?>);">
                                                <?php
                                                   $contition_array = array('post_image_id' => $artdata['image_id'], 'is_unlike' => '0');
                                                   $commnetcount = $this->common->select_data_by_condition('art_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   
                                                   
                                                   $art_fname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_name;
                                                   $art_lname = $this->db->get_where('art_reg', array('user_id' => $commnetcount[0]['user_id'], 'status' => 1))->row()->art_lastname;
                                                   ?>
                                                <div class="like_one_other">
                                                   <?php
                                                      echo ucfirst(strtolower($art_fname));
                                                      echo "&nbsp;";
                                                      echo ucfirst(strtolower($art_lname));
                                                      echo "&nbsp;";
                                                      ?>
                                                   <?php
                                                      if (count($commnetcount) > 1) {
                                                          echo "and ";
                                                          echo '' . count($commnetcount) - 1 . '';
                                                          echo "&nbsp;";
                                                          echo "others";
                                                      }
                                                      ?>
                                                </div>
                                             </a>
                                          </div>
                                          <!-- like user list end -->
                                          <!--<div class="art-all-comment col-md-12">-->
                                          <!-- 18-4 all comment start-->
                                          <!--                                                        <div id="<?php echo "fourcommentimg" . $artdata['image_id']; ?>" style="display:none">
                                             </div>
                                             
                                              khyati changes start 
                                             
                                             <div  id="<?php echo "threecommentimg" . $artdata['image_id']; ?>" style="display:block">
                                                 <div class="<?php echo 'insertcommentimg' . $artdata['image_id']; ?>">
                                                     <?php
                                                $contition_array = array('post_image_id' => $artdata['image_id'], 'is_delete' => '0');
                                                $artmulimage = $this->common->select_data_by_condition('art_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                if ($artmulimage) {
                                                    foreach ($artmulimage as $rowdata) {
                                                        $companyname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_name;
                                                        ?>
                                                             <div class="all-comment-comment-box">
                                                                 <div class="post-design-pro-comment-img"> 
                                                                     <?php
                                                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                                                ?>
                                                                     <a href="<?php echo base_url('artistic/art_manage_post/' . $rowdata['user_id'] . ''); ?>">
                                                                         <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>"  alt="">
                                                                     </a>
                                                                 </div>
                                                                 <div class="comment-name">
                                                                     <b>  <?php
                                                echo ucwords($companyname);
                                                echo '</br>';
                                                ?>
                                                                     </b>
                                                                 </div>
                                             
                                                                 <div class="comment-details" id= "<?php echo "showcommentimg" . $rowdata['post_image_comment_id']; ?>">
                                                                     <?php
                                                echo $this->common->make_links($rowdata['comment']);
                                                echo '</br>';
                                                ?>
                                                                 </div>
                                             
                                                                 <div class="edit-comment-box">
                                                                     <div class="inputtype-edit-comment">
                                                                         <div contenteditable="true"  class="editable_text edit_cpmment_edit dis-n" name="<?php echo $rowdata['post_image_comment_id']; ?>"  id="editcommentimg<?php echo $rowdata['post_image_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commenteditimg(<?php echo $rowdata['post_image_comment_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $rowdata['comment']; ?></div>
                                                                         <span class="comment-edit-button"><button class="save_photos_a" id="<?php echo "editsubmitimg" . $rowdata['post_image_comment_id']; ?>" style="display:none" onClick="edit_commentimg(<?php echo $rowdata['post_image_comment_id']; ?>)">Save</button></span>
                                                                     </div>
                                                                 </div>
                                             
                                             
                                             
                                                                 <div class="art-comment-menu-design"> 
                                                                     <div class="comment-details-menu" id="<?php echo 'likecommentimg' . $rowdata['post_image_comment_id']; ?>">
                                                                         <a id="<?php echo $rowdata['post_image_comment_id']; ?>"   onClick="comment_likeimg(this.id)">
                                             
                                                                             <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);
                                                
                                                $artcommentlike1 = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                if (count($artcommentlike1) == 0) {
                                                    ?>
                                                                                 <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                                             
                                                                             <?php } else { ?>
                                                                                 <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
                                             <?php } ?>
                                                                             <span>
                                             
                                                                                 <?php
                                                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
                                                $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('art_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                
                                                if (count($mulcountlike) > 0) {
                                                    echo count($mulcountlike);
                                                }
                                                ?>
                                             
                                                                             </span>
                                                                         </a>
                                                                     </div>
                                             
                                             
                                                                     <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                
                                                if ($rowdata['user_id'] == $userid) {
                                                    ?> 
                                             
                                                                         <span role="presentation" aria-hidden="true"> · </span>
                                                                         <div class="comment-details-menu">
                                                                             <div id="<?php echo 'editcommentboximg' . $rowdata['post_image_comment_id']; ?>" style="display:block;">
                                                                                 <a id="<?php echo $rowdata['post_image_comment_id']; ?>" onClick="comment_editboximg(this.id)" class="editbox">Edit
                                                                                 </a>
                                                                             </div>
                                                                             <div id="<?php echo 'editcancleimg' . $rowdata['post_image_comment_id']; ?>" style="display:none;">
                                                                                 <a id="<?php echo $rowdata['post_image_comment_id']; ?>" onClick="comment_editcancleimg(this.id)">Cancel
                                                                                 </a>
                                                                             </div>
                                                                         </div>
                                                                     <?php } ?>
                                             
                                                                     <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                
                                                $business_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['post_image_id'], 'status' => 1))->row()->user_id;
                                                
                                                
                                                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                                                    ?> 
                                                                         <span role="presentation" aria-hidden="true"> · </span>
                                                                         <div class="comment-details-menu">
                                                                             <input type="hidden" name="post_deleteimg"  id="post_deleteimg" value= "<?php echo $rowdata['post_image_id']; ?>">
                                                                             <a id="<?php echo $rowdata['post_image_comment_id']; ?>"   onClick="comment_deleteimg(this.id)"> Delete<span class="<?php echo 'insertcommentimg' . $rowdata['post_image_comment_id']; ?>">
                                                                                 </span>
                                                                             </a>
                                                                         </div>
                                             <?php } ?>
                                             
                                                                     <span role="presentation" aria-hidden="true"> · </span>
                                             
                                                                     <div class="comment-details-menu">
                                                                         <p> <?php
                                                echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                                echo '</br>';
                                                ?>
                                                                         </p></div></div>
                                                             </div>
                                                             <?php
                                                }
                                                }
                                                ?>
                                             
                                                 </div>
                                             </div>-->
                                          <!-- khyati changes end -->
                                          <!-- all comment end-->
                                          <!--</div>-->
                                          <?php //  }    ?>
                                          <!--<div class="post-design-commnet-box col-md-12">-->
                                          <!--                                                        <?php
                                             //      $userid = $this->session->userdata('aileenuser');
                                             //        $art_userimage = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_user_image;
                                                   ?>
                                             <div class="post-design-proo-img">
                                                 <?php //if ($art_userimage) { ?>
                                                     <img src="<?php// echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>" name="image_src" id="image_src" />
                                                     <?php
                                                //      } else {
                                                          ?>
                                                     <img src="<?php// echo base_url(NOIMAGE); ?>" alt="No Image">
                                                     <?php
                                                //       }
                                                       ?>
                                             </div>
                                             <div class="">
                                                 <div id="content" class="col-md-10 inputtype-comment" style="padding-left: 7px !important;">
                                                     <div contenteditable="true" style="min-height:37px !important; margin-top: 0px!important" class="editable_text" name="<?php echo $artdata['image_id']; ?>"  id="<?php echo "post_commentimg" . $artdata['image_id']; ?>" placeholder="Type Message ..." onkeyup="entercommentimg(<?php echo $artdata['image_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>
                                                 </div>
                                             <?php// echo form_error('post_commentimg'); ?>
                                                 <div class=" comment-edit-butn">   
                                                     <button id="<?php //echo $artdata['image_id']; ?>" onClick="insert_commentimg(this.id)">Comment</button> 
                                                 </div>
                                             </div>-->
                                          <!--</div>-->
                                          <!-- 8-5 comment design end -->
                                       </div>
                                       <?php
                                          $i++;
                                          }
                                          ?>
                                       <!-- khyati chnages end-->
                                       <a class="prev" style="left:0px;" onclick="plusSlides(-1)">&#10094;</a>
                                       <a class="next" onclick="plusSlides(1)">&#10095;</a>
                                    </div>
                                    <div class="caption-container">
                                       <p id="caption"></p>
                                    </div>
                                    <div>
                                    </div>
                                 </div>
      


   </section>

<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
   <div class="modal-dialog modal-lm">
      <div class="modal-content">
         <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
         <div class="modal-body">
            <span class="mes">
               <div id="popup-form">
                  <?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                  <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                  <input type="hidden" name="hitext" id="hitext" value="9">
                  <div class="popup_previred">
                     <img id="preview" src="#" alt="your image" />
                  </div>
                  <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                  <?php echo form_close(); ?>
               </div>
            </span>
         </div>
      </div>
   </div>
</div>
<!-- Model Popup Close -->
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
<!-- Model Popup Close -->
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="likeusermodal" role="dialog">
   <div class="modal-dialog modal-lm">
      <div class="modal-content">
         <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
         <div class="modal-body">
            <span class="mes">
            </span>
         </div>
      </div>
   </div>
</div>
<!-- Model Popup Close -->
<footer>
<?php echo $footer; ?>
        </footer>

        
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<!--<script src="<?php //echo base_url('js/jquery.jMosaic.js');  ?>"></script>-->


<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<!-- designation script start -->
<script type="text/javascript">
   function divClicked() {
       var divHtml = $(this).html();
        divHtml = divHtml.trim();
       var editableText = $("<textarea />");
       editableText.val(divHtml);
       $(this).replaceWith(editableText);
       editableText.focus();
       // setup the blur event for this new textarea
       editableText.blur(editableTextBlurred);
   }
   
   function editableTextBlurred() {
      
      var html = $(this).val();
      html = html.trim();
       var viewableText = $("<a>");
      
       if (html.match(/^\s*$/) || html == '') { 
       html = "Current Work";
       } 
       
       viewableText.html(html);
       $(this).replaceWith(viewableText);
       // setup the click event for this new div
       viewableText.click(divClicked);
   
       $.ajax({
           url: "<?php echo base_url(); ?>artistic/art_designation",
           type: "POST",
           data: {"designation": html},
           success: function (response) {
   
           }
       });
   }
   
   $(document).ready(function () {
   //alert("hi");
       $("a.designation").click(divClicked);
   });
</script>
<!-- designation script end -->
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
   
   
   
   $(document).on('keydown', function (e) {
       if (e.keyCode === 27) {
           $("#myModal1").hide();
       }
   });
</script>


<script>
   var data = <?php echo json_encode($demo); ?>;
   // alert(data);
   
   
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
<script>
   var data1 = <?php echo json_encode($de); ?>;
   // alert(data);
   
   
   $(function () {
       // alert('hi');
       $("#searchplace").autocomplete({
           source: function (request, response) {
               var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
               response($.grep(data1, function (item) {
                   return matcher.test(item.label);
               }));
           },
           minLength: 1,
           select: function (event, ui) {
               event.preventDefault();
               $("#searchplace").val(ui.item.label);
               $("#selected-tag").val(ui.item.label);
               // window.location.href = ui.item.value;
           }
           ,
           focus: function (event, ui) {
               event.preventDefault();
               $("#searchplace").val(ui.item.label);
           }
       });
   });
   
</script>

<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($city_data); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
});
  
</script>
<script type="text/javascript">
   function checkvalue() {
       //alert("hi");
       var searchkeyword =$.trim(document.getElementById('tags').value);
       var searchplace =$.trim(document.getElementById('searchplace').value);
       // alert(searchkeyword);
       // alert(searchplace);
       if (searchkeyword == "" && searchplace == "") {
           //alert('Please enter Keyword');
           return false;
       }
   }
</script>

<script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>
<!-- <script>
   //select2 autocomplete start for skill
   
   //select2 autocomplete start for Location
       $('#searchplace').select2({
   
           placeholder: 'Find Your Location',
           maximumSelectionLength: 1,
           ajax: {
   
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
   
   
   </script> -->
<script type="text/javascript">
   //For blocks or images of size, you can use $(document).ready
   $(document).ready(function () {
       $('.blocks').jMosaic({items_type: "li", margin: 0});
       $('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
   });
   
   //If this image without attribute WIDTH or HEIGH, you can use $(window).load
   $(window).load(function () {
       //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
   });
   
   //You can update on $(window).resize
   $(window).resize(function () {
       //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
       //$('.blocks').jMosaic({items_type: "li", margin: 0});
   });
</script>
<script>
   function openModal() {
       document.getElementById('myModal1').style.display = "block";
   }
   
   function closeModal() {
       document.getElementById('myModal1').style.display = "none";
   }
   
   var slideIndex = 1;
   showSlides(slideIndex);
   
   function plusSlides(n) {
       showSlides(slideIndex += n);
   }
   
   function currentSlide(n) {
       showSlides(slideIndex = n);
   }
   
   function showSlides(n) {
       var i;
       var slides = document.getElementsByClassName("mySlides");
       var dots = document.getElementsByClassName("demo");
       var captionText = document.getElementById("caption");
       if (n > slides.length) {
           slideIndex = 1
       }
       if (n < 1) {
           slideIndex = slides.length
       }
       for (i = 0; i < slides.length; i++) {
           slides[i].style.display = "none";
       }
       for (i = 0; i < dots.length; i++) {
           dots[i].className = dots[i].className.replace(" active", "");
       }
       slides[slideIndex - 1].style.display = "block";
       dots[slideIndex - 1].className += " active";
       captionText.innerHTML = dots[slideIndex - 1].alt;
   }
</script>
<!-- images like script start -->
<script type="text/javascript">
   function mulimg_like(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/mulimg_like" ?>',
           data: 'post_image_id=' + clicked_id,
           success: function (data) {
               $('.' + 'likepost' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!--images like script end -->
<!-- hide and show data start-->
<script type="text/javascript">
   function commentall(clicked_id) {
   
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
       var z = document.getElementById('insertcountimg' + clicked_id);
   
   
   
       if (x.style.display === 'block' && y.style.display === 'none') {
   
           x.style.display = 'none';
           y.style.display = 'block';
           z.style.display = 'none';
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/multifourcomment" ?>',
               data: 'art_post_id=' + clicked_id,
               //alert(data);
               success: function (data) {
                   $('#' + 'fourcomment' + clicked_id).html(data);
   
               }
           });
   
       }
   
   }
</script>
<!-- hide and show data end-->
<!-- insert comment using enter -->
<script type="text/javascript">
   function insert_commentimg(clicked_id)
   {
       // start khyati code
       var $field = $('#post_commentimg' + clicked_id);
       //var data = $field.val();
       var post_commentimg = $('#post_commentimg' + clicked_id).html();
   // end khyati code
   
   
   
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
   
       if (post_commentimg == '') {
           event.preventDefault();
           return false;
       } else {
   
   
           if (x.style.display === 'block' && y.style.display === 'none') {
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/mulimg_commentthree" ?>',
                   data: 'post_image_id=' + clicked_id + '&comment=' + post_comment,
                   dataType: "json",
                   success: function (data) {
                       $('#post_comment' + clicked_id).html("");
   
                       //  $('.insertcomment' + clicked_id).html(data);
                       $('#' + 'insertcountimg' + clicked_id).html(data.count);
                       $('.insertcomment' + clicked_id).html(data.comment);
   
                   }
               });
   
           } else {
   
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/mulimg_comment" ?>',
                   data: 'post_image_id=' + clicked_id + '&comment=' + post_comment,
                   // dataType: "json",
                   success: function (data) {
   
                       $('#post_comment' + clicked_id).html("");
   
                       $('#' + 'fourcomment' + clicked_id).html(data);
                       // $('#' + 'commnetpost' + clicked_id).html(data.count);
                       //  $('#' + 'fourcomment' + clicked_id).html(data.comment);
   
                   }
               });
           }
       }
   }
   
</script>
<script type="text/javascript">
   function entercomment(clicked_id) {
   
   
   //var $field = $('#post_comment' + clicked_id);
       //var data = $field.val();
       // var post_comment = $('#post_comment' + clicked_id).html();
   
       //$(document).ready(function($) {
   //        alert("#post_commentimg" + clicked_id);
   //        return false;
       $("#post_commentimg" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
   
       $("#post_commentimg" + clicked_id).keypress(function (event) { //alert(post_comment);
           if (event.which == 13 && event.shiftKey != 1) { //alert(post_comment);
               event.preventDefault();
               var sel = $("#post_commentimg" + clicked_id);
               var txt = sel.html();
   
               $('#post_commentimg' + clicked_id).html("");
               // $("#result").html(txt);
               // sel.html("")
               // sel.blur();
               //alert('.insertcomment' + clicked_id);
   
               var x = document.getElementById('threecomment' + clicked_id);
               var y = document.getElementById('fourcomment' + clicked_id);
   
   
               if (txt == '') {
   
                   event.preventDefault();
                   return false;
               } else {
                   if (x.style.display === 'block' && y.style.display === 'none') {
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/mulimg_commentthree" ?>',
                           data: 'post_image_id=' + clicked_id + '&comment=' + txt,
                           dataType: "json",
                           success: function (data) {
   
                               //  $('.insertcomment' + clicked_id).html(data);
                               $('#' + 'insertcountimg' + clicked_id).html(data.count);
                               $('.insertcomment' + clicked_id).html(data.comment);
   
                           }
                       });
   
                   } else {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/mulimg_comment" ?>',
                           data: 'post_id=' + clicked_id + '&comment=' + txt,
                           // dataType: "json",
                           success: function (data) {
                               $('#' + 'fourcomment' + clicked_id).html(data);
                               // $('#' + 'commnetpost' + clicked_id).html(data.count);
                               //  $('#' + 'fourcomment' + clicked_id).html(data.comment);
   
                           }
                       });
                   }
               }
   
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   
       // });
   
   }
</script>
<!-- insert comment end -->
<!-- comment like script start -->
<script type="text/javascript">
   function comment_like(clicked_id)
   {
       //alert(clicked_id);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/mulimg_comment_like" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) { //alert(data);
               $('#' + 'likecomment' + clicked_id).html(data);
   
           }
       });
   }
   
   
   function comment_liketwo(clicked_id)
   {
       //alert(clicked_id);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/mulimg_comment_like1" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) { //alert(data);
               $('#' + 'likecommentone' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!-- comment like script end -->
<!-- comment edit insert start -->
<script type="text/javascript">
   function edit_comment(abc)
   { //alert('editsubmit' + abc);
   
       //var post_comment_edit = document.getElementById("editcomment" + abc);
   
       // start khyati code
       var $field = $('#editcomment' + abc);
       //var data = $field.val();
       var post_comment_edit = $('#editcomment' + abc).html();
   // end khyati code
   
   
       if (post_comment_edit == '') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
   
       } else {
   
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/mul_edit_com_insert" ?>',
               data: 'post_image_comment_id=' + abc + '&comment=' + post_comment_edit,
               success: function (data) { //alert('falguni');
   
                   //  $('input').each(function(){
                   //     $(this).val('');
                   // }); 
                   document.getElementById('editcomment' + abc).style.display = 'none';
                   document.getElementById('showcomment' + abc).style.display = 'block';
                   document.getElementById('editsubmit' + abc).style.display = 'none';
   
                   document.getElementById('editcommentbox' + abc).style.display = 'block';
                   document.getElementById('editcancle' + abc).style.display = 'none';
                   //alert('.' + 'showcomment' + abc);
                   $('#' + 'showcomment' + abc).html(data);
   
   
   
               }
           });
       }
       //window.location.reload();
   }
</script>
<script type="text/javascript">
   function commentedit(abc) {
   
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
   
       $("#editcomment" + abc).keypress(function (event) { //alert(post_comment);
           if (event.which == 13 && event.shiftKey != 1) { //alert(post_comment);
               event.preventDefault();
               var sel = $("#editcomment" + abc);
               var txt = sel.html();
   
   
   
   
   
               if (txt == '') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
   
               } else {
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/mul_edit_com_insert" ?>',
                       data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                       // dataType: "json",
                       success: function (data) {
   
                           $('#editcomment' + abc).html("");
   
                           document.getElementById('editcomment' + abc).style.display = 'none';
                           document.getElementById('showcomment' + abc).style.display = 'block';
                           document.getElementById('editsubmit' + abc).style.display = 'none';
   
                           document.getElementById('editcommentbox' + abc).style.display = 'block';
                           document.getElementById('editcancle' + abc).style.display = 'none';
                           //alert('.' + 'showcomment' + abc);
                           $('#' + 'showcomment' + abc).html(data);
                       }
                   });
               }
   
   
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   
       // });
   
   }
</script>
<script type="text/javascript">
   function edit_commenttwo(abc)
   { //alert('editsubmit' + abc);
   
       //var post_comment_edit = document.getElementById("editcommenttwo" + abc);
   
       // start khyati code
       var $field = $('#editcommenttwo' + abc);
       //var data = $field.val();
       var post_comment_edit = $('#editcommenttwo' + abc).html();
   // end khyati code
   
       if (post_comment_edit == '') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
   
       } else {
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/mul_edit_com_insert" ?>',
               data: 'post_image_comment_id=' + abc + '&comment=' + post_comment_edit,
               success: function (data) { //alert('falguni');
   
                   //  $('input').each(function(){
                   //     $(this).val('');
                   // }); 
                   document.getElementById('editcommenttwo' + abc).style.display = 'none';
                   document.getElementById('showcommenttwo' + abc).style.display = 'block';
                   document.getElementById('editsubmittwo' + abc).style.display = 'none';
   
                   document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                   document.getElementById('editcancletwo' + abc).style.display = 'none';
                   //alert('.' + 'showcomment' + abc);
                   $('#' + 'showcommenttwo' + abc).html(data);
   
   
   
               }
           });
       }
   
   }
</script>
<script type="text/javascript">
   function commentedittwo(abc)
   {
   
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
       $('#editcommenttwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
   
               e.preventDefault();
               var sel = $("#editcomment" + abc);
               var txt = sel.html();
   
               $('#editcommenttwo' + abc).html("");
   
   
               if (txt == '') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
   
               } else {
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/mul_edit_com_insert" ?>',
                       data: 'post_image_comment_id=' + abc + '&comment=' + val,
                       success: function (data) { //alert('falguni');
   
                           //  $('input').each(function(){
                           //     $(this).val('');
                           // }); 
                           document.getElementById('editcommenttwo' + abc).style.display = 'none';
                           document.getElementById('showcommenttwo' + abc).style.display = 'block';
                           document.getElementById('editsubmittwo' + abc).style.display = 'none';
   
                           document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                           document.getElementById('editcancletwo' + abc).style.display = 'none';
                           //alert('.' + 'showcomment' + abc);
                           $('#' + 'showcommenttwo' + abc).html(data);
   
                       }
                   });
               }
   
               //alert(val);
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   
   
   }
</script>
<!-- comment edit insert end -->
<!-- comment edit box start-->
<script type="text/javascript">
   function comment_editbox(clicked_id) {
       document.getElementById('editcomment' + clicked_id).style.display = 'block';
       document.getElementById('showcomment' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit' + clicked_id).style.display = 'block';
   
   
       document.getElementById('editcommentbox' + clicked_id).style.display = 'none';
       document.getElementById('editcancle' + clicked_id).style.display = 'block';
   
   
   }
   
   
   function comment_editcancle(clicked_id) {
   
       document.getElementById('editcommentbox' + clicked_id).style.display = 'block';
       document.getElementById('editcancle' + clicked_id).style.display = 'none';
   
       document.getElementById('editcomment' + clicked_id).style.display = 'none';
       document.getElementById('showcomment' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit' + clicked_id).style.display = 'none';
   
   }
   
   function comment_editboxtwo(clicked_id) {  //alert('editsubmit2' + clicked_id);
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'block';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'block';
   
   
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'none';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'block';
   
   }
   
   function comment_editcancletwo(clicked_id) {
   
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'block';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'none';
   
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'block';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'none';
   
   }
   
</script>
<!-- comment edit box end -->
<!-- comment delete start -->
<script type="text/javascript">
   function comment_deletemodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Are you sure want to Delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function comment_deletetwomodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Are you sure want to Delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function comment_delete(clicked_id)
   {
   
       var post_delete = document.getElementById("post_delete" + clicked_id);
       //alert('.insertcomment' + post_delete.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/mul_delete_comment" ?>',
           dataType: "json",
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete.value,
           success: function (data) {
   
               $('#' + 'insertcountimg' + post_delete.value).html(data.count);
               $('.insertcomment' + post_delete.value).html(data.comment);
   
           }
       });
   }
   
   function comment_deletetwo(clicked_id)
   {
   
       var post_deleteone = document.getElementById("post_deletetwo" + clicked_id);
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/mul_delete_commenttwo" ?>',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_deleteone.value,
           success: function (data) {
   
   
               $('#' + 'fourcomment' + post_deleteone.value).html(data);
               //$('.' + 'insertcommenttwo' + post_deleteone.value).html(data);
   
           }
       });
   }
</script>
<!-- commenmt delete end -->
<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
   function updateprofilepopup(id) {
       $('#bidmodal-2').modal('show');
   }
</script>
<!-- cover image start -->
<script>
   function myFunction() {
       document.getElementById("upload-demo").style.visibility = "hidden";
       document.getElementById("upload-demo-i").style.visibility = "hidden";
       document.getElementById('message1').style.display = "block";
   
       // setTimeout(function () { location.reload(1); }, 9000);
   
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
               url: "<?php echo base_url() ?>artistic/ajaxpro",
               type: "POST",
               data: {"image": resp},
               success: function (data) {
                   html = '<img src="' + resp + '" />';
                   if (html) {
                       window.location.reload();
                   }
                   //  $("#kkk").html(html);
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
   
   
       var reader = new FileReader();
       //alert(reader);
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
   
       //alert(size);
   
   
   // pallavi code start for file type support
   if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
   //alert('not an image');
   picpopup();
   
   document.getElementById('row1').style.display = "none";
   document.getElementById('row2').style.display = "block";

   $("#upload").val('');
   return false;
   }
   // file type code end
   
       if (size > 10485760)
       {
           //show an alert to the user
           alert("Allowed file size exceeded. (Max. 10 MB)")
   
           document.getElementById('row1').style.display = "none";
           document.getElementById('row2').style.display = "block";
   
           // window.location.href = "https://www.aileensoul.com/dashboard"
           //reset file upload control
           return false;
       }
   
       $.ajax({
   
           url: "<?php echo base_url(); ?>artistic/image",
           type: "POST",
           data: fd,
           processData: false,
           contentType: false,
           success: function (response) {
               //alert(response);
   
           }
       });
   });
   
   //aarati code end
</script>
<!-- cover image end -->
<!-- 9-5 khyati image script  start --> 
<script type="text/javascript">
   function post_likeimg(clicked_id)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_postimg" ?>',
           dataType: 'json',
           data: 'post_image_id=' + clicked_id,
           success: function (data) {
               $('.' + 'likepostimg' + clicked_id).html(data.like);
               $('.likeusernameimg' + clicked_id).html(data.likeuser);
   
               $('.likeduserlistimg' + clicked_id).hide();
               if (data.like_user_count == '0') {
                   document.getElementById('likeusernameimg' + clicked_id).style.display = "none";
               } else {
                   document.getElementById('likeusernameimg' + clicked_id).style.display = "block";
               }
               $('#likeusernameimg' + clicked_id).addClass('likeduserlistimg1');
           }
       });
   }
   
   
   function comment_likeimg(clicked_id)
   {// alert("hi");
       //  alert(clicked_id);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_commentimg1" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecommentimg' + clicked_id).html(data);
   
           }
       });
   }
   function comment_likeimgtwo(clicked_id)
   {// alert("hi");
       //  alert(clicked_id);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_commentimg1" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecommentimg' + clicked_id).html(data);
   
           }
       });
   }
   
   function comment_editboximg(clicked_id) {
       document.getElementById('editcommentimg' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcommentimg' + clicked_id).style.display = 'none';
       document.getElementById('editsubmitimg' + clicked_id).style.display = 'inline-block';
       //document.getElementById('editbox' + clicked_id).style.display = 'none';
       document.getElementById('editcommentboximg' + clicked_id).style.display = 'none';
       document.getElementById('editcancleimg' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancleimg(clicked_id) {
       document.getElementById('editcommentboximg' + clicked_id).style.display = 'block';
       document.getElementById('editcancleimg' + clicked_id).style.display = 'none';
       document.getElementById('editcommentimg' + clicked_id).style.display = 'none';
       document.getElementById('showcommentimg' + clicked_id).style.display = 'block';
       document.getElementById('editsubmitimg' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   }
   
   function comment_editboximgtwo(clicked_id) {
   //                            alert('editcommentboxtwo' + clicked_id);
   //                            return false;
       $('div[id^=editcommentimgtwo]').css('display', 'none');
       $('div[id^=showcommentimgtwo]').css('display', 'block');
       $('button[id^=editsubmitimgtwo]').css('display', 'none');
       $('div[id^=editcommentboximgtwo]').css('display', 'block');
       $('div[id^=editcancleimgtwo]').css('display', 'none');
   
       document.getElementById('editcommentimgtwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcommentimgtwo' + clicked_id).style.display = 'none';
       document.getElementById('editsubmitimgtwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('editcommentboximgtwo' + clicked_id).style.display = 'none';
       document.getElementById('editcancleimgtwo' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancleimgtwo(clicked_id) {
   
       document.getElementById('editcommentboximgtwo' + clicked_id).style.display = 'block';
       document.getElementById('editcancleimgtwo' + clicked_id).style.display = 'none';
   
       document.getElementById('editcommentimgtwo' + clicked_id).style.display = 'none';
       document.getElementById('showcommentimgtwo' + clicked_id).style.display = 'block';
       document.getElementById('editsubmitimgtwo' + clicked_id).style.display = 'none';
       $('.post-design-commnet-box').show();
   }
   
   function comment_deleteimg(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedimg(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   function comment_deletedimg(clicked_id)
   {
       var post_delete = document.getElementById("post_deleteimg");
       alert(post_delete.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_commentimg" ?>',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete.value,
           dataType: "json",
           success: function (data) {
               //alert('.' + 'insertcomment' + clicked_id);
               $('.' + 'insertcommentimg' + post_delete.value).html(data.comment);
            //   $('#' + 'insertcountimg' + post_delete.value).html(data.count);
                 $('.like_count_ext_img' + post_delete.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
           }
       });
   }
   function entercommentimg(clicked_id)
   {
       $("#post_commentimg" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#post_commentimg' + clicked_id).keypress(function (e) {
   
           if (e.keyCode == 13 && !e.shiftKey) {
               e.preventDefault();
               var sel = $("#post_commentimg" + clicked_id);
               var txt = sel.html();
               if (txt == '') {
                   return false;
               }
               $('#post_commentimg' + clicked_id).html("");
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               var x = document.getElementById('threecommentimg' + clicked_id);
               var y = document.getElementById('fourcommentimg' + clicked_id);
   
   
   
               if (x.style.display === 'block' && y.style.display === 'none') {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_commentthreeimg" ?>',
                       data: 'post_image_id=' + clicked_id + '&comment=' + txt,
                       dataType: "json",
                       success: function (data) {
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                     //      $('#' + 'insertcountimg' + clicked_id).html(data.count);
                           $('.insertcommentimg' + clicked_id).html(data.comment);
                           $('.like_count_ext_img' + clicked_id).html(data.commentcount);
   
                       }
                   });
   
               } else {
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_commentimg" ?>',
                       data: 'post_image_id=' + clicked_id + '&comment=' + txt,
                       dataType: "json",
                       success: function (data) {
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                         //  $('#' + 'insertcountimg' + clicked_id).html(data.count);
                           $('#' + 'fourcommentimg' + clicked_id).html(data.comment);
                           $('.like_count_ext_img' + clicked_id).html(data.commentcount);
   
                   }
                   });
               }
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
   
   function insert_commentimg(clicked_id)
   {
       $("#post_commentimg" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
       var sel = $("#post_commentimg" + clicked_id);
       var txt = sel.html();
       if (txt == '') {
           return false;
       }
   
       $('#post_commentimg' + clicked_id).html("");
   
       var x = document.getElementById('threecommentimg' + clicked_id);
       var y = document.getElementById('fourcommentimg' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_commentthreeimg" ?>',
               data: 'post_image_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
               //    $('#' + 'insertcountimg' + clicked_id).html(data.count);
                   $('.insertcommentimg' + clicked_id).html(data.comment);
                   $('.like_count_ext_img' + clicked_id).html(data.commentcount);
   
               }
           });
   
       } else {
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_commentimg" ?>',
               data: 'post_image_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
                 //  $('#' + 'insertcountimg' + clicked_id).html(data.count);
                   $('#' + 'fourcommentimg' + clicked_id).html(data.comment);
                   $('.like_count_ext_img' + clicked_id).html(data.commentcount);
               }
           });
       }
   }
   
   function edit_commentimg(abc)
   {
       $("#editcommentimg" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcommentimg" + abc);
       var txt = sel.html();
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insertimg" ?>',
           data: 'post_image_comment_id=' + abc + '&comment=' + txt,
           success: function (data) {
               document.getElementById('editcommentimg' + abc).style.display = 'none';
               document.getElementById('showcommentimg' + abc).style.display = 'block';
               document.getElementById('editsubmitimg' + abc).style.display = 'none';
               document.getElementById('editcommentboximg' + abc).style.display = 'block';
               document.getElementById('editcancleimg' + abc).style.display = 'none';
               $('#' + 'showcommentimg' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
   
   function commentallimg(clicked_id) {
       var x = document.getElementById('threecommentimg' + clicked_id);
       var y = document.getElementById('fourcommentimg' + clicked_id);
       var z = document.getElementById('insertcountimg' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           x.style.display = 'none';
           y.style.display = 'block';
           z.style.visibility = 'show';
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/fourcommentimg" ?>',
               data: 'art_post_id=' + clicked_id,
               //alert(data);
               success: function (data) {
                   $('#' + 'fourcommentimg' + clicked_id).html(data);
               }
           });
       }
       // } else {
       //      x.style.display = 'block';
       //      y.style.display = 'block';
       //      z.style.display = 'block';
   
       //      $.ajax({ 
       //             type:'POST',
       //             url:'<?php echo base_url() . "artistic/fourcomment" ?>',
       //             data:'art_post_id='+clicked_id,
       //             //alert(data);
       //             success:function(data){
       //       $('#' + 'threecomment' + clicked_id).html(data);
   
       //       }
       //         });
       // }
   }
   
   function comment_deleteimgtwo(clicked_id)
   {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedimgtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   
   function comment_deletedimgtwo(clicked_id)
   {
       var post_delete1 = document.getElementById("post_deleteimgtwo");
       // alert(post_delete1.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_commenttwoimg" ?>',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete1.value,
           dataType: "json",
           success: function (data) {
   
               $('.' + 'insertcommentimgtwo' + post_delete1.value).html(data.comment);
              // $('#' + 'insertcountimg' + post_delete1.value).html(data.count);
                $('.like_count_ext_img' + post_delete1.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
   
           }
       });
   }
   
   function edit_commentimgtwo(abc)
   {
       $("#editcommentimgtwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcommentimgtwo" + abc);
       var txt = sel.html();
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insertimg" ?>',
           data: 'post_image_comment_id=' + abc + '&comment=' + txt,
           success: function (data) {
               document.getElementById('editcommentimgtwo' + abc).style.display = 'none';
               document.getElementById('showcommentimgtwo' + abc).style.display = 'block';
               document.getElementById('editsubmitimgtwo' + abc).style.display = 'none';
               document.getElementById('editcommentboximgtwo' + abc).style.display = 'block';
               document.getElementById('editcancleimgtwo' + abc).style.display = 'none';
               $('#' + 'showcommentimgtwo' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
   
   
   function likeuserlistimg(post_id) {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/likeuserlistimg" ?>',
           data: 'post_id=' + post_id,
           dataType: "html",
           success: function (data) {
               var html_data = data;
               $('#likeusermodal .mes').html(html_data);
               $('#likeusermodal').modal('show');
           }
       });
   
   
   }
   
   
   function commenteditimg(abc)
   {
       $("#editcommentimg" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
       $('#editcommentimg' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcommentimg" + abc);
               var txt = sel.html();
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deleteimg(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (window.preventDuplicateKeyPresses)
                   return;
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insertimg" ?>',
                   data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                   success: function (data) {
                       document.getElementById('editcommentimg' + abc).style.display = 'none';
                       document.getElementById('showcommentimg' + abc).style.display = 'block';
                       document.getElementById('editsubmitimg' + abc).style.display = 'none';
                       document.getElementById('editcommentboximg' + abc).style.display = 'block';
                       document.getElementById('editcancleimg' + abc).style.display = 'none';
                       $('#' + 'showcommentimg' + abc).html(data);
                       $('.post-design-commnet-box').show();
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
   
   function commenteditimgtwo(abc)
   {
       $("#editcommentimgtwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //$(this).html("");
       });
       $('#editcommentimgtwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcommentimgtwo" + abc);
               var txt = sel.html();
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deleteimgtwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insertimg" ?>',
                   data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                   success: function (data) {
                       document.getElementById('editcommentimgtwo' + abc).style.display = 'none';
                       document.getElementById('showcommentimgtwo' + abc).style.display = 'block';
                       document.getElementById('editsubmitimgtwo' + abc).style.display = 'none';
   
                       document.getElementById('editcommentboximgtwo' + abc).style.display = 'block';
                       document.getElementById('editcancleimgtwo' + abc).style.display = 'none';
   
                       $('#' + 'showcommentimgtwo' + abc).html(data);
                       $('.post-design-commnet-box').show();
   
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<!-- 9-5 khyati image script  emd --> 
<!-- follow user script start -->
<script type="text/javascript">
   function followuser(clicked_id)
   { //alert(clicked_id);
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/follow_two" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
               $('.' + 'fruser' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!--follow like script end -->
<!-- Unfollow user script start -->
<script type="text/javascript">
   function unfollowuser(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/unfollow_two" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
               $('.' + 'fruser' + clicked_id).html(data);
   
           }
       });
   }
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
   
   $("#profilepic").change(function () {
       profile = this.files;
                  //alert(profile);
                     if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
                      //alert('not an image');
                 $('#profilepic').val('');
                  picpopup();
                    return false;
                  }else{
                     readURL(this);}
   });
</script>
<!-- script for profile pic end -->
<script type="text/javascript">
   $(document).ready(function () {
       $("html,body").animate({scrollTop: 350}, 100); //100ms for example
   });
</script>
<script type="text/javascript">
   var _onPaste_StripFormatting_IEPaste = false;
   
   function OnPaste_StripFormatting(elem, e) {
   
       if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
           e.preventDefault();
           var text = e.originalEvent.clipboardData.getData('text/plain');
           window.document.execCommand('insertText', false, text);
       } else if (e.clipboardData && e.clipboardData.getData) {
           e.preventDefault();
           var text = e.clipboardData.getData('text/plain');
           window.document.execCommand('insertText', false, text);
       } else if (window.clipboardData && window.clipboardData.getData) {
           // Stop stack overflow
           if (!_onPaste_StripFormatting_IEPaste) {
               _onPaste_StripFormatting_IEPaste = true;
               e.preventDefault();
               window.document.execCommand('ms-pasteTextOnly', false);
           }
           _onPaste_StripFormatting_IEPaste = false;
       }
   
   }
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
     alert("The paragraph was clicked.");
     //$("html,body").animate({scrollTop: 500}, 100); //100ms for example
     });
</script>
<script>
   function picpopup() {
   
          $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
          $('#bidmodal').modal('show');
                      }
    
</script>
<!-- all popup close close using esc start -->
<script type="text/javascript">
   $( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       //$( "#bidmodal" ).hide();
       $('#bidmodal-2').modal('hide');
   }
   });  
   
</script>
<!-- all popup close close using esc end -->

</body>

</html>

