<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
        <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script>
            $(document).ready(function ()
            {
                /* Uploading Profile BackGround Image */
                $('body').on('change', '#bgphotoimg', function ()
                {
                    $("#bgimageform").ajaxForm({target: '#timelineBackground',
                        beforeSubmit: function () {},
                        success: function () {
                            $("#timelineShade").hide();
                            $("#bgimageform").hide();
                        },
                        error: function () {
                        }}).submit();
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
                        },
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
                        url: "<?php echo base_url('freelancer/image_saveBG_ajax_hire'); ?>",
                        data: dataString,
                        cache: false,
                        beforeSend: function () { },
                        success: function (html)
                        {
                            if (html)
                            {
                                window.location.reload();
                                $(".bgImage").fadeOut('slow');
                                $(".bgSave").fadeOut('slow');
                                $("#timelineShade").fadeIn("slow");
                                $("#timelineBGload").removeClass("headerimage");
                                $("#timelineBGload").css({'margin-top': html});
                                return false;
                            }
                        }
                    });
                    return false;
                });
            });
        </script>
    </head>
    <body>
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2_border; ?>
        <section>
            <div class="user-midd-section " id="paddingtop_fixed">
                <div class="container">
                    <div class="row row4">
                        <div class="col-md-4 col-sm-4 animated fadeInLeftBig profile-box profile-box-left">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>"
                                               tabindex="-1"
                                               aria-hidden="true"
                                               rel="noopener">
                                                <!-- rash code start 12-4 -->
                                                <?php
                                                if ($freepostdata[0]['profile_background'] != '') {
                                                    ?>
                                                    <!-- box image start -->
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_post_bg_thumb_upload_path') . $freepostdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>" >
                                                    </div>
                                                    <!-- box image end -->
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freepostdata[0]['freelancer_post_fullname'] . ' ' . $freepostdata[0]['freelancer_post_username']; ?>"  >
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" 
                                                   href="<?php echo base_url('freelancer/freelancer_post_profile/' . $freelancerdata[0]['user_id']); ?>" title="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                       <?php
                                                       if ($freelancerdata[0]['freelancer_post_user_image']) {
                                                           ?>

                                                        <div class="">
                                                            <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $freelancerdata[0]['freelancer_post_user_image']); ?>" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class=""> 
                                                            <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                        </div> <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>"><?php echo ucwords($userdata[0]['first_name']) . ' ' . ucwords($userdata[0]['last_name']); ?></a>
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>"><?php
                                                        if ($freepostdata[0]['designation']) {
                                                            echo ucwords($freepostdata[0]['designation']);
                                                        } else {
                                                            echo "Current Work";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile')) { ?> class="active" <?php } ?>><a  class="padding_less_left"  title="freelancer Details" href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>">Details</a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save_post')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelancer/freelancer_save_post'); ?>">Saved </a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_applied_post')) { ?> class="active" <?php } ?>><a title="Applied Post"  class="padding_less_right"  href="<?php echo base_url('freelancer/freelancer_applied_post'); ?>">Applied</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                            </div>
                        </div>
                        <!-- cover pic end -->

                        <div class="col-md-7 col-sm-7 animated fadeInUp col-md-push-4 col-sm-push-4 custom-right">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3> Recommended Post</h3>
                                    <div class="contact-frnd-post">
                                        <?php
                                        if ($postdetail) {
                                            foreach ($postdetail as $post_key => $post_value) {
                                                foreach ($post_value as $post) {
                                                    ?>
                                                    <div class="job-post-detail clearfix">
                                                        <div class="job-contact-frnd ">
                                                            <div class="profile-job-post-detail clearfix margin_btm"  id="<?php echo "removeapply" . $post['post_id']; ?>">
                                                                <div class="profile-job-post-title-inside clearfix">
                                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul>
                                                                                    <li class="fr">
                                                                                        Created Date : <?php echo trim(date('d-M-Y', strtotime($post['created_date']))); ?>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>" title="<?php echo ucwords($post['post_name']); ?>" class="display_inline post_title">
                                                                                            <?php echo ucwords($post['post_name']); ?> </a>   </li>
                                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                                    <li> 
                                                                                        <?php if ($cityname || $countryname) { ?>  
                                                                                            <div class="fr lction">
                                                                                                <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" >
                                                                                                        <?php
                                                                                                        if ($cityname) {
                                                                                                            echo $cityname . ",";
                                                                                                        }
                                                                                                        ?><?php
                                                                                                        if ($countryname) {
                                                                                                            echo $countryname;
                                                                                                        }
                                                                                                        ?></i></a>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <?php
                                                                                        $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                        $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                        ?>
                                                                                    </li>
                                                                                    <li><a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                                        </a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="profile-job-profile-menu">
                                                                            <ul class="clearfix">
                                                                                <li> <b> Field</b> 
                                                                                    <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>
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
                                                                                                echo $post['post_description'];
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
                                                                                        <p>
                                                                                            <?php
                                                                                            if (($post['post_exp_year'] != '0') || ($post['post_exp_month'] != '0')) {
<<<<<<< HEAD
                                                                                                if ($post['post_exp_year'] != '0') {
                                                                                                    echo $post['post_exp_year'];
                                                                                                }
                                                                                                if ($post['post_exp_month'] != '0') {
                                                                                                    echo ".";
                                                                                                    echo $post['post_exp_month'];
                                                                                                }
                                                                                                echo ' Year ';
=======
                                                                                                echo $post['post_exp_year'] . '.' . $post['post_exp_month'] . ' Year ';
>>>>>>> e99e71b58577771dd7484af7e755279e45ec0744
                                                                                            } else {

                                                                                                echo PROFILENA;
                                                                                            }
                                                                                            ?> 
                                                                                        </p>  
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
                                                                                <ul><li class="job_all_post last_date">
                                                                                        Last Date : <?php
                                                                                        if ($post['post_last_date']) {
                                                                                            echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?>                                                          </li>
                                                                                    <li class=fr>
                                                                                        <?php
                                                                                        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                                        $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                        if ($freelancerapply1) {
                                                                                            ?>
                                                                                            <a href="javascript:void(0);" class="button applied">Applied</a>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)">Apply</a>
                                                                                        </li> 
                                                                                        <li>
                                                                                            <?php
                                                                                            $userid = $this->session->userdata('aileenuser');
                                                                                            $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                                                                            $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                            if ($data) {
                                                                                                ?>
                                                                                                <a class="saved  button <?php echo 'savedpost' . $post['post_id']; ?>">Saved</a>
                                                                                            <?php } else { ?>

                                                                                                <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button">Save</a>
                                                                                            <?php } ?>
                                                                                        <?php } ?>

                                                                                    </li>                        
                                                                                </ul>
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
                                                <h4 class="page-heading  product-listing" >No Recommended Post Found.</h4>
                                            </div>
                                        <?php }
                                        ?> 
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
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>">
        </script>
        <script type="text/javascript">
            function save_post(abc)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "freelancer/save_user" ?>',
                    data: 'post_id=' + abc,
                    success: function (data) {
                        $('.' + 'savedpost' + abc).html(data).addClass('saved');
                    }
                });

            }
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
        <script type="text/javascript">
            function save_post(abc)
            {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "freelancer/save_user" ?>',
                    data: 'post_id=' + abc,
                    success: function (data) {
                        $('.' + 'savedpost' + abc).html(data).addClass('saved');
                    }
                });

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
        <script type="text/javascript">
            function apply_post(abc, xyz) {
                var alldata = 'all';
                var user = xyz;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "freelancer/apply_insert" ?>',
                    data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
                    success: function (data) {
                        $('.savedpost' + abc).hide();
                        $('.applypost' + abc).html(data);
                        $('.applypost' + abc).attr('disabled', 'disabled');
                        $('.applypost' + abc).attr('onclick', 'myFunction()');
                        $('.applypost' + abc).addClass('applied');
                    }
                });
            }
        </script>
        <!-- apply post end-->
        <!-- save post end -->
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script>
            function savepopup(id) {
                save_post(id);
                $('.biderror .mes').html("<div class='pop_content'>Post successfully saved.");
                $('#bidmodal').modal('show');
            }
            function applypopup(postid, userid) {
                $('.biderror .mes').html("<div class='pop_content'>Do you want to apply for this work?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
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
        </script>
        <!-- all popup close close using esc end -->
        <script type="text/javascript">
            $(document).ready(function () {
                var nb = $('div.job-post-detail').length;
                if (nb == 0) {
                    $("#dropdownclass").addClass("no-post-h2");
                }
            });
        </script>
    </body>               
</html>