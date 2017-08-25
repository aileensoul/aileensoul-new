//PROFILE PIC VALIDATION START
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
        submitHandler: profile_pic
    });
});
//PROFILE PIC VALIDATION END
//CODE FOR DESIGNATION START
function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea />");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
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
        url: base_url + "freelancer/hire_designation",
        type: "POST",
        data: {"designation": html},
        success: function (response) {

        }
    });
}
$(document).ready(function () {
    $("a.designation").click(divClicked);
});
//CODE FOR DESIGNATION END

//CODE FOR UPLOAD PROFILE PIC START
function updateprofilepopup(id) {
    $('#bidmodal-2').modal('show');
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('preview').style.display = 'block';
            $('#preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profilepic").change(function () {
    // code for not supported file TYPE
    profile = this.files;
    if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        $('#profilepic').val('');
        picpopup();
        return false;
    } else {
        readURL(this);
    }
    // end supported code 
});
//CODE FOR UPLOAD PROFILE PIC END

//CODE FOR CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
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
//CODE FOR CHECK SEARCH KEYWORD AND LOCATION BLANK END

//CODE FOR COVER PIC START
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
            url: base_url + "freelancer/ajaxpro_hire",
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

// code start for file type support
    if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        picpopup();
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        $("#upload").val('');
        return false;
    }
    // file type code end
    if (size > 26214400)
    {
        //show an alert to the user
        alert("Allowed file size exceeded. (Max. 25 MB)")
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        //reset file upload control
        return false;
    }
    $.ajax({
        url: base_url + "freelancer/image_hire",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function (response) {
        }
    });
});

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
//CODE FOR COVER PIC END


//CODE FOR SHOW POPUP OF WHEN PROFILE PIC OR COVER PIC IMG TYPE NOT SUPPORED START
function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>Please select only Image File Type.(jpeg,jpg,png,gif)");
    $('#bidmodal').modal('show');
}
//CODE FOR SHOW POPUP OF WHEN PROFILE PIC AND COVER PIC IMG TYPE NOT DUPPORTED END

//ALL POPUP CLOSE USING ESC START
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        //$( "#bidmodal" ).hide();
        $('#bidmodal-2').modal('hide');
    }
});
//ALL POPUP CLOSE USING ESC END
//FOR SCROLL PAGE AT PERTICULAR POSITION IS START
$(document).ready(function () {
    $('html,body').animate({scrollTop: 265}, 100);
});
//FOR SCROLL PAGE AT PERTICUKAR POSITION IS END

//UOPLOAD PROFILE PIC START
function profile_pic(){
   if (typeof FormData !== 'undefined') {
   // var fd = new FormData();
    var formData = new FormData( $("#userimage")[0] );
//    fd.append("image", $("#profilepic")[0].files[0]);
//         files = this.files;
       $.ajax({
     // url: "<?php echo base_url(); ?>freelancer/user_image_insert",
      url:  base_url + "freelancer/user_image_insert",
      type: "POST",
      data: formData,
      contentType: false,
          cache: false,
      processData:false,
      success: function(data)
        {
      $('#bidmodal-2').modal('hide');
      $(".user-pic").html(data);
      document.getElementById('profilepic').value= null;
      //document.getElementById('profilepic').value == '';
      $('.popup_previred').hide();
        },          
     });
      return false;
}
}
//UOPLOAD PROFILE PIC END


