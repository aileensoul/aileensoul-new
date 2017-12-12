<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->

<body class="page-container-bg-solid page-boxed">

    <?php echo $dash_header; ?>
    <!-- BEGIN HEADER MENU -->
    <?php echo $dash_header_menu; ?>

    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<style type="text/css">
    #noti_pc{ margin-bottom: 5px;
    border-radius: 50%;
    margin-left: 10px;
    display: inline-block;
    
    margin-top: 5px;   }
    .job-saved-box .notification-box ul li{display: flex!important;}
    #notification_inside{ margin-left: 0px; margin-top: 0px;   padding: 5px 10px 9px 10px;
    margin-left: 11px;
    display: inline-block;}
    #noti_pc img{border-radius: none;}
      #notification_inside h6{font-size: 17px;}
</style>
<div class="user-midd-section" id="paddingtop_fixed">
    <div class="container">
        <div class="row">
            <div class="col-md-1 col-sm-1">
            </div>
            <div class="col-md-10 col-sm-10" style="padding-bottom: 60px;">
                <div class="common-form">

                    <div class="job-saved-box">
                        <h3 style="    -webkit-box-shadow: inset 0px 1px 0px 0px #ffffff;
    box-shadow: inset 0px 1px 0px 0px #ffffff;
    border-bottom: 1px solid #d9d9d9;
    padding-left: 24px;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
    background: -moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: -ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
    background: linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
    background-color: #f9f9f9;font-weight: normal;
    color: #5c5c5c;">View Notification</h3>

                        <!-- BEGIN CONTAINER -->
                        <!--  <div class="page-container">
                        -->     <!-- BEGIN CONTENT -->
                        <!--  <div class="page-content-wrapper">
                        -->     <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <!-- <div class="page-head">
                        --> <!--        <div class="container">
                        -->           <!-- BEGIN PAGE TITLE -->
                        <!--                 <div class="page-title">
                        -->                  <!--   <h1>Notification List</h1>
                        -->
                        <!--         <div id="notificationsBody" class="notifications">
        <div class="notification-data">
          <ul> -->
                        
                        <div class="notification-box bg">

                           
                            <div class="common-form">
                           <div class="">

<?php   //if(count($totalnotification) == 0){?>
<!--                              <div class="all-box">
                                 <ul>
                                    <div class="main_pdf_box">
                                       <div class=" ">
                                          <img src="img/icon_notification_big.png">
                                          <div>
                                             <div class="not_txt"> No Notifications</div>
                                          </div>
                                       </div>
                                    </div>
                                    </ul>
                              </div>
                             -->
                              <?php// }?>
                             
                           </div>
                        </div>



                        <div class="contact-frnd-post">
                            <ul class="notification_data">
                              <!--AJAX DATA GET BY LAZZY LOADER START-->
                            </ul>
                             <div class="fw" id="loader" style="text-align:center;"><img src="<?php echo base_url('assets/images/loader.gif?ver='.time()) ?>" /></div>
                        </div>  
                        </div>  

                    </div>
                </div>  

            </div>           </div>
        <!-- END PAGE TITLE 
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
<?php echo $login_footer ?>
<?php echo $footer; ?>
 <script>
                                                                                var base_url = '<?php echo base_url(); ?>';
  </script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/notification/notification.js'); ?>"></script>
<script type="text/javascript">
   function not_active(not_id)
   { 
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "notification/not_active" ?>',
           data: 'not_id=' + not_id,
           success: function (data) {
              }
          });
      }
   
</script>
    