<div class="container" id="paddingtop_fixed">
    <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
            <div id="upload-demo" ></div>
        </div>
        <div class="col-md-12 cover-pic" >
            <button class="btn btn-success cancel-result" onclick="">Cancel</button>
            <button class="btn btn-success upload-result fr" onclick="myFunction()">Save</button>
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
        <div class="col-md-12" style="visibility: hidden; ">
            <div id="upload-demo-i"></div>
        </div>
    </div>
    <div class="">
        <div id="row2">
            <?php
            $userid = $this->session->userdata('aileenuser');
            if ($this->uri->segment(3) == $userid) {
                $user_id = $userid;
            } elseif ($this->uri->segment(3) == "") {
                $user_id = $userid;
            } else {
                $user_id = $this->db->get_where('business_profile', array('business_slug' => $this->uri->segment(3)))->row()->user_id;
            }

            $contition_array = array('user_id' => $user_id, 'is_deleted' => '0', 'status' => '1');
            $image = $this->common->select_data_by_condition('business_profile', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            $image_ori = $image[0]['profile_background'];
            if ($image_ori) {
                ?>
                    <!--<img src="<?php echo base_url($this->config->item('bus_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" />-->
                <img src="<?php echo BUS_BG_MAIN_UPLOAD_URL . $image[0]['profile_background'] ?>" name="image_src" id="image_src" />
                <?php
            } else {
                ?>
                <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="container tablate-container">
    <?php
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

                        <?php if (!file_exists($this->config->item('bus_profile_thumb_upload_path') . $businessdata1[0]['business_user_image'])) { ?>
                            <img src="<?php echo base_url(NOBUSIMAGE); ?>" alt="" >

        <?php } else {
        ?>
                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata1[0]['business_user_image']); ?>" alt="" >

    <?php } ?>

                    <?php } else { ?>
                        <img src="<?php echo base_url(NOBUSIMAGE); ?>" alt="" >
                    <?php } ?>
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    if ($businessdata1[0]['user_id'] == $userid) {
                        ?>                                                                                                                        <!-- <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a> -->
                        <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                    <?php } ?>
                </div>
            </div>
            <div class="business-profile-right">
                <div class="bui-menu-profile">
                    <div class="profile-left">
                        <h4 class="profile-head-text"><a href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug'] . ''); ?>"> <?php echo ucfirst(strtolower($businessdata1[0]['company_name'])); ?></a></h4>
                        <h4 class="profile-head-text_dg"><a href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug'] . ''); ?>"> 
<?php
if ($businessdata1[0]['industriyal']) {
    echo
    $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
}
if ($businessdata1[0]['other_industrial']) {
    echo ucfirst(strtolower($businessdata1[0]['other_industrial']));
}
?>


                            </a></h4>
                    </div>
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

                            <?php if ($contactperson[0]['status'] == 'cancel' || $contactperson[0]['status'] == '' || $contactperson[0]['status'] == 'reject') { ?>
                                <a href="javascript:void(0);" onclick="return contact_person_query(<?php echo $businessdata1[0]['user_id']; ?>,<?php echo "'" . $contactperson[0]['status'] . "'"; ?>);" style="cursor: pointer;">

    <?php } elseif ($contactperson[0]['status'] == 'pending' || $contactperson[0]['status'] == 'confirm') { ?>   
                                    <a onclick="return contact_person_query(<?php echo $businessdata1[0]['user_id']; ?>,<?php echo "'" . $contactperson[0]['status'] . "'"; ?>)" style="cursor: pointer;">
                                <?php } ?>

                                    <?php if ($contactperson[0]['status'] == 'cancel') { ?> 
                                        <div>   
                                            <div class="add-contact">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div><span class="cancel_req_busi">   <img src="<?php echo base_url('img/icon_contact_add.png'); ?>"></span></div>

                                            </div>


                                            <div class="addtocont">
                                                <span class="ft-13"><i class="icon-user"></i>
                                                    Add to contact </span>
                                            </div> 

                                        </div>
    <?php } elseif ($contactperson[0]['status'] == 'pending') {
        ?>
                                        <div class="cance_req_main_box">   
                                            <div class="add-contact">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div>
                                                    <span class="cancel_req_busi">   <img src="<?php echo base_url('img/icon_contact_cancel.png'); ?>"></span>
                                                </div>

                                            </div>


                                            <div class="addtocont">
                                                <span class="ft-13 cl_haed_s">
                                                    Cancel request </span>
                                            </div> 

                                        </div>
    <?php } elseif ($contactperson[0]['status'] == 'confirm') {
        ?> 
                                        <div class="fw in_mian_chng">   
                                            <div class="in_your_contact">

                                                <div class="in_your_contact_change">
                                                    <span class="in_your_contct_img">
                                                        <img src="<?php echo base_url('img/icon_contact_accept.png'); ?>">
                                                    </span>
                                                </div>

                                            </div>


                                            <div class="addtocont">
                                                <span class="ft-13 ai_text">
                                                    In contacts </span>
                                            </div> 

                                        </div>
    <?php } elseif ($contactperson[0]['status'] == 'reject') {
        ?>
                                        <div>   
                                            <div class="add-contact">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div><span class="cancel_req_busi">   <img src="<?php echo base_url('img/icon_contact_add.png'); ?>"></span></div>

                                            </div>


                                            <div class="addtocont">
                                                <span class="ft-13"><i class="icon-user"></i>
                                                    Add to contact </span>
                                            </div> 

                                        </div>
    <?php } else {
        ?> 
                                        <div>   
                                            <div class="add-contact">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div><span class="cancel_req_busi">   <img src="<?php echo base_url('img/icon_contact_add.png'); ?>"></span></div>

                                            </div>


                                            <div class="addtocont">
                                                <span class="ft-13"><i class="icon-user"></i>
                                                    Add to contact </span>
                                            </div> 

                                        </div>
    <?php } ?>                            

                                </a>
                        </div>
