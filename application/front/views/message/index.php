<!DOCTYPE html>
<html lang="en">

    <head>
        <?php echo $head; ?>
        <meta charset="utf-8">
        <title>Chat | Aileensoul</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/header.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
        <style type="text/css">
            .msg_right:hover .messagedelete{ visibility: visible;opacity: 1;}
            .msg_right .messagedelete{ visibility: hidden;  cursor: pointer; width:25px; float:left;}
            .msg_left_data:hover .messagedelete{ visibility: visible;opacity: 1;}
            .msg_left_data .messagedelete{ visibility: hidden;  cursor: pointer; width:25px; float:left;}
        </style>
    <body>
        <?php
        echo $header;

        if ($message_from_profile == 1) {
            echo $job_header2_border;
        } else if ($message_from_profile == 2) {
            echo $recruiter_header2_border;
        } else if ($message_from_profile == 3) {
            echo $freelancer_hire_header2_border;
        } else if ($message_from_profile == 4) {
            echo $freelancer_post_header2_border;
        } else if ($message_from_profile == 5) {
            echo $business_header2_border;
        } else if ($message_from_profile == 6) {
            echo $art_header2_border;
        }
        ?>
        <div class="container">
            <div class="" id="paddingtop_fixed">
                <!--                <div class="backdiv-mob">
                                    <a href="#" class="pull-left"><img src="<?php echo base_url(); ?>img/back-arrow.png"></a>
                                    <a href="#" class="pull-right"><img src="<?php echo base_url(); ?>img/chat-frd.png"></a>
                                </div>-->
                <div class="chat_nobcx">

                    <div class="people-list" id="people-list">
                        <div class="search border_btm">
                            <input type="text" name=""  id="user_search" placeholder="search" value= ""  />
                            <i class="fa fa-search" id="add_search"></i>
                        </div>
                        <ul class="list">

                            <!-- loop start -->
                            <div id="userlist">



                            </div>
                            <!-- loop end -->
                        </ul>
                    </div>
                    <!-- chat start -->
                    <?php
                    $lstusrdata = $this->common->select_data_by_id('user', 'user_id', $toid, $data = '*');


                    if ($lstusrdata) {
                        ?>
                                    <div class="chat" id="chat"  style="display:block;">

                                        <div class="chat-header clearfix border_btm">

                                <?php
                                if ($message_from_profile == 1) {
                                    $last_user_image = $last_user_data['user_image'];
                                    $profile_url = base_url() . 'recruiter/profile/' . $id . '?page=job';
                                }
                                if ($message_from_profile == 2) {
                                    $last_user_image = $last_user_data['user_image'];
                                    $slug = $this->db->get_where('job_reg', array('user_id' => $id, 'is_delete' => 0, 'status' => 1))->row()->slug;
                                    $profile_url = base_url() . 'job/job_printpreview/' . $slug . '?page=recruiter';
                                }
                                if ($message_from_profile == 3) {
                                    $last_user_image = $last_user_data['user_image'];
                                    $profile_url = base_url() . 'freelancer/freelancer_post_profile/' . $id . '?page=freelancer_hire';
                                }
                                if ($message_from_profile == 4) {
                                    $last_user_image = $last_user_data['user_image'];
                                    $profile_url = base_url() . 'freelancer/freelancer_hire_profile/' . $id . '?page=freelancer_post';
                                }
                                if ($message_from_profile == 5) {
                                    $busdata = $this->common->select_data_by_id('business_profile', 'user_id', $id, $data = 'business_slug');
                                    $last_user_image = $last_user_data['user_image'];
                                    $profile_url = base_url() . 'business-profile/dashboard/' . $busdata[0]['business_slug'];
                                }
                                if ($message_from_profile == 6) {
                                    $last_user_image = $last_user_data['user_image'];
                                    $profile_url = base_url() . 'artist/art_manage_post/' . $id;
                                }
                                ?>
                                            <a href="<?php echo $profile_url; ?>">
                                    <?php if ($last_user_image) { ?>                             

                                                                <div class="chat_heae_img">
                                                                    <img src="<?php echo $last_user_image; ?>" alt="" height="50px" weight="50px">
                                                                </div>
                                        <?php
                                    } else {
                                        $a = $last_user_data['first_name'];
                                        $b = $last_user_data['last_name'];
                                        $acr = substr($a, 0, 1);
                                        $bcr = substr($b, 0, 1);
                                        ?>
                                                                <div class="post-img-div">
                                            <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                </div>
                                    <?php } ?>

                                                <div class="chat-about">
                                                    <div class="chat-with">

                                                        <span><?php echo $last_user_data['first_name'] . ' ' . $last_user_data['last_name']; ?></span>  
                                                    </div>
                                                    <div class="chat-num-messages"> <?php
                                            echo $last_user_data['user_designation'];
                                            ?></div>
                                                </div>
                                            </a>

                                            <div class="chat_drop">
                                                <a onclick="myFunction()" class="chatdropbtn fr"> <img src="<?php echo base_url('assets/img/t_dot.png') ?>" onclick="myFunction()"></a>
                                                <div id="mychat_dropdown" class="chatdropdown-content">
                                                    <a href="javascript:void(0);" onClick="delete_history()">
                                                        <span class="h4-img h2-srrt"></span>  Delete All
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="chat-history" id="chat-history">
                                            <ul  id="received" class="padding_less_right">

                                            </ul>

                                        </div>

                                        <div class="panel-footer">

                                            <div class="">
                                                <div class="" id="msg_block">
                                                    <div class="input-group" id="set_input">
                                                        <form name="blog">
                                                            <div class="comment" contentEditable="true" name="comments" id="message" onpaste="OnPaste_StripFormatting(this, event);" placeholder="Type your message here..." style="position: relative;"></div>
                                                            <div for="smily"  class="smily_b" >
                                                                <div id="notification_li1" >
                                                                    <a class="smil" href="#" id="notificationLink1" ">
                                                                        <i class="em em-blush"></i></a>

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
                                        <div id="notificationContainer1" style="display: none;">
                                            <div id="notificationsBody1" class="notifications1">
                                    <?php
                                    $i = 0;
                                    foreach ($smiley_table as $key => $value) {
                                        ?>
                                                                <img id="<?php echo $i; ?>" src="<?php echo base_url() . 'uploads/smileys/' . $value[0]; ?>" alt='<img src="<?php echo base_url() . 'uploads/smileys/' . $value[0]; ?>  height="25" width="25">' height="25" width="25"onClick="followclose(<?php echo $i; ?>)">


                                        <?php
                                        $i++;
                                    }
                                    ?>

                                            </div>
                                        </div>
                                    </div>
                    <?php } else { ?>

                                    <div class="chat" id="chat" style="display:block;">
                                        <div class="chat-header clearfix ">
                                            <div class="chat-about">
                                                <div class="chat-with">
                                                </div>
                                                <div class="chat-num-messages"></div>
                                            </div>
                                        </div>
                                        <div class="chat-history" id="chat-history">
                                            <ul id="received" class="padding_less_right">
                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="clearfix">
                                                <div class="col-md-12" id="msg_block">
                                                    <div class="input-group">
                                                        <form name="blog">
                                                            <div class="form-control input-sm" contentEditable="true" name="comments" placeholder="Type your message here..." id="message  smily" style="position: relative;"></div>
                                                            <div for="smily"  class="smily_b">
                                                                <div id="notification_li" >
                                                                    <a href="#" id="notificationLink"><i class="em em-blush"></i></a>
                                                                    <div id="notificationContainer" style="display: none;">
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

                <?php echo $footer; ?>
                </body>
                </html>
                <!-- Bid-modal  -->
                <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                    <div class="modal-dialog modal-lm">
                        <div class="modal-content">
                            <button type="button" class="modal-close" data-dismiss="modal">&times;
                            </button>       
                            <div class="modal-body">
                                <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                <span class="mes">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Model Popup Close -->
                <!------  commen script khyati 15-7  ---------------->

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

                    var parseTimestamp = function (timestamp) {
                    var d = new Date(timestamp * 1000), // milliseconds
                            yyyy = d.getFullYear(),
                            mm = ('0' + (d.getMonth() + 1)).slice( - 2), // Months are zero based. Add leading 0.
                            dd = ('0' + d.getDate()).slice( - 2), // Add leading 0.
                            hh = d.getHours(),
                            h = hh,
                            min = ('0' + d.getMinutes()).slice( - 2), // Add leading 0.
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
                    var str = message.replace(/<div><br><\/div>/gi, "");
                    if (str == '') {
                    return false;
                    } else if (/^\s+$/gi.test(str))
                    {
                    return false;
                    } else {

                    var id = <?php echo $toid ?>;
                    var message_from_profile = <?php echo $message_from_profile ?>;
                    var message_to_profile = <?php echo $message_to_profile ?>;
                    var message_from_profile_id = <?php echo $message_from_profile_id ?>;
                    var message_to_profile_id = <?php echo $message_to_profile_id ?>;
                    var message = str;
                    var nickname = fname + ' ' + lname;
                    var guid = getCookie('user_guid');
                    var json_data = {"toid": id, "message_from_profile": message_from_profile, "message_to_profile": message_to_profile, "message_from_profile_id": message_from_profile_id, "message_to_profile_id": message_to_profile_id, "message": message, "nickname": nickname, "guid": guid};
                    $.ajax({
                    type: 'POST',
                            url: '<?php echo base_url() . "api/send_message" ?>',
                            data: {json: JSON.stringify(json_data)},
                            dataType: 'json',
                            success: function (r) {
                            //   callback();
                            }
                    });
                    //            $.getJSON('<?php // echo base_url() . 'api/send_message/' . $toid . '/' . $message_from_profile . '/' . $message_from_profile_id . '/' . $message_to_profile . '/' . $message_to_profile_id          ?>?message=' + encodeURIComponent(JSON.stringify(str)) + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data) {
                    //                callback();
                    //            });
                    }
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
                    var month = new Array();
                    month[0] = "Jan";
                    month[1] = "Feb";
                    month[2] = "Mar";
                    month[3] = "Apr";
                    month[4] = "May";
                    month[5] = "Jun";
                    month[6] = "Jul";
                    month[7] = "Aug";
                    month[8] = "Sep";
                    month[9] = "Oct";
                    month[10] = "Nov";
                    month[11] = "Dec";
                    var formattedDate = ('0' + date.getDate()).slice( - 2) + ' ' + ('0' + (month[date.getMonth()])).slice( - 3) + ' ' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice( - 2) + ':' + ('0' + date.getMinutes()).slice( - 2);
                    var print_message = data.message;
                    var print_message = print_message.replace(/"/gi, " ");
                    var print_message = print_message.replace(/%26amp;/gi, "&");
                    var print_message = print_message.replace(/%26gt;/gi, ">");
                    var print_message = print_message.replace(/%26lt;/gi, "<");
                    var print_message = print_message.replace(/\\r/gi, "");
                    var print_message = print_message.replace(/\\t/gi, "");
                    var html = ' <li class="clearfix" id="message_li_' + data.id + '">';
                    html += '   <div class="message-data align-right">';
                    html += '    <span class="message-data-time" >' + formattedDate + '</span>&nbsp; &nbsp;';
                    html += '    <span  class="message-data-name fr"  >' + data.nickname + ' <i class="fa fa-circle me"></i></span>';
                    html += ' </div>';
                    //html += ' <div class="chat-body clearfix">';
                    html += '   <div class="msg_right"> <div class="messagedelete fl"><a href="javascript:void(0);" onclick="delete_chat(1,' + data.id + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div> <div class="message other-message float-right">' + print_message + '</div></div>';
                    html += '</li>';
                    $('.' + 'status' + touser).html(print_message);
                    } else {

                    var timestamp = data.timestamp; // replace your timestamp
                    var date = new Date(timestamp * 1000);
                    var month = new Array();
                    month[0] = "Jan";
                    month[1] = "Feb";
                    month[2] = "Mar";
                    month[3] = "Apr";
                    month[4] = "May";
                    month[5] = "Jun";
                    month[6] = "Jul";
                    month[7] = "Aug";
                    month[8] = "Sep";
                    month[9] = "Oct";
                    month[10] = "Nov";
                    month[11] = "Dec";
                    var formattedDate = ('0' + date.getDate()).slice( - 2) + ' ' + ('0' + (month[date.getMonth()])).slice( - 3) + ' ' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice( - 2) + ':' + ('0' + date.getMinutes()).slice( - 2);
                    //                console.log(formattedDate);

                    var print_message = data.message;
                    var print_message = print_message.replace(/"/gi, " ");
                    var print_message = print_message.replace(/%26amp;/gi, "&");
                    var print_message = print_message.replace(/%26gt;/gi, ">");
                    var print_message = print_message.replace(/%26lt;/gi, "<");
                    var print_message = print_message.replace(/\\r/gi, "");
                    var print_message = print_message.replace(/\\t/gi, "");
                    var html = '<li id="message_li_' + data.id + '" class="recive-data"> <div class="message-data">';
                    html += '<span class="message-data-time">' + formattedDate + ' </span>';
                    html += '<span class="message-data-name fl"><i class="fa fa-circle online"></i>' + data.nickname + ' </span>';
                    html += ' </div>';
                    html += '    <div class="msg_left_data">   <div class="message my-message">' + print_message + '</div><div class="messagedelete"> <a href="javascript:void(0);" onclick="delete_chat(2,' + data.id + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></div>';
                    html += '</li>';
                    $('.' + 'status' + curuser).html(print_message);
                    }

                    $("#received").html($("#received").html() + html);
                    $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
                    });
                    $('#received').animate({scrollTop: $('#received').height()}, 1000);
                    }

                    var update_chats = function () {
                    if (typeof (request_timestamp) == 'undefined' || request_timestamp == 0) {
                    var offset = 52560000; // 100 years min
                    request_timestamp = parseInt(Date.now() / 10                    00 - offset);
                    }
                    $.getJSON('<?php echo base_url() . 'api/get_messages/' . $toid . '/' . $message_from_profile . '/' . $message_to_profile . '/' . $message_from_profile_id . '/' . $message_to_profile_id ?>?timestamp=' + request_timestamp, function (data) {
                    //alert(data.id);
                    append_chat_data(data);
                    var newIndex = data.length - 1;
                    if (typeof (data[newIndex]) != 'undefined') {
                    requ                    est_timestamp = data[newIndex].timestamp;
                    }
                    });
                    }

                    $('#submit').click(function (e) {
                    //        alert(12121);
                    //        return false;
                    e.preventDefault();
                    var $field = $('#message');
                    var data = $('#message').html();
                    da                    ta = data.replace(/&nbsp;/                    gi, " ");
                    if (check_perticular(data) == true) {
                    return false;
                    }
                    var data = $('#message').html().replace(/<div>/gi, '<br>').replace(/<\/div>/gi, '');
                    // data = data.replace(/<br><br>/g, '');
                    data = data.replace(/<                            div><br><\/div>/gi, " ");
                    data = data.replace(/<br>/, '');
                    if (data == '' || data = = '<br>') {
                    return false;
                    }
                    if (check_perticular(data) == true) {
                    return                            false;
                    }

                    $("#message").html("");
                    sendChat(data, function () {
                    });
                    });
                    $("#message").click(function () {
                    $(this).prop("contentEditable", true);
                    });
                    $('#message').keypress(function (e) {

                    if (e.keyCode == 13 && !e.shiftKey) {
                    e.preventDefault();
                    var sel = $("#message");
                    var txt = sel.html();
                    if (check_perticular(txt) == true) {
                    re                                        turn false;
                    }
                    var txt = $('#message').html().replace(/<div>/gi, '<br>').replace(/<\/div                                        >/gi, '');
                    txt = txt.replace(/<                                        div><br><\/div>/gi, " ");
                    txt = txt.replace(/<br>/, '');
                    txt = txt.replace(/&nbsp;/gi, " ");
                    //            txt = txt.replace(/<div><br><\/di                                        v>/gi, " ");
                    //            txt = txt.replace(/&gt;                                        /gi, ">");
                    //            txt = txt.repla                                        ce(/div/gi, "p");
                    if (txt == '' || txt == '<br>')                                         {
                    return false;
                    }
                    if (/^\s+$/gi.test(txt))
                    {
                    return false;
                    }
                    if (check_perticular(txt) == true) {
                    return false;
                    }

                    data = txt.replace(/&/g, "%26");
                    $('#message').html("");
                    sendChat(data, function () {
                    });
                    if (window.preventDuplicateKeyPresses)
                            return;
                    window.preventDuplicateKeyPresses = true;
                    window.setTimeout(function () {
                    window.preventDuplicateKeyPresses = false;
                    }, 500);
                    }
                    });
                    setInterval(function () {
                    update_chats();
                    }, 1500);
                            </script>
                            <script type="text/javascript">
                                function check_perticular(input) {
                                var testData = input.replace(/\s/g, '');
                                var regex = /^(<br>)*$/;
                                var isValid = regex.test(testData);
                                return isVa                                        lid;
                                }
                            </script>
                            <script type="text/javascript">
                                if (e.which == 13 && !e.shiftKey) {
                                e.preventDefault();
                                var $field = $('#message');
                                var data = $('#message').html();
                                var data = $('#message').html().replace(/<div>/gi, '<br>').replace(/<\/div>/gi, '');
                                data = data.replace(/<br><br>/g, '');
                                data = data.replace(/<div><br><\/div>/gi, " ");
                                data = data.repl                                        ace(/<br><br><br><br>/, '');
                                d                                        ata = data.replace(/<br>/, '');
                                if (data == '' || data == '<br>') {
                                return false;
                                }
                                $('#submit                                        ').trigger('click');
                                }

                                    </script>
                                    <script type="text/javascript">
                                        function delete_chat(from, message_id) {
                                        $('.biderror .mes').html("<div class='pop_content'> Do you want to delete this message?<div class='model_ok_cancel'><a class='okbtn' onClick='deleted_chat(" + from + ',' + message_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                                        $('#bidmodal').modal('show');
                                        }
                                        function deleted_chat(from, message_id) {
                                        $.getJSON('<?php echo base_url() . 'api / delete_messages / ' . $message_from_profile . ' / ' . $message_to_profile ?>/' + from + '/' + message_id + '?timestamp=' + request_timestamp, function (data) {
                                        });
                                        $('#message_li_' + message_id).hide();
                                        if (typeof (request_timestamp) == 'undefined' || request_timestamp == 0) {
                                        var offset = 52560000; // 100 years min
                                        request_timestamp = parseInt(Date.now() / 1000 - offset);
                                        }
                                        var id = <?php echo $toid ?>;
                                        var message_from_profile = <?php echo $message_from_profile ?>;
                                        var message_to_profile = <?php echo $message_to_profile ?>;
                                        var message_from_profile_id = <?php echo $message_from_profile_id ?>;
                                        var message_to_profile_id = <?php echo $message_to_profile_id ?>;
                                        $.ajax({
                                        type: 'POST',
                                                url: '<?php echo base_url() ?>api/last_messages',
                                                data: 'timestamp=' + request_timestamp + '&id=' + id + '&message_from_profile=' + message_from_profile + '&message_to_profile=' + message_to_profile + '&message_from_profile_id=' + message_from_profile_id + '&message_to_profile_id=' + message_to_profile_id,
                                                //            data: 'timestamp=' + request_timestamp + '&id='<?php echo $toid ?>'&message_from_profile='<?php echo $message_from_profile ?>'&message_to_profile='<?php echo $message_to_profile ?>'&message_from_profile_id='<?php echo $message_from_profile_id ?>'&message_to_profile_id='<?php echo $message_to_profile_id ?>,
                                                dataType: "json",
                                                success: function (data) {

                                                $('.' + 'status' + id).html(data);
                                                }
                                        });
                                        }
                                        function delete_history() {
                                        $('.biderror .mes').html("<div c                                        lass='pop_content'> Do you want todelete this history?<div class                                        ='model_ok_cancel'><a class='                                        okbtn' onClick='deleted_history()' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'                                        >No</a></div></div>");
                                        $('#bidmodal').modal('show');
                                        }
                                        function deleted_history() {
                                        if (typeof (request_timestamp) == 'undefined' || request_timestamp == 0) {
                                        var offset = 52560000; // 100 years min
                                        request_timestamp = parseInt(Date.now() / 1000 - offset);
                                        }
                                        var id = <?php echo $toid ?>;
                                        var message_from_profile = <?php echo $message_from_profile ?>;
                                        var message_to_profile = <?php echo $message_to_profile ?>;
                                        var message_from_profile_id = <?php echo $message_from_profile_id ?>;
                                        var message_to_profile_id = <?php echo $message_to_profile_id ?>;
                                        $.a                                        jax({
                                        type: 'POST',
                                                url: '<?php echo base_url() ?>api/de                                        lete_history',
                                                data: '                                        timestamp=' + request_timestamp + '&id=                                        ' + id + '&message_from_profile=' + message_from_profile + '&message_to_profile=' + message_to_profile + '&message_from_profile_id=' + message_from_profile_id + '&message_to_profile_id=' + message_to_profile_id,
                                                //            data: 'timestamp=' + request_timestamp + '&id='<?php echo $toid ?>'&message_from_profile='<?php echo $message_from_profile ?>'&message_to_profile='<?php echo $message_to_profile ?>'&message_from_profile_id='<?php echo $message_from_profile_id ?>'&message_to_profile_id='<?php echo $message_to_profile_id ?>,
                                                dataType: "json",
                                                success: function (data) {
                                                if (data.history == 1) {
                                                $('ul#received li').hide();
                                                $('.last' + id).hide();
                                                document.getElementById('chat').style.display = 'none';
                                                }

                                                }
                                        });
                                        }
                                                </script>

                                        
                <!-- user                                        search list  20-4  st                                        art  -->

                                                <script type="text/javascript">

                                                    $(document).ready(function ()                                         {


                                                    //$('#user_search').ke                                        ypress(function() {
                                                    $("#user_search").on("keyup", function (event) {

                                                    var val = $('#user_search').val();
                                                    var usrid = '<?php echo $toid; ?>';
                                                    // khyati chnages  start

                                                    if (val != "") {
                                                    $.ajax({
                                                    type: 'POST',
                                                            url: '<?php echo base_url() . "chat/userlisttwo/" . $message_from_profile . ' / ' . $message_to_profile ?>',
                                                            data: 'searc                                        h_user=' + val + '&user=' + usrid,
                                                            success: function (data) {
                                                            $                                        ('input').each(function () {
                                                            });
                                                            $('#userlist').html(data);
                                                            }
                                                    });
                                                    } else {

                                                    chatmsg();
                                                    }
                                                    });
                                                    });
                                                    $(document).ready(function () {
                                                    chatmsg();
                                                    }); // khyati chnages  start
                                                    function chatmsg()
                                                    {
                                                    var val = $('#user_                                        search').val();
                                                    // khyati chnages  start

                                                    if (val == "") {
                                                    $.ajax({
                                                    type: 'POST',
                                                            url:'<?php echo base_url() . "chat/userajax/" . $message_from_profile . ' / ' . $message_to_profile . ' / ' . $toid ?>',
                                                            dataType: 'json',
                                                            data: '',
                                                            success: function (data) { //alert(data);

                                                            $                                        ('#userlist').html(data.leftbar);
                                                            $('.not                                        ification_data_in_h2').html(data.headertwo);
                                                            $('#seemsg').html(data.s                                        eeall);
                                                            set                                        Timeout(
                                                                    chatmsg,
                                                                    1000
                                                                    );
                                                            },
                                                            error: function (XMLHttpRequest, textS                                        tatus, errorThrown) {
                                                            }
                                                    });
                                                    }
                                                    ;
                                                    }
                                                    ;
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
                        $("#notificationContainer                                        1").hide();
                        });
                        //Popup on click
                        $("#notificationContainer1").click(function ()
                        {
                        return false;
                        });
                        $(".chat_drop a").click(function() {
                        $("#mychat_dropdown").fadeToggle("slow", function() {
                        // Animation complete.
                        });
                        });
                        });
                                    </script>

                <                                        !-- script for selact s                                        mily for message start-->
                                    <script type="text/javascript">
                                        function followclose(clicked_id)
                                        {
                                        //        var MyDiv1 = document.getElementById(clicked_id);
                                        //       var data = MyDiv1.innerHTML;

                                        var img = document.getElementById(clicked_id);
                                        // alert(img.getAttribute('src')); // foo.jpg
                                        //alert(img.src); 
                                        var img = img.src;
                                        $('#m                                        essage').append("<img  src=" + img + " height='21' width='21' >");
                                        }
                                    </script>
                <!-- script for selact smily for message end-->

                                    <script type="text/javascript">
                                        var message = document.querySelector("div");
                                        message.addEventListener("keyup", function ()                                         {

                                        newheight = message.scrollHeight;
                                        message.style.height = newheight + "px";
                                        })

                                                var node = document.querySelector(".comment");
                                        node.focus();
                                        var caret = 10; // insert caret af                                        ter the 10th character
                                        var range = document.createRange();
                                        range.setStart(node, caret);
                                        range.setEnd(node, caret);
                                        var sel = window.getSelection();
                                        sel.removeAllRanges();
                                        sel.addRan                                        ge(rang                                        e);
                                        //    $('.chat .chat-history').scrollTop($('.chat .chat-history')[0].scrollHeight);
                                                    </script>

                                                    <script type="text/javascript">

                                                        var _onPaste_StripFormattin                                        g_IEPaste = false;
                                                        function OnPaste_StripFormatting(elem, e) {

                                                        if (e.originalE                                        vent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                                                        e.preventDefault();
                                                        var text = e.originalEvent.clipboardData.getData('text/plain');
                                                        window.document.execCommand('insertText', false, text);
                                                        } else if (e.clipboardData && e.clipboardData.getData) {
                                                        e.preventDefau                                        lt();
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

                                </sc                                        ript>
                                    <scr                                        ipt>

                                                                $(doc                                        ument).on('keydown', function (e) {
                                                        if (e.keyCode === 27) {
                                                        //$( "#bidmodal" ).hide();
                                                        document.getElementById('notificationContainer1').style.display = 'none';
                                                        }
                                                        });
                                                        $('body').on("click", "*", function (e) {
                                                        document.getElementById('notificationContainer1').style.display = 'none';
                                                        });
                                                                </script>


                                                                <script>
                                                                    /* When the user clicks on the button, 
                                                                     toggle between hi                                        ding and showing the dropdown content */
                                                                    function myFunction() {
                                                                    //document.getElementById("mychat_dropdown").classList.toggle("show");
                                                                    }

                                                                    // Close the dropdown if the user clicks outs#submitide of it
                                                                    window.onclick = function (even                                        t) {
                                                                    if (!event.target.matches('.chatdropbtn')) {

                                                                    var dropdowns = document.getElementsByClassName("chatdropdown-content");
                                                                    var i;
                                                                    for (i = 0; i < dropdowns.length; i++) {
                                                                    var openDropdown = dropdowns[i];
                                                                    if (openDropdown.classList.contains('show')) {
                                                                    openDropdown.classList.remove('show');
                                                                    }
                                                                    }
                                                                    }
                                                                    }
                                                                    //					document.getElementById("notificationContainer1").o                                        nclick = function(evt) {
//						if (!this                                        .isContentEditable) {
                                                                    //		                                        this.contentEdita                                        ble = "true";
                                                                    //							this.                                        focus();
//					                                        }
                                                                    /                                        /					};
                                                                    //Disable pa                                        rt of page
                                                                    $("                                        #notificationContainer1").on("contextmenu", function (e) {
                                                                    return false;
                                                                    });
                                                                    //Disab                                        le part of                                        page
                                                                    $('#notificati                                        onContaine                                        r1').bind('cut copy paste', function (e) {
                                                                    e.preventDefault();
                                                                    });</script>
                 
                                                                                <script>
                                                                    var message_from_profile = <?php echo $message_from_profile ?>;
                                                                    // alert(message_from_profile);
                                                                    // business data start
                                                                    if (me                                        ssage_from_profile == 1) {

                                                                    var base_url = '<?php echo base_url(); ?>';
                                                                    $(function () {
                                                                    functi                                        on split(val) {
                                                                    return val.split(/,\s*/);
                                                                    }
                                                                    function extractLast(term) {
                                                                    return split(term).pop();
                                                                    }

                                                                    $(".bus_search_loc").bind("keydown", function (event) {alert(1313);
                                                                    if (event.keyCode === $.ui.keyCode.TAB &&
                                                                            $(this).autocomplete("instance").menu.active)                                         {
                                                                    event.preventDefault();
                                                                    }
                                                                    })
                                                                    .autocomplete({
                                                                    minLength:                                        2,
                                                                                    source: function (request, response) {
                                                                    // delegate back to aut                                        ocomplete, but ext                                        ract the last                                         term
                                                                    $.getJSON(base_url + "business_profile/get                                        _location", {term: extractLast(request.term)                                        }, response);
                                                                    },
                                                                    focus: function () {
                                                                    //                                         prevent va                                       lue inserted on focus
                                                                            return false;
                                                                                    },
                                                                    sel ect: function (event, ui) {

                                                                    var text = t                                         his.value;
                                                                            var terms = split(this.value);
                                                                                    text = text == null || text == undefined ? "" : text;
                                                                                    var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                    if (checked == 'checked') {

                                                                                    terms.pus                                        h(ui.item.value);
                                                                                   this.value = terms.split("");
                                                                                    }//if end

                                                                                    else {
                                                                                    if (terms.length <= 1) {
                                                                                    // remove the current input
                                                                                    terms.pop();
                                                                                    // add the selected item
                                                                                    terms.push(ui.item.value);
                                                                                    // add placeholder to get the comma-and-space at the end
                                                                                    terms.push("");
                                                                                    this.value = terms.join(" ");
                                                                                  return false;
                                                                                    } else {
                                                                                    var last = terms.pop();
                                                                                    $(thi s).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text fro m input
                                                                                    $(this).effe                                        ct("highlight", {}, 1000);
                                                                                    $ (this).attr("style", "border: solid 1px re                                       d;");
                                                                                    return false;
                                                                                    }
                                                                                    }
                                                                                    }//end else
                                                                                    });
                                                                    });
                                                                                    $(function () {
                                                                                    function split(val) {
                                                                    return val.split(/,\s*/);
                                                                                    }
                                                                                    function extractLast(ter m)  {
                                                                                    return split(term).pop();
                                                                                    }

                                                                   $(".bus_search_comp").bind("keydown", function  (eve nt) {
                                                                                    if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                    $(this).autocomplete("instance").menu.active) {
                                                                    event.preventDefault();
                                                                                    }
                                                                    })
                                                                                    .autocomplete({
                                                                                    minLength: 2,
                                                                            source: function (request, response) {
                                                                    // delegate back to autocomplete, but extract the last term
                                                                    $.getJSON(base_url + "business_profile/get_all_data", {term: extractLast(request.term)}, response);
                                                                    },
                                                                    focus: function () {
                                                                    // prevent value inserted on focus
                                                                                    return false;
                                                                    },
                                                                    select: function (event, ui) {

                                                                    var text = thi                                      s.value;
                                                                    var t                                        erms = split(this.value);
                                                                    text = text == null || text == undefined ? "" : text;
                                                                            var checked = (text.in                                        dexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                    if (checked == 'che                                        cked') {

                                                                                    terms.push(ui.item.value);
                                                                                    this.value = te                                        rms.split("");
                                                                                  }//if end

                                                                                    else {
                                                                                    if (terms.length <= 1) {
                                                                                    // remove the                                        current in                                        put
                                                                                    terms.pop();
                                                                                    // add the selected it em
                                                                                    terms.push(ui.item.value);
                                                                                    // add placeholder t o get the comma-and-space at the end
                                                                                    terms.push("");
                                                                                  this.va                                           lue = terms.join("");
                                                                                    return false;
                                                                                    } el                                        se {
                                                                                    var last = terms.pop();
                                                                                    $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                    $(this).effect("highlight", { }, 1000);
                                                                                    $(this).attr("style", "border: solid 1px red;");
                                                                                    return false;
                                                                                    }
                                                                                    }
                                                                                    }//end else
                                                                                    });
                                                                                    });
                                                                    }
                                                                                    //BUSINES                                          S PROFILE SEAR                                      CH END  
                                                                    //FREELANCER HIRE SERACH  

                                                                                    if (message_from_profile == 3) {
                                                                    //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START
                                                                    va r  base_url = '<?p hp echo base_u rl();  ?>';
                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\                                        s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }
                                                                        $(".skill_keyword").bind("keydown",  function(event) {
                                                                        if  (event.keyCode ===  $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({

                                                                                minLeng                                        th: 2,
                                                                                        source: function(request,  response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON(base_url +  "freelancer/freelancer_hire_search_keyword",  { term : extractLast(request.term)},  response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(event,  ui) {

                                                                                        var  terms  =  split(this.value);
                                                                                        if  (terms.length <=  1) {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        // add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                        terms.push("");
                                                                                        this.value  =  terms.join("");
                                                                                        return false;
                                                                                        }  else{

                                                                                        var  last  =  terms.pop();
                                                                                        $(this).val                                        (this.value.substr(0,  this.value.length -  last.length -  2));  // removes text                                         from input
                                                                                        $(this).eff                                        ect("highlight",  {},  1000);
                                                                                        $(th                                        is).a                                        ttr("style",  "border: solid 1px r                                        ed;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                });
                                                                        });
                                                                        //SCRIP                                        T FOR AUTO                                        FILL OF                                        SEARCH KEYWORD END


                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH START

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split                                        (term).pop();
                                                                        }
                                                                        $(".skill_place").bind("keydown",  function(event) {
                                                                        if  (event.keyCode ===  $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function(request,  response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON(base_url +  "freelancer/freelancer_search_city",  { term : extractLast(request.term)},  response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on fo                                        cus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(event,  ui) {

                                                                                        var  terms  =  split(this.value);
                                                                                        if  (terms.length <=  1) {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        //                                         add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        /                                        / add                                        place                                        holder to get the comma -  and -  space at the end
                                                                                                terms.push("");
                                                                                        this.value  =  terms.join("");
                                                                                        return false;
                                                                                        }  else{
                                                                                        var  last  =  terms.pop();
                                                                                        $(this).val(this.value.substr(0,  this.value.length -  last.length -  2));  // removes text from input
                                                                                        $(this).effect("highlight",  {},  1000);
                                                                                        $(this).a                                        ttr("style",  "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                });
                                                                        });
                                                                        //SCRIPT FOR C                                        ITY AUTOFILL OFSEARCH END


                                                                        }
                                                                        //FREELANCER HIRE SERACH
                                                                        //                                        FREELANCERPOST                                         SERACH
                                                                        if  (messa                                        ge_from_profile ==  4) {
                                                                        //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD                                         START
                                                                        var  base_url  =  '<?php echo base_url(); ?>';
                                                                        $(function() {
                                                                        function spli                                        t(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }
                                                                        $(".skill_keyword").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocompl                                        ete({

                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON(base_url + "freelancer/freelancer_hire_s                                        earch_keyword", { term : ext                                        ractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent                                         value inse                                        rted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(event, ui) {

                                                                                        var terms = split(this.value);
                                                                                        if (terms.length <= 1) {
                                                                                        //                                         remove the cur                                        rent input
                                                                                        terms.pop();
                                                                                        // add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                        terms.push("");
                                                                                        this.value = terms.join("");
                                                                                        retu                                        rn false;
                                                                                        } else{

                                                                                        var last = t                                        erms.pop();
                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                        $(this).attr("st                                        yle", "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                });
                                                                        });
                                                                        //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END


                                                                        //SCRIPT FO                                        R CITY AUTOFILL OF SEARCH START

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extrac                                        tLast(term) {
                                                                        return split(term).pop();
                                                                        }
                                                                        $(".skill_place").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preve                                        ntDefault                                        ();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.g                                        etJSON(base_url + "freelancer/freelancer_search_city", { term : extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: fu                                        nction() {
                                                                                // prevent value inserted on focus
                                                                                return false;
                                                                                },
                                                                                        select: function(event, ui) {

                                                                                        var terms = split(this.value);
                                                                                        if (terms.length <= 1) {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        // add the s                                        elected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                        terms.push("");
                                                                                        this.value = terms.join("");
                                                                                        return false;
                                                                                        } else{
                                                                                        var last = terms.pop();
                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                        $(this).effe                                        ct("highlight", {}, 1000);
                                                                                        $(this).attr("style", "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                });
                                                                        });
                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH END


                                                                        }
                                                                        //FR                                        EELANCER P                                        OST SERACH
                                                                        //RECRUITER POST SERACH
                                                                        if (message_from_profile == 2) {
                                                                        // recruiter search header 2  s                                        tart
// recrui                                        ter search                                         header 2 location start
                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                        $(function () {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term)                                        {
                                                                        retu                                        rn split(term).pop();
                                                                        }

                                                                        $(".rec_search_loc").bind("keydown", function (event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function (request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON(base_url + "recruiter/get_location", {term: extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: func                                        tion () {
                                                                                // p                                        revent value inser                                        ted on focus
                                                                                r                                        eturn                                        false;
                                                                                },
                                                                                        select: function (event, ui) {

                                                                                        var text = this.value;
                                                                                        var terms = split(this.value);
                                                                                        text = text == null || text == undefined ? "" : text;
                                                                                        var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                        i                                        f (che                                        cked == 'checked') {

                                                                                        terms.push(ui.item.va                                        lue);
                                                                                        this.value = terms.split(", ");
                                                                                        }//if end

                                                                                        else {
                                                                                        if (te                                        rms.length <= 1)                                         {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        // add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                        terms.push("                                        ");
                                                                                        this.value = terms.join(", ");
                                                                                        return false;
                                                                                        } else {
                                                                                        var last = terms.pop();
                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                        $(this).attr("style", "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                        }//end else
                                                                                });
                                                                        });
                                                                        // recruiter searc location end
                                                                        // recruiter searc title start
                                                                        $(function () {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }

                                                                        $(".rec_search_title                                        ").bind("keydown", fun                                        ction (event) {
                                                                        if (event.keyCode = == $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.activ                                        e) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        sour                                        ce: functi                                        on (req                                        uest, response) {
                                                                                // delegate back to autocomplete, but extract the last term
                                                                                $.getJSON(base_url + "recruiter/get_job_tile", {term: extractLast(request.term)}, response);
                                                                                },
                                                                                        focus: function () {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function (event, ui) {

                                                                                        var text = this.value;
                                                                                        var terms = split(this.value);
                                                                                        text = text == null || text == undefined ? "" : text;
                                                                                        var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                        if (checked == 'checked') {

                                                                                        terms.p                                        ush(ui.item.value);
                                                                                        this.value = terms.split(", ");
                                                                                        }//if end

                                                                                        else {
                                                                                        if (terms.length <= 1) {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        // add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeholder to get the comma-and-spac                                        e at the end
                                                                                        terms.push("");
                                                                                        this.value = terms.join(", ");
                                                                                        return false;
                                                                                        } else {
                                                                                        var last = terms.pop();
                                                                                        $(this).val(this.value.substr(0, this.value.lengt                                        h - last.length - 2)); // removes text fro                                        m input
                                                                                        $(this).effe                                        ct("highlight", {}, 1000);
                                                                                        $(t                                        his).attr("style", "border: solid                                         1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                        }//end else
                                                                                });
                                                                        });
                                                                        }
                                                                        //RECRUITER POST SERACH
                                                                        //JOB POST SERACH
                                                                        if (message_from_profile == 1) {

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }

                                                                        $("#tags").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minL                                        ength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_alldata", { term : extractLast(request.term)}, response);
                                                                                        },
                                                                                        f                                        ocus: function                                        () {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        se                                        lect: function(event, ui) {
                                                                                        event.preventDefault();
                                                                                        $("#ta                                        gs").val(u                                        i.item.label);
                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                        // window.location.href = ui.item.value;
                                                                                        },
                                                                                });
                                                                        });
                                                                                                                                                                            
                                                                                                                                                                            <!--new script for jobtitle,company and skill  end-->
                                                                                                                                                                            
                                                                                                                                                                    <!--new script for jobtitle,company and skill start for mobile view-->

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return v                                        al.split(/,\s*                                        /);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }

                                                                        $("#tags1").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preven                                        tDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // de                                        legate back to autocomplete, but e                                        xtract the last te                                        rm
                                                                                        $.getJS                                        ON("<?php echo base_url(); ?>general/get_alldata", {term                                         : extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(event, ui) {
                                                                                        event.preventDefault();
                                                                                        $("#tags1").val(ui.item.label);
                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                        // window.location.href = ui.item.value;
                                                                                        },
                                                                                });
                                                                        });
                                                                                    
                                                                                    <!--new script for jobtitle,company and skill for mobile view end-->
                                                                                    
                                                                                                                                                                            <!--new script for cities start-->

                                                                        $(function                                        () {
                                                                        fu                                        nction split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }

                                                                        $("#searchplace").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomp                                        lete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .auto                                        complete({
                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate ba                                        ck to autocomp                                        lete, but ex                                        tract the                                        last term
                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_location", { ter                                        m : extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: functio                                        n() {
                                                                                // prevent value inserted on focus
                                                                                return false;
                                                                                },
                                                                                        select: function(event, ui)                                         {
                                                                                        e                                        vent.preven                                        tDefault();
                                                                                        $("#searchplace").val(ui.item.label);
                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                        // window.location.href = ui.item.value;
                                                                                        },
                                                                                });
                                                                        });
                                                                                                                                                                                            
                                                                                                                                                                            <!--new script                                        for cities end                                        -->
                                                                                                                                                                            
<!--new script for cities start mobile view-->

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }

                                                                        $("#searchplace1").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_location", { term : extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(event, ui) {
                                                                                        event.preventDefault();
                                                                                        $("#searchplace1").val(ui.item.label);
                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                        // window.location.href = ui.item.value;
                                                                                        },
                                                                                });
                                                                        });<!--new script for cities end mobile view-->
                                                                        }
                                                                        //JOB POST SERACH
                                                                        //ARTUSTIC POST SERACH
                                                                        if (message_from_profile == 3) {
                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                        $(func                                        tion() {
                                                                        function split                                        (val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }
                                                                        $("#tags").bind("keydown", function(event) {
                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                $(this).autocomplete                                        ("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({

                                                                                minLength: 2,
                                                                                        source: function(request, respons                                        e) {
                                                                                        // delegate back to                                        autocomplete, but extract                                        the last term
                                                                                        $.getJSON(base_url + "artist/artist                                        ic_se                                        arch_keyword", { term : extractL                                        ast(request.term)}, response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: function(even                                        t, ui) {

                                                                                        var terms = split(this.value);
                                                                                        if (terms.length <= 1) {
                                                                                        // remove the current input
                                                                                        terms.pop();
                                                                                        // add the selected item
                                                                                        terms.push(ui.item.value);
                                                                                        // add placeh                                        older to get the co                                        mma-and-space at the end
                                                                                        terms.push("");
                                                                                        this.value = terms.join("");
                                                                                        return fals                                        e;
                                                                                        } else{

                                                                                        var last = terms.pop();
                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                        $(this).attr("style", "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                });
                                                                        });
                                                                        //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END


                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH START

                                                                        $(function() {
                                                                        function split(val) {
                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                        return split(term).pop();
                                                                        }
                                                                        $("#sear                                        chplace").bind("keyd                                        own", function(event) {
                                                                        if (e                                        vent.keyCod                                        e === $.ui.keyCode.TAB &&
                                                                                $(thi                                        s).autocomplete("instance").menu.active) {
                                                                        event.preventDefault();
                                                                        }
                                                                        })
                                                                                .autocomplete({
                                                                                minLength: 2,
                                                                                        source: function(request, response) {
                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                        $.get                                        JSON(base_url + "artist/a                                        rtistic_search_city", { term : extractLast(request.term)}, response);
                                                                                        },
                                                                                        focus: function() {
                                                                                        // prevent value inserted on focus
                                                                                        return false;
                                                                                        },
                                                                                        select: fun                                        ction(event, ui) {

                                                                                var terms = split(this.value);
                                                                                if (terms.length <= 1) {
                                                                                // remove the current input
                                                                                terms.pop();
                                                                                // add the                                         selected item
                                                                                ter                                        ms.push(ui.item.value);
                                                                                // add pl                                        aceholder to get the comma-and-space at the end
                                                                                terms.push("");
                                                                                this.value = terms.join("");
                                                                                return                                         false;
                                                                                } else{
                                                                                var last = ter                                        ms.pop();
                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                $(this).effect("highlight", {}, 1000);
                                                                                $(this).attr("style", "border: solid 1px red;");
                                                                                return false;
                                                                                }
                                                                                }
                                                                                });
                                                                        });
                                                                        }
                                                                        //ARTUSTIC POST SERACH
                                                                                                                                                                                                                                    </script>
                
                                                                                                                                                                                                                                    <script>
                                                                                        var message_fro                                        m_profile = <?ph                                        p echo $mess                                        age_from_                                        profile ?>;
                                                                                        
                                                                                        // business data start
                                                                                        if (message_from_profile == 1) {

                                                                                                var b                                        ase_url = '<?php echo base_url(); ?>';
                                                                                        $(function () {
                                                                                        function split(val) {
                                                                                        return                                         val.split(/,\s*/);
                                                                                }
                                                                                function extractLast(term) {
                                                                                                return split(term).pop();
                                                                                        }
                                                                                        
                                                                                        $(".bus_search_loc").bind("keydown", function (event) {alert(1313);
                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                        event.preventDefault();
                                                                        }
                                                                                })
                                                                        .autocomplete({
                                                                                                minLength: 2,
                                                                                                source: function (request, response) {
                                                                                                // delegate back to autocomplete, but extract the last term
                                                                                                $.getJSON(bas                                        e_url + "bus                                        iness_pro                                        file/get_location", {term: extract                                        Last(request.term)}, response);
                                                                        },
                                                                        focus: function () {
                                                                                                        // prevent value inserted on foc                                        us
                                                                                                        return false;
                                                                        },
                                                                        select: function (event, ui) {

                                                                                                        var text = this.value;
                                                                                                var term                                        s = split(t                                        his.value);
                                                                                                text = text == null || text == undefined ? "" : text;
                                                                                                var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                                if (checked == 'checked') {

                                                                                                terms.push(ui.item.value);
                                                                                                this.value = terms.split(", ");
                                                                                        }//if end
                                                                                        
                                                                                        else {
                                                                                                        if (terms.length <= 1) {
                                                                                                // remove the current input
                                                                                                terms.pop();
                                                                                                // add the selected item
                                                                                                te                                        rms.push(ui.item.value);
                                                                                                /                                        / add                                        placeholder to get t                                        he comma - and - space at the                                         end
                                                                                                        terms.push("");
                                                                                                this.value = terms.join("");
                                                                                                return false;
                                                                        } else {
                                                                                                        var last = terms.pop();
                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                $(this).effect("highlight", {}, 1000);
                                                                        $(this)                                        .attr("style", "border: solid 1px red;");
                                                                        return false;
                                                                        }
                                                                        }
                                                                        }//end else                                        
                                                                        });
                                                                        });                                        
                                                                        
                                                                        $(function () {
                                                                                                        function split(val) {
                                                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast(term) {
                                                                                                                return split(term).pop();
                                                                                        }
                                                                                        
                                                                                        $(".bus_search_comp").bind("keydown", function (event) {
                                                                                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                        $(this).autocomplete("instance").menu.active) {
                                                                                                        event.preventDefault();
                                                                                        }
                                                                                        })
                                                                                        .autocomplete({
                                                                                                                minLength: 2,
                                                                                                                sour                                        ce: function (requ                                        est, response)                                        {
                                                                                                                // delegate back to autocomplete, but extrac                                        t the last term
                                                                                                                $.getJSO                                        N(base_url + "business_profile/get_all_data", {term: extractLast(request.term)}, response);                                        
                                                                                        },
                                                                                        focus: function () {
                                                                                                                        // prevent value inserted on focus
                                                                                                                        return false;
                                                                                        },
                                                                                        select: function (event, ui) {

                                                                                                                        var text = this.value;
                                                                                                                var terms = split(this.value);
                                                                                                                text = text == null || text == undefined ? "" : text;
                                                                                                                var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                                                if (checked == 'checked') {

                                                                                                                terms.push(ui.item.value);
                                                                                                                th                                        is.value = term                                        s.split("");
                                                                        }//if end
                                                                        
                                                                        else {
                                                                                                                        if (terms.length <= 1) {
                                                                                                                // remove the current input
                                                                                                                terms.pop();
                                                                                                                // add the selected item
                                                                                                                terms.push(ui.item.value);
                                                                                                                // add placeholder to get the comma-and-space at the end
                                                                                                                terms.push("");
                                                                                                                this.value = terms.join("");
                                                                                                                return false;
                                                                        } else {
                                                                                                                        var last = terms.pop();
                                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                $(this).effect("highlight", {}, 1000);
                                                                                        $(this).attr("style", "border: solid 1px red;");
                                                                                        return false;
                                                                                        }
                                                                                        }
                                                                                        }//end else
                                                                                        });
                                                                                        });
                                                                                        }
                                                                                        //BUSINESS PROFILE SEARCH END  
                                                                                        //FREELANCER HIRE SERACH  
                                                                                
                                                                                if (message_from_profile == 3) {
                                                                                                                        //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START
                                                                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                                                                $(function() {
                                                                                                                function split(val) {
                                                                                                                return val.split(/,\s*/);
                                                                                }
                                                                                function extractLast( term ) {
                                                                                                                        return split(term).pop();
                                                                                }
                                                                                $( ".skill_keyword" ).bind( "keydown", function( event ) {
                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                event.preventDefault();
                                                                        }
                                                                                })
                                                                                .autocomplete({

                                                                                                                        minLength: 2,
                                                                                                                        source: function(request, response) {
                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                        $.getJSON(base_url + "freelancer/freelancer_hire_search_keyword", { term : extractLast(request.term)},response);
                                                                                        },
                                                                                        focus: function() {
                                                                                                                                // prevent value inserted on focus
                                                                                                                                return false;
                                                                                                },
                                                                                                select: function( event, ui ) {

                                                                                                                                var terms = split(this.value);
                                                                                                                        if (terms.length <= 1) {
                                                                                                                        // remove the current input
                                                                                                                        terms.pop();
                                                                                                                        // add the selected item
                                                                                                                        terms.push(ui.item.value);
                                                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                                                        terms.push("");
                                                                                                                        this.value = terms.join("");
                                                                                                                        return false;
                                                                                }else{

                                                                                                                                var last = terms.pop();
                                                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                                $(this).attr("style","border: solid 1px red;");
                                                                                                return false;
                                                                                                }
                                                                                                }
                                                                        });
                                                                                                        });
                                                                                                        
                                                                                                        //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END
                                                                        
                                                                        
                                                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH START
                                                                                                
                                                                                                $(function() {
                                                                                                                                function split(val) {
                                                                                                                                return val.split(/,\s*/);
                                                                                                }
                                                                                                function extractLast( term ) {
                                                                                                                                        return split(term).pop();
                                                                                        }
                                                                                        $( ".skill_place" ).bind( "keydown", function( event ) {
                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                event.preventDefault();
                                                                                                }
                                                                                                })
                                                                                                .autocomplete({
                                                                                                                                        minLength: 2,
                                                                                                                                        source: function(request, response) {
                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                        $.getJSON(base_url + "freelancer/freelancer_search_city", { term : extractLast(request.term)},response);
                                                                                                },
                                                                                                focus: function() {
                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                return false;
                                                                        },
                                                                        select: function( event, ui ) {

                                                                                                                                                var terms = split(this.value);
                                                                                                                                        if (terms.length <= 1) {
                                                                                                                                        // remove the current input
                                                                                                                                        terms.pop();
                                                                                                                                        // add the selected item
                                                                                                                                        terms.push(ui.item.value);
                                                                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                                                                        terms.push("");
                                                                                                                                        this.value = terms.join("");
                                                                                                                                        return false;
                                                                                                        }else{
                                                                                                                                                var last = terms.pop();
                                                                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                                                $(this).attr("style","border: solid 1px red;");
                                                                                                                return false;
                                                                                                                }
                                                                                                                }
                                                                                                                });
                                                                                        });
                                                                                        
                                                                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH END
                                                                                                                        
                                                                                                                        
                                                                                        }
                                                                                        //FREELANCER HIRE SERACH
                                                                                                                        //FREELANCER POST SERACH
                                                                                                                if (message_from_profile == 4) {
                                                                                                                                                //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START
                                                                                                                                                var base_url = '<?php echo base_url(); ?>';
                                                                                                                                        $(function() {
                                                                                                                                        function split(val) {
                                                                                                                                        return val.split(/,\s*/);
                                                                        }
                                                                        function extractLast( term ) {
                                                                                                                                                return split(term).pop();
                                                                                                                }
                                                                                                                $( ".skill_keyword" ).bind( "keydown", function( event ) {
                                                                                                                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                        $(this).autocomplete("instance").menu.active) {
                                                                                                                                        event.preventDefault();
                                                                                                                }
                                                                                                                })
                                                                        .autocomplete({

                                                                                                                                                minLength: 2,
                                                                                                                                                source: function(request, response) {
                                                                                                                                                // delegate back to autocomplete, but extract the last term
                                                                                                                                                $.getJSON(base_url + "freelancer/freelancer_hire_search_keyword", { term : extractLast(request.term)},response);
                                                                                        },
                                                                                        focus: function() {
                                                                                                                                                        // prevent value inserted on focus
                                                                                                                                                        return false;
                                                                                        },
                                                                                        select: function( event, ui ) {

                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                // remove the current input
                                                                                                                                                terms.pop();
                                                                                                                                                // add the selected item
                                                                                                                                                terms.push(ui.item.value);
                                                                                                                                                // add placeholder to get the comma-and-space at the end
                                                                                                                                                terms.push("");
                                                                                                                                                this.value = terms.join("");
                                                                                                                                                return false;
                                                                        }else{

                                                                                                                                                        var last = terms.pop();
                                                                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                $(this).effect("highlight", {}, 1000);
                                                                                                                        $(this).attr("style","border: solid 1px red;");
                                                                                                                        return false;
                                                                                                                        }
                                                                                                                        }
                                                                                        });
                                                                                        });
                                                                                                                                
                                                                                                                                //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END
                                                                                                
                                                                                                
                                                                                                                                //SCRIPT FOR CITY AUTOFILL OF SEARCH START
                                                                                                                        
                                                                                                                        $(function() {
                                                                                                                                                        function split(val) {
                                                                                                                                                        return val.split(/,\s*/);
                                                                                                                        }
                                                                                                                        function extractLast( term ) {
                                                                                                                                                                return split(term).pop();
                                                                                                                        }
                                                                                                                        $( ".skill_place" ).bind( "keydown", function( event ) {
                                                                                                                                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                        $(this).autocomplete("instance").menu.active) {
                                                                                                                                                        event.preventDefault();
                                                                                                }
                                                                                                })
                                                                                                .autocomplete({
                                                                                                                                                                minLength: 2,
                                                                                                                                                                source: function(request, response) {
                                                                                                                                                                // delegate back to autocomplete, but extract the last term
                                                                                                                                                                $.getJSON(base_url + "freelancer/freelancer_search_city", { term : extractLast(request.term)},response);
                                                                                                },
                                                                                                focus: function() {
                                                                                                                                                                        // prevent value inserted on focus
                                                                                                                                                                        return false;
                                                                                                                                        },
                                                                                                                                        select: function( event, ui ) {

                                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                                // remove the current input
                                                                                                                                                                terms.pop();
                                                                                                                                                                // add the selected item
                                                                                                                                                                terms.push(ui.item.value);
                                                                                                                                                                // add placeholder to get the comma-and-space at the end
                                                                                                                                                                terms.push("");
                                                                                                                                                                this.value = terms.join("");
                                                                                                                                                                return false;
                                                                                                                                                }else{
                                                                                                                                                                        var last = terms.pop();
                                                                                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                                $(this).effect("highlight", {}, 1000);
                                                                                                                                        $(this).attr("style","border: solid 1px red;");
                                                                                                                                        return false;
                                                                                                                                        }
                                                                                                                                        }
                                                                                                                                        });
                                                                                                                                        });
                                                                                                                                        
                                                                                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH END
                                                                                                                                        
                                                                                                                                        
                                                                                                        }
                                                                                                                                                //FREELANCER POST SERACH
                                                                                                                                        //RECRUITER POST SERACH
                                                                                                                                        if (message_from_profile == 2) {
                                                                                                                                                                        // recruiter search header 2  start
// recruiter search header 2 location start
                                                                                                                                                                        var base_url = '<?php echo base_url(); ?>';
                                                                                                                                                                $(function () {
                                                                                                                                                                function split(val) {
                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                        }
                                                                                                                        function extractLast(term) {
                                                                                                                                                                        return split(term).pop();
                                                                                                                        }
                                                                                                                        
                                                                                                                $(".rec_search_loc").bind("keydown", function (event) {
                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                event.preventDefault();
                                                                                                                                        }
                                                                        })
                                                                        .autocomplete({
                                                                                                                                                                        minLength: 2,
                                                                                                                                                                        source: function (request, response) {
                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                        $.getJSON(base_url + "recruiter/get_location", {term: extractLast(request.term)}, response);
                                                                                                                                        },
                                                                                                                focus: function () {
                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                return false;
                                                                                                                                                },
                                                                                                                                                select: function (event, ui) {

                                                                                                                                                                                var text = this.value;
                                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                                        text = text == null || text == undefined ? "" : text;
                                                                                                                                                                        var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                                                                                                        if (checked == 'checked') {

                                                                                                                                                                        terms.push(ui.item.value);
                                                                                                                                                                        this.value = terms.split("");
                                                                                                                                                }//if end
                                                                                                                                                
                                                                                                                                                else {
                                                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                                        // remove the current input
                                                                                                                                                                        terms.pop();
                                                                                                                                                                        // add the selected item
                                                                                                                                                                        terms.push(ui.item.value);
                                                                                                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                                                                                                        terms.push("");
                                                                                                                                                                        this.value = terms.join("");
                                                                                                                                                                        return false;
                                                                                                                        } else {
                                                                                                                                                                                var last = terms.pop();
                                                                                                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                                $(this).attr("style", "border: solid 1px red;");
                                                                                                return false;
                                                                                                                                }
                                                                                                                        }
                                                                                                                        }//end else
                                                                                                                                                        });
                                                                                                                                                        });
                                                                                                                                                        
                                                                                                                        // recruiter searc location end
                                                                                                                                                                // recruiter searc title start
                                                                                                                        $(function () {
                                                                                                                                                                                function split(val) {
                                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                                                        }
                                                                                                                                                                        function extractLast(term) {
                                                                                                                                                                                        return split(term).pop();
                                                                                                                                                                }
                                                                                                                                                                
                                                                                                                                                                $(".rec_search_title").bind("keydown", function (event) {
                                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                        }
                                                                                                                                                                        })
                                                                                                                                        .autocomplete({
                                                                                                                                                                                        minLength: 2,
                                                                                                                                                                                        source: function (request, response) {
                                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                        $.getJSON(base_url + "recruiter/get_job_tile", {term: extractLast(request.term)}, response);
                                                                                                                                                                },
                                                                                                                                                                focus: function () {
                                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                                return false;
                                                                                                                                                                },
                                                                                                                                                                select: function (event, ui) {

                                                                                                                                                                                                var text = this.value;
                                                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                                                        text = text == null || text == undefined ? "" : text;
                                                                                                                                                                                        var checked = (text.indexOf(ui.item.value + ', ') > - 1 ? 'checked' : '');
                                                                                                                                                                                        if (checked == 'checked') {

                                                                                                                                                                                        terms.push(ui.item.value);
                                                                                                                                                                                        this.value = terms.split("");
                                                                                                                                        }//if end
                                                                                                                                        
                                                                                                                                        else {
                                                                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                                                        // remove the current input
                                                                                                                                                                                        terms.pop();
                                                                                                                                                                                        // add the selected item
                                                                                                                                                                                        terms.push(ui.item.value);
                                                                                                                                                                                        // add placeholder to get the comma-and-space at the end
                                                                                                                                                                                        terms.push("");
                                                                                                                                                                                        this.value = terms.join("");
                                                                                                                                                                                        return false;
                                                                                                                        } else {
                                                                                                                                                                                                var last = terms.pop();
                                                                                                                                                                                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                                                        $(this).effect("highlight", {}, 1000);
                                                                                                                                                                        $(this).attr("style", "border: solid 1px red;");
                                                                                                                                                                                return false;
                                                                                                                                                                }
                                                                                                                                                                }
                                                                        }//end else
                                                                        });
                                                                                                                                                                        });
                                                                                                                                                                        
                                                                                                                                                                        }
                                                                                                                                                                        //RECRUITER POST SERACH
                                                                                                                                                                        //JOB POST SERACH
                                                                                                                                        if (message_from_profile == 1) {

                                                                                                                                                                                                $(function() {
                                                                                                                                                                                                function split(val) {
                                                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                                                                                }
                                                                                                                                                                                function extractLast( term ) {
                                                                                                                                                                                                        return split(term).pop();
                                                                                                                                                                        }
                                                                                                                                                                        
                                                                                                                                                                        $( "#tags" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                }
                                                                                                                                                })
                                                                                                                                                                                .autocomplete({
                                                                                                                                                                                                        minLength: 2,
                                                                                                                                                                                                        source: function(request, response) {
                                                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_alldata", { term : extractLast(request.term)},response);
                                                                                                                                                                        },
                                                                                                                                                                        focus: function() {
                                                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                                                return false;
                                                                                                                                                                        },
                                                                                                                                                                        
                                                                                                                                                                        select: function(event, ui) {
                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                                        $("#tags").val(ui.item.label);
                                                                                                                                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                                                                                                                                        // window.location.href = ui.item.value;
                                                                                                                        },
                                                                                                                        
                                                                                                                                                                });
                                                                                                                        });
                                                                                                                        
                                                                                                                                                                                <!--new script for jobtitle,company and skill  end-->
                                                                                                                                                                                
                                                                                                                                                        <!--new script for jobtitle,company and skill start for mobile view-->
                                                                                                                                                                        
                                                                                                                                                                                        $(function() {
                                                                                                                                                                                                                function split(val) {
                                                                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                                                                                        }
                                                                                                                                                                                        function extractLast( term ) {
                                                                                                                                                                                                                        return split(term).pop();
                                                                                                                                                                        }
                                                                                                                                                                        
                                                                                                                                                                        $( "#tags1" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                        }
                                                                                                                                                                })
                                                                                                                                                                .autocomplete({
                                                                                                                                                                                                                        minLength: 2,
                                                                                                                                                                                                                        source: function(request, response) {
                                                                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_alldata", { term : extractLast(request.term)},response);
                                                                                                                                                                                        },
                                                                                                                                                                                        focus: function() {
                                                                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                                                                return false;
                                                                                                                                                                                        },
                                                                                                                                                                                        
                                                                                                                                                                                        select: function(event, ui) {
                                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                                                        $("#tags1").val(ui.item.label);
                                                                                                                                                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                                                                                                                                                        // window.location.href = ui.item.value;
                                                                                                                                                                                        },
                                                                                                                                                                                        
                                                                                                                                                                                        });
                                                                                                                                                                                        });
                                                                                                                                                                                        
                                                                                                                                                                                        <!--new script for jobtitle,company and skill for mobile view end-->
                                                                                                                                                                                        
                                                                                                                                                                                                <!--new script for cities start-->
                                                                                                                                                                                        
                                                                                                                                                                                        $(function() {
                                                                                                                                                                                                                                function split(val) {
                                                                                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                                                                }
                                                                                                                                                                function extractLast( term ) {
                                                                                                                                                                                                                                        return split(term).pop();
                                                                                                                                                                        }
                                                                                                                                                                        
                                                                                                                                                                        $( "#searchplace" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                                }
                                                                                                                                                                                                })
                                                                                                                                                                                .autocomplete({
                                                                                                                                                                                                                                        minLength: 2,
                                                                                                                                                                                                                                        source: function(request, response) {
                                                                                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_location", { term : extractLast(request.term)},response);
                                                                                                                                                                                                                },
                                                                                                                                                                                                focus: function() {
                                                                                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                                        },
                                                                                                                                                                                                        
                                                                                                                                                                                                        select: function(event, ui) {
                                                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                                                                        $("#searchplace").val(ui.item.label);
                                                                                                                                                                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                                                                                                                                                                        // window.location.href = ui.item.value;
                                                                                                                                                                        },
                                                                                                                                                                        
                                                                                                                                                                        });
                                                                                                                                                                        });
                                                                                                                                                                                                                
                                                                                                                                                                                                        <!--new script for cities end-->
                                                                                                                                                                                                        
                                                                                                                                                                                                        <!--new script for cities start mobile view-->
                                                                                                                                                                                                        
                                                                                                                        $(function() {
                                                                                                                                                                                                                                                function split(val) {
                                                                                                                                                                                                                                                return val.split(/,\s*/);
                                                                                                                                                                                }
                                                                                                                                                                                function extractLast( term ) {
                                                                                                                                                                                                                                                        return split(term).pop();
                                                                                                                                                                                                                }
                                                                                                                                                                                                                
                                                                                                                                                                                                                $( "#searchplace1" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                                                                        if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                                                                $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                        }
                                                                                                                                                                        })
                                                                                                                                                                                                                        .autocomplete({
                                                                                                                                                                                                                                                        minLength: 2,
                                                                                                                                                                                                                                                        source: function(request, response) {
                                                                                                                                                                                                                                                        // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                                                                        $.getJSON("<?php echo base_url(); ?>general/get_location", { term : extractLast(request.term)},response);
                                                                                                                                                                                                                        },
                                                                                                                                                                                                                        focus: function() {
                                                                                                                                                                                                                                                                // prevent value inserted on focus
                                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                        },
                                                                                                                                                                                        
                                                                                                                                                                                                                                select: function(event, ui) {
                                                                                                                                                                                                                                                                event.preventDefault();
                                                                                                                                                                                                                                                        $("#searchplace1").val(ui.item.label);
                                                                                                                                                                                                                                                        $("#selected-tag").val(ui.item.label);
                                                                                                                                                                                                                                                        // window.location.href = ui.item.value;
                                                                                                                                                                                                                        },
                                                                                                                                                                                                                        
                                                                                                                                                                                                                        });
                                                                                                                                                                                        });
                                                                                                                                                                                        
                                                                                                                                                                                        <!--new script for cities end mobile view-->
                                                                                                                                                                                        }
                                                                                                                                                                                        //JOB POST SERACH
                                                                                                                                                                                        //ARTUSTIC POST SERACH
                                                                                                                                                                                        if (message_from_profile == 3) {
                                                                                                                                                                                                                                                                var base_url = '<?php echo base_url(); ?>';
                                                                                                                                                                                                                                                        $(function() {
                                                                                                                                                                                                                                                        function split(val) {
                                                                                                                                                                                                                                                        return val.split(/,\s*/);
                                                                                                                                                                }
                                                                                                                                                                function extractLast( term ) {
                                                                                                                                                                                                                                                                return split(term).pop();
                                                                                                                                                                        }
                                                                                                                                                                        $( "#tags" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                                                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                                                                        $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                                                                        event.preventDefault();
                                                                                                                                                                                                }
                                                                                                                                                                                                })
                                                                                                                                                                                                .autocomplete({

                                                                                                                                                                                                                                                                minLength: 2,
                                                                                                                                                                                                                                                                source: function(request, response) {
                                                                                                                                                                                                                                                                // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                                                                                $.getJSON(base_url + "artist/artistic_search_keyword", { term : extractLast(request.term)},response);
                                                                                                                                                                                                                },
                                                                                                                                                                                                focus: function() {
                                                                                                                                                                                                                                                                        // prevent value inserted on focus
                                                                                                                                                                                                                                                                        return false;
                                                                                                                                                                                                        },
                                                                                                                                                                                                        select: function( event, ui ) {

                                                                                                                                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                                                                                                                                // remove the current input
                                                                                                                                                                                                                                                                terms.pop();
                                                                                                                                                                                                                                                                // add the selected item
                                                                                                                                                                                                                                                                terms.push(ui.item.value);
                                                                                                                                                                                                                                                                // add placeholder to get the comma-and-space at the end
                                                                                                                                                                                                                                                                terms.push("");
                                                                                                                                                                                                                                                                this.value = terms.join("");
                                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                                        }else{

                                                                                                                                                                                                                                                                        var last = terms.pop();
                                                                                                                                                                                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                                                                                                                                $(this).effect("highlight", {}, 1000);
                                                                                                                                                                                                                                                        $(this).attr("style","border: solid 1px red;");
                                                                                                                                                                                                                return false;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                
                                                                                                                                                                                                                                                //SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END
                                                                                                                                                                        
                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                        //SCRIPT FOR CITY AUTOFILL OF SEARCH START
                                                                                                                                                                                                                                                        
                                                                                                                                                                                                                                                        $(function() {
                                                                                                                                                                                                                                                                        function split(val) {
                                                                                                                                                                                                                                                                        return val.split(/,\s*/);
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                        function extractLast( term ) {
                                                                                                                                                                                                                                                                                return split(term).pop();
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                        $( "#searchplace" ).bind( "keydown", function( event ) {
                                                                                                                                                                                                                                                                                if (event.keyCode === $.ui.keyCode.TAB &&
                                                                                                                                                                                                                                                                                        $(this).autocomplete("instance").menu.active) {
                                                                                                                                                                                                                                                                        event.preventDefault();
                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                        })
                                                                                                                                                                                                                        .autocomplete({
                                                                                                                                                                                                                                                                                minLength: 2,
                                                                                                                                                                                                                                                                                source: function(request, response) {
                                                                                                                                                                                                                                                                                // delegate back to autocomplete, but extract the last term
                                                                                                                                                                                                                                                                                $.getJSON(base_url + "artist/artistic_search_city", { term : extractLast(request.term)},response);
                                                                                                                                                                                        },
                                                                                                                                                                                        focus: function() {
                                                                                                                                                                                                                                                                                        // prevent value inserted on focus
                                                                                                                                                                                                                                                                                        return false;
                                                                                                                                                                                                                                                        },
                                                                                                                                                                                                                                                        select: function( event, ui ) {

                                                                                                                                                                                                                                                                                        var terms = split(this.value);
                                                                                                                                                                                                                                                                                if (terms.length <= 1) {
                                                                                                                                                                                                                                                                                // remove the current input
                                                                                                                                                                                                                                                                                terms.pop();
                                                                                                                                                                                                                                                                                // add the selected item
                                                                                                                                                                                                                                                                                terms.push(ui.item.value);
                                                                                                                                                                                                                                                                                // add placeholder to get the comma-and-space at the end
                                                                                                                                                                                                                                                                                terms.push("");
                                                                                                                                                                                                                                                                                this.value = terms.join("");
                                                                                                                                                                                                                                                                                return false;
                                                                                                                                                                                                                                                                }else{
                                                                                                                                                                                                                                                                                        var last = terms.pop();
                                                                                                                                                                                                                                                                                $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                                                                                                                                                                                                                                                                                $(this).effect("highlight", {}, 1000);
                                                                                                                                                                                                                                                                        $(this).attr("style","border: solid 1px red;");
                                                                                                                                                                                                                                                                        return false;
                                                                                                                                                                                                        }
                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                        });
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                //ARTUSTIC POST SERACH
                                                                                                                                                                                                                                                                </script>
