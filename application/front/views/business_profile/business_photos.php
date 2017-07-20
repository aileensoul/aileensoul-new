<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?> 
        <section>
            <?php echo $business_common; ?>
            <div class="">
                <div class="user-midd-section"  >
                    <div  class="col-sm-12 border_tag padding_low_data padding_les" >
                        <div class="padding_les main_art" >
                            <div class="top-tab">
                                <ul class="nav nav-tabs tabs-left remove_tab">
                                    <li class="active"> <a href="<?php echo base_url('business_profile/business_photos/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-camera" aria-hidden="true"></i>   Photos</a></li>
                                    <li>       <a href="<?php echo base_url('business_profile/business_videos/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</a></li>
                                    <li>    <a href="<?php echo base_url('business_profile/business_audios/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-music" aria-hidden="true"></i>  Audio</a></li>
                                    <li>    <a href="<?php echo base_url('business_profile/business_pdf/' . $businessdata1[0]['business_slug']) ?>" data-toggle="tab"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  Pdf</a></li>
                                </ul>
                            </div>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home">
                                    <div class="common-form">
                                        <div class="">
                                            <div class="all-box">
                                                <ul>
                                                    <?php
                                                    $i = 1;
                                                    $allowed = array('gif', 'png', 'jpg');
                                                    foreach ($business_profile_data as $mke => $mval) {
                                                        $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);
                                                        if (in_array($ext, $allowed)) {
                                                            $databus[] = $mval;
                                                        }
                                                    }
                                                    if ($databus) {
                                                        ?>
                                                        <div class="pictures">
                                                            <ul>
                                                                <?php foreach ($databus as $data) {
                                                                    ?>
                                                                    <li>
                                                                        <img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $data['image_name']) ?>" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor" width="550" height="669"/>
                                                                    </li>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="art_no_pva_avl">
                                                            <div class="art_no_post_img">
                                                                <img src="<?php echo base_url('images/020-c.png'); ?>"  >
                                                            </div>
                                                            <div class="art_no_post_text1">
                                                                No Photo Available.
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <!-- silder start -->
                                            <div id="myModal1" class="modal2">
                                                <div class="modal-content2">
                                                    <span class="close2 cursor" onclick="closeModal()">&times;</span>
                                                    <!--  multiple image start -->
                                                    <?php
                                                    $i = 1;

                                                    $allowed = array('gif', 'png', 'jpg');
                                                    foreach ($business_profile_data as $mke => $mval) {

                                                        $ext = pathinfo($mval['image_name'], PATHINFO_EXTENSION);

                                                        if (in_array($ext, $allowed)) {
                                                            $databus1[] = $mval;
                                                        }
                                                    }

                                                    foreach ($databus1 as $busdata) {
                                                        ?>
                                                        <div class="mySlides">
                                                            <div class="numbertext"><?php echo $i ?> / <?php echo count($databus1) ?></div>
                                                            <div class="slider_img_p">
                                                                <img src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $busdata['image_name']) ?>" >
                                                            </div>
                                                            <!-- like comment start -->
                                                            <div>
                                                                <?php
                                                                $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                                $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                if (count($commneteduser) > 0) {
                                                                    ?>
                                                                    <div class="likeduserlistimg<?php echo $busdata['image_id'] ?>">
                                                                        <?php
                                                                        $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                                        $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                        $countlike = count($commneteduser) - 1;
                                                                        foreach ($commneteduser as $userdata) {
                                                                            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $userdata['user_id'], 'status' => 1))->row()->company_name;
                                                                        }
                                                                        ?>
                                                                        <!-- pop up box end-->
                                                                        <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $busdata['image_id'] ?>);">
                                                                            <?php
                                                                            $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                                            $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                            $countlike = count($commneteduser) - 1;
                                                                            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $commneteduser[0]['user_id'], 'status' => 1))->row()->company_name;
                                                                            ?>
                                                                            <div class="like_one_other_img">
                                                                                <?php
                                                                                if ($userid == $commneteduser[0]['user_id']) {
                                                                                    echo "You";
                                                                                    echo "&nbsp;";
                                                                                } else {
                                                                                    echo ucwords($business_fname1);
                                                                                    echo "&nbsp;";
                                                                                }
                                                                                ?>
                                                                                <?php
                                                                                if (count($commneteduser) > 1) {
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
                                                                <div class="<?php echo "likeusernameimg" . $busdata['image_id']; ?>" id="<?php echo "likeusernameimg" . $busdata['image_id']; ?>" style="display:none">
                                                                    <?php
                                                                    $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                                    $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    $countlike = count($commneteduser) - 1;
                                                                    foreach ($commneteduser as $userdata) {
                                                                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $userdata['user_id'], 'status' => 1))->row()->company_name;
                                                                    }
                                                                    ?>
                                                                    <!-- pop up box end-->
                                                                    <a href="javascript:void(0);"  onclick="likeuserlistimg(<?php echo $busdata['image_id'] ?>);">
                                                                        <?php
                                                                        $contition_array = array('post_image_id' => $busdata['image_id'], 'is_unlike' => '0');
                                                                        $commneteduser = $this->common->select_data_by_condition('bus_post_image_like', $contition_array, $data = 'post_image_like_id,post_image_id,user_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                        $countlike = count($commneteduser) - 1;
                                                                        $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $commneteduser[0]['user_id'], 'status' => 1))->row()->company_name;
                                                                        ?>
                                                                        <div class="like_one_other_img">
                                                                            <?php
                                                                            echo ucwords($business_fname1);
                                                                            echo "&nbsp;";
                                                                            ?>
                                                                            <?php
                                                                            if (count($commneteduser) > 1) {
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
                                                                <!-- show comment div start -->
                                                            </div>
                                                            <!-- like comment end -->
                                                        </div>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    <!-- slider image rotation end  -->
                                                    <a class="prev" style="left: 0px" onclick="plusSlides(-1)">&#10094;</a>
                                                    <a class="next" style="right: 0px"  onclick="plusSlides(1)">&#10095;</a>
                                                    <div class="caption-container">
                                                        <p id="caption"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- slider end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="9">
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
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog" style="z-index: 999999;">
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
        <div class="modal fade message-box" id="likeusermodal" role="dialog" style="z-index: 999999 !important;">
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
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
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
            //alert(data);

            $(function () {
                // alert('hi');
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
        <script type="text/javascript">
            //For blocks or images of size, you can use $(document).ready
            $(document).ready(function () {
                $('.blocks').jMosaic({items_type: "li", margin: 0});
                $('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
            });
        </script>
        <script>
            function openModal() {
                document.getElementById('myModal1').style.display = "block";
            }

            function closeModal() {
                document.getElementById('myModal1').style.display = "none";
            }

            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                var captionText = document.getElementById("caption");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                captionText.innerHTML = dots[slideIndex - 1].alt;
            }
        </script>
        <!-- cover image start -->
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
                        url: "<?php echo base_url() ?>business_profile/ajaxpro",
                        type: "POST",
                        data: {"image": resp},
                        success: function (data) {
                            html = '<img src="' + resp + '" />';
                            if (html)
                            {
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

            //aarati code start
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


                // pallavi code start for file type support
                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    //alert('not an image');
                    picpopup();

                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";
                    $("#upload").val('');
                    return false;
                }
                // file type code end

                if (size > 4194304)
                {
                    //show an alert to the user
                    alert("Allowed file size exceeded. (Max. 4 MB)")

                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";


                    //reset file upload control
                    return false;
                }

                $.ajax({

                    url: "<?php echo base_url(); ?>business_profile/imagedata",
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
        
        
        <script type="text/javascript">
            function h(e) {
                $(e).css({'height': '29px', 'overflow-y': 'hidden'}).height(e.scrollHeight);
            }
            $('.textarea').each(function ()
            {
                h(this);
            }).on('input', function () {
                h(this);
            });
        </script>
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
                    }
                });
            }
        </script>
        <!-- follow user script end -->
        <!-- Unfollow user script start -->
        <script type="text/javascript">
            function unfollowuser(clicked_id)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/unfollow" ?>',
                    data: 'follow_to=' + clicked_id,
                    success: function (data) {
                        $('.' + 'fr' + clicked_id).html(data);
                    }
                });
            }
        </script>
        <!-- Unfollow user script end -->
        <script>
            function updateprofilepopup(id) {
                $('#bidmodal-2').modal('show');
            }
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
                //alert(profile);
                if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                    //alert('not an image');
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
        <script type="text/javascript">
            $(document).keydown(function (e) {
                if (!e)
                    e = window.event;
                if (e.keyCode == 27 || e.charCode == 27) {
                    closeModal();
                }
            });
        </script>
        <script type="text/javascript">
            //    $('#myModal').modal({backdrop: 'true'}) 
            j$('#myModal').modal({backdrop: 'true'});
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
        <script>
            function picpopup() {
                $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
                $('#bidmodal').modal('show');
            }
        </script>
        <script type="text/javascript">
            $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                    $('#bidmodal-2').modal('hide');
                }
            });

        </script>
        <!-- contact person script start -->
        <script type="text/javascript">
            function contact_person(clicked_id) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/contact_person" ?>',
                    data: 'toid=' + clicked_id,
                    success: function (data) {
                        $('#contact_per').html(data);
                    }
                });
            }
        </script>
        <!-- contact person script end -->
        <script type="text/javascript">
            function contact_person_model(clicked_id, status) {
                if (status == 'pending') {
                    $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                    $('#bidmodal').modal('show');
                } else if (status == 'confirm') {
                    $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                    $('#bidmodal').modal('show');
                }
            }
        </script>
    </body>
</html>