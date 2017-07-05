     <head> 
       <link rel="stylesheet" type="text/css" href="css/style_login.css">
       <link rel="stylesheet" type="text/css" href="css/common-style.css">
       <link rel="stylesheet" type="text/css" href="css/media.css">
     </head>



<body class="main_bdy_c">
<header>
    
        <div class="header3">
    <div class="container">
    <div class="row">
  <div class="col-md-6 col-sm-5">
                        <div class="logo"><a href="<?php echo base_url('main') ?>"><!-- <img src="<?php// echo base_url('images/logo.png'); ?>"> --> <span >Aileensoul</span></a></div>
                    </div>
 
           <div class="col-md-6 col-sm-7 header-left-menu">
                   <ul class="fr">
                    <li class=""><a class="login_butn"  href="<?php echo base_url('login') ?>">Login</a></li>
                    <li class=""><a class="crt_butn button6"  href="<?php echo base_url('registration') ?>">Create an account</a></li>
                      
                    </ul>

                                <!-- Friend Request End-->

                                <!-- END USER LOGIN DROPDOWN -->
                        </div>
    </div>    
    </div>
     
    </div>


</header>
   <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="contus">
            <div class="abt_a">
              <h1><span>SEND US FEEDBACK</span></h1>
            </div>
                 <?php echo form_open_multipart(base_url('feedback/feedback_insert'),array('id' => 'feedbackform','name' => 'feedbackform','class' => "clearfix")); ?>
<!--                 <form id="feedbackform " class="clearfix" method="post" enctype="multipart/form-data" action="<?// echo base_url('feedback/feedback_insert'); ?>">-->
                 <fieldset class="col-md-12 par-3">
                 <div class="contactx">
                     <input type="text"  name="contact_email" id="contact_email" placeholder="Enter  Email"> <span id="contact_email-error"> </span>
                 </div>
                </fieldset>
                 <fieldset class="col-md-12 par-3">
               <div class="contactx">
                    <input type="text" name="contact_subject" id="contact_subject" placeholder="Enter Subject"> <span id="contact_subject-error"> </span></div>
                </fieldset>
                <fieldset class="col-md-12 par-3">
                <div class="contactx">
                
                     <textarea name="contact_message" class="description " id="contact_message" placeholder="Message*"></textarea>
                </div>
                </fieldset>
              
                <fieldset class="btnsa" style="float: right;">
                <button>Submit</button>    
                </fieldset>
                 </form>
            </div>
          </div> 
</div>           
</div>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="padding-bottom: 1px!important; padding: 12px;">
                <div class="footer-menu pull-left">
                    <p style="color: #fff;">&copy; 2017 | by <a href="#" style="color: #fff;">Aileensoul</a></p>
                </div>
                </div>
                <div class="col-md-6">
                <div class="footer-menu pull-right">
                    <nav>
                        <ul>
                          <li> <b><a class="" href="<?php echo base_url('about_us'); ?>">About Us</a> </b></li>
                                    <li> <b><a class="" href="<?php echo base_url('contact_us'); ?>">Contact Us</a> </b></li>
                                    <li><b><a class="" href="javascript:void(0);">Blog</a> </b></li>
                                    <li> <b><a class="" href="<?php echo base_url('feedback'); ?>">Send Us Feedback</a> </b></li>
                        </ul>
                    </nav>
                </div>
                </div>
            </div>
        </div>
        </footer>
</body>

<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>


<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#feedbackform").validate({ 

                    rules: { 

                        contact_email: {

                            required: true,
                            email: true,

                        },


                        contact_subject: {
                            required: true,
                            
                        },

                        contact_message: {
                            required: true,
                            
                        },

                         },

                    messages: {

                        contact_email: {

                            required: "Email Is Required.",
                            email: "Type email in valid format",
                            
                        },

                        

                        contact_subject: {
                            required: "Subject is required",
                            
                        },

                        contact_message: {
                            required: "Description is required",
                            
                        },
                        

                    },

                });
                   });
  </script>

</html>

<style type="text/css">
  
  
  #contact_email-error{margin-top: 46px;margin-right: 5px;}
  #contact_subject-error{margin-top: 48px;margin-right: 5px;}
  #contact_message-error{margin-top: 160px;margin-right: 5px;}
</style>