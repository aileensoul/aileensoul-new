<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
<!--post save success pop up style end -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
    
  
    <!-- start header -->
<?php echo $header; ?>
<?php echo $freelancer_hire_header2;?>
    <!-- END HEADER -->
    <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                      


                    <div class="add-post-button">
     
                        <a href="<?php echo base_url("freelancer/freelancer_hire_post"); ?>"><div class="back">
                          <div class="but1">
                               Back To Post
                          </div>
                     </div></a>

                   </div>

                    </div>
                    <!-- <div class="col-md-6 col-sm-8"> -->


                      <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>

                    <!--- middle section start -->
                   <!-- middle div stat -->
                    <div class="col-md-7 col-sm-7 all-form-content">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3> Applied Freelancer </h3>
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <!-- body tag inner data start-->
                                        <?php
// echo "<pre>"; print_r($candidatefreelancer);die();
                                        if ($postdata) {
                                            foreach ($postdata as $row) {
                                                
                                                    // echo "<pre>"; print_r($row);die();
                                                    ?> 
             <div class="profile-job-post-detail clearfix">
                   
             <div class="profile-job-post-title-inside clearfix">
                 <div class="profile-job-profile-button clearfix">
                    <div class="profile-job-post-location-name-rec">
                  

             <div style="display: inline-block; " class="fl">
                     <div  class="buisness-profile-pic-candidate">
                                   <?php
                                if ($row['freelancer_post_user_image']) {
                              ?>
                <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $row['user_id'].'?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"> <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $row['freelancer_post_user_image']); ?>" alt="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"> </a>
                    <?php
                  } else {
                      ?>
                <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>">
               <?php
                    }
                     ?>
            </div>
           </div>

              
             <div class="designation_rec fl">
          <ul>
               <li>        
             <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $row['user_id'].'?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>"><h6>
              <?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?></h6>
            </a>
          </li>

          <li style="display: block;" ><a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $row['user_id'].'?page=freelancer_hire'); ?>" title="<?php echo ucwords($row['freelancer_post_fullname']) . ' ' . ucwords($row['freelancer_post_username']); ?>" > <?php
                 if ($row['designation']) {
                  echo $row['designation'];
                } else {
                  echo PROFILENA;
                   }
                ?> </a></li>
       </ul>
           </div>

        </div>
         </div>
          </div>  <div class="profile-job-post-title clearfix">
              <div class="profile-job-profile-menu">
               <ul class="clearfix">
                  <li><b>Skills</b><span>
                  <?php
                  $comma = ", ";
                  $k = 0;
                  $aud = $row['freelancer_post_area'];
                  $aud_res = explode(',', $aud);
                  
                  if(!$row['freelancer_post_area']){

                    echo $row['freelancer_post_otherskill'];
                  }else if(!$row['freelancer_post_otherskill']){
                  foreach ($aud_res as $skill) {
                 if ($k != 0) {
                 echo $comma;
                     }
               $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
            
               echo $cache_time;
                 $k++;
                } } else if($row['freelancer_post_area'] && $row['freelancer_post_otherskill']){

                  foreach ($aud_res as $skill) {
                 if ($k != 0) {
                 echo $comma;
                     }
               $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
            
               echo $cache_time;
                 $k++;
                } echo "," . $row['freelancer_post_otherskill'];

                }

               ?>   
               </span>    
           </li>
             <!-- <li><b>Other Skill</b><span>
                <?php
                  if ($row['freelancer_post_otherskill']) {
                    echo $row['freelancer_post_otherskill'];
                 } else {
                      echo PROFILENA;
                    }
               ?></span>
              </li> -->
           <?php $cityname = $this->db->get_where('cities', array('city_id' => $row['freelancer_post_city']))->row()->city_name; ?>
           <li><b>Location</b><span> <?php
                if ($cityname) {
                   echo $cityname;
                } else {
               echo PROFILENA;
                }
               ?></span></li>
            <li><b>Skill Description</b> <span> <p>
            <?php
          if ($row['freelancer_post_skill_description']) {
             echo $row['freelancer_post_skill_description'];
        } else {
                echo PROFILENA;
             }
            ?></p></span>
         </li>
             <!--  <li><b>Designation</b>
               <span><?php
                 if ($row['designation']) {
                  echo $row['designation'];
                } else {
                  echo PROFILENA;
                   }
                ?></span>
              </li> --> 
   
             <li><b>Avaiability</b><span>
              <?php
                if ($row['freelancer_post_work_hour']) {
                   echo $row['freelancer_post_work_hour'] . "  " . "Hours per week ";
                } else {
                    echo PROFILENA;
                 }
                  ?></span>
               </li>
             <li><b>Rate Hourly</b> <span>
                <?php
             if ($row['freelancer_post_hourly']) {
             $currency = $this->db->get_where('currency', array('currency_id' => $row['freelancer_post_ratestate']))->row()->currency_name;
             if ($row['freelancer_post_fixed_rate'] == '1') {
                 $rate_type = 'Fixed';
               } else {
           $rate_type = 'Hourly';
                 }
        echo $row['freelancer_post_hourly'] . "   " . $currency . "  " . $rate_type;
              ;
              } else {
               echo PROFILENA;
                 }
           ?></span>
               </li>
                  <li><b>Total Experience</b>
                     <span> <?php
                       if ($row['freelancer_post_exp_year'] || $row['freelancer_post_exp_month']) {
                  echo $row['freelancer_post_exp_year'] . ' ' . $row['freelancer_post_exp_month'];
                  } else {
                       echo PROFILENA;
                     }
                 ?></span>
              </li>
         </ul>
    </div>

             <div class="profile-job-profile-button clearfix">
                   <div class="apply-btn fr">
            <?php
            $userid = $this->session->userdata('aileenuser');
            $contition_array = array('from_id' => $userid, 'to_id' => $row['user_id'], 'save_type' => 2, 'status' => '0');
            $savedata = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            
            // khayti changes start 6-4
            ?>
              <!--<a href="<?php echo base_url('chat/abc/' . $row['user_id'].'/3/4'); ?>">Saved</a>-->
           
          <?php if($userid != $row['user_id']){ ?>
       <a class="msg_btn" href="<?php echo base_url('chat/abc/' . $row['user_id'].'3/4'); ?>">Message</a>

 <?php  $contition_array = array('invite_user_id' => $row['user_id'], 'post_id' => $postid, 'profile' => 'freelancer');
        $userdata = $this->common->select_data_by_condition('user_invite', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
        if($userdata){ ?>
          <a href="javascript:void(0);" class="button invited" id="<?php echo 'invited' . $row['user_id']; ?>" style="cursor: default;"> Selected</a>       
         <?php }else{ ?>
         <a class=""  href="#" class="button invite_border" id="<?php echo 'invited' . $row['user_id']; ?>" onClick="inviteuserpopup(<?php echo $row['user_id']; ?>)"> Select</a>
              <!-- <a href="javascript:void(0);" class="button invite_border" id="<?php echo 'invited' . $row['user_id']; ?>" onclick="inviteuserpopup(<?php echo $row['user_id']; ?>)"> Invite</a> -->
          <?php  } ?>


        <?php
            if ($savedata) {
                ?> 
                <a class="saved">Saved </a>
        
                <?php
            } else {
                ?>

     <input type="hidden" id="<?php echo 'hideenuser' . $row['user_id']; ?>" value= "<?php echo $data[0]['save_id']; ?>">
               
              <a id="<?php echo $row['user_id']; ?>" onClick="savepopup(<?php echo $row['user_id']; ?>)" href="javascript:void(0);" class="<?php echo 'saveduser' . $row['user_id']; ?>">Save</a>
          <!-- pallavi changes end 15-4 -->
         <!--  <a id="<?php echo $row['user_id']; ?>" onClick="save_user(this.id)" href="#popup1" class="<?php echo 'saveduser' . $row['user_id']; ?>">Save User</a> -->
                          <?php
                                          
            }
          
         
         }?>
                 </div>
              </div>
            </div>
          </div>
                                                    <?php
                                                
                                            }
                                        } else {
                                            ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing" >No Recommended Freelancer Found.</h4>
                                            </div>
    <?php
}
?>
                                        <!-- body tag inner data end -->
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- middle div end -->
                      <!--- middle section end -->
                       
                     
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- Model Popup Open -->
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
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>


    <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

   
    


    <script>

