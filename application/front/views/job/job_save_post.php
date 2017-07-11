<!-- start head -->
<?php echo $head; ?>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>


<!--post save success pop up style end -->



<!-- END HEAD -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />


<body   class="page-container-bg-solid page-boxed custom-border">
    <!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->

<?php echo $job_header2_border; ?>

    <section class="custom-row">
        <div class="container" id="paddingtop_fixed">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo"></div>
                </div>
                <div class="col-md-12 cover-pic" >
                    <button class="btn btn-success cancel-result" onclick="" >Cancel</button>

                    <button class="btn btn-success set-btn upload-result" onclick="myFunction()">Save</button>

                    <div id="message1" style="display:none;">
                        <div id="floatBarsG">
                                <div id="floatBarsG_1" class="floatBarsG"></div>
                                <div id="floatBarsG_2" class="floatBarsG"></div>
                                <div id="floatBarsG_3" class="floatBarsG"></div>
                                <div id="floatBarsG_4" class="floatBarsG"></div>
                                <div id="floatBarsG_5" class="floatBarsG"></div>
                                <div id="floatBarsG_6" class="floatBarsG"></div>
                                <div id="floatBarsG_7" class="floatBarsG"></div>
                                <div id="floatBarsG_8" class="floatBarsG"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"  style="visibility: hidden; ">
                    <div id="upload-demo-i" ></div>
                </div>
            </div>

            <div class="">
                <div class="" id="row2">
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                     if($this->uri->segment(3) == $userid){
                     $user_id = $userid;
                     }elseif($this->uri->segment(3) == ""){
                     $user_id = $userid;
                     }else{
                     $user_id = $this->uri->segment(3);
                      }
                    $contition_array = array('user_id' => $user_id, 'is_delete' => '0', 'status' => '1');
                    $image = $this->common->select_data_by_condition('job_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    //echo "<pre>";print_r($image);



                    $image_ori = $image[0]['profile_background'];
                    if ($image_ori) {
                        ?>
                       
                            <img src="<?php echo base_url($this->config->item('job_bg_main_upload_path')  . $image[0]['profile_background']); ?>" name="image_src" id="image_src" / >
                        <?php
                    } else {
                        ?>
                       
                            <img src="<?php echo base_url(WHITEIMAGE); ?>" name="image_src" id="image_src" / >
              
                    <?php }
                    ?>

                
            </div>
        </div>
    
  </div>
<div class="container tablate-container art-profile">    
    <div class="upload-img">


        <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>

    </div>
    <div class="profile-photo">
        <div class="profile-pho">

            <div class="user-pic padd_img">
                <?php if ($jobdata[0]['job_user_image'] != '') { ?>
                    <img src="<?php echo base_url($this->config->item('job_profile_thumb_upload_path') . $jobdata[0]['job_user_image']); ?>" alt="" >
                <?php } else { ?>
                    <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                <?php } ?>
            <!--<a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>-->
                <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

            </div>

            <!--            <div id="popup-form">
            <?php // echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                            <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                            <input type="hidden" name="hitext" id="hitext" value="4">
                            <input type="submit" name="cancel4" id="cancel4" value="Cancel">
                            <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
            <?php // echo form_close(); ?>
                        </div>-->

        </div>


          <div class="job-menu-profile mob-block">
        <a  href="<?php echo site_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>"><h3 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h3></a>
        <!-- text head start -->

        <div class="profile-text" >

            <?php
            if ($jobdata[0]['designation'] == '') {
                ?>
                        <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                <a id="designation" class="designation" title="Designation">Current Work</a>
            <?php } else {
                ?> 
                    <!--<a id="myBtn" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>-->
                <a id="designation" class="designation" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>

            <?php } ?>
            </div>


          
        </div>

        <!-- menubar -->
<!--         <div class="profile-main-rec-box-menu  col-md-12 ">

            <div class="left-side-menu ">  </div>
            <div class="right-side-menu col-md-9 padding_less_right">  
                <ul class="">
                    <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_printpreview') { ?> class="active" <?php } ?>><a title="Details" href="<?php echo base_url('job/job_printpreview'); ?>"> Details</a>
                    </li>
                    <?php if (($this->uri->segment(1) == 'job') && ($this->uri->segment(2) == 'job_all_post' || $this->uri->segment(2) == 'job_printpreview' || $this->uri->segment(2) == 'job_resume' || $this->uri->segment(2) == 'job_save_post' || $this->uri->segment(2) == 'job_applied_post') && ($this->uri->segment(3) == $this->session->userdata('aileenuser') || $this->uri->segment(3) == '')) { ?>

                      
                        <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_save_post') { ?> class="active" <?php } ?>><a title="Saved Job" href="<?php echo base_url('job/job_save_post'); ?>">Saved </a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_applied_post') { ?> class="active" <?php } ?>><a title="Applied job" href="<?php echo base_url('job/job_applied_post'); ?>">Applied </a>
                        </li>

                    <?php } ?>


                </ul>
            </div>

      </div> -->


