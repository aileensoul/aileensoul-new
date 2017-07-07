<?php
echo $header;
echo $leftmenu;
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $section_title; ?>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    
    <!--//for flash message-->
        <div class="row" >
            <div class="col-xs-12" >
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert fade in alert-success myalert">
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>  
                    <div class="alert fade in alert-danger myalert" >
                        <i class="icon-remove close" data-dismiss="alert"></i>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- start pages box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $page_count?></h3>
                        <p>Pages</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <a href="<?php echo base_url('pages')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end pages box -->
            <!-- start category box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $category_count?></h3>
                        <p>Category</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-crosshairs"></i>
                    </div>
                    <a href="<?php echo base_url('category')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end category box -->
            <!-- start manufacturer box -->    
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $manufacturers_count?></h3>
                        <p>Manufacturer</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-puzzle-piece"></i>
                    </div>
                    <a href="<?php echo base_url('manufacturer')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           <!-- end manufacturer box -->
            <!-- start products box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $product_count?></h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="<?php echo base_url('product')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end products box -->
            
            <!-- start Bid Package box -->    
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $package_count?></h3>
                        <p>Bid Package</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cog"></i>
                    </div>
                    <a href="<?php echo base_url('bid_package')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           <!-- end Bid Package box -->
             <!-- start Deals Promotions box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $deal_count?></h3>
                        <p>Deals Promotions</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-delicious"></i>
                    </div>
                    <a href="<?php echo base_url('deals_promotions')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Deals Promotions box -->
            
           <!-- start Local Community box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $local_count?></h3>
                        <p>Local Community</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-terminal"></i>
                    </div>
                    <a href="<?php echo base_url('local_community')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Local Community box -->
            <!-- start Testimonials box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $testimonials_count?></h3>
                        <p>Testimonials</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-commenting"></i>
                    </div>
                    <a href="<?php echo base_url('testimonials')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Testimonials box -->
            <!-- start Videos box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $videos_count?></h3>
                        <p>Videos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-youtube"></i>
                    </div>
                    <a href="<?php echo base_url('videos')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Videos box -->
            <!-- start Users box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $users_count?></h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo base_url('users')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Users box -->
            <?php
            /*
            ?>
            <!-- start Setting box -->    
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $product_count?></h3>
                        <p>Setting</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cogs"></i>
                    </div>
                    <a href="<?php echo base_url('setting')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           <!-- end Setting box -->
            <!-- start Change Password box -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $product_count?></h3>
                        <p>Change Password</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <a href="<?php echo base_url('change_password')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- end Change Password box -->
            <?php
            */
            ?>
        </div><!-- /.row -->
        <!-- Main row -->
       

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php echo $footer; ?>



</body>
</html>
