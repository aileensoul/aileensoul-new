<!DOCTYPE html>
<html>
    <head>
        <title> <?php echo $title; ?></title>
        <?php echo $head; ?> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-apply.css?ver=' . time()); ?>">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <?php echo $header; ?>
        <?php echo $freelancer_post_header2_border; ?>
        <section>
            <div class="user-midd-section " id="paddingtop_fixed">
                <div class="container padding-360">
                    <div class="row4">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"
                                               tabindex="-1"
                                               aria-hidden="true"
                                               rel="noopener">
                                                   <?php
                                                   if ($freelancerdata[0]['profile_background'] != '') {
                                                       ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo base_url($this->config->item('free_post_bg_thumb_upload_path') . $freelancerdata[0]['profile_background']); ?>" class="bgImage" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="data_img bg-images no-cover-upload">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>"  >
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">
                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" 
                                                   href="<?php echo base_url('freelancer-work/freelancer-details'); ?>" title="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" tabindex="-1" aria-hidden="true" rel="noopener">
                                                       <?php
                                                       $filename = $this->config->item('free_post_profile_main_upload_path') . $freelancerdata[0]['freelancer_post_user_image'];
                                                       $s3 = new S3(awsAccessKey, awsSecretKey);
                                                       $info = $s3->getObjectInfo(bucket, $filename);
                                                       if ($info) {
                                                           ?>
                                                        <img src="<?php echo FREE_POST_PROFILE_MAIN_UPLOAD_URL . $freelancerdata[0]['freelancer_post_user_image']; ?>" alt="<?php echo $freelancerdata[0]['freelancer_post_fullname'] . ' ' . $freelancerdata[0]['freelancer_post_username']; ?>" >
                                                        <?php
                                                    } else {
                                                        $fname = $freelancerdata[0]['freelancer_post_fullname'];
                                                        $lname = $freelancerdata[0]['freelancer_post_username'];
                                                        $sub_fname = substr($fname, 0, 1);
                                                        $sub_lname = substr($lname, 0, 1);
                                                        ?>
                                                        <div class="post-img-profile">
                                                            <?php echo ucfirst(strtolower($sub_fname)) . ucfirst(strtolower($sub_lname)); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="right_left_box_design">
                                                <span class="profile-company-name">
                                                    <a href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo ucwords($freelancerdata[0]['freelancer_post_fullname']) . ' ' . ucwords($freelancerdata[0]['freelancer_post_username']); ?></a>
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a  href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php
                                                        if ($freepostdata[0]['designation']) {
                                                            echo ucwords($freepostdata[0]['designation']);
                                                        } else {
                                                            echo $this->lang->line("designation");
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'freelancer-details')) { ?> class="active" <?php } ?>><a  class="padding_less_left"  title="freelancer Details" href="<?php echo base_url('freelancer-work/freelancer-details'); ?>"><?php echo $this->lang->line("details"); ?></a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'saved-projects')) { ?> class="active" <?php } ?>><a title="Saved Post" href="<?php echo base_url('freelancer-work/saved-projects'); ?>"><?php echo $this->lang->line("saved"); ?></a>
                                                    </li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-work') && ($this->uri->segment(2) == 'applied-projects')) { ?> class="active" <?php } ?>><a title="Applied Post"  class="padding_less_right"  href="<?php echo base_url('freelancer-work/applied-projects'); ?>"><?php echo $this->lang->line("applied"); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
                                <div class="edi_origde">
                        <?php
                       //echo $count_profile;
                        if($count_profile == 100)
                        {
                            if($freepostdata[0]['progressbar']==0)
                            {
                           ?>
                        <div class="edit_profile_progress complete_profile">
                           <div class="progre_bar_text">
                              <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                           </div>
                           <div class="count_main_progress">
                              <div class="circles">
                                 <div class="second circle-1 ">
                                     <img src="<?php echo base_url("assets/img/true.png"); ?>">
                                    <div class="true_progtree">
                                       
                                    </div>
                                    <div class="tr_text">
                                       Successfully Completed
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                         }
                              
                           else
                           {
                               ?>
                        <div class="edit_profile_progress">
                           <div class="progre_bar_text">
                              <p>Please fill up your entire profile to get better job options and so that recruiter can find you easily.</p>
                           </div>
                           <div class="count_main_progress">
                              <div class="circles">
                                 <div class="second circle-1">
                                    <div>
                                       <strong></strong>
 
                                  <a href="<?php echo base_url('freelancer-work/basic-information')?>" class="edit_profile_job">Edit Profile</a>
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php
                           }
                           ?>
                     </div>
                                <div class="tablate-potrat-add">
                                    <div class="fw text-center pt10">
                                        <script type="text/javascript">
                                            (function () {
                                                if (window.CHITIKA === undefined) {
                                                    window.CHITIKA = {'units': []};
                                                }
                                                ;
                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                var placement_id = window.CHITIKA.units.length;
                                                window.CHITIKA.units.push(unit);
                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                            }());
                                        </script>
                                        <script async type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                    </div>
                                </div>
                                <div class="custom_footer_left fw">
                                    <div class="fl">
                                        <ul>
                                            <li><a href="<?php echo base_url('about-us'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> About Us </a></li>

                                            <li><a href="<?php echo base_url('contact-us'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Contact Us</a></li>

                                            <li><a href="<?php echo base_url('blog'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Blogs</a></li>
                                            <li><a href="<?php echo base_url('privacy-policy'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Privacy Policy</a></li>
                                            <li><a href="<?php echo base_url('terms-and-condition'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Terms &amp; Condition </a></li>



                                            <li><a href="<?php echo base_url('feedback'); ?>" target="_blank"><span class="custom_footer_dot" role="presentation" aria-hidden="true"> · </span> Send Us Feedback</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- cover pic end -->
                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <?php
                            if ($this->uri->segment(3) == 'live-post') {
                                echo '<div class="alert alert-success">Applied successfully...!</div>';
                            }
                            ?>
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3><?php echo $this->lang->line("recommended_project"); ?></h3>
                                    <div class="contact-frnd-post">
                                        <div class="mob-add">
                                            <div class="fw text-center pt10 pb5">
                                                <script type="text/javascript">
                                            (function () {
                                                if (window.CHITIKA === undefined) {
                                                    window.CHITIKA = {'units': []};
                                                }
                                                ;
                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                var placement_id = window.CHITIKA.units.length;
                                                window.CHITIKA.units.push(unit);
                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                            }());
                                                </script>
                                                <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                                            </div>
                                        </div>
                                        <!--.............AJAX DATA............-->
                                        <div class="fw" id="loader" style="text-align:center;">
                                            <img src="<?php echo base_url('assets/images/loader.gif?ver=' . time()) ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 

                            <div class="fw text-center">
                                <script type="text/javascript">
                                            (function () {
                                                if (window.CHITIKA === undefined) {
                                                    window.CHITIKA = {'units': []};
                                                }
                                                ;
                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 300, "height": 250, "sid": "Chitika Default"};
                                                var placement_id = window.CHITIKA.units.length;
                                                window.CHITIKA.units.push(unit);
                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                            }());
                                </script>
                                <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>

                                <div class="fw pt10">
                                    <a href="https://www.chitika.com/publishers/apply?refid=aileensoul"><img src="https://images.chitika.net/ref_banners/300x250_hidden_ad.png" /></a>
                                </div>
                            </div>


                        </div>
                        <div class="tablate-add">

                            <script type="text/javascript">
                                            (function () {
                                                if (window.CHITIKA === undefined) {
                                                    window.CHITIKA = {'units': []};
                                                }
                                                ;
                                                var unit = {"calltype": "async[2]", "publisher": "Aileensoul", "width": 160, "height": 600, "sid": "Chitika Default"};
                                                var placement_id = window.CHITIKA.units.length;
                                                window.CHITIKA.units.push(unit);
                                                document.write('<div id="chitikaAdBlock-' + placement_id + '"></div>');
                                            }());
                            </script>
                            <script type="text/javascript" src="//cdn.chitika.net/getads.js" async></script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php echo $footer; ?>

        <!-- Bid-modal  -->
        <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
            <div class="modal-dialog modal-lm">
                <div class="modal-content">
                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>         
                    <div class="modal-body">
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->

        <script async src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/js/progressloader.js?ver='.time()); ?>"></script>
       
        <script type="text/javascript">
            $(".alert").delay(3200).fadeOut(300);
            var base_url = '<?php echo base_url(); ?>';
            var count_profile_value='<?php echo $count_profile_value;?>';
            var count_profile='<?php echo $count_profile;?>';
        </script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/post_apply.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/freelancer_apply_common.js?ver=' . time()); ?>"></script>
        <script async type="text/javascript" src="<?php echo base_url('assets/js/webpage/freelancer-apply/progressbar.js?ver=' . time()); ?>"></script>
    </body>               
</html>