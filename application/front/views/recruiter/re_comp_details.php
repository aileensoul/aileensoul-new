<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-profile">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="user-img pull-left">
                            <?php if($userdata[0]['user_image'] != ''){ ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="50" width="50" alt="Smiley face" />
                        <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" height="50" width="50" alt="Smiley face" />
                        <?php } ?>
                        </div>
                        <div class="user-detail pull-left">
                            <h6><?php echo $userdata[0]['first_name'] . $userdata[0]['last_name']; ?></h6>
                            <span>Designation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                                
                                <li><a href="<?php echo base_url('job'); ?>">Job Seeker</a></li>
                                <li><a href="<?php echo base_url('recruiter'); ?>">Recruiter</a></li>
                                <li><a href="<?php echo base_url('freelancer'); ?>">Freelancer</a></li>
                                <li><a href="<?php echo base_url('business_profile'); ?>">Bussiness Profile</a></li>
                                <li><a href="<?php echo base_url('artistic'); ?>">Artistic Person</a></li>
                                <li><a href="<?php echo base_url('newsfeed'); ?>">News Feed</a></li>
                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8">

                    <!--- middle section start -->
                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>
                  
                   <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div>

                    <div>
                        <label> Postal address:<span style="color:red">*</span></label>
                        <div>
                       <?php echo form_textarea(array('name' => 'post_desc', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => '','placeholder' => "Enter Post Description")); ?>
                        </div>
                    </div>
                    <!-- <?php echo form_error('city'); ?> -->
                    
                     <div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-success pull-right" id="submit" name="submit" value="save"><br/><br/>
                        </div>
                        
                <div >
                    <input type="reset" class="btn btn-danger">
                </div>

                <div >
                    <input type="button" value="Add new section" class="btn btn-danger">
                </div>
            </div>

        </form>
        <hr />  
    
 <!--- middle section end -->
                       
                       
                        
                       
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->
<script type="text/javascript">
function checkvalue(){
   //alert("hi");
  var searchkeyword=$.trim(document.getElementById('tags').value);
  var searchplace=$.trim(document.getElementById('searchplace').value);
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
     //alert('Please enter Keyword');
    return false;
  }
}
  
</script>

<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

