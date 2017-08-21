//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER START
$(document).ready(function () {
 
    freelancerwork_applied();

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
                    
                    freelancerwork_applied(pagenum);
                }
            }
        }
    });
    
});
var isProcessing = false;
function freelancerwork_applied(pagenum)
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
        url: base_url + "freelancer/ajax_freelancer_applied_post?page=" + pagenum,
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

//CODE FOR AUTOFILL OF SEARCH KEYWORD START

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
//CODE FOR AUTOFILL OF SEARCH KEYWORD END  
//CODE FOR AUTOFILL OF SEARCH LOCATION START

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
//CODE FOR AUTOFILL OF SEARCH LOCATION END         
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
//UPLOAD PROFILE PIC CODE START
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
            $("#profilepic").change(function(){
            profile = this.files;
            if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
            $('#profilepic').val('');
            picpopup();
            return false;
            } else{
            readURL(this); }
            });
//UPLOAD PROFILE PIC CODE END
//VALIDATION FOR PROFILE PIC START
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
            
             function picpopup() {
            $('.biderror .mes').html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)");
            $('#bidmodal').modal('show');
            }
//VALIDATION FOR PROFILE PIC END
//REMOVE POST START
 function remove_post(abc)
            {
            $.ajax({
            type:'POST',
                    url: base_url + "freelancer/freelancer_delete_apply",
                    data:'app_id=' + abc,
                    success:function(data){
                    $('#' + 'removeapply' + abc).html(data).removeClass();
                    $('#' + 'removeapply' + abc).parent();
                    var numItems = $('.contact-frnd-post .job-contact-frnd').length;
                    if (numItems == '0') {
                    var nodataHtml = "<div class='text-center rio'><h4 class='page-heading  product-listing' style='border:0px;margin-bottom: 11px;'>No Saved Freelancer Found.</h4></div>";
                    $('.contact-frnd-post').html(nodataHtml);
                    }
                    }
            });
            }
 function removepopup(id) {
            $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this post?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
            $('#bidmodal').modal('show');
            }
      
//REMOVE POST END
//COVER IMAGE CODE START
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
            url:  base_url + "freelancer/ajaxpro_work",
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

            if (size > 26214400)
            {
            alert("Allowed file size exceeded. (Max. 25 MB)")
                    document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            //reset file upload control
            return false;
            }
            $.ajax({
            url:  base_url + "freelancer/image_work",
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
//COVER IMAGE CODE END
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
