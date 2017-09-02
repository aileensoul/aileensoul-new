<html>
<head>
<title><?php echo $title; ?></title>
<?php echo $head; ?>
 <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link href="<?php echo base_url() ?>css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>js/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/artistic/artistic.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css') ;?>" />
<body>
<?php echo $header; ?>
 <?php echo $art_header2_border; ?>
<div class="user-midd-section bui_art_left_box" id="paddingtop_fixed">
   <div class="container">
      <div class="row">
        <div class="col-md-4 fixed_art profile-box profile-box-custom fixed_left_side animated fadeInDownBig">
            <div class="">
                     <?php echo $left_artistic; ?> 
            </div>
         </div>
         <div class="col-md-7 col-sm-12 col-md-push-4 custom-right-business animated fadeInUp">
            <div class="common-form">
               <div class="job-saved-box">
                  <h3 style="background-color: #fff; text-align: center; color: #003; border-bottom: 1px solid #d9d9d9;">
                     Search result of 
                    <?php  if($keyword != "" && $keyword1 == ""){echo '"' .  $keyword . '"';}
                                  elseif ($keyword == "" && $keyword1 != "") {
                                    echo '"' .  $keyword1 . '"';
                                  }
                                  else
                                  {
                                     echo '"' .  $keyword . '"'; echo  " in "; echo '"' .  $keyword1 . '"';
                                  }
              ?>                               
                  </h3>
                  <!--        <div class="contact-frnd-post"> -->
                  <div class="job-contact-frnd ">
                     <div class="profile-job-post-title-inside clearfix" style="">

                     <!-- user list start -->
                      <?php if (count($artuserdata) > 0)
                          { ?>
                        <div class="profile_search" style="background-color: white; margin-bottom: 10px; margin-top: 10px;">
                           <h4 class="search_head">Profiles</h4>
                           <div class="inner_search">

                            <?php 
      
                              foreach ($artuserdata as $key) {
                                if($key['art_id']){
                              
                              ?>

                              <div class="profile-job-profile-button clearfix box_search_module">
                                 <div class="profile-job-post-location-name-rec">
                                    <div class="module_Ssearch" style="display: inline-block; float: left;">
                                       <div class="search_img" style="height: 110px; width: 108px;">
                                          <?php if($key['art_user_image']){?>
                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $key['art_user_image']); ?>" alt=" ">
                                <?php }else{?>
                           
                                      <?php  $a = $key['art_name'];
                                              $acr = substr($a, 0, 1);
                                              $b = $key['art_lastname'];
                                              $bcr = substr($b, 0, 1);
                                        ?>
                                      <div class="post-img-profile">
                                            <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                        </div>
                                       <?php }?>
                                       </div>
                                    </div>
                                    <div class="designation_rec" style="    float: left;
                                       width: 60%;
                                       padding-top: 10px; padding-bottom: 10px;">
                                       <ul>
                                          <li style="padding-top: 0px;">
                                             <a style="  font-size: 19px;font-weight: 600;" href="<?php echo base_url('artistic/dashboard/' . $key['user_id'] . ''); ?>" title="<?php echo $key['art_name'].' '.$key['art_lastname'];?>"><?php echo ucfirst(strtolower($key['art_name'])).' '.ucfirst(strtolower($key['art_lastname']));?></a>
                                          </li>
                                          <li style="display: block;">
                                             <a  class="color-search" href="<?php echo base_url('artistic/dashboard/' . $key['user_id'] . ''); ?>">
                                                 <?php if($key['designation']){echo $key['designation'];} else{echo "Current work" ;} ?>
                                              </a>
                                          </li>
                                          <li style="display: block;">
                                                            <?php
                                                   $aud = $key['art_skill'];
                                                   $aud_res = explode(',', $aud);
                                                   $skill1 = array();
                                                   foreach ($aud_res as $skdata) {
                                                     $cache_time = $this->db->get_where('skill', array('skill_id' => $skdata))->row()->skill;
                                                     $skill1[] = $cache_time;
                                                     }
                                                  $listFinal = implode(', ', $skill1);
                                                  if($listFinal && $key['other_skill']){ 
                                                     echo $listFinal . ',' . $key['other_skill'];
                                                  }
                                                       elseif(!$listFinal){ 
                                                      echo $key['other_skill'];  
                                                  }else if(!$key['other_skill']){
                                                   echo $listFinal;  
                                                }?>     
     
                                          </li>
                                          <li style="display: block;">
                                             <a  class="color-search" href="">
                                             <?php $country = $this->db->get_where('countries', array('country_id' => $key['art_country']))->row()->country_name;
                                               $city = $this->db->get_where('cities', array('city_id' => $key['art_city']))->row()->city_name;?>
                                                <?php
                                              if(!$country){ echo $city; }else if(!$city){ echo $country; }else{echo $city.",".$country;} ?>
                                              </a>
                                          </li>
                                          <li style="display: block;">
                                             <a title="" class="color-search websir-se" href="" target="_blank"> </a>
                                          </li>
                                          <input type="hidden" name="search" id="search" value="zalak">
                                       </ul>
                                    </div>

                                    <!-- follow meassge div start -->
                                    <?php 
                            $userid = $this->session->userdata('aileenuser');
                            if($key['user_id'] == $userid){}else{?>
                                    <div class="fl search_button">
                                       <div class="<?php echo "fruser" . $key['art_id']; ?>">

                                       <?php  $status  =  $this->db->get_where('follow',array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to'=>$key['art_id'] ))->row()->follow_status; 
                                            if($status == 0 || $status == " "){?>

                                          <div id="followdiv " class="user_btn">
                                            <button id="<?php echo "follow" . $key['art_id']; ?>" onClick="followuser(<?php echo $key['art_id']; ?>)">
                                             Follow 
                                             </button>
                                          </div>
                                          <?php } elseif($status == 1){ ?>

                                          <div id= "unfollowdiv"  class="user_btn" > 
                                         <button class="bg_following" id="<?php echo "unfollow" . $key['art_id']; ?>" onClick="unfollowuser(<?php echo $key['art_id']; ?>) ">
                                          Following 
                                        </button></div>

                                          <?php }?>
                                       </div>
                                       <button onclick="window.location.href = 'https://www.aileensoul.com/chat/abc/5/5/93'"> Message</button>
                                    </div>
                                    <?php }?>
                                    <!-- follow meassge div end -->
                                 </div>
                              </div>

                              <?php } } ?>
                           </div>
                        </div>
                        <?php }?>


                        <!-- user list end -->

                        <!-- user post start -->

                        <?php if($artpostdata){?>

                        <div class="col-md-12 profile_search " style="float: left; background-color: white; margin-top: 10px; margin-bottom: 10px; padding:0px!important;">
                           <h4 class="search_head">Posts</h4>
                           <div class="inner_search search inner_search_2" style="float: left;">

                           <!-- loop start for post -->
                           <?php foreach ($artpostdata as $key) {
                              ?>
                              <div id="<?php echo "removepost" . $key['art_post_id']; ?>">
                              <div class="col-md-12 col-sm-12 post-design-box"  style="box-shadow: none; ">
                                 <div class="post_radius_box">
                                    <div class="post-design-search-top col-md-12" style="background-color: none!important;">
                                       <div class="post-design-pro-img ">
                                            
                                          <a class="post_dot" href="<?php echo base_url('artistic/dashboard/' . $key['user_id'] . ''); ?>" title="<?php echo $key['art_name'].' '.$key['art_lastname'];?>" >
                                          <?php if($key['art_user_image']){?>
                                                   <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $key['art_user_image']); ?>" alt="">
                                                   <?php }else{?>
                                                   <?php 
                                                    $a = $key['art_name'];
                                                    $acr = substr($a, 0, 1);
                                                    $b = $key['art_lastname'];
                                                    $bcr = substr($b, 0, 1);
                                                    ?>
                                                    <div class="post-img-div">
                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                    </div>
                                          <?php }?>
                                          </a>
                                       </div>
                                       <div class="post-design-name col-xs-8 fl col-md-10">
                                          <ul>
                                             <li>
                                             </li>
                                           
                                             <li>
                                                <div class="post-design-product">
                                                   <a class="post_dot" href="<?php echo base_url('artistic/dashboard/' . $key['user_id'] . ''); ?>" title="<?php echo $key['art_name'].' '.$key['art_lastname'];?>" ><?php echo ucfirst(strtolower($key['art_name'])).' '.ucfirst(strtolower($key['art_lastname']));?>
                                                   </a>
                                                   <span role="presentation" aria-hidden="true"> · </span>
                                                   <div class="datespan"> 
                                                      <span style="font-weight: 400; font-size: 14px; color: #91949d; cursor: default;"> 
                                                      <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($key['created_date']))); ?>    
                                                      </span>
                                                   </div>
                                                </div>
                                             </li>
                                             <li>
                                                <div class="post-design-product" id="<?php echo 'editpostdata' . $key['art_post_id']; ?>" >
                                                   <a href="javascript:void(0);" style=" color: #000033; font-weight: 400; cursor: default;" title="" id="<?php echo 'editpostval' . $key['art_post_id']; ?>">
                                                   <?php echo $this->common->make_links($key['art_post']);?>   </a>
                                                </div>
                                             </li>
                                             <li>
                                             </li>
                                          </ul>
                                       </div>
                                       <div class="dropdown1">
                                               <a onClick="myFunction(<?php echo $key['art_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
                                                  <div id="<?php echo "myDropdown" . $key['art_post_id']; ?>" class="dropdown-content1">
                                                            <?php
                                                            if ($key['posted_user_id'] != 0) {

                                                            if ($this->session->userdata('aileenuser') == $key['posted_user_id']) {
                                                                        ?>
                                                          <a id="<?php echo $key['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><span class="h4-img h2-srrt"></span>Delete Post</a>
                                                          <a id="<?php echo $key['art_post_id']; ?>" onClick="editpost(this.id)"><span class="h3-img h2-srrt"></span>Edit</a>

                                                          <?php } else {?>
                                                          <a id="<?php echo $key['art_post_id']; ?>" onClick="deletepostmodel(this.id)"><span class="h4-img h2-srrt"></span>Delete Post</a>
                                                          <?php } }else{?>
                                                          <?php
                                                              $userid = $this->session->userdata('aileenuser');
                                                                if ($key['user_id'] == $userid) {?>
                                                                <a id="<?php echo $key['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><span class="h4-img h2-srrt"></span>Delete Post</a>
                                                                        <a id="<?php echo $key['art_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                                                                    <?php } else { ?>
                                                                     <a id="<?php echo $key['art_post_id']; ?>" onClick="deletepostmodel(this.id)"><span class="h4-img h2-srrt"></span>Delete Post</a><?php } } ?>
                                                </div>
                                            </div> 
                                       <div class="post-design-desc">
                                          <div>

                                             <div id="<?php echo "editpostbox" . $key['art_post_id']; ?>" style="display:none;">
                                                        <input type="text" id="<?php echo "editpostname" . $key['art_post_id']; ?>" name="editpostname" placeholder="Title" value="<?php echo $key['art_post']; ?>" onKeyDown=check_lengthedit(<?php echo $key['art_post_id']; ?>); onKeyup=check_lengthedit(<?php echo $key['art_post_id']; ?>); onblur=check_lengthedit(<?php echo $key['art_post_id']; ?>);>
                                                         <?php
                                                              if ($key['art_post']) {
                                                                $counter = $key['art_post'];
                                                                $a = strlen($counter);
                                                                  ?>
                                                                 <input size=1 id="text_num_<?php echo $key['art_post_id'] ?>" class="text_num" tabindex="-500" value="<?php echo (50 - $a); ?>" name=text_num readonly>
                                                               <?php } else { ?>
                                                                <input size=1 id="text_num_<?php echo $key['art_post_id'] ?>" class="text_num" tabindex="-501" value=50 name=text_num readonly> 
                                                             <?php } ?>
                                            </div>
                                          </div>
                                          <div id="<?php echo "khyati" . $key['art_post_id']; ?>" style="display:block;">
                                            <?php
                                              $small = substr($key['art_description'], 0, 180);
                                              echo $small;
                                            if (strlen($key['art_description']) > 180) {
                                               echo '... <span id="kkkk" onClick="khdiv(' . $key['art_post_id'] . ')">View More</span>';
                                             }?>
                                          </div>
                                          <div id="<?php echo "khyatii" . $key['art_post_id']; ?>" style="display:none;">
                                          <?php
                                         echo $key['art_description'];
                                           ?>
                                         </div>

                                          <div id="<?php echo "editpostdetailbox" . $key['art_post_id']; ?>" style="display:none;">      
                                                   <div contenteditable="true" id="<?php echo "editpostdesc" . $key['art_post_id']; ?>" placeholder="Product Description" class="textbuis  editable_text" name="editpostdesc"><?php echo $key['art_description']; ?></div>                  
                                          </div>
                                          <button class="fr" id="<?php echo "editpostsubmit" . $key['art_post_id']; ?>" style="display:none;margin: 5px 0; border-radius: 3px;" onclick="edit_postinsert(<?php echo $key['art_post_id']; ?>)">Save
                                          </button>
                                       </div>
                                    </div>

                                    <!-- middel section start bphotos video audio pdf -->
                                    <div class="post-design-mid col-md-12" style="border: none;">
                                        <div>                                               
                                        <div class="mange_post_image">
                                            <?php
                                            $contition_array = array('post_id' => $key['art_post_id'], 'is_deleted' => '1', 'image_type' => '1');
                                            $artmultiimage = $this->data['artmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                            ?>
                                            <?php if (count($artmultiimage) == 1) { ?>
                                                <?php
                                                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                                                $allowespdf = array('pdf');
                                                $allowesvideo = array('mp4', '3gp', 'avi','MP4');
                                                $allowesaudio = array('mp3');
                                                $filename = $artmultiimage[0]['image_name'];
                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                          if (in_array($ext, $allowed)) {
                               ?>                                   
            <div class="one-image" >
             <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[0]['image_name'])?>"> </a>
          </div>
          <?php } elseif (in_array($ext, $allowespdf)) { ?>                                                
             <div>
            <a href="<?php echo base_url('artistic/creat-pdf/' . $artmultiimage[0]['image_id']) ?>"><div class="pdf_img">
                <img src="<?php echo base_url('images/PDF.jpg')?>" style="height: 100%; width: 100%;">
                    </div></a>
                    </div>
                  <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                   <div class="video_post">
                        <video width="100%" height="55%" controls>
                        <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') .$artmultiimage[0]['image_name']) ?>" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                         </video>
                    </div>                                    
                <?php } elseif (in_array($ext, $allowesaudio)) { ?>                                            
                        <div>
                        <audio width="120" height="100" controls>
                    <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']); ?>" type="audio/mp3">
                    <source src="movie.ogg" type="audio/ogg">
                        Your browser does not support the audio tag.
                      </audio>
                    </div>
                <?php } ?>
                  <?php } elseif (count($artmultiimage) == 2) { ?>
                                                <?php
                                                foreach ($artmultiimage as $multiimage) {
                                                    ?>                                                
                                                    <div class="two-images">
                                                        <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img class="two-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$multiimage['image_name']) ?>" > </a>
                                                    </div>                                                    
                                                <?php } ?>
                                            <?php } elseif (count($artmultiimage) == 3) { ?>
                                                    <div class="three-image-top">
                                                    <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[0]['image_name']) ?>" style="width: 100%; height:100%; "> </a>
                                                </div>
                                               <div class="three-image">
                                                    <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[1]['image_name'])?>" style="width: 100%; height:100%; "> </a>
                                                </div>
                                              <div class="three-image">
                                                    <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[2]['image_name'])?>" style="width: 100%; height:100%; "> </a>
                                                </div>
                                            <?php } elseif (count($artmultiimage) == 4) { ?>
                                                <?php
                                                foreach ($artmultiimage as $multiimage) {
                                                    ?>                                                   
                                                   <div class="four-image">
                                                        <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name'])?>" style="width: 100%; height: 100%;"> </a>
                                                   </div>                                                   
                                               <?php } ?>
                                            <?php } elseif (count($artmultiimage) > 4) { ?>
                                                <?php
                                                $i = 0;
                                                foreach ($artmultiimage as $multiimage) {
                                                    ?>                                                    
                                                  <div class="four-image">
                                                            <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" style=""> </a>
                                                        </div>                                             
                                                    <?php
                                                    $i++;
                                                    if ($i == 3)
                                                        break;
                                                }
                                                ?>
                                             <div class="four-image">
                                                        <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[3]['image_name'])?>" > </a>
                                                        <a href="<?php echo base_url('artistic/post-detail/' . $key['art_post_id']) ?>" >
                                                    <div class="more-image" >
                                                <span>
                                                     View All (+<?php echo (count($artmultiimage) - 4); ?>)
                                                 </span></div>
                                             </a>
                                               </div>
                                            <?php } ?>
                                        </div>                                                            
                                            </div>
                                    </div>
                                    <!-- middel section end bphotos video audio pdf -->
                                    <div class="post-design-like-box col-md-12">
                                       <div class="post-design-menu">
                                          <ul class="col-md-6">
                                             <li class="<?php echo 'likepost' . $key['art_post_id']; ?>">
                                                <a class="ripple like_h_w" id="<?php echo $key['art_post_id']; ?>" onClick="post_like(this.id)">
                                                <?php
                                                   $userid = $this->session->userdata('aileenuser');
                                                   $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1');
                                                   $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                    $likeuserarray = explode(',', $artlike[0]['art_like_user']);
                                                      if (!in_array($userid, $likeuserarray)) { ?>
                                                <i class="fa fa-thumbs-up fa-1x" aria-hidden="true">
                                                </i>
                                                <?php } else {?>
                                                <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
                                                <?php } ?>
                                                <span style="display: none;">
                                                </span>
                                                </a>
                                             </li>
                                             <li id="<?php echo 'insertcount' . $key['art_post_id']; ?>" style="visibility:show">
                                              <?php
                                                        $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                        $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        ?>
                                                <a class="ripple like_h_w" onClick="commentall(this.id)" id="<?php echo $key['art_post_id']; ?>">
                                                <i class="fa fa-comment-o" aria-hidden="true"> 
                                                <span style="display: none;"></span>
                                                </i> 
                                                </a>
                                             </li>
                                          </ul>
                                          <ul class="col-md-6 like_cmnt_count">
                                             <li>
                                                <div class="like_count_ext<?php echo $key['art_post_id']; ?>">
                                                   <span class="comment_count">
                                                    <?php
                                                      if (count($commnetcount) > 0) {
                                                      echo count($commnetcount); ?> 
                                                   </span> 
                                                   <span> Comment</span>
                                                      <?php }?> 
                                                </div>
                                             </li>
                                             <li>
                                                <div class="comnt_count_ext_a <?php echo 'comnt_count_ext' . $key['art_post_id']; ?>">
                                                   <span class="comment_like_count"> 
                                                   <?php
                                                      if ($key['art_likes_count'] > 0) { 
                                                        echo $key['art_likes_count']; ?>
                                                      </span> 
                                                     <span> Like</span><?php  } ?> 
                                                </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                    <?php
                                        if ($key['art_likes_count'] > 0) {
                                            ?>
                                            <div class="likeduserlist<?php echo $key['art_post_id'] ?>">
                                                <?php
                                                $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                $likeuser = $commnetcount[0]['art_like_user'];
                                                $countlike = $commnetcount[0]['art_likes_count'] - 1;
                                                $likelistarray = explode(',', $likeuser);
                                              
                                                foreach ($likelistarray as $key1 => $value) {
                                                    $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                                                    $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
                                                    ?>
                                                <?php } ?>
                                                
                                                
                                                    <?php
                                                    $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                    $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                    $likeuser = $commnetcount[0]['art_like_user'];
                                                    $countlike = $commnetcount[0]['art_likes_count'] - 1;

                                                    $likelistarray = explode(',', $likeuser);
                                                    $likelistarray = array_reverse($likelistarray);
                                                    $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                                                    $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                                                    ?>
                                                    <div class="like_one_other">
                                                    <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $key['art_post_id']; ?>);">
                                                        <?php
                                                        echo ucfirst(strtolower($art_fname));
                                                        echo "&nbsp;";
                                                        echo ucfirst(strtolower($art_lname));
                                                        echo "&nbsp;";
                                                        ?>
                                                        <?php
                                                        if (count($likelistarray) > 1) {
                                                            echo "and ";
                                                            echo $countlike;
                                                            echo "&nbsp;";
                                                            echo "others";
                                                        }
                                                        ?>
                                                        </a>
                                                    </div>
                                                
                                            </div>
                                            <?php
                                        }
                                        ?> <?php  ?>

                                    <div class="<?php echo "likeusername" . $key['art_post_id']; ?>" id="<?php echo "likeusername" . $key['art_post_id']; ?>" style="display:none">
                                    <?php
                                            $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                            $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                            $likeuser = $commnetcount[0]['art_like_user'];
                                            $countlike = $commnetcount[0]['art_likes_count'] - 1;
                                            $likelistarray = explode(',', $likeuser);
                                         
                                            foreach ($likelistarray as $key2 => $value) {
                                                $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                                                $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
                                                ?>
                                            <?php } ?>
                                            
                                           
                                                <?php
                                                $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                $likeuser = $commnetcount[0]['art_like_user'];
                                                $countlike = $commnetcount[0]['art_likes_count'] - 1;

                                                $likelistarray = explode(',', $likeuser);
                                                $likelistarray = array_reverse($likelistarray);
                                                $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                                                $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                                                ?>
                                       <a href="javascript:void(0);" onclick="likeuserlist(<?php echo $key['art_post_id']; ?>);">
                                          <div class="like_one_other">
                                             <?php
                                                    echo ucfirst(strtolower($art_fname));
                                                    echo "&nbsp;";
                                                    echo ucfirst(strtolower($art_lname));
                                                    echo "&nbsp;";
                                                    ?>
                                                    <?php
                                                    if (count($likelistarray) > 1) {
                                                        echo "and ";
                                                        echo $countlike;
                                                        echo "&nbsp;";
                                                        echo "others";
                                                    }
                                                    ?>       
                                           </div>
                                       </a>
                                    </div>
                                    <div class="art-all-comment col-md-12">
                                       <div id="<?php echo "fourcomment" . $key['art_post_id']; ?>" style="display:none;">
                                       </div>
                                       <div id="<?php echo "threecomment" . $key['art_post_id']; ?>" style="display:block">
                                            <div class="hidebottomborder <?php echo 'insertcomment' . $key['art_post_id']; ?>">
                                              <?php
                                                    $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1');
                                                    $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
    
                                                    if ($artdata) {
                                                        foreach ($artdata as $rowdata) {
                                                            $artname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_name;
                                                            $artlastname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_lastname;
                                                            ?>
                                                  <div class="all-comment-comment-box">
                                                        <div class="post-design-pro-comment-img">
                                                          <?php
                                                              $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                                                                    ?>
                                                        <?php if ($art_userimage) { ?>
                                                            <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>"  alt="">
                                                                <?php } else { ?>
                                                                <?php 
                                                                $a = $artname;
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artlastname;
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div>
                                                              <?php }?>
                                                        </div>
                                                        <div class="comment-name">
                                                            <b title=" <?php
                                                                echo ucfirst(strtolower($artname));
                                                                echo "&nbsp;";
                                                                echo ucfirst(strtolower($artlastname)); ?>">
                                                          <?php
                                                          echo ucfirst(strtolower($artname));
                                                          echo "&nbsp;";
                                                          echo ucfirst(strtolower($artlastname));
                                                          ?></b><?php echo '</br>'; ?></div>
                                                          <div class="comment-details" id="<?php echo "showcomment" . $rowdata['artistic_post_comment_id']; ?>"><?php  echo $this->common->make_links($rowdata['comments']); ?></div>

                                                          <div class="edit-comment-box">
                                                             <div class="inputtype-edit-comment">
                                                              <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="<?php echo $rowdata['artistic_post_comment_id']; ?>"  id="editcomment<?php echo $rowdata['artistic_post_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commentedit(<?php echo $rowdata['artistic_post_comment_id']; ?>)"><?php echo $rowdata['comments']; ?></div>

                                                              <!-- div problem strat here in button imporatnt note-->
                                                              <span class="comment-edit-button"><button id="<?php echo 'editsubmit' . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Save</button></span>
                                                                    </div>
                                                                </div>
                                                                    <div class="art-comment-menu-design"> 
                                                                    <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['artistic_post_comment_id']; ?>">
                                                                        <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like1(this.id)">

                                                                            <?php
                                                                            $userid = $this->session->userdata('aileenuser');
                                                                            $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' => '1');
                                                                            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                            $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                                                                            if (!in_array($userid, $likeuserarray)) {
                                                                                ?>

                                                                                <i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i> 
                                                                            <?php } else {
                                                                                ?>
                                                                                <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
                                                                            <?php }
                                                                            ?>
                                                                            <span>
                                                                                <?php
                                                                                if ($rowdata['artistic_comment_likes_count'] > 0) {
                                                                                    echo $rowdata['artistic_comment_likes_count'];
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
                                                                            <div id="<?php echo 'editcommentbox' . $rowdata['artistic_post_comment_id']; ?>" style="display:block;">
                                                                                <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editbox(this.id)" class="editbox">Edit
                                                                                </a>
                                                                            </div>
                                                                            <div id="<?php echo 'editcancle' . $rowdata['artistic_post_comment_id']; ?>" style="display:none;">
                                                                                <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                    <?php
                                                                    $userid = $this->session->userdata('aileenuser');
                                                                    $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;

                                                                    if ($rowdata['user_id'] == $userid || $art_userid == $userid) {
                                                                        ?> 
                                                                        <span role="presentation" aria-hidden="true"> · </span>
                                                                        <div class="comment-details-menu">
                                                                            <input type="hidden" name="post_delete"  id="<?php echo "post_delete" . $rowdata['artistic_post_comment_id']; ?>" value= "<?php echo $rowdata['art_post_id']; ?>">
                                                                            <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                <?php } ?>
                                                                    <span role="presentation" aria-hidden="true"> · </span>
                                                                    <div class="comment-details-menu">
                                                                        <p> <?php                                                 
                                                                  echo date('d-M-Y', strtotime($rowdata['created_date']));
                                                                            echo '</br>';
                                                                            ?>
                                                                        </p></div></div>
                                                  </div> 
                                                <?php } }?>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="post-design-commnet-box col-md-12">
                                     <?php
                                            $userid = $this->session->userdata('aileenuser');
                                            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_user_image;

                                            $art_name = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_name;
                                            $art_lastname = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_lastname;
                                            ?>
                                       <div class="post-design-proo-img">
                                          <?php if ($art_userimage) { ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>" name="image_src" id="image_src" />
                                                    <?php
                                                } else {
                                                    ?>
                                                     <?php 
                                                                $a = $art_name;
                                                                $acr = substr($a, 0, 1);
                                                                 $b = $art_lastname;
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-profile">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div>
                                                    <?php
                                                }
                                                ?>
                                       </div>
                                       <div id="content" class="col-md-12 inputtype-comment cmy_2">
                                          <div contenteditable="true" style="min-height:37px !important; margin-top: 0px!important" class="editable_text" name="<?php echo $key['art_post_id']; ?>" id="<?php echo "post_comment" . $key['art_post_id']; ?>" placeholder="Type Message ..." onclick="entercomment(<?php echo $key['art_post_id']; ?>)"></div>
                                       </div>
                                       <?php echo form_error('post_comment'); ?>
                                       <div class="comment-edit-butn">       
                                           <button id="<?php echo $key['art_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              </div>
                              <?php }?>
                              <!-- loop end for post -->
                           </div>
                        </div>

                        <?php }?>
                        <!-- user post end -->

                        <!-- no data avaloble code  start-->
                        <?php if(count($artuserdata) == 0 && count($artpostdata) == 0){?>
                        <div class="text-center rio">
                                                <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                                                <p style="text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                                                <ul class="padding_less_left">
                                                    <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                                                </ul>
                         </div>
                         <?php }?>
                        <!-- no data avaloble code  start-->

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

      <!-- bid model start -->

      <div class="modal fade message-box" id="postedit" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="postedit" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
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
                                   
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
      </div>

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

<footer>
<?php echo $footer; ?>
        </footer>


<script src="<?php echo base_url() ?>js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/themes/explorer/theme.js" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
 <script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';      
var data = <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/recommen_candidate.js'); ?>"></script>
</body>
</html>