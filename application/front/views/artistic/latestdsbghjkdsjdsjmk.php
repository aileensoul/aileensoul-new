<!-- start head -->
<?php echo $head; ?>

<!--post save success pop up style strat -->
<style>
body {
  font-family: Arial, sans-serif;
  background-size: cover;
  height: 100vh;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}



.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.3);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index: 10;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
    margin: 70px auto;
    padding: 20px;
    background: #fff;
    border-radius: 5px;
    width: 30%;
    height: 200px;
    position: relative;
    transition: all 5s ease-in-out;
}

.okk{
  text-align: center;
}

.popup .okbtn {
  position: absolute;
    transition: all 200ms;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    padding: 8px 18px;
    background-color: darkcyan;
    left: 25px;
    margin-top: 15px;
    width: 100px; 
    border-radius: 8px;
}

.popup .cnclbtn {
  position: absolute;
    transition: all 200ms;
    font-size: 18px;
    font-weight: bold;
    text-decoration: none;
    color: #fff;
    padding: 8px 18px;
    background-color: darkcyan;
    right: 25px;
    margin-top: 15px;
    width: 100px;
    border-radius: 8px;
}

.popup .pop_content {
 text-align: center;
 margin-top: 40px;
  
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

<!--post save success pop up style end -->


<link rel="stylesheet" href="<?php echo base_url('css/select2-4.0.3.min.css'); ?>">

<style type="text/css" media="screen">
#row2 img{height: 350px;width: 1138px;} 
.upload-img{    float: right;
    position: relative;
    margin-top: -135px;
    right: 50px; }

   label.cameraButton {
  display: inline-block;
  margin: 1em 0;

  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
  opacity: 0.7;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}

/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}




</style>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
<?php echo $art_header2; ?>

  <!-- <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script> -->
  <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.jMosaic.css'); ?>">
    <!-- END HEADER -->
<body   class="page-container-bg-solid page-boxed">

    <section>
        <div class="container">
            <!--- select thaya pachhi ave ae -->
      <div class="row" id="row1" style="display:none;">
        <div class="col-md-12 text-center">
        <div id="upload-demo" style="width:1030px"></div>
        </div>
        <div class="col-md-12" style="padding-top: 25px;text-align: center;">
            <button class="btn btn-success upload-result cancel-result" onclick="" >Cancel</button>
    
        <button class="btn btn-success upload-result cancel-result" onclick="myFunction()">Upload Image</button>

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
        <div id="upload-demo-i" style="background:#e1e1e1;width:1030px;padding:30px;height:300px;margin-top:30px"></div>
        </div>
      </div>

      <!--- select thaya pachhi ave ae end-->


  
