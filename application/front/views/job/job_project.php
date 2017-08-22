
<!-- start head -->
<?php  echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">

<?php //if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php //} ?>
<!-- END HEADER -->
<!-- This style is used for autocomplete start -->
 <style type="text/css">

/* Layout helpers
----------------------------------*/
.ui-helper-hidden {
  display: none;
}
.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.ui-front {
  z-index: 100;
}



/* Misc visuals
----------------------------------*/

/* Overlays */
.ui-widget-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  cursor: default;
}

.ui-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: block;
  outline: none;
}
.ui-menu .ui-menu {
  position: absolute;
}
.ui-menu .ui-menu-item {
  position: relative;
  margin: 0;
  padding: 3px 1em 3px .4em;
  cursor: pointer;
  min-height: 0; /* support: IE7 */
  /* support: IE10, see #8844 */
  list-style-image: url("data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7");
}
.ui-menu .ui-menu-divider {
  margin: 5px 0;
  height: 0;
  font-size: 0;
  line-height: 0;
  border-width: 1px 0 0 0;
}
.ui-menu .ui-state-focus,
.ui-menu .ui-state-active {
  margin: -1px;
}

/* Component containers
----------------------------------*/
.ui-widget {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1.1em;
}
.ui-widget .ui-widget {
  font-size: 1em;
}
.ui-widget input,
.ui-widget select,
.ui-widget textarea,
.ui-widget button {
  font-family: Verdana,Arial,sans-serif;
  font-size: 1em;
}
.ui-widget-content {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_flat_75_ffffff_40x100.png") 50% 50% repeat-x;
  color: #222222;
}
.ui-widget-content a {
  color: #222222;
}
.ui-widget-header {
  border: 1px solid #aaaaaa;
  background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
  color: #222222;
  font-weight: bold;
}
.ui-widget-header a {
  color: #222222;
}

/* Interaction states
----------------------------------*/
.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
  border: 1px solid #d3d3d3;
  background: #e6e6e6 url("images/ui-bg_glass_75_e6e6e6_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #555555;
}

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
  border: 1px solid #999999;
  background: #dadada url("images/ui-bg_glass_75_dadada_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

.ui-state-active,
.ui-widget-content .ui-state-active,
.ui-widget-header .ui-state-active {
  border: 1px solid #aaaaaa;
  background: #ffffff url("images/ui-bg_glass_65_ffffff_1x400.png") 50% 50% repeat-x;
  font-weight: normal;
  color: #212121;
}

  </style>
<!-- This style is used for autocomplete End -->
<div class="js">
    <body class="page-container-bg-solid page-boxed">
    <div id="preloader"></div>

      <section>
      
        <div class="user-midd-section" id="paddingtop_fixed_job">
            
          <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>

 <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $jobdata = $this->common->select_data_by_condition('job_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 4){ ?>
 <div class="col-md-6 col-sm-8"><h3>You are updating your Job Profile.</h3></div>

            <?php  }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Job Profile.</h3></div>

                      <?php }?>
            </div>
       
            <br>
            <br>
            <br>

            <div class="container">
                <div class="row row4">
                
                     <?php echo $job_left; ?>

                    <!-- middle section start -->
                    <div class="col-md-6 col-sm-8">

                    <div>
                        <?php
                                if ($this->session->flashdata('error')) {
                                    echo '<div class="alert alert-danger">' . $this->session->flashdata('error') . '</div>';
                                }
                                if ($this->session->flashdata('success')) {
                                    echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                                }
                                ?>
                    </div>

                     <div class="clearfix">
                            <div class="common-form common-form_border">
                              <h3>Project And Training / Internship</h3>
                             <?php echo form_open(base_url('job/job_project_insert'), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform','class'=>'clearfix')); ?>

                         <div class="text-center">
      <h5 class="head_title">Project</h5>
  </div>
                                <fieldset class="full-width">
                                         <label>Project Name (Title):</label>

                                          <input type="text" tabindex="1" autofocus name="project_name"  id="project_name" placeholder="Enter Project Name" value="<?php if($project_name1){ echo $project_name1; } else { echo $job[0]['project_name']; }?>" maxlength="255" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value"/>
                                        
                                  </fieldset>

                                  <fieldset class="full-width">
                                         <label>Duration (in Month)</label>

                                          <input type="text" name="project_duration" tabindex="2"  id="project_duration" placeholder="Enter Duration" maxlength="2"   value="<?php if($project_duration1){ echo $project_duration1; } else { echo $job[0]['project_duration']; }?>" />
                                        
                                  </fieldset>

                                     <fieldset class="full-width">
                                         <label>Project Description</label>

                                          <textarea name="project_description"  id="project_description" tabindex="3" onpaste="OnPaste_StripFormatting(this, event);" style="resize: none;" placeholder="Enter Project Description" maxlength="4000"><?php if($project_description1){ echo $project_description1; } else { echo $job[0]['project_description']; }?></textarea>
                                        
                                  </fieldset>


 <div class="text-center">
      <h5 class="head_title">Training / Internship</h5>
  </div>
                                


                             <fieldset class="full-width">
                                         <label>Intern / Trainee as</label>

                                          <input type="text" tabindex="4" name="training_as"  id="training_as" placeholder="Intern / Trainee as" value="<?php if($training_as1){ echo $training_as1; } else { echo $job[0]['training_as']; }?>" maxlength="255"/>
                                        
                              </fieldset>

                               <fieldset class="full-width">
                                         <label>Duration (in Month)</label>

                                          <input type="text" name="training_duration" tabindex="5"  id="training_duration" placeholder="Enter Duration"   value="<?php if($training_duration1){ echo $training_duration1; } else { echo $job[0]['training_duration']; }?>" maxlength="2"/>
                                        
                                  </fieldset>

                                   <fieldset class="full-width">
                                         <label>Name of Organization</label>

                                          <input type="text" name="training_organization" tabindex="6"  id="training_organization" placeholder="Enter Name of Organization" value="<?php if($training_organization1){ echo $training_organization1; } else { echo $job[0]['training_organization']; }?>" maxlength="255"/>
                                        
                                  </fieldset>

                                    
                                <!--   <div> <span class="" >( <span class="red">*</span> ) Indicates required field</span></div> -->
                                  <fieldset class="hs-submit full-width">

<!--                                        <input type="reset">
                                        <input type="submit"  id="previous" name="previous" value="previous">-->
                                        <input type="submit"  id="next" name="next" value="Save" tabindex="7">
                                 
                                    
                                </fieldset>

                                </form>
                            </div>    
                        </div>
                    </div>
                    <!-- middle section end -->

                   
                </div>
            </div>
        </div>
    </section>
    
    <footer>
          <?php echo $footer;  ?>
    </footer>
    
</body>
</html>
             
<!-- Calender JS Start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> -->
<!-- script for skill textbox automatic end -->
 <!--new script for jobtitle,company and skill start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill  end-->

<!--new script for jobtitle,company and skill start for mobile view-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#tags1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_alldata", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#tags1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for jobtitle,company and skill for mobile view end-->

<!--new script for cities start-->
 <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end-->

<!--new script for cities start mobile view-->
  <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#searchplace1" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 2,
            source: function( request, response ) { 
                // delegate back to autocomplete, but extract the last term
                $.getJSON("<?php echo base_url();?>general/get_location", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },

             select: function(event, ui) {
           event.preventDefault();
           $("#searchplace1").val(ui.item.label);
           $("#selected-tag").val(ui.item.label);
           // window.location.href = ui.item.value;
       },
     
        });
    });
