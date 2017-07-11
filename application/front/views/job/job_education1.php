
<!-- start head -->
<?php  echo $head; ?> 
<!-- END HEAD -->

<!-- start header -->
 <?php echo $header; ?> 
<!-- END HEADER -->

    <body class="page-container-bg-solid page-boxed">

      <section>
       
        <div class="user-midd-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="left-side-bar">
                            <ul>
                               <li><a href="<?php echo base_url('job/job_basicinfo_update'); ?>">Basic Information</a></li>

                                <li><a href="<?php echo base_url('job/job_address_update'); ?>">Address</a></li>

                                  <li <?php if($this->uri->segment(1) == 'job'){?> class="active" <?php } ?>><a href="#">Educational Qualification</a></li>

                                  <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_project_update'); ?>">Project And Training / Internship</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_skill_update'); ?>">Professional Skills</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_apply_for_update'); ?>">Apply For</a></li>
                              
                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_work_exp_update'); ?>">Work Experience</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_curricular_update'); ?>">Extra Curricular Activities</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_reference_update'); ?>">Interest & Reference</a></li>

                                <li class="<?php if($jobdata[0]['job_step'] < '3'){echo "khyati";}?>"><a href="<?php echo base_url('job/job_carrier_update'); ?>">Carrier Objectives</a></li>
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

                            <div class="common-form">
                                <h3>Education</h3>
                            <?php echo form_open_multipart(base_url('job/job_education_insert'), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform','class' =>'clearfix')); ?>


                           

 <?php
     
 if($jobdata)
 {
   $count =  count($jobdata); 
      // echo"<pre>";print_r($count);die();
       for($x=0; $x<$count; $x++){
  
            $degree1 =  $jobdata[$x]['degree'];
            $stream1 = $jobdata[$x]['stream'];
            $university1 = $jobdata[$x]['university'];
            $college1 = $jobdata[$x]['college'];
            $grade1 = $jobdata[$x]['grade'];
            $percentage1 = $jobdata[$x]['percentage'];
           $pass_year1 = $jobdata[$x]['pass_year'];
           $degree_sequence= $jobdata[$x]['degree_sequence'];
           $stream_sequence= $jobdata[$x]['stream_sequence'];
            $edu_certificate1 = $jobdata[$x]['edu_certificate'];
 
//echo "<pre>";print_r($degree_sequence);
for($i =1; $i <6; $i++)
                    {
          
 ?>   
  
  <!--clone div start-->              
      <div id="edit_edu<?php echo $i;?>">
<?php
}
?>                  
         <!--  <fieldset <?php if($degree) {  ?> class="error-msg" <?php } ?>> -->
                                  <label>Degree:<span style="color:red">*</span></label>
                                <select name="degree[]" id="<?php echo $degree_sequence?>"  class="degree">
                                    <option value="">Select your degree</option>
                                    
                                      <?php
                                      //if(count($degree_data) > 0){ //echo"hii";die();
                                        if($degree1)
                                            { 
                                      foreach($degree_data as $cnt){ 
                                      
                                      ?>
                                           <option value="<?php echo $cnt['degree_id']; ?>" <?php if($cnt['degree_id']==$degree1) echo 'selected';?>><?php echo $cnt['degree_name'];?></option>

                                      <?php
                                      }} 
                                      else
                                      {
                                      ?>
                                          <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name']; ?></option>
                                      <?php 
                                      }
                                    
                                  
                                      ?>
                                      </select>
                                    <?php echo form_error('degree'); ?>

      <!--  </fieldset> -->

     <!--  <fieldset <?php if($stream) {  ?> class="error-msg" <?php } ?>> -->
     <?php

        $contition_array = array('status' => 1 ,'degree_id' => $degree1);
            
        $stream_data = $this->data['stream_data'] =  $this->common->select_data_by_condition('stream', $contition_array, $data = '*', $sortby = 'stream_name', $orderby = 'ASC', $limit = '', $offset = '', $join_str = array(), $groupby = '');

     ?>
                                      <label>Stream:<span style="color:red">*</span></label>

                                      <select name="stream[]" id="<?php echo $stream_sequence?>" class="stream" >

                                      <?php
                                   
                                      if($stream1)
                                            { 
                                      foreach($stream_data as $cnt){ 
                                        
                                      ?>
                                           <option value="<?php echo $cnt['stream_id']; ?>" <?php if($cnt['stream_id']==$stream1) echo 'selected';?>><?php echo $cnt['stream_name'];?></option>
                                      <?php
                                      }} 
                                       else
                                      {
                                      ?>
                                            <option value="">Select Degree first</option>
                                      <?php 
                                      
                                    }
                                      ?>
                                      
                                      ?>
                                     
                                      </select>
                                      <?php echo form_error('stream'); ?>  
        <!--   </fieldset>

<fieldset <?php if($univercity) {  ?> class="error-msg" <?php } ?>> -->
                                      <label>University:<span style="color:red">*</span></label>
                                       <select name="university[]" id="university1" class="university">
                                     
                                       <option value="" selected option disabled>Select your University</option>
                                       
                                       <?php
                                        if(count($university_data) > 0){
                                        foreach($university_data as $cnt){

                                          if($university1)
                                            {
                                      ?>
                                            <option value="<?php echo $cnt['university_id']; ?>" <?php if($cnt['university_id']==$university1) echo 'selected';?>><?php echo $cnt['university_name'];?></option>
                                       <?php
                                      }
                                      else
                                      {

                                      ?>
                                        <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>

                                        <?php 
                                      }
                                    }}
                                      ?>
                                      </select>
                                      <?php echo form_error('univercity'); ?> 
    <!-- </fieldset>  -->

       <!--  <fieldset <?php if($college) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>College:<span style="color:red">*</span></label>
                                    
                                         <input type="text" name="college[]" id="college1" class="college" placeholder="Enter College" value="<?php if($college1){ echo $college1; } ?>">
                                         <?php echo form_error('college'); ?>
     <!--    </fieldset>

      <fieldset <?php if($grade) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>Grade:<span style="color:red">*</span></label>
                                         <input type="text" name="grade[]" id="grade1" class="grade" placeholder="Enter Grade" value="<?php if($grade1){ echo $grade1; } ?>">
                                         <?php echo form_error('grade'); ?>
      <!-- </fieldset>

      <fieldset <?php if($percentage) {  ?> class="error-msg" <?php } ?>> -->
                                       <label>Percentage:<span style="color:red">*</span></label>
                                       <input type="number" name="percentage[]" id="percentage1" class="percentage" placeholder="Enter Percentage"  value="<?php if($percentage1){ echo $percentage1; } ?>" />
                                         <?php echo form_error('percentage'); ?>
     <!--  </fieldset>

      <fieldset <?php if($pass_year) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>Year of Passing:<span style="color:red">*</span></label>
                                         <select name="pass_year[]" id="pass_year1" class="pass_year" >
                                          <option value="" selected option disabled>--SELECT--</option>
                                         
                                          <?php 
                                          $curYear = date('Y');   
                                      
                                          for($i=$curYear; $i>=1900; $i--)
                                          {
                                            if($pass_year1)
                                          
                                            {
                                            ?>

                                              <option value="<?php echo $i ?>" <?php if($i==$pass_year1) echo 'selected';?>><?php echo $i?></option>


                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                              <option value="<?php echo $i ?>"><?php echo $i?></option>
                                        <?php
                                        }
                                          }
                                          ?> 
                                         
                                          </select>
                                         <?php echo form_error('pass_year'); ?>
      <!-- </fieldset>

      <fieldset> -->
                                        <label>Education Certificate</label>
                                         <input type="file" name="certificate[]" id="certificate1" class="certificate" placeholder="CERTIFICATE" multiple="" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>

                                         <?php 

                                         if($edu_certificate1)
                                         {
                                          ?>
                                       
                                      <img src="<?php echo base_url(JOBEDUCERTIFICATE.$edu_certificate1)?>" style="width:100px;height:100px;">
                                  
                                      <?php 
                                    }
                                    ?>
                                        <?php echo form_error('certificate'); ?>
                                 <!--    </fieldset>   -->
                    

</div> 

<?php
}
?>
                                    <div class="hs-submit full-width">
                                    
                                     <input type="reset">

                                     </div>

                                    <div class="hs-submit full-width">
                                
                                    <input type="submit"  id="previous" name="previous" value="previous">
                                    </div>

                                    <div class="hs-submit full-width">

                                       <input type="submit"  id="next" name="next" value="Next">
                                        </div>
                                 
                                    <div class="hs-submit full-width">
                                 

                                 <input type="submit"  id="add_edu" name="add_edu" value="Add More Education"> 
 
                                     </div>
                                    </form> 
      
<?php      
}
else
{
?>     
<!--clone div start-->              
  <div id="input1" style="margin-bottom:4px;" class="clonedInput">
                    
         <!--  <fieldset <?php if($degree) {  ?> class="error-msg" <?php } ?>> -->
                                  <label>Degree:<span style="color:red">*</span></label>
                                <select name="degree[]" id="degree1" class="degree">
                                    <option value="">Select your degree</option>
                                    
                                      <?php
                                      //if(count($degree_data) > 0){ //echo"hii";die();
                                      foreach($degree_data as $cnt){ 
                                        if($degree1)
                                            {
                                      ?>
                                           <option value="<?php echo $cnt['degree_id']; ?>" <?php if($cnt['degree_id']==$degree1) echo 'selected';?>><?php echo $cnt['degree_name'];?></option>

                                      <?php
                                      }
                                      else
                                      {
                                      ?>
                                          <option value="<?php echo $cnt['degree_id']; ?>"><?php echo $cnt['degree_name']; ?></option>
                                      <?php 
                                      }
                                    //}
                                  }
                                      ?>
                                      </select>
                                    <?php echo form_error('degree'); ?>

      <!--  </fieldset> -->

     <!--  <fieldset <?php if($stream) {  ?> class="error-msg" <?php } ?>> -->
                                      <label>Stream:<span style="color:red">*</span></label>

                                      <select name="stream[]" id="stream1" class="stream" >

                                      <?php
                                   
                                      if($stream1)
                                            { 
                                      foreach($stream_data as $cnt){ 
                                        
                                      ?>
                                           <option value="<?php echo $cnt['stream_id']; ?>" <?php if($cnt['stream_id']==$stream1) echo 'selected';?>><?php echo $cnt['stream_name'];?></option>
                                      <?php
                                      }}
                                      else
                                      {
                                      ?>
                                            <option value="">Select Degree first</option>
                                      <?php 
                                      
                                    }
                                      ?>
                                     
                                      </select>
                                      <?php echo form_error('stream'); ?>  
        <!--   </fieldset>

<fieldset <?php if($univercity) {  ?> class="error-msg" <?php } ?>> -->
                                      <label>University:<span style="color:red">*</span></label>
                                       <select name="university[]" id="university1" class="university">
                                     
                                       <option value="" selected option disabled>Select your University</option>
                                       
                                       <?php
                                        if(count($university_data) > 0){
                                        foreach($university_data as $cnt){

                                          if($university1)
                                            {
                                      ?>
                                            <option value="<?php echo $cnt['university_id']; ?>" <?php if($cnt['university_id']==$university1) echo 'selected';?>><?php echo $cnt['university_name'];?></option>
                                       <?php
                                      }
                                      else
                                      {

                                      ?>
                                        <option value="<?php echo $cnt['university_id']; ?>"><?php echo $cnt['university_name']; ?></option>

                                        <?php 
                                      }
                                    }}
                                      ?>
                                      </select>
                                      <?php echo form_error('univercity'); ?> 
    <!-- </fieldset>  -->

       <!--  <fieldset <?php if($college) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>College:<span style="color:red">*</span></label>
                                    
                                         <input type="text" name="college[]" id="college1" class="college" placeholder="Enter College" value="<?php if($college1){ echo $college1; } ?>">
                                         <?php echo form_error('college'); ?>
     <!--    </fieldset>

      <fieldset <?php if($grade) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>Grade:<span style="color:red">*</span></label>
                                         <input type="text" name="grade[]" id="grade1" class="grade" placeholder="Enter Grade" value="<?php if($grade1){ echo $grade1; } ?>">
                                         <?php echo form_error('grade'); ?>
      <!-- </fieldset>

      <fieldset <?php if($percentage) {  ?> class="error-msg" <?php } ?>> -->
                                       <label>Percentage:<span style="color:red">*</span></label>
                                       <input type="number" name="percentage[]" id="percentage1" class="percentage" placeholder="Enter Percentage"  value="<?php if($percentage1){ echo $percentage1; } ?>" />
                                         <?php echo form_error('percentage'); ?>
     <!--  </fieldset>

      <fieldset <?php if($pass_year) {  ?> class="error-msg" <?php } ?>> -->
                                        <label>Year of Passing:<span style="color:red">*</span></label>
                                         <select name="pass_year[]" id="pass_year1" class="pass_year" >
                                          <option value="" selected option disabled>--SELECT--</option>
                                         
                                          <?php 
                                          $curYear = date('Y');   
                                      
                                          for($i=$curYear; $i>=1900; $i--)
                                          {
                                            if($pass_year1)
                                          
                                            {
                                            ?>

                                              <option value="<?php echo $i ?>" <?php if($i==$pass_year1) echo 'selected';?>><?php echo $i?></option>


                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                              <option value="<?php echo $i ?>"><?php echo $i?></option>
                                        <?php
                                        }
                                          }
                                          ?> 
                                         
                                          </select>
                                         <?php echo form_error('pass_year'); ?>
      <!-- </fieldset>

      <fieldset> -->
                                        <label>Education Certificate</label>
                                         <input type="file" name="certificate[]" id="certificate1" class="certificate" placeholder="CERTIFICATE" multiple="" />&nbsp;&nbsp;&nbsp; <span id="certificate-error"> </span>

                                         <?php 

                                         if($edu_certificate1)
                                         {
                                          ?>
                                       
                                      <img src="<?php echo base_url(JOBEDUCERTIFICATE.$edu_certificate1)?>" style="width:100px;height:100px;">
                                  
                                      <?php 
                                    }
                                    ?>
                                        <?php echo form_error('certificate'); ?>
                                 <!--    </fieldset>   -->
                    



</div> 
<!--clone div End-->              
                   
                           

                                    <div class="hs-submit full-width">
                                     <input type="reset">
                                     </div>

                                    <div class="hs-submit full-width">
                                    <input type="submit"  id="previous" name="previous" value="previous">
                                    </div>

                                    <div class="hs-submit full-width">
                                       <input type="submit"  id="next" name="next" value="Next">
                                 </div>
                                <!--  <input type="submit"  id="add_edu" name="add_edu" value="Add More Education"> -->

                                     
                                    </form> 
                                  
                                                   <div class="hs-submit full-width">
        
        <input type="button" id="btnRemove" value=" - " />
</div>     <div class="hs-submit full-width">
                <input type="button" id="btnAdd" value=" + " />
        
        </div>
                                </fieldset>
       
                                

<?php
}         
?>        
                                    

                            </div>    
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
 
</body>
</html>


<script type="text/javascript" src="<?php echo base_url('js/jquery-ui.js') ?>"></script> 

 <!-- duplicate div -->
   <script type="text/javascript" src="<?php echo base_url('js/jquery.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('js/app.js') ?>"></script> 
  <!-- duplicate div end -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>



<!--validation for edit email formate form-->
<script type="text/javascript">
           $().ready(function () { 

                $("#jobseeker_regform").validate({

                    rules: {

                        'degree[]': {

                            required: true,
                           
                        },

                         'stream[]': {

                             required: true,
                           
                         },
                       
                        'university[]': {

                            required: true,
                            
                        },
                       
                        'college[]': {

                            required: true,
                           
                        },
                      'grade[]': {

                            required: true,
                           
                        },
                        'percentage[]': {

                            required: true,
                           
                        },
                        'pass_year[]': {

                            required: true,
                           
                        },
                        
                    },

                    messages: {

                        'degree[]': {

                            required: "Degree Is Required.",
                            
                        },

                       'stream[]': {

                           required: "Stream Is Required.",
                            
                       },

                         'university[]': {

                            required: "University  Is Required.",
                             
                        },

                        'college[]': {

                            required: "College Is Required.",
                            
                        },
                        'grade[]': {

                            required: "Grade Is Required.",
                            
                        },
                        'percentage[]': {

                            required: "Percentage Is Required.",
                            
                        },
                         'pass_year[]': {

                            required: "Pass_year Is Required.",
                            
                        },
                        
                    }

               });
                   });
  </script>

<!-- Clone input type start-->
<script>

$('#btnRemove').attr('disabled', 'disabled');
$('#btnAdd').click(function() {
    var num = $('.clonedInput').length;
    var newNum = new Number(num + 1);

     if (newNum > 5) 
    {
      
      $('#btnAdd').attr('disabled', 'disabled');
      alert("You Can add only 5 fields");
      return false;
      
    }

    var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

    newElem.children('.degree').attr('id', 'degree' + newNum).attr('name', 'degree[]');
    newElem.children('.stream').attr('id', 'stream' + newNum).attr('name', 'stream[]');
    newElem.children('.university').attr('id', 'university' + newNum).attr('name', 'university[]');
    newElem.children('.college').attr('id', 'college' + newNum).attr('name', 'college[]');
    newElem.children('.grade').attr('id', 'grade' + newNum).attr('name', 'grade[]');
    newElem.children('.percentage').attr('id', 'percentage' + newNum).attr('name', 'percentage[]');
    newElem.children('.pass_year').attr('id', 'pass_year' + newNum).attr('name', 'pass_year[]');
    newElem.children('.certificate').attr('id', 'certificate' + newNum).attr('name', 'certificate[]');

    $('#input' + num).after(newElem);
    $('#btnRemove').removeAttr('disabled', 'disabled');


});




$('#btnRemove').on('click', function() {
    $('.clonedInput').last().remove();

   
});


$('#btnAdd').on('click', function() {
 
    $('.clonedInput').last().add().find("input:text").val("");
    
});
</script>
<!-- Clone input type End-->



<!-- stream change depend on degeree start-->
<script>
$(document).on('change','select.degree',function(event) {//alert('SDDSD');
      var aa = $(this).attr('id');
  var lastChar = aa.substr(aa.length - 1);

    var degreeID = $('option:selected', this).val();

    //alert(".DeleteBtn Click Function -  " + $(this).attr('id'));

    // var degreeID = $(this).val();
        //alert(degreeID);
        if(degreeID){
         
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job/ajax_data"; ?>',
                data:'degree_id='+degreeID,
                success:function(html){//alert("#stream"+lastChar);
                    $("#stream"+lastChar).html(html);
                  //   $('#productid2').html(html);
                    
                }
            }); 
        }else{
            $('#stream'+ lastChar).html('<option value="">Select Degree first</option>');
            
        }
    });
</script>
<!-- stream change depend on degeree start-->



