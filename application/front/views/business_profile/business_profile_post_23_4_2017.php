<!-- start head -->
<?php echo $head; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<!--post save success pop up style strat -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-size: cover;
        height: 100vh;
    }

    .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255,255,255,0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
    }



    .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.3);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 10;
    }
    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        height: 200px;
        position: relative;
        transition: all 5s ease-in-out;
    }

    .okk{
        text-align: center;
    }

    .popup .okbtn {
        position: absolute;
        transition: all 200ms;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        padding: 8px 18px;
        background-color: darkcyan;
        left: 25px;
        margin-top: 15px;
        width: 100px; 
        border-radius: 8px;
    }

    .popup .cnclbtn {
        position: absolute;
        transition: all 200ms;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        padding: 8px 18px;
        background-color: darkcyan;
        right: 25px;
        margin-top: 15px;
        width: 100px;
        border-radius: 8px;
    }

    .popup .pop_content {
        text-align: center;
        margin-top: 40px;

    }

    @media screen and (max-width: 700px){
        .box{
            width: 70%;
        }
        .popup{
            width: 70%;
        }
    }
</style>

<!--post save success pop up style end -->



<style type="text/css">

    .thumb {
        width:99px;
        height: 99px;
        margin: 0.2em -0.7em 0 0;
    }
    .remove_thumb {
        position: relative;
        top: -38px;
        right: 5px;
        background: black;
        color: white;
        border-radius: 50px;
        font-size: 1.5em;
        padding: 0 0.3em 0;
        text-align: center;
        cursor: pointer;
    }
    .remove_thumb:before {
        content: "×";
    }/*
    .popup-textarea .description{
        width: 100%;
        height: 90px;
        color: #999999;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
      }
    */

</style>
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<!-- END HEADER -->

<?php echo $business_header2 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
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

