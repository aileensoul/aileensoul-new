<!--start head -->
<?php echo $head; ?>
<style type="text/css">
   #popup-form img{display: none;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.jMosaic.css'); ?>"-->
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<!-- END HEAD -->
<!-- start header -->
<style type="text/css">
  .paddingtop_fixed_aert{padding-top: 63px!important;}
</style>
<?php echo $header; ?>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<!-- script for cropiee immage End-->
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style></style>
<!-- END HEADER -->
<?php echo $business_header2_border; ?>
<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);
        
       $('html,body').animate({scrollTop:275}, 500);
   
   });
   //For Scroll page at perticular position js End
</script>
<!-- scroll page script end -->
<body   class="page-container-bg-solid page-boxed">
   <section>
      <!-- coer image start-->
      <div class="container" id="paddingtop_fixed_aert">
         <div class="row" id="row1" style="display:none;">
            <div class="col-md-12 text-center">
               <div id="upload-demo" ></div>
            </div>
            <div class="col-md-12 cover-pic" >
               <button class="btn btn-success  cancel-result" onclick="">Cancel</button>
               <button class="btn btn-success upload-result fr" onclick="myFunction()">Save</button>
               <div id="message1" style="display:none;">
                  <div class="loader">
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
            </div>
            <div class="col-md-12"  style="visibility: hidden; ">
               <div id="upload-demo-i"></div>
            </div>
         </div>
         <div class="container">
            <div class="row" id="row2">
               <?php
                  $userid = $this->session->userdata('aileenuser');
                  if ($this->uri->segment(3) == $userid) {
                      $user_id = $userid;
                  } elseif ($this->uri->segment(3) == "") {
                      $user_id = $userid;
                  } else {
                      $user_id = $user_id = $this->db->get_where('business_profile', array('business_slug' => $this->uri->segment(3)))->row()->user_id;
                      ;
                  }
                  $contition_array = array('user_id' => $user_id, 'is_deleted' => '0', 'status' => '1');
                  $image = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                  
                  $image_ori = $image[0]['profile_background'];
                  if ($image_ori) {
                      ?>
               <div class="bg-images">
                  <img src="<?php echo base_url($this->config->item('bus_bg_main_upload_path') . $image_ori); ?>" name="image_src" id="image_src" / >
               </div>
               <?php
                  } else {
                      ?>
               <div class="bg-images">
                  <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
               </div>
               <?php }
                  ?>
            </div>
         </div>
      </div>
      <?php
         $userid = $this->session->userdata('aileenuser');
         if ($businessdata1[0]['user_id'] == $userid) {
             ?>
      <div class="container">
         <div class="upload-img">
            <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
            </label>
         </div>
      </div>
      <?php } ?>
      <!-- coer image end-->
      <div class="container tablate-container">
            <?php
            $userid = $this->session->userdata('aileenuser');
            if ($businessdata1[0]['user_id'] == $userid) {
                ?>

                <div class="upload-img">


                    <label class="cameraButton"> <span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                        <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                    </label>
                </div>

            <?php } ?>
            <!-- coer image end-->

            <div class="profile-photo">
                <div class="buisness-menu">
                    
                    <div class="profile-pho-bui">

                        <div class="user-pic">
                            <?php if ($businessdata1[0]['business_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata1[0]['business_user_image']); ?>" alt="" >
                            <?php } else { ?>
                                <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>

                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($businessdata1[0]['user_id'] == $userid) {
                                ?>                                                                                                                        <!-- <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a> -->

                                <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                            <?php } ?>
                        </div>

                        <!-- <div id="popup-form">
                        <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="5">
                        <input type="submit" name="cancel5" id="cancel5" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                        <?php echo form_close(); ?>
                </div> -->

                    </div>
                    <div class="business-profile-right">
                    <div class="bui-menu-profile">



                        <h4 class="profile-head-text"><a href="<?php echo base_url('business_profile/business_resume/' . $businessdata1[0]['business_slug'] . ''); ?>"> <?php echo ucwords($businessdata1[0]['company_name']); ?></a></h4>

                        <h4 class="profile-head-text_dg"><a href="<?php echo base_url('business_profile/business_resume/' . $businessdata1[0]['business_slug'] . ''); ?>"> 


                                <?php
                                if ($businessdata1[0]['industriyal']) {
                                    echo
                                    $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                                }
                                if ($businessdata1[0]['other_industrial']) {
                                    echo ucwords($businessdata1[0]['other_industrial']);
                                }
                                ?>


                            </a></h4>

                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($businessdata1[0]['user_id'] != $userid) {
                            ?>
                            <!--   <div class="msg_flw_btn_2">
                                  <div  class="fr msg_flw_btn">
        
                                      <div class="<?php echo "fr" . $businessdata1[0]['business_profile_id']; ?>">
        
                            <?php
                            $userid = $this->session->userdata('aileenuser');

                            $contition_array = array('user_id' => $userid, 'status' => '1');

                            $bup_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                            $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $bup_id[0]['business_profile_id'], 'follow_to' => $businessdata1[0]['business_profile_id']))->row()->follow_status;
                            //echo "<pre>"; print_r($status); die();

                            if ($status == 0 || $status == " ") {
                                ?>                                                                                                                                                                                      <div class="msg_flw_btn_1" id= "followdiv">                                                                                                                                                                                          <button  id="<?php echo "follow" . $businessdata1[0]['business_profile_id']; ?>" onClick="followuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Follow</button>
                                                                                                                                                                                      </div>
                            <?php } elseif ($status == 1) { ?>                                                                                                                                                                                     <div class="msg_flw_btn_1" id= "unfollowdiv">                                                                                                                                                                                          <button id="<?php echo "unfollow" . $businessdata1[0]['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Following </button>
                                                                                                                                                                                      </div>
                            <?php } ?>
                                      </div> 
                                      <a href="<?php echo base_url('chat/abc/' . $businessdata1[0]['user_id']); ?>">Message</a>
                                  </div>
        
        
        
        
                              </div> -->
                        <?php } ?>


                                        <?php
                        $userid = $this->session->userdata('aileenuser');
                        if ($businessdata1[0]['user_id'] != $userid) {
                            ?> 
                    <div id="contact_per">

      <?php 

      $userid = $this->session->userdata('aileenuser');

      $busotherid = $this->uri->segment(3); 
      $contition_array = array('business_slug' => $busotherid, 'status' => '1');
      $busineslug = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
      $busuid = $busineslug[0]['user_id'];
   
     $contition_array = array('contact_type' => 2);

     $search_condition = "((contact_to_id = '$busuid' AND contact_from_id = ' $userid') OR (contact_from_id = '$busuid' AND contact_to_id = '$userid'))";

    $contactperson = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

            ?>


             <?php if($contactperson[0]['status'] == 'cancel' || $contactperson[0]['status'] == '' || $contactperson[0]['status'] == 'reject'){?>
                  <a href="#" onclick="return contact_person(<?php echo $businessdata1[0]['user_id']; ?>);" style="cursor: pointer;">

            <?php }elseif($contactperson[0]['status'] == 'pending' || $contactperson[0]['status'] == 'confirm'){ ?>   
                      <a onclick="return contact_person_model(<?php echo $businessdata1[0]['user_id']; ?>,<?php echo "'" . $contactperson[0]['status'] . "'"; ?>)" style="cursor: pointer;">
            <?php }?>
               
                    <div class="">
                        <div id="ripple" class="centered" >
                            <div class="circle"><span href="" class="add_r_c"><i class="fa fa-user-plus"  aria-hidden="true"></i></span></div>


                        </div>
                          <div class="addtocont">
                            <span class="ft-13"><i class="icon-user"></i>
            <?php 

        //print_r($contactperson[0]['status']) ; die();
        
                     if($contactperson[0]['status'] == 'cancel'){?>
                                Add to contact
                     <?php }elseif($contactperson[0]['status'] == 'pending'){ ?>   
                            Cancel request  
                     <?php }elseif($contactperson[0]['status'] == 'confirm'){ ?>
                        In your contact
                   <?php  }elseif($contactperson[0]['status'] == 'reject'){ ?>

                      Add to contact
                   <?php } else{?>

                   Add to contact
                   <?php }?>                            </span>
                        </div>
                    </div>
                </a>
                    </div>

                    <?php }?>
                    </div>
                    <!-- PICKUP -->
                    <!-- menubar -->
                    <div class="business-data-menu padding_less_right ">

                        

                        <div class="profile-main-box-buis-menu">  
                           
                        <div class="profile-main-box-buis-menu ml0">  
                                   <?php 
               $userid = $this->session->userdata('aileenuser');
               if($businessdata1[0]['user_id'] == $userid){
               
               ?>     
             <ul class="current-user bpro-fw6">
                   
                   <?php }else{?>
                 <ul class="bpro-fw">
                   <?php } ?>  




                                <li class="active" <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $businessdata1[0]['business_slug']); ?>">Dashboard</a>
                                </li>

                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_resume') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/business_resume/' . $businessdata1[0]['business_slug']); ?>"> Details</a>
                                </li>

                                <?php
                                        $userid = $this->session->userdata('aileenuser');
                                        if ($businessdata1[0]['user_id'] == $userid) {
                                            ?> 

                                        <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'bus_contact') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/bus_contact/' . $businessdata1[0]['business_slug']); ?>"> Contacts <br>  (<?php echo (count($businesscontacts)); ?>)</a>
                                        </li>


                                        <?php }else{

                                            $userid = $businessdata1[0]['user_id'];
                                    $contition_array = array('contact_type' => 2, 'status' => 'confirm');
                                    $search_condition = "((contact_from_id = ' $userid') OR (contact_to_id = '$userid'))";
                                    $businesscontacts1 = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');


                                            ?>

                                        <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'bus_contact') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/bus_contact/' . $businessdata1[0]['business_slug']); ?>"> Contacts <br>  (<?php echo (count($businesscontacts1)); ?>)</a>
                                        </li>


                                        <?php }?>


                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 
                                                                                                                  <!--  <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_save_post') { ?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_save_post'); ?>">Saved Post</a>
                                                                                                                                                                                        </li> -->

                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('business_profile/userlist/' . $businessdata1[0]['business_slug']); ?>">Userlist</a>
                                    </li>


                                <?php } ?>

                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 


                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business_profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($businessfollowerdata)); ?>)</a>
                                    </li>


                                    <?php
                                } else {

                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_to' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business_profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>

                                <?php } ?>

                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?>          
                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business_profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($businessfollowingdata)); ?>)</a>
                                    </li>
                                    <?php
                                } else {
                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_from' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?>
                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business_profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>
                                <?php } ?>

                            </ul>

                        

                        <?php
                        $userid = $this->session->userdata('aileenuser');

                        if ($businessdata1[0]['user_id'] != $userid) {
                            ?>
                            
                                <div class="flw_msg_btn fr top_follow">
                                    <ul>
                                        <li>
                                            <div class="<?php echo "fr" . $businessdata1[0]['business_profile_id']; ?>">

                                                <?php
                                                $userid = $this->session->userdata('aileenuser');

                                                $contition_array = array('user_id' => $userid, 'status' => '1');

                                                $bup_id = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $bup_id[0]['business_profile_id'], 'follow_to' => $businessdata1[0]['business_profile_id']))->row()->follow_status;
                                                //echo "<pre>"; print_r($status); die();


                                                $logslug = $this->db->get_where('business_profile', array('user_id' => $userid))->row()->business_slug;
                                                if ($logslug != $this->uri->segment(3)) {
                                                    if ($status == 0 || $status == " ") {
                                                        ?>
                                                        <div class="msg_flw_btn_1" id= "followdiv">
                                                            <button id="<?php echo "follow" . $businessdata1[0]['business_profile_id']; ?>" onClick="followuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Follow</button>
                                                        </div>
                                                    <?php } elseif ($status == 1) { ?>
                                                        <div class="msg_flw_btn_1" id= "unfollowdiv">
                                                            <button class="bg_following"  id="<?php echo "unfollow" . $businessdata1[0]['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Following </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>         


                                            </li>

                                            <li>
                                                <a  href="<?php echo base_url('chat/abc/' . $businessdata1[0]['user_id']); ?>">Message</a></li>
                                        <?php } ?>

                                    </ul>   
                                </div>
                           
                        <?php } ?>

                         </div>
                    </div>
                    </div>
                    <!-- pickup -->
                </div>
            </div>
        </div>
      <div class="container">
         <div class="user-midd-section"  >
            <div  class="col-sm-12 border_tag padding_low_data padding_les" >
               <div class="padding_les main_art" >
                  <div class="top-tab">
                     <ul class="nav nav-tabs tabs-left remove_tab">
                        <li class="active"> <a href="<?php echo base_url('business_profile/business_photos/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-camera" aria-hidden="true"></i>   Photos</a></li>
                        <li>       <a href="<?php echo base_url('business_profile/business_videos/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</a></li>
                        <li>    <a href="<?php echo base_url('business_profile/business_audios/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-music" aria-hidden="true"></i>  Audio</a></li>
                        <li>    <a href="<?php echo base_url('business_profile/business_pdf/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Pdf</a></li>
                     </ul>
                  </div>
                  <!-- Tab panes -->
                  <div class="tab-content">
                     <div class="tab-pane active" id="home">
                        <div class="common-form">
                           <div class="">
                              <div class="all-box">
                                 <ul>
                                    <!--  <li>
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
                                       foreach ($business_profile_data as $mke => $mval) {
                                       
                                           $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);
                                       
                                           if (in_array($ext, $allowed)) {
                                               $databus[] = $mval;
                                           }
                                       }
                                       
                                       if ($databus) { ?>
                                    <div class="pictures">
                                       <ul>
                                          <?php       foreach ($databus as $data) {
                                             ?>
                                          <li>
                                             <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $data['image_name']) ?>" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor" width="550" height="669"/>
                                          </li>
                                          <?php
                                             $i++;
                                             } ?>
                                       </ul>
                                    </div>
                                    <?php       } else {
                                       ?>
                                    <div class="main_pdf_box"  >
                                       <div class="not_avali" >
                                          <img src="<?php echo base_url('images/020-c.png'); ?>"  >
                                          <div>
                                             <div class="not_text" >Photo not avalible</div>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } ?>
                                 </ul>
                              </div>
                              <!-- silder start -->
                              <div id="myModal1" class="modal2">
                                 <div class="modal-content2">
                                    <span class="close2 cursor" onclick="closeModal()">&times;</span>
                                    <!--  multiple image start -->
                                    <?php
                                       $i = 1;
                                       
                                       $allowed = array('gif', 'png', 'jpg');
                                       foreach ($business_profile_data as $mke => $mval) {
                                       
                                           $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);
                                       
                                           if (in_array($ext, $allowed)) {
                                               $databus1[] = $mval;
                                           }
                                       }
                                       
                                       foreach ($databus1 as $busdata) {
                                           ?>
                                    <div class="mySlides">
                                       <div class="numbertext"><?php echo $i ?> / <?php echo count($databus1) ?></div>
                                       <div class="slider_img_p">
                                          <img src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $busdata['image_name']) ?>" >
                                       </div>
                                       <!-- like comment start -->
                                       <div>
                                          <!--                                                                <div class="post-design-like-box col-md-12">
                                             <div class="post-design-menu">
                                                 <ul>
                                                     <li class="<?php echo 'likepostimg' . $busdata['image_id']; ?>">
                                                         <a id="<?php echo $busdata['image_id']; ?>" onClick="mulimg_like(this.id)">
                                             
                                                             <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'user_id' => $userid, 'is_unlike' => 0);
                                                
                                                $activedata = $this->data['activedata'] = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                
                                                if ($activedata) {
                                                    ?>
                                                                 <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                                             <?php } else { ?>
                                                                 <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                                                             <?php } ?>
                                             
                                                             <span class="<?php echo 'likeimage' . $busdata['image_id']; ?>"> <?php
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => 0);
                                                $likecount = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                if ($likecount) {
                                                    echo count($likecount);
                                                }
                                                ?>
                                             
                                                             </span>
                                                         </a>
                                                     </li>
                                             
                                                     <li id="<?php echo 'insertcountimg' . $busdata['image_id']; ?>">
                                             
                                                         <?php
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_delete' => '0');
                                                $commnetcount = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                ?>
                                             
                                                         <a onClick="imgcommentall(this.id)" id="<?php echo $busdata['image_id']; ?>">
                                                             <i class="fa fa-comment-o" aria-hidden="true">
                                                                 <?php
                                                if (count($commnetcount) > 0) {
                                                    echo count($commnetcount);
                                                }
                                                ?>
                                                             </i> 
                                                         </a>
                                                     </li>
                                                 </ul>
                                             
                                             </div>
                                             </div>-->
                                          <?php
                                             $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                             $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             if (count($commneteduser) > 0) {
                                                 ?>
                                          <div class="likeduserlistimg<?php echo $busdata['image_id'] ?>">
                                             <?php
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                //                                                                echo '<pre>';
                                                //                                                                print_r($commneteduser);
                                                //                                                                
                                                $countlike = count($commneteduser) - 1;
                                                foreach ($commneteduser as $userdata) {
                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $userdata['user_id'], 'status' => 1))->row()->company_name;
                                                }
                                                ?>
                                             <!-- pop up box end-->
                                             <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $busdata['image_id'] ?>);">
                                                <?php
                                                   $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                   $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   //                                                              
                                                   $countlike = count($commneteduser) - 1;
                                                   $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $commneteduser[0]['user_id'], 'status' => 1))->row()->company_name;
                                                   ?>
                                                <div class="like_one_other_img">
                                                   <?php
                                                      if ($userid == $commneteduser[0]['user_id']) {
                                                      
                                                          echo "You";
                                                          echo "&nbsp;";
                                                      } else {
                                                          echo ucwords($business_fname1);
                                                          echo "&nbsp;";
                                                      }
                                                      ?>
                                                   <?php
                                                      if (count($commneteduser) > 1) {
                                                          ?>
                                                   <?php echo "and"; ?>
                                                   <?php
                                                      echo $countlike;
                                                      echo "&nbsp;";
                                                      echo "others";
                                                      ?> 
                                                   <?php } ?>
                                                </div>
                                             </a>
                                          </div>
                                          <?php
                                             }
                                             ?>
                                          <div class="<?php echo "likeusernameimg" . $busdata['image_id']; ?>" id="<?php echo "likeusernameimg" . $busdata['image_id']; ?>" style="display:none">
                                             <?php
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                //                                                                echo '<pre>';
                                                //                                                                print_r($commneteduser);
                                                //                                                                
                                                $countlike = count($commneteduser) - 1;
                                                foreach ($commneteduser as $userdata) {
                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $userdata['user_id'], 'status' => 1))->row()->company_name;
                                                }
                                                ?>
                                             <!-- pop up box end-->
                                             <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $busdata['image_id'] ?>);">
                                                <?php
                                                   $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                   $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                   //                                                              
                                                   $countlike = count($commneteduser) - 1;
                                                   $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $commneteduser[0]['user_id'], 'status' => 1))->row()->company_name;
                                                   ?>
                                                <div class="like_one_other_img">
                                                   <?php
                                                      echo ucwords($business_fname1);
                                                      echo "&nbsp;";
                                                      ?>
                                                   <?php
                                                      if (count($commneteduser) > 1) {
                                                          ?>
                                                   <?php echo "and"; ?>
                                                   <?php
                                                      echo $countlike;
                                                      echo "&nbsp;";
                                                      echo "others";
                                                      ?> 
                                                   <?php } ?>
                                                </div>
                                             </a>
                                          </div>
                                          <!-- show comment div start -->
                                          <!-- <div class="art-all-comment">
                                             <div  id="<?php echo "threeimgcomment" . $busdata['image_id']; ?>" style="display:block">
                                                <div class="<?php echo 'insertimgcomment' . $busdata['image_id']; ?>">
                                                   <?php
                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_delete' => '0');
                                                
                                                $busmulimage = $this->common->select_data_by_condition('bus_post_image_comment', $contition_array, $data = '*', $sortby = 'post_image_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                
                                                if ($busmulimage) {
                                                    foreach ($busmulimage as $rowdata) {
                                                        $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;
                                                        ?>
                                                   <?php $slug = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->business_slug; ?>
                                                   <div class="all-comment-comment-box">
                                                      <div class="post-design-pro-comment-img"> 
                                                         <?php
                                                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                                                ?>
                                                         <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slug); ?>">
                                                         <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                         </a>
                                                      </div>
                                                      <div class="comment-name">
                                                         <b>  <?php
                                                echo ucwords($companyname);
                                                echo '</br>';
                                                ?>
                                                         </b>
                                                      </div>
                                                      <div class="comment-details" id= "<?php echo "imgshowcomment" . $rowdata['post_image_comment_id']; ?>">
                                                         <?php
                                                echo $rowdata['comment'];
                                                ?>
                                                      </div> -->
                                          <!--       <div class="edit-comment-box">
                                             <div class="inputtype-edit-comment">
                                                <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="<?php echo $rowdata['post_image_comment_id']; ?>"  id="<?php echo "imgeditcomment" . $rowdata['post_image_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="imgcommentedit(<?php echo $rowdata['post_image_comment_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $rowdata['comment']; ?></div>
                                                <span class="comment-edit-button"><button id="<?php echo "imgeditsubmit" . $rowdata['post_image_comment_id']; ?>" style="display:none" onClick="imgedit_comment(<?php echo $rowdata['post_image_comment_id']; ?>)">Save</button></span>
                                             </div>
                                             </div> -->
                                          <!-- edit box end -->
                                          <!--     <div class="art-comment-menu-design"> -->
                                          <!-- comment like start -->
                                          <!--   <div class="comment-details-menu"  id="<?php echo 'imglikecomment' . $rowdata['post_image_comment_id']; ?>">
                                             <a id="<?php echo $rowdata['post_image_comment_id']; ?>"   onClick="imgcomment_like(this.id)"> -->
                                          <?php
                                             $userid = $this->session->userdata('aileenuser');
                                             $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'user_id' => $userid, 'is_unlike' => 0);
                                             
                                             $businesscommentlike1 = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                             //echo "<pre>"; print_r($businesscommentlike); 
                                             //echo count($businesscommentlike); 
                                             if (count($businesscommentlike1) == 0) {
                                                 ?>
                                          <!--     <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                                             <?php } else {
                                                ?>
                                             <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                             <?php } ?>
                                             <span>
                                             <?php
                                                $contition_array = array('post_image_comment_id' => $rowdata['post_image_comment_id'], 'is_unlike' => '0');
                                                $mulcountlike = $this->data['mulcountlike'] = $this->common->select_data_by_condition('bus_comment_image_like', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                
                                                if (count($mulcountlike) > 0) {
                                                    echo count($mulcountlike);
                                                }
                                                ?>
                                             </span>
                                             </a>
                                             </div>
                                             -->
                                          <!--   comment like end -->
                                          <!-- comment edit start -->
                                          <!--  <?php
                                             $userid = $this->session->userdata('aileenuser');
                                             if ($rowdata['user_id'] == $userid) {
                                                 ?>
                                             <div class="comment-details-menu">
                                                <div id="<?php echo 'imgeditcommentbox' . $rowdata['post_image_comment_id']; ?>" style="display:block;">
                                                   <a id="<?php echo $rowdata['post_image_comment_id']; ?>"   onClick="imgcomment_editbox(this.id)" class="editbox">Edit</a>
                                                </div>
                                                <div id="<?php echo 'imgeditcancle' . $rowdata['post_image_comment_id']; ?>" style="display:none;">
                                                   <a id="<?php echo $rowdata['post_image_comment_id']; ?>" onClick="imgcomment_editcancle(this.id)">Cancle</a>
                                                </div>
                                             </div>
                                             <?php } ?> -->
                                          <!-- comment edit end -->
                                          <!-- comment delete start -->
                                          <!--   <?php
                                             $userid = $this->session->userdata('aileenuser');
                                             
                                             $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['post_image_id'], 'status' => 1))->row()->user_id;
                                             
                                             
                                             if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                                                 ?>
                                             <span role="presentation" aria-hidden="true"> · </span>
                                             <div class="comment-details-menu">
                                                <input type="hidden" name="imgpost_delete"  id="imgpost_delete_<?php echo $rowdata['post_image_comment_id']; ?>" value= "<?php echo $rowdata['post_image_id']; ?>">
                                                <a id="<?php echo $rowdata['post_image_comment_id']; ?>"   onClick="imgcomment_delete(this.id)"> Delete<span class="<?php echo 'imginsertcomment' . $rowdata['post_image_comment_id']; ?>">
                                                </span> </a> 
                                             </div>
                                             <?php } ?> -->
                                          <!-- comment delete end -->
                                          <!-- created date start -->
                                          <!--  <span role="presentation" aria-hidden="true"> · </span>
                                             <div class="comment-details-menu">
                                                <p><?php
                                                echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                                echo '</br>';
                                                ?>
                                                </p>
                                             </div> -->
                                          <!-- created date end -->
                                          <!--   </div>
                                             </div>
                                             <?php
                                                }
                                                }
                                                ?>
                                             </div>
                                             </div> -->
                                          <!-- 27-4 mulimage comment start -->
                                          <!--  <div id="<?php echo "fourimgcomment" . $busdata['image_id']; ?>" style="display:none;">
                                             </div> -->
                                          <!-- 27-4 mulimage comment end -->
                                          <!-- </div> -->
                                          <!-- show comment div end -->
                                          <!-- insert comment code start -->
                                          <!--                                                                <div class="post-design-commnet-box col-md-12">
                                             <div class="post-design-proo-img"> 
                                             
                                                 <?php
                                                //         $userid = $this->session->userdata('aileenuser');
                                                //          $business_userimage = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_user_image;
                                                         ?>
                                             
                                                 <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>" alt="">
                                             </div>
                                             
                                             
                                             <div class="">
                                                 <div class="col-md-10 inputtype-comment" style="padding-left: 7px;">
                                                     <div contenteditable="true" class="editable_text" name="<?php echo $busdata['image_id']; ?>" id="<?php echo "post_imgcomment" . $busdata['image_id']; ?>" placeholder="Type Comment ..." onkeyup="entercommentimg(<?php echo $busdata['image_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>
                                                 </div>
                                             
                                                 <div class="comment-edit-butn">                                      
                                                     <button id="<?php echo $busdata['image_id']; ?>" onClick="insert_commentimg(this.id)">Comment</button>
                                             
                                                 </div>
                                             </div>
                                             
                                             </div>-->
                                          <!-- insert comment code end -->
                                       </div>
                                       <!-- like comment end -->
                                    </div>
                                    <?php
                                       $i++;
                                       }
                                       ?>
                                    <!-- slider image rotation end  -->
                                    <a class="prev" style="left: 0px" onclick="plusSlides(-1)">&#10094;</a>
                                    <a class="next" style="right: 0px"  onclick="plusSlides(1)">&#10095;</a>
                                    <div class="caption-container">
                                       <p id="caption"></p>
                                    </div>
                                 </div>
                              </div>
                              <!-- slider end -->
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      </div>
      </div>
      </div>
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
                     <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                     <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                     <input type="hidden" name="hitext" id="hitext" value="9">
                     <div class="popup_previred">
                        <img id="preview" src="#" alt="your image"/>
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
   <div class="modal fade message-box biderror" id="bidmodal" role="dialog" style="z-index: 999999;">
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
   <!-- Bid-modal-2  -->
   <div class="modal fade message-box" id="likeusermodal" role="dialog" style="z-index: 999999 !important;">
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
</body>
</html>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('js/jquery.jMosaic.js'); ?>"></script> -->
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<script>
   var data= <?php echo json_encode($demo); ?>;
   
           
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
   var data1= <?php echo json_encode($city_data); ?>;
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
       /*$.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "business_profile/mulimg_like" ?>',
        data: 'post_image_id=' + clicked_id,
        success: function (data) {
        //alert(data);
        $('.' + 'likeimgpost' + clicked_id).html(data);
        
        }
        }); */
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mulimg_like" ?>',
           data: 'post_image_id=' + clicked_id,
           dataType: 'json',
           success: function (data) {
               // $('.' + 'likepost' + clicked_id).html(data);
               //alert(data.like_user_count);
   
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
</script>
<!--images like script end -->
<!-- insert comment using enter -->
<script type="text/javascript">
   function insert_commentimg(clicked_id)
   {
   
       $("#post_imgcomment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
       var sel = $("#post_imgcomment" + clicked_id);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
       $('#post_imgcomment' + clicked_id).html("");
   
       var x = document.getElementById('threeimgcomment' + clicked_id);
       var y = document.getElementById('fourimgcomment' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "business_profile/pnmulimgcommentthree" ?>',
               data: 'post_image_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
                   $('.' + 'insertimgcomment' + clicked_id).html(data.comment);
                   $('#' + 'insertimgcount' + clicked_id).html(data.count);
   
               }
           });
   
       } else {
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "business_profile/pnmulimg_comment" ?>',
               data: 'post_image_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
   //                    alert('#' + 'insertimgcount' + clicked_id);
   //                    alert(data.count);
   //                    
   //                    alert('#' + 'fourimgcomment' + clicked_id);
   //                    alert(data.comment);
   
                   $('#' + 'insertimgcount' + clicked_id).html(data.count);
                   $('#' + 'fourimgcomment' + clicked_id).html(data.comment);
   
                   //$('#' + 'insertcommenttwo' + clicked_id).html(data);
   
               }
           });
       }
   }
   
   
