<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="../css/jquery.jMosaic.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>" /><link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/custom-style'); ?>">
    </head>
<!-- END HEADER -->
<body   class="page-container-bg-solid page-boxed">

<?php echo $header; ?>
<?php echo $art_header2_border; ?>
<section class="custom-row">
<?php echo $artistic_common; ?>
<div class="text-center tab-block">
    <div class="container mob-inner-page">
       <a href="<?php echo base_url('artistic/art_photos/' . $artisticdata[0]['user_id']) ?>">
            Photo
        </a>
       <a href="<?php echo base_url('artistic/art_videos/' . $artisticdata[0]['user_id']) ?>">
            Video
        </a>
       <a href="<?php echo base_url('artistic/art_audios/' . $artisticdata[0]['user_id']) ?>">
            Audio
        </a>
        <a href="<?php echo base_url('artistic/art_pdf/' . $artisticdata[0]['user_id']) ?>">
            PDf
        </a>
    </div>
</div>


<div class="user-midd-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 hidden-sm hidden-xs">
                <div class="full-box-module business_data">
                    <div class="profile-boxProfileCard  module">

                        <div class="head_details1">
                            <span>
                                  <a href="<?php echo base_url('artistic/artistic_profile/' . $this->uri->segment(3)) ?>"> 
                                      <h5><i class="fa fa-info-circle" aria-hidden="true"></i>
                                    Information  
                                   </h5>
                                  </a>     
                            </span>      </div>
                        <table class="business_data_table">
                            <tr>
                                <td class="business_data_td1"><i class="fa fa-trophy" aria-hidden="true"></i></td>
                                <td class="business_data_td2">

                                    <?php
                                    $aud = $artisticdata[0]['art_skill'];
                                    $aud_res = explode(',', $aud);
                                    foreach ($aud_res as $skill) {

                                        $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                        $skill1[] = $cache_time;
                                    }
                                    $listFinal = implode(', ', $skill1);
                                        echo $listFinal;
                                        
                                    ?>   
                                </td>
                            </tr>

                            <tr>
                                <td class="business_data_td1 detaile_map"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></td>
                                <td class="business_data_td2"><span><?php echo $artisticdata[0]['art_yourart']; ?></span></td>
                            </tr>

                            <tr>
                                <td class="business_data_td1 detaile_map"><i class="fa fa-file-text" aria-hidden="true"></i></td>
                                <td class="business_data_td2"><span><?php echo $this->common->make_links($artisticdata[0]['art_desc_art']); ?></span></td>
                            </tr>

                            <tr>
                                <td class="business_data_td1 detaile_map"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                                <td class="business_data_td2">
									<a href="mailto:<?php echo $artisticdata[0]['art_email']; ?>"><?php echo $artisticdata[0]['art_email']; ?></a>
								</td>
                            </tr>
                            <tr>
                                <td class="business_data_td1  detaile_map" ><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                                <td class="business_data_td2"><span>
                                        <?php
                                        if ($artisticdata[0]['art_city']) {
                                            echo $this->db->get_where('cities', array('city_id' => $artisticdata[0]['art_city']))->row()->city_name;
                                            echo",";
                                        }
                                        ?> 
                                        <?php
                                        if ($artisticdata[0]['art_country']) {
                                            echo $this->db->get_where('countries', array('country_id' => $artisticdata[0]['art_country']))->row()->country_name;
                                        }
                                        ?>
                                    </span></td>
                                    </tr>
                        </table>
                    </div>
                </div>
                <a href="<?php echo base_url('artistic/art_photos/' . $artisticdata[0]['user_id']) ?>">
                <div class="full-box-module business_data" id="autorefresh">
                    <div class="profile-boxProfileCard  module buisness_he_module" style="">

                        <div class="head_details">
                            <h5><i class="fa fa-camera" aria-hidden="true"></i>Photos</h5>
                        </div>  
                        <div class="art_photos"></div>
                    </div>
                </div>
                </a>
                <a href="<?php echo base_url('artistic/art_videos/' . $artisticdata[0]['user_id']) ?>">
                <div class="full-box-module business_data">
                    <div class="profile-boxProfileCard  module">
                        <table class="business_data_table">
                            <div class="head_details">
                                 <h5><i class="fa fa-video-camera" aria-hidden="true"></i>  Video</h5>
                            </div>
                            
                            <div class="art_videos"></div>
                        </table>

                    </div>
                </div>
                </a>
                <a href="<?php echo base_url('artistic/art_audios/' . $artisticdata[0]['user_id']) ?>">
                <div class="full-box-module business_data">
                    <div class="profile-boxProfileCard  module">
                        <table class="business_data_table">
                            <div class="head_details">
                                 <h5><i class="fa fa-music" aria-hidden="true"></i>  Audio</h5>
                            </div>
                            <div class="art_audios"></div>
                        </table>
                    </div>
                </div>
                </a>
                <a href="<?php echo base_url('artistic/art_pdf/' . $artisticdata[0]['user_id']) ?>">
                <div class="full-box-module business_data">
                    <div class="profile-boxProfileCard  module pdf_box">
                        <table class="business_data_table">
                            <div class="head_details">
                                 <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</h5>
                            </div>
                            <div class="art_pdf"></div>
                        </table>
                    </div>
                </div>
                </a>
            </div>

            <!-- popup start -->
            <div class="col-md-7 col-sm-12 "  >

