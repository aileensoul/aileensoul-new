

function updateprofilepopup(id) {
                                $('#bidmodal-2').modal('show');
                            }

 function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";
    }

    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
    }
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
                url: base_url + "artistic/ajaxpro",
               // url: "<?php echo base_url() ?>artistic/ajaxpro",
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

    $('#upload').on('change', function () {
        var reader = new FileReader();    
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

if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
    picpopup();
    document.getElementById('row1').style.display = "none";
    document.getElementById('row2').style.display = "block";
    $("#upload").val('');
    return false;
  }
      if (size > 10485760)
        {    
            alert("Allowed file size exceeded. (Max. 10 MB)")
            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            return false;
        }
        $.ajax({
            url: base_url + "artistic/image",
            //url: "<?php echo base_url(); ?>artistic/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
            }
        });
    });

function divClicked() {
       var divHtml = $(this).html();
        divHtml = divHtml.trim();
       var editableText = $("<textarea />");
       editableText.val(divHtml);
       $(this).replaceWith(editableText);
       editableText.focus();
       editableText.blur(editableTextBlurred);
   }
   
   function editableTextBlurred() {     
      var html = $(this).val();
      html = html.trim();
       var viewableText = $("<a>");     
       if (html.match(/^\s*$/) || html == '') { 
       html = "Current Work";
       }    
       viewableText.html(html);
       $(this).replaceWith(viewableText);
       viewableText.click(divClicked);
       $.ajax({
           url: base_url + "artistic/art_designation",
           //url: "<?php echo base_url(); ?>artistic/art_designation",
           type: "POST",
           data: {"designation": html},
           success: function (response) { 
           }
       });
   }
   
   $(document).ready(function () {
       $("a.designation").click(divClicked);
   });

   

function checkvalue() {                
                            var searchkeyword =$.trim(document.getElementById('tags').value);
                            var searchplace =$.trim(document.getElementById('searchplace').value);                        
                            if (searchkeyword == "" && searchplace == "") {                              
                                return false;
                            }
                        }

function check() {
                            var keyword = $.trim(document.getElementById('tags1').value);
                            var place = $.trim(document.getElementById('searchplace1').value);
                            if (keyword == "" && place == "") {
                                return false;
                            }
                        }

$('#searchplace').select2({

                                                    placeholder: 'Find Your Location',
                                                    maximumSelectionLength: 1,
                                                    ajax: {

                                                        url: base_url + "artistic/location",
                                                       // url: "<?php echo base_url(); ?>artistic/location",
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
$(document).ready(function() {
      $('.blocks').jMosaic({items_type: "li", margin: 0});
      $('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
    });

    function followuser(clicked_id)
    { 
        $.ajax({
            type: 'POST',
            url: base_url + "artistic/follow_two",
            //url: '<?php echo base_url() . "artistic/follow_two" ?>',
            data: 'follow_to=' + clicked_id,
            success: function (data) {
                $('.' + 'fruser' + clicked_id).html(data);
            }
        });
    }
function unfollowuser(clicked_id)
    {
        $.ajax({
            type: 'POST',
            url: base_url + "artistic/unfollow_two",
            //url: '<?php echo base_url() . "artistic/unfollow_two" ?>',
            data: 'follow_to=' + clicked_id,
            success: function (data) {
                $('.' + 'fruser' + clicked_id).html(data);
            }
        });
    }


$(document).ready(function() {
        $('video').mediaelementplayer({
            alwaysShowControls: false,
            videoVolume: 'horizontal',
            features: ['playpause','progress','volume','fullscreen']
        });
    });

  $(document).ready(function() {
  $("html,body").animate({scrollTop: 350}, 100); //100ms for example
});

function picpopup() {

            $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
            $('#bidmodal').modal('show');
          }

 $( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {      
        $('#bidmodal-2').modal('hide');
    }
});  

$(document).ready(function(){
    $('html,body').animate({scrollTop:265}, 100);
});