</script>
<script type="text/javascript">
   function entercommentimg(clicked_id)
   {
   
   
       $("#post_imgcomment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#post_imgcomment' + clicked_id).keypress(function (e) {
   
           if (e.keyCode == 13 && !e.shiftKey) {
               e.preventDefault();
               var sel = $("#post_imgcomment" + clicked_id);
               var txt = sel.html();
               //txt = txt.replace(/^(&nbsp;|<br>)+/, '');
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   
               $('#post_imgcomment' + clicked_id).html("");
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
   
   
               var x = document.getElementById('threeimgcomment' + clicked_id);
               var y = document.getElementById('fourimgcomment' + clicked_id);
   
               if (x.style.display === 'block' && y.style.display === 'none') {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "business_profile/pnmulimgcommentthree" ?>',
                       data: 'post_image_id=' + clicked_id + '&comment=' + txt,
                       dataType: "json",
                       success: function (data) {
   
                           $('.' + 'insertimgcomment' + clicked_id).html(data.comment);
                           $('#' + 'insertimgcount' + clicked_id).html(data.count);
   
                       }
                   });
   
               } else {
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "business_profile/pnmulimg_comment" ?>',
                       data: 'post_image_id=' + clicked_id + '&comment=' + txt,
                       success: function (data) {
   //                            $('#' + 'insertcommenttwo' + clicked_id).html(data);
   //alert('#' + 'insertimgcount' + clicked_id);
                           $('#' + 'insertimgcount' + clicked_id).html(data.count);
                           $('#' + 'fourimgcomment' + clicked_id).html(data.comment);
   
                       }
                   });
               }
           }
       });
   
   
   }
