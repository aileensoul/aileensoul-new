<header>
    <div class="header animated fadeInDownBig">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 left-header">
                    <h2 class="logo"><a href="<?php echo base_url('profiles/') . $this->session->userdata('aileenuser_slug'); ?>" title="Aileensoul"><img src="<?php echo base_url('assets/img/logo-name.png?ver='.time()) ?>" alt="Aileensoul"></a></h2>
                    <?php if ($is_userBasicInfo == '1' || $is_userStudentInfo == '1') { ?>
                        <form>
                            <input type="text" name="search" placeholder="Search..">
                        </form>
                    <?php } ?>
                </div>
                <div class="col-md-6 col-sm-6 right-header">
                    <ul>
                        <?php if ($is_userBasicInfo == '1' || $is_userStudentInfo == '1') { ?>
                            <li class="dropdown all">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/n-images/all.png') ?>"></a>

                                <div class="dropdown-menu">
                                    <div class="dropdown-title">
                                        Profiles <a href="profile.html" class="pull-right">All</a>
                                    </div>
                                    <div id="abody" class="as">
                                        <ul>
                                            <li> 
                                                <div class="all-down"> 
                                                    <a href="#"> 
                                                        <div class="all-img"> 
                                                            <img src="<?php echo base_url('assets/n-images/i5.jpg') ?>">
                                                        </div>
                                                        <div class="text-all"> Artistic Profile </div>
                                                    </a> 
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="all-down"> 
                                                    <a href="#"> 
                                                        <div class="all-img"> 
                                                            <img src="<?php echo base_url('assets/n-images/i4.jpg') ?>">
                                                        </div>
                                                        <div class="text-all"> Business Profile </div>
                                                    </a> 
                                                </div>
                                            </li>
                                            <li>
                                                <div class="all-down"> 
                                                    <a href="#"> 
                                                        <div class="all-img"> 
                                                            <img src="<?php echo base_url('assets/') ?>n-images/i1.jpg">
                                                        </div>
                                                        <div class="text-all"> Job Profile </div>
                                                    </a> 
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="all-down"> 
                                                    <a href="#"> 
                                                        <div class="all-img"> 
                                                            <img src="<?php echo base_url('assets/') ?>n-images/i2.jpg">
                                                        </div>
                                                        <div class="text-all"> Recruiter Profile </div>
                                                    </a> 
                                                </div>
                                            </li>
                                            <li> 
                                                <div class="all-down"> 
                                                    <a href="#"> 
                                                        <div class="all-img"> 
                                                            <img src="<?php echo base_url('assets/') ?>n-images/i3.jpg">
                                                        </div>
                                                        <div class="text-all"> Freelance Profile </div>
                                                    </a> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#"><img src="<?php echo base_url('assets/n-images/op.png?ver='.time()) ?>"></a>
                            </li>
                            <li id="add-contact" class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/') ?>n-images/add-contact.png"></a>

                                <div class="dropdown-menu">
                                    <div class="dropdown-title">
                                        Contact Request <a href="all-contact.html" class="pull-right">See All</a>
                                    </div>
                                    <div class="content custom-scroll">
                                        <ul class="dropdown-data add-dropdown">
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <div class="user-name">
                                                                <h6><b>Atosa Ahmedabad</b></h6>
                                                                <div class="msg-discription">IT Sector</div>
                                                            </div>

                                                        </div> 

                                                    </div>
                                                </a> 
                                                <div class="user-request">
                                                    <a href="#" class="add-left-true">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="#" class="add-right-true">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/') ?>n-images/message.png"></a>
                                <div class="dropdown-menu">
                                    <div class="dropdown-title">
                                        Messages <a href="#" class="pull-right">See All</a>
                                    </div>
                                    <div class="content custom-scroll">
                                        <ul class="dropdown-data msg-dropdown">
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6><b>Atosa Ahmedabad</b></h6>
                                                            <div class="msg-discription">Hello how are you</div>

                                                            <span class="day-text">1 month ago</span>

                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/') ?>n-images/noti.png"></a>

                                <div class="dropdown-menu">
                                    <div class="dropdown-title">
                                        Notifications <a href="notification.html" class="pull-right">See All</a>
                                    </div>
                                    <div class="content custom-scroll">
                                        <ul class="dropdown-data noti-dropdown">
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    <div class="dropdown-database">
                                                        <div class="post-img">
                                                            <img src="<?php echo base_url('assets/') ?>n-images/user-pic.jpg" alt="No Business Image">
                                                        </div>
                                                        <div class="dropdown-user-detail">
                                                            <h6>
                                                                <b>   Atosa Ahmedabad</b> 
                                                                <span class="">Started following you in business profile.</span>
                                                            </h6>
                                                            <div>

                                                                <span class="day-text">1 month ago</span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </a> 
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="dropdown user-id">
                            <a href="#" class="dropdown-toggle user-id-custom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="usr-img"><?php if($userdata['user_image'] != ''){ ?><img src="<?php echo USER_THUMB_UPLOAD_URL.$userdata['user_image'] ?>"><?php }else{ ?><div class="custom-user"><?php echo ucfirst(strtolower(substr($userdata['first_name'], 0, 1))); ?></div><?php } ?></span>
                                <span class="pr-name"><?php if(isset($userdata['first_name'])){ echo ucfirst($userdata['first_name']);}?></span>
                            </a>
                            <ul class="dropdown-menu profile-dropdown">
                                <li>Account</li>
                                <li><a href="<?php echo base_url('profile') ?>" title="Setting"><i class="fa fa-cog"></i> Setting</a></li>
                                <li><a href="<?php echo base_url('dashboard/logout') ?>" title="Logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>