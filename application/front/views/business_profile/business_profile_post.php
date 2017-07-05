<!-- start head -->
<?php echo $head; ?>
<!-- end head -->
<!-- start header -->
<?php echo $header; ?>
<!-- <script src="<?php echo base_url('js/fb_login.js'); ?>">
</script> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
<link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>

<!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
-->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
<script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>



<!-- END HEADER -->
<?php echo $business_header2_border; ?>
<!DOCTYPE html>
<html>
    <head>


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>     -->



        <!-- further and less -->
        <script>
            $(function () {
//                var showTotalChar = 150, showChar = "More", hideChar = "less";
                var showTotalChar = 180, showChar = "Read More", hideChar = "";
                $('.show').each(function () {
                    // var content = $(this).text();
                    var content = $(this).html();
                    content = content.replace(/ /g, '');
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
        <script>
            $(document).ready(function ()
            {
                /* Uploading Profile BackGround Image */
                $('body').on('change', '#bgphotoimg', function ()
                {
                    $("#bgimageform").ajaxForm({
                        target: '#timelineBackground',
                        beforeSubmit: function () {
                        }
                        ,
                        success: function () {
                            $("#timelineShade").hide();
                            $("#bgimageform").hide();
                        }
                        ,
                        error: function () {
                        }
                    }).submit();
                });
                /* Banner position drag */
                $("body").on('mouseover', '.headerimage', function ()
                {
                    var y1 = $('#timelineBackground').height();
                    var y2 = $('.headerimage').height();
                    $(this).draggable({
                        scroll: false,
                        axis: "y",
                        drag: function (event, ui) {
                            if (ui.position.top >= 0)
                            {
                                ui.position.top = 0;
                            } else if (ui.position.top <= y1 - y2)
                            {
                                ui.position.top = y1 - y2;
                            }
                        }
                        ,
                        stop: function (event, ui)
                        {
                        }
                    });
                });
                /* Bannert Position Save*/
                $("body").on('click', '.bgSave', function ()
                {
                    var id = $(this).attr("id");
                    var p = $("#timelineBGload").attr("style");
                    var Y = p.split("top:");
                    var Z = Y[1].split(";");
                    var dataString = 'position=' + Z[0];
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('business_profile/image_saveBG_ajax'); ?>",
                        data: dataString,
                        cache: false,
                        beforeSend: function () {
                        }
                        ,
                        success: function (html)
                        {
                            if (html)
                            {
                                window.location.reload();
                                $(".bgImage").fadeOut('slow');
                                $(".bgSave").fadeOut('slow');
                                $("#timelineShade").fadeIn("slow");
                                $("#timelineBGload").removeClass("headerimage");
                                $("#timelineBGload").css({
                                    'margin-top': html});
                                return false;
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body class="page-container-bg-solid page-boxed">
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4  animated fadeInLeftBig profile-box profile-box-custom">
                            <div class="">

                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>"
                                               tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $businessdata[0]['company_name']; ?>">
                                                <!-- box image start -->
                                                <?php if ($businessdata[0]['profile_background'] != '') { ?>
                                                    <div>  <img src="<?php echo base_url($this->config->item('bus_bg_thumb_upload_path') . $businessdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>" >
                                                    </div> <?php
                                                } else {
                                                    ?>
                                                    <div> 
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>" >
                                                    </div> <?php } ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>" title="<?php echo $businessdata[0]['company_name']; ?>" tabindex="-1" aria-hidden="true" rel="noopener" >
                                                    <?php
                                                    if ($businessdata[0]['business_user_image']) {
                                                        ?>
                                                        <div class="left_iner_img_profile"> 
                                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="<?php echo $businessdata[0]['company_name']; ?>" >
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="left_iner_img_profile">  
                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $businessdata[0]['company_name']; ?>">
                                                        </div>  <?php } ?>                           
                                                    <!-- 
                            <img class="profile-boxProfileCard-avatarImage js-action-profile-avatar" src="images/imgpsh_fullsize (2).jpg" alt="" style="    height: 68px;
                            width: 68px;">
                                                    -->
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>"> 
                                                        <?php echo ucwords($businessdata[0]['company_name']); ?>
                                                    </a> 
                                                </span>

                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>" >
                                                        <?php
                                                        if ($category) {
                                                            echo $category;
                                                        } else {
                                                            echo $businessdata[0]['other_industrial'];
                                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li
                                                        <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a  class="padding_less_left" title="Dashboard" href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>">Dashboard
                                                        </a>
                                                    </li>
                                                    <li 
                                                        <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a title="Followers" href="<?php echo base_url('business_profile/followers'); ?>">Followers 
                                                            <br> (<?php echo (count($businessfollowerdata)); ?>)
                                                        </a>
                                                    </li>
                                                    <li  
                                                        <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a  class="padding_less_right" title="Following" href="<?php echo base_url('business_profile/following/' . $businessdata[0]['business_slug']); ?>">Following 
                                                            <br> (<?php echo (count($businessfollowingdata)); ?>) 
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <!--                            <div  class="add-post-button">
                                                                <a class="btn btn-3 btn-3b" href="<?php echo base_url('recruiter'); ?>">
                                                                    <i class="fa fa-plus" aria-hidden="true">
                                                                    </i> Recruiter
                                                                </a>
                                                            </div>-->
                                <div class="full-box-module_follow">
                                    <!-- follower list start  -->  
                                    <div class="common-form">
                                        <h3 class="user_list_head">User List
                                        </h3>
                                        <div class="seeall">
                                            <a href="<?php echo base_url('business_profile/userlist/' . $businessdata[0]['business_slug']); ?>">All User
                                            </a>
                                        </div>
                                    </div>
                                    <div class="profile-boxProfileCard_follow  module">
                                        <ul>
                                            <li class="follow_box_ul_li">
                                                <div class="contact-frnd-post follow_left_main_box">
                                                    <?php
                                                    if ($userlistview1 > 0) {
                                                        foreach ($userlistview1 as $userlist) {
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $followfrom = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
                                                            $contition_array = array('follow_to' => $userlist['business_profile_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '2');
                                                            $businessfollow = $this->data['businessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
//                                                        echo '<pre>';
//                                                        print_r($businessfollow);exit;
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name;
                                                            if (!$businessfollow) {
                                                                ?>                             
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                        <div class="post-design-pro-img_follow">
                                                                            <?php if ($userlist['business_user_image']) { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userlist['business_user_image']); ?>"  alt="">
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                </a>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="post-design-name_follow fl">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="post-design-product_follow">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                            <h6>
                                                                                                <?php echo ucwords($userlist['company_name']); ?>
                                                                                            </h6>
                                                                                        </a> 
                                                                                    </div>
                                                                                </li>
                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                                <!-- <?php //echo "<pre>"; print_r($category);         ?> -->
                                                                                <li>
                                                                                    <div class="post-design-product_follow_main" style="display:block;">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                            <p>
                                                                                                <?php
                                                                                                if ($category) {
                                                                                                    echo $category;
                                                                                                } else {
                                                                                                    echo $userlist['other_industrial'];
                                                                                                }
                                                                                                ?>
                                                                                            </p>
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> 
                                                                        </div>  
                                                                        <div class="follow_left_box_main_btn">
                                                                            <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                                <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)">
                                                                            <i class="fa fa-times" aria-hidden="true">
                                                                            </i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!-- second condition start -->
                                                    <?php
                                                    if ($userlistview2 > 0) {
                                                        foreach ($userlistview2 as $userlist) {
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $followfrom = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name;
                                                            $contition_array = array('follow_to' => $userlist['business_profile_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '2');
                                                            $businessfollow = $this->data['businessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

                                                            if (!$businessfollow) {
                                                                ?>                             
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                        <div class="post-design-pro-img_follow">


                                                                            <?php if ($userlist['business_user_image']) { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userlist['business_user_image']); ?>"  alt="">
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                </a>
                                                                            <?php } ?>                    
                                                                        </div>
                                                                        <div class="post-design-name_follow fl">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="post-design-product_follow">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                            <h6>
                                                                                                <?php echo ucwords($userlist['company_name']);
                                                                                                ?>
                                                                                            </h6>
                                                                                        </a> 
                                                                                    </div>
                                                                                </li>

                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name; ?>

                                                                                <li>
                                                                                    <div class="post-design-product_follow_main" style="display:block;">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                            <p>
                                                                                                <?php
                                                                                                if ($category) {
                                                                                                    echo $category;
                                                                                                } else {
                                                                                                    echo $userlist['other_industrial'];
                                                                                                }
                                                                                                ?>
                                                                                            </p>
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> 
                                                                        </div>  
                                                                        <div class="follow_left_box_main_btn">
                                                                            <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                                <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)">
                                                                            <i class="fa fa-times" aria-hidden="true">
                                                                            </i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!-- third condition start -->
                                                    <?php
                                                    if ($userlistview3 > 0) {
                                                        foreach ($userlistview3 as $userlist) {
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $followfrom = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name;
                                                            $contition_array = array('follow_to' => $userlist['business_profile_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '2');
                                                            $buisnessfollow = $this->data['buisnessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                            if (!$buisnessfollow) {
                                                                ?>                             
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                        <div class="post-design-pro-img_follow">
                                                                            <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>">
                                                                                <?php
                                                                                if ($userlist['business_user_image'] != '') {
                                                                                    ?>
                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userlist['business_user_image']); ?>"  alt="">
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <img  src="<?php echo base_url(NOIMAGE); ?>"  alt="">
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </a>
                                                                        </div>
                                                                        <div class="post-design-name_follow fl">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="post-design-product_follow">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>">
                                                                                            <h6>
                                                                                                <?php echo ucwords($userlist['company_name']); ?>
                                                                                            </h6>
                                                                                        </a> 
                                                                                    </div>
                                                                                </li>
                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name; ?>

                                                                                <li>
                                                                                    <div class="post-design-product_follow_main" style="display:block;">
                                                                                        <a>
                                                                                            <p>
                                                                                                <?php
                                                                                                if ($category) {
                                                                                                    echo $category;
                                                                                                } else {
                                                                                                    echo $userlist['other_industrial'];
                                                                                                }
                                                                                                ?>
                                                                                            </p>
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> 
                                                                        </div>  
                                                                        <div class="follow_left_box_main_btn">
                                                                            <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                                <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)">
                                                                            <i class="fa fa-times" aria-hidden="true">
                                                                            </i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!-- forth condition start -->
                                                    <?php
                                                    if ($userlistview4 > 0) {
                                                        foreach ($userlistview4 as $userlist) {
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $followfrom = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_profile_id;
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name;
                                                            $contition_array = array('follow_to' => $userlist['business_proifle_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '2');
                                                            $businessfollow = $this->data['businessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            if (!$businessfollow) {
                                                                ?>                             
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                        <div class="post-design-pro-img_follow">

                                                                            <?php if ($userlist['business_user_image']) { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userlist['business_user_image']); ?>"  alt="">
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">

                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                </a>
                                                                            <?php } ?>
                                                                        </div>
                                                                        <div class="post-design-name_follow fl">
                                                                            <ul>
                                                                                <li>
                                                                                    <div class="post-design-product_follow">
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>">
                                                                                            <h6>
                                                                                                <?php echo ucwords($userlist['company_name']); ?>
                                                                                            </h6>
                                                                                        </a> 
                                                                                    </div>
                                                                                </li>
                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name; ?>

                                                                                <li>
                                                                                    <div class="post-design-product_follow_main" style="display:block;">
                                                                                        <a>
                                                                                            <p>
                                                                                                <?php
                                                                                                if ($category) {
                                                                                                    echo $category;
                                                                                                } else {
                                                                                                    echo $userlist['other_industrial'];
                                                                                                }
                                                                                                ?>
                                                                                            </p>
                                                                                        </a>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> 
                                                                        </div>  
                                                                        <div class="follow_left_box_main_btn">
                                                                            <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                                <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)">
                                                                            <i class="fa fa-times" aria-hidden="true">
                                                                            </i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <!--div class="seeall">
                                                        <a href="<?php echo base_url('business_profile/userlist'); ?>">All User
                                                        </a>
                                                    </div-->
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- follower list end  -->

                                </div>
                            </div>


                            <br>

                            <div id="result"></div>   

                        </div>
                        <!-- popup start -->

                        <!-- Trigger/Open The Modal -->
                        <!-- <div id="myBtn">Open Modal</div>-->
                        <!-- The Modal -->
                        <div id="myModal" class="modal-post">
                            <!-- Modal content -->
                            <div class="modal-content-post">
                                <span class="close1">&times;
                                </span>
                                <div class="post-editor col-md-12 post-edit-popup" id="close">
                                    <?php // echo form_open_multipart(base_url('business_profile/business_profile_addpost_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix', 'onsubmit' => "return imgval(event)")); ?>
                                    <?php echo form_open_multipart(base_url('business_profile/business_profile_addpost_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form')); ?>
                                    <div class="main-text-area col-md-12" >
                                        <div class="popup-img-in"> 
                                            <?php
                                            if ($businessdata[0]['business_user_image'] != '') {
                                                ?>
                                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                                <?php
                                            } else {
                                                ?>
                                                <img  src="<?php echo base_url(NOIMAGE); ?>"  alt="">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                            <textarea id="test-upload-product" placeholder="<?php echo $this->lang->line("post_your_product"); ?>"  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); onblur=check_length(this.form);  name=my_text rows=4 cols=30 class="post_product_name" style=" position: relative;" tabindex="1"></textarea>
                                            <div class="fifty_val">                       
                                                <input size=1 value=50 name=text_num class="text_num"  readonly> 
                                            </div>
                                            <div class="camera_in padding-left padding_les_left camer_h">
                                                <i class=" fa fa-camera" >
                                                </i> 
                                            </div>
                                        </div>
                                        <!--   <span class="fr">
                            <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->

                                    </div>
                                    <div class="row"></div>
                                    <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                        <textarea id="test-upload-des" name="product_desc" class="description" placeholder="Enter Description" tabindex="2"></textarea>
                                        <!-- <output id="list">
                                        </output> -->
                                    </div>
                                    <div class="print_privew_post">
                                    </div>
                                    <div class="preview">
                                    </div>
                                    <div id="data-vid" class="large-8 columns">
                                        <!--video will be inserted here.-->
                                    </div>
                                    <h2 id="name-vid">
                                    </h2>
                                    <p id="size-vid">
                                    </p>
                                    <p id="type-vid">
                                    </p>
                                    <div class="popup-social-icon">
                                        <ul class="editor-header">
                                            <li>


                                                <div class="col-md-12"> <div class="form-group">
                                                        <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                                    </div></div>


                                                <label for="file-1">
                                                    <i class=" fa fa-camera upload_icon" > Photo</i>
                                                    <i class=" fa fa-video-camera upload_icon" > Video </i> 
                                                    <i class="fa fa-music upload_icon" > Audio </i>
                                                    <i class=" fa fa-file-pdf-o upload_icon"   > PDF </i>
                                                </label>


                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fr margin_btm">
                                        <button type="submit"  value="Submit">Post
                                        </button>    
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- popup end -->  
                        <?php
                        if ($this->session->flashdata('error')) {
                            echo $this->session->flashdata('error');
                        }
                        ?>

                        <div class="col-md-7 col-sm-12 col-md-push-4 custom-right-business  animated fadeInUp">

                            <div class="post-editor col-md-12">
                                <div class="main-text-area col-md-12">
                                    <div class="popup-img"> 
                                        <?php if ($businessdata[0]['business_user_image']) { ?>
                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                        <?php } else { ?>
                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                        <?php } ?>
                                    </div>
                                    <div id="myBtn"  class="editor-content popup-text">
                                        <span> <?php echo $this->lang->line("post_your_product"); ?></span> 
                                        <div class="padding-left padding_les_left camer_h">
                                            <i class="fa fa-camera"></i> 
                                        </div>
                                    </div>

                                </div>
                                <!-- <div class="fr">
                                  <a class="button">Post
                                  </a>
                                </div> -->
                            </div>



                            <!-- body content start-->
                            <div class="business-all-post">
                                <!--                                <div id="progress-div"><div id="progress-bar"></div></div>
                                                                <div id="targetLayer"></div>-->
                                <?php
//echo "<pre>"; print_r($businessprofiledata); die();

                                if (count($businessprofiledatapost) > 0) {
                                    foreach ($businessprofiledatapost as $row) {
                                        $userid = $this->session->userdata('aileenuser');
                                        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                                        $businessdelete = $this->data['businessdelete'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                        $contition_array = array('user_id' => $row['user_id'], 'status' => '1');
                                        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                        $likeuserarray = explode(',', $businessdelete[0]['delete_post']);
                                        if (!in_array($userid, $likeuserarray)) {
                                            ?>
                                            <div id="<?php echo "removepost" . $row['business_profile_post_id']; ?>">
                                                <div class="col-md-12 col-sm-12 post-design-box">
                                                    <div  class="post_radius_box">  
                                                        <div class="post-design-top col-md-12" >  
                                                            <div class="post-design-pro-img"> 
                                                                <!-- pop up box start-->
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
                                                                <!-- pop up box end-->


                                                                <?php
                                                                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_user_image;
                                                                $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;
                                                                ?>
                                                                <?php
                                                                $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;
                                                                $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                                ?>

                                                                <?php if ($row['posted_user_id']) {
                                                                    ?>

                                                                    <?php if ($userimageposted) { ?>
                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>">
                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>">
                                                                            <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                        </a>
                                                                    <?php } ?>

                                                                <?php } else { ?>
                                                                    <?php if ($business_userimage) { ?>
                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>">
                                                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                        </a>
                                                                    <?php } else { ?>
                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>">
                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="post-design-name fl col-xs-8 col-md-10">
                                                                <ul>
                                                                    <?php
                                                                    $companyname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->company_name;
                                                                    $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;
                                                                    $categoryid = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;
                                                                    $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;

                                                                    $companynameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->company_name;

                                                                    $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                                    ?>

                                                                    <li>
                                                                    </li>
                                                                    <?php if ($row['posted_user_id']) { ?>
                                                                        <li>
                                                                            <div class="else_post_d">
                                                                                <div class="post-design-product">
                                                                                    <a class="post_dot_2" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>"><?php echo ucwords($companynameposted); ?></a>
                                                                                    <p class="posted_with" > Posted With</p> <a class="other_name name_business post_dot_2"  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>"><?php echo ucwords($companyname); ?></a>
                                                                                    <span role="presentation" aria-hidden="true"> · </span> <span class="ctre_date"  >
                                                                                        <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>  

                                                                                    </span> </div></div>
                                                                        </li>

                                                                        <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>


                                                                        <!--                                                            <li>
                                                                                                                                        <div class="post-design-product">
                                                                                                                                            <a class="buuis_desc_a" href="javascript:void(0);"  title="Category">
                                                                        <?php
                                                                        if ($category) {

                                                                            echo ucwords($category);
                                                                        } else {
                                                                            echo ucwords($businessdata[0]['other_industrial']);
                                                                        }
                                                                        ?>
                                                                                                                                            </a>
                                                                                                                                        </div>
                                                                                                                                    </li>-->
                                                                    <?php } else { ?>
                                                                        <li>
                                                                            <div class="post-design-product">
                                                                                <a class="post_dot"  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="<?php echo ucwords($companyname); ?>";>
                                                                                    <?php echo ucwords($companyname); ?>  </a>
                                                                                <span role="presentation" aria-hidden="true"> · </span>
                                                                                <div class="datespan"> <span class="ctre_date" > 
                                                                                        <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>

                                                                                    </span></div>

                                                                            </div>



                                                                        </li>

                                                                    <?php } ?>
                                                                    <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>


                                                                    <li>
                                                                        <div class="post-design-product">
                                                                            <a class="buuis_desc_a" href="javascript:void(0);"  title="Category">
                                                                                <?php
                                                                                if ($category) {

                                                                                    echo ucwords($category);
                                                                                } else {
                                                                                    echo ucwords($businessdata[0]['other_industrial']);
                                                                                }
                                                                                ?>
                                                                            </a>
                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                    </li> 
                                                                </ul> 
                                                            </div>  
                                                            <div class="dropdown1">
                                                                <a onClick="myFunction(<?php echo $row['business_profile_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v">
                                                                </a>
                                                                <div id="<?php echo "myDropdown" . $row['business_profile_post_id']; ?>" class="dropdown-content1">

                                                                    <?php
                                                                    if ($row['posted_user_id'] != 0) {

                                                                        if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                                                                            ?>
                                                                            <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)">
                                                                                <i class="fa fa-trash-o" aria-hidden="true">
                                                                                </i> Delete Post
                                                                            </a>
                                                                            <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)">
                                                                                <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                                                </i>Edit
                                                                            </a>

                                                                        <?php } else {
                                                                            ?>

                                                                            <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)">
                                                                                <i class="fa fa-trash-o" aria-hidden="true">
                                                                                </i> Delete Post
                                                                            </a>
                                                                            <a href="<?php echo base_url('business_profile/business_profile_contactperson/' . $row['posted_user_id'] . ''); ?>">
                                                                                <i class="fa fa-user" aria-hidden="true">
                                                                                </i> Contact Person
                                                                            </a>

                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <?php if ($this->session->userdata('aileenuser') == $row['user_id']) { ?> 
                                                                            <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)">
                                                                                <i class="fa fa-trash-o" aria-hidden="true">
                                                                                </i> Delete Post
                                                                            </a>
                                                                            <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)">
                                                                                <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                                                </i>Edit
                                                                            </a>
                                                                        <?php } else { ?>
                                                                            <a onclick="user_postdeleteparticular(<?php echo $row['business_profile_post_id']; ?>)">
                                                                                <i class="fa fa-trash-o" aria-hidden="true">
                                                                                </i> Delete Post
                                                                            </a>

                                                                            <a href="<?php echo base_url('business_profile/business_profile_contactperson/' . $row['user_id'] . ''); ?>">
                                                                                <i class="fa fa-user" aria-hidden="true">
                                                                                </i> Contact Person
                                                                            </a>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>


                                                                </div>
                                                            </div>
                                                            <div class="post-design-desc">
                                                                <div class="ft-15 t_artd">
                                                                    <div id="<?php echo 'editpostdata' . $row['business_profile_post_id']; ?>" style="display:block;">
                                                                        <a >
                                                                            <?php echo $this->common->make_links($row['product_name']); ?>
                                                                        </a>
                                                                    </div>
                                                                    <div id="<?php echo 'editpostbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                        <input type="text" id="<?php echo 'editpostname' . $row['business_profile_post_id']; ?>" name="editpostname" placeholder="Product Name" value="<?php echo $row['product_name']; ?>">
                                                                    </div>
                                                                </div>                    

                                                                <!--               khyati chnages sstat 24-6         -->

                                                                <div id="<?php echo "khyati" . $row['business_profile_post_id']; ?>" style="display:block;">
                                                                    <?php
                                                                    $small = substr($row['product_description'], 0, 180);
                                                                    echo $small;
                                                                    if (strlen($row['product_description']) > 180) {
                                                                        echo '... <span id="kkkk" onClick="khdiv(' . $row['business_profile_post_id'] . ')">View More</span>';
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div id="<?php echo "khyatii" . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                    <?php
                                                                    echo $row['product_description'];
                                                                    ?>
                                                                </div>
                                                                <div id="<?php echo 'editpostdetailbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                    <div  contenteditable="true" id="<?php echo 'editpostdesc' . $row['business_profile_post_id']; ?>"  class="textbuis editable_text margin_btm" name="editpostdesc" placeholder="Description" ><?php echo $row['product_description']; ?></div>
                                                                </div>
                                                                <!-- khyati changes end 24-6 -->
                                                                <div id="<?php echo 'editpostdetailbox' . $row['business_profile_post_id']; ?>" style="display:none;">

                                                                    <div contenteditable="true" id="<?php echo 'editpostdesc' . $row['business_profile_post_id']; ?>" placeholder="Product Description" class="textbuis  editable_text"  name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $row['product_description']; ?></div>                  
                                                                </div>
                                                                <button class="fr" id="<?php echo "editpostsubmit" . $row['business_profile_post_id']; ?>" style="display:none;margin: 5px 0; border-radius: 3px;" onClick="edit_postinsert(<?php echo $row['business_profile_post_id']; ?>)">Save
                                                                </button>

                                                            </div> 
                                                        </div>
                                                        <div class="post-design-mid col-md-12 padding_adust" >
                                                            <!-- multiple image code  start-->
                                                            <div>
                                                                <?php
                                                                $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
                                                                $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                ?>
                                                                <?php if (count($businessmultiimage) == 1) { ?>
                                                                    <?php
//                                                                    $allowed = array('gif', 'PNG', 'jpg', 'jpeg', 'png');
                                                                    $allowed = array('gif', 'PNG', 'jpg', 'jpeg', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp');

                                                                    $allowespdf = array('pdf');
                                                                    $allowesvideo = array('mp4', 'webm', 'qt', 'mov');
                                                                    $allowesaudio = array('mp3');
                                                                    $filename = $businessmultiimage[0]['image_name'];
                                                                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                                    if (in_array($ext, $allowed)) {
                                                                        ?>
                                                                        <!-- one image start -->
                                                                        <div class="one-image">
                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                                <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>"> 
                                                                            </a>
                                                                        </div>
                                                                        <!-- one image end -->
                                                                    <?php } elseif (in_array($ext, $allowespdf)) { ?>
                                                                        <!-- one pdf start -->
                                                                        <div>
                                                                            <a title="click to open" href="<?php echo base_url('business_profile/creat_pdf/' . $businessmultiimage[0]['image_id']) ?>"><div class="pdf_img">
                                                                                    <img src="<?php echo base_url('images/PDF.jpg') ?>" style="height: 100%; width: 100%;">
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <!-- one pdf end -->
                                                                    <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                                                                        <!-- one video start -->
                                                                        <div>
                                                                            <video width="100%" height="350" controls>
                                                                                <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                                                                                <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/ogg">
                                                                                Your browser does not support the video tag.
                                                                            </video>
                                                                        </div>
                                                                        <!-- one video end -->
                                                                    <?php } elseif (in_array($ext, $allowesaudio)) { ?>
                                                                        <!-- one audio start -->
                                                                        <div class="audio_main_div">
                                                                            <div class="audio_img">
                                                                                <img src="<?php echo base_url('images/music-icon.png') ?> ">  
                                                                            </div>
                                                                            <div class="audio_source">
                                                                                <audio id="audio_player" width="100%" height="100" controls>
                                                                                    <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="audio/mp3">
                                                                                    <source src="movie.ogg" type="audio/ogg">
                                                                                    Your browser does not support the audio tag.
                                                                                </audio>
                                                                            </div>
                                                                            <div class="audio_mp3">
                                                                                <p title="hellow this is mp3">This text will scroll from right to left</p>
                                                                            </div>
                                                                        </div> 
                                                                        <!-- one audio end -->
                                                                    <?php } ?>
                                                                <?php } elseif (count($businessmultiimage) == 2) { ?>
                                                                    <?php
                                                                    foreach ($businessmultiimage as $multiimage) {
                                                                        ?>
                                                                        <!-- two image start -->
                                                                        <div  class="two-images" >
                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                                <img class="two-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                            </a>
                                                                        </div>
                                                                        <!-- two image end -->
                                                                    <?php } ?>
                                                                <?php } elseif (count($businessmultiimage) == 3) { ?>
                                                                    <!-- three image start -->
                                                                    <div class="three-image-top" >
                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                        </a>
                                                                    </div>
                                                                    <div class="three-image" >

                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                        </a>
                                                                    </div>
                                                                    <div class="three-image" >
                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                        </a>
                                                                    </div>
                                                                    <!-- three image end -->
                                                                <?php } elseif (count($businessmultiimage) == 4) { ?>
                                                                    <?php
                                                                    foreach ($businessmultiimage as $multiimage) {
                                                                        ?>
                                                                        <!-- four image start -->
                                                                        <div class="four-image">
                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                                <img class="breakpoint" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                            </a>
                                                                        </div>
                                                                        <!-- four image end -->
                                                                    <?php } ?>
                                                                <?php } elseif (count($businessmultiimage) > 4) { ?>
                                                                    <?php
                                                                    $i = 0;
                                                                    foreach ($businessmultiimage as $multiimage) {
                                                                        ?>
                                                                        <!-- five image start -->

                                                                        <div class="four-image">
                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                                <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                            </a>
                                                                        </div>

                                                                        <!-- five image end -->
                                                                        <?php
                                                                        $i++;
                                                                        if ($i == 3)
                                                                            break;
                                                                    }
                                                                    ?>
                                                                    <!-- this div view all image start -->

                                                                    <div class="four-image">
                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>">
                                                                            <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                        </a>
                                                                        <a class="text-center" href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>" >
                                                                            <div class="more-image" >
                                                                                <span>View All (+
                                                                                    <?php echo (count($businessmultiimage) - 4); ?>)</span>

                                                                            </div>

                                                                        </a>
                                                                    </div>



                                                                    <!-- this div view all image end -->
                                                                <?php } ?>
                                                                <div>
                                                                </div>
                                                            </div>
                                                            <!-- multiple image code  end-->
                                                        </div>
                                                        <div class="post-design-like-box col-md-12">
                                                            <div class="post-design-menu">
                                                                <ul class="col-md-6 col-sm-6 col-xs-6">
                                                                    <li class="<?php echo 'likepost' . $row['business_profile_post_id']; ?>">
                                                                        <a id="<?php echo $row['business_profile_post_id']; ?>" class="ripple like_h_w"  onClick="post_like(this.id)">
                                                                            <?php
                                                                            $userid = $this->session->userdata('aileenuser');
                                                                            $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                                                                            $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                            $likeuser = $this->data['active'][0]['business_like_user'];
                                                                            $likeuserarray = explode(',', $active[0]['business_like_user']);
                                                                            if (!in_array($userid, $likeuserarray)) {
                                                                                ?>               
                                                                <!--                                                                        <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">
                                                                                                                            </i>-->
                                                                                <i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>
                                                                            <?php } else { ?> 
                        <!--                                                                        <i class="fa fa-thumbs-up" aria-hidden="true">
                                                                                    </i>-->
                                                                                <i class="fa fa-thumbs-up fa-1x main_color" aria-hidden="true"></i>
                                                                            <?php } ?>
                                                                            <span class="like_As_count">
                                                                                <?php
                                                                                if ($row['business_likes_count'] > 0) {
                                                                                    echo $row['business_likes_count'];
                                                                                }
                                                                                ?>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li id="<?php echo "insertcount" . $row['business_profile_post_id']; ?>" style="visibility:show">
                                                                        <?php
                                                                        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                        $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                        ?>
                                                                        <a  onClick="commentall(this.id)" id="<?php echo $row['business_profile_post_id']; ?>" class="ripple like_h_w">
                                                                            <i class="fa fa-comment-o" aria-hidden="true"> 
                                                                                <?php
                                                                                /*   if (count($commnetcount) > 0) {
                                                                                  echo count($commnetcount);
                                                                                  } */
                                                                                ?>
                                                                            </i> 
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <ul class="col-md-6 col-sm-6 col-xs-6 like_cmnt_count">

                                                                    <li>
                                                                        <div class="like_count_ext">
                                                                            <span class="comment_count<?php echo $row['business_profile_post_id']; ?>" > 
                                                                                <?php
                                                                                if (count($commnetcount) > 0) {
                                                                                    echo count($commnetcount);
                                                                                    ?>
                                                                                    <span> Comment</span>
                                                                                <?php }
                                                                                ?> 
                                                                            </span> 

                                                                        </div>
                                                                    </li>

                                                                    <li>
                                                                        <div class="comnt_count_ext">
                                                                            <span class="comment_like_count<?php echo $row['business_profile_post_id']; ?>"> 
                                                                                <?php
                                                                                if ($row['business_likes_count'] > 0) {
                                                                                    echo $row['business_likes_count'];
                                                                                    ?>

                                                                                    <span> Like</span>
                                                                                <?php }
                                                                                ?>

                                                                            </span> 

                                                                        </div></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <!-- like user list start -->
                                                        <!-- pop up box start-->
                                                        <?php
                                                        if ($row['business_likes_count'] > 0) {
                                                            ?>
                                                            <div class="likeduserlist<?php echo $row['business_profile_post_id'] ?>">
                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                $likeuser = $commnetcount[0]['business_like_user'];
                                                                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                $likelistarray = explode(',', $likeuser);
                                                                foreach ($likelistarray as $key => $value) {
                                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                }
                                                                ?>
                                                                <!-- pop up box end-->
                                                                <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['business_profile_post_id']; ?>);">
                                                                    <?php
                                                                    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                    $likeuser = $commnetcount[0]['business_like_user'];
                                                                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                    $likelistarray = explode(',', $likeuser);

                                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                    ?>
                                                                    <div class="like_one_other">
                                                                        <?php
                                                                        if ($userid == $value) {
                                                                            echo "You";
                                                                            echo "&nbsp;";
                                                                        } else {
                                                                            echo ucwords($business_fname1);
                                                                            echo "&nbsp;";
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if (count($likelistarray) > 1) {
                                                                            ?>
                                                                            <?php echo " and"; ?>
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

                                                        <div class="<?php echo "likeusername" . $row['business_profile_post_id']; ?>" id="<?php echo "likeusername" . $row['business_profile_post_id']; ?>" style="display:none">
                                                            <?php
                                                            $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                            $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            $likeuser = $commnetcount[0]['business_like_user'];
                                                            $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                            $likelistarray = explode(',', $likeuser);
                                                            foreach ($likelistarray as $key => $value) {
                                                                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                            }
                                                            ?>
                                                            <!-- pop up box end-->
                                                            <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['business_profile_post_id']; ?>);">
                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                $likeuser = $commnetcount[0]['business_like_user'];
                                                                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                $likelistarray = explode(',', $likeuser);

                                                                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                ?>
                                                                <div class="like_one_other">
                                                                    <?php
                                                                    echo ucwords($business_fname1);
                                                                    echo "&nbsp;";
                                                                    ?>
                                                                    <?php
                                                                    if (count($likelistarray) > 1) {
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


                                                        <!-- like user list end -->
                                                        <!-- all comment start-->
                                                        <div class="art-all-comment col-md-12">
                                                            <div  id="<?php echo "fourcomment" . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                <!-- khyati 19-4 changes start -->
                                                                <!-- khyati 19-4 changes end -->
                                                            </div>
                                                            <!-- khyati changes start -->
                                                            <div  id="<?php echo "threecomment" . $row['business_profile_post_id']; ?>" style="display:block">
                                                                <div class="<?php echo 'insertcomment' . $row['business_profile_post_id']; ?>">
                                                                    <?php
                                                                    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                                                                    $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                                    if ($businessprofiledata) {
                                                                        foreach ($businessprofiledata as $rowdata) {
                                                                            $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;

                                                                            $slugname1 = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_slug;
                                                                            ?>
                                                                            <div class="all-comment-comment-box">
                                                                                <div class="post-design-pro-comment-img"> 
                                                                                    <?php
                                                                                    $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                                                                                    ?>
                                                                                    <?php if ($business_userimage) { ?>
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname1); ?>">

                                                                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt=""> </a>
                                                                                    <?php } else { ?>
                                                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname1); ?>">

                                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                                        </a>
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="comment-name">
                                                                                    <b title=" <?php echo $companyname; ?>">  
                                                                                        <?php
                                                                                        echo $companyname;
                                                                                        echo '</br>';
                                                                                        ?>
                                                                                    </b>
                                                                                </div>
                                                                                <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                    <?php
                                                                                    //   echo $this->common->make_links($rowdata['comments']);
                                                                                    //echo '</br>';
                                                                                    $new_product_comment = $this->common->make_links($rowdata['comments']);
                                                                                    echo nl2br(htmlspecialchars_decode(htmlentities($new_product_comment, ENT_QUOTES, 'UTF-8')));
                                                                                    ?>
                                                                                </div>
                                                                                <!--                                                                <div class="col-md-12">
                                                                                                                                                    <div class="col-md-10">
                                                                                
                                                                                
                                                                                                                                                        <div contenteditable="true" class="editable_text" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>" id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none; margin-top: 0px!important;" value="<?php echo $rowdata['comments']; ?>" onClick="commentedit(this.name)"></div>
                                                                                                                                                    </div>
                                                                                                                                                    <div class="col-md-2 comment-edit-button">
                                                                                                                                                        <button id="<?php echo "editsubmit" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Comment
                                                                                                                                                        </button>
                                                                                                                                                    </div>
                                                                                                                                                </div>-->
                                                                                <div class="edit-comment-box">
                                                                                    <div class="inputtype-edit-comment">
                                                                                        <!--<textarea type="text" class="textarea" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>" id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;resize: none;" onClick="commentedit(this.name)"><?php echo $rowdata['comments']; ?></textarea>-->
                                                                                        <div contenteditable="true" class="editable_text editav_2" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>"  id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commentedit(<?php echo $rowdata['business_profile_post_comment_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $rowdata['comments']; ?></div>
                                                                                        <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Save</button></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="art-comment-menu-design"> 
                                                                                    <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                        <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_like1(this.id)">
                                                                                            <?php
                                                                                            $userid = $this->session->userdata('aileenuser');
                                                                                            $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' => '1');
                                                                                            $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                            $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);
                                                                                            if (!in_array($userid, $likeuserarray)) {
                                                                                                ?>
                                                                                                <i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>
                                                                                            <?php } else { ?>
                                                                                                <i class="fa fa-thumbs-up main_color" aria-hidden="true">
                                                                                                </i>
                                                                                            <?php } ?>
                                                                                            <span>
                                                                                                <?php
                                                                                                if ($rowdata['business_comment_likes_count']) {
                                                                                                    echo $rowdata['business_comment_likes_count'];
                                                                                                }
                                                                                                ?>
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                    <?php
                                                                                    $userid = $this->session->userdata('aileenuser');
                                                                                    if ($rowdata['user_id'] == $userid) {
                                                                                        ?>
                                                                                        <span role="presentation" aria-hidden="true"> · 
                                                                                        </span>
                                                                                        <div class="comment-details-menu">
                                                                                            <div id="<?php echo 'editcommentbox' . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                                                                                <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                                                                                </a>
                                                                                            </div>
                                                                                            <div id="<?php echo 'editcancle' . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                                                                                <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <?php
                                                                                    $userid = $this->session->userdata('aileenuser');
                                                                                    $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                                                                                    if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                                                                                        ?>                                     
                                                                                        <span role="presentation" aria-hidden="true"> · 
                                                                                        </span>
                                                                                        <div class="comment-details-menu">
                                                                                            <input type="hidden" name="post_delete"  id="post_delete<?php echo $rowdata['business_profile_post_comment_id']; ?>" value= "<?php echo $rowdata['business_profile_post_id']; ?>">
                                                                                            <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete
                                                                                                <span class="<?php echo 'insertcomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                                </span>
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php } ?>                                   
                                                                                    <span role="presentation" aria-hidden="true"> · 
                                                                                    </span>
                                                                                    <div class="comment-details-menu">
                                                                                        <p>
                                                                                            <?php
                                                                                            echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                                                                            //echo date('Y-m-d H:i:s', strtotime($rowdata['created_date']));
                                                                                            echo '</br>';
                                                                                            ?>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <!-- khyati changes end -->
                                                            <!-- all comment end -->
                                                        </div>
                                                        <!-- comment start -->
                                                        <div class="post-design-commnet-box col-md-12">
                                                            <div class="post-design-proo-img"> 
                                                                <?php
                                                                $userid = $this->session->userdata('aileenuser');
                                                                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_user_image;
                                                                ?>
                                                                <?php if ($business_userimage) { ?>
                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                <?php } ?>
                                                            </div>

                                                            <div id="content" class="col-md-12  inputtype-comment cmy_2" >
                                                                <div contenteditable="true" class="edt_2 editable_text" name="<?php echo $row['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $row['business_profile_post_id']; ?>" placeholder="Add a Comment ..." onClick="entercomment(<?php echo $row['business_profile_post_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>
                                                            </div>
                                                            <?php echo form_error('post_comment'); ?> 
                                                            <div class="comment-edit-butn">       
                                                                <button id="<?php echo $row['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <!-- comment end -->
                                                    </div>
                                                </div></div>
                                            <?php
                                        } else {
                                            $count[] = "abc";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            if (count($businessprofiledatapost) > 0) {
                                if (count($count) == count($businessprofiledatapost)) {
                                    ?>
                                    <div class="contact-frnd-post bor_none">
                                        <div class="text-center rio">
                                            <h4 class="page-heading  product-listing" >No Post Found.</h4>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="contact-frnd-post bor_none">
                                    <div class="text-center rio">
                                        <h4 class="page-heading  product-listing" >No Post Found.</h4>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- body content end-->

                            <!-- no post found div start -->
                            <div class="nofoundpost"> 
                            </div>
                            <!-- no post found div end -->


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
                    <button type="button" class="modal-close" data-dismiss="modal">&times;
                    </button>       
                    <div class="modal-body">
                      <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->

        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="likeusermodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close1" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->


        <!-- Bid-modal for this modal appear or not start -->
        <div class="modal fade message-box" id="post" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bid-modal for this modal appear or not  Popup Close -->



    </body>
</html>




<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>


<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script> 
<!-- <script type="text/javascript">jQuery.noConflict();</script> -->

<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 


<script>

                                                                    jQuery.noConflict();

                                                                    (function ($) {


                                                                        var data = <?php echo json_encode($demo);
            ?>;
                                                                        //alert(data);
                                                                        $(function () {
                                                                            // alert('hi');
                                                                            $("#tags").autocomplete({
                                                                                source: function (request, response) {
                                                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                                    response($.grep(data, function (item) {
                                                                                        return matcher.test(item.label);
                                                                                    }));
                                                                                }
                                                                                ,
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
                                                                        }
                                                                        );

                                                                    })(jQuery);

</script>


<script>

    jQuery.noConflict();

    (function ($) {

        var data1 = <?php echo json_encode($city_data);
            ?>;
        //alert(data);
        $(function () {
            // alert('hi');
            $("#searchplace").autocomplete({
                source: function (request, response) {
                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                    response($.grep(data1, function (item) {
                        return matcher.test(item.label);
                    }));
                }
                ,
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
        }
        );

    })(jQuery);

</script>



<script>
    $('#content').on('change keyup keydown paste cut', 'textarea', function () {
        $(this).height(0).height(this.scrollHeight);
    }).find('textarea').change();
</script>




<script type="text/javascript">
    function checkvalue() {
        //alert("hi");
        var searchkeyword = $.trim(document.getElementById('tags').value);
        var searchplace = $.trim(document.getElementById('searchplace').value);
        // alert(searchkeyword);
        // alert(searchplace);
        if (searchkeyword == "" && searchplace == "") {
            //alert('Please enter Keyword');
            return false;
        }
    }
</script>
<!-- <script>
    //select2 autocomplete start for Location
    $('#searchplace').select2({
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax: {
            url: "<?php echo base_url(); ?>business_profile/location",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    //alert(data);
                    results: data
                };
            }
            ,
            cache: true
        }
    });
</script>
--><!-- like comment script start -->
<!-- post like script start -->
<script type="text/javascript">
    function post_like(clicked_id)
    {
        //alert(clicked_id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/like_post" ?>',
            data: 'post_id=' + clicked_id,
            dataType: 'json',
            success: function (data) {
                // $('.' + 'likepost' + clicked_id).html(data);
                //alert(data.like_user_count);

                $('.' + 'likepost' + clicked_id).html(data.like);
                $('.likeusername' + clicked_id).html(data.likeuser);
                $('.comment_like_count' + clicked_id).html(data.like_user_count);
                $('.likeduserlist' + clicked_id).hide();
                //alert(data.like_user_total_count);
                if (data.like_user_total_count == '0') {
                    document.getElementById('likeusername' + clicked_id).style.display = "none";
                } else {
                    document.getElementById('likeusername' + clicked_id).style.display = "block";
                }
                $('#likeusername' + clicked_id).addClass('likeduserlist1');
            }
        });
    }
//    $(document).ready(function(){
//        $('.like_one_other').
//    });
</script>
<!--post like script end -->
<!-- comment insert script start -->
<script type="text/javascript">
//    function insert_comment(clicked_id)
//    {
//        var post_comment = document.getElementById("post_comment" + clicked_id);
//        var $field = $('#post_comment' + clicked_id);
//        var post_comment = $('#post_comment' + clicked_id).html();
//
//        $('#post_comment' + clicked_id).html("");
//        $.ajax({
//            type: 'POST',
//            url: '<?php echo base_url() . "business_profile/insert_commentthree" ?>',
//            data: 'post_id=' + clicked_id + '&comment=' + post_comment,
//            dataType: "json",
//            success: function (data) {
//                $('div').each(function () {
//                    $(this).val('');
//                });
//                $('#' + 'insertcount' + clicked_id).html(data.count);
//                $('.' + 'insertcomment' + clicked_id).html(data.comment);
//            }
//        });
//    }

    function insert_comment(clicked_id)
    {
        $("#post_comment" + clicked_id).click(function () {
            $(this).prop("contentEditable", true);
            $(this).html("");
        });

        var sel = $("#post_comment" + clicked_id);
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
        txt = txt.replace(/&/g, "%26");
        $('#post_comment' + clicked_id).html("");

        var x = document.getElementById('threecomment' + clicked_id);
        var y = document.getElementById('fourcomment' + clicked_id);

        if (x.style.display === 'block' && y.style.display === 'none') {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "business_profile/insert_commentthree" ?>',
                data: 'post_id=' + clicked_id + '&comment=' + txt,
                dataType: "json",
                success: function (data) {
                    $('textarea').each(function () {
                        $(this).val('');
                    });
                    //   $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('.insertcomment' + clicked_id).html(data.comment);
                    $('.comment_count' + clicked_id).html(data.comment_count);
                }
            });

        } else {

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "business_profile/insert_comment" ?>',
                data: 'post_id=' + clicked_id + '&comment=' + txt,
                dataType: "json",
                success: function (data) {
                    $('textarea').each(function () {
                        $(this).val('');
                    });
                    // $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('#' + 'fourcomment' + clicked_id).html(data.comment);
                    $('.comment_count' + clicked_id).html(data.comment_count);
                }
            });
        }
    }
</script>
<!-- insert comment using enter -->
<script type="text/javascript">
//    function entercomment(clicked_id)
//    {
//        $(document).ready(function () {
//            $('#post_comment' + clicked_id).keypress(function (e) {
//                if (event.which == 13 && event.shiftKey != 1) {
//                    var val = $('#post_comment' + clicked_id).val();
//                    var $field = $('#post_comment' + clicked_id);
//                    var post_comment = $('#post_comment' + clicked_id).html();
//                    $('#post_comment' + clicked_id).html("");
//                    e.preventDefault();
//
//                    if (window.preventDuplicateKeyPresses)
//                        return;
//                    window.preventDuplicateKeyPresses = true;
//                    window.setTimeout(function () {
//                        window.preventDuplicateKeyPresses = false;
//                    }, 500);
//                    var x = document.getElementById('threecomment' + clicked_id);
//                    var y = document.getElementById('fourcomment' + clicked_id);
//                    if (x.style.display === 'block' && y.style.display === 'none') {
//                        $.ajax({
//                            type: 'POST',
//                            url: '<?php echo base_url() . "business_profile/insert_commentthree" ?>',
//                            data: 'post_id=' + clicked_id + '&comment=' + val,
//                            dataType: "json",
//                            success: function (data) {
//                                $('input').each(function () {
//                                    $(this).val('');
//                                });
//                                $('#' + 'insertcount' + clicked_id).html(data.count);
//                                $('.insertcomment' + clicked_id).html(data.comment);
//                            }
//                        });
//                    } else {
//                        $.ajax({
//                            type: 'POST',
//                            url: '<?php echo base_url() . "business_profile/insert_comment" ?>',
//                            data: 'post_id=' + clicked_id + '&comment=' + val,
//                            success: function (data) {
//                                $('input').each(function () {
//                                    $(this).val('');
//                                }
//                                );
//                                $('#' + 'fourcomment' + clicked_id).html(data);
//                            }
//                        });
//                    }
//                }
//            });
//        });
//    }

    function entercomment(clicked_id)
    {
//                    $(document).ready(function () {

        $("#post_comment" + clicked_id).click(function () {
            $(this).prop("contentEditable", true);
            //$(this).html("");
        });

        $('#post_comment' + clicked_id).keypress(function (e) {

            if (e.keyCode == 13 && !e.shiftKey) {
                e.preventDefault();
                var sel = $("#post_comment" + clicked_id);
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
                txt = txt.replace(/&/g, "%26");
                $('#post_comment' + clicked_id).html("");

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);

                // khyati chnages  start

                var x = document.getElementById('threecomment' + clicked_id);
                var y = document.getElementById('fourcomment' + clicked_id);

                if (x.style.display === 'block' && y.style.display === 'none') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/insert_commentthree" ?>',
                        data: 'post_id=' + clicked_id + '&comment=' + txt,
                        dataType: "json",
                        success: function (data) {
                            $('textarea').each(function () {
                                $(this).val('');
                            });
                            //  $('.insertcomment' + clicked_id).html(data);
                            // $('#' + 'insertcount' + clicked_id).html(data.count);
                            $('.insertcomment' + clicked_id).html(data.comment);
                            $('.comment_count' + clicked_id).html(data.comment_count);

                        }
                    });

                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/insert_comment" ?>',
                        data: 'post_id=' + clicked_id + '&comment=' + txt,
                        dataType: "json",
                        success: function (data) {
                            $('textarea').each(function () {
                                $(this).val('');
                            });
                            //$('#' + 'fourcomment' + clicked_id).html(data);
                            //$('#' + 'insertcount' + clicked_id).html(data.count);
                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
                            $('.comment_count' + clicked_id).html(data.comment_count);
                        }
                    });
                }
                // khyati chnages end
                //alert(val);
            }
        });
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
        });
        //  });

    }
</script>
<!--comment insert script end -->
<!-- hide and show data start-->
<script type="text/javascript">
    function commentall(clicked_id) {
        var x = document.getElementById('threecomment' + clicked_id);
        var y = document.getElementById('fourcomment' + clicked_id);
        var z = document.getElementById('insertcount' + clicked_id);

        $('.post-design-commnet-box').show();
        if (x.style.display === 'block' && y.style.display === 'none') {
            x.style.display = 'none';
            y.style.display = 'block';
            z.style.visibility = 'show';
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "business_profile/fourcomment" ?>',
                data: 'bus_post_id=' + clicked_id,
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
        //          url:'<?php //echo base_url() . "business_profile/fourcomment"                                                                                ?>',
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
<!-- comment like script start -->
<script type="text/javascript">
    function comment_like(clicked_id)
    {
        //alert(clicked_id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/like_comment" ?>',
            data: 'post_id=' + clicked_id,
            success: function (data) {
                //alert('.' + 'likepost' + clicked_id);
                $('#' + 'likecomment' + clicked_id).html(data);
            }
        });
    }
</script>
<script type="text/javascript">
    function comment_like1(clicked_id)
    {
        //alert(clicked_id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/like_comment1" ?>',
            data: 'post_id=' + clicked_id,
            success: function (data) {
                //alert('.' + 'likepost' + clicked_id);
                $('#' + 'likecomment1' + clicked_id).html(data);
            }
        });
    }
</script>
<!--comment like script end -->
<script type="text/javascript">
    function comment_delete(clicked_id) {
        $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');

    }

    function comment_deleted(clicked_id)
    {
        var post_delete = document.getElementById("post_delete" + clicked_id);
        //alert(post_delete.value);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/delete_comment" ?>',
            data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
            dataType: "json",
            success: function (data) {
                //alert('.' + 'insertcomment' + clicked_id);
                $('.' + 'insertcomment' + post_delete.value).html(data.comment);
                //$('#' + 'insertcount' + post_delete.value).html(data.count);
                $('.comment_count' + post_delete.value).html(data.comment_count);
                $('.post-design-commnet-box').show();
            }
        });
    }

    function comment_deletetwo(clicked_id)
    {

        $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }

    function comment_deletedtwo(clicked_id)
    {
        var post_delete1 = document.getElementById("post_deletetwo");
        //alert(post_delete.value);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/delete_commenttwo" ?>',
            data: 'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
            dataType: "json",
            success: function (data) {
                //alert('.' + 'insertcomment' + clicked_id);
                $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
                //$('#' + 'insertcount' + post_delete1.value).html(data.count);
                $('.comment_count' + post_delete1.value).html(data.comment_count);
                $('.post-design-commnet-box').show();
            }
        });
    }
</script>
<!--comment delete script end -->
<!-- comment edit box start-->
<script type="text/javascript">
    function comment_editbox(clicked_id) {
        document.getElementById('editcomment' + clicked_id).style.display = 'inline-block';
        document.getElementById('showcomment' + clicked_id).style.display = 'none';
        document.getElementById('editsubmit' + clicked_id).style.display = 'inline-block';
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
<script type="text/javascript">
//    function edit_comment(abc)
//    {
//        var post_comment_edit = document.getElementById("editcomment" + abc);
//        var $field = $('#editcomment' + abc);
//        var post_comment_edit = $('#editcomment' + abc).html();
//        $.ajax({
//            type: 'POST',
//            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
//            data: 'post_id=' + abc + '&comment=' + post_comment_edit,
//            success: function (data) {
//                document.getElementById('editcomment' + abc).style.display = 'none';
//                document.getElementById('showcomment' + abc).style.display = 'block';
//                document.getElementById('editsubmit' + abc).style.display = 'none';
//                document.getElementById('editcommentbox' + abc).style.display = 'block';
//                document.getElementById('editcancle' + abc).style.display = 'none';
//                $('#' + 'showcomment' + abc).html(data);
//            }
//        });
//    }

    function edit_comment(abc)
    {
        //var post_comment_edit = document.getElementById("editcomment" + abc);

        $("#editcomment" + abc).click(function () {
            $(this).prop("contentEditable", true);
            //     $(this).html("");
        });

        var sel = $("#editcomment" + abc);
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
        txt = txt.replace(/&/g, "%26");
//                    alert(txt);
//                    return false;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
            data: 'post_id=' + abc + '&comment=' + txt,
            success: function (data) { //alert('falguni');

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
//    function commentedit(abc)
//    {
//        $(document).ready(function () {
//            $('#editcomment' + abc).keypress(function (e) {
//                if (e.keyCode == 13 && !e.shiftKey) {
//                    var val = $('#editcomment' + abc).val();
//                    e.preventDefault();
//                    if (window.preventDuplicateKeyPresses)
//                        return;
//                    window.preventDuplicateKeyPresses = true;
//                    window.setTimeout(function () {
//                        window.preventDuplicateKeyPresses = false;
//                    }, 500);
//                    $.ajax({
//                        type: 'POST',
//                        url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
//                        data: 'post_id=' + abc + '&comment=' + val,
//                        success: function (data) {
//                            document.getElementById('editcomment' + abc).style.display = 'none';
//                            document.getElementById('showcomment' + abc).style.display = 'block';
//                            document.getElementById('editsubmit' + abc).style.display = 'none';
//                            document.getElementById('editcommentbox' + abc).style.display = 'block';
//                            document.getElementById('editcancle' + abc).style.display = 'none';
//                            $('#' + 'showcomment' + abc).html(data);
//                        }
//                    });
//                }
//            });
//        });
//    }

    function commentedit(abc)
    {
//                    alert(1212121);
//                    return false;
        //$(document).ready(function () {

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
                    return false;
                }
                if (/^\s+$/gi.test(txt))
                {
                    return false;
                }
                txt = txt.replace(/&/g, "%26");
                //$('#editcomment' + abc).html("");

                if (window.preventDuplicateKeyPresses)
                    return;
                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data: 'post_id=' + abc + '&comment=' + txt,
                    success: function (data) { //alert('falguni');
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
        //});
    }

</script>
<script type="text/javascript">
//    function edit_commenttwo(abc)
//    {
//        var post_comment_edit = document.getElementById("editcommenttwo" + abc);
//        $.ajax({
//            type: 'POST',
//            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
//            data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
//            success: function (data) {
//                document.getElementById('editcommenttwo' + abc).style.display = 'none';
//                document.getElementById('showcommenttwo' + abc).style.display = 'block';
//                document.getElementById('editsubmittwo' + abc).style.display = 'none';
//                document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
//                document.getElementById('editcancletwo' + abc).style.display = 'none';
//                $('#' + 'showcommenttwo' + abc).html(data);
//            }
//        });
//    }


    function edit_commenttwo(abc)
    {
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
            return false;
        }
        if (/^\s+$/gi.test(txt))
        {
            return false;
        }
        txt = txt.replace(/&/g, "%26");
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
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

//                function commentedittwo(abc)
//                {
//                    $(document).ready(function () {
//                        $('#editcommenttwo' + abc).keypress(function (e) {
//                            if (e.keyCode == 13 && !e.shiftKey) {
//                                var val = $('#editcommenttwo' + abc).val();
//                                e.preventDefault();
//
//                                if (window.preventDuplicateKeyPresses)
//                                    return;
//
//                                window.preventDuplicateKeyPresses = true;
//                                window.setTimeout(function () {
//                                    window.preventDuplicateKeyPresses = false;
//                                }, 500);
//
//                                $.ajax({
//                                    type: 'POST',
//                                    url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
//                                    data: 'post_id=' + abc + '&comment=' + val,
//                                    success: function (data) { //alert('falguni');
//
//
//                                        document.getElementById('editcommenttwo' + abc).style.display = 'none';
//                                        document.getElementById('showcommenttwo' + abc).style.display = 'block';
//                                        document.getElementById('editsubmittwo' + abc).style.display = 'none';
//
//                                        document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
//                                        document.getElementById('editcancletwo' + abc).style.display = 'none';
//                                        //alert('.' + 'showcomment' + abc);
//
//                                        $('#' + 'showcommenttwo' + abc).html(data);
//                                        $('.post-design-commnet-box').show();
//
//
//                                    }
//                                });
//                            }
//                        });
//                    });
//
//                }

    function commentedittwo(abc)
    {
        //$(document).ready(function () {
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
                    return false;
                }
                if (/^\s+$/gi.test(txt))
                {
                    return false;
                }
                txt = txt.replace(/&/g, "%26");
                //$('#editcommenttwo' + abc).html("");

                if (window.preventDuplicateKeyPresses)
                    return;

                window.preventDuplicateKeyPresses = true;
                window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                }, 500);

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data: 'post_id=' + abc + '&comment=' + txt,
                    success: function (data) { //alert('falguni');


                        document.getElementById('editcommenttwo' + abc).style.display = 'none';
                        document.getElementById('showcommenttwo' + abc).style.display = 'block';
                        document.getElementById('editsubmittwo' + abc).style.display = 'none';

                        document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                        document.getElementById('editcancletwo' + abc).style.display = 'none';
                        //alert('.' + 'showcomment' + abc);

                        $('#' + 'showcommenttwo' + abc).html(data);
                        $('.post-design-commnet-box').show();


                    }
                });
            }
        });
        //});
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
        });

    }
</script>
<script type="text/javascript">
    function commentedit2(abc)
    {
        $(document).ready(function () {
            $('#editcomment2' + abc).keypress(function (e) {
                if (e.keyCode == 13 && !e.shiftKey) {
                    var val = $('#editcomment2' + abc).val();
                    e.preventDefault();
                    if (window.preventDuplicateKeyPresses)
                        return;
                    window.preventDuplicateKeyPresses = true;
                    window.setTimeout(function () {
                        window.preventDuplicateKeyPresses = false;
                    }, 500);
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                        data: 'post_id=' + abc + '&comment=' + val,
                        success: function (data) {
                            //alert('falguni');
                            //  $('input').each(function(){
                            //     $(this).val('');
                            // }); 
                            document.getElementById('editcomment2' + abc).style.display = 'none';
                            document.getElementById('showcomment2' + abc).style.display = 'block';
                            document.getElementById('editsubmit2' + abc).style.display = 'none';
                            document.getElementById('editcommentbox2' + abc).style.display = 'block';
                            document.getElementById('editcancle2' + abc).style.display = 'none';
                            //alert('.' + 'showcomment' + abc);
                            $('#' + 'showcomment2' + abc).html(data);
                        }
                    });
                    //alert(val);
                }
            });
        });
    }
</script>
<script type="text/javascript">
    function edit_comment3(abc)
    { //alert('editsubmit' + abc);

        var post_comment_edit = document.getElementById("editcomment3" + abc);
        //alert(post_comment.value);
        //alert(post_comment.value);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
            data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
            success: function (data) { //alert('falguni');

                //  $('input').each(function(){
                //     $(this).val('');
                // }); 
                document.getElementById('editcomment3' + abc).style.display = 'none';
                document.getElementById('showcomment3' + abc).style.display = 'block';
                document.getElementById('editsubmit3' + abc).style.display = 'none';

                document.getElementById('editcommentbox3' + abc).style.display = 'block';
                document.getElementById('editcancle3' + abc).style.display = 'none';
                //alert('.' + 'showcomment' + abc);
                $('#' + 'showcomment3' + abc).html(data);
                $('.post-design-commnet-box').show();


            }
        });
        //window.location.reload();
    }
</script>


<script type="text/javascript">

    function commentedit3(abc)
    {
        $(document).ready(function () {
            $('#editcomment3' + abc).keypress(function (e) {


                if (e.keyCode == 13 && !e.shiftKey) {
                    var val = $('#editcomment3' + clicked_id).val();
                    e.preventDefault();

                    if (window.preventDuplicateKeyPresses)
                        return;

                    window.preventDuplicateKeyPresses = true;
                    window.setTimeout(function () {
                        window.preventDuplicateKeyPresses = false;
                    }, 500);

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                        data: 'post_id=' + abc + '&comment=' + val,
                        success: function (data) { //alert('falguni');

                            //  $('input').each(function(){
                            //     $(this).val('');
                            // }); 
                            document.getElementById('editcomment3' + abc).style.display = 'none';
                            document.getElementById('showcomment3' + abc).style.display = 'block';
                            document.getElementById('editsubmit3' + abc).style.display = 'none';

                            document.getElementById('editcommentbox3' + abc).style.display = 'block';
                            document.getElementById('editcancle3' + abc).style.display = 'none';
                            //alert('.' + 'showcomment' + abc);
                            $('#' + 'showcomment3' + abc).html(data);



                        }
                    });

                    //alert(val);
                }
            });
        });

    }
</script>

<script type="text/javascript">
    function edit_comment4(abc)
    { //alert('editsubmit' + abc);

        var post_comment_edit = document.getElementById("editcomment4" + abc);
        //alert(post_comment.value);
        //alert(post_comment.value);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
            data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
            success: function (data) { //alert('falguni');

                //  $('input').each(function(){
                //     $(this).val('');
                // }); 
                document.getElementById('editcomment4' + abc).style.display = 'none';
                document.getElementById('showcomment4' + abc).style.display = 'block';
                document.getElementById('editsubmit4' + abc).style.display = 'none';

                document.getElementById('editcommentbox4' + abc).style.display = 'block';
                document.getElementById('editcancle4' + abc).style.display = 'none';
                //alert('.' + 'showcomment' + abc);
                $('#' + 'showcomment4' + abc).html(data);



            }
        });
        //window.location.reload();
    }
</script>

<script type="text/javascript">

    function commentedit4(abc)
    {
        $(document).ready(function () {
            $('#editcomment4' + abc).keypress(function (e) {

                if (e.keyCode == 13 && !e.shiftKey) {
                    var val = $('#editcomment4' + clicked_id).val();
                    e.preventDefault();

                    if (window.preventDuplicateKeyPresses)
                        return;

                    window.preventDuplicateKeyPresses = true;
                    window.setTimeout(function () {
                        window.preventDuplicateKeyPresses = false;
                    }, 500);

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                        data: 'post_id=' + abc + '&comment=' + val,
                        success: function (data) { //alert('falguni');

                            //  $('input').each(function(){
                            //     $(this).val('');
                            // }); 
                            document.getElementById('editcomment4' + abc).style.display = 'none';
                            document.getElementById('showcomment4' + abc).style.display = 'block';
                            document.getElementById('editsubmit4' + abc).style.display = 'none';

                            document.getElementById('editcommentbox4' + abc).style.display = 'block';
                            document.getElementById('editcancle4' + abc).style.display = 'none';
                            //alert('.' + 'showcomment' + abc);
                            $('#' + 'showcomment4' + abc).html(data);



                        }
                    });

                    //alert(val);
                }
            });
        });

    }
</script>

<!--comment edit insert script end -->
<!-- like comment script end -->
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
<!-- further and less -->
<!--<script src="../js/jquery-1.8.2.js">
</script>-->



<!-- drop down script zalak start -->
<script>
    /* When the user clicks on the button, 
     toggle between hiding and showing the dropdown content */
    function myFunction(clicked_id) {
//        $('.dropdown-content1').removeClass('show');
//        document.getElementById('myDropdown' + clicked_id).classList.toggle("show");

        var dropDownClass = document.getElementById('myDropdown' + clicked_id).className;
        dropDownClass = dropDownClass.split(" ").pop(-1);
        if (dropDownClass != 'show') {
            $('.dropdown-content1').removeClass('show');
            $('#myDropdown' + clicked_id).addClass('show');
        } else {
            $('.dropdown-content1').removeClass('show');
        }


        $(document).on('keydown', function (e) {
            if (e.keyCode === 27) {

                document.getElementById('myDropdown' + clicked_id).classList.toggle("hide");
                $(".dropdown-content1").removeClass('show');

            }

        });

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
<!-- drop down script zalak end -->
<!-- multi image add post khyati start -->
<script type="text/javascript">
    //alert("a");
    var $fileUpload = $("#files"),
            $list = $('#list'),
            thumbsArray = [],
            maxUpload = 5;
    // READ FILE + CREATE IMAGE
    function read(f) {
        //alert("aa");
        return function (e) {
            var base64 = e.target.result;
            var $img = $('<img/>', {
                src: base64,
                title: encodeURIComponent(f.name), //( escape() is deprecated! )
                "class": "thumb"
            });
            var $thumbParent = $("<span/>", {
                html: $img, "class": "thumbParent"}
            ).append('<span class="remove_thumb"/>');
            thumbsArray.push(base64);
            // Push base64 image into array or whatever.
            $list.append($thumbParent);
        };
    }
    // HANDLE FILE/S UPLOAD
    function handleFileSelect(e) {
        //alert("aaa");
        e.preventDefault();
        // Needed?
        var files = e.target.files;
        var len = files.length;
        if (len > maxUpload || thumbsArray.length >= maxUpload) {
            return alert("Sorry you can upload only 5 images");
        }
        for (var i = 0; i < len; i++) {
            var f = files[i];
            if (!f.type.match('image.*'))
                continue;
            // Only images allowed    
            var reader = new FileReader();
            reader.onload = read(f);
            // Call read() function
            reader.readAsDataURL(f);
        }
    }
    $fileUpload.change(function (e) {
        alert("aaaa");
        handleFileSelect(e);
    }
    );
    $list.on('click', '.remove_thumb', function () {
        //alert("aaaaa");
        var $removeBtns = $('.remove_thumb');
        // Get all of them in collection
        var idx = $removeBtns.index(this);
        // Exact Index-from-collection
        $(this).closest('span.thumbParent').remove();
        // Remove tumbnail parent
        thumbsArray.splice(idx, 1);
        // Remove from array
    });
</script>
<!-- multi image add post khyati end -->
<script language=JavaScript>

    function check_length(my_form)
    {
        maxLen = 50;
        // max number of characters allowed
        if (my_form.my_text.value.length > maxLen) {
            // Alert message if maximum limit is reached. 
            // If required Alert can be removed. 
            var msg = "You have reached your maximum limit of characters allowed";
            //alert(msg);

            $('.biderror .mes').html("<div class='pop_content'>" + msg + "</div>");
            $('#bidmodal').modal('show');

            // Reached the Maximum length so trim the textarea
            my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
        } else {
            // Maximum length not reached so update the value of my_text counter
            my_form.text_num.value = maxLen - my_form.my_text.value.length;
        }
    }
    //-->
</script>
<!--- khyati change end-->

<!-- savepost start -->
<script type="text/javascript">
    function save_post(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/business_profile_save" ?>',
            data: 'business_profile_post_id=' + abc,
            success: function (data) {
                $('.' + 'savedpost' + abc).html(data);
            }
        });
    }