</script>
<!-- hide and show data start-->
<script type="text/javascript">
   function imgcommentall(clicked_id) {
   
   
       var x = document.getElementById('threeimgcomment' + clicked_id);
       var y = document.getElementById('fourimgcomment' + clicked_id);
       var z = document.getElementById('insertimgcount' + clicked_id);
       $('.post-design-commnet-box').show();
       if (x.style.display === 'block' && y.style.display === 'none') {
           x.style.display = 'none';
           y.style.display = 'block';
           z.style.visibility = 'show';
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "business_profile/pnmulimagefourcomment" ?>',
               data: 'bus_img_id=' + clicked_id,
               success: function (data) {
                   $('#' + 'fourimgcomment' + clicked_id).html(data);
   
               }
           });
       }
   }
</script>
<!-- hide and show data end-->
<!-- comment like script start -->
<script type="text/javascript">
   function imgcomment_like(clicked_id)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mulimg_comment_like" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) {
               $('#' + 'imglikecomment' + clicked_id).html(data);
           }
       });
   }
   function imgcomment_liketwo(clicked_id)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mulimg_comment_liketwo" ?>',
           data: 'post_image_comment_id=' + clicked_id,
           success: function (data) {
               $('#' + 'imglikecomment1' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!-- comment like script end -->
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
<script type="text/javascript">
   function imgcomment_editbox(clicked_id) {
       document.getElementById('imgeditcomment' + clicked_id).style.display = 'inline-block';
       document.getElementById('imgshowcomment' + clicked_id).style.display = 'none';
       document.getElementById('imgeditsubmit' + clicked_id).style.display = 'inline-block';
       document.getElementById('imgeditcommentbox' + clicked_id).style.display = 'none';
       document.getElementById('imgeditcancle' + clicked_id).style.display = 'block';
   
       $('.post-design-commnet-box').hide();
   }
   
   function imgcomment_editcancle(clicked_id) {
   
       document.getElementById('imgeditcommentbox' + clicked_id).style.display = 'block';
       document.getElementById('imgeditcancle' + clicked_id).style.display = 'none';
   
       document.getElementById('imgeditcomment' + clicked_id).style.display = 'none';
       document.getElementById('imgshowcomment' + clicked_id).style.display = 'block';
       document.getElementById('imgeditsubmit' + clicked_id).style.display = 'none';
       $('.post-design-commnet-box').show();
   }
   
   function imgcomment_editboxtwo(clicked_id) {
   
       $('div[id^=imgeditcommenttwo]').css('display', 'none');
       $('div[id^=imgshowcommenttwo]').css('display', 'block');
       $('button[id^=imgeditsubmittwo]').css('display', 'none');
       $('div[id^=imgeditcommentboxtwo]').css('display', 'block');
       $('div[id^=imgeditcancletwo]').css('display', 'none');
   
   
       document.getElementById('imgeditcommenttwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('imgshowcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('imgeditsubmittwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('imgeditcommentboxtwo' + clicked_id).style.display = 'none';
       document.getElementById('imgeditcancletwo' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   function imgcomment_editcancletwo(clicked_id) {
       document.getElementById('imgeditcommentboxtwo' + clicked_id).style.display = 'block';
       document.getElementById('imgeditcancletwo' + clicked_id).style.display = 'none';
       document.getElementById('imgeditcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('imgshowcommenttwo' + clicked_id).style.display = 'block';
       document.getElementById('imgeditsubmittwo' + clicked_id).style.display = 'none';
       $('.post-design-commnet-box').show();
   }
   
</script>
<!-- comment edit insert start -->
<script type="text/javascript">
   function edit_comment(abc)
   { //alert('editsubmit' + abc);
   
   
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //     $(this).html("");
       });
   
   
       var sel = $("#editcomment" + abc);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
       //else {
       //var post_comment_edit = document.getElementById("editcomment" + abc);
       //alert(post_comment.value);
       //alert(post_comment.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
           data: 'post_image_comment_id=' + abc + '&comment=' + txt,
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
   
       //}
       //window.location.reload();
   }
</script>
<script type="text/javascript">
   function commentedit(abc)
   {
   
   
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //$(this).html("");
       });
   
   
       $('#editcomment' + abc).keypress(function (event) {
   
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcomment" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
               } else if (/^\s+$/gi.test(txt)) {
                   return false;
               } else {
                   if (window.preventDuplicateKeyPresses)
                       return;
   
                   window.preventDuplicateKeyPresses = true;
                   window.setTimeout(function () {
                       window.preventDuplicateKeyPresses = false;
                   }, 500);
   
   
   
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
                       data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                       success: function (data) { //alert('falguni');
   
   
                           document.getElementById('editcomment' + abc).style.display = 'none';
                           document.getElementById('showcomment' + abc).style.display = 'block';
                           document.getElementById('editsubmit' + abc).style.display = 'none';
   
                           document.getElementById('editcommentbox' + abc).style.display = 'block';
                           document.getElementById('editcancle' + abc).style.display = 'none';
                           //alert('.' + 'showcomment' + abc);
                           $('#' + 'showcomment' + abc).html(data);
   
   
   
                       }
                   });
                   //alert(val);
               }
           }
       });
   
   
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   function edit_commenttwo(abc)
   { //alert('editsubmit' + abc);
   
       //var post_comment_edit = document.getElementById("editcommenttwo" + abc);
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //$(this).html("");
       });
   
       var sel = $("#editcommenttwo" + abc);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
       } else if (/^\s+$/gi.test(txt))
       {
           return false;
       } else {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
               data: 'post_image_comment_id=' + abc + '&comment=' + txt,
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
           //$(this).html("");
       });
   
   
       $('#editcommenttwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
   
               var sel = $("#editcommenttwo" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
               } else if (/^\s+$/gi.test(txt))
               {
                   return false;
               } else {
   
                   if (window.preventDuplicateKeyPresses)
                       return;
   
                   window.preventDuplicateKeyPresses = true;
                   window.setTimeout(function () {
                       window.preventDuplicateKeyPresses = false;
                   }, 500);
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
                       data: 'post_image_comment_id=' + abc + '&comment=' + txt,
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
   
   
   }
</script>
<!-- comment edit insert end -->
<!-- comment delete start -->
<script type="text/javascript">
   function comment_delete(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   
   function comment_deleted(clicked_id)
   {
   
       var post_delete = document.getElementById("post_delete" + clicked_id);
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_delete_comment" ?>',
           dataType: "json",
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete.value,
           success: function (data) { //alert(data.count); alert(data.comment);
   
               // $('.' + 'insertcomment' + post_delete.value).html(data);
               $('#' + 'insertcount' + post_delete.value).html(data.count);
               $('.insertcomment' + post_delete.value).html(data.comment);
   
           }
       });
   }
   
   
   
   function comment_deletetwo(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   function comment_deletedtwo(clicked_id)
   {
   
       var post_delete1 = document.getElementById("post_deletetwo" + clicked_id);
       //alert(post_delete.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_delete_commenttwo" ?>',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete1.value,
           success: function (data) { //alert('.' + 'insertcomment' + clicked_id);
   
               $('.' + 'insertcommenttwo' + post_delete1.value).html(data);
   
           }
       });
   }
