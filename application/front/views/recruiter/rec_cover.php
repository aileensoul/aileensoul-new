 <div>
            <div class="container" id="paddingtop_fixed">
                <div class="profile-banner">

                </div>  
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic">
                        <?php if($recdata[0]['recruiter_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $recdata[0]['recruiter_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div> 
                        
            <div id="popup-form">
                        <?php echo form_open_multipart(base_url('recruiter/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="4">
                        <input type="submit" name="cancel4" id="cancel4" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                    </form>

                        </div>

                    </div>
                    <div class="col-md-2 col-sm-2"></div>
                      <div class="job-menu-profile">
                          <h4>Dhaval Shah</h4>
                          <p>Jr. Owner</p>
                      </div>
                </div>
            </div>
        </div>