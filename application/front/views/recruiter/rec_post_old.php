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
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="50" width="50" alt="Smiley face" />
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
                                <li <?php if($this->uri->segment(1) == 'recruiter'){?> class="active" <?php } ?>><a href="#">Recruiter</a></li>
                                <li><a href="<?php echo base_url('freelancer'); ?>">Freelancer</a></li>
                                <li><a href="<?php echo base_url('business_profile'); ?>">Bussiness Profile</a></li>
                                <li><a href="<?php echo base_url('artistic'); ?>">Artistic Person</a></li>
                                <li><a href="<?php echo base_url('newsfeed'); ?>">News Feed</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8">

                    <!--- middle section start -->
                  <div class="add-post"><a href="<?php echo base_url('recruiter/add_post'); ?>">Add new post</a> </div>

                   
                   
                      <!--- middle section end -->
 <?php foreach($postdata as $post){ ?>
                      <div class="job-post-detail clearfix">
                            <div class="job-post-title">
                                <h6><a href="#"> <?php echo $post['post_name']; ?></a></h6>
                                <span>Aileensoul</span>
                            </div>
                            <div class="exper-location">
                                <ul>
                                    <li><a href="#"><i class="fa fa-lock" aria-hidden="true"></i><?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?></a></li>
                                    <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $post['post_location']; ?></a></li>
                                    <li><a href="#"></a></li>
                                </ul>
                            </div>
                            <div class="job-about">
                                <ul>
                                    <li><label>Skills:</label> <span><?php echo $post['post_skill']; ?></span></li>
                                    <li><label>Job Description:</label> <span><?php echo $post['post_description']; ?></span></li>
                                    <li class="clearfix salary-age">
                                        <div class="pull-left">
                                             <i class="fa fa-inr" aria-hidden="true"></i> 50,000 - 3,00,000 P.A 
                                        </div>
                                        <div class="pull-right">
                                           <?php echo $post['created_date']; ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <?php if($post['user_id'] == $userid){ ?>
                            <div class="apply-btn pull-left">
                                <a href="<?php echo base_url('recruiter/view_apply_list/' . $post['post_id']); ?>">Applied person :<?php echo count($this->common->select_data_by_id('job_apply', 'post_id', $post['post_id'], $data = '*', $join_str = array())); ?></a>
                            </div>
                            <div class="apply-btn">
                                <a href="<?php echo base_url('recruiter/edit_post/' . $post['post_id']); ?>">Edit </a>
                            </div>
                            <?php } ?>
                            
                        </div>

                          <?php } ?> 
    
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


<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

