 <div class="col-md-3 col-sm-3">
                        <div class="job-profile-left-side-bar">
                            <div class="left-side-bar">
                                <ul>

                                <?php
                                    if(($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>


                                  <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_all_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('job/job_all_post'); ?>">Home</a>
                                    </li>

                                    <?php }?>

                                    <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_printpreview'){?> class="active" <?php } ?>><a href="<?php echo base_url('job/job_printpreview'); ?>">Job Profile</a>
                                    </li>


                                     <?php
                                    if(($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>

                                    <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_resume'){?> class="active" <?php } ?>><a href="<?php echo base_url('job/job_resume'); ?>">Resume</a>
                                    </li>

                                     <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_save_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('job/job_save_post'); ?>">Saved Job</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_applied_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('job/job_applied_post'); ?>">Applied Job</a>
                                    </li>

                                    <?php }?>

                                </ul>
                            </div>
                        </div>
                    </div>