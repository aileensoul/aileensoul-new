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

$(document).ready(function () {  
    artistic_following(slug_id);  
});
function artistic_following(slug_id)
{//alert(slug_id);
    //if (isProcessing) {
        /*
         *This won't go past this condition while
         *isProcessing is true.
         *You could even display a message.
         **/
        //return;
    //}
   // isProcessing = true;
    $.ajax({
        type: 'POST',
        url: base_url + "artistic/ajax_following",
        //url: '<?php echo base_url() . "artistic/ajax_following" ?>',
        //url: base_url + "artistic/ajax_following/" + slug_id + '?page=' + pagenum,
         data: 'slug_id=' + slug_id,
        //data: {total_record:$("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            //if (pagenum == 'undefined') {
              //  $(".contact-frnd-post").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
           // } else {
           //     $('#loader').show();
           // }
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $('.loader').remove();
            $('.contact-frnd-post').append(data);
            // second header class add for scroll
            var nb = $('.post-design-box').length;
            if (nb == 0) {
                $("#dropdownclass").addClass("no-post-h2");
            } else {
                $("#dropdownclass").removeClass("no-post-h2");
            }
           // isProcessing = false;
        }
    });
}

function updateprofilepopup(id) {
        $('#bidmodal-2').modal('show');
    }
var modal = document.getElementById('myModal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

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
                            // alert("hi");
                                $("a.designation").click(divClicked);
                            });

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

$(function() {
    // alert('hi');
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
        // window.location.href = ui.item.value;
    }
    ,
    focus: function(event, ui) {
        event.preventDefault();
        $("#searchplace").val(ui.item.label);
    }
});
});

// $(function() {
//     // alert('hi');
// $( "#tags1" ).autocomplete({
//      source: function( request, response ) {
//          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
//          response( $.grep( data, function( item ){
//              return matcher.test( item.label );
//          }) );
//    },
//     minLength: 1,
//     select: function(event, ui) {
//         event.preventDefault();
//         $("#tags1").val(ui.item.label);
//         $("#selected-tag").val(ui.item.label);
//         // window.location.href = ui.item.value;
//     }
//     ,
//     focus: function(event, ui) {
//         event.preventDefault();
//         $("#tags1").val(ui.item.label);
//     }
// });
// });

// $(function() {
//     // alert('hi');
// $( "#searchplace1" ).autocomplete({
//      source: function( request, response ) {
//          var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
//          response( $.grep( data1, function( item ){
//              return matcher.test( item.label );
//          }) );
//    },
//     minLength: 1,
//     select: function(event, ui) {
//         event.preventDefault();
//         $("#searchplace1").val(ui.item.label);
//         $("#selected-tag").val(ui.item.label);
//         // window.location.href = ui.item.value;
//     }
//     ,
//     focus: function(event, ui) {
//         event.preventDefault();
//         $("#searchplace1").val(ui.item.label);
//     }
// });
// });

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
     //url: "<?php echo base_url() ?>artistic/ajaxpro",
      type: "POST",
      data: {"image":resp},
      success: function (data) {
        html = '<img src="' + resp + '" />';
        if(html)
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
//aarati code start
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

$('#upload').on('change', function () {   
  var fd = new FormData();
 fd.append( "image", $("#upload")[0].files[0]);
 files = this.files;
 size = files[0].size;
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
        url: base_url + "artistic/image",
        //url: "<?php echo base_url(); ?>artistic/image",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success:function(response){       
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

function followuser(clicked_id)
{ //alert(clicked_id); 
   $.ajax({
                type:'POST',
                url: base_url + "artistic/follow_two",
                //url:'<?php echo base_url() . "artistic/follow_two" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
               $('.' + 'fruser' + clicked_id).html(data);                    
                }
            }); 
}

function unfollowuser(clicked_id)
{  
   $.ajax({
                type:'POST',
                url: base_url + "artistic/unfollow_two",
                //url:'<?php echo base_url() . "artistic/unfollow_two" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
               $('.' + 'fruser' + clicked_id).html(data);                   
                }
            }); 
}

function followuser_two(clicked_id)
{ 
   $.ajax({
                type:'POST',
                url: base_url + "artistic/followtwo",
                //url:'<?php echo base_url() . "artistic/followtwo" ?>',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
               $('#' + 'frfollow' + clicked_id).html(data);                   
                }
            }); 
}

 function unfollowuser_two(clicked_id)
    {
        $.ajax({
            type: 'POST',
            url: base_url + "artistic/unfollowtwo",
            //url: '<?php echo base_url() . "artistic/unfollowtwo" ?>',
            data: 'follow_to=' + clicked_id,
            success: function (data) { 
                $('#' + 'frfollow' + clicked_id).html(data);  
              // $('#unfollowdiv').html('');
            }
        });
    }

function unfollowuser_list(clicked_id)
{ 
   $.ajax({
                type:'POST',
                url: base_url + "artistic/unfollow_following",
                //url:'<?php echo base_url() . "artistic/unfollow_following" ?>',
                dataType: 'json',
                 data:'follow_to='+clicked_id,
                success:function(data){ 
               $('.' + 'frusercount').html(data.unfollow);
               if(data.notcount == 0){
                 $('.' + 'contact-frnd-post').html(data.notfound);
               }else{ 
              $('#' + 'removefollow' + clicked_id).fadeOut(4000);
                 }   
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
    
    

function picpopup() {
            $('.biderror .mes').html("<div class='pop_content'>Only Image Type Supported");
            $('#bidmodal').modal('show');
}

$( document ).on( 'keydown', function ( e ) {
    if ( e.keyCode === 27 ) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});  

 $(document).ready(function(){    
   //  $(document).load().scrollTop(1000);       
       $('html,body').animate({scrollTop:265}, 100);  
   });