</script>
<!-- save post end -->
<!-- remove save post start -->

<!-- remove save post end -->
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
                $("#fad" + clicked_id).fadeOut(6000);
            }
        });
    }
</script>
<script type="text/javascript">
    function followclose(clicked_id)
    {
        $("#fad" + clicked_id).fadeOut(4000);
    }
</script>
<!--follow like script end -->
<!-- insert post script zalak start -->
<script>
    $('#file-fr').fileinput({
        language: 'fr',
        uploadUrl: '#',
        allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp']
    });
    $('#file-es').fileinput({
        language: 'es',
        uploadUrl: '#',
        allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp']
    });
    $("#file-0").fileinput({
        'allowedFileExtensions': ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp']
    });
    $("#file-1").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image','video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    /*$(".file").on('fileselect', function(event, n, l) {
     alert('File Selected. Name: ' + l + ', Num: ' + n);
     });
     */
    $("#file-3").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        overwriteInitial: false,
        initialPreviewAsData: true,
        initialPreview: [
            "http://lorempixel.com/1920/1080/transport/1",
            "http://lorempixel.com/1920/1080/transport/2",
            "http://lorempixel.com/1920/1080/transport/3",
        ],
        initialPreviewConfig: [
            {
                caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1}
            ,
            {
                caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2}
            ,
            {
                caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
            ,
        ],
    });
    $("#file-4").fileinput({
        uploadExtraData: {
            kvId: '10'}
    });
    $(".btn-warning").on('click', function () {
        var $el = $("#file-4");
        if ($el.attr('disabled')) {
            $el.fileinput('enable');
        } else {
            $el.fileinput('disable');
        }
    });
    $(".btn-info").on('click', function () {
        $("#file-4").fileinput('refresh', {
            previewClass: 'bg-info'});
    });
    /*
     $('#file-4').on('fileselectnone', function() {
     alert('Huh! You selected no files.');
     });
     $('#file-4').on('filebrowse', function() {
     alert('File browse clicked for #file-4');
     });
     */
    $(document).ready(function () {
        $("#test-upload").fileinput({
            'showPreview': false,
            'allowedFileExtensions': ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp'],
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
                {
                    caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1}
                ,
                {
                    caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2}
                ,
                {
                    caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
                ,
            ]
        });
        /*
         $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
         alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
         });
         */
    });
