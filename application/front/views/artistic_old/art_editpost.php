<?php  echo $head; ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>

    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                       <?php echo $artistic_left; ?>
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
                    
                        <div>

                        <div class="common-form">
                            <h3>Art Edit Post</h3>
                             <?php echo form_open_multipart(base_url('artistic/art_editpost_insert/'.$artdata[0]['art_post_id']), array('id' => 'artpost','name' => 'art','class' => 'clearfix')); ?>
                            <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>
                                
                            
                            <fieldset>
                                <label>Post Name:<span style="color:red">*</span></label>
                                <input type="text" name="postname" id="postname" value="<?php echo $artdata[0]['art_post'];?>">  
                                 <?php echo form_error('postname'); ?>
                            </fieldset>

                             <fieldset>
                                    <label>Skills:<span style="color:red">*</span></label>
                                    

                                    <select name="skills[]" id ="skill1" multiple="multiple" style="width:270px " class="skill1" required >

                                 <?php foreach ($skill1 as $skill) { ?>
                                <option value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill']; ?></option>
                                  <?php } ?>

                                </select>

                                     <?php echo form_error('skills'); ?> 
                                </fieldset>

                            <fieldset>
                                <label>Other skill:</label>
                                <input type="text" class="left skill-group" name="other_skill" id="other_skill" placeholder="Enter Other Skill" value="<?php echo $artdata[0]['other_skill'];?>"> 
                                <?php echo form_error('other_skill'); ?>
                            </fieldset> 

                            <fieldset class="full-width">
                                <label>Description:<span style="color:red">*</span></label>
                                <textarea id="description" name="description"><?php echo $artdata[0]['art_description']; ?></textarea>
                               
                                <?php echo form_error('description'); ?>
                            </fieldset> 
                            
                            <fieldset class="full-width">
                                <label>Attachment:</label>
                                <input type="file" name="postattach" id="postattach"> 

                                                        
                                                            <?php
                                                       $allowed =  array('gif','png','jpg');
                                                       $allowespdf = array('pdf');
                                                       
                                                       $filename = $artdata[0]['art_attachment'];
                                                       

                                                       $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                      

                                                       if(in_array($ext,$allowed) ) 
                                                       { 
                                                         
                                                          ?>
                                                         
                                                       <img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path').$artdata[0]['art_attachment'])?>" style="width:100px;height:100px;"> 
                                                          <?php
                                                       }
                                                       elseif(in_array($ext,$allowespdf))
                                                       { ?>


                                                        <a href="<?php echo base_url('artistic/creat_pdf/'.$artdata[0]['art_post_id']) ?>">PDF</a>
                                                       <?php }
                                                       else
                                                       {
                                                        
                                                       ?>

                                                        <video width="320" height="240" controls>
                                                          <source src="<?php echo base_url($this->config->item('art_post_main_upload_path').$artdata[0]['art_attachment']); ?>" type="video/mp4">
                                                          <source src="movie.ogg" type="video/ogg">
                                                          Your browser does not support the video tag.
                                                       </video>
                                                       <?php
                                                        }
                                                       ?>
                                                         
<!--video and audio display end -->

                                <input type="hidden" name="hiddenimg" id="hiddenimg" value="<?php echo $artdata[0]['art_attachment']; ?>">   
                            </fieldset>
                            <fieldset class="hs-submit full-width">

                                 <input type="reset" name="reset" value="Clear">
                                <input type="submit" name="arteditpost" id="arteditpost">
                               
                            </fieldset>
                           
                            </form>             
                        </div></div>
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


    <!-- footer end-->


 <!-- for script skills  --> 
 
<script type="text/javascript" src="<?php echo base_url('js/3.3.0/select2.js'); ?>"></script>
    <script>

var complex = <?php echo json_encode($selectdata); ?>;

$("#skill1").select2().select2('val',complex)

</script>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>


    <!-- footer end-->

<!-- auto search skills end -->