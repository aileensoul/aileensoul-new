<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-profile">
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <div class="user-img pull-left">
                            <?php if($userdata[0]['user_image'] != ''){ ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="300" width="100" alt="Smiley face" />
                        <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                        <?php } ?>
                        </div>
                        <div class="user-detail pull-left">
                            <h6><?php echo $userdata[0]['first_name'] . $userdata[0]['last_name']; ?></h6>
                            <span>Designation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                            
                                <li><a href="<?php echo base_url('job'); ?>">Job Seeker</a></li>
                                <li><a href="<?php echo base_url('recruiter'); ?>">Recruiter</a></li>
                                <li><a href="<?php echo base_url('freelancer'); ?>">Freelancer</a></li>
                                <li><a href="<?php echo base_url('business_profile'); ?>">Bussiness Profile</a></li>
                                <li><a href="<?php echo base_url('artistic'); ?>">Artistic Person</a></li>
                                <li><a href="<?php echo base_url('message'); ?>">Message</a></li>
                                
                            </ul>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-8">
                     <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                        
                        
                        <div class="job-post-detail clearfix">
                            <div class="job-post-title">
                                <h6><?php $friend[0]['user_name']?></h6>  
                            </div>
                            <div class="exper-location">
                              

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->
    