</script>
<!-- insert post zalak script end -->
<!-- post insert developing script start -->
<script type="text/javascript">
    $(document).ready(function ($jquery) {
    });
</script>

<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>


<script type="text/javascript">
    function imgval(event) {

        var fileInput = document.getElementById("file-1").files;
        var product_name = document.getElementById("test-upload-product").value;
        var product_description = document.getElementById("test-upload-des").value;
        var product_fileInput = document.getElementById("file-1").value;


        if (product_fileInput == '' && product_name == '' && product_description == '')
        {

            $('#post .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
            $('#post').modal('show');
            // window.location='';

            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $('#bidmodal').modal('hide');
                    $('.modal-post').show();

                }
            });
            event.preventDefault();
            return false;

        } else {
//            alert("hii");

            for (var i = 0; i < fileInput.length; i++)
            {
                var vname = fileInput[i].name;
                var vfirstname = fileInput[0].name;
                var ext = vfirstname.split('.').pop();
                var ext1 = vname.split('.').pop();
                var allowedExtensions = ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp'];
                var allowesvideo = ['mp4', 'webm'];
                var allowesaudio = ['mp3'];
                var allowespdf = ['pdf'];

                var foundPresent = $.inArray(ext, allowedExtensions) > -1;
//                alert(foundPresent);
                var foundPresentvideo = $.inArray(ext, allowesvideo) > -1;
                var foundPresentaudio = $.inArray(ext, allowesaudio) > -1;
                var foundPresentpdf = $.inArray(ext, allowespdf) > -1;


                if (foundPresent == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;
                    if (foundPresent1 == true && fileInput.length <= 10) {
                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#bidmodal').modal('show');
                        setInterval('window.location.reload()', 10000);
                        // window.location='';

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                //$( "#bidmodal" ).hide();
                                $('#bidmodal').modal('hide');
                                $('.modal-post').show();

                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentvideo == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowesvideo) > -1;
                    if (foundPresent1 == true && fileInput.length == 1) {
                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#bidmodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                //$( "#bidmodal" ).hide();
                                $('#bidmodal').modal('hide');
                                $('.modal-post').show();

                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentaudio == true)
                {
                    var foundPresent1 = $.inArray(ext1, allowesaudio) > -1;
                    if (foundPresent1 == true && fileInput.length == 1) {
                    } else {
                        $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        $('#bidmodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                //$( "#bidmodal" ).hide();
                                $('#bidmodal').modal('hide');
                                $('.modal-post').show();

                            }
                        });
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

                            $(document).on('keydown', function (e) {
                                if (e.keyCode === 27) {
                                    //$( "#bidmodal" ).hide();
                                    $('#bidmodal').modal('hide');
                                    $('.modal-post').show();

                                }
                            });
                            event.preventDefault();
                            return false;
                        }
                    } else {
                        if (fileInput.length > 10) {
                            $('.biderror .mes').html("<div class='pop_content'>You can not upload more than 10 files at a time.");
                        } else {
                            $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                        }
                        $('#bidmodal').modal('show');
                        setInterval('window.location.reload()', 10000);

                        $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                                //$( "#bidmodal" ).hide();
                                $('#bidmodal').modal('hide');
                                $('.modal-post').show();

                            }
                        });
                        event.preventDefault();
                        return false;
                    }
                } else if (foundPresentvideo == false) {

                    $('.biderror .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files..");
                    $('#bidmodal').modal('show');
                    setInterval('window.location.reload()', 10000);

                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            //$( "#bidmodal" ).hide();
                            $('#bidmodal').modal('hide');
                            $('.modal-post').show();

                        }
                    });
                    event.preventDefault();
                    return false;

                }
            }
        }
    }
