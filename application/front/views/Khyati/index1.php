<html lang="en">
<head>
  <title>PHP - jquery ajax crop image before upload using croppie plugins</title>
  <!-- <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
  <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
  <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css"> -->

 <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
  


</head>
<body>



	  	<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">Image Upluad</div>
	  <div class="panel-body">

	  	<div class="row">
	  		<div class="col-md-12 text-center">
				<div id="upload-demo" style="width:350px"></div>
	  		</div>
	  		<div class="col-md-12" style="padding-top:30px;">

				<strong>Select Image:</strong>
				<br/>
				<input type="file" id="upload">
				<br/>
				<button class="btn btn-success upload-result" onclick="switchVisible();" >Upload Image</button>
				
	  		<div class="col-md-12" style="">
				<div id="upload-demo-i" style="background:#e1e1e1;width:1030px;height:300px;"></div>
	  		</div>
	  	</div>

	  </div>
	</div>
</div>

<script type="text/javascript">
function switchVisible() {
             document.getElementById("upload-demo").style.visibility = "hidden";
             document.getElementById("upload-demo-i").style.visibility = "show";
             document.getElementById("upload-demo-i").style.top = 0;
}

</script>

<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1030,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 1030,
        height: 350
    }
});

$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {

		$.ajax({
			url: "https://www.aileensoul.com/khyati/ajaxpro",
			type: "POST",
			data: {"image":resp},
			success: function (data) {
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});

</script>

</body>
</html>