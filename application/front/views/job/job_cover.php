 <div>
        <div class="container">
            <div class="profile-banner">
                
            </div>
            <div class="profile-photo">
              <div class="profile-pho">

                <div class="user-pic">
                        <?php if($job[0]['job_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $job[0]['job_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>
                        
                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="2">
                        <input type="submit" name="cancel2" id="cancel2" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                    </form>

                </div>
                <h6 align="center" class="profile-head-text"> <?php echo $userdata[0]['first_name'] . $userdata[0]['last_name']; ?></h6>
                    <div class="profile-text" >
                        <p align="center">Jr. Owner</p>
                    </div>
              </div>
            </div>
        </div>
       </div>
       