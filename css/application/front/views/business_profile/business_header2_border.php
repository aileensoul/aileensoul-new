<script type="text/javascript">

    function addmsg_contact(type, msg)
    {
        if (msg == 0)
        {
            $("#addcontact_count").html('');
            $('#addcontactLink').removeClass('contact_notification_available');
        } else
        {
            $('#addcontact_count').html(msg);
            $('#addcontact_count').css({"background-color": "#FF4500", "padding": "3.5px 5px"});
            $('#addcontactLink').addClass('contact_notification_available');
        }
    }
    function waitForMsg_contact()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>business_profile/contact_count",
            async: true,
            cache: false,
            timeout: 50000,
            success: function (data) {
                addmsg_contact("new", data);
                setTimeout(
                        waitForMsg_contact,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }


    $(document).ready(function () {

        waitForMsg_contact();

    });
    $(document).ready(function () {
        $menuLeft = $('.pushmenu-left');
        $nav_list = $('#nav_list');

        $nav_list.click(function () {
            $(this).toggleClass('active');
            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
            $menuLeft.toggleClass('pushmenu-open');
        });
    });

</script>
<!-- script for fetch all unread notification end-->

<script>
    $(document).ready(function () {
        $("#addcontactBody").click(function (event) {
            $("#addcontactContainer").show();
            event.stopPropagation();
        });
        $("body").click(function (event) {
            $("#addcontactContainer").hide();
            event.stopPropagation();
        });
    });
</script>
<script type="text/javascript" >
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#addcontactContainer").hide();
        }
    });
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#InboxContainer").hide();
        }
    });


    $(document).ready(function ()
    {
        $(".dropdown_hover").click(function ()
        {
            $("#addcontactContainer").hide();
        });
    });

    $(document).ready(function ()
    {
        $("#addcontactLink").click(function ()
        {
            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            $(".dropdown-menu").hide();
            $("#dropdown-content_hover").hide();
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $("#addcontactContainer").fadeToggle(300);
            $("#addcontact_count").fadeOut("slow");
            return false;
        });
    });
//Document Click
</script>

