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

//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER START
$(document).ready(function () {
    job_apply();
 
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
                    
                    job_apply(pagenum);
                }
            }
        }
    });
    
});
var isProcessing = false;
function job_apply(pagenum)
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
        url: base_url + "job/ajax_apply_job?page=" + pagenum,
        data: {total_record:$("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            if (pagenum == 'undefined') {

                $(".job-contact-frnd").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
            } else {
                $('#loader').show();
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $('.loader').remove();
            $('.job-contact-frnd').append(data);
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

//new script for jobtitle,company and skill start
 $(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( "#tags" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url +"general/get_alldata", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $("#tags").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for jobtitle,company and skill End

//new script for jobtitle,company and skill start for mobile view Start
$(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( "#tags1" ).bind( "keydown", function( event ) {
           if ( event.keyCode === $.ui.keyCode.TAB &&
               $( this ).autocomplete( "instance" ).menu.active ) {
               event.preventDefault();
           }
       })
       .autocomplete({
           minLength: 2,
           source: function( request, response ) { 
               // delegate back to autocomplete, but extract the last term
               $.getJSON(base_url +"general/get_alldata", { term : extractLast( request.term )},response);
           },
           focus: function() {
               // prevent value inserted on focus
               return false;
           },
   
            select: function(event, ui) {
          event.preventDefault();
          $("#tags1").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for jobtitle,company and skill start for mobile view End

//new script for cities start
 $(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( "#searchplace" ).bind( "keydown", function( event ) {
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
          $("#searchplace").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for cities End

//new script for cities start mobile view Start
$(function() {
       function split( val ) {
           return val.split( /,\s*/ );
       }
       function extractLast( term ) {
           return split( term ).pop();
       }
       
       $( "#searchplace1" ).bind( "keydown", function( event ) {
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
          $("#searchplace1").val(ui.item.label);
          $("#selected-tag").val(ui.item.label);
      },
    
       });
   });
//new script for cities start mobile view End

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
//For Search VAlidation End

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
   
   if (!files[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
   savepopup();
   
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

 //Remove Post Start
function removepopup(id) {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to remove this job?<div class='model_ok_cancel'><a class='okbtn' id=" + id + " onClick='remove_post(" + id + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show').fadeIn("slow");
   }

    function remove_post(abc)
   {
       $.ajax({
           type: 'POST',
           url: base_url +'job/job_delete_apply',
           data: 'app_id=' + abc,
           success: function (data) {
               $('#' + 'removeapply' + abc).html(data);
               $('#' + 'removeapply' + abc).parent().removeClass();
               var numItems = $('.contact-frnd-post .job-contact-frnd').length;
               if (numItems == '0') {
          
                   var nodataHtml = "<div class='art-img-nn'><div class='art_no_post_img'><img src='" + base_url + "('img/job-no.png')''></div><div class='art_no_post_text'>No  Applied Post Available</div></div>";
                   $('.contact-frnd-post').html(nodataHtml);
               }
           }
       });
   
   }
 //Remove Post End

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
   
   $("#profilepic").change(function(){
    
      profile = this.files;
    if (!profile[0].name.match(/.(jpg|jpeg|png|gif)$/i)){
      $('#profilepic').val('');
       picpopup();
       return false;
        }else{
        readURL(this);}
   
   });

    function picpopup() {
       
   
   $('.biderror .mes').html("<div class='pop_content'>Image Type is not Supported");
   $('#bidmodal').modal('show');
   }
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
           url: base_url + "job/ajax_designation",
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
 $( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       $('#bidmodal').modal('hide').fadeOut("slow");
   }
   });  
   
   
    $( document ).on( 'keydown', function ( e ) {
   if ( e.keyCode === 27 ) {
       $('#bidmodal-2').modal('hide').fadeOut("slow");
   }
   });  
   
 //all popup close close using esc End

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