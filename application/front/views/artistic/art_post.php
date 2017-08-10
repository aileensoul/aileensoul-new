<!--start head -->
<?php echo $head; ?>

<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/1.10.3.jquery-ui.css'); ?>">
<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('dragdrop/fileinput.css'); ?>">
<link href="<?php echo base_url('dragdrop/themes/explorer/theme.css'); ?>" media="all" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/video.css'); ?>">
<script src="<?php echo base_url('js/mediaelement-and-player.min.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/plugins/sortable.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/fileinput.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/fr.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/js/locales/es.js'); ?>"></script>
<script src="<?php echo base_url('dragdrop/themes/explorer/theme.js'); ?>"></script>
<!-- END HEADER -->
<!--<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
   <script src="<?php echo base_url('js/fb_login.js'); ?>"></script>-->
 <style type="text/css">
    .progress 
    {
        display:none; 
        position:relative; 
        width:100%; 
        border: 1px solid #ddd; 
        padding: 1px; 
        border-radius: 3px; 
        height: 23px;
    }
    .bar 
    { 
        background-color: #1b8ab9; 
        width:0%; 
        height:20px; 
        border-radius: 3px; 
    }
    .percent 
    { 
        position:absolute; 
        display:inline-block; 
        top:3px; 
        left:48%; 
    }
    .bs-example .sr-only{
        position: inherit;
        width:45px;
        height: 20px;
    }
</style>  
<?php echo $art_header2_border; ?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <script>
         $(document).ready(function ()
         {
         
             /* Uploading Profile BackGround Image */
             $('body').on('change', '#bgphotoimg', function ()
             {
         
                 $("#bgimageform").ajaxForm({target: '#timelineBackground',
                     beforeSubmit: function () {},
                     success: function () {
         
                         $("#timelineShade").hide();
                         $("#bgimageform").hide();
                     },
                     error: function () {
         
                     }}).submit();
             });
         
         
             /* Banner position drag */
             $("body").on('mouseover', '.headerimage', function ()
             {
                 var y1 = $('#timelineBackground').height();
                 var y2 = $('.headerimage').height();
                 $(this).draggable({
                     scroll: false,
                     axis: "y",
                     drag: function (event, ui) {
                         if (ui.position.top >= 0)
                         {
                             ui.position.top = 0;
                         } else if (ui.position.top <= y1 - y2)
                         {
                             ui.position.top = y1 - y2;
                         }
                     },
                     stop: function (event, ui)
                     {
                     }
                 });
             });
         
             /* Bannert Position Save*/
             $("body").on('click', '.bgSave', function ()
             {
                 var id = $(this).attr("id");
                 var p = $("#timelineBGload").attr("style");
                 var Y = p.split("top:");
                 var Z = Y[1].split(";");
                 var dataString = 'position=' + Z[0];
                 $.ajax({
                     type: "POST",
                     url: "<?php echo base_url('artistic/image_saveBG_ajax'); ?>",
                     data: dataString,
                     cache: false,
                     beforeSend: function () { },
                     success: function (html)
                     {
                         if (html)
                         {
                             window.location.reload();
                             $(".bgImage").fadeOut('slow');
                             $(".bgSave").fadeOut('slow');
                             $("#timelineShade").fadeIn("slow");
                             $("#timelineBGload").removeClass("headerimage");
                             $("#timelineBGload").css({'margin-top': html});
                             return false;
                         }
                     }
                 });
                 return false;
             });
         
         
         
         });
         
         
         
      </script>
   </head>
   <body>
      <div class="user-midd-section" id="paddingtop_fixed">
      <div class="container">
      <div class="row">
      <div class="profile-art-box profile-box-custom col-md-4 animated fadeInLeftBig">
         <?php ?>