<?php 

$userid = $this->session->userdata('aileenuser');
$other_user = $artisticdata[0]['art_id'];

$contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
 $userdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

$loginuser = $userdata[0]['art_id'];

 $contition_array = array('follow_type' => 1, 'follow_status' => 1);

 $search_condition = "((follow_from  = '$loginuser' AND follow_to  = ' $other_user') OR (follow_from  = '$other_user' AND follow_to  = '$loginuser'))";

 $contactperson = $this->common->select_data_by_search('follow', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

//echo "<pre>"; print_r($contactperson); die();
 if((count($contactperson) == 2) || ($artisticdata[0]['user_id'] == $userid)){
?>

                <div class="post-editor col-md-12">
                    <div class="main-text-area col-md-12" style="padding-left: 1px;">
                        <div class="popup-img"> 
                             <?php
                                                    $userimage = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                                                    $userimageposted = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                                                    ?>

                                                    <?php ?>
                                                        
                                                       
                <?php   if ($userimageposted) {    ?>

                 <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $userimageposted)) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />

                <?php }?>

                <?php  }else{?>


                    

                    <?php 
                          $a = $artisticdata[0]['art_name'];
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artisticdata[0]['art_lastname'];
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                    <?php   }?>
                           
                        </div>
                        <div id="myBtn3"  class="editor-content popup-text">
                            <span> Post Your Art....</span> 
<div class="padding-left padding_les_left camer_h">
                                <i class=" fa fa-camera" >
                                </i> 
                            </div>
                        </div>
                        
                    </div>

                </div>
           
<?php }?>
            <!-- The Modal -->
            <div id="myModal3" class="modal-post">

                <!-- Modal content -->
                <div class="modal-content-post">
                    <span class="close3">&times;</span>

                    <div class="post-editor col-md-12 post-edit-popup" id="close">
                        <?php echo form_open_multipart(base_url('artistic/art_post_insert/' . 'manage/' . $artisticdata[0]['user_id']), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "return imgval(event);")); ?>

                        <div class="main-text-area col-md-12" >
                            <div class="popup-img-in "> 

                            <?php if($artisticdata[0]['art_user_image']){?>

                             <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                            <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">

                            <?php }?>

                            <?php }else{?>

                            <?php 
                          $a = $artisticdata[0]['art_name'];
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artisticdata[0]['art_lastname'];
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                            <?php }?>
                            </div>
                            <div id="myBtn3"    class="editor-content col-md-10 popup-text" >
                                   <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
                                <textarea id= "test-upload-product" placeholder="Post Your Art...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form);  onkeyup=check_length(this.form); onblur=check_length(this.form); name=my_text rows=4 cols=30 class="post_product_name"></textarea>
                               <div class="fifty_val">  
                                    <input size=1 class="text_num" tabindex="-500" value=50 name=text_num readonly> 
                                </div>

                            

                      <div class="camera_in padding-left padding_les_left camer_h">
                                <i class=" fa fa-camera" >
                                </i> 
                            </div>
</div>
                        </div>
                        <div class="row"></div>
                        <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                    <textarea id="test-upload-des" name="product_desc" class="description" placeholder="Enter Description"></textarea>

                            <output id="list"></output>
                        </div>




                        <div class="popup-social-icon">
                            <ul class="editor-header">

                                <li>

                                    <div class="col-md-12"> <div class="form-group">
                                            <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                        </div></div>


                                    <label for="file-1"><i class=" fa fa-camera "  style=" margin: 8px; cursor:pointer"> Photo</i><i class=" fa fa-video-camera"  style=" margin: 8px; cursor:pointer"> Video </i> <i class="fa fa-music "  style=" margin: 8px; cursor:pointer"> Audio </i><i class=" fa fa-file-pdf-o "  style=" margin: 8px; cursor:pointer"> PDF </i> </label>


                                </li>
                            </ul>


                        </div>
                        <div class="fr">
                            <button type="submit"  value="Submit" style="margin: 0px;">Post</button>    </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- popup end -->
            
          
            <div class="bs-example">
                                <div class="progress progress-striped" id="progress_div">
                                    <div class="progress-bar" style="width: 0%;">
                                        <span class="sr-only">0%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="art-all-post">
                <div class="job-contact-frnd ">


                    <?php
