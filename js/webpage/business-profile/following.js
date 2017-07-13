// BUSUINESS SEARCH SCRIPT START
$(function () {
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

$(function () {
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

function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return false;
    }
}
// BUSUINESS SEARCH SCRIPT END

// COVER PAGE START

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
            url: base_url + "business_profile/ajaxpro",
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

//aarati code start
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
    // file type code end
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
        url: base_url + "business_profile/imagedata",
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        success: function (response) {
        }
    });
});

// COVER PAGE END
// follow user script start 
function followuser(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/follow",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
        }
    });
}
//follow user script end 
// Unfollow user script start 
function unfollowuser(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/unfollow",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
        }
    });
}
// Unfollow user script end 
// follow user script start 
function followuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/follow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'follow_btn_' + clicked_id).html(data);
            $('.' + 'follow_btn_' + clicked_id).removeClass('user_btn');
            $('.' + 'follow_btn_' + clicked_id).addClass('user_btn_h');
            $('#' + 'unfollow' + clicked_id).html('');
        }
    });
}
// follow like script end 
// Unfollow user script start 
function unfollowuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/unfollow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'follow_btn_' + clicked_id).html(data);
            $('.' + 'follow_btn_' + clicked_id).removeClass('user_btn_h');
            $('.' + 'follow_btn_' + clicked_id).removeClass('user_btn_f');
            $('.' + 'follow_btn_' + clicked_id).addClass('user_btn_i');
        }
    });
}
// follow like script end 
// Unfollow own userlist user script start 
function unfollowuser_list(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/unfollow_following",
        dataType: 'json',
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'frusercount').html(data.unfollow);
            if (data.notcount == 0) {
                $('.' + 'contact-frnd-post').html(data.notfound);
            } else {
                $('#' + 'removefollow' + clicked_id).fadeOut(4000);
            }
        }
    });
}
// follow like script end 
function updateprofilepopup(id) {
    $('#bidmodal-2').modal('show');
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

$("#profilepic").change(function () {
    profile = this.files;
    if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        $('#profilepic').val('');
        picpopup();
        return false;
    } else {
        readURL(this);
    }
});

// PROFILE PIC VALIDATION START
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
// PROFILE PIC VALIDATION END

function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
    $('#bidmodal').modal('show');
}
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#bidmodal-2').modal('hide');
    }
});
$(document).ready(function () {
    $('html,body').animate({scrollTop: 330}, 500);
});
//contact person script start 
function contact_person(clicked_id) {
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/contact_person",
        data: 'toid=' + clicked_id,
        success: function (data) {
            $('#contact_per').html(data);
        }
    });
}
//contact person script end

function contact_person_model(clicked_id, status) {
    if (status == 'pending') {
        $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    } else if (status == 'confirm') {
        $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
        $('#bidmodal').modal('show');
    }
}