<?php echo $left_artistic; ?>

         <div class="full-box-module_follow">
            <!-- follower list start  -->  
            <div class="common-form">
               <h3 class="user_list_head">User List</h3>
               <div class="seeall">
                  <a href="<?php echo base_url('artistic/userlist'); ?>">All User</a>
               </div>
               <div class="profile-boxProfileCard_follow  module">
                 
               </div>
               <!-- follower list end  -->
            </div>
         </div>
      </div>
      <!-- cover pic end -->
      <!-- popup start -->
      <!-- Trigger/Open The Modal -->
      <!-- popup end -->
      <div class="col-md-7 col-sm-12 col-md-push-4  custom-right-art animated fadeInUp">
     
         <div class="post-editor col-md-12">
            <div class="main-text-area col-md-12">
               <div class="popup-img">
                  <?php
                     $userimage = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     $userimageposted = $this->db->get_where('art_reg', array('user_id' => $this->session->userdata('aileenuser')))->row()->art_user_image;
                     ?>

                     <?php if($artisticdata[0]['art_user_image']){?>

                      <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class= "post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                  <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">
                  <?php }?>

                  <?php }else{?>

   
                            <div class= "post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                        
                        

                  <?php }?>
               </div>
               <div id="myBtn"  class="editor-content popup-text">
                  <span > Post Your Art....</span> 
                  <div class="padding-left padding_les_left camer_h">
                     <i class=" fa fa-camera" >
                     </i> 
                  </div>
               </div>
            </div>
         </div>


          <div class="bs-example">
                                <div class="progress progress-striped" id="progress_div">
                                    <div class="progress-bar" style="width: 0%;">
                                        <span class="sr-only">0%</span>
                                    </div>
                                </div>
                            </div>

                             <div class="art-all-post">
                             <div class="nofoundpost"> 
                             </div>
                             </div>
      </section>
      <footer>
         <?php echo $footer; ?>
      </footer>



       <!-- Bid-modal  -->
                    <div class="modal fade message-box biderror" id="bidmodal-limit" role="dialog">
                        <div class="modal-dialog modal-lm deactive">
                            <div class="modal-content">
                                <button type="button" class="modal-close" data-dismiss="modal" id="common-limit">&times;</button>       
                                <div class="modal-body">
                                    <!--<img class="icon" src="images/dollar-icon.png" alt="" />-->
                                    <span class="mes"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Model Popup Close -->
      <!-- Bid-modal  -->
      <div class="modal fade message-box biderror" id="bidmodal" role="dialog"  >
         <div class="modal-dialog modal-lm" >
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
      <div class="modal fade message-box" id="likeusermodal" role="dialog" >
         <div class="modal-dialog modal-lm">
            <div class="modal-content">
               <button type="button" class="modal-close" data-dismiss="modal">&times;</button>       
               <div class="modal-body">
                  <span class="mes">
                  </span>
               </div>
            </div>
         </div>
      </div>
      <!-- Model Popup Close -->
       <!-- Bid-modal for this modal appear or not start -->
            <div class="modal fade message-box" id="post" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="post" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade message-box" id="postedit" role="dialog">
                <div class="modal-dialog modal-lm">
                    <div class="modal-content">
                        <button type="button" class="modal-close" id="postedit" data-dismiss="modal">&times;</button>       
                        <div class="modal-body">
                            <span class="mes">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bid-modal for this modal appear or not  Popup Close -->
		<!-- The Modal -->
         <div id="myModal" class="modal-post">
            <!-- Modal content -->
            <div class="modal-content-post">
               <span class="close1">&times;</span>
                  <div class="post-editor col-md-12 post-edit-popup" id="close">
                  <?php echo form_open_multipart(base_url('artistic/art_post_insert/'), array('id' => 'artpostform', 'name' => 'artpostform', 'class' => 'clearfix upload-image-form', 'onsubmit' => "imgval(event)")); ?>
                  <div class="main-text-area " >
                     <div class="popup-img-in "> 

                     <?php if($artisticdata[0]['art_user_image']){?>


                      <?php 

if (!file_exists($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image'])) {
                                                                $a = $artisticdata[0]['art_name'];
                                                                $acr = substr($a, 0, 1);
                                                                $b = $artisticdata[0]['art_lastname'];
                                                                $bcr = substr($b, 0, 1);
                                                                ?>
                                                                <div class="post-img-div">
                                                                    <?php echo ucfirst(strtolower($acr)) . ucfirst(strtolower($bcr)) ?>
                                                                </div> 
                                                                <?php
                                                            } else { ?>

                     <img  src="<?php echo base_url($this->config->item('art_profile_thumb_upload_path') . $artisticdata[0]['art_user_image']); ?>"  alt="">

                     <?php }?>

                     <?php }else{?>

                                       <?php 
                          $a = $artisticdata[0]['art_name'];
                          $words = explode(" ", $a);
                          foreach ($words as $w) {
                            $acronym = $w[0];
                            }?>
                          <?php 
                          $b = $artisticdata[0]['art_lastname'];
                          $words = explode(" ", $b);
                          foreach ($words as $w) {
                            $acronym1 = $w[0];
                            }?>

                            <div class="post-img-div">
                            <?php echo  ucfirst(strtolower($acronym)) . ucfirst(strtolower($acronym1)); ?>
                            </div>
                       

                     <?php }?>

                     </div>
                     <div id="myBtn"  class="editor-content col-md-10 popup-text" >
                        <!-- <textarea name="product_title" placeholder="Post Your Product...."></textarea>  -->
 <textarea id= "test-upload_product" placeholder="Post Your Art...."   onKeyPress=check_length(this.form); onKeyDown=check_length(this.form); onKeyup=check_length(this.form); onblur="check_length(this.form)" name=my_text rows=4 cols=30 class="post_product_name" style="position: relative;"></textarea>
                        <div class="fifty_val">                       
                           <input size=1 class="text_num" tabindex="-500" value=50 name=text_num readonly> 
                        </div>
                   
                      <div class="padding-left padding_les_left camer_h">
                        <i class=" fa fa-camera" >
                        </i> 
                     </div>
                       </div>
                  </div>
                  <div class="row"></div>
                  <div  id="text"  class="editor-content col-md-12 popup-textarea" >
                     <textarea id="test-upload_des" name="product_desc" class="description" placeholder="Enter Description"></textarea>
                     <output id="list"></output>
                  </div>
                  <!--   <span class="fr">
                     <input type="file" id="files" name="postattach[]" multiple style="display:block;">  </span> -->
                  <div class="popup-social-icon">
                     <ul class="editor-header">
                        <li>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <input id="file-1" type="file" class="file" name="postattach[]"  multiple class="file" data-overwrite-initial="false" data-min-file-count="2" style="display: none;">
                              </div>
                           </div>
                           <label for="file-1">
                           <i class=" fa fa-camera upload_icon"  > Photo</i>
                           <i class=" fa fa-video-camera upload_icon"  > Video </i>
                           <i class="fa fa-music upload_icon "  > Audio </i>
                           <i class=" fa fa-file-pdf-o upload_icon"  > PDF </i>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <div class="fr">
                     <button type="submit"  value="Submit">Post</button>    
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </div>
   

<footer>
<?php echo $footer; ?>
</footer>

<script>
   $(document).ready(function () {
       $('video').mediaelementplayer({
           alwaysShowControls: false,
           videoVolume: 'horizontal',
           features: ['playpause', 'progress', 'volume', 'fullscreen']
       });
   });
</script>
<!-- further and less -->
<script>
   $(function () {
       var showTotalChar = 200, showChar = "Read More", hideChar = "";
       $('.show_more').each(function () {
           var content = $(this).html();
           if (content.length > showTotalChar) {
               var con = content.substr(0, showTotalChar);
               var hcon = content.substr(showTotalChar, content.length - showTotalChar);
               var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
               $(this).html(txt);
           }
       });
       $(".showmoretxt").click(function () {
           if ($(this).hasClass("sample")) {
               $(this).removeClass("sample");
               $(this).text(showChar);
           } else {
               $(this).addClass("sample");
               $(this).text(hideChar);
           }
           $(this).parent().prev().toggle();
           $(this).prev().toggle();
           return false;
       });
   });
</script>
<script>
   $('#file-fr').fileinput({
       language: 'fr',
       uploadUrl: '#',
       allowedFileExtensions: ['jpg', 'png', 'gif' , 'mp4','mp3','pdf']
   });
   $('#file-es').fileinput({
       language: 'es',
       uploadUrl: '#',
       allowedFileExtensions: ['jpg', 'png', 'gif' , 'mp4', 'mp3', 'pdf']
   });
   
   $("#file-1").fileinput({
       uploadUrl: '#', // you must set a valid URL here else you will get an error
       allowedFileExtensions: ['jpg', 'png', 'gif' , 'mp4' , 'mp3' ,'pdf'],
       overwriteInitial: false,
       maxFileSize: 1000000,
       maxFilesNum: 10,
       //allowedFileTypes: ['image', 'video', 'flash'],
       slugCallback: function (filename) {
           return filename.replace('(', '_').replace(']', '_');
       }
   });
   /*
    $(".file").on('fileselect', function(event, n, l) {
    alert('File Selected. Name: ' + l + ', Num: ' + n);
    });
    */
   
   $(".btn-warning").on('click', function () {
       var $el = $("#file-4");
       if ($el.attr('disabled')) {
           $el.fileinput('enable');
       } else {
           $el.fileinput('disable');
       }
   });
   // $(".btn-info").on('click', function () {
   //     $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
   // });
   /*
    $('#file-4').on('fileselectnone', function() {
    alert('Huh! You selected no files.');
    });
    $('#file-4').on('filebrowse', function() {
    alert('File browse clicked for #file-4');
    });
    */
   $(document).ready(function () {
       $("#test-upload").fileinput({
           'showPreview': false,
           'allowedFileExtensions': ['jpg', 'png', 'gif', 'mp4','mp3','pdf'],
           'elErrorContainer': '#errorBlock'
       });
       $("#kv-explorer").fileinput({
           'theme': 'explorer',
           'uploadUrl': '#',
           overwriteInitial: false,
           initialPreviewAsData: true,
   
       });
       /*
        $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
        alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        });
        */
   });
</script>
<!-- script for skill textbox automatic start (option 2)-->
<script src="<?php echo base_url('js/jquery.wallform.js'); ?>"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="<?php echo base_url('js/jquery-ui.min.js'); ?>"></script>
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
<!--      <script>
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
   
   
   
   </script> -->
<!-- popup form edit start -->
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
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.validate.js'); ?>"></script>
<script type="text/javascript">
   //validation for edit email formate form
   
   $(document).ready(function () {
   
       $("#artpostform").validate({
   
           rules: {
   
               postname: {
   
                   required: true,
               },
   
               // skills: {
   
               //   require_from_group: [1, ".skill-group"]
               //     //required: true,
               // },
   
               // other_skill: {
   
               //     require_from_group: [1, ".skill-group"]
               //     //required: true,
               // },
   
   
               description: {
                   required: true,
   
               },
   
               // postattach: {
   
               //      required: true,
   
               //  },
   
           },
   
           messages: {
   
               postname: {
   
                   required: "Post name Is Required.",
   
               },
   
               // skills: {
   
               //     required: "Skill Is Required.",
   
               // },
   
               description: {
                   required: "Description is required",
   
               },
               // postattach: {
   
               //     required: "Attachment Is Required.",
   
               // },
   
           },
   
       });
   });
</script>
<!-- javascript validation End -->
<!-- post like script start -->
<script type="text/javascript">
   function post_like(clicked_id)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_post" ?>',
           dataType: 'json',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('.' + 'likepost' + clicked_id).html(data.like);
               $('.likeusername' + clicked_id).html(data.likeuser);
               $('.comnt_count_ext' + clicked_id).html(data.like_user_count);
               
               $('.likeduserlist' + clicked_id).hide();
               if (data.likecount == '0') {
                   document.getElementById('likeusername' + clicked_id).style.display = "none";
               } else {
                   document.getElementById('likeusername' + clicked_id).style.display = "block";
               }
               $('#likeusername' + clicked_id).addClass('likeduserlist1');
           }
       });
   }
</script>
<!--post like script end -->
<!-- comment like script start -->
<script type="text/javascript">
   function comment_like(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_comment" ?>',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecomment' + clicked_id).html(data);
   
           }
       });
   }
</script>
<script type="text/javascript">
   function comment_like1(clicked_id)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/like_comment1" ?>',
           data: 'post_id=' + clicked_id,
           success: function (data) {
               $('#' + 'likecomment1' + clicked_id).html(data);
   
           }
       });
   }
