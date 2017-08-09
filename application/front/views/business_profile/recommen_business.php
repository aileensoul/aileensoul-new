<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
        <link href="<?php echo base_url() ?>css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>js/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css"/>
        <script src="<?php echo base_url() ?>js/jquery-2.0.3.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/plugins/sortable.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>js/themes/explorer/theme.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <script>
            $(function () {
                var showTotalChar = 200, showChar = "ReadMore", hideChar = "";
                $('.showmore').each(function () {
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
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <!-- START HEADER -->
        <?php echo $header; ?>
        <!-- END HEADER -->
        <?php echo $business_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4  profile-box profile-box-custom  animated fadeInLeftBig">
                            <div class="">
                                <?php echo $business_left; ?>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-md-push-4 custom-right-business animated fadeInUp" style="height: 150%;">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3 style="background-color: #fff; text-align: center; color: #003;">
                                        Search result of 
                                        <?php
                                        if ($keyword != "" && $keyword1 == "") {
                                            echo '"' . $keyword . '"';
                                        } elseif ($keyword == "" && $keyword1 != "") {
                                            echo '"' . $keyword1 . '"';
                                        } else {
                                            echo '"' . $keyword . '"';
                                            echo " and ";
                                            echo '"' . $keyword1 . '"';
                                        }
                                        ?>
                                    </h3>
                                    <div class="job-contact-frnd">
                                        <?php
                                        if (count($profile) > 0 || count($description) > 0) {
                                            if ($profile) {
                                                ?>
                                                <div class="profile-job-post-title-inside clearfix" style="">
                                                    <div class="profile_search" style="background-color: white; margin-bottom: 10px; margin-top: 10px;">
                                                        <h4 class="search_head">Profiles</h4>
                                                        <div class="inner_search">
                                                            <?php
                                                            foreach ($profile as $p) {
                                                                ?>
                                                                <div class="profile-job-profile-button clearfix box_search_module" style="margin-bottom: 20px!important;">
                                                                    <div class="profile-job-post-location-name-rec">
                                                                        <div class="module_Ssearch" style="display: inline-block; float: left;">
                                                                            <div class="search_img" style="height: 110px; width: 108px;" >
                                                                                <a style=" " href="<?php echo base_url('business_profile/business_profile_manage_post/' . $p['business_slug']); ?>" title="">
                                                                                    <?php
                                                                                    if ($p['business_user_image'] != '') {
                                                                                        ?>
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $p['business_user_image']); ?>" alt="" > </a>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                     <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                                                    </a>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="designation_rec" style="float: left;
                                                                             width: 60%;
                                                                             padding-top: 10px; padding-bottom: 10px;">
                                                                            <ul>
                                                                                <li style="padding-top: 0px;">
                                                                                    <a  class="main_search_head" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $p['business_slug']); ?>" title="<?php echo ucfirst(strtolower($p['company_name'])); ?>"><?php echo ucfirst(strtolower($p['company_name'])); ?></a>
                                                                                </li>
                                                                                <li style="display: block;">
                                                                                    <a  class="color-search" s title="">
                                                                                        <?php
                                                                                        $cache_time = $this->db->get_where('industry_type', array('industry_id' => $p['industriyal']))->row()->industry_name;
                                                                                        echo $cache_time;
                                                                                        ?>            
                                                                                    </a>
                                                                                </li>
                                                                                <li style="display: block;">
                                                                                    <a title="" class="color-search">
                                                                                        <?php
                                                                                        $cache_time = $this->db->get_where('business_type', array('type_id' => $p['business_type']))->row()->business_name;
                                                                                        echo $cache_time;
                                                                                        ?> 
                                                                                    </a>
                                                                                </li>
                                                                                <li style="display: block;">
                                                                                    <a title="" class="color-search">
                                                                                        <?php
                                                                                        $cityname = $this->db->get_where('cities', array('city_id' => $p['city']))->row()->city_name;
                                                                                        $countryname = $this->db->get_where('countries', array('country_id' => $p['country']))->row()->country_name;
                                                                                        ?>
                                                                                        <?php
                                                                                        if ($cityname || $countryname) {
                                                                                            ?>
                                                                                            <?php
                                                                                            if ($cityname) {
                                                                                                echo $cityname;
                                                                                                echo ', ';
                                                                                            }
                                                                                            echo $countryname;
                                                                                            ?>
                                                                                            <?php
                                                                                        }
                                                                                        ?>   
                                                                                    </a>
                                                                                </li>
                                                                                <li style="display: block;">
                                                                                    <a title="" class="color-search websir-se" href="<?php echo $p['contact_website']; ?>" target="_blank"> <?php echo $p['contact_website']; ?></a>
                                                                                </li>
                                                                                <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
                                                                            </ul>
                                                                        </div>
                                                                        <?php
                                                                        $userid = $this->session->userdata('aileenuser');
                                                                        if ($p['user_id'] != $userid) {
                                                                            ?>
                                                                            <div class="fl search_button">
                                                                                <div class="<?php echo "fruser" . $p['business_profile_id']; ?>">
                                                                                    <?php
                                                                                    $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $businessdata[0]['business_profile_id'], 'follow_to' => $p['business_profile_id']))->row()->follow_status;
                                                                                    if ($status == 0 || $status == " ") {
                                                                                        ?>
                                                                                        <div id= "followdiv " class="user_btn">
                                                                                            <button id="<?php echo "follow" . $p['business_profile_id']; ?>" onClick="followuser_two(<?php echo $p['business_profile_id']; ?>)">
                                                                                                Follow 
                                                                                            </button>
                                                                                        </div>
                                                                                    <?php } elseif ($status == 1) { ?>
                                                                                        <div id= "unfollowdiv"  class="user_btn" > 
                                                                                            <button class="bg_following" id="<?php echo "unfollow" . $p['business_profile_id']; ?>" onClick="unfollowuser_two(<?php echo $p['business_profile_id']; ?>)">
                                                                                                Following 
                                                                                            </button>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <button onclick="window.location.href = '<?php echo base_url('chat/abc/5/5/' . $p['user_id']); ?>'"> Message</button>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php if ($description) { ?>
                                                    <div class="col-md-12 profile_search " style="float: left; background-color: white; margin-top: 10px; margin-bottom: 10px; padding:0px!important;">
                                                        <h4 class="search_head">Posts</h4>
                                                        <div class="inner_search search inner_search_2" style="float: left;">
                                                            <?php
                                                            foreach ($description as $p) {
                                                                if (($p['product_description']) || ($p['product_name'])) {
                                                                    ?>
                                                                    <div class="col-md-12 col-sm-12 post-design-box" id="removepost5" style="box-shadow: none; ">
                                                                        <div class="post_radius_box">
                                                                            <div class="post-design-search-top col-md-12" style="background-color: none!important;">
                                                                                <div class="post-design-pro-img ">
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
                                                                                    <?php
                                                                                    $business_userimage = $this->db->get_where('business_profile', array('user_id' => $p['user_id'], 'status' => 1))->row()->business_user_image;
                                                                                    $userimageposted = $this->db->get_where('business_profile', array('user_id' => $p['posted_user_id']))->row()->business_user_image;
                                                                                    $slugname = $this->db->get_where('business_profile', array('user_id' => $p['user_id'], 'status' => 1))->row()->business_slug;
                                                                                    $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $p['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                                                    ?>
                                                                                    <?php if ($p['posted_user_id']) {
                                                                                        ?>
                                                                                        <?php if ($userimageposted) { ?>
                                                                                            <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>" title="">
                                                                                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />
                                                                                            </a>
                                                                                        <?php } else { ?>
                                                                                            <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>" title="">
                                                                                                 <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                                                            <?php } ?> </a>
                                                                                    <?php } else { ?>
                                                                                        <?php if ($business_userimage) { ?>
                                                                                            <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="">
                                                                                                <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt=""> </a>
                                                                                        <?php } else { ?>
                                                                                            <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="">
                                                                                                 <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                                                            </a>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                                <div class="post-design-name col-xs-8 fl col-md-10">
                                                                                    <ul>
                                                                                        <li>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="post-design-product">
                                                                                                <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title=""><?php echo ucfirst(strtolower($p['company_name'])); ?>
                                                                                                </a>
                                                                                                <span role="presentation" aria-hidden="true"> · </span>
                                                                                                <div class="datespan"> 
                                                                                                    <span style="font-weight: 400; font-size: 14px; color: #91949d; cursor: default;"> 
                                                                                                        <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($p['created_date']))); ?>      
                                                                                                    </span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li>
                                                                                            <div class="post-design-product">
                                                                                                <a href="javascript:void(0);" style=" color: #000033; font-weight: 400; cursor: default;" title="">
                                                                                                    <?php
                                                                                                    $cache_time = $this->db->get_where('industry_type', array('industry_id' => $p['industriyal']))->row()->industry_name;
                                                                                                    echo $cache_time;
                                                                                                    ?>  </a>
                                                                                            </div>
                                                                                        </li>
                                                                                        <li>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="post-design-desc">
                                                                                    <div>
                                                                                        <div id="editpostdata5" style="display:block;">
                                                                                            <a style="margin-bottom: 0px; font-size: 16px">
                                                                                                <?php echo ucfirst(strtolower($p['product_name'])); ?>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div id="editpostbox5" style="display:none;">
                                                                                            <input type="text" id="editpostname5" name="editpostname" placeholder="Product Name" value="zalak">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="editpostdetails5" style="display:block;">
                                                                                        <span class="showmore">  <?php echo ucfirst(strtolower($p['product_description'])); ?>
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
                                                                                    <?php
                                                                                    $contition_array = array('post_id' => $p['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
                                                                                    $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                    ?>
                                                                                    <?php if (count($businessmultiimage) == 1) { ?>
                                                                                        <?php
                                                                                        $allowed = array('gif', 'png', 'jpg');
                                                                                        $allowespdf = array('pdf');
                                                                                        $allowesvideo = array('mp4', 'webm');
                                                                                        $allowesaudio = array('mp3');
                                                                                        $filename = $businessmultiimage[0]['image_name'];
                                                                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                                                        if (in_array($ext, $allowed)) {
                                                                                            ?>
                                                                                            <div class="one-image" >
                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                    <img src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) ?>" > 
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } elseif (in_array($ext, $allowespdf)) { ?>
                                                                                            <div>
                                                                                                <a title="click to open" href="<?php echo base_url('business_profile/creat_pdf/' . $businessmultiimage[0]['image_id']) ?>">
                                                                                                    <div class="pdf_img">
                                                                                                        <img src="<?php echo base_url('images/PDF.jpg') ?>"">
                                                                                                    </div>
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                                                                                            <div>
                                                                                                <video width="320" height="240" controls>
                                                                                                    <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                                                                                                    <source src="movie.ogg" type="video/ogg">
                                                                                                    Your browser does not support the video tag.
                                                                                                </video>
                                                                                            </div>
                                                                                        <?php } elseif (in_array($ext, $allowesaudio)) { ?>
                                                                                            <div>
                                                                                                <audio width="120" height="100" controls>
                                                                                                    <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="audio/mp3">
                                                                                                    <source src="movie.ogg" type="audio/ogg">
                                                                                                    Your browser does not support the audio tag.
                                                                                                </audio>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } elseif (count($businessmultiimage) == 2) { ?>
                                                                                        <?php
                                                                                        foreach ($businessmultiimage as $multiimage) {
                                                                                            ?>
                                                                                            <div class="two-images" >
                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                    <img class="two-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" > 
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } elseif (count($businessmultiimage) == 3) { ?>
                                                                                        <div class="three-image-top" >
                                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>" > 
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="three-image" >
                                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['image_name']) ?>" > 
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="three-image" >
                                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_post_id']) ?>">
                                                                                                <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['image_name']) ?>" > 
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php } elseif (count($businessmultiimage) == 4) { ?>
                                                                                        <?php
                                                                                        foreach ($businessmultiimage as $multiimage) {
                                                                                            ?>
                                                                                            <div class="four-image" >
                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                    <img class="breakpoint" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" > 
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                    <?php } elseif (count($businessmultiimage) > 4) { ?>
                                                                                        <?php
                                                                                        $i = 0;
                                                                                        foreach ($businessmultiimage as $multiimage) {
                                                                                            ?>
                                                                                            <div>
                                                                                                <div class="four-image" >
                                                                                                    <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                        <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" > 
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                            $i++;
                                                                                            if ($i == 3)
                                                                                                break;
                                                                                        }
                                                                                        ?>
                                                                                        <div>
                                                                                            <div class="four-image" >
                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                    <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['image_name']) ?>"> 
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="four-image" >
                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>" ></a>


                                                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>" >
                                                                                                    <span class="more-image"> View All  (+
                                                                                                        <?php echo (count($businessmultiimage) - 4); ?>)
                                                                                                    </span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="post-design-like-box col-md-12">
                                                                                <div class="post-design-menu">
                                                                                    <ul class="col-md-6">
                                                                                        <li class="<?php echo 'likepost' . $p['business_profile_post_id']; ?>">
                                                                                            <a class="ripple like_h_w" id="<?php echo $p['business_profile_post_id']; ?>"   onClick="post_like(this.id)">
                                                                                                <?php
                                                                                                $userid = $this->session->userdata('aileenuser');
                                                                                                $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1');
                                                                                                $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                                $likeuser = $this->data['active'][0]['business_like_user'];
                                                                                                $likeuserarray = explode(',', $active[0]['business_like_user']);
                                                                                                if (!in_array($userid, $likeuserarray)) {
                                                                                                    ?>               
                                                                                                    <i class="fa fa-thumbs-up fa-1x" aria-hidden="true">
                                                                                                    </i>
                                                                                                <?php } else { ?> 
                                                                                                    <i class="fa fa-thumbs-up main_color" aria-hidden="true">
                                                                                                    </i>
                                                                                                <?php } ?>
                                                                                                <span style="display: none;">
                                                                                                    <?php
                                                                                                    if ($p['business_likes_count'] > 0) {
                                                                                                        echo $p['business_likes_count'];
                                                                                                    }
                                                                                                    ?>
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li id="<?php echo "insertcount" . $p['business_profile_post_id']; ?>" style="visibility:show">
                                                                                            <?php
                                                                                            $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                                            $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                            ?>
                                                                                            <a class="ripple like_h_w" onClick="commentall(this.id)" id="<?php echo $p['business_profile_post_id']; ?>">
                                                                                                <i class="fa fa-comment-o" aria-hidden="true"> 
                                                                                                    <span style="display: none;"><?php
                                                                                                        if (count($commnetcount) > 0) {
                                                                                                            echo count($commnetcount);
                                                                                                        }
                                                                                                        ?></span>
                                                                                                </i> 
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                    <ul class="col-md-6 like_cmnt_count">
                                                                                        <li>
                                                                                            <div class="like_count_ext">
                                                                                                <span class="comment_count<?php echo $p['business_profile_post_id']; ?>" > 
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
                                                                                                <span class="comment_like_count<?php echo $p['business_profile_post_id']; ?>"> 
                                                                                                    <?php
                                                                                                    if ($p['business_likes_count'] > 0) {
                                                                                                        echo $p['business_likes_count'];
                                                                                                        ?>
                                                                                                        <span> Like</span>
                                                                                                    <?php }
                                                                                                    ?>
                                                                                                </span> 
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            if ($p['business_likes_count'] > 0) {
                                                                                ?>
                                                                                <div class="likeduserlist1 likeduserlist<?php echo $p['business_profile_post_id'] ?>">
                                                                                    <?php
                                                                                    $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                    $likeuser = $commnetcount[0]['business_like_user'];
                                                                                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                                    $likelistarray = explode(',', $likeuser);
                                                                                    foreach ($likelistarray as $key => $value) {
                                                                                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                                    }
                                                                                    ?>
                                                                                    <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $p['business_profile_post_id']; ?>);">
                                                                                        <?php
                                                                                        $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                                        $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                                        $likeuser = $commnetcount[0]['business_like_user'];
                                                                                        $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                                        $likelistarray = explode(',', $likeuser);

                                                                                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                                        ?>
                                                                                        <div class="like_one_other">
                                                                                            <?php
                                                                                            echo ucfirst(strtolower($business_fname1));
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
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <div class="<?php echo "likeusername" . $p['business_profile_post_id']; ?>" id="<?php echo "likeusername" . $p['business_profile_post_id']; ?>" style="display:none">
                                                                                <?php
                                                                                $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                $likeuser = $commnetcount[0]['business_like_user'];
                                                                                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                                $likelistarray = explode(',', $likeuser);
                                                                                foreach ($likelistarray as $key => $value) {
                                                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                                }
                                                                                ?>
                                                                                <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $p['business_profile_post_id']; ?>);">
                                                                                    <?php
                                                                                    $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                                    $likeuser = $commnetcount[0]['business_like_user'];
                                                                                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                                    $likelistarray = explode(',', $likeuser);

                                                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                                    ?>
                                                                                    <div class="like_one_other">
                                                                                        <?php
                                                                                        echo ucfirst(strtolower($business_fname1));
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
                                                                            <div class="art-all-comment col-md-12">
                                                                                <div  id="<?php echo "fourcomment" . $p['business_profile_post_id']; ?>" style="display:none;">
                                                                                </div>
                                                                                <div  id="<?php echo "threecomment" . $p['business_profile_post_id']; ?>" style="display:block">
                                                                                    <div class="<?php echo 'insertcomment' . $p['business_profile_post_id']; ?>">
                                                                                        <?php
                                                                                        $contition_array = array('business_profile_post_id' => $p['business_profile_post_id'], 'status' => '1');
                                                                                        $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                                                        if ($businessprofiledata) {
                                                                                            foreach ($businessprofiledata as $pdata) {
                                                                                                $companyname = $this->db->get_where('business_profile', array('user_id' => $pdata['user_id']))->row()->company_name;
                                                                                                ?>
                                                                                                <div class="all-comment-comment-box">
                                                                                                    <div class="post-design-pro-comment-img"> 
                                                                                                        <?php
                                                                                                        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $pdata['user_id'], 'status' => 1))->row()->business_user_image;
                                                                                                        ?>
                                                                                                        <?php if ($business_userimage) { ?>
                                                                                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                 <?php } else { ?>
                                                                      <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
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
                                                                                                    <div class="comment-details" id= "<?php echo "showcomment" . $pdata['business_profile_post_comment_id']; ?>">
                                                                                                        <?php
                                                                                                        echo $this->common->make_links($pdata['comments']);
                                                                                                        ?>
                                                                                                    </div>
                                                                                                    <div class="edit-comment-box">
                                                                                                        <div class="inputtype-edit-comment">
                                                                                                            <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 81%;" class="editable_text" name="<?php echo $pdata['business_profile_post_comment_id']; ?>"  id="<?php echo "editcomment" . $pdata['business_profile_post_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commentedit(<?php echo $pdata['business_profile_post_comment_id']; ?>)"><?php echo $pdata['comments']; ?></div>
                                                                                                            <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $pdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $pdata['business_profile_post_comment_id']; ?>)">Save</button></span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="art-comment-menu-design">
                                                                                                        <div class="comment-details-menu" id="<?php echo 'likecomment1' . $pdata['business_profile_post_comment_id']; ?>">
                                                                                                            <a id="<?php echo $pdata['business_profile_post_comment_id']; ?>" onClick="comment_like1(this.id)">
                                                                                                                <?php
                                                                                                                $userid = $this->session->userdata('aileenuser');
                                                                                                                $contition_array = array('business_profile_post_comment_id' => $pdata['business_profile_post_comment_id'], 'status' => '1');
                                                                                                                $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                                                $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);
                                                                                                                if (!in_array($userid, $likeuserarray)) {
                                                                                                                    ?>
                                                                                                                    <i class="fa fa-thumbs-up fa-1x" aria-hidden="true">
                                                                                                                    </i> 
                                                                                                                <?php } else { ?>
                                                                                                                    <i class="fa fa-thumbs-up" aria-hidden="true">
                                                                                                                    </i>
                                                                                                                <?php } ?>
                                                                                                                <span>
                                                                                                                    <?php
                                                                                                                    if ($pdata['business_comment_likes_count']) {
                                                                                                                        echo $pdata['business_comment_likes_count'];
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                </span>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                        $userid = $this->session->userdata('aileenuser');
                                                                                                        if ($pdata['user_id'] == $userid) {
                                                                                                            ?>
                                                                                                            <span role="presentation" aria-hidden="true"> · 
                                                                                                            </span>
                                                                                                            <div class="comment-details-menu">
                                                                                                                <div id="<?php echo 'editcommentbox' . $pdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                                                                                                    <a id="<?php echo $pdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                                <div id="<?php echo 'editcancle' . $pdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                                                                                                    <a id="<?php echo $pdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        <?php } ?>
                                                                                                        <?php
                                                                                                        $userid = $this->session->userdata('aileenuser');
                                                                                                        $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $pdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                                                                                                        if ($pdata['user_id'] == $userid || $business_userid == $userid) {
                                                                                                            ?>                                     
                                                                                                            <span role="presentation" aria-hidden="true"> · 
                                                                                                            </span>
                                                                                                            <div class="comment-details-menu">
                                                                                                                <input type="hidden" name="post_delete"  id="post_delete<?php echo $pdata['business_profile_post_comment_id']; ?>" value= "<?php echo $pdata['business_profile_post_id']; ?>">
                                                                                                                <a id="<?php echo $pdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete
                                                                                                                    <span class="<?php echo 'insertcomment' . $pdata['business_profile_post_comment_id']; ?>">
                                                                                                                    </span>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        <?php } ?>                                   
                                                                                                        <span role="presentation" aria-hidden="true"> · 
                                                                                                        </span>
                                                                                                        <div class="comment-details-menu">
                                                                                                            <p>
                                                                                                                <?php
                                                                                                                echo date('d-M-Y', strtotime($pdata['created_date']));
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
                                                                            </div>
                                                                            <div class="post-design-commnet-box col-md-12">
                                                                                <div class="post-design-proo-img"> 
                                                                                    <?php
                                                                                    $userid = $this->session->userdata('aileenuser');
                                                                                    $business_userimage = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_user_image;

                                                                                    $business_user = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->company_name;
                                                                                    ?>
                                                                                    <?php if ($business_userimage) { ?>
                                                                                        <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                                    <?php } else { ?>
                                                                                         <img  src="<?php echo base_url(NOBUSIMAGE); ?>"  alt="">
                                                                                    <?php } ?>
                                                                                </div>

                                                                                <div id="content" class="col-md-12 inputtype-comment cmy_2">
                                                                                    <div contenteditable="true" class="editable_text" name="<?php echo $p['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $p['business_profile_post_id']; ?>" placeholder="Add a comment ..." onClick="entercomment(<?php echo $p['business_profile_post_id']; ?>)"></div>
                                                                                </div>
                                                                                <?php echo form_error('post_comment'); ?> 
                                                                                <div class="comment-edit-butn">       
                                                                                    <button id="<?php echo $p['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment
                                                                                    </button>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="text-center rio">
                                                            <h1 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">Oops No Data Found.</h1>
                                                            <p style="text-transform:none !important;border:0px;">We couldn't find what you were looking for.</p>
                                                            <ul class="padding_less_left">
                                                                <li style="text-transform:none !important; list-style: none;">Make sure you used the right keywords.</li>
                                                            </ul>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;
                    </button>       
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
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <footer>
            <?php echo $footer ?>
        </footer>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.highlite.js'); ?>">
        </script>
        <script>
            $('#content').on('change keyup keydown paste cut', 'textarea', function () {
                $(this).height(0).height(this.scrollHeight);
            }).find('textarea').change();
        </script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/search.js'); ?>"></script>
    </body>
</html>
