<!-- menubar --> 
<?php
 $returnpage= $_GET['page'];
 $userid = $this->session->userdata('aileenuser');?>
   <div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">

                <div class=" right-side-menu art-side-menu padding_less_right right-menu-jr">  
     <?php 
               $userid = $this->session->userdata('aileenuser');
               if($jobdata[0]['user_id'] == $userid){
               
               ?>     
               <ul class="current-user pro-fw">
                   
                   <?php }else{?>
                 <ul class="pro-fw4">
                   <?php } ?>  
                                  
                                <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_printpreview'){?> class="active" <?php } ?>>

                                     <?php if($returnpage == 'recruiter'){?>
     <a title="Details" href="<?php echo base_url('job/job_printpreview/'.$this->uri->segment(3).'?page='.$returnpage); ?>">Details</a>
        <?php }else{?>
     <a title="Details" href="<?php echo base_url('job/job_printpreview/'); ?>">Details</a>
        <?php }?>

                               
                                    </li>
 <?php
                                    if(($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser')|| $this->uri->segment(3) == '')) { ?>

                                    <!-- <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_resume'){?> class="active" <?php } ?>><a title="Resume" href="<?php echo base_url('job/job_resume'); ?>">Resume</a>
                                    </li> -->

                                     <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_save_post'){?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/job_save_post'); ?>">Saved </a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_applied_post'){?> class="active" <?php } ?>><a title="Applied Job" href="<?php echo base_url('job/job_applied_post'); ?>">Applied </a>
                                    </li>

                                    <?php }?>

      
</ul>

                <div class="flw_msg_btn fr">
                    <ul>

                         <!-- <li class="fruser2">
                                <div id="unfollowdiv">
                                <a id="unfollow2" onclick="unfollowuser(2)"> Following</a>
                                </div>
                        </li> -->
                        
                       <?php 
                       //echo $this->uri->segment(3);
                       //echo $userid; die();

        if($this->uri->segment(3) != ""){ 
            if($this->uri->segment(3) != $userid){
                ?>
                         
                         <?php
              
            $contition_array = array('from_id' => $userid, 'to_id' => $this->uri->segment(3), 'save_type' => 1, 'status' => '0');
             $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                //echo "<pre>"; print_r($data); die();
             if ($data) {
          ?> 
                        <li> 
                 <a class=" butt_rec  save_saved_btn">Saved</a>
                           

                           <!--  <input type="hidden" id="<?php echo 'hideenuser' . $this->uri->segment(3); ?>" value= "<?php echo $this->uri->segment(3); ?>"> -->
                    
                        </li>
                                                                <?php } else{ ?>
                        <li> 
                         <a id="<?php echo $this->uri->segment(3); ?>" onClick="savepopup(<?php echo $this->uri->segment(3); ?>)" href="javascript:void(0);" class= "save_saved_btn <?php echo 'saveduser' . $this->uri->segment(3); ?>">
                        Save
                    </a>
                        </li>
                                                                <?php } ?>
                       <li> <a href="<?php echo base_url('chat/abc/' . $this->uri->segment(3)); ?>">Message</a> </li>
                       <?php } }?>
                    </ul>
                </div>
</div>
<!-- 
       <div class="col-md-3 padding_less_right" style="width: 30%">

            </div> -->
        <!-- <div class="col-md-3">

        </div> -->
</div>

