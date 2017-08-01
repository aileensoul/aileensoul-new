<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<?php echo $business_header2_border ?>
<body class="page-container-bg-solid page-boxed">

    <?php echo $dash_header; ?>
    <!-- BEGIN HEADER MENU -->
    <?php echo $dash_header_menu; ?>

    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<style type="text/css">
    .ani
    {
        transition: all 0.1s;
        -webkit-transition: all 0.1s;
    }

    .acbutton
    {
        position: relative;
        padding: 10px 40px;
        margin: 0px 10px 10px 0px;
        float: left;
        border-radius: 10px;
        font-family: 'Pacifico', cursive;
        font-size: 25px;
        color: #FFF;
        text-decoration: none;  
    }
    .acbutton:active
    {
        transform: translate(0px,5px);
        -webkit-transform: translate(0px,5px);
        border-bottom: 1px solid;
    }
</style>

        <div class="col-md-4 col-xs-12  hidden-md hidden-sm hidden-lg pt1201 ">
                <div class="common-form ">
                <div class="main_cqlist-1"> 
                    <div class="contact-list ">
                        <h3 class="list-title">Contact Request Notifications</h3>
                        <div class="noti_cq">
                            
                             <div class="cq_post">
        <ul>


       <?php if ($friendlist_con) { //echo "hii";
                                foreach ($friendlist_con as $friend) {
                                
                                    ?>


                                    <?php
                                    $userid = $this->session->userdata('aileenuser');


                                    if ($friend['contact_from_id'] == $userid) {
                                        ?>
          <li> 
          <div class="cq_main_lp">
          <div class="cq_latest_left">
            <div class="cq_post_img">

              <?php if ($friend['business_user_image'] != '') { ?>
               <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $friend['business_user_image']); ?>">
                        </a>
             <?php } else { ?>
              <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                    <img src="<?php echo base_url(NOIMAGE); ?>" />
                    </a>
                <?php } ?>
                                                            

            </div>
          </div>  
            <div class="cq_latest_right">
            <div class="cq_desc_post">
              <sapn class="rifght_fname">  
               <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
              <span class="main_name">
              <?php echo ucfirst(strtolower($friend['company_name'])); ?> 
              </span>
              </a>
              <span style="color: #8c8c8c;">confirmed your contact request .</span>
              </sapn>
            </div>
          
            <div class="cq_desc_post">
              <sapn class="cq_rifght_desc">  <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($friend['modify_date'])));  ?> </sapn>
            </div>  
            </div>



          </div>

          </li>
        <?php } } }else{?>

         <li>
          <div class="cq_main_lp">
         No contact request  available...
         </div>
         </li>
        <?php }?>
        </ul>
      </div>
                        </div>
                    </div>  
                    </div>
            </div>