<!-- <script src="<?php //echo base_url('js/jquery.min.js');  ?>"></script> -->

        <script>
            $(document).ready(function()
            {


            /* Uploading Profile BackGround Image */
            $('body').on('change', '#bgphotoimg', function()
            {

            $("#bgimageform").ajaxForm({target: '#timelineBackground',
                    beforeSubmit:function(){},
                    success:function(){

                    $("#timelineShade").hide();
                    $("#bgimageform").hide();
                    },
                    error:function(){

                    } }).submit();
            });
            /* Banner position drag */
            $("body").on('mouseover', '.headerimage', function ()
            {
            var y1 = $('#timelineBackground').height();
            var y2 = $('.headerimage').height();
            $(this).draggable({
            scroll: false,
                    axis: "y",
                    drag: function(event, ui) {
                    if (ui.position.top >= 0)
                    {
                    ui.position.top = 0;
                    }
                    else if (ui.position.top <= y1 - y2)
                    {
                    ui.position.top = y1 - y2;
                    }
                    },
                    stop: function(event, ui)
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
                    beforeSend: function(){ },
                    success: function(html)
                    {
                    if (html)
                    {
                    window.location.reload();
                    $(".bgImage").fadeOut('slow');
                    $(".bgSave").fadeOut('slow');
                    $("#timelineShade").fadeIn("slow");
                    $("#timelineBGload").removeClass("headerimage");
                    $("#timelineBGload").css({'margin-top':html});
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
        <div class="user-midd-section">
            <div class="container">
                <div class="row">


                    <div class="col-md-4"><div class="profile-box profile-box-left">

                            <div class="full-box-module">    


                                <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover">    <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                                                                     href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>"
                                                                                     tabindex="-1"
                                                                                     aria-hidden="true"
                                                                                     rel="noopener"
                                                                                     title="<?php echo $businessdata[0]['company_name']; ?>">
                                            <!-- box image start -->
<?php if ($businessdata[0]['profile_background'] != '') {
    ?>
                                                <img src="<?php echo base_url(BUSBGIMG . $businessdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>"  style="height: 95px;
                                                     width: 100%; " >

<?php
} else {
    ?>
                                                <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>"  style="height: 95px; width: 100%;">
                                            <?php } ?>

                                        </a>

                                    </div>



                                    <div class="profile-boxProfileCard-content clearfix">

                                        <div class="buisness-profile-txext col-md-4">
                                            <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>" title="<?php echo $businessdata[0]['company_name']; ?>" tabindex="-1" aria-hidden="true" rel="noopener" >
<?php
if ($businessdata[0]['business_user_image']) {
    ?>
                                                    <img  src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']); ?>"  alt="<?php echo $businessdata[0]['company_name']; ?>" style="    height: 77px;
                                                          width: 71px;
                                                          z-index: 3;
                                                          position: relative;
                                                          " >
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $businessdata[0]['company_name']; ?>">
                                                    <?php
                                                }
                                                ?>                           
                                                <!-- 
                                                  <img class="profile-boxProfileCard-avatarImage js-action-profile-avatar" src="images/imgpsh_fullsize (2).jpg" alt="" style="    height: 68px;
                                          width: 68px;">
                                                --></a>

                                        </div>
                                        <div class="profile-box-user  profile-text-bui-user  fr col-md-9">
                                            <span class="profile-company-name ">
                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>"> <?php echo ucwords($businessdata[0]['company_name']); ?></a> </span>

<?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>

                                            <div class="profile-boxProfile-name">
                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>"><?php echo $category; ?></a></div>



                                        </div>


                                        <div class="profile-box-bui-menu  col-md-12">

                                            <ul class="">

                                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post') { ?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>">Dashboard</a>
                                                </li>



                                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>>
                                                    <a href="<?php echo base_url('business_profile/followers'); ?>">Followers <br> (<?php echo (count($businessfollowerdata)); ?>)</a>
                                                </li>

                                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/following'); ?>">Following <br> (<?php echo (count($businessfollowingdata)); ?>) </a>
                                                </li>


                                            </ul>


                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div  class="add-post-button">


                                <a class="btn btn-3 btn-3b"href="<?php echo base_url('recruiter'); ?>"><i class="fa fa-plus" aria-hidden="true"></i> Recruiter</a>
                            </div>
                            <div class="full-box-module_follow">

                                <!-- follower list start  -->  
                                <div class="common-form">
                                    <h3 class="user_list_head">User List</h3>

                                    <div class="seeall">
                                        <a href="<?php echo base_url('business_profile/userlist'); ?>">All User</a>
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
        $businessfollow = $this->data['businessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $category = $this->db->get_where('industry_type', array('industry_id' => $userlist['industriyal'], 'status' => 1))->row()->industry_name;


        if (!$businessfollow) {
            ?>                             

                                                            <div class="profile-job-post-title-inside clearfix">

                                                                <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                    <div class="post-design-pro-img_follow">
                                                            <?php if ($userlist['business_user_image']) { ?>

                                                                            <img  src="<?php echo base_url(USERIMAGE . $userlist['business_user_image']); ?>"  alt="">
                                                            <?php } else { ?>
                                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($userlist['company_name']); ?>">
                                                            <?php } ?>


                                                                    </div>


                                                                    <div class="post-design-name_follow fl">
                                                                        <ul>


                                                                            <li><div class="post-design-product_follow">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                        <h6>
            <?php
            echo ucwords($userlist['company_name']);
            ?>
                                                                                        </h6>

                                                                                    </a> </div></li>


                                                                            <li>
                                                                                <div class="post-design-product_follow_main" style="display:block;">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                        <p>
                                                                                            <?php
                                                                                            echo $category;
                                                                                            ?>
                                                                                        </p></a>
                                                                                </div>


                                                                            </li>
                                                                        </ul> 
                                                                    </div>  

                                                                    <div class="follow_left_box_main_btn">

                                                                        <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                            <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow</button>
                                                                        </div>

                                                                    </div>


                                                                    <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>


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
        $businessfollow = $this->data['businessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        if (!$businessfollow) {
            ?>                             

                                                            <div class="profile-job-post-title-inside clearfix">

                                                                <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                    <div class="post-design-pro-img_follow">

                                                                        <img  src="<?php echo base_url(USERIMAGE . $userlist['business_user_image']); ?>"  alt="">

                                                                    </div>


                                                                    <div class="post-design-name_follow fl">
                                                                        <ul>


                                                                            <li><div class="post-design-product_follow">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                        <h6>
            <?php
            echo ucwords($userlist['company_name']);
            ?>
                                                                                        </h6>
                                                                                    </a> </div></li>


                                                                            <li>
                                                                                <div class="post-design-product_follow_main" style="display:block;">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile/' . $userlist['business_slug'] . ''); ?>" title="<?php echo ucwords($userlist['company_name']); ?>">
                                                                                        <p>
            <?php
            echo $category;
            ?>
                                                                                        </p></a>
                                                                                </div>


                                                                            </li>
                                                                        </ul> 
                                                                    </div>  

                                                                    <div class="follow_left_box_main_btn">

                                                                        <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                            <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow</button>
                                                                        </div>

                                                                    </div>


                                                                    <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>


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
        $buisnessfollow = $this->data['buisnessfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');



        if (!$buisnessfollow) {
            ?>                             

                                                            <div class="profile-job-post-title-inside clearfix">

                                                                <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['business_profile_id']; ?>">                   
                                                                    <div class="post-design-pro-img_follow">

                                                                        <img  src="<?php echo base_url(USERIMAGE . $userlist['business_user_image']); ?>"  alt="">

                                                                    </div>


                                                                    <div class="post-design-name_follow fl">
                                                                        <ul>


                                                                            <li><div class="post-design-product_follow">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>">
                                                                                        <h6>
                                                            <?php
                                                            echo ucwords($userlist['company_name']);
                                                            ?>
                                                                                        </h6>
                                                                                    </a> </div></li>


                                                                            <li>
                                                                                <div class="post-design-product_follow_main" style="display:block;">
                                                                                    <a>
                                                                                        <p>
            <?php
            echo $category;
            ?>
                                                                                        </p></a>
                                                                                </div>


                                                                            </li>
                                                                        </ul> 
                                                                    </div>  

                                                                    <div class="follow_left_box_main_btn">

                                                                        <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                            <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow</button>
                                                                        </div>

                                                                    </div>


                                                                    <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>


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

                                                                        <img  src="<?php echo base_url(USERIMAGE . $userlist['business_user_image']); ?>"  alt="">

                                                                    </div>


                                                                    <div class="post-design-name_follow fl">
                                                                        <ul>


                                                                            <li><div class="post-design-product_follow">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $userlist['business_slug'] . ''); ?>">
                                                                                        <h6>
                                                            <?php
                                                            echo ucwords($userlist['company_name']);
                                                            ?>
                                                                                        </h6>
                                                                                    </a> </div></li>


                                                                            <li>
                                                                                <div class="post-design-product_follow_main" style="display:block;">
                                                                                    <a>
                                                                                        <p>
            <?php
            echo $category;
            ?>
                                                                                        </p></a>
                                                                                </div>


                                                                            </li>
                                                                        </ul> 
                                                                    </div>  

                                                                    <div class="follow_left_box_main_btn">

                                                                        <div class="<?php echo "fr" . $userlist['business_profile_id']; ?>">
                                                                            <button id="<?php echo "followdiv" . $userlist['business_profile_id']; ?>" onClick="followuser(<?php echo $userlist['business_profile_id']; ?>)">Follow</button>
                                                                        </div>

                                                                    </div>


                                                                    <span class="Follow_close" onClick="followclose(<?php echo $userlist['business_profile_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>


                                                                </div>

                                                            </div>


                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                }
                                                                                ?>


                                                <div class="seeall">
                                                    <a href="<?php echo base_url('business_profile/userlist'); ?>">All User</a>
                                                </div>

                                            </div>
                                        </li>


                                    </ul>
                                </div>

                                <!-- follower list end  -->


                            </div>

                        </div>
                    </div>
                    <!-- popup start -->
                    <div class="col-md-7 col-sm-7 all-form-content">

                        <div class="post-editor col-md-12">
                            <div class="main-text-area col-md-12">
                                <div class="popup-img col-md-1"> 
                                                <?php if ($businessdata[0]['business_user_image']) { ?>
                                        <img  src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']); ?>"  alt="">
                                                <?php } else { ?>
                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                <?php } ?>
                                </div>
                                <div id="myBtn"  class="editor-content col-md-11 popup-text" contenteditable>
                                    <span> Post Your Product....</span> 



                                </div>
                            </div>
                            <div class="fr">
                                <a href="" class="button">Post</a></div>
                        </div>
                    </div>
                    <!-- Trigger/Open The Modal -->
                    <!-- <div id="myBtn">Open Modal</div>
                    -->
                    <!-- The Modal -->
                    <div id="myModal" class="modal-post">

                        <!-- Modal content -->
                        <div class="modal-content-post">
                            <span class="close1">&times;</span>

                            <div class="post-editor col-md-12">

<?php echo form_open_multipart(base_url('business_profile/business_profile_addpost_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix', 'onsubmit' => "imgval()")); ?>

                                <div class="main-text-area col-md-12"  style="border-bottom: 5px solid #ced5df;">
                                    <div class="popup-img col-md-1"> <img  src="<?php echo base_url(USERIMAGE . $businessdata1[0]['business_user_image']); ?>"  alt="">
                                    </div>
                                    <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                           <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
                                        <textarea placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
                                                  name=my_text rows=4 cols=30 class="post_product_name" style="height:  10%;"></textarea>
                                        <div style="display: none;">                        
                                            <input size=1 value=50 name=text_num style="width: 52px;" readonly> 
                                        </div>

                                    </div>
                                   <!--   <span class="fr">
                               
                                   <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->
                                    <div class="col-md-1"><i class=" fa fa-camera "  style="margin: 0px;
                                                             font-size: 27px;
                                                             cursor: pointer;
                                                             /* margin-right: -38px; */
                                                             margin-top: 20px;"></i> </div>

                                </div>
                                <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                    <textarea name="product_desc" class="description" placeholder="Enter Description"></textarea>

                                    <output id="list"></output>
                                </div>
                                <div class="print_privew_post">

                                </div>
                                <div class="preview"></div>
                                <div id="data-vid" class="large-8 columns">
                                    <!--video will be inserted here.-->
                                </div>

                                <h2 id="name-vid"></h2>
                                <p id="size-vid"></p>
                                <p id="type-vid"></p>

                                <div class="popup-social-icon">
                                    <ul class="editor-header">

                                        <li>
                                            <label for="test-upload"><i class=" fa fa-camera "  style=" margin: 8px; cursor:pointer"> Photo</i><i class=" fa fa-video-camera"  style=" margin: 8px; cursor:pointer"> Video </i> <i class="fa fa-music "  style=" margin: 8px; cursor:pointer"> Audio </i><i class=" fa fa-file-pdf-o fa-2x"  style=" margin: 8px; cursor:pointer"> PDF </i> </label>

                                            <input type="file" class="file" style="display:block;" id="test-upload" style="display:none;" name="postattach[]" multiple>
                                        </li>
                                    </ul>


                                </div>
                                <div class="fr">
                                    <button type="submit"  value="Submit">Post</button>    </div>
<?php echo form_close(); ?>
                            </div>
                        </div>

                    </div>

                    <!-- popup end -->    
                    <div class="col-md-7 col-sm-7 all-form-content ">

                        <!-- body content start-->

<?php

function text2link($text) {
    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
    return $text;
}
?>
<?php
//echo "<pre>"; print_r($businessprofiledata); die();
foreach ($businessprofiledata as $row) {


    $userid = $this->session->userdata('aileenuser');

    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
    $businessdelete = $this->data['businessdelete'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

    $likeuserarray = explode(',', $businessdelete[0]['delete_post']);

    if (!in_array($userid, $likeuserarray)) {
        ?>

                                <div class="col-md-12 col-sm-12 post-design-box"  id="<?php echo "removepost" . $row['business_profile_post_id']; ?>">

                                    <div  class="post_radius_box">  
                                        <div class="post-design-top col-md-12" >  
                                            <div class="post-design-pro-img"> 





                                                <!-- pop up box start-->
                                                <div id="popup1" class="overlay">
                                                    <div class="popup">

                                                        <div class="pop_content">
                                                            Your Post is Successfully Saved.
                                                            <p class="okk"><a class="okbtn" href="#">Ok</a></p>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- pop up box end-->



                                                <!-- pop up box start-->
                                                <div id="<?php echo "popup2" . $row['business_profile_post_id']; ?>" class="overlay">
                                                    <div class="popup">

                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post?.

                                                            <p class="okk"><a class="okbtn" id="<?php echo $row['business_profile_post_id']; ?>" onClick="remove_post(this.id)" href="#">Yes</a></p>

                                                            <p class="okk"><a class="cnclbtn" href="#">No</a></p>

                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- pop up box end-->


                                                <!-- pop up box start-->
                                                <div id="<?php echo "popup5" . $row['business_profile_post_id']; ?>" class="overlay">
                                                    <div class="popup">

                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post from your profile?.

                                                            <p class="okk"><a class="okbtn" id="<?php echo $row['business_profile_post_id']; ?>" onClick="del_particular_userpost(this.id)" href="#">OK</a></p>

                                                            <p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- pop up box end-->





        <?php
        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_user_image;
        ?>
        <?php if ($business_userimage) { ?>
                                                    <img  src="<?php echo base_url(USERIMAGE . $business_userimage); ?>"  alt="">
        <?php } else { ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
        <?php } ?>
                                            </div>


                                            <div class="post-design-name fl">
                                                <ul>


        <?php
        $companyname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->company_name;

        $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;

        $categoryid = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;


        $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
        ?>

                                                    <li></li>

                                                    <li><div class="post-design-product"><a style="    font-size: 18px;
                                                                                            line-height: 24px; font-weight: 600; color: #000033; margin-bottom: 4px; "  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>" title="<?php echo ucwords($companyname); ?>";><?php echo ucwords($companyname); ?> <span style="font-weight: 400;"> <?php echo date('d-M-Y', strtotime($row['created_date'])); ?></span></a></div></li>

                                                    <li>
                                                    <li><div class="post-design-product"><a href="javascript:void(0);" style=" color: #000033; font-weight: 400;" title="<?php echo ucwords($companyname); ?>"><?php echo ucwords($category); ?></a></div></li>

                                                    <li>

                                                    </li> 
                                                </ul> 
                                            </div>  


                                            <div class="dropdown1">
                                                <a onClick="myFunction(<?php echo $row['business_profile_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
                                                <div id="<?php echo "myDropdown" . $row['business_profile_post_id']; ?>" class="dropdown-content1">

        <?php if ($this->session->userdata('aileenuser') == $row['user_id']) { ?> 

                                                        <a href="<?php echo "#popup2" . $row['business_profile_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>

                                                        <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>

                                                    <?php } else { ?>
                                                        <a href="<?php echo "#popup5" . $row['business_profile_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>


                                                        <!-- <?php
                                                        $userid = $this->session->userdata('aileenuser');
                                                        $contition_array = array('user_id' => $userid, 'business_save' => '1', 'post_id ' => $row['business_profile_post_id']);
                                                        $businesssave = $this->data['businesssave'] = $this->common->select_data_by_condition('business_profile_save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                        if ($businesssave) {
                                                            ?>
                                                        
                                                           <a><i class="fa fa-bookmark" aria-hidden="true"></i>Saved Post</a>
                                                        
            <?php } else { ?>
                                                        
                                                           <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="save_post(this.id)" href="#popup1" class="<?php echo 'savedpost' . $row['business_profile_post_id']; ?>"><i class="fa fa-bookmark" aria-hidden="true"></i>  Save Post</a>
                                                        
            <?php } ?>
                                                        -->
                                                        <a href="<?php echo base_url('business_profile/business_profile_contactperson/' . $row['user_id'] . ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
        <?php } ?>
                                                </div>
                                            </div>


                                            <div class="post-design-desc ">
                                                <div >
                                                    <div id="<?php echo 'editpostdata' . $row['business_profile_post_id']; ?>" style="display:block;">
                                                        <a style="margin-bottom: 0px;     font-size: 16px"><?php echo text2link($row['product_name']); ?></a>
                                                    </div>

                                                    <div id="<?php echo 'editpostbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                                                        <input type="text" id="<?php echo 'editpostname' . $row['business_profile_post_id']; ?>" name="editpostname" value="<?php echo $row['product_name']; ?>">
                                                    </div>

                                                </div>                    
                                                <span class="show"> 

                                                    <div id="<?php echo 'editpostdetails' . $row['business_profile_post_id']; ?>" style="display:block;">
        <?php print text2link($row['product_description']); ?>
                                                    </div>

                                                    <div id="<?php echo 'editpostdetailbox' . $row['business_profile_post_id']; ?>" style="display:none;">

                                                        <textarea id="<?php echo 'editpostdesc' . $row['business_profile_post_id']; ?>" name="editpostdesc"><?php echo $row['product_description']; ?>
                                                        </textarea> 
                                                    </div>

                                                    <button id="<?php echo "editpostsubmit" . $row['business_profile_post_id']; ?>" style="display:none" onClick="edit_postinsert(<?php echo $row['business_profile_post_id']; ?>)">EditPost</button>


                                                </span>


                                            </div> 
                                        </div>




                                        <div class="post-design-mid col-md-12">

                                            <!-- multiple image code  start-->

                                            <div>
        <?php
        $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
        $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        ?>

        <?php if (count($businessmultiimage) == 1) { ?>

            <?php
            $allowed = array('gif', 'png', 'jpg');
            $allowespdf = array('pdf');
            $allowesvideo = array('mp4', '3gp');
            $allowesaudio = array('mp3');
            $filename = $businessmultiimage[0]['image_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array($ext, $allowed)) {
                ?>

                                                        <!-- one image start -->
                                                        <div id="basic-responsive-image" style="height: 50%; width: 100%;">
                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $businessmultiimage[0]['image_name'])) ?>" style="width: 100%; height: 100%;"> </a>
                                                        </div>
                                                        <!-- one image end -->

            <?php } elseif (in_array($ext, $allowespdf)) { ?>

                                                        <!-- one pdf start -->
                                                        <div>
                                                            <a href="<?php echo base_url('business_profile/creat_pdf/' . $businessmultiimage[0]['image_id']) ?>">PDF</a>
                                                        </div>
                                                        <!-- one pdf end -->

            <?php } elseif (in_array($ext, $allowesvideo)) { ?>

                                                        <!-- one video start -->
                                                        <div>
                                                            <video width="320" height="240" controls>
                                                                <source src="<?php echo base_url(BUSPOSTIMAGE . $businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                                                                <source src="movie.ogg" type="video/ogg">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                        <!-- one video end -->

                                                    <?php } elseif (in_array($ext, $allowesaudio)) { ?>

                                                        <!-- one audio start -->
                                                        <div>
                                                            <audio width="120" height="100" controls>

                                                                <source src="<?php echo base_url(BUSPOSTIMAGE . $businessmultiimage[0]['image_name']); ?>" type="audio/mp3">
                                                                <source src="movie.ogg" type="audio/ogg">
                                                                Your browser does not support the audio tag.

                                                            </audio>

                                                        </div>

                                                        <!-- one audio end -->

            <?php } ?>

        <?php } elseif (count($businessmultiimage) == 2) { ?>

                                                    <?php
                                                    foreach ($businessmultiimage as $multiimage) {
                                                        ?>

                                                        <!-- two image start -->
                                                        <div  id="two_images_bui" >
                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img class="two-columns" src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $multiimage['image_name'])) ?>" style="width: 100%; height: 100%;"> </a>
                                                        </div>

                                                        <!-- two image end -->
            <?php } ?>

        <?php } elseif (count($businessmultiimage) == 3) { ?>



                                                    <!-- three image start -->
                                                    <div id="three_images_art" >
                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $businessmultiimage[0]['image_name'])) ?>" style="width: 100%; height:100%; "> </a>
                                                    </div>
                                                    <div style="width: 49.4%; height: 35%; float: left; margin-top: 4px; margin-right: 3px;">
                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $businessmultiimage[1]['image_name'])) ?>" style="width: 100%; height:100%; "> </a>
                                                    </div>
                                                    <div style="width: 49.4%; height: 35%; float: left; margin-top: 4px; margin-right: 3px;">
                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_post_id']) ?>"><img class="three-columns" src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $businessmultiimage[2]['image_name'])) ?>" style="width: 100%; height:100%; "> </a>
                                                    </div>

                                                    <!-- three image end -->


        <?php } elseif (count($businessmultiimage) == 4) { ?>


            <?php
            foreach ($businessmultiimage as $multiimage) {
                ?>

                                                        <!-- four image start -->
                                                        <div id="responsive_buis-images-breakpoints" style="   ">
                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $multiimage['image_name'])) ?>" style="width: 100%; height: 100%;"> </a>

                                                        </div>

                                                        <!-- four image end -->

            <?php } ?>


        <?php } elseif (count($businessmultiimage) > 4) { ?>



                                                    <?php
                                                    $i = 0;
                                                    foreach ($businessmultiimage as $multiimage) {
                                                        ?>

                                                        <!-- five image start -->
                                                        <div>
                                                            <div id="responsive_buis-images-breakpoints">
                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $multiimage['image_name'])) ?>" style=""> </a>
                                                            </div>
                                                        </div>

                                                        <!-- five image end -->

                <?php
                $i++;
                if ($i == 3)
                    break;
            }
            ?>
                                                    <!-- this div view all image start -->
                                                    <div>
                                                        <div id="responsive_buis-images_3-breakpoints" >
                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url(BUSPOSTIMAGE . str_replace(" ", "_", $businessmultiimage[3]['image_name'])) ?>" style=" width: 100%; height: 100%;"> </a></div>


                                                        <div class="bui_images_view_more" >

                                                            <a href="<?php echo base_url('business_profile/postnewpage/' . $row['business_profile_post_id']) ?>" >View All (+<?php echo (count($businessmultiimage) - 4); ?>)</a>
                                                        </div>

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
                                                <ul>
                                                    <li class="<?php echo 'likepost' . $row['business_profile_post_id']; ?>">

                                                        <a id="<?php echo $row['business_profile_post_id']; ?>"   onClick="post_like(this.id)">

                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                                                $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                $likeuser = $this->data['active'][0]['business_like_user'];
                                                $likeuserarray = explode(',', $active[0]['business_like_user']);

                                                if (!in_array($userid, $likeuserarray)) {
                                                    ?>               

                                                                <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>

        <?php } else { ?> 
                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
        <?php } ?>
                                                            <span>
                                                <?php
                                                if ($row['business_likes_count'] > 0) {
                                                    echo $row['business_likes_count'];
                                                }
                                                ?>
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li id="<?php echo "insertcount" . $row['business_profile_post_id']; ?>" style="display:block;">
        <?php
        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
        $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        ?>

                                                        <a  onClick="commentall(this.id)" id="<?php echo $row['business_profile_post_id']; ?>"><i class="fa fa-comment-o" aria-hidden="true"> 
        <?php
        if (count($commnetcount) > 0) {
            echo count($commnetcount);
        } else {
            
        }
        ?>
                                                            </i> 
                                                        </a>

                                                    </li>
                                                </ul>

                                            </div>
                                        </div>



                                        <!-- like user list start -->

                                        <!-- pop up box start-->
                                        <div id="<?php echo "popuplike" . $row['business_profile_post_id']; ?>" class="overlay">
                                            <div class="popup">

                                                <div class="pop_content">

                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                $likeuser = $commnetcount[0]['business_like_user'];
                                                                $countlike = $commnetcount[0]['business_likes_count'] - 1;

                                                                $likelistarray = explode(',', $likeuser);


                                                                foreach ($likelistarray as $key => $value) {

                                                                    $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                    ?>

                                                        <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $value); ?>">
            <?php echo ucwords($business_fname1); ?>

                                                        </a>

                                                                <?php } ?>

                                                    <p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

                                                </div>

                                            </div>
                                        </div>
                                        <!-- pop up box end-->
                                        <div class="like_other">
                                            <a  href="<?php echo "#popuplike" . $row['business_profile_post_id']; ?>">
        <?php
        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
        $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

        $likeuser = $commnetcount[0]['business_like_user'];
        $countlike = $commnetcount[0]['business_likes_count'] - 1;

        $likelistarray = explode(',', $likeuser);

        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
        ?>


                                                <div class="like_one_other">


                                                    <?php echo ucwords($business_fname1);
                                                    echo "&nbsp;"; ?>



                                                    <?php
                                                    if (count($likelistarray) > 1) {
                                                        ?>

                                                        <?php echo "and"; ?>


            <?php echo $countlike;
            echo "&nbsp;";
            echo "others"; ?> 

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
                                                        ?>
                                                            <div class="all-comment-comment-box">
                                                                <div class="post-design-pro-comment-img"> 
                <?php
                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                ?>
                                                            <?php if ($business_userimage) { ?>
                                                                        <img  src="<?php echo base_url(USERIMAGE . $business_userimage); ?>"  alt="">
                                                            <?php } else { ?>
                                                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                            <?php } ?>

                                                                </div>
                                                                <div class="comment-name">

                                                                    <b>  <?php echo $companyname;
                                                            echo '</br>'; ?>
                                                                    </b>
                                                                </div>
                                                                <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['business_profile_post_comment_id']; ?>">
                <?php
                echo text2link($rowdata['comments']);
                echo '</br>';
                ?>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="col-md-10">
                                                                        <input type="text" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>" id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" value="<?php echo $rowdata['comments']; ?>" onClick="commentedit(this.name)"></div>

                                                                    <div class="col-md-2 comment-edit-button">
                                                                        <button id="<?php echo "editsubmit" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Comment</button>
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
                                                                                <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                                                                    <?php } else { ?>

                                                                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>

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

                                                                        <span role="presentation" aria-hidden="true"> · </span>
                                                                        <div class="comment-details-menu">

                                                                            <div id="<?php echo 'editcommentbox' . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                                                                <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                                                                </a>
                                                                            </div>

                                                                            <div id="<?php echo 'editcancle' . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                                                                <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancle
                                                                                </a>
                                                                            </div>

                                                                        </div>

                <?php } ?>



                                                                            <?php
                                                                            $userid = $this->session->userdata('aileenuser');

                                                                            $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;


                                                                            if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                                                                                ?>                                     
                                                                        <span role="presentation" aria-hidden="true"> · </span>
                                                                        <div class="comment-details-menu">



                                                                            <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['business_profile_post_id']; ?>">
                                                                            <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                </span>
                                                                            </a>
                                                                        </div>

                <?php } ?>                                   
                                                                    <span role="presentation" aria-hidden="true"> · </span>
                                                                    <div class="comment-details-menu">
                                                                        <p><?php echo date('d-M-Y', strtotime($rowdata['created_date']));
                echo '</br>'; ?></p></div>
                                                                </div></div>


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
                                                    <img  src="<?php echo base_url(USERIMAGE . $business_userimage); ?>"  alt="">
                                                            <?php } else { ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
        <?php } ?>
                                            </div>



                                            <div class="">
                                                <div class="col-md-10  inputtype-comment" style="    padding-left: 7px;">
                                                    <input type="text" name="<?php echo $row['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $row['business_profile_post_id']; ?>" placeholder="Type Message ..." value= ""  onClick="entercomment(this.name)"></div>
        <?php echo form_error('post_comment'); ?> 
                                                <div class="col-md-1 comment-edit-butn">       
                                                    <button id="<?php echo $row['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button></div>
                                            </div>

                                        </div>

                                        <!-- comment end -->
                                    </div>

                                </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                        <!-- body content end-->
                    </div>
                </div>
            </div></div></div>

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