</script>
<!--comment like script end -->
<!-- comment delete script start -->
<script type="text/javascript">
   function comment_delete(clicked_id) {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deleted(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
   function comment_deleted(clicked_id)
   {
      var post_delete = document.getElementById("post_delete" + clicked_id);
       //alert(post_delete.value);
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_comment" ?>',
           data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
           dataType: "json",
           success: function (data) {
               //alert('.' + 'insertcomment' + clicked_id);
               $('.' + 'insertcomment' + post_delete.value).html(data.comment);
               //$('#' + 'insertcount' + post_delete.value).html(data.count);
                $('.like_count_ext' + post_delete.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
           }
       });
   }
   
   function comment_deletetwo(clicked_id)
   {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='comment_deletedtwo(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function comment_deletedtwo(clicked_id)
   {
       var post_delete1 = document.getElementById("post_deletetwo");
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
           data: 'post_id=' + clicked_id + '&post_delete=' + post_delete1.value,
           dataType: "json",
           success: function (data) {
   
               // $('.' + 'insertcomment' + post_delete.value).html(data);
               $('.' + 'insertcommenttwo' + post_delete1.value).html(data.comment);
            //   $('#' + 'insertcount' + post_delete1.value).html(data.count);
             $('.like_count_ext' + post_delete1.value).html(data.commentcount);
               $('.post-design-commnet-box').show();
   
           }
       });
   }
   
   
   //                        function comment_deletetwo(clicked_id)
   //                        {
   //
   //                            var post_delete = document.getElementById("post_delete2");
   //
   //                            $.ajax({
   //                                type: 'POST',
   //                                url: '<?php echo base_url() . "artistic/delete_commenttwo" ?>',
   //                                data: 'post_id=' + clicked_id + '&post_delete=' + post_delete.value,
   //                                success: function (data) {
   //
   //                                    $('#' + 'fourcomment' + post_delete.value).html(data);
   //
   //                                }
   //                            });
   //                        }
</script>
<!--comment delete script end -->
<!-- comment insert script start -->
<!-- insert comment using comment button-- > 
   <!-- insert comment using enter -->
<script type="text/javascript">
   //                        function insert_comment(clicked_id)
   //                        {
   //                            var $field = $('#post_comment' + clicked_id);
   //                            var post_comment = $('#post_comment' + clicked_id).html();
   //                            
   //                            $('#post_comment' + clicked_id).html("");
   //
   //                            var x = document.getElementById('threecomment' + clicked_id);
   //                            var y = document.getElementById('fourcomment' + clicked_id);
   //
   //                            if (post_comment == '') {
   //
   //                                event.preventDefault();
   //                                return false;
   //                            } else {
   //
   //                                if (x.style.display === 'block' && y.style.display === 'none') {
   //
   //                                    $.ajax({
   //                                        type: 'POST',
   //                                        url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
   //                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
   //                                        dataType: "json",
   //                                        success: function (data) {
   //
   //                                            //$('.' + 'insertcomment' + clicked_id).html(data);
   //                                            $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                            $('.insertcomment' + clicked_id).html(data.comment);
   //
   //                                        }
   //                                    });
   //
   //                                } else {
   //
   //                                    $.ajax({
   //                                        type: 'POST',
   //                                        url: '<?php echo base_url() . "artistic/insert_comment" ?>',
   //                                        data: 'post_id=' + clicked_id + '&comment=' + post_comment,
   //                                        dataType: "json",
   //                                        success: function (data) {
   //                                            $('textarea').each(function () {
   //                                                $(this).val('');
   //                                            });
   //                                            $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                            $('#' + 'fourcomment' + clicked_id).html(data.comment);
   //                                        }
   //                                    });
   //
   //                                }
   //                            }
   //
   //                        }
   
   function insert_comment(clicked_id)
   {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
   
       var sel = $("#post_comment" + clicked_id);
       var txt = sel.html();
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');

       txt = txt.replace(/div>/gi, 'p>');


       if (txt == '' || txt == '<br>') {
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
       $('#post_comment' + clicked_id).html("");
   
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
               data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
                  // $('#' + 'insertcount' + clicked_id).html(data.count);
                   $('.insertcomment' + clicked_id).html(data.comment);
                   $('.like_count_ext' + clicked_id).html(data.commentcount);
   
               }
           });
   
       } else {
   
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/insert_comment" ?>',
               data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
               dataType: "json",
               success: function (data) {
                   $('textarea').each(function () {
                       $(this).val('');
                   });
              //     $('#' + 'insertcount' + clicked_id).html(data.count);
                   $('#' + 'fourcomment' + clicked_id).html(data.comment);
                   $('.like_count_ext' + clicked_id).html(data.commentcount);
               }
           });
       }
   }
   
