<!--start head -->
<?php echo $head; ?>
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
<link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
<script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
<!--  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   -->
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
<!-- END HEADER -->
<!--<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
   <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>-->
<?php echo $art_header2_border; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <script>
         $(document).ready(function ()
         {
         
             /* Uploading Profile BackGround Image */
             $('body').on('change', '#bgphotoimg', function ()
             {
         
                 $("#bgimageform").ajaxForm({target: '#timelineBackground',
                     beforeSubmit: function () {},
                     success: function () {
         
                         $("#timelineShade").hide();
                         $("#bgimageform").hide();
                     },
                     error: function () {
         
                     }}).submit();
             });
         
         
             /* Banner position drag */
             $("body").on('mouseover', '.headerimage', function ()
             {
                 var y1 = $('#timelineBackground').height();
                 var y2 = $('.headerimage').height();
                 $(this).draggable({
                     scroll: false,
                     axis: "y",
                     drag: function (event, ui) {
                         if (ui.position.top >= 0)
                         {
                             ui.position.top = 0;
                         } else if (ui.position.top <= y1 - y2)
                         {
                             ui.position.top = y1 - y2;
                         }
                     },
                     stop: function (event, ui)
                     {
                     }
                 });
             });
         
             /* Bannert Position Save*/
             $("body").on('click', '.bgSave', function ()
             {
                 var id = $(this).attr("id");
                 var p = $("#timelineBGload").attr("style");
                 var Y = p.split("top:");
                 var Z = Y[1].split(";");
                 var dataString = 'position=' + Z[0];
                 $.ajax({
                     type: "POST",
                     url: "<?php echo base_url('artistic/image_saveBG_ajax'); ?>",
                     data: dataString,
                     cache: false,
                     beforeSend: function () { },
                     success: function (html)
                     {
                         if (html)
                         {
                             window.location.reload();
                             $(".bgImage").fadeOut('slow');
                             $(".bgSave").fadeOut('slow');
                             $("#timelineShade").fadeIn("slow");
                             $("#timelineBGload").removeClass("headerimage");
                             $("#timelineBGload").css({'margin-top': html});
                             return false;
                         }
                     }
                 });
                 return false;
             });
         
         
         
         });
         
         
         
      </script>
   </head>
   <body>
      <div class="user-midd-section" id="paddingtop_fixed">
      <div class="container">
      <div class="row">
      <div class="profile-art-box profile-box-custom col-md-4 ">
         <?php ?>
         <div class="full-box-module">
            <div class="profile-boxProfileCard  module">
               <div class="profile-boxProfileCard-cover">
                  <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo site_url('artistic/art_manage_post'); ?>" tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>">
                     <?php if ($artisticdata[0]['profile_background']) { ?>
                     <div class="data_img"><img src="<?php echo base_url($this->config->item('art_bg_thumb_upload_path') . $artisticdata[0]['profile_background']); ?>" alt ="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>" class="bgImage"  >
                     </div>
                     <?php } else { ?>
                     <div class="data_img">
                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>"  >
                     </div>
                     <?php } ?>
                  </a>
               </div>
               <div class="profile-boxProfileCard-content clearfix">
                  <div class="left_side_box_img buisness-profile-txext">
                     <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo site_url('artistic/art_manage_post'); ?>" title="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                        <!-- box image start -->
                        <?php if ($artisticdata[0]['art_user_image']) { ?>
                        <div class="data_img_2">   
                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>" class="bgImage"  alt="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>" >
                        </div>
                        <?php } else { ?> 
                        <div class="data_img_2">
                           <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?>">
                        </div>
                        <?php } ?>
                        <!-- box image end -->
                     </a>
                  </div>
                  <div class="right_left_box_design ">
                     <span class="profile-company-name ">
                     <a   href="<?php echo site_url('artistic/art_manage_post'); ?>"> <?php echo ucwords($artisticdata[0]['art_name']) . ' ' . ucwords($artisticdata[0]['art_lastname']); ?></a>
                     </span>
                     <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                     <div class="profile-boxProfile-name">
                        <a  href="<?php echo site_url('artistic/art_manage_post'); ?>">
                        <?php
                           if ($artisticdata[0]['designation']) {
                               echo ucwords($artisticdata[0]['designation']);
                           } else {
                               echo "Current Work";
                           }
                           ?>
                        </a>
                     </div>
                     <ul class=" left_box_menubar">
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Dashboard" href="<?php echo base_url('artistic/art_manage_post'); ?>"> Dashboard</a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers'); ?>">Followers <br>(<?php echo (count($followerdata)); ?>)</a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a class="padding_less_right"  title="Following" href="<?php echo base_url('artistic/following'); ?>">Following<br>(<?php echo (count($followingdata)); ?>)</a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <div class="full-box-module_follow">
            <!-- follower list start  -->  
            <div class="common-form">
               <h3 class="user_list_head">User List</h3>
               <div class="seeall">
                  <a href="<?php echo base_url('artistic/userlist'); ?>">All User</a>
               </div>
               <div class="profile-boxProfileCard_follow  module">
                  <ul>
                     <li class="follow_box_ul_li">
                        <div class="contact-frnd-post follow_left_main_box">
                           <?php
                              if ($userlistview1 > 0) {
                                  foreach ($userlistview1 as $userlist) {
                              
                                      $userid = $this->session->userdata('aileenuser');
                              
                                      $followfrom = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_id;
                              
                              
                                      $contition_array = array('follow_to' => $userlist['art_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '1');
                                      $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                              
                              
                              
                                      if (!$artfollow) {
                                          ?>                             
                           <div class="profile-job-post-title-inside clearfix">
                              <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['art_id']; ?>">
                                 <div class="post-design-pro-img_follow">
                                    <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>" title="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php if ($userlist['art_user_image']) { ?>
                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userlist['art_user_image']); ?>"  alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>" > 
                                    <?php } else { ?>
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } ?>
                                    </a>
                                 </div>
                                 <div class="post-design-name_follow fl">
                                    <ul>
                                       <li>
                                          <div class="post-design-product_follow">
                                             <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>">
                                                <h6>
                                                   <?php
                                                      echo ucwords($userlist['art_name']);
                                                      echo"&nbsp;";
                                                      echo ucwords($userlist['art_lastname']);
                                                      ?>
                                                </h6>
                                             </a>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="post-design-product_follow_main" style="display:block;">
                                             <a>
                                                <p>
                                                   <?php
                                                      if ($userlist['designation']) {
                                                          echo $userlist['designation'];
                                                      } else {
                                                          echo "Current Work";
                                                      }
                                                      ?>
                                                </p>
                                             </a>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="follow_left_box_main_btn">
                                    <div class="<?php echo "fr" . $userlist['art_id']; ?>">
                                       <button id="<?php echo "followdiv" . $userlist['art_id']; ?>" onClick="followuser(<?php echo $userlist['art_id']; ?>)">Follow</button>
                                    </div>
                                 </div>
                                 <span class="Follow_close" onClick="followclose(<?php echo $userlist['art_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>
                              </div>
                           </div>
                           <?php
                              }
                              }
                              }
                              ?>
                           <!-- second condition start -->
                           <?php
                              if ($userlistview2 > 0) {
                                  foreach ($userlistview2 as $userlist) {
                              
                                      $userid = $this->session->userdata('aileenuser');
                              
                                      $followfrom = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_id;
                              
                              
                                      $contition_array = array('follow_to' => $userlist['art_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '1');
                                      $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                              
                              
                              
                                      if (!$artfollow) {
                                          ?>                             
                           <div class="profile-job-post-title-inside clearfix">
                              <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['art_id']; ?>">
                                 <div class="post-design-pro-img_follow">
                                    <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>" title="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php if ($userlist['art_user_image']) { ?>
                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userlist['art_user_image']); ?>"  alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } else { ?> 
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } ?>
                                    </a>
                                 </div>
                                 <div class="post-design-name_follow fl">
                                    <ul>
                                       <li>
                                          <div class="post-design-product_follow">
                                             <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>">
                                                <h6>
                                                   <?php
                                                      echo ucwords($userlist['art_name']);
                                                      echo"&nbsp;";
                                                      echo ucwords($userlist['art_lastname']);
                                                      ?>
                                                </h6>
                                             </a>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="post-design-product_follow_main" style="display:block;">
                                             <a>
                                                <p>
                                                   <?php
                                                      if ($userlist['designation']) {
                                                          echo $userlist['designation'];
                                                      } else {
                                                          echo "Current Work";
                                                      }
                                                      ?>
                                                </p>
                                             </a>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="follow_left_box_main_btn">
                                    <div class="<?php echo "fr" . $userlist['art_id']; ?>">
                                       <button id="<?php echo "followdiv" . $userlist['art_id']; ?>" onClick="followuser(<?php echo $userlist['art_id']; ?>)">Follow</button>
                                    </div>
                                 </div>
                                 <span class="Follow_close" onClick="followclose(<?php echo $userlist['art_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>
                              </div>
                           </div>
                           <?php
                              }
                              }
                              }
                              ?>
                           <!-- third condition start -->
                           <?php
                              if ($userlistview3 > 0) {
                                  foreach ($userlistview3 as $userlist) {
                              
                                      $userid = $this->session->userdata('aileenuser');
                              
                                      $followfrom = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_id;
                              
                              
                                      $contition_array = array('follow_to' => $userlist['art_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '1');
                                      $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                              
                              
                              
                                      if (!$artfollow) {
                                          ?>                             
                           <div class="profile-job-post-title-inside clearfix">
                              <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['art_id']; ?>">
                                 <div class="post-design-pro-img_follow">
                                    <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>" title="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php if ($userlist['art_user_image']) { ?>
                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userlist['art_user_image']); ?>"  alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>"> <?php } else { ?>
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } ?></a>
                                 </div>
                                 <div class="post-design-name_follow fl">
                                    <ul>
                                       <li>
                                          <div class="post-design-product_follow">
                                             <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>">
                                                <h6>
                                                   <?php
                                                      echo ucwords($userlist['art_name']);
                                                      echo"&nbsp;";
                                                      echo ucwords($userlist['art_lastname']);
                                                      ?>
                                                </h6>
                                             </a>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="post-design-product_follow_main" style="display:block;">
                                             <a>
                                                <p>
                                                   <?php
                                                      if ($userlist['designation']) {
                                                          echo $userlist['designation'];
                                                      } else {
                                                          echo "Current Work";
                                                      }
                                                      ?>
                                                </p>
                                             </a>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="follow_left_box_main_btn">
                                    <div class="<?php echo "fr" . $userlist['art_id']; ?>">
                                       <button id="<?php echo "followdiv" . $userlist['art_id']; ?>" onClick="followuser(<?php echo $userlist['art_id']; ?>)">Follow</button>
                                    </div>
                                 </div>
                                 <span class="Follow_close" onClick="followclose(<?php echo $userlist['art_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>
                              </div>
                           </div>
                           <?php
                              }
                              }
                              }
                              ?>
                           <!-- forth condition start -->
                           <?php
                              if ($userlistview4 > 0) {
                                  foreach ($userlistview4 as $userlist) {
                              
                                      $userid = $this->session->userdata('aileenuser');
                              
                                      $followfrom = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_id;
                              
                              
                                      $contition_array = array('follow_to' => $userlist['art_id'], 'follow_from' => $followfrom, 'follow_status' => '1', 'follow_type' => '1');
                                      $artfollow = $this->data['artfollow'] = $this->common->select_data_by_condition('follow', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                              
                              
                              
                                      if (!$artfollow) {
                                          ?>                             
                           <div class="profile-job-post-title-inside clearfix">
                              <div class=" col-md-12 follow_left_box_main" id="<?php echo "fad" . $userlist['art_id']; ?>">
                                 <div class="post-design-pro-img_follow">
                                    <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>" title="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php if ($userlist['art_user_image']) { ?>
                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userlist['art_user_image']); ?>"  alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } else { ?> 
                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($userlist['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($userlist['art_lastname']);
                                       ?>">
                                    <?php } ?></a>
                                 </div>
                                 <div class="post-design-name_follow fl">
                                    <ul>
                                       <li>
                                          <div class="post-design-product_follow">
                                             <a href="<?php echo base_url('artistic/art_manage_post/' . $userlist['user_id'] . ''); ?>">
                                                <h6>
                                                   <?php
                                                      echo ucwords($userlist['art_name']);
                                                      echo"&nbsp;";
                                                      echo ucwords($userlist['art_lastname']);
                                                      ?>
                                                </h6>
                                             </a>
                                          </div>
                                       </li>
                                       <li>
                                          <div class="post-design-product_follow_main" style="display:block;">
                                             <a>
                                                <p>
                                                   <?php
                                                      if ($userlist['designation']) {
                                                          echo $userlist['designation'];
                                                      } else {
                                                          echo "Current Work";
                                                      }
                                                      ?>
                                                </p>
                                             </a>
                                          </div>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="follow_left_box_main_btn">
                                    <div class="<?php echo "fr" . $userlist['art_id']; ?>">
                                       <button id="<?php echo "followdiv" . $userlist['art_id']; ?>" onClick="followuser(<?php echo $userlist['art_id']; ?>)">Follow</button>
                                    </div>
                                 </div>
                                 <span class="Follow_close" onClick="followclose(<?php echo $userlist['art_id']; ?>)"><i class="fa fa-times" aria-hidden="true"></i></span>
                              </div>
                           </div>
                           <?php
                              }
                              }
                              }
                              ?>
                        </div>
                     </li>
                  </ul>
               </div>
               <!-- follower list end  -->
            </div>
         </div>
      </div>
      <!-- cover pic end -->
      <!-- popup start -->
      <!-- Trigger/Open The Modal -->
      <!-- popup end -->
      <div class="col-md-7 col-sm-12 col-md-push-4  custom-right-art">
     
         <div class="post-editor col-md-12">
            <div class="main-text-area col-md-12">
               <div class="popup-img">
                  <?php
                     $userimage = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     $userimageposted = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     ?>

                     <?php if($artisticdata[0]['art_user_image']){?>
                  <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">

                  <?php }else{?>


                   <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($artisticdata[0]['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($artisticdata[0]['art_lastname']);
                                       ?>">

                  <?php }?>
               </div>
               <div id="myBtn"  class="editor-content popup-text">
                  <span > Post Your Art....</span> 
                  <div class="padding-left padding_les_left camer_h">
                     <i class=" fa fa-camera" >
                     </i> 
                  </div>
               </div>
            </div>
         </div>
         <!-- The Modal -->
         <div id="myModal" class="modal-post">
            <!-- Modal content -->
            <div class="modal-content-post">
               <span class="close1">&times;</span>
                  <div class="post-editor col-md-12 post-edit-popup" id="close">
                  <?php echo form_open_multipart(base_url('artistic/art_post_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix', 'onsubmit' => "imgval(event)")); ?>
                  <div class="main-text-area " >
                     <div class="popup-img-in "> 

                     <?php if($artisticdata[0]['art_user_image']){?>
                     <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">
                     <?php }else{?>

                      <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($artisticdata[0]['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($artisticdata[0]['art_lastname']);
                                       ?>">

                     <?php }?>

                     </div>
                     <div id="myBtn"  class="editor-content col-md-10 popup-text" >
                        <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
 <textarea id= "test-upload_product" placeholder="Post Your Art...."   onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); onblur="check_length(this.form)" name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;"></textarea>
                        <div class="fifty_val">                       
                           <input size=1 class="text_num" value=50 name=text_num readonly> 
                        </div>
                   
                      <div class="padding-left padding_les_left camer_h">
                        <i class=" fa fa-camera" >
                        </i> 
                     </div>
                       </div>
                  </div>
                  <div class="row"></div>
                  <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                     <textarea id="test-upload_des" name="product_desc" class="description" placeholder="Enter Description"></textarea>
                     <output id="list"></output>
                  </div>
                  <!--   <span class="fr">
                     <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->
                  <div class="popup-social-icon">
                     <ul class="editor-header">
                        <li>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                              </div>
                           </div>
                           <label for="file-1">
                           <i class=" fa fa-camera upload_icon"  > Photo</i>
                           <i class=" fa fa-video-camera upload_icon"  > Video </i>
                           <i class="fa fa-music upload_icon "  > Audio </i>
                           <i class=" fa fa-file-pdf-o upload_icon"  > PDF </i>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <div class="fr">
                     <button type="submit"  value="Submit">Post</button>    
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
    
      <?php

         if (count($finalsorting) > 0) { 
             foreach ($finalsorting as $row) {
                 //  echo '<pre>'; print_r($finalsorting); die();
                 $userid = $this->session->userdata('aileenuser');
         
                 $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                 $artdelete = $this->data['artdelete'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
                 $likeuserarray = explode(',', $artdelete[0]['delete_post']);
         
                 if (!in_array($userid, $likeuserarray)) {
                     ?>
      <div id="<?php echo "removepost" . $row['art_post_id']; ?>">
         <div class="col-md-12 col-sm-12 post-design-box">
            <div class="post_radius_box">
               <div class="post-design-top col-md-12" id= "showpost">
                  <div class="post-design-pro-img"> 
                     <?php
                        $art_userimage = $this->db->get_where('art_reg', array('user_id' => $row['user_id'], 'status' => 1))->row()->art_user_image;
                        
                        $userimageposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_user_image;
                        ?>
                     <?php if ($row['posted_user_id']) { ?>
                     <a class="post_dot" title="<?php echo ucwords($firstnameposted) . ' ' . ucwords($lastnameposted); ?>" href="<?php echo base_url('artistic/art_manage_post/' . $row['posted_user_id']); ?>">

                     <?php ?>

                     <?php if($userimageposted){?>
                     <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />
                     <?php }else{?>

                      <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($artisticdata[0]['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($artisticdata[0]['art_lastname']);
                                       ?>">


                     <?php }?>

                     </a>
                     <?php } else { ?>
                     <a  class="post_dot" title="" href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>">

                     <?php if($art_userimage){?>
                     <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>"  alt="">
                     <?php }else{?>

                      <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php
                                       echo ucwords($artisticdata[0]['art_name']);
                                       echo"&nbsp;";
                                       echo ucwords($artisticdata[0]['art_lastname']);
                                       ?>">


                     <?php }?>

                      </a>
                     <?php } ?>
                  </div>
                   
                  <div class="post-design-name fl col-xs-8 col-md-10">
                     <ul>
                        <?php
                           $firstname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_name;
                           
                           $lastname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_lastname;
                           
                           $firstnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_name;
                           $lastnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_lastname;
                           
                           $designation = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->designation;
                           
                           
                           $userskill = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_skill;
                           
                           
                           $aud = $userskill;
                           $aud_res = explode(',', $aud);
                           foreach ($aud_res as $skill) {
                           
                               $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                               $skill1[] = $cache_time;
                           }
                           $listFinal = implode(', ', $skill1);
                           ?>
                        <li>
                           <div class="post-design-product">
                              <!-- other user post time name strat-->
                              <?php if ($row['posted_user_id']) { ?>
                              <div class="else_post_d">
                                 <a style="max-width: 30%;" class="post_dot" title="<?php echo ucwords($firstnameposted) . ' ' . ucwords($lastnameposted); ?>" href="<?php echo base_url('artistic/art_manage_post/' . $row['posted_user_id']); ?>"><?php echo ucwords($firstnameposted) . ' ' . ucwords($lastnameposted); ?> </a>
                                 <p class="posted_with" > Posted With </p>
                                 <a  class="post_dot1 padding_less_left" href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>"><?php echo ucwords($firstname) . ' ' . ucwords($lastname); ?></a>
                                 <span role="presentation" aria-hidden="true"> · </span>
                                 <span class="ctre_date"> 
                                 <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>
                                 </span>
                              </div>
                              <!-- other user post time name end-->
                              <?php } else { ?>
                              <a title="<?php
                                 echo ucwords($firstname);
                                 print "&nbsp;&nbsp;";
                                 echo ucwords($lastname);
                                 ?>" class="post_dot" href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>"><?php
                                 echo ucwords($firstname);
                                 print "&nbsp;&nbsp;";
                                 echo ucwords($lastname);
                                 ?> </a>
                              <span role="presentation" aria-hidden="true"> · </span>
                              <div class="datespan">
                                 <span class="ctre_date">  <?php // echo date('d-M-Y',strtotime($row['created_date']));                                              ?>
                                 <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>
                                 </span> 
                              </div>
                              <?php } ?> 
                           </div>
                        </li>
                        <li>
                           <div class="post-design-product">
                              <a><?php if($designation)
                                 {echo $designation;
                                 
                                 }else{
                                     echo "Current Work";
                                    }?> </a>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="dropdown1">
                     <a onClick="myFunction(<?php echo $row['art_post_id']; ?>)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v"></a>
                     <div id="<?php echo "myDropdown" . $row['art_post_id']; ?>" class="dropdown-content1">
                        <?php
                           if ($row['posted_user_id'] != 0) {
                           
                               if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                                   ?>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                        <?php } else {
                           ?>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>
                        <a href="<?php echo base_url('artistic/artistic_contactperson/' . $row['user_id'] . ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
                        <?php
                           }
                           } else {
                           ?>  
                        <?php
                           $userid = $this->session->userdata('aileenuser');
                           if ($row['user_id'] == $userid) {
                               ?>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                        <?php } else { ?>
                        <a id="<?php echo $row['art_post_id']; ?>" onClick="deletepostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>
                        <a href="<?php echo base_url('artistic/artistic_contactperson/' . $row['user_id'] . ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
                        <?php
                           }
                           }
                           ?>
                     </div>
                  </div>
                  <div class="post-design-desc ">
                     <span>
                        <div class="ft-15 t_artd">
                           <div id="<?php echo 'editpostdata' . $row['art_post_id']; ?>" style="display:block;">
                              <a class="ft-15 t_artd"><?php echo $this->common->make_links($row['art_post']); ?></a>
                           </div>
                <div id="<?php echo 'editpostbox' . $row['art_post_id']; ?>" style="display:none;">
                              <input type="text" placeholder="Title" id="<?php echo 'editpostname' . $row['art_post_id']; ?>" name="editpostname"  value="<?php echo $row['art_post']; ?>" style=" margin-bottom: 10px;">
                           </div>
                        </div>
                         
<!--               khyati chnages sstat 24-6         <div  id="<?php echo 'editpostdetails' . $row['art_post_id']; ?>" style="display:block ; ">
                           <?php
                              $text = $this->common->make_links($row['art_description']);
                              ?>
                           <span class="show_more ft-13 "><?php echo $text; ?></span>
                        </div>-->
                         
                         <div id="<?php echo "khyati" . $row['art_post_id']; ?>" style="display:block;">
                      <?php
                     $small = substr($row['art_description'], 0, 180);
                     echo $small;

                     if (strlen($row['art_description']) > 180) {
                          echo '... <span id="kkkk" onClick="khdiv(' . $row['art_post_id'] . ')">View More</span>';
                        }?>
                   </div>
                    <div id="<?php echo "khyatii" . $row['art_post_id']; ?>" style="display:none;">
                      <?php
                     echo $row['art_description'];
                   ?>
                   </div>
                        <div id="<?php echo 'editpostdetailbox' . $row['art_post_id']; ?>" style="display:none;">
                           <div  contenteditable="true" id="<?php echo 'editpostdesc' . $row['art_post_id']; ?>"  class="textbuis editable_text margin_btm" name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);" placeholder="Description" ><?php echo $row['art_description']; ?></div>
                        </div>
                         <!-- khyati changes end 24-6 -->
                        <button id="<?php echo "editpostsubmit" . $row['art_post_id']; ?>" style="display:none" onClick="edit_postinsert(<?php echo $row['art_post_id']; ?>)" class="fr" style="margin-right: 176px; border-radius: 3px;" >Save</button>
                     </span>
                  </div>
               </div>
               <!-- multiple image code  start-->
               <div class="post-design-mid col-md-12" >
                  <div class="">
                     <?php
                        $contition_array = array('post_id' => $row['art_post_id'], 'is_deleted' => '1', 'image_type' => '1');
                        $artmultiimage = $this->data['artmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        ?>
                     <?php if (count($artmultiimage) == 1) { ?>
                     <?php
                        $allowed = array('gif', 'PNG', 'jpg');
                        $allowespdf = array('pdf');
                        $allowesvideo = array('mp4', '3gp', 'avi', 'ogg', '3gp', 'webm');
                        $allowesaudio = array('mp3');
                        $filename = $artmultiimage[0]['image_name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        
                        if (in_array($ext, $allowed)) {
                            ?>
                     <!-- one image start -->
                     <div class="one-image">
                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img  src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[0]['image_name']) ?>" > </a>
                     </div>
                     <!-- one image end -->
                     <?php } elseif (in_array($ext, $allowespdf)) { ?>
                     <!-- one pdf start -->
                     <div>
                        <a href="<?php echo base_url('artistic/creat_pdf/' . $artmultiimage[0]['image_id']) ?>">
                           <div class="pdf_img">
                              <img src="<?php echo base_url('images/PDF.jpg') ?>">
                           </div>
                        </a>
                     </div>
                     <!-- one pdf end -->
                     <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                     <!-- one video start -->
                     <div>
                        <video width="100%" height="370" >
                           <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']) ?>" type="video/mp4">
                           <source src="movie.ogg" type="video/ogg">
                        </video>
                     </div>
                     <!-- one video end -->
                     <?php } elseif (in_array($ext, $allowesaudio)) { ?>
                     <!-- one audio start -->
               
                        <div class="audio_main_div">
                           <div class="audio_img">
                              <img src="<?php echo base_url('images/music-icon.png') ?> ">  
                           </div>
                           <div class="audio_source">
                              <audio  controls>
                                 <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']) ?>" type="audio/mp3">
                                 <source src="movie.ogg" type="audio/ogg">
                                 Your browser does not support the audio tag.
                              </audio>
                           </div>
                           <div class="audio_mp3">
                              <p title="hellow this is mp3">This text will scroll from right to left</p>
                           </div>
                        </div>
                        <!-- one audio end -->
                        <?php } ?>
                        <?php } elseif (count($artmultiimage) == 2) { ?>
                        <?php
                           foreach ($artmultiimage as $multiimage) {
                           ?>
                        <!-- two image start -->
                        <div  class="two-images" >
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="two-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                        </div>
                        <!-- two image end -->
                        <?php } ?>
                        <?php } elseif (count($artmultiimage) == 3) { ?>
                        <!-- three image start -->
                        <div class="three-image-top" >
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[0]['image_name']) ?>"> </a>
                        </div>
                        <div  class="three-image">
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[1]['image_name']) ?>" > </a>
                        </div>
                        <div  class="three-image">
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[2]['image_name']) ?>" > </a>
                        </div>
                        <!-- three image end -->
                        <?php } elseif (count($artmultiimage) == 4) { ?>
                        <?php
                           foreach ($artmultiimage as $multiimage) {
                               ?>
                        <!-- four image start -->
                        <div class="four-image">
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                        </div>
                        <!-- four image end -->
                        <?php } ?>
                        <?php } elseif (count($artmultiimage) > 4) { ?>
                        <?php
                           $i = 0;
                           foreach ($artmultiimage as $multiimage) {
                                                                      ?>
                        <!-- five image start -->
                        <div>
                           <div class="four-image">
                              <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                           </div>
                        </div>
                        <!-- five image end -->
                        <?php
                           $i++;
                           if ($i == 3)
                           break;
                           }
                           ?>
                        <!-- this div view all image start -->
                        
                           <div class="four-image" >
                              <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[3]['image_name']) ?>"> </a>
                           
                           <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>" >
                              <div class="more-image" >
                                 <span> View All (+<?php echo (count($artmultiimage) - 4); ?>) </span>
                              </div>
                           </a>
                        </div>
                       
                        <!-- this div view all image end -->
                        <?php } ?>
                     </div>
                  </div>
                  <!-- multiple image code  end-->
                  <!-- like comment symbol start -->
                  <div class="post-design-like-box col-md-12">
                     <div class="post-design-menu">
                        <!-- like comment div start -->
                        <ul class="col-md-6">
                           <li class="<?php echo 'likepost' . $row['art_post_id']; ?>">
                              <a id="<?php echo $row['art_post_id']; ?>" class="ripple like_h_w" onClick="post_like(this.id)">
                              <?php
                                 $userid = $this->session->userdata('aileenuser');
                                 $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                                 $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                 $likeuserarray = explode(',', $artlike[0]['art_like_user']);
                                 
                                 if (!in_array($userid, $likeuserarray)) {
                                     ?>
                              <i class="fa fa-thumbs-up   fa-1x" aria-hidden="true"></i>
                              <?php } else {
                                 ?>
                              <i class="fa fa-thumbs-up fa-1x main_color " aria-hidden="true"></i>
                              <?php }
                                 ?>
                              <span>
                              <?php
                                 //                                                                        if ($row['art_likes_count'] > 0) {
                                 //                                                                            echo $row['art_likes_count'];
                                 //                                                                        }
                                 //                                                                        ?>
                              </span>
                              </a>
                           </li>
                           <li id="<?php echo 'insertcount' . $row['art_post_id']; ?>" style="visibility:show">
                              <?php
                                 $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                 $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                 ?>
                              <a  class="ripple like_h_w" onClick="commentall(this.id)" id="<?php echo $row['art_post_id']; ?>">
                              <i class="fa fa-comment-o" aria-hidden="true">
                              <?php
                                 //                                                                        if (count($commnetcount) > 0) {
                                 //                                                                            echo count($commnetcount);
                                 //                                                                        }
                                                                                                         ?>
                              </i>  
                              </a>
                           </li>
                        </ul>
                        <ul class="col-md-6 like_cmnt_count">
                           <li>
                              <div class="like_cmmt_space comnt_count_ext_a like_count_ext<?php echo $row['art_post_id']; ?>">
                                 <span class="comment_count" > 
                                 <?php
                                    if (count($commnetcount) > 0) {
                                        echo count($commnetcount); ?>
                                 </span> 
                                 <span> Comment</span>
                                 <?php }
                                    ?> 
                              </div>
                           </li>
                           <li>
                              <div class="comnt_count_ext_a <?php echo 'comnt_count_ext' . $row['art_post_id']; ?>">
                                 <span class="comment_like_count"> 
                                 <?php
                                    if ($row['art_likes_count'] > 0) { 
                                        echo $row['art_likes_count']; ?>
                                 </span> 
                                 <span> Like</span>
                                 <?php   }
                                    ?> 
                              </div>
                           </li>
                        </ul>
                        <!-- like comment div end -->
                     </div>
                  </div>
                  <!-- like comment symbol end -->
                  <?php
                     if ($row['art_likes_count'] > 0) {
                         ?>
                  <div class="likeduserlist<?php echo $row['art_post_id'] ?>">
                     <?php
                        $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                        $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $likeuser = $commnetcount[0]['art_like_user'];
                        $countlike = $commnetcount[0]['art_likes_count'] - 1;
                        $likelistarray = explode(',', $likeuser);
                        //  $likelistarray = array_reverse($likelistarray);
                        foreach ($likelistarray as $key => $value) {
                            $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                            $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
                            ?>
                     <?php } ?>
                     <!-- pop up box end-->
                     <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['art_post_id']; ?>);">
                        <?php
                           $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                           $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                           
                           $likeuser = $commnetcount[0]['art_like_user'];
                           $countlike = $commnetcount[0]['art_likes_count'] - 1;
                           
                           $likelistarray = explode(',', $likeuser);
                           $likelistarray = array_reverse($likelistarray);
                           $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                           $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                           ?>
                        <div class="like_one_other">
                           <?php
                              $userid = $this->session->userdata('aileenuser');
                              
                              if ($userid == $likelistarray[0]) {
                              
                                  echo "You";
                              } else {
                                  echo ucwords($art_fname);
                                  echo "&nbsp;";
                                  echo ucwords($art_lname);
                                  echo "&nbsp;";
                              }
                              ?>
                           <?php
                              if (count($likelistarray) > 1) {
                                  echo "and ";
                                  echo $countlike;
                                  echo "&nbsp;";
                                  echo "others";
                              }
                              ?>
                        </div>
                     </a>
                  </div>
                  <?php
                     }
                     ?>
                  <!-- like user list name start -->
                  <div class="<?php echo "likeusername" . $row['art_post_id']; ?>" id="<?php echo "likeusername" . $row['art_post_id']; ?>" style="display:none">
                     <?php
                        $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                        $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                        $likeuser = $commnetcount[0]['art_like_user'];
                        $countlike = $commnetcount[0]['art_likes_count'] - 1;
                        $likelistarray = explode(',', $likeuser);
                        // $likelistarray = array_reverse($likelistarray);
                        foreach ($likelistarray as $key => $value) {
                            $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                            $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
                            ?>
                     <?php } ?>
                     <!-- pop up box end-->
                     <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['art_post_id']; ?>);">
                        <?php
                           $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                           $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                           
                           $likeuser = $commnetcount[0]['art_like_user'];
                           $countlike = $commnetcount[0]['art_likes_count'] - 1;
                           
                           $likelistarray = explode(',', $likeuser);
                           $likelistarray = array_reverse($likelistarray);
                           $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                           $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                           ?>
                        <div class="like_one_other">
                           <?php
                              echo ucwords($art_fname);
                              echo "&nbsp;";
                              echo ucwords($art_lname);
                              echo "&nbsp;";
                              ?>
                           <?php
                              if (count($likelistarray) > 1) {
                                  echo "and ";
                                  echo $countlike;
                                  echo "&nbsp;";
                                  echo "others";
                              }
                              ?>
                        </div>
                     </a>
                  </div>
                  <!-- like user list end -->
                  <!-- comment start -->
                  <div class="art-all-comment col-md-12">
                     <div id="<?php echo "fourcomment" . $row['art_post_id']; ?>" style="display:none">
                     </div>
                     <div  id="<?php echo "threecomment" . $row['art_post_id']; ?>" style="display:block">
                        <div class="<?php echo 'insertcomment' . $row['art_post_id']; ?>">
                           <?php
                              $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                              $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                              
                              if ($artdata) {
                                      foreach ($artdata as $rowdata) {
                                         $artname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_name;
                                          $artlastname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_lastname;
                                      ?>
                           <div class="all-comment-comment-box">
                              <a href="<?php echo base_url('artistic/art_manage_post/' . $rowdata['user_id'] . ''); ?>">
                                 <div class="post-design-pro-comment-img">
                                    <?php
                                       $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                                       ?>
                                    <?php if ($art_userimage[0]['art_user_image']) { ?>
                                    <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>"  alt="">
                                    <?php
                                       } else {
                                           ?>
                              <a href="<?php echo base_url('artistic/art_manage_post/' . $rowdata['user_id'] . ''); ?>">
                              <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                              </a>
                              <?php
                                 }
                                 ?>
                              </div>
                              <div class="comment-name">
                                 <b title=" <?php
                                    echo ucwords($artname);
                                    echo "&nbsp;";
                                    echo ucwords($artlastname);
                                    ?>">
                                 <?php
                                    echo ucwords($artname);
                                    echo "&nbsp;";
                                    echo ucwords($artlastname);
                                    ?></b><?php echo '</br>'; ?>
                              </div>
                              </a>
                              <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['artistic_post_comment_id']; ?>">
                                 <?php
                                    echo $this->common->make_links($rowdata['comments']);
                                    ?>
                              </div>
                              <div class="edit-comment-box">
                                 <div class="inputtype-edit-comment">
                                    <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 78%;" class="editable_text" name="<?php echo $rowdata['artistic_post_comment_id']; ?>"  id="editcomment<?php echo $rowdata['artistic_post_comment_id']; ?>" placeholder="Enter Your Comment " value= ""  onkeyup="commentedit(<?php echo $rowdata['artistic_post_comment_id']; ?>)"><?php echo $rowdata['comments']; ?></div>
                                    <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Save</button></span>
                                 </div>
                              </div>
                              <div class="art-comment-menu-design">
                                 <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['artistic_post_comment_id']; ?>">
                                    <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like1(this.id)">
                                    <?php
                                       $userid = $this->session->userdata('aileenuser');
                                       $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' => '1');
                                       $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                       $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);
                                       
                                       if (!in_array($userid, $likeuserarray)) {
                                       ?>
                                    <i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i> 
                                    <?php } else {
                                       ?>
                                    <i class="fa fa-thumbs-up fa-1x main_color" aria-hidden="true"></i>
                                    <?php }
                                       ?>
                                    <span>
                                    <?php
                                       if ($rowdata['artistic_comment_likes_count'] > 0) {
                                               echo $rowdata['artistic_comment_likes_count'];
                                        }
                                       ?>
                                    </span>
                                    </a>
                                 </div>
                                 <?php
                                    $userid = $this->session->userdata('aileenuser');
                                    
                                    if ($rowdata['user_id'] == $userid) {
                                        ?> 
                                 <span role="presentation" aria-hidden="true"> · </span>
                                 <div class="comment-details-menu">
                                    <div id="<?php echo 'editcommentbox' . $rowdata['artistic_post_comment_id']; ?>" style="display:block;">
                                       <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editbox(this.id)" class="editbox">Edit
                                       </a>
                                    </div>
                                    <div id="<?php echo 'editcancle' . $rowdata['artistic_post_comment_id']; ?>" style="display:none;">
                                       <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                                       </a>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <?php
                                    $userid = $this->session->userdata('aileenuser');
                                    
                                    $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;
                                    
                                    
                                    if ($rowdata['user_id'] == $userid || $art_userid == $userid) {
                                        ?> 
                                 <span role="presentation" aria-hidden="true"> · </span>
                                 <div class="comment-details-menu">
                                    <input type="hidden" name="post_delete"  id="post_delete<?php echo $rowdata['artistic_post_comment_id']; ?>" value= "<?php echo $rowdata['art_post_id']; ?>">
                                    <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                    </span>
                                    </a>
                                 </div>
                                 <?php } ?>
                                 <span role="presentation" aria-hidden="true"> · </span>
                                 <div class="comment-details-menu">
                                    <p> <?php
                                       echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                       echo '</br>';
                                       ?>
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <?php } }?>
                        </div>
                     </div>
                  </div>
                  <!-- comment end -->
                  


                  <!-- comment enter box start  -->
                  <div class="post-design-commnet-box col-md-12">
                     <?php
                        $userid = $this->session->userdata('aileenuser');
                        $art_userimage = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_user_image;
                        ?>
                     <div class="post-design-proo-img">
                        <?php if ($art_userimage[0]['art_user_image']) { ?>
                        <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>" name="image_src" id="image_src" />
                        <?php
                           } else {
                               ?>
                        <img src="<?php echo base_url(NOIMAGE); ?>" alt="No Image">
                        <?php
                           }
                           ?>
                     </div>
                     <div class="">
                        <div id="content" class="col-md-12 inputtype-comment cmy_2" >
                           <div contenteditable="true" class="editable_text edt_2" name="<?php echo $row['art_post_id']; ?>"  id="<?php echo "post_comment" . $row['art_post_id']; ?>" placeholder="Add a Comment ..." onClick="entercomment(<?php echo $row['art_post_id']; ?>)"></div>
                        </div>
                        <?php echo form_error('post_comment'); ?>
                        <div class=" comment-edit-butn" >   
                           <button  id="<?php echo $row['art_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button> 
                        </div>
                     </div>
                  </div>
                  <!-- comment enter box end  -->



               </div>
            </div>
         </div>
         <?php } 
         else{
          $count[] = "abc";
         }



       } 

     }   

     //echo count($finalsorting);
     //echo count($count);

     if(count($finalsorting) > 0){ 
          if(count($count) == count($finalsorting)){  ?>
         <div class="contact-frnd-post bor_none">
         <div class="text-center rio">
            <h4 class="page-heading  product-listing" >No Post Found.</h4>
         </div>
         </div>
         <?php } } else{ ?>


          
         <div class="contact-frnd-post bor_none">
         <div class="text-center rio">
            <h4 class="page-heading  product-listing" >No Post Found.</h4>
         </div>
         </div>
         <?php }  ?>

         <div class="nofoundpost">
          </div>


      </div>
      </section>
      <footer>
         <?php echo $footer; ?>
      </footer>
      <!-- Bid-modal  -->
      <div class="modal fade message-box biderror" id="bidmodal" role="dialog"  >
         <div class="modal-dialog modal-lm" >
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
      <div class="modal fade message-box" id="likeusermodal" role="dialog" >
         <div class="modal-dialog modal-lm">
            <div class="modal-content">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
               <div class="modal-body">
                  <span class="mes">
                  </span>
               </div>
            </div>
         </div>
      </div>
      <!-- Model Popup Close -->
       <!-- Bid-modal for this modal appear or not start -->
            <div class="modal fade message-box" id="post" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bid-modal for this modal appear or not  Popup Close -->
   </body>
</html>
<script>
   $(document).ready(function () {
       $('video').mediaelementplayer({
           alwaysShowControls: false,
           videoVolume: 'horizontal',
           features: ['playpause', 'progress', 'volume', 'fullscreen']
       });
   });
</script>
<!-- further and less -->
<script>
   $(function () {
       var showTotalChar = 200, showChar = "Read More", hideChar = "";
       $('.show_more').each(function () {
           var content = $(this).html();
           if (content.length > showTotalChar) {
               var con = content.substr(0, showTotalChar);
               var hcon = content.substr(showTotalChar, content.length - showTotalChar);
               var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
               $(this).html(txt);
           }
       });
       $(".showmoretxt").click(function () {
           if ($(this).hasClass("sample")) {
               $(this).removeClass("sample");
               $(this).text(showChar);
           } else {
               $(this).addClass("sample");
               $(this).text(hideChar);
           }
           $(this).parent().prev().toggle();
           $(this).prev().toggle();
           return false;
       });
   });
</script>
<script>
   $('#file-fr').fileinput({
       language: 'fr',
       uploadUrl: '#',
       allowedFileExtensions: ['jpg', 'png', 'gif']
   });
   $('#file-es').fileinput({
       language: 'es',
       uploadUrl: '#',
       allowedFileExtensions: ['jpg', 'png', 'gif']
   });
   
   $("#file-1").fileinput({
       uploadUrl: '#', // you must set a valid URL here else you will get an error
       allowedFileExtensions: ['jpg', 'png', 'gif'],
       overwriteInitial: false,
       maxFileSize: 1000,
       maxFilesNum: 10,
       //allowedFileTypes: ['image', 'video', 'flash'],
       slugCallback: function (filename) {
           return filename.replace('(', '_').replace(']', '_');
       }
   });
   /*
    $(".file").on('fileselect', function(event, n, l) {
    alert('File Selected. Name: ' + l + ', Num: ' + n);
    });
    */
   
   $(".btn-warning").on('click', function () {
       var $el = $("#file-4");
       if ($el.attr('disabled')) {
           $el.fileinput('enable');
       } else {
           $el.fileinput('disable');
       }
   });
   // $(".btn-info").on('click', function () {
   //     $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
   // });
   /*
    $('#file-4').on('fileselectnone', function() {
    alert('Huh! You selected no files.');
    });
    $('#file-4').on('filebrowse', function() {
    alert('File browse clicked for #file-4');
    });
    */
   $(document).ready(function () {
       $("#test-upload").fileinput({
           'showPreview': false,
           'allowedFileExtensions': ['jpg', 'png', 'gif'],
           'elErrorContainer': '#errorBlock'
       });
       $("#kv-explorer").fileinput({
           'theme': 'explorer',
           'uploadUrl': '#',
           overwriteInitial: false,
           initialPreviewAsData: true,
   
       });
       /*
        $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
        alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        });
        */
   });
</script>
<!-- script for skill textbox automatic start (option 2)-->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
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
<!--      <script>
   //select2 autocomplete start for skill
   $('#searchskills').select2({
   
       placeholder: 'Find Your Skills',
   
       ajax: {
   
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
       ajax: {
   
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
   
   
   
   </script> -->
<!-- popup form edit start -->
<script>
   // Get the modal
   var modal = document.getElementById('myModal');
   
   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");
   
   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];
   
   // When the user clicks the button, open the modal 
   btn.onclick = function () {
       modal.style.display = "block";
   }
   
   // When the user clicks on <span> (x), close the modal
   span.onclick = function () {
       modal.style.display = "none";
   }
   
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function (event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }
</script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
   //validation for edit email formate form
   
   $(document).ready(function () {
   
       $("#artpostform").validate({
   
           rules: {
   
               postname: {
   
                   required: true,
               },
   
               // skills: {
   
               //   require_from_group: [1, ".skill-group"]
               //     //required: true,
               // },
   
               // other_skill: {
   
               //     require_from_group: [1, ".skill-group"]
               //     //required: true,
               // },
   
   
               description: {
                   required: true,
   
               },
   
               // postattach: {
   
               //      required: true,
   
               //  },
   
           },
   
           messages: {
   
               postname: {
   
                   required: "Post name Is Required.",
   
               },
   
               // skills: {
   
               //     required: "Skill Is Required.",
   
               // },
   
               description: {
                   required: "Description is required",
   
               },
               // postattach: {
   
               //     required: "Attachment Is Required.",
   
               // },
   
           },
   
       });
   });
</script>
<!-- javascript validation End -->
<!-- post like script start -->
<script type="text/javascript">
   function post_like(clicked_id)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_post" ?>',
           dataType: 'json',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('.' + 'likepost' + clicked_id).html(data.like);
               $('.likeusername' + clicked_id).html(data.likeuser);
               $('.comnt_count_ext' + clicked_id).html(data.like_user_count);
               
               $('.likeduserlist' + clicked_id).hide();
               if (data.likecount == '0') {
                   document.getElementById('likeusername' + clicked_id).style.display = "none";
               } else {
                   document.getElementById('likeusername' + clicked_id).style.display = "block";
               }
               $('#likeusername' + clicked_id).addClass('likeduserlist1');
           }
       });
   }
</script>
<!--post like script end -->
<!-- comment like script start -->
<script type="text/javascript">
   function comment_like(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_comment" ?>',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecomment' + clicked_id).html(data);
   
           }
       });
   }
