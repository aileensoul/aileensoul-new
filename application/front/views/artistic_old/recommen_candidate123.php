<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/demo.css'); ?>">

    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
    <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
 <?php echo $art_header2; ?>
    <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">


       <div class="col-md-4"><div class="profile-box profile-box-left">

   <div class="full-box-module">    
                                <div class="profile-boxProfileCard  module">
                                    <div class="profile-boxProfileCard-cover">    
                                        <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                           href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>"
                                           tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $businessdata[0]['company_name']; ?>">
                                            <!-- box image start -->
                                            <?php if ($businessdata[0]['profile_background'] != '') { ?>
                                                <img src="<?php echo base_url(BUSBGIMG . $businessdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>"  style="height: 95px; width: 100%; ">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $businessdata[0]['company_name']; ?>"  style="height: 95px; width: 100%;">
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="profile-boxProfileCard-content clearfix">
                                        <div class="buisness-profile-txext col-md-4">
                                            <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>" title="<?php echo $businessdata[0]['company_name']; ?>" tabindex="-1" aria-hidden="true" rel="noopener" >
                                                <?php
                                                if ($businessdata[0]['business_user_image']) {
                                                    ?>
                                                    <img  src="<?php echo base_url(USERIMAGE . $businessdata[0]['business_user_image']); ?>"  alt="<?php echo $businessdata[0]['company_name']; ?>" style="height: 77px; width: 71px; z-index: 3; position: relative; ">
                                                <?php } else { ?>
                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="<?php echo $businessdata[0]['company_name']; ?>">
                                                <?php } ?>                           
                                                <!-- 
                        <img class="profile-boxProfileCard-avatarImage js-action-profile-avatar" src="images/imgpsh_fullsize (2).jpg" alt="" style="    height: 68px;
                        width: 68px;">
                                                -->
                                            </a>
                                        </div>
                                        <div class="profile-box-user  profile-text-bui-user  fr col-md-9">
                                            <span class="profile-company-name ">
                                                <a style="margin-left: 3px;" href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>"> 
                                                    <?php echo ucwords($businessdata[0]['company_name']); ?>
                                                </a> 
                                            </span>
                                            <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                            <div class="profile-boxProfile-name">
                                                <a style="padding-left: 1px;" href="<?php echo base_url('business_profile/business_profile_manage_post/'); ?> " title="<?php echo ucwords($businessdata[0]['company_name']); ?>" >
                                                    <b> <?php echo $category; ?></b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-box-bui-menu  col-md-12">
                                            <ul class="">
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'business_profile_manage_post') { ?> class="active" 
                                                    <?php } ?>>
                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post'); ?>">Dashboard
                                                    </a>
                                                </li>
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'followers') { ?> class="active" 
                                                    <?php } ?>>
                                                    <a href="<?php echo base_url('business_profile/followers'); ?>">Followers 
                                                        <br> (<?php echo (count($businessfollowerdata)); ?>)
                                                    </a>
                                                </li>
                                                <li 
                                                    <?php if ($this->uri->segment(1) == 'business_profile' && $this->uri->segment(2) == 'following') { ?> class="active" 
                                                    <?php } ?>>
                                                    <a href="<?php echo base_url('business_profile/following'); ?>">Following 
                                                        <br> (<?php echo (count($businessfollowingdata)); ?>) 
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

  
  
   
</div>
</div>
<!-- left side box close -->


   <div class="col-md-7 col-sm-7 all-form-content" style="height: 150%;">
                        <div class="common-form">
                            <div class="job-saved-box">

                                <h3>Search Result</h3>
                                <div class="contact-frnd-post">
                                    <div class="job-contact-frnd ">