//echo "<pre>"; print_r($artsdata); die();
                    if (count($artsdata) > 0) { 
                        foreach ($artsdata as $row) {

                            ?>

            <div id="<?php echo "removepost" . $row['art_post_id']; ?>">
                 <div class="profile-job-post-detail clearfix">
                     <div class=" post-design-box">


                         <div class="post-design-top col-md-12" >  
                                                <div class="post-design-pro-img"> 

                                                    <?php
                                                    $userimage = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_user_image;
                                                    $userimageposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_user_image;

                                                     $firstname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_name;
                                                    $lastname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_lastname;

                                                    $firstnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_name;
                                                    $lastnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_lastname;
                                                    ?>

                                                    <?php if ($row['posted_user_id']) {  ?>
                                                        <a  class="post_dot" title="<?php echo ucfirst(strtolower($firstnameposted)) . ' ' . ucfirst(strtolower($lastnameposted)); ?>" href="<?php echo base_url('artistic/art_manage_post/' . $row['posted_user_id']); ?>">
                                                       
                                                      <?php   if ($userimageposted) {    ?>


                                           <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $userimageposted)) {
                                                                $a = $firstnameposted;
                                                                $acr = substr($a, 0, 1);
                                                                $b = $lastnameposted;
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                                  <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" /> 
                                  <?php }?>

                                  </a>
                                                        <?php  }else{?>

                                                        <?php 
                          $a = $firstnameposted;
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $lastnameposted;
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       


                                                       <?php   }?>
                                      
              <?php } else {   ?>


                                                        <a class="post_dot"  href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>">
                                                         <?php
                            if ($artisticdata[0]['art_user_image']) {
                                ?>

                                 <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $userimage)) {
                                                                $a = $firstname;
                                                                $acr = substr($a, 0, 1);
                                                                $b = $lastname;
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                                <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $userimage); ?>" name="image_src" id="image_src" />
                                <?php }?>


                                  <?php } else { ?>

                               <?php 
                          $a = $firstname;
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $lastname;
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                            <?php } ?>
                                                            </a>

                                                    <?php } ?>
                                                </div>


                                                <div class="post-design-name fl col-xs-8 col-md-10">
                                                    <ul>
                                                        <li>
                                                                <?php
                                                                $firstname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_name;
                                                                $lastname = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->art_lastname;

                                                                $firstnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_name;
                                                                $lastnameposted = $this->db->get_where('art_reg', array('user_id' => $row['posted_user_id']))->row()->art_lastname;
                                                              
                                                                 $designation = $this->db->get_where('art_reg', array('user_id' => $row['user_id']))->row()->designation;
                                                                ?>
                                                            
                                                            <!-- other user post time name strat-->

                                                            <?php if ($row['posted_user_id']) { ?>

                                                                <div class="else_post_d">
                                                                <div class="post-design-product">

                                                                    <a  class="post_dot padding_less_left" style="max-width: 30%;" title="<?php echo ucfirst(strtolower($firstnameposted)) . ' ' . ucfirst(strtolower($lastnameposted)); ?>" href="<?php echo base_url('artistic/art_manage_post/' . $row['posted_user_id']); ?>"><?php echo ucfirst(strtolower($firstnameposted)) . ' ' . ucfirst(strtolower($lastnameposted)); ?> </a><span class="posted_with" > Posted     With 
                                                                    </span><a class="post_dot1 padding_less_left" title="<?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?>"  href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>"><?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?></a>
                                                                  <span role="presentation" aria-hidden="true"> · </span>  <span style="color: #91949d; font-size: 14px;"> 
                                                                        <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>
                                                                    </span>
                                                                </div>
                                                                </div>
                                                                <!-- other user post time name end-->
                                                            <?php } else { ?>
                                                              <div class="post-design-product">

                                                                <a  class="post_dot" title="<?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?>"   href="<?php echo base_url('artistic/art_manage_post/' . $row['user_id']); ?>">
                                                                    <?php echo ucfirst(strtolower($firstname)) . ' ' . ucfirst(strtolower($lastname)); ?>

                                                                </a><span role="presentation" aria-hidden="true"> · </span>
                                                                <div class="datespan">
                     <span style="font-weight: 400; font-size: 13px; color: #91949d;">
         <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?>                               
                 </span></div>
                                                                    </div>
                                                            <?php } ?>  

                                                        </li>
                                                         <li><div class="post-design-product">
                                                                <a class="in_desc_cw"><?php if($designation)
                                                                    {echo $designation;
                                                                    
                                                                    }else{
                                                                        echo "Current Work.";

                                                                       }?> </a>
                                                                
                                                            </div></li>

                                                    </ul> 
                                                </div>

                                                <?php 

                                                $userid = $this->session->userdata('aileenuser');


                                                if($userid == $row['posted_user_id'] || $row['user_id'] == $userid){

                                                ?>
                                                <div class="dropdown2">
                                                    <a onClick="myFunction1(<?php echo $row['art_post_id']; ?>)" class="dropbtn2 dropbtn2 fa fa-ellipsis-v"></a>
                                                    <div id="<?php echo "myDropdown" . $row['art_post_id']; ?>" class="dropdown-content2">

                                                        <?php 
                                                        if ($row['posted_user_id'] != 0) {

                                                            if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                                                                ?>
                                                                <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>

                                                                <a id="<?php echo $row['art_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>

                                                            <?php } else {
                                                                ?>

                                                                <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>

                                                                <!-- <a href="<?php echo base_url('artistic/artistic_contactperson/' . $row['user_id'] . ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a> -->

                                                            <?php }
                                                        } else {
                                                            ?>  


                                                            <?php
                                                            $userid = $this->session->userdata('aileenuser');
                                                            if ($row['user_id'] == $userid) {
                                                                ?>

                                                                <a id="<?php echo $row['art_post_id']; ?>" onClick="deleteownpostmodel(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete Post</a>
                                                                <a id="<?php echo $row['art_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>

                                                     <?php }  ?>
                                                               
                                                            <?php 
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <?php }?>


                                                <div class="post-design-desc ">
                                                    <span> 
                                                        <div id="<?php echo 'editpostdata' . $row['art_post_id']; ?>" style="display:block;">
                                                            <span class="ft-15 t_artd"><?php echo $this->common->make_links($row['art_post']); ?></span>
                                                        </div>

            <div id="<?php echo 'editpostbox' . $row['art_post_id']; ?>" style="display:none; margin-bottom: 10px;">
                    <input type="text" class="my_text" id="<?php echo 'editpostname' . $row['art_post_id']; ?>" name="editpostname" placeholder="Title" value="<?php echo $row['art_post']; ?>"  onKeyDown=check_lengthedit(<?php echo $row['art_post_id']; ?>); onKeyup=check_lengthedit(<?php echo $row['art_post_id']; ?>); onblur=check_lengthedit(<?php echo $row['art_post_id']; ?>);>

                    <?php 
                              if($row['art_post']){ 
                                $counter = $row['art_post'];
                                $a = strlen($counter);

                                ?>

                            <input size=1 id="text_num" class="text_num" tabindex="-501" value="<?php echo (50 - $a);?>" name=text_num readonly>

                           <?php }else{?>
                           <input size=1 id="text_num" tabindex="-502" class="text_num" value=50 name=text_num readonly> 

                            <?php }?>
            </div>
                          

                      <div id="<?php echo "khyati" . $row['art_post_id']; ?>" style="display:block;">
                      <?php
                     $small = substr($row['art_description'], 0, 180);
                     echo $this->common->make_links($small);

                     if (strlen($row['art_description']) > 180) {
                          echo '... <span id="kkkk" onClick="khdiv(' . $row['art_post_id'] . ')">View More</span>';
                        }?>
                   </div>
                    <div id="<?php echo "khyatii" . $row['art_post_id']; ?>" style="display:none;">
                      <?php
                     echo $row['art_description'];
                   ?>
                   </div>

                    <div id="<?php echo 'editpostdetailbox' . $row['art_post_id']; ?>" style="display:none;">