<?php echo $job_menubar; ?>       </div>

</div> 
        <div class="middle-part container padding_set_res">
    <div class="job-menu-profile mob-none">
        <a  href="<?php echo site_url('job/job_printpreview/' . $jobdata[0]['user_id']); ?>"><h5 class="profile-head-text"> <?php echo $jobdata[0]['fname'] . ' ' . $jobdata[0]['lname']; ?></h5></a>
        <!-- text head start -->

        <div class="profile-text" >

            <?php
            if ($jobdata[0]['designation'] == '') {
                ?>
                        <!--<center><a id="myBtn" title="Designation">Designation</a></center>-->
                <a id="designation" class="designation" title="Designation">Current Work</a>
            <?php } else {
                ?> 
                    <!--<a id="myBtn" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>-->
                <a id="designation" class="designation" title="<?php echo ucwords($jobdata[0]['designation']); ?>"><?php echo ucwords($jobdata[0]['designation']); ?></a>

            <?php } ?>
            </div>


          
        </div>

        <!-- text head end -->


    <div class="col-md-8 col-sm-12 mob-clear">
    <div class="">
        <div class="common-form">
            <div class="job-saved-box">
                <h3>Saved Job</h3>
                <div class="contact-frnd-post">
                    
                    <?php
                    if ($postdetail) {

                        foreach ($postdetail as $post) {
                            //    $post['user_id'] = $post['userid'];
                            ?> 
                            <div class="job-contact-frnd ">
                                <div class="profile-job-post-detail clearfix" id="<?php echo "postdata" . $post['app_id']; ?>">

     <div class="profile-job-post-title clearfix">
        <div class="profile-job-profile-button clearfix">
             <div class="profile-job-details col-md-12 col-xs-12">
                    <ul>
                        <li class="fr date_re">
                                                    Created Date : <?php echo date('d-M-Y',strtotime($post['created_date'])); ?>
                                                </li>
                     <li>
               <a  class=" post_title" href="#" title="Post Title" >
               <?php echo ucwords($this->common->make_links($post['post_name'])); ?> </a>   </li>

             <li>   
             <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name;


                                                     $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                 <?php   if($cityname || $countryname){ ?>
                                                    <div class="fr lction">
                                                    
                                                            
     <p title="Location"><i class="fa fa-map-marker" aria-hidden="true">

     <?php if($cityname){echo $cityname.","; }?><?php echo $countryname;?>
                                                              </i></p>
                                                            
                                                             
                                                    </div>
                                                    <?php } ?>
<?php
                 $cache_time1= $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->re_comp_name; ?>
              <a class="job_companyname" href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"  title="<?php echo $cache_time1;?>" ><?php
                
                   $out = strlen($cache_time1) > 40 ? substr($cache_time1,0,40)."..." : $cache_time1;       
                    echo $out;
                  
              ?></a>

            </li>

            <li><a  class=" display_inline" title="Recruiter Name" href="<?php echo base_url('recruiter/rec_profile/' . $post['user_id'].'?page=job'); ?>"><?php
             $cache_time = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_firstname;
              $cache_time1 = $this->db->get_where('recruiter', array('user_id' => $post['user_id']))->row()->rec_lastname;
             echo ucwords($cache_time)."  ".ucwords($cache_time1);
           ?></a></li>
       </ul>
          </div>
               </div>
                                        <div class="profile-job-profile-menu">
                                            <ul class="clearfix">
                                                <li> <b> Skills</b> <span> 
                    <?php
                     $comma = ", ";
                     $k = 0;
                     $aud = $post['post_skill'];
                     $aud_res = explode(',', $aud);

                     if(!$post['post_skill']){

                        echo $post['other_skill'];

                     }else if(!$post['other_skill']){

                        foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            echo $comma;
                        }
                     $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;


                        echo $cache_time;
                        $k++;
                    }

                     }else if($post['post_skill'] && $post['other_skill']){
                     foreach ($aud_res as $skill) {
                        if ($k != 0) {
                            echo $comma;
                        }
                     $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;


                        echo $cache_time;
                        $k++;
                    } echo ','.$post['other_skill']; }
             ?>       
                                                    </span>
                                                </li>


                                                <!-- <?php if ($post['other_skill']) { ?>
                                                    <li><b>Other Skill</b><span><?php echo $post['other_skill']; ?></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li><b>Other Skill</b><span><?php echo "-"; ?></span></li><?php } ?> -->

                                                <li><b>Job Description</b><span><p>
            <?php if($post['post_description']){echo $this->common->make_links($post['post_description']);}else{echo PROFILENA;} ?> </p></span>
                                                </li>
                                                <li><b>Interview Process</b><span>
            <?php if($post['interview_process']){echo $this->common->make_links($post['interview_process']);}else{echo PROFILENA;} ?></span>
                                                </li>
                                                   <li>
                                                <b>Required Experience</b>
                                                <span title="Min - Max">
                                                    <p>
                                                        
                                                     <?php 

      if(($post['min_year'] != '' && $post['max_year'] !='') && ($post['fresher'] == 1))
     { 
        if ($post['min_month'] == '' && $post['max_month'] == '') {
            echo $post['min_year'].' Year - '.$post['max_year'] . ' Year'." , ". "Fresher can also apply.";
          
        }  
         elseif ($post['min_month'] != '' && $post['max_month'] != '') {
      echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .'.'.$post['max_month'] . ' Year'." , ". "Fresher can also apply.";
            
          
        } 
        elseif ($post['min_month'] != '' && $post['max_month'] == '') {
        echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .' Year'." , ". "Fresher can also apply.";
            
          
        }
        elseif ($post['min_month'] == '' && $post['max_month'] != '') {
        echo $post['min_year']. ' Year - '.$post['max_year'] .' Year'." , ". "Fresher can also apply.";
            
          
        }    
     } 
     elseif($post['min_year'] != '' && $post['max_year'] !='')
     { 
        if ($post['min_month'] == '' && $post['max_month'] == '') {
            echo $post['min_year'].' Year - '.$post['max_year'] . ' Year';
          
        }  
         elseif ($post['min_month'] != '' && $post['max_month'] != '') {
      echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .'.'.$post['max_month'] . ' Year';
            
          
        } 
        elseif ($post['min_month'] != '' && $post['max_month'] == '') {
        echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .' Year';
            
          
        }
        elseif ($post['min_month'] == '' && $post['max_month'] != '') {
        echo $post['min_year']. ' Year - '.$post['max_year'] .' Year';
            
          
        }    
     } 
    else
    {
      echo "Fresher";
 // echo $post['min_year'].'.'.$post['min_month'] . ' Year - '.$post['max_year'] .'.'.$post['max_month'] . ' Year';
         
    }

 ?> 
    </p>  
                                                </span>
                                            </li>

     <li><b>Salary</b><span title="Min - Max" >
     <?php 
 $currency = $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;

     if ($post['min_sal'] || $post['max_sal']){echo $post['min_sal']." - ".$post['max_sal'].' '. $currency ." Per Year"; } else {echo PROFILENA;}?></span>
                                            </li>

                                                <li><b>No of Position</b><span><?php echo $post['post_position']; ?></span>
                                                </li>


                                            </ul>
                                        </div>
                                        <div class="profile-job-profile-button clearfix">
                                            <div class="profile-job-details col-md-12 col-xs-12">
                                                <ul>
                                                    <li class="job_all_post last_date">
                                                    Last Date : <?php if($post['post_last_date'] != "0000-00-00"){ echo date('d-M-Y',strtotime($post['post_last_date'])); }else{ echo PROFILENA;} ?></li>
                                                    <?php
                                                    $this->data['userid'] = $userid = $this->session->userdata('aileenuser');

                                                    $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                    $jobsave = $this->data['jobsave'] = $this->common->select_data_by_condition('job_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                    if ($jobsave[0]['job_save'] == 1) {
                                                        ?>

                                                        <button  class="button" disabled>Applied</button>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="fr"> 

                                                                                                <!--<a href="<?php echo '#popup5' . $post['post_id']; ?>"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button">Apply</a>-->
                                                            <a href="javascript:void(0);" class="button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['app_id'] ?>)">Apply</a>

                                                        </li>
                                                        <li class="fr"> 
                                                            <!--<a href="#popup1" class="button">Remove</a>-->
                                                            <a href="javascript:void(0);" class="button" onclick="removepopup(<?php echo $post['app_id'] ?>)">Remove</a>
                                                        </li>

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
                            <?php
                        }
                    } else {
                        ?>
                        <div class="text-center rio">
                            <h4 class="page-heading  product-listing" >No Saved Job Found.</h4>
                        </div>
                    <?php } ?> 
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>



    </div>