</body>

</html>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



<!-- script for skill textbox automatic end (option 2)-->

<script>

                                                var data = <?php echo json_encode($demo); ?>;
//alert(data);


                                                $(function() {
                                                // alert('hi');
                                                $("#tags").autocomplete({
                                                source: function(request, response) {
                                                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                response($.grep(data, function(item){
                                                return matcher.test(item.label);
                                                }));
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
                                                });</script>

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
                    //alert(data);

                    results: data


                    };
                    },
                    cache: true
            }
    });</script>

<!-- like comment script start -->

<!-- post like script start -->

<script type="text/javascript">
    function post_like(clicked_id)
            {
            //alert(clicked_id);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/like_post" ?>',
                    data:'post_id=' + clicked_id,
                    success:function(data){ //alert('.' + 'likepost' + clicked_id);
                    $('.' + 'likepost' + clicked_id).html(data);
                    }
            });
            }
</script>

<!--post like script end -->

<!-- comment insert script start -->

<script type="text/javascript">
    function insert_comment(clicked_id)
            {
            var post_comment = document.getElementById("post_comment" + clicked_id);
            //alert(clicked_id);
            //alert(post_comment.value);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/insert_comment" ?>',
                    data:'post_id=' + clicked_id + '&comment=' + post_comment.value,
                    dataType: "json",
                    success:function(data){
                    $('input').each(function(){
                    $(this).val('');
                    });
                    $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('.' + 'insertcomment' + clicked_id).html(data.comment);
                    }
            });
            }
