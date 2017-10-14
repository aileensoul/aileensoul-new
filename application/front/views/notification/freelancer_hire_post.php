<!-- start head -->
<?php echo $head; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/freelancer-hire.css?ver=' . time()); ?>">


<!--post save success pop up style strat -->
<style>
   /* body {
        font-family: Arial, sans-serif;
        background-size: cover;
        height: 100vh;
    }*/

   /* .box {
        width: 40%;
        margin: 0 auto;
        background: rgba(255,255,255,0.2);
        padding: 35px;
        border: 2px solid #fff;
        border-radius: 20px/50px;
        background-clip: padding-box;
        text-align: center;
    }*/



   /* .overlay {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.3);
        transition: opacity 500ms;
        visibility: hidden;
        opacity: 0;
        z-index: 10;
    }*/
    /*.overlay:target {
        visibility: visible;
        opacity: 1;
    }*/

   /* .popup {
        margin: 70px auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
        width: 30%;
        height: 200px;
        position: relative;
        transition: all 5s ease-in-out;
    }*/

    .okk{
        text-align: center;
    }

   .pop_content .okbtn{
        position: absolute;
        transition: all 200ms;
        font-size: 16px;
        text-decoration: none;
        color: #fff;
        padding: 8px 18px;
        background-color: #0A2C5D;
        left: 170px;
        margin-top: 8px;
        width: 100px; 
        border-radius: 8px;
    }
    .pop_content .cnclbtn {
        position: absolute;
        transition: all 200ms;
        font-size: 16px;
        text-decoration: none;
        color: #fff;
        padding: 8px 18px;
        background-color: #0A2C5D;
        right: 170px;
        margin-top: 8px;
        width: 100px;
        border-radius: 8px;
    }

     .popup .pop_content {
        text-align: center;
        margin-top: 40px;

    }
   .model_ok_cancel{
        width:200px !important;
    }

   /* @media screen and (max-width: 700px){
        .box{
            width: 70%;
        }
        /*.popup{
            width: 70%;
        }*/
 /*   }*/
</style>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/1.10.3.jquery-ui.css'); ?>">



<!--post save success pop up style end -->


<style type="text/css" media="screen">
#row2 { overflow: hidden; width: 100%; }
#row2 img { height: 350px;width: 100%; }
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
<!-- END HEAD -->
<!-- start header -->
<?php echo $header; ?>






<!-- END HEADER -->

<body   class="page-container-bg-solid page-boxed ">

    <section>
        <div class="container">
            <div class="row" id="row1" style="display:none;">
                <div class="col-md-12 text-center">
                    <div id="upload-demo" style="width:100%"></div>
                </div>
                <div class="col-md-12 cover-pic" style="padding-top: 25px;text-align: center;">
                    <button class="btn btn-success cancel-result" onclick="" >Cancel</button>

                    <button class="btn btn-success set-btn upload-result " onclick="myFunction()">Upload Image</button>

                    <div id="message1" style="display:none;">
                        <div id="floatBarsG">
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
                <div class="col-md-12"  style="visibility: hidden; ">
                    <div id="upload-demo-i" style="background:#e1e1e1;width:100%;padding:30px;height:1px;margin-top:30px"></div>
                </div>
            </div>


            
        </div>
    </div>
</div>   

<div class="container">    
<!--    <div class="upload-img">

