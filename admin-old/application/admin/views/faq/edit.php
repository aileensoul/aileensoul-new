<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>



    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                        <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li><a href="<?php echo site_url('faq'); ?>">FAQ Management</a></li>

                <li class="active">Edit</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?>   <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">

                        <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                if ($this->session->flashdata('error')) {

                                    echo $this->session->flashdata('error');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'add_admin', 'id' => 'edit_admin', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('faq/faq_edit', $form_attr);

                                ?>

                                

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">FAQ Question</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="faq_que" name="faq_que" value="<?php echo $result[0]['faq_que']; ?>" class="form-control">

                                    </div>

                                </div>

                                

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">FAQ Answer</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="faq_ans" name="faq_ans" value="<?php echo $result[0]['faq_ans']; ?>" class="form-control">

                                    </div>

                                </div>

                               
                              
                                <div class="done">

                                <input type="hidden" name="faq_id" value="<?php echo $result[0]['faq_id']; ?>" />    

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                </div>

                                </form>

                            </div>

                        </div><!-- col-lg-12-->      	

                    </div><!-- /row -->





                </section><!--wrapper -->

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

        <script src="<?php echo base_url('admin/assets/js/jquery.sparkline.js') ?>"></script>





        <!--common script for all pages-->

        <script src="<?php echo base_url('admin/assets/js/common-scripts.js') ?>"></script>



        <!--script for this page-->

        <script src="<?php echo base_url('admin/assets/js/jquery-ui-1.9.2.custom.min.js') ?>"></script>



        <!--custom switch-->

        <script src="<?php echo base_url('admin/assets/js/bootstrap-switch.js') ?>"></script>



        <!--custom tagsinput-->

        <script src="<?php echo base_url('admin/assets/js/jquery.tagsinput.js') ?>"></script>



        <!--custom checkbox & radio-->



        <script src="<?php echo base_url('admin/assets/js/form-component.js') ?>"></script>    

        <script type="text/javascript">

            $(document).ready(function () {

                $('.alert-success').fadeOut(3000).hide('700');

                $('.alert-danger').fadeOut(3000).hide('700');

            });

        </script>

        <script src="<?php echo base_url('admin/assets/ckeditor/ckeditor.js'); ?>"></script>

          <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

      <!-- javascript validation start -->
   <script type="text/javascript">

           

            $(document).ready(function () { 

                $("#add_driver").validate({

                    rules: {

                     
                         faq_que: {

                            required: true,
                            
                        },
                        faq_ans: {

                            required: true,
                            
                        },
                      
                    },

                    messages: {


                        faq_que: {

                            required: "faq question Is Required.",
                            
                        },
                        faq: {

                            required: "faq Answer Is Required.",
                            
                        },
                        

                        
                    },

                });
                   });
</script>
<!-- javascript validation End -->





        <!-- CK Editor -->
           <script src="<?php echo base_url('admin/assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.js'); ?>"></script>

      <!-- javascript validation start -->
   <script type="text/javascript">

           

            $(document).ready(function () { 

                $("#add_driver").validate({

                    rules: {

                     
                         faq_que: {

                            required: true,
                            
                        },
                        faq_ans: {

                            required: true,
                            
                        },
                      
                    },

                    messages: {


                        faq_que: {

                            required: "faq question Is Required.",
                            
                        },
                        faq: {

                            required: "faq Answer Is Required.",
                            
                        },
                        

                        
                    },

                });
                   });
</script>
<!-- javascript validation End -->








    </body>

</html>