</script>

<!-- insert comment using enter -->
<script type="text/javascript">

    function entercomment(clicked_id)
            {

            $(document).ready(function() {
            $('#post_comment' + clicked_id).keypress(function(e) {

            if (e.keyCode == 13 && !e.shiftKey) {
            var val = $('#post_comment' + clicked_id).val();
            e.preventDefault();
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
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/insert_commentthree" ?>',
                    data:'post_id=' + clicked_id + '&comment=' + val,
                    dataType: "json",
                    success:function(data){
                    $('input').each(function(){
                    $(this).val('');
                    });
                    //  $('.insertcomment' + clicked_id).html(data);
                    $('#' + 'insertcount' + clicked_id).html(data.count);
                    $('.insertcomment' + clicked_id).html(data.comment);
                    }
            });
            } else {

            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/insert_comment" ?>',
                    data:'post_id=' + clicked_id + '&comment=' + val,
                    // dataType: "json",
                    success:function(data){
                    $('input').each(function(){
                    $(this).val('');
                    });
                    $('#' + 'fourcomment' + clicked_id).html(data);
                    // $('#' + 'commnetpost' + clicked_id).html(data.count);
                    //  $('#' + 'fourcomment' + clicked_id).html(data.comment);

                    }
            });
            }
            // khyati chnages end
            //alert(val);
            }
            });
            });
            }