<?php if($returnpage==''){ ?>
        <label class="cameraButton"><i class="fa fa-camera" aria-hidden="true"></i>
            <input type="file" id="upload" name="upload" accept="image/*;capture=camera" onclick="showDiv()">
        </label>
<?php }?>
    </div>-->

    <div class="profile-photo">
               

        <div class="job-menu-profile">
            <h5 > <?php echo ucwords($freelancerpostdata[0]['fullname']) . ' ' . ucwords($freelancerpostdata[0]['username']); ?></h5>


           

            <div  class="add-post-button">
                
            </div> 
        </div>
        <div class="col-md-7 col-sm-7 all-form-content">
            <div class="common-form">
                                <div class="job-saved-box">
                                    <h3> Recommended Post</h3>
                                    <div class="contact-frnd-post">
                                        <!-- <div > -->
                                        <!-- start -->

                                        <?php
                                        if ($freelancerpostdata) {
                                            foreach ($freelancerpostdata as $post) {
//                                                foreach ($post_value as $post) {
                                                    ?>
                                                    <div class="job-post-detail clearfix">
                                                        <!-- pop up box start-->


                                                        <div class="job-contact-frnd ">
                                                            <div class="profile-job-post-detail clearfix margin_btm"  id="<?php echo "removeapply" . $post['post_id']; ?>">
                                                                <div class="profile-job-post-title-inside clearfix">



                                                                    <div class="profile-job-post-title clearfix margin_btm" >
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul>
                                                                                    <li class="fr created_date">
                                                                                        Created Date : <?php
                                                                                        echo trim(date('d-M-Y', strtotime($post['created_date'])));
                                                                                        ?>
                                                                                    </li>
                                                                                    <li class="dot_free">
                                                                                        <a href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>" title="<?php echo ucwords($post['post_name']); ?>" class="display_inline post_title">
                                                                                            <?php echo ucwords($post['post_name']); ?> </a>   </li>



                                                                                    <?php $cityname = $this->db->get_where('cities', array('city_id' => $post['city']))->row()->city_name; ?>
                                                                                    <?php $countryname = $this->db->get_where('countries', array('country_id' => $post['country']))->row()->country_name; ?>
                                                                                    <li class="created_date"> 
                                                                                        <?php if ($cityname || $countryname) { ?>  
                                                                                            <div class="fr lction">


                                                                                                <a href="" title="Location"><i class="fa fa-map-marker" aria-hidden="true" >                                                                                                       </i>
                                                                                                    <?php
                                                                                                    if ($cityname) {
                                                                                                        echo $cityname . ",";
                                                                                                    }
                                                                                                    ?><?php
                                                                                                    if ($countryname) {
                                                                                                        echo $countryname;
                                                                                                    }
                                                                                                    ?>
                                                                                                </a>
                                                                                            </div>
                                                                                        <?php } ?>

                                                                                        <?php
                                                                                        $firstname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->fullname;
                                                                                        $lastname = $this->db->get_where('freelancer_hire_reg', array('user_id' => $post['user_id']))->row()->username;
                                                                                        ?>
                                                                                    </li>
                                                                                    <li><a class="display_inline" title="<?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>" href="<?php echo base_url('freelancer/freelancer_hire_profile/' . $post['user_id'] . '?page=freelancer_post'); ?>"><?php echo ucwords($firstname); ?>&nbsp;<?php echo ucwords($lastname); ?>
                                                                                        </a></li>

                                                                                </ul>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="profile-job-profile-menu">
                                                                            <ul class="clearfix">
                                                                                <li> <b> Field</b> <span><?php echo $this->db->get_where('category', array('category_id' => $post['post_field_req']))->row()->category_name; ?>

                                                                                    </span>
                                                                                </li>
                                                                                <li> <b> Skills</b> <span> 
                                                                                        <?php
                                                                                        $comma = ", ";
                                                                                        $k = 0;
                                                                                        $aud = $post['post_skill'];
                                                                                        $aud_res = explode(',', $aud);

                                                                                        if (!$post['post_skill']) {

                                                                                            echo $post['post_other_skill'];
                                                                                        } else if (!$post['post_other_skill']) {

                                                                                            foreach ($aud_res as $skill) {
                                                                                                if ($k != 0) {
                                                                                                    echo $comma;
                                                                                                }
                                                                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                                echo $cache_time;
                                                                                                $k++;
                                                                                            }
                                                                                        } else if ($post['post_skill'] && $post['post_other_skill']) {
                                                                                            foreach ($aud_res as $skill) {
                                                                                                if ($k != 0) {
                                                                                                    echo $comma;
                                                                                                }
                                                                                                $cache_time = $this->db->get_where('skill', array('skill_id' => $skill))->row()->skill;
                                                                                                echo $cache_time;
                                                                                                $k++;
                                                                                            } echo "," . $post['post_other_skill'];
                                                                                        }
                                                                                        ?>     

                                                                                    </span>
                                                                                </li>


                                                                                <!--  <?php if ($post['other_skill']) { ?>
                                                                                                     <li><b>Other Skill</b><span><?php echo $post['other_skill']; ?></span>
                                                                                                     </li>
                                                                                <?php } else { ?>
                                                                                                     <li><b>Other Skill</b><span><?php echo "-"; ?></span></li><?php } ?> -->

                                                                                <li><b>Post Description</b><span><p>
                                                                                            <?php
                                                                                            if ($post['post_description']) {
                                                                                                echo $post['post_description'];
                                                                                            } else {
                                                                                                echo PROFILENA;
                                                                                            }
                                                                                            ?> </p></span>
                                                                                </li>
                                                                                <li><b>Rate</b><span>
                                                                                        <?php
                                                                                        if ($post['post_rate']) {
                                                                                            echo $post['post_rate'];
                                                                                            echo "&nbsp";
                                                                                            echo $this->db->get_where('currency', array('currency_id' => $post['post_currency']))->row()->currency_name;
                                                                                            echo "&nbsp";
                                                                                            if ($post['post_rating_type'] == 1) {
                                                                                                echo "Hourly";
                                                                                            } else {
                                                                                                echo "Fixed";
                                                                                            }
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?></span>
                                                                                </li>

                                                                                <li>
                                                                                    <b>Required Experience</b>
                                                                                    <span>

                                                                                        <p>
                                                                                            <?php
                                                                                            if ($post['post_exp_month'] || $post['post_exp_year']) {
                                                                                                if ($post['post_exp_year']) {
                                                                                                    echo $post['post_exp_year'];
                                                                                                }
                                                                                                if ($post['post_exp_month']) {

                                                                                                    if ($post['post_exp_year'] == '0') {
                                                                                                        echo 0;
                                                                                                    }
                                                                                                    echo ".";
                                                                                                    echo $post['post_exp_month'];
                                                                                                }
                                                                                                echo " Year";
                                                                                            } else {
                                                                                                echo PROFILENA;
                                                                                            }
                                                                                            ?> 

                                                                                        </p>  

                                                                                    </span>
                                                                                </li>




                                                                                <!-- vishang 14-4 end -->



                                                                                <li><b>Estimated Time</b><span> <?php
                                                                                        if ($post['post_est_time']) {
                                                                                            echo $post['post_est_time'];
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?></span>
                                                                                </li>


                                                                            </ul>
                                                                        </div>
                                                                        <div class="profile-job-profile-button clearfix">
                                                                            <div class="profile-job-details col-md-12">
                                                                                <ul><li class="job_all_post last_date">
                                                                                        Last Date : <?php
                                                                                        if ($post['post_last_date']) {
                                                                                            echo date('d-M-Y', strtotime($post['post_last_date']));
                                                                                        } else {
                                                                                            echo PROFILENA;
                                                                                        }
                                                                                        ?>                                                          </li>



                                                                                    <li class=fr>
                                                                                        <?php
                                                                                        $this->data['userid'] = $userid = $this->session->userdata('aileenuser');
                                                                                        $contition_array = array('post_id' => $post['post_id'], 'job_delete' => 0, 'user_id' => $userid);
                                                                                        $freelancerapply1 = $this->data['freelancerapply'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = 'desc', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                        if ($freelancerapply1) {
                                                                                            ?>
                                                                                            <a href="javascript:void(0);" class="button applied">Applied</a>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>

                                                                                            <a href="javascript:void(0);"  class= "<?php echo 'applypost' . $post['post_id']; ?>  button" onclick="applypopup(<?php echo $post['post_id'] ?>,<?php echo $post['user_id'] ?>)">Apply</a>
                                                                                        </li> 
                                                                                        <li>
                                                                                            <?php
                                                                                            $userid = $this->session->userdata('aileenuser');

                                                                                            $contition_array = array('user_id' => $userid, 'job_save' => '2', 'post_id ' => $post['post_id'], 'job_delete' => '1');
                                                                                            $data = $this->data['jobsave'] = $this->common->select_data_by_condition('freelancer_apply', $contition_array, $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array(), $groupby = '');
                                                                                            if ($data) {
                                                                                                ?>
                                                                                                <a class="saved  button <?php echo 'savedpost' . $post['post_id']; ?>">Saved</a>
                                                                                            <?php } else { ?>

                                                                                                <a id="<?php echo $post['post_id']; ?>" onClick="savepopup(<?php echo $post['post_id']; ?>)" href="javascript:void(0);" class="<?php echo 'savedpost' . $post['post_id']; ?> button">Save</a>

                                                                                            <?php } ?>
                                                                                        <?php } ?>

                                                                                    </li>                        
                                                                                </ul>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                        


                                                        </div>


                                                    </div>


                                                    <?php
                                                }
//                                            }
                                        } else {
                                            ?>
                                            <div class="art-img-nn">
                                                <div class="art_no_post_img">

                                                    <img src="<?php echo base_url('img/free-no1.png') ?>">

                                                </div>
                                                <div class="art_no_post_text">
                                                    No Recommended Post Available.
                                                </div>
                                            </div>
                                        <?php }
                                        ?> 
                                        <!-- <div class="col-md-1">
                                        </div> -->
                                    </div>
                                </div>
                            </div>
        </div>


        <div class="user-midd-section">
            <div class="container">
                <div class="row">


                    <div class="col-md-4">


                    </div>





                </div>
            </div>
        </div>
        </section>
        <footer>
            <?php echo $footer; ?>
        </footer>
<!-- Bid-modal-2  -->
                        <div class="modal fade message-box" id="bidmodal-2" role="dialog">
                            <div class="modal-dialog modal-lm">
                                <div class="modal-content">
                                    <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
                                    <div class="modal-body">
                                        <span class="mes">
                                            <div id="popup-form">
                                                <?php echo form_open_multipart(base_url('freelancer/user_image_insert'), array('id' => 'userimage','name' => 'userimage', 'class' => 'clearfix')); ?>
                                                <input type="file" name="profilepic" accept="image/gif, image/jpeg, image/png" id="profilepic">
                                                <input type="hidden" name="hitext" id="hitext" value="2">
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


<!-- Model Popup Open -->
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

        </body>

        </html>

    
   
    
      <script>
                                            var base_url = '<?php echo base_url(); ?>';
        </script>

     <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
     <script src="<?php echo base_url('assets/js/croppie.js'); ?>"></script>

        <!-- script for skill textbox automatic start (option 2)-->

  
      
        <script>

var data= <?php echo json_encode($demo); ?>;

        
$(function() {
    // alert('hi');
$( "#tags" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
  
</script>


                        <script>
                            function updateprofilepopup(id) {
                                $('#bidmodal-2').modal('show');
                            }
                        </script>


        <script type="text/javascript">
            function checkvalue() {
                //alert("hi");
                var searchkeyword = document.getElementById('tags').value;
                var searchplace = document.getElementById('searchplace').value;
                // alert(searchkeyword);
                // alert(searchplace);
                if (searchkeyword == "" && searchplace == "") {
                    //alert('Please enter Keyword');
                    return false;
                }
            }
        </script>


        <script>
            //select2 autocomplete start for skill
            $('#searchskills').select2({

                placeholder: 'Find Your Skills',

                ajax: {

                    url: "<?php echo base_url(); ?>freelancer/keyskill",
                    dataType: 'json',
                    delay: 250,

                    processResults: function (data) {

                        return {
                            //alert(data);

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

                    url: "<?php echo base_url(); ?>freelancer/location",
                    dataType: 'json',
                    delay: 250,

                    processResults: function (data) {

                        return {
                            //alert(data);

                            results: data


                        };

                    },
                    cache: true
                }
            });
            //select2 autocomplete End for Location

        </script>

        <!-- cover image start -->
        <script>
            function myFunction() {
                document.getElementById("upload-demo").style.visibility = "hidden";
                document.getElementById("upload-demo-i").style.visibility = "hidden";
                document.getElementById('message1').style.display = "block";

                // setTimeout(function () { location.reload(1); }, 5000);

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
                        url: "<?php echo base_url(); ?>freelancer/ajaxpro_hire",
                        type: "POST",
                        data: {"image": resp},
                        success: function (data) {
                            html = '<img src="' + resp + '" />';
                            if (html) {
                                window.location.reload();
                            }
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
                //alert("hi");


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

                if (size > 4194304)
                {
                    //show an alert to the user
                    alert("Allowed file size exceeded. (Max. 4 MB)")

                    document.getElementById('row1').style.display = "none";
                    document.getElementById('row2').style.display = "block";


                    //reset file upload control
                    return false;
                }


                $.ajax({

                    url: "<?php echo base_url(); ?>freelancer/image_hire",
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


        <!-- remove own post start -->

        <script type="text/javascript">
            function remove_post(abc)
            {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "freelancer/remove_post" ?>',
                    data: 'post_id=' + abc,
                    success: function (data) {
                         $('#' + 'removeapply' + abc).html(data);
                $('#' + 'removeapply' + abc).parent().removeClass();

                       var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                if (numItems == '0') {
                    var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Applied Job.</h4></div>";

                 $('.contact-frnd-post').html(nodataHtml);

}


                    }
                });

            }
        </script>

        <!-- remove own post end -->

        
<script>
    function removepopup(id) {
        
        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id="+ id +" onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
</script>
 <script>
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
                                viewableText.html(html);
                                $(this).replaceWith(viewableText);
                                // setup the click event for this new div
                                viewableText.click(divClicked);

                                $.ajax({
                                    url: "<?php echo base_url(); ?>freelancer/hire_designation",
                                    type: "POST",
                                    data: {"designation": html},
                                    success: function (response) {

                                    }
                                });
                            }

                            $(document).ready(function () {
                                $("a.designation").click(divClicked);
                            });
                        </script>