<!--- select thai ne ave ae pelaj -->
<div class="container">
  <div class="row" id="row2">
        <?php
        $userid  = $this->session->userdata('aileenuser');
            $contition_array = array( 'user_id' => $userid, 'is_delete' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('art_reg', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
         
            $image_ori=$image[0]['profile_background'];
           if($image_ori)
           {
            ?>
            <div class="bg-images">
            <img src="<?php echo $image[0]['profile_background']; ?>" name="image_src" id="image_src" / >
            <?php
           }
           else
           {
            echo " ";
           }
          
            ?>

    </div>
    </div>
</div>
  </div>
  </div>   

    <div class="container">    
      <div class="upload-img">
      
        
        <label class="cameraButton">Take a picture
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>

<!--- select thai ne ave ae pelaj puru -->
                
            </div>
               
                <div class="profile-photo">
                    <div class="profile-pho">

                        <div class="user-pic">
                        <?php if($artdata[0]['art_user_image'] != ''){ ?>
                           <img src="<?php echo base_url(USERIMAGE . $artdata[0]['art_user_image']);?>" alt="" >
                            <?php } else { ?>
                            <img alt="" class="img-circle" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                            <?php } ?>
                            <a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>

                        </div>

                        <div id="popup-form">
                        <?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="5">
                        <input type="submit" name="cancel5" id="cancel5" value="Cancel">
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

                                  

                                     <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_manage_post'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_manage_post'); ?>"> Dashboard</a>
                                    </li>

                                      <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'artistic_profile'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/artistic_profile'); ?>"> Details</a>
                                    </li>
                                

                                    <li <?php if($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_savepost'){?> class="active" <?php } ?>><a href="<?php echo base_url('artistic/art_savepost'); ?>">Saved </a>
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
    <!-- menubar -->      <div class="job-menu-profile">
                          <a href="<?php echo site_url('artistic/artistic_profile/'.$artisticdata[0]['user_id']); ?>"><h5><?php echo ucwords($artisticdata[0]['art_name']) .' '.  ucwords($artisticdata[0]['art_lastname']); ?></h5></a>
                          
                             <!-- text head start -->
                    <div class="profile-text" >
                   
                     <?php 
                     if($artisticdata[0]['designation'] == '')
                     {
                     ?>
                     <a id="myBtn">Designation</a>
                     <?php }else{?> 
                      <a id="myBtn"><?php echo ucwords($artisticdata[0]['designation']); ?></a>
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
         <input type="hidden" name="hitext" id="hitext" value="5">
  <fieldset class="col-md-2"><input type="submit"  id="submitdes" name="submitdes" value="Submit"></fieldset>
                        <?php echo form_close();?>
  
                    
                     
                    </div>
                   
                    <div class="col-md-2"></div>

              </div>

            </div>


            <!-- text head end -->

                      </div>
            
<!-- popup start -->
<div class="col-md-7 col-sm-7 all-form-content" style="    margin-left: 143px;" >

  <div class="post-editor col-md-12">
                                <div class="main-text-area col-md-12">
                                <div class="popup-img col-md-1"> <img  src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']);?>"  alt="">
 </div>
 <div id="myBtn"  class="editor-content col-md-11 popup-text" contenteditable>
        <span> Post Your Product....</span> 
      <!--  <span class="fr">
        <input type="file" id="FileID" style="display:none;">
         <label for="FileID"><i class=" fa fa-camera fa"  style=" margin: 8px; cursor:pointer">  </i>
         </label>
          </span>     
       -->
     </div>
    </div>
    <div class="fr">
     <a href="" class="button">Post</a></div>
      </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal-post">

  <!-- Modal content -->
  <div class="modal-content-post">
   <span class="close1">&times;</span>
  
   <div class="post-editor col-md-12">
   
    <?php echo form_open_multipart(base_url('artistic/art_post_insert/'), array('id' => 'artpostform','name' => 'artpostform', 'class' => 'clearfix')); ?>

                                <div class="main-text-area col-md-12"  style="border-bottom: 5px solid #ced5df;">
                                <div class="popup-img col-md-1"> <img  src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']);?>"  alt="">
 </div>
 <div id="myBtn"  class="editor-content col-md-10 popup-text" >
        <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
         <textarea placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
 name=my_text rows=4 cols=30 class="post_product_name"></textarea>
  <div>                        
<input size=1 value=50 name=text_num style="width: 52px;"> 
       </div>
      
     </div>
    <!--   <span class="fr">

    <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->
<div class="col-md-1"><i class=" fa fa-camera "  style="margin: 0px;
    font-size: 27px;
    cursor: pointer;
    /* margin-right: -38px; */
    margin-top: 20px;"></i> </div>

 </div>
<div  id="text  class="editor-content" class=" col-md-12 popup-textarea" >
      <textarea name="product_desc" class="description" placeholder="Enter Description"> </textarea>

      <output id="list"></output>
</div>
<div class="print_privew_post">
  
</div>
 <div class="preview"></div>
 <div id="data-vid" class="large-8 columns">
            <!--video will be inserted here.-->
        </div>

           <h2 id="name-vid"></h2>
         <p id="size-vid"></p>
         <p id="type-vid"></p>
   
<div class="popup-social-icon">
  <ul class="editor-header">
   
                      <li><input type="file" id="file-es" style="display:none;" id="files" accept="image/*" name="postattach[]" multiple style="display:block;">
                                    <label for="file-es"><i class=" fa fa-camera "  style=" margin: 8px; cursor:pointer"> Photo </i> </label>
                                    </li>

                                     <li><input type="file" id="the-video-file-field" accept="video/*" style="display:none;" id="files" name="postattach[]" multiple style="display:block;">
                                    <label for="the-video-file-field"><i class=" fa fa-video-camera"  style=" margin: 8px; cursor:pointer"> Video </i> </label>
                                    </li>
                                    
        <li>
                                
  <label for="upload" ><i class="fa fa-music "  style=" margin: 8px; cursor:pointer" accept="audio/*"> Audio </i></label>
  <input type="file" name="upload" id="upload" class="upload" style="display:none;" "/>

                               </li>
                                
                                
                                 <li><input type="file" id="file-es" style="display:none;" id="files" accept="application/pdf"  name="postattach[]" multiple style="display:block;">
                                    <label for="file-es"><i class=" fa fa-file-pdf-o fa-2x"  style=" margin: 8px; cursor:pointer"> PDF </i></label>
                                    </li>
                             
                                    </ul>
     

</div>
    <div class="fr">
     <button type="submit"  value="Submit">Submit</button>    </div>
     <?php echo form_close(); ?>
      </div>
  </div>
</div>
<!-- popup end -->

  
                </div>
            </div>
        </div>
        </div>
         <div class="user-midd-section">
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                     <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">

 <div class="head_details1">
             <span><h5><i class="fa fa-info-circle" aria-hidden="true"></i> Information</h5>
</span>      </div>
         <table class="business_data_table">
          <tr>
           <td class="business_data_td1"><i class="fa fa-user"></i></td>
           <td class="business_data_td2">Dhaval Shah</td>
           </tr>
           <tr>
           <td class="business_data_td1"><i class="fa fa-mobile"></i></td>
           <td class="business_data_td2"><span>09879907399</span></td>
           </tr>
           <tr>
           <td class="business_data_td1  detaile_map"><i class="fa fa-map-marker"></i></td>
           <td class="business_data_td2"><span>E-912 Titanium City Center, 1000 Feet Road, Near Sachin Tower, Anadnager, Satellite, Ahmedabad-380015. </span></td>
           </tr>
           <tr>
           <td class="business_data_td1"><i class="fa fa-globe"></i></td>
           <td class="business_data_td2"><span><a href="#">https://www.aileensoul.com </a></span></td>
           </tr>
           <tr>
           <td class="business_data_td1"><i class="fa fa-suitcase"></i></td>
           <td class="business_data_td2"><span>Details of Business</span></td>
           </tr>
         </table>
      </div>
    </div>

  <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module buisness_he_module" style="height: 47%;">

 <div class="head_details">
             <h5><i class="fa fa-camera" aria-hidden="true"></i>   Photos</h5>
      </div>      
              <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
              <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
               <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 <div class="image_profile"><img src="../images/imgpsh_fullsize (2).jpg" alt="img1"></div>
                 
           
     </div>
     </div>
  <div class="full-box-module business_data">
     <div class="profile-boxProfileCard  module">
<table class="business_data_table">
 <div class="head_details">
           <h5><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</h5>
           </div>
           <tr>
             <td class="image_profile"> 
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
              
                  </video>
              </td>

             <td class="image_profile">
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
                 
                  </video>
             </td>
             <td class="image_profile">
                  <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
               
                  </video>
            </td>

           </tr>
        <tr>
             <td class="image_profile"> 
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
              
                  </video>
              </td>

             <td class="image_profile">
                 <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
                 
                  </video>
             </td>
             <td class="image_profile">
                  <video controls>
                    <source src="../images/Short video clip-nature.mp4" type="video/mp4">
                    <source src="../images/Short video clip-nature.ogg" type="video/ogg">
               
                  </video>
            </td>

           </tr>
        </table>

     </div>
                </div>
                   
      </div>

<div class="col-md-7">
  
 <div class="job-contact-frnd ">

                         <?php
                        foreach($artsdata as $row)
                         {
                                            ?>
                    <div class="profile-job-post-detail clearfix"  id="<?php echo "removepost" . $row['art_post_id']; ?>">
                    <div class=" post-design-box">

<!-- pop up box start-->
<div id="<?php echo "popup2" . $row['art_post_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      Are You Sure want to delete this post?.

      <p class="okk"><a class="okbtn" id="<?php echo $row['art_post_id']; ?>" onClick="remove_ownpost(this.id)" href="#">OK</a></p>

      <p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->

                    <div class="post-design-top col-md-12" >  
                    <div class="post-design-pro-img"> 

                    <?php 
                 $userimage =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_user_image; 
                 ?>

                    <img src="<?php echo base_url(ARTISTICIMAGE .  $userimage);?>" name="image_src" id="image_src" / >
                     </div>


                      <div class="post-design-name fl">
                      <ul>
                        <li>
                        <?php 
                 $firstname =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_name;
                 $lastname =  $this->db->get_where('art_reg',array('user_id' => $row['user_id']))->row()->art_lastname; 
                 ?>
                        <a href="<?php echo base_url('artistic/artistic_profile/'.$row['user_id']); ?>">
                        <h6> <?php echo ucwords($firstname) . ucwords($lastname) ;?></h6>
                        </a>
                        </li>
                        <li ><div class="post-design-product"><?php echo $row['art_post']?><span><?php  echo date('d-M-Y',strtotime($row['created_date'])); ?></span></div></li>
                       <!--  <li><a href="">T-Shirt</a></li> -->
                      </ul> 
                      </div>  
  <div class="dropdown2">
<a onClick="myFunction(<?php echo $row['art_post_id']; ?>)" class="dropbtn2 dropbtn2 fa fa-ellipsis-v"></a>
  <div id="<?php echo "myDropdown" . $row['art_post_id']; ?>" class="dropdown-content2">

<?php 
    $userid  = $this->session->userdata('aileenuser');
    if($row['user_id'] == $userid) {
    ?>


    <a href="<?php echo "#popup2" . $row['art_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>
    
     <a href="<?php echo base_url('artistic/art_editpost/'.$row['art_post_id'].''); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>

<?php }else{?>
    <a href="<?php echo "#popup5" . $row['art_post_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>

    <?php

  $userid  = $this->session->userdata('aileenuser'); 
  $contition_array = array( 'user_id' => $userid, 'post_save' => '1', 'post_id ' => $row['art_post_id']);
         $artsave = $this->data['artsave']  = $this->common->select_data_by_condition('art_post_save', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
     
         if($artsave){

?>

   <a><i class="fa fa-bookmark" aria-hidden="true"></i>Saved Post</a>

<?php }else{?>

 <a id="<?php echo $row['art_post_id']; ?>" onClick="save_post(this.id)" href="#popup1" class="<?php echo 'savedpost' . $row['art_post_id']; ?>"><i class="fa fa-bookmark" aria-hidden="true"></i>Save Post</a>
<?php }?>


    <a href="<?php echo base_url('artistic/artistic_contactperson/'.$row['user_id'].''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
    <?php }?>

  </div>
</div>


              <div class="post-design-desc show">
                       
 <?php echo $row['art_description']; ?>

                     </div> 
                </div>


                 <div class="post-design-mid col-md-12" >  
                <div>

                    <div class="post-design-product-img">
             
             <div class="pictures">


<div class="row">
  <div class="column">
    <img src="../images/image7.jpg" width="500" height="467" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">
  </div>
  <div class="column">
    <img src="../images/image6.jpg" width="500" height="467" onclick="openModal();currentSlide(2)" class="hover-shadow cursor">
  </div>
  <div class="column">
    <img src="../images/asg.jpg" width="500" height="467" onclick="openModal();currentSlide(3)" class="hover-shadow cursor">
  </div>
  <div class="column">

<div class="post_img_mul">

    <img src="../images/h.jpg" width="500" height="467" onclick="openModal();currentSlide(4)" class="hover-shadow cursor" style="background: red;">

    
  </div>
  </div>

     
</div>

    
</div>


<div class="post_img_mu">

  

<div id="myModal1" class="modal2">
  <span class="close2 cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content2">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
      <img src="../images/image7.jpg" style="width:100% ; height: 70%;">
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <img src="../images/image6.jpg" style="width:100%; height: 70%;">
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <img src="../images/h.jpg" style="width:100%; height: 70%;">
    </div>
    
    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
      <img src="../images/asg.jpg" style="width:100%; height: 70%;">
    </div>
    <div class="mySlides">
      <div class="numbertext">5 / 5</div>
      <img src="../images/h.jpg" style="width:100%; height: 70%;">

    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>


   <div>
      <div class="post-design-like-box col-md-12">
                <div class="post-design-menu">
                  <ul>
                    <li>
                    <a id="<?php echo $row['art_post_id']; ?>" onClick="post_like(this.id)"><i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> <span class="<?php echo 'likepost' . $row['art_post_id']; ?>">
                                       <?php echo $row['art_likes_count']; ?>
                                      </span>
                                      </a>
                    </li>
                    <li>

                     <?php 

          $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
           $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

                                   ?>

                    <a  onClick="commentall(this.id)" id="<?php echo $row['art_post_id']; ?>">
                    <i class="fa fa-comment-o" aria-hidden="true">
                     <?php 
                    if(count($commnetcount) > 0){
                    echo count($commnetcount); 
                   }else{}
                    ?>
                     </i> 
                    </a>
                    </li>
                  </ul>

                  </div>
                </div>
<div class="post-design-commnet-box col-md-12">
                
                  <div class="post-design-proo-img"> 
                  
                 <img src="https://www.aileensoul.com/uploads/user_image/red_bowers_and_wilkins_p3_headphones-wallpaper-2048x2048.jpg" alt="">
                  </div>


                  <div class="">
                  <div class="col-md-10 inputtype-comment">
                  <input type="text" name="89" id="post_comment89" placeholder="Type Comment ..." value="" onclick="entercomment(this.name)">
                  </div>

                                      <div class="col-md-1 comment-edit-butn">                                      
                  <button id="89" onclick="insert_comment(this.id)">Comment</button>
                                             
                  </div>
</div>

      </div>

   </div>
  </div>
</div>

    </div>
                </div>
                </div>   
                </div>
                </div>
               <div class="post-design-like-box col-md-12">
                <div class="post-design-menu">
                  <ul>

                    <li class="<?php echo 'likepost' . $row['art_post_id']; ?>">

                    <a id="<?php echo $row['art_post_id']; ?>" onClick="post_like(this.id)">

                    <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('art_post_id' => $row['art_post_id'], 'status' =>'1');
          $artlike =   $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artlike[0]['art_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>

                    <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                    <?php }else{
                        ?>
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>

                    <span>
                      <?php 
                      if($row['art_likes_count'] > 0){
                      echo $row['art_likes_count'];
                       } 
                      ?>
                     </span>
                      </a>
                    </li>

                    <li>
                     <?php 

          $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
           $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

                                   ?>
                    <a  onClick="commentall(this.id)" id="<?php echo $row['art_post_id']; ?>"><i class="fa fa-comment-o" aria-hidden="true">
                      <?php 
                    if(count($commnetcount) > 0){
                    echo count($commnetcount); 
                   }else{}
                    ?>
                    </i>
                   
                    </a>
                    </li>
                  </ul>

                  </div>
                </div>

<!-- like user list start -->

<!-- pop up box start-->
<div id="<?php echo "popuplike" . $row['art_post_id']; ?>" class="overlay">
  <div class="popup">
    
    <div class="pop_content">
      
      <?php 


$contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['art_like_user'];
$countlike = $commnetcount[0]['art_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);


      foreach ($likelistarray as $key => $value) {
       
$art_fname1 =  $this->db->get_where('art_reg',array('user_id' => $value, 'status' => 1))->row()->art_name;

$art_lname1 =  $this->db->get_where('art_reg',array('user_id' => $value, 'status' => 1))->row()->art_lastname;
      ?>

      <a href="<?php echo base_url('artistic/artistic_profile/'.$value); ?>">
      <?php echo ucwords($art_fname1); echo "&nbsp;"; echo ucwords($art_lname1); ?>
        
      </a>

<?php }?>

<p class="okk"><a class="cnclbtn" href="#">Cancle</a></p>

    </div>

  </div>
</div>
<!-- pop up box end-->

                        <a  href="<?php echo "#popuplike" . $row['art_post_id']; ?>">
                        <?php

$contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' =>'0');
$commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); 

$likeuser = $commnetcount[0]['art_like_user'];
$countlike = $commnetcount[0]['art_likes_count'] - 1;

$likelistarray = explode(',', $likeuser);

$art_fname =  $this->db->get_where('art_reg',array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;

$art_lname =  $this->db->get_where('art_reg',array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                        ?>


<div>


<?php echo ucwords($art_fname); echo "&nbsp;"; echo ucwords($art_lname); echo "&nbsp;"; ?>

</div>

<?php

if(count($likelistarray) > 1) {
?>
<div>
<?php  echo "and"; ?>
</div>

<b><?php echo $countlike; echo "others"; ?> </b>


<?php }?>
</a>

<!-- like user list end -->


                <div class="art-all-comment col-md-12">
<!-- all comments code start-->
                       <div id="<?php echo "fourcomment" . $row['art_post_id']; ?>" style="display:none">

                                    <?php 

                                    $contition_array = array('art_post_id' =>  $row['art_post_id'], 'status' =>'1');
        $artdata =   $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data='*', $sortby = 'artistic_post_comment_id', $orderby = 'ASC', $limit = '', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($artdata){
                                      foreach($artdata as $rowdata)
                                        { 

                 $artname =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id']))->row()->art_name;?>
<div class="all-comment-comment-box">
 <div class="post-design-pro-comment-img"> 
                  <?php 
                 $art_userimage =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                 ?>

                 <img  src="<?php echo base_url(ARTISTICIMAGE . $art_userimage);?>"  alt="">
                  </div>
<div class="comment-name">
                                        <b>
                                      <?php  echo $artname; echo '</br>';
                                        ?>
                                        </b>
                                        </div>

                                        <div  class="comment-details" id= "<?php echo "showcomment2" . $rowdata['artistic_post_comment_id']; ?>">
                                       <?php  echo $rowdata['comments']; echo '</br>';
                                       ?>
                                       </div>
                                      

                                        <input type="text" name="editcomment2" id="<?php echo "editcomment2" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>">

                                        <button id="<?php echo "editsubmit2" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment2(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Comment</button>

                            <div class="art-comment-menu-design"> 
                               <div class="comment-details-menu" id="<?php echo 'likecomment' . $rowdata['artistic_post_comment_id']; ?>">
                                <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like(this.id)">

            <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' =>'1');
          $artcommentlike =   $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>
                      <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>
                      <?php }else{
                        ?>
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>

                                  <span>
                                       <?php
                                       if($rowdata['artistic_comment_likes_count']){
                                        echo $rowdata['artistic_comment_likes_count']; 
                                         }
                                        ?>
                                  </span>
                                  </a>
                                 </div>

 <?php
                    $userid  = $this->session->userdata('aileenuser');
                      if($rowdata['user_id'] == $userid){ 
                           ?>                                 
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">  
                                     <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_editbox2(this.id)" class="editbox">Edit
                                      </a>
 </div>

 <?php }?>

 

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $art_userid =  $this->db->get_where('art_post',array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $art_userid == $userid){ 
             ?>   
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">  
                                     <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['art_post_id']; ?>">
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                      </span>
                                      </a>
     </div>

     <?php }?>
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">  <p>

                             
                                    <?php
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?></p></div>

                                          </div>
                                       </div>
 

                                        <?php    } 

                                           }else{ echo 'No comments Available!!!';} ?>
                 
                                    </div>


                                    <div  id="<?php echo "threecomment" . $row['art_post_id']; ?>" style="display:block">
                                                <div class="<?php echo 'insertcomment' . $row['art_post_id']; ?>">
                                                <?php 

                                    $contition_array = array('art_post_id' =>  $row['art_post_id'], 'status' =>'1');
        $artdata =   $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data='*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str= array(), $groupby = ''); 
                                      
                                        if($artdata){
                                      foreach($artdata as $rowdata)
                                        {
                                          $artname =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id']))->row()->art_name;?>
                                         <div class="all-comment-comment-box">
   <div class="post-design-pro-comment-img"> 
                  <?php 
                 $art_userimage =  $this->db->get_where('art_reg',array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image;
                 ?>

                 <img  src="<?php echo base_url(ARTISTICIMAGE . $art_userimage);?>"  alt="">
                  </div>
<div class="comment-name">
                                       <b><?php echo $artname; echo '</br>'; ?>
</b>
</div>

                                        <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['artistic_post_comment_id']; ?>">
                                        <?php
                                        echo $rowdata['comments']; echo '</br>';
                                        ?>
                                        </div>
    <div class="col-md-12">
                                        <div class="col-md-10"> 
                                        <input type="text" name="editcomment" id="<?php echo "editcomment" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" value="<?php  echo $rowdata['comments']; ?>">
 </div>

                                        <div class="col-md-2 comment-edit-button">
                                        
                                        <button id="<?php echo "editsubmit" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Comment</button>

                                       </div>

</div>
 <div class="art-comment-menu-design"> 
                               <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['artistic_post_comment_id']; ?>">
                                  <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like1(this.id)">

                                   <?php

             $userid = $this->session->userdata('aileenuser');
          $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' =>'1');
          $artcommentlike =   $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array , $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str= array(), $groupby = '');
          $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                      if(!in_array($userid, $likeuserarray)){
                        ?>

                        <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i> 
                    <?php }else{
                    ?>
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                     <?php }
                     ?>
                        <span>
                       <?php 
                       if($rowdata['artistic_comment_likes_count'] > 0){
                       echo $rowdata['artistic_comment_likes_count'];
                        }
                        ?>
                        </span>
                        </a>
</div>
<?php
                    $userid  = $this->session->userdata('aileenuser');
                      if($rowdata['user_id'] == $userid){ 
                           ?> 

<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                      </a>
                                      
    </div>
 <?php }?>

 <?php
       $userid  = $this->session->userdata('aileenuser');

       $art_userid =  $this->db->get_where('art_post',array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;


          if($rowdata['user_id'] == $userid ||  $art_userid == $userid){ 
             ?> 
<span role="presentation" aria-hidden="true"> · </span>
<div class="comment-details-menu">
                                      <input type="hidden" name="post_delete"  id="post_delete" value= "<?php echo $rowdata['art_post_id']; ?>">
                                      <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>">
                                      </span>
                                      </a>
 </div>
<?php }?>
 <span role="presentation" aria-hidden="true"> · </span>

<div class="comment-details-menu">
                                         <p>
                                       <?php 
                                        echo date('d-M-Y',strtotime($rowdata['created_date'])); echo '</br>'; ?>
 </p></div></div>
                                       </div>
                                             

                                         <?php }
                                       }
                                      ?>
                                                  
                                                </div>
                                                </div>
<!-- all comments code end -->

                  </div>
                </div>
                <div class="post-design-commnet-box col-md-12">
                
                  <div class="post-design-proo-img">
                   <img src="<?php echo base_url(USERIMAGE .  $userimage);?>" name="image_src" id="image_src" / >
                    </div>


                  <div class="">
                  <div class="col-md-10 inputtype-comment">
                  <input type="text" name="post_comment"  id="<?php echo "post_comment" . $row['art_post_id']; ?>" placeholder="Type Comment ..." value= "">
                                                 <?php echo form_error('post_comment'); ?>
                                                 </div>
                                                   <div class="col-md-1 comment-edit-butn">   
                                                 <button id="<?php echo $row['art_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button> </div>
</div>
             
      </div>
      </div>
      
       <?php
        }
        ?>
        </div>

</div>

    </div>
   </div>     
    </section>
   <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    <footer>
        
        <?php echo $footer;  ?>
    </footer>
    
</body>
</html>

<!-- footer End -->
<!-- script for skill textbox automatic start (option 2)-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery.jMosaic.js'); ?>"></script>
 
  <script type="text/javascript" src="<?php echo base_url('js/select2-4.0.3.min.js'); ?>"></script>
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
             

              results: data


            };
            
          },
           cache: true
        }
      });
//select2 autocomplete End for Location


  </script>
  

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

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

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


  <!-- post like script start -->

<script type="text/javascript">
function post_like(clicked_id)
{
   
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/like_post" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ 
                    $('.' + 'likepost' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--post like script end -->

<!-- comment like script start -->

<script type="text/javascript">
function comment_like(clicked_id)
{
    
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/like_comment" ?>',
                 data:'post_id='+clicked_id,
                success:function(data){ 
                    $('.' + 'likecomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--comment like script end -->

<!-- comment delete script start -->

<script type="text/javascript">
function comment_delete(clicked_id)
{
    
     var post_delete = document.getElementById("post_delete");
   
   $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "artistic/delete_comment" ?>',
                 data:'post_id='+clicked_id + '&post_delete='+post_delete.value,
                success:function(data){ 

                 

                    $('.' + 'insertcomment' + post_delete.value).html(data);
                    
                }
            }); 
}
</script>

<!--comment delete script end -->


<!-- comment insert script start -->

<script type="text/javascript">
function insert_comment(clicked_id)
{
    var post_comment = document.getElementById("post_comment");
  
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/insert_comment" ?>',
                 data:'post_id='+clicked_id + '&comment='+post_comment.value,
                   success:function(data){ 
                     $('input').each(function(){
                      $(this).val('');
                  }); 
                    $('.' + 'insertcomment' + clicked_id).html(data);
                    
                }
            }); 
}
</script>

<!--comment insert script end -->

<!-- comment edit script start -->

<!-- comment edit box start-->
<script type="text/javascript">
    
    function comment_editbox(clicked_id){  
        document.getElementById('editcomment' + clicked_id).style.display='block';
        document.getElementById('showcomment' + clicked_id).style.display='none';
        document.getElementById('editsubmit' + clicked_id).style.display='block';
        
}

function comment_editbox2(clicked_id){  
        document.getElementById('editcomment2' + clicked_id).style.display='block';
        document.getElementById('showcomment2' + clicked_id).style.display='none';
        document.getElementById('editsubmit2' + clicked_id).style.display='block';
        
}

</script>

<!--comment edit box end-->

<!-- comment edit insert start -->

<script type="text/javascript">
function edit_comment(abc)
{

   var post_comment_edit = document.getElementById("editcomment" + abc);
   
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

         document.getElementById('editcomment' + abc).style.display='none';
       document.getElementById('showcomment' + abc).style.display='block';
       document.getElementById('editsubmit' + abc).style.display='none';
                     
                    $('#' + 'showcomment' + abc).html(data);


                    
                }
            }); 
   
}
</script>


<script type="text/javascript">
function edit_comment2(abc)
{ 

   var post_comment_edit = document.getElementById("editcomment2" + abc);
   
   $.ajax({ 
                type:'POST',
                url:'<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                 data:'post_id='+abc + '&comment='+post_comment_edit.value,
                   success:function(data){ 

                  
         document.getElementById('editcomment2' + abc).style.display='none';
       document.getElementById('showcomment2' + abc).style.display='block';
       document.getElementById('editsubmit2' + abc).style.display='none';
                     
                    $('#' + 'showcomment' + abc).html(data);


                    
                }
            }); 
  
}
</script>


<!--comment edit insert script end -->

<!-- hide and show data start-->
<script type="text/javascript">
  function commentall(){ 
 

   var x = document.getElementById('threecomment');
   var y = document.getElementById('fourcomment');
    if (x.style.display === 'block' && y.style.display === 'none') {
        x.style.display = 'none';
        y.style.display = 'block';
 
    } else {
        x.style.display = 'block';
        y.style.display = 'none';
    }

  }
</script>
<!-- hide and show data end-->



<!-- cover image start -->
<script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   document.getElementById('message1').style.display = "block";

   setTimeout(function () { location.reload(1); }, 5000);
   
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
        width: 1000,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 1030,
        height: 350
    }
});


