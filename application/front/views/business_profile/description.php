<!--start head -->


<?php echo $head; ?>
<!-- END HEAD -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">

<!-- start header -->
<?php echo $header; ?>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<?php if($businessdata[0]['business_step'] == 4){?>
<?php echo $business_header2_border; ?>
<?php }?>
<!-- END HEADER -->
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

                                <li <?php if ($this->uri->segment(1) == 'business-profile') { ?> class="active init" <?php } ?>><a href="#">Description</a></li>

                                <li class="custom-none <?php if ($businessdata[0]['business_step'] < '3') {
    echo "khyati";
} ?>"><a href="<?php echo base_url('business-profile/image'); ?>">Business Images</a></li>


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

                        <div class="common-form common-form_border">
                            <h3>
                                Description
                            </h3>

<?php echo form_open(base_url('business-profile/description-insert'), array('id' => 'businessdis', 'name' => 'businessdis', 'class' => 'clearfix')); ?>

                           <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div>


                            <?php
                            $business_type = form_error('business_type');
                            $industriyal = form_error('industriyal');
                            $subindustriyal = form_error('subindustriyal');
                            $business_details = form_error('business_details');
                            ?> 
                            
                            <fieldset <?php if ($business_type) { ?> class="error-msg" <?php } ?>>
                                <label>Business Type:<span style="color:red">*</span></label>
                                <select name="business_type" tabindex="1" autofocus id="business_type" onchange="busSelectCheck(this);">
                                    <!-- <option value="" selected option disabled>Select Business type</option> -->
                                    <?php
                                    
                                    if ($business_type1) {
                                        $businessname = $this->db->get_where('business_type', array('type_id' => $business_type1))->row()->business_name;
                                        ?>
                                        <option value="<?php echo $business_type1; ?>"><?php echo $businessname; ?></option>
                                        <?php
                                        foreach ($businesstypedata as $cnt) {
                                            ?>
                                            <option value="<?php echo $cnt['type_id']; ?>"><?php echo $cnt['business_name']; ?></option>

                                        <?php } ?>
                                        <option id="busOption" value="0" <?php if ($business_type1 == 0) {
                                            echo "selected";
                                        } ?>>Other</option>
                                    <?php
                                    } else {
                                        if (count($businesstypedata) > 0) {
                                            ?>
        <option value="" <?php if ($business_type1 == '') {
        echo "selected";
    } ?>>Select Business Type</option>
                                            <?php foreach ($businesstypedata as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['type_id']; ?>"><?php echo $cnt['business_name']; ?></option>
        <?php }
    } ?>
                                        <option id="busOption" value="0" <?php if ($business_type1 == '0') {
        echo "selected";
    } ?>>Other</option>
<?php }
?>

                                </select>
<?php echo form_error('business_type'); ?>
                            </fieldset>




                            <fieldset <?php if ($industriyal) { ?> class="error-msg" <?php } ?>>
                                <label>Category:<span style="color:red">*</span></label>

                                <select name="industriyal" tabindex="2"  id="industriyal" onchange="indSelectCheck(this);">


<!-- <option id="indOption" value="0" <?php if ($industriyal1 == 0) {
    echo "selected";
} ?>>Any Other</option> -->  

                                    <?php
                                    if ($industriyal1) {

                                        $industryname = $this->db->get_where('industry_type', array('industry_id' => $industriyal1))->row()->industry_name;
                                        ?>

                                        <option value="<?php echo $industriyal1; ?>"><?php echo $industryname; ?></option>
                                        <?php
                                        foreach ($industriyaldata as $cnt) {
                                            ?>
                                            <option value="<?php echo $cnt['industry_id']; ?>"><?php echo $cnt['industry_name']; ?></option>

                                        <?php }
                                        ?>
                                        <option id="indOption" value="0" <?php if ($industriyal1 == 0) {
                                        echo "selected";
                                    } ?>>Other</option>  
                                    <?php
                                    } else {
                                        ?>
                                        <option value="" <?php if ($industriyal1 == '') {
        echo "selected";
    } ?>>Select Category</option>
                                        <?php
                                        if (count($industriyaldata) > 0) {
                                            foreach ($industriyaldata as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['industry_id']; ?>"><?php echo $cnt['industry_name']; ?></option>
        <?php }
    } ?>
                                        <option id="indOption" value="0" <?php if ($industriyal1 == '0') {
        echo "selected";
    } ?>>Other</option>

                                    <?php }
                                    ?>
                                </select>

<?php echo form_error('industriyal'); ?>
                            </fieldset>




                            <div id="busDivCheck" <?php if ($business_type1 != 0) { ?>style="display:none" <?php } ?>>
                                <fieldset <?php if ($subindustrial) { ?> class="error-msg" <?php } ?> class="half-width" id="other-business" style="display:none;">
