<div class="container pt15">
			<div class="sticky-container right-profile">
                <ul class="sticky-right">
                    <li>
                         <a title="Artistic Profile" href="#art-scroll" class="right-menu-box art-r" onclick="return tabindexart();"> <span>Artistic Profile</span></a>
                    </li>
                    <li>
                        <a title="Business Profile" href="#bus-scroll" class="right-menu-box bus-r" onclick="return tabindexbus();"> <span>Business Profile</span></a>
                    </li>
                    <li>
                        <a title="Job Profile" href="#job-scroll" class="right-menu-box job-r" onclick="return tabindexjob();"><span>Job Profile</span></a>
                    </li>
                    <li>
                        <a title="Recruiter Profile" href="#rec-scroll" class="right-menu-box rec-r" onclick="return tabindexrec();"> <span>Recruiter Profile</span></a>
                    </li>
                    <li>
                        <a title="freelancer Profile" href="#free-scroll" class="right-menu-box free-r" onclick="return tabindexfree();"> <span>Freelance Profile</span></a>
                    </li>
                </ul>
            </div>
			<section class="all-profile-custom">
				<div id="bus-scroll" class="custom-box odd">
                    <div class="custom-width">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="left-box">
                                    <a href="#"><img title="Business Profile" src="<?php echo base_url(). "assets/n-images/i4.jpg"; ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="right-box">
                                    <h1><a title="Business Profile" href="#">Business Profile</a></h1>
                                    <p>Grow your business network.</p>
                                    <div class="btns">
                                        <a title="Take me in"  ng-if="details_data.bp_step == '4'" class="btn-4" ng-href="<?php echo base_url('business-profile'); ?>" target="_self">Take me in</a> 
                                        <a title="Take me in" ng-if="details_data.bp_status == '0' && details_data.rp_step == '3'" class="btn-4" ng-href="<?php echo base_url('business-profile'); ?>" target="_self">Active</a> 
                                        <a title="Take me in" ng-if="details_data.bp_step == null" class="btn-4" ng-href="<?php echo base_url('business-profile'); ?>" target="_self">Register</a> 
										<a title="How it works" data-target="#bus-popup" data-toggle="modal" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
                                    </div>
                                </div>
                            </div>
						</div>
                    </div>
                </div>
							
				<div id="job-scroll" class="custom-box odd">
                    <div class="custom-width">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="left-box">
                                    <a href="#"><img title="Job Profile" src="<?php echo base_url(). "assets/n-images/i1.jpg"; ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="right-box">
                                    <h1><a title="Job Profile" href="#">Job Profile</a></h1>
                                    <p>Find best job options and connect with recruiters.</p>
                                    <div class="btns">
                                        <a title="Take me in"  ng-if="details_data.jp_step == '10'" class="btn-4" ng-href="<?php echo base_url('job'); ?>" target="_self">Take me in</a> 
                                        <a title="Take me in" ng-if="details_data.jp_status == '0' && details_data.jp_step == '10'" class="btn-4" ng-href="<?php echo base_url('job'); ?>" target="_self">Active</a> 
                                        <a title="Take me in" ng-if="details_data.jp_step == null" class="btn-4" ng-href="<?php echo base_url('job'); ?>" target="_self">Register</a> 
                                        <a title="How it works" data-target="#jop-popup" data-toggle="modal" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                            
                <div id="rec-scroll" class="custom-box odd">
                    <div class="custom-width">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="left-box">
                                    <a href="#"><img title="Recruiter Profile" src="<?php echo base_url(). "assets/n-images/i2.jpg"; ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="right-box">
                                    <h1><a title="Recruiter Profile" href="#">Recruiter Profile</a></h1>
                                    <p>Hire quality employees here.</p>
                                    <div class="btns">
                                       <a title="Take me in"  ng-if="details_data.rp_step == '3'" class="btn-4" ng-href="<?php echo base_url('recruiter'); ?>" target="_self" >Take me in</a> 
                                        <a title="Take me in" ng-if="details_data.rp_status == '0' && details_data.rp_step == '3'" class="btn-4" ng-href="<?php echo base_url('recruiter'); ?>" target="_self">Active</a> 
                                        <a title="Take me in" ng-if="details_data.rp_step == null" class="btn-4" ng-href="<?php echo base_url('recruiter'); ?>" target="_self">Register</a> 
										<a title="How it works" data-target="#rec-popup" data-toggle="modal" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
									</div>
                                </div>
                            </div>
						</div>
                    </div>
                </div>
				<div id="art-scroll" class="custom-box odd">
                    <div class="custom-width">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="left-box">
                                    <a href="#"><img title="Artistic Profile" src="<?php echo base_url(). "assets/n-images/i5.jpg"; ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="right-box">
                                    <h1><a title="Artistic Profile" href="#">Artistic Profile</a></h1>
                                    <p>Show your art &amp; talent to the world.</p>
                                    <div class="btns">
                                        <a title="Take me in"  ng-if="details_data.ap_step == '4'" class="btn-4" ng-href="<?php echo base_url('artist'); ?>" target="_self">Take me in</a> 
                                        <a title="Take me in" ng-if="details_data.ap_status == '0' && details_data.ap_step == '4'" class="btn-4" ng-href="<?php echo base_url('artist'); ?>" target="_self">Active</a> 
                                        <a title="Take me in" ng-if="details_data.ap_step == null && details_data.ap_step == null" class="btn-4" ng-href="<?php echo base_url('artist'); ?>" target="_self">Register</a> 
                                        <a title="How it Works" data-target="#art-popup" data-toggle="modal" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
				<div id="free-scroll" class="custom-box odd">
                    <div class="custom-width">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <div class="left-box">
                                    <a href="#"><img title="Freelance Profile" src="<?php echo base_url(). "assets/n-images/i3.jpg"; ?>"></a>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="right-box">
                                    <h1><a title="Freelance Profile" href="#">Freelance Profile</a></h1>
                                    <p>Hire freelancers and also find freelance work.</p>
                                    <div class="btns">
                                        <a title="Take me in"  ng-if="details_data.rp_step == '3'" class="btn-4"  ng-href="<?php echo base_url('freelancer'); ?>" target="_self">Take me in</a> 
                                        <a title="Take me in" ng-if="details_data.rp_status == '0' && details_data.rp_step == '3'" class="btn-4" ng-href="<?php echo base_url('freelancer'); ?>" target="_self">Active</a> 
                                        <a title="Take me in" ng-if="details_data.fh_step == null && details_data.fp_step == null" class="btn-4" ng-href="<?php echo base_url('freelancer'); ?>" target="_self">Register</a> 
										<a title="How it works" data-target="#fre-popup" data-toggle="modal" href="javascript:;" class="pl20 ml20 hew">How it works?</a>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
		</div>