
//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER START
$(document).ready(function () {
    
    freelancerhire_project(user_id,returnpage);

    $(window).scroll(function () {
        //if ($(window).scrollTop() == $(document).height() - $(window).height()) {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            var page = $(".page_number:last").val();
            var total_record = $(".total_record").val();
            var perpage_record = $(".perpage_record").val();
            if (parseInt(perpage_record) <= parseInt(total_record)) {
                var available_page = total_record / perpage_record;
                available_page = parseInt(available_page, 10);
                var mod_page = total_record % perpage_record;
                if (mod_page > 0) {
                    available_page = available_page + 1;
                }
                //if ($(".page_number:last").val() <= $(".total_record").val()) {
                if (parseInt(page) <= parseInt(available_page)) {
                    var pagenum = parseInt($(".page_number:last").val()) + 1;
                    
                    freelancerhire_project(user_id,returnpage,pagenum);
                }
            }
        }
    });
    
});
var isProcessing = false;
function freelancerhire_project(user_id,returnpage,pagenum)
{
   
    if (isProcessing) {
        /*
         *This won't go past this condition while
         *isProcessing is true.
         *You could even display a message.
         **/
        return;
    }
    isProcessing = true;
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/ajax_freelancer_hire_post/" + user_id + '/' + returnpage +'?page=' + pagenum,
        data: {total_record:$("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            if (pagenum == 'undefined') {
                $(".contact-frnd-post").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
            } else {
                $('#loader').show();
            }
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
            isProcessing = false;
        }
    });
}

//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER END

//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD START

$(function () {
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
            $("#tags1").val(ui.item.label);
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
//SCRIPT FOR AUTOFILL OF SEARCH KEYWORD END
//SCRIPT FOR AUTOFILL OF SEARCH LOACATION START            

$(function () {
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
//  SCRIPT FOR AUTOFILL OF SEARCH LOCATION END
//  //CODE FOR DESIGNATION START
function divClicked() {
    // alert(456);
    var divHtml = $(this).html();
    var editableText = $("<textarea />");
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();
    editableText.blur(editableTextBlurred);
}

function editableTextBlurred() {
    //alert(789);
    var html = $(this).val();
    var viewableText = $("<a>");
    if (html.match(/^\s*$/) || html == '') {
        html = "Current Work";
    }
    viewableText.html(html);
    $(this).replaceWith(viewableText);
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
    // alert(123);
    $("a.designation").click(divClicked);
});
//CODE FOR DESIGNATION END

//FUNCTION FOR CHECK VALUE OF SEARCH KEYWORD AND LOCATION BLANK STRAT
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
//FUNCTION FOR CHECK VALUE OF SEARCH KEYWORD AND LOCATION BLANK END

//FUNCTION FOR PROFILE PIC START
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

//FUNCTION FOR PROFILE PIC END
//FUNCTION FOR COVER IMG START
function myFunction() {
    document.getElementById("upload-demo").style.visibility = "hidden";
    document.getElementById("upload-demo-i").style.visibility = "hidden";
    document.getElementById('message1').style.display = "block";
}
function showDiv() {
    document.getElementById('row1').style.display = "block";
    document.getElementById('row2').style.display = "none";
}
//FUNCTION FOR COVER IMG END
//CODE FOR COVER IMG START
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
    };
    reader.readAsDataURL(this.files[0]);
});

$('#upload').on('change', function () {
    var fd = new FormData();
    fd.append("image", $("#upload")[0].files[0]);
    files = this.files;
    size = files[0].size;
    //  code start for file type support
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
        alert("Allowed file size exceeded. (Max. 25 MB)");
        document.getElementById('row1').style.display = "none";
        document.getElementById('row2').style.display = "block";
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
};
// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
};
// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};

//CODE FOR COVER IMAGE END
//CODE FOR SAVE POST START
function savepopup(id) {
    save_post(id);
    $('.biderror .mes').html("<div class='pop_content'>Your post is successfully saved.");
    $('#bidmodal').modal('show');
}
function save_post(abc)
{
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/save_user",
        data: 'post_id=' + abc,
        success: function (data) {
            $('.' + 'savedpost' + abc).html(data).addClass('saved');
        }
    });
}
//CODE FOR SAVE POST END
//CODE FOR REMOVE POST START
function removepopup(id) {
    $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');
}
function remove_post(abc)
{
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/remove_post",
        data: 'post_id=' + abc,
        success: function (data) {
            $('#' + 'removeapply' + abc).html(data);
            $('#' + 'removeapply' + abc).parent().removeClass();
            var numItems = $('.contact-frnd-post .job-contact-frnd').length;
            if (numItems === '0') {
                var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Post Found.</h4></div>";
                $('.contact-frnd-post').html(nodataHtml);
            }
        }
    });

}
//CODE FOR REMOVE POST END
//CODE FOR APPLY POST START
function applypopup(postid, userid) {
    $('.biderror .mes').html("<div class='pop_content'>Are you sure you want to apply this post?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');
}
function apply_post(abc, xyz) {
    var alldata = 'all';
    var user = xyz;
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/apply_insert",
        data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
        success: function (data) {
            $('.savedpost' + abc).hide();
            $('.applypost' + abc).html(data);
            $('.applypost' + abc).attr('disabled', 'disabled');
            $('.applypost' + abc).attr('onclick', 'myFunction()');
            $('.applypost' + abc).addClass('applied');
        }
    });
}
//CODE FOR APPLY POST END
//CODE FOR PROFILE PIC AND COVER PIC VALIDATION START
function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)");
    $('#bidmodal').modal('show');
}
//CODE FOR PROFILE PIC AND COVER PIC VALIDATION END
//CODE FOR ALL POPUP CLOSE USING ESC START
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#bidmodal').modal('hide');
    }
});
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#bidmodal-2').modal('hide');
    }
});

//CODE FOR ALL POPUP CLOSE USING ESC END
//CODE FOR SCROLL PAGE AT PERTICULAR START
$(document).ready(function () {
    $('html,body').animate({scrollTop: 265}, 100);
});

//CODE FOR SCROLL PAGE AT PERTICULAR END
// VALIDATION FOR PROFILE PIC START

$(document).ready(function () {

    $("#userimage").validate({

        rules: {

            profilepic: {

                required: true

            }

        },

        messages: {

            profilepic: {

                required: "Photo Required"

            }

        }

    });
});
// VALIDATION FOR PROFILE PIC END