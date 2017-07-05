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

                <li><a href="<?php echo site_url('job'); ?>">Job Management</a></li>

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

                             <label>Userid   :  </label>
                             <?php echo $result[0]['user_id']; ?>
                              
                              </fieldset></br>

                              <fieldset>

                             <label> Art id   :  </label>
                             <?php echo $result[0]['art_id']; ?>
                              
                              </fieldset></br>

                            
                                <fieldset>
                                    <label>Name: </label>
                                     <?php echo $result[0]['art_name'];?>
                                </fieldset>
                                
                                <fieldset>
                                    <label>E-mail address  :   </label>
                                    <?php echo $result[0]['art_email'];?>
                                </fieldset>
                               

                                <fieldset class="full-width">
                                    <label>Phone number :  </label>
                                    <?php echo $result[0]['art_phnno'];?>
                                </fieldset>
                               
                     
                              <fieldset>
                             <label>Country: <?php $cache_time  =  $this->db->get_where('countries',array('country_id' => $result[0]['art_country']))->row()->country_name;  
                             echo $cache_time;?></label>
                              </fieldset>

                                <fieldset>
                                    <label>State: <?php $cache_time  =  $this->db->get_where('states',array('state_id' => $result[0]['art_state']))->row()->state_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                               

                                
                                <fieldset>
                                   <label>City: <?php $cache_time  =  $this->db->get_where('cities',array('city_id' => $result[0]['art_city']))->row()->city_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                                
                                <fieldset>
                                    <label>Pincode  :  </label>
                                   <?php echo $result[0]['art_pincode'];?>
                                </fieldset>
                               
                                <fieldset class="full-width">
                                    <label>Address  :  </label>
                                  <?php echo $result[0]['art_address']; ?>
                                </fieldset>

                            <fieldset>
                                <label>What is your Art  :  </label>
                                <?php echo $result[0]['art_yourart'];?>"/>
                            </fieldset>
                           
 
                            <fieldset>
                                <label>Speciality  :  </label>
                               <?php echo $result[0]['art_speciality'];?>
                            </fieldset>

                            <fieldset class="full-width">
                                <label>How You are Inspire  : </label>
                            <?php echo $result[0]['art_inspire'];?>
                            </fieldset>
           
                               
                            <fieldset class="full-width">
                                <label>Art Portfolio</label>
                                 <?php echo $result[0]['art_portfolio'];?>
                            </fieldset>
                                
                     
                          <fieldset class="full-width">
                                    <label>Best of mine  :  </label>
                                  
                            </fieldset>
                            <fieldset class="full-width">
                            <img src="<?php echo base_url(ARTISTICIMAGE.$result[0]['art_bestofmine'])?>" style="width:100px;height:100px;">
                        


                        <fieldset class="full-width">
                            <label>Achievmeant:<span style="color:red">*</span></label>
                            <img src="<?php echo base_url( ARTISTICIMAGE . $result[0]['art_achievement'])?>" style="width:100px;height:100px;">
                            
                    

                        <fieldset class="full-width">
                            <label for="country-suggestions"> Skills  :  </label>
                            <?php echo $result[0]['art_skill'];?>
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

