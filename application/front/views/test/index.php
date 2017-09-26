<!DOCTYPE html>
<html class="no-js"> 
    <head>
        
         <title><?php echo $title; ?></title>
        <?php echo $head; ?>
         
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
       <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/recruiter/recruiter.css'); ?>">
        
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('stepform/css/normalize.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('stepform/css/main.css') ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('stepform/css/jquery.steps.css') ?>" />
        
         <script type="text/javascript" src="<?php echo base_url('stepform/js/modernizr-2.6.2.min.js'); ?>"></script> 
         <script type="text/javascript" src="<?php echo base_url('stepform/js/jquery-1.9.1.min.js'); ?>"></script> 
         <script type="text/javascript" src="<?php echo base_url('stepform/js/jquery.cookie-1.3.1.js'); ?>"></script> 
         <script type="text/javascript" src="<?php echo base_url('stepform/js/jquery.steps.js'); ?>"></script> 
       
    </head>
    <body>
     <?php echo $header; ?>
        <?php if ($recdata[0]['re_step'] == 3) { ?>
            <?php echo $recruiter_header2_border; ?>
        <?php } ?>

        <!--<div id="preloader"></div>-->
        <section>

            <div class="user-midd-section" id="paddingtop_fixed">
<div class="common-form1">
                    <div class="col-md-3 col-sm-4"></div>

                    <?php
                    if ($recdata[0]['re_step'] == 3) {
                        ?>
                        <div class="col-md-6 col-sm-8"><h3>You are updating your Recruiter Profile.</h3></div>

                    <?php } else {
                        ?>
                        <div class="col-md-6 col-sm-8"><h3>You are making your Recruiter Profile.</h3></div>

                    <?php } ?>
                </div>
            </div>
            
              <div class="content">
          
            <script>
                $(function ()
                {
                    $("#wizard").steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft",
                        stepsOrientation: "vertical"
                    });
                });
            </script>

            <div id="wizard">
                <h2>First Step</h2>
                <section>
                     <?php echo form_open(base_url('recruiter/basic_information'), array('id' => 'basicinfo', 'name' => 'basicinfo', 'class' => 'clearfix')); ?>
                     <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>

							<div class="fw">
                                <fieldset>
                                    <label>First Name<span class="red">*</span>:</label>
                                    <input name="first_name" tabindex="1" autofocus type="text" id="first_name"  placeholder="Enter First Name" value="<?php
                                    if ($firstname) {
                                        echo trim(ucfirst(strtolower($firstname)));
                                    } else {
                                        echo trim(ucfirst(strtolower($userdata[0]['first_name'])));
                                    }
                                    ?>" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/><span id="fullname-error "></span>
                                           <?php echo form_error('first_name'); ?>
                                </fieldset>


                                <fieldset>
                                    <label>Last Name<span class="red">*</span> :</label>
                                    <input name="last_name" type="text" tabindex="2" placeholder="Enter Last Name"
                                           value="<?php
                                           if ($lastname) {
                                               echo trim(ucfirst(strtolower($lastname)));
                                           } else {
                                               echo trim(ucfirst(strtolower($userdata[0]['last_name'])));
                                           }
                                           ?>" id="last_name" /><span id="fullname-error" ></span>
                                           <?php echo form_error('last_name'); ?>
                                </fieldset>
							</div>
							<div class="fw">

                                <fieldset>
                                    <label>Email address:<span class="red">*</span></label>
                                    <input name="email"  type="text" id="email" tabindex="3" placeholder="Enter Email"  value="<?php
                                    if ($email) {
                                        echo $email;
                                    } else {
                                        echo $userdata[0]['user_email'];
                                    }
                                    ?>" /><span id="email-error" ></span>
                                           <?php echo form_error('email'); ?>
                                </fieldset>

                                <fieldset>
                                    <label>Phone number:</label>
                                    <input name="phoneno" placeholder="Enter Phone Number" tabindex="4" value="<?php
                                    if ($phone) {
                                        echo $phone;
                                    }
                                    ?>" type="text" id="phoneno"  /><span ></span>
                                           <?php echo form_error('phoneno'); ?>
                                </fieldset>

							</div>
                                <fieldset class="hs-submit full-width">


                                    <input type="submit"  id="next" name="next" tabindex="5" value="Next">


                                </fieldset>
 </form>
                </section>

                <h2>Second Step</h2>
                <section>
                    <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. 
                        In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum 
                        dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. 
                        In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. 
                        Donec non pulvinar urna. Aliquam id velit lacus.</p>
                </section>

            </div>
        </div>
        </section>
      <!-- BEGIN FOOTER -->
        <?php //echo $footer; ?>
        <!-- END FOOTER -->

        <!-- FIELD VALIDATION JS START -->
        <script src="<?php //echo base_url('js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
       <!--<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>-->
       <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            var data1 = <?php echo json_encode($de); ?>;
            var data = <?php echo json_encode($demo); ?>;
            var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
            var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
        </script>
        <!-- FIELD VALIDATION JS END -->
       <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/search.js'); ?>"></script>
       <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/basic_info.js'); ?>"></script>
    </body>
</html>