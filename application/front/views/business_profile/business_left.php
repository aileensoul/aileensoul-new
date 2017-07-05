<div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                <ul>

                                     <?php 
                                if(($this->uri->segment(1) == 'business_profile') && ($this->uri->segment(2) == 'business_profile_post' || $this->uri->segment(2) == 'business_resume' || $this->uri->segment(2) == 'business_profile_manage_post' || $this->uri->segment(2) == 'business_profile_save_post' || $this->uri->segment(2) == 'userlist' 
                                    || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>


                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_post'); ?>">Home</a>
                                    </li>

                                    <?php }?>

                                     <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_resume'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata[0]['business_slug']); ?>">Business Profile</a>
                                    </li>
                                    
                                  <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>">Manage Your Own Post</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'recruiter'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter'); ?>">Recruiter</a>
                                    </li>
                                    

                                    <?php 
                                if(($this->uri->segment(1) == 'business_profile') && ($this->uri->segment(2) == 'business_profile_post' || $this->uri->segment(2) == 'business_resume' || $this->uri->segment(2) == 'business_profile_manage_post' || $this->uri->segment(2) == 'business_profile_save_post' || $this->uri->segment(2) == 'userlist' 
                                    || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                                  <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_save_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/business_profile_save_post'); ?>">Saved Post</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/userlist'); ?>">Userlist</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/followers'); ?>">Followers  (<?php echo $followers; ?>)</a>
                                    </li>
                                    
                                    <li <?php if($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('business_profile/following'); ?>">Following  (<?php echo $following; ?> )</a>
                                    </li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>