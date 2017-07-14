<!-- header -->

<!-- <script type="text/javascript">
$(window).load(function(){
        $('#message_count').hide();
        return false;
    });
</script> -->
<head> 
    <meta charset="utf-8" />
    <!-- SEO CHANGES START -->
    <meta name="google-site-verification" content="BKzvAcFYwru8LXadU4sFBBoqd0Z_zEVPOtF0dSxVyQ4" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <!-- SEO CHANGES END -->
    <!-- NEED TO ADD FOLLOWING TAG IN HEADER -->
    <link rel="canonical" href="http://www.aileensoul.com" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="description" content=" " />
    <meta name="keywords" content=" " />
    <!-- Add following GoogleAnalytics tracking code in Header.-->
    <!-- 
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-91486853-1', 'auto');
      ga('send', 'pageview');
    
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6060111582812113",
        enable_page_level_ads: true
      });
    </script>
    -->
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
    <!-- CSS START -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('z2/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_new.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_harshad.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style_yatin.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/media.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/lato.css'); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('zalak/css/style.css'); ?>">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url('zalak/css/demo.css'); ?>">

   
</head>

<!-- style for span id=notification_count start-->
<style>

    /*style for span id=notification_count start*/
    .msg_dot{padding: 0!important;}
    #notification_count
    {   padding: 3px;
        background: #1b8ab9;
        color: #ffffff;
        font-weight: bold;
        margin-left: 7px;
        /* border-radius: 80%; */
        -moz-border-radius: 9px;
        -webkit-border-radius: 2px;
        position: absolute;
        margin-top: -1px;
      
    }
    /*style for span id=notification_count End*/

    /*style for span id=message_count start*/


    #message_count
    {
        padding: 3px;
        background: #1b8ab9;
        color: #ffffff;
        font-weight: bold;
        margin-left: 7px;
        /* border-radius: 80%; */
        -moz-border-radius: 9px;
        -webkit-border-radius: 2px;
        position: absolute;

        margin-top: -2px;font-size: 10px;
        top: 9px;
        line-height: normal;
        right: 11px;
    }
    /*style for span id=message_count End*/

</style>
<!-- style for span id=notification_count end-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/animate.css" />
<!-- script for fetch all unread notification start-->
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php // echo base_url('js/script.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php //echo base_url('js/select2_new.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script> 
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.6/jquery.mousewheel.min.js'></script>
</body>
</html>
<script type="text/javascript">
var dragging = false;
var clientY = 0;

$(document).ready(function(event) {
  $(".noti").each(function() { 
    var viewportHeight = $(".noti").outerHeight();
    var totalHeight = $(".noti").prop("scrollHeight");
  
    var scrollUnitHeight = (viewportHeight / totalHeight) * viewportHeight;
  
    $(".noti .scroll span").height(scrollUnitHeight);
  });
  
  $(document).on('mousewheel', '.noti', function(event) {
    var scrollLocation = $(this).find(".scroll span").position().top;
    moveScrollTo($(this), scrollLocation - (event.deltaY * 10));
    
    event.preventDefault();
    return false;
  });
  
  $(window).on("mouseup", function(event) {
    if (dragging) {
      dragging = false;
      $(".scrolling").removeClass("scrolling");
      
      event.preventDefault();
      return false;
    }
  });
  
  $(".noti .scroll span").on("mousedown", function(event) {
    clientY = event.clientY - $(this).position().top;
    dragging = true;
    $(this).parents(".noti").addClass("scrolling");
    
    event.preventDefault();
    return false;
  });
  
  $(document).on("click", ".scroll", function(event) {
    if ($(event.target).is("span")) {
      return;
    }
    
    var scrollPosition = event.clientY - 15;
    moveScrollTo($(this).parents(".noti"), scrollPosition);
  });
  
  $(window).on("mousemove", function(event) {
    if (dragging) {
      var scrollPosition = event.clientY - clientY;
      moveScrollTo($(".scrolling"), scrollPosition);
      
      event.preventDefault();
    }
  });
});

