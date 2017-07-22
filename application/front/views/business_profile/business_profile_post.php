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
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <style>
            .progress 
            {
                display:none; 
                position:relative; 
                width:100%; 
                border: 1px solid #ddd; 
                padding: 1px; 
                border-radius: 3px; 
                height: 23px;
            }
            .bar 
            { 
                background-color: #1b8ab9; 
                width:0%; 
                height:20px; 
                border-radius: 3px; 
            }
            .percent 
            { 
                position:absolute; 
                display:inline-block; 
                top:3px; 
                left:48%; 
            }
        </style>
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
                        <div class="col-md-4  animated fadeInLeftBig profile-box profile-box-custom">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('business-profile/dashboard'); ?>"
                                               tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $businessdata[0]['company_name']; ?>">
                                                <!-- BOX IMAGE START -->
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

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('business-profile/dashboard'); ?>" title="<?php echo $businessdata[0]['company_name']; ?>" tabindex="-1" aria-hidden="true" rel="noopener" >
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
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a  href="<?php echo base_url('business-profile/dashboard/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>"> 
                                                        <?php echo ucwords($businessdata[0]['company_name']); ?>
                                                    </a> 
                                                </span>

                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('business-profile/dashboard/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>" >
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
                                                        <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'dashboard') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a  class="padding_less_left" title="Dashboard" href="<?php echo base_url('business-profile/dashboard'); ?>">Dashboard
                                                        </a>
                                                    </li>
                                                    <li 
                                                        <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'followers') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a title="Followers" href="<?php echo base_url('business-profile/followers'); ?>">Followers 
                                                            <br> (<?php echo (count($businessfollowerdata)); ?>)
                                                        </a>
                                                    </li>
                                                    <li  
                                                        <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'following') { ?> class="active" 
                                                        <?php } ?>>
                                                        <a  class="padding_less_right" title="Following" href="<?php echo base_url('business-profile/following/' . $businessdata[0]['business_slug']); ?>">Following 
                                                            <br> (<?php echo (count($businessfollowingdata)); ?>) 
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <div class="full-box-module_follow">
                                    <!-- follower list start  -->  
                                    <div class="common-form">
                                        <h3 class="user_list_head">User List
                                        </h3>
                                        <div class="seeall">
                                            <a href="<?php echo base_url('business-profile/userlist/' . $businessdata[0]['business_slug']); ?>">All User
                                            </a>
                                        </div>
                                    </div>
                                    <!-- GET USER FOLLOE SUGESSION LIST START [AJAX DATA DISPLAY UNDER profile-boxProfileCard_follow CLASS]-->
                                    <div class="profile-boxProfileCard_follow  module">

                                    </div>
                                    <!-- GET USER FOLLOE SUGESSION LIST START -->
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
                                    <?php echo form_open_multipart(base_url('business-profile/bussiness-profile-post-add'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "return imgval(event)")); ?>
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
                                            <textarea id="test-upload-product" placeholder="<?php echo $this->lang->line("post_your_product"); ?>"  onKeyPress=check_length(this.form); onKeyUp=check_length(this.form); onKeyDown=check_length(this.form); onblur=check_length(this.form);  name=my_text rows=4 cols=30 class="post_product_name" style=" position: relative;" tabindex="1"></textarea>
                                            <div class="fifty_val">                       
                                                <input size=1 value=50 name=text_num class="text_num"  readonly> 
                                            </div>
                                            <div class="camera_in padding-left padding_les_left camer_h">
                                                <i class=" fa fa-camera" >
                                                </i> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row"></div>
                                    <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                        <textarea id="test-upload-des" name="product_desc" class="description" placeholder="Enter Description" tabindex="2"></textarea>
                                    </div>
                                    <div class="print_privew_post">
                                    </div>
                                    <div class="preview">
                                    </div>
                                    <div id="data-vid" class="large-8 columns">
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
                                                <div class="col-md-12"> 
                                                    <div class="form-group">
                                                        <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                                    </div>
                                                </div>
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
                            </div>
                            <!-- body content start-->
                            <!-- ALL POST DATA DISPLAY IN TO business-all-post CLASS AFTER CALL AJAX -->
                            <!--                      video tag   khytai chndge 8-7    <div>
                            <video width="100%" height="350" controls>
                         <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/mp4">
                        <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']); ?>" type="video/ogg">
                             Your browser does not support the video tag.
                                 </video>
                        </div>-->
                            <div class='progress' id="progress_div">
                                <div class='bar' id='bar'></div>
                                <div class='percent' id='percent'>0%</div>
                            </div>
                            <div class="business-all-post">
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
                    <button type="button" class="modal-close1" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes"></span>
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
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bid-modal for this modal appear or not  Popup Close -->

 <div class="modal fade message-box" id="postedit" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- POST BOX JAVASCRIPT START --> 
        <script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
        <!-- POST BOX JAVASCRIPT END --> 

        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 

        <script>
