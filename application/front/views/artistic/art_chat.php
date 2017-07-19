<!DOCTYPE html>
<html lang="en">
    <head>

        <!--- for dispaly div insted of input type start -->
       
        <?php echo $header; ?>
        <!--- for dispaly div insted of input type end -->
        <meta charset="utf-8">
        <title>Chat</title>
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/common-style.css'); ?>">
<link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/media.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>">

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url('js/moment.js'); ?>"></script>

        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- http://bootsnipp.com/snippets/4jXW -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" />
    
         <link rel="stylesheet" href="<?php echo base_url(); ?>css/style_harshad.css" />


    </head>
    <body>

        <div class="container_chat " id="paddingtop_fixed">
            <div class="chat_nobcx">
                <div class="people-list" id="people-list">
                    <div class="search border_btm">
                        <input type="text" name=""  id="user_search" placeholder="search" value= ""  />
                        <i class="fa fa-search"></i>
                    </div>
                    <ul class="list">

                        <!-- loop start -->
                        <div id="userlist" >
                            <?php
                            if (count($userlist) > 0) {
                                foreach ($userlist as $user) {
                                    ?>
                                    <a href="<?php echo base_url() . 'chat/abc/' . $user['user_id']; ?>">
            <li class="clearfix <?php
                if ($user['user_id'] == $lstusr) {
                                            echo "active";
                                        }
                                        ?>">
                                            <?php if ($user['user_image']) { ?>
                                                <div class="chat_heae_img">
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $user['user_image']); ?>" alt="" >
                                                </div>
                                            <?php } else { ?>
                                                <div class="chat_heae_img">
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="" >
                                                </div>
                                            <?php } ?>
                                            <div class="about">
                                                <div class="name"> 
                                                    <?php echo $user['first_name'] . "<br>"; ?> </div>
                                                <div class="<?php echo 'status' . $user['user_id']; ?>" id="status_user" >
                                                         <?php echo $user['message']; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                    <?php
                                }
                            } else { ?>

                            <div class="no_user_Av">

                               <?php  echo 'No user available...'; ?>

                        </div>
                           <?php }
                            ?>
                        </div>
                        <!-- loop end -->

                    </ul>
                </div>
                <!-- chat start -->

                <?php
                $lstusrdata = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = '*');
                if ($lstusrdata) {
                    ?>
                    <div class="chat" id="chat" style="display:block;">
                        <div class="chat-header clearfix border_btm">

                            <?php if ($lstusrdata[0]['user_image']) { ?>
                                <div class="chat_heae_img">
                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $lstusrdata[0]['user_image']); ?>" alt="" >
                                </div>

                            <?php } else { ?>
                                <div class="chat_heae_img">
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="" >
                                </div>
                            <?php } ?>

                            <div class="chat-about">
                                <div class="chat-with">
                                    <span >   <?php echo $lstusrdata[0]['first_name'] . ' ' . $lstusrdata[0]['last_name']; ?> </span> </div>
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
                                    <span class="input-group-addon">bli
                                      Nickname:
                                    </span>
                                    <input id="nickname" type="text" class="form-control input-sm" placeholder="Nickname..." />
                                  </div>
                                </div> -->
                                <div class="col-md-12" id="msg_block">
                                    <div class="input-group" id="set_input">

                                                                           <!--  <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." /> -->
                                        <form name="blog">

                                            <!--  <div class="comment" contentEditable="true" name="comments" id="message  smily" style="position: relative;"> -->

                                            <div class="comment" contentEditable="true" name="comments" onpaste="OnPaste_StripFormatting(this, event);" id="message" placeholder="Type your message here..." style="position: relative;"></div>
                                            <div for="smily" class="smily_b">
                                                <div id="notification_li1" >
                                                    <a class="smil"  href="#" id="notificationLink1" >   <i class="em em-blush"></i></a>

                                                    <div id="notificationContainer1" style="display: none;
                                                    "">

                                                        <div id="notificationsBody1" class="notifications1">
                                                            <?php
                                                            $i = 0;
                                                            foreach ($smiley_table as $key => $value) {
                                                                
                                                                ?>

                                                                <img id="<?php echo $i; ?>" src="<?php echo base_url() . 'uploads/smileys/' . $value[0]; ?>" height="25" width="25"onClick="followclose(<?php echo $i; ?>)">

                                                                <?php
                                                                $i++;
                                                            }
                                                            ?>
                                                        </div>

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
                <?php } else { ?>

                    <div class="chat" id="chat" style="display:block;">
                        <div class="chat-header clearfix">
                            <div class="chat-about">
                                <div class="chat-with">
                                </div>
                                <div class="chat-num-messages"></div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul  id="received" class="padding_less_right">
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="clearfix">
                                <div class="col-md-11" id="msg_block">

                                    <div class="input-group" id="set_input">
                                                    <!--  <input style="    min-height: 41px;
                                         height: auto; position: relative;" id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." /> -->
                                        <div class="comment" contentEditable="true" name="comments" id="message" onpaste="OnPaste_StripFormatting(this, event);" placeholder="Type your message here..." style="position: relative;"></div>

                                        <div for="smily" class="smily_b" >
                                            <div id="notification_li1" >
                                                <a class="smil"  href="#" id="notificationLink1">   <i class="em em-blush"></i></a>

                                                <div id="notificationContainer1" style="display: none;
                                                    ">

                                                    <div id="notificationsBody1" class="notifications1">
                                                        <?php
                                                        $i = 0;
                                                        foreach ($smiley_table as $key => $value) {
                                                            ?>

                                                            <img id="<?php echo $i; ?>" src="<?php echo base_url() . 'uploads/smileys/' . $value[0]; ?>" height="25" width="25"onClick="followclose(<?php echo $i; ?>)">

                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-sm main_btn" id="submit">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>


                <!-- chat end -->
            </div>



        </div> 


    </body>
</html>
<!------  commen script khyati 15-7  ---------------->
    <script>
        jQuery(document).ready(function($) {
         if(screen.width <= 767){
     document.getElementById('chat').style.display = 'none';
         }
          });</script>
<script type="text/javascript">
    var dropDownMenu = new Foundation.DropdownMenu($('#smileystatic'), {
        disableHover: true,
        clickOpen: true
    });</script>


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
        var lastusr = '<?php echo $lstusr; ?>';
        var str = message;
        str = str.replace(/<div>/gi, "");
        str = str.replace(/<\/div>/gi, "");
        str = str.replace(/&nbsp;/gi, " ");
//        str = str.replace(/<br>/gi, "");
        // var str = message.replace(/&nbsp;/g, "");
        //var str = str.replace(/<div><br><\/div>/g, "");
        // var str = str.replace(/ /g, "");
        //alert(str);
        // if (str == '<div><br></div><div><br></div>' || str == '<div><br></div>') {
        if (str == '') {
            return false;
        } else if (/^\s+$/gi.test(str))
        {
            return false;
        } else {
            $.getJSON('<?php echo base_url(); ?>api/send_message/' + lastusr + '?message=' + encodeURIComponent(JSON.stringify(str)) + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data) {
                callback();
            }); 
        }
    }
    /*
    $('#message').keypress(function (event) {
            if (event.keyCode == 13 && !event.shiftKey) {
                event.preventDefault();
                var sel = $("#message");
                var txt = sel.html();
                if (txt == '') {
                    return false;
                } else {
                    alert(2);
                    $.getJSON('<?php echo base_url(); ?>api/send_message/' + lastusr + '?message=' + txt + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data) {
                        callback();
                    });
                }
            }
        }); 
*/

    var append_chat_data = function (chat_data) {
        chat_data.forEach(function (data) {
            var is_me = data.guid == getCookie('user_guid');
            var fname = '<?php echo $logfname; ?>';
            var lname = '<?php echo $loglname; ?>';
            var lastusr = '<?php echo $lstusr; ?>';
            var userid = '<?php echo $userid; ?>';
            var touser = data.message_to;
            var curuser = data.message_from;
//alert(data.timestamp);
            if (curuser == userid) {
                //  var timeString = moment(data.timestamp).format("HH:mm:ss");

                var timestamp = data.timestamp; // replace your timestamp
                var date = new Date(timestamp * 1000);
// var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();

                var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                //console.log(formattedDate);
//alert(formattedDate);

            var print_message = data.message;
            var print_message = print_message.replace(/"/gi, " ");
            var print_message = print_message.replace(/%26amp;/gi, "&");
                
                
                    var html = ' <li class="clearfix">';
                    html += '   <div class="message-data align-right">';
                    html += '    <span class="message-data-time" >' + formattedDate + '</span>&nbsp; &nbsp;';
                    html += '    <span  class="message-data-name fr"  >' + fname +
                            ' ' + lname + '  <i class="fa fa-circle me"></i></span>';
                    html += ' </div>';
                    html += '<div class="message other-message float-right">' + print_message + '</div>';
                    html += '</li>';
                    $('.' + 'status' + touser).html(print_message);
               
            } else {

                var timestamp = data.timestamp; // replace your timestamp
                var date = new Date(timestamp * 1000);
                var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
                //console.log(formattedDate);
            var print_message = data.message;
            var print_message = print_message.replace(/"/gi, " ");
            var print_message = print_message.replace(/%26amp;/gi, "&")
                
                    var html = '<li> <div class="message-data">';
                    html += '<span class="message-data-name fl" ><i class="fa fa-circle online"></i>' + data.nickname + ' </span>';
                    html += '<span class="message-data-time">' + formattedDate + ' </span>';
                    html += ' </div>';
                    html += ' <div class="message my-message">' + print_message + '</div>';
                    html += '</li>';
                    $('.' + 'status' + curuser).html(print_message);
                
            }
//            $('.chat-history').animate({scrollTop: $('.chat-history').height()}, 2000);
//            var dchativ = $(".chat-history");
//            div.scrollTop(div.prop('scrollHeight'));

            var $cont = $('.chat-history');
            $cont[0].scrollTop = $cont[0].scrollHeight;

            $("#received").html($("#received").html() + html);
        });
//        $('#received').animate({scrollTop: $('#received').height()}, 1000);
    }

        var update_chats = function () {
        if (typeof (request_timestamp) == 'undefined' || request_timestamp == 0) {
            var offset = 52560000; // 100 years min
            request_timestamp = parseInt(Date.now() / 1000 - offset);
        }


        var lastusr = '<?php echo $lstusr; ?>';
        $.getJSON('<?php echo base_url(); ?>api/get_messages/' + lastusr + '?timestamp=' + request_timestamp, function (data) {
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
//        data = data.replace(/(<br>)*/g,"p");

//         data = data.replace(/\<br\>/g,'');
        data = data.replace(/&nbsp;/gi, " ");
        
        data = data.replace(/&gt;/gi,">");
        data = data.replace(/div/gi, "p");

        data = data.replace(/&/g, "%26");
    
    
        if (data == "") {
            return false;
        }
        $("#message").html("");

        $field.addClass('disabled').attr('disabled', 'disabled');
        sendChat(data, function () {
            $field.val('').removeClass('disabled').removeAttr('disabled');
        });
    });

//    $('#message').keyup(function (e) {
//        if (e.which == 13 && !e.shiftKey) {
//            e.preventDefault();
//            $('#submit').trigger('click');
//        }else if (e.which == 13 && e.shiftKey) {
//            pasteIntoInput(this, "\n");
//        }
//    });
    $('#message').keyup(function (e) {
        if (e.which == 13 && !e.shiftKey) {
            e.preventDefault();
            $('#submit').trigger('click');
        }
    });

    setInterval(function () {
        update_chats();
    }, 1500);

</script>

<!-- user search list  20-4  sstart  -->

<script type="text/javascript">

    $(document).ready(function () {

        //$('#user_search').keypress(function() {
        $("#user_search").on("keyup", function (event) {

            var val = $('#user_search').val();
            if (val == " ") {
                // alert("heeee");
                document.getElementById('userlist').style.display = 'block';
                return false;
            }
            // khyati chnages  start

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "chat/user_list" ?>',
                data: 'search_user=' + val,
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
     url:'<?php // echo base_url() . "chat/user_list"                ?>',
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
    });</script>

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



<script type="text/javascript">

    $("#bottom").on("scroll", function ()
    {
        $("#bottomv").html($("#bottom")[0].scrollTop);
    });
    $(function ()
    {
        $("#bottom")[0].scrollTop = $("#bottom")[0].scrollHeight - $("#bottom").height();
    });
    
    $('.chat .chat-history').scrollTop($('.chat .chat-history')[0].scrollHeight);
</script>

<script type="text/javascript">

    var _onPaste_StripFormatting_IEPaste = false;

    function OnPaste_StripFormatting(elem, e) {

        if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
            e.preventDefault();
            var text = e.originalEvent.clipboardData.getData('text/plain');
            window.document.execCommand('insertText', false, text);
        } else if (e.clipboardData && e.clipboardData.getData) {
            e.preventDefault();
            var text = e.clipboardData.getData('text/plain');
            window.document.execCommand('insertText', false, text);
        } else if (window.clipboardData && window.clipboardData.getData) {
            // Stop stack overflow
            if (!_onPaste_StripFormatting_IEPaste) {
                _onPaste_StripFormatting_IEPaste = true;
                e.preventDefault();
                window.document.execCommand('ms-pasteTextOnly', false);
            }
            _onPaste_StripFormatting_IEPaste = false;
        }

    }

</script>