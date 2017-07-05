<!-- start head -->
<?php echo $head; ?>
<style type="text/css">
    #popup-form img{display: none;}
</style>


<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>

<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);
        
       $('html,body').animate({scrollTop:265}, 100);
   
   });
   //For Scroll page at perticular position js End
</script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<?php echo $art_header2_border; ?>

<!-- END HEADER -->
<body   class="page-container-bg-solid page-boxed">

    <section class="custom-row">
        <div class="container" id="paddingtop_fixed">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo" ></div>
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
                    <div id="upload-demo-i" ></div>
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
                       
                            <img src="<?php echo base_url($this->config->item('art_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" />
                        <?php
                    } else {
                        ?>
                        
                            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
<?php }
?>

                </div>
            </div>
        </div>
 

<div class="container tablate-container art-profile">

<?php
$userid = $this->session->userdata('aileenuser');
if ($artisticdata[0]['user_id'] == $userid) {
    ?> 
        <div class="upload-img">

            <label class="cameraButton"> <span class="tooltiptext">Upload Cover Photo</span> <i class="fa fa-camera" aria-hidden="true"></i>
                <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
            </label>
        </div>
<?php } ?>



    <div class="profile-photo">
        <div class="profile-pho">

            <div class="user-pic padd_img">
<?php if ($artisticdata[0]['art_user_image'] != '') { ?>
                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>" alt="" >
                <?php } else { ?>
                    <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                <?php } ?>


                <?php
                $userid = $this->session->userdata('aileenuser');
                if ($artisticdata[0]['user_id'] == $userid) {
                    ?> 
                    <!--<a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>-->
                    <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                <?php } ?>
            </div>

<!--            <div id="popup-form">
<?php // echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                <input type="hidden" name="hitext" id="hitext" value="4">
                <input type="submit" name="cancel4" id="cancel4" value="Cancel">
                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                </form>
            </div>-->

        </div>
        
        <div class="job-menu-profile mob-block">
        <a href="<?php echo site_url('artistic/art_manage_post/' . $artisticdata[0]['user_id']); ?>"><h5><?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?></h5></a>

        <!-- text head start -->
        <div>
            <div class="profile-text" >

<?php
if ($artisticdata[0]['designation'] == '') {
    ?>

                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?> 
                        <a id="designation" class="designation" title="Designation">Current Work</a>
                        <?php } ?>

                <?php } else { ?> 
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?> 
                        <a id="designation" class="designation" title="<?php echo ucwords($artisticdata[0]['designation']); ?>"><?php echo ucwords($artisticdata[0]['designation']); ?></a>
                    <?php } else { ?>
                        <a><?php echo ucwords($artisticdata[0]['designation']); ?></a>
                    <?php } ?>
                <?php } ?>


                <!-- The Modal -->
                <!-- <div id="myModal" class="modal"> -->
                    <!-- Modal content -->
                    <!-- <div class="col-md-2"></div> -->
                    <!-- <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
<?php echo form_open(base_url('artistic/art_designation/'), array('id' => 'artdesignation', 'name' => 'artdesignation', 'class' => 'clearfix')); ?>

                        <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php echo $artisticdata[0]['designation']; ?>">

                        <?php echo form_error('designation'); ?>
                        </fieldset>

                        <input type="hidden" name="hitext" id="hitext" value="3">
                        <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                            <?php echo form_close(); ?>



                    </div>
 -->
                    <!-- <div class="col-md-2"></div> -->
                <!-- </div> -->
            </div>


            <!-- text head end -->

        </div>

    </div>
        
        <div class="profile-main-rec-box-menu  profile-box-art col-md-12 padding_les ">

            
            <div class="right-side-menu art-side-menu ml0">
                <?php 
               $userid = $this->session->userdata('aileenuser');
               if($artisticdata[0]['user_id'] == $userid){
               
               ?>     
        <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  

                    <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('artistic/art_manage_post/' . $artisticdata[0]['user_id']); ?>"> Dashboard</a>
                    </li>

                    <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('artistic/artistic_profile/' . $artisticdata[0]['user_id']); ?>"> Details</a>
                    </li>


<?php
$userid = $this->session->userdata('aileenuser');
if ($artisticdata[0]['user_id'] == $userid) {
    ?>

                                        <!-- <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost') { ?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_savepost/' . $artisticdata[0]['user_id']); ?>">Saved Post </a>
                                        </li> -->




                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('artistic/userlist'); ?>">Userlist</a>
                        </li>
<?php } ?>      

