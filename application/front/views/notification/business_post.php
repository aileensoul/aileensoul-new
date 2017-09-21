<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui-1-12-1.css'); ?>"> <!-- DOWNLOAD FROM : href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css'); ?>" />
        <!-- further and less -->
        <script>
            $(function () {
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
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <!-- START HEADER -->
        <?php echo $header; ?>
        <!-- END HEADER -->
        <?php echo $business_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4  profile-box profile-box-left animated fadeInLeftBig">
                            <div class="">
                                <?php echo $business_left; ?>
                            </div>
                            <br>
                            <div id="result"></div>   
                        </div>
                        <div id="myModal" class="modal-post">
                        </div>
                        <!-- popup end -->  
                        <?php
                        if ($this->session->flashdata('error')) {
                            echo $this->session->flashdata('error');
                        }
                        ?>
                        <div class="col-md-7 col-sm-12 custom-right-business animated fadeInUp">
                            <!-- body content start-->
                            <?php
                            if (count($busienss_data) > 0) {

                                $userid = $this->session->userdata('aileenuser');
                                $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1');
                                $businessdelete = $this->data['businessdelete'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                $likeuserarray = explode(',', $businessdelete[0]['delete_post']);
                                if (!in_array($userid, $likeuserarray) && $businessdelete[0]['is_delete'] == '0') {
                                    ?>
                                    <div id="<?php echo "removepost" . $busienss_data[0]['business_profile_post_id']; ?>">
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
                                                        $business_userimage = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['user_id'], 'status' => 1))->row()->business_user_image;
                                                        $userimageposted = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['posted_user_id']))->row()->business_user_image;
                                                        ?>
                                                        <?php
                                                        $slugname = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['user_id'], 'status' => 1))->row()->business_slug;
                                                        $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                        ?>

                                                        <?php if ($busienss_data[0]['posted_user_id']) {
                                                            ?>

                                                            <?php if ($userimageposted) { ?>
                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugnameposted); ?>">
                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugnameposted); ?>">
                                                                    <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                </a>
                                                            <?php } ?>

                                                        <?php } else { ?>
                                                            <?php if ($business_userimage) { ?>
                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugname); ?>">
                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugname); ?>">
                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                </a>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="post-design-name fl col-md-10">
                                                        <ul>
                                                            <?php
                                                            $companyname = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['user_id'], 'status' => 1))->row()->company_name;
                                                            $slugname = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['user_id'], 'status' => 1))->row()->business_slug;
                                                            $categoryid = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['user_id'], 'status' => 1))->row()->industriyal;
                                                            $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;

                                                            $companynameposted = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['posted_user_id']))->row()->company_name;

                                                            $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $busienss_data[0]['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                            ?>

                                                            <li>
                                                            </li>

                                                            <?php if ($busienss_data[0]['posted_user_id']) { ?>
                                                                <li>
                                                                    <div class="else_post_d">
                                                                        <div class="post-design-product">
                                                                            <a class="post_dot_2" href="<?php echo base_url('business-profile/dashboard/' . $slugnameposted); ?>"><?php echo ucwords($companynameposted); ?></a>
                                                                            <p class="posted_with" > Posted With </p> <a class="other_name name_business"  href="<?php echo base_url('business-profile/dashboard/' . $slugname); ?>"><?php echo ucwords($companyname); ?></a>
                                                                            <span role="presentation" aria-hidden="true"> · </span> <span class="ctre_date"  >
                                                                                <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($busienss_data[0]['created_date']))); ?>  

                                                                            </span> </div></div>
                                                                </li>
                                                            <?php } else { ?>
                                                                <li>
                                                                    <div class="post-design-product">
                                                                        <a class="post_dot"  href="<?php echo base_url('business-profile/dashboard/' . $slugname); ?>" title="<?php echo ucwords($companyname); ?>";>
                                                                            <?php echo ucwords($companyname); ?>  </a>
                                                                        <span role="presentation" aria-hidden="true"> · </span>
                                                                        <div class="datespan"> <span class="ctre_date" > 
                                                                                <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($busienss_data[0]['created_date']))); ?>

                                                                            </span></div>

                                                                    </div>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <div class="post-design-product">
                                                                    <a class="buuis_desc_a" href="javascript:void(0);"  title="Category">
                                                                        <?php
                                                                        if ($category) {
                                                                            echo ucwords($category);
                                                                        } else {
                                                                            echo ucwords($busienss_data[0]['other_industrial']);
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
                                                        <a onClick="myFunction(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v">
                                                        </a>
                                                        <div id="<?php echo "myDropdown" . $busienss_data[0]['business_profile_post_id']; ?>" class="dropdown-content1">

                                                            <?php
                                                            if ($busienss_data[0]['posted_user_id'] != 0) {

                                                                if ($this->session->userdata('aileenuser') == $busienss_data[0]['posted_user_id']) {
                                                                    ?>
                                                                    <a onclick="user_postdelete(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)">
                                                                        <i class="fa fa-trash-o" aria-hidden="true">
                                                                        </i> Delete Post
                                                                    </a>
                                                                    <a id="<?php echo $busienss_data[0]['business_profile_post_id']; ?>" onClick="editpost(this.id)">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                                        </i>Edit
                                                                    </a>

                                                                <?php } else {
                                                                    ?>

                                                                    <a onclick="user_postdelete(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)">
                                                                        <i class="fa fa-trash-o" aria-hidden="true">
                                                                        </i> Delete Post
                                                                    </a>
                                                                    <a href="<?php echo base_url('business-profile/contact-person/' . $busienss_data[0]['posted_user_id'] . ''); ?>">
                                                                        <i class="fa fa-user" aria-hidden="true">
                                                                        </i> Contact Person
                                                                    </a>

                                                                    <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <?php if ($this->session->userdata('aileenuser') == $busienss_data[0]['user_id']) { ?> 
                                                                    <a onclick="user_postdelete(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)">
                                                                        <i class="fa fa-trash-o" aria-hidden="true">
                                                                        </i> Delete Post
                                                                    </a>
                                                                    <a id="<?php echo $busienss_data[0]['business_profile_post_id']; ?>" onClick="editpost(this.id)">
                                                                        <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                                        </i>Edit
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a onclick="user_postdeleteparticular(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)">
                                                                        <i class="fa fa-trash-o" aria-hidden="true">
                                                                        </i> Delete Post
                                                                    </a>

                                                                    <a href="<?php echo base_url('business-profile/contact-person/' . $busienss_data[0]['user_id'] . ''); ?>">
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
                                                            <div id="<?php echo 'editpostdata' . $busienss_data[0]['business_profile_post_id']; ?>" style="display:block;">
                                                                <a >
                                                                    <?php echo $this->common->make_links($busienss_data[0]['product_name']); ?>
                                                                </a>
                                                            </div>
                                                            <div id="<?php echo 'editpostbox' . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none;">
                                                                <input type="text" id="<?php echo 'editpostname' . $busienss_data[0]['business_profile_post_id']; ?>" name="editpostname" placeholder="Product Name" value="<?php echo $busienss_data[0]['product_name']; ?>">
                                                            </div>
                                                        </div>                    


                                                        <div id="<?php echo "khyati" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:block;">
                                                            <?php
                                                            $small = substr($busienss_data[0]['product_description'], 0, 180);
                                                            echo $small;
                                                            if (strlen($busienss_data[0]['product_description']) > 180) {
                                                                echo '... <span id="kkkk" onClick="khdiv(' . $busienss_data[0]['business_profile_post_id'] . ')">View More</span>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div id="<?php echo "khyatii" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none;">
                                                            <?php
                                                            echo $busienss_data[0]['product_description'];
                                                            ?>
                                                        </div>
                                                        <div id="<?php echo 'editpostdetailbox' . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none;">
                                                            <div contenteditable="true" id="<?php echo 'editpostdesc' . $busienss_data[0]['business_profile_post_id']; ?>" placeholder="Product Description" class="textbuis  editable_text"  name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $busienss_data[0]['product_description']; ?></div>                  
                                                        </div>
                                                        <button class="fr" id="<?php echo "editpostsubmit" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none;margin: 5px 0; border-radius: 3px;" onClick="edit_postinsert(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)">Save
                                                        </button>

                                                    </div> 
                                                </div>
                                                <div class="post-design-mid col-md-12 padding_adust" >
                                                    <!-- multiple image code  start-->
                                                    <div>
                                                        <?php
                                                        $contition_array = array('post_id' => $busienss_data[0]['business_profile_post_id'], 'is_deleted' => '1', 'insert_profile' => '2');
                                                        $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_files', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        ?>
                                                        <?php if (count($businessmultiimage) == 1) { ?>
                                                            <?php
                                                            $allowed = array('gif', 'png', 'jpg');
                                                            $allowespdf = array('pdf');
                                                            $allowesvideo = array('mp4', 'webm');
                                                            $allowesaudio = array('mp3');
                                                            $filename = $businessmultiimage[0]['file_name'];
                                                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                            if (in_array($ext, $allowed)) {
                                                                ?>
                                                                <!-- one image start -->
                                                                <div class="one-image">
                                                                    <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                        <img src="<?php echo base_url($this->config->item('bus_post_image_upload_path') . $businessmultiimage[0]['file_name']) ?>"> 
                                                                    </a>
                                                                </div>
                                                                <!-- one image end -->
                                                            <?php } elseif (in_array($ext, $allowespdf)) { ?>
                                                                <!-- one pdf start -->
                                                                <div>
                                                                    <a title="click to open" href="<?php echo base_url('business_profile/creat_pdf/' . $businessmultiimage[0]['post_files_id']) ?>"><div class="pdf_img">
                                                                            <img src="<?php echo base_url('images/PDF.jpg') ?>" style="height: 100%; width: 100%;">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <!-- one pdf end -->
                                                            <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                                                                <!-- one video start -->
                                                                <div>
                                                                    <video width="100%" height="350" controls>
                                                                        <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['file_name']); ?>" type="video/mp4">
                                                                        <source src="movie.ogg" type="video/ogg">
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
                                                                            <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['file_name']); ?>" type="audio/mp3">
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
                                                                <div class="two-images">
                                                                    <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                        <img class="two-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['file_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                    </a>
                                                                </div>
                                                                <!-- two image end -->
                                                            <?php } ?>
                                                        <?php } elseif (count($businessmultiimage) == 3) { ?>
                                                            <!-- three image start -->
                                                            <div class="three-image-top" >
                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                    <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['file_name']) ?>" style="width: 100%; height:100%; "> 
                                                                </a>
                                                            </div>
                                                            <div class="three-image" >
                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                    <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['file_name']) ?>" style="width: 100%; height:100%; "> 
                                                                </a>
                                                            </div>
                                                            <div class="three-image" >
                                                                <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_post_id']) ?>">
                                                                    <img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['file_name']) ?>" style="width: 100%; height:100%; "> 
                                                                </a>
                                                            </div>
                                                            <!-- three image end -->
                                                        <?php } elseif (count($businessmultiimage) == 4) { ?>
                                                            <?php
                                                            foreach ($businessmultiimage as $multiimage) {
                                                                ?>
                                                                <!-- four image start -->
                                                                <div class="four-image" >
                                                                    <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                        <img class="breakpoint" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['file_name']) ?>" style="width: 100%; height: 100%;"> 
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
                                                                <div>
                                                                    <div class="four-image" >
                                                                        <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                            <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['file_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                        </a>
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
                                                                <div class="four-image" >
                                                                    <a href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>">
                                                                        <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['file_name']) ?>" style="width: 100%; height: 100%;"> 
                                                                    </a>
                                                                    <a class="text-center" href="<?php echo base_url('business_profile/postnewpage/' . $busienss_data[0]['business_profile_post_id']) ?>" >
                                                                        <div class="more-image" >
                                                                            <span>View All (+
                                                                                <?php echo (count($businessmultiimage) - 4); ?>)</span>
                                                                        </div>
                                                                    </a>
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
                                                        <ul class="col-md-6 col-sm-6 col-xs-6">
                                                            <li class="<?php echo 'likepost' . $busienss_data[0]['business_profile_post_id']; ?>">
                                                                <a id="<?php echo $busienss_data[0]['business_profile_post_id']; ?>" class="ripple like_h_w"  onClick="post_like(this.id)">
                                                                    <?php
                                                                    $userid = $this->session->userdata('aileenuser');
                                                                    $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1');
                                                                    $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    $likeuser = $this->data['active'][0]['business_like_user'];
                                                                    $likeuserarray = explode(',', $active[0]['business_like_user']);
                                                                    if (!in_array($userid, $likeuserarray)) {
                                                                        ?>               

                                                                        <i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>
                                                                    <?php } else { ?> 
                                                                        <i class="fa fa-thumbs-up fa-1x main_color" aria-hidden="true"></i>
                                                                    <?php } ?>
                                                                    <span class="like_As_count">
                                                                        <?php
                                                                        if ($busienss_data[0]['business_likes_count'] > 0) {
                                                                            echo $busienss_data[0]['business_likes_count'];
                                                                        }
                                                                        ?>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li id="<?php echo "insertcount" . $busienss_data[0]['business_profile_post_id']; ?>" style="visibility:show">
                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                ?>
                                                                <a  onClick="commentall(this.id)" id="<?php echo $busienss_data[0]['business_profile_post_id']; ?>" class="ripple like_h_w">
                                                                    <i class="fa fa-comment-o" aria-hidden="true"> 
                                                                        <?php
                                                                        ?>
                                                                    </i> 
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <ul class="col-md-6 col-sm-6 col-xs-6 like_cmnt_count">
                                                            <li>
                                                                <div class="like_count_ext">
                                                                    <span class="comment_count<?php echo $busienss_data[0]['business_profile_post_id']; ?>" > 
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
                                                                    <span class="comment_like_count<?php echo $busienss_data[0]['business_profile_post_id']; ?>"> 
                                                                        <?php
                                                                        if ($busienss_data[0]['business_likes_count'] > 0) {
                                                                            echo $busienss_data[0]['business_likes_count'];
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
                                                if ($busienss_data[0]['business_likes_count'] > 0) {
                                                    ?>
                                                    <div class="likeduserlist<?php echo $busienss_data[0]['business_profile_post_id'] ?>">
                                                        <?php
                                                        $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                        $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        $likeuser = $commnetcount[0]['business_like_user'];
                                                        $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                        $likelistarray = explode(',', $likeuser);
                                                        foreach ($likelistarray as $key => $value) {
                                                            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                        }
                                                        ?>
                                                        <!-- pop up box end-->
                                                        <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $busienss_data[0]['business_profile_post_id']; ?>);">
                                                            <?php
                                                            $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
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

                                                <div class="<?php echo "likeusername" . $busienss_data[0]['business_profile_post_id']; ?>" id="<?php echo "likeusername" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none">
                                                    <?php
                                                    $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                    $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                    $likeuser = $commnetcount[0]['business_like_user'];
                                                    $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                    $likelistarray = explode(',', $likeuser);
                                                    foreach ($likelistarray as $key => $value) {
                                                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                    }
                                                    ?>
                                                    <!-- pop up box end-->
                                                    <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $busienss_data[0]['business_profile_post_id']; ?>);">
                                                        <?php
                                                        $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
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
                                                    <div  id="<?php echo "fourcomment" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:none;">
                                                    </div>
                                                    <!-- khyati changes start -->
                                                    <div  id="<?php echo "threecomment" . $busienss_data[0]['business_profile_post_id']; ?>" style="display:block">
                                                        <div class="<?php echo 'insertcomment' . $busienss_data[0]['business_profile_post_id']; ?>">
                                                            <?php
                                                            $contition_array = array('business_profile_post_id' => $busienss_data[0]['business_profile_post_id'], 'status' => '1');
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
                                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugname1); ?>">

                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt=""> </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business-profile/dashboard/' . $slugname1); ?>">

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
                                                                            $new_product_comment = $this->common->make_links($rowdata['comments']);
                                                                            echo nl2br(htmlspecialchars_decode(htmlentities($new_product_comment, ENT_QUOTES, 'UTF-8')));
                                                                            ?>
                                                                        </div>
                                                                        <div class="edit-comment-box">
                                                                            <div class="inputtype-edit-comment">
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
                                                                                        <i class="fa fa-thumbs-up fa-1x" aria-hidden="true">
                                                                                        </i> 
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
                                                        <div contenteditable="true" class="edt_2 editable_text" name="<?php echo $busienss_data[0]['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $busienss_data[0]['business_profile_post_id']; ?>" placeholder="Add a Comment ..." onClick="entercomment(<?php echo $busienss_data[0]['business_profile_post_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>
                                                    </div>
                                                    <?php echo form_error('post_comment'); ?> 
                                                    <div class="comment-edit-butn">       
                                                        <button id="<?php echo $busienss_data[0]['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment
                                                        </button>
                                                    </div>

                                                </div>
                                                <!-- comment end -->
                                            </div>
                                        </div></div>
                                    <?php
                                } else if ($businessdelete[0]['is_delete'] == '1') {
                                    ?>

                                    <div class="text-center rio">
                                        <h4 class="page-heading  product-listing" >Sorry, this content isn't available at the moment.</h4>
                                    </div>

                                    <?php
                                }
                            } else {
                                ?>

                                <div class="text-center rio">
                                    <h4 class="page-heading  product-listing" >No Post Found.</h4>
                                </div>

                            <?php } ?>
                            <!-- body content end-->
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
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
                                                            var base_url = '<?php echo base_url(); ?>';
                                                            var data = <?php echo json_encode($demo); ?>;
                                                            var data1 = <?php echo json_encode($city_data); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/notification/business_post.js'); ?>"></script>