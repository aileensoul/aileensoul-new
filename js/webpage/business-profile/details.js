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

// END OF BUSINESS SEARCH AUTO FILL 

function updateprofilepopup(id) {
    $('#bidmodal-2').modal('show');
}

// COVER IMAGE START 
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
    // pallavi code start for file type support
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
// cover image end 

// follow user script start 
function followuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/follow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
        }
    });
}
// follow user script end 
// Unfollow user script start 
function unfollowuser_two(clicked_id)
{
    $.ajax({
        type: 'POST',
        url: base_url + "business_profile/unfollow_two",
        data: 'follow_to=' + clicked_id,
        success: function (data) {
            $('.' + 'fr' + clicked_id).html(data);
        }
    });
}
// Unfollow user script end 
// script for profile pic strat 
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
// script for profile pic end 
function openModal() {
    document.getElementById('myModal1').style.display = "block";
}
function closeModal() {
    document.getElementById('myModal1').style.display = "none";
}

var n = 1;
//showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    captionText.innerHTML = dots[slideIndex - 1].alt;
}



function picpopup() {
    $('.biderror .mes').html("<div class='pop_content'>This is not valid file. Please Uplode valid Image File.");
    $('#bidmodal').modal('show');
}

$(document).ready(function () {
    $("#myBtn").click(function () {
        $("#myModal").modal();
    });
});
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#bidmodal-2').modal('hide');
    }
});
// scroll page script start 
//For Scroll page at perticular position js Start
$(document).ready(function () {
    $('html,body').animate({scrollTop: 330}, 500);
});
//For Scroll page at perticular position js End
// scroll page script end 


// all popup close close using esc start 
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        closeModal();
    }
});
// all popup close close using esc end 

// all popup close close using esc start 
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $('#myModal').modal('hide');
    }
});
// all popup close close using esc end


 $(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                //$( "#bidmodal" ).hide();
                $('#query').modal('hide');
                //$('.modal-post').show();
                }
                });



                    
  function contact_person_query(clicked_id, status) { 

   
                        $.ajax({
                            type: 'POST',
                            //url: '<?php echo base_url() . "business_profile/contact_person_query" ?>',
                            url: base_url + "business_profile/contact_person_query",

                            data: 'toid=' + clicked_id + '&status=' + status,
                            success: function (data) { //alert(data);
                              // return data;
                               contact_person_model(clicked_id, status, data);
                            }
                        });
                    }

                    





                    function contact_person_model(clicked_id, status, data) {

                        if(data == 1){

                            if (status == 'pending') {

                            $('.biderror .mes').html("<div class='pop_content'> Do you want to cancel  contact request?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');

                        } else if (status == 'confirm') {

                            $('.biderror .mes').html("<div class='pop_content'> Do you want to remove this user from your contact list?<div class='model_ok_cancel'><a class='okbtn' id=" + clicked_id + " onClick='contact_person(" + clicked_id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
                            $('#bidmodal').modal('show');

                        }else{ 
                           contact_person(clicked_id); 
                        }

                }else{

                      $('#query .mes').html("<div class='pop_content'>Sorry, we can't process this request at this time.");
                      $('#query').modal('show');
                            
                }
                        
                       

                    }
  



                    function contact_person(clicked_id) {
                        
                        $.ajax({
                            type: 'POST',
                            //url: '<?php echo base_url() . "business_profile/contact_person" ?>',
                            url: base_url + "business_profile/contact_person",

                            data: 'toid=' + clicked_id,
                            success: function (data) {
                                //   alert(data);
                                $('#contact_per').html(data);

                            }
                        });
                    }



    
    