function moveScrollTo(parent, scrollPosition) {    
  if (parent.length > 0) {
    var viewportHeight = parent.outerHeight();
    var limitedViewportHeight = viewportHeight - parent.find(".scroll span").height();
    
    var totalHeight = parent.prop("scrollHeight");

    if (scrollPosition < 0) {
      scrollPosition = 0;
    }
    
    var scrollSpanPosition = scrollPosition;
    
    if (scrollSpanPosition > viewportHeight - parent.find(".scroll span").height()) {
      scrollSpanPosition = viewportHeight - parent.find(".scroll span").height();
    }
    
    if (scrollPosition > viewportHeight) {
      scrollPosition = viewportHeight;
    }
    
    parent.find(".scroll span").css("top", scrollSpanPosition);

    parent.find(".scroll").css("top", (scrollSpanPosition / viewportHeight) * totalHeight);

    parent.scrollTop((scrollSpanPosition / viewportHeight) * totalHeight);
  }
}
</script>
<script type="text/javascript" charset="utf-8">

    function addmsg(type, msg)
    {

        if (msg == 0)
        {
            $("#notification_count").html('');


        } else
        {
            $('#notification_count').html(msg);
            $('#notification_count').css({"background-color": "#FF4500", "padding": "3px"});

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
            error: function (XMLHttpRequest, textStatus, errorThrown) {
//                addmsg("error", textStatus + " (" + errorThrown + ")");
//                setTimeout(
//                        waitForMsg,
//                        15000);
            }
        });
    }
    ;

    $(document).ready(function () {

        waitForMsg();

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

<!-- script for fetch all unread message notification start-->

<script type="text/javascript" charset="utf-8">

    function addmsg1(type, msg)
    {
        if (msg == 0)
        {
            $("#message_count").html('');

        } else
        {
            $('#message_count').html(msg);
            $('#message_count').css({"background-color": "#FF4500", "padding": "3px"});
            //alert("welcome");
        }


    }

    function waitForMsg1()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>notification/select_msg_noti",

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
//                addmsg1("error", textStatus + " (" + errorThrown + ")");
//                setTimeout(
//                        waitForMsg1,
//                        15000);
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


<!-- script for fetch all conatct notification start -->
<script type="text/javascript">


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
//                addmsg("error", textStatus + " (" + errorThrown + ")");
//                setTimeout(
//                        waitForMsg,
//                        15000);
            }
        });
    }
    ;

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
</script>

<!-- scrpt for fatch a;; conatct notification end -->


<!-- script header notifaction-->
<!-- Click event on body hide the element notification & Message start -->
<script>
    $(document).ready(function () {
        $("body").click(function (event) {
            $("#notificationContainer").hide(600);
           // event.stopPropagation();
        });

    });

    $(document).ready(function () {
        $("body").click(function (event) {
            $("#InboxContainer").hide(600);

           // event.stopPropagation();
        });

    });



    $(document).ready(function () {
        $('.dropdown-user').click(function (event) {
        event.stopPropagation();
            $(".dropdown-menu").slideToggle("fast");
        });
        $(".dropdown-menu").on("dropdown-user", function (event) {
           // event.stopPropagation();
        });
    });

    $(document).on("dropdown-user", function () {
        $(".dropdown-menu").hide();
    });

    $(document).ready(function () {
        $("body").click(function (event) {
            $(".dropdown-menu").hide(600);
          //event.stopPropagation();
        });

    });

</script>
<!-- Click event on button show the element notification & Message end-->

<script type="text/javascript" >

// click on escape notification & message drop down close start
$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( "#notificationContainer" ).hide();
    }
});

