
<?php  echo $head; ?>

<!-- select 2 validation border start -->
<style type="text/css">
  
  /*.keyskill_border_deactivte {
  border: 0px solid red;

}*/

.keyskill_border_active {
  border: 1px solid red;

}
</style>

<!-- select 2 validation border end -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>
    

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<?php if($artdata[0]['art_step'] == 4){?>
    <?php echo $art_header2_border; }?>

    <!-- END HEADER -->
    <div class="js">
    <body class="page-container-bg-solid page-boxed">
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
                                <li class="custom-none"><a href="<?php echo base_url('artistic/art_basic_information_update'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('artistic/art_address'); ?>">Address</a></li>

                                <li <?php if($this->uri->segment(1) == 'artistic'){?> class="active init" <?php } ?>><a href="#">Art Information</a></li>

                                <li class="custom-none <?php if($artdata[0]['art_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('artistic/art_portfolio'); ?>">Portfolio</a></li>

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
                            <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div>

                                <?php
                                 $artname =  form_error('artname');
                                 $skills =  form_error('skills');
                                 $desc_art =  form_error('desc_art');
                                  
                                 ?>


                                    <fieldset class="full-width" <?php if($skills) {  ?> class="error-msg" <?php } ?> >
                                        <label>Art:<span style="color:red">*</span></label>
                                       
                                          <select tabindex="1" autofocus name="skills[]" id ="skils" class="keyskil" multiple="multiple" style="width:100%;">
                                          <option></option>
                                       <?php foreach ($skill as $ski) { ?>
                                      <option value="<?php echo $ski['skill_id']; ?>"><?php echo $ski['skill']; ?></option>
                                    <?php } ?>
                                      </select>

                                        <?php echo form_error('skills'); ?>
                                    </fieldset>


                        <fieldset class="full-width">
                                <label>Other Art:</label>
                                <input type="text" class="keyskil" tabindex="2" name="other_skill" id="other_skill" placeholder="Enter Other Skill" value="<?php if($otherskill1){ echo $otherskill1; }?>"> 
                                <?php echo form_error('other_skill'); ?>
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
   <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    <footer>
        
        <?php echo $footer;  ?>
    </footer>
    
</body>
</div>
</html>

  <script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<script type="text/javascript">
     var textarea = document.getElementById("textarea");

textarea.onkeyup = function(evt) {
    this.scrollTop = this.scrollHeight;
}
 </script>
<!-- script for skill textbox automatic end (option 2)-->
<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>

<script>

var data1 = <?php echo json_encode($de); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
  
</script>

<script type="text/javascript">
                        function checkvalue() {
                            //alert("hi");
                            var searchkeyword =$.trim(document.getElementById('tags').value);
                            var searchplace =$.trim(document.getElementById('searchplace').value);
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>


  
<!-- <script>
//select2 autocomplete start for skill
                                                $('#searchskills').select2({

                                                    placeholder: 'Find Your Skills',

                                                    ajax: {

                                                        url: "<?php echo base_url(); ?>artistic/keyskill",
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

                                                        url: "<?php echo base_url(); ?>artistic/location",
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


</script> -->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script>

<!-- script for select2 box Script start-->
<script type="text/javascript" src="<?php echo base_url('js/3.3.0/select2.js'); ?>"></script>



  
<!-- script for select2 box Script End-->

<script type="text/javascript">

            //validation for edit email formate form


            jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");


            $.validator.addMethod("regx1", function(value, element, regexpr) {          
    return regexpr.test(value);
}, "Only space not allow");


$.validator.addMethod("regx", function(value, element, regexpr) {          
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


            $(document).ready(function () { 

                $("#artinfo").validate({ 
  
                  ignore: '*:not([name])',
                    rules: {

                        artname: {

                            required: true,
                            regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                            //noSpace: true,

                         
                        },

                        'skills[]': {
                            
                          require_from_group: [1, ".keyskil"] 
                           
                        }, 
                        other_skill: {
                            
                           require_from_group: [1, ".keyskil"],
                           regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                           //noSpace: true
                            
                        },
                       desc_art: {

                            required: true,
                             regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                           // noSpace: true
                            
                        },
                        
                    },

                    messages: {

                        artname: {

                            required: "Speciality Is Required.",
                            
                        },

                        'skills[]': {

                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",

                        },

                        other_skill: {

                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",
                        },
                        desc_art: {

                            required: "Description of your Art Is Required.",
                            
                        },
                       
                },

                });
                   });

    
  </script>


<script type="text/javascript">
  
function imgval(){ 

 var skill_main = document.getElementById("skils").value;
 var skill_other = document.getElementById("other_skill").value;

     if(skill_main =='' && skill_other == ''){
  //$($("#skils").select2("container")).removeClass("keyskill_border_deactivte");

  $($("#skils").select2("container")).addClass("keyskill_border_active");
  }
   
  }

</script>
<script>

var complex = <?php echo json_encode($selectdata); ?>;


if(complex != '')
    { 
        //alert(789);
         $("#skils").select2({
         placeholder: "Select your art",
         }).select2('val', complex);
    }
   if(complex == '')
    {
        //alert(123);
         $("#skils").select2({
         placeholder: "Select your art",
 
        });
    }

//$("#skils").select2().select2('val',complex)

</script>
<!-- edit time skill fetch end-->

    <!-- footer end-->
 <script type="text/javascript"> 
 $(".alert").delay(3200).fadeOut(300);
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script>
   