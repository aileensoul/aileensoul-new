<!--start head -->
<?php  echo $head; ?>
<link rel="stylesheet" href="<?php echo base_url('css/select2-4.0.3.min.css'); ?>">
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                                <li><a href="<?php echo base_url('artistic/art_basic_information_update'); ?>">Basic information</a></li>
                                <li><a href="<?php echo base_url('artistic/art_address'); ?>">Address</a></li>
                                <li><a href="<?php echo base_url('artistic/art_information'); ?>">Art information</a></li>
                                <li><a href="<?php echo base_url('artistic/art_portfolio'); ?>">Portfolio</a></li>
                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active" <?php } ?>><a href="#">Skills</a></li>
                                
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
 
                    <div class="col-md-6 col-sm-8">
                     <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>

                         <div class="common-form">
                         <h3>Skills</h3>
                            <?php echo form_open_multipart(base_url('artistic/art_skills_insert'), array('id' => 'artskills','name' => 'artskills','class' => 'clearfix')); ?>
                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 

                            <?php
                             $skills =  form_error('skills');
                         ?>


                                <fieldset>
                                    <label>Best of mine:</label>
                                    <input type="file" name="bestofmine" id="bestofmine" placeholder="Enter Best of mine" /><span id="bestofmine-error"></span>
                                    
                                </fieldset>
                                 

                                <fieldset>
                                    <label>Achievmeant:</label>
                                    <input name="achievmeant"  type="file" id="achievmeant" placeholder="Enter Achievmeant" /><span id="achievmeant-error"></span>
                                 
                                </fieldset>
                               

                                <fieldset class="full-width">
                                    <label>Skills:<span style="color:red">*</span></label>
                                    
                                     <select class="" name="skills[]" id="skills" multiple="multiple" required>
                                </select>
                                     <?php echo form_error('skills'); ?> 
                                </fieldset>
                                


                                 <fieldset class="hs-submit full-width">
                                   
                                    <a href="<?php echo base_url('artistic/art_portfolio'); ?>">Previous</a>
                                    
                                    <input type="submit"  id="submit" name="submit" value="Submit">
                                    <input type="reset">
                                </fieldset>

                            </form>
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>
    </section>
   <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    <footer>
        
        <?php echo $footer;  ?>
    </footer>
    
</body>
</html>

  <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#artskills").validate({

                    rules: {

                        skills: {

                            required: true,
                         
                        }

                      
                        
                    },

                    messages: {

                        skills: {

                            required: "Skills Is Required.",
                            
                        }

                    
                       
                },

                });
                   });
  </script>

<!-- script for skill textbox automatic Start (option 2)-->

  
  <script src="<?php echo base_url('js/select2-4.0.3.min.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>
//select2 autocomplete start for skill
$('#skills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/keyskill",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
              

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for skill

</script>


    <!-- footer end -->