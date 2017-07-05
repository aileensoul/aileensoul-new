<!-- start head -->
<?php  echo $head; ?>
<link rel="stylesheet" href="<?php echo base_url('css/select2-4.0.3.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
    <!-- END HEAD -->
    <!-- start header -->
  <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5">
                        <div class="logo"><a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('images/logo-white.png'); ?>"></a></div>
                    </div>
                    <div class="col-md-8 col-sm-7">
                        <div class="pushmenu pushmenu-left">
                        <ul class="">
                         
                            <li><a href="<?php echo base_url(); ?>">Login</a></li>
                             <li><a href="<?php echo base_url('registration/index') ?>">Create an account</a></li>

                            <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                   
                   

  <!-- Friend Request Start-->
  <!--  -->
<!-- Friend Request End-->

                    <!-- END USER LOGIN DROPDOWN -->
                       </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

   <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script>
$(document).ready(function()
{


/* Uploading Profile BackGround Image */
$('body').on('change','#bgphotoimg', function()
{

$("#bgimageform").ajaxForm({target: '#timelineBackground',
beforeSubmit:function(){},
success:function(){

$("#timelineShade").hide();
$("#bgimageform").hide();
},
error:function(){

} }).submit();
});



/* Banner position drag */
$("body").on('mouseover','.headerimage',function ()
{
var y1 = $('#timelineBackground').height();
var y2 =  $('.headerimage').height();
$(this).draggable({
scroll: false,
axis: "y",
drag: function(event, ui) {
if(ui.position.top >= 0)
{
ui.position.top = 0;
}
else if(ui.position.top <= y1 - y2)
{
ui.position.top = y1 - y2;
}
},
stop: function(event, ui)
{
}
});
});


/* Bannert Position Save*/
$("body").on('click','.bgSave',function ()
{
var id = $(this).attr("id");
var p = $("#timelineBGload").attr("style");
var Y =p.split("top:");
var Z=Y[1].split(";");
var dataString ='position='+Z[0];
$.ajax({
type: "POST",
url: "<?php echo base_url('business_profile/image_saveBG_ajax'); ?>",
data: dataString,
cache: false,
beforeSend: function(){ },
success: function(html)
{
if(html)
{
  window.location.reload();
$(".bgImage").fadeOut('slow');
$(".bgSave").fadeOut('slow');
$("#timelineShade").fadeIn("slow");
$("#timelineBGload").removeClass("headerimage");
$("#timelineBGload").css({'margin-top':html});
return false;
}
}
});
return false;
});



});
</script>
</head>
<body>

<!-- cover pic start -->
<div class="container" id="container" id="paddingtop_fixed">

<div id="timelineContainer">

<!-- timeline background -->
<div id="timelineBackground">
<img src="<?php echo base_url(USERIMAGE . $businessdata[0]['profile_background']);?>" class="bgImage" style="margin-top: <?php echo $businessdata[0]['profile_background_position']; ?>;">

</div>

<!-- timeline background -->
<div  id="timelineShade" style="background:url(<?php echo base_url('images/timeline_shade.png'); ?>">
<form id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo base_url('business_profile/image_upload_ajax'); ?>">


</div>
</form>
</div>

<!-- timeline profile picture -->


<!-- timeline title -->


<!-- timeline nav -->
<div id="timelineNav"></div>

</div>

