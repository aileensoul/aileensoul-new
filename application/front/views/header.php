<!-- style for span id=notification_count start-->
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style.css'); ?>">
<!-- style for span id=notification_count end-->
<body class="pushmenu-push">
    <!-- 
     <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> This alert box could indicate a successful or positive action.
      </div> -->
    <header>
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
                    if ($userid) {
                        ?>
                        <div class="col-md-8 col-sm-7 col-xs-7 header-left-menu">
                            <div class="main-menu-right">
                                <ul class="">


    <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')) { ?>
                                        <li><a class=" action-button shadow animate" onclick="return leave_page(5)">All</a></li>

    <?php } else { ?>

                                        <li><a class=" action-button shadow animate" href="<?php echo base_url('dashboard') ?>"><i class="fa fa-th" aria-hidden="true"></i>
                                            </a></li>
    <?php } ?>



      <!-- <li><a href="#" id="notificationLink" onclick = "return getNotification()">Notification <i class="fa fa-bell-slash-o" aria-hidden="true"></i>
          <span id="notification_count"></span>
      </a></li> -->
                                    <!-- general notification start -->
                                    <li id="notification_li">
                                        <a class="action-button shadow animate" href="javascript:void(0)" id="notificationLink" onclick = "return Notificationheader();"><em class="hidden-xs"></em> <i class="fa fa-bell" aria-hidden="true"></i>

                                            <span id="notification_count"></span>

                                        </a><div id="notificationContainer">
                                            <div id="notificationTitle">Notifications</div>

                                            <div id="notificationsBody" class="notifications">


                                            </div>
                                    </li>
                                    <!-- general notification end -->
                                    <?php
                                    $userid = $this->session->userdata('aileenuser');
                                    ?>

                                <!-- <li><a href="<?php //echo base_url('message/message_chat/')       ?>">Message <i class="fa fa-commenting" aria-hidden="true"></i></a></li> -->
                                    <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count; ?></span> -->
    <?php } ?>
                                        <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em><i class="fa fa-commenting" aria-hidden="true"></i>
                                            <span id="message_count"></span>
                                        </a>

                                        <div id="InboxContainer">
                                            <div id="InboxBody" class="Inbox">


                                                <div id="notificationsmsgBody" class="notificationsmsg">


                                                </div>

                                                <?php if ($message_seeall) { ?> 
                                                    <div id="InboxFooter"><a href="<?php echo base_url('chat') ?>">See All</a></div>
    <?php } ?>

                                            </div>
                                    </li>

                               <!--  <li><a href="<?php //echo base_url('friendrequest')       ?>">Friend Request <i class="fa fa-user" aria-hidden="true"></i></a></li> -->

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
    <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')) { ?>
                                        
                                       <a  onclick="return leave_page(6)">
                                                        <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
                                        
    <?php } else { ?>

                                       <a href="<?php echo base_url() . 'profile' ?>">
                                                        <i class="fa fa-user" aria-hidden="true"></i> Edit Profile </a>
    <?php } ?>
                                                
                                            </li>
                                            <li>
    <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')) { ?>
                                        
                                       <a  onclick="return leave_page(7)">
                                                        <i class="fa fa-exchange" aria-hidden="true"></i> Change password </a>
                                        
    <?php } else { ?>

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
    <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')) { ?>

                                                    <a  onclick="return leave_page(8)">
                                                        <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 

    <?php } else { ?>

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


<?php } ?>
                </div>
            </div>
        </div>
    </header>

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
    <!-- <script type="text/javascript" src="<?php //echo base_url('js/jquery.min-notification.js');       ?>"></script> -->
    <!-- Extra js if not work then add End-->