<?php if ($business_type1 == 0) { ?>        <!-- <label id="bustype">Add Here Your Other Business type:<span style="color:red;" >*</span></label> --> <?php } ?>
                                    <label> Other Business Type: <span style="color:red;" >*</span></label>
                                    <input type="text" name="bustype"  tabindex="3"  id="bustype" value="<?php echo $other_business; ?>" style="<?php if ($business_type1 != 0) {
                                               echo 'display: none';
                                           } ?>" required="">
<?php echo form_error('subindustriyal'); ?>
                                </fieldset>
                            </div>


                            <div id="indDivCheck" <?php if ($industriyal1 != 0) { ?>style="display:none" <?php } ?>>
                                <fieldset <?php if ($subindustrial) { ?> class="error-msg" <?php } ?> class="half-width" id="other-category" style="display:none;">
<?php if ($industriyal1 == 0) { ?>    <!--  <label id="indtype">Add Here Your Other Category type:<span style="color:red">*</span></label> --> <?php } ?>
                                    <label> Other Category:<span style="color:red;" >*</span></label>
                                    <input type="text" name="indtype" id="indtype" tabindex="4"  value="<?php echo $other_industry; ?>" 
                                           style="<?php if ($industriyal1 != 0) {
    echo 'display: none';
} ?>" required="">
<?php echo form_error('subindustriyal'); ?>
                                </fieldset>
                            </div>





                            <fieldset <?php if ($business_details) { ?> class="error-msg" <?php } ?> class="full-width">
                                <label>Details of your business:<span style="color:red">*</span></label>


                                <textarea name="business_details" id="business_details" rows="4" tabindex="5"  cols="50" placeholder="Enter Business Detail" style="resize: none;"><?php if ($business_details1) {
    echo $business_details1;
} ?></textarea>
<?php echo form_error('business_details'); ?>


                            </fieldset>


                            <fieldset class="hs-submit full-width">


                                <input type="submit"  id="next" name="next" value="Next" tabindex="6" >


                            </fieldset>

                            </form>
                        </div>
                    </div>

                    <!-- middle section end -->


                </div>
            </div>
        </div>
    </section>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- footer start -->
    <footer>

<?php echo $footer; ?>
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

                                    var data = <?php echo json_encode($demo); ?>;
// alert(data);


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
        ajax: {

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




<script>
    function busSelectCheck(nameSelect)
    {//alert("hi");

        var industriyal = document.getElementById("industriyal").value;
        var business_type = document.getElementById("business_type").value;

        if (nameSelect) {
            var busOptionValue = document.getElementById("busOption").value;
            if (busOptionValue == nameSelect.value) {
                document.getElementById("busDivCheck").style.display = "block";
                document.getElementById("bustype").style.display = "block";
                document.getElementById("other-business").style.display = "block";
                //$("#busDivCheck .half-width label").text('Other Business Type:');
                $("#busDivCheck .half-width label").html('Other Business Type:<span style="color:red;" >*</span>');
            } else {
                //document.getElementById("busDivCheck").style.display = "none";
                document.getElementById("bustype").style.display = "none";
                if (industriyal == 0 && business_type == 0) {
                    // document.getElementById("busDivCheck").style.display = "none";
                    $("#busDivCheck .half-width label").text('');
                    $("#bustype-error").remove();
                }
                if (industriyal == 0 && business_type != 0) {
                    $("#busDivCheck .half-width label").text('');
                    $("#bustype-error").remove();
                }
            }
        } else {
//        document.getElementById("busDivCheck").style.display = "none";
            document.getElementById("bustype").style.display = "none";
            $("#busDivCheck .half-width label").text('');
        }
    }
</script>


<script>
    function indSelectCheck(nameSelect)
    {
        if (nameSelect) {
            indOptionValue = document.getElementById("indOption").value;
            //alert(nameSelect.value);alert(indOptionValue);
            if (indOptionValue == nameSelect.value) {
                document.getElementById("indDivCheck").style.display = "block";
                document.getElementById("indtype").style.display = "block";
                document.getElementById("other-category").style.display = "block";
            } else {
                document.getElementById("indDivCheck").style.display = "none";
            }
        } else {
            document.getElementById("indDivCheck").style.display = "none";
        }
    }
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#industriyal').on('change', function () {
            var industriyalID = $(this).val();
            if (industriyalID) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "business_profile/ajax_data"; ?>',
                    data: 'industry_id=' + industriyalID,
                    success: function (html) {
                        $('#subindustriyal').html(html);

                    }
                });
            } else {
                $('#subindustriyal').html('<option value="">Select industriyal first</option>');
            }
        });
    });
</script>





<script type="text/javascript">

    //validation for edit email formate form


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

        $("#businessdis").validate({

            rules: {

                business_type: {

                    required: true,

                },

                industriyal: {

                    required: true,

                },
                subindustriyal: {

                    required: true,

                },

                business_details: {

                    required: true,
                     regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                    //noSpace: true

                },
            },

            messages: {

                business_type: {

                    required: "Business type Is Required.",

                },

                industriyal: {

                    required: "Industrial Is Required.",

                },
                subindustriyal: {

                    required: "Subindustrial Is Required.",

                },

                business_details: {

                    required: "Business details Is Required.",

                },
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

