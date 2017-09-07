
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
                                <li class="custom-none"><a href="<?php echo base_url('artistic/artistic-information-update'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('artistic/artistic-address'); ?>">Address</a></li>

                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active init" <?php } ?>><a href="#">Art Information</a></li>

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

                        <div class="common-form common-form_border">
                         <h3>
                            Art Information
                        </h3>
                        
                            <?php echo form_open(base_url('artistic/art_information_insert'), array('id' => 'artinfo','name' => 'artinfo','class' => 'clearfix', 'onsubmit' => "imgval()")); ?>
                          
                                <?php
                                 $artname =  form_error('artname');
                                 $skills =  form_error('skills');
                                 $desc_art =  form_error('desc_art');
                                  
                                 ?>

                                    <fieldset class="full-width" <?php if($skills) {  ?> class="error-msg" <?php } ?> >
                                        <label>Art:<span style="color:red">*</span></label>
                                    
                                      <input placeholder="Enter Art" id="skills2" value="<?php echo $work_skill; ?>" name="skills"  size="90">

                                        <?php echo form_error('skills'); ?>
                                    </fieldset>


                                <fieldset class="full-width" <?php if($artname) {  ?> class="error-msg" <?php } ?>>
                                    <label>Speciality In Art:<span style="color:red">*</span></label>
                                    <input name="artname" type="text" id="artname" tabindex="3" placeholder="Enter Speciality" value="<?php if($artname1){ echo $artname1; } ?>"/><span id="artname-error"></span>
                                     <?php echo form_error('artname'); ?>
                                </fieldset>
              
                              
                                <fieldset  <?php if($desc_art) {  ?> class="error-msg" <?php } ?> class="full-width">
                                    <label>Description of your art:<span style="color:red">*</span></label>

                                 <textarea id="textarea" name ="desc_art" id="desc_art" tabindex="4" rows="4" cols="50" placeholder="Enter Description of Your Art" style="resize: none;"><?php if($desc_art1){ echo $desc_art1; } ?></textarea>
                                   
                                  <?php echo form_error('desc_art'); ?><br/> 
                                </fieldset>
                               

                                <fieldset class="full-width">
                                    <label>How You are Inspire:</label>
                                
                                    <input name="inspire"  type="text" id="inspire" placeholder="Enter Inspire" tabindex="5" value="<?php if($inspire1){ echo $inspire1; } ?>"/><span ></span>
                                 
                                </fieldset>

                                 <fieldset class="hs-submit full-width">
                                   
                                    <input type="submit"  id="next" name="next" value="Next" tabindex="6">
                                   
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

  
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js?ver='.time()); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js?ver='.time()); ?>"></script>

 
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js?ver=' . time()); ?>"></script>

<script type="text/javascript">
 var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;

var data1 = <?php echo json_encode($de); ?>;

var data1 = <?php echo json_encode($city_data); ?>;

var complex = <?php echo json_encode($selectdata); ?>;

var textarea = document.getElementById("textarea");

</script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/webpage/artistic/art_information.js?ver='.time()); ?>"></script>
</body>
</html>
   