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
        $("#addcontactLink").click(function ()
        {
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $(".dropdown-menu").hide();
            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#dropdown-content_hover").hide();
            $("#InboxContainer").fadeToggle(300);
            $("#Inbox_count").fadeOut("slow");
            return false;
        });
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

<header>
    <div class="bg-search">
        <div class="header2 headerborder animated fadeInDownBig">
            <div class="container">
                <div class="row">
                    <?php echo $business_search; ?>
                    <div class="col-sm-5 col-md-6 col-xs-6 mob-width">
                        <div class="search-mob-block">
                            <div class="">
                                <a href="#search">
                                    <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                </a>
                            </div>
                            <div id="search">
                                <button type="button" class="close">×</button>
                                <form>
                                    <div class="new-search-input">
                                        <input type="search" value="" placeholder="Find Your Job" />
                                        <input type="search" value="" placeholder="Find Your Location" />
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="">
                            <ul id="dropdownclass">
                                <li <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_post') { ?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_post'); ?>"><img src="<?php echo base_url(); ?>img/icon_home.png"></a>
                                </li>
                                <!-- Friend Request Start-->
                                <li id="add_contact">
                                    <a class="action-button shadow animate" href="javascript:void(0)" id="addcontactLink" onclick = "return Notification_contact();">
                                        <img src="<?php echo base_url(); ?>img/icon_contact_request.png">
                                        <span id="addcontact_count"></span>
                                    </a>
                                    <div id="addcontactContainer">
                                        <div id="addcontactTitle">Contact Request</div>
                                        <div id="addcontactBody" class="notifications">
                                        </div>
                                        <div id="addcontactFooter"><a href="<?php echo base_url('business_profile/contact_list'); ?>">See All</a></div>
                                    </div>
                                </li>          
                                <li>
                                    <div class="dropdown_hover">
                                        <span id="art_profile" >Business Profile <i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <div class="dropdown-content_hover" id="dropdown-content_hover">
                                            <span class="my_account">
                                                <div class="my_S">Account</div>
                                            </span>
                                            <a href="<?php echo base_url('business_profile/business_resume/' . $businessdata[0]['business_slug']); ?>"><span class="h2-img h2-srrt"></span> View Profile</a> 
                                            <a href="<?php echo base_url('business_profile/business_information_update'); ?>"><span class="h3-img h2-srrt"></span> Edit Profile</a>
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
    $(document).ready(function () {
        $('.dropdown_hover').click(function (event) {
            event.stopPropagation();
            $(".dropdown-content_hover").slideToggle("fast");
        });
        $(".dropdown-content_hover").on("dropdown_hover", function (event) {
            event.stopPropagation();
        });
    });

    $(document).on("dropdown_hover", function () {
        $(".dropdown-content_hover").hide();
    });

    $(document).ready(function () {
        $("body").click(function (event) {
            $(".dropdown-content_hover").hide();
            event.stopPropagation();
        });
    });
</script>

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