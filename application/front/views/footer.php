<!-- IMAGE PRELOADER SCRIPT -->
<script type="text/javascript">
 function preload(arrayOfImages) {
    $(arrayOfImages).each(function () {
        $('<img />').attr('src',this).appendTo('body').css('display','none');
    });
}
</script>
<!-- IMAGE PRELOADER SCRIPT -->
<!-- script for update all read notification start-->
<script type="text/javascript">
    function Notificationheader() {
        getNotification();
        notheader();
    }
    function getNotification() {
        // first click alert('here'); 
        $.ajax({
            url: "<?php echo base_url(); ?>notification/update_notification",
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
            }
        });
    }
    function notheader()
    {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "notification/not_header" ?>',
            data: '',
            success: function (data) {
                $('#' + 'notificationsBody').html(data);
            }
        });
    }

    jQuery(document).ready(function ($) {
        if (screen.width <= 767) {
            $("ul.left-form-each").on("click", ".init", function () {
                $(this).closest("ul").children('li:not(.init)').toggle();
            });
            var allOptions = $("ul").children('li:not(.init)');
            $("ul.left-form-each").on("click", "li:not(.init)", function () {
                allOptions.removeClass('selected');
                $(this).addClass('selected');
                $("ul.left-form-each").children('.init').html($(this).html());
                allOptions.toggle();
            });
        }
        $(function () {
            $('a[href="#search"]').on('click', function (event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search > form > input[type="search"]').focus();
            });
            $('#search, #search button.close').on('click keyup', function (event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });
        });
    });

    $(document).ready(function () {
        // MAIN NOTIFICATION
        waitForMsg();
        $menuLeft = $('.pushmenu-left');
        $nav_list = $('#nav_list');
        $nav_list.click(function () {
            $(this).toggleClass('active');
            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
            $menuLeft.toggleClass('pushmenu-open');
        });
        // CONTACT PERSON COUNT
        waitForMsg_contact();
        $menuLeft = $('.pushmenu-left');
        $nav_list = $('#nav_list');
        $nav_list.click(function () {
            $(this).toggleClass('active');
            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
            $menuLeft.toggleClass('pushmenu-open');
        });
        // CONTAINER HIDE : NOTIFICATION, PROFILEBOX, MESSAGEBOX
        $("body").click(function (event) {
            $("#notificationContainer").hide(600);
            $("#InboxContainer").hide(600);
            $(".dropdown-menu").hide(600);
            $("#acon").hide(600);
        });
        // EDIT PROFILE DROPDOWN 
        $('.dropdown-user').click(function (event) {
            event.stopPropagation();
            $(".dropdown-menu").slideToggle("fast");
        });
        $(".dropdown-menu").on("dropdown-user", function (event) {
            // event.stopPropagation();
        });

        //ON CLICK GENERAL NOTIFICATION ICON EVENT IN HEADER
        $("#notificationLink").click(function ()
        {
            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            $(".dropdown-menu").hide();
            $("#dropdown-content_hover").hide();
            $("#addcontactContainer").hide();
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $("#notificationContainer").fadeToggle(300);
            $("#notification_count").fadeOut("slow");
            return false;
        });
        //ON CLICK MESSAGE NOTIFICATION ICON EVENT IN HEADER
        $("#InboxLink").click(function ()
        {
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $(".dropdown-menu").hide();
            $("#addcontactContainer").hide();
            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#dropdown-content_hover").hide();
            $("#InboxContainer").fadeToggle(300);
            $("#Inbox_count").fadeOut("slow");
            return false;
        });
        //ON CLICK USER PROFILE NOTIFICATION ICON EVENT IN HEADER
        $(".dropdown-user").click(function ()
        {
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $("#addcontactContainer").hide();
            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            $("#dropdown-content_hover").hide();
            return true;
        });
        //ON CLICK USER PROFILE NOTIFICATION DROPDOWN HOVER ICON EVENT IN HEADER 
        $(".dropdown_hover").click(function ()
        {
            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();
            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            return true;
        });
        // SHOW HIDE POPOVER
        $("myDropdown").click(function () {
            $(this).find(".dropdown-menu").slideToggle("slow");
        });
    });

    function addmsg(type, msg)
    {
        if (msg == 0)
        {
            $("#notification_count").html('');
            $('#notificationLink').removeClass('notification_available');
        } else
        {
            $('#notification_count').html(msg);
            $('#notification_count').css({"background-color": "#FF4500", "padding": "5px 6px"});
            $('#notificationLink').addClass('notification_available');
        }
    }
    function waitForMsg()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>notification/select_notification",
            async: true,
            cache: false,
            timeout: 50000,
            success: function (data) {
                addmsg("new", data);
                setTimeout(
                        waitForMsg,
                        10000
                        );
            },
        });
    }
    
    
    function addmsg_contact(type, msg)
    {
        if (msg == 0)
        {
            $("#addcontact_count").html('');
        } else
        {
            $('#addcontact_count').html(msg);
            $('#addcontact_count').css({"background-color": "#FF4500", "padding": "3px"});
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

    // USER PROFILE DROPDOWN IN HEADER
    $(document).on("dropdown-user", function () {
        $(".dropdown-menu").hide();
    });
    // CLICK ON ESCAPE NOTIFICATION & MESSAGE DROP DOWN CLOSE START
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#notificationContainer").hide();
        }
    });


    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#InboxContainer").hide();
            $("#acon").hide();
        }
    });
    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $("#acon").hide();
        }
    });
    $(document).on("click", function (event) {
        var $trigger = $(".myDropdown");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".myDropdown").slideUp("slow");
        }
    });
    // CLICK ON ESCAPE NOTIFICATION & MESSAGE DROP DOWN CLOSE END

    $(document).ready(function ()
    {
        $("#alink").click(function ()
        {
            $("#acon").fadeToggle(300);
            $("#acont").fadeOut("slow");

            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
            $(".dropdown-menu").hide();
            $("#dropdown-content_hover").hide();
            $("#addcontactContainer").hide();
            $("#notificationContainer").hide();
            $("#notification_count").hide();


            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();


            return false;
        });

    });

</script>


<!-- footer end -->