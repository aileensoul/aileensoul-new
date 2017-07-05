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
                            <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $userdata[0]['user_image']);?>" height="300" width="100" alt="Smiley face" />
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
        <div class="user-midd-section">
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
                                <li><a href="<?php echo base_url('message'); ?>">Message</a></li>
                                
                            </ul>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-8">
                     <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                        
                        
                       <!--  <div class="job-post-detail clearfix">  -->
                            <div class="job-post-title">
                                <!-- <h6><?php echo $friend[0]['user_name']; ?></h6>  --> 
                            </div>
                                <?php if(is_set($msg_chat) && count($msg_chat) > 0){
                                foreach($msg_chat as $row)
                                { 
                                       if($row['message_from'] != $userid){ 
                $username  =  $this->db->get_where('user',array('user_id' => $row['message_from']))->row()->first_name;
                                ?>

                                <div> 
                                <?php  
                                echo $username; echo"<br/>";
                                ?>
                                </div>

                                <?php
                                       }
                                       else{
                                        ?>

                                        <div>
                                        <?php 
                                         echo $toname[0]['first_name'];echo"<br/>";
                                         ?>
                                         </div>

                                         <?php
                                       } ?> 
                                     <div>
                                     <?php 
                                     echo $row['message']; echo"<br/>";
                                     ?>
                                     </div>
                                     <?php
                                    } }
                                 
                            ?>
                               
                             <?php echo form_open(base_url('message/message_insert/'.$id.''), array('id' => 'message_chat','name' => 'message_chat', 'class' => 'clearfix')); ?>

                             <div>
                             <textarea name="msg_chat" id="msg_chat"></textarea>
                             </div>
                             <div>
                             <input type="submit" name="chatsubmit" id="chatsubmit">
                             </div>
                             <?php echo form_close(); ?>

                            
                       <!--  </div> -->
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#msg_chat').on('change',function(){ alert("hello");
        var msg_chat = $(this).val();
        if(msg_chat){
            $.ajax({
                type:'POST',
                url:'<?php //echo base_url() . "message/ajax_data"; ?>',
                data:'message='+msg_chat,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
     -->