</script>


<!--comment insert script end -->


<!-- hide and show data start-->
<script type="text/javascript">
    function commentall(clicked_id){

    var x = document.getElementById('threecomment' + clicked_id);
    var y = document.getElementById('fourcomment' + clicked_id);
    var z = document.getElementById('insertcount' + clicked_id);
    if (x.style.display === 'block' && y.style.display === 'none') {


    x.style.display = 'none';
    y.style.display = 'block';
    z.style.display = 'none';
    $.ajax({
    type:'POST',
            url:'<?php echo base_url() . "business_profile/fourcomment" ?>',
            data:'bus_post_id=' + clicked_id,
            //alert(data);
            success:function(data){
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
    //          url:'<?php //echo base_url() . "business_profile/fourcomment"  ?>',
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
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/like_comment" ?>',
                    data:'post_id=' + clicked_id,
                    success:function(data){ //alert('.' + 'likepost' + clicked_id);
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
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/like_comment1" ?>',
                    data:'post_id=' + clicked_id,
                    success:function(data){ //alert('.' + 'likepost' + clicked_id);
                    $('#' + 'likecomment1' + clicked_id).html(data);
                    }
            });
            }
</script>

<!--comment like script end -->

<script type="text/javascript">
    function comment_delete(clicked_id)
            {

            var post_delete = document.getElementById("post_delete");
            //alert(post_delete.value);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/delete_comment" ?>',
                    data:'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
                    dataType: "json",
                    success:function(data){ //alert('.' + 'insertcomment' + clicked_id);

                    $('.' + 'insertcomment' + post_delete.value).html(data.comment);
                    $('#' + 'insertcount' + post_delete.value).html(data.count);
                    }
            });
            }

    function comment_deletetwo(clicked_id)
            {

            var post_delete1 = document.getElementById("post_deletetwo");
            //alert(post_delete.value);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/delete_commenttwo" ?>',
                    data:'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
                    dataType: "json",
                    success:function(data){ //alert('.' + 'insertcomment' + clicked_id);

                    $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
                    $('#' + 'insertcount' + post_delete1.value).html(data.count);
                    }
            });
            }

