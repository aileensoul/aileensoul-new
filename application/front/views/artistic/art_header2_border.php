
<?php if(($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post')){?>

<header class="">
    <div class="bg-search">
        <div class="header2 headerborder animated fadeInDownBig">
            <div class="container">
                <div class="row">
                  <?php echo $artistic_search; ?>
                  <div class="col-sm-5 col-md-5 col-xs-12 h2-smladd fw-479 pl0-xs pl15-mob">
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
                       
                       
                       <ul class="" id="dropdownclass">
                        
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_post'); ?>"><span class="bu_home"></span></a>
                                    </li>
                                <!-- Friend Request Start-->
                                <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count;  ?></span> -->
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
                 <!-- Friend Request End-->
<li>
	<div class="dropdown_hover">
  <span id="art_profile">Artistic Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
  <div class="dropdown-content_hover" id="dropdown-content_hover">
                  <span class="my_account">
                                        <div class="my_S">Account</div>
                                            
      </span>
      <a href="<?php echo site_url('artistic/artistic_profile'); ?>"><span class="h2-img h2-srrt"></span> View Profile</a>
     <a href="<?php echo base_url('artistic/art_basic_information_update'); ?>"><span class="h3-img h2-srrt"></span> Edit Profile</a>

     <?php
      $userid = $this->session->userdata('aileenuser');
      ?>
 <a onClick="deactivate(<?php echo $userid; ?>)"><span class="h4-img h2-srrt"></span>Deactive Profile</a>
  </div>
</div>
</li>
                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div> 
                    </div>
                  
                   
                </div>
            </div>
        </div>
       </div> 
    </header>
    <?php }
    else
    { ?>
      <header class="">
    <div class="bg-search">
        <div class="header2">
            <div class="container">
                <div class="row">
                  <?php echo $artistic_search; ?>
                  <div class="col-sm-5 col-md-5 col-xs-5 fw-479 pl0-xs pl15-mob">
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
                       
                       
                       <ul class="" id="dropdownclass">
                        
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_post'); ?>"><span class="bu_home"></a>
                                    </li>
                                <!-- Friend Request Start-->
                                  <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count;  ?></span> -->
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
                 <!-- Friend Request End-->
<li>
  <div class="dropdown_hover">
  <span id="art_profile">Artistic Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
  <div class="dropdown-content_hover" id="dropdown-content_hover">
                  <span class="my_account">
                                        <div class="my_S">Account</div>
                                            
      </span>
      <a href="<?php echo site_url('artistic/artistic_profile'); ?>"><span class="h2-img h2-srrt"></span> View Profile</a>
     <a href="<?php echo base_url('artistic/art_basic_information_update'); ?>"><span class="h3-img h2-srrt"></span> Edit Profile</a>

     <?php
      $userid = $this->session->userdata('aileenuser');
      ?>
 <a onClick="deactivate(<?php echo $userid; ?>)"><span class="h4-img h2-srrt"></span>Deactive Profile</a>
  </div>
</div>
</li>
                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div> 
                    </div>
                  
                   
                </div>
            </div>
        </div>
       </div> 
    </header>


<?php
    }
    ?>



<!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                        <div class="modal-dialog modal-lm deactive">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal" id="common">&times;</button>       
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->




<script type="text/javascript">
  

$(document).ready(function(){
    $('.dropdown_hover').click(function(event){
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

$(document).ready(function() {
     $("body").click(function(event) {
        $(".dropdown-content_hover").hide();
        event.stopPropagation();
    });
 
});
</script>


<script type="text/javascript">

  function deactivate(clicked_id) { 
      $('.biderror .mes').html("<div class='pop_content'> Are you sure you want to deactive your artistic profile?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='deactivate_profile(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
          $('#bidmodal').modal('show');
 }

 function deactivate_profile(clicked_id){

                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . "artistic/deactivate" ?>',
                      data: 'id=' + clicked_id,
                        success: function (data) {
                          window.location= "<?php echo base_url() ?>dashboard";
                                    
                                }
                            });



 }
 </script>

 

 <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

   $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        $( "#dropdown-content_hover" ).hide();
    }
});  


    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->

<script type="text/javascript" charset="utf-8">

    function addmsg1(type, msg)
    {
        if (msg == 0)
        {
            $("#message_count").html('');
            $('#InboxLink').removeClass('msg_notification_available');
        } else
        {
            $('#message_count').html(msg);
            $('#message_count').css({"background-color": "#FF4500", "padding": "3px"});
            $('#InboxLink').addClass('msg_notification_available');
            //alert("welcome");
        }
    }
    function waitForMsg1()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>notification/select_msg_noti/3",
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
    };

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
            url: "<?php echo base_url(); ?>notification/update_msg_noti/3",
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
            data: 'message_from_profile=6&message_to_profile=6',
            success: function (data) {
                $('#' + 'notificationsmsgBody').html(data);
            }
        });

    }
</script>
<!------  commen script harshad  ---------------->