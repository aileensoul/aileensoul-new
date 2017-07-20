<?php echo $head; ?>
<
<?php echo $header; ?>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<?php echo $business_header2_border ?>
<html>
    <head>
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
        <!-- further and less -->
        <script>
            $(function () {
                var showTotalChar = 200, showChar = "ReadMore", hideChar = "";
                $('.showmore').each(function () {
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
        </script>   <script>
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
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-4  profile-box profile-box-custom  animated fadeInLeftBig">
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
                                <!--        <div class="contact-frnd-post"> -->
                                <div class="job-contact-frnd ">
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
                                                            //                                                 echo "<pre>"; print_r($p);die();
                                                            ?>
                                                            <div class="profile-job-profile-button clearfix box_search_module" style="border: 1px solid #efefef;margin-bottom: 20px!important;">
                                                                <div class="profile-job-post-location-name-rec">
                                                                    <div class="module_Ssearch" style="display: inline-block; float: left;">
                                                                        <div class="search_img" style="height: 110px; width: 108px;" >
                                                                            <a style=" " href="<?php echo base_url('business_profile/business_profile_manage_post/' . $p['business_slug']); ?>" title="">
                                                                                <?php
                                                                                if($p['business_user_image'] != ''){
                                                                                ?>
                                                                                <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $p['business_user_image']); ?>" alt="" > </a>
                                                                            <?php
                                                                                }else{
                                                                                    ?>
                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="No Image" > </a>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="designation_rec" style="    float: left;
                                                                         width: 60%;
                                                                         padding-top: 10px; padding-bottom: 10px;">
                                                                        <ul>
                                                                            <li style="padding-top: 0px;">
                                                                                <a  style="font-weight: 600; font-size: 18px;" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $p['business_slug']); ?>" title="<?php echo ucwords($p['company_name']); ?>"><?php echo ucwords($p['company_name']); ?></a>
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
                                                                                <a title="" class="color-search" href="<?php echo $p['contact_website']; ?>" target="_blank"> <?php echo $p['contact_website']; ?></a>
                                                                            </li>
                                                                            <input type="hidden" name="search" id="search" value="<?php echo $keyword; ?>">
                                                                        </ul>
                                                                    </div>
                                                                    <div class="fl search_button">
                                                                        <div class="<?php echo "fruser" . $p['business_profile_id']; ?>">
            <?php $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $businessdata[0]['business_profile_id'], 'follow_to' => $p['business_profile_id']))->row()->follow_status;
            if ($status == 0 || $status == " ") {
                ?>
                                                                                <div id= "followdiv " class="user_btn">
                                                                                    <button id="<?php echo "follow" . $p['business_profile_id']; ?>" onClick="followuser(<?php echo $p['business_profile_id']; ?>)">
                                                                                        Follow 
                                                                                    </button>
                                                                                </div>
            <?php } elseif ($status == 1) { ?>
                                                                                <div id= "unfollowdiv"  class="user_btn" > 
                                                                                    <button class="bg_following" id="<?php echo "unfollow" . $p['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $p['business_profile_id']; ?>)">
                                                                                        Following 
                                                                                    </button>
                                                                                </div>
            <?php } ?>
                                                                        </div>

                                                                        <button onclick="window.location.href = '<?php echo base_url('chat/abc/' . $p['user_id']); ?>'"> Message</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            /*
                                                              ?>
                                                              <div class="view_more_details">
                                                              <a href="<?php echo base_url('business_profile/business_resume/' . $p['user_id']); ?>">View more in<?php echo ucwords($p['company_name']) . 'Profile'; ?></a>
                                                              </div>
                                                              <?php
                                                             */
                                                            ?>
            <?php
        }
    }
    ?>
                                                </div>
                                            </div>
                                                    <?php if ($description) { ?>
                                                <div class="col-md-12 profile_search " style="float: left; background-color: white; margin-top: 10px; margin-bottom: 10px; padding:0px!important;">
                                                    <h4 class="search_head">Posts</h4>
                                                    <div class="inner_search search" style="float: left;">
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
                                                                                ?>
                                                                                <?php
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
                                                                                            <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                    <?php } ?> </a>
                                                                                <?php } else { ?>
                                                                                    <?php if ($business_userimage) { ?>
                                                                                        <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="">
                                                                                            <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt=""> </a>
                                                                                    <?php } else { ?>
                                                                                        <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="">
                                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt=""> </a>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div class="post-design-name col-xs-8 fl col-md-10">
                                                                                <ul>
                                                                                    <li>
                                                                                    </li>
                                                                                    <!-- <?php
                                                                                $slugname = $this->db->get_where('business_profile', array('user_id' => $p['user_id'], 'status' => 1))->row()->business_slug;
                                                                                ?> -->
                                                                                    <li>
                                                                                        <div class="post-design-product">
                                                                                            <a class="post_dot" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title=""><?php echo ucwords($p['company_name']); ?>
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
                                                                            <?php /* ?>
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
                                                                              <?php */ ?>
                                                                            <div class="post-design-desc">
                                                                                <div>
                                                                                    <div id="editpostdata5" style="display:block;">
                                                                                        <a style="margin-bottom: 0px; font-size: 16px">
                <?php echo ucwords($p['product_name']); ?>
                                                                                        </a>
                                                                                    </div>
                                                                                    <div id="editpostbox5" style="display:none;">
                                                                                        <input type="text" id="editpostname5" name="editpostname" placeholder="Product Name" value="zalak">
                                                                                    </div>
                                                                                </div>
                                                                                <div id="editpostdetails5" style="display:block;">
                                                                                    <span class="showmore">  <?php echo ucwords($p['product_description']); ?>
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
                                                                                                <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                                            </a>
                                                                                        </div>
                    <?php } elseif (in_array($ext, $allowespdf)) { ?>
                                                                                        <div>
                                                                                            <a title="click to open" href="<?php echo base_url('business_profile/creat_pdf/' . $businessmultiimage[0]['image_id']) ?>">
                                                                                                <div class="pdf_img">
                                                                                                    <img src="<?php echo base_url('images/PDF.jpg') ?>" style="height: 100%; width: 100%;">
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
                                                                                                <img class="two-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                                            </a>
                                                                                        </div>
                    <?php } ?>
                <?php } elseif (count($businessmultiimage) == 3) { ?>
                                                                                    <div class="three-image-top" >
                                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="three-image" >
                                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="three-image" >
                                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_post_id']) ?>">
                                                                                            <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['image_name']) ?>" style="width: 100%; height:100%; "> 
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } elseif (count($businessmultiimage) == 4) { ?>
                    <?php
                    foreach ($businessmultiimage as $multiimage) {
                        ?>
                                                                                        <div class="four-image" >
                                                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $p['business_profile_post_id']) ?>">
                                                                                                <img class="breakpoint" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
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
                                                                                                    <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> 
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
                                                                                                <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['image_name']) ?>" style="width: 100%; height: 100%;"> 
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
                                                                                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
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
                                                                                ?>
                <?php if ($business_userimage) { ?>
                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                <?php } else { ?>
                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
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
                                                                <?php /* ?>               
                                                                  <div class="view_more_details">
                                                                  <a href="<?php echo base_url('business_profile/business_resume/' . $p['user_id']); ?>">View more in<?php echo ucwords($p['company_name']) . '  Profile'; ?></a>
                                                                  </div>
                                                                  <?php */ ?>
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
<!--                                                    <div class="view_more_details">
                                                        <a href="javascript:void(0);">Oops! Search data not found.</a>
                                                    </div>-->
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
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>-->
<script>
                                                                    $('#content').on('change keyup keydown paste cut', 'textarea', function () {
                                                                        $(this).height(0).height(this.scrollHeight);
                                                                    }).find('textarea').change();
</script>
<script>
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
</script>
<script>
    var data1 = <?php echo json_encode($de);
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
</script>
<script src="<?php echo base_url('js/jquery.highlite.js'); ?>"></script>
<script type="text/javascript">
    var text = document.getElementById("search").value;
    //alert(text);

    $(".search").highlite({

        text: text


    });
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
   </script> -->
<!-- like comment script start -->
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
        if (txt == '') {
            return false;
        }

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
                    $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('.insertcomment' + clicked_id).html(data.comment);

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
                    $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('#' + 'fourcomment' + clicked_id).html(data.comment);
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
//                               $('#' + 'insertcount' + clicked_id).html(data.count);
//                               $('.insertcomment' + clicked_id).html(data.comment);
                            $('.insertcomment' + clicked_id).html(data.comment);
                            //$('.comment_count' + clicked_id).html(data.comment_count);
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
                            $('#' + 'insertcount' + clicked_id).html(data.count);
                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
                            $('.' + 'comment_count' + clicked_id).html(data.comment_count);

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
        //          url:'<?php //echo base_url() . "business_profile/fourcomment"                                                    ?>',
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
        $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }

    function comment_deleted(clicked_id)
    {
//        var post_delete = document.getElementById("post_delete");
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
//                alert('.' + 'comment_count' + clicked_id);
//                alert(data.comment_count);
//                
                $('.' + 'comment_count' + post_delete.value).html(data.comment_count);
                $('.post-design-commnet-box').show();
            }
        });
    }

    function comment_deletetwo(clicked_id)
    {

        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }

    function comment_deletedtwo(clicked_id)
    {
        var post_delete1 = document.getElementById("post_deletetwo" + clicked_id);
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
                $('.comment_count' + post_delete1.value).html(data.total_comment_count + ' <span> Comment</span>');
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
        if (txt == '' || txt == '<br>') {
            return false;
        }
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
                if (txt == '' || txt == '<br>') {
                    return false;
                }
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
        if (txt == '' || txt == '<br>') {
            return false;
        }
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

                if (txt == '' || txt == '<br>') {
                    return false;
                }

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
        document.getElementById('myDropdown' + clicked_id).classList.toggle("show");


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
        if (my_form.my_text.value.length >= maxLen) {
            // Alert message if maximum limit is reached. 
            // If required Alert can be removed. 
            var msg = "You have reached your maximum limit of characters allowed";
            alert(msg);
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
<!-- edit post start -->
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
        //var editpostdetails = document.getElementById("editpostdesc" + abc);
        // start khyati code
        var $field = $('#editpostdesc' + abc);
        //var data = $field.val();
        var editpostdetails = $('#editpostdesc' + abc).html();
        // end khyati code


        // $('#editpostdesc' + abc).html("");
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
<!-- edit post end -->
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
<script type="text/javascript">
    function remove_post(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/business_profile_deletepost" ?>',
            data: 'business_profile_post_id=' + abc,
            //alert(data);
            success: function (data) {
                $('#' + 'removepost' + abc).html(data);
            }
        });
    }
