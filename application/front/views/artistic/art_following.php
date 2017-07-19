<!-- start head -->
<?php  echo $head; ?>


<style type="text/css">
    #popup-form img{display: none;}
</style>


<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

<!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>

<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);
        
       $('html,body').animate({scrollTop:265}, 100);
   
   });
   //For Scroll page at perticular position js End
</script>
 <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

<?php echo $art_header2_border; ?>


<body   class="page-container-bg-solid page-boxed">

    <section class="custom-row">
        <div class="container" id="paddingtop_fixed">
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
        <div id="upload-demo"> </div>
        </div>
        <div class="col-md-12 cover-pic">
            <button class="btn btn-success cancel-result" onclick="" >Cancel</button>
    
        <button class="btn btn-success set-btn upload-result" onclick="myFunction()">Save</button>

        <div id="message1" style="display:none;">
      <div class="loader">
        <div id="floatBarsG">
  <div id="floatBarsG_1" class="floatBarsG"></div>
  <div id="floatBarsG_2" class="floatBarsG"></div>
  <div id="floatBarsG_3" class="floatBarsG"></div>
  <div id="floatBarsG_4" class="floatBarsG"></div>
  <div id="floatBarsG_5" class="floatBarsG"></div>
  <div id="floatBarsG_6" class="floatBarsG"></div>
  <div id="floatBarsG_7" class="floatBarsG"></div>
  <div id="floatBarsG_8" class="floatBarsG"></div>
</div>

      </div>
        </div>
        </div>
        <div class="col-md-12"  style="visibility: hidden; ">
        <div id="upload-demo-i"></div>
        </div>
      </div>

   
