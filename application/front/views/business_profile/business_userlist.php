<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <?php echo $business_common; ?>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>User list</h3>
                                    <div class="contact-frnd-post">
                                        <?php foreach ($userlist as $user) { ?>
                                            <div class="job-contact-frnd ">
                                                <div class="profile-job-post-detail clearfix">
                                                    <div class="profile-job-post-title-inside clearfix">
                                                        <div class="profile-job-post-location-name">
                                                            <div class="user_lst"><ul>
                                                                    <li class="fl">
                                                                        <div class="follow-img">
                                                                            <?php if ($user['business_user_image'] != '') { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>">
                                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $user['business_user_image']); ?>" height="50px" width="50px" alt="" >
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>">
                                                                                    <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                                </a>
                                                                            <?php } ?> 
                                                                        </div>
                                                                    </li>
                                                                    <li class="folle_text">
                                                                        <div class="">
                                                                            <div class="follow-li-text " style="padding: 0;">
                                                                                <a title="<?php echo $user['company_name']; ?>" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $user['business_slug']); ?>"><?php echo $user['company_name']; ?></a>
                                                                            </div>
                                                                            <div>
                                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $user['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                                <a><?php
                                                                                    if ($category) {
                                                                                        echo $category;
                                                                                    } else {
                                                                                        echo $user['other_industrial'];
                                                                                    }
                                                                                    ?></a>
                                                                            </div>
                                                                    </li>
                                                                    <li class="<?php echo "fruser" . $user['business_profile_id']; ?> fr">
                                                                        <?php
                                                                        $status = $this->db->get_where('follow', array('follow_type' => 2, 'follow_from' => $artdata[0]['business_profile_id'], 'follow_to' => $user['business_profile_id']))->row()->follow_status;
                                                                        if ($status == 0 || $status == " ") {
                                                                            ?>
                                                                            <div id= "followdiv " class="user_btn">
                                                                                <button id="<?php echo "follow" . $user['business_profile_id']; ?>" onClick="followuser(<?php echo $user['business_profile_id']; ?>)">
                                                                                    Follow 
                                                                                </button></div>
                                                                        <?php } elseif ($status == 1) { ?>
                                                                            <div id= "unfollowdiv"  class="user_btn" > 
                                                                                <button class="bg_following" id="<?php echo "unfollow" . $user['business_profile_id']; ?>" onClick="unfollowuser(<?php echo $user['business_profile_id']; ?>)">
                                                                                    Following 
                                                                                </button></div>
                                                                        <?php } ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="col-md-1">
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
        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
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
                                <input type="hidden" name="hitext" id="hitext" value="6">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <!-- script for skill textbox automatic end (option 2)-->
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <!-- script for business autofill -->
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data = <?php echo json_encode($demo); ?>;
            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/userlist.js'); ?>"></script>
        <script type="text/javascript">
//            function checkvalue() {
//                var searchkeyword = $.trim(document.getElementById('tags').value);
//                var searchplace = $.trim(document.getElementById('searchplace').value);
//                if (searchkeyword == "" && searchplace == "") {
//                    return false;
//                }
//            }
//            function updateprofilepopup(id) {
//                $('#bidmodal-2').modal('show');
//            }
//
//            /* COVER PIC SCRIPT START */
//            function myFunction() {
//                document.getElementById("upload-demo").style.visibility = "hidden";
//                document.getElementById("upload-demo-i").style.visibility = "hidden";
//                document.getElementById('message1').style.display = "block";
//            }
//            function showDiv() {
//                document.getElementById('row1').style.display = "block";
//                document.getElementById('row2').style.display = "none";
//            }
//            $uploadCrop = $('#upload-demo').croppie({
//                enableExif: true,
//                viewport: {
//                    width: 1250,
//                    height: 350,
//                    type: 'square'
//                },
//                boundary: {
//                    width: 1250,
//                    height: 350
//                }
//            });
//            $('.upload-result').on('click', function (ev) {
//                $uploadCrop.croppie('result', {
//                    type: 'canvas',
//                    size: 'viewport'
//                }).then(function (resp) {
//                    $.ajax({
//                        url: "<?php echo base_url() ?>business_profile/ajaxpro",
//                        type: "POST",
//                        data: {"image": resp},
//                        success: function (data) {
//                            html = '<img src="' + resp + '" />';
//                            if (html)
//                            {
//                                window.location.reload();
//                            }
//                        }
//                    });
//                });
//            });
//            $('.cancel-result').on('click', function (ev) {
//                document.getElementById('row2').style.display = "block";
//                document.getElementById('row1').style.display = "none";
//                document.getElementById('message1').style.display = "none";
//            });
//            $('#upload').on('change', function () {
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $uploadCrop.croppie('bind', {
//                        url: e.target.result
//                    }).then(function () {
//                        console.log('jQuery bind complete');
//                    });
//                }
//                reader.readAsDataURL(this.files[0]);
//            });
//            $('#upload').on('change', function () {
//                var fd = new FormData();
//                fd.append("image", $("#upload")[0].files[0]);
//                files = this.files;
//                size = files[0].size;
//                if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
//                    picpopup();
//                    document.getElementById('row1').style.display = "none";
//                    document.getElementById('row2').style.display = "block";
//                    $("#upload").val('');
//                    return false;
//                }
//                // file type code end
//                if (size > 4194304)
//                {
//                    //show an alert to the user
//                    alert("Allowed file size exceeded. (Max. 4 MB)")
//                    document.getElementById('row1').style.display = "none";
//                    document.getElementById('row2').style.display = "block";
//                    //reset file upload control
//                    return false;
//                }
//                $.ajax({
//                    url: "<?php echo base_url(); ?>business_profile/imagedata",
//                    type: "POST",
//                    data: fd,
//                    processData: false,
//                    contentType: false,
//                    success: function (response) {
//                    }
//                });
//            });
//            /* COVER PIC SCRIPT END */
//            
//            /* FOLLOW USER START */
//            function followuser(clicked_id)
//            {
//                $.ajax({
//                    type: 'POST',
//                    url: '<?php echo base_url() . "business_profile/follow" ?>',
//                    data: 'follow_to=' + clicked_id,
//                    success: function (data) {
//                        $('.' + 'fruser' + clicked_id).html(data);
//                    }
//                });
//            }
//            /* FOLLOW USER END */
//            
//            /* UNFOLLOW USER START */
//            function unfollowuser(clicked_id)
//            {
//                $.ajax({
//                    type: 'POST',
//                    url: '<?php echo base_url() . "business_profile/unfollow" ?>',
//                    data: 'follow_to=' + clicked_id,
//                    success: function (data) {
//                        $('.' + 'fruser' + clicked_id).html(data);
//                    }
//                });
//            }
//            /* UNFOLLOW USER END */
//            
//            /* SCRIPT FOR PROFILE PIC START */
//            function readURL(input) {
//                if (input.files && input.files[0]) {
//                    var reader = new FileReader();
//                    reader.onload = function (e) {
//                        document.getElementById('preview').style.display = 'block';
//                        $('#preview').attr('src', e.target.result);
//                    }
//                    reader.readAsDataURL(input.files[0]);
//                }
//            }
//            $("#profilepic").change(function () {
//                profile = this.files;
//                if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
//                    $('#profilepic').val('');
//                    picpopup();
//                    return false;
//                } else {
//                    readURL(this);
//                }
//            });    
//            /* SCRIPT FOR PROFILE PIC END */
//            
//            //validation for edit email formate form
//            $(document).ready(function () {
//                $("#userimage").validate({
//                    rules: {
//                        profilepic: {
//                            required: true,
//                        },
//                    },
//                    messages: {
//                        profilepic: {
//                            required: "Photo Required",
//                        },
//                    },
//                });
//            });
//            
//            function picpopup() {
//                $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
//                $('#bidmodal').modal('show');
//            }
//            
//            $(document).on('keydown', function (e) {
//                if (e.keyCode === 27) {
//                    $('#bidmodal-2').modal('hide');
//                }
//            });
//            <!-- scroll page script start -->
//            $(document).ready(function () {
//                $('html,body').animate({scrollTop: 330}, 500);
//            });
        </script>
    </body>
</html>


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