<?php if (($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home')) { ?>
    <header>
        <div class="bg-search">
            <div class="header2 headerborder animated fadeInDownBig">
                <div class="container">
                    <div class="row">
                        <?php echo $business_search; ?>
                        <div class="col-sm-6 col-md-6 col-xs-12  h2-smladd mob-width">
                            <div class="search-mob-block">
                                <div class="">
                                    <a href="#search">
                                        <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                    </a>
                                </div>
                                <div id="search">
                                    <button type="button" class="close">×</button>
                                    <form action=<?php echo base_url('search/business_search') ?> method="get">
                                        <div class="new-search-input">
                                            <input type="text" id="tags1" class="tags" name="skills" placeholder="Companies, Category, Products">
                                            <input type="text" id="searchplace1" class="searchplace" name="searchplace" placeholder="Find Location">
                                            <button type="submit" class="btn btn-primary" onclick="return check()">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="">
                                <ul class="" id="dropdownclass">
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home') { ?> class="active" <?php } ?>><a class="bus-h" href="<?php echo base_url('business-profile/home'); ?>"><span class="home-22x22-h"></span></a>
                                    </li>
                                    <li id="add_contact">
                                        <a class="action-button shadow animate dropbtn_common" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                            <span class="bu_req"></span>
                                            <span id="addcontact_count"></span>
                                        </a>
                                        <div id="addcontactContainer" class="dropdown2_content">
                                            <div id="addcontactBody" class="notifications">
                                                <?php
                                                $contition_array = array('contact_to_id' => $userid, 'status' => 'pending');
                                                $contactperson_req = $this->common->select_data_by_condition('contact_person', $contition_array, $data = '*', $sortby = 'contact_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                $contition_array = array('contact_from_id' => $userid, 'status' => 'confirm');
                                                $contactperson_con = $this->common->select_data_by_condition('contact_person', $contition_array, $data = '*', $sortby = 'contact_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                $unique_user = array_merge($contactperson_req, $contactperson_con);

                                                $new = array();
                                                foreach ($unique_user as $value) {
                                                    $new[$value['contact_id']] = $value;
                                                }

                                                $post = array();

                                                foreach ($new as $key => $row) {
                                                    $post[$key] = $row['contact_id'];
                                                }
                                                array_multisort($post, SORT_DESC, $new);

                                                $contactperson = $new;
                                                ?>
                                                <div id="addcontactTitle">Contact Request <span class="see_link" id="seecontact"></span></div>
                                                <div class="content mCustomScrollbar light notifications" id="notification_main_in" data-mcs-theme="minimal-dark">
                                                    <div>
                                                        <ul class="notification_data_in_con">
                                                        </ul></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>  
                                    <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                        <?php } ?>
                                        <a class="action-button shadow animate dropbtn_common" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em> <span class="message3-24x24-h"></span>
                                            <span id="message_count" class="message_count"></span>
                                        </a>

                                        <div id="InboxContainer" class="dropdown2_content">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages   <span class="see_link" id="seemsg"> </span></div>
                                                <div>
                                                    <ul class="notification_data_in_h2">
                                                    </ul>
                                                </div>
                                            </div>
                                    </li>   
                                    <li>
                                        <div class="dropdown_hover">
                                            <span id="art_profile" class="dropbtn_common" >Business Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <div class="dropdown-content_hover dropdown2_content" id="dropdown-content_hover">
                                                <span class="my_account">
                                                    <div class="my_S">Account</div>
                                                </span>
                                                <a href="<?php echo base_url('business-profile/details/' . $businessdata[0]['business_slug']); ?>">
                                                    <span class="icon-view-profile edit_data"></span>
                                                    <span> View Profile </span></a> 
                                                <a href="<?php echo base_url('business-profile/business-information-update'); ?>">
                                                    <span class="icon-edit-profile edit_data"></span>  
                                                    <span>Edit Profile </span></a>
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                ?>
                                                <a onClick="deactivate(<?php echo $userid; ?>)"><span class="icon-delete edit_data"></span>  <span>Deactive Profile</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    </header>
    <?php
} else {
    ?>
    <header>
        <div class="bg-search">
            <div class="header2">
                <div class="container">
                    <div class="row">
                        <?php echo $business_search; ?>
                        <div class="col-sm-6 col-md-6 col-xs-12  h2-smladd mob-width">
                            <div class="search-mob-block">
                                <div class="">
                                    <a href="#search">
                                        <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                    </a>
                                </div>
                                <div id="search">
                                    <button type="button" class="close">×</button>
                                    <form action=<?php echo base_url('search/business_search') ?> method="get">
                                        <div class="new-search-input">
                                            <input type="text" id="tags1" name="skills" placeholder="Companies, Category, Products">
                                            <input type="text" id="searchplace1" name="searchplace" placeholder="Find Location">
                                            <button type="submit" class="btn btn-primary" onclick="return check()">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="">
                                <ul class="" id="dropdownclass">
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home') { ?> class="active" <?php } ?>><a class="bus-h" href="<?php echo base_url('business-profile/home'); ?>"><span class="home-22x22-h"></span></a>
                                    </li>
                                    <li id="add_contact">
                                        <a class="action-button shadow animate" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                            <span class="bu_req"></span>
                                            <span id="addcontact_count"></span>
                                        </a>
                                        <div id="addcontactContainer" class="dropdown2_content">
                                            <div id="addcontactBody" class="notifications">
                                                <div id="addcontactTitle">Contact Request <span class="see_link" id="seecontact"></span></div>
                                                <div class="content mCustomScrollbar light notifications" id="notification_main_in" data-mcs-theme="minimal-dark">
                                                    <div>
                                                        <ul class="notification_data_in_con">
                                                        </ul></div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>   
                                    <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                        <?php } ?>
                                        <a class="action-button shadow animate dropbtn_common" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em> <span class="message3-24x24-h"></span>
                                            <span id="message_count" class="message_count"></span>
                                        </a>

                                        <div id="InboxContainer" class="dropdown2_content">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages   <span class="see_link" id="seemsg"> </span></div>
                                                <div>
                                                    <ul class="notification_data_in_h2">

                                                    </ul>
                                                </div>
                                            </div>
                                    </li>        
                                    <li>
                                        <div class="dropdown_hover">
                                            <span id="art_profile" class="dropbtn_common">Business Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <div class="dropdown-content_hover dropdown2_content" id="dropdown-content_hover">
                                                <span class="my_account">
                                                    <div class="my_S">Account</div>
                                                </span>
                                                <a href="<?php echo base_url('business-profile/details/' . $businessdata[0]['business_slug']); ?>">
                                                    <span class="icon-view-profile edit_data"></span>
                                                    <span> View Profile </span></a> 
                                                <a href="<?php echo base_url('business-profile/business-information-edit'); ?>">
                                                    <span class="icon-edit-profile edit_data"></span>  
                                                    <span>Edit Profile </span></a>
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                ?>
                                                <a onClick="deactivate(<?php echo $userid; ?>)"><span class="icon-delete edit_data"></span>  <span>Deactive Profile</span></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    </header>
<?php } ?>
<!-- Bid-modal  -->
<div class="modal fade message-box biderror" id="bidmodal" role="dialog">
    <div class="modal-dialog modal-lm deactive">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
            <div class="modal-body">
                <span class="mes"></span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->

<script type="text/javascript">

    function deactivate(clicked_id) {
        $('.biderror .mes').html("<div class='pop_content'> Are you sure you want to deactive your business profile?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='deactivate_profile(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }

    function deactivate_profile(clicked_id) {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "business_profile/deactivate" ?>',
            data: 'id=' + clicked_id,
            success: function (data) {
                window.location = "<?php echo base_url() ?>dashboard";
            }
        });
    }
</script>

<!-- script for update all read notification start-->
<script type="text/javascript">
    function Notification_contact() {
        contactperson();
        update_contact_count();
    }
    function contactperson() {
        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/contact_notification",
            type: "POST",
            dataType: 'json',
            data: '',
            success: function (data) {
//                $('#addcontactBody').html(data.seeall);
                $('.notification_data_in_con').html(data.contactdata);
                $('#seecontact').html(data.seeall);
            }
        });
    }
    function update_contact_count() {
        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/update_contact_count",
            type: "POST",
            success: function (data) {
                //$('#addcontactBody').html(data);
            }
        });
    }
    function contactapprove(toid, status) {
        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/contact_approve",
            type: "POST",
            data: 'toid=' + toid + '&status=' + status,
            dataType: "json",
            success: function (data) {
                $('.mCS_no_scrollbar').html(data.contactdata);
                $('.contactcount').html(data.contactcount);
                var segment = '<?php echo $this->uri->segment(2); ?>';
                if (segment == 'contacts') {
                    var slug = '<?php echo $slug_id; ?>';
                    $('.art-img-nn').hide();
                    business_contacts_header(slug);
                }

                var not_contact_count = $('.addcontact-left').length;
                if (not_contact_count == 0) {
                    var data_html = "<li><div class='art-img-nn' id='art-blank'><div class='art_no_post_img'><img src='<?php echo base_url(); ?>img/No_Contact_Request.png'></div><div class='art_no_post_text'>No Contact Request Available.</div></div></li>";
                    $('#notification_main_in').html(data_html);
                    $('#seecontact').hide();
                }
            }
        });
    }
