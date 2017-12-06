
//Validation Start
 $(document).ready(function () {
   
       $("#jobdesignation").validate({
   
           rules: {
   
               designation: {
   
                   required: true,
   
               },
   
           },
   
           messages: {
   
               designation: {
   
                   required: "Designation is required.",
   
               },
   
           },
   
       });
   });
//Validation End

//CODE FOR RESPONES OF AJAX COME FROM CONTROLLER AND LAZY LOADER START
$(document).ready(function () {
    job_home();

    $(window).scroll(function () {
        if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.7) {
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
                if (parseInt(page) <= parseInt(available_page)) {
                    var pagenum = parseInt($(".page_number:last").val()) + 1;
                    
                    job_home(pagenum);
                }
            }
        }
    });
    
});
var isProcessing = false;
function job_home(pagenum)
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
        url: base_url + "job/ajax_recommen_job?page=" + pagenum,
        data: {total_record:$("#total_record").val()},
        dataType: "html",
        beforeSend: function () {
            if (pagenum == 'undefined') {
                $(".job-contact-frnd1 ").prepend('<p style="text-align:center;"><img class="loader" src="' + base_url + 'images/loading.gif"/></p>');
            } else {
                $('#loader').show();
            }
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $('.loader').remove();
            $('.job-contact-frnd1 ').append(data);
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

//Tooltip start
 $(document).ready(function () {
       $('[data-toggle="tooltip"]').tooltip();
   
   });
//Tooltip End

//save post start 
  function savepopup(id) {
       save_post(id);
       $('.biderror .mes').html("<div class='pop_content'>Job successfully saved.");
       $('#bidmodal').modal('show');
   }

  function save_post(abc)
   {
       $.ajax({
           type: 'POST',
           url: base_url +'job/job_save',
           data: 'post_id=' + abc,
           success: function (data) {
               $('.' + 'savedpost' + abc).html(data).addClass('saved');
           }
       });
   
   }
//save post End

//apply post start
 function applypopup(postid, userid) 
 {
       $('.biderror .mes').html("<div class='pop_content'>Do you want to apply this job?<div class='model_ok_cancel'><a class='okbtn' id=" + postid + " onClick='apply_post(" + postid + "," + userid + ")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>");
       $('#bidmodal').modal('show');
  }

 function apply_post(abc, xyz) {
       var alldata = 'all';
       var user = xyz;
   
       $.ajax({
           type: 'POST',
           url: base_url +'job/job_apply_post',
           data: 'post_id=' + abc + '&allpost=' + alldata + '&userid=' + user,
           dataType: 'json',
           success: function (data) {
            
               $('.savedpost' + abc).hide();
               $('.applypost' + abc).html(data.status);
               $('.applypost' + abc).attr('disabled', 'disabled');
               $('.applypost' + abc).attr('onclick', 'myFunction()');
               $('.applypost' + abc).addClass('applied');
               if (data.notification.notification_count != 0) {
                                                var notification_count = data.notification.notification_count;
                                                var to_id = data.notification.to_id;
                                                show_header_notification(notification_count, to_id);
                                            }
           }
       });
   }
//apply post end



