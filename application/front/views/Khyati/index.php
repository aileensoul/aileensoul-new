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
  
<style type="text/css" media="screen">
#row2 img{height: 350px;width: 1138px;}	
.upload-img{    float: right;
    position: relative;
    margin-top: -135px;
    right: 50px; }

   label.cameraButton {
  display: inline-block;
  margin: 1em 0;

  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
  opacity: 0.7;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}

/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}




</style>

</head>
<body>


 
<!-- <div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">Image Upluad</div>
	  <div class="panel-body"> -->

<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">Image Upload</div>
	  <div class="panel-body">
<!--- select thaya pachhi ave ae -->
	  	<div class="row" id="row1" style="display:none;">
	  		<div class="col-md-12 text-center">
				<div id="upload-demo" style="width:1030px"></div>
	  		</div>
	  		<div class="col-md-12" style="padding-top: 25px;text-align: center;">
	  			
				<button class="btn btn-success upload-result" onclick="myFunction()">Upload Image</button>

				<div id="message1" style="display:none;">
				WAIT JUST 2 MIN
				</div>
	  		</div>
	  		<div class="col-md-12"  style="visibility: hidden; ">
				<div id="upload-demo-i" style="background:#e1e1e1;width:1030px;padding:30px;height:300px;margin-top:30px"></div>
	  		</div>
	  	</div>

	  	<!--- select thaya pachhi ave ae end-->


	
<!--- select thai ne ave ae pelaj -->

	<div class="row" id="row2">
	  		<?php
	  		$userid  = $this->session->userdata('aileenuser');
            $contition_array = array( 'user_id' => $userid, 'is_delete' => '0' , 'status' => '1');
            $image = $this->common->select_data_by_condition('user', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
           //echo "<pre>";print_r($image);
            $image_ori=$image[0]['profile_background'];
           if($image_ori)
           {
           	?>
           	<img src="<?php echo $image[0]['profile_background']; ?>" name="image_src" id="image_src" / >
           	<?php
           }
           else
           {
           	echo " ";
           }
          
            ?>

    </div>
</div>
  </div>
	</div>   

		<div class="container">    
			<div class="upload-img">
			
				
				<label class="cameraButton">Take a picture
				    <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
				</label>
			</div>
		</div>


				
	  	



<!--- select thai ne ave ae pelaj puru -->
<!-- </div>

	  </div>
	</div>
</div> -->

<!-- cover image start -->
<script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   document.getElementById('message1').style.display = "block";

   setTimeout(function () { location.reload(1); }, 9000);
   }

   function showDiv() {
   document.getElementById('row1').style.display = "block";
   document.getElementById('row2').style.display = "none";
}
</script>
<!-- <script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   }
</script> -->

<!-- <script>
function myFunction() {
   document.getElementById("upload-demo").style.visibility = "hidden";
   document.getElementById("upload-demo-i").style.visibility = "hidden";
   }
</script> -->


<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1000,
        height: 300,
        type: 'square'
    },
    boundary: {
        width: 1030,
        height: 350
    }
});

// $('#upload').on('change', function () { 
// 	//alert("hi");
// 	var reader = new FileReader();
//     reader.onload = function (e) {
//     	$uploadCrop.croppie('bind', {
//     		url: e.target.result
//     	}).then(function(){
//     		console.log('jQuery bind complete');
//     	});
    	
//     }
//     reader.readAsDataURL(this.files[0]);
// });

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

//aarati code start
$('#upload').on('change', function () { 
	//alert("hi");
	
	
	var reader = new FileReader();
	//alert(reader);
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);

    

});

$('#upload').on('change', function () { 
	//alert("hi");
	// var data=new formData();
	// //alert(data);
	// $.each($("#upload")[0].files,function(i,file)
	// 	{
	// 		data.append("image",file);
	// 	});
	 //var fd = new FormData();

       //fd.append( "fileInput", $("#upload")[0].files[0]);
// var file = $('#upload')[0].files[0];
  var fd = new FormData();
 fd.append( "image", $("#upload")[0].files[0]);

		$.ajax({

				url: "<?php echo base_url(); ?>khyati/image",
				type: "POST",
				data: fd,
				processData: false,
				contentType: false,
				success:function(response){
					//alert(response);

				}
			});
	});

//aarati code end
</script>
<!-- cover image end -->
</body>
</html>