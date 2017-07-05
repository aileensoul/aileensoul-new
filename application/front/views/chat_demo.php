<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!--- for dispaly div insted of input type start -->
<style type="text/css">
div .comment {  
  height: 40px;
  border: 1px solid #ccc;
}
</style>

<!--- for dispaly div insted of input type end -->
  <meta charset="utf-8">
  <title>Chat-Example | CodeIgniter</title>
  <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="<?php echo base_url('js/moment.js'); ?>"></script>
 
     <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
  <!-- http://bootsnipp.com/snippets/4jXW -->

  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style_chat.css" />
  
  
  <!-- <script type="text/javascript">   
    $( document ).ready ( function () {
      
      $('#nickname').keyup(function() {
        var nickname = $(this).val();
        
        if(nickname == ''){
          $('#msg_block').hide();
        }else{
          $('#msg_block').show();
        }
      });
      
      // initial nickname check
      $('#nickname').trigger('keyup');
    });
    
  </script> -->
 
</head>
<body>

 <div class="container ">
    <div class="people-list" id="people-list">
       <div class="search">
        <input type="text" name=""  id="user_search" placeholder="search" value= ""  />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">

<!-- loop start -->
<div id="userlist">
<?php 
if(count($userlist) > 0){ foreach($userlist as $user){ ?>
 <li class="clearfix">
          <?php        if ($user['user_image']) {?>
   
<img src="<?php echo base_url(USERIMAGE . $user['user_image']); ?>" alt="" height="50px" weight="50px">

 <?php  } else { ?>
 <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="50px" weight="50px">
 
<?php  } ?>
          <div class="about">
            <div class="name"> 
    <a href="<?php echo base_url() . 'chat/abc/' . $user['user_id']; ?>"><?php echo  $user['first_name'] . "<br>"; ?></a> </div>
            <div class="<?php echo 'status' . $user['user_id']; ?>">
            <?php echo  $user['message']; ?>
            </div>
          </div>
        </li>
<?php }}else{
  echo 'No user available...';
  } ?>
</div>
        <!-- loop end -->
       
      </ul>
    </div>
<!-- chat start -->

<?php     

$lstusrdata = $this->common->select_data_by_id('user', 'user_id', $lstusr, $data = '*'); 
if($lstusrdata){?>
   <div class="chat">
      <div class="chat-header clearfix">

  <?php   if ($lstusrdata[0]['user_image']) {?>
   
<img src="<?php echo base_url(USERIMAGE . $lstusrdata[0]['user_image']); ?>" alt="" height="50px" weight="50px">

<?php  } else { ?>
 <img src="<?php echo base_url(NOIMAGE); ?>" alt="" height="50px" weight="50px">
 
<?php  } ?>

         <div class="chat-about">
          <div class="chat-with">
          <?php echo $lstusrdata[0]['first_name'] . ' ' .  $lstusrdata[0]['last_name']; ?> </div>
          <!-- <div class="chat-num-messages"> Current Work</div> -->
        </div>
        </div>
        <div class="chat-history">
        <ul class="" id="received">
          
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
              <div class="input-group">

               <!--  <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." /> -->
                <form name="blog">
               
               <div class="comment" contentEditable="true" name="comments" id="message  smily" style="position: relative;">
            
              </div>
<div for="smily" style="position: absolute;    position: absolute;
    top: 7px;
    right: 61px;">


    <a href=""><i class="em em-blush"></i></a></div>
            </form>
                <span class="input-group-btn">
        <button class="btn btn-warning btn-sm" id="submit" style="padding: 10px">Send</button>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
<?php }else{ ?>
 
   <div class="chat">
      <div class="chat-header clearfix">

  

         <div class="chat-about">
          <div class="chat-with">
           </div>
          <div class="chat-num-messages"></div>
        </div>
        </div>
        <div class="chat-history">
        <ul class="" id="received">
         </ul>
      </div>
       <div class="panel-footer">
          <div class="clearfix">
            
            <div class="col-md-9" id="msg_block">
              <div class="input-group">
                <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                <span class="input-group-btn">
        <button class="btn btn-warning btn-sm" id="submit">Send</button>
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

<script type="text/javascript">
  $(".smily").click(function() {
    $(".smily").animate({"height" : "350","width":"250"}, 500);
 });
</script>


<script type="text/javascript">
var request_timestamp = 0;
 
var setCookie = function(key, value) {
  var expires = new Date();
  expires.setTime(expires.getTime() + (5 * 60 * 1000));
  document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
 
var getCookie = function(key) {
  var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
  return keyValue ? keyValue[2] : null;
}
 
var guid = function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
  }
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
}
 