</script>
<!-- commenmt delete end
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
               url: "<?php echo base_url() ?>business_profile/ajaxpro",
               type: "POST",
               data: {"image": resp},
               success: function (data) {
                   html = '<img src="' + resp + '" />';
                   if (html)
                   {
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
   $("#upload").val('');
   return false;
   }
   // file type code end
   
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
           success: function (response) {
   
   
           }
       });
   });
   
   //aarati code end
</script>
<script type="text/javascript">
   function imgedit_comment(abc)
   {
       $("#imgeditcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#imgeditcomment" + abc);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='imgcomment_deleted(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       } else if (/^\s+$/gi.test(txt))
       {
           return false;
       } else {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
               data: 'post_image_comment_id=' + abc + '&comment=' + txt,
               success: function (data) {
   
   
                   document.getElementById('imgeditcomment' + abc).style.display = 'none';
                   document.getElementById('imgshowcomment' + abc).style.display = 'block';
                   document.getElementById('imgeditsubmit' + abc).style.display = 'none';
   
                   document.getElementById('imgeditcommentbox' + abc).style.display = 'block';
                   document.getElementById('imgeditcancle' + abc).style.display = 'none';
                   $('#' + 'imgshowcomment' + abc).html(data);
                   $('.post-design-commnet-box').show();
   
   
               }
           });
       }
   
   }
   
   function imgcommentedit(abc)
   {
       $("#imgeditcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#imgeditcomment' + abc).keypress(function (event) {
   
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#imgeditcomment" + abc);
               var txt = sel.html();
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='imgcomment_deleted(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               } else if (/^\s+$/gi.test(txt))
               {
                   return false;
               } else {
   
                   if (window.preventDuplicateKeyPresses)
                       return;
                   window.preventDuplicateKeyPresses = true;
                   window.setTimeout(function () {
                       window.preventDuplicateKeyPresses = false;
                   }, 500);
   
   
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
                       data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                       success: function (data) {
   
   
                           document.getElementById('imgeditcomment' + abc).style.display = 'none';
                           document.getElementById('imgshowcomment' + abc).style.display = 'block';
                           document.getElementById('imgeditsubmit' + abc).style.display = 'none';
   
                           document.getElementById('imgeditcommentbox' + abc).style.display = 'block';
                           document.getElementById('imgeditcancle' + abc).style.display = 'none';
   
                           $('#' + 'imgshowcomment' + abc).html(data);
                           $('.post-design-commnet-box').show();
   
   
                       }
                   });
               }
   
           }
       });
   
   
   }
   
   function imgedit_commenttwo(abc)
   {
   
       $("#imgeditcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
   
       });
   
       var sel = $("#imgeditcommenttwo" + abc);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='imgcomment_deletedtwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
           data: 'post_image_comment_id=' + abc + '&comment=' + txt,
           success: function (data) {
               //alert(data);
               document.getElementById('imgeditcommenttwo' + abc).style.display = 'none';
               document.getElementById('imgshowcommenttwo' + abc).style.display = 'block';
               document.getElementById('imgeditsubmittwo' + abc).style.display = 'none';
   
               document.getElementById('imgeditcommentboxtwo' + abc).style.display = 'block';
               document.getElementById('imgeditcancletwo' + abc).style.display = 'none';
               $('#' + 'imgshowcommenttwo' + abc).html(data);
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
   function imgcommentedittwo(abc)
   {
   
       $("#imgeditcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#imgeditcommenttwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#imgeditcommenttwo" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='imgcomment_deletedtwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
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
                   url: '<?php echo base_url() . "business_profile/mul_edit_com_insert" ?>',
                   data: 'post_image_comment_id=' + abc + '&comment=' + txt,
                   success: function (data) {
   
   
                       document.getElementById('imgeditcommenttwo' + abc).style.display = 'none';
                       document.getElementById('imgshowcommenttwo' + abc).style.display = 'block';
                       document.getElementById('imgeditsubmittwo' + abc).style.display = 'none';
   
                       document.getElementById('imgeditcommentboxtwo' + abc).style.display = 'block';
                       document.getElementById('imgeditcancletwo' + abc).style.display = 'none';
                       $('#' + 'imgshowcommenttwo' + abc).html(data);
                       $('.post-design-commnet-box').show();
                   }
               });
   
   
           }
       });
   
   
   }
