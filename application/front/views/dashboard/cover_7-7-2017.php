<!-- head -->
<?php echo $head; ?>
<?php echo $header; ?>
<!-- head -->

<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script> 
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>
<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>

  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>"> -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<!--END HEADER -->


<body   class="page-container-bg-solid page-boxed">

    <section>
	<div class="profile-text1 animated fadeInDownBig" >
            <?php
            $userid = $this->session->userdata('aileenuser');
            $this->db->select('*');
            $this->db->where('created_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 MONTH) AND NOW()');
            $this->db->where('user_id', $userid);
            $result = $this->db->get('user')->result_array();


            if ($userdata[0]['user_verify'] == 0 && count($result) > 0) {
                ?>

                <div class="alert alert-warning  vs-o">
                <div class="email-verify">
					<span class="email-img"><img src="images/email.png"></span>
                    <span class="as-p">
                       We have send you an activation email address on your email , Click the link in the mail to verify your email address.   
                    </span>
                    <span class="fw-50"> <a class="vert_email " onClick="sendmail(this.id)" id="<?php echo $userdata[0]['user_email']; ?>">Verify Email Address</a></span>
					 <span class="fw-50"> <a class="chng_email" href="">Change Email Address</a></span>
                  <!--  <span class="fr"><i class="fa fa-times" aria-hidden="true"></i> </span> -->
                </div>
                </div>
            <?php }
            ?>

        </div> 
        <!-- coer image start-->
        <div class="container" id="padding_dash">

            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo"></div>
                </div>
                <div class="col-md-12 cover-pic" >
                    <button class="btn btn-success  cancel-result" onclick="myFunction()">Cancel</button>

                    <button class="btn btn-success upload-result fr" onclick="myFunction()">Save</button>

                    <div id="message1" style="display:none;">
                        <div class="loader"><div id="floatBarsG">
                                <div id="floatBarsG_1" class="floatBarsG"></div>
                                <div id="floatBarsG_2" class="floatBarsG"></div>
                                <div id="floatBarsG_3" class="floatBarsG"></div>
                                <div id="floatBarsG_4" class="floatBarsG"></div>
                                <div id="floatBarsG_5" class="floatBarsG"></div>
                                <div id="floatBarsG_6" class="floatBarsG"></div>
                                <div id="floatBarsG_7" class="floatBarsG"></div>
                                <div id="floatBarsG_8" class="floatBarsG"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"  style="visibility: hidden; ">
                    <div id="upload-demo-i"></div>
                </div>
            </div>




            <div class="container">
                <div class="row" id="row2">
                    <?php
                    $userid = $this->session->userdata('aileenuser');
                    $contition_array = array('user_id' => $userid, 'is_delete' => '0', 'status' => '1');
                    $image = $this->common->select_data_by_condition('user', $contition_array, $data = 'profile_background', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                    //echo "<pre>";print_r($image);
                    $image_ori = $image[0]['profile_background'];
                    if ($image_ori) {
                        ?>
                        <div class="bg-images">
                            <img src="<?php echo base_url($this->config->item('user_bg_main_upload_path'). $userdata[0]['profile_background']); ?>" name="image_src" id="image_src" / ></div>
                        <?php
                    } else {
                        ?>
                        <div class="bg-images">
                            <img src="<?php echo WHITEIMAGE; ?>" name="image_src" id="image_src" alt="WHITE IMAGE" /></div>
                    <?php }
                    ?>

                </div>
            </div>
        </div>
       

<div class="container">   
<div class="row"> 
    <div class="upload-img">


        <label class="cameraButton"><span class="tooltiptext">Upload Cover Photo</span> <i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>
    </div>
     </div>
</div>
       
        <!-- coer image end-->

<div class="profile-photo">
    <div class="profile-main-pho">
        <div class="user-pic-picture">
            <div class="user-pic">
                <?php
                $image_ori = $userdata[0]['user_image'];
                if ($image_ori) {
                    ?>
                    <img src="<?php echo base_url($this->config->item('user_thumb_upload_path') . $userdata[0]['user_image']); ?>" alt="" >

<?php } else { ?>

                    <img src="<?php echo base_url(NOIMAGE); ?>" alt="" > 
<?php } ?>
            <!--<a href="#popup-form" class="fancybox"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>-->

                <a href="javascript:void(0);" onclick="updateprofilepopup();"><i class="fa fa-camera" aria-hidden="true"></i> Update Profile Picture</a>


            </div>
        </div>
       
    </div>
    <div class="main-font-name">
        <h5 align="center"> <?php echo ucwords($userdata[0]['first_name']) . ' ' . ucwords($userdata[0]['last_name']); ?></h5>
        <div>
            <p align="center"><?php echo ucwords($userdata[0]['user_name']) ?></p>  
        </div>   

        
    </div>

</div>
    <div class="user-midd-section">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-12 col-sm-12">
                    <div class="mid-bar">
                        <div class="first-mid-bar">
                            <ul class="clearfix">
                                <li><a href="<?php echo base_url('job'); ?>">Job Profile</a></li>
                                <li><a href="<?php echo base_url('recruiter'); ?>">Recruiter Profile</a></li>
                                <li><a href="<?php echo base_url('freelancer'); ?>">Freelancer Profile</a></li>

                            </ul>
                        </div>
                        <div  class="second-mid-bar">
                            <ul class="clearfix">

                                <li><a href="<?php echo base_url('business_profile'); ?>">Business Profile</a></li>
                                <li><a href="<?php echo base_url('artistic'); ?>">Artistic Profile</a></li>

                            </ul>

                        </div>
                    </div>
                </div>
                <!-- 	<div class="col-md-2">
                        </div> -->

            </div>
        </div>
    </div>
</section>

<!-- model for popup start -->
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
                    <!-- model for popup -->
<!-- Model Popup Open -->
<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
<?php echo form_open_multipart(base_url('dashboard/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image"/>
</div>
                        <!--<input type="hidden" name="hitext" id="hitext" value="3">-->
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save" >
<?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Bid-modal-2  -->
<!-- Model Popup Close -->
<?php echo $footer; ?>
<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
                    function updateprofilepopup(id) {
                        $('#bidmodal-2').modal('show');
                    }
</script>

<script>
// Get the modal
    var modal = document.getElementById('myModal');

// Get the button that opens the modal
    var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<!-- cover image start -->
<script>
    function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";

        // setTimeout(function () { location.reload(1); }, 9000);

    }


    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
    }
</script>


<script type="text/javascript">
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 1250,
            height: 350,
            type: 'square'
        },
        boundary: {
            width: 1250,
            height: 350
        }
    });



    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {


            $.ajax({
                //url: "https://www.aileensoul.com/dashboard/ajaxpro",
                url: "<?php echo base_url() ?>dashboard/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                    html = '<img src="' + resp + '" />';
                    if (html) {
                        window.location.reload();
                    }
                    //  $("#kkk").html(html);
                }
            });

        });
    });

    $('.cancel-result').on('click', function (ev) {
        document.getElementById('row2').style.display = "block";
        document.getElementById('row1').style.display = "none";
        document.getElementById('message1').style.display = "none";
    });
    //aarati code start
    $('#upload').on('change', function () {
        var reader = new FileReader();
        //alert(reader);
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);



    });

    $('#upload').on('change', function () {

        var fd = new FormData();
        fd.append("image", $("#upload")[0].files[0]);

        files = this.files;
        size = files[0].size;

        //alert(size);

        // pallavi code start for file type support
if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    //alert('not an image');
    picpopup();

    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    return false;
  }
  // file type code end

        if (size > 10485760)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 10 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            // window.location.href = "https://www.aileensoul.com/dashboard"
            //reset file upload control
            return false;
        }

        $.ajax({

            url: "<?php echo base_url(); ?>dashboard/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                //alert(response);

            }
        });
    });