<div contenteditable="true" class="editable_text"  id="<?php echo 'editpostdesc' . $row['art_post_id']; ?>" placeholder="Description" name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $row['art_description']; ?></div> 
                                                        </div>

                                                        <button class="fr" id="<?php echo "editpostsubmit" . $row['art_post_id']; ?>" style="display:none;margin: 5px 0px;" onClick="edit_postinsert(<?php echo $row['art_post_id']; ?>)">Save</button>


                                                    </span></div>
                                            </div> 
                                            
               <!-- multiple image code  start--> 


                    <div class="post-design-mid col-md-12" > 
                         <div class="mange_post_image">

                              <?php
                                                    $contition_array = array('post_id' => $row['art_post_id'], 'is_deleted' => '1', 'image_type' => '1');
                                                    $artmultiimage = $this->data['artmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                    ?>

                                                    <?php if (count($artmultiimage) == 1) { ?>

                                                        <?php
                                                        $allowed = array('gif', 'png', 'PNG', 'jpg','PNG');
                                                        $allowespdf = array('pdf');
                                                        $allowesvideo = array('mp4', 'webm','MP4');
                                                        $allowesaudio = array('mp3');
                                                        $filename = $artmultiimage[0]['image_name'];
                                                        $ext = pathinfo($filename, PATHINFO_EXTENSION);

                                                        if (in_array($ext, $allowed)) {
                                                            ?>

                                                            <!-- one image start -->
                                                             <div class="one-image">
                                                                <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']) ?>" > </a>

                                           
                                                            </div>
                                                            <!-- one image end -->

              <?php } elseif (in_array($ext, $allowespdf)) { ?>

                                                            <!-- one pdf start -->
                                                            <div  >
                                                                <a href="<?php echo base_url('artistic/creat_pdf/' . $artmultiimage[0]['image_id']) ?>"><div class="pdf_img">
                                                                        <img style="height: 100%; width: 100%;" src="<?php echo base_url('images/PDF.jpg') ?>" >
                                                                    </div></a>
                                                            </div>
                                                            <!-- one pdf end -->

                <?php } elseif (in_array($ext, $allowesvideo)) { ?>

                                                            <!-- one video start -->
                                                            <div class="video_post">
                                                                <video width="100%" class="video" height="55%" controls>


                                                                    <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']) ?>" type="video/mp4">
                                                                    <source src="movie.ogg" type="video/ogg">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </div>
                                                            <!-- one video end -->

                <?php } elseif (in_array($ext, $allowesaudio)) { ?>

                                                            <!-- one audio start -->
                                                            <div>
                                                                <div class="audio_main_div">
                                                                    <div class="audio_img">
                                                                        <img src="<?php echo base_url('images/music-icon.png') ?> ">  
                                                                    </div>
                                                                    <div class="audio_source">
                                                                        <audio  controls>

                                                                            <source src="<?php echo base_url($this->config->item('art_post_main_upload_path') . $artmultiimage[0]['image_name']); ?>" type="audio/mp3">
                                                                            <source src="movie.ogg" type="audio/ogg">
                                                                            Your browser does not support the audio tag.
                                                                        </audio>
                                                                    </div>
                                                                    <div class="audio_mp3" id="<?php echo "postname" . $row['art_post_id']; ?>">
                                                                        <p title="<?php echo $row['art_post']; ?>"><?php echo $row['art_post']; ?></p>
                                                                    </div>
                                                                </div> 
                                                                <!-- one audio end -->

                                                            <?php } ?>
                                         <?php } elseif (count($artmultiimage) == 2) { ?>
                                         <?php
                                                            foreach ($artmultiimage as $multiimage) {
                                                                ?>

                                                                <!-- two image start -->
                                                                 <div class="two-images">
                                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="two-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                                                                </div>

                                                                <!-- two image end -->
                                                            <?php } ?>

            <?php } elseif (count($artmultiimage) == 3) { ?>

                 <!-- three image start -->
                                                           <div class="three-image-top">
                                                                <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[0]['image_name']) ?>"> </a>
                                                            </div>
                                                            <div class="three-image">
                                                                <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[1]['image_name']) ?>" > </a>
                                                            </div>

                                                              <div class="three-image">
                                                                <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[2]['image_name']) ?>" > </a>
                                                            </div>

                                                            <!-- three image end -->


                                                       <?php } elseif (count($artmultiimage) == 4) { ?>

                                                       <?php
                                                            foreach ($artmultiimage as $multiimage) {
                                                                ?>

                                                                <!-- four image start -->
                                                             <div class="four-image">
                                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>"> </a>

                                                                </div>

                                                                <!-- four image end -->

                                                            <?php } ?>


           <?php } elseif (count($artmultiimage) > 4) { ?>


                               <?php
                                                            $i = 0;
                                                            foreach ($artmultiimage as $multiimage) {
                                                                ?>

                                                                <!-- five image start -->
                                                                <div>
                                                                     <div class="four-image">
                                                                        <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                                                                    </div>
                                                                </div>

                                                                <!-- five image end -->

                                                                <?php
                                                                $i++;
                                                                if ($i == 3)
                                                                    break;
                                                            }
                                                            ?>
                                                            <!-- this div view all image start -->

                                                                            <div>
                                                               <div class="four-image">
                                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>"><img src="<?php echo base_url($this->config->item('art_post_thumb_upload_path') . $artmultiimage[3]['image_name']) ?>" > </a>

                                                                    <a href="<?php echo base_url('artistic/postnewpage/' . $row['art_post_id']) ?>" >
                                                                <div class="more-image" >
<span>

                                                                    View All (+<?php echo (count($artmultiimage) - 4); ?>)</span>
                                                                </div>
                                                                </a>
                                                                </div>
                                                            </div>
                                                            <!-- this div view all image end -->


            <?php } ?>
                         </div>

                    </div>

                    </div>

                    <!-- multiple image code  end--> 



                                            <div class="post-design-like-box col-md-12">
                                                <div class="post-design-menu">
                                                    <!-- like comment div start -->
                                                    <ul class="col-md-6">
                                                        <li class="<?php echo 'likepost' . $row['art_post_id']; ?>">
                                                            <a title="Like" class="ripple like_h_w" id="<?php echo $row['art_post_id']; ?>" class="ripple like_h_w" onClick="post_like(this.id)">

                                                                <?php
                                                                $userid = $this->session->userdata('aileenuser');
                                                                $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                                                                $artlike = $this->data['artlike'] = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                $likeuserarray = explode(',', $artlike[0]['art_like_user']);

                                                                if (!in_array($userid, $likeuserarray)) {
                                                                    ?>
                                                                    <i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>
                                                                <?php } else {
                                                                    ?>
                                                                    <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
            <?php }
            ?>

                                                                <span class="like_As_count">

                                                                    <?php
