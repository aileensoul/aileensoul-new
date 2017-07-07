<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('../uploads/admin/logo.png') ?>" class="" alt="Dollarbid">
            </div>
        </div>

        <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->

            <!-- Start Dashboard -->
            <li <?php if ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
            </li>
            <!-- End Dashboard -->
            <!-- Start Pages -->
            <li <?php if ($this->uri->segment(1) == 'pages' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('pages'); ?>">
                    <i class="fa fa-file-text-o"></i><span>Pages</span>
                </a>
            </li>
            <!-- End Pages -->
            <!-- Start Home Page Banner -->
            <li <?php if ($this->uri->segment(1) == 'banner' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-bars"></i> <span>Home Page Slider</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('banner/add'); ?>"><i class="fa fa-circle-o"></i> Add Banner</a></li>
                    <li><a href="<?php echo base_url('banner'); ?>"><i class="fa fa-circle-o"></i> List Banner</a></li>
                </ul>
            </li>
            <!-- End Home Page Banner -->
            <!--Start category-->
            <li <?php if ($this->uri->segment(1) == 'category' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('category'); ?>">    
                    <i class="fa fa-crosshairs"></i><span>Category</span>
                </a>
            </li>
            <!--Start category-->
            <!--Start manufacturer-->
            <li <?php if ($this->uri->segment(1) == 'manufacturer' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('manufacturer'); ?>">    
                    <i class="fa fa-puzzle-piece"></i><span>Manufacturer</span>
                </a>
            </li>
            <!--Start manufacturer-->
            <!--Start Products-->
            <li <?php if ($this->uri->segment(1) == 'product' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-bars"></i> <span>Products</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('product/add'); ?>"><i class="fa fa-circle-o"></i> Add products</a></li>
                    <li><a href="<?php echo base_url('product'); ?>"><i class="fa fa-circle-o"></i> List Products</a></li>
                </ul>
            </li>
            <!--End Products-->
            
            <!--Start Bidding Package-->
            <li <?php if ($this->uri->segment(1) == 'bid_package' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('bid_package'); ?>">    
                    <i class="fa fa-cog"></i><span>Bid Package</span>
                </a>
            </li>
            <!--Start Bidding Package-->
            <!--Start Deals Promotions-->
            <li <?php if ($this->uri->segment(1) == 'deals_promotions' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-delicious"></i> <span>Deals Promotions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('deals_promotions/add'); ?>"><i class="fa fa-circle-o"></i> Add Deals Promotions</a></li>
                    <li><a href="<?php echo base_url('deals_promotions'); ?>"><i class="fa fa-circle-o"></i> List Deals Promotions</a></li>
                </ul>
            </li>
            <!--Start Deals Promotions-->
            <!--Start Local Community-->
            <li <?php if ($this->uri->segment(1) == 'local_community' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-terminal"></i> <span>Local Community</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('local_community/add'); ?>"><i class="fa fa-circle-o"></i> Add Local Community</a></li>
                    <li><a href="<?php echo base_url('local_community'); ?>"><i class="fa fa-circle-o"></i> List Local Community</a></li>
                </ul>
            </li>
            <!--Start Local Community-->
            <!--Start Global Community-->
            <li <?php if ($this->uri->segment(1) == 'global_community' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-globe"></i> <span>Global Community</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url('global_community/add'); ?>"><i class="fa fa-circle-o"></i> Add Global Community</a></li>-->
                    <li><a href="<?php echo base_url('global_community'); ?>"><i class="fa fa-circle-o"></i> List Global Community</a></li>
                </ul>
            </li>
            <!--Start Global Community-->
            
            <!--Stay Connect Community-->
<!--            <li <?php if ($this->uri->segment(1) == 'stay_connect' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('stay_connect'); ?>">
                    <i class="fa fa-globe"></i> <span>Stay Connect</span>
                </a>
            </li>-->
            <!--End stay connect-->
            <!-- Start For Testimonial-->
            <li <?php if ($this->uri->segment(1) == 'testimonials' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-commenting"></i> <span>Testimonials</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('testimonials/add'); ?>"><i class="fa fa-circle-o"></i> Add Testimonial</a></li>
                    <li><a href="<?php echo base_url('testimonials'); ?>"><i class="fa fa-circle-o"></i> List Testimonials</a></li>
                </ul>
            </li>
            <!-- End For Testimonial-->
            <!--Start Videos-->
            <li <?php if ($this->uri->segment(1) == 'videos' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('videos'); ?>">    
                    <i class="fa fa-youtube"></i><span>Videos</span>
                </a>
            </li>
            <!--End Videos-->
            <!--Start Users-->
            <li <?php if ($this->uri->segment(1) == 'users' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="<?php echo base_url('users'); ?>">    
                    <i class="fa fa-users"></i><span>Users</span>
                </a>
            </li>
            <!--End Users-->
            
            <!--Start Faqs-->
            <li <?php if ($this->uri->segment(1) == 'faqs' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-bars"></i> <span>Faqs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('faqs/add'); ?>"><i class="fa fa-circle-o"></i> Add Faqs</a></li>
                    <li><a href="<?php echo base_url('faqs'); ?>"><i class="fa fa-circle-o"></i> List Faqs</a></li>
                </ul>
            </li>
            <!--End Products-->
            <!--Start Deals Promotions-->
            <li <?php if ($this->uri->segment(1) == 'why_choose' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-delicious"></i> <span>Why Choose the Dollarbid?</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('why_choose/add'); ?>"><i class="fa fa-circle-o"></i> Add Why Choose the Dollarbid ?</a></li>
                    <li><a href="<?php echo base_url('why_choose'); ?>"><i class="fa fa-circle-o"></i> List Why Choose the Dollarbid ?</a></li>
                </ul>
            </li>
            <!--Start Deals Promotions-->
            <!--Start Setting-->
<!--            <li <?php if ($this->uri->segment(1) == 'setting' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               <a href="<?php echo base_url('setting'); ?>">
                   <i class="fa fa-cogs"></i> <span>Setting</span>
               </a>
           </li> -->
           <!--End Setting-->
           <!--Start Change Password-->
            <li <?php if ($this->uri->segment(1) == 'emailtemplate' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               <a href="<?php echo base_url('emailtemplate'); ?>">
                   <i class="fa fa-lock"></i> <span>Email Templates</span>
               </a>
           </li>
           <!--End Change Password-->
           
           <!--Start Change Password-->
            <li <?php if ($this->uri->segment(1) == 'change_password' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               <a href="<?php echo base_url('dashboard/change_password'); ?>">
                   <i class="fa fa-lock"></i> <span>Change Password</span>
               </a>
           </li>
           <!--End Change Password-->
            


            <!--End of my code-->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>