<div class="">
  <div class="" id="row2">
        <?php
        $userid  = $this->session->userdata('aileenuser');
      if ($this->uri->segment(3) == $userid) {
                        $user_id = $userid;
                    } elseif ($this->uri->segment(3) == "") {
                        $user_id = $userid;
                    } else {
                        $user_id = $this->uri->segment(3);
                    }
            $contition_array = array( 'user_id' => $user_id, 'is_delete' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           
            $image_ori=$image[0]['profile_background'];
            if($image_ori)
           {
            ?>
            
            <img src="<?php echo base_url($this->config->item('art_bg_main_upload_path') . $artisticdata[0]['profile_background']);?>" name="image_src" id="image_src" />
              <?php
           }
           else
           { ?>
         
            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" />
      <?php     }
        ?>
    </div>
    </div>
</div>
  
    <div class="container tablate-container art-profile">
    <?php
    $userid = $this->session->userdata('aileenuser');
    if($artisticdata[0]['user_id'] == $userid){ 
    ?>      
      <div class="upload-img">
      
        
        <label class="cameraButton"> <span class="tooltiptext">Upload Cover Photo</span> <i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>
         
            </div>

             <?php }?>

                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic padd_img">
                        <?php if($artisticdata[0]['art_user_image'] != ''){ ?>
                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>

                            <?php
    $userid = $this->session->userdata('aileenuser');
    if($artisticdata[0]['user_id'] == $userid){ 
    ?>


                            
<a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>
                             <?php }?> 
                        </div>
                    </div>
                    <div class="job-menu-profile mob-block">
            <a href="<?php echo site_url('artistic/art_manage_post/' . $artisticdata[0]['user_id']); ?>">
                <h5><?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?></h5></a>

            <!-- text head start -->
            <div class="profile-text" >

                <?php
                if ($artisticdata[0]['designation'] == '') {
                    ?>

                    <?php if ($artisticdata[0]['user_id'] == $userid) { ?>
                        <a id="designation" class="designation" title="Designation">Current Work    </a>

                    <?php } ?>

                <?php } else { ?> 

                    <?php if ($artisticdata[0]['user_id'] == $userid) { ?>

                        <a id="designation" class="designation" title="<?php echo ucwords($artisticdata[0]['designation']); ?>">
                            <?php echo ucwords($artisticdata[0]['designation']); ?>

                        </a>

                                        <!-- <a id="myBtn"><?php echo ucwords($artisticdata[0]['designation']); ?></a> -->
                    <?php } else { ?>
                        <a>Current Work </a>
                    <?php } ?>

                <?php } ?>


            </div>

        </div>
                    <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les ">


<div class="right-side-menu art-side-menu ml0">
                                    <?php 
               $userid = $this->session->userdata('aileenuser');
               if($artisticdata[0]['user_id'] == $userid){
               
               ?>     
               <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  
 
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post'){?> class="active" <?php } ?>><a title="Dashboard" href="<?php echo base_url('artistic/art_manage_post/'.$artisticdata[0]['user_id']); ?>"> Dashboard</a>
                                    </li>


                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile'){?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('artistic/artistic_profile/'.$artisticdata[0]['user_id']); ?>"> Details</a>
                                     </li>

                                     <?php
                          $userid = $this->session->userdata('aileenuser');
                          if($artisticdata[0]['user_id'] == $userid)
                          { 
                          ?>

                                  
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a title="Userlist" href="<?php echo base_url('artistic/userlist'); ?>">Userlist</a>
                                    </li>

                                    <?php }?>

                                   <?php
                      $userid = $this->session->userdata('aileenuser'); 
                       if($artisticdata[0]['user_id'] == $userid)
                       { 
                        ?>
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a title="Followers"  href="<?php echo base_url('artistic/followers/'.$artisticdata[0]['user_id']); ?>">Followers <br> (<?php echo (count($followerdata)); ?>)</a>
                                    </li>
                            <?php }else{

        $artregid = $artisticdata[0]['art_id'];
        $contition_array = array('follow_to' => $artregid, 'follow_status' =>'1',  'follow_type' =>'1');
        $followerotherdata = $this->data['followerotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                              ?> 
                              <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a title="Followers"  href="<?php echo base_url('artistic/followers/'.$artisticdata[0]['user_id']); ?>">Followers  <br>(<?php echo (count($followerotherdata)); ?>)</a>
                                    </li>

                            <?php }?> 

                                    
                                   <?php
                            if($artisticdata[0]['user_id'] == $userid){ 
                            ?>      
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a  title="Following" href="<?php echo base_url('artistic/following/'.$artisticdata[0]['user_id']); ?>">Following <br> <div class= "frusercount">(<?php echo (count($followingdata)); ?>)</div></a>
                                    </li>
                                    <?php }else{

$artregid = $artisticdata[0]['art_id'];
$contition_array = array('follow_from' => $artregid, 'follow_status' =>'1',  'follow_type' =>'1');
$followingotherdata = $this->data['followingotherdata'] =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                      ?>
                                  <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a  title="Following" href="<?php echo base_url('artistic/following/'.$artisticdata[0]['user_id']); ?>">Following  <br><div class= "frusercount">(<?php echo (count($followingotherdata)); ?>)</div></a>
                                    </li> 
                                  <?php }?>  

                                   
                                    
                                </ul>


<?php 
                    $userid  = $this->session->userdata('aileenuser'); 
                    if($artisticdata[0]['user_id'] != $userid){
                      ?>
   
<div class="flw_msg_btn fr">
<ul>

<li class="<?php echo "fruser" . $artisticdata[0]['art_id']; ?>">

<?php

     $userid = $this->session->userdata('aileenuser');

      $contition_array = array('user_id' => $userid, 'status' => '1');

    $bup_id = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     $status  =  $this->db->get_where('follow',array('follow_type' => 1, 'follow_from' => $bup_id[0]['art_id'], 'follow_to'=>$artisticdata[0]['art_id'] ))->row()->follow_status; 
    //echo "<pre>"; print_r($status); die();

if($status == 0 || $status == " "){?>

 <div id= "followdiv">
<button id="<?php echo "follow" . $artisticdata[0]['art_id']; ?>" onClick="followuser(<?php echo $artisticdata[0]['art_id']; ?>)">Follow</button>
</div>
 <?php }elseif($status == 1){ ?>
<div id= "unfollowdiv">
<button class="bg_following" id="<?php echo "unfollow" . $artisticdata[0]['art_id']; ?>" onClick="unfollowuser(<?php echo $artisticdata[0]['art_id']; ?>)"> Following</button>
</div>


<?php } ?>
</li>

<li>
  <a href="<?php echo base_url('chat/abc/'.$artisticdata[0]['user_id'].'/6/6'); ?>">Message</a></li>

</ul>
</div>

<?php
}
?>


  </div>  
    <!-- menubar -->                
  </div>   
    </div>
    </div>
<div class="user-midd-section art-inner">
    <div class="container">
     <div class="job-menu-profile mob-none">
                          <a href="<?php echo site_url('artistic/art_manage_post/'.$artisticdata[0]['user_id']); ?>"> <h5 > <?php echo ucwords($artisticdata[0]['art_name']) .' '.  ucwords($artisticdata[0]['art_lastname']); ?>
                          </h5></a>
                             <!-- text head start -->
                    <div class="profile-text" >
                   
                               <?php
        $userid = $this->session->userdata('aileenuser');

            if($artisticdata[0]['user_id'] == $userid){


              if ($artisticdata[0]['designation'] == '') {
                    ?>
                        <a id="designation" class="designation" title="Designation">Current Work</a>

                    

                <?php } else { ?> 

                        <a id="designation" class="designation" title="<?php echo ucwords($artisticdata[0]['designation']); ?>">
                            <?php echo ucwords($artisticdata[0]['designation']); ?>

                        </a>

                    <?php } 

            }else{ ?>

           <?php  if ($artisticdata[0]['designation'] == '') {
                    ?>
                        <a>Current Work</a>

                    

                <?php } else { ?> 

                        <a title="<?php echo ucwords($artisticdata[0]['designation']); ?>">
                            <?php echo ucwords($artisticdata[0]['designation']); ?>

                        </a>

                    <?php }  ?>
                

                <?php }?>                  
            </div>
            

            <!-- text head end -->
                      </div>
                      <div class="col-md-7 col-sm-12 follow_mid">

                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div> 

                        <div class="common-form">
                            <div class="job-saved-box">

                                <h3>Following</h3>
                                 <div class="contact-frnd-post">
                              
                              <?php if(count($userlist ) > 0){?>
                        <?php foreach ($userlist as $user) { ?>

                            <?php
                                $art_name =  $this->db->get_where('art_reg',array('art_id' => $user['follow_to']))->row()->art_name;
                                $art_id =  $this->db->get_where('art_reg',array('art_id' => $user['follow_to']))->row()->user_id;

                                 $art_lastname =  $this->db->get_where('art_reg',array('art_id' => $user['follow_to']))->row()->art_lastname;
                             ?>  
                                  <div class="job-contact-frnd" id="<?php echo "removefollow" . $user['follow_to']; ?>">

                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title-inside clearfix">
                                                <div class="profile-job-post-location-name">
                                                    <div class="user_lst"><ul>

                            <li class="fl padding_les_left rsp">
                            <div class="follow-img">
                                 <?php if($this->db->get_where('art_reg',array('art_id' => $user['follow_to']))->row()->art_user_image != ''){ ?>
                                 <a href="<?php echo base_url('artistic/art_manage_post/'.$art_id); ?>">
                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $this->db->get_where('art_reg',array('art_id' => $user['follow_to']))->row()->art_user_image);?>" height="50px" width="50px" alt="" > </a>
                            <?php } else { ?>
                              <a href="<?php echo base_url('artistic/art_manage_post/'.$art_id); ?>">
                            <img alt=""  src="<?php echo base_url(NOIMAGE); ?>" alt="" />  </a>

                            <?php } ?> 
                            </div>
                            </li>
                            <li class="folle_text">
                             <div class="">
                         <div class="follow-li-text ">
                                <a title="<?php echo ucwords($art_name); echo "&nbsp;"; echo ucwords($art_lastname); ?>" href="<?php echo base_url('artistic/art_manage_post/'.$art_id); ?>"><?php echo ucwords($art_name); echo "&nbsp;"; echo ucwords($art_lastname); ?></a></div>
                                  
                                                        <?php  if ($user['designation']) { ?>
                                                           <div>
                                                            <a><?php echo ucwords($user['designation']); ?></a>
                                                        </div>
                                                       <?php  
                                                        }
                                                        else
                                                        {
                                                          ?>
                                                          <div>
                                                            <a><?php echo "Current Work"; ?></a>
                                                        </div>

                                                      <?php  }
                                                        ?>
                                                       
                            </li>
                              <?php

                             $userid = $this->session->userdata('aileenuser'); 


                            if($artisticdata[0]['user_id'] == $userid){ 
                             ?>
                             <li class="fr rsap <?php echo "fruser" . $userid['follow_to']; ?>">

                              <?php

              $contition_array = array('follow_from' =>$artisticdata[0]['art_id'], 'follow_status' => 1,'follow_type' => 1, 'follow_to' => $user['follow_to']);
            
             $status =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');
                 

    
        if($status[0]['follow_status'] == 1){ ?>

                            <div class="user_btn " id= "unfollowdiv">
                            <button class="bg_following" id="<?php echo "unfollow" . $user['follow_to']; ?>" onClick="unfollowuser_list(<?php echo $user['follow_to']; ?>)"><span>Following</span></button>
                           </div>
<?php } ?>
                             </li>

                             <?php }else{ ?>

                             <li class="fr" id ="<?php echo "frfollow" . $user['follow_to']; ?>">

                              <?php

            
                 
             $contition_array = array('user_id' => $userid, 'status' =>'1');
             $artisticdatauser =  $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

              $contition_array = array('follow_from' =>$artisticdatauser[0]['art_id'], 'follow_status' => 1,'follow_type' => 1, 'follow_to' => $user['follow_to']);


             $status_list =  $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str, $groupby = '');

       
        if(($status_list[0]['follow_status'] == 0 || $status_list[0]['follow_status'] == ' '  ) && $user['follow_to'] != $artisticdatauser[0]['art_id']){ ?>

                            
                            <div class="user_btn follow_btn_<?php echo $user['follow_to']; ?>" id= "followdiv">
                        <button id="<?php echo "follow" . $user['follow_to']; ?>" onClick="followuser_two(<?php echo $user['follow_to']; ?>)">Follow</button>
                           </div> 

       <?php }else if($user['follow_to'] == $artisticdatauser[0]['art_id']){ ?>

    <?php }else{ ?>

                     <div class="user_btn follow_btn_<?php echo $user['follow_to']; ?>" id= "unfollowdiv">
                            <button class="bg_following" id="<?php echo "unfollow" . $user['follow_to']; ?>" onClick="unfollowuser_two(<?php echo $user['follow_to']; ?>)"><span>Following</span></button>
                           </div>   

     <?php }?>
                             </li>

                             <?php } ?> 

                            </ul>
                            </div>
                            </div>
                            </div>
                            
                         </div>
                                                       
                                  </div>
                                   <?php } ?>
                                   <?php }else{?>

                            <div class="text-center rio">
                            <h4 class="page-heading  product-listing" style="border:0px;margin-bottom: 11px;">No Following Found.</h4>
                        </div>

                                   <?php }?>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                    
            </div>

        </div>
        </div>
        </div>
        </div>
        
    </section>
    <footer>
 <?php echo $footer;  ?>
  </footer>      
  


  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
 
</body>

 <!-- Bid-modal  -->
            <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
                <div class="modal-dialog modal-lm">
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
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
<?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="7">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image" />
     </div>                   <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
<?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->

</html>




 <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>


 <!-- <script type="text/javascript" src="<?php echo base_url('js/3.3.0/select2.js'); ?>"></script> -->

 

<!-- script for skill textbox automatic start (option 2)-->
 
  
<!-- script for skill textbox automatic end (option 2)-->

<!-- designation script start -->
<script type="text/javascript">
                            function divClicked() {
                                var divHtml = $(this).html();
                                var editableText = $("<textarea />");
                                editableText.val(divHtml);
                                $(this).replaceWith(editableText);
                                editableText.focus();
                                // setup the blur event for this new textarea
                                editableText.blur(editableTextBlurred);
                            }

                            function editableTextBlurred() {
                                var html = $(this).val();
                                var viewableText = $("<a>");
                               if (html.match(/^\s*$/) || html == '') { 
                                html = "Current Work";
                                } 
                                viewableText.html(html);
                                $(this).replaceWith(viewableText);
                                // setup the click event for this new div
                                viewableText.click(divClicked);

                                $.ajax({
                                    url: "<?php echo base_url(); ?>artistic/art_designation",
                                    type: "POST",
                                    data: {"designation": html},
                                    success: function (response) {

                                    }
                                });
                            }

                            $(document).ready(function () {
                            // alert("hi");
                                $("a.designation").click(divClicked);
                            });
                        </script>

<!-- designation script end -->
 
<!-- script for skill textbox automatic end (option 2)-->
<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1= <?php echo json_encode($de); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
  
</script>

<!-- <script>
//select2 autocomplete start for skill
$('#searchskills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/keyskill",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
             
              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/location",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
              
              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location

</script>
<!-- popup form edit start -->
 
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
 


<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#userimage").validate({

                    rules: {

                        profilepic: {

                            required: true,
                         
                        },
  

                    },

                    messages: {

                        profilepic: {

                            required: "Photo Required",
                            
                        },

                },

                });
                   });
  </script>