</script>
<!--new script for cities end mobile view-->
<!-- for search validation -->
<script type="text/javascript">
   function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }
   }
   
</script>


<script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>
<!-- <script>
//select2 autocomplete start for skill
    $('#searchskills').select2({

        placeholder: 'Find Your Skills',

        ajax: {

            url: "<?php echo base_url(); ?>job/keyskill",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
    $('#searchplace').select2({

        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax: {

            url: "<?php echo base_url(); ?>job/location",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for Location

</script>
               -->  
<script type="text/javascript">   
 $(".formSentMsg").delay(3200).fadeOut(300);
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script>


<script type="text/javascript">





               $(document).ready(function () { 
              // alert(123); 



$.validator.addMethod("regx1", function(value, element, regexpr) {          
    //return value == '' || value.trim().length != 0; 
     if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
     // return regexpr.test(value);
}, "Only space, only number and only special characters are not allow");


$.validator.addMethod("regx2", function(value, element, regexpr) {          
    //return value == '' || value.trim().length != 0; 
     if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
     // return regexpr.test(value);
},"space are not allow in the begining");

$.validator.addMethod("regdigit", function(value, element, regexpr) {          
    //return value == '' || value.trim().length != 0; 
     if(!value) 
            {
                return true;
            }
            else
            {
                  return regexpr.test(value);
            }
     // return regexpr.test(value);
},"Only digit allowed");


                            $("#jobseeker_regform").validate({

                                rules: {

                                    project_name:{

                                        //required: true,
                                        regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                        regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                                    },

                                    project_description:{
                                      regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                       //regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                                    },
                                    project_duration:{
                                
                                        regdigit:/^[0-9]*$/,
                                    },
                                    training_as:{
                                       regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                        regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                                    },
                                    training_duration:{
                                      regdigit:/^[0-9]*$/,
                                    },
                                    training_organization:{
                                      regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                       regx2:/^[^-\s][a-zA-Z0-9_\s-]+$/
                                    },

                                },
                     messages: {

                                    project_duration: {

                                    //  maxlength: "Duration Is Not More Than Two Digit",

                                    },

                                    training_duration: {

                                      //   maxlength: "Duration Is Not More Than Two Digit",

                                    },

                                  }
                            });
                        });
  
        </script>

<!-- disable spacebar js start-->
<script type='text/javascript'>
$(window).load(function(){
$("#project_duration").on("keydown", function (e) {
return e.which !== 32;
});
}); 

$(window).load(function(){
$("#training_duration").on("keydown", function (e) {
return e.which !== 32;
});
}); 
</script>
<!-- disable spacebar js end-->

<!-- THIS FUNCTION IS USED FOR PASTE SAME DESCRIPTION THAT COPIED START -->
 <script type="text/javascript">
            var _onPaste_StripFormatting_IEPaste = false;
            function OnPaste_StripFormatting(elem, e) {
               // alert(456);
                if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                    e.preventDefault();
                    var text = e.originalEvent.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (e.clipboardData && e.clipboardData.getData) {
                    e.preventDefault();
                    var text = e.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (window.clipboardData && window.clipboardData.getData) {
                    // Stop stack overflow
                    if (!_onPaste_StripFormatting_IEPaste) {
                        _onPaste_StripFormatting_IEPaste = true;
                        e.preventDefault();
                        window.document.execCommand('ms-pasteTextOnly', false);
                    }
                    _onPaste_StripFormatting_IEPaste = false;
                }
            }
        </script>
<!-- THIS FUNCTION IS USED FOR PASTE SAME DESCRIPTION THAT COPIED END -->

