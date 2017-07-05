<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Chat | Aileensoul</title>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/media.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>">
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- http://bootsnipp.com/snippets/4jXW -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style_harshad.css" />
     
    <body>
        <?php echo $header; ?>



        <div class="container_chat " id="paddingtop_fixed">
            <div class="chat_nobcx">
                <div class="people-list" id="people-list">
                    <div class="search border_btm">
                        <input type="text" name=""  id="user_search" placeholder="search" value= ""  />
                        <i class="fa fa-search"></i>
                    </div>
                    <ul class="list">

                        <!-- loop start -->
                        <div id="userlist">
                            <?php
                            if (in_array($toid, $userlist)) {
                                foreach ($userlist as $user) {
                                    ?>
                                    <li class="clearfix <?php
                                        if ($user['user_id'] == $toid) {
                                            echo "active";
                                        }
                                        ?>">
                                        <?php if ($user['user_image']) { ?>
                                            <div class="chat_heae_img">
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $user['user_image']); ?>" alt="" height="50px" weight="50px">
                                            </div>
        <?php } else { ?>

                                            <div class="chat_heae_img">
                                                <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="30px" weight="30px">
                                            </div>
        <?php } ?>
            <div class="about">
                   <div class="name"> 
                              <a href="<?php echo base_url() . 'chat/abc/' . $user['user_id']; ?>"><?php echo $user['first_name'] . ' ' . $user['last_name'] . "<br>"; ?></a> </div>
     <div class="<?php echo 'status' . $user['user_id']; ?>" id="status_user">
                                    <?php echo $user['message']; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            } else {

                                $lstusrdata = $this->common->select_data_by_id('user', 'user_id', $toid, $data = '*');


                                if ($lstusrdata) {
                                    ?>

                                    <li class="clearfix <?php
                            if ($lstusrdata[0]['user_id'] == $toid) {
                                echo "active";
                            }
                            ?>">
        <?php if ($lstusrdata[0]['user_image']) { ?>
                                            <div class="chat_heae_img">
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $lstusrdata[0]['user_image']); ?>" alt="" height="50px" weight="50px">
                                            </div>
        <?php } else { ?>
                                            <div class="chat_heae_img">
                                                <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="50px" weight="50px">
                                            </div>
        <?php } ?>
                                        <div class="about">
                                            <div class="name"> 
                                                <a href="<?php echo base_url() . 'chat/abc/' . $lstusrdata[0]['user_id']; ?>"><?php echo $lstusrdata[0]['first_name'] . ' ' . $lstusrdata[0]['last_name'] . "<br>"; ?></a> </div>
                                            <div class="<?php echo 'status' . $lstusrdata[0]['user_id']; ?>" id="status_user">

                                            </div>
                                        </div>
                                    </li>

        <?php
    }
    foreach ($userlist as $user) {  
        if ($user['user_id'] != $toid) {
            ?>
                                        <a href="<?php echo base_url() . 'chat/abc/' . $user['user_id']; ?>">
                                            <li class="clearfix <?php
                                        if ($user['user_id'] == $toid) {
                                            echo "active";
                                        }
                                        ?>">
                                                <?php if ($user['user_image']) { ?>
                                                    <div class="chat_heae_img">
                                                        <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $user['user_image']); ?>" alt="" height="50px" weight="50px">
                                                    </div>
                                                        <?php } else { ?>
                                                    <div class="chat_heae_img">
                                                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="50px" weight="50px">
                                                    </div>
            <?php } ?>
                                                <div class="about">
                                                    <div class="name"> 
                                                             <?php echo $user['first_name'] . ' ' . $user['last_name'] . "<br>"; ?></div>
                                                    <div class="<?php echo 'status' . $user['user_id']; ?>" id="status_user">
                                        <?php echo $user['message']; ?>
                                                    </div>
                                                </div>
                                            </li></a> 
        <?php
        }
    }
}
?>
                        </div>
                        <!-- loop end -->
                    </ul>
                </div>


                <!-- chat start -->

                        <?php
                        $lstusrdata = $this->common->select_data_by_id('user', 'user_id', $toid, $data = '*');


                        if ($lstusrdata) {
                            ?>
                    <div class="chat">
                        <div class="chat-header clearfix border_btm">

                            <?php if ($lstusrdata[0]['user_image']) { ?>
                                <div class="chat_heae_img">
                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $lstusrdata[0]['user_image']); ?>" alt="" height="50px" weight="50px">
                                </div>
    <?php } else { ?>
                                <div class="chat_heae_img">
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="50px" weight="50px">
                                </div>
    <?php } ?>

                            <div class="chat-about">
                                <div class="chat-with">
                                    <a href="">  <?php echo $lstusrdata[0]['first_name'] . ' ' . $lstusrdata[0]['last_name']; ?></a>  </div>
                                <div class="chat-num-messages"> Current Work</div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul  id="received" class="padding_less_right">

                            </ul>

                        </div>

                        <div class="panel-footer">
                            <div class="clearfix">
                                <!-- <div class="col-md-3">
                                  <div class="input-group">
                                    <span class="input-group-addon">
                                      Nickname:
                                    </span>
                                    <input id="nickname" type="text" class="form-control input-sm" placeholder="Nickname..." />
                                  </div>
                                </div> -->
                                <div class="col-md-12" id="msg_block">
                                    <div class="input-group" id="set_input">

                       <!--  <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." /> -->
                                        <form name="blog">

                                            <div class="comment" contentEditable="true" name="comments" id="message"  style="position: relative;"></div>
                                            <div for="smily"  class="smily_b" >
                                                <div id="notification_li1" >
                                                    <a class="smil" href="#" id="notificationLink1" ">
                                                        <i class="em em-blush"></i></a>

                                                    <div id="notificationContainer1" style="display: none;
                                                       ">

                                                        <div id="notificationsBody1" class="notifications1">
    <?php $i = 0;
    foreach ($smiley_table as $key => $value) {
        ?>

                                                                <img id="<?php echo $i; ?>" src="<?php echo base_url() . 'uploads/smileys/' . $value[0]; ?>" height="25" width="25"onClick="followclose(<?php echo $i; ?>)">

        <?php $i++;
    }
    ?>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </form>

                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-sm main_send" id="submit" >Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } else { ?>

                    <div class="chat">
                        <div class="chat-header clearfix ">



                            <div class="chat-about">
                                <div class="chat-with">
                                </div>
                                <div class="chat-num-messages"></div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul id="received" class="padding_less_right">

                            </ul>

                        </div>

                        <div class="panel-footer">
                            <div class="clearfix">

                                <div class="col-md-12" id="msg_block">
                                    <div class="input-group">

                       <!--  <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." /> -->
                                        <form name="blog">

                                            <div class="form-control input-sm" contentEditable="true" name="comments"  id="message  smily" style="position: relative;"></div>
                                            <div for="smily"  class="smily_b">
                                                <div id="notification_li" >
                                                    <a href="#" id="notificationLink"><i class="em em-blush"></i></a>

                                                    <div id="notificationContainer" style="display: none;
                                                        ">

                                                        <div id="notificationsBody" class="notifications"></div>

                                                    </div>

                                                </div>

                                            </div>
                                        </form>

                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-sm main_send" id="submit">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php } ?>
                <!-- chat start -->
            </div>

    </body>