<?php
$userid = $this->session->userdata('aileenuser');
if ($artisticdata[0]['user_id'] == $userid) {
    ?>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers/' . $artisticdata[0]['user_id']); ?>">Followers  <br>(<?php echo (count($followerdata)); ?>)</a>
                        </li>
                    <?php
                    } else {

                        $artregid = $artisticdata[0]['art_id'];
                        $contition_array = array('follow_to' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
                        $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        ?> 
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers/' . $artisticdata[0]['user_id']); ?>">Followers  <br> (<?php echo (count($followerotherdata)); ?>)</a>
                        </li>

                    <?php } ?> 

<?php
if ($artisticdata[0]['user_id'] == $userid) {
    ?>      
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('artistic/following/' . $artisticdata[0]['user_id']); ?>">Following <br> (<?php echo (count($followingdata)); ?>)</a>
                        </li>
                    <?php
                    } else {

                        $artregid = $artisticdata[0]['art_id'];
                        $contition_array = array('follow_from' => $artregid, 'follow_status' => '1', 'follow_type' => '1');
                        $followingotherdata = $this->data['followingotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        ?>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('artistic/following/' . $artisticdata[0]['user_id']); ?>">Following  <br> (<?php echo (count($followingotherdata)); ?>)</a>
                        </li> 
                    <?php } ?>  
                </ul>
            
            <?php 
                    $userid  = $this->session->userdata('aileenuser'); 
                    if($artisticdata[0]['user_id'] != $userid){
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
                                    <button id="<?php echo "follow" . $artisticdata[0]['art_id']; ?>" onClick="followuser(<?php echo $artisticdata[0]['art_id']; ?>)">Follow</a>
                                </div>
<?php } elseif ($status == 1) { ?>
                                <div id= "unfollowdiv">
                                    <button class="bg_following" id="<?php echo "unfollow" . $artisticdata[0]['art_id']; ?>" onClick="unfollowuser(<?php echo $artisticdata[0]['art_id']; ?>)"> Following</a>
                                </div>


<?php } ?>
                        </li>

                        <li>
                            <a href="<?php echo base_url('chat/abc/' . $artisticdata[0]['user_id']); ?>">Message</a></li>

                    </ul>
                </div>
            </div>
            <?php
                    }
            ?>
        </div>  
        <!-- menubar -->                
    </div>    
    
</div>
        <div class="user-midd-section art-inner">
            <div class="container">
    <div class="job-menu-profile mob-none">
        <a href="<?php echo site_url('artistic/art_manage_post/' . $artisticdata[0]['user_id']); ?>"><h5><?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?></h5></a>

        <!-- text head start -->
        <div>
            <div class="profile-text" >

<?php
if ($artisticdata[0]['designation'] == '') {
    ?>

                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?> 
                        <a id="designation" class="designation" title="Designation">Current Work</a>
                        <?php } ?>

                <?php } else { ?> 
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?> 
                        <a id="designation" class="designation" title="<?php echo ucwords($artisticdata[0]['designation']); ?>"><?php echo ucwords($artisticdata[0]['designation']); ?></a>
                    <?php } else { ?>
                        <a><?php echo ucwords($artisticdata[0]['designation']); ?></a>
                    <?php } ?>
                <?php } ?>


                <!-- The Modal -->
                <!-- <div id="myModal" class="modal"> -->
                    <!-- Modal content -->
                    <!-- <div class="col-md-2"></div> -->
                    <!-- <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
<?php echo form_open(base_url('artistic/art_designation/'), array('id' => 'artdesignation', 'name' => 'artdesignation', 'class' => 'clearfix')); ?>

                        <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php echo $artisticdata[0]['designation']; ?>">

                        <?php echo form_error('designation'); ?>
                        </fieldset>

                        <input type="hidden" name="hitext" id="hitext" value="3">
                        <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                            <?php echo form_close(); ?>



                    </div>
 -->
                    <!-- <div class="col-md-2"></div> -->
                <!-- </div> -->
            </div>


            <!-- text head end -->

        </div>

    </div>
    <div class="col-md-7 col-sm-12 col-xs-12 mob-plr0">
        <div class="common-form">
            <div class="job-saved-box">
                <h3>Details</h3>
                <div class=" fr rec-edit-pro">

<?php
$userid = $this->session->userdata('aileenuser');

