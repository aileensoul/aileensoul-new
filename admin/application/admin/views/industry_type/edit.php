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

                <li><a href="<?php echo site_url('industry_type'); ?>">industry type Management</a></li>

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

                                $form_attr = array('name' => 'add_industry', 'id' => 'edit_industry', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('industry_type/edit_insert', $form_attr);

                                ?>
     


                                 <fieldset <?php if($business) {  ?> class="error-msg" <?php } ?>>
                                    <label>Select Business Type:<span style="color:red">*</span></label>

                                     
                                    <?php
                                   
                                                 //print_r ($id); die();
                                                 ?>
                                    <select name="business[]" multiple id="business">

                                    <?php

                                            
                                            if($business1)
                                            {
                                                $id = explode(',',$business1);
                                                foreach($id as $id1){
                                                     
                                                         foreach ($business as $cnt) {

                                                   
                                         ?>
                           
                                           <option value="<?php echo $cnt['type_id']; ?>" <?php if($cnt['type_id']==$id1) echo 'selected';?>><?php echo $cnt['business_type'];?></option> 
                                                
                                            <?php
                                               
                                          }
                                          
                                            }
                                          }
                                                 else
                                                {
                                                  foreach($business as $cnt){
                                            ?>

                                            <option value="<?php echo $cnt['type_id']; ?>"><?php echo $cnt['business_type']; ?></option>
                                             <?php
                                              }
                                             }
                                          
                                         
                                            ?>
                                    </select>

                                    
                                  
                                     <?php echo form_error('business[]'); ?>
                                </fieldset>


                                    

                                <div class="form-group">

                                    <label class="col-sm-2 col-sm-2 control-label">industry type</label>

                                    <div class="col-sm-7">

                                        <input type="text" id="industry_name" name="industry_name" value="<?php echo $stream[0]['industry_name']; ?>" class="form-control">

                                    </div>

                                </div>

                              
                                <div class="done">

                                <input type="hidden" name="industry_id" value="<?php echo $industry_type[0]['industry_id']; ?>" />    

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

        <script type="text/javascript" src="<?php echo base_url('admin/assets/js/jquery.validate.min.js') ?>"></script>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#edit_admin").validate({

                    rules: {

                        type_name: {

                            required: true,

                        },

                     

                        industry_name: {

                            required: true,

                        }

                       

                    },

                    messages: {

                        type_name: {

                            required: "Please enter business type",

                        },

                        industry_name: {

                            required: "Please enter industry",

                        }

                    },

                });

            });

        </script>

        <!-- CK Editor -->


          <!-- script for multiple language select dropdown start -->
<link href="<?php echo base_url('css/jquery.multiselect.css') ?>"  rel="stylesheet" type="text/css"> 
<!-- <script type="text/javascript" src="<?php //echo base_url('js/jquery.min.js') ?>"></script>  -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.multiselect.js') ?>"></script> 

<script>

$('#business').multiselect({
    columns: 1,
    placeholder: 'Select Business Type',
    search: true,
    selectAll: true
});

</script>
<!-- script for multiple language select dropdown End --> 



    </body>

</html>