<!-- popup form edit END -->

 <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#artdesignation").validate({

                    rules: {

                        designation: {

                            required: true,
                         
                        },

                        
                        
                    },

                    messages: {

                        designation: {

                            required: "Designation Is Required.",
                            
                        },

                        
                },

                });
                   });
  </script>
<!-- cover image start -->
<script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   document.getElementById('message1').style.display = "block";

  // setTimeout(function () { location.reload(1); }, 5000);
   
   }
  

   function showDiv() {
   document.getElementById('row1').style.display = "block";
   document.getElementById('row2').style.display = "none";
}
</script>

<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1250,
        height: 350,
        type: 'square'
    },
    boundary: {
        width: 1250,
        height: 350
    }
});


$('.upload-result').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {

    $.ajax({
     url: "<?php echo base_url() ?>artistic/ajaxpro",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
        html = '<img src="' + resp + '" />';
        if(html)
{
  window.location.reload();
}
      }
    });

  });
});

$('.cancel-result').on('click', function (ev) {

        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";

    });

//aarati code start
$('#upload').on('change', function () { 
 
  var reader = new FileReader();
 
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);

    

});

$('#upload').on('change', function () { 
  
  var fd = new FormData();
 fd.append( "image", $("#upload")[0].files[0]);

 files = this.files;
 size = files[0].size;

// pallavi code start for file type support
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    picpopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";

    $("#upload").val('');
    return false;
  }
  // file type code end

 if (size > 10485760)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 10 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            // window.location.href = "https://www.aileensoul.com/dashboard"
            //reset file upload control
            return false;
        }
    $.ajax({

        url: "<?php echo base_url(); ?>artistic/image",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success:function(response){
        
        }
      });
  });