$('.upload-result').on('click', function (ev) {
  $uploadCrop.croppie('result', {
    type: 'canvas',
    size: 'viewport'
  }).then(function (resp) {

    $.ajax({
      url: "https://www.aileensoul.com/artistic/ajaxpro",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
        html = '<img src="' + resp + '" />';
         $("#upload-demo-i").html(html);
      }
    });

  });
});

//aarati code start
$('#upload').on('change', function () { 
  
  
  
  var reader = new FileReader();
  
    reader.onload = function (e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL(this.files[0]);

    

});

$('#upload').on('change', function () { 
  
  var fd = new FormData();
 fd.append( "image", $("#upload")[0].files[0]);

    $.ajax({

        url: "<?php echo base_url(); ?>artistic/image",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success:function(response){
         

        }
      });
  });

//aarati code end
</script>
<!-- cover image end -->
 


<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction1(clicked_id) {
    document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn1')) {

    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction(clicked_id) {
    document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn2')) {

    var dropdowns = document.getElementsByClassName("dropdown-content2");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script>
$(function() {
var showTotalChar = 270, showChar = "Further", hideChar = "less";
$('.show').each(function() {
var content = $(this).text();
if (content.length > showTotalChar) {
var con = content.substr(0, showTotalChar);
var hcon = content.substr(showTotalChar, content.length - showTotalChar);
var txt= con +  '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
$(this).html(txt);
}
});
$(".showmoretxt").click(function() {
if ($(this).hasClass("sample")) {
$(this).removeClass("sample");
$(this).text(showChar);
} else {
$(this).addClass("sample");
$(this).text(hideChar);
}
$(this).parent().prev().toggle();
$(this).prev().toggle();
return false;
});
});
</script>
 <script type="text/javascript">
    //For blocks or images of size, you can use $(document).ready
    $(document).ready(function() {
      
      $('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});

    });
    
    //If this image without attribute WIDTH or HEIGH, you can use $(window).load
    $(window).load(function() {
            //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
        });
    
    //You can update on $(window).resize
    $(window).resize(function() {
      //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
      //$('.blocks').jMosaic({items_type: "li", margin: 0});
    });
    </script>
  
<script>
function openModal() {
  document.getElementById('myModal1').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal1').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