</div>
</div>


<div class="user-midd-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>

        </div>
    </div>
</div>
</section>

<!-- Model Popup Open -->
<!-- Bid-modal  -->
<div class="modal fade message-box biderror" id="bidmodal" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                <span class="mes"></span>
            </div>
        </div>
    </div>
</div>

<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
                        <?php echo form_open_multipart(base_url('job/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
 <div class="popup_previred">
                         <img id="preview" src="#" alt="your image" />
</div>
                        <input type="hidden" name="hitext" id="hitext" value="4">
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                        <?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->
</body>

</html>

<!-- script for skill textbox automatic start-->
   <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
    <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
     
     <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
     <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">

<!-- script for skill textbox automatic end -->

<script>

 var data = <?php echo json_encode($demo); ?>;
//alert(data);
 $(function () {
   $("#tags").autocomplete({
     source: function (request, response) {
     var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
      response($.grep(data, function (item) {
     return matcher.test(item.label);
     }));
    },
     minLength: 1,
 select: function (event, ui) {
 event.preventDefault();
 $("#tags").val(ui.item.label);
   $("#selected-tag").val(ui.item.label);
                                                                // window.location.href = ui.item.value;
  } ,
    focus: function (event, ui) {
       event.preventDefault();
       $("#tags").val(ui.item.label);
           }
       });
      });

</script>
                <script>

var data1= <?php echo json_encode($city_data); ?>;
//alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
  
</script>
<!-- <script>
//select2 autocomplete start for skill
    $('#searchskills').select2({

        placeholder: 'Find Your Skills',

        ajax: {

            url: "<?php echo base_url(); ?>job/keyskill",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

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

        ajax: {

            url: "<?php echo base_url(); ?>job/location",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for Location

</script> -->
<script>
// Get the modal
    var modal = document.getElementById('myModal');

// Get the button that opens the modal
    var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<!-- crop image js start--> 

<!-- crop image js End--> 
<!-- Validation Start -->
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

<!-- Validation End -->

<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";


    }


    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
    }
</script>


<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1250,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 1250,
            height: 350
        }
    });



    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {

            $.ajax({
                url: "<?php echo base_url() ?>job/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    if (html) {
                        window.location.reload();
                    }
                }
            });

        });
    });

    $('.cancel-result').on('click', function (ev) {

        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";


    });