$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( "#InboxContainer" ).hide();
    }
});
// click on escape notification & message drop down close end


    $(document).ready(function ()
    {
        $("#notificationLink").click(function ()
        {
//$("#notificationLink").hide();
                
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

    });

//Document Click
    $(document).ready(function ()
    {
        $("#InboxLink").click(function ()
        {
//$("#notificationLink").hide();

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

    });

    $(document).ready(function ()
    {
        $(".dropdown-user").click(function ()
        {
//$("#notificationLink").hide();

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

    });

    $(document).ready(function ()
    {
        $(".dropdown_hover").click(function ()
        {
//$("#notificationLink").hide();

            $("#Frnd_reqContainer").hide();
            $("#Frnd_req_count").hide();

            $("#notificationContainer").hide();
            $("#notification_count").hide();
            $("#InboxContainer").hide();
            $("#Inbox_count").hide();
//$(".dropdown-user").hide();
            return true;
        });

    });

</script>



<script type="text/javascript">
    $(document).ready(function () {
        // Show hide popover
        $("myDropdown").click(function () {
            $(this).find(".dropdown-menu").slideToggle("slow");
        });
    });
    $(document).on("click", function (event) {
        var $trigger = $(".myDropdown");
        if ($trigger !== event.target && !$trigger.has(event.target).length) {
            $(".myDropdown").slideUp("slow");
        }
    });
</script>

<!-- -->
<body class="pushmenu-push">
<!-- 
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> This alert box could indicate a successful or positive action.
  </div> -->

  <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'recommen_candidate') || ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_all_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'recommen_candidate') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_apply_post') || ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_post') || ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post')){?>
    <header class="">
        <div class="header animated fadeInDownBig">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 col-xs-5 mob-zindex">
                        <!-- <div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('images/logo-white.png'); ?>"></a></div> -->
                        <div class="logo">
                            <a tabindex="-200" href="<?php echo base_url('dashboard') ?>"> <h2  style="color: white;">Aileensoul</h2></a>
                        </div>
                    </div>

                    
<?php 
   $userid = $this->session->userdata('aileenuser');
if($userid){?>
                    <div class="col-md-8 col-sm-7 col-xs-7 header-left-menu">
                        <div class="main-menu-right">
                            <ul class="">


                                <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                <li><a class=" action-button shadow animate" onclick="return leave_page(5)">All</a></li>

                                 <?php }else{?>

                                 <li><a class=" action-button shadow animate" href="<?php echo base_url('dashboard') ?>"><img class="h-img" src="<?php echo base_url(); ?>img/header_icon_menu.png">
</a></li>
                                 <?php } ?>

                               

  <!-- <li><a href="#" id="notificationLink" onclick = "return getNotification()">Notification <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
      <span id="notification_count"></span>
  </a></li> -->
                                <!-- general notification start -->
                                <li id="notification_li">
                                    <a class="action-button shadow animate" href="javascript:void(0)" id="notificationLink" onclick = "return Notificationheader();"><em class="hidden-xs"></em> <img class="h-img" src="<?php echo base_url(); ?>img/header_icon_notification.png">

                                        <span id="notification_count"></span>

                                    </a><div id="notificationContainer">
                                        <div id="notificationTitle">Notifications</div>

                                        <div id="notificationsBody" class="notifications ">


                                        </div>
                                </li>
                                <!-- general notification end -->
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                ?>

                            <!-- <li><a href="<?php //echo base_url('message/message_chat/')      ?>">Message <i class="fa fa-commenting" aria-hidden="true"></i></a></li> -->
                                <li id="Inbox_link">
                                    <?php if  ($message_count) { ?>
                                                   <!--  <span class="badge bg-theme"><?php //echo $message_count; ?></span> -->
                                    <?php } ?>
                                    <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em><img class="h-img"src="<?php echo base_url(); ?>img/header_icon_message.png">
                                        <span id="message_count"></span>
                                    </a>

                                    <div id="InboxContainer">
                                        <div id="InboxBody" class="Inbox">
                                           <div id="notificationTitle">Messages</div>

                                            <div id="notificationsmsgBody" class="notificationsmsg">


                                            </div>
                                
                                 <?php if($message_seeall){   ?> 
                                     <div id="InboxFooter"><a href="<?php echo base_url('chat') ?>">See All</a></div>
                             <?php    } ?>
                                           
                                        </div>
                                </li>

                           <!--  <li><a href="<?php //echo base_url('friendrequest')      ?>">Friend Request <i class="fa fa-user" aria-hidden="true"></i></a></li> -->

                                <!-- BEGIN USER LOGIN DROPDOWN -->
                                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                <li class="dropdown dropdown-user">

                                    <a class="dropbtn action-button shadow animate" href="javascript:void(0)" type="button" id="menu1" data-toggle="dropdown" >
                                        <!-- <div id="hi" class="notifications"> -->
                                        <?php if ($userdata[0]['user_image'] != '') { ?>
                                            <img alt="" class="img-circle" src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" height="50" width="50" alt="Smiley face" />
                                        <?php } else { ?>
                                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                                        <?php } ?>

                                        <span class="u2 username username-hide-on-mobile hidden-xs"> <?php
                                            if (isset($userdata[0]['first_name'])) {
                                                echo $userdata[0]['first_name'];
                                            }
                                            ?> </span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>

                                    </a>


                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="myDropdown">

                                        <!-- <li>
                                        <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(6)">
                                                <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
                                
                                 <?php }else{?>

                               <a href="<?php echo base_url() . 'profile' ?>">
                                                <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
                                 <?php } ?>
                                            
                                        </li>
                                        <li>
                                        <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(7)">
                                                <i class="fa fa-exchange" aria-hidden="true"></i> Change password </a>
                                
                                 <?php }else{?>

                              <a href="<?php echo base_url('registration/changepassword') ?>">
                                                <i class="fa fa-exchange" aria-hidden="true"></i> Change password </a>
                                 <?php } ?>
                                            
                                        </li> -->
                                        <li class="my_account">
                                        <div class="my_S">Account</div>
                                            
                                        </li>
                                        <li class="Setting">
                                            <a href="<?php echo base_url('profile') ?>">
                                                <i class="fa fa-cog" aria-hidden="true"></i> Setting</a> 
                                        </li>
                                        <li class="logout">
                                         <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(8)">
                                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                                
                                 <?php }else{?>

                               <a href="<?php echo base_url('dashboard/logout') ?>">
                                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                                 <?php } ?>
                                           

                                            <!--                                            Logout-->
                                        </li>

                                    </ul>
                                    <!--  </div> -->
                                </li>


                                <!-- Friend Request Start-->
                                <!--  -->
                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div>
                    </div>


                    <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php } else
    { ?>
 <header class="">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5 col-xs-5 mob-zindex">
                        <!-- <div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('images/logo-white.png'); ?>"></a></div> -->
                        <div class="logo">
                            <a tabindex="-200" href="<?php echo base_url('dashboard') ?>"> <h2  style="color: white;">Aileensoul</h2></a>
                        </div>
                    </div>

                    
<?php 
   $userid = $this->session->userdata('aileenuser');
if($userid){?>
                    <div class="col-md-8 col-sm-7 col-xs-7 header-left-menu">
                        <div class="main-menu-right">
                            <ul class="">


                                <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                <li><a class=" action-button shadow animate" onclick="return leave_page(5)">All</a></li>

                                 <?php }else{?>

                                 <li><a class=" action-button shadow animate" href="<?php echo base_url('dashboard') ?>">
                                         <img class="h-img" src="<?php echo base_url(); ?>img/header_icon_menu.png">
</a></li>
                                 <?php } ?>

                               

  <!-- <li><a href="#" id="notificationLink" onclick = "return getNotification()">Notification <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
      <span id="notification_count"></span>
  </a></li> -->
                                <!-- general notification start -->
                                <li id="notification_li">
                                    <a class="action-button shadow animate" href="javascript:void(0)" id="notificationLink" onclick = "return Notificationheader();"><em class="hidden-xs"></em> <img class="h-img" src="<?php echo base_url(); ?>img/header_icon_notification.png">

                                        <span id="notification_count"></span>

                                    </a><div id="notificationContainer">
                                        <div id="notificationTitle">Notifications</div>

                                        <div id="notificationsBody" class="notifications noti">

                                            <div class="scroll">
    <span></span>
  </div>
                                        </div>
                                </li>
                                <!-- general notification end -->
                                <?php
                                $userid = $this->session->userdata('aileenuser');
                                ?>

                            <!-- <li><a href="<?php //echo base_url('message/message_chat/')      ?>">Message <i class="fa fa-commenting" aria-hidden="true"></i></a></li> -->
                                <li id="Inbox_link">
                                    <?php if  ($message_count) { ?>
                                                   <!--  <span class="badge bg-theme"><?php //echo $message_count; ?></span> -->
                                    <?php } ?>
                                    <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em><img class="h-img" src="<?php echo base_url(); ?>img/header_icon_message.png">
                                        <span id="message_count"></span>
                                    </a>

                                    <div id="InboxContainer">
                                        <div id="InboxBody" class="Inbox">
                                           <div id="notificationTitle">Messages</div>

                                            <div id="notificationsmsgBody" class="notificationsmsg">


                                            </div>
                                
                                 <?php if($message_seeall){   ?> 
                                     <div id="InboxFooter"><a href="<?php echo base_url('chat') ?>">See All</a></div>
                             <?php    } ?>
                                           
                                        </div>
                                </li>

                           <!--  <li><a href="<?php //echo base_url('friendrequest')      ?>">Friend Request <i class="fa fa-user" aria-hidden="true"></i></a></li> -->

                                <!-- BEGIN USER LOGIN DROPDOWN -->
                                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                <li class="dropdown dropdown-user">

                                    <a class="dropbtn action-button shadow animate" href="javascript:void(0)" type="button" id="menu1" data-toggle="dropdown" >
                                        <!-- <div id="hi" class="notifications"> -->
                                        <?php if ($userdata[0]['user_image'] != '') { ?>
                                            <img alt="" class="img-circle" src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" height="50" width="50" alt="Smiley face" />
                                        <?php } else { ?>
                                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                                        <?php } ?>

                                        <span class="u2 username username-hide-on-mobile hidden-xs"> <?php
                                            if (isset($userdata[0]['first_name'])) {
                                                echo $userdata[0]['first_name'];
                                            }
                                            ?> </span>
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>

                                    </a>


                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1" id="myDropdown">

                                        <!-- <li>
                                        <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(6)">
                                                <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
                                
                                 <?php }else{?>

                               <a href="<?php echo base_url() . 'profile' ?>">
                                                <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
                                 <?php } ?>
                                            
                                        </li>
                                        <li>
                                        <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(7)">
                                                <i class="fa fa-exchange" aria-hidden="true"></i> Change password </a>
                                
                                 <?php }else{?>

                              <a href="<?php echo base_url('registration/changepassword') ?>">
                                                <i class="fa fa-exchange" aria-hidden="true"></i> Change password </a>
                                 <?php } ?>
                                            
                                        </li> -->
                                        <li class="my_account">
                                        <div class="my_S">Account</div>
                                            
                                        </li>
                                        <li class="Setting">
                                            <a href="<?php echo base_url('profile') ?>">
                                                <i class="fa fa-cog" aria-hidden="true"></i> Setting</a> 
                                        </li>
                                        <li class="logout">
                                         <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               <a  onclick="return leave_page(8)">
                                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                                
                                 <?php }else{?>

                               <a href="<?php echo base_url('dashboard/logout') ?>">
                                                <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                                 <?php } ?>
                                           

                                            <!--                                            Logout-->
                                        </li>

                                    </ul>
                                    <!--  </div> -->
                                </li>


                                <!-- Friend Request Start-->
                                <!--  -->
                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div>
                    </div>


                    <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

      <?php  }?>

    
  <div id="aDiv" class="" style="margin-top: 150px;">
  The oldest classical Greek and Latin writing had little or no spaces between words or other ones, and could be written in boustrophedon (alternating directions). Over time, text direction (left to right) became standardized, and word dividers and terminal punctuation became common. The first way to divide sentences into groups was the original paragraphos, similar to an underscore at the beginning of the new group.[3] The Greek paragraphos evolved into the pilcrow (¶), which in English manuscripts in the Middle Ages can be seen inserted inline between sentences. The hedera leaf (e.g. ☙) has also been used in the same way.

