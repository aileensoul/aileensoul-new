<script>
    $(document).ready(function () {
        $("#addcontactBody").click(function (event) {
            $("#addcontactContainer").show();
            event.stopPropagation();
        });
        $("body").click(function (event) {
            $("#addcontactContainer").hide(600);
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
                        <div class="col-sm-5 col-md-6 col-xs-12  h2-smladd mob-width">
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
                                            <input type="text" id="tags1" name="skills" placeholder="Find Your Business">
                                            <input type="text" id="searchplace1" name="searchplace" placeholder="Find Your Location">
                                            <button type="submit" class="btn btn-primary" onclick="return check()">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="">
                                <ul class="" id="dropdownclass">
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home') { ?> class="active" <?php } ?>><a class="bus-h" href="<?php echo base_url('business-profile/home'); ?>"><span class="bu_home"></span></a>
                                    </li>
                                    <!-- Friend Request Start-->
                                    <li id="add_contact">
                                        <a class="action-button shadow animate" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                            <span class="bu_req"></span>
                                            <span id="addcontact_count"></span>
                                        </a>
                                        <div id="addcontactContainer">
                                            <div id="addcontactTitle">Contact Request <a class="fr" href="<?php echo base_url('business-profile/contact-list'); ?>">See All</a></div>
                                            <div id="addcontactBody" class="notifications">
                                            </div>
                                        </div>
                                    </li>  
                                    <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count;      ?></span> -->
                                        <?php } ?>
                                        <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em> <span class="img-msg"></span>

                                            <span id="message_count"></span>
                                        </a>

                                        <div id="InboxContainer">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages</div>

                                                <div id="notificationsmsgBody" class="notificationsmsg">
                                                </div>
                                            </div>
                                    </li> 
                                    <li>
                                        <div class="dropdown_hover">
                                            <span id="art_profile" >Business Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <div class="dropdown-content_hover" id="dropdown-content_hover">
                                                <span class="my_account">
                                                    <div class="my_S">Account</div>
                                                </span>
                                                <a href="<?php echo base_url('business-profile/business_resume/' . $businessdata[0]['business_slug']); ?>"><span class="h2-img h2-srrt"></span>View Profile</a> 
                                                <a href="<?php echo base_url('business-profile/business_information_update'); ?>"><span class="h3-img h2-srrt"></span> Edit Profile</a>
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                ?>
                                                <a onClick="deactivate(<?php echo $userid; ?>)"><span class="h4-img h2-srrt"></span> Deactive Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Friend Request End-->
                                    <!-- END USER LOGIN DROPDOWN -->
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
                        <div class="col-sm-5 col-md-6 col-xs-12  h2-smladd mob-width">
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
                                            <input type="text" id="tags1" name="skills" placeholder="Find Your Business">
                                            <input type="text" id="searchplace1" name="searchplace" placeholder="Find Your Location">
                                            <button type="submit" class="btn btn-primary" onclick="return check()">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="">
                                <ul class="" id="dropdownclass">
                                    <li <?php if ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home') { ?> class="active" <?php } ?>><a class="bus-h" href="<?php echo base_url('business-profile/home'); ?>"><span class="bu_home"></span></a>
                                    </li>
                                    <!-- Friend Request Start-->
                                    <li id="add_contact">
                                        <a class="action-button shadow animate" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                           <!--  <span class="hidden-xs">Contact Request &nbsp;</span>  -->
                                            <span class="bu_req"></span>
                                            <span id="addcontact_count"></span>
                                        </a>
                                        <div id="addcontactContainer">
                                            <div id="addcontactTitle">Contact Request <a class="fr" href="<?php echo base_url('business-profile/contact-list'); ?>">See All</a></div>
                                            <div id="addcontactBody" class="notifications">
                                            </div>
                                        </div>
                                    </li>  
                                    <li id="Inbox_link">
                                        <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em> <span class="img-msg"></span>
                                            <span id="message_count"></span>
                                        </a>
                                        <div id="InboxContainer">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages</div>
                                                <div id="notificationsmsgBody" class="notificationsmsg">
                                                </div>
                                            </div>
                                    </li>        
                                    <li>
                                        <div class="dropdown_hover">
                                            <span id="art_profile" >Business Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                            <div class="dropdown-content_hover" id="dropdown-content_hover">
                                                <span class="my_account">
                                                    <div class="my_S">Account</div>
                                                </span>
                                                <a href="<?php echo base_url('business-profile/details/' . $businessdata[0]['business_slug']); ?>"><span class="h2-img h2-srrt"></span>View Profile</a> 
                                                <a href="<?php echo base_url('business-profile/business-information-edit'); ?>"><span class="h3-img h2-srrt"></span> Edit Profile</a>
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                ?>
                                                <a onClick="deactivate(<?php echo $userid; ?>)"><span class="h4-img h2-srrt"></span> Deactive Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- Friend Request End-->
                                    <!-- END USER LOGIN DROPDOWN -->
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
            success: function (data) {
                $('#addcontactBody').html(data);
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
            success: function (data) {
                $('#addcontactBody').html(data);
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
        { //alert(1234);
            $("#message_count").html('');
            $("#message_count").removeAttr("style");
            $('#InboxLink').removeClass('msg_notification_available');
        } else
        {
            $('#message_count').html(msg);
            //     $('#message_count').css({"background-color": "#FF4500", "height": "16px", "width": "16px", "padding": "3px 4px"});
            $('#InboxLink').addClass('msg_notification_available');
            $('#message_count').addClass('count_add');
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

    function getmsgNotification() {
        msgNotification();
        msgheader();
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