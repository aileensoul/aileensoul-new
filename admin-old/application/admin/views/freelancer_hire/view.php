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

                <li><a href="<?php echo site_url('freelancer_hire'); ?>">Job Management</a></li>

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">

                        <div class="col-lg-12">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                  <fieldset>
                                     <label>user id  : </label>
                                    <?php echo $freelancer[0]['user_id'];?>
                
                                  </fieldset>

                                  <fieldset>
                                   <label>registration id  :  </label>
                                   <?php echo $freelancer[0]['reg_id'];?>
                                   </fieldset>
                              

                                <fieldset>
                                    <label>Full Name : </label>
                                  <?php echo $freelancer[0]['fullname'];?>
                                </fieldset>
                              
                                <fieldset>
                                    <label>User Name : </label>
                                    <?php echo $freelancer[0]['username'];?>
                                </fieldset>
                               
                                
                                <fieldset>
                                    <label>Email : </label>
                                <?php echo $freelancer[0]['email'];?>
                                </fieldset>
                                 

                                <fieldset>
                                    <label>Skype Id : </label>
                                    <?php echo $freelancer[0]['skyupid'];?>
                                </fieldset>
                               
                                
                                <fieldset>
                                    <label>Phone Number  :  </label>
                                  <?php echo $freelancer[0]['phone'];?>
                                </fieldset>
                           
                              <fieldset>
                             <label>Country: <?php $cache_time  =  $this->db->get_where('countries',array('country_id' => $freelancer[0]['country']))->row()->country_name;  
                             echo $cache_time;?></label>
                              </fieldset>

                                <fieldset>
                                    <label>State: <?php $cache_time  =  $this->db->get_where('states',array('state_id' => $freelancer[0]['state']))->row()->state_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                               

                                
                                <fieldset>
                                   <label>City: <?php $cache_time  =  $this->db->get_where('cities',array('city_id' => $freelancer[0]['city']))->row()->city_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                                <fieldset>
                                <label>Pincode  :  </label>
                                <?php echo $freelancer[0]['pincode'];?>
                                </fieldset>
                                 
                                
                                <fieldset class="col-md-12">
                                    <label>Postal Address  :  </label>

                                 <?php echo $freelancer[0]['address'];?>
                                </fieldset>
                           


                                <fieldset class="col-md-12">
                                    <label>Professional Info :  </label>
                                      <?php echo $freelancer[0]['Professional_info'];?>
                                 
                                </fieldset>

                                    <fieldset>
                                    <label>Pay Hourly   :  </label>
                                    <?php echo $freelancer[0]['pay_hourly'];?>
                                </fieldset>

                                 
                                <fieldset>
                                    <label>Fixed Price : </label>
                                    <?php echo $freelancer[0]['fixed_price'];?>
                                </fieldset>
                                
                                
     

                            <fieldset>
                                    <label>Fields Of Requirmeant  :  </label>
                                    <?php echo $freelancer[0]['fields_req'];?>
                                </fieldset>
                               
                                <fieldset>
                                    <label>Area Of Requirmeant :  </label>
                                    <?php echo $freelancer[0]['area_req'];?>
                                </fieldset>
                               

                                <fieldset>
                                    <label>Require Skill : </label>
                                   <?php echo $freelancer[0]['req_skill'];?>
                                </fieldset>
                               

                                <fieldset>
                                    <label>Require Experience  :  </label>
                                    <?php echo $freelancer[0]['req_experience'];?>
                                </fieldset>
                               

                                <fieldset>
                                    <label>Require Person : </label>
                                    <?php echo $freelancer[0]['req_person'];?>
                                </fieldset>
                                
                              
                  
                             
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


        <!-- CK Editor -->



    </body>

</html>