</script>

<!--comment delete script end -->

<!-- comment edit box start-->
<script type="text/javascript">

    function comment_editbox(clicked_id){
    document.getElementById('editcomment' + clicked_id).style.display = 'block';
    document.getElementById('showcomment' + clicked_id).style.display = 'none';
    document.getElementById('editsubmit' + clicked_id).style.display = 'block';
    document.getElementById('editcommentbox' + clicked_id).style.display = 'none';
    document.getElementById('editcancle' + clicked_id).style.display = 'block';
    }

    function comment_editcancle(clicked_id){

    document.getElementById('editcommentbox' + clicked_id).style.display = 'block';
    document.getElementById('editcancle' + clicked_id).style.display = 'none';
    document.getElementById('editcomment' + clicked_id).style.display = 'none';
    document.getElementById('showcomment' + clicked_id).style.display = 'block';
    document.getElementById('editsubmit' + clicked_id).style.display = 'none';
    }

    function comment_editboxtwo(clicked_id){
    document.getElementById('editcommenttwo' + clicked_id).style.display = 'block';
    document.getElementById('showcommenttwo' + clicked_id).style.display = 'none';
    document.getElementById('editsubmittwo' + clicked_id).style.display = 'block';
    document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'none';
    document.getElementById('editcancletwo' + clicked_id).style.display = 'block';
    }

    function comment_editcancletwo(clicked_id){

    document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'block';
    document.getElementById('editcancletwo' + clicked_id).style.display = 'none';
    document.getElementById('editcommenttwo' + clicked_id).style.display = 'none';
    document.getElementById('showcommenttwo' + clicked_id).style.display = 'block';
    document.getElementById('editsubmittwo' + clicked_id).style.display = 'none';
    }

</script>

<!--comment edit box end-->

<!-- comment edit insert start -->

