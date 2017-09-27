
   <?php $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if($pageWasRefreshed ) {
   echo $test_header;
} 
 ?> 
                            <!--- middle section start -->
                            <div id="screen">
                            <div class="common-form common-form_border">
                                <h3>Basic Information</h3>
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
                            </div>
                            </div>
 <?php if($pageWasRefreshed ) {
   echo $test_footer;
} ?>
       <script type="text/javascript" src="<?php echo base_url('js/webpage/recruiter/basic_info.js'); ?>"></script>
    <script>
            function ChangeUrl(title, url) {
                                                     if (typeof (history.pushState) != "undefined") {
                                                         var obj = {Title: title, Url: url};
                                                         history.pushState(obj, obj.Title, obj.Url);
                                                         $("#screen").load(url);
                                                     } else {
                                                         alert("Browser does not support HTML5.");
                                                     }
                                                 }
                                                 
                                                 </script>