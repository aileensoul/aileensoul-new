<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css?ver=' . time()); ?>">
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver=' . time()); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver=' . time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css?ver=' . time()); ?>">
           <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css') ;?>" />
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border; ?>
        <section>
            <?php echo $business_common; ?>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3" style="width: 22%;"></div>
                        <div class="col-md-7 col-sm-12">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>Details </h3> 
                                    <div class=" fr rec-edit-pro">
                                        <?php

                                        function text2link($text) {
                                            $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                                            $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                                            $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                                            return $text;
                                        }
                                        ?>      
                                    </div> 
                                    <div class="contact-frnd-post">
                                        <div class="job-contact-frnd ">
                                            <div class="profile-job-post-detail clearfix">
                                                <div class="profile-job-post-title clearfix">
                                                    <div class="profile-job-profile-button clearfix">
                                                        <div class="profile-job-details">
                                                            <ul>
                                                                <li>
                                                                    <p class="details_all_tital"> Basic Information</p> 
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-profile-menu">
                                                        <ul class="clearfix">
                                                            <li> <b>Comapny Name</b> <span> <?php echo $businessdata1[0]['company_name']; ?> </span></li>
                                                            <li> <b> Country</b> <span> <?php echo $this->db->get_where('countries', array('country_id' => $businessdata1[0]['country']))->row()->country_name; ?> </span></li>
                                                            <li> <b>State</b>
                                                                <span> <?php echo $this->db->get_where('states', array('state_id' => $businessdata1[0]['state']))->row()->state_name; ?> </span>
                                                            </li>
                                                            <?php
                                                            if ($businessdata1[0]['user_id'] == $userid) {
                                                                if ($businessdata1[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> 
                                                                        <span><?php echo $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name; ?></span> 
                                                                    </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b> City</b> <span>
                                                                            <?php echo PROFILENA; ?>
                                                                        </span> </li>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($businessdata1[0]['city']) {
                                                                    ?>
                                                                    <li><b> City</b> <span><?php
                                                                            echo
                                                                            $this->db->get_where('cities', array('city_id' => $businessdata1[0]['city']))->row()->city_name;
                                                                            ?></span> </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($businessdata1[0]['user_id'] == $userid) {
                                                                if ($businessdata1[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span> </li>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <li><b> Pincode:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                                    <?php
                                                                }
                                                            } else {
                                                                if ($businessdata1[0]['pincode']) {
                                                                    ?>
                                                                    <li> <b>Pincode</b><span><?php echo $businessdata1[0]['pincode']; ?></span></li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            <li> <b>Postal Address</b><span> <?php echo $businessdata1[0]['address']; ?> </span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital"> Contact Information</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b> Contact Person</b> <span> <?php echo $businessdata1[0]['contact_person']; ?> </span>
                                                                </li>
                                                                <?php
                                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                                    if ($businessdata1[0]['contact_mobile']) {
                                                                        ?>
                                                                        <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <li><b> Contact Mobile </b> <span><?php echo PROFILENA; ?></span> </li>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    if ($businessdata1[0]['contact_mobile']) {
                                                                        ?>
                                                                        <li> <b>Contact Mobile</b><span> <?php echo $businessdata1[0]['contact_mobile']; ?> </span></li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                <li><b> Contact Email</b> <span><?php echo $businessdata1[0]['contact_email']; ?></span> </li>
                                                                <?php
                                                                if ($businessdata1[0]['user_id'] == $userid) {
                                                                    if ($businessdata1[0]['contact_website']) {
                                                                        ?>
                                                                        <li> <b>Contact Website</b><span>
                                                                                <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
                                                                        </li>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <li><b> Contact Website:</b> <span><?php echo PROFILENA; ?></span> </li>
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    if ($businessdata1[0]['contact_website']) {
                                                                        ?>
                                                                        <li> <b>Contact Website</b><span>
                                                                                  <!--<a href="https://<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $this->common->make_links($businessdata1[0]['contact_website']); ?></a></span>-->
                                                                                <a href="<?php echo $businessdata1[0]['contact_website']; ?>" target="_blank"><?php echo $businessdata1[0]['contact_website']; ?></a></span>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li>
                                                                        <p class="details_all_tital">Professional Information</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <ul class="clearfix">
                                                                <li> <b>Buisness  Type </b> <span><?php
                                                                        $business_typename = $this->db->get_where('business_type', array('type_id' => $businessdata1[0]['business_type']))->row()->business_name;
                                                                        if ($business_typename) {
                                                                            echo $business_typename;
                                                                        } else {
                                                                            echo $businessdata1[0]['other_business_type'];
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                                <li> <b>Category</b><span><?php
                                                                        $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata1[0]['industriyal']))->row()->industry_name;
                                                                        if ($category) {
                                                                            echo $category;
                                                                        } else {
                                                                            echo $businessdata1[0]['other_industrial'];
                                                                        }
                                                                        ?></span>
                                                                </li>
                                                                <li><b>Details Of Your buisness </b> 
                                                                    <span>
                                                                        <p> <?php echo $this->common->make_links($businessdata1[0]['details']);
                                                                        ?></p>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="profile-job-post-title clearfix">
                                                        <div class="profile-job-profile-button clearfix">
                                                            <div class="profile-job-details">
                                                                <ul>
                                                                    <li><p class="details_all_tital">Business Images</p> </li>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="profile-job-profile-menu">
                                                            <div  class="buisness-profile-pic">
                                                                <?php
                                                                if (count($busimagedata) > 0) {
                                                                    if (count($busimagedata) > 3) {
                                                                        $i = 1;
                                                                        $k = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            if ($i <= 2) {
                                                                                ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">          
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                    </div>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i2">  
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                        <div class="view_bui"> 
                                                                                            <a   id="myBtn">view all</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            } $i++;
                                                                            $k++;
                                                                            if ($i == 4) {
                                                                                break;
                                                                            }
                                                                        }
                                                                    } else {
                                                                        $i = 1;
                                                                        $k = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            if ($i <= 2) {
                                                                                ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">          <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(1)" class="hover-shadow cursor">
                                                                                    </div>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <div class="column1">
                                                                                    <div class="bui_res_i">  
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $image['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $k; ?>)" class="hover-shadow cursor">
                                                                                        <!-- <div class="view_bui"> <a >view all</a></div> -->


                                                                                    </div>

                                                                                </div>



                                                                                <?php
                                                                            } $i++;
                                                                            $k++;
                                                                            if ($i == 4) {
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <span style="padding: 8px;"><h7>No Image Available</h7> 

                                                                        <?php
                                                                        $userid = $this->session->userdata('aileenuser');

                                                                        if ($businessdata1[0]['user_id'] == $userid) {
                                                                            ?>
                                                                            <a href="<?php echo base_url('business_profile/image') ?>">Add Images</a>

                                                                        <?php } ?>

                                                                    </span>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <div class="modal fade modal_popup" id="myModal" role="dialog" style="z-index: 1003">
                                                                    <div class="modal-dialog" style="width: 88%;">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title">Business Images</h4>
                                                                            </div>
                                                                            <div class="modal-body popup-img-popup">
                                                                                <div>
                                                                                    <?php
                                                                                    $j = 1;
                                                                                    foreach ($busimagedata as $imagemul) {
                                                                                        ?>
                                                                                        <div class="bui_popup_img"> 
                                                                                            <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $imagemul['image_name']); ?>"  onclick="openModal(); currentSlide(<?php echo $j; ?>)" class="hover-shadow cursor">   </div> 
                                                                                        <?php
                                                                                        $j++;
                                                                                    }
                                                                                    ?>

                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div id="myModal1" class="modal2" style="padding-top: 7%;">


                                                                    <div class="modal-content2"> 
                                                                        <span class="close2 cursor" onclick="closeModal()">&times;</span>  
                                                                        <?php
                                                                        $i = 1;
                                                                        foreach ($busimagedata as $image) {
                                                                            ?>
                                                                            <div class="mySlides">
                                                                                <div class="numbertext"><?php echo $i ?> / <?php echo count($busimagedata); ?></div>
                                                                                <div class="slider_img">
                                                                                    <img src="<?php echo base_url($this->config->item('bus_profile_main_upload_path') . $image['image_name']); ?> " >
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                            $i++;
                                                                        }
                                                                        ?>

                                                                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                                                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                                                        <div class="caption-container">
                                                                            <p id="caption"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- popup -->
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
                        <!-- Model Popup Close -->

                        <!-- Bid-modal for this modal appear or not start -->
                        <div class="modal fade message-box" id="query" role="dialog">
                            <div class="modal-dialog modal-lm">
                                <div class="modal-content">
                                    <button type="button" class="modal-close" id="query" data-dismiss="modal">&times;</button>       
                                    <div class="modal-body">
                                        <span class="mes">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bid-modal for this modal appear or not  Popup Close -->

                        <!-- Bid-modal-2  -->
                        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
                            <div class="modal-dialog modal-lm">
                                <div class="modal-content">
                                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                                    <div class="modal-body">
                                        <span class="mes">
                                            <div id="popup-form">
                                                <?php echo form_open_multipart(base_url('business-profile/user-image-change'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                                <input type="hidden" name="hitext" id="hitext" value="4">
                                                <div class="popup_previred">
                                                    <img id="preview" src="#" alt="your image"/>
                                                </div>
                                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                                <?php echo form_close(); ?>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Model Popup Close -->
                        <?php echo $footer; ?>
                        <!-- script for skill textbox automatic start (option 2)-->
<!--                        <script src="<?php // echo base_url('js/jquery-ui.min.js?ver='.time());  ?>"></script>
                        <script src="<?php // echo base_url('js/demo/jquery-1.9.1.js?ver='.time());  ?>"></script>
                        <script src="<?php // echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time());  ?>"></script>-->
                        <script src="<?php echo base_url('assets/js/croppie.js?ver=' . time()); ?>"></script>
                        <script src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver=' . time()); ?>"></script>
                        <!-- script for business autofill -->
                        <script>
                                                                            var base_url = '<?php echo base_url(); ?>';
                        </script>
                        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/details.js?ver=' . time()); ?>"></script>
                        <script type="text/javascript" defer="defer" src="<?php echo base_url('js/webpage/business-profile/common.js?ver=' . time()); ?>"></script>
                        </body>
                        </html>
