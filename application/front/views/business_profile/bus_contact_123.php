<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <?php echo $head; ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
</head>
<body class="page-container-bg-solid page-boxed pushmenu-push">
  <?php echo $header; ?>
  <?php echo $business_header2_border ?>
  <section>
    <div class="container" id="paddingtop_fixed">
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
          <div id="upload-demo" ></div>
        </div>
        <div class="col-md-12 cover-pic">
          <button class="btn btn-success cancel-result" onclick="" >Cancel</button>
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
        $userid  = $this->session->userdata('aileenuser');
        if($this->uri->segment(3) == $userid){
          $user_id = $userid;
        }elseif($this->uri->segment(3) == ""){
          $user_id = $userid;
        }else{
            $user_id = $this->db->get_where('business_profile',array('business_slug' => $this->uri->segment(3)))->row()->user_id;
                     }
            $contition_array = array( 'user_id' => $user_id, 'is_deleted' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            $image_ori=$image[0]['profile_background'];
            if($image_ori)
            {
            ?>
      
            <img src="<?php echo base_url($this->config->item('bus_bg_main_upload_path') . $image[0]['profile_background']);?>" name="image_src" id="image_src" / >
          
            <?php
           }
           else
           { ?>
          
            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
      <?php     }
          
            ?>
        </div>
      </div>
    </div>
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
                   <?php }?>

                            </span>
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



                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $businessdata1[0]['business_slug']); ?>">Dashboard</a>
                                </li>

                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_resume') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/business_resume/' . $businessdata1[0]['business_slug']); ?>"> Details</a>
                                </li>

                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'bus_contact') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/bus_contact/' . $businessdata1[0]['business_slug']); ?>"> Contacts</a>
                                </li>

                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 
                 

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
      </div>
      <div class="user-midd-section">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-8 col-sm-8">
              <div class="common-form">
                <div class="job-saved-box">
                  <h3>Contacts</h3>
                  <div class="contact-frnd-post">
                  <?php
                  if(count($unique_user) > 0){ 
                    foreach ($unique_user as $user) { 
                      if($busuid == $user['contact_from_id']){ 

                        $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_to_id'], $data = '*', $join_str = array());

                        $contition_array = array('contact_from_id' => $login, 'contact_to_id' => $user['contact_to_id'], 'contact_type' => 2);

                        $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                
                      } 
                      else { 
                        $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_from_id'], $data = '*', $join_str = array());

                        $contition_array = array('contact_to_id' => $login, 'contact_from_id' => $user['contact_from_id'], 'contact_type' => 2);

                        $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                      }  
                          ?>
                    <div class="job-contact-frnd">
                      <div class="profile-job-post-detail clearfix" id="<?php echo "removecontact" .$cdata[0]['user_id']; ?>">
                        <div class="profile-job-post-title-inside clearfix">
                          <div class="profile-job-post-location-name">
                            <div class="user_lst"><ul>
                              <li class="fl">
                              <div class="follow-img">
                                <?php if($cdata[0]['business_user_image'] != ''){ ?>
                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/'.$cdata[0]['business_slug']); ?>">
                                  <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') $cdata[0]['business_user_image']);?>" height="50px" width="50px" alt="" >
                                </a>
                            <?php } else { ?>
                            <a href="<?php echo base_url('business_profile/business_profile_manage_post/'.$cdata[0]['business_slug']); ?>">
                            <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            </a>
                            <?php } ?> 
                            </div>
                            </li>
                            <li style="width: 67%">
                             <div class="">
                         <div class="follow-li-text " style="padding: 0;">
                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/'.$cdata[0]['business_slug']); ?>"><?php echo ucwords($cdata[0]['company_name']);?></a>
                          </div>
                          <!-- category start -->
                                <div>

                                <?php  $category =  $this->db->get_where('industry_type',array('industry_id' => $cdata[0]['industriyal'], 'status' => 1))->row()->industry_name;  ?>
         
         
                               <a><?php 

                               if($category){
                                echo $category;
                               }else{
                              echo $cdata[0]['other_industrial'];
                                 }

                               ?></a>
     
                                </div>

                               <!--  category end -->

                            </li>
                            
  <li class="fr">
                                  
 
                  <?php if($login == $cdata[0]['user_id']){}else{?>
  
                 <?php  if($clistuser[0]['status'] == 'cancel'){?>

                 <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">

                      <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                           Add to contact
                        </button>
                      </div>  

                  <?php }elseif($clistuser[0]['status'] == 'pending'){ ?>

                  <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                    <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?> , 'pending')">
                           Cancel request
                      </button>
                      </div>     

                  <?php }else if($clistuser[0]['status'] == 'confirm'){ ?>
                 
                 <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                  <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?> , 'confirm')">
                            In your contact
                   </button> 
                   </div>        

                  <?php  } else if($clistuser[0]['status'] == 'reject'){?>

                  <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                  <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                            Add to contact
                  </button>
                  </div>

                    <?php  }else {?>
                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                    <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                    Add to contact
                    </button>
                    </div>

                    <?php }?>
                      
                      <?php }?>
   
                           
</li>

                            </ul>
                            </div>
                            </div>
                            </div>
                            
                            
                         </div>
                                                        <?php } ?>
                                  </div>
     <?php }else{?>

                            <div class="text-center rio">
                            <h4 class="page-heading  product-listing">No Contacts Found.</h4>
                           </div>

                                   <?php }?>
                                   <div class="col-md-1">
                                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</body>
</html>