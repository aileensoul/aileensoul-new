<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border ?>
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
                                    <h3>Contacts</h3>
                                    <div class="contact-frnd-post">
                                        <?php
                                        if (count($unique_user) > 0) {
                                            foreach ($unique_user as $user) {
                                                if ($busuid == $user['contact_from_id']) {
                                                    $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_to_id'], $data = '*', $join_str = array());
                                                    $contition_array = array('contact_from_id' => $login, 'contact_to_id' => $user['contact_to_id'], 'contact_type' => 2);
                                                    $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                } else {
                                                    $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_from_id'], $data = '*', $join_str = array());
                                                    $contition_array = array('contact_to_id' => $login, 'contact_from_id' => $user['contact_from_id'], 'contact_type' => 2);
                                                    $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                }
                                                ?>
                                                <div class="job-contact-frnd">
                                                    <div class="profile-job-post-detail clearfix" id="<?php echo "removecontact" . $cdata[0]['user_id']; ?>">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-post-location-name">
                                                                <div class="user_lst"><ul>
                                                                        <li class="fl">
                                                                            <div class="follow-img">
                                                                                <?php if ($cdata[0]['business_user_image'] != '') { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>">
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $cdata[0]['business_user_image']); ?>" height="50px" width="50px" alt="" >
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>">
                                                                                        <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                                    </a>
                                                                                <?php } ?> 
                                                                            </div>
                                                                        </li>
                                                                        <li style="width: 67%">
                                                                            <div class="">
                                                                                <div class="follow-li-text " style="padding: 0;">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>"><?php echo ucwords($cdata[0]['company_name']); ?></a>
                                                                                </div>
                                                                                <div>
                                                                                    <?php $category = $this->db->get_where('industry_type', array('industry_id' => $cdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                                    <a><?php
                                                                                        if ($category) {
                                                                                            echo $category;
                                                                                        } else {
                                                                                            echo $cdata[0]['other_industrial'];
                                                                                        }
                                                                                        ?></a>
                                                                                </div>
                                                                        </li>
                                                                        <li class="fr">
                                                                            <?php
                                                                            if ($login == $cdata[0]['user_id']) {
                                                                                
                                                                            } else {
                                                                                ?>
                                                                                <?php if ($clistuser[0]['status'] == 'cancel') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>  
                                                                                <?php } elseif ($clistuser[0]['status'] == 'pending') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?>, 'pending')">
                                                                                            Cancel request
                                                                                        </button>
                                                                                    </div>     
                                                                                <?php } else if ($clistuser[0]['status'] == 'confirm') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?>, 'confirm')">
                                                                                            In your contact
                                                                                        </button> 
                                                                                    </div>        
                                                                                <?php } else if ($clistuser[0]['status'] == 'reject') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing">No Contacts Found.</h4>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-1"></div>
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
                                <?php echo form_open_multipart(base_url('business-profile/user-image-change'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="13">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                   <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <!-- script for business autofill -->
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
                    },
                    focus: function (event, ui) {
                        event.preventDefault();
                        $("#searchplace").val(ui.item.label);
                    }
                });
            });
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
        <!-- end of business search auto fill -->
        <script>
            function updateprofilepopup(id) {
                $('#bidmodal-2').modal('show');
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
            jQuery.noConflict();

            (function ($) {
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
            })(jQuery);
            //aarati code end
        </script>
        <!-- cover image end -->

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
                        $('.' + 'fr' + clicked_id).html(data);
                    }
                });
            }
        </script>
        <!--follow like script end -->
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
        <!-- scroll page script start -->
        <script type="text/javascript">
            //For Scroll page at perticular position js Start
            $(document).ready(function () {
                //  $(document).load().scrollTop(1000);
                $('html,body').animate({scrollTop: 330}, 100);
            });
            //For Scroll page at perticular position js End
        </script>
        <!-- scroll page script end -->
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
        <script type="text/javascript">
            function contact_person_menu(clicked_id) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/contact_person_menu" ?>',
                    data: 'toid=' + clicked_id,
                    success: function (data) {
                        $('#' + 'statuschange' + clicked_id).html(data);
                    }
                });
            }
        </script>
        <!-- contact person script end -->
        <script type="text/javascript">
            function removecontactuser(clicked_id) {
                var showdata = window.location.href.split("/").pop();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/removecontactuser" ?>',
                    dataType: 'json',
                    data: 'contact_id=' + clicked_id + '&showdata=' + showdata,
                    success: function (data) {
                        $('#' + 'statuschange' + clicked_id).html(data.contactdata);
                        if (data.notfound == 1) {
                            if (data.notcount == 0) {
                                $('.' + 'contact-frnd-post').html(data.nomsg);
                            } else {
                                $('#' + 'removecontact' + clicked_id).fadeOut(4000);
                            }
                        }
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function contact_person_cancle(clicked_id, status) {
                if (status == 'confirm') {
                    $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='removecontactuser(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                    $('#bidmodal').modal('show');
                } else if (status == 'pending') {
                    $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person_menu(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                    $('#bidmodal').modal('show');
                }
            }

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