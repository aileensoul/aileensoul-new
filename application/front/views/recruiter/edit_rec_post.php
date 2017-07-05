<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
      <link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet" type="text/css" />
<?php echo $header; ?>
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        <div class="user-profile" id="paddingtop_fixed" >
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
                                <li><a href="#">Freelancer</a></li>
                                <li><a href="#">Bussiness Profile</a></li>
                                <li><a href="#">Artistic Person</a></li>
                                <li><a href="#">Artistic Person</a></li>
                                <li><a href="#">Artistic Person</a></li>
                                <li><a href="#">Artistic Person</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8">

                    <div>
                        <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                    </div>

                    <div class="common-form">
                    <h3>Edit REC Post</h3>

                    <input action="action" type="button" value="Back" onclick="history.back();" /><br/><br/>
                    
                 <?php echo form_open(base_url('recruiter/add_post_store'), array('id' => 'basicinfo','name' => 'basicinfo','class' => 'clearfix')); ?>

                    <div><span style="color:red">Fields marked with asterisk (*) are mandatory</span></div> 

                    <fieldset>
                        <label">Post name:<span style="color:red">*</span></label>
                        <input name="post_name" type="text" id="post_name" onblur="return full_name();"/>
                        <span id="fullname-error"></span>
                        <?php echo form_error('post_name'); ?>
                    </fieldset>
                    <fieldset>
                        <label class="col-sm-4 control-label">Skills:<span style="color:red">*</span></label>
                        <input name="skills" type="text" id="skills" onblur="return full_name();"/><span id="fullname-error"></span>
                        <?php echo form_error('skills'); ?>
                    </fieldset>
                    <fieldset> 
                     <label class="col-sm-4 control-label">Experience:<span style="color:red">*</span></label>
                            <select name="month">
                            <option value="">Month</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                               </select>
                            <select name="year">
                            <option value="">Year</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            </select>
                            <span id="fullname-error"></span>
                            <?php echo form_error('month'); ?>
                    </fieldset>
                    <fieldset>
                        <label class="col-sm-4 control-label">No of position:<span style="color:red">*</span></label>                        
                            <input name="position" type="number" min="1" id="position" value="1" onblur="return full_name();"/>
                            <span id="fullname-error"></span>
                            <?php echo form_error('position'); ?>
                    </fieldset>
                    <fieldset>
                        <label class="col-sm-2 control-label">Post description:<span style="color:red">*</span></label>
                        <?php echo form_textarea(array('name' => 'post_desc', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($emailformat_detail[0]['varmailformat']))); ?>
                        <?php echo form_error('post_desc'); ?>
                    </fieldset>
                    <fieldset>
                        <label class="col-sm-2 control-label">Interview process:<span style="color:red">*</span></label>
                        <?php echo form_textarea(array('name' => 'interview', 'id' => 'varmailformat', 'class' => "ckeditor", 'value' => html_entity_decode($emailformat_detail[0]['varmailformat']))); ?>
                        <?php echo form_error('interview'); ?> 
                    </fieldset>
                    <fieldset>
                        <label class="col-md-3 control-label">Last date for apply:<span style="color:red">*</span></label>
                        <input type="text" name="last_date" placeholder="Enter user birthdate" id="datepicker" value=""class="form-control" placeholder="Enter text">
                        <?php echo form_error('last_date'); ?>       
                    </fieldset>
                    <fieldset>
                        <label>Location:<span style="color:red">*</span></label>                  
                        <input name="location" type="text" id="location" onblur="return full_name();"/><span id="fullname-error"></span>
                        <?php echo form_error('location'); ?>
                    </fieldset>
               <fieldset class="full-width hs-submit">
                    <input type="submit" id="submit" name="submit" value="save">
                    <input type="reset">
                </fieldset>
            </div>

        </form>
        <hr/>  
                       
                       
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
      <script type="text/javascript" src="<?php echo site_url('js/jquery-1.11.1.min.js') ?>"></script>
         <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
        <script>
  $( function() {

    $( "#datepicker" ).datepicker();
  } );
  </script>

