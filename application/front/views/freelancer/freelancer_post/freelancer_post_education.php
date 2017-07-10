<!-- HEAD start -->
<?php echo $head; ?>
<!-- END HEAD -->

<!-- start header -->
<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<!-- This Css is used for call popup -->
<link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.fancybox.css" />

<?php if ($freepostdata[0]['user_id'] && $freepostdata[0]['free_post_step'] == '7'){ 
     echo $freelancer_post_header2_border; } ?>
<div class="js">
<body>
<div id="preloader"></div>
    <section>



        <div class="user-midd-section" id="paddingtop_fixed">
             <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>
                      <?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $freepostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($freepostdata[0]['free_post_step'] == 7){ ?> 


<div class="col-md-6 col-sm-8"><h3>You are updating your Freelancer Profile.</h3></div>
                <?php }else{

             ?>



                      <div class="col-md-6 col-sm-8"><h3>You are making your Freelancer Profile.</h3></div>

                      <?php }?>
            </div>
            <br>
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="left-side-bar">
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_basic_information'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_address_information'); ?>">Address Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_professional_information'); ?>">Professional Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_rate'); ?>">Rate</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_avability'); ?>">ADD Your Avability</a></li>
                                <li <?php if ($this->uri->segment(1) == 'freelancer') { ?> class="active init" <?php } ?>><a href="#"> Education</a></li>	

                                <li class="custom-none <?php if ($freepostdata[0]['free_post_step'] < '6') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('freelancer/freelancer_post_portfolio'); ?>">Portfolio</a></li>
                            </ul>
                        </div>
                    </div>
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
                        <div class="common-form common-form_border">
                            <h3>Education Info</h3>
                            <?php echo form_open(base_url('freelancer/freelancer_post_education_insert'), array('id' => 'freelancer_post_education', 'name' => 'freelancer_post_education', 'class' => 'clearfix')); ?>


                            <?php
                            $degree = form_error('degree');
                            $stream = form_error('stream');
                            $univercity = form_error('univercity');
                            $collage = form_error('collage');
                            $percentage = form_error('percentage');
                            $passingyear = form_error('passingyear');
                            $address = form_error('address');
                            ?>


                            <fieldset <?php if ($degree) { ?> class="error-msg" <?php } ?>>
                                <label>Higher Degree:<!-- <span style="color:red">*</span> --></label>
                                <select name="degree" tabindex="1" autofocus id="degree">
                                    <option value="">Select your degree</option>

                                    <?php
                                    if (count($degree_data) > 0) {
                                        foreach ($degree_data as $cnt) {
                                            if ($degree1) {
                                                ?>
                                                <option value="<?php echo $cnt['degree_id']; ?>" <?php if ($cnt['degree_id'] == $degree1) echo 'selected'; ?>><?php echo $cnt['degree_name']; ?></option>

                                                <?php
                                            }
                                            else {
                                                ?>
                                                <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name']; ?></option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
<?php echo form_error('degree'); ?>

                            </fieldset>

                            <fieldset <?php if ($stream) { ?> class="error-msg" <?php } ?>>
                                <label>Stream:<!-- <span style="color:red">*</span> --></label>
                                <select name="stream" id="stream" tabindex="2">
                                    <?php
                                    foreach ($stream_data as $cnt) {
                                        if ($stream1) {
                                            ?>
                                            <option value="<?php echo $cnt['stream_id']; ?>" <?php if ($cnt['stream_id'] == $stream1) echo 'selected'; ?>><?php echo $cnt['stream_name']; ?></option>
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <option value="">Select Degree first</option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                    <?php echo form_error('stream'); ?>  
                            </fieldset>

                            <fieldset <?php if ($univercity) { ?> class="error-msg" <?php } ?>>
                                <label>University:<!-- <span style="color:red">*</span> --></label>
                                <select name="university" id="university" tabindex="3" class="university_1">
                                    <option value="" selected option disabled>Select your University</option>
<?php
if (count($university_data) > 0) {
    foreach ($university_data as $cnt) {

        if ($university1) {
            ?>
                                                <option value="<?php echo $cnt['university_id']; ?>" <?php if ($cnt['university_id'] == $university1) echo 'selected'; ?>><?php echo $cnt['university_name']; ?></option>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>

                                                <?php
                                            }
                                        }
                                    }
                                    ?>
               <option value="<?php echo $university_otherdata[0]['university_id']; ?> "><?php echo $university_otherdata[0]['university_name']; ?></option>
                                </select>
                                    <?php echo form_error('university'); ?> 
                            </fieldset>

                            <fieldset <?php if ($college) { ?> class="error-msg" <?php } ?>>
                                <label>College:<!-- <span style="color:red">*</span> --></label>
                                <input type="text" name="college" id="college" tabindex="4" placeholder="Enter college"  value="<?php if ($college1) {
                                        echo $college1;
                                    } ?>">
<?php echo form_error('college'); ?> 
                            </fieldset>

                            <fieldset <?php if ($percentage) { ?> class="error-msg" <?php } ?>>
                                <label>Percentage:<!-- <span style="color:red">*</span> --></label>
                                <input type="text" name="percentage" placeholder="Enter percentage" tabindex="5" value="<?php if ($percentage1) {
    echo $percentage1;
} ?>">
                                <?php echo form_error('percentage'); ?>
                            </fieldset>

                            <fieldset <?php if ($passingyear) { ?> class="error-msg" <?php } ?>>
                                <label>Year of passing:<!-- <span style="color:red">*</span> --></label>
                                <select name="passingyear" tabindex="6">
                                    <option value="" selected option disabled>Select your Passing year</option>
                                    <?php
                                    $curYear = date('Y');

                                    for ($i = $curYear; $i >= 1900; $i--) {
                                        if ($pass_year1) {
                                            ?>

                                            <option value="<?php echo $i ?>" <?php if ($i == $pass_year1) echo 'selected'; ?>><?php echo $i ?></option>


        <?php
    }
    else {
        ?>
                                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php
                                        }
                                    }
                                    ?> 

                                </select> 
                                    <?php echo form_error('passingyear'); ?>
                            </fieldset>




                            <fieldset class="hs-submit full-width">

<!--                                <input type="reset">
                                <a href="<?php echo base_url('freelancer/freelancer_post_avability'); ?>">Previous</a>-->
                                <input type="submit"  tabindex="7" id="next" name="next" value="Next">


                            </fieldset>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php echo $footer; ?>
</body>
</div>
     <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
   <!-- This Js is used for call popup -->
<script src="<?php echo base_url('js/jquery.fancybox.js'); ?>"></script>
<!-- This Js is used for call popup -->


    <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script>
var data= <?php echo json_encode($demo); ?>;
//alert(data);
        
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
//alert(data);

        
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


<!--  <script>
                    
                    //select2 autocomplete start for Location
                    $('#searchplace').select2({
                        placeholder: 'Find Your Location',
                        maximumSelectionLength: 1,
                        ajax: {
                            url: "<?php echo base_url(); ?>freelancer/location",
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data) {
                                return {
                                    //alert(data);
                                    results: data
                                };
                            },
                            cache: true
                        }
                    });
                    //select2 autocomplete End for Location
                </script>
 -->
    <!-- script for degree,stream start -->



    <script type="text/javascript">

        $(document).ready(function () {
            $('#degree').on('change', function () {

                var degreeID = $(this).val();

                if (degreeID) {

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() . "freelancer/ajax_data"; ?>',
                        data: 'degree_id=' + degreeID,
                        success: function (html) {
                            $('#stream').html(html);

                        }
                    });
                } else {
                    $('#stream').html('<option value="">Select Degree first</option>');

                }
            });
        });



    </script>


    <script type="text/javascript">

        //validation for edit email formate form


        //pattern validation at percentage start//
              $.validator.addMethod("percen", function(value, element, param) {
              if (this.optional(element)) {
               return true;
              }
              if (typeof param === "string") {
                param = new RegExp("^(?:" + param + ")$");
              }
              return param.test(value);
            }, "Please Enter Percentage like 89.96.");
  
             //pattern validation at percentage end//

        $(document).ready(function () {

            $("#freelancer_post_education").validate({

                rules: {

    
                   
                    percentage: {

                       
                       number:true,
                     percen: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/

                    },

                   

                },

                messages: {

            
                  


                },

            });
        });
    </script>

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
  <script type="text/javascript">
            function checkvalue() {
            
            var searchkeyword = $.trim(document.getElementById('tags').value);
            var searchplace = $.trim(document.getElementById('searchplace').value);
            // alert(searchke                                    yword);
            // alert(search                                    place);
            if (searchkeyword == "" && searchplace == "") {
            //alert('Please enter Key                                        word');
            return  false;
            }
            }
        </script> 
        <script type="text/javascript">

//Click on University other option process Start 
   $(document).on('change', '.university_1', function (event) {
      var item=$(this);
      var uni=(item.val());
      if(uni == 463)
      {
            $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');
   
             $('.message #univer').on('click', function () {
      var $textbox = $('.message').find('input[type="text"]'),
      textVal  = $textbox.val();
      $.ajax({
                          type: 'POST',
                          url: '<?php echo base_url() . "freelancer/freelancer_other_university" ?>',
                          dataType: 'json',
                          data: 'other_university=' + textVal,
                          success: function (response) {
                       
                               if(response.select == 0)
                              {
                                $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }
                              else if(response.select == 1)
                              {
                                $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                              }  
                              else
                              {
                                   $.fancybox.close();
                                  
                                   $('.university_1').html(response.select);
                              }
                          }
                      });
      
                  });
      }
     
   });
   

   
//Click on University other option process End 
</script>