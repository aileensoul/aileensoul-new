<!-- <Don't Remove this Script SEO> -->
<!--<script>
   $(function () {
       var input = $(".common-form input");
       var len = input.val().length;
       input[0].focus();
       input[0].setSelectionRange(len, len);
   });
   </script>-->
<!--<script>
   (function (i, s, o, g, r, a, m) {
       i['GoogleAnalyticsObject'] = r;
       i[r] = i[r] || function () {
           (i[r].q = i[r].q || []).push(arguments)
       }, i[r].l = 1 * new Date();
       a = s.createElement(o),
               m = s.getElementsByTagName(o)[0];
       a.async = 1;
       a.src = g;
       m.parentNode.insertBefore(a, m)
   })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
   
   ga('create', 'UA-91486853-1', 'auto');
   ga('send', 'pageview');
   
   </script>
   
   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   <script>
   (adsbygoogle = window.adsbygoogle || []).push({
       google_ad_client: "ca-pub-6060111582812113",
       enable_page_level_ads: true
   });
   </script>-->
<!-- header -->
<header class="">
  <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'home') || ($this->uri->segment(1) == 'job' && $this->uri->segment(2) == 'job_all_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'recommen_candidate') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_apply_post') || ($this->uri->segment(1) == 'business-profile' && $this->uri->segment(2) == 'home') || ($this->uri->segment(1) == 'artistic' && $this->uri->segment(2) == 'art_post')) { ?>
   <div class="header animated fadeInDownBig">
    <?php
}
else{
  ?>
<div class="header">
  <?php
}
    ?>
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-sm-5 col-xs-5 mob-zindex">
               <div class="logo">
                  <a tabindex="-200" href="<?php echo base_url('dashboard') ?>">
                     <h2  style="color: white;">Aileensoul</h2>
                  </a>
               </div>
            </div>
            <?php
               $userid = $this->session->userdata('aileenuser');
               if ($userid) {
                   ?>
            <div class="col-md-8 col-sm-7 col-xs-7 header-left-menu">
               <div class="main-menu-right">
                  <ul class="">
                     <li id="a_li">
                        <a id="alink" class="action-button shadow animate dropbtn_common"  <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add-post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>onclick="return leave_page(5)" <?php } ?>> <span class="all"></span></a>
                        <div id="acon"  class="dropdown2_content">
                           <div id="atittle">Profiles <a href="<?php echo base_url('dashboard') ?>" class="fr">All</a></div>
                           <div id="abody" class="as">
                              <ul>
                                 <li>
                                    <div class="all-down">
                                       <a href="<?php echo base_url('job'); ?>">
                                          <div class="all-img">
                                             <img src="<?php echo base_url('img/i1.jpg') ?>">
                                          </div>
                                          <div class="text-all">
                                             Job Profile
                                          </div>
                                       </a>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="all-down">
                                       <a href="<?php echo base_url('recruiter'); ?>">
                                          <div class="all-img">
                                             <img src="<?php echo base_url('img/i2.jpg') ?>">
                                          </div>
                                          <div class="text-all">
                                             Recruiter Profile
                                          </div>
                                       </a>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="all-down">
                                       <a href="<?php echo base_url('freelancer'); ?>">
                                          <div class="all-img">
                                             <img src="<?php echo base_url('img/i3.jpg') ?>">
                                          </div>
                                          <div class="text-all">
                                             Freelance Profile
                                          </div>
                                       </a>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="all-down">
                                       <a href="<?php echo base_url('business-profile'); ?>">
                                          <div class="all-img">
                                             <img src="<?php echo base_url('img/i4.jpg') ?>">
                                          </div>
                                          <div class="text-all">
                                             Business Profile
                                          </div>
                                       </a>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="all-down">
                                       <a href="<?php echo base_url('artistic'); ?>">
                                          <div class="all-img">
                                             <img src="<?php echo base_url('img/i5.jpg') ?>">
                                          </div>
                                          <div class="text-all">
                                             Artistic Profile
                                          </div>
                                       </a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </li>
                     <!-- general notification start -->
                     <li id="notification_li">
                        <a class="action-button shadow animate dropbtn_common" href="javascript:void(0)" id="notificationLink" onclick = "return Notificationheader();"><em class="hidden-xs"></em> <i class="header-icon-notification "></i>
                        <span id="notification_count"></span>
                        </a>
                        <div id="notificationContainer"  class="dropdown2_content">
                           <div id="InboxBody" class="Inbox">
                              <div id="notificationTitle">Notifications <span class="see_link" id="seenot"></span></div>
                              <div class="content mCustomScrollbar light notifications" id="notification_main_in" data-mcs-theme="minimal-dark">
                                 <div>
                                    <ul class="notification_data_in">
                                       <div class="fw" id="gen_not_loader" style="text-align:center;"><img src="<?php echo base_url('images/loader.gif?ver='.time()) ?>" /></div>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <!-- general notification end -->
                     <!-- BEGIN USER LOGIN DROPDOWN -->
                     <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                     <li class="dropdown dropdown-user">
                        <a class="dropbtn action-button shadow animate dropbtn_common" href="javascript:void(0)" type="button" id="menu1" data-toggle="dropdown" >
                           <!-- <div id="hi" class="notifications"> -->
                           <?php if ($userdata[0]['user_image'] != '') { ?>
                           <div id="profile-photohead" class="profile-head">
                           <img alt="" class="img-circle" src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" height="50" width="50" alt="Smiley face" />
                         </div>

                           <?php
                              } else {
                              
                                  $a = $userdata[0]['first_name'];
                                  $acr = substr($a, 0, 1);
                                  ?>
                                  <div id="profile-photohead" class="profile-head">
                           <div class="custom-user">
                              <?php echo ucfirst(strtolower($acr)); ?>
                           </div>

                         </div>
                           <?php } ?>
                           <span class="u2 username username-hide-on-mobile hidden-xs"> <?php
                              if (isset($userdata[0]['first_name'])) {
                                  echo $userdata[0]['first_name'];
                              }
                              ?> </span>
                           <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu dropdown2_content" role="menu" aria-labelledby="menu1" id="myDropdown">
                           <li class="my_account">
                              <div class="my_S">Account</div>
                           </li>
                           <li class="Setting">
                              <a href="<?php echo base_url('profile') ?>">
                              <i class="fa fa-cog" aria-hidden="true"></i> Setting</a> 
                           </li>
                           <li class="logout">
                              <?php if (($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'add-post') || ($this->uri->segment(1) == 'recruiter' && $this->uri->segment(2) == 'edit_post') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'add-projects') || ($this->uri->segment(1) == 'freelancer-hire' && $this->uri->segment(2) == 'edit-projects')) { ?>
                              <a  onclick="return leave_page(8)">
                              <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                              <?php } else { ?>
                              <a href="<?php echo base_url('dashboard/logout') ?>">
                              <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a> 
                              <?php } ?>
                              <!--Logout-->
                           </li>
                        </ul>
                        <!--  </div> -->
                     </li>
                     <!-- END USER LOGIN DROPDOWN -->
                  </ul>
               </div>
            </div>
            <?php } ?>
         </div>
      </div>
   </div>
</header>
<!-- header end -->