<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?>  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css?ver='.time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css?ver='.time()); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/artistic/artistic.css?ver='.time()); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/common/mobile.css?ver='.time()) ;?>" />
    </head>
    <body class="page-container-bg-solid page-boxed">
    <?php echo $header; ?>
        <?php if ($artdata[0]['art_step'] == 4) { ?>
            <?php echo $art_header2_border; ?>
        <?php } ?>
 <div class="js">
  <div id="preloader"></div>
      <section>  
        <div class="user-midd-section" id="paddingtop_fixed">
           <div class="common-form1">
           <div class="row">
             <div class="col-md-3 col-sm-4"></div>
             <?php 
             $userid = $this->session->userdata('aileenuser');
             $contition_array = array('user_id' => $userid, 'status' => '1');
             $artdata = $this->common->select_data_by_condition('art_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');           
             if($artdata[0]['art_step'] == 4){ ?>
 <div class="col-md-6 col-sm-8"><h3>You are updating your Artistic Profile.</h3></div>
                <?php }else{
             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Artistic Profile.</h3></div>
                       <?php }?>
            </div>
            </div>        
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active init" <?php } ?>><a href="#">Basic Information</a></li>
                                <li class="custom-none <?php if($artdata[0]['art_step'] < '1'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/artistic-address'); ?>">Address</a></li>
                                <li class="custom-none <?php if($artdata[0]['art_step'] < '2'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/artistic-information'); ?>">Art Information</a></li>
                                <li class="custom-none <?php if($artdata[0]['art_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/artistic-portfolio'); ?>">Portfolio</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- middle section start --> 
                    <div class="col-md-6 col-sm-8">
                    <div>
                        <?php
                                        if ($this->session->flashdata('error')) {
                                            echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                        }
                                        if ($this->session->flashdata('success')) {
                                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                        }?>
                    </div>
                        <div class="common-form common-form common-form_border clearfix">
                         <h3>
                            Basic Information
                        </h3>                       
                           <?php echo form_open(base_url('artistic/art_basic_information_insert'), array('id' => 'artbasicinfo','name' => 'artbasicinfo', 'class' => 'clearfix')); ?>
                                <?php
                                 $firstname =  form_error('firstname');
                                 $lastname = form_error('lastname');
                                 $email =  form_error('email');
                                 $phoneno =  form_error('phoneno');
                                 
                         		?>
                               <fieldset <?php if($firstname) {  ?> class="error-msg" <?php } ?>>
                                    <label>First Name:<span style="color:red">*</span></label>
                                    <input name="firstname" tabindex="1" autofocus type="text" id="firstname" placeholder="Enter First Name" value="<?php if($firstname1){ echo $firstname1; } else { echo $art[0]['first_name']; }?>"/>
                                    <?php echo form_error('firstname'); ?>
                                </fieldset>                              
                                <fieldset <?php if($lastname) {  ?> class="error-msg" <?php } ?>>
                                    <label>Last Name:<span style="color:red">*</span></label>
                                    <input name="lastname" type="text" id="lastname" tabindex="2" placeholder="Enter Last Name" value="<?php if($lastname1){ echo $lastname1; } else { echo $art[0]['last_name']; } ?>"/>
                                    <?php echo form_error('lastname'); ?>
                                </fieldset>
                                <fieldset <?php if($email) {  ?> class="error-msg" <?php } ?>>
                                <?php $user_email = strtolower($art[0]['user_email']); ?>
                                    <label>E-mail address:<span style="color:red">*</span></label>
                                    <input name="email"  type="text" id="email" tabindex="3" placeholder="Enter E-mail Address" value="<?php if($email1){ echo $email1; } else { echo $user_email; } ?>">
                                     <?php echo form_error('email'); ?>
                                </fieldset>                             
                                <fieldset <?php if($phoneno) {  ?> class="error-msg" <?php } ?>>
                                    <label>Phone number:</label>
                                    <input name="phoneno"  type="text" id="phoneno" tabindex="4" placeholder="Enter Phone Number" value="<?php if($phoneno1){ echo $phoneno1; } ?>">
                                    <?php echo form_error('phoneno'); ?><br/>
                                </fieldset>                                
                                <fieldset class="hs-submit full-width">                                 
                                    <input type="submit"  id="next" name="next" value="Next" tabindex="5">
                                    </fieldset>
                           </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <footer>
     <?php echo $footer;  ?>
    </footer>
    </div>
  <script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js?ver='.time()) ?>"></script>  
  <script src="<?php echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>
  <script src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js?ver='.time()) ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js?ver='.time()); ?>"></script>
<script>
 var base_url = '<?php echo base_url(); ?>';
var data= <?php echo json_encode($demo); ?>;
var data1 = <?php echo json_encode($de); ?>;
var data1 = <?php echo json_encode($city_data); ?>;
</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/search.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/information.js?ver='.time()); ?>"></script>
</body>
</html>