</script>
<script type="text/javascript">
   function comment_like1(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_comment1" ?>',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecomment1' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!--comment like script end -->
<!-- comment delete script start -->
<script type="text/javascript">
   function comment_delete(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   function comment_deleted(clicked_id)
   {
      var post_delete = document.getElementById("post_delete" + clicked_id);
       //alert(post_delete.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_comment" ?>',
           data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
           dataType: "json",
           success: function (data) {
               //alert('.' + 'insertcomment' + clicked_id);
               $('.' + 'insertcomment' + post_delete.value).html(data.comment);
               //$('#' + 'insertcount' + post_delete.value).html(data.count);
                $('.like_count_ext' + post_delete.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
           }
       });
   }
   
   function comment_deletetwo(clicked_id)
   {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function comment_deletedtwo(clicked_id)
   {
       var post_delete1 = document.getElementById("post_deletetwo");
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
           data: 'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
           dataType: "json",
           success: function (data) {
   
               // $('.' + 'insertcomment' + post_delete.value).html(data);
               $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
            //   $('#' + 'insertcount' + post_delete1.value).html(data.count);
             $('.like_count_ext' + post_delete1.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
   
           }
       });
   }
   
   
   //                        function comment_deletetwo(clicked_id)
   //                        {
   //
   //                            var post_delete = document.getElementById("post_delete2");
   //
   //                            $.ajax({
   //                                type: 'POST',
   //                                url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
   //                                data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
   //                                success: function (data) {
   //
   //                                    $('#' + 'fourcomment' + post_delete.value).html(data);
   //
   //                                }
   //                            });
   //                        }
</script>
<!--comment delete script end -->
<!-- comment insert script start -->
<!-- insert comment using comment button-- > 
   <!-- insert comment using enter -->
<script type="text/javascript">
   //                        function insert_comment(clicked_id)
   //                        {
   //                            var $field = $('#post_comment' + clicked_id);
   //                            var post_comment = $('#post_comment' + clicked_id).html();
   //                            
   //                            $('#post_comment' + clicked_id).html("");
   //
   //                            var x = document.getElementById('threecomment' + clicked_id);
   //                            var y = document.getElementById('fourcomment' + clicked_id);
   //
   //                            if (post_comment == '') {
   //
   //                                event.preventDefault();
   //                                return false;
   //                            } else {
   //
   //                                if (x.style.display === 'block' && y.style.display === 'none') {
   //
   //                                    $.ajax({
   //                                        type: 'POST',
   //                                        url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
   //                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
   //                                        dataType: "json",
   //                                        success: function (data) {
   //
   //                                            //$('.' + 'insertcomment' + clicked_id).html(data);
   //                                            $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                            $('.insertcomment' + clicked_id).html(data.comment);
   //
   //                                        }
   //                                    });
   //
   //                                } else {
   //
   //                                    $.ajax({
   //                                        type: 'POST',
   //                                        url: '<?php echo base_url() . "artistic/insert_comment" ?>',
   //                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
   //                                        dataType: "json",
   //                                        success: function (data) {
   //                                            $('textarea').each(function () {
   //                                                $(this).val('');
   //                                            });
   //                                            $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
   //                                        }
   //                                    });
   //
   //                                }
   //                            }
   //
   //                        }
   
   function insert_comment(clicked_id)
   {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
       var sel = $("#post_comment" + clicked_id);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
       $('#post_comment' + clicked_id).html("");
   
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
               data: 'post_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
                  // $('#' + 'insertcount' + clicked_id).html(data.count);
                   $('.insertcomment' + clicked_id).html(data.comment);
                   $('.like_count_ext' + clicked_id).html(data.commentcount);
   
               }
           });
   
       } else {
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_comment" ?>',
               data: 'post_id=' + clicked_id + '&comment=' + txt,
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
              //     $('#' + 'insertcount' + clicked_id).html(data.count);
                   $('#' + 'fourcomment' + clicked_id).html(data.comment);
                   $('.like_count_ext' + clicked_id).html(data.commentcount);
               }
           });
       }
   }
   