//                                                                    if ($row['art_likes_count'] > 0) {
//                                                                        echo $row['art_likes_count'];
//                                                                    }
                                                                    ?>

                                                                </span> 

                                                            </a>

                                                        </li>
                                                        <!-- <li class="m4-24">
                                                           
                                                        </li> -->
                                                        <li id="<?php echo 'insertcount' . $row['art_post_id']; ?>" style="visibility:show">

                                                            <?php
                                                            $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                            $commnetcount = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            ?>
                                                            <a class="ripple like_h_w"  title="Comment" class="ripple" onClick="commentall(this.id)" id="<?php echo $row['art_post_id']; ?>">
                                                                <i class="fa fa-comment-o" aria-hidden="true">
                                                                    <?php
//                                                                    if (count($commnetcount) > 0) {
//                                                                        echo count($commnetcount);
//                                                                    }
                                                                    ?>
                                                                </i>  
                                                            </a>
                                                        </li>

                                                    </ul>
                                                     <ul class="col-md-6 like_cmnt_count">

                                                              <li>
                                                                <div class="like_cmmt_space comnt_count_ext_a like_count_ext<?php echo $row['art_post_id']; ?>">
                                                                    <span class="comment_count" > 
                                                                        <?php
                                                                        if (count($commnetcount) > 0) {
                                                                            echo count($commnetcount); ?>
                                                                             
                                                                        </span> 
                                                                    <span> Comment</span>
                                                                                <?php }
                                                                        ?> 
                                                                </div>
                                                            </li>

                                                            <li>
                                                                <div class="comnt_count_ext_a    <?php echo 'comnt_count_ext' . $row['art_post_id']; ?>">
                                                                    <span class="comment_like_count"> 
                                                                       <?php
                                                                        if ($row['art_likes_count'] > 0) { 
                                                                            echo $row['art_likes_count']; ?>
                                                                   </span> 
                                                                    <span> Like</span>
                                                                <?php   }
                                                                        ?> 
                                                                   
                                                                </div>
                                                            </li>
                                        </ul>
                                                    <!-- like comment div end -->
                                                </div>
                                            </div>

                                            <!-- like user list start -->
                                              <!-- pop up box start-->
                                                                                       <?php
                                           // if ($row['art_likes_count'] > 0) {
                                                ?>
                                                <!--<div class="likeduserlist<?php echo $row['art_post_id'] ?>">-->
                                            <div class="likeduserlist1 <?php echo "likeusername" . $row['art_post_id']; ?>" id="<?php echo "likeusername" . $row['art_post_id']; ?>" style="display:block">
                                                    <?php
                                                    $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                    $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                    $likeuser = $commnetcount[0]['art_like_user'];
                                                    $countlike = $commnetcount[0]['art_likes_count'] - 1;
                                                    $likelistarray = explode(',', $likeuser);
                                                    foreach ($likelistarray as $key => $value) {
                                                        $art_fname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_name;
                                                        $art_lname1 = $this->db->get_where('art_reg', array('user_id' => $value, 'status' => 1))->row()->art_lastname;
                                                    }
                                                    ?>
                                                   
                                                        <?php
                                                        $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1', 'is_delete' => '0');
                                                        $commnetcount = $this->common->select_data_by_condition('art_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        $likeuser = $commnetcount[0]['art_like_user'];
                                                        $countlike = $commnetcount[0]['art_likes_count'] - 1;
                                                        $likelistarray = explode(',', $likeuser);
                                                        $likelistarray = array_reverse($likelistarray);
                                                        $art_fname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_name;
                                                        $art_lname = $this->db->get_where('art_reg', array('user_id' => $likelistarray[0], 'status' => 1))->row()->art_lastname;
                                                        ?>
                                                        <div class="like_one_other">
                                                         <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['art_post_id']; ?>);">
                                                            <?php
                                                            if ($userid == $likelistarray[0]) {
                                                                echo "You";
                                                            } else {
                                                                echo ucfirst(strtolower($art_fname));
                                                                echo "&nbsp; ";
                                                                echo ucfirst(strtolower($art_lname));
                                                                echo "&nbsp;";
                                                            }
                                                            ?>
                                                            <?php
                                                            if (count($likelistarray) > 1) {
                                                                ?>
                                                                <?php echo "and"; ?>
                                                                <?php
                                                                echo $countlike;
                                                                echo "&nbsp;";
                                                                echo "others";
                                                                ?> 
                <?php } ?>
                </a>
                                                        </div>
                                                  
                                                </div>
                                                <?php
                                         //   }
                                            ?>


                                                                <?php
