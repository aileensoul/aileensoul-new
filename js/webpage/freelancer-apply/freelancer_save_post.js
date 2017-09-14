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
    document.getElementById('upload-demo-one').style.display = 'block';
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
                 beforeSend: function () {
                    // $('.loader').show();
                    document.getElementById('loader').style.display = 'block';
                },
                complete: function () {
                    $document.getElementById('loader').style.display = 'none';
                },
                success: function (data) {
                    $('#loader').remove();
                    $('#bidmodal-2').modal('hide');
                    $(".user-pic").html(data);
                    document.getElementById('upload-one').value = null;
                    document.getElementById('upload-one').value = null;
                    document.getElementById('upload-demo-one').style.display = 'none';
                    $('.cr-image').attr('src', '#');
//                    html = '<img src="' + resp + '" />';
//                    $("#upload-demo-i").html(html);
                }
            });
        });
//    });
    }
});
//CODE FOR PROFILE PIC UPLOAD WITH CROP END

//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER START
$(document).ready(function () {

    freelancerwork_save();

    $(window).scroll(function () {
        //if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      //  if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
             if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7){
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

                    freelancerwork_save(pagenum);
                }
            }
        }
    });

});
var isProcessing = false;
function freelancerwork_save(pagenum)
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
        url: base_url + "freelancer/ajax_freelancer_save_post?page=" + pagenum,
        data: {total_record: $("#total_record").val()},
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

//DESIGNATION START
function divClicked() {
    var divHtml = $(this).html();
    var editableText = $("<textarea/>");
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
//UPLOAD PROFILE PIC CODE START
function updateprofilepopup(id) {
    document.getElementById('upload-one').value = null;
    document.getElementById('upload-demo-one').style.display = 'none';
    $('#bidmodal-2').modal('show');
}
//UPLOAD PROFILE PIC CODE END
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
//$('.upload-result').on('click', function (ev) {
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
    $(".cr-image").attr("src", "");
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

        url: base_url() + "freelancer/image_work",
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
//REMOVE SAVE POST START
function remove_post(abc)
{
    var savepara = 'save';
    $.ajax({
        type: 'POST',
        url: base_url + "freelancer/freelancer_delete_apply",
        data: 'app_id=' + abc + '&para=' + savepara,
        success: function (data) {
            $('#' + 'postdata' + abc).html(data);
            $('#' + 'postdata' + abc).parent().removeClass();
            var numItems = $('.contact-frnd-post .job-contact-frnd').length;
            if (numItems == '0') {
                var nodataHtml = '<div class="art-img-nn"><div class="art_no_post_img"><img src="../img/free-no1.png"></div><div class="art_no_post_text"> no_saved </div></div>';
                $('.contact-frnd-post').html(nodataHtml);
            }
        }
    });
}
function removepopup(id) {
    $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
    $('#bidmodal').modal('show');
}
//REMOVE SAVE POST END


//CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return  false;
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


function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)");
    $('#bidmodal').modal('show');
}

//ALL POPUP CLOSE USING ESC START
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
//ALL POPUP CLOSE USING ESC END
//FOR SCROLL PAGE AT PERTICULAR POSITION JS START
$(document).ready(function () {
    $('html,body').animate({scrollTop: 265}, 100);
});
//FOR SCROLL PAGE AT PERTICULAR POSITION JS END