</script>
<script type="text/javascript">
   function imgcomment_delete(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='imgcomment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   function imgcomment_deleted(clicked_id)
   {
       var post_delete = document.getElementById("imgpost_delete_" + clicked_id);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_delete_comment" ?>',
           dataType: 'json',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete.value,
           success: function (data) {
               $('#' + 'insertimgcount' + post_delete.value).html(data.count);
               $('.' + 'insertimgcomment' + post_delete.value).html(data.comment);
               $('.post-design-commnet-box').show();
           }
       });
   }
   
   
   function imgcomment_deletetwo(clicked_id)
   {
       $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='imgcomment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   
   function imgcomment_deletedtwo(clicked_id)
   {
       var post_delete1 = document.getElementById("imgpost_deletetwo_" + clicked_id);
   //        alert(post_delete1.value);
   //        return false;
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/mul_delete_commenttwo" ?>',
           data: 'post_image_comment_id=' + clicked_id + '&post_delete=' + post_delete1.value,
           dataType: "json",
           success: function (data) {
               //$('.' + 'insertcommenttwo' + post_delete1.value).html(data);
               $('.' + 'insertimgcommenttwo' + post_delete1.value).html(data.comment);
               $('#' + 'insertimgcount' + post_delete1.value).html(data.count);
               $('.post-design-commnet-box').show();
               //fourimgcomment173
           }
       });
   }
