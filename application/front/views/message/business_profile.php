<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $head_message; ?>
        <meta charset="utf-8">
        <title>Chat | Aileensoul</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="icon" href="<?php echo base_url('assets/images/favicon.png'); ?>">
        <!--        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
                <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">-->
        <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>

        <style type="text/css">
            .msg_right:hover .messagedelete{ visibility: visible;opacity: 1;}
            .msg_right .messagedelete{ visibility: hidden;  cursor: pointer; width:25px; float:left;}
            .msg_left_data:hover .messagedelete{ visibility: visible;opacity: 1;}
            .msg_left_data .messagedelete{ visibility: hidden;  cursor: pointer; width:25px; float:left;}
            .chat .chat-history .msg_left_data::after{display:none;}
            .chat .chat-history .msg_right::after{display:none;}
            .msg_left_data .msg-user-img{width:35px; height:35px; border-radius:100%; overflow:hidden; float:left; margin-right:10px;}
            .msg_right .msg-user-img{width:35px; height:35px; border-radius:100%; overflow:hidden; float:right; margin-left:10px;}
            .chat .chat-history .my-message{max-width:93%;}
            .chat .chat-history .other-message{float:left; max-width:93%;}
            .msg-time{float: right; padding-left: 10px; font-size: 11px; vertical-align: bottom; line-height: 1;
                      padding-top: 10px; opacity: 0.5;}
            </style>
<!--            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/emoji/css/jquery.emojipicker.css">
            <script type="text/javascript" src="<?php echo base_url() ?>assets/emoji/js/jquery.emojipicker.js"></script>

             Emoji Data 
            <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/emoji/css/jquery.emojipicker.tw.css">
            <script type="text/javascript" src="<?php echo base_url() ?>assets/emoji/js/jquery.emojis.js"></script>-->

