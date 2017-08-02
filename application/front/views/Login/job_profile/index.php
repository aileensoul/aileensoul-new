
<select name="country" id="country">
    <option value="">Select Country</option>
    <?php
    if(count($countries) > 0){
    	foreach($countries as $cnt){
  ?>
        <option value="<?php echo $cnt['country_id']; ?>"><?php echo $cnt['country_name']; ?></option>
   <?php }}
    ?>
</select>

<select name="state" id="state">
    <option value="">Select country first</option>
</select>

<select name="city" id="city">
    <option value="">Select state first</option>
</select>


<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){ 
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url() . "job_profile/ajax_data"; ?>',
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
                url:'<?php echo base_url() . "job_profile/ajax_data"; ?>',
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
