function notificatin_ajax_data(a){isProcessing||(isProcessing=!0,$.ajax({type:"POST",url:base_url+"notification/ajax_notification_data?page="+a,data:{total_record:$("#total_record").val()},dataType:"html",beforeSend:function(){"undefined"==a?$(".notification_data").prepend('<p style="text-align:center;"><img class="loader" src="'+base_url+'assets/images/loading.gif"/></p>'):$("#loader").show()},complete:function(){$("#loader").hide()},success:function(a){$(".loader").remove(),$(".notification_data").append(a);var e=$(".post-design-box").length;0==e?$("#dropdownclass").addClass("no-post-h2"):$("#dropdownclass").removeClass("no-post-h2"),isProcessing=!1}}))}$(document).ready(function(){notificatin_ajax_data(),$(window).scroll(function(){if($(window).scrollTop()+$(window).height()>=$(document).height()){var a=$(".page_number:last").val(),e=$(".total_record").val(),t=$(".perpage_record").val();if(parseInt(t)<=parseInt(e)){var n=e/t;n=parseInt(n,10);var o=e%t;if(o>0&&(n+=1),parseInt(a)<=parseInt(n)){var i=parseInt($(".page_number:last").val())+1;notificatin_ajax_data(i)}}}})});var isProcessing=!1;