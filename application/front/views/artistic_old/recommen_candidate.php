<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
 
 <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link href="<?php echo base_url() ?>css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>js/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>js/jquery-2.0.3.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/plugins/sortable.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/fileinput.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/themes/explorer/theme.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">


    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
 <?php echo $art_header2_border; ?>
    <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">


       <div class="col-md-4"><div class="profile-box profile-box-left">

   <div class="full-box-module">    
                                <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover">    
                                        <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                           href="<?php echo base_url('artistic/art_manage_post'); ?>"
                                           tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo ucwords($artdata[0]['art_name']) . ' ' . ucwords($artdata[0]['art_lastname']); ?>">
                                            <!-- box image start -->
                                            <?php if ($artdata[0]['profile_background'] != '') { ?>
                                                <img src="<?php echo base_url($this->config->item('art_bg_main_upload_path') . $artdata[0]['profile_background']); ?>" class="bgImage" alt=""  style="height: 95px; width: 100%; ">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt=""  style="height: 95px; width: 100%;">
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="profile-boxProfileCard-content clearfix">
                                        <div class="buisness-profile-txext col-md-4">
                                            <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('artistic/art_manage_post'); ?>" title="<?php echo ucwords($artdata[0]['art_name']) . ' ' . ucwords($artdata[0]['art_lastname']); ?>" tabindex="-1" aria-hidden="true" rel="noopener" >
                                                <?php
                                                if ($artdata[0]['art_user_image']) {
                                                    ?>
                                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artdata[0]['art_user_image']); ?>"  alt="" style="height: 77px; width: 71px; z-index: 3; position: relative; ">
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                <?php } ?>                           
                                                <!-- 
                        <img class="profile-boxProfileCard-avatarImage js-action-profile-avatar" src="images/imgpsh_fullsize (2).jpg" alt="" style="    height: 68px;
                        width: 68px;">
                                                -->
                                            </a>
                                        </div>
                                        <div class="profile-box-user  profile-text-bui-user  fr col-md-9">
                                            <span class="profile-company-name ">
                                                <a style="margin-left: 3px;" href="<?php echo base_url('artistic/art_manage_post'); ?>" title="<?php echo ucwords($artdata[0]['art_name']) . ' ' . ucwords($artdata[0]['art_lastname']); ?>"> 
                                                    <?php echo ucwords($artdata[0]['art_name']) . ' ' . ucwords($artdata[0]['art_lastname']); ?>
                                                </a> 
                                            </span>
                                            <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                            <div class="profile-boxProfile-name">
                                                <a style="padding-left: 1px;" href="<?php echo base_url('artistic/art_manage_post'); ?> " title="<?php echo ucwords($artdata[0]['art_name']) . ' ' . ucwords($artdata[0]['art_lastname']); ?>" >
                                                    <b> 
                                                    <?php
                                                if ($artdata[0]['designation']) {
                                                    echo ucwords($artdata[0]['designation']);
                                                } else {
                                                    echo "Designation";
                                                }
                                                ?>
                                                      
                                                    </b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-box-bui-menu  col-md-12">
                                            <ul class="">
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('artistic/art_manage_post'); ?>"> Dashboard</a>
                                                </li>
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers'); ?>">Followers <br>(<?php echo (count($followerdata)); ?>)</a>
                                                </li>
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('artistic/following'); ?>">Following<br>(<?php echo (count($followingdata)); ?>)</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

  
  
   
</div>
</div>
<!-- left side box close -->

<input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
   <div class="col-md-7 col-sm-7 all-form-content" style="height: 150%;">
                        <div class="common-form">
                            <div class="job-saved-box">

                                <h3 style="background-color: #fff; text-align: center; color: #003;">Search Result of <?php echo ucwords($keyword)?></h3>
                                <!-- <div class="contact-frnd-post"> -->
                                    <div class="job-contact-frnd ">
<!-- main data start -->
                            
                                       <div class="profile-job-post-title-inside clearfix">
                                      
