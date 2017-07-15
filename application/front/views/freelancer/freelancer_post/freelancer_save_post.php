<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <style type="text/css">
            #popup-form img{display: none;}
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">

    </head>
    <body class="page-container-bg-solid page-boxed">
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2_border; ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result set-btn" onclick="" >Cancel</button>

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
                        $image = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>
                            <img src="<?php echo base_url($this->config->item('free_post_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             <?php }
                             ?>
                    </div>
                </div>
            </div>
            <div class="container tablate-container art-profile">
                <div class="upload-img">
                    <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                        <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                    </label>
                </div>
                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php if ($jobdata[0]['freelancer_post_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $jobdata[0]['freelancer_post_user_image']); ?>" alt="" >
                            <?php } else { ?>
                                <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                        </div>
                    </div>      
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);"> <h3> <?php echo ucwords($freepostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freepostdata[0]['freelancer_post_username']); ?></h3></a>
                        <div class="profile-text">
                            <?php
                            if ($freepostdata[0]['designation'] == "") {
                                ?> 
                                <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freepostdata[0]['designation']); ?>"><?php echo ucwords($freepostdata[0]['designation']); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr"> 
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freepostdata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">
                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile')) { ?> class="active" <?php } ?>><a title="Freelancer Details" href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>">Details</a>
                                    </li>
                                    <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile' || $this->uri->segment(2) == 'freelancer_apply_post' || $this->uri->segment(2) == 'freelancer_save_post' || $this->uri->segment(2) == 'freelancer_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save_post')) { ?> class="active" <?php } ?>><a title="Saved" href="<?php echo base_url('freelancer/freelancer_save_post'); ?>">Saved Post</a>
                                        </li>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_applied_post')) { ?> class="active" <?php } ?>><a title="Applied Post" href="<?php echo base_url('freelancer/freelancer_applied_post'); ?>">Applied Post</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="middle-part container">
                    <div class="job-menu-profile mob-none pt20">
                        <a href="javascript:void(0);"> <h5> <?php echo ucwords($freepostdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freepostdata[0]['freelancer_post_username']); ?></h5></a>
                        <div class="profile-text">
                            <?php
                            if ($freepostdata[0]['designation'] == "") {
                                ?> 
                                <a id="designation" class="designation" title="Designation">Designation</a>
                                <?php
                            } else {
                                ?> 
                                <a id="designation" class="designation" title="<?php echo ucwords($freepostdata[0]['designation']); ?>"><?php echo ucwords($freepostdata[0]['designation']); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-xs-12 mob-clear">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Saved Posts</h3>
                                <div class="contact-frnd-post">
                                    <?php

                                    function text2link($text) {
                                        $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                        $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                        $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                        return $text;
                                    }
                                    ?>
                                    <?php
                                    if ($postdetail) {
                                        foreach ($postdetail as $post) {
                                            $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                            $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                            $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                            if ($freelancerapply1) {
                                                ?>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="job-contact-frnd ">
                                                    <div class="profile-job-post-detail clearfix" id="<?php echo "postdata" . $post['app_id']; ?>">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-post-title-inside clearfix">
                                                                <div class="profile-job-post-title clearfix margin_btm">
                                                                    <div class="profile-job-profile-button clearfix">
                                                                        <div class="profile-job-details col-md-12">
                                                                            <ul>
                                                                                <li class="fr">
                                                                                    Created Date : <?php echo trim(date('d-M-Y', strtotime($post['created_date']))); ?>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="#" title="<?php echo ucwords(text2link($post['post_name'])); ?>" class="post_title">
                                                                                        <?php echo ucwords(text2link($post['post_name'])); ?> </a> </li>
                                                                                <?php
                                                                                $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                ?>
                                                                                <li><a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                                    </a>
                                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                                    <?php if ($cityname || $countryname) { ?>

                                                                                        <div class="fr lction">

                                                                                            <p title="Location">
                                                                                                <i class="fa fa-map-marker" aria-hidden="true">  <?php
                                                                                                    if ($cityname) {
                                                                                                        echo $cityname . ",";
                                                                                                    }
                                                                                                    ?><?php
                                                                                                    if ($countryname) {
                                                                                                        echo $countryname;
                                                                                                    }
                                                                                                    ?></i></p>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="profile-job-profile-menu">
                                                                        <ul class="clearfix">
                                                                            <li> <b> Field</b> <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>

                                                                                </span>
                                                                            </li>
                                                                            <li> <b> Skills</b> <span> 
                                                                                    <?php
                                                                                    $comma = ", ";
                                                                                    $k = 0;
                                                                                    $aud = $post['post_skill'];
                                                                                    $aud_res = explode(',', $aud);
                                                                                    if (!$post['post_skill']) {
                                                                                        echo $post['post_other_skill'];
                                                                                    } else if (!$post['post_other_skill']) {
                                                                                        foreach ($aud_res as $skill) {
                                                                                            if ($k != 0) {
                                                                                                echo $comma;
                                                                                            }
                                                                                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;

                                                                                            echo $cache_time;
                                                                                            $k++;
                                                                                        }
                                                                                    } else if ($post['post_skill'] && $post['post_other_skill']) {
                                                                                        foreach ($aud_res as $skill) {
                                                                                            if ($k != 0) {
                                                                                                echo $comma;
                                                                                            }
                                                                                            $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                            echo $cache_time;
                                                                                            $k++;
                                                                                        } echo "," . $post['post_other_skill'];
                                                                                    }
                                                                                    ?>     

                                                                                </span>
                                                                            </li>
                                                                            <li><b>Post Description</b><span><p>
                                                                                        <?php
                                                                                        if ($post['post_description']) {
                                                                                            echo text2link($post['post_description']);
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?> </p></span>
                                                                            </li>
                                                                            <li><b>Rate</b><span>
                                                                                    <?php
                                                                                    if ($post['post_rate']) {
                                                                                        echo $post['post_rate'];
                                                                                        echo "&nbsp";
                                                                                        echo $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                                                        echo "&nbsp";
                                                                                        if ($post['post_rating_type'] == 1) {
                                                                                            echo "Hourly";
                                                                                        } else {
                                                                                            echo "Fixed";
                                                                                        }
                                                                                    } else {
                                                                                        echo PROFILENA;
                                                                                    }
                                                                                    ?></span>
                                                                            </li>
                                                                            <li>
                                                                                <b>Required Experience</b>
                                                                                <span>
                                                                                    <?php
                                                                                    if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                                       if ($post['post_exp_year'] != '0') {
                                                                                                    echo $post['post_exp_year'];
                                                                                                }
                                                                                                if ($post['post_exp_month'] != '0') {
                                                                                                    echo ".";
                                                                                                    echo $post['post_exp_month'];
                                                                                                }
                                                                                                echo ' Year ';
                                                                                            } else {

                                                                                                echo PROFILENA;
                                                                                            }
                                        
                                                                                    ?>
                                                                                </span>
                                                                            </li>
                                                                            <li><b>Estimated Time</b><span> <?php
                                                                                    if ($post['post_est_time']) {
                                                                                        echo $post['post_est_time'];
                                                                                    } else {
                                                                                        echo PROFILENA;
                                                                                    }
                                                                                    ?></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="profile-job-profile-button clearfix">
                                                                        <div class="profile-job-details col-md-12">
                                                                            <ul>
                                                                                <li class="job_all_post last_date">
                                                                                    Last Date : <?php
                                                                                    if ($post['post_last_date']) {
                                                                                        echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                                    } else {
                                                                                        echo PROFILENA;
                                                                                    }
                                                                                    ?>                                                          </li>
                                                                                <li class=fr>
                                                                                    <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $post['app_id'] ?>)">Remove</a>
                                                                                    <?php
                                                                                    $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                                    $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                                    $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                    if ($freelancerapply1) {
                                                                                        ?>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>

                                                                                        <a href="javascript:void(0);" class="button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['app_id'] ?>)">Apply</a>
                                                                                    </li> 
                                                                                <?php } ?>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="text-center rio">
                                        <h4 class="page-heading  product-listing">No Saved Posts Found.</h4>
                                    </div>
                                <?php } ?>
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
                                <?php echo form_open_multipart(base_url('freelancer/user_image_add'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" />
                                </div>
                                <input type="hidden" name="hitext" id="hitext" value="2">
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save"  >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script>

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
                                                                                    }
                                                                                    ,
                                                                                    focus: function (event, ui) {
                                                                                        event.preventDefault();
                                                                                        $("#tags").val(ui.item.label);
                                                                                    }
                                                                                });
                                                                            });

        </script>
        <script>

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
                    }
                    ,
                    focus: function (event, ui) {
                        event.preventDefault();
                        $("#searchplace").val(ui.item.label);
                    }
                });
            });

        </script>
        <script>
            function myFunction() {
                document.getElementById("upload-demo").style.visibility = "hidden";
                document.getElementById("upload-demo-i").style.visibility = "hidden";
                document.getElementById('message1').style.display = "block";
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

                        url: "<?php echo base_url() ?>freelancer/ajaxpro_work",
                        type: "POST",
                        data: {"image": resp},
                        success: function (data) {
                            html = '<img src="' + resp + '" />';
                            if (html) {
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


            $('#upload').on('change', function () {
                var fd = new FormData();
                fd.append("image", $("#upload")[0].files[0]);
                files = this.files;
                size = files[0].size;
                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    picpopup();
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";
                    $("#upload").val('');
                    return false;
                }

                if (size > 26214400)
                {
                    alert("Allowed file size exceeded. (Max. 25 MB)")
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";
                    return false;
                }
                $.ajax({

                    url: "<?php echo base_url(); ?>freelancer/image_work",
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
        <script type="text/javascript">

            // <!-- remove save post start -->

            function remove_post(abc)
            {
                var    savepara    =    'save';
                $.ajax({
                    type:    'POST',
                    url:    '<?php echo base_url() . "freelancer/freelancer_delete_apply" ?>',
                    data: 'app_id=' + abc + '&para=' + savepara,
                    success: function (data) {
                        $('#' + 'postdata' + abc).html(data);
                        $('#' + 'postdata' + abc).parent().removeClass();
                        var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                        if (numItems == '0') {
                            var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Posts Found.</h4></div>";
                            $('.contact-frnd-post').html(nodataHtml);
                        }
                    }
                });
            }

            function apply_post(abc, xyz)
            {
            var alldata = 'all';
                    var user = <?php echo $aileenuser_id; ?>;
                    var appid = xyz;
                    $.ajax({
                    type: 'POST',
                            url: '<?php echo base_url() . "freelancer/apply_insert" ?>',
                            data: 'post_id=' + abc + '&allpost=' + alldata.value + '&userid=' + user.value,
                            success: function (data) {
                            $('#' + 'postdata' + appid).html(data);
                                    $('#' + 'postdata' + appid).parent().removeClass();
                                    var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                                    if (numItems == '0') {
                            var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Job Found.</h4></div>";
                                    $('.contact-frnd-post').html(nodataHtml);
                            }

  }
               });
               }
        </script>
        <script>
                            function updateprofilepopup(id) {
                            $('#bidmodal-2').modal('show');
                            }
        </script>

        <script type="text/javascript">
                            function checkvalue() {
                            var searchkeyword = $.trim(document.getElementById('tags').value);
                                    var searchplace = $.trim(document.getElementById('searchplace').value);
                                    if (searchkeyword == "" && searchplace == "") {
                            return  false;
                            }
                            }
        </script> 
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script>
                                    function removepopup(id) {
                                    $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                            $('#bidmodal').modal('show');
                                    }
                            function applypopup(postid, appid) {
                            $('.biderror .mes').html("<div class='pop_content'>Do you want to apply for this work?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + appid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                    $('#bidmodal').modal('show');
                            }
        </script>
        <script>
                            function divClicked() {
                            var divHtml = $(this).html();
                                    var editableText = $("<textarea/>");
                                    editableText.val(divHtml);
                                    $(this).replaceWith(editableText);
                                    editableText.focus();
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
                                    url: "<?php echo base_url(); ?>freelancer/designation",
                                            type: "POST",
                                            data: {"designation": html},
                                            success: function (response) {
                                            }
                                    });
                            }
                            $(document).ready(function () {
                            $("a.designation").click(divClicked);
                            });
        </script>
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

                            $("#profilepic").change(function () {
                            profile = this.files;
                                    if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                            $('#profilepic').val('');
                                    picpopup();
                                    return false;
                            } else {
                            readURL(this);
                            }
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
                                    $('.biderror .mes').html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)");
                                            $('#bidmodal').modal('show');
                                    }
        </script>
        <!-- all popup close close using esc start -->
        <script type="text/javascript">
                            $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                            $('#bidmodal').modal('hide');
                            }
                            });
                                    $(document).on('keydown', function (e) {
                            if (e.keyCode === 27) {
                            $('#bidmodal-2').modal('hide');
                            }
                            });
        </script>
        <!-- all popup close close using esc end -->
        <!--//For Scroll page at perticular position js Start-->
        <script type="text/javascript">
                                    $(document).ready(function () {
                            $('html,body').animate({scrollTop: 265}, 100);
                            });
        </script>
        <!--//For Scroll page at perticular position js End-->
    </body>
</html>