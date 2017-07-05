<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="<?php echo site_url('settings'); ?>">
                    <?php
                    if ($loged_in_user[0]['admin_role'] == 1) {
                        ?>
                        <img src="<?php echo site_url() . $this->config->item('profile_main_image') . $admin_image; ?>" class="img-circle" width="80">
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo site_url() . $this->config->item('admin_thumb_upload_path') . $admin_image; ?>" class="img-circle" width="80">
                        <?php
                    }
                    ?>
                </a></p>
            <h5 class="centered"><?php echo $admin_name ?></h5>
            <li class="mt">
                <a <?php if ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?>  href="<?php echo site_url('dashboard'); ?>" title="Dashboard">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'settings' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('settings') ?>" title="Settings">
                    <i class="fa fa-wrench"></i>
                    <span>Setting</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'sem' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('sem'); ?>" title="Sem">
                    <i class="fa fa-facebook"></i>
                    <span>SEM</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'seo' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('seo'); ?>" title="Seo">
                    <i class="fa fa-bullhorn"></i>
                    <span>SEO</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'pages' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('pages'); ?>" title="pages">
                    <i class="fa fa-file"></i>
                    <span>Pages</span>
                </a>
            </li>
            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'email_settings' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('email_settings'); ?>" title="Email Setting">
                    <i class="fa fa-envelope"></i>
                    <span>Email Setting</span>
                </a>
            </li>
            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'email_template' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('email_template'); ?>" title="Email Template">
                    <i class="fa fa-envelope-o"></i>
                    <span>Email Template</span>
                </a>
            </li>
          <!-- chnages by khyati today -->
           <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'subscription' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('subscription'); ?>" title="TYpe">
                    <i class="fa fa-file"></i>
                    <span>Subscription management</span>
                </a>
            </li>
            
             <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'type' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('type'); ?>" title="TYpe">
                    <i class="fa fa-envelope-o"></i>
                    <span>Subscription type</span>
                </a>
            </li>
            
            <!-- end -->

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'company_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Company Management">
                    <i class="fa fa-university"></i>
                    <span>Company Management</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('company_management'); ?>" title="View Company"><i class="fa fa-eye"></i>View Company Management</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('company_management/add'); ?>" title="Add Company"><i class="fa fa-plus"></i>Add Company Management</a></li>
                </ul>
            </li>


            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'client_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Client Management">
                    <i class="fa fa-male"></i>
                    <span>Client Management</span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo site_url('client_management'); ?>" title="View Client"><i class="fa fa-eye"></i>View Client Management</a></li>
                    <li><a href="<?php echo site_url('client_management/add'); ?>" title="Add Client"><i class="fa fa-plus"></i>Add Client Management</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'truck_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Truck Management">
                    <i class="fa fa-truck"></i>
                    <span>Truck Management</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('truck_management'); ?>" title="View Truck"><i class="fa fa-eye"></i>View Truck Management</a></li>
                    <li><a  href="<?php echo site_url('truck_management/add'); ?>" title="Add Truck"><i class="fa fa-plus"></i>Add Truck Management</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'work_order' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Work Order Management">
                    <i class="fa fa-money"></i>
                    <span>Work Order Management</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('work_order'); ?>" title="View Work Order"><i class="fa fa-eye"></i>View Work Order</a></li>
                    <li><a  href="<?php echo site_url('work_order/add'); ?>" title="Add Work Order"><i class="fa fa-plus"></i>Add Work Order</a></li>
                    <li><a  href="<?php echo site_url('work_order/cancel_work_order_request'); ?>" title="Cancel Work Order Request"><i class="fa fa-eye"></i>Cancel Work Order Request</a></li>
                    <li><a  href="<?php echo site_url('work_order/cancel_work_order'); ?>" title="Cancel Work Order"><i class="fa fa-eye"></i>Cancel Work Order</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'driver_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Driver management">
                    <i class="fa fa-user"></i>
                    <span>Driver Management</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('driver_management'); ?>"title="View Driver"><i class="fa fa-eye" ></i>View Driver Management</a></li>
                <!---    <li><a  href="<?php echo site_url('driver_management/add'); ?>"><i class="fa fa-plus"></i>Add Driver Management</a></li> -->
                </ul>
            </li>
            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'user_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="Admin user"
                                                                                                               <i class="fa fa-users"></i>
                    <span>Admin User Management</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('user_management'); ?>" title="view admin"><i class="fa fa-eye"></i>View Admin User </a></li>
                    <li><a  href="<?php echo site_url('user_management/add'); ?>" title="add admin"><i class="fa fa-plus" ></i>Add Admin User</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'activity_logs' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('activity_logs'); ?>" title="activity logs">
                    <i class="fa fa-child"></i>
                    <span>Activity Logs</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'invoice_management' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('invoice'); ?>" title="invoice management">
                    <i class="fa fa-file-text"></i>
                    <span>Invoice Management</span>
                </a>
                <!--                <ul class="sub">
                                    <li><a  href="<?php echo site_url('invoice'); ?>"><i class="fa fa-eye"></i>View Invoice Management</a></li>
                                    <li><a  href="<?php echo site_url('invoice/add'); ?>"><i class="fa fa-plus"></i>Add Invoice Management</a></li>
                                </ul>-->
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'message' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="<?php echo site_url('message'); ?>" title="message">
                    <i class="fa fa-envelope-o"></i>
                    <span>Message</span>
                </a>
            </li>

            <li class="sub-menu">
                <a <?php if ($this->uri->segment(1) == 'inquiry' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" title="inquiry">
                    <i class="fa fa-university"></i>
                    <span>Inquiry</span>
                </a>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('contact_us'); ?>" title="View Contact"><i class="fa fa-eye"></i>View Contact us</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="<?php echo site_url('feedback'); ?>" title="View Feedback"><i class="fa fa-eye"></i>View Feedback</a></li>
                </ul>
            </li>
            <!--        
                    <li class="sub-menu">
                        <a <?php if ($this->uri->segment(1) == 'inquiry' || $this->uri->segment(1) == '') { ?> class="active" <?php } else { ?> class=""   <?php } ?> href="javascript:;" >
                            <i class="fa fa-flag" aria-hidden="true"></i>
                            <span>Reports</span>
                        </a>
                        <ul class="sub">
                            <li><a  href="<?php echo site_url('company_register'); ?>"><i class="fa fa-eye"></i>Company report</a></li>
                        </ul>
                        
                    </li>
                    
                    
            --> 

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
