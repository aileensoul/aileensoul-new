<!-- start head -->
<?php echo $head; ?>

<style type="text/css">
    #popup-form img{display: none;}
</style>


<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-3.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/croppie.css'); ?>">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">


<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>

<!-- END HEADER -->
<script type="text/javascript">
   //For Scroll page at perticular position js Start
   $(document).ready(function(){
    
   //  $(document).load().scrollTop(1000);
        
       $('html,body').animate({scrollTop:265}, 100);
   
   });
   //For Scroll page at perticular position js End
</script>
<?php echo $art_header2_border; ?>


<body   class="page-container-bg-solid page-boxed">

    <section class="custom-row">
        <div class="container" id="paddingtop_fixed">
 
        </div>



        <div class="user-midd-section art-inner">
            <div class="container">
<div class="col-md-3"></div>
    <div class="col-md-7 col-sm-12 col-xs-12 mob-plr0">

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

        <div class="common-form">
            <div class="job-saved-box">

                <h3>Userlist</h3>
                <div class="contact-frnd-post">

                    <?php foreach ($userlist as $user) { ?>
                        <div class="job-contact-frnd ">

                            <div class="profile-job-post-detail clearfix">
                                <div class="profile-job-post-title-inside clearfix">
                                    <div class="profile-job-post-location-name">
                                        <div class="user_lst"><ul>

                                                <li class="fl padding_less_left" >
                                                    <div class="follow-img">
                                                        <?php if ($user['art_user_image'] != '') { ?>
                                                        <a href="<?php echo base_url('artistic/art_manage_post/' . $user['user_id']); ?>">


                                                             <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $user['art_user_image'])) {
                                                                $a = $user['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $user['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-userlist">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>
                                                            <img src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $user['art_user_image']); ?>" height="50px" width="50px" alt="" >
                                                            <?php  } ?>

                                                            </a>
                                                        <?php } else { ?>
                                <a href="<?php echo base_url('artistic/art_manage_post/' . $user['user_id']); ?>">

                           
                            <?php 

                            $a = $user['art_name'];
                            $acronym = substr($a, 0, 1)
                          ?>
                          <?php 
                          $b = $user['art_lastname'];
                          $acronym1 = substr($b, 0, 1)
                           ?>

                            <div class="post-img-userlist">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                             </a>
                                                        <?php } ?> 
                                                    </div>
                                                </li>
                                                <li class="folle_text">
                                                    <div class="">
                                                        <div class="follow-li-text ">
                                                            <a href="<?php echo base_url('artistic/art_manage_post/' . $user['user_id']); ?>"><?php echo ucfirst(strtolower($user['art_name']));
                                                    echo "&nbsp;";
                                                    echo ucfirst(strtolower($user['art_lastname'])); ?></a></div>


                                                      <?php  if ($user['designation']) { ?>
                                                           <div>
                                                            <a><?php echo ucfirst(strtolower($user['designation'])); ?></a>
                                                        </div>
                                                       <?php  
                                                        }
                                                        else
                                                        {
                                                          ?>
                                                          <div>
                                                            <a><?php echo "Current Work"; ?></a>
                                                        </div>

                                                      <?php  }
                                                        ?>


                                                </li>

                                                <li class="fr <?php echo "fruser" . $user['art_id']; ?>">

                                                    <?php
                                                    $status = $this->db->get_where('follow', array('follow_type' => 1, 'follow_from' => $artdata[0]['art_id'], 'follow_to' => $user['art_id']))->row()->follow_status;

                                                    if ($status == 0 || $status == " ") {
                                                        ?>

                                                        <div id= "followdiv" class="user_btn">
                                                            <button id="<?php echo "follow" . $user['art_id']; ?>" onClick="followuser(<?php echo $user['art_id']; ?>)"> 
                                                                Follow 
                                                            </button>
                                                        </div>

    <?php } elseif ($status == 1) { ?>

                                                        <div id= "unfollowdiv" class="user_btn ">
                                                            <button class="bg_following" id="<?php echo "unfollow" . $user['art_id']; ?>" onClick="unfollowuser(<?php echo $user['art_id']; ?>)">
                                                                Following 
                                                            </button>
                                                        </div>
    <?php } ?>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