// SECOND HEADER SEARCH SCRIPT
                                                jQuery.noConflict();
                                                (function ($) {

                                                    var data = <?php echo json_encode($demo); ?>;
                                                    $(function () {
                                                        $("#tags").autocomplete({
                                                            source: function (request, response) {
                                                                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                response($.grep(data, function (item) {
                                                                    return matcher.test(item.label);
                                                                }));
                                                            },
                                                            minLength: 1,
                                                            select: function (event, ui) {
                                                                event.preventDefault();
                                                                $("#tags").val(ui.item.label);
                                                                $("#selected-tag").val(ui.item.label);
                                                            },
                                                            focus: function (event, ui) {
                                                                event.preventDefault();
                                                                $("#tags").val(ui.item.label);
                                                            }
                                                        });
                                                    });

                                                    var data1 = <?php echo json_encode($city_data); ?>;
                                                    $(function () {
                                                        $("#searchplace").autocomplete({
                                                            source: function (request, response) {
                                                                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                response($.grep(data1, function (item) {
                                                                    return matcher.test(item.label);
                                                                }));
                                                            },
                                                            minLength: 1,
                                                            select: function (event, ui) {
                                                                event.preventDefault();
                                                                $("#searchplace").val(ui.item.label);
                                                                $("#selected-tag").val(ui.item.label);
                                                            },
                                                            focus: function (event, ui) {
                                                                event.preventDefault();
                                                                $("#searchplace").val(ui.item.label);
                                                            }
                                                        });
                                                    });


                                                })(jQuery);

        </script>

        <script>
            $('#content').on('change keyup keydown paste cut', 'textarea', function () {
                $(this).height(0).height(this.scrollHeight);
            }).find('textarea').change();
        </script>

        <script type="text/javascript">
            function checkvalue() {
                var searchkeyword = $.trim(document.getElementById('tags').value);
                var searchplace = $.trim(document.getElementById('searchplace').value);
                if (searchkeyword == "" && searchplace == "") {
                    return false;
                }
            }
            /* POST LIKE SCRIPT START */
            function post_like(clicked_id)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/like_post" ?>',
                    data: 'post_id=' + clicked_id,
                    dataType: 'json',
                    success: function (data) {
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
            /* POST LIKE SCRIPT END */

            /* COMMENT INSERT SCRIPT START */

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
                txt = txt.replace(/&gt;/gi, ">");
                txt = txt.replace(/div/gi, "p");
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
                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
                            $('.comment_count' + clicked_id).html(data.comment_count);
                        }
                    });
                }
            }

            /* COMMENT INSERT SCRIPT END */

            /* INSERT COMMENT USING ENTER START */
            function entercomment(clicked_id)
            {
                $("#post_comment" + clicked_id).click(function () {
                    $(this).prop("contentEditable", true);
                });
                $('#post_comment' + clicked_id).keypress(function (e) {

                    if (e.keyCode == 13 && !e.shiftKey) {
                        e.preventDefault();
                        var sel = $("#post_comment" + clicked_id);
                        var txt = sel.html();
                        txt = txt.replace(/&nbsp;/gi, " ");
                        txt = txt.replace(/<br>$/, '');
                        txt = txt.replace(/&gt;/gi, ">");
                        txt = txt.replace(/div/gi, "p");
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
                                    $('#' + 'fourcomment' + clicked_id).html(data.comment);
                                    $('.comment_count' + clicked_id).html(data.comment_count);
                                }
                            });
                        }
                    }
                });
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
                });

            }
            /* INSERT COMMENT USING ENTER END */

            /* HIDE AND SHOW DATA START */
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
            }
            /* HIDE AND SHOW DATA END */

            /* COMMENT LIKE SCRIPT START */
            function comment_like(clicked_id)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/like_comment" ?>',
                    data: 'post_id=' + clicked_id,
                    success: function (data) {
                        $('#' + 'likecomment' + clicked_id).html(data);
                    }
                });
            }

            function comment_like1(clicked_id)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/like_comment1" ?>',
                    data: 'post_id=' + clicked_id,
                    success: function (data) {
                        $('#' + 'likecomment1' + clicked_id).html(data);
                    }
                });
            }
            /* COMMENT LIKE SCRIPT END */

            /* COMMENT DELETE SCRIPT START */
            function comment_delete(clicked_id) {
                $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                $('#bidmodal').modal('show');
            }

            function comment_deleted(clicked_id)
            {
                var post_delete = document.getElementById("post_delete" + clicked_id);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/delete_comment" ?>',
                    data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
                    dataType: "json",
                    success: function (data) {
                        $('.' + 'insertcomment' + post_delete.value).html(data.comment);
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
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/delete_commenttwo" ?>',
                    data: 'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
                    dataType: "json",
                    success: function (data) {
                        $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
                        $('.comment_count' + post_delete1.value).html(data.comment_count);
                        $('.post-design-commnet-box').show();
                    }
                });
            }
            /* COMMENT DELETE SCRIPT END */

            /* COMMENT EDIT BOX START */
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

            function comment_editbox3(clicked_id) {
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

            function comment_editbox4(clicked_id) {
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
            /* COMMENT EDIT BOX END */

            /* COMMENT EDIT INSERT START */
            function edit_comment(abc)
            {
                $("#editcomment" + abc).click(function () {
                    $(this).prop("contentEditable", true);
                });

                var sel = $("#editcomment" + abc);
                var txt = sel.html();
                txt = txt.replace(/&nbsp;/gi, " ");
                txt = txt.replace(/<br>$/, '');
                txt = txt.replace(/&gt;/gi, ">");
                txt = txt.replace(/div/gi, "p");
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

            function commentedit(abc)
            {
                $("#editcomment" + abc).click(function () {
                    $(this).prop("contentEditable", true);
                });
                $('#editcomment' + abc).keypress(function (event) {
                    if (event.which == 13 && event.shiftKey != 1) {
                        event.preventDefault();
                        var sel = $("#editcomment" + abc);
                        var txt = sel.html();
                        txt = txt.replace(/&nbsp;/gi, " ");
                        txt = txt.replace(/<br>$/, '');
                        txt = txt.replace(/&gt;/gi, ">");
                        txt = txt.replace(/div/gi, "p");
                        if (txt == '' || txt == '<br>') {
                            return false;
                        }
                        if (/^\s+$/gi.test(txt))
                        {
                            return false;
                        }
                        txt = txt.replace(/&/g, "%26");

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
            }

            function edit_commenttwo(abc)
            {
                $("#editcommenttwo" + abc).click(function () {
                    $(this).prop("contentEditable", true);
                });
                var sel = $("#editcommenttwo" + abc);
                var txt = sel.html();
                txt = txt.replace(/&nbsp;/gi, " ");
                txt = txt.replace(/<br>$/, '');
                txt = txt.replace(/&gt;/gi, ">");
                txt = txt.replace(/div/gi, "p");

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
            function commentedittwo(abc)
            {
                $("#editcommenttwo" + abc).click(function () {
                    $(this).prop("contentEditable", true);
                });

                $('#editcommenttwo' + abc).keypress(function (event) {
                    if (event.which == 13 && event.shiftKey != 1) {
                        event.preventDefault();

                        var sel = $("#editcommenttwo" + abc);
                        var txt = sel.html();

                        txt = txt.replace(/&nbsp;/gi, " ");
                        txt = txt.replace(/<br>$/, '');
                        txt = txt.replace(/&gt;/gi, ">");
                        txt = txt.replace(/div/gi, "p");

                        if (txt == '' || txt == '<br>') {
                            return false;
                        }
                        if (/^\s+$/gi.test(txt))
                        {
                            return false;
                        }
                        txt = txt.replace(/&/g, "%26");

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
                    }
                });
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
                });

            }
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
                                    document.getElementById('editcomment2' + abc).style.display = 'none';
                                    document.getElementById('showcomment2' + abc).style.display = 'block';
                                    document.getElementById('editsubmit2' + abc).style.display = 'none';
                                    document.getElementById('editcommentbox2' + abc).style.display = 'block';
                                    document.getElementById('editcancle2' + abc).style.display = 'none';
                                    $('#' + 'showcomment2' + abc).html(data);
                                }
                            });
                        }
                    });
                });
            }
            function edit_comment3(abc)
            {
                var post_comment_edit = document.getElementById("editcomment3" + abc);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
                    success: function (data) {
                        document.getElementById('editcomment3' + abc).style.display = 'none';
                        document.getElementById('showcomment3' + abc).style.display = 'block';
                        document.getElementById('editsubmit3' + abc).style.display = 'none';
                        document.getElementById('editcommentbox3' + abc).style.display = 'block';
                        document.getElementById('editcancle3' + abc).style.display = 'none';

                        $('#' + 'showcomment3' + abc).html(data);
                        $('.post-design-commnet-box').show();
                    }
                });
            }
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
                                success: function (data) {
                                    document.getElementById('editcomment3' + abc).style.display = 'none';
                                    document.getElementById('showcomment3' + abc).style.display = 'block';
                                    document.getElementById('editsubmit3' + abc).style.display = 'none';
                                    document.getElementById('editcommentbox3' + abc).style.display = 'block';
                                    document.getElementById('editcancle3' + abc).style.display = 'none';

                                    $('#' + 'showcomment3' + abc).html(data);
                                }
                            });
                        }
                    });
                });
            }
            function edit_comment4(abc)
            {
                var post_comment_edit = document.getElementById("editcomment4" + abc);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/edit_comment_insert" ?>',
                    data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
                    success: function (data) {
                        document.getElementById('editcomment4' + abc).style.display = 'none';
                        document.getElementById('showcomment4' + abc).style.display = 'block';
                        document.getElementById('editsubmit4' + abc).style.display = 'none';
                        document.getElementById('editcommentbox4' + abc).style.display = 'block';
                        document.getElementById('editcancle4' + abc).style.display = 'none';

                        $('#' + 'showcomment4' + abc).html(data);
                    }
                });
            }
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
                                success: function (data) {
                                    document.getElementById('editcomment4' + abc).style.display = 'none';
                                    document.getElementById('showcomment4' + abc).style.display = 'block';
                                    document.getElementById('editsubmit4' + abc).style.display = 'none';
                                    document.getElementById('editcommentbox4' + abc).style.display = 'block';
                                    document.getElementById('editcancle4' + abc).style.display = 'none';

                                    $('#' + 'showcomment4' + abc).html(data);
                                }
                            });
                        }
                    });
                });
            }
            /* COMMENT EDIT INSERT END */
            /* POST BOX 50 CHARACTER LIMITATION CHECK START */
            function check_length(my_form)
            {
                maxLen = 50;
                // max number of characters allowed
                if (my_form.my_text.value.length > maxLen) {
                    // Alert message if maximum limit is reached. 
                    // If required Alert can be removed. 
                    var msg = "You have reached your maximum limit of characters allowed";
                    $('.biderror .mes').html("<div class='pop_content'>" + msg + "</div>");
                    $('#bidmodal').modal('show');

                    // Reached the Maximum length so trim the textarea
                    my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
                } else {
                    // Maximum length not reached so update the value of my_text counter
                    my_form.text_num.value = maxLen - my_form.my_text.value.length;
                }
            }


     function check_lengthedit(abc)
    {
    maxLen = 50;
    var product_name = document.getElementById("editpostname" + abc).value;
    if (product_name.length > maxLen) {
    text_num = maxLen - product_name.length;
    var msg = "You have reached your maximum limit of characters allowed";
    $('#postedit .mes').html("<div class='pop_content'>" + msg + "</div>");
    $('#postedit').modal('show');
    var substrval = product_name.substring(0, maxLen);
    $('#editpostname' + abc).val(substrval);
    } else {
    text_num = maxLen - product_name.length;
    document.getElementById("text_num").value = text_num;
    }
    }
            /* POST BOX 50 CHARACTER LIMITATION CHECK END */
            /* SAVEPOST START */
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
            /* SAVEPOST END */
            /* FOLLOW USER SCRIPT START */
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
            function followclose(clicked_id)
            {
                $("#fad" + clicked_id).fadeOut(4000);
            }
            /* FOLLOW USER SCRIPT END */
        </script>
        <!-- POPUP BOX FOR POST START -->
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
        <!-- POPUP BOX FOR POST START -->
        <!-- DROP DOWN SCRIPT START -->
        <script>
            /* When the user clicks on the button, 
             toggle between hiding and showing the dropdown content */
            function myFunction(clicked_id) {
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
        <!-- DROP DOWN SCRIPT END -->
        <!-- MULTI IMAGE ADD POST START -->
        <script type="text/javascript">
            var $fileUpload = $("#files"),
                    $list = $('#list'),
                    thumbsArray = [],
                    maxUpload = 5;
            // READ FILE + CREATE IMAGE
            function read(f) {
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
                handleFileSelect(e);
            });
            $list.on('click', '.remove_thumb', function () {
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
        <script>
            $('#file-fr').fileinput({
                language: 'fr',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp','mp4','mp3','pdf']
            });
            $('#file-es').fileinput({
                language: 'es',
                uploadUrl: '#',
                allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp','mp4','mp3','pdf']
            });
            $("#file-0").fileinput({
                'allowedFileExtensions': ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp','mp4','mp3','pdf']
            });
            $("#file-1").fileinput({
                uploadUrl: '#', // you must set a valid URL here else you will get an error
                allowedFileExtensions: ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp','mp4','mp3','pdf'],
                overwriteInitial: false,
                maxFileSize: 1000000,
                maxFilesNum: 10,
                //allowedFileTypes: ['image','video', 'flash'],
                slugCallback: function (filename) {
                    return filename.replace('(', '_').replace(']', '_');
                }
            });
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
            $(document).ready(function () {
                $("#test-upload").fileinput({
                    'showPreview': false,
                    'allowedFileExtensions': ['jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp','mp4','mp3','pdf'],
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
            });
        </script>
        <!-- MULTI IMAGE ADD POST START -->
        <!-- POST DEVELOPING SCRIPT START -->
        <script type="text/javascript">
            function imgval(event) {
                var fileInput = document.getElementById("file-1").files;
                var product_name = document.getElementById("test-upload-product").value;
                var product_trim = product_name.trim();
                var product_description = document.getElementById("test-upload-des").value;
                var des_trim = product_description.trim();
                var product_fileInput = document.getElementById("file-1").value;
                if (product_fileInput == '' && product_trim == '' && des_trim == '')
                {
                    $('#post .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
                    $('#post').modal('show');
                    $(document).on('keydown', function (e) {
                        if (e.keyCode === 27) {
                            $('#bidmodal').modal('hide');
                            $('.modal-post').show();
                        }
                    });
                    event.preventDefault();
                    return false;
                } else {
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
                                $(document).on('keydown', function (e) {
                                    if (e.keyCode === 27) {
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

                                 if (product_name == '') {
    $('.biderror .mes').html("<div class='pop_content'>You have to add audio title.");
    $('#bidmodal').modal('show');
    //setInterval('window.location.reload()', 10000);

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
                                $('.biderror .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                                $('#bidmodal').modal('show');
                                setInterval('window.location.reload()', 10000);

                                $(document).on('keydown', function (e) {
                                    if (e.keyCode === 27) {
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
            //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open start
            $(document).ready(function () {
                $('#post').on('click', function () {
                    $('.modal-post').show();
                });
            });
            //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open end  
        </script>
        <!-- POST DEVELOPING SCRIPT END -->
        <script type="text/javascript">
            function contentedit(clicked_id) {
                $("#post_comment" + clicked_id).click(function () {
                    $(this).prop("contentEditable", true);
                    $(this).html("");
                });
                $("#post_comment" + clicked_id).keypress(function (event) {
                    if (event.which == 13 && event.shiftKey != 1) {
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
                                success: function (data) {
                                    $('input').each(function () {
                                        $(this).val('');
                                    }
                                    );
                                    $('#' + 'fourcomment' + clicked_id).html(data);
                                    $('.comment_count' + clicked_id).html(data.comment_count);
                                }
                            });
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
                    success: function (data) {
                        $('#' + 'removepost' + abc).remove();
                        if (data.notcount == 'count') {
                            $('.' + 'nofoundpost').html(data.notfound);
                        }
                        var nb = $('.post-design-box').length;
                        if (nb == 0) {
                            $("#dropdownclass").addClass("no-post-h2");
                        } else {
                            $("#dropdownclass").removeClass("no-post-h2");
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
                    success: function (data) {
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
                        document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                        document.getElementById('editpostsubmit' + abc).style.display = 'none';
                        document.getElementById('khyati' + abc).style.display = 'none';
                        document.getElementById('khyatii' + abc).style.display = 'block';
                        $('#' + 'editpostdata' + abc).html(data.title);
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
                var $field = $('#editpostdesc' + abc);
                var editpostdetails = $('#editpostdesc' + abc).html();
                editpostdetails = editpostdetails.replace(/&/g, "%26");
                editpostdetails = editpostdetails.replace(/&gt;/gi, ">");
                editpostdetails = editpostdetails.replace(/&nbsp;/gi, " ");
                editpostdetails = editpostdetails.replace(/div/gi, "p");

                if (editpostname.value == '' && editpostdetails == '') {
                    $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
                    $('#bidmodal').modal('show');

                    document.getElementById('editpostdata' + abc).style.display = 'block';
                    document.getElementById('editpostbox' + abc).style.display = 'none';
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
                            document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                            document.getElementById('editpostsubmit' + abc).style.display = 'none';
                            document.getElementById('khyati' + abc).style.display = 'block';
                            $('#' + 'editpostdata' + abc).html(data.title);
                            $('#' + 'khyati' + abc).html(data.description);
                            $('#' + 'postname' + abc).html(data.postname);

                        }
                    });
                }
            }
        </script>
        <!-- edit post end -->
        <script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                var bar = $('#bar');
                var percent = $('#percent');
                var options = {
                    beforeSend: function () {
                        // Replace this with your loading gif image
                        document.getElementById("progress_div").style.display = "block";
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        document.getElementById("myModal").style.display = "none";
//                        $(".business-all-post").prepend('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    success: function () {
                        var percentVal = '100%';
                        bar.width(percentVal)
                        percent.html(percentVal);

                    },
                    complete: function (response) {
                        // Output AJAX response to the div container


            document.getElementById('test-upload-product').value = null;
            document.getElementById('test-upload-des').value = null;

            $(".file-preview-frame").hide();


                        $('#progress_div').fadeOut('5000').remove();
                        // $('.loader').remove();
                        $('.business-all-post div:first').remove();
                        $(".business-all-post").prepend(response.responseText);
                        
                        // second header class add for scroll
                        var nb = $('.post-design-box').length;
                        if (nb == 0) {
                            $("#dropdownclass").addClass("no-post-h2");
                        } else {
                            $("#dropdownclass").removeClass("no-post-h2");
                        }
                        
                        $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top - 100}, 150);

                    }
                };
                // Submit the form
                $(".upload-image-form").ajaxForm(options);
                return false;
            });
        </script>
        <script>
            $(document).ready(function () {
                business_home_post();
                business_home_three_user_list()
            });
        </script>
        <script type="text/javascript">
            function business_home_post() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/business_home_post/" ?>',
                    data: '',
                    dataType: "html",
                    beforeSend: function () {
                        $(".business-all-post").prepend('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                    },
                    success: function (data) {
                        $('.loader').remove();
                        $('.business-all-post').html(data);

                        // second header class add for scroll
                        var nb = $('.post-design-box').length;
                        if (nb == 0) {
                            $("#dropdownclass").addClass("no-post-h2");
                        } else {
                            $("#dropdownclass").removeClass("no-post-h2");
                        }
                    }
                });
            }

            function business_home_three_user_list() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/business_home_three_user_list/" ?>',
                    data: '',
                    dataType: "html",
                    beforeSend: function () {
                        $(".profile-boxProfileCard_follow").html('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                    },
                    success: function (data) {
                        $('.loader').remove();
                        $('.profile-boxProfileCard_follow').html(data);
                    }
                });
            }
        </script>
        <!-- 180 words more than script start -->
        <script type="text/javascript">
            function seemorediv(abc) {
                document.getElementById('seemore' + abc).style.display = 'block';
                document.getElementById('lessmore' + abc).style.display = 'none';
            }
        </script>
        <!-- 180 words more than script end-->
        <script type="text/javascript">
            $(window).load(function () {
                var nb = $('.post-design-box').length;
                if (nb == 0) {
                    $("#dropdownclass").addClass("no-post-h2");
                }
            });
        </script>


        <script type="text/javascript">



    $('#postedit').on('click', function(){
    // $('.my_text').attr('readonly', false);
    });
    $(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
    //$( "#bidmodal" ).hide();
    $('#postedit').modal('hide');
    // $('.my_text').attr('readonly', false);

    //$('.modal-post').show();

    }
    });


</script>



<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#tags1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#tag1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#tags1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#searchplace1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data1, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>

          <script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>
    </body>
</html>