</script>
<script type="text/javascript">
//This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open start
    $(document).ready(function () {
        $('#post').on('click', function () {

            $('.modal-post').show();
            //  location.reload(false);
        });
    });
    //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open end  
</script>


<!-- post insert developing code end  -->


    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>-->
<script type="text/javascript">
    function contentedit(clicked_id) {
        //alert(clicked_id);

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
                txt = txt.replace(/&nbsp;/gi, " ");
                txt = txt.replace(/<br>$/, '');
                if (txt == '' || txt == '<br>') {
                    return false;
                }
                if (/^\s+$/gi.test(txt))
                {
                    return false;
                }
                txt = txt.replace(/&/g, "%26");
                $('#post_comment' + clicked_id).html("");
                // $("#result").html(txt);
                // sel.html("")
                // sel.blur();


                var x = document.getElementById('threecomment' + clicked_id);
                var y = document.getElementById('fourcomment' + clicked_id);
                if (x.style.display === 'block' && y.style.display === 'none') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/insert_commentthree" ?>',
                        data: 'post_id=' + clicked_id + '&comment=' + txt,
                        dataType: "json",
                        success: function (data) {
                            $('input').each(function () {
                                $(this).val('');
                            });
                            //  $('.insertcomment' + clicked_id).html(data);
                            $('#' + 'insertcount' + clicked_id).html(data.count);
                            $('.insertcomment' + clicked_id).html(data.comment);
                            $('.comment_count' + clicked_id).html(data.comment_count);
                        }
                    });
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "business_profile/insert_comment" ?>',
                        data: 'post_id=' + clicked_id + '&comment=' + txt,
                        // dataType: "json",
                        success: function (data) {
                            $('input').each(function () {
                                $(this).val('');
                            }
                            );
                            $('#' + 'fourcomment' + clicked_id).html(data);
                            $('.comment_count' + clicked_id).html(data.comment_count);
                            // $('#' + 'commnetpost' + clicked_id).html(data.count);
                            //  $('#' + 'fourcomment' + clicked_id).html(data.comment);
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
</script>
<script type="text/javascript">
    function remove_post(abc)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/business_profile_deleteforpost" ?>',
            dataType: 'json',
            data: 'business_profile_post_id=' + abc,
            //alert(data);
            success: function (data) {
                $('#' + 'removepost' + abc).remove();
                if (data.notcount == 'count') {
                    $('.' + 'nofoundpost').html(data.notfound);
                }

            }
        });
    }