</script>
<script type="text/javascript">
   //                        function entercomment(clicked_id)
   //                        {
   //                            $('#post_comment' + clicked_id).keypress(function (e) {
   //                                if (e.keyCode == 13 && !e.shiftKey) {
   //                                    var val = $('#post_comment' + clicked_id).val();
   //                                    e.preventDefault();
   //
   //                                    if (window.preventDuplicateKeyPresses)
   //                                        return;
   //
   //                                    window.preventDuplicateKeyPresses = true;
   //                                    window.setTimeout(function () {
   //                                        window.preventDuplicateKeyPresses = false;
   //                                    }, 500);
   //                                    var x = document.getElementById('threecomment' + clicked_id);
   //                                    var y = document.getElementById('fourcomment' + clicked_id);
   //
   //                                    if (val == '') {
   //
   //                                        event.preventDefault();
   //                                        return false;
   //                                    } else {
   //
   //                                        if (x.style.display === 'block' && y.style.display === 'none') {
   //                                            $.ajax({
   //                                                type: 'POST',
   //                                                url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
   //                                                data: 'post_id=' + clicked_id + '&comment=' + val,
   //                                                dataType: "json",
   //                                                success: function (data) {
   //                                                    $('textarea').each(function () {
   //                                                        $(this).val('');
   //                                                    });
   //
   //                                                    //  $('.insertcomment' + clicked_id).html(data);
   //                                                    $('#' + 'insertcount' + clicked_id).html(data.count);
   //                                                    $('.insertcomment' + clicked_id).html(data.comment);
   //
   //                                                }
   //                                            });
   //
   //                                        } else {
   //
   //                                            $.ajax({
   //                                                type: 'POST',
   //                                                url: '<?php echo base_url() . "artistic/insert_comment" ?>',
   //                                                data: 'post_id=' + clicked_id + '&comment=' + val,
   //                                                // dataType: "json",
   //                                                success: function (data) {
   //                                                    $('textarea').each(function () {
   //                                                        $(this).val('');
   //                                                    });
   //                                                    $('#' + 'fourcomment' + clicked_id).html(data);
   //                                                }
   //                                            });
   //                                        }
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   
   function entercomment(clicked_id)
   {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       $('#post_comment' + clicked_id).keypress(function (e) {
   
           if (e.keyCode == 13 && !e.shiftKey) {
               e.preventDefault();
               var sel = $("#post_comment" + clicked_id);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');

              txt = txt.replace(/div>/gi, 'p>');


               if (txt == '' || txt == '<br>') {
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   
               $('#post_comment' + clicked_id).html("");
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               var x = document.getElementById('threecomment' + clicked_id);
               var y = document.getElementById('fourcomment' + clicked_id);
   
   
   
               if (x.style.display === 'block' && y.style.display === 'none') {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                       data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
                       dataType: "json",
                       success: function (data) { //alert(123); alert(data.commentcount);
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                         //  $('#' + 'insertcount' + clicked_id).html(data.count);
                           $('.insertcomment' + clicked_id).html(data.comment);
                           $('.like_count_ext' + clicked_id).html(data.commentcount);
                       }
                   });
               } else {
                   $.ajax({
                       type: 'POST',
                       url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                       data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
                       dataType: "json",
                       success: function (data) {
                           $('textarea').each(function () {
                               $(this).val('');
                           });
                        //   $('#' + 'insertcount' + clicked_id).html(data.count);
                           $('#' + 'fourcomment' + clicked_id).html(data.comment);
                           $('.like_count_ext' + clicked_id).html(data.commentcount);
                          }
                   });
               }
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<!--comment insert script end -->
<!-- comment edit script start -->
<!-- comment edit box start-->
<script type="text/javascript">
   function comment_editbox(clicked_id) {
       document.getElementById('editcomment' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcomment' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit' + clicked_id).style.display = 'inline-block';
       //document.getElementById('editbox' + clicked_id).style.display = 'none';
       document.getElementById('editcommentbox' + clicked_id).style.display = 'none';
       document.getElementById('editcancle' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancle(clicked_id) {
       document.getElementById('editcommentbox' + clicked_id).style.display = 'block';
       document.getElementById('editcancle' + clicked_id).style.display = 'none';
       document.getElementById('editcomment' + clicked_id).style.display = 'none';
       document.getElementById('showcomment' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   }
   
   function comment_editboxtwo(clicked_id) {
       //                            alert('editcommentboxtwo' + clicked_id);
       //                            return false;
       $('div[id^=editcommenttwo]').css('display', 'none');
       $('div[id^=showcommenttwo]').css('display', 'block');
       $('button[id^=editsubmittwo]').css('display', 'none');
       $('div[id^=editcommentboxtwo]').css('display', 'block');
       $('div[id^=editcancletwo]').css('display', 'none');
   
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'inline-block';
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'none';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   }
   
   
   function comment_editcancletwo(clicked_id) {
   
       document.getElementById('editcommentboxtwo' + clicked_id).style.display = 'block';
       document.getElementById('editcancletwo' + clicked_id).style.display = 'none';
   
       document.getElementById('editcommenttwo' + clicked_id).style.display = 'none';
       document.getElementById('showcommenttwo' + clicked_id).style.display = 'block';
       document.getElementById('editsubmittwo' + clicked_id).style.display = 'none';
       $('.post-design-commnet-box').show();
   }
   
   function comment_editbox3(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
       document.getElementById('editcomment3' + clicked_id).style.display = 'block';
       document.getElementById('showcomment3' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit3' + clicked_id).style.display = 'block';
   
       document.getElementById('editcommentbox3' + clicked_id).style.display = 'none';
       document.getElementById('editcancle3' + clicked_id).style.display = 'block';
       $('.post-design-commnet-box').hide();
   
   }
   
   function comment_editcancle3(clicked_id) {
   
       document.getElementById('editcommentbox3' + clicked_id).style.display = 'block';
       document.getElementById('editcancle3' + clicked_id).style.display = 'none';
   
       document.getElementById('editcomment3' + clicked_id).style.display = 'none';
       document.getElementById('showcomment3' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit3' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   
   }
   
   function comment_editbox4(clicked_id) { //alert(clicked_id); alert('editcomment' + clicked_id); alert('showcomment' + clicked_id); alert('editsubmit' + clicked_id); 
       document.getElementById('editcomment4' + clicked_id).style.display = 'block';
       document.getElementById('showcomment4' + clicked_id).style.display = 'none';
       document.getElementById('editsubmit4' + clicked_id).style.display = 'block';
   
       document.getElementById('editcommentbox4' + clicked_id).style.display = 'none';
       document.getElementById('editcancle4' + clicked_id).style.display = 'block';
   
       $('.post-design-commnet-box').hide();
   
   }
   
   function comment_editcancle4(clicked_id) {
   
       document.getElementById('editcommentbox4' + clicked_id).style.display = 'block';
       document.getElementById('editcancle4' + clicked_id).style.display = 'none';
   
       document.getElementById('editcomment4' + clicked_id).style.display = 'none';
       document.getElementById('showcomment4' + clicked_id).style.display = 'block';
       document.getElementById('editsubmit4' + clicked_id).style.display = 'none';
   
       $('.post-design-commnet-box').show();
   
   }
</script>
<!--comment edit box end-->
<!-- comment edit insert start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   //                        function edit_comment(abc)
   //                        {
   //                            var $field = $('#editcomment' + abc);
   //                            var editpostdetails = $('#editcomment' + abc).html();
   //                            if (editpostdetails == '') {
   //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                $('#bidmodal').modal('show');
   //                            } else {
   //                                $.ajax({
   //                                    type: 'POST',
   //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                    data: 'post_id=' + abc + '&comment=' + editpostdetails,
   //                                    success: function (data) {
   //                                        document.getElementById('editcomment' + abc).style.display = 'none';
   //                                        document.getElementById('showcomment' + abc).style.display = 'block';
   //                                        document.getElementById('editsubmit' + abc).style.display = 'none';
   //                                        document.getElementById('editbox' + abc).style.display = 'block';
   //                                        document.getElementById('editcancle' + abc).style.display = 'none';
   //                                        $('#' + 'showcomment' + abc).html(data);
   //                                    }
   //                                });
   //                            }
   //                        }
   
   function edit_comment(abc)
   {
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcomment" + abc);
       var txt = sel.html();
   
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
        txt = txt.replace(/div>/gi, 'p>');

       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
           data: 'post_id=' + abc + '&comment=' + encodeURIComponent(txt),
           success: function (data) {
               document.getElementById('editcomment' + abc).style.display = 'none';
               document.getElementById('showcomment' + abc).style.display = 'block';
               document.getElementById('editsubmit' + abc).style.display = 'none';
               document.getElementById('editcommentbox' + abc).style.display = 'block';
               document.getElementById('editcancle' + abc).style.display = 'none';
               $('#' + 'showcomment' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function commentedit(abc)
   //                        {
   //                                $('#editcomment' + abc).keypress(function (e) {
   //                                if (event.which == 13 && event.shiftKey != 1) {
   //                                    var $field = $('#editcomment' + abc);
   //                                    var editpostdetails = $('#editcomment' + abc).html();
   //                                    if (editpostdetails == '') {
   //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                        $('#bidmodal').modal('show');
   //                                    } else {
   //                                        $.ajax({
   //                                            type: 'POST',
   //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                            data: 'post_id=' + abc + '&comment=' + editpostdetails,
   //                                            success: function (data) {
   //                                                document.getElementById('editcomment' + abc).style.display = 'none';
   //                                                document.getElementById('showcomment' + abc).style.display = 'block';
   //                                                document.getElementById('editsubmit' + abc).style.display = 'none';
   //                                                document.getElementById('editbox' + abc).style.display = 'block';
   //                                                document.getElementById('editcancle' + abc).style.display = 'none';
   //                                                $('#' + 'showcomment' + abc).html(data);
   //                                            }
   //                                        });
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   function commentedit(abc)
   {
       $("#editcomment" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
       $('#editcomment' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcomment" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');

               txt = txt.replace(/div>/gi, 'p>');


               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_delete(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   //                                       
   
               if (window.preventDuplicateKeyPresses)
                   return;
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                   data: 'post_id=' + abc + '&comment=' + encodeURIComponent(txt),
                   success: function (data) {
                       document.getElementById('editcomment' + abc).style.display = 'none';
                       document.getElementById('showcomment' + abc).style.display = 'block';
                       document.getElementById('editsubmit' + abc).style.display = 'none';
                       document.getElementById('editcommentbox' + abc).style.display = 'block';
                       document.getElementById('editcancle' + abc).style.display = 'none';
                       $('#' + 'showcomment' + abc).html(data);
                       $('.post-design-commnet-box').show();
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function edit_commenttwo(abc)
   //                        {
   //                            var post_comment_edit = document.getElementById("editcommenttwo" + abc);
   //                            if (post_comment_edit.value == '') {
   //                                $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                $('#bidmodal').modal('show');
   //                            } else {
   //                                $.ajax({
   //                                    type: 'POST',
   //                                    url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                    data: 'post_id=' + abc + '&comment=' + post_comment_edit.value,
   //                                    success: function (data) {
   //                                        document.getElementById('showcommenttwo' + abc).style.display = 'block';
   //                                        document.getElementById('showcommenttwo' + abc).innerHTML = data;
   //                                        document.getElementById('editboxtwo' + abc).style.display = 'block';
   //                                        document.getElementById('editcommenttwo' + abc).style.display = 'none';
   //                                        document.getElementById('editsubmittwo' + abc).style.display = 'none';
   //                                        document.getElementById('editcancletwo' + abc).style.display = 'none';
   //                                    }
   //                                });
   //                            }
   //                        }
   
   function edit_commenttwo(abc)
   {
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
       });
   
       var sel = $("#editcommenttwo" + abc);
       var txt = sel.html();
   
       txt = txt.replace(/&nbsp;/gi, " ");
       txt = txt.replace(/<br>$/, '');
       txt = txt.replace(/div>/gi, 'p>');


       if (txt == '' || txt == '<br>') {
           $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
           $('#bidmodal').modal('show');
           return false;
       }
       if (/^\s+$/gi.test(txt))
       {
           return false;
       }
   
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
           data: 'post_id=' + abc + '&comment=' + encodeURIComponent(txt),
           success: function (data) {
               document.getElementById('editcommenttwo' + abc).style.display = 'none';
               document.getElementById('showcommenttwo' + abc).style.display = 'block';
               document.getElementById('editsubmittwo' + abc).style.display = 'none';
               document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
               document.getElementById('editcancletwo' + abc).style.display = 'none';
               $('#' + 'showcommenttwo' + abc).html(data);
               $('.post-design-commnet-box').show();
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<script type="text/javascript">
   //                        function commentedittwo(abc)
   //                        {
   //                            $('#editcommenttwo' + abc).keypress(function (e) {
   //                                if (e.which == 13) {
   //                                    var val = $('#editcommenttwo' + abc).val();
   //
   //                                    if (val == '') {
   //                                        $('.biderror .mes').html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
   //                                        $('#bidmodal').modal('show');
   //                                    } else {
   //                                        $.ajax({
   //                                            type: 'POST',
   //                                            url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
   //                                            data: 'post_id=' + abc + '&comment=' + val,
   //                                            success: function (data) {
   //                                                document.getElementById('editcommenttwo' + abc).style.display = 'none';
   //                                                document.getElementById('showcommenttwo' + abc).style.display = 'block';
   //                                                document.getElementById('editsubmittwo' + abc).style.display = 'none';
   //                                                document.getElementById('editboxtwo' + abc).style.display = 'block';
   //                                                document.getElementById('editcancletwo' + abc).style.display = 'none';
   //                                                $('#' + 'showcommenttwo' + abc).html(data);
   //                                            }
   //                                        });
   //                                    }
   //                                    e.preventDefault();
   //                                }
   //                            });
   //                        }
   
   function commentedittwo(abc)
   {
       $("#editcommenttwo" + abc).click(function () {
           $(this).prop("contentEditable", true);
           //$(this).html("");
       });
       $('#editcommenttwo' + abc).keypress(function (event) {
           if (event.which == 13 && event.shiftKey != 1) {
               event.preventDefault();
               var sel = $("#editcommenttwo" + abc);
               var txt = sel.html();
   
               txt = txt.replace(/&nbsp;/gi, " ");
               txt = txt.replace(/<br>$/, '');
               txt = txt.replace(/div>/gi, 'p>');


               if (txt == '' || txt == '<br>') {
                   $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='comment_deletetwo(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                   $('#bidmodal').modal('show');
                   return false;
               }
               if (/^\s+$/gi.test(txt))
               {
                   return false;
               }
   
               if (window.preventDuplicateKeyPresses)
                   return;
   
               window.preventDuplicateKeyPresses = true;
               window.setTimeout(function () {
                   window.preventDuplicateKeyPresses = false;
               }, 500);
   
               $.ajax({
                   type: 'POST',
                   url: '<?php echo base_url() . "artistic/edit_comment_insert" ?>',
                   data: 'post_id=' + abc + '&comment=' + encodeURIComponent(txt),
                   success: function (data) {
                       document.getElementById('editcommenttwo' + abc).style.display = 'none';
                       document.getElementById('showcommenttwo' + abc).style.display = 'block';
                       document.getElementById('editsubmittwo' + abc).style.display = 'none';
   
                       document.getElementById('editcommentboxtwo' + abc).style.display = 'block';
                       document.getElementById('editcancletwo' + abc).style.display = 'none';
   
                       $('#' + 'showcommenttwo' + abc).html(data);
                       $('.post-design-commnet-box').show();
   
                   }
               });
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   }
</script>
<!--comment edit insert script end -->
<!-- hide and show data start-->
<script type="text/javascript">
   function commentall(clicked_id) {
       var x = document.getElementById('threecomment' + clicked_id);
       var y = document.getElementById('fourcomment' + clicked_id);
       var z = document.getElementById('insertcount' + clicked_id);
   
       if (x.style.display === 'block' && y.style.display === 'none') {
           x.style.display = 'none';
           y.style.display = 'block';
           z.style.visibility = 'show';
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/fourcomment" ?>',
               data: 'art_post_id=' + clicked_id,
               //alert(data);
               success: function (data) {
                   $('#' + 'fourcomment' + clicked_id).html(data);
               }
           });
       }
       // } else {
       //      x.style.display = 'block';
       //      y.style.display = 'block';
       //      z.style.display = 'block';
   
       //      $.ajax({ 
       //             type:'POST',
       //             url:'<?php echo base_url() . "artistic/fourcomment" ?>',
       //             data:'art_post_id='+clicked_id,
       //             //alert(data);
       //             success:function(data){
       //       $('#' + 'threecomment' + clicked_id).html(data);
   
       //       }
       //         });
       // }
   }
</script>
<!-- hide and show data end-->
<!-- popup box for post start -->
<script>
   // Get the modal
   var modal = document.getElementById('myModal');
   
   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");
   
   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close1")[0];
   
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
<!-- popup form end-->
<script>
   /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
   function myFunction1(clicked_id) {
   
        document.getElementById('myDropdown' + clicked_id).classList.toggle("show");
    
         $( document ).on( 'keydown', function ( e ) {
                   if ( e.keyCode === 27 ) { 
   
                   document.getElementById('myDropdown' + clicked_id).classList.toggle("hide");
                    $(".dropdown-content2").removeClass('show');
   
       }
      
   }); 
   
   }
   
   // Close the dropdown if the user clicks outside of it
   window.onclick = function (event) {
       if (!event.target.matches('.dropbtn1')) {
   
           var dropdowns = document.getElementsByClassName("dropdown-content2");
           var i;
           for (i = 0; i < dropdowns.length; i++) {
               var openDropdown = dropdowns[i];
               if (openDropdown.classList.contains('show')) {
                   openDropdown.classList.remove('show');
               }
           }
       }
   }
   
   
</script>
<!-- further and less -->
<!--  <script>
   $(function () {
       var showTotalChar = 200, showChar = "Read More", hideChar = "";
       $('.show').each(function () {
           //var content = $(this).text();
           var content = $(this).html();
           if (content.length > showTotalChar) {
               var con = content.substr(0, showTotalChar);
               var hcon = content.substr(showTotalChar, content.length - showTotalChar);
               var txt = con + '<span class="dots">...</span><span class="morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="showmoretxt">' + showChar + '</a></span>';
               $(this).html(txt);
           }
       });
       $(".showmoretxt").click(function () {
           if ($(this).hasClass("sample")) {
               $(this).removeClass("sample");
               $(this).text(showChar);
           } else {
               $(this).addClass("sample");
               $(this).text(hideChar);
           }
           $(this).parent().prev().toggle();
           $(this).prev().toggle();
           return false;
       });
   });
   </script> -->
<!-- multi image add post khyati start -->
<script type="text/javascript">
   //alert("a");
   var $fileUpload = $("#files"),
           $list = $('#list'),
           thumbsArray = [],
           maxUpload = 10;
   
   // READ FILE + CREATE IMAGE
   function read(f) {//alert("aa");
       return function (e) {
           var base64 = e.target.result;
           var $img = $('<img/>', {
               src: base64,
               title: encodeURIComponent(f.name), //( escape() is deprecated! )
               "class": "thumb"
           });
           var $thumbParent = $("<span/>", {html: $img, "class": "thumbParent"}).append('<span class="remove_thumb"/>');
           thumbsArray.push(base64); // Push base64 image into array or whatever.
           $list.append($thumbParent);
       };
   }
   
   // HANDLE FILE/S UPLOAD
   function handleFileSelect(e) {//alert("aaa");
       e.preventDefault(); // Needed?
       var files = e.target.files;
       var len = files.length;
       if (len > maxUpload || thumbsArray.length >= maxUpload) {
           return alert("Sorry you can upload only 5 images");
       }
       for (var i = 0; i < len; i++) {
           var f = files[i];
           if (!f.type.match('image.*'))
               continue; // Only images allowed    
           var reader = new FileReader();
           reader.onload = read(f); // Call read() function
           reader.readAsDataURL(f);
       }
   }
   
   $fileUpload.change(function (e) {//alert("aaaa");
       handleFileSelect(e);
   });
   
   $list.on('click', '.remove_thumb', function () {//alert("aaaaa");
       var $removeBtns = $('.remove_thumb'); // Get all of them in collection
       var idx = $removeBtns.index(this);   // Exact Index-from-collection
       $(this).closest('span.thumbParent').remove(); // Remove tumbnail parent
       thumbsArray.splice(idx, 1); // Remove from array
   });
   
   
   
</script>
<!-- multi image add post khyati end -->
<!-- success message remove after some second start -->
<script type="text/javascript">
   $(document).ready(function () {
   
       $('.alert-danger').delay(3000).hide('700');
   
       $('.alert-success').delay(3000).hide('700');
   
   });
   
</script>
<!-- success message remove after some second end -->
<!-- edit post start -->
<!-- <script type="text/javascript">
   function editpost(abc)
   {
       document.getElementById('editpostdata' + abc).style.display = 'none';
       document.getElementById('editpostbox' + abc).style.display = 'block';
       //document.getElementById('editpostdetails' + abc).style.display = 'none', 'display:inline !important';
       document.getElementById('editpostdetailbox' + abc).style.display = 'block';
       document.getElementById('editpostsubmit' + abc).style.display = 'block';
       document.getElementById('khyati' + abc).style.display = 'none';
   }
</script>
<script type="text/javascript">
   function edit_postinsert(abc)
   {
   
       var editpostname = document.getElementById("editpostname" + abc);
       // var editpostdetails = document.getElementById("editpostdesc" + abc);
       // start khyati code
       var $field = $('#editpostdesc' + abc);
       //var data = $field.val();
       var editpostdetails = $('#editpostdesc' + abc).html();
       // end khyati code
   
       if ((editpostname.value == '') && (editpostdetails == '' || editpostdetails == '<br>')) {
           $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
           $('#bidmodal').modal('show');
   
           document.getElementById('editpostdata' + abc).style.display = 'block';
           document.getElementById('editpostbox' + abc).style.display = 'none';
         //  document.getElementById('editpostdetails' + abc).style.display = 'block';
           document.getElementById('editpostdetailbox' + abc).style.display = 'none';
   
           document.getElementById('editpostsubmit' + abc).style.display = 'none';
       } else {
           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_post_insert" ?>',
               data: 'art_post_id=' + abc + '&art_post=' + editpostname.value + '&art_description=' + editpostdetails,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                   //alert(data.description);
                   document.getElementById('khyati').style.display = 'block';
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyati').html(data.description);
                 
               }
           });
       }
   
   }
</script>
<!- edit post end --> 
<!-- save post start -->
<script>
   function save_post(abc)
   {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/artistic_save" ?>',
           data: 'art_post_id=' + abc,
           success: function (data) {
   
               $('.' + 'savedpost' + abc).html(data);
               //window.setTimeout(update, 10000);
   
           }
       });
   
   }
</script>
<!-- save post end -->
<!-- remove save post start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   function deleteownpostmodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this post?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='remove_post(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function remove_post(abc)
   { 
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/art_delete_post" ?>',
           dataType: 'json',
           data: 'art_post_id=' + abc,
           //alert(data);
           success: function (data) { 
   
               $('#' + 'removepost' + abc).remove();
               if(data.notcount == 'count'){
                    $('.' + 'nofoundpost').html(data.notfound);
                   }

   
   
           }
       });
   
   }
</script>
<!-- remove save post end -->
<!-- remove particular user post start -->
<script type="text/javascript">
   function deletepostmodel(abc) {
   
   
       $('.biderror .mes').html("<div class='pop_content'>Do you want to delete this post from your profile?<div class='model_ok_cancel'><a class='okbtn' id=" + abc + " onClick='del_particular_userpost(" + abc + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
   }
   
</script>
<script type="text/javascript">
   function del_particular_userpost(abc)
   {
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/del_particular_userpost" ?>',
           dataType: 'json',
           data: 'art_post_id=' + abc,
           //alert(data);
           success: function (data) {
   
               $('#' + 'removepost' + abc).remove();
               if(data.notcount == 'count'){
                    $('.' + 'nofoundpost').html(data.notfound);
                   }

   
   
           }
       });
   
   }
   
</script>
<!-- remove particular user post end -->
<!-- follow user script start -->
<script type="text/javascript">
   function followuser(clicked_id)
   {
   
       $("#fad" + clicked_id).fadeOut(6000);
   
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/follow_two" ?>',
           data: 'follow_to=' + clicked_id,
           success: function (data) {
   
               $('.' + 'fr' + clicked_id).html(data);
   
           }
   
   
       });
   
   }
   
</script>
<script type="text/javascript">
   function followclose(clicked_id)
   {
       $("#fad" + clicked_id).fadeOut(3000);
   }
</script>
<!--follow like script end -->
<!-- insert post validtation start -->
<script src="<?php echo base_url('js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
   function imgval(event) {
       //var fileInput = document.getElementById('test-upload');
       var fileInput = document.getElementById("file-1").files;
       var product_name = document.getElementById("test-upload_product").value;

       var product_trim = product_name.trim();


       var product_description = document.getElementById("test-upload_des").value;

        var des_trim = product_description.trim();

       var product_fileInput = document.getElementById("file-1").value;
   
   
       if (product_fileInput == '' && product_trim == '' && des_trim == '')
       {
   
           $('#post .mes').html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post.");
            $('#post').modal('show');
           // setInterval('window.location.reload()', 10000);
           // window.location='';
   
            $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
           event.preventDefault();
           return false;
   
       } else {
   
   
           for (var i = 0; i < fileInput.length; i++)
           {
               var vname = fileInput[i].name;
               var vfirstname = fileInput[0].name;
               var ext = vfirstname.split('.').pop();
               var ext1 = vname.split('.').pop();
               var allowedExtensions = ['jpg', 'jpeg', 'PNG', 'gif', 'png'];
               var allowesvideo = ['mp4', 'webm'];
               var allowesaudio = ['mp3'];
               var allowespdf = ['pdf'];
   
               var foundPresent = $.inArray(ext, allowedExtensions) > -1;
               var foundPresentvideo = $.inArray(ext, allowesvideo) > -1;
               var foundPresentaudio = $.inArray(ext, allowesaudio) > -1;
               var foundPresentpdf = $.inArray(ext, allowespdf) > -1;
   
               if (foundPresent == true)
               {
                   var foundPresent1 = $.inArray(ext1, allowedExtensions) > -1;
   
                   if (foundPresent1 == true && fileInput.length <= 10) {
                   } else {
   
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       //setInterval('window.location.reload()', 10000);
                       // window.location='';
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
   
               } else if (foundPresentvideo == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowesvideo) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {
                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       //setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
               } else if (foundPresentaudio == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowesaudio) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {


                    if (product_name == '') {
                           $('#post .mes').html("<div class='pop_content'>You have to add audio title.");
                           $('#post').modal('show');
                           //setInterval('window.location.reload()', 10000);
                            $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                           event.preventDefault();
                           return false;
                       }


                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                      // setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
   
                       event.preventDefault();
                       return false;
                   }
               } else if (foundPresentpdf == true)
               {
   
                   var foundPresent1 = $.inArray(ext1, allowespdf) > -1;
   
                   if (foundPresent1 == true && fileInput.length == 1) {
   
                       if (product_name == '') {
                           $('#post .mes').html("<div class='pop_content'>You have to add pdf title.");
                           $('#post').modal('show');
                           //setInterval('window.location.reload()', 10000);
                            $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                           event.preventDefault();
                           return false;
                       }
                   } else {
                       $('#post .mes').html("<div class='pop_content'>You can only upload one type of file at a time...either photo or video or audio or pdf.");
                       $('#post').modal('show');
                       //setInterval('window.location.reload()', 10000);
   
                        $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                       event.preventDefault();
                       return false;
                   }
               } 

               else if (foundPresentvideo == false && foundPresentpdf == false && foundPresentaudio == false && foundPresent == false) {
   
                   $('#post .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload images , video , pdf or audio..");
                   $('#post').modal('show');
                  // setInterval('window.location.reload()', 10000);
   
                    $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                   event.preventDefault();
                   return false;
   
               }


               else if (foundPresentvideo == false) {
   
                   $('#post .mes').html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files..");
                   $('#post').modal('show');
                   //setInterval('window.location.reload()', 10000);
   
                    $( document ).on( 'keydown', function ( e ) {
                     if ( e.keyCode === 27 ) {
                   //$( "#bidmodal" ).hide();
                   $('#post').modal('hide');
                   $('.modal-post').show();
   
                  }
               });  
   
                   event.preventDefault();
                   return false;
   
               }
   
           }
       }
   }
   
</script>

<!-- insert validation end -->
<!-- 
   textarea js -->
<script type="text/javascript">
   function contentedit(clicked_id) {
       //var $field = $('#post_comment' + clicked_id);
       //var data = $field.val();
       // var post_comment = $('#post_comment' + clicked_id).html();
       //$(document).ready(function($) {
       $("#post_comment" + clicked_id).click(function () {
           $(this).prop("contentEditable", true);
           $(this).html("");
       });
       $("#post_comment" + clicked_id).keypress(function (event) { //alert(post_comment);
           if (event.which == 13 && event.shiftKey != 1) { //alert(post_comment);
               event.preventDefault();
               var sel = $("#post_comment" + clicked_id);
               var txt = sel.html();
   
               $('#post_comment' + clicked_id).html("");
               // $("#result").html(txt);
               // sel.html("")
               // sel.blur();
               //alert('.insertcomment' + clicked_id);
               var x = document.getElementById('threecomment' + clicked_id);
               var y = document.getElementById('fourcomment' + clicked_id);
               if (txt == '') {
                   event.preventDefault();
                   return false;
               } else {
                   if (x.style.display === 'block' && y.style.display === 'none') {
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/insert_commentthree" ?>',
                           data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
                           dataType: "json",
                           success: function (data) {
   
                               //  $('.insertcomment' + clicked_id).html(data);
                               $('#' + 'insertcount' + clicked_id).html(data.count);
                               $('.insertcomment' + clicked_id).html(data.comment);
   
                           }
                       });
   
                   } else {
   
                       $.ajax({
                           type: 'POST',
                           url: '<?php echo base_url() . "artistic/insert_comment" ?>',
                           data: 'post_id=' + clicked_id + '&comment=' + encodeURIComponent(txt),
                           // dataType: "json",
                           success: function (data) {
                               $('#' + 'fourcomment' + clicked_id).html(data);
                               // $('#' + 'insertcount' + clicked_id).html(data.count);
                               //  $('#' + 'fourcomment' + clicked_id).html(data.comment);
   
                           }
                       });
                   }
               }
   
           }
       });
       $(".scroll").click(function (event) {
           event.preventDefault();
           $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
       });
   
       // });
   
   }
</script>
<script type="text/javascript">
   function likeuserlist(post_id) {
   
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url() . "artistic/likeuserlist" ?>',
           data: 'post_id=' + post_id,
           dataType: "html",
           success: function (data) {
               var html_data = data;
               $('#likeusermodal .mes').html(html_data);
               $('#likeusermodal').modal('show');
           }
       });
   
   
   }
</script>
<style type="text/css">
   .likeduser{
   width: 100%;
   background-color: #1b8ab9;
   }
   .likeduser-title{
   color: #fff;
   margin-bottom: 5px;
   padding: 7px;
   }
   .likeuser_list{
   background-color: #ccc;
   float: left;
   margin: 0px 6px 5px 9px;
   padding: 5px;
   width: 47%;
   font-size: 14px;
   }
   .likeduserlist, .likeduserlist1 {
   float: left;
   background-color: #fff!important;
   /*        margin-left: 15px;
   margin-right: 15px;*/
   width: 100%!important;
   }
   div[class^="likeduserlist"]{
   width: 100% !important;
   background-color: #fff !important;
   }
   /*.like_one_other{
   margin-left: 15px;*/
   /*  margin-right: 15px;*/
   /*}*/
</style>
<!-- This  script use for close dropdown in every post -->
<script type="text/javascript">
   $('body').on("click", "*", function (e) {
       var classNames = $(e.target).attr("class").toString().split(' ').pop();
       if (classNames != 'fa-ellipsis-v') {
           $('div[id^=myDropdown]').hide().removeClass('show');
       }
   
   });
   
</script>
<!-- This  script use for close dropdown in every post -->
<!-- multi image add post khyati end -->
<script language=JavaScript>
   function check_length(my_form)
   { //alert("hii");
       maxLen = 50;
   //alert(my_form.my_text.value.length);
       // max number of characters allowed
       if (my_form.my_text.value.length > maxLen) {
           // Alert message if maximum limit is reached. 
           // If required Alert can be removed. 
           var msg = "You have reached your maximum limit of characters allowed";
           $("#test-upload_product").prop("readonly", true);
           //    alert(msg);
           //my_form.text_num.value = maxLen - my_form.my_text.value.length;
           $('.biderror .mes').html("<div class='pop_content'>" + msg + "</div>");
           $('#bidmodal-limit').modal('show');
           // Reached the Maximum length so trim the textarea
           my_form.my_text.value = my_form.my_text.value.substring(0, maxLen);
       } else { //alert("1");
           // Maximum length not reached so update the value of my_text counter
           my_form.text_num.value = maxLen - my_form.my_text.value.length;
       }
   }


    function check_lengthedit(abc)
   { 
       maxLen = 50;
   

       var product_name = document.getElementById("editpostname" +abc).value;
      
 
       if (product_name.length > maxLen) { 

           
           text_num = maxLen - product_name.length;
           var msg = "You have reached your maximum limit of characters allowed";

            $("#editpostname" + abc).prop("readonly", true);
              
           $('#postedit .mes').html("<div class='pop_content'>" + msg + "</div>");
           $('#postedit').modal('show');
           
           var substrval = product_name.substring(0, maxLen);
           $('#editpostname' + abc).val(substrval);
         
       } else { 
           text_num = maxLen - product_name.length;

           document.getElementById("text_num").value = text_num;
       }
   }
  
</script>

<script type="text/javascript">
   // all popup close close using esc start
      
    
    
   
   //all popup close close using esc end
   
    // pop up open & close aarati code start 
   jQuery(document).mouseup(function (e) {
               
                var container1 = $("#myModal");
               
                       jQuery(document).mouseup(function (e)
                         {
                           var container = $("#close");
   
             
                   if (!container.is(e.target) // if the target of the click isn't the container...
                   && container.has(e.target).length === 0) // ... nor a descendant of the container
               {
                 
                   container1.hide();
               }
           });
                  
           });
   
   // pop up open & close aarati code end
   
</script>
<script src="<?php echo base_url('js/demo/jquery-1.9.1.js'); ?>"></script>
<script src="<?php echo base_url('js/demo/jquery-ui-1.9.1.js'); ?>"></script>
<!-- script for skill textbox automatic end (option 2)-->
<!-- script for skill textbox automatic end (option 2)-->
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
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
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
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
   
   })(jQuery);
   
</script>


<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data = <?php echo json_encode($demo); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#tags1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#tag1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#tags1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<script>
   jQuery.noConflict();
   
   (function ($) {
   
       var data1 = <?php echo json_encode($de); ?>;
       //alert(data);
   
   
       $(function () {
           // alert('hi');
           $("#searchplace1").autocomplete({
               source: function (request, response) {
                   var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                   response($.grep(data1, function (item) {
                       return matcher.test(item.label);
                   }));
               },
               minLength: 1,
               select: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
                   $("#selected-tag").val(ui.item.label);
                   // window.location.href = ui.item.value;
               }
               ,
               focus: function (event, ui) {
                   event.preventDefault();
                   $("#searchplace1").val(ui.item.label);
               }
           });
       });
   
   })(jQuery);
   
</script>
<!--- khyati chnage ssstart 24-6 -->

<script type="text/javascript">
    
     function khdiv(abc) {
         
         $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_more_insert" ?>',
               data: 'art_post_id=' + abc,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                     document.getElementById('khyati' + abc).style.display = 'none';
                 document.getElementById('khyatii' + abc).style.display = 'block';
                   //alert(data.description);
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyatii' + abc).html(data.description);
                 
               }
           });
   
   }
   
   </script>
   
   <script type="text/javascript">
   function editpost(abc)
   {
       document.getElementById('editpostdata' + abc).style.display = 'none';
       document.getElementById('editpostbox' + abc).style.display = 'block';
       //document.getElementById('editpostdetails' + abc).style.display = 'none', 'display:inline !important';
       document.getElementById('editpostdetailbox' + abc).style.display = 'block';
       document.getElementById('editpostsubmit' + abc).style.display = 'block';
       document.getElementById('khyati' + abc).style.display = 'none';
       document.getElementById('khyatii' + abc).style.display = 'none';

   }