if(getCookie('user_guid') == null || typeof(getCookie('user_guid')) == 'undefined'){
  var user_guid = guid();
  setCookie('user_guid', user_guid);
}
 
 
// https://gist.github.com/kmaida/6045266
var parseTimestamp = function(timestamp) {
  var d = new Date( timestamp * 1000 ), // milliseconds
    yyyy = d.getFullYear(),
    mm = ('0' + (d.getMonth() + 1)).slice(-2),  // Months are zero based. Add leading 0.
    dd = ('0' + d.getDate()).slice(-2),     // Add leading 0.
    hh = d.getHours(),
    h = hh,
    min = ('0' + d.getMinutes()).slice(-2),   // Add leading 0.
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

  $.getJSON('<?php echo base_url(); ?>api/send_message/' + lastusr + '?message=' + message + '&nickname=' + fname + ' ' + lname + '&guid=' + getCookie('user_guid'), function (data){
    callback();
  });
}
 
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
    if(curuser == userid){
  //  var timeString = moment(data.timestamp).format("HH:mm:ss");

var timestamp = data.timestamp; // replace your timestamp
var date = new Date(timestamp * 1000);
// var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear();

var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
console.log(formattedDate);
//alert(formattedDate);
  //  alert(timeString);
      var html = ' <li class="clearfix">';
      html += '   <div class="message-data align-right">';
          html += '    <span class="message-data-time" >' + formattedDate + '</span>&nbsp; &nbsp;';
             html += '    <span  class="message-data-name"  >' + fname + 
             ' ' + lname + '</span> <i class="fa fa-circle me"></i>';
        html += ' </div>';

   
      html += '<div class="message other-message float-right">' + data.message + '</div>';
         html += '</li>'; 

         $('.' + 'status' + touser).html(data.message);
    }else{

 
      var timestamp = data.timestamp; // replace your timestamp
var date = new Date(timestamp * 1000);
var formattedDate = ('0' + date.getDate()).slice(-2) + '/' + ('0' + (date.getMonth() + 1)).slice(-2) + '/' + date.getFullYear() + ' ' + ('0' + date.getHours()).slice(-2) + ':' + ('0' + date.getMinutes()).slice(-2);
console.log(formattedDate);

      var html = '<li> <div class="message-data">';
       html += '<span class="message-data-name"><i class="fa fa-circle online"></i>' + data.nickname + ' </span>';
        html += '<span class="message-data-time">' + formattedDate + ' </span>';
 html += ' </div>';
      html += '     <div class="message my-message">' + data.message + '</div>';
      html += '</li>';

      $('.' + 'status' + touser).html(data.message);
    }
    $("#received").html( $("#received").html() + html);
  });
  
  $('#received').animate({ scrollTop: $('#received').height()}, 1000);
}
 
var update_chats = function () {
  if(typeof(request_timestamp) == 'undefined' || request_timestamp == 0){
    var offset = 52560000; // 100 years min
    request_timestamp = parseInt( Date.now() / 1000 - offset );
  }


  var lastusr = '<?php echo $lstusr; ?>';


  $.getJSON('<?php echo base_url(); ?>api/get_messages/' + lastusr  + '?timestamp=' + request_timestamp, function (data){
    append_chat_data(data); 
 
    var newIndex = data.length-1;
    if(typeof(data[newIndex]) != 'undefined'){
      request_timestamp = data[newIndex].timestamp;
    }
  });      
}


$('#submit').click(function (e) {
  e.preventDefault();
  
  var $field = $('#message');
  //var data = $field.val();
  var data = $('#message').html();
alert(data);
 
  $field.addClass('disabled').attr('disabled', 'disabled');
  sendChat(data, function (){
    $field.val('').removeClass('disabled').removeAttr('disabled');
  });
});
 
$('#message').keyup(function (e) {
  if (e.which == 13) {
    $('#submit').trigger('click');
  }
});
 
setInterval(function (){
  update_chats();
}, 1500);

</script>

<!-- user search list  20-4  start  -->

<script type="text/javascript">
  
$(document).ready(function() {

  //$('#user_search').keypress(function() {
  $("#user_search").on("keyup", function (event) { 
          
        var val = $('#user_search').val();
      
      // khyati chnages  start
             
       $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "chat/user_list" ?>',
                data:'search_user='+val,
                success:function(data){ 
                     $('input').each(function(){
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
                url:'<?php// echo base_url() . "chat/user_list" ?>',
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