</script>


<!-- remove particular user post start -->
<script type="text/javascript">
    function del_particular_userpost(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/del_particular_userpost" ?>',
            dataType: 'json',
            data: 'business_profile_post_id=' + abc,
            //alert(data);
            success: function (data) {
                // $('#' + 'removepost' + abc).html(data);
                $('#' + 'removepost' + abc).remove();
                if (data.notcount == 'count') {
                    $('.' + 'nofoundpost').html(data.notfound);
                }


            }
        });
    }
</script>
<!-- remove particular user post end -->



<!-- post delete login user script start -->
<script type="text/javascript">
    function user_postdelete(clicked_id)
    {
        // alert(clicked_id);

        $('.biderror .mes').html("<div class='pop_content'> Do you want to delete this post?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='remove_post(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
</script>
<!-- post delete login user end -->

<!-- post delete particular login user script start -->
<script type="text/javascript">
    function user_postdeleteparticular(clicked_id)
    {

        $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this post from your profile?.<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='del_particular_userpost(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
</script>
<!-- post delete particular login user end -->


<!-- This  script use for close dropdown in every post -->
<script type="text/javascript">
    $('body').on("click", "*", function (e) {
        var classNames = $(e.target).attr("class").toString().split(' ').pop();
        if (classNames != 'fa-ellipsis-v') {
            $('div[id^=myDropdown]').hide().removeClass('show');
        }

    });

</script>
<!-- This  script use for close dropdown in every post -->
<script type="text/javascript">
    $(".like_ripple").click(function (e) {

        // Remove any old one
        $(".ripple").remove();

        // Setup
        var posX = $(this).offset().left,
                posY = $(this).offset().top,
                buttonWidth = $(this).width(),
                buttonHeight = $(this).height();

        // Add the element
        $(this).prepend("<span class='ripple'></span>");


        // Make it round!
        if (buttonWidth >= buttonHeight) {
            buttonHeight = buttonWidth;
        } else {
            buttonWidth = buttonHeight;
        }

        // Get the center of the element
        var x = e.pageX - posX - buttonWidth / 2;
        var y = e.pageY - posY - buttonHeight / 2;


        // Add the ripples CSS and start the animation
        $(".ripple").css({
            width: buttonWidth,
            height: buttonHeight,
            top: y + 'px',
            left: x + 'px'
        }).addClass("rippleEffect");
    });
</script>
<!--
<script language="javascript" type="text/javascript">
    $(document).ready(function () {
        $('.alert-danger1').delay(3000).hide('700');
    });
</script>-->

<script>
    $(document).ready(function () {
        $('video').mediaelementplayer({
            alwaysShowControls: false,
            videoVolume: 'horizontal',
            features: ['playpause', 'progress', 'volume', 'fullscreen']
        });
    });
</script>
<script type="text/javascript">
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            if ($('.modal-post').show()) {

                $(document).on('keydown', function (e) {
                    if (e.keyCode === 27) {
                        //$( "#bidmodal" ).hide();
                        $('.modal-post').hide();
                    }
                });


            }
            document.getElementById('myModal').style.display = "none";
        }
    });
