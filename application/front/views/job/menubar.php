<!-- menubar --> 
<?php
   $returnpage= $_GET['page'];
   $userid = $this->session->userdata('aileenuser');?>
<div class="profile-main-rec-box-menu profile-box-art col-md-12 padding_les">
   <div class=" right-side-menu art-side-menu padding_less_right job_edit_pr right-menu-jr <?php if($returnpage == 'recruiter'){echo "job_data_left_menubar";}?>">
      <?php 
         $userid = $this->session->userdata('aileenuser');
         if($jobdata[0]['user_id'] == $userid){
         
         ?>     
      <ul class="current-user pro-fw">
      <?php }else{?>
      <ul class="pro-fw4">
         <?php } ?>  
         <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'resume'){?> class="active" <?php } ?>>
            <?php if($returnpage == 'recruiter'){?>
            <a title="Details" href="<?php echo base_url('job/resume/'.$this->uri->segment(3).'?page='.$returnpage); ?>">Details</a>
            <?php }else{?>
            <a title="Details" href="<?php echo base_url('job/resume/'); ?>">Details</a>
            <?php }?>
         </li>
         <?php
        
            if(($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'home' || $this->uri->segment(2) == 'resume' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'saved-job' || $this->uri->segment(2) == 'applied-job') && ($userid == $id)) { ?>
         <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'saved-job'){?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/saved-job'); ?>">Saved </a>
         </li>
         <li <?php if($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'applied-job'){?> class="active" <?php } ?>><a title="Applied Job" href="<?php echo base_url('job/applied-job'); ?>">Applied </a>
         </li>
         <?php }
         ?>
      </ul>
    
            <?php 
               if($this->uri->segment(3) != ""){ 
                   if($returnpage == 'recruiter'){
                       ?>
                          <div class="flw_msg_btn fr">
         <ul>
            <?php

               $id = $this->db->get_where('job_reg', array('slug' => $this->uri->segment(3), 'is_delete' => '0', 'status' => '1'))->row()->user_id;

               $contition_array = array('from_id' => $userid, 'to_id' => $id, 'save_type' => '1', 'status' => '0');
                $data = $this->common->select_data_by_condition('save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                  
                if ($data) {
               ?> 
   
            <li> 
               <a class=" butt_rec  save_saved_btn">Saved</a>
            </li>
            <?php } else{ ?>
            <li> 
               <a id="<?php echo 'saveduser' . $id; ?>" onClick="savepopup(<?php echo $id; ?>)" href="javascript:void(0);" class= "save_saved_btn <?php echo 'saveduser' . $id; ?>">
               Save
               </a>
            </li>
            <?php } ?>
            <li> 
               <a href="<?php echo base_url('chat/abc/2/1/' . $id); ?>">Message</a> 
            </li>
           </ul>
      </div>              <?php } }?>
        

   </div>
</div>