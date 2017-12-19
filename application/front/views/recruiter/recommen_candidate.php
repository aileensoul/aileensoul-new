<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 
        <?php
        if (IS_REC_CSS_MINIFY == '0') {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css'); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/recruiter.css'); ?>">
            <?php
        } else {
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css_min/recruiter/rec_common_header.min.css?ver=' . time()); ?>">
        <?php } ?>
<!--   <script type="text/javascript" language="javascript">
                                        var aax_size = '300x250';
                                        var aax_pubname = 'aileensoul-21';
                                        var aax_src = '302';
                            </script>-->

<!--<script type="text/javascript">
  var oldDocumentWrite = document.write

// change document.write temporary
document.write = function(node){
    $("#khyati").append(node)
}

// get script
$.getScript( "http://www.googleadservices.com/pagead/conversion.js", function() {
    // replace the temp document.write with the original version
    setTimeout(function() {
        document.write = oldDocumentWrite
    }, 100000000)
});

</script>-->


    </head>
    <body class="page-container-bg-solid page-boxed pushmenu-push">
        <?php echo $header; ?>
        <?php if ($recdata[0]['re_step'] == 3) { ?>
            <?php echo $recruiter_header2_border; ?>
        <?php } ?>
        <div id="preloader"></div>
        <!-- START CONTAINER -->
        <section>
            <!-- MIDDLE SECTION START -->
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container padding-360">
                    <div class="">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt"><div class="">

                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block" href="<?php echo base_url('recruiter/profile'); ?>" tabindex="-1" 
                                               aria-hidden="true" rel="noopener">
                                                <div class="bg-images no-cover-upload"> 
                                                    <?php
                                                    $image_ori = $recdata[0]['profile_background'];
                                                    $filename = $this->config->item('rec_bg_main_upload_path') . $recdata[0]['profile_background'];
                                                    $s3 = new S3(awsAccessKey, awsSecretKey);
                                                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                    if ($info && $recdata[0]['profile_background'] != '') {
                                                        ?>
                                                        <img src = "<?php echo REC_BG_MAIN_UPLOAD_URL . $recdata[0]['profile_background']; ?>" name="image_src" id="image_src" />
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" >
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock"  href="<?php echo base_url('recruiter/profile/' . $recdata[0]['user_id']); ?>" title="<?php echo $recdata[0]['rec_firstname'] . ' ' . $recdata[0]['rec_lastname']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                    <?php
                                                    $filename = $this->config->item('rec_profile_thumb_upload_path') . $recdata[0]['recruiter_user_image'];
                                                    $s3 = new S3(awsAccessKey, awsSecretKey);
                                                    $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                    if ($recdata[0]['recruiter_user_image'] != '' && $info) {
                                                        ?>
                                                        <img src="<?php echo REC_PROFILE_THUMB_UPLOAD_URL . $recdata[0]['recruiter_user_image']; ?>" alt="" >
                                                        <?php
                                                    } else {


                                                        $a = $recdata[0]['rec_firstname'];
                                                        $acr = substr($a, 0, 1);

                                                        $b = $recdata[0]['rec_lastname'];
                                                        $acr1 = substr($b, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($acr1)); ?>

                                                        </div>

                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo site_url('recruiter/profile'); ?>" title="<?php echo ucfirst(strtolower($recdata['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata['rec_lastname'])); ?>">   <?php echo ucfirst(strtolower($recdata[0]['rec_firstname'])) . ' ' . ucfirst(strtolower($recdata[0]['rec_lastname'])); ?></a>
                                                </span>

                                                        <?php //$category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name;   ?>
                                                <div class="profile-boxProfile-name">
                                                    <a href="<?php echo site_url('recruiter/profile/' . $recdata[0]['user_id']); ?>" title="<?php echo ucfirst(strtolower($recdata[0]['designation'])); ?>">
                                                        <?php
                                                        if (ucfirst(strtolower($recdata[0]['designation']))) {
                                                            echo ucfirst(strtolower($recdata[0]['designation']));
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'profile') { ?> class="active" <?php } ?>><a class="padding_less_left" title="Details" href="<?php echo base_url('recruiter/profile'); ?>"> Details</a>
                                                    </li>                                
                                                    <li id="rec_post_home" <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'post') { ?> class="active" <?php } ?>><a title="Post" href="<?php echo base_url('recruiter/post'); ?>">Post</a>
                                                    </li>
                                                    <li <?php if ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'save-candidate') { ?> class="active" <?php } ?>><a title="Saved Candidate" class="padding_less_right" href="<?php echo base_url('recruiter/save-candidate'); ?>">Saved </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>


<?php echo $left_footer; ?>
<?php // if (($candidatejob != NULL) || ($recruiterdata != NULL)) {  ?>
                                <div  class="add-post-button">
                                    <a class="btn btn-3 btn-3b"  href="<?php echo base_url('recruiter/add-post'); ?>"><i class="fa fa-plus" aria-hidden="true"></i>  Post a Job</a>
                                </div> <?php //}  ?>
                                <div id="khyati"></div>
                            </div>

                        </div>
                        <!--- search end -->


                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="common-form ">
                                <div class="job-saved-box">
<?php //if (($candidatejob != NULL) || ($recruiterdata != NULL)) {  ?>
                                    <h3>
                                        Recommended Candidate
                                    </h3>
<?php // }  ?>
                                    <div class="contact-frnd-post">

                                        <div class = "job-contact-frnd">
                                            <!--AJAX DATA START FOR RECOMMAND CANDIDATE-->
                                        </div>
                                        <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 

                            <div class="all-profile-box">
                                <div class="all-pro-head">
                                    <h4>Profiles<a href="" class="pull-right">All</a></h4>
                                </div>
                                <ul class="all-pr-list">
                                    <li>
                                        <a href="#">
                                            <div class="all-pr-img">
                                                <img src="img/i1.png">
                                            </div>
                                            <span>Job Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="all-pr-img">
                                                <img src="img/i2.jpg">
                                            </div>
                                            <span>Recruiter Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="all-pr-img">
                                                <img src="img/i3.jpg">
                                            </div>
                                            <span>Freelance Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="all-pr-img">
                                                <img src="img/i4.jpg">
                                            </div>
                                            <span>Business Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="all-pr-img">
                                                <img src="img/i5.jpg">
                                            </div>
                                            <span>Artistic Profile</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- MIDDLE SECTION END -->
        </section>

        <!-- END CONTAINER -->

        <!-- BEGIN FOOTER -->
        <!-- BID MODAL START -->
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
        <!-- BID MODAL END-->
        <!-- START FOOTER -->

<?php echo $footer; ?>

        <!-- END FOOTER -->


        <!-- FIELD VALIDATION JS START -->




        <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            //   var data1 = <?php //echo json_encode($de);  ?>;
            //   var data = <?php //echo json_encode($demo);  ?>;
            var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>



        <!-- FIELD VALIDATION JS END -->
        <?php
        if (IS_REC_JS_MINIFY == '0') {
            ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/recruiter/search.js'); ?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/webpage/recruiter/recommen_candidate.js'); ?>"></script>
            <?php
        } else {
            ?>
            <script type="text/javascript"  src="<?php echo base_url('assets/js_min/webpage/recruiter/recommen_candidate.min.js?ver=' . time()); ?>"></script>
<?php } ?>




    </body>
</html>