<!-- main data start --> 
                            <div class="profile-job-post-title-inside clearfix" style="border: 1px solid #d9d9d9;">
          <div class="profile-job-profile-button clearfix box_search_module" style="height: 16%;">
                                                            <!-- pop up box start-->
              
                                                            <!-- pop up box end-->
     <div class="profile-job-post-location-name-rec">
          <div class="module_Ssearch" style="display: inline-block; float: left;">
             <div class="search_img">
                           <img src="http://localhost/aileensoul/uploads/user_image/sergey-brin-33.jpg" alt=" ">
                        </div>
       </div>
   
       <div class="designation_rec" style="    float: left;
    width: 60%;
    padding-top: 16px;">
          <ul>
       <li>
      <a style="  font-size: 19px;
         font-weight: 600;" href="" title=" dhaval shah">
       <!-- <?php echo $key['art_name'].' '.$key['art_lastname'];?> -->
       Zalak patel
           
       </a>
      </li>
      
      <li style="display: block;">
        <a  class="color-search" style="font-size: 16px;" href="" title="IAS">
                <!-- <?php  if($key['art_yourart']){echo $key['art_yourart']; }else {echo PROFILENA;}?>             -->
           
           </a>
       </li>
         <li style="display: block;">
         <a  class="color-search" href="">
         Designation
           <!-- <?php if($key['designation']){echo $key['designation'];} else{echo PROFILENA;} ?> -->
         </a>

       </li>
       <li style="display: block;">
         <a  class="color-search" href="">
         <!-- <?php
                  $comma = ", ";
                  $k = 0;
                  $aud = $key['art_skill'];
                  $aud_res = explode(',', $aud);
                  foreach ($aud_res as $skill) {
                 if ($k != 0) {
                 echo $comma;
                     }
               $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
               if ($cache_time) {
               echo $cache_time;
             } else {
                echo PROFILENA;
                }
                 $k++;
                }
               ?> 
 -->           
         </a>

       </li>
       <li style="display: block;">
         <a  class="color-search" href=""><?php echo $key['country'].$key['city']; ?></a>
       </li>
      
    </ul>
      </div>
      <div class="fl search_button">
        <button>follow</button>
        <br>
         <button>Message</button>
      </div>



     </div>
       </div>
       <?php }}?>

       <div class="col-md-12 col-sm-12 post-design-box" id="removepost5" style="margin-bottom: 0px; box-shadow: none; border: none;">
                                    <div class="post_radius_box">  
                                        <div class="post-design-search-top col-md-12" style="background-color: none!important;">  
                                            <div class="post-design-pro-img col-md-2"> 
                                                <!-- pop up box start-->
                                                <div id="popup1" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Your Post is Successfully Saved.
                                                            <p class="okk">
                                                                <a class="okbtn" href="#">Ok
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- pop up box end-->
                                                <!-- pop up box start-->
                                                <div id="popup25" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post?.
                                                            <p class="okk">
                                                                <a class="okbtn" id="5" onclick="remove_post(this.id)" href="#">Yes
                                                                </a>
                                                            </p>
                                                            <p class="okk">
                                                                <a class="cnclbtn" href="#">No
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- pop up box end-->
                                                <!-- pop up box start-->
                                                <div id="popup55" class="overlay">
                                                    <div class="popup">
                                                        <div class="pop_content">
                                                            Are You Sure want to delete this post from your profile?.
                                                            <p class="okk">
                                                                <a class="okbtn" id="5" onclick="del_particular_userpost(this.id)" href="#">OK
                                                                </a>
                                                            </p>
                                                            <p class="okk">
                                                                <a class="cnclbtn" href="#">Cancel
                                                                </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- pop up box end-->                                                                <img src="http://localhost/aileensoul/uploads/user_image/photo2.jpg" alt="">
                                                                                                </div>
                                            <div class="post-design-name fl col-md-9">
                                                <ul>
                                                    
                                                    <li>
                                                    </li>

                                                                                                            <li>
                                                            <div class="post-design-product">
                                                                <a class="post_dot" href="http://localhost/aileensoul/business_profile/business_profile_manage_post/zalak-patel-infotechtechnoloy-pvt-ltd-co-in-ahmedabad-gujrat-india" title="Zalak Patel Infotechtechnoloy.pvt.ltd .co.in.  Ahmedabad Gujrat India" ;="">
                                                                    Zalak Patel Infotechtechnoloy.pvt.ltd .co.in.  Ahmedabad Gujrat India  </a>
                                                                <div class="datespan">  <span style="font-weight: 400;
                                                    font-size: 14px;
                                                    color: #91949d; cursor: default;"> 
                                                                        07-May-2017                                                                    </span></div>

                                                            </div>



                                                        </li>

                                                    
                                                    <li>
                                                        <div class="post-design-product">
                                                            <a href="javascript:void(0);" style=" color: #000033; font-weight: 400; cursor: default;" title="Category">
                                                                IT Sector                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    </li> 
                                                </ul> 
                                            </div>  
                                            <div class="dropdown1">
                                                <a onclick="myFunction(5)" class="dropbtn1 dropbtn1 fa fa-ellipsis-v">
                                                </a>
                                                <div id="myDropdown5" class="dropdown-content1">
                                                     
                                                        <a href="#popup25">
                                                            <i class="fa fa-trash-o" aria-hidden="true">
                                                            </i> Delete Post
                                                        </a>
                                                        <a id="5" onclick="editpost(this.id)">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                            </i>Edit
                                                        </a>
                                                                                                    </div>
                                            </div>
                                            <div class="post-design-desc ">
                                                <div>
                                                    <div id="editpostdata5" style="display:block;">
                                                        <a style="margin-bottom: 0px;     font-size: 16px">
                                                            zalak                                                        </a>
                                                    </div>
                                                    <div id="editpostbox5" style="display:none;">
                                                        <input type="text" id="editpostname5" name="editpostname" placeholder="Product Name" value="zalak">
                                                    </div>
                                                </div>                    

                                                <div id="editpostdetails5" style="display:block;">
                                                    <span class="show"> 
                                                        48648486486                                                    </span>
                                                </div>
                                                <div id="editpostdetailbox5" style="display:none;">
                                                  <!-- <textarea id="editpostdesc5" placeholder="Product Description" class="textbuis" name="editpostdesc">48648486486</textarea>
                                                    -->
                                                    <div contenteditable="true" id="editpostdesc5" placeholder="Product Description" class="textbuis  editable_text" name="editpostdesc">48648486486</div>                  
                                                </div>
                                                <button class="fr" id="editpostsubmit5" style="display:none;margin: 5px 0; border-radius: 3px;" onclick="edit_postinsert(5)">Save
                                                </button>

                                            </div> 
                                        </div>
                                        
                                        <div class="post-design-mid col-md-12" style="border: none;">
                                            <!-- multiple image code  start-->
                                            <div>                                                                                                                                                           <!-- one image start -->
                                                        <div id="basic-responsive-image" style="height: 50%; width: 100%;">
                                                            <a href="http://localhost/aileensoul/business_profile/postnewpage/5">
                                                                <img src="http://localhost/aileensoul/uploads/bus_post_image/1494150788_2.jpg" style="width: 100%; height: 100%;"> 
                                                            </a>
                                                        </div>
                                                        <!-- one image end -->                                                                      <div>
                                                </div>
                                            </div>
                                            <!-- multiple image code  end-->
                                        </div>
                                        <div class="post-design-like-box col-md-12" style="border: none;">
                                            <div class="post-design-menu">
                                                <ul>
                                                    <li class="likepost5">
                                                        <a id="5" onclick="post_like(this.id)">
                                                                           
                                                                <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true">
                                                                </i>                                                    <span>                                                </span>
                                                        </a>
                                                    </li>
                                                    <li id="insertcount5" style="visibility:show">
                                                                                                                <a onclick="commentall(this.id)" id="5">
                                                            <i class="fa fa-comment-o" aria-hidden="true"> 
                                                                11                                                            </i> 
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- like user list start -->
                                        <!-- pop up box start-->
                                        
                                        <div class="likeusername5" id="likeusername5" style="display:none">
                                                                                        <!-- pop up box end-->
                                            <a href="javascript:void(0);" onclick="likeuserlist(5);">
                                                                                                <div class="like_one_other">
                                                    &nbsp;                                                                                                    </div>
                                            </a>
                                        </div>


                                        <!-- like user list end -->
                                        <!-- all comment start-->
                                        <div class="art-all-comment col-md-12">
                                            <div id="fourcomment5" style="display:none;">
                                                <!-- khyati 19-4 changes start -->
                                                <!-- khyati 19-4 changes end -->
                                            </div>
                                            <!-- khyati changes start -->
                                           
                                            <!-- khyati changes end -->
                                            <!-- all comment end -->
                                        </div>
                                        <!-- comment start -->
                                        <div class="post-design-commnet-box col-md-12">
                                            <div class="post-design-proo-img">                                                                      <img src="http://localhost/aileensoul/uploads/user_image/photo2.jpg" alt="">
                                                                                            </div>
                                            <div class="">
                                                <div id="content" class="col-md-10  inputtype-comment" style="padding-left: 7px;">
                                                    <div contenteditable="true" style="min-height:37px !important; margin-top: 0px!important" class="editable_text" name="5" id="post_comment5" placeholder="Type Message ..." onclick="entercomment(5)"></div>
                                                </div>
         
                                                <div class="col-md-1 comment-edit-butn">       
                                                    <button id="5" onclick="insert_comment(this.id)">Comment
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <!-- comment end -->

                                    </div> </div><div class="view_more_details">
                                          <a href="">View more in Aileensoul's Profile</a>
                                        </div>
                                </div>


         </div>
<!-- main data end -->


                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                   <!--  col-md-7 close -->
</div>
</div>
</div>