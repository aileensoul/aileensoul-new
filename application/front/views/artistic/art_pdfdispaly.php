
<input action="action" type="button" value="Back" onclick="history.back();" /> <br/><br/>


<?php

	if($artdata[0]['image_name']){ 
?>
<embed src="<?php echo base_url().$this->config->item('art_post_main_upload_path').$artdata[0]['image_name'] ?>" width="600" height="775">
<?php }
elseif($artregdata[0]['art_bestofmine']){ 
?>
<embed src="<?php echo base_url().$this->config->item('art_post_main_upload_path').$artregdata[0]['art_bestofmine']; ?>" width="600" height="775">
<?php }
elseif($artregdata[0]['art_achievement']){
?>
<embed src="<?php echo base_url().$this->config->item('art_post_main_upload_path').$artregdata[0]['art_achievement']; ?>" width="600" height="775">
<?php }?>


<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