<?php } ?>
                    </div>
                    <div class="col-md-1">
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>
            </div>
        </div>
</section>
<footer>
<?php echo $footer; ?>
</footer>      

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

<!-- Bid-modal-2  -->
<div class="modal fade message-box" id="bidmodal-2" role="dialog">
    <div class="modal-dialog modal-lm">
        <div class="modal-content">
            <button type="button" class="modal-close" data-dismiss="modal">&times;</button>     	
            <div class="modal-body">
                <span class="mes">
                    <div id="popup-form">
<?php echo form_open_multipart(base_url('artistic/user_image_insert'), array('id' => 'userimage', 'name' => 'userimage', 'class' => 'clearfix')); ?>
                        <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                        <input type="hidden" name="hitext" id="hitext" value="6">
 <div class="popup_previred">
                        <img id="preview" src="#" alt="your image" >
                        </div>
                        <!--<input type="submit" name="cancel3" id="cancel3" value="Cancel">-->
                        <input type="submit" name="profilepicsubmit" id="profilepicsubmit" value="Save">
<?php echo form_close(); ?>
                    </div>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Model Popup Close -->

<footer>
<?php echo $footer; ?>
        </footer>



<!-- script for skill textbox automatic start (option 2)-->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
-->  

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>



<!-- designation script start -->
<script type="text/javascript">
                            function divClicked() {
                                var divHtml = $(this).html();
                                var editableText = $("<textarea />");
                                editableText.val(divHtml);
                                $(this).replaceWith(editableText);
                                editableText.focus();
                                // setup the blur event for this new textarea
                                editableText.blur(editableTextBlurred);
                            }

                            function editableTextBlurred() {
                                var html = $(this).val();
                                var viewableText = $("<a>");

                                if (html.match(/^\s*$/) || html == '') { 
                                html = "Current Work";
                                }
                                viewableText.html(html);
                                $(this).replaceWith(viewableText);
                                // setup the click event for this new div
                                viewableText.click(divClicked);

                                $.ajax({
                                    url: "<?php echo base_url(); ?>artistic/art_designation",
                                    type: "POST",
                                    data: {"designation": html},
                                    success: function (response) {

                                    }
                                });
                            }

                            $(document).ready(function () {
                            // alert("hi");
                                $("a.designation").click(divClicked);
                            });
                        </script>

<!-- designation script end -->
<!-- script for skill textbox automatic end (option 2)-->
<script>

                                                        var data = <?php echo json_encode($demo); ?>;
// alert(data);


                                                        $(function () {
                                                            // alert('hi');
                                                            $("#tags").autocomplete({
                                                                source: function (request, response) {
                                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                    response($.grep(data, function (item) {
                                                                        return matcher.test(item.label);
                                                                    }));
                                                                },
                                                                minLength: 1,
                                                                select: function (event, ui) {
                                                                    event.preventDefault();
                                                                    $("#tags").val(ui.item.label);
                                                                    $("#selected-tag").val(ui.item.label);
                                                                    // window.location.href = ui.item.value;
                                                                }
                                                                ,
                                                                focus: function (event, ui) {
                                                                    event.preventDefault();
                                                                    $("#tags").val(ui.item.label);
                                                                }
                                                            });
                                                        });

</script>

<script>

                                                        var data1 = <?php echo json_encode($de); ?>;
