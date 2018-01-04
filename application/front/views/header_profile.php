<header>
    <div class="header animated fadeInDownBig">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 left-header">
                    <h2 class="logo"><a href="<?php echo base_url('profiles/') . $this->session->userdata('aileenuser_slug'); ?>" title="Aileensoul"><img src="<?php echo base_url('assets/img/logo-name.png?ver='.time()) ?>" alt="Aileensoul"></a></h2>
                </div>
                <div class="col-md-6 col-sm-6 right-header">
                    <ul>
                        <li class="dropdown user-id">
                            <a href="#" class="dropdown-toggle user-id-custom" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="usr-img"><?php if($userdata['user_image'] != ''){ ?><img src="assets/img/user-pic.jpg"><?php }else{ ?><div class="custom-user"><?php echo ucfirst(strtolower(substr($userdata['first_name'], 0, 1))); ?></div><?php } ?></span>
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