</script>
<script type="text/javascript">
   function h(e) {
       $(e).css({'height': '29px', 'overflow-y': 'hidden'}).height(e.scrollHeight);
   }
   $('.textarea').each(function ()
   {
       h(this);
   }).on('input', function () {
       h(this);
   });
</script>
<script type="text/javascript">
   function editpost(abc)
   {
       document.getElementById('editpostdata' + abc).style.display = 'none';
       document.getElementById('editpostbox' + abc).style.display = 'block';
       document.getElementById('editpostdetails' + abc).style.display = 'none';
       document.getElementById('editpostdetailbox' + abc).style.display = 'block';
       document.getElementById('editpostsubmit' + abc).style.display = 'block';
   }
</script>
<script type="text/javascript">
   function edit_postinsert(abc)
   {
   
       var editpostname = document.getElementById("editpostname" + abc);
       var $field = $('#editpostname' + abc);
       var editpostdetails = $('#editpostdesc' + abc).html();
       if (editpostname.value == '' && editpostdetails == '') {
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
               url: '<?php echo base_url() . "business_profile/edit_post_insert" ?>',
               data: 'business_profile_post_id=' + abc + '&product_name=' + editpostname.value + '&product_description=' + editpostdetails,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                   document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
   
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
   
                   $('#' + 'editpostdata' + abc).html(data.title);
                   $('#' + 'editpostdetails' + abc).html(data.description);
               }
           });
       }
   }