</script>
<!-- remove save post end -->
<!-- remove particular user post start -->
<script type="text/javascript">
    function del_particular_userpost(abc)
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/del_particular_userpost" ?>',
            data: 'business_profile_post_id=' + abc,
            //alert(data);
            success: function (data) {
                $('#' + 'removepost' + abc).html(data);
                $('#' + 'removepost' + abc).remove;

            }
        });
    }
</script>
<!-- remove particular user post end -->
<!-- follow user script start -->
<script type="text/javascript">
    function followuser(clicked_id)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/follow" ?>',
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
            url: '<?php echo base_url() . "business_profile/unfollow" ?>',
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
        $("#fad" + clicked_id).fadeOut(4000);
    }
</script>
<!--follow like script end -->
<!-- insert post script zalak start -->
<script>
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
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
    function imgval(event) {

        var fileInput = document.getElementById("test-upload").files;
        var product_name = document.getElementById("test-upload-product").value;
        var product_description = document.getElementById("test-upload-des").value;
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
<!-- post delete login user script start -->
<script type="text/javascript">
    function user_postdelete(clicked_id)
    {

        $('.biderror .mes').html("<div class='pop_content'> Are You Sure want to delete this post?.<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='remove_post(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
</script>
<!-- post delete login user end -->
<!-- post delete particular login user script start -->
<script type="text/javascript">
    function user_postdeleteparticular(clicked_id)
    {

        $('.biderror .mes').html("<div class='pop_content'> Are You Sure want to delete this post from your profile?.<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='del_particular_userpost(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
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
<!-- This  script use for close dropdown in every post -->
<!-- all popup close close using esc start -->
<script type="text/javascript">
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            //$( "#bidmodal" ).hide();
            $('#bidmodal').modal('hide');
        }
    });

</script>
<!-- all popup close close using esc end-->