<div class="profile_search" style="background-color: white; margin-bottom: 10px; margin-top: 10px;"> 

                                       <h4 class="search_head">Profiles</h4>
                                       <div class="inner_search">

                                       <?php if($artuserdata){
                              foreach ($artuserdata as $key) {
                                if($key['art_id']){
                              
                              ?>

                                                 <div class="profile-job-profile-button clearfix box_search_module search" style="height: 14%;border: 1px solid #efefef;margin-bottom: 10px;">
                                                            
     <div class="profile-job-post-location-name-rec">
          <div class="module_Ssearch" style="display: inline-block; float: left;">
             <div class="search_img">
                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $key['art_user_image']); ?>" alt=" ">
                        </div>
       </div>
   
       <div class="designation_rec" style="    float: left;
    width: 60%;
    padding-top: 16px;">
          <ul>
       <li>
      <a style="  font-size: 19px;
         font-weight: 600;" href="" title="<?php echo $key['art_name'].' '.$key['art_lastname'];?>">
       <?php echo $key['art_name'].' '.$key['art_lastname'];?>
       </a>
      </li>
      
      <li style="display: block;">
        <a  class="color-search" style="font-size: 16px;" href="" title="IAS">

               
           </a>
       </li>
         <li style="display: block;">
         <a  class="color-search" href="">
           <?php if($key['designation']){echo $key['designation'];} else{echo PROFILENA;} ?>
         </a>

       </li>
       <li style="display: block;">
         <a  class="color-search" href="">
           <?php
                  $comma = ", ";
                  $k = 0;
                  $aud = $key['art_skill'];
                  $aud_res = explode(',', $aud);
                  foreach ($aud_res as $skill) {
                 if ($k != 0) {
                 echo $comma;
                     }
               $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
               if ($cache_time) {
               echo $cache_time;
             } else {
                echo PROFILENA;
                }
                 $k++;
                }
               ?>
         </a>

       </li>
       <li style="display: block;">
         <a  class="color-search" href="">
         <?php $country = $this->db->get_where('countries', array('country_id' => $key['art_country']))->row()->country_name;
         $city = $this->db->get_where('cities', array('city_id' => $key['art_city']))->row()->city_name;
         ?>
         <?php echo $country.",".$city; ?>
         </a>
       </li>
      
    </ul>
      </div>
      <div class="fl search_button">
        <div class="<?php echo "fruser" . $key['art_id']; ?>">
<?php  $status  =  $this->db->get_where('follow',array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to'=>$key['art_id'] ))->row()->follow_status; 

if($status == 0 || $status == " "){?>
 
 <div id= "followdiv " class="user_btn">

            <button id="<?php echo "follow" . $key['art_id']; ?>" onClick="followuser(<?php echo $key['art_id']; ?>)">
                               Follow 
                            </button></div>

                            <?php }elseif($status == 1){ ?>

                                   <div id= "unfollowdiv"  class="user_btn" > 
           <button class="bg_following" id="<?php echo "unfollow" . $key['art_id']; ?>" onClick="unfollowuser(<?php echo $key['art_id']; ?>) ">
                               Following 
                            </button></div>
                                <?php } ?>
</div>
        <br>
         <button onclick="window.location.href = '<?php echo base_url('chat/abc/' . $key['user_id']); ?>'"> Message</button>
      </div>



     </div>
       </div>
       <?php }}?>
</div>

</div>
<div class="col-md-12 profile_search " style="float: left; background-color: white; margin-top: 10px; margin-bottom: 10px; padding:0px!important;"> 
       <h4 class="search_head">Posts</h4>
       <div class="inner_search">

       <?php foreach ($artuserdata as $key) {
         if($key['art_description']){
       
       ?>
       <div class="col-md-12 col-sm-12 post-design-box search" id="removepost5" style=" box-shadow: none;">
                                    <div class="post_radius_box">  
                                        <div class="post-design-search-top col-md-12" style="background-color: none!important;">  
                                            <div class="post-design-pro-img col-md-2"> 
                                                
                                                <div id="popup1" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Your Post is Successfully Saved.
                                                            <p class="okk">
                                                                <a class="okbtn" href="#">Ok
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="popup25" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post?.
                                                            <p class="okk">
                                                                <a class="okbtn" id="5" onclick="remove_post(this.id)" href="#">Yes
                                                                </a>
                                                            </p>
                                                            <p class="okk">
                                                                <a class="cnclbtn" href="#">No
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="popup55" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post from your profile?.
                                                            <p class="okk">
                                                                <a class="okbtn" id="5" onclick="del_particular_userpost(this.id)" href="#">OK
                                                                </a>
                                                            </p>
                                                            <p class="okk">
                                                                <a class="cnclbtn" href="#">Cancel
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $key['art_user_image']); ?>" alt="">
                                                                                                </div>
                                            <div class="post-design-name fl col-md-9">
                                                <ul>
                                                    
                                                    <li>
                                                    </li>

                                                                                                            <li>
                                                            <div class="post-design-product">
                                                                <a class="post_dot" href="<?php echo base_url('artistic/art_manage_post/' . $key['user_id'] . ''); ?>" title="<?php echo $key['art_name'].' '.$key['art_lastname'];?>" >
                                                                    <?php echo $key['art_name'].' '.$key['art_lastname'];?>
                                                                      </a>
                                                                <div class="datespan">  <span style="font-weight: 400;
                                                    font-size: 14px;
                                                    color: #91949d; cursor: default;"> 
                                                                        <?php echo date('d-M-Y', strtotime($key['created_date'])); ?>                                                                    </span></div>

                                                            </div>



                                                        </li>

                                                    
                                                    <li>
                                                        <div class="post-design-product">
                                                            <a href="javascript:void(0);" style=" color: #000033; font-weight: 400; cursor: default;" title="Category">
                                                                <?php echo $key['art_post'];?>                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    </li> 
                                                </ul> 
                                            </div>  
                                            <div class="dropdown1">
                                                <a onclick="myFunction(5)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v">
                                                </a>
                                                <div id="myDropdown5" class="dropdown-content1">
                                                     
                                                        <a href="#popup25">
                                                            <i class="fa fa-trash-o" aria-hidden="true">
                                                            </i> Delete Post
                                                        </a>
                                                        <a id="5" onclick="editpost(this.id)">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                            </i>Edit
                                                        </a>
                                                                                                    </div>
                                            </div>
                                            <div class="post-design-desc ">
                                                <div>
                                                    <div id="editpostdata5" style="display:block;">
                                                        <a style="margin-bottom: 0px;     font-size: 16px">
                                                            <?php echo $key['art_description'];?>                                                        </a>
                                                    </div>
                                                    <div id="editpostbox5" style="display:none;">
                                                        <input type="text" id="editpostname5" name="editpostname" placeholder="Product Name" value="zalak">
                                                    </div>
                                                </div>                    

                                                <div id="editpostdetails5" style="display:block;">
                                                    <span class="show"> 
                                                         </span>
                                                </div>
                                                <div id="editpostdetailbox5" style="display:none;">
                                                  
                                                    <div contenteditable="true" id="editpostdesc5" placeholder="Product Description" class="textbuis  editable_text" name="editpostdesc"></div>                  
                                                </div>
                                                <button class="fr" id="editpostsubmit5" style="display:none;margin: 5px 0; border-radius: 3px;" onclick="edit_postinsert(5)">Save
                                                </button>

                                            </div> 
                                        </div>
                                        
                                        <div class="post-design-mid col-md-12" style="border: none;">
                                            
                                            <div>                                                                                                                                                           
                                                        <div class="mange_post_image">
                                            <?php
                                            $contition_array = array('post_id' => $key['art_post_id'], 'is_deleted' => '1', 'image_type' => '1');
                                            $artmultiimage = $this->data['artmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                            ?>

                                            <?php if (count($artmultiimage) == 1) { ?>

                                                <?php
                                                $allowed = array('gif', 'png', 'jpg');
                                                $allowespdf = array('pdf');
                                                $allowesvideo = array('mp4', '3gp', 'avi');
                                                $allowesaudio = array('mp3');
                                                $filename = $artmultiimage[0]['image_name'];
                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);

         if (in_array($ext, $allowed)) {
                ?>

                                                   
            <div id="basic-responsive-image" style="height: 80%; width: 100%;">
             <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[0]['image_name'])?>" style="width: 100%; height: 100%;"> </a>
                                                    </div>
                                                    

                                                <?php } elseif (in_array($ext, $allowespdf)) { ?>

                                                  
             <div>
            <a href="<?php echo base_url('artistic/creat_pdf/' . $artmultiimage[0]['image_id']) ?>"><div class="pdf_img">
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

                                                    
                                                    <div  id="two_manage_images_art" >
                                                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="two-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$multiimage['image_name']) ?>" > </a>
                                                    </div>

                                                    
                                                <?php } ?>

                                            <?php } elseif (count($artmultiimage) == 3) { ?>



                                              
                                                <div id="three_images_art" >
                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[0]['image_name']) ?>" style="width: 100%; height:100%; "> </a>
                                                </div>
                                                <div  id="three_images_2_art">
                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[1]['image_name'])?>" style="width: 100%; height:100%; "> </a>
                                                </div>

                                                <div  id="three_images_2_art">
                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[2]['image_name'])?>" style="width: 100%; height:100%; "> </a>
                                                </div>

                                                


                                            <?php } elseif (count($artmultiimage) == 4) { ?>


                                                <?php
                                                foreach ($artmultiimage as $multiimage) {
                                                    ?>

                                                    
                                                    <div id="responsive_manage-images-breakpoints" style="   ">
                                                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name'])?>" style="width: 100%; height: 100%;"> </a>

                                                    </div>

                                                    

                                                <?php } ?>


                                            <?php } elseif (count($artmultiimage) > 4) { ?>



                                                <?php
                                                $i = 0;
                                                foreach ($artmultiimage as $multiimage) {
                                                    ?>

                                                    
                                                    <div>
                                                        <div id="responsive-manage_images_2-breakpoints">
                                                            <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" style=""> </a>
                                                        </div>
                                                    </div>

                                                    

                                                    <?php
                                                    $i++;
                                                    if ($i == 3)
                                                        break;
                                                }
                                                ?>
                                               
                                                <div>
                                                    <div id="responsive-manage_images_3-breakpoints" >
                                                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') .$artmultiimage[3]['image_name'])?>" > </a></div>


                                                    <div class="manage_images_view_more" >


                                                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>" >View All (+<?php echo (count($artmultiimage) - 4); ?>)</a>
                                                    </div>

                                                </div>
                                              


                                            <?php } ?>
                                            <div>


                                            </div>

                                        </div>
                                                              <div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="post-design-like-box col-md-12" style="border: none;">
                                            <div class="post-design-menu">
                                                <ul>

                                                    <li class="<?php echo 'likepost' . $key['art_post_id']; ?>">
                                                        <a id="<?php echo $key['art_post_id']; ?>" onClick="post_like(this.id)">

                                                            <?php
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1');
                                                            $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            $likeuserarray = explode(',', $artlike[0]['art_like_user']);

                                                            if (!in_array($userid, $likeuserarray)) {
                                                                ?>
                                                                <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                                                            <?php } else {
                                                                ?>
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                            <?php }
                                                            ?>
                                                            <span>
                                                                <?php
                                                                if ($key['art_likes_count'] > 0) {
                                                                    echo $key['art_likes_count'];
                                                                }
                                                                ?>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li id="<?php echo 'insertcount' . $key['art_post_id']; ?>" style="visibility:show">
                                                        <?php
                                                        $contition_array = array('art_post_id' => $key['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                        $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        ?>
                                                        <a  onClick="commentall(this.id)" id="<?php echo $key['art_post_id']; ?>">
                                                            <i class="fa fa-comment-o" aria-hidden="true">
                                                                <?php echo count($commnetcount); ?>
                                                            </i>  
                                                        </a>
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
                                                
                                                <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $key['art_post_id']; ?>);">
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
                                                        <?php
                                                        echo ucwords($art_fname);
                                                        echo "&nbsp;";
                                                        echo ucwords($art_lname);
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
                                            
                                            <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $key['art_post_id']; ?>);">
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
                                                    <?php
                                                    echo ucwords($art_fname);
                                                    echo "&nbsp;";
                                                    echo ucwords($art_lname);
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
                                            <div id="<?php echo "fourcomment" . $key['art_post_id']; ?>" style="display:none">
                                            </div>
                                            
                                            <div  id="<?php echo "threecomment" . $key['art_post_id']; ?>" style="display:block">
                                                <div class="<?php echo 'insertcomment' . $key['art_post_id']; ?>">
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
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="comment-name">
                                                                    <b title=" <?php
                                                                    echo ucwords($artname);
                                                                    echo "&nbsp;";
                                                                    echo ucwords($artlastname);
                                                                    ?>">
                                                                           <?php
                                                                           echo ucwords($artname);
                                                                           echo "&nbsp;";
                                                                           echo ucwords($artlastname);
                                                                           ?></b><?php echo '</br>'; ?></div>

                                           <div class="comment-details" id="<?php echo "showcomment" . $rowdata['artistic_post_comment_id']; ?>"><?php  echo $this->common->make_links($rowdata['comments']); ?></div>
                     <div class="edit-comment-box">
                                                                    <div class="inputtype-edit-comment">
                                                                        <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="<?php echo $rowdata['artistic_post_comment_id']; ?>"  id="editcomment<?php echo $rowdata['artistic_post_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commentedit(<?php echo $rowdata['artistic_post_comment_id']; ?>)"><?php echo $rowdata['comments']; ?></div>
                                                                        <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Save</button></span>
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

                                                                                <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                                                                            <?php } else {
                                                                                ?>
                                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
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
                                                                            <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['art_post_id']; ?>">
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
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php   ?>
                                        
                                        <div class="post-design-commnet-box col-md-12">
                                        <?php
                                            $userid = $this->session->userdata('aileenuser');
                                            $art_userimage = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_user_image;
                                            ?>
                                            <div class="post-design-proo-img">                                                                     <?php if ($art_userimage) { ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>" name="image_src" id="image_src" />
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="No Image">
                                                    <?php
                                                }
                                                ?>
                                                                                            </div>
                                            <div class="">
                                                <div id="content" class="col-md-10  inputtype-comment" style="padding-left: 7px;">
                                                    <div contenteditable="true" style="min-height:37px !important; margin-top: 0px!important" class="editable_text" name="<?php echo $key['art_post_id']; ?>" id="<?php echo "post_comment" . $key['art_post_id']; ?>" placeholder="Type Message ..." onclick="entercomment(<?php echo $key['art_post_id']; ?>)"></div>
                                                </div>
                                                <?php echo form_error('post_comment'); ?>
                                                <div class=" comment-edit-butn">   
                                                    <button id="<?php echo $key['art_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button> 
                                                </div>
                                            </div>
                                        </div>

                                       
                                       

                                    
                                </div>
                                

         </div>
         <?php }}}?>
