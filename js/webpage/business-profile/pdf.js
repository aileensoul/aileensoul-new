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


// UPLOAD COVER PIC START 
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
    
    document.getElementById("upload-demo").style.visibility = "hidden";
    document.getElementById("upload-demo-i").style.visibility = "hidden";
    document.getElementById('message1').style.display = "block";
    
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            url: base_url + "business_profile/ajaxpro",
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
// UPLOAD COVER PIC end

/* FOLLOW USER START */
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
/* FOLLOW USER END */

/* UNFOLLOW USER START */
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
/* UNFOLLOW USER END */

// contact person script start 
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

$(document).on('keydown', function (e) {
                if (e.keyCode === 27) {
                //$( "#bidmodal" ).hide();
                $('#query').modal('hide');
                //$('.modal-post').show();
                }
                });


//For blocks or images of size, you can use $(document).ready
$(document).ready(function () {
    $('.blocks').jMosaic({items_type: "li", margin: 0});
    $('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
});

//If this image without attribute WIDTH or HEIGH, you can use $(window).load
$(window).load(function () {
    //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
});

//You can update on $(window).resize
$(window).resize(function () {
    //$('.pictures').jMosaic({min_row_height: 150, margin: 3, is_first_big: true});
    //$('.blocks').jMosaic({items_type: "li", margin: 0});
});

//For Scroll page at perticular position js Start
$(document).ready(function () {
    //  $(document).load().scrollTop(1000);
    $('html,body').animate({
        scrollTop: 330}, 500);
});
