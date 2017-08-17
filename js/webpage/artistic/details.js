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

    function divClicked() {
                            var divHtml = $(this).html();
                             divHtml = divHtml.trim();
                            var editableText = $("<textarea />");
                            editableText.val(divHtml);
                            $(this).replaceWith(editableText);
                            editableText.focus();
                            // setup the blur event for this new textarea
                            editableText.blur(editableTextBlurred);
                        }
                            function editableTextBlurred() {
                            var html = $(this).val();
                            html = html.trim();
                            //alert(html);
                            var viewableText = $("<a>");
                            if (html.match(/^\s*$/) || html == '') {
                                html = "Current Work";
                            }
                            viewableText.html(html);
                            $(this).replaceWith(viewableText);
                            // setup the click event for this new div
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
$(function() {
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
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags").val(ui.item.label);
    }
});
});
$(function() {
$( "#searchplace" ).autocomplete({
     source: function( request, response ) {
         var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
         response( $.grep( data1, function( item ){
             return matcher.test( item.label );
         }) );
   },
    minLength: 1,
    select: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
        $("#selected-tag").val(ui.item.label);
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});
$(function() {
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
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#tags1").val(ui.item.label);
    }
});
});
$(function() {
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
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace1").val(ui.item.label);
    }
});
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
                    if (html)
                    {
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


    $("#upload").change(function () { 
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
                      if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
                  $('#profilepic').val('');
                   picpopup();
                     return false;
                   }else{
                      readURL(this);}
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

 function updateprofilepopup(id) {
$('#bidmodal-2').modal('show');
}