</script>
<script>
// Get the modal
    var modal = document.getElementById('myModal');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<!--<script>
    jQuery(document).mouseup(function (e) {
        var container1 = $("#myModal");
        container1.show();
        if (container1.show())
        {
            jQuery(document).mouseup(function (e) {
                var container = $("#postpopup_close");
                if (!container.is(e.target) 
                        && container.has(e.target).length === 0)
                {
                    container1.hide();
                }
            });
        }
    });
</script>-->
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
    // pop up open & close aarati code start 
    jQuery(document).mouseup(function (e) {

        var container1 = $("#myModal");

        jQuery(document).mouseup(function (e)
        {
            var container = $("#close");


            if (!container.is(e.target) // if the target of the click isn't the container...
                    && container.has(e.target).length === 0) // ... nor a descendant of the container
            {

                container1.hide();
            }
        });

    });

// pop up open & close aarati code end


</script>


<!-- all popup close close using esc start -->
<script type="text/javascript">

    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            //$( "#bidmodal" ).hide();
            $('#likeusermodal').modal('hide');
        }
    });

    $('.modal-close').on('click', function () {
        $('#myModal').modal('show');
    });

</script>


<!-- all popup close close using esc end-->

<!--<khyati chnages 24-4 start-->
<script type="text/javascript">

    function khdiv(abc) {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/edit_more_insert" ?>',
            data: 'business_profile_post_id=' + abc,
            dataType: "json",
            success: function (data) {

                document.getElementById('editpostdata' + abc).style.display = 'block';
                document.getElementById('editpostbox' + abc).style.display = 'none';
                //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                document.getElementById('editpostsubmit' + abc).style.display = 'none';
                document.getElementById('khyati' + abc).style.display = 'none';
                document.getElementById('khyatii' + abc).style.display = 'block';
                //alert(data.description);
                $('#' + 'editpostdata' + abc).html(data.title);
                // $('#' + 'editpostdetails' + abc).html(data.description);
                $('#' + 'khyatii' + abc).html(data.description);

            }
        });

    }

