
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
<?php echo $header; ?>


<?php echo $art_header2; ?>
 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
    <!-- END HEADER -->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                           <ul>
                                 
                                 
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

                        <div>
                            <div>

                          
                            </div> <br/>
                            <div> 
                               
                            <div class="business_pf_ct_person_form clearfix" style="padding: 0px;">
                            <div class="common-form contact_form" >                            <h3>Contact Person</h3>
                            <?php echo form_open_multipart(base_url('artistic/artistic_contactperson_query/'.$contactperson[0]['user_id']), array('id' => 'contactperson','name' => 'contactperson','class' => 'clearfix cntact-ss')); ?>
                             <ul class="artistic_pf_ct_person_detail">
                                    <li style="padding-top: 7px;"><b>Contact Person: </b><span><?php echo $contactperson[0]['art_name'];?></span></li>
                                    <li><b>Email Id: </b><span><?php echo $contactperson[0]['art_email'];?></span></li>
                                    <li><b >Phone No: </b><span><?php echo $contactperson[0]['art_phnno'];?></span></li>
                                </ul>

                                <div class="business_pf_ct_ clearfix">

                             <div class="buisness-contact-head"> <h4>Send your inquiry</h4></div>

                            

                                <fieldset>
                                    <label>Email Address</label>
                                    <input name="email"  type="text" id="email" placeholder="Enter  Email Address" value="<?php echo $userdata[0]['user_email']; ?>">

                                      <input name="toemail"  type="hidden" id="toemail" placeholder="Enter Your Email Address" value="<?php echo $contactperson[0]['art_email']; ?>">

                                       <?php echo form_error('email'); ?>
                                </fieldset>
                                
                                <fieldset class="full-width">
                                    <label>Details</label>
                                    <textarea name="msg" id="msg" placeholder="Enter Details" style="height: 20%; resize: none;"></textarea>
                                   
                                    <?php echo form_error('msg'); ?><br/>
                                </fieldset>
                                <fieldset class="full-width hs-submit">
                                    <button type="submit" value="Send" style="margin-right: 0px;">Send</button>
                                </fieldset>
                                </div>
                           <?php echo form_close(); ?>
                            </div>
                            </div>
                        </div>
                    </div>
                    

                    <!-- middle section end -->

                </div>
            </div>
        </div>
    </section>
   <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    
</body>
</html>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
 <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
  <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>


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


</script>
 -->


    <!-- footer end -->