</div>

</div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                   <!--  col-md-7 close -->
</div>
</div>
</div>
<!-- Bid-modal  -->
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

                    </body>

                    </html>

<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
                    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
                    <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
                    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
                    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script>





<script type="text/javascript">
                                                                        var text = document.getElementById("search").value;
//alert(text);

                                                                        $(".search").highlite({

                                                                            text: text



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
                    <script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword = document.getElementById('tags').value;
                            var searchplace = document.getElementById('searchplace').value;
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>
                    <script>
                        //select2 autocomplete start for skill
                        $('#searchskills').select2({

                            placeholder: 'Find Your Skills',

                            ajax: {

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



                    </script>
<!-- popup form edit start -->

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

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
                    <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">

                        //validation for edit email formate form

                        $(document).ready(function () {

                            $("#artpostform").validate({

                                rules: {

                                    postname: {

                                        required: true,
                                    },

                                    // skills: {

                                    //   require_from_group: [1, ".skill-group"]
                                    //     //required: true,
                                    // },

                                    // other_skill: {

                                    //     require_from_group: [1, ".skill-group"]
                                    //     //required: true,
                                    // },


                                    description: {
                                        required: true,

                                    },

                                    // postattach: {

                                    //      required: true,

                                    //  },

                                },

                                messages: {

                                    postname: {

                                        required: "Post name Is Required.",

                                    },

                                    // skills: {

                                    //     required: "Skill Is Required.",

                                    // },

                                    description: {
                                        required: "Description is required",

                                    },
                                    // postattach: {

                                    //     required: "Attachment Is Required.",

                                    // },

                                },

                            });
                        });
                    </script>

                    <!-- javascript validation End -->
 <!-- post like script start -->

                    <script type="text/javascript">
                        function post_like(clicked_id)
                        {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/like_post" ?>',
                                dataType: 'json',
                                data: 'post_id=' + clicked_id,
                                success: function (data) {
                                    $('.' + 'likepost' + clicked_id).html(data.like);
                                    $('.likeusername' + clicked_id).html(data.likeuser);

                                    $('.likeduserlist' + clicked_id).hide();
                                    if (data.like_user_count == '0') {
                                        document.getElementById('likeusername' + clicked_id).style.display = "none";
                                    } else {
                                        document.getElementById('likeusername' + clicked_id).style.display = "block";
                                    }
                                    $('#likeusername' + clicked_id).addClass('likeduserlist1');
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
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/like_comment" ?>',
                                data: 'post_id=' + clicked_id,
                                success: function (data) {
                                    $('#' + 'likecomment' + clicked_id).html(data);

                                }
                            });
                        }
                    </script>

                    <script type="text/javascript">
                        function comment_like1(clicked_id)
                        {

                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/like_comment1" ?>',
                                data: 'post_id=' + clicked_id,
                                success: function (data) {
                                    $('#' + 'likecomment1' + clicked_id).html(data);

                                }
                            });
                        }
                    </script>

                    <!--comment like script end -->

                    <!-- comment delete script start -->
<script type="text/javascript">

                        function comment_delete(clicked_id) {
                            $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        }

                        function comment_deleted(clicked_id)
                        {
                            var post_delete = document.getElementById("post_delete");
                            //alert(post_delete.value);
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/delete_comment" ?>',
                                data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
                                dataType: "json",
                                success: function (data) {
                                    //alert('.' + 'insertcomment' + clicked_id);
                                    $('.' + 'insertcomment' + post_delete.value).html(data.comment);
                                    $('#' + 'insertcount' + post_delete.value).html(data.count);
                                    $('.post-design-commnet-box').show();
                                }
                            });
                        }

                        function comment_deletetwo(clicked_id)
                        {
                            $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        }

                    </script>
