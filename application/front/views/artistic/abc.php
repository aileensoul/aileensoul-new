<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.3.0/select2.js"></script>

<select multiple="multiple" style="width:300px">
<?php foreach ($skill as $ski) { ?>
	 <option value="<?php echo $ski['skill_id']; ?>"><?php echo $ski['skill']; ?></option>
  <?php } ?>
</select>

<script "text/javascript" >
var complex = <?php echo json_encode($selectdata); ?>;
///alert(complex);
$('select').select2().select2('val', complex)

</script>