</script>
<!-- edit post start -->
<script type="text/javascript">
    function editpost(abc)
    {
        $("#myDropdown" + abc).removeClass('show');
        document.getElementById('editpostdata' + abc).style.display = 'none';
        document.getElementById('editpostbox' + abc).style.display = 'block';
        //    document.getElementById('editpostdetails' + abc).style.display = 'none';
        document.getElementById('editpostdetailbox' + abc).style.display = 'block';
        document.getElementById('editpostsubmit' + abc).style.display = 'block';
        document.getElementById('khyatii' + abc).style.display = 'none';
        document.getElementById('khyati' + abc).style.display = 'none';
    }
</script>
<script type="text/javascript">
    function edit_postinsert(abc)
    {
        var editpostname = document.getElementById("editpostname" + abc);
        //var editpostdetails = document.getElementById("editpostdesc" + abc);
// start khyati code
        var $field = $('#editpostdesc' + abc);
        //var data = $field.val();
        var editpostdetails = $('#editpostdesc' + abc).html();
//        editpostdetails = editpostdetails.replaceAll('&', '%26');
        editpostdetails = editpostdetails.replace(/&/g, "%26");

// end khyati code


        // $('#editpostdesc' + abc).html("");
        if (editpostname.value == '' && editpostdetails == '') {
            $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
            $('#bidmodal').modal('show');

            document.getElementById('editpostdata' + abc).style.display = 'block';
            document.getElementById('editpostbox' + abc).style.display = 'none';
            //   document.getElementById('editpostdetails' + abc).style.display = 'block';
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
                    // document.getElementById('editpostdetails' + abc).style.display = 'block';
                    document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                    document.getElementById('editpostsubmit' + abc).style.display = 'none';
                    document.getElementById('khyati' + abc).style.display = 'block';
                    $('#' + 'editpostdata' + abc).html(data.title);
                    //$('#' + 'editpostdetails' + abc).html(data.description);
                    $('#' + 'khyati' + abc).html(data.description);
                }
            });
        }
    }