<!--            <script type="text/javascript">
                $(document).ready(function (e) {

                    $('#input-default').emojiPicker();
                    $('#input-custom-size').emojiPicker({
                        width: '300px',
                        height: '200px'
                    });
                    $('#input-left-position').emojiPicker({
                        position: 'left'
                    });
                    $('#create').click(function (e) {
                        e.preventDefault();
                        $('#text-custom-trigger').emojiPicker({
                            width: '300px',
                            height: '200px',
                            button: false
                        });
                    });
                    $('#toggle').click(function (e) {
                        e.preventDefault();
                        $('#text-custom-trigger').emojiPicker('toggle');
                    });
                    $('#destroy').click(function (e) {
                        e.preventDefault();
                        $('#text-custom-trigger').emojiPicker('destroy');
                    })

                    // keyup event is fired
                    $(".emojiable-question, .emojiable-option").on("keyup", function () {
                        //console.log("emoji added, input val() is: " + $(this).val());
                    });
                });
            </script>-->

        <body ng-app="messageApp" ng-controller="messageController">
            <?php echo $header; ?>
            <?php echo $business_header2_border; ?>
            <div class="container">
            <div class="" id="paddingtop_fixed">
                <div class="chat_nobcx">
                    <!--<div class="people-list" id="people-list" ng-app="messageApp" ng-controller="messageController">-->
                    <div class="people-list" id="people-list">
                        <div class="search border_btm">
                            <input name="search_key" ng-model="search_key" ng-keyup="getSearchdata()" id="search_key" placeholder="search" type="search">
                            <i class="fa fa-search" id="add_search"></i>
                        </div>
                        <ul class="list">
                            <div id="userlist">
                                <div class="userlist_repeat" ng-repeat="data in loaded_user_data| filter:search">
                                    <!--<a href="<?php echo base_url() ?>message/b/{{data.business_slug}}">-->
                                    <li class="clearfix" id="{{data.business_slug}}" ng-class="{'active': data.business_slug == current}" ng-click="getuserMessage()">
                                        <div class="chat_heae_img" ng-if="data.business_user_image">
                                            <img src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL ?>{{data.business_user_image}}" alt="{{data.company_name}}"/>
                                        </div>
                                        <div class="chat_heae_img" ng-if="!data.business_user_image">
                                            <img src="<?php echo base_url() . NOBUSIMAGE2 ?>" alt="No Bus Image"/>
                                        </div>
                                        <div class="about">
                                            <div class="name">{{data.company_name}}<br></div>
                                            <div>{{data.message| htmlToPlaintext}}</div>
                                        </div>
                                    </li>
                                    <!--</a>-->
                                </div>
                            </div>
                        </ul>
                    </div>
                    <!-- chat start -->
                    <div class="chat" id="chat" style="display:block;">
                        <div class="chat-header clearfix border_btm">
                            <a href="#">
                                <div class="chat_heae_img" ng-if="business_user_image">
                                    <img src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL ?>{{business_user_image}}" alt="{{company_name}}"/>
                                </div>
                                <div class="chat_heae_img" ng-if="!business_user_image">
                                    <img src="<?php echo base_url() . NOBUSIMAGE2 ?>" alt="No Bus Image"/>
                                </div>

                                <div class="chat-about">
                                    <div class="chat-with">
                                        <span>{{company_name}}</span>  
                                    </div>
                                    <div class="chat-num-messages" ng-if="industriyal">{{industriyal}}</div>
                                    <div class="chat-num-messages" ng-if="!industriyal">{{other_industrial}}</div>
                                </div>
                            </a>
                            <div class="chat_drop">
                                <a onclick="myFunction()" class="chatdropbtn fr"> 
                                    <img src="<?php base_url('assets/img/t_dot.png') ?>" onclick="myFunction()">
                                </a>
                                <div id="mychat_dropdown" class="chatdropdown-content">
                                    <a href="javascript:void(0);" onclick="delete_history()">
                                        <span class="h4-img h2-srrt"></span>  Delete All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history" id="chat-history" scroll="user_chat">
                            <div id="<?php echo $business_login_slug ?>-{{business_slug}}" class="user_message_div">
                                <ul id="received" class="padding_less_right received" ng-repeat="(key, value) in user_chat | groupBy: 'date'">
                                    <div class="message-data align-right">    
                                        <span class="message-data-time">{{key}}</span>
                                    </div>
                                    <div ng-repeat="chat in value"> 
                                        <li class="clearfix" ng-if="chat.message_from_profile_id == '<?php echo $business_login_profile_id ?>'">   
                                            <div class="msg_right"> 
                                                <div class="messagedelete fl">
                                                    <a href="javascript:void(0);">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="message other-message float-right" ng-bind-html="chat.message"><span class="msg-time">{{chat.timestamp * 1000| date : "hh:mm a"}}</span></div>
                                                <div class="msg-user-img" ng-if="chat.business_user_image"><img src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL . $business_login_user_image ?>"></div>
                                                <div class="msg-user-img" ng-if="!chat.business_user_image"><img src="<?php echo base_url() . NOBUSIMAGE2 ?>" alt="No Business Image"></div>
                                            </div>
                                        </li> 
                                        <li class="recive-data" ng-if="chat.message_from_profile_id != '<?php echo $business_login_profile_id ?>'"> 
                                            <div class="msg_left_data"> 
                                                <div class="msg-user-img" ng-if="chat.business_user_image"><img src="<?php echo BUS_PROFILE_THUMB_UPLOAD_URL ?>{{business_user_image}}" alt="{{chat.company_name}}"></div>
                                                <div class="msg-user-img" ng-if="!chat.business_user_image"><img src="<?php echo base_url() . NOBUSIMAGE2 ?>" alt="No Business Image"></div>
                                                <div class="message my-message" ng-bind-html="chat.message"><span class="msg-time">{{chat.timestamp * 1000| date : "hh:mm a"}}</span></div>
                                                <div class="messagedelete"> 
                                                    <a href="javascript:void(0);" onclick="delete_chat(2, 365)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </div>

                                </ul>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="">
                                <div class="" id="msg_block">
                                    <div class="input-group" id="set_input">
                                        <form name="blog">
                                            <div class="comment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-model="chatMsg" ng-change="isMsgBoxEmpty = false" ng-enter="sendMsg()" ng-focus="setFocus" focus-me="setFocus" name="message" id="message" onpaste="OnPaste_StripFormatting(this, event);" placeholder="Type your message here..." style="position: relative;" contenteditable="true"></div>
                                            <!--<div class="comment" ng-class="{'form-control': false, 'has-error':isMsgBoxEmpty}" ng-model="chatMsg" ng-change="isMsgBoxEmpty = false" ng-enter="sendMsg()" name="message" id="message" onpaste="OnPaste_StripFormatting(this, event);" placeholder="Type your message here..." style="position: relative;" contenteditable="true"></div>-->
                                            <div for="smily" class="smily_b">
                                                <div><a class="smil" href="#" id="notificationLink1"><i class="em em-blush"></i></a></div>
                                            </div>
                                        </form>
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-sm main_send" ng-click="sendMsg()" id="submit">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $footer; ?>
        <script>
                    var base_url = '<?php echo base_url(); ?>';
                    var slug = '<?php echo $slugid; ?>';
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/angular-filter/0.4.9/angular-filter.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script>
        <script>
                    // Defining angularjs application.
