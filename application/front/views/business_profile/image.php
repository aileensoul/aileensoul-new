<!--start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<style type="text/css">
.header2{border-bottom-left-radius: 4px;border-bottom-right-radius: 4px; }
.full-width  img{display: none;}
#imageold {display: block;}
#preview {display: none; height:100px; width:100px; margin: 0 auto;}

</style>

    <!-- start header -->
<?php echo $header; ?>
    <!-- END HEADER -->
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
    <?php if($businessdata[0]['business_step'] == 4){?>
<?php echo $business_header2_border; ?>
<?php }?>
<div class="js">
    <body class="page-container-bg-solid page-boxed">
    <div id="preloader"></div>

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>

<?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $busdata = $this->common->select_data_by_condition('business_profile', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($busdata[0]['business_step'] == 4){ ?>

<div class="col-md-6 col-sm-8"><h3>You are updating your Business Profile.</h3></div>
              <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Business Profile.</h3></div>

                       <?php }?>
            </div>
            <br>
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('business-profile/business-information-update'); ?>">Business Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('business-profile/contact-information'); ?>">Contact Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('business-profile/description'); ?>">Description</a></li>

                                <li <?php if($this->uri->segment(1) == 'business-profile'){?> class="active init" <?php } ?>><a href="#">Business Images</a></li>

                               
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
                            <h3>Business Images</h3>
                        
                            <?php echo form_open_multipart(base_url('business-profile/image-insert'), array('id' => 'businessimage','name' => 'businessimage','class' => 'clearfix')); ?>
                           

                                <fieldset class="full-width">
                                    <label>Business Images:</label>
                                    <input type="file" tabindex="1" onclick = "removemsg()" onchange="validate(event)" autofocus name="image1[]" id="image1" multiple/> 

                                     <div class="bus_image" style="color:#f00; display: block;"></div> 

                                    <?php if(count($busimage) > 0){
                                        $y = 0;
                                        foreach($busimage as $image){ 
                                          $y = $y +1;

                                          //echo $image['image_id']; ?>
                                    <div class="job_work_edit_<?php echo $image['image_id']?>" id="image_main">
                                            <input type="hidden" name="filedata[]" id="filename" value="old">
                                            <input type="hidden" name="filename[]" id="filename" value="<?php echo $image['image_name']; ?>">
                                            <input type="hidden" name="imageid[]" id="filename" value="<?php echo $image['image_id']; ?>">

                                            <div class="img_bui_data"> 
                                            <div class="edit_bui_img">
                                            <img id="imageold" src="<?php echo base_url($this->config->item('bus_profile_main_upload_path').$image['image_name'])?>" >
                                   </div>
                                            
                                             <?php // if ($y != 1) {
                                                                    ?>
                                                                    <div style="float: left;">
                                                                        <div class="hs-submit full-width fl">
                      <input id="bui_img_delete" type="button" value="" onclick="delete_job_exp(<?php echo $image['image_id']; ?>);" style="display: none;"> 
                                                                           
                                                                            <div class="bui_close">
                                                                            <label for="bui_img_delete"><i class="fa fa-times" aria-hidden="true"></i></label>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                <?php // } ?>
                                              </div>
                                              </div>
                                        <?php }} ?>
                                           
                                             
                                 <img id="preview" src="#" alt="your image"/>
                                   
                                </fieldset>
                               <fieldset class="hs-submit full-width">
                                  

                                   
                                    <input type="submit"  id="submit" name="submit" tabindex="2"  value="Submit">
                                   
                                    
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

 <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



<!-- script for business autofill -->
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

var data1= <?php echo json_encode($city_data); ?>;
//alert(data1);

        
$(function() {
    // alert('hi');
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
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
                            var searchkeyword = $.trim(document.getElementById('tags').value);
                            var searchplace = $.trim(document.getElementById('searchplace').value);
                            // alert(searchkeyword);
                            // alert(searchplace);
                            if (searchkeyword == "" && searchplace == "") {
                                //alert('Please enter Keyword');
                                return false;
                            }
                        }
                    </script>
  <!-- end of business search auto fill -->


<!-- <script>

//select2 autocomplete start for Location
$('#searchplace').select2({
        
        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax:{

          url: "<?php echo base_url(); ?>business_profile/location",
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



<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>


<script type="text/javascript"> 
 $(".alert").delay(3200).fadeOut(300);
</script>

<script type="text/javascript">
                        function delete_job_exp(grade_id) {
                        //  alert(grade_id);
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url() . "business_profile/bus_img_delete" ?>',
                                data: 'grade_id=' + grade_id,
                                // dataType: "html",
                                success: function (data) {
                                  
                                    if (data) { 

                                     // alert('job_work_edit_' + grade_id);
                                        $('.job_work_edit_' + grade_id).remove();
                                    }
                                }
                            });
                        }
                    </script>
    <!-- footer end -->
    
    
    <!-- script for profile pic strat -->
<script type="text/javascript">
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'none';
                $('#preview').attr('src', e.target.result);
            }
             reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#image1").change(function(){ 
        readURL(this);
    });
</script>
<script type="text/javascript">
  jQuery(document).ready(function($) {  

// site preloader -- also uncomment the div in the header and the css style for #preloader
$(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script>


<!-- only iamge upload validation strat-->
<script type="text/javascript">

    function validate(event) {


        var fileInput = document.getElementById("image1").files;



        if (fileInput != '')
        {
            for (var i = 0; i < fileInput.length; i++)
            {

                var vname = fileInput[i].name;
                var ext = vname.split('.').pop();
                var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'PNG'];

                var foundPresent = $.inArray(ext, allowedExtensions) > -1;
                // alert(foundPresent);

                if (foundPresent == true)
                {
                } else {

                    $(".bus_image").html("Please select only Image File.");

                    event.preventDefault();
                    //return false; 
                }


            }

        }

    }

    function removemsg() {

        $(".bus_image").html(" ");
        document.getElementById("image1").value = null;

    }
</script>


<!-- only iamge upload validation end-->


<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#tags1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#tag1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#tags1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#searchplace1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data1, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
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