//                                        $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
//                                        $artdatacondition = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '', $offset = '', $join_str = array(), $groupby = '');
//                                        if ($artdatacondition) {
                                            ?>
                                            <div class="art-all-comment col-md-12">
                                                <div id="<?php echo "fourcomment" . $row['art_post_id']; ?>" style="display:none">
                                                </div>
                                                <!-- 3 comment start -->
                                                <!-- khyati changes start -->
                                                <div  id="<?php echo "threecomment" . $row['art_post_id']; ?>" style="display:block">
                                                    <div class="<?php echo 'insertcomment' . $row['art_post_id']; ?>">
                                                        <?php
                                                        $contition_array = array('art_post_id' => $row['art_post_id'], 'status' => '1');
                                                        $artdata = $this->data['artdata'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = 'artistic_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');
                                                        if ($artdata) {
                                                            foreach ($artdata as $rowdata) {
                                                                $artname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_name;

                                                                $artlastname = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id']))->row()->art_lastname;
                                                                ?>
                             <div class="all-comment-comment-box">
                                <div class="post-design-pro-comment-img"> 
                    <?php $art_userimage = $this->db->get_where('art_reg', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->art_user_image; ?>
                    <?php if ($art_userimage) { ?>
                            <a href="<?php echo base_url('artistic/art_manage_post/' . $rowdata['user_id'] . ''); ?>">

 <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $art_userimage)) {
                                                                $a = $artname;
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artlastname;
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>


                                     <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>"  alt="">

                                     <?php }?>
                                            </a>
                                                <?php
                                            } else {
                                          ?>
                                <a href="<?php echo base_url('artistic/art_manage_post/' . $rowdata['user_id'] . ''); ?>">
      

                                         <?php 
                          $a = $artname;
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artlastname;
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                                             </a>
                                            <?php
                                        }
                                      ?>
                                     </div>
                                     <div class="comment-name">
                                     <b><?php
                                            echo ucfirst(strtolower($artname));
                                             echo "&nbsp;";
                                              echo ucfirst(strtolower($artlastname));
                                              ?></b><?php echo '</br>'; ?>
                                    </div>

                                <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['artistic_post_comment_id']; ?>">

                                <div id="<?php echo "lessmore" . $rowdata['artistic_post_comment_id']; ?>" style="display:block;">
                                <?php
                     $small = substr($rowdata['comments'], 0, 180);
                     echo $this->common->make_links($small);

                     if (strlen($rowdata['comments']) > 180) {
                          echo '... <span id="kkkk" onClick="seemorediv(' . $rowdata['artistic_post_comment_id'] . ')">See More</span>';
                        }?>
                        </div>
                   
                    <div id="<?php echo "seemore" . $rowdata['artistic_post_comment_id']; ?>" style="display:none;">
                      <?php
                      echo $this->common->make_links($rowdata['comments']);
                   ?>

               </div>

               </div>

                                <div class="edit-comment-box">
                                    <div class="inputtype-edit-comment">

                         <div contenteditable="true" style="display:none; min-height:37px !important; margin-top: 0px!important; margin-left: 1.5% !important; width: 78%;" class="editable_text" name="<?php echo $rowdata['artistic_post_comment_id']; ?>"  id="<?php echo "editcomment" . $rowdata['artistic_post_comment_id']; ?>" placeholder="Add a Comment ..." value= ""  onkeyup="commentedit(<?php echo $rowdata['artistic_post_comment_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $rowdata['comments']; ?></div>
                            <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $rowdata['artistic_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['artistic_post_comment_id']; ?>)">Save</button></span>
                                                                        </div>
                                                                    </div>

                            <div class="art-comment-menu-design"> 
                            <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['artistic_post_comment_id']; ?>">
                             <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_like1(this.id)">

                                     <?php
                                             $userid = $this->session->userdata('aileenuser');
                                     $contition_array = array('artistic_post_comment_id' => $rowdata['artistic_post_comment_id'], 'status' => '1');
                                            $artcommentlike = $this->data['artcommentlike'] = $this->common->select_data_by_condition('artistic_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                 $likeuserarray = explode(',', $artcommentlike[0]['artistic_comment_like_user']);

                                     if (!in_array($userid, $likeuserarray)) {
                                         ?>
                                     <i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i> 
                              <?php } else {
                                  ?>
                                <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>
                                     <?php }
                                                 ?>
                        <span>
                            <?php
                        if ($rowdata['artistic_comment_likes_count'] > 0) {
                             echo $rowdata['artistic_comment_likes_count'];
                                     }
                        ?>
                        </span>
                        </a>
                       </div>
                     <?php
                     $userid = $this->session->userdata('aileenuser');

                     if ($rowdata['user_id'] == $userid) {
                    ?> 

                        <span role="presentation" aria-hidden="true"> · </span>
                        <div class="comment-details-menu">

                        <div id="<?php echo 'editcommentbox' . $rowdata['artistic_post_comment_id']; ?>" style="display:block;">
                            <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editbox(this.id)" class="editbox">Edit
                                 </a>
                 </div>

                    <div id="<?php echo 'editcancle' . $rowdata['artistic_post_comment_id']; ?>" style="display:none;">
                        <a id="<?php echo $rowdata['artistic_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                        </a>
                                 </div>

                             </div>
                        <?php } ?>

                            <?php
                            $userid = $this->session->userdata('aileenuser');

                        $art_userid = $this->db->get_where('art_post', array('art_post_id' => $rowdata['art_post_id'], 'status' => 1))->row()->user_id;


                        if ($rowdata['user_id'] == $userid || $art_userid == $userid) {
                                                                            ?> 
                         <span role="presentation" aria-hidden="true"> · </span>
               <div class="comment-details-menu">
<input type="hidden" name="post_delete"  id="post_delete<?php echo $rowdata['artistic_post_comment_id']; ?>" value= "<?php echo $rowdata['art_post_id']; ?>">
<a id="<?php echo $rowdata['artistic_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete
<span class="<?php echo 'insertcomment' . $rowdata['artistic_post_comment_id']; ?>"></span>
                                                                                </a>
                                                                            </div>
                    <?php } ?>

                         <span role="presentation" aria-hidden="true"> · </span>

                        <div class="comment-details-menu">
                        <p> <?php
                         echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                 echo '</br>';
                         ?>
                        </p></div></div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div> </div>
                                                <!-- khyati changes end -->
                                                <!-- all comments code end -->

                                            </div>
        <?php //} else { ?>

<!--            <div id="<?php echo "fourcomment" . $row['art_post_id']; ?>" style="display:none">
                                            </div>

                                            <div  id="<?php echo "threecomment" . $row['art_post_id']; ?>" style="display:block">

                                                <div class="<?php echo 'insertcomment' . $row['art_post_id']; ?>">
                                                </div>
                                            </div>-->
        <?php //} ?>

                                            <div class="post-design-commnet-box col-md-12">
                                            <div class="post-design-proo-img  hidden-mob">
                                                <?php
                                                $userid = $this->session->userdata('aileenuser');
                                                $art_userimage = $this->db->get_where('art_reg', array('user_id' => $userid, 'status' => 1))->row()->art_user_image;
                                                ?>
                                                <?php
                                                if ($art_userimage) {
                                                    ?>

                                                     <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $art_userimage)) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                                                    <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $art_userimage); ?>" name="image_src" id="image_src" />

                                                    <?php }?>
                                                    <?php
                                                } else {
                                                    ?>


                                                    <?php 
                          $a = $artisticdata[0]['art_name'];
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artisticdata[0]['art_lastname'];
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       


                                                    <?php
                                                }
                                                ?>
                                            </div>
                                           
                                                <div id="content" class="col-md-12 inputtype-comment cmy_2">
                                                    <div contenteditable="true" class="editable_text" type="text" name="<?php echo $row['art_post_id']; ?>"  id="<?php echo "post_comment" . $row['art_post_id']; ?>" placeholder="Add a Comment ..." value= "" onClick="entercomment(<?php echo $row['art_post_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>

                                                      <div class="mob-comment">
                            <button  id="<?php echo $row['art_post_id']; ?>" onClick="insert_comment(this.id)"><img src="<?php echo base_url('img/send.png') ?>"></button> 
                            
                           </div>
                                                </div>    
        <?php echo form_error('post_comment'); ?>

                                              <div class=" comment-edit-butn hidden-mob" >  
                                                    <button  id="<?php echo $row['art_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button> 
                                                </div>
                                            

                                        </div>
                     
                </div>
             </div>

                            <?php } }


                            else {
                            ?>
                        <div class="art_no_post_avl" id="no_post_avl">
         <h3> Post</h3>
          <div class="art-img-nn">
         <div class="art_no_post_img">

           <img src="<?php echo base_url('img/art-no.png')?>">
        
         </div>
         <div class="art_no_post_text">
           No Post Available.
         </div>
          </div>
       </div>

<?php } ?>

