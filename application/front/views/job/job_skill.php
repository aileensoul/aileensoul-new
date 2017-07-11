 
<!-- start head -->
<?php echo $head; ?>
<!-- END HEAD -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.css" rel="stylesheet" /> 
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>" />

<!-- start header -->
<?php echo $header; ?> 
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<?php if($jobdata[0]['job_step'] == 10){ ?>
<?php echo $job_header2_border; ?>
<?php } ?>
<!-- END HEADER -->
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
             
             if($jobdata[0]['job_step'] == 10 || $jobdata[0]['job_step'] >= 5){ ?>

<div class="col-md-6 col-sm-8"><h3>You are updating your Job Profile.</h3></div>
                <?php }else{

             ?>
                      <div class="col-md-6 col-sm-8"><h3>You are making your Job Profile.</h3></div>

            <?php }?>
            </div>
            <br>
            <br>
            <br>

            <div class="container">
                <div class="row row4">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <?php
                            $userid = $this->session->userdata('user_id');
                            $job = $this->db->get_where('job_reg', array('user_id' => $userid))->row()->job_step;
                            ?>
                            <ul class="left-form-each">
                                <li class="custom-none"><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('job/job_address_update'); ?>">Address</a></li>

                                <li class="custom-none"><a href="<?php echo base_url('job/job_education_update'); ?>">Educational Qualification</a></li>


                                <li class="custom-none"><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li <?php if ($this->uri->segment(1) == 'job') { ?> class="active init" <?php } ?>><a href="#">Professional Skills</a></li>
<!-- 
                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '5') {
                                    //echo "khyati";
                                }
                                ?>"><a href="<?php //echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li> -->

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '5') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '7') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '8') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>

                                <li class="custom-none <?php
                                if ($jobdata[0]['job_step'] < '9') {
                                    echo "khyati";
                                }
                                ?>"><a href="<?php echo base_url('job/job_carrier_update'); ?>">Career Objectives</a></li>
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
}
?>
                        </div>

                        <div class="clearfix">

                            <div class="common-form common-form_border">
                                <h3>Keyskills</h3>
<?php echo form_open(base_url('job/job_skill_insert'), array('id' => 'jobseeker_regform', 'name' => 'jobseeker_regform', 'class' => 'clearfix', 'onsubmit' => "imgval()")); ?>


                                <!-- <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span><?php $skills = form_error('skills'); ?>
                                </div> --> 

      <div> <span class="required_field" >( <span class="red">*</span> ) Indicates required field</span></div>
                                


                                <fieldset class="full-width" <?php if ($skills) { ?> class="error-msg" <?php } ?> >
                                    <label>keyskills:<span class="red">*</span></label>

 <?php
                                        if ($skill_other) {
                                            ?>

                                    <select name="skills1[]" id ="skils" tabindex="1" autofocus  multiple="multiple" style="width:100%;" placeholder='Enter Skill'>
                                     <option></option>
<?php foreach ($skill as $ski) { ?>
                                            <option value="<?php echo $ski['skill_id']; ?>"><?php echo $ski['skill']; ?></option>
<?php } ?>
                                    </select>
                                    <?php }else{?>
<select name="skills[]" id ="skils" tabindex="1" autofocus class="keyskil" multiple="multiple" style="width:100%;">
  <option></option>
<?php foreach ($skill as $ski) { ?>
                                            <option value="<?php echo $ski['skill_id']; ?>"><?php echo $ski['skill']; ?></option>
<?php } ?>
                                    </select>

                                    <?php }?>


                                        <?php echo form_error('skills'); ?>
                                </fieldset>


                                <div  style="padding-left: 8px;">
                                    <fieldset class="full-width padding_less_left">
                                        <label>Other skill:</label>

                                        <?php
                                        if ($skill_other) {
                                            ?>

                                            <input type="text" class="keyskil1" tabindex="2"  name="other_skill1" id="other_keyskill1" placeholder="Enter Other Skill" value=""> 
                                            <div class="action-buttons btn-group ">
                                                <a href="javascript:void(0);" id="add_field1" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>
                                            <?php
                                            $count = count($skill_other);
                                            foreach ($skill_other as $post) {
                                                ?>
                                                <input type="text" class="edit_other_skill1" name="other_skill<?php echo $post['skill_id']; ?>" id="other_keyskill-<?php echo $post['skill_id']; ?>" placeholder="Enter Other Skill" value="<?php echo $post['skill']; ?>"> 
                                                <div class="action-buttons btn-group" id="edit-other-skill-<?php echo $post['skill_id']; ?>">
                                                    <a href="javascript:void(0);" class="edit_other_skill" id="edit_other_skill-<?php echo $post['skill_id']; ?>"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                </div>
        <?php echo form_error('other_skill'); ?>
                                                <!--   <input class="clearable" type="text" name="" value="" placeholder="Enter a Search term" /> -->
                                                <?php
                                            }
                                            ?>

    <?php
} else {
    ?> 



                                            <input type="text"  class="keyskil" name="other_skill" id="other_keyskill" placeholder="Enter Other Skill" value=""> 
                                            <?php  echo form_error('other_skill'); ?>
                                          <!--   <input class="clearable" type="text" name="" value="" placeholder="Enter a Search term" /> -->


                                            <div class="action-buttons btn-group ">
                                                <a href="javascript:void(0);" id="add_field" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                                            </div>


    <?php
}
?>
                                    </fieldset>
                                </div>

                                <fieldset class="hs-submit full-width">