var data= <?php echo json_encode($demo); ?>;
//alert(data);

        
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

var data1= <?php echo json_encode($city_data); ?>;
//alert(data1);

        
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
<script type="text/javascript">
function checkvalue(){
   //alert("hi");
  var searchkeyword=document.getElementById('tags').value;
  var searchplace=document.getElementById('searchplace').value;
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
  //   alert('Please enter Keyword');
    return false;
  }
}
</script>
    
    <script type="text/javascript">
    
   function inviteuser(clicked_id)
    {  

      var post_id = "<?php echo $postid; ?>";
//alert(post_id);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "freelancer/free_invite_user" ?>',
            data: 'post_id=' + post_id + '&invited_user=' + clicked_id,
            success: function (data) { //alert(data);
                $('#' + 'invited' + clicked_id).html(data).addClass('invited').removeClass('invite_border').removeAttr("onclick");
                 $('#' + 'invited' + clicked_id).css('cursor', 'default');

            }
        });
    }

   
</script>
<!-- <script>


//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
       
        ajax:{

         
          url: "<?php echo base_url(); ?>freelancer/location",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
              //alert(data);

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location

</script>
 -->

<script type="text/javascript">
                  function save_user(abc)
                        {
                          
           var saveid = document.getElementById("hideenuser" + abc);
           //alert(saveid);
                $.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "freelancer/save_user1" ?>',
        data: 'user_id=' + abc + '&save_id=' + saveid.value,
        success: function (data) {
    $('.' + 'saveduser' + abc).html(data).addClass('saved');
                                }
                            });
                        }
                    </script>

<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

<script>
function savepopup(id) {
                          //alert(123);
    save_user(id);
                            //alert(456);
                      
  $('.biderror .mes').html("<div class='pop_content'>Freelancer successfully saved.");
  $('#bidmodal').modal('show');
 }
 </script>

<script >
function inviteuserpopup(abc){

    $('.biderror .mes').html("<div class='pop_content'>Do you want to select this freelancer for your project?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='inviteuser(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');

   } 

  </script>
    <!-- end footer -->
 