//aarati code end
</script>
<!-- cover image end -->

<script>
    function sendmail(abc) {

//alert(abc);

        $.ajax({

            url: "<?php echo base_url(); ?>registration/res_mail",
            type: "POST",
            data: 'user_email=' + abc,
            success: function (response) { 
                 $('.biderror .mes').html("<div class='pop_content'>Email send Successfully.");
                  $('#bidmodal').modal('show');
                  window.open(response);
            }
        });
    }
</script>



</body>
</html>
<!-- script for profile pic strat -->
<script type="text/javascript">
    

     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
            
            document.getElementById('preview').style.display = 'block';
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#profilepic").change(function(){
        // pallavi code for not supported file type 15/06/2017
      profile = this.files;
      //alert(profile);
      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
       //alert('not an image');
        $('#profilepic').val('');
         picpopup();
         return false;
          }else{
          readURL(this);}

          // end supported code 
    });
</script>

<!-- script for profile pic end -->

<!-- popup for file type -->
  <script>
         function picpopup() {           
            $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
            $('#bidmodal').modal('show');
                        }
                    </script>

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>


<script type="text/javascript">

            //validation for edit email formate form

            $(document).ready(function () { 

                $("#userimage").validate({

                    rules: {

                        profilepic: {

                            required: true,
                         
                        },
  

                    },

                    messages: {

                        profilepic: {

                            required: "Photo Required",
                            
                        },

                },

                });
                   });
  </script>

  <script type="text/javascript">
// all popup close close using esc start
    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

     $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal').modal('hide');
    }
});  
    //all popup close close using esc end
</script>
    
