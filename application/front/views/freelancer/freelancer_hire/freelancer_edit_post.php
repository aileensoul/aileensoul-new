<!-- start head -->
<?php  echo $head; ?>
    <!-- END HEAD -->
    <!-- start header -->
     
<?php echo $header; ?>
    <!-- END HEADER -->
    <!-- pallavi 14-4-2017 -->
    <?php echo $freelancer_hire_header2; ?>
    <!-- pallavi end 14-4-2017 -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/3.3.0/select2.css'); ?>">
     <link href="<?php echo base_url('css/jquery-ui.css') ?>" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">

      <!-- This Css is used for call popup -->
   <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />


     <!-- Calender Css Start-->
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery.datetimepicker.css'); ?>">
   <!-- Calender Css End-->


<!-- css for date picker start-->
<style type="text/css">

.date-dropdowns .day, .date-dropdowns .month, .date-dropdowns .year{width: 30%; float: left; margin-right: 5%;}
.date-dropdowns .year{margin-right: 0;}
.example {
    width: 33%;
    min-width: 400px;
    padding: 15px;
    display: inline-block;
    box-sizing: border-box;
    text-align: center;
}

.example:first-of-type {
    position: relative;
    bottom: 35px;
}

/* Example Heading */
.example h2 {
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
    font-size: 1.3em;
    margin: 15px 0;
    color: #4F5462;
}

.example input {
    display: block;
    margin: 0 auto 20px auto;
    width: 150px;
    padding: 8px 10px;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    background: #F2F2F2;
    text-align: center;
    font-size: 1em;
    letter-spacing: 0.02em;
    font-family: "Roboto Condensed", helvetica, arial, sans-serif;
}

.example select {
    padding: 10px;
    background: #ffffff;
    border: 1px solid #CCCCCC;
    border-radius: 3px;
    margin: 0 3px;
}

.example select.invalid {
    color: #E9403C;
}

.example input[type="submit"] {
    margin-top: 10px;
}

.example input[type="submit"]:hover {
    cursor: pointer;
    background-color: #e5e5e5;
}


