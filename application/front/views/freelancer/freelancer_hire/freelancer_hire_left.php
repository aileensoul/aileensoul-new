<div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                   <ul>

                                  

                                  <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_hire_post')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_hire_post'); ?>">Home</a>
                                    </li>
                                    
                                     <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_hire_profile')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_hire_profile'); ?>">Employer Profile</a>
                                    </li>

                                   
                                    


                                    <?php 

                                   
                                if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_hire_post' || $this->uri->segment(2) == 'freelancer_hire_profile' || $this->uri->segment(2) == 'freelancer_add_post' || $this->uri->segment(2) == 'freelancer_save') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>


                                   <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_add_post')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_add_post'); ?>">Add New Post</a>
                                    </li>
 

                                    <li <?php if(($this->uri->segment(1) == 'freelancer') && ($this->uri->segment(2) == 'freelancer_save')){?> class="active" <?php } ?>><a href="<?php echo base_url('freelancer/freelancer_save'); ?>">Saved Freelancer</a>
                                    </li>

                                    <?php }?>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>