
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
                                <li><a href="<?php echo base_url('newsfeed'); ?>">News Feed</a></li>
                                 <li><a href="#">Notification & Friend Request</a></li>
                                
                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
                    <div class="col-md-6 col-sm-8">
                        <div class="job-post-detail clearfix">
                            <div class="exper-location">
                               <center> <span>Friend Request</span></center>
                            </div>

                            <div class="job-about">
                            <!-- <?php //echo form_open(base_url(''), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform')); ?> -->

                            <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>

                                <div>
                                         
                                   
    <?php
                                         
    $userid = $this->session->userdata('aileenuser');
     foreach($friend as $cnt)
     {
                                        
        if ($cnt['user_id'] ==  $userid)
        {
                            
            echo "";
        }
        else
        {
                           
        ?> 

        <img alt="" class="img-circle" src="<?php echo base_url(USERIMAGE . $cnt['user_image']);?>" height="50" width="50" alt="Smiley face" />         
                                                
        USER ID: <?php echo $cnt['user_id']; ?><br>
        USER NAME:<?php echo $cnt['user_name']; ?><br>
        FIRST NAME:<?php echo $cnt['first_name']; ?>&nbsp;<?php echo $cnt['last_name']; echo "<br>";

        //for button change Approved start
        $contition_array = array('relation_from_id' => $userid ,'relation_to_id' => $cnt['user_id']);
        $friendstatus = $this->common->select_data_by_condition('relation', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

      //echo "<pre>"; print_r($friendstatus);exit();

 //main if condition start
if ($friendstatus[0]['relation_status'] == 3 || $friendstatus[0]['relation_status'] == '' )
            {

           
         //condition array for change button to friends start at confirm user
        $contition_array = array('relation_to_id' => $userid ,'relation_from_id' => $cnt['user_id']);
        $friend_status = $this->common->select_data_by_condition('relation', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

            if ($friend_status[0]['relation_status'] == 1 )
            {
            ?>

                <button style= "background-color: #4CAF50; /* Green */border: none;color: white;" >Friends</button>

                <?php
                        }
                //condition array for change button to friends end at confirm user

                //condition array for change button to Request Sent start
                elseif ($friend_status[0]['relation_status'] == 2 )
                {  
                ?>
 
                    <button style= "background-color: #BCB4DF; /* Green */border: none;color: white;"><a href="#">Friend Request Already Sent</a></td></button>
             <?php
                }

                //condition array for change button to Request Sent end

                //condition array for change button to Add Friend start
                else
                {
                ?>
                    <button style= "background-color: #64B2D6; /* Green */border: none;color: white;"><a href="<?php echo base_url('friendrequest/friendrequest_addfriend_insert/'.$cnt['user_id'].''); ?>">Add Friend</a></td></button>

                <?php
                }
            //condition array for change button to Add Friend end
                ?> <br><br>
                <?php
    }
    //main if condition end

    //condition array for change button to Friend Request Sent and cancel start
    elseif ($friendstatus[0]['relation_status'] == 2 )
    {

        $contition_array = array('relation_from_id' => $userid ,'relation_to_id' => $cnt['user_id']);
                                                
        $friendstatus_cancel= $this->common->select_data_by_condition('relation', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
            //echo "<pre>"; print_r( $friendstatus_cancel);exit();


            ?>

            <button style= "background-color: #DE9F8C; /* Green */border: none;color: white;"><a href="#">Friend Request Sent</a></td></button>

            <button style= "background-color: #D4ADDE;  /* Green */border: none;color: white;" ><a href="<?php echo base_url('friendrequest/friendrequest_cancel_update/'. $friendstatus_cancel[0]['relation_to_id'].''); ?>">Cancel</a></button>
            <br><br>
            <?php

            }
            //condition array for change button to Friend Request Sent and cancel start

            //condition array for change button to Friends start at sender side
            elseif ($friendstatus[0]['relation_status'] == 1 )
            {
            ?>
                <button style= "background-color: #4CAF50; /* Green */border: none;color: white;" >Friends</button>
                <br><br>
            <?php
             }

            //condition array for change button to Friends  end  at sender side
            else 
                                                           
            {
                echo "";
            ?>                                               

            <br><br>

            <?php 
                }
                //else bracket end
            }
            //second else bracket end
        }
        //for each bracket end
            //for button change Approved end
                                        
            ?>               
                 </div>

                                </form>
                            </div>    
                        </div>
                    </div>
                    <!-- middle section end -->

                    <!-- Role model section start-->
                    <!-- <div class="col-md-3 col-sm-12">
                        <div class="role-model">
                            <div class="role-model-title">
                                Role Model
                            </div>
                            <div class="role-model-img">
                                <img src="../images/sunny-deol.jpg">
                            </div>
                            <div class="role-model-detail">
                                <h6>Sunny Deol</h6>
                                <span>acter</span>
                                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas.</p>
                            </div>
                        </div>
                    </div> -->
                    <!-- Role model section End-->
                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <!-- footer start -->
    <footer>
       <!--  <div class="footer text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-logo">
                            <a href="index.html"><img src="images/logo-white.png"></a>
                        </div>
                        <ul>
                            <li>E-912 Titanium City Center Anandngar Ahmedabad-380015</li>
                            <li><a href="mailto:AileenSoul@gmail.com">AileenSoul@gmail.com</a></li>
                            <li>+91 903-353-8102</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
    <?php echo $footer;  ?>
    </footer>
    
</body>
</html>


    <!-- footer end -->
    <!-- end footer -->
    