<script type="text/javascript">
                        function comment_deletedtwo(clicked_id)
                        {
                            var post_delete1 = document.getElementById("post_deletetwo");
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
                                data: 'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
                                dataType: "json",
                                success: function (data) {

                                    // $('.' + 'insertcomment' + post_delete.value).html(data);
                                    $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
                                    $('#' + 'insertcount' + post_delete1.value).html(data.count);
                                    $('.post-design-commnet-box').show();

                                }
                            });
                        }


//                        function comment_deletetwo(clicked_id)
//                        {
//
//                            var post_delete = document.getElementById("post_delete2");
//
//                            $.ajax({
//                                type: 'POST',
//                                url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
//                                data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
//                                success: function (data) {
//
//                                    $('#' + 'fourcomment' + post_delete.value).html(data);
//
//                                }
//                            });
//                        }
                    </script>

                    <!--comment delete script end -->

<!-- comment insert script start -->
                    <!-- insert comment using comment button-- > 
                    <!-- insert comment using enter -->
                    <script type="text/javascript">

//                        function insert_comment(clicked_id)
//                        {
//                            var $field = $('#post_comment' + clicked_id);
//                            var post_comment = $('#post_comment' + clicked_id).html();
//                            
//                            $('#post_comment' + clicked_id).html("");
//
//                            var x = document.getElementById('threecomment' + clicked_id);
//                            var y = document.getElementById('fourcomment' + clicked_id);
//
//                            if (post_comment == '') {
//
//                                event.preventDefault();
//                                return false;
//                            } else {
//
//                                if (x.style.display === 'block' && y.style.display === 'none') {
//
//                                    $.ajax({
//                                        type: 'POST',
//                                        url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
//                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
//                                        dataType: "json",
//                                        success: function (data) {
//
//                                            //$('.' + 'insertcomment' + clicked_id).html(data);
//                                            $('#' + 'insertcount' + clicked_id).html(data.count);
//                                            $('.insertcomment' + clicked_id).html(data.comment);
//
//                                        }
//                                    });
//
//                                } else {
//
//                                    $.ajax({
//                                        type: 'POST',
//                                        url: '<?php echo base_url() . "artistic/insert_comment" ?>',
//                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
//                                        dataType: "json",
//                                        success: function (data) {
//                                            $('textarea').each(function () {
//                                                $(this).val('');
//                                            });
//                                            $('#' + 'insertcount' + clicked_id).html(data.count);
//                                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
//                                        }
//                                    });
//
//                                }
//                            }
//
//                        }

                        function insert_comment(clicked_id)
                        {
                            $("#post_comment" + clicked_id).click(function () {
                                $(this).prop("contentEditable", true);
                                $(this).html("");
                            });

                            var sel = $("#post_comment" + clicked_id);
                            var txt = sel.html();
                            if (txt == '') {
                                return false;
                            }

                            $('#post_comment' + clicked_id).html("");

                            var x = document.getElementById('threecomment' + clicked_id);
                            var y = document.getElementById('fourcomment' + clicked_id);

                            if (x.style.display === 'block' && y.style.display === 'none') {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                                    data: 'post_id=' + clicked_id + '&comment=' + txt,
                                    dataType: "json",
                                    success: function (data) {
                                        $('textarea').each(function () {
                                            $(this).val('');
                                        });
                                        $('#' + 'insertcount' + clicked_id).html(data.count);
                                        $('.insertcomment' + clicked_id).html(data.comment);

                                    }
                                });

                            } else {

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                                    data: 'post_id=' + clicked_id + '&comment=' + txt,
                                    dataType: "json",
                                    success: function (data) {
                                        $('textarea').each(function () {
                                            $(this).val('');
                                        });
                                        $('#' + 'insertcount' + clicked_id).html(data.count);
                                        $('#' + 'fourcomment' + clicked_id).html(data.comment);
                                    }
                                });
                            }
                        }

                    </script>
<script type="text/javascript">

