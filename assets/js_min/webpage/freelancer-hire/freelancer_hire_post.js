function freelancerhire_project(e,a){isProcessing||(isProcessing=!0,$.ajax({type:"POST",url:base_url+"freelancer/ajax_freelancer_hire_post/"+e+"?page="+a,data:{total_record:$("#total_record").val()},dataType:"html",beforeSend:function(){document.getElementById("loader").style.display="block"},complete:function(){document.getElementById("loader").style.display="none"},success:function(e){$(".job-contact-frnd1").append(e);var a=$(".job-contact-frnd1 .all-job-box").length;0==a&&$(".job-contact-frnd1").addClass("cust-border");var t=$(".post-design-box").length;0==t?$("#dropdownclass").addClass("no-post-h2"):$("#dropdownclass").removeClass("no-post-h2"),isProcessing=!1}}))}function divClicked(){var e=$(this).html(),a=$("<textarea />");a.val(e),$(this).replaceWith(a),a.focus(),a.blur(editableTextBlurred)}function capitalize(e){return e[0].toUpperCase()+e.slice(1)}function editableTextBlurred(){var e=$(this).val(),a=$("<a>");(e.match(/^\s*$/)||""==e)&&(e="Current Work"),a.html(capitalize(e)),$(this).replaceWith(a),a.click(divClicked),$.ajax({url:base_url+"freelancer/hire_designation",type:"POST",data:{designation:e},success:function(e){}})}function checkvalue(){var e=$.trim(document.getElementById("tags").value),a=$.trim(document.getElementById("searchplace").value);return""==e&&""==a?!1:void 0}function check(){var e=$.trim(document.getElementById("tags1").value),a=$.trim(document.getElementById("searchplace1").value);return""==e&&""==a?!1:void 0}function savepopup(e){save_post(e),$(".biderror .mes").html("<div class='pop_content'>Your project is successfully saved."),$("#bidmodal").modal("show")}function save_post(e){$.ajax({type:"POST",url:base_url+"freelancer/save_user",data:"post_id="+e,success:function(a){$(".savedpost"+e).html(a).addClass("saved")}})}function remove_post(e){$.ajax({type:"POST",url:base_url+"freelancer/remove_post",data:"post_id="+e,success:function(){$("#removeapply"+e).remove();var a=$(".job-contact-frnd1 .all-job-box").length;if("0"==a){var t='<div class="art-img-nn"><div class="art_no_post_img"><img src="../assets/img/free-no1.png"></div><div class="art_no_post_text">No Project Found</div></div>';$(".job-contact-frnd1").html(t),$(".job-contact-frnd1").addClass("cust-border")}}})}function removepopup(e){$(".biderror .mes").html("<div class='pop_content'>Do you want to remove this project?<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='remove_post("+e+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function applypopup(e,a){$(".biderror .mes").html("<div class='pop_content'>Are you sure you want to apply this project?<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='apply_post("+e+","+a+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function apply_post(e,a){var t="all",o=a;$.ajax({type:"POST",url:base_url+"freelancer/apply_insert",data:"post_id="+e+"&allpost="+t+"&userid="+o,datatype:"json",success:function(a){if($(".savedpost"+e).hide(),$(".applypost"+e).html(a.status),$(".applypost"+e).attr("disabled","disabled"),$(".applypost"+e).attr("onclick","myFunction()"),$(".applypost"+e).addClass("applied"),0!=a.notification.notification_count){var t=a.notification.notification_count,o=a.notification.to_id;show_header_notification(t,o)}}})}function picpopup(){$(".biderror .mes").html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)"),$("#bidmodal").modal("show")}$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal").modal("hide")}),$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal-2").modal("hide")}),$(document).ready(function(){freelancerhire_project(user_id),$(window).scroll(function(){if($(window).scrollTop()>=.7*($(document).height()-$(window).height())){var e=$(".page_number:last").val(),a=$(".total_record").val(),t=$(".perpage_record").val();if(parseInt(t)<=parseInt(a)){var o=a/t;o=parseInt(o,10);var s=a%t;if(s>0&&(o+=1),parseInt(e)<=parseInt(o)){var n=parseInt($(".page_number:last").val())+1;freelancerhire_project(user_id,n)}}}})});var isProcessing=!1;$(document).ready(function(){$("a.designation").click(divClicked)}),$(document).ready(function(){$("html,body").animate({scrollTop:265},100)});