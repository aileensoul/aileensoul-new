    <div class="container" id="paddingtop_fixed_art">
       <div class="row" id="row1" style="display:none;">
            <div class="col-md-12 text-center padding_less_left">
                <div id="upload-demo" ></div>
            </div>
            <div class="col-md-12 cover-pic" >
                <button class="btn btn-success cancel-result" onclick="" >Cancel</button>

                <button class="btn btn-success set-btn upload-result" onclick="myFunction()">Save</button>

                <div id="message1" style="display:none;">
                    <div class="loader"><div id="floatBarsG">
                            <div id="floatBarsG_1" class="floatBarsG"></div>
                            <div id="floatBarsG_2" class="floatBarsG"></div>
                            <div id="floatBarsG_3" class="floatBarsG"></div>
                            <div id="floatBarsG_4" class="floatBarsG"></div>
                            <div id="floatBarsG_5" class="floatBarsG"></div>
                            <div id="floatBarsG_6" class="floatBarsG"></div>
                            <div id="floatBarsnoG_7" class="floatBarsG"></div>
                            <div id="floatBarsG_8" class="floatBarsG"></div>
                        </div>
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

                    <img src="<?php echo base_url($this->config->item('art_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                    <?php
                } else {
                    ?>

                         <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" alt="WHITE IMAGE" />
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
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);?>

                            <div class="post-img-user">
                            <?php echo  ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)); ?>
                            </div>
                       

                    <!-- <img alt="" class="img-circle" src="<?php //echo base_url(NOIMAGE); ?>" alt="" /> -->


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
         <h4 class="profile-head-text"><a href="<?php echo site_url('artistic/dashboard/' . $artisticdata[0]['user_id']); ?>">
                <?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?></a>
</h4>
            <!-- text head start -->
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

                    <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('artistic/dashboard/' . $artisticdata[0]['user_id']); ?>"> Dashboard</a>
                    </li>

                    <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('artistic/details/' . $artisticdata[0]['user_id']); ?>"> Details</a>
                    </li>


                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?> 

                        <!-- <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('artistic/userlist'); ?>">Userlist<br> (<?php echo (count($userlistcount)); ?>)</a>
                        </li> -->
                    <?php } ?>


                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers'); ?>">Followers <br> (<?php echo $flucount; ?>)</a>
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
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a  title="Followers" href="<?php echo base_url('artistic/followers/' . $artisticdata[0]['user_id']); ?>">Followers <br> (<?php echo ($count); ?>)</a>
                        </li>

                    <?php } ?> 
                    <?php
                    if ($artisticdata[0]['user_id'] == $userid) {
                        ?>        
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('artistic/following'); ?>">Following <br> (<?php echo $countfr; ?>)</a>
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
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('artistic/following/' . $artisticdata[0]['user_id']); ?>">Following <br>  (<?php echo $countfo; ?>)</a>
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

                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($userid != $artisticdata[0]['user_id']) {
                                    ?>
                                <li> <a href="<?php echo base_url('chat/abc/' . $artisticdata[0]['user_id'].'/6/6'); ?>">Message</a> </li>
                            <?php } ?>
                        </ul>
                    </div>
           
            <?php } ?>

        </div>  
        <!-- menubar -->      
        
    </div>
</div>
     

</div>

</div>
</div>