</script>


<script type="text/javascript">
   function edit_postinsert(abc)
   {
   
       var editpostname = document.getElementById("editpostname" + abc);
       // var editpostdetails = document.getElementById("editpostdesc" + abc);
       // start khyati code
       var $field = $('#editpostdesc' + abc);
       //var data = $field.val();
       var editpostdetails = $('#editpostdesc' + abc).html();

        editpostdetails = editpostdetails.replace(/&gt;/gi,">");
       
       editpostdetails = editpostdetails.replace(/&nbsp;/gi, " ");
       // end khyati code
   //alert(editpostdetails);
       if ((editpostname.value == '') && (editpostdetails == '' || editpostdetails == '<br>')) {
           $('.biderror .mes').html("<div class='pop_content'>You must either fill title or description.");
           $('#bidmodal').modal('show');
   
           document.getElementById('editpostdata' + abc).style.display = 'block';
           document.getElementById('editpostbox' + abc).style.display = 'none';
           document.getElementById('khyati' + abc).style.display = 'block';
           document.getElementById('editpostdetailbox' + abc).style.display = 'none';
   
           document.getElementById('editpostsubmit' + abc).style.display = 'none';
       } else { 

   //alert(editpostdetails);

           $.ajax({
               type: 'POST',
               url: '<?php echo base_url() . "artistic/edit_post_insert" ?>',
               data: 'art_post_id=' + abc + '&art_post=' + editpostname.value + '&art_description=' + editpostdetails,
               dataType: "json",
               success: function (data) {
   
                   document.getElementById('editpostdata' + abc).style.display = 'block';
                   document.getElementById('editpostbox' + abc).style.display = 'none';
                 //  document.getElementById('editpostdetails' + abc).style.display = 'block';
                   document.getElementById('editpostdetailbox' + abc).style.display = 'none';
                   document.getElementById('editpostsubmit' + abc).style.display = 'none';
                   //alert(data.description);
                   document.getElementById('khyati' + abc).style.display = 'block';
                   $('#' + 'editpostdata' + abc).html(data.title);
                  // $('#' + 'editpostdetails' + abc).html(data.description);
                   $('#' + 'khyati' + abc).html(data.description);
                   $('#' + 'postname' + abc).html(data.postname);
                 
               }
           });
       }
   
   }
