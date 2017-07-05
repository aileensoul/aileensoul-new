<?php echo $head; ?>
<!-- header -->

<!-- style for span id=notification_count start-->
<body class="pushmenu-push" onload="ajax();">
  <?php echo $header; ?>
    <section class="buttonset">
        <div id="nav_list"></div>
    </section>

    <!-- header end -->


    <section>
      
        </div>
        
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                    <div class="container bootstrap snippet">
    <div class="row">
      
          <div class="col-md-1 col-sm-1"></div>
                    <div class="col-md-10 col-sm-10">
                        <div class="common-form"> <h3>Message</h3>
                    
                     <div class="job-saved-box">
                         <div class="contact-frnd-post">
                                    
                                        <div class="profile-job-post-detail clearfix">    
        <div class="col-md-3 bg-white ">

            
            
            <!-- =============================================================== -->
            <!-- member list -->
            <ul class="friend-list ">
                <li><a href="#">Home</a></li>
<select class="" name="search_user" id="search_user" ></select>

              <?php 
                foreach ($user_list as $user) 
                {
                
              ?>   
               
                <li class="active">
                    <a href="<?php echo base_url('message/message_chats/'.$user['user_id']); ?>" class="clearfix">
                        <img src="<?php echo base_url(USERIMAGE . $user['user_image']);?>" alt="" class="img-circle">
                        <div class="friend-name">   
                            <strong></strong><?php echo ucwords($user['first_name']).' '.' '.' '.ucwords($user['last_name']); ?></strong>
                        </div>
                        
                    </a>
                </li>
                <?php
                  }
                ?>

               
            </ul>
        </div>
        
             
                           
         <div class="col-md-9">   
      <!-- DIRECT CHAT PRIMARY -->

      <div class="box box-primary direct-chat direct-chat-primary">
        <div class="box-header with-border">

        
          <h4><?php echo ucwords($name[0]['first_name']) .' '.ucwords($name[0]['last_name']) ;?></h4>
        <!-- /.box-header -->
        <div class="box-body">

          <!-- Conversations are loaded here -->
          <div class="direct-chat-messages">
          <?php if(isset($msg_chat) && count($msg_chat) > 0){  
            foreach($msg_chat as $msg) { 
              if($msg['message_to'] == $userid){?>
            <!-- from -->
            <div class="direct-chat-msg">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-left"><?php 
      $fname = $this->db->get_where('user',array('user_id' => $msg['message_from']))->row()->first_name; $lname = $this->db->get_where('user',array('user_id' => $msg['message_from']))->row()->last_name; echo  ucwords($fname) . " " .  ucwords($lname)  ?></span>

        <?php
          $uimage = $this->db->get_where('user',array('user_id' => $msg['message_from']))->row()->user_image;
        ?>
                <span class="direct-chat-timestamp pull-right"> <?php echo $msg['message_create_date']; ?></span>
              </div>
              <!-- /.direct-chat-info -->
              <img class="direct-chat-img" src="<?php echo base_url(USERIMAGE . $uimage);?>" alt="Message User Image"><!-- /.direct-chat-img -->
              <div class="direct-chat-text">
                <?php echo $msg['message']; ?>
              </div>
              <!-- /.direct-chat-text -->
            </div>
            <!-- from -->
            <?php }else{ ?>
    
            <!-- TO -->
            <div class="direct-chat-msg right">
              <div class="direct-chat-info clearfix">
                <span class="direct-chat-name pull-right"><?php echo ucwords($userdata[0]['first_name']) .' '. ucwords($userdata[0]['last_name']); ?></span>
                <span class="direct-chat-timestamp pull-left"><?php echo $msg['message_create_date']; ?></span>
              </div>
              <!-- /.direct-chat-info -->
              <img class="direct-chat-img" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" alt="Message User Image"><!-- /.direct-chat-img -->
              <div class="direct-chat-text">
               <?php echo $msg['message']; ?>
              </div>
              <!-- to-->
            </div>
          <?php } } }?>
          </div>
          <!--/.direct-chat-messages-->
    
         
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        <?php  $id =  $this->db->get_where('user',array('user_id' => $msg['message_from']))->row()->user_id;  //echo $id;die();?> 
        <?php
         echo form_open(base_url('message/messages_insert/'.$lastid.''), array('id' => 'message_chat','name' => 'message_chat', 'class' => 'clearfix')); 
            
         ?>
           
            <div class="input-group">
              <input type="text" name="msg_chat" id="msg_chat" placeholder="Type Message ..." class="form-control">
                  <span class="input-group-btn">
                   <input type="submit" name="chatsubmit" id="chatsubmit" value="Send" class="btn btn-flat">
                    <!-- <button type="submit" class="btn btn-flat" >Send</button> -->
                  </span>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
    </div>

                                               
                                          
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
    </section>
    <footer>

      <?php echo $footer; ?>      
     </footer>

<script>
//  $('#chatsubmit').on('click',function(){ 
// setInterval('window.location.reload()', 10000);

//   });

 

    


//  $("#chatsubmit").click(function(){
//   clearInterval(interval);
// }




      // function auto_load(){
      //   $.ajax({
      //     url: "<?php echo base_url(); ?>message/messages_insert",
      //     cache: false,
      //     success: function(data){
      //       alert(data);
      //        $(".box-body").html(data);
      //     } 
      //   });
      // }
      
 
      // $(document).ready(function(){
 
      //   auto_load(); //Call auto_load() function when DOM is Ready
 
      // });
 
      // //Refresh auto_load() function after 10000 milliseconds
      // setInterval(auto_load,10000);


    function ajax(){
    
    var req = new XMLHttpRequest();
    
    req.onreadystatechange = function(){
    
    if(req.readyState == 4 && req.status == 200){
   // alert( req.responseText);
    document.getElementById('text').innerHTML = req.responseText;
    } 
    }
    req.open('GET','<?php echo base_url(); ?>message/message_chats/4',true); 
    req.send();
    
    }
    setInterval(function(){ajax()},1000);
  </script>

</body>

</html>

<!-- script for skill textbox automatic start (option 2)-->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 -->  
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>
//select2 autocomplete start for User Search
$(document).ready(function () {

$('#search_user').select2({
        
        placeholder: 'Find User',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>message/search_user",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            //alert(data);
            return {
              //alert(data);

              results: data

            };
             
          },

           cache: true
        }
      });

 $('#search_user').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              
              window.location = "<?php echo base_url('message/message_chats/')?>" + url; // redirect
          }
          return false;
      });
});

//select2 autocomplete End for User Search

</script>

