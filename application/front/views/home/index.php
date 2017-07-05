

<?php echo '<pre>'; print_r($data); die(); ?>


<!--head start-->
<?php echo $head; ?>
<!--head end-->
<!--header start-->
<?php echo $header; ?>

<!--header end-->

 <!--banner start-->
        <div class='banner'>
            <div class='container'>
                 <?php echo form_open(base_url('home/register'), array('class' => 'form-vertical', 'id' => 'registerForm')); ?>
      
                <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                    <div class='parallelogram'>
                       
                        <h3>SELLER REGISTRATION</h3>
                        <input type='email' placeholder="Email Address*" name="store_email" value="" class="">
                        <div class="clearfix"></div>
<?=form_error('store_email')?>
                        <input type='text' placeholder="Full Name*" name="store_fullname" value="" class="">
                        <div class="clearfix"></div>
<?=form_error('store_fullname')?>
                        <input type='text' placeholder="Mobile Number*" name="store_sellerno" value="" class="">
<?=form_error('store_sellerno')?>
                        <input type='password' placeholder="Password*" name="store_password" class="">
<?=form_error('store_password')?>
        <!--                <a href='javascript:void(0)' onclick="register();"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Start Selling</a>-->
                        <button type="submit" name="SubmitCreate" id="SubmitCreate" class="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Start Selling</button>
                    </div>
                </form>
            </div>
        </div>
        <!--banner end-->
        <!--content start-->
        <section><!--section 1 start-->
            <div class='e-com'>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-12 text-center icon_head'>
                            <h2>Grow your business with the leader in Indian e-Commerce.</h2>
                        </div>
                    </div>
                    <div class='row text-center icon_content'>
                        <div class='col-sm-4 con_icon'>
                            <img src="<?php echo base_url('images/icon_2.gif'); ?>" />
                            <h1>7.2 CRORE</h1>
                            <h5>Customer looking to buy your product </h5>
                        </div>
                        <div class='col-sm-4 con_icon'>
                            <img src="<?php echo base_url('images/icon_1.gif'); ?>"/>
                            <h1>90000+</h1>
                            <h5>Business growing rapidly with us. </h5>
                        </div>
                        <div class='col-sm-4 con_icon'>
                            <img src="<?php echo base_url('images/icon_3.gif'); ?>"/>
                            <h1>15 DAYS</h1>
                            <h5>to process  your payments </h5>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--section 1 end-->
        <section><!--section 2 start-->
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 text-center sec_content'>
                        <h2>Why sellers love us</h2>
                    </div>
                </div>
                <div class='row text-left text_content'>
                    <div class='col-sm-4 con_text'>                           
                        <h1>Lots Of Business </h1>
                        <ul>
                            <li>Most trusted Mobile commerce platform</li>
                            <li>80 millions Customers</li>
                            <li>Wide reach, servicing 39k pin codes across India</li>
                            <li>Free listing</li>
                        </ul>
                    </div>
                    <div class='col-sm-4 con_text'>                           
                        <h1>Self Serve & easy to use</h1>
                        <ul>
                            <li>Most trusted Mobile commerce platform</li>
                            <li>80 millions Customers</li>
                            <li>Wide reach, servicing 39k pin codes across India</li>
                            <li>Free listing</li>
                        </ul>
                    </div>
                    <div class='col-sm-4 con_text'>                           
                        <h1>Incredible support </h1>
                        <ul>
                            <li>Most trusted Mobile commerce platform</li>
                            <li>80 millions Customers</li>
                            <li>Wide reach, servicing 39k pin codes across India</li>
                            <li>Free listing</li>
                        </ul>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-sm-12 text-center sec_content2'>
                        <h2>Doing Business In Laceberry Is Really Easy</h2>
                    </div>
                </div>
            </div>
        </section><!--section 2 end-->
        <section><!--section 3 start-->
            <div class='business_step'>
                <div class='container'>
                    <div class='row text-center process'>
                        <!--                    <div class='process_step1 steps'>
                                            <h4>STEP 1:</h4>
                                            <h3>List Your Products</h3>
                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                        </div>
                                            <div class='process_step2 steps'>
                                            <h4>STEP 2:</h4>
                                            <h3>Sell Across India</h3>
                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                        </div>
                                            <div class='process_step3 steps'>
                                            <h4>STEP 3:</h4>
                                            <h3>Ship With Ease</h3>
                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                        </div>
                                            <div class='process_step4 steps'>
                                            <h4>STEP 4:</h4>
                                            <h3>Earn Big</h3>
                                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                        </div>-->
                        <img src='images/Proccess Step.jpg'/>                    
                    </div>

                </div>
            </div>
        </section><!--section 3 end-->
        <!--content end-->
         


          

</div>

<!--footer start-->
 <?php echo $footer ?> 
<!--footer end-->
 <script type="text/javascript" src="js/jquery.min.js"></script>


<script language="javascript" type="text/javascript">
            $(document).ready(function () { 
                $('.alert-danger').delay(3000).hide('700');
                $('.alert-success').delay(3000).hide('700');
            });
        </script>

        
 
 </body>
 </html>