
<!DOCTYPE html>
<html>
   <head>
<!-- start head -->
<?php echo $head; ?>
<!-- Calender Css Start-->

 <title>Artist Profile - Aileensoul.com</title>

<!-- Calender Css End-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/job.css?ver='.time()); ?>">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/artistic.css?ver='.time()); ?>">
<!-- This Css is used for call popup -->

</head>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<!-- END HEADER -->
<body>
   <section>
      <div class="user-midd-section " id="paddingtop_fixed">
         <div class="container">
            <div class="row">
               <div class="col-md-3"></div>
               <div class="clearfix">
                  <div class="job_reg_page_fprm">
                      
                     <div class="common-form job_reg_main">
                        <h3>Welcome In Artist Profile</h3>

                        <?php echo form_open(base_url('artist/profile_insert'), array('id' => 'artinfo','name' => 'artinfo','class' => 'clearfix', 'onsubmit' => "return validation_other(event)")); ?>

                        <fieldset>
                           <label >First Name <font  color="red">*</font> :</label>                          
                           <input type="text" name="firstname" id="firstname" tabindex="1" placeholder="Enter first name" style="text-transform: capitalize;" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" value="<?php echo $userdata[0]['first_name']; ?>" maxlength="35">
                           <?php echo form_error('firstname');; ?>
                        </fieldset>
                        <fieldset>
                           <label >Last Name <font  color="red">*</font>:</label>
                           <input type="text" name="lastname" id="lastname" tabindex="2" placeholder="Enter last name" style="text-transform: capitalize;" onfocus="this.value = this.value;" value="<?php echo $userdata[0]['last_name']; ?>" maxlength="35">
                           <?php echo form_error('lastname');; ?>
                        </fieldset>
                        <fieldset>
                           <label >Email Address <font  color="red">*</font> :</label>
                           <input type="email" name="email" id="email" tabindex="3" placeholder="Enter email address" value="<?php echo $userdata[0]['user_email'];?>" maxlength="255">
                           <?php echo form_error('email');; ?>
                        </fieldset>
                        <fieldset>
                           <label >Phone number:</label>
                           <input type="text" name="phoneno" id="phoneno" tabindex="4" placeholder="Enter phone number" value="<?php echo $job[0]['user_email'];?>" maxlength="255">
                           <?php echo form_error('email');; ?>
                        </fieldset>

                        <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
								<label>Country:<span style="color:red">*</span></label>								
        								<select name="country" id="country" tabindex="5">
            							<option value="">Select country</option>
            							<?php
                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){  ?>
                            <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name'];?></option>
                                    <?php                                            
                                          }       
                                            }
                                            ?>
        							</select><span id="country-error"></span>
							     <?php echo form_error('country'); ?>
    					</fieldset> 

    					<fieldset <?php if($state) {  ?> class="error-msg" <?php } ?>>
								    <label>state:<span style="color:red">*</span></label>
    								<select name="state" id="state" tabindex="6">
        							<?php
                                          if($state1)
                                            {
                                            foreach($states as $cnt){  ?>
                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$state1) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
                                                <?php
                                                } }                                             
                                               else
                                                {
                                            ?>
                                                 <option value="">Select country first</option>
                                                  <?php                                            
                                            }
                                            ?>
								    </select><span id="state-error"></span>
                                     <?php echo form_error('state'); ?>
						</fieldset> 

						<fieldset <?php if($city) {  ?> class="error-msg" <?php } ?>>
								    <label> City:<span style="color:red">*</label>
									<select name="city" id="city" tabindex="7">
    								<?php
                                         if($city1)
                                            {
                                          foreach($cities as $cnt){                                              
                                              ?>
                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$city1) echo 'selected';?>><?php echo $cnt['city_name'];?></option>
                                                <?php
                                                } }
                                                else if($state1)
                                             {
                                            ?>
                                            <option value="">Select city</option>
                                            <?php
                                            foreach ($cities as $cnt) {
                                                ?>
                                                <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>
                                                <?php
                                            }
                                        }                                              
                                                else
                                                {
                                            ?>
                                        <option value="">Select state first</option>
                                         <?php                                          
                                            }
                                            ?>
									</select><span id="city-error"></span>
                                    <?php echo form_error('city'); ?>
								</fieldset>                              
                
                					<fieldset class="full-width art-cat-custom <?php if($skills) {  ?> error-msg <?php } ?>">
                                        <label>Art category:<span style="color:red">*</span></label>

                          <select name="skills[]" id="skills" multiple>
                         <!--  <option value="">Ex:- Dancer, Photographer, Writer, Singer, Actor</option> -->
                            <?php                             
                                      foreach($art_category as $cnt){ 
                                          if($art_category1)
                                            { 
                                              $category = explode(',' , $art_category1);  
                                              ?>
                                                 <option value="<?php echo $cnt['category_id']; ?>"
                                                  <?php if(in_array($cnt['category_id'], $category)) echo 'selected';?>><?php echo ucwords(ucfirst($cnt['art_category']));?></option>              
                                                 <?php
                                                }
                                                else
                                                {  
                                            ?>
                            <option value="<?php echo $cnt['category_id']; ?>"><?php echo ucwords(ucfirst($cnt['art_category']));?></option>
                                <?php    }       
                                            }
                                            ?>
                      </select>
                                    
                                        <?php echo form_error('skills'); ?>
                         </fieldset>
                                    <?php if($othercategory1){?>
                                    <div id="other_category" class="other_category" style="display: block;">
                                      <?php }else{ ?>
                                      <div id="other_category" class="other_category" style="display: none;">
                                      <?php }?>
                                    <fieldset class="full-width <?php if($artname) {  ?> error-msg <?php } ?>">
                                    <label>Other category:<span style="color:red">*</span></label>
                                    <input name="othercategory"  type="text" id="othercategory" tabindex="2" placeholder="Other category" value="<?php if($othercategory1){ echo $othercategory1; } ?>" onkeyup= "return removevalidation();"/><!-- <span id="artname-error"></span> -->
                                     <?php echo form_error('othercategory'); ?>
                                 </div>
                                   </fieldset>

                        <fieldset class=" full-width">
                           <div class="job_reg">
                              <!--<input type="reset">-->
                              <!-- <input tabindex="9" title="Register" type="submit" id="submit" name="btnsubmit" value="Register">
 -->

                                    <input type="submit"  id="next" name="next" value="Register" tabindex="9" onclick="return validate();">

                           </div>
                        </fieldset>
                        <?php echo form_close();?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- END CONTAINER -->

    <!-- Bid-modal  -->
      <div class="modal fade message-box biderror custom-message in" id="bidmodal" role="dialog"  >
         <div class="modal-dialog modal-lm" >
            <div class="modal-content message">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
               <div class="modal-body">
                  <span class="mes"></span>
               </div>
            </div>
         </div>
      </div>
      <!-- Model Popup Close -->


<!-- <footer>        -->
<?php echo $login_footer ?> 
<?php echo $footer;  ?>
<!-- </footer> -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()) ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.multi-select.js?ver=' . time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/artistic_common.js?ver='.time()); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artist/profile.js?ver='.time()); ?>"></script>
 <script>
     var base_url = '<?php echo base_url(); ?>';  
 </script>
</body>
</html>