</script>
<!-- cover image end -->
<script type="text/javascript">
   function likeuserlist(post_id) {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/likeuserlist" ?>',
           data: 'post_id=' + post_id,
           dataType: "html",
           success: function (data) {
               var html_data = data;
               $('#likeusermodal .mes').html(html_data);
               $('#likeusermodal').modal('show');
           }
       });
   
   
   }
   function likeuserlistimg(post_id) {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/imglikeuserlist" ?>',
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
   .likeduser, .likeduser1{
   width: 100%;
   background-color: #00002D;
   }
   .likeduser-title, .likeduser-title1{
   color: #fff;
   margin-bottom: 5px;
   padding: 7px;
   }
   .likeuser_list, .likeuser_list1{
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
   .like_one_other, .like_one_other_img{
   margin-left: 25px;
   /*  margin-right: 15px;*/
   }
</style>
<!-- follow user script start -->
<script type="text/javascript">
   function followuser(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/follow" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
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
           type: 'POST',
           url: '<?php echo base_url() . "business_profile/unfollow" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
               $('.' + 'fr' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!-- Unfollow user script end -->
<script>
   function updateprofilepopup(id) {
       $('#bidmodal-2').modal('show');
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
<script type="text/javascript">
   $(document).keydown(function (e) {
       if (!e)
           e = window.event;
       if (e.keyCode == 27 || e.charCode == 27) {
           closeModal();
       }
   });
</script>
<script type="text/javascript">
   //    $('#myModal').modal({backdrop: 'true'}) 
       j$('#myModal').modal({backdrop:'true'});
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
<script>
   function picpopup() {
       
   
   $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
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
<!-- contact person script start -->
<script type="text/javascript">
   function contact_person(clicked_id) { 
       $.ajax({
          type: 'POST',
          url: '<?php echo base_url() . "business_profile/contact_person" ?>',
          data: 'toid=' + clicked_id,
          success: function (data) {
            //   alert(data);
              $('#contact_per').html(data);
   
          }
      });
   }
</script>
<!-- contact person script end -->


<script type="text/javascript">
    

    function contact_person_model(clicked_id , status){

    if(status == 'pending'){

    $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');

    }else if(status == 'confirm'){

    $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');
    
   }

  }
</script>

