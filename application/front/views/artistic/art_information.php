
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <?php echo $head; ?> 

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css?ver='.time()); ?>">
      
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/artistic.css?ver='.time()); ?>">
        <style type="text/css">
          
          .multi-select-container {
    display: inline-block;
    position: relative;
}

.multi-select-menu {
    position: absolute;
    left: 0;
    top: 0.8em;
    z-index: 1;
    float: left;
    min-width: 100%;
    background: #fff;
    margin: 1em 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    display: none;
}

.multi-select-menuitem {
    display: block;
    font-size: 0.875em;
    padding: 0.6em 1em 0.6em 30px;
    white-space: nowrap;
}

.multi-select-menuitem + .multi-select-menuitem {
    padding-top: 0;
}

.multi-select-presets {
    border-bottom: 1px solid #ddd;
}

.multi-select-menuitem input {
    position: absolute;
    margin-top: 0.25em;
    margin-left: -20px;
}

.multi-select-button {
    display: inline-block;
    font-size: 0.875em;
    padding: 0.2em 0.6em;
    max-width: 16em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: -0.5em;
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    cursor: default;
}

.multi-select-button:after {
    content: "";
    display: inline-block;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0.4em 0.4em 0 0.4em;
    border-color: #999 transparent transparent transparent;
    margin-left: 0.4em;
    vertical-align: 0.1em;
}

.multi-select-container--open .multi-select-menu {
    display: block;
}

.multi-select-container--open .multi-select-button:after {
    border-width: 0 0.4em 0.4em 0.4em;
    border-color: transparent transparent #999 transparent;
}

.multi-select-container--positioned .multi-select-menu {
    /* Avoid border/padding on menu messing with JavaScript width calculation */
    box-sizing: border-box;
}

.multi-select-container--positioned .multi-select-menu label {
    /* Allow labels to line wrap when menu is artificially narrowed */
    white-space: normal;
}

        </style>
      
    </head>
    <body class="page-container-bg-solid page-boxed">

    <?php echo $header; ?>
        <?php if ($artdata[0]['art_step'] == 4) { ?>
            <?php echo $art_header2_border; ?>
        <?php } ?>

<!-- <div class="js">
<div id="preloader"></div> -->

      <section>    
        <div class="user-midd-section" id="paddingtop_fixed">
          <div class="common-form1">
             <div class="row">
             <div class="col-md-3 col-sm-4"></div>

              <?php             
             if($artdata[0]['art_step'] == 4){ ?>
<div class="col-md-6 col-sm-8"><h3>You are updating your Artistic Profile.</h3></div>

              <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Artistic Profile.</h3></div>

                        <?php }?>
            </div>
        </div>
           
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('artistic/artistic-information-update'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('artistic/artistic-address'); ?>">Address</a></li>

                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active init" <?php } ?>><a href="javascript:void(0);">Art Information</a></li>

                                <li class="custom-none <?php if($artdata[0]['art_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/artistic-portfolio'); ?>">Portfolio</a></li>

                            </ul>
                        </div>
                    </div>

                    <!-- middle section start -->
 
                    <div class="col-md-6 col-sm-8">

                     <div class="art-alert">
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
                        
                            <?php echo form_open(base_url('artistic/art_information_insert'), array('id' => 'artinfo','name' => 'artinfo','class' => 'clearfix', 'onsubmit' => "return validation_other(event)")); ?>
                          
                                <?php
                                 $artname =  form_error('artname');
                                 $othercategory =  form_error('othercategory');
                                 $skills =  form_error('skills');
                                 //$desc_art =  form_error('desc_art');
                                  
                                 ?>

                                    <fieldset class="full-width <?php if($skills) {  ?> error-msg <?php } ?>">
                                        <label>Art category:<span style="color:red">*</span></label>

                          <select name="skills[]" id="skills" tabindex="1" autofocus multiple>
                         <!--  <option value="">Ex:- Dancer, Photographer, Writer, Singer, Actor</option> -->
                          <?php
                                  if(count($art_category) > 0){
                                                foreach($art_category as $cnt){
                                                    if($art_category1)
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['category_id']; ?>" <?php if($cnt['category_id']==$art_category1) echo 'selected';?>><?php echo $cnt['art_category'];?></option>              
                                                 <?php
                                                }
                                                else
                                                {
                                            ?>
                            <option value="<?php echo $cnt['category_id']; ?>"><?php echo $cnt['art_category'];?></option>
                                <?php    }       
                                            }}
                                            ?>
                      </select>
                                    
                                      <!-- <input placeholder="Ex:- Dancing, Photography, Writing, Singing, Acting" id="skills2" value="<?php echo $work_skill; ?>" name="skills" tabindex="1" size="90"> -->

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
                                   </fieldset>
                                 </div>

                                <fieldset class="full-width <?php if($artname) {  ?> error-msg <?php } ?>">
                                    <label>Speciality in art<span class="optional">(optional)</span>:</label>
                                    <input name="artname"  type="text" id="artname" tabindex="2" placeholder="Ex:- Classical dancing, Contemporary, Zumba, Hip Hop " value="<?php if($artname1){ echo $artname1; } ?>"/><!-- <span id="artname-error"></span> -->
                                     <?php echo form_error('artname'); ?>
                                </fieldset>
              
                              
                                <fieldset  class="full-width">
                                    <label>Description of your artistic career<span class="optional">(optional)</span>:<!-- <span style="color:red">*</span> --></label>

                                 <textarea id="textarea" name ="desc_art" id="desc_art" tabindex="3" rows="4" cols="50" placeholder="Enter description of your art" style="resize: none;"><?php if($desc_art1){ echo $desc_art1; } ?></textarea>
                                   
                                  <?php echo form_error('desc_art'); ?><br/> 
                                </fieldset>
                               

                                <fieldset class="full-width">
                                    <label>How you are inspire<span class="optional">(optional)</span>:</label>
                                
                                    <input name="inspire"  type="text" id="inspire" placeholder="Enter inspire" tabindex="4" value="<?php if($inspire1){ echo $inspire1; } ?>"/><span ></span>
                                 
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

  

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.min.js?ver='.time()); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js?ver=' . time()); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.multi-select.js?ver=' . time()); ?>"></script>


<script type="text/javascript">
 var base_url = '<?php echo base_url(); ?>';   
var data= <?php echo json_encode($demo); ?>;

var data1 = <?php echo json_encode($de); ?>;

var data1 = <?php echo json_encode($city_data); ?>;

var complex = <?php echo json_encode($selectdata); ?>;

var textarea = document.getElementById("textarea");

</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/artistic_common.js?ver='.time()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/webpage/artistic/art_information.js?ver='.time()); ?>"></script>
</body>
</html>
   