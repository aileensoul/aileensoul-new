<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <!-- START HEADER -->
        <?php echo $header; ?>
        <!-- END HEADER -->
        <?php echo $business_header2_border; ?><!-- start head -->
        <?php echo $dash_header; ?>
        <?php echo $dash_header_menu; ?>
        <div class="col-md-4 col-xs-12  hidden-md hidden-sm hidden-lg pt1201 ">
            <div class="common-form ">
                <div class="main_cqlist-1"> 
                    <div class="contact-list ">
                        <h3 class="list-title">Contact Request Notifications</h3>
                        <div class="noti_cq">
                            <div class="cq_post">
                                <ul>
                                    <?php
                                    if ($friendlist_con) {
                                        foreach ($friendlist_con as $friend) {
                                            ?>
                                            <?php
                                            $userid = $this->session->userdata('aileenuser');
                                            if ($friend['contact_from_id'] == $userid) {
                                                ?>
                                                <li> 
                                                    <div class="cq_main_lp">
                                                        <div class="cq_latest_left">
                                                            <div class="cq_post_img">
                                                                <?php if ($friend['business_user_image'] != '') { ?>
                                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $friend['business_user_image']); ?>">
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                        <img src="<?php echo base_url(NOIMAGE); ?>" />
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>  
                                                        <div class="cq_latest_right">
                                                            <div class="cq_desc_post">
                                                                <sapn class="rifght_fname">  
                                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                        <span class="main_name">
                                                                            <?php echo ucfirst(strtolower($friend['company_name'])); ?> 
                                                                        </span>
                                                                    </a>
                                                                    <span style="color: #8c8c8c;">confirmed your contact request .</span>
                                                                </sapn>
                                                            </div>
                                                            <div class="cq_desc_post">
                                                                <sapn class="cq_rifght_desc">  <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($friend['modify_date']))); ?> </sapn>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <li>
                                            <div class="cq_main_lp2">
                                                No Notifications  available...
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <div class="user-midd-section" id="paddingtop_fixed pt_mn">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-7 pt120 pt_mn2">
                        <div class="common-form main_cqlist">
                            <div class="contact-list">
                                <h3 class="list-title list-title2"> Contact Request</h3>
                            </div>  
                            <div class="all-list">
                                <ul  id="contactlist">
                                    <!-- AJAX DATA ... -->
                                </ul>
                                <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url() ?>images/loader.gif" /></div>
                            </div>        
                        </div>
                        <!-- END PAGE TITLE -->
                    </div>
                    <div class="col-md-4 col-sm-5 pt120 hidden-xs ">
                        <div class="common-form ">
                            <div class="main_cqlist-1"> 
                                <div class="contact-list ">
                                    <h3 class="list-title">Contact Request Notifications</h3>
                                    <div class="noti_cq">
                                        <div class="cq_post">
                                            <ul>
                                                <?php
                                                if ($friendlist_con) {
                                                    foreach ($friendlist_con as $friend) {
                                                        ?>
                                                        <?php
                                                        $userid = $this->session->userdata('aileenuser');
                                                        if ($friend['contact_from_id'] == $userid) {
                                                            ?>
                                                            <li> 
                                                                <div class="cq_main_lp">
                                                                    <div class="cq_latest_left">
                                                                        <div class="cq_post_img">

                                                                            <?php if ($friend['business_user_image'] != '') { ?>
                                                                                <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $friend['business_user_image']); ?>">
                                                                                </a>
                                                                            <?php } else { ?>
                                                                                <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" />
                                                                                </a>
                                                                            <?php } ?>


                                                                        </div>
                                                                    </div>  
                                                                    <div class="cq_latest_right">
                                                                        <div class="cq_desc_post">
                                                                            <sapn class="rifght_fname">  
                                                                                <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                                                    <span class="main_name">
                                                                                        <?php echo ucfirst(strtolower($friend['company_name'])); ?> 
                                                                                    </span>
                                                                                </a>
                                                                                <span style="color: #8c8c8c;">confirmed your contact request .</span>
                                                                            </sapn>
                                                                        </div>

                                                                        <div class="cq_desc_post">
                                                                            <sapn class="cq_rifght_desc">  <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($friend['modify_date']))); ?> </sapn>
                                                                        </div>  
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>
                                                    <li>
                                                        <div class="cq_main_lp2">
                                                            No Notifiaction  available...
                                                        </div>
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
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <div class="page-content-inner">
                                    <div class="row">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </div>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <!-- BEGIN INNER FOOTER -->
        <?php echo $footer; ?>
        <!-- script for update all read notification start-->
        <script type="text/javascript">
            function contactperson() {
                $.ajax({
                    url: "<?php echo base_url(); ?>business_profile/contact_notification",
                    type: "POST",
                    success: function (data) {
                        $('#addcontactBody').html(data);
                    }
                });
            }
            function contactapprove(toid, status) {
                $.ajax({
                    url: "<?php echo base_url(); ?>business_profile/contact_list_approve",
                    type: "POST",
                    data: 'toid=' + toid + '&status=' + status,
                    success: function (data) {
                        $('#contactlist').html(data);
                    }
                });
            }

            $(document).ready(function () {
                business_contact_list();
                
                $(window).scroll(function () {
                    //if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {

                        var page = $(".page_number:last").val();
                        var total_record = $(".total_record").val();
                        var perpage_record = $(".perpage_record").val();
                        if (parseInt(perpage_record) <= parseInt(total_record)) {
                            var available_page = total_record / perpage_record;
                            available_page = parseInt(available_page, 10);
                            var mod_page = total_record % perpage_record;
                            if (mod_page > 0) {
                                available_page = available_page + 1;
                            }
                            //if ($(".page_number:last").val() <= $(".total_record").val()) {
                            if (parseInt(page) <= parseInt(available_page)) {
                                var pagenum = parseInt($(".page_number:last").val()) + 1;
                                business_contact_list(pagenum);
                            }
                        }
                    }
                });
            });
            var isProcessing = false;
            function business_contact_list(pagenum) {
                if (isProcessing) {
                    /*
                     *This won't go past this condition while
                     *isProcessing is true.
                     *You could even display a message.
                     **/
                    return;
                }
                isProcessing = true;
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>business_profile/ajax_contact_list?page=" + pagenum,
                    data: {total_record: $("#total_record").val()},
                    dataType: "html",
                    beforeSend: function () {
                        if (pagenum == 'undefined') {
                            // $(".contactlist").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
                        } else {
                            $('#loader').show();
                        }
                    },
                    complete: function () {
                        $('#loader').hide();
                    },
                    success: function (data) {
                        $('.loader').remove();
                        $('#contactlist').append(data);

                        isProcessing = false;
                    }
                });
            }

        </script>
        <!-- script for update all read notification end -->
    </body>
</html>