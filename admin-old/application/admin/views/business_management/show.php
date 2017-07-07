
<!DOCTYPE html>

<html lang="en">

    <?php echo $head; ?>

     <link href="<?php echo base_url('admin/css/jquery-ui.css') ?>" rel="stylesheet" type="text/css">


    <body>



        <section id="container" >

            <?php echo $header; ?>

            <?php echo $leftbar; ?>



            <section id="main-content">

                <section class="wrapper">

                      <!--breadcumb -->

                  <ol class="breadcrumb">

                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i></a></li>

                <li><a href="<?php echo site_url('recruiter_management'); ?>">recruiter management</a></li>

                <li class="active">Add</li>

                 </ol>

                    <!-- end breadcumb -->

                        <h3><i class="fa fa-angle-right pull-left"></i> <?php echo $module_name; ?> <button type="button" onclick="window.history.back();" class="btn btn-default pull-right">Back</button></h3>

                  



                    <!-- BASIC FORM ELELEMNTS -->

                    <div class="row mt">
                     <div class="col-lg-3"></div>

                        <div class="col-lg-9">

                            <div class="form-panel">

                                <h4 class="mb"><i class="fa fa-angle-right"></i> <?php echo $section_title; ?></h4>

                                <?php

                                if ($this->session->flashdata('success')) {

                                    echo $this->session->flashdata('success');

                                }

                                ?>

                                <?php

                                $form_attr = array('name' => 'add_driver', 'id' => 'add_driver', 'class' => 'form-horizontal style-form');

                                echo form_open_multipart('user_management/add_insert', $form_attr);

                                ?>

                                

                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Company Name</label>
                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['company_name']; ?></label>

                                    
                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Country</label>
                                     <label class="col-sm-7 col-md-7 control-label"><?php $country  =  $this->db->get_where('countries',array('country_id' => $business[0]['country']))->row()->country_name; echo $country;  ?></label>

                                    
                                </div>

                               <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">State</label>

                                     <label class="col-sm-7 col-md-7 control-label"><?php $state  =  $this->db->get_where('states',array('state_id' => $business[0]['state']))->row()->state_name; echo $state;  ?></label>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">City</label>

                                     <label class="col-sm-7 col-md-7 control-label"><?php $city  =  $this->db->get_where('cities',array('city_id' => $business[0]['city']))->row()->city_name; echo $city;  ?></label>
                                </div>

                               <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Pincode</label>

                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['pincode']; ?></label>
                                </div> 
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Postal Address</label>

                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['address']; ?></label>
                                </div>

                                 <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Contact Person</label>

                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['contact_person']; ?></label>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Contact Mobile</label>

                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['contact_mobile']; ?></label>

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Contact Email</label>
                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['contact_email']; ?></label>

                                   
                                </div>
                           
                            <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Contact Website</label>
                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['contact_website']; ?></label>

                                  

                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Business Type</label>
                                     <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['business_type']; ?></label>

                                    
                                </div>
                            <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Industriyal</label>

                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['industriyal']; ?></label>
                                </div>
                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Sub Industriyal</label>
                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['subindustriyal']; ?></label>

                                   

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Details of your business</label>
                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['details']; ?></label>

                                    

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Images</label>
                                   <img src="<?php echo base_url(BUSINESSIMAGE.$business[0]['business_profile_image']); ?>" class="col-sm-7 col-md-7 form-control" style="width: 100px; height: 80px;">

                                   
                                </div>
                                 <div class="form-group">

                                    <label class="col-sm-2 col-md-2 control-label">Add More</label>
                                    <label class="col-sm-7 col-md-7 control-label"><?php echo $business[0]['addmore']; ?></label>

                                   
                                </div>
                                    <div class="form-group">

                                  <!--  <div class="col-sm-5">

                                    <div class="col-sm-7">

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>
                                    </div>

                                </div>
 -->


                                </div>

                                <!-- <div> -->
                                <!-- <div class="done">
                                <input type="submit" name="submit" value="submit">

                                <input type="submit" class="btn btn-theme btn_my" name="submit" value="Submit" />

                                <button type="reset" class="btn btn-default btn_my">Reset</button>

                                </div> -->

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

                $("#add_driver").validate({

                    rules: {

                        admin_name: {

                            required: true,

                        },

                        admin_email: {

                            required: true,

                            email: true,

                            remote: {

                                url: "<?php echo base_url() . 'user_management/check_email' ?>",

                                type: "post",

                                data: {

                                    email: function () {

                                        return $("#admin_email").val();

                                    },

                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',

                                },

                            },

                        },

                        admin_username: {

                            required: true

                        },

                        admin_image: {

                            required: true

                        }

                    },

                    messages: {

                        admin_name: {

                            required: "Please enter admin name",

                        },

                        admin_email: {

                            required: "Please enter driver email",

                            email: "Please enter valid email id",

                            remote: "Email already exists"

                        },

                        admin_username: {

                            required: "Please enter username"

                        },

                        admin_image: {

                            required: "Please select image"

                        }

                    },

                });

            });

         
  }

);

        </script>

        <script>
  $( function() {

    $( "#datepicker" ).datepicker();
  } );
  </script>

        <!-- CK Editor -->



    </body>

</html>