</style>
<!-- css for date picker end-->
    <body class="page-container-bg-solid page-boxed">

      <section>
        
        <div class="user-midd-section" id="paddingtop_fixed">
            <div class="container">
                <div class="row">
                    <!-- <?php echo $freelancer_hire_left; ?> -->
                    <div class="col-md-3"></div>
                    <div class="col-md-7 col-sm-8">


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
                    <h3 class="h3_edit">Edit Post</h3>

                   
                    
                 <?php echo form_open(base_url('freelancer/freelancer_edit_post_insert/'.$freelancerpostdata[0]['post_id']), array('id' => 'postinfo','name' => 'postinfo','class' => 'clearfix form_addedit')); ?>

                  <div>
                            <h4 class="freelancer_editpost_title"> Project Description</h4></div>

                 
                                <div>
                                   <span style="color:#7f7f7e;padding-left: 8px;">( </span><span style="color:red">*</span><span style="color:#7f7f7e"> )</span> 
                                   <span style="color:#7f7f7e">Indicates required field</span>
                                </div> 

                            <fieldset class="full-width">
                                <label>Post Title:<span style="color:red">*</span></label>
                                <input name="post_name" type="text" id="post_name" tabindex="1" autofocus placeholder="Enter Post Name" value="<?php echo $freelancerpostdata[0]['post_name']?> "/>
                                <span id="fullname-error"></span>                        
                                <?php echo form_error('post_name'); ?>
                            </fieldset>

                            <fieldset class="full-width">
                                <label>Post description:<span style="color:red">*</span></label>

                                <textarea style="resize: none;height: 22%;overflow: auto;" tabindex="2" name="post_desc" id="post_desc" placeholder="Enter Description"><?php echo $freelancerpostdata[0]['post_description']; ?></textarea>

                                
                                <?php echo form_error('post_desc'); ?>
                           </fieldset>


                           <fieldset class="full-width" <?php if($fields_req) {  ?> class="error-msg" <?php } ?>>
                  <label>Fields Of Requirement:<span style="color:red">*</span></label>
                   <select tabindex="3" name="fields_req" id="fields_req">
                        <option value="" selected option disabled>Select Fields of Requirement</option>
                 <?php  
                                            if(count($category) > 0){ 
                                                           foreach($category as $cnt){  
                                          
                                            if($freelancerpostdata[0]['post_field_req'])
                                            {  
                                              ?>
                                                 <option value="<?php echo $cnt['category_id']; ?>" <?php if($cnt['category_id'] == $freelancerpostdata[0]['post_field_req']) echo 'selected';?>><?php echo $cnt['category_name'];?></option>
                                               
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                              
                                                  <option value="<?php echo $cnt['category_id']; ?>"><?php echo $cnt['category_name'];?></option> 
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
                            </select>
                            <?php echo form_error('fields_req'); ?>
                            </fieldset>

                            <fieldset class="full-width" <?php if($post_skill) {  ?> class="error-msg" <?php } ?>>
                                <label>Skills of Requirements:<span style="color:red">*</span></label>
                               
                                  <select tabindex="4" name="skills[]" id ="skill1" multiple="multiple" style="width:100% " class="keyskil">


                                 <?php foreach ($skill1 as $skill) { ?>
                                <option value="<?php echo $skill['skill_id']; ?>"><?php echo $skill['skill']; ?></option>
                                  <?php } ?>

                                </select>
                                <?php echo form_error('skills'); ?>
                                </select>
                            </fieldset>

                            <fieldset class="full-width" <?php if($other_skill) {  ?> class="error-msg" <?php } ?> >
                            <label class="control-label">Other Skill:</label>
                            <input name="other_skill" tabindex="5" type="text" id="other_skill" class="keyskil" placeholder="Enter Your Other Skill" value="<?php echo $freelancerpostdata[0]['post_other_skill']; ?>" />
                                <span id="fullname-error"></span>
                                <?php echo form_error('other_skill'); ?>
                        </fieldset>


              <fieldset class="full-width two-select-box fullwidth_experience"> 
                                <label>Experience:</label>
                                
                                <select name="year" id="year" tabindex="6">
                                    <!-- <option value="<?php //echo $freelancerpostdata[0]['post_exp_year']?>"><?php //echo $freelancerpostdata[0]['post_exp_year']." Year"?></option> -->
                       <option value="" selected option disabled>Year</option>
                                    <option value="0" <?php if($freelancerpostdata[0]['post_exp_year']=="0") echo 'selected="selected"'; ?>>0 Year</option>
                                    <option value="1" <?php if($freelancerpostdata[0]['post_exp_year']=="1") echo 'selected="selected"'; ?>>1 Year</option>
                                    <option value="2" <?php if($freelancerpostdata[0]['post_exp_year']=="2") echo 'selected="selected"'; ?>>2 Year</option>
                                    <option value="3" <?php if($freelancerpostdata[0]['post_exp_year']=="3") echo 'selected="selected"'; ?>>3 Year</option>
                                    <option value="4" <?php if($freelancerpostdata[0]['post_exp_year']=="4") echo 'selected="selected"'; ?>>4 Year</option>
                                    <option value="5" <?php if($freelancerpostdata[0]['post_exp_year']=="5") echo 'selected="selected"'; ?>>5 Year</option>
                                    <option value="6" <?php if($freelancerpostdata[0]['post_exp_year']=="6") echo 'selected="selected"'; ?>>6 Year</option>
                                    <option value="7" <?php if($freelancerpostdata[0]['post_exp_year']=="7") echo 'selected="selected"'; ?>>7 Year</option>
                                    <option value="8" <?php if($freelancerpostdata[0]['post_exp_year']=="8") echo 'selected="selected"'; ?>>8 Year</option>
                                    <option value="9" <?php if($freelancerpostdata[0]['post_exp_year']=="9") echo 'selected="selected"'; ?>>9 Year</option>
                                    <option value="10" <?php if($freelancerpostdata[0]['post_exp_year']=="10") echo 'selected="selected"'; ?>>10 Year</option>
                                    <option value="11" <?php if($freelancerpostdata[0]['post_exp_year']=="11") echo 'selected="selected"'; ?>>11 Year</option>
                                    <option value="12" <?php if($freelancerpostdata[0]['post_exp_year']=="12") echo 'selected="selected"'; ?>>12 Year</option>
                                    <option value="13" <?php if($freelancerpostdata[0]['post_exp_year']=="13") echo 'selected="selected"'; ?>>13 Year</option>
                                    <option value="14" <?php if($freelancerpostdata[0]['post_exp_year']=="14") echo 'selected="selected"'; ?>>14 Year</option>
                                    <option value="15" <?php if($freelancerpostdata[0]['post_exp_year']=="15") echo 'selected="selected"'; ?>>15 Year</option>
                                    <option value="16" <?php if($freelancerpostdata[0]['post_exp_year']=="16") echo 'selected="selected"'; ?>>16 Year</option>
                                    <option value="17" <?php if($freelancerpostdata[0]['post_exp_year']=="17") echo 'selected="selected"'; ?>>17 Year</option>
                                    <option value="18" <?php if($freelancerpostdata[0]['post_exp_year']=="18") echo 'selected="selected"'; ?>>18 Year</option>
                                    <option value="19" <?php if($freelancerpostdata[0]['post_exp_year']=="19") echo 'selected="selected"'; ?>>19 Year</option>
                                    <option value="20" <?php if($freelancerpostdata[0]['post_exp_year']=="20") echo 'selected="selected"'; ?>>20 Year</option>
                                </select>
                                <span id="fullname-error"></span>
                                <?php echo form_error('year'); ?>

                                <select name="month" style="margin-left: 8px;" tabindex="7" id="month">
                                   <!--  <option value="<?php //echo $freelancerpostdata[0]['post_exp_month']?> "><?php //echo $freelancerpostdata[0]['post_exp_month']." Month"?></option> -->
                                    <!-- <option >Month</option> -->
                                     <option value="" selected option disabled>Month</option>

                                  <option value="0" <?php if($freelancerpostdata[0]['post_exp_month']=="0") echo 'selected="selected"'; ?>>0 Month</option>
                                   <option value="1" <?php if($freelancerpostdata[0]['post_exp_month']=="1") echo 'selected="selected"'; ?>>1 Month</option>
                                  <option value="2" <?php if($freelancerpostdata[0]['post_exp_month']=="2") echo 'selected="selected"'; ?>>2 Month</option>
                                  <option value="3" <?php if($freelancerpostdata[0]['post_exp_month']=="3") echo 'selected="selected"'; ?>>3 Month</option>
                                  <option value="4" <?php if($freelancerpostdata[0]['post_exp_month']=="4") echo 'selected="selected"'; ?>>4 Month</option>
                                   <option value="5" <?php if($freelancerpostdata[0]['post_exp_month']=="5") echo 'selected="selected"'; ?>>5 Month</option>
                                  <option value="6"<?php if($freelancerpostdata[0]['post_exp_month']=="6") echo 'selected="selected"'; ?>>6 Month</option>
                               </select>
                                <?php echo form_error('month'); ?>
                                
                            </fieldset>



                            

                            <fieldset class="col-md-12">  
                             <b><h2 class="freelancer_editpost_title">Payment For Freelancer : </h2></b>
                            </fieldset>

                            <fieldset style="padding-left: 8px;" class="col-md-4" <?php if($rate) {  ?> class="error-msg" <?php } ?> >
                            <label class="control-label">Rate:<span style="color:red">*</span></label>
                            <input name="rate" type="number" id="rate" tabindex="8" placeholder="Enter Your rate" value="<?php echo $freelancerpostdata[0]['post_rate']; ?>" />
                                <span id="fullname-error"></span>
                                <?php echo form_error('rate'); ?>
                            </fieldset>

                            <fieldset class=" col-md-4"> 
                     <label>Currency:<span class="red">*</span></label>
                            <select name="currency" id="currency" tabindex="9">
                             <option value="" selected option disabled>Select Currency</option>
                            <?php if(count($currency) > 0){
                            foreach($currency as $cur){ 

                                if($freelancerpostdata[0]['post_currency'])
                                            {?>

                                         <option value="<?php echo $cur['currency_id']; ?>" <?php if($cur['currency_id'] == $freelancerpostdata[0]['post_currency']) echo 'selected';?>><?php echo $cur['currency_name'];?></option>
                                            <?php }else{
                                ?>
                             <option value="<?php echo $cur['currency_id']; ?>"><?php echo $cur['currency_name']; ?></option>
                             <?php  } } }?>
                             </select>

          
                             <?php echo form_error('currency'); ?>

                    </fieldset>
                    <fieldset class="col-md-4">
                    <label>Work Type</label>
                    
  <input type="radio" name="rating" tabindex="10" <?php if($freelancerpostdata[0]['post_rating_type']==0){ ?> checked <?php } ?> value="0" > Hourly
  
  <input type="radio" name="rating"  <?php if($freelancerpostdata[0]['post_rating_type']==1){?> checked <?php }?> value ="1"> Fixed
  
  <?php echo form_error('rating'); ?>
                               </fieldset>

                            
                             <fieldset>
                                <label>Estimated time of project:</label>
                                <input name="est_time" type="text" tabindex="11" id="est_time" placeholder="Enter Estimated time in month/year" value="<?php echo $freelancerpostdata[0]['post_est_time']?> "/>
                                <span id="fullname-error"></span>
                                <?php echo form_error('post_name'); ?>
                            </fieldset>

                            
                         <fieldset <?php if($last_date) {  ?> class="error-msg" <?php } ?>>
                        <label>Last date for apply:<span style="color:red">*</span></label>

                         <input type="hidden" id="example2">

                       <!--  <input type="text" name="last_date" id="datepicker" tabindex="12" placeholder="dd/mm/yyyy"   autocomplete="off" value="<?php echo $freelancerpostdata[0]['post_last_date']?>" > -->

                        <?php echo form_error('last_date'); ?> 
                    </fieldset>
  

                        <!-- <fieldset <?php if($last_date) {  ?> class="error-msg" <?php } ?>>
                        <label>Last date for apply:</label>
                        <input type="date" name="last_date" placeholder="Enter date" id="last_date1" value="<?php echo $freelancerpostdata[0]['post_last_date']?>">
                        <?php echo form_error('last_date'); ?> 
                        </fieldset>
 -->
                           <!--  <fieldset>
                                <label class="full-width">Location:</label>
                                <input name="location" type="text" id="location" onblur="return full_name();" value="<?php echo $freelancerpostdata[0]['post_location']?>" /><span id="fullname-error"></span>
                                <?php  ?>
                            </fieldset> -->


                            <fieldset <?php if($country) {  ?> class="error-msg" <?php } ?>>
                <label>Country:<span style="color:red">*</span></label>
                
                        <select name="country" id="country" tabindex="13">
                         
                           <option value="" selected option disabled>Select Country</option>
                          <?php
                                            if(count($countries) > 0){
                                                foreach($countries as $cnt){
                                          
                                            if($country1)
                                            {
                                              ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>" <?php if($cnt['country_id']==$country1) echo 'selected';?>><?php echo $cnt['country_name'];?></option>
                                               
                                                <?php
                                                }
                                                else
                                                {
                                            ?>
                                                 <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name'];?></option>
                                                  <?php
                                            
                                            }
       
                                            }}
                                            ?>
                      </select><span id="country-error"></span>
                   <?php echo form_error('country'); ?>
                  </fieldset>

    <fieldset <?php if($state) {  ?> class="error-msg" <?php } ?>>
                  <label>State:<span class="red">*</span></label>
                   <select tabindex="2" name="state" id="state">
                  <?php
                                          if($state1)

                                            {
                                            foreach($states as $cnt){
                                                
                                                 
                                              ?>

                                                 <option value="<?php echo $cnt['state_id']; ?>" <?php if($cnt['state_id']==$state1) echo 'selected';?>><?php echo $cnt['state_name'];?></option>
                                               
                                                <?php
                                                } }
                                              
                                                else
                                                {
                                            ?>
                                                 <option value="">Select country first</option>
                                                  <?php
                                            
                                            }
                                            ?>
                </select>
                                <?php echo form_error('state'); ?>
                  </fieldset>

                  <fieldset>
                    <label> City:</label>
                  <select name="city" id="city" tabindex="14">
                    <?php

                                         if($city1)

                                            {
                                          foreach($cities as $cnt){
                                               
                                              ?>

                                               <option value="<?php echo $cnt['city_id']; ?>" <?php if($cnt['city_id']==$city1) echo 'selected';?>><?php echo $cnt['city_name'];?></option>

                                                <?php
                                                } }
                                                else if($state1)
                                             {
                                            ?>
                                            <option value="">Select City</option>
                                            <?php
                                            foreach ($cities as $cnt) {
                                                ?>

                                                <option value="<?php echo $cnt['city_id']; ?>"><?php echo $cnt['city_name']; ?></option>

                                                <?php
                                            }
                                        }
                                              
                                                else
                                                {
                                            ?>
                                        <option value="">Select state first</option>

                                         <?php
                                            
                                            }
                                            ?>
                  </select><span id="city-error"></span>
                                    <?php echo form_error('city'); ?>
                </fieldset>

                            <fieldset class="hs-submit full-width">

                                <!-- <input type="reset"> -->
                                
                             <?php if(($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_add_post') || ($this->uri->segment(1) == 'freelancer' && $this->uri->segment(2) == 'freelancer_edit_post')){?>
                                
                               
                                 <a class="add_post_btnc" onclick="return leave_page(9)">Cancel</a>
                                 <?php }else{?>

                                 <a class="add_post_btnc"  href="javascript:history.back()">Cancel</a>
                                 <?php } ?>
                                 
                                <input type="submit" tabindex="15" id="submit" class="add_post_btns" name="submit" value="Save">
                                
                            </fieldset>
                            </div>

                            </form>
                            </div>
                    
                   
                </div>
            </div>
        </div>
    </section>

<!-- Bid-modal  -->
          <div class="modal fade message-box biderror" id="bidmodal" role="dialog">
              <div class="modal-dialog modal-lm">
                  <div class="modal-content">
                     <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                         <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                      <span class="mes"></span>
                    </div>
                </div>
          </div>
       </div>
  <!-- Model Popup Close -->
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <!-- BEGIN INNER FOOTER -->
    <?php echo $footer; ?>
    <!-- end footer -->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
   <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
       <script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>  
   
        <script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>

<!-- This Js is used for call popup -->

<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('js/jquery.datetimepicker.full.js'); ?>"></script>
<script type="text/javascript">
$('#datepicker').datetimepicker({
  //yearOffset:222,
 // startDate: "2013/02/14",
 minDate:0,
  lang:'ch',
  timepicker:false,
  format:'d/m/Y',
  formatDate:'Y/m/d',
  scrollMonth : false,
  scrollInput : false
  //minDate:'-1970/01/02', // yesterday is minimum date
  //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
<!-- Calender Js End-->

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

  <script type="text/javascript">

function checkvalue(){
   //alert("hi");
  var searchkeyword=$.trim(document.getElementById('tags').value);
  var searchplace=$.trim(document.getElementById('searchplace').value);
  // alert(searchkeyword);
  // alert(searchplace);
  if(searchkeyword == "" && searchplace == ""){
     alert('Please enter Keyword');
    return false;
  }
}

function checkvalue_search() {
       
        var searchkeyword = $.trim(document.getElementById('tags').value);
        var searchplace = $.trim(document.getElementById('searchplace').value);
        
        if (searchkeyword == "" && searchplace == "") 
        {
          //  alert('Please enter Keyword');
            return false;
        }
    }


//Leave Page on add and edit post page start
  function leave_page(clicked_id)
{

//alert(clicked_id);
 
 
   var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    
 
   
    if(clicked_id==4)
    {
       if(searchkeyword=="" && searchplace=="" )
       {
            return checkvalue_search;
       }
      
    }
   
      return home(clicked_id,searchkeyword,searchplace);

    }

  function home(clicked_id,searchkeyword,searchplace) {
  
                        
      $('.biderror .mes').html("<div class='pop_content'>Do you want to discard your changes?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='home_profile("+ clicked_id +','+'"'+ searchkeyword + '"'+','+'"'+ searchplace + '"' +")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
          $('#bidmodal').modal('show');

 }

 function home_profile(clicked_id,searchkeyword,searchplace){
  
  var  url,data;
  
  
if (clicked_id == 4) {
    url = '<?php echo base_url() . "search/freelancer_hire_search" ?>';

   
    data='id=' + clicked_id + '&skills=' + searchkeyword+ '&searchplace=' + searchplace;
    
} 

  
                  $.ajax({
                      type: 'POST',
                      url: url,
                      data: data,
                        success: function (data) {
                            if(clicked_id==1)
                            {
                              // alert("hsjdh");

                                  window.location= "<?php echo base_url('freelancer/recommen_candidate'); ?>";    
                            }
                            else if(clicked_id==2)
                            {
                                window.location= "<?php echo base_url('freelancer/freelancer_hire_profile'); ?>"; 
                            }
                            else if(clicked_id==3)
                            {
                                window.location= "<?php echo base_url('freelancer_hire/freelancer_hire_basic_info'); ?>"; 
                            }
                            else if(clicked_id==4)
                            {
                                   
                                if(searchkeyword=="")
                                        {
               
                                        window.location= "<?php echo base_url() ?>search/freelancer_hire_search/"+0+"/"+searchplace; 

                                        }
                                    else if(searchplace=="")
                                        {
                
                                             window.location= "<?php echo base_url() ?>search/freelancer_hire_search/"+searchkeyword+"/"+0; 
                                        }
                                        else
                                         {
                                          window.location= "<?php echo base_url() ?>search/freelancer_hire_search/"+searchkeyword+"/"+searchplace; 
                                        }
                                 
                                 
                                
                            }
                             else if(clicked_id==5)
                            {
                                window.location= "<?php echo base_url('dashboard') ?>"; 
                            }
                             else if(clicked_id==6)
                            {
                                window.location= "<?php echo base_url() . 'profile' ?>"; 
                            }
                             else if(clicked_id==7)
                            {
                                window.location= "<?php echo base_url('registration/changepassword') ?>"; 
                            }
                             else if(clicked_id==8)
                            {
                                window.location= "<?php echo base_url('dashboard/logout') ?>"; 
                            }
                            else if(clicked_id==9)
                            {
                                        location.href = 'javascript:history.back()';
                            }
                            else
                            {
                                alert("edit profilw");
                            }
                                     
                                }
                            });


 }
 //Leave Page on add and edit post page End
</script>




<!-- Field Validation Js Start -->
 

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate1.15.0..min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/additional-methods1.15.0.min.js'); ?>"></script> 
<!-- Field Validation Js End -->
<!-- javascript validation start -->
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



// for date validtaion start

jQuery.validator.addMethod("isValid", function (value, element) {


var todaydate = new Date();
var dd = todaydate.getDate();
var mm = todaydate.getMonth()+1; //January is 0!
var yyyy = todaydate.getFullYear();

if(dd<10) {
    dd='0'+dd
} 

if(mm<10) {
    mm='0'+mm
} 

  var todaydate = yyyy+'-'+mm+'-'+dd;
 
    var one = new Date(value).getTime();
    var second = new Date(todaydate).getTime();
   
    return one >= second;
    
}, "Last date should be grater than and equal to today date");

//date validation end




            $(document).ready(function () { 

                $("#postinfo").validate({

                  ignore: '*:not([name])',

                    rules: {

                        post_name: {

                            required: true,
                            regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                            //noSpace: true
                           
                        },

                         'skills[]': {
                            
                          require_from_group: [1, ".keyskil"] 
                          //required:true 
                        }, 

                        other_skill: {
                            
                           require_from_group: [1, ".keyskil"],
                          regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                            // required:true 
                        },
                        fields_req:{
                            required:true,
                        },
                      
                       post_desc: {

                            required: true,
                            regx:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                           //noSpace: true
                           
                        },
                        last_date:{
                          required:true,
                          isValid: 'Last date should be grater than and equal to today date'
                        },
                        currency:{
                          required:true,
                        },
                        rate:{
                          required:true,
                          noSpace: true
                        },
                        country:{
                          required:true,
                        },
                        state:{
                          required:true,
                        }
                      
                    },

                    messages: {

                        post_name: {

                            required: "Post name Is Required.",
                            
                        },

                       'skills[]': {

                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",

                        },

                        other_skill: {

                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'",
                        },
                        fields_req:{
                          required:"Please Select Field of Requirement",
                        },
                        
                        post_desc: {

                            required: "Post Description  Is Required.",
                            
                        },
                       last_date:{
                         required:"Last Date of apply is required.",
                       },
                       currency:{
                        required:"Please select currency type",
                       },
                       rate:{
                        required:"Rate is Required",
                       },
                       country:{
                        required:"Please Select Country"
                       },
                       state:{
                        required:"Please select State"
                       }

                    }

                });
                   });
</script>
<!-- javascript validation End -->

<!-- country city dependent -->

<script type="text/javascript">

$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        alert(countryID);
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "freelancer/ajax_dataforcity"; ?>',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "freelancer/ajax_dataforcity"; ?>',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
<!-- script for skill textbox automatic start (option 2)-->
<script type="text/javascript" src="<?php echo base_url('js/3.3.0/select2.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->

<script>

//select2 autocomplete start for skill
$('#skills').select2({
        
        placeholder: 'Find Your Skills',
       
        ajax:{

         
          url: "<?php echo base_url(); ?>freelancer/keyskill",
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
//select2 autocomplete End for skill

</script>
 <script>

var complex = <?php echo json_encode($selectdata); ?>;

$("#skill1").select2().select2('val',complex)

</script>

<script src="<?php echo base_url('js/jquery.date-dropdowns.js'); ?>"></script>
<script>
$(function() {
                

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

var today = yyyy;

var date_picker ='<?php echo date('Y-m-d',strtotime($freelancerpostdata[0]['post_last_date']));?>';

                $("#example2").dateDropdowns({
                    submitFieldName: 'last_date',
                    submitFormat: "yyyy-mm-dd",
                    minYear: today,
                    maxYear: today + 1,
                    defaultDate: date_picker,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //startDate: today,

                });   
                
            });
</script>

<style type="text/css">
  #example2-error{margin-top: 42px!important;}
</style>