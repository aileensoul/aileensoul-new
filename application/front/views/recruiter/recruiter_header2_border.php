
 <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'recommen_candidate')){?>
   
<header>
    <div class="bg-search">
        <div class="header2 headerborder animated fadeInDownBig">
            <div class="container">
                <div class="row">
                  <div class="col-sm-7 col-md-7 col-xs-6 hidden-mob">
                        <div class="job-search-box1 clearfix">
                           <?php echo $rec_search;  ?>
                    </div>
                    </div>
                  <div class="col-sm-5 col-md-5 col-xs-12 h2-smladd fw-479">
                       <div class="search-mob-block">
                                 <div class="">
                                     <a href="#search">
                                     <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                     </a>
                                 </div>
                                 <div id="search">
                                    <button type="button" class="close">×</button>
                                    <form  action=<?php echo base_url('search/recruiter_search')?> method="get">
                                        <div class="new-search-input">
                                <input type="text" id="tags1" name="skills" placeholder="Job Title, Skills, Industries">
                                            <input type="text" id="searchplace1" name="searchplace" placeholder="Find Location">
                                            <input type="submit" name="search_submit" value="Search" onclick="return check()"  class="btn btn-primary"></button>
                                        </div>
                                    </form>
                                </div>
                             </div>
                       <div class="">

                      

                            <ul class="" id="dropdownclass">
                          
 

                                <li<?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter/recommen_candidate'); ?>"><span class="home-22x22-h"></span></span></a>
                                   
                                <!-- Friend Request Start-->

                               </li>
                                <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count;  ?></span> -->
                                        <?php } ?>
                                        <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em> <span class="message3-24x24-h"></span>

                                            <span id="message_count"></span>
                                        </a>

                                        <div id="InboxContainer">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages<span class="see_link" id="seemsg"> </span></div>
<div class="content mCustomScrollbar light notifications" id="notification_main_in" data-mcs-theme="minimal-dark">

<div>
    <ul class="notification_data_in_h2">
        
    </ul></div>

                                                </div>
                                            </div>
                                    </li> 
                                  <li>
  
<div class="dropdown_hover">
  <span id="art_profile">Recruiter Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
  <div class="dropdown-content_hover" id="dropdown-content_hover">
            <span class="my_account">
                                        <div class="my_S">Account</div>
                                            
      </span>
      <a href="<?php echo base_url('recruiter/rec_profile'); ?>"><span class="icon-view-profile edit_data"></span> <sapn>View Profile</sapn></a>
     <a href="<?php echo base_url('recruiter/rec_basic_information'); ?>"><span class="icon-edit-profile edit_data"> </span>
     <span>Edit Profile</span> </a>

     <?php
      $userid = $this->session->userdata('aileenuser');
      ?>
    <a onClick="deactivate(<?php echo $userid; ?>)"><span class="icon-delete edit_data"> </span><sapn> Deactive Profile </sapn></a>
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
  
    </header>
    <?php }
    else
      {?>
    <header>
    <div class="bg-search">
        <div class="header2 ">
            <div class="container">
                <div class="row">
                  <div class="col-sm-7 col-md-7 col-xs-12 hidden-mob">
                        <div class="job-search-box1 clearfix">
                           <?php echo $rec_search; ?>
                    </div>
                    </div>
                  <div class="col-sm-5 col-md-5 col-xs-12 fw-479">
                       <div class="search-mob-block">
                                 <div class="">
                                     <a href="#search">
                                     <label><i class="fa fa-search" aria-hidden="true"></i></label>
                                     </a>
                                 </div>
                                 <div id="search">
                                    <button type="button" class="close">×</button>
                                    <form  action=<?php echo base_url('search/recruiter_search')?> method="get">
                                        <div class="new-search-input">
                                            <input type="text" id="tags1" name="skills" placeholder="Job Title, Skills, Industries">
                                            <input type="text" id="searchplace1" name="searchplace" placeholder="Find Location">
                                            <input type="submit" name="search_submit" value="Search" class="btn btn-primary"></button>
                                        </div>
                                    </form>
                                </div>
                             </div>
                       <div class="">

                      

                            <ul class="" id="dropdownclass">
                          
 
                                <li<?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post'){?> class="active" <?php } ?>>

                                <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post')){?>
                                

                                 <a href="javascript:void(0);" onclick="return leave_page(1)"><span class="home-22x22-h"></span></a> 
                                 <?php }else{?>

                               <a href="<?php echo base_url('recruiter/recommen_candidate'); ?>"><span class="home-22x22-h"></span></a>
                                 <?php } ?>
                                   


                                <li<?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post'){?> class="active" <?php } ?>>

                                   
                                <!-- Friend Request Start-->

                               </li>
                                  <li id="Inbox_link">
                                        <?php if ($message_count) { ?>
                                                           <!--  <span class="badge bg-theme"><?php //echo $message_count;  ?></span> -->
                                        <?php } ?>
                                        <a class="action-button shadow animate" href="#" id="InboxLink" onclick = "return getmsgNotification()"><em class="hidden-xs"> </em><span class="message3-24x24-h"></span>
                                            <span id="message_count"></span>
                                        </a>

                                        <div id="InboxContainer">
                                            <div id="InboxBody" class="Inbox">
                                                <div id="notificationTitle">Messages<span class="see_link" id="seemsg"> </span></div>