//                        function entercomment(clicked_id)
//                        {
//                            $('#post_comment' + clicked_id).keypress(function (e) {
//                                if (e.keyCode == 13 && !e.shiftKey) {
//                                    var val = $('#post_comment' + clicked_id).val();
//                                    e.preventDefault();
//
//                                    if (window.preventDuplicateKeyPresses)
//                                        return;
//
//                                    window.preventDuplicateKeyPresses = true;
//                                    window.setTimeout(function () {
//                                        window.preventDuplicateKeyPresses = false;
//                                    }, 500);
//                                    var x = document.getElementById('threecomment' + clicked_id);
//                                    var y = document.getElementById('fourcomment' + clicked_id);
//
//                                    if (val == '') {
//
//                                        event.preventDefault();
//                                        return false;
//                                    } else {
//
//                                        if (x.style.display === 'block' && y.style.display === 'none') {
//                                            $.ajax({
//                                                type: 'POST',
//                                                url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
//                                                data: 'post_id=' + clicked_id + '&comment=' + val,
//                                                dataType: "json",
//                                                success: function (data) {
//                                                    $('textarea').each(function () {
//                                                        $(this).val('');
//                                                    });
//
//                                                    //  $('.insertcomment' + clicked_id).html(data);
//                                                    $('#' + 'insertcount' + clicked_id).html(data.count);
//                                                    $('.insertcomment' + clicked_id).html(data.comment);
//
//                                                }
//                                            });
//
//                                        } else {
//
//                                            $.ajax({
//                                                type: 'POST',
//                                                url: '<?php echo base_url() . "artistic/insert_comment" ?>',
//                                                data: 'post_id=' + clicked_id + '&comment=' + val,
//                                                // dataType: "json",
//                                                success: function (data) {
//                                                    $('textarea').each(function () {
//                                                        $(this).val('');
//                                                    });
//                                                    $('#' + 'fourcomment' + clicked_id).html(data);
//                                                }
//                                            });
//                                        }
//                                    }
//                                    e.preventDefault();
//                                }
//                            });
//                        }


                        function entercomment(clicked_id)
                        {
                            $("#post_comment" + clicked_id).click(function () {
                                $(this).prop("contentEditable", true);
                            });

                            $('#post_comment' + clicked_id).keypress(function (e) {

                                if (e.keyCode == 13 && !e.shiftKey) {
                                    e.preventDefault();
                                    var sel = $("#post_comment" + clicked_id);
                                    var txt = sel.html();
                                    if (txt == '') {
                                        return false;
                                    }
                                    $('#post_comment' + clicked_id).html("");

                                    if (window.preventDuplicateKeyPresses)
                                        return;

                                    window.preventDuplicateKeyPresses = true;
                                    window.setTimeout(function () {
                                        window.preventDuplicateKeyPresses = false;
                                    }, 500);

                                    var x = document.getElementById('threecomment' + clicked_id);
                                    var y = document.getElementById('fourcomment' + clicked_id);



                                    if (x.style.display === 'block' && y.style.display === 'none') {
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                                            data: 'post_id=' + clicked_id + '&comment=' + txt,
                                            dataType: "json",
                                            success: function (data) {
                                                $('textarea').each(function () {
                                                    $(this).val('');
                                                });
                                                $('#' + 'insertcount' + clicked_id).html(data.count);
                                                $('.insertcomment' + clicked_id).html(data.comment);
                                            }
                                        });
                                    } else {
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                                            data: 'post_id=' + clicked_id + '&comment=' + txt,
                                            dataType: "json",
                                            success: function (data) {
                                                $('textarea').each(function () {
                                                    $(this).val('');
                                                });
                                                $('#' + 'insertcount' + clicked_id).html(data.count);
                                                $('#' + 'fourcomment' + clicked_id).html(data.comment);
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
                    </script>

                    <!--comment insert script end -->

                    <!-- comment edit script start -->
<!-- comment edit box start-->
                    <script type="text/javascript">

                        function comment_editbox(clicked_id) {
                            document.getElementById('editcomment' + clicked_id).style.display = 'inline-block';
                            document.getElementById('showcomment' + clicked_id).style.display = 'none';
                            document.getElementById('editsubmit' + clicked_id).style.display = 'inline-block';
                            //document.getElementById('editbox' + clicked_id).style.display = 'none';
                            document.getElementById('editcommentbox' + clicked_id).style.display = 'none';
                            document.getElementById('editcancle' + clicked_id).style.display = 'block';
                            $('.post-design-commnet-box').hide();
                        }


                        function comment_editcancle(clicked_id) {
                            document.getElementById('editcommentbox' + clicked_id).style.display = 'block';
                            document.getElementById('editcancle' + clicked_id).style.display = 'none';
                            document.getElementById('editcomment' + clicked_id).style.display = 'none';
                            document.getElementById('showcomment' + clicked_id).style.display = 'block';
                            document.getElementById('editsubmit' + clicked_id).style.display = 'none';

                            $('.post-design-commnet-box').show();
                        }

                        function comment_editboxtwo(clicked_id) {
//                            alert('editcommentboxtwo' + clicked_id);
//                            return false;
                            $('div[id^=editcommenttwo]').css('display', 'none');
                            $('div[id^=showcommenttwo]').css('display', 'block');
                            $('button[id^=editsubmittwo]').css('display', 'none');
                            $('div[id^=editcommentboxtwo]').css('display', 'block');
                            $('div[id^=editcancletwo]').css('display', 'none');

                            document.getElementById('editcommenttwo' + clicked_id).style.display = 'inline-block';
                            document.getElementById('showcommenttwo' + clicked_id).style.display = 'none';
                            document.getElementById('editsubmittwo' + clicked_id).style.display = 'inline-block';
                            document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'none';
                            document.getElementById('editcancletwo' + clicked_id).style.display = 'block';
                            $('.post-design-commnet-box').hide();
                        }


                        function comment_editcancletwo(clicked_id) {

                            document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'block';
                            document.getElementById('editcancletwo' + clicked_id).style.display = 'none';

                            document.getElementById('editcommenttwo' + clicked_id).style.display = 'none';
                            document.getElementById('showcommenttwo' + clicked_id).style.display = 'block';
                            document.getElementById('editsubmittwo' + clicked_id).style.display = 'none';
                            $('.post-design-commnet-box').show();
                        }

                        function comment_editbox3(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
                            document.getElementById('editcomment3' + clicked_id).style.display = 'block';
                            document.getElementById('showcomment3' + clicked_id).style.display = 'none';
                            document.getElementById('editsubmit3' + clicked_id).style.display = 'block';

                            document.getElementById('editcommentbox3' + clicked_id).style.display = 'none';
                            document.getElementById('editcancle3' + clicked_id).style.display = 'block';
                            $('.post-design-commnet-box').hide();

                        }

                        function comment_editcancle3(clicked_id) {

                            document.getElementById('editcommentbox3' + clicked_id).style.display = 'block';
                            document.getElementById('editcancle3' + clicked_id).style.display = 'none';

                            document.getElementById('editcomment3' + clicked_id).style.display = 'none';
                            document.getElementById('showcomment3' + clicked_id).style.display = 'block';
                            document.getElementById('editsubmit3' + clicked_id).style.display = 'none';

                            $('.post-design-commnet-box').show();

                        }

                        function comment_editbox4(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
                            document.getElementById('editcomment4' + clicked_id).style.display = 'block';
                            document.getElementById('showcomment4' + clicked_id).style.display = 'none';
                            document.getElementById('editsubmit4' + clicked_id).style.display = 'block';

                            document.getElementById('editcommentbox4' + clicked_id).style.display = 'none';
                            document.getElementById('editcancle4' + clicked_id).style.display = 'block';

                            $('.post-design-commnet-box').hide();

                        }

                        function comment_editcancle4(clicked_id) {

                            document.getElementById('editcommentbox4' + clicked_id).style.display = 'block';
                            document.getElementById('editcancle4' + clicked_id).style.display = 'none';

                            document.getElementById('editcomment4' + clicked_id).style.display = 'none';
                            document.getElementById('showcomment4' + clicked_id).style.display = 'block';
                            document.getElementById('editsubmit4' + clicked_id).style.display = 'none';

                            $('.post-design-commnet-box').show();

                        }
                    </script>

                    <!--comment edit box end-->
<!-- comment edit insert start -->
                    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
                    <script type="text/javascript">
                        //                        function edit_comment(abc)
                        //                        {
                        //                            var $field = $('#editcomment' + abc);
                        //                            var editpostdetails = $('#editcomment' + abc).html();
                        //                            if (editpostdetails == '') {
                        //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        //                                $('#bidmodal').modal('show');
                        //                            } else {
                        //                                $.ajax({
                        //                                    type: 'POST',
                        //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                        //                                    data: 'post_id=' + abc + '&comment=' + editpostdetails,
                        //                                    success: function (data) {
                        //                                        document.getElementById('editcomment' + abc).style.display = 'none';
                        //                                        document.getElementById('showcomment' + abc).style.display = 'block';
                        //                                        document.getElementById('editsubmit' + abc).style.display = 'none';
                        //                                        document.getElementById('editbox' + abc).style.display = 'block';
                        //                                        document.getElementById('editcancle' + abc).style.display = 'none';
                        //                                        $('#' + 'showcomment' + abc).html(data);
                        //                                    }
                        //                                });
                        //                            }
                        //                        }

                        function edit_comment(abc)
                        {
                            $("#editcomment" + abc).click(function () {
                                $(this).prop("contentEditable", true);
                            });

                            var sel = $("#editcomment" + abc);
                            var txt = sel.html();
                            if (txt == '' || txt == '<br>') {
                                $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                $('#bidmodal').modal('show');
                                return false;
                            }
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                                data: 'post_id=' + abc + '&comment=' + txt,
                                success: function (data) {
                                    document.getElementById('editcomment' + abc).style.display = 'none';
                                    document.getElementById('showcomment' + abc).style.display = 'block';
                                    document.getElementById('editsubmit' + abc).style.display = 'none';
                                    document.getElementById('editcommentbox' + abc).style.display = 'block';
                                    document.getElementById('editcancle' + abc).style.display = 'none';
                                    $('#' + 'showcomment' + abc).html(data);
                                    $('.post-design-commnet-box').show();
                                }
                            });
                            $(".scroll").click(function (event) {
                                event.preventDefault();
                                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
                            });
                        }
                    </script>
<script type="text/javascript">

                        //                        function commentedit(abc)
                        //                        {
                        //                                $('#editcomment' + abc).keypress(function (e) {
                        //                                if (event.which == 13 && event.shiftKey != 1) {
                        //                                    var $field = $('#editcomment' + abc);
                        //                                    var editpostdetails = $('#editcomment' + abc).html();
                        //                                    if (editpostdetails == '') {
                        //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        //                                        $('#bidmodal').modal('show');
                        //                                    } else {
                        //                                        $.ajax({
                        //                                            type: 'POST',
                        //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                        //                                            data: 'post_id=' + abc + '&comment=' + editpostdetails,
                        //                                            success: function (data) {
                        //                                                document.getElementById('editcomment' + abc).style.display = 'none';
                        //                                                document.getElementById('showcomment' + abc).style.display = 'block';
                        //                                                document.getElementById('editsubmit' + abc).style.display = 'none';
                        //                                                document.getElementById('editbox' + abc).style.display = 'block';
                        //                                                document.getElementById('editcancle' + abc).style.display = 'none';
                        //                                                $('#' + 'showcomment' + abc).html(data);
                        //                                            }
                        //                                        });
                        //                                    }
                        //                                    e.preventDefault();
                        //                                }
                        //                            });
                        //                        }

                        function commentedit(abc)
                        {
                            $("#editcomment" + abc).click(function () {
                                $(this).prop("contentEditable", true);
                            });
                            $('#editcomment' + abc).keypress(function (event) {
                                if (event.which == 13 && event.shiftKey != 1) {
                                    event.preventDefault();
                                    var sel = $("#editcomment" + abc);
                                    var txt = sel.html();
                                    if (txt == '' || txt == '<br>') {
                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
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
                                        url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                                        data: 'post_id=' + abc + '&comment=' + txt,
                                        success: function (data) {
                                            document.getElementById('editcomment' + abc).style.display = 'none';
                                            document.getElementById('showcomment' + abc).style.display = 'block';
                                            document.getElementById('editsubmit' + abc).style.display = 'none';
                                            document.getElementById('editcommentbox' + abc).style.display = 'block';
                                            document.getElementById('editcancle' + abc).style.display = 'none';
                                            $('#' + 'showcomment' + abc).html(data);
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

<script type="text/javascript">
                        //                        function edit_commenttwo(abc)
                        //                        {
                        //                            var post_comment_edit = document.getElementById("editcommenttwo" + abc);
                        //                            if (post_comment_edit.value == '') {
                        //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        //                                $('#bidmodal').modal('show');
                        //                            } else {
                        //                                $.ajax({
                        //                                    type: 'POST',
                        //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                        //                                    data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
                        //                                    success: function (data) {
                        //                                        document.getElementById('showcommenttwo' + abc).style.display = 'block';
                        //                                        document.getElementById('showcommenttwo' + abc).innerHTML = data;
                        //                                        document.getElementById('editboxtwo' + abc).style.display = 'block';
                        //                                        document.getElementById('editcommenttwo' + abc).style.display = 'none';
                        //                                        document.getElementById('editsubmittwo' + abc).style.display = 'none';
                        //                                        document.getElementById('editcancletwo' + abc).style.display = 'none';
                        //                                    }
                        //                                });
                        //                            }
                        //                        }

                        function edit_commenttwo(abc)
                        {
                            $("#editcommenttwo" + abc).click(function () {
                                $(this).prop("contentEditable", true);
                            });

                            var sel = $("#editcommenttwo" + abc);
                            var txt = sel.html();
                            if (txt == '' || txt == '<br>') {
                                $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                $('#bidmodal').modal('show');
                                return false;
                            }
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                                data: 'post_id=' + abc + '&comment=' + txt,
                                success: function (data) {
                                    document.getElementById('editcommenttwo' + abc).style.display = 'none';
                                    document.getElementById('showcommenttwo' + abc).style.display = 'block';
                                    document.getElementById('editsubmittwo' + abc).style.display = 'none';
                                    document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                                    document.getElementById('editcancletwo' + abc).style.display = 'none';
                                    $('#' + 'showcommenttwo' + abc).html(data);
                                    $('.post-design-commnet-box').show();
                                }
                            });
                            $(".scroll").click(function (event) {
                                event.preventDefault();
                                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
                            });
                        }
                    </script>
<script type="text/javascript">

                        //                        function commentedittwo(abc)
                        //                        {
                        //                            $('#editcommenttwo' + abc).keypress(function (e) {
                        //                                if (e.which == 13) {
                        //                                    var val = $('#editcommenttwo' + abc).val();
                        //
                        //                                    if (val == '') {
                        //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                        //                                        $('#bidmodal').modal('show');
                        //                                    } else {
                        //                                        $.ajax({
                        //                                            type: 'POST',
                        //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                        //                                            data: 'post_id=' + abc + '&comment=' + val,
                        //                                            success: function (data) {
                        //                                                document.getElementById('editcommenttwo' + abc).style.display = 'none';
                        //                                                document.getElementById('showcommenttwo' + abc).style.display = 'block';
                        //                                                document.getElementById('editsubmittwo' + abc).style.display = 'none';
                        //                                                document.getElementById('editboxtwo' + abc).style.display = 'block';
                        //                                                document.getElementById('editcancletwo' + abc).style.display = 'none';
                        //                                                $('#' + 'showcommenttwo' + abc).html(data);
                        //                                            }
                        //                                        });
                        //                                    }
                        //                                    e.preventDefault();
                        //                                }
                        //                            });
                        //                        }

                        function commentedittwo(abc)
                        {
                            $("#editcommenttwo" + abc).click(function () {
                                $(this).prop("contentEditable", true);
                                //$(this).html("");
                            });
                            $('#editcommenttwo' + abc).keypress(function (event) {
                                if (event.which == 13 && event.shiftKey != 1) {
                                    event.preventDefault();
                                    var sel = $("#editcommenttwo" + abc);
                                    var txt = sel.html();
                                    if (txt == '' || txt == '<br>') {
                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
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
                                        url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                                        data: 'post_id=' + abc + '&comment=' + txt,
                                        success: function (data) {
                                            document.getElementById('editcommenttwo' + abc).style.display = 'none';
                                            document.getElementById('showcommenttwo' + abc).style.display = 'block';
                                            document.getElementById('editsubmittwo' + abc).style.display = 'none';

                                            document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                                            document.getElementById('editcancletwo' + abc).style.display = 'none';

                                            $('#' + 'showcommenttwo' + abc).html(data);
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

                    <!--comment edit insert script end -->
<!-- hide and show data start-->
                    <script type="text/javascript">
                        function commentall(clicked_id) {
                            var x = document.getElementById('threecomment' + clicked_id);
                            var y = document.getElementById('fourcomment' + clicked_id);
                            var z = document.getElementById('insertcount' + clicked_id);

                            if (x.style.display === 'block' && y.style.display === 'none') {
                                x.style.display = 'none';
                                y.style.display = 'block';
                                z.style.visibility = 'show';
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url() . "artistic/fourcomment" ?>',
                                    data: 'art_post_id=' + clicked_id,
                                    //alert(data);
                                    success: function (data) {
                                        $('#' + 'fourcomment' + clicked_id).html(data);
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
                    </script>
                    <!-- hide and show data end-->

                    <!-- popup box for post start -->

                    <script>
                        // Get the modal
                        var modal = document.getElementById('myModal');

                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtn");

                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close1")[0];

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

                    <!-- popup form end-->

<script>
                        /* When the user clicks on the button, 
                         toggle between hiding and showing the dropdown content */
                        function myFunction(clicked_id) {
                            document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
                        }

                        // Close the dropdown if the user clicks outside of it
                        window.onclick = function (event) {
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
 <!-- further and less -->
                    <script>
                        $(function () {
                            var showTotalChar = 200, showChar = "More", hideChar = "less";
                            $('.show').each(function () {
                                //var content = $(this).text();
                                var content = $(this).html();
                                if (content.length > showTotalChar) {
                                    var con = content.substr(0, showTotalChar);
                                    var hcon = content.substr(showTotalChar, content.length - showTotalChar);
                                    var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
                                    $(this).html(txt);
                                }
                            });
                            $(".showmoretxt").click(function () {
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

<!-- multi image add post khyati start -->

                    <script type="text/javascript">
                        //alert("a");
                        var $fileUpload = $("#files"),
                                $list = $('#list'),
                                thumbsArray = [],
                                maxUpload = 10;

                        // READ FILE + CREATE IMAGE
                        function read(f) {//alert("aa");
                            return function (e) {
                                var base64 = e.target.result;
                                var $img = $('<img/>', {
                                    src: base64,
                                    title: encodeURIComponent(f.name), //( escape() is deprecated! )
                                    "class": "thumb"
                                });
                                var $thumbParent = $("<span/>", {html: $img, "class": "thumbParent"}).append('<span class="remove_thumb"/>');
                                thumbsArray.push(base64); // Push base64 image into array or whatever.
                                $list.append($thumbParent);
                            };
                        }

                        // HANDLE FILE/S UPLOAD
                        function handleFileSelect(e) {//alert("aaa");
                            e.preventDefault(); // Needed?
                            var files = e.target.files;
                            var len = files.length;
                            if (len > maxUpload || thumbsArray.length >= maxUpload) {
                                return alert("Sorry you can upload only 5 images");
                            }
                            for (var i = 0; i < len; i++) {
                                var f = files[i];
                                if (!f.type.match('image.*'))
                                    continue; // Only images allowed    
                                var reader = new FileReader();
                                reader.onload = read(f); // Call read() function
                                reader.readAsDataURL(f);
                            }
                        }

                        $fileUpload.change(function (e) {//alert("aaaa");
                            handleFileSelect(e);
                        });

                        $list.on('click', '.remove_thumb', function () {//alert("aaaaa");
                            var $removeBtns = $('.remove_thumb'); // Get all of them in collection
                            var idx = $removeBtns.index(this);   // Exact Index-from-collection
                            $(this).closest('span.thumbParent').remove(); // Remove tumbnail parent
                            thumbsArray.splice(idx, 1); // Remove from array
                        });



                    </script>
                    <!-- multi image add post khyati end -->
                    <!-- success message remove after some second start -->
                    <script type="text/javascript">
                        $(document).ready(function () {

                            $('.alert-danger').delay(3000).hide('700');

                            $('.alert-success').delay(3000).hide('700');

                        });

                    </script>

                    <!-- success message remove after some second end -->
                    <!-- edit post start -->

                    <script type="text/javascript">
                        function editpost(abc)
                        {
                            document.getElementById('editpostdata' + abc).style.display = 'none';
                            document.getElementById('editpostbox' + abc).style.display = 'block';
                            document.getElementById('editpostdetails' + abc).style.display = 'none', 'display:inline !important';
                            document.getElementById('editpostdetailbox' + abc).style.display = 'block';
                            document.getElementById('editpostsubmit' + abc).style.display = 'block';
                        }
                    </script>
<script type="text/javascript">
                        function edit_postinsert(abc)
                        {

                            var editpostname = document.getElementById("editpostname" + abc);
                            // var editpostdetails = document.getElementById("editpostdesc" + abc);
                            // start khyati code
                            var $field = $('#editpostdesc' + abc);
                            //var data = $field.val();
                            var editpostdetails = $('#editpostdesc' + abc).html();
                            // end khyati code

                            if ((editpostname.value == '') && (editpostdetails == '' || editpostdetails == '<br>')) {
                                $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
                                $('#bidmodal').modal('show');

                                document.getElementById('editpostdata' + abc).style.display = 'block';
                                document.getElementById('editpostbox' + abc).style.display = 'none';
                                document.getElementById('editpostdetails' + abc).style.display = 'block';
                                document.getElementById('editpostdetailbox' + abc).style.display = 'none';

                                document.getElementById('editpostsubmit' + abc).style.display = 'none';
                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url() . "artistic/edit_post_insert" ?>',
                                    data: 'art_post_id=' + abc + '&art_post=' + editpostname.value + '&art_description=' + editpostdetails,
                                    dataType: "json",
                                    success: function (data) {

                                        document.getElementById('editpostdata' + abc).style.display = 'block';
                                        document.getElementById('editpostbox' + abc).style.display = 'none';
                                        document.getElementById('editpostdetails' + abc).style.display = 'block';
                                        document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                                        document.getElementById('editpostsubmit' + abc).style.display = 'none';
                                        //alert(data.description);
                                        $('#' + 'editpostdata' + abc).html(data.title);
                                        $('#' + 'editpostdetails' + abc).html(data.description);
                                    }
                                });
                            }

                        }
                    </script>
<!-- save post start -->

                    <script type="text/javascript">
                        function save_post(abc)
                        {

                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/artistic_save" ?>',
                                data: 'art_post_id=' + abc,
                                success: function (data) {

                                    $('.' + 'savedpost' + abc).html(data);
                                    //window.setTimeout(update, 10000);

                                }
                            });

                        }
                    </script>

                    <!-- save post end -->
<!-- remove save post start -->
                    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

                    <script type="text/javascript">

                        function deleteownpostmodel(abc) {


                            $('.biderror .mes').html("<div class='pop_content'>Are you sure want to Delete Your post?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='remove_post(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        }

                    </script>
<script type="text/javascript">
                        function remove_post(abc)
                        {

                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/art_deletepost" ?>',
                                data: 'art_post_id=' + abc,
                                //alert(data);
                                success: function (data) {

                                    $('#' + 'removepost' + abc).html(data);


                                }
                            });

                        }
                    </script>
 <!-- remove particular user post start -->

                    <script type="text/javascript">

                        function deletepostmodel(abc) {


                            $('.biderror .mes').html("<div class='pop_content'>Are you sure want to Delete this post From Your Profile?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='del_particular_userpost(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');
                        }

                    </script><script type="text/javascript">
                        function del_particular_userpost(abc)
                        {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/del_particular_userpost" ?>',
                                data: 'art_post_id=' + abc,
                                //alert(data);
                                success: function (data) {

                                    $('#' + 'removepost' + abc).html(data);


                                }
                            });

                        }

                    </script>

                    <!-- remove particular user post end -->



 <script type="text/javascript">
    function followuser(clicked_id)
    {
      //alert(clicked_id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "artistic/follow" ?>',
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
            url: '<?php echo base_url() . "artistic/unfollow" ?>',
            data: 'follow_to=' + clicked_id,
            success: function (data) {

                $('.' + 'fruser' + clicked_id).html(data);

            }
        });
    }
</script>
<script type="text/javascript">
                        function followclose(clicked_id)
                        {
                            $("#fad" + clicked_id).fadeOut(3000);
                        }
                    </script>
                    <!--follow like script end -->
<!-- insert post validtation start -->

                    <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
                    <script type="text/javascript">

                        function imgval(event) {
                            //var fileInput = document.getElementById('test-upload');
                            var fileInput = document.getElementById("test-upload").files;
                            var product_name = document.getElementById("test-upload_product").value;
                            var product_description = document.getElementById("test-upload_des").value;
                            var product_fileInput = document.getElementById("test-upload").value;


                            if (product_fileInput == '' && product_name == '' && product_description == '')
                            {

                                $('.biderror .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
                                $('#bidmodal').modal('show');
                                setInterval('window.location.reload()', 10000);
                                // window.location='';
                                event.preventDefault();
                                return false;

                            } else {


                                for (var i = 0; i < fileInput.length; i++)
                                {
                                    var vname = fileInput[i].name;
                                    var vfirstname = fileInput[0].name;
                                    var ext = vfirstname.split('.').pop();
                                    var ext1 = vname.split('.').pop();
                                    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                    var allowesvideo = ['mp4', 'webm'];
                                    var allowesaudio = ['mp3'];
                                    var allowespdf = ['pdf'];

                                    var foundPresent = $.inArray(ext, allowedExtensions) > -1;
                                    var foundPresentvideo = $.inArray(ext, allowesvideo) > -1;
                                    var foundPresentaudio = $.inArray(ext, allowesaudio) > -1;
                                    var foundPresentpdf = $.inArray(ext, allowespdf) > -1;

                                    if (foundPresent == true)
                                    {
                                        var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;

                                        if (foundPresent1 == true && fileInput.length <= 10) {
                                        } else {

                                            $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                            $('#bidmodal').modal('show');
                                            setInterval('window.location.reload()', 10000);
                                            // window.location='';
                                            event.preventDefault();
                                            return false;
                                        }

                                    } else if (foundPresentvideo == false) {

                                        $('.biderror .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files..");
                                        $('#bidmodal').modal('show');
                                        setInterval('window.location.reload()', 10000);
                                        event.preventDefault();
                                        return false;

                                    } else if (foundPresentvideo == true)
                                    {

                                        var foundPresent1 = $.inArray(ext1, allowesvideo) > -1;

                                        if (foundPresent1 == true && fileInput.length == 1) {
                                        } else {
                                            $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                            $('#bidmodal').modal('show');
                                            setInterval('window.location.reload()', 10000);
                                            event.preventDefault();
                                            return false;
                                        }
                                    } else if (foundPresentaudio == true)
                                    {

                                        var foundPresent1 = $.inArray(ext1, allowesaudio) > -1;

                                        if (foundPresent1 == true && fileInput.length == 1) {
                                        } else {
                                            $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                            $('#bidmodal').modal('show');
                                            setInterval('window.location.reload()', 10000);
                                            event.preventDefault();
                                            return false;
                                        }
                                    } else if (foundPresentpdf == true)
                                    {

                                        var foundPresent1 = $.inArray(ext1, allowespdf) > -1;

                                        if (foundPresent1 == true && fileInput.length == 1) {

                                            if (product_name == '') {
                                                $('.biderror .mes').html("<div class='pop_content'>You have to add pdf title.");
                                                $('#bidmodal').modal('show');
                                                setInterval('window.location.reload()', 10000);
                                                event.preventDefault();
                                                return false;
                                            }
                                        } else {
                                            $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                            $('#bidmodal').modal('show');
                                            setInterval('window.location.reload()', 10000);
                                            event.preventDefault();
                                            return false;
                                        }
                                    }

                                }
                            }
                        }

                    </script>
                    <script type="text/javascript">

                        $(document).ready(function () {
                            $('.modal-close').on('click', function () {
                                $('.modal-post').hide();
                            });
                        });

                    </script>
<script type="text/javascript">
                        function contentedit(clicked_id) {
                            //var $field = $('#post_comment' + clicked_id);
                            //var data = $field.val();
                            // var post_comment = $('#post_comment' + clicked_id).html();
                            //$(document).ready(function($) {
                            $("#post_comment" + clicked_id).click(function () {
                                $(this).prop("contentEditable", true);
                                $(this).html("");
                            });
                            $("#post_comment" + clicked_id).keypress(function (event) { //alert(post_comment);
                                if (event.which == 13 && event.shiftKey != 1) { //alert(post_comment);
                                    event.preventDefault();
                                    var sel = $("#post_comment" + clicked_id);
                                    var txt = sel.html();

                                    $('#post_comment' + clicked_id).html("");
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
                                                url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                                                data: 'post_id=' + clicked_id + '&comment=' + txt,
                                                dataType: "json",
                                                success: function (data) {

                                                    //  $('.insertcomment' + clicked_id).html(data);
                                                    $('#' + 'insertcount' + clicked_id).html(data.count);
                                                    $('.insertcomment' + clicked_id).html(data.comment);

                                                }
                                            });

                                        } else {

                                            $.ajax({
                                                type: 'POST',
                                                url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                                                data: 'post_id=' + clicked_id + '&comment=' + txt,
                                                // dataType: "json",
                                                success: function (data) {
                                                    $('#' + 'fourcomment' + clicked_id).html(data);
                                                    // $('#' + 'insertcount' + clicked_id).html(data.count);
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

<script type="text/javascript">
                        $('#file-fr').fileinput({
                            language: 'fr',
                            uploadUrl: '#',
                            allowedFileExtensions: ['jpg', 'png', 'gif']
                        });
                        $('#file-es').fileinput({
                            language: 'es',
                            uploadUrl: '#',
                            allowedFileExtensions: ['jpg', 'png', 'gif']
                        });
                        $("#file-0").fileinput({
                            'allowedFileExtensions': ['jpg', 'png', 'gif']
                        });
                        $("#file-1").fileinput({
                            uploadUrl: '#', // you must set a valid URL here else you will get an error
                            allowedFileExtensions: ['jpg', 'png', 'gif'],
                            overwriteInitial: false,
                            maxFileSize: 1000,
                            maxFilesNum: 10,
                            //allowedFileTypes: ['image', 'video', 'flash'],
                            slugCallback: function (filename) {
                                return filename.replace('(', '_').replace(']', '_');
                            }
                        });

                        $(document).ready(function () {
                            $("#test-upload").fileinput({
                                'showPreview': false,
                                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                                'elErrorContainer': '#errorBlock'
                            });
                            $("#kv-explorer").fileinput({
                                'theme': 'explorer',
                                'uploadUrl': '#',
                                overwriteInitial: false,
                                initialPreviewAsData: true,
                                initialPreview: [
                                    "http://lorempixel.com/1920/1080/nature/1",
                                    "http://lorempixel.com/1920/1080/nature/2",
                                    "http://lorempixel.com/1920/1080/nature/3",
                                ],
                                initialPreviewConfig: [
                                    {caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
                                    {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                                    {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3},
                                ]
                            });

                        });
                    </script>
<script type="text/javascript">
                        function likeuserlist(post_id) {

                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "artistic/likeuserlist" ?>',
                                data: 'post_id=' + post_id,
                                dataType: "html",
                                success: function (data) {
                                    var html_data = data;
                                    $('#likeusermodal .mes').html(html_data);
                                    $('#likeusermodal').modal('show');
                                }
                            });


                        }
                    </script>
<style type="text/css">
                        .likeduser{
                            width: 100%;
                            background-color: #00002D;
                        }
                        .likeduser-title{
                            color: #fff;
                            margin-bottom: 5px;
                            padding: 7px;
                        }
                        .likeuser_list{
                            background-color: #ccc;
                            float: left;
                            margin: 0px 6px 5px 9px;
                            padding: 5px;
                            width: 47%;
                            font-size: 14px;
                        }
                        .likeduserlist, .likeduserlist1 {
                            float: left;
                            /*        margin-left: 15px;
                                    margin-right: 15px;*/
                            width: 96%;
                        }
                        div[class^="likeduserlist"]{
                            width: 100% !important;
                            background-color: #fff !important;
                        }
                        .like_one_other{
                           /* margin-left: 15px;*/
                            /*  margin-right: 15px;*/

                        }

                    </style>
