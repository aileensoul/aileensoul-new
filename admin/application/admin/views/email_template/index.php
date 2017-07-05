
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

                <li class="active">Email template</li>

                 </ol>

                    <!-- end breadcumb -->

                    <h3><i class="fa fa-angle-right"></i> <?php echo $module_name; ?></h3>

                    <div class="row mt">

                        <div class="col-md-12">

                            <div class="content-panel">





                                <table class="table table-striped table-advance table-hover comon" id="edit_temp">

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

                                    

                                    

                                    <thead>

                                        <tr>

                                            <?php if($this->uri->segment(2)=='' || $this->uri->segment(2)=='index'){

                                        $segment2='index';

                                     } else {

                                         $segment2='search';

                                     } ?>    

                                            <th><i class="fa fa-bullhorn"></i>  #  </th>

                                            <th><i class="fa fa-bullhorn"></i> <a href="<?php echo ( $this->uri->segment(3) == 'vartitle' && $this->uri->segment(4) == 'ASC') ? site_url($this->uri->segment(1) . '/'.$segment2.'/vartitle/DESC/' . $offset) : site_url($this->uri->segment(1) . '/'.$segment2.'/vartitle/ASC/' . $offset); ?>"> Title </a>

                                            <?php echo ( $this->uri->segment(3) == 'vartitle' && $this->uri->segment(4) == 'ASC' ) ? '<i class="glyphicon glyphicon-arrow-up">' : (( $this->uri->segment(3) == 'vartitle' && $this->uri->segment(4) == 'DESC' ) ? '<i class="glyphicon glyphicon-arrow-down">' : '' ); ?> 

                                            </th>

                                            <th><i class="fa fa-file-image-o"></i> <a href="javascript:void(0);"> Subject </a></th>

                                              <th><i class=" fa fa-edit"></i> <a href="javascript:void(0);"> Edit </a></th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                         $i = $offset + 1; 

                                        foreach ($emailformat_list as $emailformat) {

                                            $decode_page_id = base64_encode($emailformat['emailid']);

                                            ?>

                                            <tr>

                                                <td data-title="#"><?php echo $i++; ?></td>

                                                <td data-title="Title"><?php echo $emailformat['vartitle']; ?></td>

                                                <td data-title="Subject"><?php echo $emailformat['varsubject']; ?></td>

                                                <td data-title="Edit">

                                                    <?php $emailformatid=($emailformat['emailid']); ?>

                                                    <a href="<?php echo base_url() . 'email_template/edit/' . $decode_page_id; ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>

                                                </td>

                                            </tr>

                                            <?php

                                        }

                                        ?>

                                    </tbody>

                                </table>







                            </div><!-- /content-panel -->



                        </div><!-- /col-md-12 -->

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

                                            <div style="margin-left: 20px;">

                                                <?php echo "Records $rec1 - $rec2 of $total_rows"; ?>

                                            </div><?php } else {

                                                ?>

                                            <div  style="margin-left: 20px;">

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

        <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

        <script class="include" type="text/javascript" src="<?php echo base_url('assets/js/jquery.dcjqaccordion.2.7.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/jquery.nicescroll.js') ?>" type="text/javascript"></script>

        <!--common script for all pages-->

        <script src="<?php echo base_url('assets/js/common-scripts.js') ?>"></script>

       <script type="text/javascript">

            $(document).ready(function(){

                

               $(".alert-danger").fadeOut(3000).hide("1000"); 

               $(".alert-success").fadeOut(3000).hide("1000"); 

            });

        </script> 

        



    </body>

</html>