<div class="content mCustomScrollbar light notifications" id="notification_main_in" data-mcs-theme="minimal-dark">

<div>
    <ul class="notification_data_in_h2">
        
    </ul></div>

                                                </div>
                                            </div>
                                    </li> 
                                    <li>
  
<div class="dropdown_hover">
  <span id="art_profile">Recruiter Profile <i class="fa fa-caret-down" aria-hidden="true"></i></span>
  <div class="dropdown-content_hover" id="dropdown-content_hover">
            <span class="my_account">
                                        <div class="my_S">Account</div>
                                            
      </span>


  <!-- View profile popup show on different page of Recruiter Start -->

       <?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post')){?>

   <a onclick="return leave_page(2)"><span class="icon-view-profile edit_data"></span>
      <span> View Profile </span></a>

     <?php }else{?>
       <a href="<?php echo base_url('recruiter/rec_profile'); ?>"><span class="icon-view-profile edit_data"></span>
      <span> View Profile </span></a>
      <?php } ?>
  <!-- View profile popup show on different page of Recruiter ENd -->


<!-- Edit Profile popup show on different page of Recruiter Start -->
<?php if(($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post')){?>

   <a onclick="return leave_page(3)"><span class="icon-edit-profile edit_data"></span>  
      <span>Edit Profile </span></a>


     <?php }else{?>
  <a href="<?php echo base_url('recruiter/rec_basic_information'); ?>"><span class="icon-edit-profile edit_data"></span>  
      <span>Edit Profile </span></a>

      <?php } ?>
    
<!-- Edit Profile popup show on different page of Recruiter Start -->
     
     
     <?php
      $userid = $this->session->userdata('aileenuser');
      ?>
    <a onClick="deactivate(<?php echo $userid; ?>)"><span class="icon-delete edit_data"></span>  <span>Deactive Profile</span></a>
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
  
    </header>
<?php }?>


 <!-- Bid-modal  -->
          <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
              <div class="modal-dialog modal-lm deactive">
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





<script type="text/javascript">

  function deactivate(clicked_id) { 
      $('.biderror .mes').html("<div class='pop_content'> Are you sure you want to deactive your recruiter profile?<div class='model_ok_cancel'><a class='okbtn deactive' id=" + clicked_id + " onClick='deactivate_profile(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
          $('#bidmodal').modal('show');
 }

 function deactivate_profile(clicked_id){

                  $.ajax({
                      type: 'POST',
                      url: '<?php echo base_url() . "recruiter/deactivate" ?>',
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
            $('span#message_count').removeAttr('style');
            document.getElementById('message_count').style.display = "none";
        } else
        {
            $('#message_count').html(msg);
         $('#message_count').css({"background": "#FF4500" , "padding" : '4px 6px 4px 5.5px',"line-height" : '1',"border-radius":' 100%',"line-height": '9px' ,"font-size": '10px' });
         
            $('#InboxLink').addClass('msg_notification_available');
             // $('#message_count').addClass('count_add');
            //alert("welcome");
        }


    }

    function waitForMsg1()
    {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>notification/select_msg_noti/2",

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

 
 
<!-- script for update all read notification start-->
<script type="text/javascript">
   
      $(document).ready(function () {
      
   var segment = '<?php echo "" . $this->uri->segment(1) . "" ?>';
   if(segment != "chat"){ chatmsg(); };
           });  // khyati chnages  start
 function chatmsg()
    {             
             // khyati chnages  start
       
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "chat/userajax/2/1" ?>',
                dataType: 'json',
                data: '',
                success: function (data) { //alert(data);

                    $('#userlist').html(data.leftbar);
                    $('.notification_data_in_h2').html(data.headertwo);
                    $('#seemsg').html(data.seeall);
                  setTimeout(
                         chatmsg,
                        1000
                         );
                },
             error: function (XMLHttpRequest, textStatus, errorThrown) {
            }           
            });
          
            };
            
    function getmsgNotification() {
        msgNotification();
     //   msgheader();
    }

    function msgNotification() {
        // first click alert('here'); 
        $.ajax({
            url: "<?php echo base_url(); ?>notification/update_msg_noti/2",
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
            data: 'message_from_profile=2&message_to_profile=1',
            success: function (data) {
                $('.' + 'notification_data_in_h2').html(data);
            }
        });

    }
</script>
 <!-- all popup close close using esc end -->