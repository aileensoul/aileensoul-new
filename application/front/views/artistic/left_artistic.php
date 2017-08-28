
         <div class="full-box-module">
            <div class="profile-boxProfileCard  module">
               <div class="profile-boxProfileCard-cover">
                  <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo site_url('artistic/dashboard'); ?>" tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?>">
                     <?php if ($artisticdata[0]['profile_background']) { ?>
                     <div class="data_img"><img src="<?php echo base_url($this->config->item('art_bg_thumb_upload_path') . $artisticdata[0]['profile_background']); ?>" alt ="<?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?>" class="bgImage"  >
                     </div>
                     <?php } else { ?>
                     <div class="data_img">
                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?>"  >
                     </div>
                     <?php } ?>
                  </a>
               </div>
               <div class="profile-boxProfileCard-content clearfix">
                  <div class="left_side_box_img buisness-profile-txext">
                     <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo site_url('artistic/dashboard'); ?>" title="<?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                        <!-- box image start -->
                        <?php if ($artisticdata[0]['art_user_image']) { ?>
                        <div class="data_img_2"> 


<?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div>
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                           <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>" class="bgImage"  alt="<?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?>" >

                              <?php } ?>
                        </div>
                        <?php } else { ?> 
                        <div class="data_img_2">
                           
                          <?php 
                          $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);?>

                            <div>
                            <?php echo  ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)); ?>
                            </div>
                        </div>
                        <?php } ?>
                        <!-- box image end -->
                     </a>
                  </div>
                  <div class="right_left_box_design ">
                     <span class="profile-company-name ">
                     <a   href="<?php echo site_url('artistic/dashboard'); ?>"> <?php echo ucfirst(strtolower($artisticdata[0]['art_name'])) . ' ' . ucfirst(strtolower($artisticdata[0]['art_lastname'])); ?></a>
                     </span>
                     <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                     <div class="profile-boxProfile-name">
                        <a  href="<?php echo site_url('artistic/dashboard'); ?>">
                        <?php
                           if ($artisticdata[0]['designation']) {
                               echo ucfirst(strtolower($artisticdata[0]['designation']));
                           } else {
                               echo "Current Work";
                           }
                           ?>
                        </a>
                     </div>
                     <ul class=" left_box_menubar">
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Dashboard" href="<?php echo base_url('artistic/dashboard'); ?>"> Dashboard</a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers') { ?> class="active" <?php } ?>><a title="Followers" href="<?php echo base_url('artistic/followers'); ?>">Followers <br>(<?php echo (count($followerdata)); ?>)</a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following') { ?> class="active" <?php } ?>><a class="padding_less_right"  title="Following" href="<?php echo base_url('artistic/following'); ?>">Following<br><div id="countfollow">(<?php echo (count($followingdata)); ?>)</div></a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
           <div class="custom_footer_left fw">
          <div class="fl">
            <ul>
              <li><a href=""> About Us </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Contact Us</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a  href="">Blogs</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Terms & Condition </a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Privacy Policy</a></li>
              <span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span>
              <li><a href="">Send Us Feedback</a></li>
            </ul>
          </div>
        <div>
          
        </div>

        </div>