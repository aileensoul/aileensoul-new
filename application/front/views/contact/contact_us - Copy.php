<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->

<body>
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-5">
                        <div class="logo"><a href="<?php echo base_url(); ?>"><img src="../images/logo-white.png"></a></div>
                    </div>
                    <div class="col-md-8 col-sm-7">

                    </div>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">


                        <div class="common-form">
                            <h3>Contact Us</h3>
                            <?php echo form_open(base_url('contact_us/contact_us_insert'), array('id' => 'contact_regform', 'name' => 'contact_regform', 'class' => 'clearfix')); ?>

                            <fieldset>
                                <label>Name<span style="color:red">*</span></label>
                                <input type="text" name="contact_name" id="contact_name" placeholder="Enter Name"> <span id="contact_name-error"> </span>
                                <?php echo form_error('contact_name'); ?>
                            </fieldset>



                            <fieldset>
                                <label>E-mail<span style="color:red">*</span></label>
                                <input type="text" name="contact_email" id="contact_email" placeholder="Enter  Email"> <span id="contact_email-error"> </span>
                                <?php echo form_error('contact_email'); ?>
                            </fieldset>

                            <fieldset>
                                <label>Subject<span style="color:red">*</span></label>
                                <input type="text" name="contact_subject" id="contact_subject" placeholder="Enter Subject"> <span id="contact_subject-error"> </span>
                                <?php echo form_error('contact_subject'); ?>
                            </fieldset>

                            <!--  <fieldset class="full-width contact_textarea">
                                 <label>Message<span style="color:red">*</span></label>
              
                                 <textarea name="contact_message" id="contact_message" class="" placeholder="Enter Message" style="height: 25%;"> 
                                 </textarea>
                            <?php //echo form_error('contact_message'); ?>
                               
              
                            </fieldset> -->
                            <fieldset class="full-width">
                                <label>Message<span style="color:red">*</span></label>

                                <textarea name="contact_message" class="description valid" id="contact_message" placeholder="Enter Description" style="height: 25%;" > </textarea>
                                <?php echo form_error('contact_message'); ?>



                            </fieldset>
                            <!-- 
                                       <span id="contact_message-error"> </span>
                            -->

                            <fieldset class="hs-submit full-width">
                                <input type="submit"  id="submit" name="submit" value="submit">

                            </fieldset>

                            </form>
                        </div>

                        <!--    <h2>Address</h2>
             
                                              <div class="form-group">
                                                 <label class="col-sm-7 col-md-7 control-label"><?php echo $cnt[0]['site_address']; ?></label>
                                               </div>
                                                 
                                             <div class="form-group">
                                                 <label class="col-sm-7 col-md-7 control-label"><?php echo $cnt[0]['site_email']; ?></label>
                                               </div>
             
                                               <div class="form-group">
                                                 <label class="col-sm-7 col-md-7 control-label"><?php echo $cnt[0]['site_mobile']; ?></label>
                                               </div>
             
                                               <div class="form-group">
                                                 <label class="col-sm-7 col-md-7 control-label"><?php echo $cnt[0]['site_url']; ?></label>
                                               </div>
                        -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="">
    <div class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-logo">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>images/logo-white.png"></a>
                    </div>
                    <ul>
                        <li> Ahmedabad-380015</li>
                        <li><a href="mailto:AileenSoul@gmail.com">AileenSoul@gmail.com</a></li>
                        <li><?php echo $cnt[0]['site_email']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <p><i class="fa fa-copyright" aria-hidden="true"></i> 2017 All Rights Reserved </p>
                </div>
                <div class="col-md-6 col-sm-6">
                    <!-- <ul>
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
