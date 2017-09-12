//CODE FOR PROFILE PIC UPLOAD WITH CROP START
     $uploadCrop1 = $('#upload-demo-one').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload-one').on('change', function () {
        alert(123);
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop1.croppie('bind', {
                url: e.target.result
            }).then(function () {
                console.log('jQuery bind complete');
            });

        }
        reader.readAsDataURL(this.files[0]);
    });
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
    function profile_pic() {
//    $('.upload-result-one').on('click', function (ev) {
        $uploadCrop1.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            $.ajax({
                //url: "/ajaxpro.php", user_image_insert
               // url: "<?php echo base_url(); ?>freelancer/ajaxpro_test",
               url: base_url + "freelancer/user_image_add1",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                  $('#bidmodal-2').modal('hide');
                    $(".user-pic").html(data);
                    document.getElementById('upload-one').value = null;
                    document.getElementById('upload-demo-one').value = '';
//                    html = '<img src="' + resp + '" />';
//                    $("#upload-demo-i").html(html);
                }
            });
        });
//    });
}
   });
   //CODE FOR PROFILE PIC UPLOAD WITH CROP END

function profile_pic() {
    if (typeof FormData !== 'undefined') {
        // var fd = new FormData();
        var formData = new FormData($("#userimage")[0]);
//    fd.append("image", $("#profilepic")[0].files[0]);
//         files = this.files;
        $.ajax({
            // url: "<?php echo base_url(); ?>freelancer/user_image_insert",
            url: base_url + "freelancer/user_image_add",
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                $('#bidmodal-2').modal('hide');
                $(".user-pic").html(data);
                document.getElementById('profilepic').value = null;
                //document.getElementById('profilepic').value == '';
                $('#preview').prop('src', '#');
                $('.popup_previred').hide();
            },
        });
        return false;
    }
}
//UOPLOAD PROFILE PIC END
//DESIGNATION START
function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea/>");
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
        url: base_url + "freelancer/designation",
        type: "POST",
        data: {"designation": html},
        success: function (response) {

        }
    });
}

$(document).ready(function () {
    $("a.designation").click(divClicked);
});
//DESIGNATION END
//UPLOAD PROFILE PIC START
function updateprofilepopup(id) {
    $('#bidmodal-2').modal('show');
}
//UPLOAD PROFILE PIC END

//COVER IMAGE CODE START

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
$('.upload-result').off('click').on('click', function (ev) {
   
    document.getElementById("upload-demo").style.visibility = "hidden";
    document.getElementById("upload-demo-i").style.visibility = "hidden";
    document.getElementById('message1').style.display = "block";
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {

        $.ajax({
            url: base_url + "freelancer/ajaxpro_work",
            type: "POST",
            data: {"image": resp},
            success: function (data) {
                $("#row2").html(data);
                document.getElementById('row2').style.display = "block";
                document.getElementById('row1').style.display = "none";
                document.getElementById('message1').style.display = "none";
                document.getElementById("upload-demo").style.visibility = "visible";
                document.getElementById("upload-demo-i").style.visibility = "visible";
            }
        });

    });
});

$('.cancel-result').on('click', function (ev) {
    document.getElementById('row2').style.display = "block";
    document.getElementById('row1').style.display = "none";
    document.getElementById('message1').style.display = "none";
    $(".cr-image").attr("src","");
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

    if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        picpopup();
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        $("#upload").val('');
        return false;
    }
    if (size > 26214400)
    {
        alert("Allowed file size exceeded. (Max. 25 MB)")
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
        return false;
    }
    $.ajax({
        url: base_url + "freelancer/image_work",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function (response) {
        }
    });
});
// Get the modal
//var modal = document.getElementById('myModal');
//// Get the button that opens the modal
//var btn = document.getElementById("myBtn");
//// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];
//// When the user clicks the button, open the modal 
//btn.onclick = function () {
//    modal.style.display = "block";
//}
//// When the user clicks on <span> (x), close the modal
//span.onclick = function () {
//    modal.style.display = "none";
//}
//// When the user clicks anywhere outside of the modal, close it
//window.onclick = function (event) {
//    if (event.target == modal) {
//        modal.style.display = "none";
//    }
//}
//COVER IMAGE CODE END
//CHECK SEARCH KEYWORD AND LOCATION BLANK START
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
//CHECK SEARCH KEYWORD AND LOCATION BLANK END
//SAVE USER START
function savepopup(id) {
    save_user(id);
    $('.biderror .mes').html("<div class='pop_content'>Freelancer is successfully saved.");
    $('#bidmodal').modal('show');
}
function save_user(abc)
{
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/save_user1",
        data: 'user_id=' + abc,
        success: function (data) {
            $('.' + 'saveduser' + abc).html(data).addClass('butt_rec');
        }
    });

}
//SAVE USER END

function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)");
    $('#bidmodal').modal('show');
}

//ALL POPUP CLOSE USING ESC START
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#bidmodal-2').modal('hide');
    }
});
//ALL POPUP CLOSE USING ESC END
//FOR SCROLL PAGE AT PERTICULAR POSITION JS START
$(document).ready(function () {
    $('html,body').animate({scrollTop: 265}, 100);
});
//FOR SCROLL PAGE AT PERTICULAR POSITION JS END


