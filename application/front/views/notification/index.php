<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->

<body class="page-container-bg-solid page-boxed">

    <?php echo $dash_header; ?>
    <!-- BEGIN HEADER MENU -->
    <?php echo $dash_header_menu; ?>

    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->

<div class="user-midd-section" id="paddingtop_fixed">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1">
            </div>
            <div class="col-md-10 col-sm-10">
                <div class="common-form">

                    <div class="job-saved-box">
                        <h3>View Notification</h3>

                        <!-- BEGIN CONTAINER -->
                        <!--  <div class="page-container">
                        -->     <!-- BEGIN CONTENT -->
                        <!--  <div class="page-content-wrapper">
                        -->     <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <!-- <div class="page-head">
                        --> <!--        <div class="container">
                        -->           <!-- BEGIN PAGE TITLE -->
                        <!--                 <div class="page-title">
                        -->                  <!--   <h1>Notification List</h1>
                        -->
                        <!--         <div id="notificationsBody" class="notifications">
        <div class="notification-data">
          <ul> -->
                        
                        <div class="notification-box bg">

                            <ul>
                            <div class="common-form">
                           <div class="">

<?php if(count($totalnotification) == 0){?>
                              <div class="all-box">
                                 <ul>
                                    <div class="main_pdf_box">
                                       <div class=" ">
                                          <img src="img/icon_notification_big.png">
                                          <div>
                                             <div class="not_txt"> No Notifications</div>
                                          </div>
                                       </div>
                                    </div>
                                    </ul>
                              </div>
                             
                              <?php }?>
                              <!-- silder start -->
                              <div id="myModal1" class="modal2">
                                 <div class="modal-content2">
                                    <span class="close2 cursor" onclick="closeModal()">×</span>
                                    <!--  multiple image start -->
                                                                        <!-- slider image rotation end  -->
                                    <a class="prev" style="left: 0px" onclick="plusSlides(-1)">�?�</a>
                                    <a class="next" style="right: 0px" onclick="plusSlides(1)">�?�</a>
                                    <div class="caption-container">
                                       <p id="caption"></p>
                                    </div>
                                 </div>
                              </div>
                              <!-- slider end -->
                           </div>
                        </div>






                                <?php
                                foreach ($totalnotification as $total) { 
                                 $abc = $total['not_id'];
                               //1 
                                    if ($total['not_from'] == 1) { 
                                      $companyname = $this->db->get_where('recruiter', array('user_id' => $total['user_id']))->row()->re_comp_name;  ?> 
                                       <a href="<?php echo base_url('notification/recruiter_post/' . $total['post_id']); ?>">
                                        <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>"> 
                                        
                                            <div class="notification-pic" id="noti_pc" >
                                            <?php   
                                                                                      
                                         $filepath = FCPATH . $this->config->item('rec_profile_thumb_upload_path') . $total['user_image'];
                                        
                                          
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('rec_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
                                                   
                                                <?php     } ?>    
                                            </div>
                                           
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b><i> Recruiter</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b>  From " . ucwords($companyname) . "  Invited you for an interview."; ?></h6>
                                              <div  class="hout_noti">
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            

                                        </li>
                                        </a>
                                        <?php
                                    }
                             
                                ?>

                                <?php
                            //   2
                                    if ($total['not_from'] == 3 && $total['not_img'] == 0) {
                                        ?>
                                        <a href="<?php echo base_url('artistic/artistic_profile/' . $total['user_id']); ?>">
                                        <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>"> 
                                        
                                            <div class="notification-pic" id="noti_pc">
                                             <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
                                                  
                                                <?php     } ?>
                                               <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Started following you in artistic."; ?></h6>
                                             <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php
                                    }
                         
                                ?>

                                <?php
                               // 3
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 1) {
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                             
                                                <div class="notification-pic" id="noti_pc">
                             <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>                               
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Commented on your post in artistic."; ?></h6>
                                                    <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php } 
                                            
                                       
                                    }
                              
                                ?>

                                <?php 
                               // 4
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 2) { 
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>"> 
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                               <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>  
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes your post in artistic."; ?></h6>
                                                    <div  class="hout_noti">
                                                        <?php   echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                       
                                        <?php 
                                        }  
                                       }
                               
                                ?> 
                                            
                                            <?php
                                //5
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 3) {
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                
                                                    
                                                     <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes your post's comment in artistic."; ?></h6>
                                                  <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php }
                                  
                                } ?>
                                            
                                            <?php
                             //   6
                                    if ($total['not_from'] == 3) {
                                      if ($total['not_img'] == 5) {   ?>
                                      <a href="<?php echo base_url('notification/art_post_img/' . $total['post_id'] . '/' . $total['image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>"> 
                                            
                                                <div class="notification-pic"  id="noti_pc">
                                       <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>           
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes your photo in artistic."; ?></h6>
                                                    <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }

                                }
                                ?>
                                            
                                            <?php