//aarati code start
    $('#upload').on('change', function () {

        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);



    });

    $('#upload').on('change', function () {

        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);

        files = this.files;
        size = files[0].size;

if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    savepopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    return false;
  }

        if (size > 4194304)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 4 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            return false;
        }


        $.ajax({

            url: "<?php echo base_url(); ?>job/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {

            }
        });
    });

//aarati code end
</script>

<!-- modal javascript start -->

<script type="text/javascript">
    function remove_post(abc)
    {
        //var savepara = document.getElementById("saveid" + abc);
        var savepara = 'save';
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "job/job_delete_apply" ?>',
            data: 'app_id=' + abc + '&para=' + savepara,
            success: function (data) {
                $('#' + 'postdata' + abc).html(data);
                $('#' + 'postdata' + abc).parent().removeClass();
                var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                if (numItems == '0') {
                    var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Job Found.</h4></div>";
                    $('.contact-frnd-post').html(nodataHtml);
                }
            }
        });
    }
    function apply_post(abc, xyz)
    {

//      var alldata = document.getElementById("allpost" + abc);
        var alldata = 'all';
        //var user = document.getElementById("userid" + abc);
        var user = <?php echo $aileenuser_id; ?>;
      //  alert(user);
        var appid = xyz;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "job/job_apply_post" ?>',
            data: 'post_id=' + abc + '&allpost=' + alldata.value + '&userid=' + user.value,
            success: function (data) {
                $('#' + 'postdata' + appid).html(data);
                $('#' + 'postdata' + appid).parent().removeClass();
                var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                if (numItems == '0') {
                    var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Job Found.</h4></div>";
                    $('.contact-frnd-post').html(nodataHtml);
                }

            }
        });

    }