// alert(data);


                                                        $(function () {
                                                            // alert('hi');
                                                            $("#searchplace").autocomplete({
                                                                source: function (request, response) {
                                                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                                                    response($.grep(data1, function (item) {
                                                                        return matcher.test(item.label);
                                                                    }));
                                                                },
                                                                minLength: 1,
                                                                select: function (event, ui) {
                                                                    event.preventDefault();
                                                                    $("#searchplace").val(ui.item.label);
                                                                    $("#selected-tag").val(ui.item.label);
                                                                    // window.location.href = ui.item.value;
                                                                }
                                                                ,
                                                                focus: function (event, ui) {
                                                                    event.preventDefault();
                                                                    $("#searchplace").val(ui.item.label);
                                                                }
                                                            });
                                                        });

</script>

<script>

var data= <?php echo json_encode($demo); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#tags1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});
  
</script>
<script>

var data1 = <?php echo json_encode($city_data); ?>;
// alert(data);

        
$(function() {
    // alert('hi');
$( "#searchplace1" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
});
  
</script>

<script type="text/javascript">
    function checkvalue() {
        //alert("hi");
        var searchkeyword =$.trim(document.getElementById('tags').value);
        var searchplace =$.trim(document.getElementById('searchplace').value);
        // alert(searchkeyword);
        // alert(searchplace);
        if (searchkeyword == "" && searchplace == "") {
            //alert('Please enter Keyword');
            return false;
        }
    }
</script>

<script type="text/javascript">
                        function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }
                    </script>

<!-- <script>
//select2 autocomplete start for skill
    $('#searchskills').select2({

        placeholder: 'Find Your Skills',

        ajax: {

            url: "<?php echo base_url(); ?>artistic/keyskill",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for skill

//select2 autocomplete start for Location
    $('#searchplace').select2({

        placeholder: 'Find Your Location',
        maximumSelectionLength: 1,
        ajax: {

            url: "<?php echo base_url(); ?>artistic/location",
            dataType: 'json',
            delay: 250,

            processResults: function (data) {

                return {

                    results: data


                };

            },
            cache: true
        }
    });
//select2 autocomplete End for Location

</script>
 --><!-- popup form edit start -->

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


<!-- popup form edit END -->

<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>

<script src="<?php echo base_url('js/fb_login.js'); ?>"></script>
<script type="text/javascript">

    //validation for edit email formate form

    $(document).ready(function () {

        $("#artdesignation").validate({

            rules: {

                designation: {

                    required: true,

                },

            },

            messages: {

                designation: {

                    required: "Designation Is Required.",

                },

            },

        });
    });
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
                url: "<?php echo base_url() ?>artistic/ajaxpro",
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

    $("#upload").val('');
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

            url: "<?php echo base_url(); ?>artistic/image",
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

<!-- follow user script start -->

<script type="text/javascript">
    function followuser(clicked_id)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "artistic/follow" ?>',
            dataType: 'json',
            data: 'follow_to=' + clicked_id,
            success: function (data) { //alert(data.count);

                $('.' + 'fruser' + clicked_id).html(data.follow);
                $('#countfollow').html(data.count);


            }
        });
    }
</script>

<!--follow like script end -->

<!-- Unfollow user script start -->

<script type="text/javascript">
    function unfollowuser(clicked_id)
    {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "artistic/unfollow" ?>',
            dataType: 'json',
            data: 'follow_to=' + clicked_id,
            success: function (data) {

                $('.' + 'fruser' + clicked_id).html(data.follow);
                $('#countfollow').html(data.count);


            }
        });
    }
</script>

<!--follow like script end -->


<!-- end search validation -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script>
    function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
</script>

<!--follow like script end -->
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
         profile = this.files;
                   //alert(profile);
                      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
                       //alert('not an image');
                  $('#profilepic').val('');
                   picpopup();
                     return false;
                   }else{
                      readURL(this);}
    });
</script>

<!-- script for profile pic end -->

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
     <script>
     function picpopup() {

            $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
            $('#bidmodal').modal('show');
                        }
      </script>


      <!-- all popup close close using esc start -->
 <script type="text/javascript">
   

    $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

 </script>
 <!-- all popup close close using esc end -->

 </body>

</html>