</script>
<!--- khyati chnage end 24-6 -->



<!-- all popup close close using esc start -->
<script type="text/javascript">

    $('#post').on('click', function(){
        $('#myModal').modal('show');
    });

   


    $( document ).on( 'keydown', function ( e ) {
       if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
           $('#likeusermodal').modal('hide');
       }
   });  
      
   $(document).on('keydown', function (e) { 
       if (e.keyCode === 27) {
           if($('.modal-post').show()){
   
             $( document ).on( 'keydown', function ( e ) {
             if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
          $('.modal-post').hide();

           }
          });  
        
   
           }
            //document.getElementById('myModal').style.display = "none";
            }
    });





   $( document ).on( 'keydown', function ( e ) {
       if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
           $('#post').modal('hide');
            //$('.modal-post').show();

       }
   });  

 $( document ).on( 'keydown', function ( e ) {
       if ( e.keyCode === 27 ) {
           //$( "#bidmodal" ).hide();
           $('#postedit').modal('hide');
         // $('.my_text').attr('readonly', false);
          $(".my_text").prop("readonly", false);
            //$('.modal-post').show();

       }
   });  
  
    
</script>


<script type="text/javascript">

            var _onPaste_StripFormatting_IEPaste = false;

            function OnPaste_StripFormatting(elem, e) {

                if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                   // alert(1);
                    e.preventDefault();
                    var text = e.originalEvent.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (e.clipboardData && e.clipboardData.getData) { 
                    //alert(2);
                   
                    e.preventDefault();
                    var text = e.clipboardData.getData('text/plain');
                    window.document.execCommand('insertText', false, text);
                } else if (window.clipboardData && window.clipboardData.getData) {

                    //alert(3);

                    // Stop stack overflow
                    if (!_onPaste_StripFormatting_IEPaste) {
                        _onPaste_StripFormatting_IEPaste = true;
                        e.preventDefault();
                        window.document.execCommand('ms-pasteTextOnly', false);
                    }
                    _onPaste_StripFormatting_IEPaste = false;
                }

            }

        </script>