</script>
<script type="text/javascript">
   //                        function entercomment(clicked_id)
   //                        {
   //                            $('#post_comment' + clicked_id).keypress(function (e) {
   //                                if (e.keyCode == 13 && !e.shiftKey) {
   //                                    var val = $('#post_comment' + clicked_id).val();
   //                                    e.preventDefault();
   //
   //                                    if (window.preventDuplicateKeyPresses)
   //                                        return;
   //
   //                                    window.preventDuplicateKeyPresses = true;
   //                                    window.setTimeout(function () {
   //                                        window.preventDuplicateKeyPresses = false;
   //                                    }, 500);
   //                                    var x = document.getElementById('threecomment' + clicked_id);
   //                                    var y = document.getElementById('fourcomment' + clicked_id);
   //
   //                                    if (val == '') {
   //
   //                                        event.preventDefault();
   //                                        return false;
   //                                    } else {
   //
   //                                        if (x.style.display === 'block' && y.style.display === 'none') {
   //                                            $.ajax({
   //                                                type: 'POST',
   //                                                url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
   //                                                data: 'post_id=' + clicked_id + '&comment=' + val,
   //                                                dataType: "json",
   //                                                success: function (data) {
   //                                                    $('textarea').each(function () {
   //                                                        $(this).val('');
   //                                                    });
   //
   //                                                    //  $('.insertcomment' + clicked_id).html(data);
   //                                                    $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                                    $('.insertcomment' + clicked_id).html(data.comment);
   //
   //                                                }
   //                                            });
   //
   //                                        } else {
   //
   //                                            $.ajax({
   //                                                type: 'POST',
   //                                                url: '<?php echo base_url() . "artistic/insert_comment" ?>',
   //                                                data: 'post_id=' + clicked_id + '&comment=' + val,
   //                                                // dataType: "json",
   //                                                success: function (data) {
   //                                                    $('textarea').each(function () {
   //                                                        $(this).val('');
   //                                                    });
   //                                                    $('#' + 'fourcomment' + clicked_id).html(data);
   //                                                }
   //                                            });
   //                                        }
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   
   function entercomment(clicked_id)
   {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#post_comment' + clicked_id).keypress(function (e) {
   
           if (e.keyCode == 13 && !e.shiftKey) {
               e.preventDefault();
               var sel = $("#post_comment" + clicked_id);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   
               $('#post_comment' + clicked_id).html("");
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               var x = document.getElementById('threecomment' + clicked_id);
               var y = document.getElementById('fourcomment' + clicked_id);
   
   
   
               if (x.style.display === 'block' && y.style.display === 'none') {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                       data: 'post_id=' + clicked_id + '&comment=' + txt,
                       dataType: "json",
                       success: function (data) { //alert(123); alert(data.commentcount);
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                         //  $('#' + 'insertcount' + clicked_id).html(data.count);
                           $('.insertcomment' + clicked_id).html(data.comment);
                           $('.like_count_ext' + clicked_id).html(data.commentcount);
                       }
                   });
               } else {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                       data: 'post_id=' + clicked_id + '&comment=' + txt,
                       dataType: "json",
                       success: function (data) {
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                        //   $('#' + 'insertcount' + clicked_id).html(data.count);
                           $('#' + 'fourcomment' + clicked_id).html(data.comment);
                           $('.like_count_ext' + clicked_id).html(data.commentcount);
                          }
                   });
               }
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<!--comment insert script end -->
<!-- comment edit script start -->
<!-- comment edit box start-->
<script type="text/javascript">
   function comment_editbox(clicked_id) {
       document.getElementById('editcomment' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcomment' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit' + clicked_id).style.display = 'inline-block';
       //document.getElementById('editbox' + clicked_id).style.display = 'none';
       document.getElementById('editcommentbox' + clicked_id).style.display = 'none';
       document.getElementById('editcancle' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancle(clicked_id) {
       document.getElementById('editcommentbox' + clicked_id).style.display = 'block';
       document.getElementById('editcancle' + clicked_id).style.display = 'none';
       document.getElementById('editcomment' + clicked_id).style.display = 'none';
       document.getElementById('showcomment' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   }
   
   function comment_editboxtwo(clicked_id) {
       //                            alert('editcommentboxtwo' + clicked_id);
       //                            return false;
       $('div[id^=editcommenttwo]').css('display', 'none');
       $('div[id^=showcommenttwo]').css('display', 'block');
       $('button[id^=editsubmittwo]').css('display', 'none');
       $('div[id^=editcommentboxtwo]').css('display', 'block');
       $('div[id^=editcancletwo]').css('display', 'none');
   
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'none';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancletwo(clicked_id) {
   
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'block';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'none';
   
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'block';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'none';
       $('.post-design-commnet-box').show();
   }
   
   function comment_editbox3(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
       document.getElementById('editcomment3' + clicked_id).style.display = 'block';
       document.getElementById('showcomment3' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit3' + clicked_id).style.display = 'block';
   
       document.getElementById('editcommentbox3' + clicked_id).style.display = 'none';
       document.getElementById('editcancle3' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   
   }
   
   function comment_editcancle3(clicked_id) {
   
       document.getElementById('editcommentbox3' + clicked_id).style.display = 'block';
       document.getElementById('editcancle3' + clicked_id).style.display = 'none';
   
       document.getElementById('editcomment3' + clicked_id).style.display = 'none';
       document.getElementById('showcomment3' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit3' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   
   }
   
   function comment_editbox4(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
       document.getElementById('editcomment4' + clicked_id).style.display = 'block';
       document.getElementById('showcomment4' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit4' + clicked_id).style.display = 'block';
   
       document.getElementById('editcommentbox4' + clicked_id).style.display = 'none';
       document.getElementById('editcancle4' + clicked_id).style.display = 'block';
   
       $('.post-design-commnet-box').hide();
   
   }
   
   function comment_editcancle4(clicked_id) {
   
       document.getElementById('editcommentbox4' + clicked_id).style.display = 'block';
       document.getElementById('editcancle4' + clicked_id).style.display = 'none';
   
       document.getElementById('editcomment4' + clicked_id).style.display = 'none';
       document.getElementById('showcomment4' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit4' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   
   }
</script>
<!--comment edit box end-->
<!-- comment edit insert start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   //                        function edit_comment(abc)
   //                        {
   //                            var $field = $('#editcomment' + abc);
   //                            var editpostdetails = $('#editcomment' + abc).html();
   //                            if (editpostdetails == '') {
   //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                $('#bidmodal').modal('show');
   //                            } else {
   //                                $.ajax({
   //                                    type: 'POST',
   //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                    data: 'post_id=' + abc + '&comment=' + editpostdetails,
   //                                    success: function (data) {
   //                                        document.getElementById('editcomment' + abc).style.display = 'none';
   //                                        document.getElementById('showcomment' + abc).style.display = 'block';
   //                                        document.getElementById('editsubmit' + abc).style.display = 'none';
   //                                        document.getElementById('editbox' + abc).style.display = 'block';
   //                                        document.getElementById('editcancle' + abc).style.display = 'none';
   //                                        $('#' + 'showcomment' + abc).html(data);
   //                                    }
   //                                });
   //                            }
   //                        }
   
   function edit_comment(abc)
   {
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcomment" + abc);
       var txt = sel.html();
   
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
           data: 'post_id=' + abc + '&comment=' + txt,
           success: function (data) {
               document.getElementById('editcomment' + abc).style.display = 'none';
               document.getElementById('showcomment' + abc).style.display = 'block';
               document.getElementById('editsubmit' + abc).style.display = 'none';
               document.getElementById('editcommentbox' + abc).style.display = 'block';
               document.getElementById('editcancle' + abc).style.display = 'none';
               $('#' + 'showcomment' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function commentedit(abc)
   //                        {
   //                                $('#editcomment' + abc).keypress(function (e) {
   //                                if (event.which == 13 && event.shiftKey != 1) {
   //                                    var $field = $('#editcomment' + abc);
   //                                    var editpostdetails = $('#editcomment' + abc).html();
   //                                    if (editpostdetails == '') {
   //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                        $('#bidmodal').modal('show');
   //                                    } else {
   //                                        $.ajax({
   //                                            type: 'POST',
   //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                            data: 'post_id=' + abc + '&comment=' + editpostdetails,
   //                                            success: function (data) {
   //                                                document.getElementById('editcomment' + abc).style.display = 'none';
   //                                                document.getElementById('showcomment' + abc).style.display = 'block';
   //                                                document.getElementById('editsubmit' + abc).style.display = 'none';
   //                                                document.getElementById('editbox' + abc).style.display = 'block';
   //                                                document.getElementById('editcancle' + abc).style.display = 'none';
   //                                                $('#' + 'showcomment' + abc).html(data);
   //                                            }
   //                                        });
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   function commentedit(abc)
   {
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
       $('#editcomment' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcomment" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   //                                       
   
               if (window.preventDuplicateKeyPresses)
                   return;
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                   data: 'post_id=' + abc + '&comment=' + txt,
                   success: function (data) {
                       document.getElementById('editcomment' + abc).style.display = 'none';
                       document.getElementById('showcomment' + abc).style.display = 'block';
                       document.getElementById('editsubmit' + abc).style.display = 'none';
                       document.getElementById('editcommentbox' + abc).style.display = 'block';
                       document.getElementById('editcancle' + abc).style.display = 'none';
                       $('#' + 'showcomment' + abc).html(data);
                       $('.post-design-commnet-box').show();
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function edit_commenttwo(abc)
   //                        {
   //                            var post_comment_edit = document.getElementById("editcommenttwo" + abc);
   //                            if (post_comment_edit.value == '') {
   //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                $('#bidmodal').modal('show');
   //                            } else {
   //                                $.ajax({
   //                                    type: 'POST',
   //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                    data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
   //                                    success: function (data) {
   //                                        document.getElementById('showcommenttwo' + abc).style.display = 'block';
   //                                        document.getElementById('showcommenttwo' + abc).innerHTML = data;
   //                                        document.getElementById('editboxtwo' + abc).style.display = 'block';
   //                                        document.getElementById('editcommenttwo' + abc).style.display = 'none';
   //                                        document.getElementById('editsubmittwo' + abc).style.display = 'none';
   //                                        document.getElementById('editcancletwo' + abc).style.display = 'none';
   //                                    }
   //                                });
   //                            }
   //                        }
   
   function edit_commenttwo(abc)
   {
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcommenttwo" + abc);
       var txt = sel.html();
   
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
           data: 'post_id=' + abc + '&comment=' + txt,
           success: function (data) {
               document.getElementById('editcommenttwo' + abc).style.display = 'none';
               document.getElementById('showcommenttwo' + abc).style.display = 'block';
               document.getElementById('editsubmittwo' + abc).style.display = 'none';
               document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
               document.getElementById('editcancletwo' + abc).style.display = 'none';
               $('#' + 'showcommenttwo' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function commentedittwo(abc)
   //                        {
   //                            $('#editcommenttwo' + abc).keypress(function (e) {
   //                                if (e.which == 13) {
   //                                    var val = $('#editcommenttwo' + abc).val();
   //
   //                                    if (val == '') {
   //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                        $('#bidmodal').modal('show');
   //                                    } else {
   //                                        $.ajax({
   //                                            type: 'POST',
   //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                            data: 'post_id=' + abc + '&comment=' + val,
   //                                            success: function (data) {
   //                                                document.getElementById('editcommenttwo' + abc).style.display = 'none';
   //                                                document.getElementById('showcommenttwo' + abc).style.display = 'block';
   //                                                document.getElementById('editsubmittwo' + abc).style.display = 'none';
   //                                                document.getElementById('editboxtwo' + abc).style.display = 'block';
   //                                                document.getElementById('editcancletwo' + abc).style.display = 'none';
   //                                                $('#' + 'showcommenttwo' + abc).html(data);
   //                                            }
   //                                        });
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   function commentedittwo(abc)
   {
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //$(this).html("");
       });
       $('#editcommenttwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcommenttwo" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                   data: 'post_id=' + abc + '&comment=' + txt,
                   success: function (data) {
                       document.getElementById('editcommenttwo' + abc).style.display = 'none';
                       document.getElementById('showcommenttwo' + abc).style.display = 'block';
                       document.getElementById('editsubmittwo' + abc).style.display = 'none';
   
                       document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                       document.getElementById('editcancletwo' + abc).style.display = 'none';
   
                       $('#' + 'showcommenttwo' + abc).html(data);
                       $('.post-design-commnet-box').show();
   
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<!--comment edit insert script end -->
<!-- hide and show data start-->
<script type="text/javascript">
   function commentall(clicked_id) {
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
       var z = document.getElementById('insertcount' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           x.style.display = 'none';
           y.style.display = 'block';
           z.style.visibility = 'show';
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/fourcomment" ?>',
               data: 'art_post_id=' + clicked_id,
               //alert(data);
               success: function (data) {
                   $('#' + 'fourcomment' + clicked_id).html(data);
               }
           });
       }
       // } else {
       //      x.style.display = 'block';
       //      y.style.display = 'block';
       //      z.style.display = 'block';
   
       //      $.ajax({ 
       //             type:'POST',
       //             url:'<?php echo base_url() . "artistic/fourcomment" ?>',
       //             data:'art_post_id='+clicked_id,
       //             //alert(data);
       //             success:function(data){
       //       $('#' + 'threecomment' + clicked_id).html(data);
   
       //       }
       //         });
       // }
   }
</script>
<!-- hide and show data end-->
<!-- popup box for post start -->
<script>
   // Get the modal
   var modal = document.getElementById('myModal');
   
   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");
   
   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close1")[0];
   
   // When the user clicks the button, open the modal 
   btn.onclick = function () {
       modal.style.display = "block";
   }
   
   // When the user clicks on <span> (x), close the modal
   span.onclick = function () {
       modal.style.display = "none";
   }
   
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function (event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }
</script>
<!-- popup form end-->
<script>
   /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
   function myFunction(clicked_id) {
   
        document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
    
         $( document ).on( 'keydown', function ( e ) {
                   if ( e.keyCode === 27 ) { 
   
                   document.getElementById('myDropdown' + clicked_id).classList.toggle("hide");
                    $(".dropdown-content1").removeClass('show');
   
       }
      
   }); 
   
   }
   
   // Close the dropdown if the user clicks outside of it
   window.onclick = function (event) {
       if (!event.target.matches('.dropbtn1')) {
   
           var dropdowns = document.getElementsByClassName("dropdown-content1");
           var i;
           for (i = 0; i < dropdowns.length; i++) {
               var openDropdown = dropdowns[i];
               if (openDropdown.classList.contains('show')) {
                   openDropdown.classList.remove('show');
               }
           }
       }
   }
   
   
</script>
<!-- further and less -->
<!--  <script>
   $(function () {
       var showTotalChar = 200, showChar = "Read More", hideChar = "";
       $('.show').each(function () {
           //var content = $(this).text();
           var content = $(this).html();
           if (content.length > showTotalChar) {
               var con = content.substr(0, showTotalChar);
               var hcon = content.substr(showTotalChar, content.length - showTotalChar);
               var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
               $(this).html(txt);
           }
       });
       $(".showmoretxt").click(function () {
           if ($(this).hasClass("sample")) {
               $(this).removeClass("sample");
               $(this).text(showChar);
           } else {
               $(this).addClass("sample");
               $(this).text(hideChar);
           }
           $(this).parent().prev().toggle();
           $(this).prev().toggle();
           return false;
       });
   });
   </script> -->
<!-- multi image add post khyati start -->
<script type="text/javascript">
   //alert("a");
   var $fileUpload = $("#files"),
           $list = $('#list'),
           thumbsArray = [],
           maxUpload = 10;
   
   // READ FILE + CREATE IMAGE
   function read(f) {//alert("aa");
       return function (e) {
           var base64 = e.target.result;
           var $img = $('<img/>', {
               src: base64,
               title: encodeURIComponent(f.name), //( escape() is deprecated! )
               "class": "thumb"
           });
           var $thumbParent = $("<span/>", {html: $img, "class": "thumbParent"}).append('<span class="remove_thumb"/>');
           thumbsArray.push(base64); // Push base64 image into array or whatever.
           $list.append($thumbParent);
       };
   }
   
   // HANDLE FILE/S UPLOAD
   function handleFileSelect(e) {//alert("aaa");
       e.preventDefault(); // Needed?
       var files = e.target.files;
       var len = files.length;
       if (len > maxUpload || thumbsArray.length >= maxUpload) {
           return alert("Sorry you can upload only 5 images");
       }
       for (var i = 0; i < len; i++) {
           var f = files[i];
           if (!f.type.match('image.*'))
               continue; // Only images allowed    
           var reader = new FileReader();
           reader.onload = read(f); // Call read() function
           reader.readAsDataURL(f);
       }
   }
   
   $fileUpload.change(function (e) {//alert("aaaa");
       handleFileSelect(e);
   });
   
   $list.on('click', '.remove_thumb', function () {//alert("aaaaa");
       var $removeBtns = $('.remove_thumb'); // Get all of them in collection
       var idx = $removeBtns.index(this);   // Exact Index-from-collection
       $(this).closest('span.thumbParent').remove(); // Remove tumbnail parent
       thumbsArray.splice(idx, 1); // Remove from array
   });
   
   
   
</script>
<!-- multi image add post khyati end -->
<!-- success message remove after some second start -->
<script type="text/javascript">
   $(document).ready(function () {
   
       $('.alert-danger').delay(3000).hide('700');
   
       $('.alert-success').delay(3000).hide('700');
   
   });
   
</script>
<!-- success message remove after some second end -->
<!-- edit post start -->
<!-- <script type="text/javascript">
   function editpost(abc)
   {
       document.getElementById('editpostdata' + abc).style.display = 'none';
       document.getElementById('editpostbox' + abc).style.display = 'block';
       //document.getElementById('editpostdetails' + abc).style.display = 'none', 'display:inline !important';
       document.getElementById('editpostdetailbox' + abc).style.display = 'block';
       document.getElementById('editpostsubmit' + abc).style.display = 'block';
       document.getElementById('khyati' + abc).style.display = 'none';
   }
</script>
<script type="text/javascript">
   function edit_postinsert(abc)
   {
   
       var editpostname = document.getElementById("editpostname" + abc);
       // var editpostdetails = document.getElementById("editpostdesc" + abc);
       // start khyati code
       var $field = $('#editpostdesc' + abc);
       //var data = $field.val();
       var editpostdetails = $('#editpostdesc' + abc).html();
       // end khyati code
   
       if ((editpostname.value == '') && (editpostdetails == '' || editpostdetails == '<br>')) {
           $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
           $('#bidmodal').modal('show');
   
           document.getElementById('editpostdata' + abc).style.display = 'block';
           document.getElementById('editpostbox' + abc).style.display = 'none';
         //  document.getElementById('editpostdetails' + abc).style.display = 'block';
           document.getElementById('editpostdetailbox' + abc).style.display = 'none';
   
           document.getElementById('editpostsubmit' + abc).style.display = 'none';
       } else {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_post_insert" ?>',
               data: 'art_post_id=' + abc + '&art_post=' + editpostname.value + '&art_description=' + editpostdetails,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                   //alert(data.description);
                   document.getElementById('khyati').style.display = 'block';
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyati').html(data.description);
                 
               }
           });
       }
   
   }
</script>
<!- edit post end --> 
<!-- save post start -->
<script>
   function save_post(abc)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/artistic_save" ?>',
           data: 'art_post_id=' + abc,
           success: function (data) {
   
               $('.' + 'savedpost' + abc).html(data);
               //window.setTimeout(update, 10000);
   
           }
       });
   
   }
</script>
<!-- save post end -->
<!-- remove save post start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   function deleteownpostmodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this post?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='remove_post(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function remove_post(abc)
   { 
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/art_delete_post" ?>',
           dataType: 'json',
           data: 'art_post_id=' + abc,
           //alert(data);
           success: function (data) { 
   
               $('#' + 'removepost' + abc).remove();
               if(data.notcount == 'count'){
                    $('.' + 'nofoundpost').html(data.notfound);
                   }

   
   
           }
       });
   
   }
</script>
<!-- remove save post end -->
<!-- remove particular user post start -->
<script type="text/javascript">
   function deletepostmodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this post from your profile?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='del_particular_userpost(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function del_particular_userpost(abc)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/del_particular_userpost" ?>',
           dataType: 'json',
           data: 'art_post_id=' + abc,
           //alert(data);
           success: function (data) {
   
               $('#' + 'removepost' + abc).remove();
               if(data.notcount == 'count'){
                    $('.' + 'nofoundpost').html(data.notfound);
                   }

   
   
           }
       });
   
   }
   
</script>
<!-- remove particular user post end -->
<!-- follow user script start -->
<script type="text/javascript">
   function followuser(clicked_id)
   {
   
       $("#fad" + clicked_id).fadeOut(6000);
   
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/follow" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
               $('.' + 'fr' + clicked_id).html(data);
   
           }
   
   
       });
   
   }
   
</script>
<script type="text/javascript">
   function followclose(clicked_id)
   {
       $("#fad" + clicked_id).fadeOut(3000);
   }
</script>
<!--follow like script end -->
<!-- insert post validtation start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   function imgval(event) {
       //var fileInput = document.getElementById('test-upload');
       var fileInput = document.getElementById("file-1").files;
       var product_name = document.getElementById("test-upload_product").value;
       var product_description = document.getElementById("test-upload_des").value;
       var product_fileInput = document.getElementById("file-1").value;
   
   
       if (product_fileInput == '' && product_name == '' && product_description == '')
       {
   
           $('#post .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
            $('#post').modal('show');
           // setInterval('window.location.reload()', 10000);
           // window.location='';
   
            $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
           event.preventDefault();
           return false;
   
       } else {
   
   
           for (var i = 0; i < fileInput.length; i++)
           {
               var vname = fileInput[i].name;
               var vfirstname = fileInput[0].name;
               var ext = vfirstname.split('.').pop();
               var ext1 = vname.split('.').pop();
               var allowedExtensions = ['jpg', 'jpeg', 'PNG', 'gif'];
               var allowesvideo = ['mp4', 'webm'];
               var allowesaudio = ['mp3'];
               var allowespdf = ['pdf'];
   
               var foundPresent = $.inArray(ext, allowedExtensions) > -1;
               var foundPresentvideo = $.inArray(ext, allowesvideo) > -1;
               var foundPresentaudio = $.inArray(ext, allowesaudio) > -1;
               var foundPresentpdf = $.inArray(ext, allowespdf) > -1;
   
               if (foundPresent == true)
               {
                   var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;
   
                   if (foundPresent1 == true && fileInput.length <= 10) {
                   } else {
   
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       setInterval('window.location.reload()', 10000);
                       // window.location='';
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
   
               } else if (foundPresentvideo == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowesvideo) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {
                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
               } else if (foundPresentaudio == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowesaudio) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {
                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
   
                       event.preventDefault();
                       return false;
                   }
               } else if (foundPresentpdf == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowespdf) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {
   
                       if (product_name == '') {
                           $('#post .mes').html("<div class='pop_content'>You have to add pdf title.");
                           $('#post').modal('show');
                           setInterval('window.location.reload()', 10000);
                            $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                           event.preventDefault();
                           return false;
                       }
                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
               } else if (foundPresentvideo == false) {
   
                   $('#post .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files..");
                   $('#post').modal('show');
                   setInterval('window.location.reload()', 10000);
   
                    $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                   event.preventDefault();
                   return false;
   
               }
   
           }
       }
   }
   
</script>
<script type="text/javascript">
   //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open start
                $(document).ready(function () {
                    $('#post').on('click', function () {

                        $('.modal-post').show();
                       //  location.reload(false);
                    });
                });
  //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open end  
   
</script>
<!-- insert validation end -->
<!-- 
   textarea js -->
<script type="text/javascript">
   function contentedit(clicked_id) {
       //var $field = $('#post_comment' + clicked_id);
       //var data = $field.val();
       // var post_comment = $('#post_comment' + clicked_id).html();
       //$(document).ready(function($) {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
       $("#post_comment" + clicked_id).keypress(function (event) { //alert(post_comment);
           if (event.which == 13 && event.shiftKey != 1) { //alert(post_comment);
               event.preventDefault();
               var sel = $("#post_comment" + clicked_id);
               var txt = sel.html();
   
               $('#post_comment' + clicked_id).html("");
               // $("#result").html(txt);
               // sel.html("")
               // sel.blur();
               //alert('.insertcomment' + clicked_id);
               var x = document.getElementById('threecomment' + clicked_id);
               var y = document.getElementById('fourcomment' + clicked_id);
               if (txt == '') {
                   event.preventDefault();
                   return false;
               } else {
                   if (x.style.display === 'block' && y.style.display === 'none') {
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                           data: 'post_id=' + clicked_id + '&comment=' + txt,
                           dataType: "json",
                           success: function (data) {
   
                               //  $('.insertcomment' + clicked_id).html(data);
                               $('#' + 'insertcount' + clicked_id).html(data.count);
                               $('.insertcomment' + clicked_id).html(data.comment);
   
                           }
                       });
   
                   } else {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                           data: 'post_id=' + clicked_id + '&comment=' + txt,
                           // dataType: "json",
                           success: function (data) {
                               $('#' + 'fourcomment' + clicked_id).html(data);
                               // $('#' + 'insertcount' + clicked_id).html(data.count);
                               //  $('#' + 'fourcomment' + clicked_id).html(data.comment);
   
                           }
                       });
                   }
               }
   
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   
       // });
   
   }
</script>
<script type="text/javascript">
   function likeuserlist(post_id) {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/likeuserlist" ?>',
           data: 'post_id=' + post_id,
           dataType: "html",
           success: function (data) {
               var html_data = data;
               $('#likeusermodal .mes').html(html_data);
               $('#likeusermodal').modal('show');
           }
       });
   
   
   }
</script>
<style type="text/css">
   .likeduser{
   width: 100%;
   background-color: #1b8ab9;
   }
   .likeduser-title{
   color: #fff;
   margin-bottom: 5px;
   padding: 7px;
   }
   .likeuser_list{
   background-color: #ccc;
   float: left;
   margin: 0px 6px 5px 9px;
   padding: 5px;
   width: 47%;
   font-size: 14px;
   }
   .likeduserlist, .likeduserlist1 {
   float: left;
   background-color: #fff!important;
   /*        margin-left: 15px;
   margin-right: 15px;*/
   width: 100%!important;
   }
   div[class^="likeduserlist"]{
   width: 100% !important;
   background-color: #fff !important;
   }
   /*.like_one_other{
   margin-left: 15px;*/
   /*  margin-right: 15px;*/
   /*}*/
</style>
<!-- This  script use for close dropdown in every post -->
<script type="text/javascript">
   $('body').on("click", "*", function (e) {
       var classNames = $(e.target).attr("class").toString().split(' ').pop();
       if (classNames != 'fa-ellipsis-v') {
           $('div[id^=myDropdown]').hide().removeClass('show');
       }
   
   });
   
</script>
<!-- This  script use for close dropdown in every post -->
<!-- multi image add post khyati end -->
<script language=JavaScript>
   function check_length(my_form)
   {
       maxLen = 50;
   
       // max number of characters allowed
       if (my_form.my_text.value.length >= maxLen) {
           // Alert message if maximum limit is reached. 
           // If required Alert can be removed. 
           var msg = "You have reached your maximum limit of characters allowed";
           //    alert(msg);
           //my_form.text_num.value = maxLen - my_form.my_text.value.length;
           $('#post .mes').html("<div class='pop_content'>" + msg + "</div>");
           $('#post').modal('show');
           // Reached the Maximum length so trim the textarea
           my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
       } else { //alert("1");
           // Maximum length not reached so update the value of my_text counter
           my_form.text_num.value = maxLen - my_form.my_text.value.length;
       }
   }
   //-->
</script>
<!--- khyati change end-->
<script type="text/javascript">
   // all popup close close using esc start
      
    $( document ).on( 'keydown', function ( e ) {
       if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
           $('#likeusermodal').modal('hide');
       }
   });  
      
   $(document).on('keydown', function (e) { 
       if (e.keyCode === 27) {
           if($('.modal-post').show()){
   
             $( document ).on( 'keydown', function ( e ) {
             if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
          $('.modal-post').hide();

           }
          });  
        
   
           }
            document.getElementById('myModal').style.display = "none";
            }
    });





   $( document ).on( 'keydown', function ( e ) {
       if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
           $('#post').modal('hide');
            $('.modal-post').show();

       }
   });  
    
   
   //all popup close close using esc end
   
    // pop up open & close aarati code start 
   jQuery(document).mouseup(function (e) {
               
                var container1 = $("#myModal");
               
                       jQuery(document).mouseup(function (e)
                         {
                           var container = $("#close");
   
             
                   if (!container.is(e.target) // if the target of the click isn't the container...
                   && container.has(e.target).length === 0) // ... nor a descendant of the container
               {
                 
                   container1.hide();
               }
           });
                  
           });
   
   // pop up open & close aarati code end
   
