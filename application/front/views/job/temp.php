<?php echo form_open_multipart(base_url('job/temp_insert'), array('id' => 'jobseeker_regform','name' => 'jobseeker_regform','class' =>'clearfix')); ?>

<div id="input1" style="margin-bottom:4px;" class="clonedInput">

 <!-- <select name="product" id="product1" class="product"> -->
   <select name="degree[]" id="degree1" class="degree">
                                    <option value="">Select your degree</option>
                                    
                                      <?php
                                      if(count($degree_data) > 0){ //echo"hii";die();
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
                                    }}
                                      ?>
  </select>
  <select name="stream[]" id="stream1" class="stream" >
  <!-- <select name="productid" id="productid1" class="productid"> -->

                                      <?php
                                     //echo"hii";die();
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
      <fieldset <?php if($univercity) {  ?> class="error-msg" <?php } ?>>
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
    </fieldset> 


    </div>
     <input type="submit"  id="next" name="next" value="Next">
     </form>
    <div>
        <input type="button" id="btnAdd" value=" + " />
        <input type="button" id="btnRemove" value=" - " />
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
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

    $('#input' + num).after(newElem);
    $('#btnRemove').removeAttr('disabled', 'disabled');


});

$('#btnRemove').on('click', function() {
    $('.clonedInput').last().remove();
    $('#btnAdd').removeAttr('disabled', 'disabled');
});

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
                success:function(html){//alert("#stream" + lastChar);
                    $("#stream" + lastChar).html(html);
                  //   $('#productid2').html(html);
                    
                }
            }); 
        }else{
            $('#stream').html('<option value="">Select Degree first</option>');
            
        }
    });

// // delegate event handler
// $(document).ready(function() {
// //for(var i = 1; i < 10; ++i) {
// $('#myForm').on('change', 'select[id^=product]', function() {alert("hhh");
// //$('#product').on('change',function(){
// 	var aa = $(this).attr('id');
// 	var lastChar = aa.substr(aa.length - 1);

//     var degreeID = $('option:selected', this).val();

//     //alert(".DeleteBtn Click Function -  " + $(this).attr('id'));

//     // var degreeID = $(this).val();
//         //alert(degreeID);
//         if(degreeID){
         
//             $.ajax({
//                 type:'POST',
//                 url:'<?php echo base_url() . "job/ajax_data"; ?>',
//                 data:'degree_id='+degreeID,
//                 success:function(html){alert("#productid" + lastChar);
//                     $("#productid" + lastChar).html(html);
//                   //   $('#productid2').html(html);
                    
//                 }
//             }); 
//         }else{
//             $('#productid2').html('<option value="">Select Degree first</option>');
            
//         }
//    // $(this).next('input.productid').val(value.split('-')[3]);
// })
// //}
// });
</script>

