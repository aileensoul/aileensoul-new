<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <style type="text/css">
            #popup-form img{display: none;}
        </style>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php
        $returnpage = $_GET['page'];
        if ($returnpage == 'freelancer_post') {
            echo $freelancer_post_header2_border;
        } else {
            echo $freelancer_hire_header2_border;
        }
        ?>
        <section class="custom-row">
            <div class="container" id="paddingtop_fixed">
                <div class="row" id="row1" style="display:none;">
                    <div class="col-md-12 text-center">
                        <div id="upload-demo" ></div>
                    </div>
                    <div class="col-md-12 cover-pic" >
                        <button class="btn btn-success  cancel-result" onclick="" >Cancel</button>
                        <button class="btn btn-success set-btn upload-result " onclick="myFunction()">Save</button>
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
                        $image = $this->common->select_data_by_condition('freelancer_hire_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $image_ori = $image[0]['profile_background'];
                        if ($image_ori) {
                            ?>
                            <img src="<?php echo base_url($this->config->item('free_hire_bg_main_upload_path') . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                            <?php
                        } else {
                            ?>
                                 <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
                             <?php }
                             ?>
                    </div>
                </div>
            </div>
            <div class="container tablate-container  art-profile">    

                <?php if ($returnpage == '') { ?>
                    <div class="upload-img">
                        <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
                            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
                        </label>
                    </div>
                <?php } ?>



                <div class="profile-photo">
                    <div class="profile-pho">
                        <div class="user-pic padd_img">
                            <?php if ($freelancerhiredata[0]['freelancer_hire_user_image'] != '') { ?>
                                <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $freelancerhiredata[0]['freelancer_hire_user_image']); ?>" alt="" >
                            <?php } else { ?>
                                <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <?php if ($returnpage == '') { ?>
                                <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
                        <a href="javascript:void(0);">
                            <h3> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freelancerhiredata[0]['username']); ?></h3>
                        </a>
                        <div class="profile-text">

                            <?php
                            if ($returnpage == '') {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else { ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    Designation
                                <?php } else {
                                    ?>
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                    </div>

                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
                        <div class=" right-side-menu art-side-menu padding_less_right  right-menu-jr">  
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            if ($freelancerhiredata[0]['user_id'] == $userid) {
                                ?>     
                                <ul class="current-user pro-fw">

                                <?php } else { ?>
                                    <ul class="pro-fw4">
                                    <?php } ?>  
                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_hire_profile')) { ?> class="active" <?php } ?>>
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Employer Details" href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>">Employer Details</a> <?php } else { ?> <a title="Employer Details" href="<?php echo base_url('freelancer/freelancer_hire_profile'); ?>">Employer Details</a> <?php } ?>
                                    </li>
                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save')) { ?> class="active" <?php } ?>> 
                                        <?php if ($returnpage == 'freelancer_post') { ?><a title="Post"  href="<?php echo base_url('freelancer/freelancer_hire_post/' . $this->uri->segment(3) . '?page=freelancer_post'); ?>">Post</a><?php } else { ?><a title="Post" href="<?php echo base_url('freelancer/freelancer_hire_post'); ?>">Post</a><?php } ?>
                                    </li>
                                    <?php
                                    if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_hire_post' || $this->uri->segment(2) == 'freelancer_hire_profile' || $this->uri->segment(2) == 'freelancer_add_post' || $this->uri->segment(2) == 'freelancer_save') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) {
                                        ?>
                                        <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer" href="<?php echo base_url('freelancer/freelancer_save'); ?>">Saved Freelancer</a>
                                        </li>
                                    <?php } ?>
                                </ul>                          
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                if ($userid != $this->uri->segment(3)) {
                                    if ($this->uri->segment(3) != "") {
                                        ?>
                                        <div class="flw_msg_btn fr">
                                            <ul>
                                                <li> <a href="<?php echo base_url('chat/abc/' . $this->uri->segment(3)); ?>">Message</a> </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>


                <?php if ($returnpage == '') { ?>
                    <div  class="add-post-button mob-block">
                        <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer/freelancer_add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Post</a>

                    </div>
                <?php } ?>
                <div class="middle-part container">          
                    <div class="job-menu-profile mob-none pt20">
                        <a href="javascript:void(0);">
                            <h5> <?php echo ucwords($freelancerhiredata[0]['fullname']) . ' ' . ucwords($freelancerhiredata[0]['username']); ?></h5>
                        </a>
                        <div class="profile-text">

                            <?php
                            if ($returnpage == '') {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    <a id="designation" class="designation" title="Designation">Designation</a>

                                <?php } else { ?> 
                                    <a id="designation" class="designation" title="<?php echo ucwords($freelancerhiredata[0]['designation']); ?>"><?php echo ucwords($freelancerhiredata[0]['designation']); ?></a>
                                    <?php
                                }
                            } else {
                                if ($freelancerhiredata[0]['designation'] == '') {
                                    ?>
                                    Designation
                                <?php } else {
                                    ?>
                                    <a   title=" <?php echo ucwords($freelancerhiredata[0]['designation']); ?>">
                                        <?php echo ucwords($freelancerhiredata[0]['designation']); ?> </a>
                                    <?php
                                }
                            }
                            ?>
                        </div>

                        <div  class="add-post-button">
                            <?php if ($returnpage == '') { ?>
                                <a class="btn btn-3 btn-3b" href="<?php echo base_url('freelancer/freelancer_add_post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Add Post</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mob-clear">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Employer Details</h3>
                                <?php
                                function text2link($text) {
                                    $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                    $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                    $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                    return $text;
                                }
                                ?>                              
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li> <p class="details_all_tital "> Basic Information</p> </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Name</b> <span> <?php echo $freelancerhiredata[0]['fullname'] . ' ' . $freelancerhiredata[0]['username']; ?> </span>
                                                        </li>

                                                        <li> <b>Email </b><span> <?php echo $freelancerhiredata[0]['email']; ?></span>
                                                        </li>



                                                        <?php
                                                        if ($returnpage == 'freelancer_post') {
                                                            if ($freelancerhiredata['skyupid']) {
                                                                ?>
                                                                <li> <b>Skype Id</b> <span> <?php echo $freelancerhiredata[0]['skyupid']; ?> </span>
                                                                </li> 
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerhiredata[0]['skyupid']) {
                                                                ?>
                                                                <li> <b>Skype Id</b> <span> <?php echo $freelancerhiredata[0]['skyupid']; ?> </span>
                                                                </li> 
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Skype Id</b> <span>
                                                                        <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                        <?php
                                                        if ($returnpage == 'freelancer_post') {
                                                            if ($freelancerhiredata[0]['phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $freelancerhiredata[0]['phone']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                echo "";
                                                            }
                                                        } else {
                                                            if ($freelancerhiredata[0]['phone']) {
                                                                ?>
                                                                <li><b> Phone Number</b> <span><?php echo $freelancerhiredata[0]['phone']; ?></span> </li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><b>Phone Number</b> <span>
                                                                        <?php echo PROFILENA; ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>


                                                    </ul>
                                                </div>
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li> <p class="details_all_tital "> Address</p> </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $freelancerhiredata[0]['country']))->row()->country_name; ?> </span>
                                                            </li>

                                                            <li> <b>State </b><span><?php
                                                                    echo
                                                                    $this->db->get_where('states', array('state_id' => $freelancerhiredata[0]['state']))->row()->state_name;
                                                                    ?> </span>
                                                            </li>

                                                            <?php
                                                            if ($returnpage == 'freelancer_post') {
                                                                if ($freelancerhiredata[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $freelancerhiredata[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerhiredata[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $freelancerhiredata[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b>City</b> <span>
                                                                            <?php echo PROFILENA; ?></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($returnpage == 'freelancer_post') {
                                                                if ($freelancerhiredata[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode </b><span><?php echo $freelancerhiredata[0]['pincode']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    echo "";
                                                                }
                                                            } else {
                                                                if ($freelancerhiredata[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode </b><span><?php echo $freelancerhiredata[0]['pincode']; ?></span>
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b>Pincode</b> <span>
                                                                            <?php echo PROFILENA; ?></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <li> <b>Postal Address </b><span><p> <?php echo $freelancerhiredata[0]['address']; ?> 
                                                                    </p></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li><p class="details_all_tital ">Professional Information</p></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b>Professional Information </b> <span> 
                                                                    <pre>  <?php echo $this->common->make_links($freelancerhiredata[0]['professional_info']); ?> 
                                                                    </pre></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                                <div class="profile-job-post-title clearfix">
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
        <footer>
            <?php echo $footer; ?>
        </footer>
        <!-- model for popup start -->
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
        <!-- model for popup -->
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('freelancer/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="4">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image"/>

                                </div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>         
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script>

                                var data = <?php echo json_encode($demo); ?>;
                                $(function () {
                                    // alert('hi');
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
                                            // window.location.href = ui.item.value;
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
                        // window.location.href = ui.item.value;
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
            function updateprofilepopup(id) {
                $('#bidmodal-2').modal('show');
            }
        </script>
        <script type="text/javascript">
            function checkvalue() {
                var searchkeyword = $.trim(document.getElementById('tags').value);
                var searchplace = $.trim(document.getElementById('searchplace').value);
                if (searchkeyword == "" && searchplace == "") {
                    return false;
                }
            }
        </script>
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
                        url: "<?php echo base_url(); ?>freelancer/ajaxpro_hire",

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

// code start for file type support
                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    picpopup();
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";
                    $("#upload").val('');
                    return false;
                }
                // file type code end
                if (size > 26214400)
                {
                    //show an alert to the user
                    alert("Allowed file size exceeded. (Max. 25 MB)")
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";
                    //reset file upload control
                    return false;
                }
                $.ajax({
                    url: "<?php echo base_url(); ?>freelancer/image_hire",
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
        <script>
            function divClicked() {
                var divHtml = $(this).html();
                var editableText = $("<textarea />");
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
                    url: "<?php echo base_url(); ?>freelancer/hire_designation",
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
        <!-- script for profile pic strat -->
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById('preview').style.display = 'block';
                        $('#preview').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#profilepic").change(function () {
                // code for not supported file TYPE
                profile = this.files;
                if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    $('#profilepic').val('');
                    picpopup();
                    return false;
                } else {
                    readURL(this);
                }
                // end supported code 
            });
        </script>

        <!-- script for profile pic end -->
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <script type="text/javascript">

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
        <!-- popup for file type -->
        <script>
            function picpopup() {
                $('.biderror .mes').html("<div class='pop_content'>Please select only Image File Type.(jpeg,jpg,png,gif)");
                $('#bidmodal').modal('show');
            }
        </script>
        <!-- all popup close close using esc start -->
        <script type="text/javascript">
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    //$( "#bidmodal" ).hide();
                    $('#bidmodal-2').modal('hide');
                }
            });
        </script>
        <!-- all popup close close using esc end -->
        <script type="text/javascript">
            //For Scroll page at perticular position js Start
            $(document).ready(function () {
                $('html,body').animate({scrollTop: 265}, 100);
            });
            //For Scroll page at perticular position js End
        </script>
    </body>
</html>