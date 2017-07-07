<!DOCTYPE html>

<html lang="en">

    <?php

    echo $head;

    ?>



    <body>



        <section id="container" >

            <!--header-->

            <?php echo $header; ?>

            <!--sidebar menu-->

            <?php echo $leftbar; ?>

            <!--main content start-->

            <section id="main-content">

                <section class="wrapper">

                     <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li class="active">pages</li>

                 </ol>

                    <!-- end breadcumb -->

                    <h3><i class="fa fa-angle-right"></i> <?php echo $module_name; ?></h3>

                    <div class="row mt">

                        <div class="col-md-12">

                            <div class="content-panel">

                                <div class="search_box">

                                    <div class="col-md-9">

                                        <?php echo form_open('pages/search', array('method' => 'post', 'id' => 'search_frm', 'class' => 'form-inline')); ?>

                                        <input type="text" class="form-control input-sm" value="<?php echo $search_keyword; ?>" placeholder="Search" name="search_keyword" id="search_keyword" required>

                                        <input type="submit" name="submit" value="Submit" class="btn btn-theme" />

                                        <?php echo form_close(); ?>

                                    </div>

                                    <?php if ($this->session->userdata('page_search_keyword')) { ?>

                                        <a href="<?php echo site_url('pages/clear_search') ?>">Clear Search</a>

                                    <?php } ?>

                                </div>



                                <table class="table table-striped table-advance table-hover comon" id="page_data">

                                    <h4><i class="fa fa-angle-right"></i> <?php echo $section_title; ?> </h4>

                                    <hr>

                                    <?php

                                    if ($this->session->flashdata('error')) {

                                        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';

                                    }

                                    if ($this->session->flashdata('success')) {

                                        echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';

                                    }

                                    ?>

                                 

                                    <?php

                                    if ($this->session->flashdata('error')) {

                                        echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';

                                    }

                                    ?>

                                    <thead>

                                        <tr>

                                            <?php

                                            if ($this->uri->segment(2) == '' || $this->uri->segment(2) == 'index') {

                                                $segment2 = 'index';

                                            } else {

                                                $segment2 = 'search';

                                            }

                                            ?>

                                            

                     <th><i class="fa fa-bullhorn"></i>  #  </th>

                     <th><i class="fa fa-file-image-o"></i> <a href="javascript:void(0);"> Page Image</a></th>

                 <th><i class="fa fa-bullhorn"></i> <a href="<?php echo ( $this->uri->segment(3) == 'page_name' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/' . $segment2 . '/page_name/DESC/' . $offset) : site_url($this->uri->segment(1) . '/' . $segment2 . '/page_name/ASC/' . $offset); ?>"> Page Name </a>

                <?php echo ( $this->uri->segment(3) == 'page_name' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'page_name' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                     </th>

                 <th class="hidden-phone"><i class="fa fa-question-circle"></i> <a href="<?php echo ( $this->uri->segment(3) == 'page_title' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/' . $segment2 . '/page_title/DESC/' . $offset) : site_url($this->uri->segment(1) . '/' . $segment2 . '/page_title/ASC/' . $offset); ?>"> Page Title </a>

              <?php echo ( $this->uri->segment(3) == 'page_title' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'page_title' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                  </th>

                                            <th><i class=" fa fa-edit"></i> <a href="javascript:void(0);"> Edit </a></th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        if ($total_rows != 0) {

                                              $i = $offset + 1; 

                                            foreach ($pages_list as $pages) {

                                                

                                                $decode_page_id = base64_encode($pages['page_id']);

                                                ?>

                                                <tr>

                                                    <td data-title="#"><?php echo $i++; ?></td>

                                                    <td data-title="Image"><img src="<?php echo base_url(pageimages.$pages['image']) ?>" style="width: 100px; height: 80px;"></td>
                                                    
                                                    <td data-title="Page Name"><?php echo $pages['page_name']; ?></td>

                                                    <td data-title="Page Title"><?php echo $pages['page_title']; ?></td>

                                                    <td data-title="Edit">

                                                        <a href="<?php echo site_url('pages/edit/' . $decode_page_id); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>

                                                    </td>

                                                </tr>

        <?php

    }

} else {

    ?>

                                            <tr>

                                                <td align="center" colspan="5"> Oops! No Data Found</td>

                                            </tr>  

    <?php

}

?>

                                    </tbody>

                                </table>







                            </div><!-- /content-panel -->



                        </div><!-- /col-md-12 -->



                        <!-- /pagination -->

<div class="dta_left">

                            <?php

                                    if ($total_rows > 0) {

                                        if ($this->pagination->create_links()) {



                                            $rec1 = $offset + 1;

                                            $rec2 = $offset + $limit;

                                            if ($rec2 > $total_rows) {

                                                $rec2 = $total_rows;

                                            }

                                            ?>

                                            <div  style="margin-left: 20px;">

                                                <?php echo "Records $rec1 - $rec2 of $total_rows"; ?>

                                            </div><?php } else {

                                                ?>

                                            <div style="margin-left: 20px;">

                                                <?php echo "Records 1 - $total_rows of $total_rows"; ?>

                                            </div>



                                            <?php

                                        }

                                    }

                                    ?>

                        </div>

                        <!-- /pagination -->

                        <?php

                        if ($this->pagination->create_links()) {



                            $tot_page = ceil($total_rows / $limit);





                            $cur_page = ceil($offset / $limit) + 1;

                            ?>





                            <div class="text-right data_right">

                                <div id="example2_paginate" class="dataTables_paginate paging_simple_numbers">

                                    <?php echo $this->pagination->create_links(); ?> 

                                </div>

                            </div>





<?php } ?>



                    </div><!-- /row -->



                </section><! --/wrapper -->

            </section><!-- /MAIN CONTENT -->



            <!--main content end-->

<?php echo $footer; ?>

        </section>



        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('admin/assets/js/jquery.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.scrollTo.min.js') ?>"></script>

        <script src="<?php echo base_url('admin/assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>

        <!--common script for all pages-->

        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>

        <!--script for this page-->

        <script type="text/javascript">

            $(document).ready(function () {

                $('.alert-success').fadeOut(3000).hide('700');

                $('.alert-danger').fadeOut(3000).hide('700');



            });

        </script> 



<!--        <script>

            //custom select box



            $(function () {

                $('select.styled').customSelect();

            });



        </script>-->



    </body>

</html>