//            var messageApp = angular.module('messageApp', []);
                    var messageApp = angular.module('messageApp', ['angular.filter', 'ngSanitize']);
                    messageApp.filter('htmlToPlaintext', function () {
                        return function (text) {
                            return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
                        };
                    });
                    //messageApp.filter('unsafe', function($sce) { return $sce.trustAsHtml; });
                    // AUTO SCROLL MESSAGE DIV FIRST TIME START
                    messageApp.directive('scroll', function ($timeout) {
                        return {
                            restrict: 'A',
                            link: function (scope, element, attr) {
                                scope.$watchCollection(attr.scroll, function (newVal) {
                                    $timeout(function () {
                                        element[0].scrollTop = element[0].scrollHeight;
                                    });
                                });
                            }
                        }
                    });
                    // AUTO SCROLL MESSAGE DIV FIRST TIME END
                    messageApp.directive('ngEnter', function () {			// custom directive for sending message on enter click
                        return function (scope, element, attrs) {
                            element.bind("keydown keypress", function (event) {
                                if (event.which === 13 && !event.shiftKey) {
                                    scope.$apply(function () {
                                        scope.$eval(attrs.ngEnter);
                                    });
                                    event.preventDefault();
                                }
                            });
                        };
                    });
                    messageApp.directive('focusMe', function ($timeout) {		// custom directive for focusing on message sending input box
                        return {
                            link: function (scope, element, attrs) {
                                scope.$watch(attrs.focusMe, function (value) {
                                    if (value === true) {
                                        $timeout(function () {
                                            element[0].focus();
                                            scope[attrs.focusMe] = false;
                                        });
                                    }
                                });
                            }
                        };
                    });
                    messageApp.controller('messageController', function ($scope, $http) {
                        // Varialbles Initialization.
                        var socket = io.connect(window.location.protocol + '//' + window.location.hostname + ':3000');

                        $scope.isMsgBoxEmpty = false;
                        $scope.isFileSelected = false;
                        $scope.isMsg = false;
                        $scope.setFocus = true;
                        $scope.chatMsg = "";
                        $scope.users = [];
                        $scope.messeges = [];
                        $scope.current = '<?php echo $this->uri->segment(3); ?>';
                        load_message_user();
                        function load_message_user() {
                            $http.get(base_url + "message/getBusinessUserChatList").success(function (data) {
                                $scope.loaded_user_data = data;
                                var select_segment = window.location.pathname.split("/").pop();
                                $('li#' + select_segment).addClass('active');
                            })
                        }

                        $scope.getSearchdata = function () {
                            $http({
                                method: 'POST',
                                url: base_url + 'message/getBusinessUserChatSearchList',
                                data: 'search_key=' + $scope.search_key,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .success(function (data) {
                                        $scope.loaded_user_data = data;
                                    });
                        }
                        $scope.getuserMessage = function () {
                            var business_slug = this.data.business_slug;
                            getUserMessage(business_slug);
                            history.pushState('Business Profile Message', 'Business Profile Message', business_slug);
                            var select_segment = window.location.pathname.split("/").pop();
                            $('li').removeClass('active');
                            $('li#' + select_segment).addClass('active');
                        }

                        getUserMessage($scope.current);
                        function getUserMessage(business_slug) {
                            $http({
                                method: 'POST',
                                url: base_url + 'message/getBusinessUserChat',
                                data: 'business_slug=' + business_slug,
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                    .success(function (data) {
                                        $scope.business_user_image = data.business_user_image;
                                        $scope.company_name = data.company_name;
                                        $scope.industriyal = data.industriyal;
                                        $scope.other_industrial = data.other_industrial;
                                        $scope.business_slug = data.business_slug;
                                        $scope.user_chat = data.chat;
                                    });
                        }

                        // sending text message function
                        $scope.sendMsg = function () {
                            $scope.current = window.location.pathname.split("/").pop();
                            var message = $('#message').html();
                            message = message.replace(/^(<br\s*\/?>)+/, '');
                            if (message) {
                                $scope.isFileSelected = false;
                                $scope.isMsg = true;
                                $http({
                                    method: 'POST',
                                    url: base_url + 'message/businessMessageInsert',
                                    data: 'message=' + message + '&business_slug=' + $scope.current,
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                        .success(function (data) {
                                            if (data.result != 'fail') {
                                                // GET SOCKET USER LIST START
                                                socket.emit('getBusinessChatUserList', {
                                                    message_slug: $scope.current, message_to_slug: data.business_slug, message: data.message, timestamp: data.timestamp, message_from_profile_id: data.message_from_profile_id, company_name: data.company_name, business_user_image: data.business_user_image, date: data.date
                                                });
                                                // GET SOCKET USER LIST END    
                                            }
                                        });
                            } else {
                                $scope.isMsgBoxEmpty = true;
                            }
                        }

                        // SOCKET ON

                        socket.on('getBusinessChatUserList', function (data) {
                            var chat_length = $scope.user_chat.length;
                            if (chat_length == 0) {
                                $scope.user_chat = [];
                            }
                            load_message_user();
                            getUserMessage($scope.current);
                            $('#message').html('');
                            $scope.setFocus = true;
                        });

                    });
        </script>
    </body>
</html>