//aarati code end 
</script>
<!-- cover image end -->

<script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword =$.trim(document.getElementById('tags').value);
                            var searchplace =$.trim(document.getElementById('searchplace').value);
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>
<!-- follow user script start -->

<script type="text/javascript">
function followuser(clicked_id)
{ //alert(clicked_id);
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/follow_two" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 

               $('.' + 'fruser' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--follow like script end -->

<!-- Unfollow user script start -->

<script type="text/javascript">
function unfollowuser(clicked_id)
{
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/unfollow_two" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 

               $('.' + 'fruser' + clicked_id).html(data);
                    
                }
            }); 
}
</script>


<!-- follow user script start -->

<script type="text/javascript">
function followuser_two(clicked_id)
{ 
  // alert(clicked_id);
  // return false;
  
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/followtwo" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
                  //alert(data);
                  // return false;
               //$('.' + 'fruser_list' + clicked_id).html(data);
               $('#' + 'frfollow' + clicked_id).html(data);  
                    
                }
            }); 
}
</script>

<!--follow like script end -->


<!-- Unfollow user script start -->

<script type="text/javascript">
    function unfollowuser_two(clicked_id)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "artistic/unfollowtwo" ?>',
            data: 'follow_to=' + clicked_id,
            success: function (data) { 

                $('#' + 'frfollow' + clicked_id).html(data);  
              // $('#unfollowdiv').html('');
            }
        });
    }
</script>

<!--follow like script end -->


<!-- Unfollow own userlist user script start -->

<script type="text/javascript">
function unfollowuser_list(clicked_id)
{ 
  
   

   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/unfollow_following" ?>',
                dataType: 'json',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
               $('.' + 'frusercount').html(data.unfollow);
               if(data.notcount == 0){
                 $('.' + 'contact-frnd-post').html(data.notfound);
               }else{ 
              $('#' + 'removefollow' + clicked_id).fadeOut(4000);
                 }   
                }
            }); 
}
</script>

<!--follow like script end -->



<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>

<!--follow like script end -->


<!-- script for profile pic strat -->
<script type="text/javascript">
    

     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'block';
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profilepic").change(function(){
         profile = this.files;
                   //alert(profile);
                      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
                       //alert('not an image');
                  $('#profilepic').val('');
                   picpopup();
                     return false;
                   }else{
                      readURL(this);}
    });
</script>

<!-- script for profile pic end -->



   <script>
     function picpopup() {

            $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
            $('#bidmodal').modal('show');
                        }
      </script>


      <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->