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


                                 <table>
                                        <h1>Job Information</h1><br><br>

                                          <tr>
                                           <label>Job id : </label>
                                          <lable> <?php echo $job[0]['job_id'];?></label>
                                          </tr><br><br>


                                         <tr>
                                           <label>User id :  </label>
                                            <label> <?php echo $job[0]['user_id'];?> </label>
                                        
                                        </tr><br><br>

                                        <tr>
                                        <label>First Name  : </label>
                                         <label> <?php echo $job[0]['fname'];?> </label>
                                        </tr><br><br>

                                      
                                        <label>Last Name  :  </label>
                                         <label><?php echo $job[0]['lname'];?> </label>
                                        
                                        </tr><br><br>

                                        <tr>
                                        <label>Email Address  : </label>
                                        <label><?php echo $job[0]['email'];?></label>
                                        
                                        </tr><br><br>

                                        <tr>
                                        <label>Phone Number  : </label>
                                      <label> <?php echo $job[0]['phnno'];?></label>
                                        
                                        </tr><br><br>

                                         <tr>
                                        <label>Marital Status  : </label>
                                         <lable> <?php echo $job[0]['marital_status'];?></label>
                                        
                                        </tr><br><br>

                                                
                              <fieldset>
                             <label>nationality: <?php $cache_time  =  $this->db->get_where('nation',array('nation_id' => $job[0]['nation_id']))->row()->nation_name;  
                             echo $cache_time;?></label>
                              </fieldset>

                                         <tr>
                                        <label>Language Known  : </label>
                                         <lable> <?php echo $job[0]['language'];?></label>
                                        </tr><br><br>

                                         <tr>
                                        <label>Date of Birth : </label>
                                        <?php echo $job[0]['dob'];?> </span>
                                         
                                        </tr><br><br>

                                        <tr>
                                        <label>Gender  : </label>
                                       <lable> <?php echo $job[0]['gender'];?></label>
                                        </tr><br><br>
    
                                      
                              <fieldset>
                             <label>Country: <?php $cache_time  =  $this->db->get_where('countries',array('country_id' => $job[0]['country_id']))->row()->country_name;  
                             echo $cache_time;?></label>
                              </fieldset>

                                <fieldset>
                                    <label>State: <?php $cache_time  =  $this->db->get_where('states',array('state_id' => $job[0]['state_id']))->row()->state_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                               

                                
                                <fieldset>
                                   <label>City: <?php $cache_time  =  $this->db->get_where('cities',array('city_id' => $job[0]['city_id']))->row()->city_name;  
                             echo $cache_time;?></label>
                                </fieldset>
                                

                                        
                                         <tr>
                                        <label>Pincode : </label>
                                       <label>  <?php echo $job[0]['pincode'];?></label>
                                        </tr><br><br>

                                        <tr>
                                        <label>Address : </label>
                                       <lable> <?php echo $job[0]['address'];?></label>
                                        </tr><br><br>

                                      
                                        <tr>
                                        <label>Degree  : </label>
                                     <lable> <?php echo $job[0]['degree'];?></label>
                                        </tr><br><br>

                                        <tr>
                                       <label>Stream : </label>
                                         <lable> <?php echo $job[0]['stream'];?></label> 
                                        </tr><br><br>

                                        <tr>
                                        <label>University : </label>
                                          <lable> <?php echo $job[0]['university'];?></label>
                                        </tr><br><br>

                                        <tr>
                                        <label>College : </label>
                                         <lable> <?php echo $job[0]['college'];?></label>
                                        </tr><br><br>

                                         <tr>
                                        <label>Grade : </label>
                                         <lable> <?php echo $job[0]['grade'];?></label> 
                                        </tr><br><br>

                                        <tr>
                                        <label>Percentage : </label>
                
                                      <label> <?php echo $job[0]['percentage'];?><label>
                                        </tr><br><br>
                                         

                                        <tr>
                                        <label>Year of Passing : </label>
                                         <lable> <?php echo $job[0]['year_pass'];?></label>
                                        </tr></br></br>

                                        <tr>
                                        <label>Education Certificate  : </label>
                                           <img src="<?php echo base_url( JOBEDUCERTIFICATE . $job[0]['edu_certificate'])?>" style="width:100px;height:100px;">
                                         
                                    </tr><br><br>
                                   
                                        <tr>
                                        <label>keyskills : </label>
                                      <label>  <?php echo $job[0]['keyskill'];?></label>
                                        </tr><br><br>

                                        <tr>
                                        <label>Apply For  : </label>
                                         <label><?php echo $job[0]['ApplyFor'];?></label>
                                        </tr><br><br>

                               
                                        <tr>
                                        <label>Job Title  : </label>
                                        <label><?php echo $job[0]['jobtitle'];?></label>
                                        </tr><br><br>

                                        <tr>

                                        <tr>
                                        <label>Company Name  : </label>
                                        <label> <?php echo $job[0]['companyname'];?></label>
                                        </tr><br><br>

                                      

                                        <tr>
                                        <label>Company Email  : </label>
                                        <label> <?php echo $job[0]['companyemail'];?></label>
                                        </tr><br><br>

                                       

                                        <tr>
                                        <label>Company Phone : </label>
                                         <label><?php echo $job[0]['companyphn'];?></label>
                                        </tr><br><br>

                                    <tr>
                                        <label>Fresher / Experience :  </label>
                                          <lable> <?php echo $job[0]['experience'];?></label>   
                                     </tr>
                                   
                                     <tr>
                                        <label>Experience Year : </label>
                                          <lable> <?php echo $job[0]['experience_year'];?></label>   
                                     </tr>
                                      <tr>
                                        <label>Experience Month : </label>
                                          <lable> <?php echo $job[0]['experience_month'];?></label>   
                                     </tr>

                                    
                                     <tr>
                                        <label>Experience Certificate : </label>
                                           <img src="<?php echo base_url( JOBWORKCERTIFICATE . $job[0]['work_Certificate'])?>" style="width:100px;height:100px;">
                    
                                        </tr><br><br>

                                        <tr>
                                        <label>Curricular Activities :  </label>
                                         <lable> <?php echo $job[0]['currucular'];?></label>
                                        </tr><br><br>

                                         <tr>
                                        <label>Interest : </label>
                                         <lable> <?php echo $job[0]['interest'];?></label>
                                        </tr><br><br>

                                        <tr>
                                        <label>References  : </label>
                                          <lable> <?php echo $job[0]['reference'];?></label>
                                        </tr><br><br>

                              
                                        <tr>
                                        <label>Carrier Objectives : </label>
                                         <lable> <?php echo $job[0]['carrier'];?></label>
                                    
                                        </tr>

                                    <br><br>
       
                                </table>

                  
                             
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