<!-- 180 words more than script start -->

<script type="text/javascript">
    
     function seemorediv(abc) { //alert("hii");
         
                   document.getElementById('seemore' + abc).style.display = 'block';
                   document.getElementById('lessmore' + abc).style.display = 'none';
                
   }
   
   </script>
 <!-- 180 words more than script end-->


 <script type="text/javascript">
   
  $(document).ready(function(){ 

  var nb = $('div.post-design-box').length;
   if(nb == 0){
 $("#dropdownclass").addClass("no-post-h2");

   }

});
 </script>
            <script type="text/javascript">
                $('#file-1').on('click', function(e){
                   var a = document.getElementById('test-upload_product').value;
var b = document.getElementById('test-upload_des').value;
    document.getElementById("artpostform").reset();
    document.getElementById('test-upload_product').value = a;
    document.getElementById('test-upload_des').value = b;
    });
            </script>



            <script type="text/javascript">
              
              $('#post').on('click', function () {
    $('#myModal').modal('show');
    $("#test-upload_product").prop("readonly", false);
    });


$('#postedit').on('click', function () {
   // $('#myModal').modal('show');
    $(".my_text").prop("readonly", false);
    });
            </script>


            <!-- post upload using javascript start -->


   <script type = "text/javascript" src="<?php echo base_url() ?>js/jquery.form.3.51.js"></script>
        <script type="text/javascript">

    jQuery(document).ready(function ($) {
//  var bar = $('#bar');
//  var percent = $('#percent');

    var bar = $('.progress-bar');
    var percent = $('.sr-only');
    var options = {
    beforeSend: function () { 
    // Replace this with your loading gif image
    document.getElementById("progress_div").style.display = "block";
    var percentVal = '0%';
    bar.width(percentVal)
            percent.html(percentVal);
    document.getElementById("myModal").style.display = "none";
    },
            uploadProgress: function (event, position, total, percentComplete) { 
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
                    percent.html(percentVal);
            },
            success: function () {
            var percentVal = '100%';
            bar.width(percentVal)
                    percent.html(percentVal);
            },
            complete: function (response) {
            // Output AJAX response to the div container
            document.getElementById('test-upload_product').value = '';
           document.getElementById('test-upload_des').value = '';
           document.getElementById('file-1').value = '';
            $("input[name='my_text']").val(50);
            $(".file-preview-frame").hide();
//            $('#progress_div').fadeOut('5000').remove();
            document.getElementById("progress_div").style.display = "none";
            $('.art-all-post div:first').remove();
            $(".art-all-post").prepend(response.responseText);
            // second header class add for scroll
            var nb = $('.post-design-box').length;
            if (nb == 0) {
            $("#dropdownclass").addClass("no-post-h2");
            } else {
            $("#dropdownclass").removeClass("no-post-h2");
            }
            $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top - 100}, 150);
            }
    };
    // Submit the form
    $(".upload-image-form").ajaxForm(options);
    return false;
    });
