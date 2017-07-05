<!-- Head start -->
<?php  echo $head; ?>
    <!-- END HEAD -->

    <!-- start header -->

<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/timeline.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css'); ?>">
    
    <?php if ($freepostdata[0]['user_id'] && $freepostdata[0]['free_post_step'] == '7'){ 
     echo $freelancer_post_header2_border; } ?>

<!-- End Header-->

<style type="text/css">
   /* img{display: none;}*/
</style>

<div class="js">
<body>
<div id="preloader"></div>
    
    <section class="custom-row">
        <div class="user-midd-section" id="paddingtop_fixed">
           <div class="common-form1">
             <div class="col-md-3 col-sm-4"></div>

<?php 

             $userid = $this->session->userdata('aileenuser');

             $contition_array = array('user_id' => $userid, 'status' => '1');
             $freepostdata = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
             
             if($freepostdata[0]['free_post_step'] == 7){  ?>

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
                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_avability'); ?>">Add Your Avability</a></li>
                                <li class="custom-none"><a href="<?php echo base_url('freelancer/freelancer_post_education'); ?>"> Education</a></li>           
                                <li <?php if($this->uri->segment(1) == 'freelancer'){?> class="active init" <?php } ?>><a href="#">Portfolio</a></li>
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
                                        }?>
                    </div>

                        <div class="common-form common-form_border">
                            <h3>Portfolio</h3>
                           

                        <form name="freelancer_post_portfolio" method="post" id="freelancer_post_portfolio" 
                    class="clearfix"  enctype="multipart/form-data" >
 <!-- <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> <span style="color:#7f7f7e">Indicates required field</span>
                                </div>
 -->

                           

                         <fieldset> 
                                        <label>Attachment</label>
                                         <input type="file" name="portfolio_attachment" id="portfolio_attachment" class="portfolio_attachment" tabindex="1" autofocus placeholder="PORTFOLIO ATTACHMENT" multiple="" />&nbsp;&nbsp;&nbsp; 

                                         

                                          <span id ="filename" style="color: #8c8c8c; font-size: 17px; padding-left: 10px;visibility:show;"><?php echo $portfolio_attachment1; ?></span><span class="file_name"></span>
 
                      <div class="portfolio_image" style="color:#f00; display: block;"></div>
           
                        <?php if($portfolio_attachment1){?>
                              <div style="visibility:show;" id ="pdffile">

                              <?php  $userid = $this->session->userdata('aileenuser');?>
                              <a href="<?php echo base_url('freelancer/pdf/'. $userid) ?>"><i class="fa fa-file-pdf-o fa-2x" style="color: red; padding-left: 8px; padding-top: 10px; padding-bottom: 10px; position: relative;" aria-hidden="true"></i></a>

                              <a style="position: absolute; cursor:pointer;" onclick="delpdf();"><i class="fa fa-times" aria-hidden="true"></i></a>

                              </div>
                              <?php }?>





                            <input type="hidden" tabindex="2" name="image_hidden_portfolio" id="image_hidden_portfolio" value="<?php if($portfolio_attachment1){ echo $portfolio_attachment1; } ?>">

                                </fieldset>   

                  <fieldset class="full-width">
                  <label>Description:</label>
   <!--  <textarea name ="portfolio" tabindex="3" id="portfolio" rows="4" cols="50" placeholder="Enter description" style="resize: none;"><?php if($portfolio1){ echo $portfolio1; } ?></textarea> -->

   <div tabindex="2" style="width: 93%"  class="editable_text"  contenteditable="true" name ="portfolio" id="portfolio123" rows="4" cols="50" placeholder="Enter Portfolio Detail" style="resize: none;"><?php if($portfolio1){ echo $portfolio1; } ?> </div>
                                <?php echo form_error('portfolio'); ?> 
                            </fieldset>

                                <fieldset class="hs-submit full-width">
                                    
<!--                                    <input type="reset">
 <a href="<?php echo base_url('freelancer/freelancer_post_education'); ?>">Previous</a>-->
                                    <input type="submit"  id="submit" tabindex="4" name="submit" value="Submit" onclick="return portfolio_form_submit(event);" >
                                    
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
     <script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
    <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
   
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

var data= <?php echo json_encode($city_data); ?>;
//alert(data);

        
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
 <!-- <script>
                    
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
 
</body>
</div>
</html>

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

<?php
$userid = $this->session->userdata('aileenuser');
 $contition_array = array('user_id' => $userid);
       
 $free_reg_data = $this->common->select_data_by_condition('freelancer_post_reg', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = ''); ?>



<script type="text/javascript">
 function portfolio_form_submit(event){


var free_post_step = "<?php echo $free_reg_data[0]['free_post_step']; ?>";

//alert(free_post_step);

    var image_hidden_portfolio = document.getElementById("image_hidden_portfolio").value;

    var portfolio_attachment = document.getElementById("portfolio_attachment").value;

  var $field = $('#portfolio123');
  
  var portfolio = $('#portfolio123').html();
 
 
    
    if(portfolio_attachment != ''){
      
      var portfolio_attachment_ext = portfolio_attachment.split('.').pop();
      
      var allowespdf = ['pdf'];
      var foundPresentpdf = $.inArray(portfolio_attachment_ext, allowespdf) > -1


    }

      var image_hidden_portfolio_ext = image_hidden_portfolio.split('.').pop();
      
      var allowespdf = ['pdf'];
      var foundPresentportfolio = $.inArray(image_hidden_portfolio_ext, allowespdf) > -1;


     if(foundPresentpdf == false){ 
        $(".portfolio_image").html("Please select only pdf file.");
        event.preventDefault();
        return false;
     }

      else
      { 

        var fd = new FormData();
                
        fd.append("image", $("#portfolio_attachment")[0].files[0]);

        files = this.files;

       fd.append('portfolio', portfolio);
       fd.append('image_hidden_portfolio', image_hidden_portfolio);

       

        $.ajax({


            url: "<?php echo base_url(); ?>freelancer/freelancer_post_portfolio_insert",
            type: "POST",
           // data:'file=' + fd + 'portfolio='+portfolio,
            data: fd,
            processData: false,
            contentType: false,
            success: function (data) {

            
             if(free_post_step == 7){ 

              
                 window.location= "<?php echo base_url() ?>freelancer/freelancer_post_profile"; 
                 }else{ 
                    window.location= "<?php echo base_url() ?>freelancer/freelancer_apply_post"; 
              
                  } 
            }
        }); 
 
     }

  event.preventDefault();
    return false;

 }
</script>


<!-- only pdf script end -->

<script type="text/javascript">
  function delpdf(){
     $.ajax({ 
        type:'POST',
        url:'<?php echo base_url() . "freelancer/deletepdf" ?>',
        success:function(data){ 
          // alert(data);
          // return false;
       //document.getElementById('filename').style.visiblity="hidden";
    //   document.getElementById("pdffile").style.visibility = "hidden";
        $("#filename").text('');
        $("#pdffile").hide();
        document.getElementById('image_hidden_portfolio').value = '';

          }
            }); 
  }
  </script>
 