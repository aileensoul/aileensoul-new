<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>Within a group of three phone numbers, ensure at least one is complete.</title>

 
</head>
<body>
  <?php echo form_open(base_url('job/job_skill_insert'), array('id' => 'myform','name' => 'jobseeker_regform','class' =>'clearfix')); ?>
<label for="mobile_phone">Mobile phone: </label>
 <select name="skills[]" id ="skils" class="left phone-group" multiple="multiple" style="width:300px">
                                       <?php foreach ($skill as $ski) { ?>
                                      <option value="<?php echo $ski['skill_id']; ?>"><?php echo $ski['skill']; ?></option>
                                    <?php } ?>
                                      </select>
<br/>
<label for="home_phone">Home phone: </label>
<input class="left phone-group" id="home_phone" name="home_phone">
<br/>
<label for="work_phone">Work phone: </label>
<input class="left phone-group" id="work_phone" name="work_phone">
<br/>
<input type="submit" value="Validate!">
</form>

<!-- <link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
 --><script type="text/javascript" src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script> 



<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.js"></script>

<script>
// just for the demos, avoids form submit
$(document).ready(function() {
jQuery.validator.setDefaults({
  //debug: true,
  success: "valid"
});
$( "#myform" ).validate({
 ignore: '*:not([name])',

  rules: {
    'skills[]': {
      require_from_group: [1, ".phone-group"]
    },
    home_phone: {
      require_from_group: [1, ".phone-group"]
    },
    work_phone: {
      require_from_group: [1, ".phone-group"]
    }
  }
                   
});
});
</script>

<script type="text/javascript">
//select2 autocomplete start for skill
var complex = <?php echo json_encode($selectdata); ?>;
//alert(complex);
$('#skils').select2().select2('val', complex)
//select2 autocomplete End for skill
</script>
</body>
</html>