</script>

<!-- model javascript end -->

<!-- for search validation -->
<script type="text/javascript">
   function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }
   }
   
</script>
<!-- end search validation -->


<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function removepopup(id) {
        $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this job?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
    function applypopup(postid, appid) {
        $('.biderror .mes').html("<div class='pop_content'>Do you want to apply this job?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + appid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>
<script>
    function divClicked() {
        var divHtml = $(this).html();
        var editableText = $("<textarea />");
        editableText.val(divHtml);
        $(this).replaceWith(editableText);
        editableText.focus();
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }

    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<a>");
       if (html.match(/^\s*$/) || html == '') {
                                html = "Current Work";
                                }
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(divClicked);

        $.ajax({
            url: "<?php echo base_url(); ?>job/ajax_designation",
            type: "POST",
            data: {"designation": html},
            success: function (response) {
            }
        });
    }

    $(document).ready(function () {
        $("a.designation").click(divClicked);
    });
</script>


<!-- script for profile pic strat -->
<script type="text/javascript">
    

     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'block';
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profilepic").change(function(){
      readURL(this);
        profile = this.files;
      //alert(profile);
      // if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
      //  //alert('not an image');
      //   $('#profilepic').val('');
      //    savepopup();
      //    return false;
      //     }else{
      //     readURL(this);}

    });
</script>

<!-- script for profile pic end -->




<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#userimage").validate({

                    rules: {

                        profilepic: {

                            required: true,
                         
                        },
  

                    },

                    messages: {

                        profilepic: {

                            required: "Photo Required",
                            
                        },

                },

                });
                   });
  </script>
  <script>
                        function savepopup() {
                            
                      
            $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
            $('#bidmodal').modal('show');
                        }
                    </script>


                    <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  


     $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->


 <script type="text/javascript">
//For Scroll page at perticular position js Start
$(document).ready(function(){
 
//  $(document).load().scrollTop(1000);
     
    $('html,body').animate({scrollTop:265}, 100);

});
//For Scroll page at perticular position js End
</script>