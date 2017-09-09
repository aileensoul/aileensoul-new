//Cover Image Start
 function myFunction() {
        document.getElementById("upload-demo").style.visibility = "hidden";
        document.getElementById("upload-demo-i").style.visibility = "hidden";
        document.getElementById('message1').style.display = "block";
    }

    function showDiv() {
        document.getElementById('row1').style.display = "block";
        document.getElementById('row2').style.display = "none";
        $(".cr-image").attr("src","");
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
                url: base_url +"job/ajaxpro",
                type: "POST",
                data: {"image": resp},
                success: function (data) {
                   if (data) 
                   {
                    $("#row2").html(data);
                    document.getElementById('row2').style.display = "block";
                    document.getElementById('row1').style.display = "none";
                    document.getElementById('message1').style.display = "none";
                    document.getElementById("upload-demo").style.visibility = "visible";
                    document.getElementById("upload-demo-i").style.visibility = "visible";
                  }
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

        // pallavi code start for file type support
        if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            //alert('not an image');
            picpopup();

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            return false;
        }
        // file type code end
        function picpopup() {
        $('.biderror .mes').html("<div class='pop_content'>Image type is not supported");
        $('#bidmodal').modal('show');
    }

        if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
            picpopup();

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";
            return false;
        }

        if (size > 4194304)
        {
            //show an alert to the user
            alert("Allowed file size exceeded. (Max. 4 MB)")

            document.getElementById('row1').style.display = "none";
            document.getElementById('row2').style.display = "block";

            return false;
        }

        $.ajax({
            url: base_url +"job/image",
            type: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
            }
        });
    });
//aarati code end
//Cover Image End


//Update Profile Pic Start
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

function profile_pic() {
    if (typeof FormData !== 'undefined') {
        
        var formData = new FormData($("#userimage")[0]);
        $.ajax({
          
            url: base_url + "job/user_image_insert",
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
                $('#preview').prop('src', '#');
                 $('#preview').hide();
                $('.popup_previred').hide();
            },
        });
        return false;
    }
}
//UPLOAD PROFILE PIC END


//Designation Update Start
function divClicked() {
        var divHtml = $(this).html();
        var editableText = $("<textarea />");
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
            url: base_url +"job/ajax_designation",
            type: "POST",
            data: {"designation": html},
            success: function (response) {
            }
        });
    }

    $(document).ready(function () {
        $("a.designation").click(divClicked);
    });
//Designation Update End

//For Scroll page at perticular position js Start
    $(document).ready(function(){
     
     $('html,body').animate({scrollTop:265}, 100);
     $('.complete_profile').fadeIn('fast').delay(5000).fadeOut('slow');
     $('.temp').fadeIn('fast').delay(5000).fadeOut('slow');
     $('.edit_profile_job').fadeIn('slow').delay(5000);
     $('.tr_text').fadeIn('slow').delay(500);
     $('.true_progtree img').fadeIn('slow').delay(500);
     $('.progress .progress-bar').css("width",
           function() {
               return $(this).attr("aria-valuenow") + "%";
           }
       )
   // Disable progress bar when 100% complete End  
   });
//For Scroll page at perticular position js End