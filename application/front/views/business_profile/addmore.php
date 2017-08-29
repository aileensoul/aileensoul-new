<!--start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/profiles/business/business.css'); ?>">
    
    <!-- start header -->
<?php echo $header; ?>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>  
<?php echo $business_header2_border ?>

    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                                <li><a href="<?php echo base_url('business_profile/business_information_update'); ?>">Business information</a></li>
                                <li><a href="<?php echo base_url('business_profile/contact_information'); ?>">Contact information</a></li>
                                <li><a href="<?php echo base_url('business_profile/description'); ?>">Description</a></li>
                                <li><a href="<?php echo base_url('business_profile/image'); ?>">Images</a></li>
                                <li <?php if($this->uri->segment(1) == 'business_profile'){?> class="active" <?php } ?>><a href="#">Add more</a></li>
                                
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

                        <div class="common-form">
                        <h3>Add More</h3>
                        
                            <?php echo form_open_multipart(base_url('business_profile/addmore_insert'), array('id' => 'businessaddmore','name' => 'businessaddmore','class' => 'clearfix')); ?>
                            
                            

                                <fieldset class="full-width">
                                    <label>Add More:</label>

                                     <textarea name="addmore" id="addmore" rows="4" cols="50" placeholder="Enter More Detail" style="resize: none;"><?php if($addmore1){ echo $addmore1; } ?></textarea>
                                    
                                </fieldset>
                                

                                <fieldset class="hs-submit full-width">
                                    

                                    
                                    <input type="submit"  id="submit" name="submit" value="Submit">
                                   
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
    
 
</body>
</html>

    <!-- footer end -->


<script type="text/javascript" src="<?php echo site_url('js/jquery-ui.js') ?>"></script>
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


<script>

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

</script>