In ancient manuscripts, another means to divide sentences in into paragraphs was a line break (newline) followed by an initial at the beginning of the next paragraph. An initial is an oversize capital letter, sometimes outdented beyond the margin of text. This style can be seen, for example, in the original Old English manuscript of Beowulf. Outdenting is still used in English typography, though not commonly.[4] Modern English typography usually indicates a new paragraph by indenting the first line. This style can be seen in the (handwritten) United States Constitution from 1787. For additional ornamentation, a hedera leaf or other symbol can be added to the inter-paragraph whitespace, or put in the indentation space.

A second common modern English style is to use no indenting, but add vertical whitespace to create "block paragraphs". On a typewriter, a double carriage return produces a blank line for this purpose; professional typesetters may put in an arbitrary vertical space by adjusting leading. This style is very common in electronic formats, such as on the World Wide Web and email.
  <div class="scroll">
    <span></span>
  </div>
</div>

    <!-- header end -->

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
                //data: {uid: 12341234}, //this sends the user-id to php as a post variable, in php it can be accessed as $_POST['uid']
                success: function (data) {
                    data = JSON.parse(data);
                    //alert(data);
                    //update some fields with the updated data
                    //you can access the data like 'data["driver"]'
                }
            });

        }

        function notheader()
        {

            // $("#fad" + clicked_id).fadeOut(6000);


            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "notification/not_header" ?>',
                data: '',
                success: function (data) {
                    //    alert(data);
                    $('#' + 'notificationsBody').html(data);

                }


            });

        }

    </script>
    <!-- script for update all read notification end -->

    <!-- script for update all read notification start-->
    <script type="text/javascript">

        function getmsgNotification() {
            msgNotification();
            msgheader();

        }

        function msgNotification() {
            // first click alert('here'); 

            $.ajax({
                url: "<?php echo base_url(); ?>notification/update_msg_noti",
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
                data: '',
                success: function (data) {
                    //    alert(data);
                    $('#' + 'notificationsmsgBody').html(data);

                }


            });

        }
    </script>
    <!------  commen script harshad  ---------------->
    <script>
        jQuery(document).ready(function($) {
         if(screen.width <= 767){
             
             $("ul.left-form-each").on("click", ".init", function() {
                $(this).closest("ul").children('li:not(.init)').toggle();
            });

            var allOptions = $("ul").children('li:not(.init)');
            $("ul.left-form-each").on("click", "li:not(.init)", function() {
                allOptions.removeClass('selected');
                $(this).addClass('selected');
                $("ul.left-form-each").children('.init').html($(this).html());
                allOptions.toggle();
            });
             
             
          
            }
            
            
           $(function () {
                $('a[href="#search"]').on('click', function(event) {
                    event.preventDefault();
                    $('#search').addClass('open');
                    $('#search > form > input[type="search"]').focus();
                });

                $('#search, #search button.close').on('click keyup', function(event) {
                    if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                        $(this).removeClass('open');
                    }
                });

            });
        });
    </script>
    <!-- script for update all read notification end -->
<!-- <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
    -->

    <!-- Extra js if not work then add Start-->
    <!-- <script type="text/javascript" src="<?php //echo base_url('js/jquery.min-notification.js');      ?>"></script> -->
    <!-- Extra js if not work then add End-->