</script>
<!-- script for update all read notification end -->
<!-- all popup close close using esc start -->
<script type="text/javascript">
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            //$( "#bidmodal" ).hide();
            $('#bidmodal').modal('hide');
        }
    });
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#dropdown-content_hover").hide();
        }
    });
</script>
<!-- all popup close close using esc end-->
<script type="text/javascript" charset="utf-8">
    function addmsg1(type, msg)
    {
        if (msg == 0)
        {
            $("#message_count").html('');
            $("#message_count").removeAttr("style");
            $('#InboxLink').removeClass('msg_notification_available');
            document.getElementById('message_count').style.display = "none";
        } else
        {
            $('#message_count').html(msg);
            //     $('#message_count').css({"background-color": "#FF4500", "height": "16px", "width": "16px", "padding": "3px 4px"});
            $('#InboxLink').addClass('msg_notification_available');
            $('#message_count').addClass('count_add');
            document.getElementById('message_count').style.display = "block";
            //alert("welcome");
        }
    }
    function waitForMsg1()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>notification/select_msg_noti/6",
            async: true,
            cache: false,
            timeout: 50000,

            success: function (data) {
                addmsg1("new", data);
                setTimeout(
                        waitForMsg1,
                        10000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });
    }
    ;

    $(document).ready(function () {
        waitForMsg1();
    });
    $(document).ready(function () {
        $menuLeft = $('.pushmenu-left');
        $nav_list = $('#nav_list');

        $nav_list.click(function () {
            $(this).toggleClass('active');
            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
            $menuLeft.toggleClass('pushmenu-open');
        });
    });

</script>
<!-- script for fetch all unread message notification end-->


<!-- script for update all read notification start-->
<script type="text/javascript">
    $(document).ready(function () {

        var segment = '<?php echo "" . $this->uri->segment(1) . "" ?>';
        if (segment != "chat") {
            chatmsg();
        }
        ;
    });  // khyati chnages  start
    function chatmsg()
    {
        // khyati chnages  start

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "chat/userajax/5/5" ?>',
            dataType: 'json',
            data: '',
            success: function (data) {

                $('#userlist').html(data.leftbar);
                $('.notification_data_in_h2').html(data.headertwo);
                $('#seemsg').html(data.seeall);
                setTimeout(
                        chatmsg,
                        100000
                        );
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            }
        });

    }
    ;
    function getmsgNotification() {
        msgNotification();
//        msgheader();
    }

    function msgNotification() {
        // first click alert('here'); 
        $.ajax({
            url: "<?php echo base_url(); ?>notification/update_msg_noti/6",
            type: "POST",
            //data: {uid: 12341234}, //this sends the user-id to php as a post variable, in php it can be accessed as $_POST['uid']
            success: function (data) {
                data = JSON.parse(data);
                //alert(data);
                //update some fields with the updated data
                //you can access the data like 'data["driver"]'
            }
        });
    }
    function msgheader()
    {
        // $("#fad" + clicked_id).fadeOut(6000);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "notification/msg_header/" . $this->uri->segment(3) . "" ?>',
            data: 'message_from_profile=5&message_to_profile=5',
            success: function (data) {
                $('#' + 'notificationsmsgBody').html(data);
            }
        });

    }
</script>
<!--  commen script harshad  -->

<script type="text/javascript">

    $(document).ready(function () {

        document.getElementById('tags1').value = null;
        document.getElementById('searchplace1').value = null;

    });
</script>
