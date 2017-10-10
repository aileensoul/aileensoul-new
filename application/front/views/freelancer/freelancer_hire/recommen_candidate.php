<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css?ver=' . time()); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css?ver=' . time()); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/freelancer-hire/freelancer-hire.css?ver=' . time()); ?>">
    </head>
    <body class="pushmenu-push">
        <?php echo $header; ?>
        <?php echo $freelancer_hire_header2_border; ?>
        <section>
            <div class="user-midd-section" id="paddingtop_fixed">
                <div class="container padding-360">
                    <div class="row4">
                        <div class="profile-box-custom fl animated fadeInLeftBig left_side_posrt">
                            <div class="">
                                <div class="full-box-module">   
                                    <div class="profile-boxProfileCard  module">
                                        <div class="profile-boxProfileCard-cover"> 
                                            <a class="profile-boxProfileCard-bg u-bgUserColor a-block"
                                               href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" 
                                               title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">

                                                <?php if ($freehiredata[0]['profile_background'] != '') { ?>
                                                    <div class="data_img">
                                                        <img src="<?php echo FREE_HIRE_BG_THUMB_UPLOAD_URL . $freehiredata[0]['profile_background']; ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="data_img bg-images no-cover-upload">
                                                        <img src="<?php echo base_url(WHITEIMAGE); ?>" class="bgImage" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"  >
                                                    </div>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <div class="profile-boxProfileCard-content clearfix">
                                            <div class="left_side_box_img buisness-profile-txext">

                                                <a class="profile-boxProfilebuisness-avatarLink2 a-inlineBlock" href="<?php echo base_url('freelancer-hire/employer-details'); ?>"  tabindex="-1" aria-hidden="true" rel="noopener" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>">
                                                    <?php
                                                       $filename = $this->config->item('free_hire_profile_main_upload_path') . $freehiredata[0]['freelancer_hire_user_image'];
                                                        $s3 = new S3(awsAccessKey, awsSecretKey);
                                                        $this->data['info'] = $info = $s3->getObjectInfo(bucket, $filename);
                                                    if ($info) {
                                                        ?>
                                                        <img src="<?php echo FREE_HIRE_PROFILE_MAIN_UPLOAD_URL . $freehiredata[0]['freelancer_hire_user_image']; ?>" alt="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>" >
                                                      
                                                    <?php  } else {
                                                        $fname = $freehiredata[0]['fullname'];
                                                        $lname = $freehiredata[0]['username'];
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
                                            <div class="right_left_box_design ">
                                                <span class="profile-company-name ">
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"> <?php echo ucwords($freehiredata[0]['fullname']) . ' ' . ucwords($freehiredata[0]['username']); ?></a>  
                                                </span>
                                                <?php $category = $this->db->get_where('industry_type', array('industry_id' => $businessdata[0]['industriyal'], 'status' => 1))->row()->industry_name; ?>
                                                <div class="profile-boxProfile-name">
                                                    <a href="<?php echo base_url('freelancer-hire/employer-details'); ?>" title="<?php echo $freehiredata[0]['fullname'] . " " . $freehiredata[0]['username']; ?>"><?php
                                                        if ($freehiredata[0]['designation']) {
                                                            echo $freehiredata[0]['designation'];
                                                        } else {
                                                            echo "Designation";
                                                        }
                                                        ?></a>
                                                </div>
                                                <ul class=" left_box_menubar">
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'employer-details')) { ?> class="active" <?php } ?>><a title="Employer Details"  class="padding_less_left" href="<?php echo base_url('freelancer-hire/employer-details'); ?>" ><?php echo $this->lang->line("details"); ?></a></li>
                                                    <li><a title="Projects" href="<?php echo base_url('freelancer-hire/projects'); ?>"><?php echo $this->lang->line("Projects"); ?></a></li>
                                                    <li <?php if (($this->uri->segment(1) == 'freelancer-hire') && ($this->uri->segment(2) == 'freelancer-save')) { ?> class="active" <?php } ?>><a title="Saved Freelancer"  class="padding_less_right" href="<?php echo base_url('freelancer-hire/freelancer-save'); ?>"><?php echo $this->lang->line("saved"); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>                             
                                </div>
								<div class="tablate-potrat-add">
								<div class="fw text-center pt10">
									<script type="text/javascript" language="javascript">
									  var aax_size='300x250';
									  var aax_pubname = 'aileensoul-21';
									  var aax_src='302';
									</script>
									<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
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

                                <div  class="add-post-button">
                                    <a class="btn btn-3 btn-3b" id ="Fh-post-project" href="<?php echo base_url('freelancer-hire/add-projects'); ?>"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $this->lang->line("post_project"); ?></a>
                                </div>
                            </div>

                        </div>
                        <?php

                        function text2link($text) {
                            $text = preg_replace('/(((f|ht){1}t(p|ps){1}:\/\/)[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '<a href="\\1" target="_blank" rel="nofollow">\\1</a>', $text);
                            $text = preg_replace('/([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&\/\/=]+)/i', '\\1<a href="http://\\2" target="_blank" rel="nofollow">\\2</a>', $text);
                            $text = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/i', '<a href="mailto:\\1" rel="nofollow" target="_blank">\\1</a>', $text);
                            return $text;
                        }
                        ?>
                        <!-- middle div stat -->
                        <div class="custom-right-art mian_middle_post_box animated fadeInUp">
                            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3><?php echo $this->lang->line("recommended_freelancer"); ?></h3>
                                    <div class="contact-frnd-post">
<!--										<div class="mob-add">
								<div class="fw text-center pt10 pb5">
									<script type="text/javascript" language="javascript">
									  var aax_size='300x250';
									  var aax_pubname = 'aileensoul-21';
									  var aax_src='302';
									</script>
									<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
									</div>
							</div>-->
                                        <div class="job-contact-frnd">
                                            <!--AJAX DATA...........-->

                                            <!-- body tag inner data end -->
                                            <div class="col-md-1">
                                            </div>
                                        </div>
                                        <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver=' . time()) ?>" /></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- middle div  -->
						<div id="hideuserlist" class="right_middle_side_posrt fixed_right_display animated fadeInRightBig"> 
					
						<div class="fw text-center">
							<script type="text/javascript" language="javascript">
							  var aax_size='300x250';
							  var aax_pubname = 'aileensoul-21';
							  var aax_src='302';
							</script>
							<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
						</div>
						<div class="fw pt20" style="text-align:center;">
							<a target="_blank"  href="https://www.amazon.in/gp/product/B01J2J5AJK/ref=as_li_tl?ie=UTF8&camp=3638&creative=24630&creativeASIN=B01J2J5AJK&linkCode=as2&tag=aileensoul-21&linkId=20545e667d8508dfeeec485f8ac5d518"><img border="0" src="//ws-in.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=IN&ASIN=B01J2J5AJK&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL250_&tag=aileensoul-21" ></a><img src="//ir-in.amazon-adsystem.com/e/ir?t=aileensoul-21&l=am2&o=31&a=B01J2J5AJK" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
						</div>
                    </div>
					<div class="tablate-add">
					
					<script type="text/javascript" language="javascript">
					  var aax_size='160x600';
					  var aax_pubname = 'aileensoul-21';
					  var aax_src='302';
					</script>
					<script type="text/javascript" language="javascript" src="https://c.amazon-adsystem.com/aax2/assoc.js"></script>
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
                        <span class="mes"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model Popup Close -->
        <script>
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/recommen_candidate.js?ver=' . time()); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/webpage/freelancer-hire/freelancer_hire_common.js?ver=' . time()); ?>"></script>
    </body>
</html>