//7
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id; ?>
         <a href="<?php echo base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                         <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>     
                                                <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Commneted on your photo in artistic."; ?></h6>
                                                <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                               
                                }
                                ?>
                                        
                                        
                                        <?php
                          //   8
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 6) {
       $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id; ?>
       <a href="<?php echo base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                            <div class="notification-pic" id="noti_pc">
                                                <?php    $filepath = FCPATH . $this->config->item('art_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes your photo's comment in artistic."; ?></h6>
                                                <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                       
                                }
                                ?>
                                
                                <?php
                                     $bus_from1 = $total['not_from'];
                                     $bus_img1 = $total['not_img'];

                                    if ($bus_from1 == '6' && $bus_img1 == '1') {
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                        ?>
                                        <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>"  onClick="not_active(<?php echo $total['not_id']; ?>)">
                                        <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                        
                                            <div class="notification-pic" id="noti_pc" >
                                                
                                              <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                    
<!--                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname) . "</b> Commented on your post in business profile."; ?></h6>
                                              <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php
                                    } 
                                        ?>
                                        
                                        <?php
                                   

                                ?>
                                        
                                        <?php
                                        //10
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
          $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;?>
          <a href="<?php echo base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                    <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>        
                                                <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname)  . "</b> Commented on your photo in business profile."; ?></h6>
                                                <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                           
                                        </li>
                                         </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                    }

                                ?>
                                        
                                        <?php
                                 //11
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 6) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;?>
         <a href="<?php echo base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                           <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>  
                                                <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes your photo's comment in business profile."; ?></h6>
                                               <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                }
                                ?>

                 
                                <?php
                         
                         //12
                                    if ($total['not_from'] == 6 && $total['not_img'] == 0) {
                                        $id = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->business_slug;
                                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                        if ($id) {
                                            ?>
                                             <a href="<?php echo base_url('business_profile/business_resume/' . $id); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                               <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                   
                                                </div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Started following you in business profile."; ?></h6>
                                                  <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a> 
                                            <?php
                                        }
                                    }
                                ?>

                                <?php
                            //  13
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 2) {
                                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                            ?>
                                            <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                        <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                 <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
              <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>

                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                            
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes your post in business profile."; ?></h6>
                                                   <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                    }
                             
                                ?>
                                 <?php
                             // 14
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 3) { 
                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;              
                                          ?>
                                          <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                             <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>   
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes your post's comment in business profile."; ?></h6>
                                               <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }
                                    }
                             
                                ?>
                                            
                                            <?php
                             // 15
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 5) { 
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;        
                                          ?>
                                           <a href="<?php echo base_url('notification/bus_post_img/' . $total['post_id'] . '/' . $total['image_id']); ?>">
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                <?php    $filepath = FCPATH . $this->config->item('bus_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                  <?php    } else { 
                                                                    $a = $companyname;
                                                                    $acr = substr($a, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes your photo in business profile."; ?></h6>
                                                 <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }
                                    }

                                ?>
                                <?php
                              //  17
                                    if ($total['not_from'] == 2) {

                                        $id = $this->db->get_where('job_reg', array('user_id' => $total['not_to_id']))->row()->job_id;
                                        if ($id) {
                                            ?>
                                            <a href="<?php echo base_url('job/job_printpreview/' . $total['not_from_id'].'?page=recruiter'); ?>"> 
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                 <?php    $filepath = FCPATH . $this->config->item('job_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                               <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr); ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b><i> Job Seeker</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Aplied on your job post."; ?></h6>
                                                <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                        }
                                    }
                              
                                ?>

                              

                                <?php
                                
                             //   foreach ($work_not as $art) {
                                    if ($total['not_from'] == 5) {
                                  //    19
                                            ?>
                                            <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $total['user_id'].'?page=freelancer_post'); ?>"> 
                                            <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                  <?php    $filepath = FCPATH . $this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('free_hire_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                 <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr); ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                    <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<font color='black'><b><i>Employer</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Selected you for project."; ?></h6>
                                                 <div  class="hout_noti">
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                        }
                                //    }
                             //   }
                                ?>

                                <?php
                               //20
                                   if ($total['not_from'] == 4) {
                                        ?> 
                                        <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $total['not_from_id']); ?>">
                                        <li class="<?php if ($total['not_active'] == 1){ echo 'active2'; } ?>">
                                         
                                            <div class="notification-pic" id="noti_pc" >
                                               <?php    $filepath = FCPATH . $this->config->item('free_post_profile_thumb_upload_path') . $total['user_image'];
                                        
                                            if ($total['user_image'] && (file_exists($filepath)) == 1){ ?>
                                                    <img src="<?php echo base_url($this->config->item('free_post_profile_thumb_upload_path') . $total['user_image']); ?>" >
                                                  <?php    } else { 
                                                                    $a = $total['first_name'];
                                                                    $b = $total['last_name'];
                                                                    $acr = substr($a, 0, 1);
                                                                    $bcr = substr($b, 0, 1);
                                                                    
                                                                    ?>
                                                                    <div class="post-img-div">
                                                                        <?php echo ucwords($acr) . ucwords($bcr); ?>
                                                                    </div>
<!--                                                   
                                                <?php     } ?>
                                                <!--<img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >-->
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<font color='black'><b><i>Freelancer</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Applied on your post."; ?></h6>
                                             <div  class="hout_noti">
                                                    <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        
                                        <?php
                                   }
                               }
                                ?>
                            </ul>
                        </div>  

                    </div>
                </div>  

            </div>           </div>
        <!-- END PAGE TITLE 
    </div>
</div>
<!-- END PAGE HEAD-->
<!-- BEGIN PAGE CONTENT BODY -->
<div class="page-content">
    <div class="container">
        <!-- BEGIN PAGE BREADCRUMBS -->
        <!-- <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.html">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Layouts</span>
            </li>
        </ul> -->
        <!-- END PAGE BREADCRUMBS -->
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT BODY -->
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<?php echo $footer; ?>

<script type="text/javascript">
   function not_active(not_id)
   { 
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "notification/not_active" ?>',
           data: 'not_id=' + not_id,
           success: function (data) {
              }
          });
      }
   
</script>
    