</script>
<!-- edit post end -->
<!--<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>-->
<script type = "text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<!--<script type = "text/javascript" src = "<?php echo base_url() ?>js/jquery.form.min.js"></script>-->

<script>
    jQuery(document).ready(function ($) {

        var options = {
            beforeSend: function () {
                // Replace this with your loading gif image
                //$('.business-all-post').prepend("<progress id='bar' value='0' max='100'></progress>").show();
//                document.getElementById("progress-div").style.display = "block";
//                $("#progress-bar").width('0%');
                document.getElementById("myModal").style.display = "none";
                $(".business-all-post").prepend('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
            },
//            uploadProgress: function (event, position, total, percentComplete) {
//                $("#progress-bar").width(percentComplete + '%');
//                $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
//            },
            complete: function (response) {

                // Output AJAX response to the div container
                // console.log(response.responseText);
//                    $(".upload-image-messages").html(response.responseText);
                //    document.getElementById("myModal").style.display="none";
//                $(".business-all-post").prepend(response.responseText);
//                $('#progress-bar').hide();
                $('.loader').remove();
                $('.business-all-post div:first').remove();
                $(".business-all-post").prepend(response.responseText);
                //$(".bor_none").hide();
                $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top - 100}, 150);
            }
        };
        // Submit the form
        $(".upload-image-form").ajaxForm(options);
        return false;
    });
</script>

<!--
<style>
#progress-bar {background-color: #12CC1A !important; height:20px !important; color: #ccc!important; width:0% !important; -webkit-transition: width .3s;-moz-transition: width .3s;transition: width .3s;}
#progress-div {display:none; float: left !important;  border:#0FA015 1px solid !important; padding: 5px 0px !important; margin:30px 0px !important; border-radius:4px !important; text-align:center !important;}
#targetLayer{width:100% !important; text-align:center !important;}

</style>-->