if ($artisticdata[0]['user_id'] === $userid) {
    ?>
                        <ul>
                      <!--   <li>  <a href="<?php //echo base_url('artistic/art_basic_information_update'); ?>">Edit </a> </li>

                          <li><a href="<?php //echo base_url('artistic/deactivate/'.$this->session->userdata('aileenuser')); ?>" onclick="return confirm('Are you sure you want to Deactivate?')">Deactivate </a>
                           </li>
                            -->
                        </ul>
<?php } ?>
                </div> 


                <div class="contact-frnd-post">
                    <div class="job-contact-frnd ">
                        <div class="profile-job-post-detail clearfix">
                            <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
            <p class="details_all_tital "> Basic Information</p>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                        <li> <b>First Name</b> <span> <?php echo $artisticdata[0]['art_name']; ?> </span>
                                        </li>
                                        <li> <b>Last Name</b> <span> <?php echo $artisticdata[0]['art_lastname']; ?> </span>
                                        </li>

                                        <li> <b>Email </b><span> <?php echo $artisticdata[0]['art_email']; ?> </span>
                                        </li>
                                       

                                         <?php if($artisticdata[0]['art_phnno']){ ?>
                                            <li><b> Phone Number</b> <span><?php echo $artisticdata[0]['art_phnno']; ?></span> </li>

                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Phone Number</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
                                    </ul>
                                </div>
                                <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details">
                                            <ul>
                                                <li>
                    <p class="details_all_tital ">Contact Address</p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                        <ul class="clearfix">
                                            <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $artisticdata[0]['art_country']))->row()->country_name; ?> </span>
                                            </li>

                                            <li> <b>State </b><span> <?php echo
$this->db->get_where('states', array('state_id' => $artisticdata[0]['art_state']))->row()->state_name;
?> </span>

