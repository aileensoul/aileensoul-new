<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gyc.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>" />
        <link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>" />
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <?php echo $business_common; ?>
            <div class="text-center tab-block">
                <div class="container mob-inner-page">
                    <a href="<?php echo base_url('business-profile/photos/' . $businessdata1[0]['business_slug']) ?>">
                        Photo
                    </a>
                    <a href="<?php echo base_url('business-profile/videos/' . $businessdata1[0]['business_slug']) ?>">
                        Video
                    </a>
                    <a href="<?php echo base_url('business-profile/audios/' . $businessdata1[0]['business_slug']) ?>">
                        Audio
                    </a>
                    <a href="<?php echo base_url('business-profile/pdf/' . $businessdata1[0]['business_slug']) ?>">
                        PDf
                    </a>
                </div>
            </div>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                    </div>
                </div>
            </div>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 profile-box-custom">
                            <div class="full-box-module business_data">
                                <div class="profile-boxProfileCard  module">
                                    <div class="head_details1">
                                        <span><a href="<?php echo base_url('business-profile/details/' . $businessdata1[0]['business_slug']); ?>"><h5><i class="fa fa-info-circle" aria-hidden="true"></i>Information</h5></a>
                                        </span>      
                                    </div>
                                    <table class="business_data_table">
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-user"></i></td>
                                            <td class="business_data_td2"><?php echo ucwords($businessdata1[0]['contact_person']); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-mobile"></i></td>
                                            <td class="business_data_td2"><span><?php
                                                    if ($businessdata1[0]['contact_mobile'] != '0') {
                                                        echo $businessdata1[0]['contact_mobile'];
                                                    } else {
                                                        echo '-';
                                                    }
                                                    ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1"><i class="fa fa-envelope-o" aria-hidden="true"></i></td>
                                            <td class="business_data_td2"><span><?php echo $businessdata1[0]['contact_email']; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-map-marker"></i></td>
                                            <td class="business_data_td2"><span>
                                                    <?php
                                                    if ($businessdata1[0]['address']) {
                                                        echo $businessdata1[0]['address'];
                                                        echo ",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($businessdata1[0]['city']) {
                                                        echo $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name;
                                                        echo",";
                                                    }
                                                    ?> 
                                                    <?php
                                                    if ($businessdata1[0]['country']) {
                                                        echo $this->db->get_where('countries', array('country_id' => $businessdata1[0]['country']))->row()->country_name;
                                                    }
                                                    ?> 
                                                </span></td>
                                        </tr>
                                        <?php
                                        if ($businessdata1[0]['contact_website']) {
                                            ?>
                                            <tr>
                                                <td class="business_data_td1"><i class="fa fa-globe"></i></td>
                                                <td class="business_data_td2 website"><span><a target="_blank" href="<?php echo $businessdata1[0]['contact_website']; ?>"> <?php echo $businessdata1[0]['contact_website']; ?></a></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td class="business_data_td1 detaile_map"><i class="fa fa-suitcase"></i></td>
                                            <td class="business_data_td2"><span><?php echo $this->common->make_links($businessdata1[0]['details']); ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- user iamges start-->
                            <a href="<?php echo base_url('business-profile/photos/' . $businessdata1[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module buisness_he_module" >
                                        <div class="head_details">
                                            <h5><i class="fa fa-camera" aria-hidden="true"></i>   Photos</h5>
                                        </div>
                                        <div class="bus_photos">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- user images end-->
                            <!-- user video start-->
                            <a href="<?php echo base_url('business-profile/videos/' . $businessdata1[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module">
                                        <table class="business_data_table">
                                            <div class="head_details">
                                                <h5><i class="fa fa-video-camera" aria-hidden="true"></i>Video</h5>
                                            </div>
                                            <div class="bus_videos">
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- user video emd-->
                            <!-- user audio start-->
                            <a href="<?php echo base_url('business-profile/audios/' . $businessdata1[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module">
                                        <div class="head_details1">
                                            <h5><i class="fa fa-music" aria-hidden="true"></i>Audio</h5>
                                        </div>
                                        <table class="business_data_table">
                                            <div class="bus_audios"> 
                                            </div>
                                        </table>
                                    </div>
                                </div>
                            </a>
                            <!-- user audio end-->
                            <!-- user pdf  start-->
                            <a href="<?php echo base_url('business-profile/pdf/' . $businessdata1[0]['business_slug']) ?>">
                                <div class="full-box-module business_data">
                                    <div class="profile-boxProfileCard  module buisness_he_module" >
                                        <div class="head_details">
                                            <h5><i class="fa fa-file-pdf-o" aria-hidden="true"></i>  PDF</h5>
                                        </div>      
                                        <div class="bus_pdf"></div>
                                    </div>
                                </div>
                            </a>
                            <!-- user pdf  end-->
                        </div>
                        <div class="col-md-7 custom-right-business">
                            <?php
                            $userid = $this->session->userdata('aileenuser');
                            $other_user = $businessdata1[0]['business_profile_id'];
                            $other_user_id = $businessdata1[0]['user_id'];

                            $contition_array = array('user_id' => $userid, 'is_deleted' => '0', 'status' => '1');
                            $userdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                            $loginuser = $userdata[0]['business_profile_id'];
                            $contition_array = array('follow_type' => 2, 'follow_status' => 1);
                            $search_condition = "((follow_from  = '$loginuser' AND follow_to  = ' $other_user') OR (follow_from  = '$other_user' AND follow_to  = '$loginuser'))";
                            $followperson = $this->common->select_data_by_search('follow', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

                            $contition_array = array('contact_type' => 2);
                            $search_condition = "((contact_from_id  = '$userid' AND contact_to_id = ' $other_user_id') OR (contact_from_id  = '$other_user_id' AND contact_to_id = '$userid'))";
                            $contactperson = $this->common->select_data_by_search('contact_person', $search_condition, $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = '', $groupby = '');

                            if ((count($followperson) == 2) || ($businessdata1[0]['user_id'] == $userid) || (count($contactperson) == 1)) {
                                ?>
                                <div class="post-editor col-md-12">
                                    <div class="main-text-area col-md-12">
                                        <div class="popup-img"> 
                                            <?php if ($businessdata[0]['business_user_image']) { ?><img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                            <?php } else { ?>
                                                <img alt=""  src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                            <?php } ?>
                                        </div>
                                        <div id="myBtn1"  class="editor-content popup-text">
                                            <span>Post Your Product....</span>
                                            <div class="padding-left padding_les_left camer_h">
                                                <i class=" fa fa-camera">
                                                </i> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- The Modal -->
                            <div id="myModal3" class="modal-post">
                                <!-- Modal content -->
                                <div class="modal-content-post">
                                    <span class="close3">&times;</span>
                                    <div class="post-editor post-edit-popup" id="close">
                                        <?php echo form_open_multipart(base_url('business-profile/bussiness-profile-post-add/' . 'manage/' . $businessdata1[0]['user_id']), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "imgval(event)")); ?>
                                        <div class="main-text-area col-md-12"  >
                                            <div class="popup-img-in"> 
                                                <?php
                                                if ($businessdata[0]['business_user_image'] != '') {
                                                    ?>
                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $businessdata[0]['business_user_image']); ?>"  alt="">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img  src="<?php echo base_url(NOIMAGE); ?>"  alt="">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div id="myBtn1"  class="editor-content col-md-10 popup-text" >
                                                <textarea id= "test-upload_product" placeholder="Post Your Product...."  onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); 
                                                          name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;" tabindex="1"></textarea>
                                                <div class="fifty_val">                   
                                                    <input size=1 value=50 name=text_num class="text_num" readonly> 
                                                </div>
                                                <div class="padding-left camera_in camer_h" ><i class=" fa fa-camera " ></i> </div>
                                            </div>
                                        </div>
                                        <div class="row"></div>
                                        <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                                            <textarea id="test-upload_des" name="product_desc" class="description" placeholder="Enter Description" tabindex="2"></textarea>
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
                                                <li>
                                                    <div class="col-md-12"> <div class="form-group">
                                                            <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                                                        </div></div>
                                                    <label for="file-1">
                                                        <i class=" fa fa-camera upload_icon"  > Photo</i>
                                                        <i class=" fa fa-video-camera upload_icon"> Video </i> 
                                                        <i class="fa fa-music upload_icon"> Audio </i>
                                                        <i class=" fa fa-file-pdf-o upload_icon"> PDF </i>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="fr margin_btm">
                                            <button type="submit"  value="Submit">Post</button>    
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- popup end -->
                            <?php
                            if ($this->session->flashdata('error')) {
                                echo $this->session->flashdata('error');
                            }
                            ?>
                            <div class="fw">
                                <div class='progress' id="progress_div" style="display: none">
                                    <div class='bar' id='bar'></div>
                                    <div class='percent' id='percent'>0%</div>
                                </div>
                                <div class="business-all-post">
                                    <div class="nofoundpost"> 
                                    </div>
                                </div>
                                <!-- middle section start -->
                                <?php
                                if (count($business_profile_data) > 0) {
                                    foreach ($business_profile_data as $row) {
                                        $contition_array = array('user_id' => $row['user_id'], 'status' => '1');
                                        $businessdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                        ?>
                                        <div id="<?php echo "removeownpost" . $row['business_profile_post_id']; ?>">
                                            <div class="">
                                                <div class="post-design-box">
                                                    <div class="post-design-top col-md-12" >  
                                                        <div class="post-design-pro-img"> 
                                                            <?php
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $userimage = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->business_user_image;
                                                            $userimageposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->business_user_image;
                                                            ?>
                                                            <?php if ($row['posted_user_id']) { ?>
                                                                <?php if ($userimageposted) { ?>
                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userimageposted); ?>" name="image_src" id="image_src" />
                                                                <?php } else { ?>
                                                                    <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <?php if ($userimage) { ?>
                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $userimage); ?>" name="image_src" id="image_src" />
                                                                <?php } else { ?>
                                                                    <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="post-design-name fl col-xs-8 col-md-10">
                                                            <ul>
                                                                <?php
                                                                $companyname = $this->db->get_where('business_profile', array('user_id' => $row['user_id']))->row()->company_name;
                                                                $slugname = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->business_slug;
                                                                $categoryid = $this->db->get_where('business_profile', array('user_id' => $row['user_id'], 'status' => 1))->row()->industriyal;
                                                                $category = $this->db->get_where('industry_type', array('industry_id' => $categoryid, 'status' => 1))->row()->industry_name;
                                                                $companynameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id']))->row()->company_name;
                                                                $slugnameposted = $this->db->get_where('business_profile', array('user_id' => $row['posted_user_id'], 'status' => 1))->row()->business_slug;
                                                                ?>
                                                                <?php if ($row['posted_user_id']) { ?>
                                                                    <li>
                                                                        <div class="else_post_d">
                                                                            <div class="post-design-product">
                                                                                <a style="max-width: 40%;" class="post_dot" title="<?php echo ucwords($companynameposted); ?>" href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugnameposted); ?>"><?php echo ucwords($companynameposted); ?></a>
                                                                                <p class="posted_with" > Posted With</p>
                                                                                <a class="other_name post_dot" href="<?php echo base_url('business-profile/details/' . $slugname); ?>"><?php echo ucwords($companyname); ?></a>
                                                                                <span role="presentation" aria-hidden="true"> · </span> <span class="ctre_date"><?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?> </span> 
                                                                            </div></div>
                                                                    </li>
                                                                <?php } else { ?>
                                                                    <li><div class="post-design-product"><a class="post_dot" title="<?php echo ucwords($companyname); ?> " href="<?php echo base_url('business_profile/business_profile_manage_post/' . $slugname); ?>"><?php echo ucwords($companyname); ?> </a>
                                                                            <span role="presentation" aria-hidden="true"> · </span>
                                                                            <div class="datespan"> 
                                                                                <span class="ctre_date"><?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($row['created_date']))); ?></span> 
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                <li><div class="post-design-product">   <a class="buuis_desc_a"  title="Category" > 
                                                                            <?php
                                                                            if ($category) {
                                                                                echo ucwords($category);
                                                                            } else {
                                                                                echo ucwords($businessdata[0]['other_industrial']);
                                                                            }
                                                                            ?>
                                                                        </a> </div>
                                                                </li>
                                                                <li>
                                                                </li> 
                                                            </ul> 
                                                        </div>  
                                                        <div class="dropdown2">
                                                            <a onClick="myFunction1(<?php echo $row['business_profile_post_id']; ?>)" class="dropbtn2 dropbtn2 fa fa-ellipsis-v"></a>
                                                            <div id="<?php echo "myDropdown" . $row['business_profile_post_id']; ?>" class="dropdown-content2">
                                                                <?php
                                                                if ($row['posted_user_id'] != 0) {
                                                                    if ($this->session->userdata('aileenuser') == $row['posted_user_id']) {
                                                                        ?>
                                                                        <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)">
                                                                            <i class="fa fa-trash-o" aria-hidden="true">
                                                                            </i> Delete Post
                                                                        </a>
                                                                        <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)">
                                                                            <i class="fa fa-pencil-square-o" aria-hidden="true">
                                                                            </i>Edit
                                                                        </a>
                                                                    <?php } else {
                                                                        ?>
                                                                        <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)">
                                                                            <i class="fa fa-trash-o" aria-hidden="true">
                                                                            </i> Delete Post
                                                                        </a>
                                                                        <a href="<?php echo base_url('business-profile/business-profile-contactperson/' . $row['posted_user_id'] . ''); ?>">
                                                                            <i class="fa fa-user" aria-hidden="true">
                                                                            </i> Contact Person
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <?php if ($this->session->userdata('aileenuser') == $row['user_id']) { ?> 
                                                                        <a onclick="user_postdelete(<?php echo $row['business_profile_post_id']; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Post</a>
                                                                        <a id="<?php echo $row['business_profile_post_id']; ?>" onClick="editpost(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                                                                    <?php } else { ?>
                                                                        <a href="<?php echo base_url('business-profile/business-profile-contactperson/' . $row['user_id'] . ''); ?>"><i class="fa fa-user" aria-hidden="true"></i> Contact Person</a>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <?php if ($row['product_name'] || $row['product_description']) { ?>
                                                            <div class="post-design-desc ">
                                                            <?php } ?>                          
                                                            <div class="ft-15 t_artd">
                                                                <div id="<?php echo 'editpostdata' . $row['business_profile_post_id']; ?>" style="display:block;">
                                                                    <a  ><?php echo $this->common->make_links($row['product_name']); ?></a>
                                                                </div>
                                                                <div id="<?php echo 'editpostbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                    <input type="text" id="<?php echo 'editpostname' . $row['business_profile_post_id']; ?>" name="editpostname" placeholder="Product Name" value="<?php echo $row['product_name']; ?>" onKeyDown=check_lengthedit(<?php echo $row['business_profile_post_id']; ?>); onKeyup=check_lengthedit(<?php echo $row['business_profile_post_id']; ?>); onblur=check_lengthedit(<?php echo $row['business_profile_post_id']; ?>);>

                                                                    <?php
                                                                    if ($row['product_name']) {
                                                                        $counter = $row['product_name'];
                                                                        $a = strlen($counter);
                                                                        ?>

                                                                        <input size=1 id="text_num" class="text_num" value="<?php echo (50 - $a); ?>" name=text_num readonly>

                                                                    <?php } else { ?>
                                                                        <input size=1 id="text_num" class="text_num" value=50 name=text_num readonly> 

                                                                    <?php } ?>

                                                                </div>
                                                            </div>
                                                            <div id="<?php echo "khyati" . $row['business_profile_post_id']; ?>" style="display:block;">
                                                                <?php
                                                                $small = substr($row['product_description'], 0, 180);
                                                                echo $this->common->make_links($small);
                                                                if (strlen($row['product_description']) > 180) {
                                                                    echo '... <span id="kkkk" onClick="khdiv(' . $row['business_profile_post_id'] . ')">View More</span>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div id="<?php echo "khyatii" . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                <?php
                                                                echo $row['product_description'];
                                                                ?>
                                                            </div>
                                                            <div id="<?php echo 'editpostdetailbox' . $row['business_profile_post_id']; ?>" style="display:none;">
                                                                <div  contenteditable="true" id="<?php echo 'editpostdesc' . $row['business_profile_post_id']; ?>" placeholder="Product Description" class="textbuis  editable_text" placeholder="Description of Your Product"  name="editpostdesc" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $row['product_description']; ?></div>
                                                            </div>
                                                            <button class="fr" id="<?php echo "editpostsubmit" . $row['business_profile_post_id']; ?>" style="display:none;margin: 5px 0;" onClick="edit_postinsert(<?php echo $row['business_profile_post_id']; ?>)">Save</button>
                                                        </div> 
                                                        <?php if ($row['product_name'] || $row['product_description']) { ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="post-design-mid col-md-12" >  
                                                        <!-- multiple image code  start-->
                                                        <div class="mange_post_image">
                                                            <?php
                                                            $contition_array = array('post_id' => $row['business_profile_post_id'], 'is_deleted' => '1', 'image_type' => '2');
                                                            $businessmultiimage = $this->data['businessmultiimage'] = $this->common->select_data_by_condition('post_image', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            ?>
                                                            <?php if (count($businessmultiimage) == 1) { ?>
                                                                <?php
                                                                $allowed = array('jpg', 'jpeg', 'PNG', 'gif', 'png', 'psd', 'bmp', 'tiff', 'iff', 'xbm', 'webp');
                                                                $allowespdf = array('pdf');
                                                                $allowesvideo = array('mp4', 'webm');
                                                                $allowesaudio = array('mp3');
                                                                $filename = $businessmultiimage[0]['image_name'];
                                                                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                                                if (in_array($ext, $allowed)) {
                                                                    ?>
                                                                    <!-- one image start -->
                                                                    <div class="one-image">
                                                                        <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[0]['image_name']) ?>"> </a>
                                                                    </div>
                                                                    <!-- one image end -->
                                                                <?php } elseif (in_array($ext, $allowespdf)) { ?>
                                                                    <!-- one pdf start -->
                                                                    <div>
                                                                        <a href="<?php echo base_url('business-profile/creat-pdf/' . $businessmultiimage[0]['image_id']) ?>"><div class="pdf_img">
                                                                                <img src="<?php echo base_url('images/PDF.jpg') ?>" style="height: 100%; width: 100%;">
                                                                            </div></a>
                                                                    </div>
                                                                    <!-- one pdf end -->
                                                                <?php } elseif (in_array($ext, $allowesvideo)) { ?>
                                                                    <!-- one video start -->
                                                                    <div>
                                                                        <video class="video" width="100%" height="350" controls>
                                                                            <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) ?>" type="video/mp4">
                                                                            <source src="movie.ogg" type="video/ogg">
                                                                            Your browser does not support the video tag.
                                                                        </video>
                                                                    </div>
                                                                    <!-- one video end -->
                                                                <?php } elseif (in_array($ext, $allowesaudio)) { ?>
                                                                    <!-- one audio start -->
                                                                    <div class="audio_main_div">
                                                                        <div class="audio_img">
                                                                            <img src="<?php echo base_url('images/music-icon.png') ?> ">  
                                                                        </div>
                                                                        <div class="audio_source">
                                                                            <audio  controls>
                                                                                <source src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) ?>" type="audio/mp3">
                                                                                <source src="movie.ogg" type="audio/ogg">
                                                                                Your browser does not support the audio tag.
                                                                            </audio>
                                                                        </div>
                                                                        <div class="audio_mp3" id="<?php echo "postname" . $row['business_profile_post_id']; ?>">
                                                                            <p title="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></p>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- one audio end -->
                                                                <?php } ?>
                                                            <?php } elseif (count($businessmultiimage) == 2) { ?>
                                                                <?php
                                                                foreach ($businessmultiimage as $multiimage) {
                                                                    ?>
                                                                    <!-- two image start -->
                                                                    <div  class="two-images" >
                                                                        <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img class="two-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> </a>
                                                                    </div>
                                                                    <!-- two image end -->
                                                                <?php } ?>
                                                            <?php } elseif (count($businessmultiimage) == 3) { ?>
                                                                <!-- three image start -->
                                                                <div class="three-imag-top" >
                                                                    <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_main_upload_path') . $businessmultiimage[0]['image_name']) ?>" style="width: 100%; height:100%; "> </a>
                                                                </div>
                                                                <div class="three-image" >
                                                                    <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[1]['image_name']) ?>" style="width: 100%; height:100%; "> </a>
                                                                </div>
                                                                <div class="three-image" >
                                                                    <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img class="three-columns" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[2]['image_name']) ?>" style="width: 100%; height:100%; "> </a>
                                                                </div>
                                                                <!-- three image end -->
                                                            <?php } elseif (count($businessmultiimage) == 4) { ?>
                                                                <?php
                                                                foreach ($businessmultiimage as $multiimage) {
                                                                    ?>
                                                                    <!-- four image start -->
                                                                    <div class="four-image">
                                                                        <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img class="breakpoint" src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" style="width: 100%; height: 100%;"> </a>
                                                                    </div>
                                                                    <!-- four image end -->
                                                                <?php } ?>
                                                            <?php } elseif (count($businessmultiimage) > 4) { ?>
                                                                <?php
                                                                $i = 0;
                                                                foreach ($businessmultiimage as $multiimage) {
                                                                    ?>
                                                                    <!-- five image start -->
                                                                    <div class="four-image">
                                                                        <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $multiimage['image_name']) ?>" > </a>
                                                                    </div>
                                                                    <!-- five image end -->
                                                                    <?php
                                                                    $i++;
                                                                    if ($i == 3)
                                                                        break;
                                                                }
                                                                ?>
                                                                <!-- this div view all image start -->

                                                                <div class="four-image">
                                                                    <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>"><img src="<?php echo base_url($this->config->item('bus_post_thumb_upload_path') . $businessmultiimage[3]['image_name']) ?>" style=" width: 100%; height: 100%;"> </a>
                                                                    <a href="<?php echo base_url('business-profile/post-detail/' . $row['business_profile_post_id']) ?>">
                                                                        <div class="more-image" >
                                                                            <span> View All (+<?php echo (count($businessmultiimage) - 4); ?>)
                                                                            </span></div>
                                                                    </a>
                                                                </div>
                                                                <!-- this div view all image end -->
                                                            <?php } ?>
                                                            <div>
                                                            </div>
                                                        </div>
                                                        <!-- multiple image code  end-->
                                                    </div>
                                                    <div class="post-design-like-box col-md-12">
                                                        <div class="post-design-menu">
                                                            <ul class="col-md-6">
                                                                <li class="<?php echo 'likepost' . $row['business_profile_post_id']; ?>">
                                                                    <a class="ripple like_h_w" id="<?php echo $row['business_profile_post_id']; ?>"   onClick="post_like(this.id)">
                                                                        <?php
                                                                        $userid = $this->session->userdata('aileenuser');
                                                                        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');
                                                                        $active = $this->data['active'] = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                        $likeuser = $this->data['active'][0]['business_like_user'];
                                                                        $likeuserarray = explode(',', $active[0]['business_like_user']);

                                                                        if (!in_array($userid, $likeuserarray)) {
                                                                            ?>               

                                                                                                                                                                                                                                                                                                                                                                            <!--<i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>-->
                                                                            <i class="fa fa-thumbs-up" style="color: #999;" aria-hidden="true"></i>

                                                                        <?php } else { ?> 
                                                                                                                                                                                                                                                                                                                                                                            <!--<i class="fa fa-thumbs-up" aria-hidden="true"></i>-->
                                                                            <i class="fa fa-thumbs-up main_color fa-1x" aria-hidden="true"></i>
                                                                        <?php } ?>

                                                                        <span class="like_As_count">
                                                                            <?php
                                                                            if ($row['business_likes_count'] > 0) {
                                                                                echo $row['business_likes_count'];
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li id="<?php echo "insertcount" . $row['business_profile_post_id']; ?>" style="visibility:show">
                                                                    <?php
                                                                    $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                    $commnetcount = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                    ?>

                                                                    <a class="ripple like_h_w" onClick="commentall(this.id)" id="<?php echo $row['business_profile_post_id']; ?>"><i class="fa fa-comment-o" aria-hidden="true"> 
                                                                            <?php
                                                                            /* if (count($commnetcount) > 0) {
                                                                              echo count($commnetcount);
                                                                              } */
                                                                            ?>
                                                                        </i> 
                                                                    </a>
                                                                </li> 
                                                            </ul>
                                                            <ul class="col-md-6 like_cmnt_count">

                                                                <li>
                                                                    <div class="like_count_ext">
                                                                        <span class="comment_count<?php echo $row['business_profile_post_id']; ?>" > 

                                                                            <?php
                                                                            if (count($commnetcount) > 0) {
                                                                                echo count($commnetcount);
                                                                                ?>
                                                                                <span> Comment</span>
                                                                            <?php }
                                                                            ?> 
                                                                        </span> 

                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="comnt_count_ext">
                                                                        <span class="comment_like_count<?php echo $row['business_profile_post_id']; ?>"> 
                                                                            <?php
                                                                            if ($row['business_likes_count'] > 0) {
                                                                                echo $row['business_likes_count'];
                                                                                ?>
                                                                                <span> Like</span>
                                                                            <?php } ?>
                                                                        </span> 

                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- like user list start -->

                                                    <!-- pop up box start-->
                                                    <?php
                                                    if ($row['business_likes_count'] > 0) {
                                                        ?>
                                                        <div class="likeduserlist1 likeduserlist<?php echo $row['business_profile_post_id'] ?>">
                                                            <?php
                                                            $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                            $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                            $likeuser = $commnetcount[0]['business_like_user'];
                                                            $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                            $likelistarray = explode(',', $likeuser);
                                                            foreach ($likelistarray as $key => $value) {
                                                                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                            }
                                                            ?>
                                                            <!-- pop up box end-->
                                                            <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['business_profile_post_id']; ?>);">
                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                                $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                                $likeuser = $commnetcount[0]['business_like_user'];
                                                                $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                                $likelistarray = explode(',', $likeuser);

                                                                $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                                ?>
                                                                <div class="like_one_other">
                                                                    <?php
                                                                    if ($userid == $value) {
                                                                        echo "You";
                                                                        echo "&nbsp;";
                                                                    } else {
                                                                        echo ucwords($business_fname1);
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
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div  class="likeduserlist1  <?php echo "likeusername" . $row['business_profile_post_id']; ?>" id="<?php echo "likeusername" . $row['business_profile_post_id']; ?>" style="display:none">
                                                        <?php
                                                        $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                        $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                        $likeuser = $commnetcount[0]['business_like_user'];
                                                        $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                        $likelistarray = explode(',', $likeuser);
                                                        foreach ($likelistarray as $key => $value) {
                                                            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                        }
                                                        ?>
                                                        <!-- pop up box end-->
                                                        <a href="javascript:void(0);"  onclick="likeuserlist(<?php echo $row['business_profile_post_id']; ?>);">
                                                            <?php
                                                            $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1', 'is_delete' => '0');
                                                            $commnetcount = $this->common->select_data_by_condition('business_profile_post', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');

                                                            $likeuser = $commnetcount[0]['business_like_user'];
                                                            $countlike = $commnetcount[0]['business_likes_count'] - 1;
                                                            $likelistarray = explode(',', $likeuser);

                                                            $business_fname1 = $this->db->get_where('business_profile', array('user_id' => $value, 'status' => 1))->row()->company_name;
                                                            ?>
                                                            <div class="like_one_other">
                                                                <?php
                                                                echo ucwords($business_fname1);
                                                                echo "&nbsp;";
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
                                                            </div>
                                                        </a>
                                                    </div>

                                                    <!-- like user list end -->



                                                    <!-- all comment start-->

                                                    <div class="art-all-comment col-md-12">

                                                        <div id="<?php echo "fourcomment" . $row['business_profile_post_id']; ?>" style="display:none;">


                                                        </div>

                                                        <!-- khyati changes start -->
                                                        <div  id="<?php echo "threecomment" . $row['business_profile_post_id']; ?>" style="display:block">
                                                            <div class="<?php echo 'insertcomment' . $row['business_profile_post_id']; ?>">

                                                                <?php
                                                                $contition_array = array('business_profile_post_id' => $row['business_profile_post_id'], 'status' => '1');

                                                                $businessprofiledata = $this->data['businessprofiledata'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = 'business_profile_post_comment_id', $orderby = 'DESC', $limit = '1', $offset = '', $join_str = array(), $groupby = '');

                                                                if ($businessprofiledata) {
                                                                    foreach ($businessprofiledata as $rowdata) {
                                                                        $companyname = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id']))->row()->company_name;
                                                                        ?>
                                                                        <div class="all-comment-comment-box">
                                                                            <div class="post-design-pro-comment-img"> 
                                                                                <?php
                                                                                $business_userimage = $this->db->get_where('business_profile', array('user_id' => $rowdata['user_id'], 'status' => 1))->row()->business_user_image;
                                                                                ?>
                                                                                <?php if ($business_userimage) { ?>
                                                                                    <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                                                <?php } else { ?>
                                                                                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                                                <?php } ?>

                                                                            </div>
                                                                            <div class="comment-name">

                                                                                <b>  <?php
                                                                                    echo ucwords($companyname);
                                                                                    echo '</br>';
                                                                                    ?>
                                                                                </b>
                                                                            </div>
                                                                            <div class="comment-details" id= "<?php echo "showcomment" . $rowdata['business_profile_post_comment_id']; ?>">



                                                                                <div id="<?php echo "lessmore" . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                                                                    <?php
                                                                                    $small = substr($rowdata['comments'], 0, 180);
                                                                                    echo $this->common->make_links($small);

                                                                                    if (strlen($rowdata['comments']) > 180) {
                                                                                        echo '... <span id="kkkk" onClick="seemorediv(' . $rowdata['business_profile_post_comment_id'] . ')">See More</span>';
                                                                                    }
                                                                                    ?>
                                                                                </div>

                                                                                <div id="<?php echo "seemore" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                                                                    <?php
                                                                                    $new_product_comment = $this->common->make_links($rowdata['comments']);


                                                                                    echo nl2br(htmlspecialchars_decode(htmlentities($new_product_comment, ENT_QUOTES, 'UTF-8')));
                                                                                    ?>

                                                                                </div>


                                                                            </div>

                                                                            <div class="edit-comment-box">
                                                                                <div class="inputtype-edit-comment">

                                                                                    <div contenteditable="true"  class="editable_text editav_2" name="<?php echo $rowdata['business_profile_post_comment_id']; ?>"  id="<?php echo "editcomment" . $rowdata['business_profile_post_comment_id']; ?>" placeholder="Add a Commnet Comment " value= ""  onkeyup="commentedit(<?php echo $rowdata['business_profile_post_comment_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"><?php echo $rowdata['comments']; ?></div>
                                                                                    <span class="comment-edit-button"><button id="<?php echo "editsubmit" . $rowdata['business_profile_post_comment_id']; ?>" style="display:none" onClick="edit_comment(<?php echo $rowdata['business_profile_post_comment_id']; ?>)">Save</button></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="art-comment-menu-design"> 
                                                                                <div class="comment-details-menu" id="<?php echo 'likecomment1' . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                    <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_like1(this.id)">
                                                                                        <?php
                                                                                        $userid = $this->session->userdata('aileenuser');
                                                                                        $contition_array = array('business_profile_post_comment_id' => $rowdata['business_profile_post_comment_id'], 'status' => '1');
                                                                                        $businesscommentlike = $this->data['businesscommentlike'] = $this->common->select_data_by_condition('business_profile_post_comment', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                        $likeuserarray = explode(',', $businesscommentlike[0]['business_comment_like_user']);
                                                                                        if (!in_array($userid, $likeuserarray)) {
                                                                                            ?>
                                                                                                                                                                                           <!-- <i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i>  -->
                                                                                            <i class="fa fa-thumbs-up fa-1x" aria-hidden="true"></i> 
                                                                                        <?php } else { ?>
                                                                                            <i class="fa fa-thumbs-up main_color" aria-hidden="true"></i>

                                                                                        <?php } ?>
                                                                                        <span>
                                                                                            <?php
                                                                                            if ($rowdata['business_comment_likes_count']) {
                                                                                                echo $rowdata['business_comment_likes_count'];
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
                                                                                        <div id="<?php echo 'editcommentbox' . $rowdata['business_profile_post_comment_id']; ?>" style="display:block;">
                                                                                            <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_editbox(this.id)" class="editbox">Edit
                                                                                            </a>
                                                                                        </div>
                                                                                        <div id="<?php echo 'editcancle' . $rowdata['business_profile_post_comment_id']; ?>" style="display:none;">
                                                                                            <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>" onClick="comment_editcancle(this.id)">Cancel
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <?php
                                                                                $userid = $this->session->userdata('aileenuser');
                                                                                $business_userid = $this->db->get_where('business_profile_post', array('business_profile_post_id' => $rowdata['business_profile_post_id'], 'status' => 1))->row()->user_id;
                                                                                if ($rowdata['user_id'] == $userid || $business_userid == $userid) {
                                                                                    ?>                                     
                                                                                    <span role="presentation" aria-hidden="true"> · </span>
                                                                                    <div class="comment-details-menu">
                                                                                        <input type="hidden" name="post_delete"  id="post_delete<?php echo $rowdata['business_profile_post_comment_id']; ?>" value= "<?php echo $rowdata['business_profile_post_id']; ?>">
                                                                                        <a id="<?php echo $rowdata['business_profile_post_comment_id']; ?>"   onClick="comment_delete(this.id)"> Delete<span class="<?php echo 'insertcomment' . $rowdata['business_profile_post_comment_id']; ?>">
                                                                                            </span>
                                                                                        </a>
                                                                                    </div>
                                                                                <?php } ?>                                   
                                                                                <span role="presentation" aria-hidden="true"> · </span>
                                                                                <div class="comment-details-menu">
                                                                                    <p><?php
                                                                                        echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($rowdata['created_date'])));
                                                                                        echo '</br>';
                                                                                        ?></p></div>
                                                                            </div></div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <!-- khyati changes end -->
                                                        <!-- all comment end -->
                                                    </div>
                                                    <!-- comment start -->
                                                    <div class="post-design-commnet-box col-md-12">
                                                        <div class="post-design-proo-img"> 
                                                            <?php
                                                            $userid = $this->session->userdata('aileenuser');
                                                            $business_userimage = $this->db->get_where('business_profile', array('user_id' => $userid, 'status' => 1))->row()->business_user_image;
                                                            ?>
                                                            <?php if ($business_userimage) { ?>
                                                                <img  src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $business_userimage); ?>"  alt="">
                                                            <?php } else { ?>
                                                                <img src="<?php echo base_url(NOIMAGE); ?>" alt="">
                                                            <?php } ?>
                                                        </div>
                                                        <div id="content" class="col-md-12  inputtype-comment cmy_2" >
                                                            <div contenteditable="true" class="editable_text edt_2" name="<?php echo $row['business_profile_post_id']; ?>"  id="<?php echo "post_comment" . $row['business_profile_post_id']; ?>" placeholder="Add a Comment... " onClick="entercomment(<?php echo $row['business_profile_post_id']; ?>)" onpaste="OnPaste_StripFormatting(this, event);"></div>
                                                        </div>
                                                        <?php echo form_error('post_comment'); ?> 
                                                        <div class="comment-edit-butn">       
                                                            <button id="<?php echo $row['business_profile_post_id']; ?>" onClick="insert_comment(this.id)">Comment</button></div>
                                                    </div>
                                                    <!-- comment end -->
                                                </div>
                                            </div> </div>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="contact-frnd-post bor_none">
                                        <div class="text-center rio">
                                            <h4 class="page-heading  product-listing">No Post Found.</h4>
                                        </div>
                                    </div>

                                <?php } ?>
                                <div class="nofoundpost">
                                </div>


                            </div>
                            <!-- business_profile _manage_post end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                            <div id="popup-form">
                                <?php echo form_open_multipart(base_url('business_profile/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                <input type="hidden" name="hitext" id="hitext" value="5">
                                <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" />
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box" id="likeusermodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close1" data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade message-box" id="post" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" id="post"data-dismiss="modal">&times;</button>       
                    <div class="modal-body">
                        <span class="mes">
                        </span>
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
        <footer>
            <?php echo $footer; ?>
        </footer>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script> 
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        
        <script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script> 
        
        <script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
        <script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
    </script>
    <!-- POST BOX JAVASCRIPT END --> 
    <script>
                                                                var base_url = '<?php echo base_url(); ?>';
                                                                var data = <?php echo json_encode($demo); ?>;
                                                                var data1 = <?php echo json_encode($city_data); ?>;
                                                                var slug = '<?php echo $slugid; ?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/dashboard.js'); ?>"></script>
</body>
</html>
