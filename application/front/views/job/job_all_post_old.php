<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<!-- <header>
    <div class="bg-search">
        <div class="header2">
            <div class="container">
                <div class="row">
                  <div class="col-md-2 col-sm-5">
                       <div class="pushmenu pushmenu-left">
                            <ul class="">
                                <li><a href="javascript:void(0);">HOME</a></li>

 -->                                <!-- Friend Request Start-->
<!-- 
                                <div>

                                </div>
 -->                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
<!--                             </ul>
                        </div> 
                    </div>
                  
                     <div class="col-md-10 col-sm-10">
                        <div class="job-search-box1 clearfix">
                        <form>
                            <fieldset class="col-md-5">
 -->                             <!--    <label>Find Your Skills</label>
                              --> <!--   <input type="text" name="" placeholder="Find Your Skill">
                            </fieldset>
                            <fieldset class="col-md-5">
                              --><!--    <label>Find Your Location</label>
                              -->  <!--  <input type="text" name="" placeholder="Find Your Location">
                            </fieldset>
                            <fieldset class="col-md-2">
                                <button> Search</button>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div> 
    </header>
     -->
<body class="page-container-bg-solid page-boxed">

<section>
   <div>
        <div class="container">
            <div class="profile-banner">
                
            </div>
            <div class="profile-photo">
              <div class="profile-pho">

                <div class="user-pic">
                        <?php if($jobdata[0]['job_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $jobdata[0]['job_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>
                        
                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="1">
                        <input type="submit" name="cancel1" id="cancel1" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                     <?php  echo form_close();?>
                </div>

                </div>
                <div class="col-md-2 col-sm-2 col-xs-4"></div>
                 <div class="job-menu-profile">
                    <a  href="<?php echo site_url('job/job_printpreview/'.$jobdata[0]['user_id']); ?>"><h5 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' '.$jobdata[0]['lname']; ?></h5></a>
                    
                        <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                     if($jobdata[0]['designation'] == '')
                     {
                     ?>
                     <center><a id="myBtn">Designation</a></center>
                     <?php }else{?> 
                      <center><a id="myBtn"><?php echo ucwords($jobdata[0]['designation']); ?></a></center>
                      <?php }?>
                  

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                      <!-- Modal content --><div class="col-md-2"></div>
                      <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
                         <?php echo form_open(base_url('job/job_designation/'), array('id' => 'jobdesignation','name' => 'jobdesignation', 'class' => 'clearfix')); ?>

  <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php echo $jobdata[0]['designation']; ?>">
<?php echo form_error('designation'); ?>
  </fieldset>
         <input type="hidden" name="hitext" id="hitext" value="1">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php echo form_close();?>
  
                    
                     
                    </div>
                    <div class="col-md-2"></div>
              </div>
            </div>

            <!-- text head end -->
                    </div>
              </div>
            </div>
        </div>
       </div>

       <?php echo $job_search; ?>

     <!---middle section start -->
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                   <?php echo $job_left; ?>  
     <!--- middle section end -->

                    <div class="col-md-7 col-sm-7">
                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Recommended Job</h3>
                                <div class="contact-frnd-post">
<?php 

  if($falguni == 1)
  {
 foreach($postdetail as $post_key => $post_value){

    if(count($post_value) > 0){

      foreach($post_value as $post){  

     //  $contition_array = array('post_id' => $post['post_id'],'user_id' => '1');
     // $jobdata = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     $userid = $this->session->userdata('aileenuser');
       $contition_array = array('user_id'=> $userid,'post_id' => $post['post_id'],'job_delete' =>0);
       $jobdata =  $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
                            
if($jobdata[0]['job_save'] != 2){ 
        ?> 

                                    <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title-inside clearfix">
                                                <div class="profile-job-post-location-name">
                                                    <ul>
                                                    
                                                       <li><?php echo $post['post_name']; ?></li>

                                                      <li><a href="<?php echo base_url('recruiter/rec_profile/'.$post['user_id']); ?>"><?php 
                                                      $cache_time  =  $this->db->get_where('recruiter',array('user_id' => $post['user_id']))->row()->re_comp_name;  
                                                  
                                                            echo  ucwords($cache_time);
                                                            ?></a></li>

                                                             <li><a href="<?php echo base_url('recruiter/rec_profile/'.$post['user_id']); ?>"><?php 
                                                      $cache_time  =  $this->db->get_where('recruiter',array('user_id' => $post['user_id']))->row()->rec_firstname;  
                                                  
                                                            echo  ucwords($cache_time);
                                                            ?></a></li>
                                                     
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details col-md-12">
                                                        <ul>
                                                            <li>
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year"  . "Required" ; ?>"><i class="fa fa-star-o" aria-hidden="true"></i>       <?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?> </a>
                                                             
                                                            </li>
                                                           
                                                            <li>

                                                            <?php 
                 $cityname =  $this->db->get_where('cities',array('city_id' => $post['city']))->row()->city_name;?>
                                                                <p><i class="fa fa-map-marker" aria-hidden="true"><?php echo  $cityname;  ?></i></p>
                                                            </li>

                                                            <li class="fr">

                                                           Created Date:<?php 
                                                    echo date('d-M-Y',strtotime($post['created_date']));
                                                            ?>
                                                       
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Skills:</b> <span> 
                                                        <?php
                                                        $comma = ",";
                                                        $k=0;
                                                        $aud=$post['post_skill'];
                                                        $aud_res=explode(',',$aud);
                                                        foreach ($aud_res as $skill)
                                                        {
                                                            if($k!=0)
                                                            {
                                                               echo $comma;
                                                            }
                                                            $cache_time  =  $this->db->get_where('skill',array('skill_id' => $skill))->row()->skill;  
                                                             //$skill1[]= $cache_time;

                                                            echo  $cache_time;
                                                           $k++;
                                                        }
                                                        ?>       
                                                        </span>
                                                        </li>
                                                       

                                                       <?php if($post['other_skill']) { ?>
                                                       <li><b>Other Skill:</b><span><?php echo $post['other_skill']; ?></span>
                                                        </li>
                                                        <?php }else{?>
                                                        <li><b>Other Skill:</b><span><?php echo "-"; ?></span></li><?php }?>

                                                        <li><b>Job Description:</b><span><?php echo $post['post_description']; ?></span>
                                                        </li>

                                                        <?php if($post['min_sal']){ ?>
                                                        <li><b>Minimum Salary:</b><span><?php echo $post['min_sal']; ?></span>
                                                        </li>
                                                        <?php }else{?>
                                                        <li><b>Minimum Salary:</b><span><?php echo "-"; ?></span>
                                                        </li><?php }?>

                                                          <?php if($post['max_sal']){?>
                                                         <li><b>Maximum Salary:</b><span><?php echo $post['max_sal']; ?></span>
                                                        </li>
                                                        <?php }else{?>
                                                        <li><b>Maximum Salary:</b><span><?php echo "-" ; ?></span>
                                                        </li><?php }?>

                                                        <li><b>No of Position:</b><span><?php echo $post['post_position']; ?></span>
                                                        </li>
                                                        
                                                        
                                                    </ul>
                                                </div>
                                               <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details col-md-12">
                                                    <ul><li>

                                                           Last Date:<?php 
                                                    echo date('d-M-Y',strtotime($post['post_last_date']));
                                                            ?>
                                                            </li>
                                                           
<?php
       // $userid = $this->session->userdata('aileenuser');
       // $contition_array = array('user_id'=> $userid,'post_id' => $post['post_id'],'job_delete' =>0);
       // $jobdata =  $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

       if($jobdata[0]['job_save'] == 1)
       {

?>
    
      <button  class="button" disabled>Applied</button>

<?php
        }
        else
        {
?>
     <li class="fr"> <a href="<?php echo base_url('job/job_apply_post/' . $post['post_id']. '/all/'. $post['user_id']); ?>"  class="button">Apply</a></li>
     <li class="fr">
      <a href="<?php echo base_url('job/job_save/' . $post['post_id']); ?>" class="button">Save</a></li>
<?php
       }
?>
                                                     
                                                    </div>
                                                       
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
<?php } } }else{echo  'no data available';} } } else{ //echo "falguni"; die();


 if(count($postdetail) > 0){
foreach($postdetail as $post_key => $post){ //echo "falgungi"; die();

     //  $contition_array = array('post_id' => $post['post_id'],'user_id' => '1');
     // $jobdata = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = 'post_id', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     $userid = $this->session->userdata('aileenuser');
       $contition_array = array('user_id'=> $userid,'post_id' => $post['post_id'],'job_delete' =>0);
       $jobdata =  $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 
                            
if($jobdata[0]['job_save'] != 2){ 
        ?> 

                                    <div class="job-contact-frnd ">

                                        <div class="profile-job-post-detail clearfix">
                                            <div class="profile-job-post-title-inside clearfix">
                                                <div class="profile-job-post-location-name">
                                                    <ul>
                                                    

                                                      <li><a href="<?php echo base_url('recruiter/rec_profile/'.$post['user_id']); ?>"><?php 
                                                      $cache_time  =  $this->db->get_where('recruiter',array('user_id' => $post['user_id']))->row()->rec_firstname;  
                                                  
                                                            echo  $cache_time;
                                                            ?></a></li>
                                                      <li><?php echo $post['post_name']; ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?>"><i class="fa fa-star-o" aria-hidden="true"></i>       <?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?></a>
                                                             <!--    <p   data-toggle="tooltip" data-placement="top" title=" "> <i class="fa fa-lock"  aria-hidden="true"></i> <?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?></p> -->
                                                            </li>
                                                           <!--  <li>
                                                              <p> <abbr title="<?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?>""> <?php echo $post['exp_month'] . "month  " . $post['exp_year'] . "year" ; ?></abbr></p>
       
                                                            </li> -->
                                                            <li>

                                                            <?php 
                 $cityname =  $this->db->get_where('cities',array('city_id' => $post['city']))->row()->city_name;?>
                                                                <p><i class="fa fa-map-marker" aria-hidden="true"><?php echo $cityname; ?></i></p>
                                                            </li>
                                                           
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Skills:</b> <span> 
                                                        <?php
                                                        $comma = ",";
                                                        $k=0;
                                                        $aud=$post['post_skill'];
                                                        $aud_res=explode(',',$aud);
                                                        foreach ($aud_res as $skill)
                                                        {
                                                            if($k!=0)
                                                            {
                                                               echo $comma;
                                                            }
                                                            $cache_time  =  $this->db->get_where('skill',array('skill_id' => $skill))->row()->skill;  
                                                             //$skill1[]= $cache_time;

                                                            echo  $cache_time;
                                                           $k++;
                                                        }
                                                        ?>       
                                                        </span>
                                                        </li>
                                                       
                                                        <li><b>Job Description:</b><span><?php echo $post['post_description']; ?></span>
                                                        </li>
                                                        
                                                        <div class="pull-right">
                                                           <?php echo $post['created_date']; ?>
                                                        </div>
                                                    </ul>
                                                </div>
                                                <div class="profile-job-profile-button clearfix">
                                                    <div>
<?php
       // $userid = $this->session->userdata('aileenuser');
       // $contition_array = array('user_id'=> $userid,'post_id' => $post['post_id'],'job_delete' =>0);
       // $jobdata =  $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

       if($jobdata[0]['job_save'] == 1)
       {

?>
    
      <button  class="button" disabled>Applied</button>

<?php
        }
        else
        {
?>
      <a href="<?php echo base_url('job/job_apply_post/' . $post['post_id']. '/all/'. $post['user_id']); ?>"  class="button">Apply</a>
      <a href="<?php echo base_url('job/job_save/' . $post['post_id']); ?>" class="button">Save</a>
<?php
       }
?>
                                                     
                                                    </div>
                                                       
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
<?php } } }else{ echo  'no data available'; } }?>

                                </div>


                            </div>
                        </div>
                    </div>
    </section>
   <!--  <footer>
         <?php //echo $footer;  ?>
    </footer> -->

</body>
</html>
<!-- script for skill textbox automatic start (option 2)-->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 -->  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>
//select2 autocomplete start for skill
$('#searchskills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>job/keyskill",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
              //alert(data);

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax:{

         
          url: "<?php echo base_url(); ?>job/location",
          dataType: 'json',
          delay: 250,
          
          processResults: function (data) {
            
            return {
              //alert(data);

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location

</script>

<script>
//tooltip
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
    
});
</script>






<!-- popup form edit start -->

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
 

<!-- popup form edit END -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#jobdesignation").validate({

                    rules: {

                        designation: {

                            required: true,
                         
                        },

                        
                        
                    },

                    messages: {

                        designation: {

                            required: "Designation Is Required.",
                            
                        },

                        
                },

                });
                   });
  </script>
