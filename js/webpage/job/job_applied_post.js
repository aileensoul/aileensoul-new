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
    submitHandler: profile_pic
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
               $('#' + 'removeapply' + abc).removeClass();
               var numItems = $('.contact-frnd-post .job-contact-frnd .profile-job-post-detail').length;
               if (numItems == '0') {
          
                   var nodataHtml = "<div class='art-img-nn'><div class='art_no_post_img'><img src='"+ base_url + "img/job-no.png'/></div><div class='art_no_post_text'>No  Applied Post Available</div></div>";
                   $('.contact-frnd-post').html(nodataHtml);
               }
           }
       });
   
   }
 //Remove Post End

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