</html>
<script type="text/javascript">
    var request_timestamp = 0;

    var setCookie = function (key, value) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (5 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
    }

    var getCookie = function (key) {
        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
        return keyValue ? keyValue[2] : null;
    }

    var guid = function () {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    }

    if (getCookie('user_guid') == null || typeof (getCookie('user_guid')) == 'undefined') {
        var user_guid = guid();
        setCookie('user_guid', user_guid);
    }


// https://gist.github.com/kmaida/6045266
    var parseTimestamp = function (timestamp) {
        var d = new Date(timestamp * 1000), // milliseconds
                yyyy = d.getFullYear(),
                mm = ('0' + (d.getMonth() + 1)).slice(-2), // Months are zero based. Add leading 0.
                dd = ('0' + d.getDate()).slice(-2), // Add leading 0.
                hh = d.getHours(),
                h = hh,
                min = ('0' + d.getMinutes()).slice(-2), // Add leading 0.
                ampm = 'AM',
                timeString;

        if (hh > 12) {
            h = hh - 12;
            ampm = 'PM';
        } else if (hh === 12) {
            h = 12;
            ampm = 'PM';
        } else if (hh == 0) {
            h = 12;
        }

        timeString = yyyy + '-' + mm + '-' + dd + ', ' + h + ':' + min + ' ' + ampm;

        return timeString;
    }



    var sendChat = function (message, callback) {

        var fname = '<?php echo $logfname; ?>';
        var lname = '<?php echo $loglname; ?>';
        var message = message;
//        var str = message.replace(/&nbsp;/g, "");
//        var str = str.replace(/ /g, "");
        str = message.replace(/<div>/gi, "");
        str = str.replace(/<\/div>/gi, "");
        str = str.replace(/&nbsp;/gi, " ");
        str = str.replace(/<br>/gi, "");
        //if (str == '<div><br></div><div><br></div>' || str == '<div><br></div>') {
        if (str == '') {
            return false;
        }else if (/^\s+$/gi.test(str))
        {
            return false;
        } else {
            $.getJSON('<?php echo base_url() . 'api/send_message/' . $toid ?>?message=' + str + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data) {
                callback();
            });
        }
        /*$('#message').keypress(function (e) {

            if (e.keyCode == 13 && !e.shiftKey) {
                e.preventDefault();
                var sel = $("#message");
                var txt = sel.html();
                if (txt == '') {
                    return false;
                } else {
                    $.getJSON('<?php echo base_url() . 'api/send_message/' . $toid ?>?message=' + txt + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data) {
                        callback();
                    });
                }
            }
        }); */


    }

    var append_chat_data = function (chat_data) {
        chat_data.forEach(function (data) {
            var is_me = data.guid == getCookie('user_guid');
            var userid = '<?php echo $userid; ?>';
            var curuser = data.message_from;
            var touser = data.message_to;
         
            if (curuser == userid) {
                var timestamp = data.timestamp; // replace your timestamp
                var date = new Date(timestamp * 1000);
                var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                console.log(formattedDate);

                var html = ' <li class="clearfix">';
                html += '   <div class="message-data align-right">';
                html += '    <span class="message-data-time" >' + formattedDate + '</span>&nbsp; &nbsp;';
                html += '    <span  class="message-data-name fr"  >' + data.nickname + ' <i class="fa fa-circle me"></i></span>';
                html += ' </div>';
                //html += ' <div class="chat-body clearfix">';
                html += '     <div class="message other-message float-right">' + data.message + '</div>';
                html += '</li>';
                
                $('.' + 'status' + touser).html(data.message);
            } else {

                var timestamp = data.timestamp; // replace your timestamp
                var date = new Date(timestamp * 1000);
                var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                console.log(formattedDate);


                var html = '<li> <div class="message-data">';
                html += '<span class="message-data-name fl"><i class="fa fa-circle online"></i>' + data.nickname + ' </span>';
                html += '<span class="message-data-time">' + formattedDate + ' </span>';
                html += ' </div>';
                html += '     <div class="message my-message">' + data.message + '</div>';
                html += '</li>';


                $('.' + 'status' + curuser).html(data.message);
            }
            
             var $cont = $('.chat-history');
            $cont[0].scrollTop = $cont[0].scrollHeight;
            
            $("#received").html($("#received").html() + html);
        });

        $('#received').animate({scrollTop: $('#received').height()}, 1000);
    }

    var update_chats = function () {
        if (typeof (request_timestamp) == 'undefined' || request_timestamp == 0) {
            var offset = 52560000; // 100 years min
            request_timestamp = parseInt(Date.now() / 1000 - offset);
        }
        $.getJSON('<?php echo base_url() . 'api/get_messages/' . $toid ?>?timestamp=' + request_timestamp, function (data) {
            append_chat_data(data);

            var newIndex = data.length - 1;
            if (typeof (data[newIndex]) != 'undefined') {
                request_timestamp = data[newIndex].timestamp;
            }
        });
    }


    $('#submit').click(function (e) {
        e.preventDefault();

        var $field = $('#message');
        //var data = $field.val();
        var data = $('#message').html();

        if (data == "") {
            return false;
        }
        $("#message").html("");

        $field.addClass('disabled').attr('disabled', 'disabled');
        sendChat(data, function () {
            $field.val('').removeClass('disabled').removeAttr('disabled');
        });
    });

    $('#message').keyup(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#submit').trigger('click');
        }
    });

    setInterval(function () {
        update_chats();
    }, 1500);

