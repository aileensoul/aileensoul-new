<div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                <ul>

                                    <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter/rec_post'); ?>">Home</a>
                                    </li>

                                     <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'rec_profile'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter/rec_profile'); ?>">Recruiter Profile</a>
                                    </li>


                                    <?php
                                    if(($this->uri->segment(1) == 'recruiter') && ($this->uri->segment(2) == 'rec_post' || $this->uri->segment(2) == 'rec_profile' || $this->uri->segment(2) == 'add_post' || $this->uri->segment(2) == 'save_candidate') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>

                                     <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter/add_post'); ?>">Add New Post</a>
                                    </li>
                                   
                                    <li <?php if($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save_candidate'){?> class="active" <?php } ?>><a href="<?php echo base_url('recruiter/save_candidate'); ?>">Saved Candidate</a>
                                    </li>

                                    <?php }?>
                                   
                                </ul>
                            </div>
                        </div>
                    </div>