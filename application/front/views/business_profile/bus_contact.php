<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php echo $business_header2_border ?>
        <section>
            <?php echo $business_common; ?>
            <div class="user-midd-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3>Contacts</h3>
                                    <div class="contact-frnd-post">
                                        <?php
                                        if (count($unique_user) > 0) {
                                            foreach ($unique_user as $user) {
                                                if ($busuid == $user['contact_from_id']) {
                                                    $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_to_id'], $data = '*', $join_str = array());
                                                    $contition_array = array('contact_from_id' => $login, 'contact_to_id' => $user['contact_to_id'], 'contact_type' => 2);
                                                    $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                } else {
                                                    $cdata = $this->common->select_data_by_id('business_profile', 'user_id', $user['contact_from_id'], $data = '*', $join_str = array());
                                                    $contition_array = array('contact_to_id' => $login, 'contact_from_id' => $user['contact_from_id'], 'contact_type' => 2);
                                                    $clistuser = $this->common->select_data_by_condition('contact_person', $contition_array, $data = 'status,contact_id', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                }
                                                ?>
                                                <div class="job-contact-frnd">
                                                    <div class="profile-job-post-detail clearfix" id="<?php echo "removecontact" . $cdata[0]['user_id']; ?>">
                                                        <div class="profile-job-post-title-inside clearfix">
                                                            <div class="profile-job-post-location-name">
                                                                <div class="user_lst"><ul>
                                                                        <li class="fl">
                                                                            <div class="follow-img">
                                                                                <?php if ($cdata[0]['business_user_image'] != '') { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>">
                                                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $cdata[0]['business_user_image']); ?>" height="50px" width="50px" alt="" >
                                                                                    </a>
                                                                                <?php } else { ?>
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>">
                                                                                        <img alt="" src="<?php echo base_url(NOIMAGE); ?>" alt="" />
                                                                                    </a>
                                                                                <?php } ?> 
                                                                            </div>
                                                                        </li>
                                                                        <li style="width: 67%">
                                                                            <div class="">
                                                                                <div class="follow-li-text " style="padding: 0;">
                                                                                    <a href="<?php echo base_url('business_profile/business_profile_manage_post/' . $cdata[0]['business_slug']); ?>"><?php echo ucwords($cdata[0]['company_name']); ?></a>
                                                                                </div>
                                                                                <div>
                                                                                    <?php $category = $this->db->get_where('industry_type', array('industry_id' => $cdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                                                    <a><?php
                                                                                        if ($category) {
                                                                                            echo $category;
                                                                                        } else {
                                                                                            echo $cdata[0]['other_industrial'];
                                                                                        }
                                                                                        ?></a>
                                                                                </div>
                                                                        </li>
                                                                        <li class="fr">
                                                                            <?php
                                                                            if ($login == $cdata[0]['user_id']) {
                                                                                
                                                                            } else {
                                                                                ?>
                                                                                <?php if ($clistuser[0]['status'] == 'cancel') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>  
                                                                                <?php } elseif ($clistuser[0]['status'] == 'pending') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?>, 'pending')">
                                                                                            Cancel request
                                                                                        </button>
                                                                                    </div>     
                                                                                <?php } else if ($clistuser[0]['status'] == 'confirm') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_cancle(<?php echo $cdata[0]['user_id']; ?>, 'confirm')">
                                                                                            In your contact
                                                                                        </button> 
                                                                                    </div>        
                                                                                <?php } else if ($clistuser[0]['status'] == 'reject') { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <div class="user_btn" id="<?php echo "statuschange" . $cdata[0]['user_id']; ?>">
                                                                                        <button onclick="contact_person_menu(<?php echo $cdata[0]['user_id']; ?>)">
                                                                                            Add to contact
                                                                                        </button>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="text-center rio">
                                                <h4 class="page-heading  product-listing">No Contacts Found.</h4>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
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
                                <input type="hidden" name="hitext" id="hitext" value="13">
                                <div class="popup_previred">
                                    <img id="preview" src="#" alt="your image" /></div>
                                   <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                                <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
                                <?php echo form_close(); ?>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
        <!-- script for business autofill -->
        <script>
                                                                            var base_url = '<?php echo base_url(); ?>';
                                                                            var data = <?php echo json_encode($demo); ?>;
                                                                            var data1 = <?php echo json_encode($city_data); ?>;
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/business-profile/contacts.js'); ?>"></script>
    </body>
</html>