</script>



<!-- user search list  20-4  start  -->

<script type="text/javascript">

    $(document).ready(function () {


        //$('#user_search').keypress(function() {
        $("#user_search").on("keyup", function (event) {

            var val = $('#user_search').val();
            var usrid = '<?php echo $toid; ?>';

            // khyati chnages  start

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "chat/userlisttwo" ?>',

                data: 'search_user=' + val + '&user=' + usrid,
                success: function (data) {
                    $('input').each(function () {
                    });


                    $('#userlist').html(data);
                }
            });
            // khyati chnages end

        });
    });


    /* 
     function enteruser()
     {
     
     $(document).ready(function() {
     
     
     $('#user_search').keypress(function() { 
     
     var val = $('#user_search').val();
     // alert(val);
     
     //alert(val); return false;
     // khyati chnages  start
     
     $.ajax({ 
     type:'POST',
     url:'<?php echo base_url() . "chat/userlisttwo" ?>',
     data:'search_user='+val,
     //     dataType: "json",
     success:function(data){ 
     $('input').each(function(){
     //$(this).val('');
     });
     
     //  $('.insertcomment' + clicked_id).html(data);
     $('#userlist').html(data);
     //   $('.insertcomment' + clicked_id).html(data.comment);
     
     }
     }); 
     
     
     // khyati chnages end
     
     
     });
     });
     
     }
     */
</script>

<!-- user search list 20-4 end -->



<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#notificationLink1").click(function ()
        {
            $("#notificationContainer1").fadeToggle(300);
            $("#notification_count1").fadeOut("slow");
            return false;
        });

        //Document Click hiding the popup 
        $(document).click(function ()
        {
            $("#notificationContainer1").hide();
        });

        //Popup on click
        $("#notificationContainer1").click(function ()
        {
            return false;
        });

    });
</script>

<!-- script for selact smily for message start-->
<script type="text/javascript">
    function followclose(clicked_id)
    {
        var img = document.getElementById(clicked_id);
// alert(img.getAttribute('src')); // foo.jpg
//alert(img.src); 
        var img = img.src;
        $('#message').append("<img  src=" + img + " height='25' width='25' >");

    }
</script>
<!-- script for selact smily for message end-->

<script type="text/javascript">
    var message = document.querySelector("div");

    message.addEventListener("keyup", function () {

        newheight = message.scrollHeight;
        message.style.height = newheight + "px";
    })
</script>