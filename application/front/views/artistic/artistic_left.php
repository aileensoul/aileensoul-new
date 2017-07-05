<div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                   <ul>

                                    <?php 
                                if(($this->uri->segment(1) == 'artistic') && ($this->uri->segment(2) == 'artistic_profile' || $this->uri->segment(2) == 'art_post' || $this->uri->segment(2) == 'art_manage_post' || $this->uri->segment(2) == 'art_addpost' || $this->uri->segment(2) == 'art_editpost' 
                                    || $this->uri->segment(2) == 'artistic_commentpost' || $this->uri->segment(2) == 'artistic_commentpost_edit' || $this->uri->segment(2) == 'artistic_contactperson' || $this->uri->segment(2) == 'art_savepost' || $this->uri->segment(2) == 'userlist' || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_post'); ?>">Home</a>
                                    </li>
                             <?php }?>

                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/artistic_profile'); ?>">Artistic Profile</a>
                                    </li>

                                

                                     <?php 
                                if(($this->uri->segment(1) == 'artistic') && ($this->uri->segment(2) == 'artistic_profile' || $this->uri->segment(2) == 'art_post' || $this->uri->segment(2) == 'art_manage_post' || $this->uri->segment(2) == 'art_addpost' || $this->uri->segment(2) == 'art_editpost' 
                                    || $this->uri->segment(2) == 'artistic_commentpost' || $this->uri->segment(2) == 'artistic_commentpost_edit' || $this->uri->segment(2) == 'artistic_contactperson' || $this->uri->segment(2) == 'art_savepost' || $this->uri->segment(2) == 'userlist' || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>


                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_savepost'); ?>">Saved Post</a>
                                    </li>

                                  <?php }?>

                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_manage_post'); ?>">Manage Your Own Post</a>
                                    </li>

                                
                                     <?php 
                                if(($this->uri->segment(1) == 'artistic') && ($this->uri->segment(2) == 'artistic_profile' || $this->uri->segment(2) == 'art_post' || $this->uri->segment(2) == 'art_manage_post' || $this->uri->segment(2) == 'art_addpost' || $this->uri->segment(2) == 'art_editpost' 
                                    || $this->uri->segment(2) == 'artistic_commentpost' || $this->uri->segment(2) == 'artistic_commentpost_edit' || $this->uri->segment(2) == 'artistic_contactperson' || $this->uri->segment(2) == 'art_savepost' || $this->uri->segment(2) == 'userlist' || $this->uri->segment(2) == 'followers' || $this->uri->segment(2) == 'following') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>


                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/userlist'); ?>">Userlist</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/followers'); ?>">Followers  (<?php echo $followers; ?>)</a>
                                    </li>
                                    
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/following'); ?>">Following  (<?php echo $following; ?> )</a>
                                    </li>

                                   <?php }?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>