<?php } ?>
                </div>
                <!-- PICKUP -->
                <!-- menubar -->
                <div class="business-data-menu padding_less_right ">
                    <div class="profile-main-box-buis-menu">  
<?php
$userid = $this->session->userdata('aileenuser');
if ($businessdata1[0]['user_id'] == $userid) {
    ?>     
                            <ul class="current-user bpro-fw6">
                        <?php } else { ?>
                                <ul class="bpro-fw">
                            <?php } ?>  
                                <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'dashboard') { ?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('business-profile/dashboard/' . $businessdata1[0]['business_slug']); ?>">Dashboard</a></li>
                                <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'details') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug']); ?>"> Details</a></li>


<?php
$userid = $this->session->userdata('aileenuser');
if ($businessdata1[0]['user_id'] == $userid) {


    $userid = $businessdata1[0]['user_id'];
    $contition_array = array('contact_type' => 2, 'contact_person.status' => 'confirm', 'business_profile.status'=>1);
    $search_condition = "((contact_from_id = ' $userid') OR (contact_to_id = '$userid'))";

    $join_str[0]['table'] = 'business_profile';
    $join_str[0]['join_table_id'] = 'business_profile.user_id';
    $join_str[0]['from_table_id'] = 'contact_person.contact_from_id';
    $join_str[0]['join_type'] = '';


    $businesscontacts = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
    ?> 

                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'contacts') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business-profile/contacts/' . $businessdata1[0]['business_slug']); ?>"> Contacts <br>  (<span class="contactcount"><?php echo (count($businesscontacts)); ?></span>)</a>
                                    </li>


    <?php
} else {

    $userid = $businessdata1[0]['user_id'];
    $contition_array = array('contact_type' => 2, 'status' => 'confirm');
    $search_condition = "((contact_from_id = ' $userid') OR (contact_to_id = '$userid'))";
    $businesscontacts1 = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');
    ?>

                                    <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'bus_contact') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('business_profile/bus_contact/' . $businessdata1[0]['business_slug']); ?>"> Contacts <br>  (<?php echo (count($businesscontacts1)); ?>)</a>
                                    </li>


<?php } ?>


<?php
$userid = $this->session->userdata('aileenuser');

$contition_array = array('business_step' => 4, 'is_deleted' => 0, 'status' => 1, 'user_id !=' => $userid);
$userlistcountbus = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
?> 
                                    <!-- <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'userlist') { ?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('business-profile/userlist/' . $businessdata1[0]['business_slug']); ?>">Userlist<br> (<?php echo (count($userlistcountbus)); ?>)</a></li> -->

                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business-profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($businessfollowerdata)); ?>)</a></li>
                                    <?php
                                } else {
                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_to' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?> 
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('business-profile/followers/' . $businessdata1[0]['business_slug']); ?>">Followers <br>  (<?php echo (count($followerotherdata)); ?>)</a></li>
                                <?php } ?>
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($businessdata1[0]['user_id'] == $userid) {
                                    ?>          
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business-profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> <div id="countfollow">(<?php echo (count($businessfollowingdata)); ?>)</div></a>
                                    </li>
                                    <?php
                                } else {
                                    $businessregid = $businessdata1[0]['business_profile_id'];
                                    $contition_array = array('follow_from' => $businessregid, 'follow_status' => '1', 'follow_type' => '2');
                                    $followerotherdata = $this->data['followerotherdata'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                    ?>
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a title="Following" href="<?php echo base_url('business-profile/following/' . $businessdata1[0]['business_slug']); ?>">Following <br> (<?php echo (count($followerotherdata)); ?>)</a>
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
    $logslug = $this->db->get_where('business_profile', array('user_id' => $userid))->row()->business_slug;
    if ($logslug != $this->uri->segment(3)) {
        if ($status == 0 || $status == " ") {
            ?>
                                                        <div class="msg_flw_btn_1" id= "followdiv">
                                                            <button id="<?php echo "follow" . $businessdata1[0]['business_profile_id']; ?>" onClick="followuser_two(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Follow</button>
                                                        </div>
                                                    <?php } elseif ($status == 1) { ?>
                                                        <div class="msg_flw_btn_1" id= "unfollowdiv">
                                                            <button class="bg_following"  id="<?php echo "unfollow" . $businessdata1[0]['business_profile_id']; ?>" onClick="unfollowuser_two(<?php echo $businessdata1[0]['business_profile_id']; ?>)">Following </button>
                                                        </div>
                                                    <?php } ?>
                                                </div>         
                                            </li>
                                            <li>
                                                <a  href="<?php echo base_url('chat/abc/5/5/' . $businessdata1[0]['user_id']); ?>">Message</a></li>
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