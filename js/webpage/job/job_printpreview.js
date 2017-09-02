//validation start
$(document).ready(function () {

        $("#jobdesignation").validate({

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
//validation End

//new script for jobtitle,company and skill start
 $(function() {
 	
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( ".tags" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url +"job/get_alldata", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $(".tags").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for jobtitle,company and skill End

//new script for cities start
 $(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( ".searchplace" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url +"general/get_location", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $(".searchplace").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for cities End

//For Search Validation Start
 function check() {
       var keyword = $.trim(document.getElementById('tags1').value);
       var place = $.trim(document.getElementById('searchplace1').value);
       if (keyword == "" && place == "") {
           return false;
       }
   }

    function checkvalue() {
     
       var searchkeyword = $.trim(document.getElementById('tags').value);
       var searchplace = $.trim(document.getElementById('searchplace').value);
   
       if (searchkeyword == "" && searchplace == "") {
           return false;
       }
   }
//For Search Validation End

//Save Post Start
function savepopup(id) {
        save_user(id);
        $('.biderror .mes').html("<div class='pop_content'>Candidate successfully saved.");
        $('#bidmodal').modal('show');
    }

function save_user(abc)
    {
        $.ajax({
            type: 'POST',
            url: base_url +'recruiter/save_search_user',
            data: 'user_id=' + abc,
            success: function (data) {
                $('.' + 'saveduser' + abc).html(data).addClass('butt_rec');
            }
        });
    }
//Save Post End

//Cover Image Start
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
                url: base_url +"job/ajaxpro",
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
        $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
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
//Update Profile Pic End

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

//all popup close close using esc start
 $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            $('#bidmodal-2').modal('hide');
        }
    });
//all popup close close using esc End

//Tabing In Education And Graduation Start
 function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
//Tabing In Education And Graduation End

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

  //Disable progress bar when 100% complete Start
  $(document).ready(function(){ 
   
   var nb = $('div.profile-job-post-title').length;
    if(nb == 0){
   $("#dropdownclass").addClass("no-post-h2");
   
    }
   });
   
   $(document).ready(function () {
   $('.complete_profile').fadeIn('fast').delay(5000).fadeOut('slow');
   $('.edit_profile_job').fadeIn('slow').delay(5000);
   $('.tr_text').fadeIn('slow').delay(500);
   $('.true_progtree img').fadeIn('slow').delay(500);
     });
//Disable progress bar when 100% complete End

//Progress bar see start
 (function($) {9
   $('.second.circle-1').circleProgress({
   value: count_profile_value
   }).on('circle-animation-progress', function(event, progress) {
   $(this).find('strong').html(Math.round(count_profile * progress) + '<i>%</i>');
   });
   
   })(jQuery);
   //Progress bar see End

   $(".alert").delay(3200).fadeOut(300);