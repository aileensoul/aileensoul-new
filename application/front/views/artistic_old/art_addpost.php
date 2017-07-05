
<!-- start head -->
<?php  echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/select2-4.0.3.min.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
<header>
    <div class="bg-search">
        <div class="header2">
            <div class="container">
                <div class="row">
                  <div class="col-md-2 col-sm-5">
                       <div class="pushmenu pushmenu-left">
                            <ul class="">
                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_post'); ?>">Home</a>
                                    </li>
                                <!-- Friend Request Start-->

                                <div>

                                </div>
                                <!-- Friend Request End-->
                                <!-- END USER LOGIN DROPDOWN -->
                            </ul>
                        </div> 
                    </div>
                  
                     <div class="col-md-10 col-sm-10">
                        <div class="job-search-box1 clearfix">
                        <form>
                            <fieldset class="col-md-5">
                             <!--    <label>Find Your Skills</label>
                              -->   <input type="text" name="" placeholder="Find Your Skill">
                            </fieldset>
                            <fieldset class="col-md-5">
                             <!--    <label>Find Your Location</label>
                              -->   <input type="text" name="" placeholder="Find Your Location">
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
url: "<?php echo base_url('artistic/image_saveBG_ajax'); ?>",
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
<img src="<?php echo base_url(USERIMAGE . $artisticdata[0]['profile_background']);?>" class="bgImage" style="margin-top: <?php echo $artisticdata[0]['profile_background_position']; ?>;">

</div>

<!-- timeline background -->
<div  id="timelineShade" style="background:url(<?php echo base_url('images/timeline_shade.png'); ?>">
<form id="bgimageform" method="post" enctype="multipart/form-data" action="<?php echo base_url('artistic/image_upload_ajax'); ?>">

<!-- <label for="bgphotoimg"><i class=" fa fa-camera fa-2x">  </i></label>
 -->


<div class="uploadFile timelineUploadBG" style="background:url(<?php echo base_url('images/whitecam.png'); ?>">

<input type="file" name="photoimg" id="bgphotoimg" class=" custom-file-input" original-title="Change Cover Picture"  ">



</div>
</form>
</div>


<div id="timelineNav"></div>

</div>