</script>


<script type="text/javascript">

  $('#common-limit').on('click', function(){
        $('#myModal').modal('show');
    $("#test-upload_product").prop("readonly", false);

    });



</script>


<script type="text/javascript">
    
 


$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();

if(document.getElementById('bidmodal-limit').style.display === "block"){ 
        $('#bidmodal-limit').modal('hide');
    $("#test-upload_product").prop("readonly", false);
        
        $('#myModal').model('show');
 }
        document.getElementById('myModal').style.display === "none";

 

    }
});  
</script>

 <!-- post upload using javascript end -->

 <script>
            $(document).ready(function () {
                art_home_post();
                art_home_three_user_list()
            });
        </script>


        <script type="text/javascript">
            function art_home_post() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "artistic/art_home_post/" ?>',
                    data: '',
                    dataType: "html",
                    beforeSend: function () {
                        $(".art-all-post").prepend('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                    },
                    success: function (data) {
                        $('.loader').remove();
                        $('.art-all-post').html(data);

                        // second header class add for scroll
                        var nb = $('.post-design-box').length;
                        if (nb == 0) {
                            $("#dropdownclass").addClass("no-post-h2");
                        } else {
                            $("#dropdownclass").removeClass("no-post-h2");
                        }
                    }
                });
            }

            function art_home_three_user_list() {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "artistic/art_home_three_user_list/" ?>',
                    data: '',
                    dataType: "html",
                    beforeSend: function () {
                        $(".profile-boxProfileCard_follow").html('<p style="text-align:center;"><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
                    },
                    success: function (data) { //alert(data);
                        $('.loader').remove();
                        $('.profile-boxProfileCard_follow').html(data);
                    }
                });
            }
        </script>


</body>
</html>
