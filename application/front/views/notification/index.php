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
<style type="text/css">
    #noti_pc{ margin-bottom: 5px;
    border-radius: 50%;
    margin-left: 10px;
    display: inline-block;
    
    margin-top: 5px;   }
    .job-saved-box .notification-box ul li{display: flex!important;}
    #notification_inside{ margin-left: 0px; margin-top: 0px;   padding: 5px 10px 9px 10px;
    margin-left: 11px;
    display: inline-block;}
    #noti_pc img{border-radius: none;}
      #notification_inside h6{font-size: 17px;}
</style>
<div class="user-midd-section" id="paddingtop_fixed">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1">
            </div>
            <div class="col-md-10 col-sm-10">
                <div class="common-form">

                    <div class="job-saved-box" style="border: 1px solid #d9d9d9;">
                        <h3 style="    -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
    box-shadow: inset 0px 1px 0px 0px #ffffff;
    border-bottom: 1px solid #d9d9d9;
    padding-left: 24px;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
    background: -moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
    background-color: #f9f9f9;font-weight: 600;
    color: #000033;">Notification</h3>

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

                        <div class="notification-box">

                            <ul>
                                <?php
                                foreach ($totalnotification as $total) { 
                                    if ($total['not_from'] == 1) {
                                      $companyname = $this->db->get_where('recruiter', array('user_id' => $total['user_id']))->row()->re_comp_name;  ?> 
                                       <a href="<?php echo base_url('notification/recruiter_post/' . $total['post_id']); ?>">
                                        <li> 
                                        
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                           
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b><i> Recruiter</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b>  From " . ucwords($companyname) . "  Invited You For An Interview."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            

                                        </li>
                                        </a>
                                        <?php
                                    }
                              //  }
                                ?>

                                <?php
                            //    foreach ($artfollow as $art) {
                                    if ($total['not_from'] == 3 && $total['not_img'] == 0) {
                                        ?>
                                        <a href="<?php echo base_url('artistic/artistic_profile/' . $total['user_id']); ?>">
                                        <li> 
                                        
                                            <div class="notification-pic" id="noti_pc">
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Started Following You In Artistic."; ?></h6>
                                                <div><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php
                                    }
                              //  }
                                ?>

                                <?php
                               // foreach ($artcommnet as $art) {
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 1) {
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>">
                                            <li>
                                             
                                                <div class="notification-pic" id="noti_pc">
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Commented On Your Post In Artistic."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php } 
                                            
                                       
                                    }
                               // }
                                ?>

                                <?php
                               // foreach ($artlike as $art) { //echo '<pre>'; print_r($artlike); 
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 2) {
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>"> 
                                            <li>
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Post In Artistic."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php  echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php // } elseif ($art['not_img'] == 5) { ?>
<!--                                            <li> 
                                                <div class="notification-pic" >
                                                    <img src="<?php echo base_url(USERIMAGE . $art['user_image']); ?>" >
                                                </div>
                                                <div class="notification-data-inside">
                                                    <a href="<?php echo base_url('notification/art_post_img/' . $art['art_post_id']); ?>"><h6><?php echo "<font color='#4e6db1'><b><i> Artistic</i></font></b><b>" . "  " . $art['first_name'] . ' ' . $art['last_name'] . "</b> liked on your image"; ?></h6></a>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($art['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                            </li>-->
                                        <?php //} 
                                        }  
                                       }
                               // }
                                ?> 
                                            
                                            <?php
                                //foreach ($artcmtlike as $art) {
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 3) {
                                            ?>
                                            <a href="<?php echo base_url('notification/art_post/' . $total['art_post_id']); ?>">
                                            <li>
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Post's Comment In Artistic."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php }
                                  //  }
                                } ?>
                                            
                                            <?php
                             //   foreach ($artimglike as $bus) {
                                    if ($total['not_from'] == 3) {
                                      if ($total['not_img'] == 5) {   ?>
                                      <a href="<?php echo base_url('notification/art_post_img/' . $total['post_id'] . '/' . $total['image_id']); ?>">
                                            <li> 
                                            
                                                <div class="notification-pic"  id="noti_pc">
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Photo In Artistic."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }
                               //     }
                                }
                                ?>
                                            
                                            <?php
                             //   foreach ($artimgcommnet as $bus) {
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id; ?>
         <a href="<?php echo base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li>
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Commneted On Your Photo In Artistic."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                //    }
                                }
                                ?>
                                        
                                        
                                        <?php
                          //      foreach ($artimgcmtlike as $bus) { 
                                    if ($total['not_from'] == 3) {
                                        if ($total['not_img'] == 6) {
       $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id; ?>
       <a href="<?php echo base_url('notification/art_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li>
                                            
                                            <div class="notification-pic" id="noti_pc">
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Likes Your Photo's Comment In Artistic."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                  //  }
                                }
                                ?>
                                
                 

                                <?php
                              //  foreach ($buscommnet as $bus) {
                                     $bus_from1 = $total['not_from'];
                                     $bus_img1 = $total['not_img'];

                                    if ($bus_from1 == '6' && $bus_img1 == '1') {
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                        ?>
                                        <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>">
                                        <li>
                                        
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname) . "</b> Commented On Your Post In Business Profile."; ?></h6>
                                                <div><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php
                                    } 
                                        ?>
                                        
                                        <?php
                                   
                              //  }
                                ?>
                                        
                                        <?php
                             //   foreach ($busimgcommnet as $bus) {
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 4) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
          $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;?>
          <a href="<?php echo base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li>
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname)  . "</b> Commented On Your Photo In Business Profile."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                           
                                        </li>
                                         </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                    }
                              //  }
                                ?>
                                        
                                        <?php
                            //    foreach ($busimgcmtlike as $bus) {
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 6) {
         $postid = $this->db->get_where('post_image', array('image_id' => $total['post_image_id']))->row()->post_id;
         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;?>
         <a href="<?php echo base_url('notification/bus_post_img/' . $postid . '/' . $total['post_image_id']); ?>">
                                            <li>
                                            
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes Your Photo's Comment In Business Profile."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                //    }
                                }
                                ?>

                 
                                <?php
                           //     foreach ($busifollow as $bus) {
                                    if ($total['not_from'] == 6 && $total['not_img'] == 0) {
                                        $id = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->business_slug;
                                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                        if ($id) {
                                            ?>
                                             <a href="<?php echo base_url('business_profile/business_resume/' . $id); ?>">
                                            <li>
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Started Following You In Business Profile."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a> 
                                            <?php
                                        }
                                    }
                             //   }
                                ?>

                                <?php
                            //    foreach ($buslike as $bus) {
                                    if ($total['not_from'] == 6) {
                                        if ($total['not_img'] == 2) {
                                    $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;
                                            ?>
                                            <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>">
                                            <li>
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes Your Post In Business Profile."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                        <?php }  ?>
                                            
                                        <?php  
                                    }
                              //  }
                                ?>
                                 <?php
                             //   foreach ($buscmtlike as $bus) {
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 3) { 
                        $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;              
                                          ?>
                                          <a href="<?php echo base_url('notification/business_post/' . $total['business_profile_post_id']); ?>">
                                            <li>
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<<b>" . "  " . ucwords($companyname) .  "</b> Likes Your Post's Comment In Business Profile."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }
                                    }
                               // }
                                ?>
                                            
                                            <?php
                             //   foreach ($busimglike as $bus) {
                                    if ($total['not_from'] == 6) {
                                      if ($total['not_img'] == 5) { 
                                         $companyname = $this->db->get_where('business_profile', array('user_id' => $total['not_from_id']))->row()->company_name;        
                                          ?>
                                           <a href="<?php echo base_url('notification/bus_post_img/' . $total['post_id'] . '/' . $total['image_id']); ?>">
                                            <li>
                                             
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                               
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b>" . "  " . ucwords($companyname) .  "</b> Likes Your Photo In Business Profile."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                      }
                                    }
                             //   }
                                ?>
                                <?php
                              //  foreach ($rec_not as $art) {
                                    if ($total['not_from'] == 2) {

                                        $id = $this->db->get_where('job_reg', array('user_id' => $total['not_to_id']))->row()->job_id;
                                        if ($id) {
                                            ?>
                                            <a href="<?php echo base_url('job/job_printpreview/' . $total['not_from_id'].'?page=recruiter'); ?>"> 
                                            <li>
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<b><i> Job Seeker</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Aplied On Your Job Post."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                        }
                                    }
                               // }
                                ?>

                                <?php
                               // foreach ($hire_not as $art) {
                                    if ($total['not_from'] == 6) {

                                        $id = $this->db->get_where('freelancer_post_reg', array('user_id' => $total['user_id']))->row()->freelancer_post_reg_id;
                                        if ($id) {
                                            ?>
                                            <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $total['not_from_id'].'?page=freelancer_hire'); ?>">
                                            <li> 
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<font color='black'><b><i>Freelancer</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Applied On Your Post."; ?></h6>
                                                    <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                    </div>
                                                </div>
                                                
                                            </li>
                                            </a>
                                            <?php
                                        }
                                    }
                            //    }
                                ?>

                                <?php
                                
                             //   foreach ($work_not as $art) {
                                    if ($total['not_from'] == 5) {
                                  //      $id = $this->db->get_where('job_reg', array('user_id' => $total['user_id']))->row()->job_id;
                                  //      if ($id) {
                                            ?>
                                            <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $total['user_id'].'?page=freelancer_post'); ?>"> 
                                            <li>
                                            
                                                <div class="notification-pic" id="noti_pc" >
                                                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                                </div>
                                                
                                                <div class="notification-data-inside" id="notification_inside">
                                                    <h6><?php echo "<font color='black'><b><i>Employer</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Selected You For Project."; ?></h6>
                                                    <div><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                        <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
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
                               // foreach ($work_post as $work) {
                                   if ($total['not_from'] == 4) {
                                        ?> 
                                        <a href="<?php echo base_url('freelancer/freelancer_post_profile/' . $total['not_from_id']); ?>">
                                        <li>
                                         
                                            <div class="notification-pic" id="noti_pc" >
                                                <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $total['user_image']); ?>" >
                                            </div>
                                            
                                            <div class="notification-data-inside" id="notification_inside">
                                                <h6><?php echo "<font color='black'><b><i>Freelancer</i></font></b><b>" . "  " . ucwords($total['first_name']) . ' ' . ucwords($total['last_name']) . "</b> Applied on your post."; ?></h6>
                                                <div ><i class="fa fa-comment" aria-hidden="true" style="margin-right:8px;"></i>
                                                    <?php echo $this->common->time_elapsed_string($total['not_created_date'], $full = false); ?>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        </a>
                                        <!--
                                        <?php
                                   }
                               }
                                ?>
                            </ul>
                        </div>  

                    </div>
                </div>  

            </div>           </div>
        <!-- END PAGE TITLE -->
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
    