<?php if($artisticdata[0]['art_city']){?>
                                            </li>
                                            <li><b> City</b> <span><?php echo
$this->db->get_where('cities', array('city_id' => $artisticdata[0]['art_city']))->row()->city_name;
?></span> </li>
<?php }  else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b> City</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>


                                            <?php if($artisticdata[0]['art_pincode']){ ?>
                                            <li> <b>Pincode </b><span> <?php echo $artisticdata[0]['art_pincode']; ?></span>
                                            </li>
                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Pincode</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>
                                            <li> <b>Postal Address </b><span> <?php echo $artisticdata[0]['art_address']; ?></span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="profile-job-post-title clearfix">
                                    <div class="profile-job-profile-button clearfix">
                                        <div class="profile-job-details">
                                            <ul>
                                                <li>
             <p class="details_all_tital "> Art Information</p>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="profile-job-profile-menu">
                                        <ul class="clearfix">

                                            <li> <b>Art </b> <span>
<?php
$aud = $artisticdata[0]['art_skill'];
$aud_res = explode(',', $aud);
foreach ($aud_res as $skill) {

    $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
    $skill1[] = $cache_time;
}
$listFinal = implode(', ', $skill1);

if(!$listFinal){

  echo $artisticdata[0]['other_skill'];  

}else if(!$artisticdata[0]['other_skill']){

echo $listFinal;  
}else if($listFinal && $artisticdata[0]['other_skill']){
echo $listFinal . ',' . $artisticdata[0]['other_skill'];
}

?>     
                                                </span>
                                            </li>

                                            <!-- <li> <b> Other Art </b> 

                                                    <?php if ($artisticdata[0]['other_skill']) { ?>

                                                    <span>
    <?php
    echo $artisticdata[0]['other_skill'];
    ?>     
                                                    </span>

                                                    <?php } else { ?>

                                                    <span>
                                                        <?php echo PROFILENA;
                                                        ?>  </span>
<?php } ?>
                                            </li> -->

                                            <li> <b> Speciality in Art </b> <span> <?php echo $artisticdata[0]['art_yourart']; ?> </span>
                                            </li>


                                <?php if($artisticdata[0]['art_desc_art']){ ?>

                                            <li><b> Description of your art</b> <span><?php echo $this->common->make_links($artisticdata[0]['art_desc_art']); ?></span> </li>
                                            <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Description of your art</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>

                                        <?php if($artisticdata[0]['art_inspire']){?>
                                         <li><b> How You are Inspire</b> <span><?php echo $artisticdata[0]['art_inspire']; ?></span> </li>
                                         <?php } else {
           if($artisticdata[0]['user_id'] == $userid){ 
                  ?>  
      <li><b>Description of your art</b> <span>
             <?php echo PROFILENA;?></span></li><?php  }else{}?>               
          <?php }?>  

                                        </ul>
                                    </div>
                                </div> 

                            </div> 

                            <?php if($artisticdata[0]['user_id'] == $userid){?>
                            <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
                <p class="details_all_tital ">Portfolio</p>
                                            </li>

                                        </ul>
                                    </div>
                                </div>


                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                      
                                        <li><b>Attachment</b> 

                                            
                                        <span>

                                         <?php
if ($artisticdata[0]['art_bestofmine']) {
    ?>
                                                <div class="buisness-profile-pic">



    <?php
    $allowed = array('gif', 'png', 'jpg');
    $allowespdf = array('pdf');
    $allowesvideo = array('mp4', '3gp');
    $allowesaudio = array('mp3');

    $filename = $artisticdata[0]['art_bestofmine'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);


    if (in_array($ext, $allowed)) {
        ?>
              <img src="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>">
         <?php } elseif (in_array($ext, $allowespdf)) { ?>
        <a href="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>">PDF</a>
         <?php
         } ?>  
                                                   </div>

                                                   <?php } else {
                                                        echo PROFILENA;
                                                    } ?>
                                            </span>

                                             
                                           
                                        </li>
                                        
 

                 <li> <b>Details of Portfolio </b> 

                 <span> 
                 
                 <?php if($artisticdata[0]['art_portfolio']){?>
                 <?php echo $this->common->make_links($artisticdata[0]['art_portfolio']); ?>
                 <?php } else{

                            echo PROFILENA;

                            } ?>
                           
                  </span></li>
</ul>                          </div>

                                </div>

                                <?php }else{

                                if($artisticdata[0]['art_bestofmine'] == '' && $artisticdata[0]['art_portfolio'] == '') {}else{?>

                                <div class="profile-job-post-title clearfix">
                                <div class="profile-job-profile-button clearfix">
                                    <div class="profile-job-details">
                                        <ul>
                                            <li>
                <p class="details_all_tital ">Portfolio</p>
                                            </li>

                                        </ul>
                                    </div>
                                </div>


                                <div class="profile-job-profile-menu">
                                    <ul class="clearfix">
                                      
                                        <li><b>Attachment</b> 

                                            
                                        <span>

                                         <?php
if ($artisticdata[0]['art_bestofmine']) {
    ?>
                                                <div class="buisness-profile-pic">



    <?php
    $allowed = array('gif', 'png', 'jpg');
    $allowespdf = array('pdf');
    $allowesvideo = array('mp4', '3gp');
    $allowesaudio = array('mp3');

    $filename = $artisticdata[0]['art_bestofmine'];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);


    if (in_array($ext, $allowed)) {
        ?>
              <img src="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>">
         <?php } elseif (in_array($ext, $allowespdf)) { ?>
        <a href="<?php echo base_url($this->config->item('art_portfolio_main_upload_path') . $artisticdata[0]['art_bestofmine']) ?>">PDF</a>
         <?php
         } ?>
                    </div>

                 <?php }?>
                        </span>

                                             
                                           
                                        </li>
                                        
 

                 <li> <b>Details of Portfolio </b> 

                 <span> 
                 
                 <?php if($artisticdata[0]['art_portfolio']){?>
                 <?php echo $this->common->make_links($artisticdata[0]['art_portfolio']); ?>
                 <?php }else{

                     echo PROFILENA;
                    
                    } ?>
                           
                  </span></li>
</ul>                          </div>

                                </div>


                                <?php } }?>
                            </div> 

                        </div>
                    </div>

                </div>
            </div>
        </div>

            </div>
    </div>

</section>
<footer>

<?php echo $footer; ?>
</footer>

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
                        <input type="hidden" name="hitext" id="hitext" value="4">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image" />
                        </div>
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
<?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->


</body>

</html>

<!-- script for skill textbox automatic start (option 2)-->

<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>


<!-- designation script start -->
<script type="text/javascript">
                            function divClicked() {
                                var divHtml = $(this).html();
                                var editableText = $("<textarea />");
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
                            // alert("hi");
                                $("a.designation").click(divClicked);
                            });
                        </script>

<!-- designation script end -->
<!-- script for skill textbox automatic end (option 2)-->
<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
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
// alert(data);

        
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

<!-- <script>
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


<!-- popup form edit END -->



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

<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        // setTimeout(function () { location.reload(1); }, 5000);

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



    $("#upload").change(function () { 

        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);

// pallavi code start for file type support
        files = this.files;
        size = files[0].size;

if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    picpopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";

   $("#upload").val('');
 //document.getElementById("upload").setTextValue() = "";

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

            }
        });
    });

//aarati code end
</script>
<!-- cover image end -->

<!-- follow user script start -->

<script type="text/javascript">
    function followuser(clicked_id)
    { //alert(clicked_id);

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


<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
function updateprofilepopup(id) {
$('#bidmodal-2').modal('show');
}
</script>

<!--follow like script end -->

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