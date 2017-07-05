 <div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                   <ul>


                                     <?php 
                                if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile' || $this->uri->segment(2) == 'freelancer_apply_post' || $this->uri->segment(2) == 'freelancer_save_post' || $this->uri->segment(2) == 'freelancer_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>


                                   <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_apply_post')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_apply_post'); ?>">Home</a>
                                    </li>

                                <?php }?>
                                
                                    <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_post_profile'); ?>">Freelancer Work Profile</a>
                                    </li>


                                    <?php 
                                if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_post_profile' || $this->uri->segment(2) == 'freelancer_apply_post' || $this->uri->segment(2) == 'freelancer_save_post' || $this->uri->segment(2) == 'freelancer_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>

                                    
                                

                                    <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save_post')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_save_post'); ?>">Saved Freelancer</a>
                                    </li>

                                    <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_applied_post')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_applied_post'); ?>">Applied Freelancer</a>
                                    </li>


                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>