<!--                                    <input type="reset">
                                    <input type="submit"  id="previous" name="previous" value="previous">-->
                                    <input type="submit"  id="next" name="next" tabindex="3" value="next">


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
    <!-- END CONTAINER -->

<div class="modal fade message-box biderror" id="bidmodalskill" role="dialog">
                    <div class="modal-dialog modal-lm">
                        <div class="modal-content">
                        <button  type="button" class="modal-close" data-dismiss="modal" onclick="closemodel()" id="post">&times;</button>         
                            <div class="modal-body">
                                <span class="mes"></span>
                            </div>
                        </div>
                    </div>
                </div>

</body>
</html>

<style type="text/css">
    .keyskil, #other_keyskill1, #other_keyskill{
        width:93% !important;
        
    }    
.common-form .edit_other_skill1{width: 93% !important;margin-top: 6px;}
</style>



<!-- script for js validation start-->
<script src="<?php echo base_url('js/jquery.js'); ?>"></script> 
<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<!-- script for skill textbox automatic end -->
<script>

                                        var data = <?php echo json_encode($demo); ?>;

                                        $(function () {
                                            // alert('hi');
                                            $("#tags").autocomplete({
                                                source: function (request, response) {
                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                    response($.grep(data, function (item) {
                                                        return matcher.test(item.label);
                                                    }));
                                                },
                                                minLength: 1,
                                                select: function (event, ui) {
                                                    event.preventDefault();
                                                    $("#tags").val(ui.item.label);
                                                    $("#selected-tag").val(ui.item.label);
                                                    // window.location.href = ui.item.value;
                                                }
                                                ,
                                                focus: function (event, ui) {
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

<!-- <script>
//select2 autocomplete start for skill
    // $('#searchskills').select2({

    //     placeholder: 'Find Your Skills',

    //     ajax: {

    //         url: "<?php echo base_url(); ?>job/keyskill",
    //         dataType: 'json',
    //         delay: 250,

    //         processResults: function (data) {

    //             return {

    //                 results: data


    //             };

    //         },
    //         cache: true
    //     }
    // });
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

</script> -->



<!-- script for clear textbox start-->
<!-- <script type="text/javascript" src="<?php// echo base_url('js/jquery.clearsearch-1.0.4.js'); ?>"></script> -->
<!-- script for clear textbox End-->
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.js"></script>

<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

<script type="text/javascript">
//select2 autocomplete start for skill
    var complex = <?php echo json_encode($selectdata); ?>;
   // $('#skils').select2().select2('val', complex)

    if(complex != '')
    { 
        //alert(789);
         $("#skils").select2({
         placeholder: "Select a Language",
         }).select2('val', complex);
    }
   if(complex == '')
    {
        //alert(123);
         $("#skils").select2({
         placeholder: "Select a Language",
 
        });
    }
//select2 autocomplete End for skill
</script>

<script type="text/javascript">

jQuery.validator.addMethod("noSpace", function(value, element) { 
      return value == '' || value.trim().length != 0;  
    }, "No space please and don't leave it empty");



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
//         $('.edit_other_skill1').each(function() {
//     $(this).rules('add', {
//         regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
      
//     });
// });
       
        //alert(123);
     $("#jobseeker_regform").validate({
      //  alert(456);

             ignore: '*:not([name])',

            rules: {


                'skills[]': {

                    require_from_group: [1, ".keyskil"],
                            //required:true 
                },

                other_skill: {

                    require_from_group: [1, ".keyskil"],
                     regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //noSpace: true
                            // required:true 
                },
                 other_skill1: {

                   
                     regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //noSpace: true
                            // required:true 
                },
               
            },

       messages: {

                'skills[]': {

                    require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",

                },

                other_skill: {

                    require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",
                }
            }

        });

//validation with class name start
     $('.edit_other_skill1').each(function() {
        $(this).rules('add', {
           required: true,
            regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
            messages: {
                required:  "Please Write Other Skill",
                //number:  "your custom number message"
            }
        });
    });
//validation with class name End

          });
//validation end

//clear textbox start
    // $(function () {
    //     // init plugin (with callback)
    //     $('#other_skill').clearSearch({
    //         callback: function () {
    //             console.log("search cleared");
    //         }
    //     });

    // });
//clear textbox End

    $('#add_field').click(function (e) {

        e.preventDefault();
        e.stopPropagation();
        var other_skill = $("#other_keyskill").val();
        

        var postData = {
            'other_skill': other_skill,
          };
        $.ajax({

            type: "POST",
            url: "<?php echo base_url(); ?>job/other_skill_insert",
            data: postData, //assign the var here 
            success: function () {
                if(other_skill=="")
                {
                    $('.biderror .mes').html("<div class='pop_content'>Empty Skill is not Allowed.");
                    $('#bidmodalskill').modal('show');

                    $("#other_keyskill").val('');
                }
                else
                {
                    $('.biderror .mes').html("<div class='pop_content'>Skill Inserted Successfully.");
                    $('#bidmodalskill').modal('show');

                        $("#other_keyskill").val('');
                }
                
                // if (msg == "Skill Inserted Successfully")
                // {
                    //window.location.reload(true);
                   // window.location= "<?php echo base_url() ?>job/job_skill_update";
                //}

            }
        });
    });





    $('#add_field1').click(function (e) {

        e.preventDefault();
        e.stopPropagation();
        var other_skill = $("#other_keyskill1").val();
    //    var user_id = <?php echo $aileenuser_id; ?>
        
        var postData = {
            'other_skill': other_skill,
    //        'user_id': user_id
        };
        
        $.ajax({

            type: "POST",
            url: "<?php echo base_url(); ?>job/other_skill_insert",
            data: postData, //assign the var here 
            success: function () {

                 if(other_skill=="")
                {
                    $('.biderror .mes').html("<div class='pop_content'>Empty Skill is not Allowed.");
                    $('#bidmodalskill').modal('show');

                    $("#other_keyskill").val('');
                }
                else
                {
                        $('.biderror .mes').html("<div class='pop_content'>Skill inserted successfully.");
                         $('#bidmodalskill').modal('show');

                        $("#other_keyskill1").val('');
                }
                // if (msg == "Skill Inserted Successfully")
                // {
                //     window.location.reload(true);
                // }
            }

        });
    });

    $('.edit_other_skill').click(function (e) {
    //  var other_skill = $("#edit_other_skill").val();
   // alert("hi");
        var id_val = $(this).attr('id');
        //alert(id_val);
        var parts = id_val.split('-', 2);
        //alert(parts);
        var get_id  = parts[1];
        //alert(get_id);
       
        var postData = {
            'skill_id': get_id
        };
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>job/other_skill_remove",
            data: postData, //assign the var here 
            success: function (msg) {
                if(msg == 'ok'){
                    $("#other_keyskill-" + get_id).remove();
                    $("#edit-other-skill-" + get_id).remove();



                }
                $('.biderror .mes').html("<div class='pop_content'>Skill Remove successfully.");
                 $('#bidmodalskill').modal('show');
            }
        });
    });


 function closemodel(){
    window.location= "<?php echo base_url() ?>job/job_skill_update";
 }

</script>

<script type="text/javascript">
  
function imgval(){ 
 //   alert(123);

 var skill_main = document.getElementById("skils").value;
 var skill_other = document.getElementById("other_keyskill1").value;

     if(skill_main =='' && skill_other == ''){
  //$($("#skils").select2("container")).removeClass("keyskill_border_deactivte");

  $(".select2-drop-mask").addClass("keyskill_border_active");
  }
   
  }

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




<style type="text/css">
    #skils-error{margin-top: -5px;}
    #other_keyskill-error{margin-top: -5px;margin-right: 58px;}
    #other_keyskill-688-error{margin-right: 40px;}
     #other_keyskill-689-error{margin-right: 40px;}
      #other_keyskill-690-error{margin-right: 40px;}
       #other_keyskill-691-error{margin-right: 40px;}
        #other_keyskill-692-error{margin-right: 40px;}
         #other_keyskill-693-error{margin-right: 40px;}
          #other_keyskill-694-error{margin-right: 40px;}
</style>


<!-- all popup close close using esc start -->
 <script type="text/javascript">
   

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodalskill').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->

 <script type="text/javascript">
   //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open start
                $(document).ready(function (e) {
                    $('#post').on('click', function () { 

                        $('#bidmodalskill').modal('show');
                          return false;
                    });
                });
  //This script is used for "This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post." comment click close then post add popup open end  
   
</script>