</div>
<!-- cover pic end -->
        <div>
            <div class="container">
                
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic">
                        <?php if($artisticdata[0]['art_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $artisticdata[0]['art_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>

                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="3">
                        <input type="submit" name="cancel3" id="cancel3" value="Cancel">
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
                    </form>
                </div>

                    </div>
                    <div class="profile-main-rec-box-menu  col-md-12 ">

<div class="left-side-menu col-md-2">  </div>
<div class="right-side-menu col-md-9">
                                    <ul>

                                    <?php 
                                if(($this->uri->segment(1) == 'artistic') && ($this->uri->segment(2) == 'artistic_profile') && ($this->uri->segment(3) == $this->session->userdata('aileenuser'))) { ?>

                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_post'); ?>">Home</a>
                                    </li>
                             <?php }?>

                                   <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/artistic_profile'); ?>"> Profile</a>
                                    </li>

                                

                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_savepost'); ?>">Saved </a>
                                    </li>

                                  

                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_manage_post'); ?>"> Post</a>
                                    </li>

                                

                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'userlist'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/userlist'); ?>">Userlist</a>
                                    </li>

                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'followers'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/followers'); ?>">Followers  (<?php echo $followers; ?>)</a>
                                    </li>
                                    
                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'following'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/following'); ?>">Following  (<?php echo $following; ?> )</a>
                                    </li>

                                   
                                    
                                </ul>
</div>

  </div>  
                   
                      <div class="job-menu-profile">
                         <a href="<?php echo site_url('artistic/artistic_profile/'.$artisticdata[0]['user_id']); ?>"> <h5><?php echo ucwords($artisticdata[0]['art_name']) .' '.  ucwords($artisticdata[0]['art_lastname']); ?></h5></a>
                             <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                     if($artisticdata[0]['designation'] == '')
                     {
                     ?>
                     <center><a id="myBtn">Designation</a></center>
                     <?php }else{?> 
                      <center><a id="myBtn"><?php echo ucwords($artisticdata[0]['designation']); ?></a></center>
                      <?php }?>
                  

                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                      <!-- Modal content --><div class="col-md-2"></div>
                      <div class="modal-content col-md-8">
                        <span class="close">&times;</span>
                        <fieldset></fieldset>
                         <?php echo form_open(base_url('artistic/art_designation/'), array('id' => 'artdesignation','name' => 'artdesignation', 'class' => 'clearfix')); ?>

  <fieldset class="col-md-8"> <input type="text" name="designation" id="designation" placeholder="Enter Your Designation" value="<?php echo $artisticdata[0]['designation']; ?>">
  <?php echo form_error('designation'); ?>
  </fieldset>


         <input type="hidden" name="hitext" id="hitext" value="2">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php echo form_close();?>
  
                    
                     
                    </div>
                    <div class="col-md-2"></div>
              </div>
            </div>

            <!-- text head end -->
                </div>
                <div class="col-md-7 col-sm-7">

                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div> 

                        <div class="common-form">
                            <div class="job-saved-box">
                                <h3>Add New Post</h3>
                              
                         
                            <?php echo form_open_multipart(base_url('artistic/art_post_insert'), array('id' => 'artpost','name' => 'artpost', 'class' => 'clearfix')); ?>

                            <?php
                             $postname =  form_error('postname');
                             $skills =  form_error('skills');
                             $description =  form_error('description');
                             //$postattach =  form_error('postattach');
                             
                            ?>

                            <fieldset <?php if($postname) {  ?> class="error-msg" <?php } ?>>
                                <label>Post Name:<span style="color:red">*</span></label>
                                <input type="text" name="postname" id="postname" placeholder="Enter Post Name">  
                                <?php echo form_error('postname'); ?>
                            </fieldset>


                            <fieldset>
                                    <label>Skills:<span style="color:red">*</span></label>
                                
                                     <select class="left skill-group" name="skills[]" id="skills" multiple="multiple" required>
                                </select>
                                     <?php echo form_error('skills'); ?> 
                                </fieldset>

                            <fieldset class="full-width">
                                <label>Other skill:</label>
                                <input type="text" class="left skill-group" name="other_skill" id="other_skill" placeholder="Enter Other Skill"> 
                                <?php echo form_error('other_skill'); ?>
                            </fieldset> 
                            <fieldset class="full-width">
                                <label>Attachment:</label>
                                <input type="file" name="postattach" id="postattach">  
                            </fieldset>

                             <fieldset <?php if($description) {  ?> class="error-msg" <?php } ?> class="full-width">
                                <label>Description:<span style="color:red">*</span></label>
                                <textarea id="description" name="description" placeholder="Enter Description"></textarea>
                                <?php echo form_error('description'); ?>
                            </fieldset> 

                             

                        <div class="fr">           
                            <fieldset class="hs-submit full-width">

                                <input type="reset" name="reset" value="Clear">
                                <input type="submit" name="artpost" id="artpost">
                                
                            </fieldset>
                      </div>      
                      </form>
                                          
                                        </div>
                                        <div class="col-md-1">
                                        </div>
                                    </div>
                    
            </div>
        </div>
        </div>

        
         
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                       
                                </div>

                        </div>
                    </div>
    </section>
    <footer>
 <?php echo $footer;  ?>
  </footer>      


</body>

</html>

<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

  <script src="<?php echo base_url('js/select2-4.0.3.min.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>
//select2 autocomplete start for skill
$('#searchskills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/keyskill",
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

         
          url: "<?php echo base_url(); ?>artistic/location",
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



<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#artpost").validate({

                    rules: {

                        postname: {

                            required: true,
                        },


                        // skills: {

                        //   require_from_group: [1, ".skill-group"]
                        //     //required: true,
                        // },

                        // other_skill: {

                        //     require_from_group: [1, ".skill-group"]
                        //     //required: true,
                        // },


                        description: {
                            required: true,
                            
                        },

                       // postattach: {

                       //      required: true,
                            
                       //  },

                    },

                    messages: {

                        postname: {

                            required: "Post name Is Required.",
                            
                        },

                        // skills: {

                        //     required: "Skill Is Required.",
                            
                        // },

                        description: {
                            required: "Description is required",
                            
                        },
                        // postattach: {

                        //     required: "Attachment Is Required.",
                            
                        // },

                    },

                });
                   });
  </script>

  <script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#artdesignation").validate({

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
<!-- auto search skills start -->

<script>
//select2 autocomplete start for skill
$('#skills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>artistic/keyskill",
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

</script>


    <!-- footer end

<!- auto search skills end -->