<!-- for no post found msg show using ajax start -->
    <div class="nofoundpost">
    </div>

<!-- for no post found msg show using ajax end -->

             </div>
             </div>
            </div>
            
        </div>
    </div>
</div>
    
</div>
            </section>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <!-- footer start -->
        
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
<?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="5">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" />
                                </div>
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
<?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->


        <!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal-limit" role="dialog">
                        <div class="modal-dialog modal-lm deactive">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal" id="common-limit">&times;</button>       
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->

        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="profileimage" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal" id="profileimage">&times;</button>       
                    <div class="modal-body">

                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>


         <div class="modal fade message-box" id="postedit" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="postedit"data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Model Popup Close -->
        <!-- Bid-modal-2  -->
        <div class="modal fade message-box" id="likeusermodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->


        <!-- Bid-modal for this modal appear or not start -->
            <div class="modal fade message-box" id="post" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="post" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bid-modal for this modal appear or not  Popup Close -->

             <!-- Bid-modal for this modal appear or not start -->
            <div class="modal fade message-box" id="image" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="image" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bid-modal for this modal appear or not  Popup Close -->
       
<footer>
<?php echo $footer; ?>
</footer>

<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
<script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
var complex = <?php echo json_encode($selectdata); ?>;
var textarea = document.getElementById("textarea");

var slug = '<?php echo $artid; ?>';
</script>

<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/dashboard.js'); ?>"></script>

 </body>
</html>