</div>
<!-- cover pic end -->
    <div>
        <div class="container">
           
            <div class="profile-photo">
              <div class="profile-pho">

                <div class="user-pic">
                        <?php if($businessdata[0]['business_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                          

                        </div>
                        
                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="4">
                        <input type="submit" name="cancel1" id="cancel4" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                     <?php  echo form_close( );?>
                </div>

                </div>
                <div class="col-md-2 col-sm-2"></div>
                 <div class="job-menu-profile">


                  

                    <h5 class="profile-head-text"><a href="<?php echo base_url('business_profile/business_resume/'.$businessdata[0]['user_id'].''); ?>"> <?php echo ucwords($businessdata[0]['company_name']); ?></a></h5>
                    <div class="profile-text" >
                        <p>Jr. Owner</p>
                    </div>
              </div>
            </div>
        </div>
       </div>

    

        <div class="user-midd-section">
            <div class="container">
                <div class="row">
            
                    <div class="col-md-7 col-sm-7">
                        <div class="common-form">
                            <div class="job-saved-box">

                            

                                <h3>Business Profile </h3> 
                                 <div class=" fr rec-edit-pro">
                              
                                    </div> 
                               
                            

                                    <?php 
                            if($this->session->userdata('aileenuser') == $businessdata[0]['user_id']){?>
                            
                                <?php }?>

                                        <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
                                        <div class="profile-job-post-detail clearfix">
                                   <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                    <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                            <p> Basic Information</p> 
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                     <li> <b>Comapny Name:</b> <span> <?php echo $businessdata[0]['company_name'];?> </span>
                                                        </li>
                                                     
                                                      <li> <b> Country:</b> <span> <?php echo  $this->db->get_where('countries',array('country_id' => $businessdata[0]['country']))->row()->country_name;  ?> </span>
                                                        </li>
                                                       
                                                        <li> <b>State :</b><span> <?php echo  
                                                        $this->db->get_where('states',array('state_id' => $businessdata[0]['state']))->row()->state_name;  ?> </span>
                                                        </li>
                                                        <li><b> City:</b> <span><?php echo  
                                                        $this->db->get_where('cities',array('city_id' => $businessdata[0]['city']))->row()->city_name;  ?></span> </li>
                                                           
                                                         <li> <b>Pincode :</b><span><?php echo $businessdata[0]['pincode'];?></span>
                                                        </li>
                                                         <li> <b>Postal Address :</b><span> <?php echo $businessdata[0]['address'];?> </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                 <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                 <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p> Contact Information</p>
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Contact Person:</b> <span> <?php echo $businessdata[0]['contact_person'];?> </span>
                                                        </li>
                                                       
                                                        <li> <b>Contact Mobile :</b><span> <?php echo $businessdata[0]['contact_mobile'];?> </span>
                                                        </li>
                                                        <li><b> Contact Email:</b> <span><?php echo $businessdata[0]['contact_email'];?></span> </li>
                                                           
                                                         <li> <b>Contact Website :</b><span> <?php echo $businessdata[0]['contact_website'];?></span>
                                                        </li>
                                                      
                                                    </ul>
                                                </div>
                                                </div>
                                                     <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                 <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p>Professional Information</p>
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b>Buisness  Type :-</b> <span><?php echo  
                                                        $this->db->get_where('business_type',array('type_id' => $businessdata[0]['business_type']))->row()->business_type;  ?></span> </span>
                                                        </li>
                                                       
                                                        <li> <b>Industrial:-</b><span><?php echo  
                                                        $this->db->get_where('industry_type',array('industry_id' => $businessdata[0]['industriyal']))->row()->industry_name;  ?></span>
                                                        </li>
                                                        <li><b>Sub Industrial:-</b> <span><?php echo  
                                                        $this->db->get_where('sub_industry_type',array('sub_industry_id' => $businessdata[0]['subindustriyal']))->row()->sub_industry_name;  ?></span> </li>
                                                           
                                                          <li><b>Details Of Your buisness :-</b> <span><?php echo $businessdata[0]['details'];?></span> </li>
                                                           
                                                    
                                                    </ul>
                                                </div>
                                                </div> 
                                                        <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                 <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p> Images</p>
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                         <li>
                                                         <div  class="buisness-profile-pic"><img src="<?php echo base_url(BUSINESSPROFILEIMAGE . $businessdata[0]['business_profile_image']);?>" alt="" >
                            							</div>		</a></li>
                                                    </ul>
                                                </div>
                                                </div> 
                                                        <div class="profile-job-post-title clearfix">
                                                <div class="profile-job-profile-button clearfix">
                                                 <div class="profile-job-details">
                                                        <ul>
                                                            <li>
                                                                <p> ADD MORE :-</p>
                                                            </li>
                                                          
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="profile-job-profile-menu">
                                                    <ul class="clearfix">
                                                        <li> <b> Add More:-</b> <span> <?php echo $businessdata[0]['addmore'];?> </span>
                                                        </li>
                                                    
                                                    </ul>
                                                </div>
                                                </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
    </section>
    <footer>

        <footer>
            <?php echo $footer;?>
        </footer>




</body>

</html>
<!-- script for skill textbox automatic start (option 2)-->

<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/select2-4.0.3.min.js'); ?>"></script>

<!-- script for skill textbox automatic end (option 2)-->

<script>

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
         maximumSelectionLength: 1,
        ajax:{

         
          url: "<?php echo base_url(); ?>business_profile/location",
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

</script>