</script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->
<!-- script for skill textbox automatic end (option 2)-->
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#tags").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#tags").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#tags").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#searchplace").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data1, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>

<!--- khyati chnage ssstart 24-6 -->

<script type="text/javascript">
    
     function khdiv(abc) {
         
         $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_more_insert" ?>',
               data: 'art_post_id=' + abc,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                     document.getElementById('khyati' + abc).style.display = 'none';
                 document.getElementById('khyatii' + abc).style.display = 'block';
                   //alert(data.description);
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyatii' + abc).html(data.description);
                 
               }
           });
   
   }
   
   </script>
   
   <script type="text/javascript">
   function editpost(abc)
   {
       document.getElementById('editpostdata' + abc).style.display = 'none';
       document.getElementById('editpostbox' + abc).style.display = 'block';
       //document.getElementById('editpostdetails' + abc).style.display = 'none', 'display:inline !important';
       document.getElementById('editpostdetailbox' + abc).style.display = 'block';
       document.getElementById('editpostsubmit' + abc).style.display = 'block';
       document.getElementById('khyati' + abc).style.display = 'none';
       document.getElementById('khyatii' + abc).style.display = 'none';

   }
</script>
<script type="text/javascript">
   function edit_postinsert(abc)
   {
   
       var editpostname = document.getElementById("editpostname" + abc);
       // var editpostdetails = document.getElementById("editpostdesc" + abc);
       // start khyati code
       var $field = $('#editpostdesc' + abc);
       //var data = $field.val();
       var editpostdetails = $('#editpostdesc' + abc).html();
       // end khyati code
   
       if ((editpostname.value == '') && (editpostdetails == '' || editpostdetails == '<br>')) {
           $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
           $('#bidmodal').modal('show');
   
           document.getElementById('editpostdata' + abc).style.display = 'block';
           document.getElementById('editpostbox' + abc).style.display = 'none';
         //  document.getElementById('editpostdetails' + abc).style.display = 'block';
           document.getElementById('editpostdetailbox' + abc).style.display = 'none';
   
           document.getElementById('editpostsubmit' + abc).style.display = 'none';
       } else {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_post_insert" ?>',
               data: 'art_post_id=' + abc + '&art_post=' + editpostname.value + '&art_description=' + editpostdetails,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                   //alert(data.description);
                   document.getElementById('khyati' + abc).style.display = 'block';
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyati' + abc).html(data.description);
                 
               }
           });
       }
   
   }
</script>
<!--- khyati chnage end 24-6 -->



<!-- all popup close close using esc start -->
<script type="text/javascript">

    $('#post').on('click', function(){
        $('#myModal').modal('show');
    });
    
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