</div>
<div class="user-midd-section" id="paddingtop_fixed pt_mn">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-7 pt120 pt_mn2">
                <div class="common-form main_cqlist">

                    <div class="contact-list">
                        <h3 class="list-title list-title2"> Contact Request</h3>

                    </div>  
                    <div class="all-list">
                        <ul  id="contactlist">
                            <?php
                            if ($friendlist_req) {
                                foreach ($friendlist_req as $friend) {
                                    $inddata = $this->common->select_data_by_id('industry_type', 'industry_id', $friend['industriyal'], $data = '*', $join_str = array());
                                    ?>


                                    <?php
                                    $userid = $this->session->userdata('aileenuser');


                                    if ($friend['contact_to_id'] == $userid) {
                                        ?>
                                        <li id="<?php echo $friend['contact_from_id']; ?>">
                                            <div class="list-box">
                                                <div class="profile-img">
                                                    <?php if ($friend['business_user_image'] != '') { ?>
                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $friend['business_user_image']); ?>">
                                                        </a>
                                                    <?php } else { ?>
                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                        <img src="<?php echo base_url(NOIMAGE); ?>" />
                                                        </a>
                                                    <?php } ?>
                                                            <!--<img src="http://localhost/aileensoul/uploads/user_profile/thumbs/images_(4).jpg">-->
                                                </div>
                                                <div class="profile-content">
                                                    <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                                                      <div class="main_data_cq">   <span title="<?php echo $friend['company_name']; ?>" class="main_compny_name"><?php echo $friend['company_name']; ?></span></div>
                                                      <div class="main_data_cq">

                                                      <?php if($inddata[0]['industry_name']){?>
                                                        <span class="dc_cl_m"   title="<?php echo $inddata[0]['industry_name']; ?>"> <?php echo $inddata[0]['industry_name']; ?></span>
                                                        <?php }else{?>

                                                         <span class="dc_cl_m"   title="<?php echo $friend['other_industrial']; ?>"> <?php echo $friend['other_industrial']; ?></span>
                                                        <?php }?>
                                                        </div>
                                                    </a>
                                                    </span>

                                                </div>
                                                <div class="fw">
                                                    <p class="connect-link">
                                                        <a href="#" class="cr-accept acbutton  ani" onclick = "return contactapprove(<?php echo $friend['contact_from_id']; ?>, 1);"><span class="cr-accept1"><i class="fa fa-check" aria-hidden="true"></i>
 </span></a>
                                                        <a href="#" class="cr-decline" onclick = "return contactapprove(<?php echo $friend['contact_from_id']; ?>, 0);"><span class="cr-decline1"><i class="fa fa-times" aria-hidden="true"></i>
 </span></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>

                                    <?php } ?>

                                <?php }
                            } else { //echo "hi"i; die();
                                ?>
                                <li>
                               
                                No contacts available...
                              
                                </li>

<?php } ?>
                        </ul>
                    </div>        
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <div class="col-md-4 col-sm-5 pt120 hidden-xs ">
                <div class="common-form ">
                <div class="main_cqlist-1"> 
                    <div class="contact-list ">
                        <h3 class="list-title">Contact Request Notifications</h3>
                        <div class="noti_cq">
                            
                             <div class="cq_post">
        <ul>


       <?php if ($friendlist_con) { //echo "hii";
                                foreach ($friendlist_con as $friend) {
                                
                                    ?>


                                    <?php
                                    $userid = $this->session->userdata('aileenuser');


                                    if ($friend['contact_from_id'] == $userid) {
                                        ?>
          <li> 
          <div class="cq_main_lp">
          <div class="cq_latest_left">
            <div class="cq_post_img">

              <?php if ($friend['business_user_image'] != '') { ?>
               <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                        <img src="<?php echo base_url($this->config->item('bus_profile_thumb_upload_path') . $friend['business_user_image']); ?>">
                        </a>
             <?php } else { ?>
              <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
                    <img src="<?php echo base_url(NOIMAGE); ?>" />
                    </a>
                <?php } ?>
                                                            

            </div>
          </div>  
            <div class="cq_latest_right">
            <div class="cq_desc_post">
              <sapn class="rifght_fname">  
               <a  href="<?php echo base_url('business_profile/business_profile_manage_post/' . $friend['business_slug']); ?>">
              <span class="main_name">
              <?php echo ucfirst(strtolower($friend['company_name'])); ?> 
              </span>
              </a>
              <span style="color: #8c8c8c;">confirmed your contact request .</span>
              </sapn>
            </div>
          
            <div class="cq_desc_post">
              <sapn class="cq_rifght_desc">  <?php echo $this->common->time_elapsed_string(date('Y-m-d H:i:s', strtotime($friend['modify_date'])));  ?> </sapn>
            </div>  
            </div>



          </div>

          </li>
        <?php } } }else{?>

         <li>
          <div class="cq_main_lp">
         No contact request  available...
         </div>
         </li>
        <?php }?>
        </ul>
      </div>
                        </div>
                    </div>  
                    </div>
            </div>
</div>
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE BREADCRUMBS -->
                <!-- <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Layouts</span>
                    </li>
                </ul> -->
                <!-- END PAGE BREADCRUMBS -->
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<?php echo $footer; ?>

<!-- script for update all read notification start-->
<script type="text/javascript">


    function contactperson() {

        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/contact_notification",
            type: "POST",
            success: function (data) {

                $('#addcontactBody').html(data);

            }
        });

    }

    function contactapprove(toid, status) {

        $.ajax({
            url: "<?php echo base_url(); ?>business_profile/contact_list_approve",
                type: "POST",
                        data: 'toid=' + toid + '&status=' + status,
            success: function (data) {
                        //document.getElementById(toid).remove();
                            $('#contactlist').html(data);

            }
        });

                        }

</script>
<!-- script for update all read notification end -->


<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#tags1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#tag1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#tags1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#searchplace1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data1, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>

          <script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>