<script type="text/javascript">
    function edit_comment(abc)
            { //alert('editsubmit' + abc);

            var post_comment_edit = document.getElementById("editcomment" + abc);
            //alert(post_comment.value);
            //alert(post_comment.value);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data:'post_id=' + abc + '&comment=' + post_comment_edit.value,
                    success:function(data){ //alert('falguni');

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
            //window.location.reload();
            }
</script>


<script type="text/javascript">

    function commentedit(abc)
            {


            $(document).ready(function() {
            $('#editcomment' + abc).keypress(function(e) {

            if (e.keyCode == 13 && !e.shiftKey) {
            var val = $('#editcomment' + abc).val();
            e.preventDefault();
            if (window.preventDuplicateKeyPresses)
                    return;
            window.preventDuplicateKeyPresses = true;
            window.setTimeout(function () {
            window.preventDuplicateKeyPresses = false;
            }, 500);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data:'post_id=' + abc + '&comment=' + val,
                    success:function(data){ //alert('falguni');


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
            });
            });
            }
</script>


<script type="text/javascript">
    function edit_commenttwo(abc)
            { //alert('editsubmit' + abc);

            var post_comment_edit = document.getElementById("editcommenttwo" + abc);
            //alert(post_comment.value);
            //alert(post_comment.value);
            $.ajax({
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data:'post_id=' + abc + '&comment=' + post_comment_edit.value,
                    success:function(data){ //alert('falguni');

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
</script>

<script type="text/javascript">

    function commentedit2(abc)
            {
            $(document).ready(function() {
            $('#editcomment2' + abc).keypress(function(e) {

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
            type:'POST',
                    url:'<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data:'post_id=' + abc + '&comment=' + val,
                    success:function(data){ //alert('falguni');

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
    btn.onclick = function() {
    modal.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
    }
    }
</script>

<!-- further and less -->

<script src="jquery-1.8.2.js"></script>
<script>
    $(function() {
    var showTotalChar = 270, showChar = "Further", hideChar = "less";
    $('.show').each(function() {
    var content = $(this).text();
    if (content.length > showTotalChar) {
    var con = content.substr(0, showTotalChar);
    var hcon = content.substr(showTotalChar, content.length - showTotalChar);
    var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
    $(this).html(txt);
    }
    });
    $(".showmoretxt").click(function() {
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
    });</script>

<!-- drop down script zalak start -->


<script>
    /* When the user clicks on the button, 
     toggle between hiding and showing the dropdown content */
    function myFunction(clicked_id) {
    document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
    }

// Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
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
    function read(f) {//alert("aa");
    return function(e) {
    var base64 = e.target.result;
    var $img = $('<img/>', {
    src: base64,
            title: encodeURIComponent(f.name), //( escape() is deprecated! )
            "class": "thumb"
    });
    var $thumbParent = $("<span/>", {html:$img, "class":"thumbParent"}).append('<span class="remove_thumb"/>');
    thumbsArray.push(base64); // Push base64 image into array or whatever.
    $list.append($thumbParent);
    };
    }

// HANDLE FILE/S UPLOAD
    function handleFileSelect(e) {//alert("aaa");
    e.preventDefault(); // Needed?
    var files = e.target.files;
    var len = files.length;
    if (len > maxUpload || thumbsArray.length >= maxUpload){
    return alert("Sorry you can upload only 5 images");
    }
    for (var i = 0; i < len; i++) {
    var f = files[i];
    if (!f.type.match('image.*')) continue; // Only images allowed    
    var reader = new FileReader();
    reader.onload = read(f); // Call read() function
    reader.readAsDataURL(f);
    }
    }

    $fileUpload.change(function(e) {alert("aaaa");
    handleFileSelect(e);
    });
    $list.on('click', '.remove_thumb', function () {//alert("aaaaa");
    var $removeBtns = $('.remove_thumb'); // Get all of them in collection
    var idx = $removeBtns.index(this); // Exact Index-from-collection
    $(this).closest('span.thumbParent').remove(); // Remove tumbnail parent
    thumbsArray.splice(idx, 1); // Remove from array
    });</script>
<!-- multi image add post khyati end -->

<script language=JavaScript>
                                                        <    !--
                                                            function check_length(m    y_form)
                                                            {
            maxLen = 50; // max number of characters allowed
    if (my_form.my_text.value.length >= maxLen) {
// Alert message if maximum limit is reached. 
// If required Alert can be removed. 
    var msg = "You have reached your maximum limit of characters allowed";
    alert(msg);
// Reached the Maximum length so trim the textarea
    my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
                                                                        }
                                                                        else{ // Maximum length not reached so update the value of my_text counter
            my_form.text_num.value = maxLen - my_form.my    _t    ex    t.value.length;
                                                                            }
                                                                            }
                                                                        //-->
</script>
<!--- khyati change end-->


<!-- edit post start -->

    <script type="te            xt/javascript">
                      function editpost(abc)
                    { 

   
                  
       document.getElementById('editpostdata' + abc).style.display='none';
       document.getElementById('editpostbox' + abc).style.display='block';
       document.getElementById('editpostdetails' + abc).style.display='none';
       document.getElementById('editpostdetailbox' + abc).style.display='block';
       document.getElementById('editpo            stsubmit' + ab                c).style.display='block';

        
                    }
</script>


                                                                <script type="text/javascript">
                                                                    function edit_postinsert(abc)
                                                                        {

            var editpostname = document.getElementById("editpostname" + abc);
    var editpostdetails = document.getElementById("editpostdesc" + abc);
    $.ajax({
    type:'POST',
            url:'<?php echo base_url() . "business_profile/edit_post_insert" ?>',
            data:'business_profile_post_id=' + abc + '&product_name=' + editpostname.value + '&product_description=' + editpostdetails.value,
            dataType: "json",
            success:function(data){

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
                                                        </script>


<!-- edi                            t post end -->

<!-- savepost start -->

                                                        <script type="text/javascript">
                                                        function save_post(abc)
{

                    $.ajax({
                    type:'POST',
                            url:'<?php echo base_url() . "business_profile/business_profile_save" ?>',
                            data:'business_profile_post_id=' + abc,
                            success:function(data){

                            $('.' + 'savedpost' + abc).html(data);
}
}); 

}
</script>

<!-                                - save post end -->
<!-- remove s                                ave post start -->

<script type="text/javascript">
 function remove_post(abc)
{

                                    $.ajax({
                                    type:'POST',
                                            url:'<?php echo base_url() . "business_profile/business_profile_deletepost" ?>',
                                            data:'business_profile_post_id=' + abc,
                                            //alert(data);
                                            success:function(data){

                                            $('#' + 'removepost' + abc).html(data);
      }
      }); 
      
      }
      </script>

<!-- rem                                    ove save post end -->


<!-- remove particul                                    ar user post start -->

      <script type="text/javascript">
      function del_particular_userpost(abc)
      {

                                                    $.ajax({
                                                    type:'POST',
                                                            url:'<?php echo base_url() . "business_profile/del_particular_userpost" ?>',
                                                            data:'business_profile_post_id=' + abc,
                                                            //alert(data);
                                                            success:function(data){

                                                            $('#' + 'removepost' + abc).html(data);
}
                                                        }); 
                                                            
                                                            }
                                                            </script>

<!-- remove par                                        ticular user post end -->


<!-- fo                                        llow user script start -->

                                                        <script type="text/javascript">
function followuser(clicked_id)
                                                        {

                                                                    $("#fad" + clicked_id).fadeOut(4000);
                                                            $.ajax({
                                                            type:'POST',
                                                                    url:'<?php echo base_url() . "business_profile/follow" ?>',
                                                                    data:'follow_to=' + clicked_id,
                                                                    success:function(data){

                                                                    $('.' + 'fr' + clicked_id).html(data);
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


<!-- insert post script zalak start -->

                                                                <script>
                                                                $('#file-fr').fileinput({
                                                                            language: 'fr',
                                                                            uploadUrl: '#',
                                                                            allowedFileExtensions: ['jpg', 'png', 'gif']
                                                            });
                                                                $('#file-es').fileinput({
                                                                            language: 'es',
                                                                            uploadUrl                                                            : '#',
                                                                            allowedFileExtensions: ['jpg', 'png', 'gif']
                                                    });
                                                        $("#file-0").fileinput({
                                                                            'allowedFileExtensions': ['jpg', 'png', 'gif']
                                                    });
                                                    $("#file-1").fileinput({
                                                                            uploadUrl: '#', // you must set a valid URL here else you will get an error
                                                                            allowedFileEx                                                            tensions:                                                             ['jpg', 'png', 'gif'],
                                                                            overwriteInitial: false,
                                                                            maxFileSize: 1000,
                                                                            maxFilesNum: 10,
                                                                            //allowedFile                                                            Types: ['                                                            image',                                                             'video', 'flash'],
                                                                            slugCallback: function (filename) {
                                                                            return filename.replace('(', '_').replace(']', '_');
                                    }
                                    });
                                    /*
                                $(".file").on('fileselect', function(event, n, l) {
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
                                                                                    {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
                                        {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                               {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3},
                                   ],
                                   });
                                    $("#file-4").fileinput({
                                                                                            uploadExtraData: {kvId: '10'}
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
                                                                                                    $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
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
                                                                                                    {caption: "nature-1.jpg", si                                                            ze: 329892, width: "120px", url: "{$url}", key: 1},
                                {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                                        {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3},
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
                                        
                                        function imgval(){


//var fileInput = document.getElementById('test-upload');

                                                                                                    var fileInput = document.getElementById("test-upload").files;
                                                                                                    for (var i = 0; i < fileInput.length; i++)
                                                                                                            {
                                                                                                            var vname = fileInput[i].name;
                                                                                                            var vfirstname = fileInput[0].name;
                                                                                                            var ext = vfirstname.split('.').pop();
                                                                                                            var ext1 = vname.split('.').pop();
                                                                                                            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                                                                                            var allowesvideo = ['mp4', '3gp'];
                                                                                                            var allowesaudio = ['mp3'];
                                                                                                            var allowespdf = ['pdf'];
                                                                                                            var foundPresent = $.inArray(ext, allowedExtensions) > - 1;
                                                                                                            var foundPresentvideo = $.inArray(ext, allowesvideo) > - 1;
                                                                                                            var foundPresentaudio = $.inArray(ext, allowesaudio) > - 1;
                                                                                                            var foundPresentpdf = $.inArray(ext, allowespdf) > - 1;
                                                                                                            if (foundPresent == true)
                                                                                                            {
                                                                                                            var foundPresent1 = $.inArray(ext1, allowedExtensions) > - 1;
                                                                                                            if (foundPresent1 == true && fileInput.length <= 10){
                 }else{

                                                                                                                    $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in ne                                                                w post.");
                                                                                                            $('#bidmodal').modal('show');
                                                                                                            setInterval('window.location.reload()', 10000);
                                                                                                            // window.location='';
                                                                                                            event.preventDefault();
                                                                                                            return fa                                                                lse;
                                            }
                                            
                                            }
                                            else if(foundPresentvideo == true)
                                    {

                                                                                                                    var foundPresent1 = $.inArray(e                                                                xt1, allowesvideo) > - 1;
                                                                                                            if (foundPresent1 == true && fileInput.length == 1){
                                            }else{
                                                                                                                    $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                                                                                            $('#bidmodal').modal('show');
                                                                                                            setInterval('window.location.reload()', 10000);
                                                                                                            event.preventDefault();
                                                                                                            return f                                                                alse;
         }   
         } 
         
         else if(foundPresentaudio == true)
         {

                                                                                                                    var foundPresent1 = $.inArray(ext1, allowesaudio) > - 1;
                                                                                                            if (foundPresent1 == true && fileInput.length == 1){
                                           }else{
                                                                                                                    $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                                                                                            $('#bidmodal').modal('show');
                                                                                                            setInterval('window.location.reload()', 10000);
                                                                                                            event.preventDefault();
                                                                                                            return false;
                                            }   
                                            }
                                            else if(foundPresentpdf == true)
                                                {

                                                                                                                    var foundPresent1 = $.inArray(ext1, allowespdf) > - 1;
                                                                                                            if (foundPresent1 == true && fileInput.length == 1){
                                                }else{
                                                                                                                    $('.biderror .mes').html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post.");
                                                                                                            $('#bidmodal').modal('show');
                                                                                                            setInterval('window.location.reload()', 10000);
                                                                                                            event.preventDefault();
                                                                                                            return false;
                                                }   
                                                }
                                                
                                            }
                                            }
                                            
                                            
                                            
</script>
                                            <script type="text/javascript">
                                            
                                            $(document).ready(function(){
                                                                                                                    $('.modal-clo                                                                        se').on('cl                                                                        ick', function(){
                                                                                                            $('.modal-post').hide();
            });
            });
            
</script>

<!-- post insert developing code end  -->
