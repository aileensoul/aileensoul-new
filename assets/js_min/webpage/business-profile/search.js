function business_search_post(e){isProcessing||(isProcessing=!0,$.ajax({type:"POST",url:base_url+"search/ajax_business_search?page="+e+"&skills="+keyword+"&searchplace="+keyword1,data:{total_record:$("#total_record").val()},dataType:"html",beforeSend:function(){"undefined"==e||$("#loader").show()},complete:function(){$("#loader").hide()},success:function(e){$(".loader").remove(),$(".job-contact-frnd").append(e);var t=$(".post-design-box").length;0==t?$("#dropdownclass").addClass("no-post-h2"):$("#dropdownclass").removeClass("no-post-h2"),isProcessing=!1}}))}function check(){var e=$.trim(document.getElementById("tags1").value),t=$.trim(document.getElementById("searchplace1").value);return""==e&&""==t?!1:void 0}function checkvalue(){var e=$.trim(document.getElementById("tags").value),t=$.trim(document.getElementById("searchplace").value);return""==e&&""==t?!1:void 0}function post_like(e){$.ajax({type:"POST",url:base_url+"business_profile/like_post",data:"post_id="+e,dataType:"json",success:function(t){if($(".likepost"+e).html(t.like),$(".likeusername"+e).html(t.likeuser),$(".comment_like_count"+e).html(t.like_user_count),$(".likeduserlist"+e).hide(),"0"==t.like_user_total_count?document.getElementById("likeusername"+e).style.display="none":document.getElementById("likeusername"+e).style.display="block",$("#likeusername"+e).addClass("likeduserlist1"),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}function insert_comment(e){$("#post_comment"+e).click(function(){$(this).prop("contentEditable",!0),$(this).html("")});var t=$("#post_comment"+e),o=t.html();if(""==o)return!1;$("#post_comment"+e).html("");var n=document.getElementById("threecomment"+e),i=document.getElementById("fourcomment"+e);"block"===n.style.display&&"none"===i.style.display?$.ajax({type:"POST",url:base_url+"business_profile/insert_commentthree",data:"post_id="+e+"&comment="+o,dataType:"json",success:function(t){if($("textarea").each(function(){$(this).val("")}),$("#insertcount"+e).html(t.count),$(".insertcomment"+e).html(t.comment),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}}):$.ajax({type:"POST",url:base_url+"business_profile/insert_comment",data:"post_id="+e+"&comment="+o,dataType:"json",success:function(t){if($("textarea").each(function(){$(this).val("")}),$("#insertcount"+e).html(t.count),$("#fourcomment"+e).html(t.comment),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}function entercomment(e){$("#post_comment"+e).click(function(){$(this).prop("contentEditable",!0)}),$("#post_comment"+e).keypress(function(t){if(13==t.keyCode&&!t.shiftKey){t.preventDefault();var o=$("#post_comment"+e),n=o.html();if(""==n)return!1;if($("#post_comment"+e).html(""),window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500);var i=document.getElementById("threecomment"+e),s=document.getElementById("fourcomment"+e);"block"===i.style.display&&"none"===s.style.display?$.ajax({type:"POST",url:base_url+"business_profile/insert_commentthree",data:"post_id="+e+"&comment="+n,dataType:"json",success:function(t){if($("textarea").each(function(){$(this).val("")}),$(".insertcomment"+e).html(t.comment),$(".comment_count"+e).html(t.comment_count),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}}):$.ajax({type:"POST",url:base_url+"business_profile/insert_comment",data:"post_id="+e+"&comment="+n,dataType:"json",success:function(t){if($("textarea").each(function(){$(this).val("")}),$("#insertcount"+e).html(t.count),$("#fourcomment"+e).html(t.comment),$(".comment_count"+e).html(t.comment_count),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}}),$(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)})}function commentall(e){var t=document.getElementById("threecomment"+e),o=document.getElementById("fourcomment"+e),n=document.getElementById("insertcount"+e);"block"===t.style.display&&"none"===o.style.display&&(t.style.display="none",o.style.display="block",n.style.visibility="show",$.ajax({type:"POST",url:base_url+"business_profile/fourcomment",data:"bus_post_id="+e,success:function(t){$("#fourcomment"+e).html(t)}}))}function comment_like(e){$.ajax({type:"POST",url:base_url+"business_profile/like_comment",data:"post_id="+e,success:function(t){if($("#likecomment"+e).html(t),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}function comment_like1(e){$.ajax({type:"POST",url:base_url+"business_profile/like_comment1",data:"post_id="+e,success:function(t){if($("#likecomment1"+e).html(t),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}function comment_delete(e){$(".biderror .mes").html("<div class='pop_content'>Are you sure you want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='comment_deleted("+e+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function comment_deleted(e){var t=document.getElementById("post_delete"+e);$.ajax({type:"POST",url:base_url+"business_profile/delete_comment",data:"post_id="+e+"&post_delete="+t.value,dataType:"json",success:function(e){$(".insertcomment"+t.value).html(e.comment),$(".comment_count"+t.value).html(e.comment_count),$(".post-design-commnet-box").show()}})}function comment_deletetwo(e){$(".biderror .mes").html("<div class='pop_content'>Are you sure want to delete this comment?<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='comment_deletedtwo("+e+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function comment_deletedtwo(e){var t=document.getElementById("post_deletetwo"+e);$.ajax({type:"POST",url:base_url+"business_profile/delete_commenttwo",data:"post_id="+e+"&post_delete="+t.value,dataType:"json",success:function(e){$(".insertcommenttwo"+t.value).html(e.comment),$(".comment_count"+t.value).html(e.total_comment_count+" <span> Comment</span>"),$(".post-design-commnet-box").show()}})}function comment_editbox(e){document.getElementById("editcomment"+e).style.display="inline-block",document.getElementById("showcomment"+e).style.display="none",document.getElementById("editsubmit"+e).style.display="inline-block",document.getElementById("editcommentbox"+e).style.display="none",document.getElementById("editcancle"+e).style.display="block",$(".post-design-commnet-box").hide()}function comment_editcancle(e){document.getElementById("editcommentbox"+e).style.display="block",document.getElementById("editcancle"+e).style.display="none",document.getElementById("editcomment"+e).style.display="none",document.getElementById("showcomment"+e).style.display="block",document.getElementById("editsubmit"+e).style.display="none",$(".post-design-commnet-box").show()}function comment_editboxtwo(e){$("div[id^=editcommenttwo]").css("display","none"),$("div[id^=showcommenttwo]").css("display","block"),$("button[id^=editsubmittwo]").css("display","none"),$("div[id^=editcommentboxtwo]").css("display","block"),$("div[id^=editcancletwo]").css("display","none"),document.getElementById("editcommenttwo"+e).style.display="inline-block",document.getElementById("showcommenttwo"+e).style.display="none",document.getElementById("editsubmittwo"+e).style.display="inline-block",document.getElementById("editcommentboxtwo"+e).style.display="none",document.getElementById("editcancletwo"+e).style.display="block",$(".post-design-commnet-box").hide()}function comment_editcancletwo(e){document.getElementById("editcommentboxtwo"+e).style.display="block",document.getElementById("editcancletwo"+e).style.display="none",document.getElementById("editcommenttwo"+e).style.display="none",document.getElementById("showcommenttwo"+e).style.display="block",document.getElementById("editsubmittwo"+e).style.display="none",$(".post-design-commnet-box").show()}function comment_editbox3(e){document.getElementById("editcomment3"+e).style.display="block",document.getElementById("showcomment3"+e).style.display="none",document.getElementById("editsubmit3"+e).style.display="block",document.getElementById("editcommentbox3"+e).style.display="none",document.getElementById("editcancle3"+e).style.display="block",$(".post-design-commnet-box").hide()}function comment_editcancle3(e){document.getElementById("editcommentbox3"+e).style.display="block",document.getElementById("editcancle3"+e).style.display="none",document.getElementById("editcomment3"+e).style.display="none",document.getElementById("showcomment3"+e).style.display="block",document.getElementById("editsubmit3"+e).style.display="none",$(".post-design-commnet-box").show()}function comment_editbox4(e){document.getElementById("editcomment4"+e).style.display="block",document.getElementById("showcomment4"+e).style.display="none",document.getElementById("editsubmit4"+e).style.display="block",document.getElementById("editcommentbox4"+e).style.display="none",document.getElementById("editcancle4"+e).style.display="block",$(".post-design-commnet-box").hide()}function comment_editcancle4(e){document.getElementById("editcommentbox4"+e).style.display="block",document.getElementById("editcancle4"+e).style.display="none",document.getElementById("editcomment4"+e).style.display="none",document.getElementById("showcomment4"+e).style.display="block",document.getElementById("editsubmit4"+e).style.display="none",$(".post-design-commnet-box").show()}function edit_comment(e){$("#editcomment"+e).click(function(){$(this).prop("contentEditable",!0)});var t=$("#editcomment"+e),o=t.html();return""==o||"<br>"==o?!1:($.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+o,success:function(t){document.getElementById("editcomment"+e).style.display="none",document.getElementById("showcomment"+e).style.display="block",document.getElementById("editsubmit"+e).style.display="none",document.getElementById("editcommentbox"+e).style.display="block",document.getElementById("editcancle"+e).style.display="none",$("#showcomment"+e).html(t),$(".post-design-commnet-box").show()}}),void $(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)}))}function commentedit(e){$("#editcomment"+e).click(function(){$(this).prop("contentEditable",!0)}),$("#editcomment"+e).keypress(function(t){if(13==t.which&&1!=t.shiftKey){t.preventDefault();var o=$("#editcomment"+e),n=o.html();if(""==n||"<br>"==n)return!1;if(window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500),$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+n,success:function(t){document.getElementById("editcomment"+e).style.display="none",document.getElementById("showcomment"+e).style.display="block",document.getElementById("editsubmit"+e).style.display="none",document.getElementById("editcommentbox"+e).style.display="block",document.getElementById("editcancle"+e).style.display="none",$("#showcomment"+e).html(t),$(".post-design-commnet-box").show()}})}}),$(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)})}function edit_commenttwo(e){$("#editcommenttwo"+e).click(function(){$(this).prop("contentEditable",!0)});var t=$("#editcommenttwo"+e),o=t.html();return""==o||"<br>"==o?!1:($.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+o,success:function(t){document.getElementById("editcommenttwo"+e).style.display="none",document.getElementById("showcommenttwo"+e).style.display="block",document.getElementById("editsubmittwo"+e).style.display="none",document.getElementById("editcommentboxtwo"+e).style.display="block",document.getElementById("editcancletwo"+e).style.display="none",$("#showcommenttwo"+e).html(t),$(".post-design-commnet-box").show()}}),void $(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)}))}function commentedittwo(e){$("#editcommenttwo"+e).click(function(){$(this).prop("contentEditable",!0)}),$("#editcommenttwo"+e).keypress(function(t){if(13==t.which&&1!=t.shiftKey){t.preventDefault();var o=$("#editcommenttwo"+e),n=o.html();if(""==n||"<br>"==n)return!1;if(window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500),$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+n,success:function(t){document.getElementById("editcommenttwo"+e).style.display="none",document.getElementById("showcommenttwo"+e).style.display="block",document.getElementById("editsubmittwo"+e).style.display="none",document.getElementById("editcommentboxtwo"+e).style.display="block",document.getElementById("editcancletwo"+e).style.display="none",$("#showcommenttwo"+e).html(t),$(".post-design-commnet-box").show()}})}}),$(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)})}function commentedit2(e){$(document).ready(function(){$("#editcomment2"+e).keypress(function(t){if(13==t.keyCode&&!t.shiftKey){var o=$("#editcomment2"+e).val();if(t.preventDefault(),window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500),$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+o,success:function(t){document.getElementById("editcomment2"+e).style.display="none",document.getElementById("showcomment2"+e).style.display="block",document.getElementById("editsubmit2"+e).style.display="none",document.getElementById("editcommentbox2"+e).style.display="block",document.getElementById("editcancle2"+e).style.display="none",$("#showcomment2"+e).html(t)}})}})})}function edit_comment3(e){var t=document.getElementById("editcomment3"+e);$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+t.value,success:function(t){document.getElementById("editcomment3"+e).style.display="none",document.getElementById("showcomment3"+e).style.display="block",document.getElementById("editsubmit3"+e).style.display="none",document.getElementById("editcommentbox3"+e).style.display="block",document.getElementById("editcancle3"+e).style.display="none",$("#showcomment3"+e).html(t),$(".post-design-commnet-box").show()}})}function commentedit3(e){$(document).ready(function(){$("#editcomment3"+e).keypress(function(t){if(13==t.keyCode&&!t.shiftKey){var o=$("#editcomment3"+clicked_id).val();if(t.preventDefault(),window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500),$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+o,success:function(t){document.getElementById("editcomment3"+e).style.display="none",document.getElementById("showcomment3"+e).style.display="block",document.getElementById("editsubmit3"+e).style.display="none",document.getElementById("editcommentbox3"+e).style.display="block",document.getElementById("editcancle3"+e).style.display="none"}})}})})}function edit_comment4(e){var t=document.getElementById("editcomment4"+e);$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+t.value,success:function(t){document.getElementById("editcomment4"+e).style.display="none",document.getElementById("showcomment4"+e).style.display="block",document.getElementById("editsubmit4"+e).style.display="none",document.getElementById("editcommentbox4"+e).style.display="block",document.getElementById("editcancle4"+e).style.display="none",$("#showcomment4"+e).html(t)}})}function commentedit4(e){$(document).ready(function(){$("#editcomment4"+e).keypress(function(t){if(13==t.keyCode&&!t.shiftKey){var o=$("#editcomment4"+clicked_id).val();if(t.preventDefault(),window.preventDuplicateKeyPresses)return;window.preventDuplicateKeyPresses=!0,window.setTimeout(function(){window.preventDuplicateKeyPresses=!1},500),$.ajax({type:"POST",url:base_url+"business_profile/edit_comment_insert",data:"post_id="+e+"&comment="+o,success:function(t){document.getElementById("editcomment4"+e).style.display="none",document.getElementById("showcomment4"+e).style.display="block",document.getElementById("editsubmit4"+e).style.display="none",document.getElementById("editcommentbox4"+e).style.display="block",document.getElementById("editcancle4"+e).style.display="none",$("#showcomment4"+e).html(t)}})}})})}function myFunction1(e){var t=document.getElementById("myDropdown"+e).className;t=t.split(" ").pop(-1),"show"!=t?($(".dropdown-content1").removeClass("show"),$("#myDropdown"+e).addClass("show")):$(".dropdown-content1").removeClass("show"),$(document).on("keydown",function(t){27===t.keyCode&&(document.getElementById("myDropdown"+e).classList.toggle("hide"),$(".dropdown-content1").removeClass("show"))})}function read(e){return function(t){var o=t.target.result,n=$("<img/>",{src:o,title:encodeURIComponent(e.name),"class":"thumb"}),i=$("<span/>",{html:n,"class":"thumbParent"}).append('<span class="remove_thumb"/>');thumbsArray.push(o),$list.append(i)}}function handleFileSelect(e){e.preventDefault();var t=e.target.files,o=t.length;if(o>maxUpload||thumbsArray.length>=maxUpload)return alert("Sorry you can upload only 5 images");for(var n=0;o>n;n++){var i=t[n];if(i.type.match("image.*")){var s=new FileReader;s.onload=read(i)}}}function check_length(e){if(maxLen=50,e.my_text.value.length>=maxLen){var t="You have reached your maximum limit of characters allowed";alert(t),e.my_text.value=e.my_text.value.substring(0,maxLen)}else e.text_num.value=maxLen-e.my_text.value.length}function editpost(e){document.getElementById("editpostdata"+e).style.display="none",document.getElementById("editpostbox"+e).style.display="block",document.getElementById("editpostdetails"+e).style.display="none",document.getElementById("editpostdetailbox"+e).style.display="block",document.getElementById("editpostsubmit"+e).style.display="block"}function edit_postinsert(e){var t=document.getElementById("editpostname"+e),o=($("#editpostdesc"+e),$("#editpostdesc"+e).html());""==t.value&&""==o?($(".biderror .mes").html("<div class='pop_content'>You must either fill title or description."),$("#bidmodal").modal("show"),document.getElementById("editpostdata"+e).style.display="block",document.getElementById("editpostbox"+e).style.display="none",document.getElementById("editpostdetails"+e).style.display="block",document.getElementById("editpostdetailbox"+e).style.display="none",document.getElementById("editpostsubmit"+e).style.display="none"):$.ajax({type:"POST",url:base_url+"business_profile/edit_post_insert",data:"business_profile_post_id="+e+"&product_name="+t.value+"&product_description="+o,dataType:"json",success:function(t){document.getElementById("editpostdata"+e).style.display="block",document.getElementById("editpostbox"+e).style.display="none",document.getElementById("editpostdetails"+e).style.display="block",document.getElementById("editpostdetailbox"+e).style.display="none",document.getElementById("editpostsubmit"+e).style.display="none",$("#editpostdata"+e).html(t.title),$("#editpostdetails"+e).html(t.description)}})}function save_post(e){$.ajax({type:"POST",url:base_url+"business_profile/business_profile_save",data:"business_profile_post_id="+e,success:function(t){$(".savedpost"+e).html(t)}})}function remove_post(e){$.ajax({type:"POST",url:base_url+"business_profile/business_profile_deletepost",data:"business_profile_post_id="+e,success:function(t){$("#removepost"+e).html(t)}})}function del_particular_userpost(e){$.ajax({type:"POST",url:base_url+"business_profile/del_particular_userpost",data:"business_profile_post_id="+e,success:function(t){$("#removepost"+e).html(t),$("#removepost"+e).remove}})}function followuser_two(e){$.ajax({type:"POST",url:base_url+"business_profile/follow_two",data:"follow_to="+e+"&profile_slug="+slug_id,dataType:"json",success:function(t){if($(".fruser"+e).html(t.follow_html),$(".left_box_following_count").html("("+t.following_count+")"),$(".left_box_follower_count").html("("+t.follower_count+")"),0!=t.notification.notification_count){var o=t.notification.notification_count,n=t.notification.to_id;show_header_notification(o,n)}}})}function unfollowuser_two(e){$.ajax({type:"POST",url:base_url+"business_profile/unfollow_two",data:"follow_to="+e+"&profile_slug="+slug_id,dataType:"json",success:function(t){$(".fruser"+e).html(t.unfollow_html),$(".left_box_following_count").html("("+t.unfollowing_count+")"),$(".left_box_follower_count").html("("+t.unfollower_count+")")}})}function followclose(e){$("#fad"+e).fadeOut(4e3)}function imgval(e){var t=document.getElementById("test-upload").files,o=document.getElementById("test-upload-product").value,n=document.getElementById("test-upload-des").value,i=document.getElementById("test-upload").value;if(""==i&&""==o&&""==n)return $(".biderror .mes").html("<div class='pop_content'>This post appears to be blank. Please write or attach (photos, videos, audios, pdf) to post."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1;for(var s=0;s<t.length;s++){var l=t[s].name,d=t[0].name,c=d.split(".").pop(),a=l.split(".").pop(),m=["jpg","jpeg","png","gif"],r=["mp4","webm"],u=["mp3"],p=["pdf"],y=$.inArray(c,m)>-1,f=$.inArray(c,r)>-1,h=$.inArray(c,u)>-1,_=$.inArray(c,p)>-1;if(1==y){var b=$.inArray(a,m)>-1;if(!(1==b&&t.length<=10))return $(".biderror .mes").html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1}else{if(0==f)return $(".biderror .mes").html("<div class='pop_content'>This File Format is not supported Please Try to Upload MP4 or WebM files.."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1;if(1==f){var b=$.inArray(a,r)>-1;if(1!=b||1!=t.length)return $(".biderror .mes").html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1}else if(1==h){var b=$.inArray(a,u)>-1;if(1!=b||1!=t.length)return $(".biderror .mes").html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1}else if(1==_){var b=$.inArray(a,p)>-1;if(1!=b||1!=t.length)return $(".biderror .mes").html("<div class='pop_content'>sorry this is not valid file for this post please try to uplode in new post."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1;if(""==o)return $(".biderror .mes").html("<div class='pop_content'>You have to add pdf title."),$("#bidmodal").modal("show"),setInterval("window.location.reload()",1e4),e.preventDefault(),!1}}}}function contentedit(e){$("#post_comment"+e).click(function(){$(this).prop("contentEditable",!0),$(this).html("")}),$("#post_comment"+e).keypress(function(t){if(13==t.which&&1!=t.shiftKey){t.preventDefault();var o=$("#post_comment"+e),n=o.html();$("#post_comment"+e).html("");var i=document.getElementById("threecomment"+e),s=document.getElementById("fourcomment"+e);"block"===i.style.display&&"none"===s.style.display?$.ajax({type:"POST",url:base_url+"business_profile/insert_commentthree",data:"post_id="+e+"&comment="+n,dataType:"json",success:function(t){$("input").each(function(){$(this).val("")}),$("#insertcount"+e).html(t.count),$(".insertcomment"+e).html(t.comment)}}):$.ajax({type:"POST",url:base_url+"business_profile/insert_comment",data:"post_id="+e+"&comment="+n,success:function(t){$("input").each(function(){$(this).val("")}),$("#fourcomment"+e).html(t)}})}}),$(".scroll").click(function(e){e.preventDefault(),$("html,body").animate({scrollTop:$(this.hash).offset().top},1200)})}function likeuserlist(e){$.ajax({type:"POST",url:base_url+"business_profile/likeuserlist",data:"post_id="+e,dataType:"html",success:function(e){var t=e;$("#likeusermodal .mes").html(t),$("#likeusermodal").modal("show")}})}function user_postdelete(e){$(".biderror .mes").html("<div class='pop_content'> Are You Sure want to delete this post?.<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='remove_post("+e+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function user_postdeleteparticular(e){$(".biderror .mes").html("<div class='pop_content'> Are You Sure want to delete this post from your profile?.<div class='model_ok_cancel'><a class='okbtn' id="+e+" onClick='del_particular_userpost("+e+")' href='javascript:void(0);' data-dismiss='modal'>Yes</a><a class='cnclbtn' href='javascript:void(0);' data-dismiss='modal'>No</a></div></div>"),$("#bidmodal").modal("show")}function myFunction(e){document.getElementById("myDropdown"+e).classList.toggle("show")}$(document).ready(function(){business_search_post(),$(window).scroll(function(){if($(window).scrollTop()>=.7*($(document).height()-$(window).height())){var e=$(".page_number:last").val(),t=$(".total_record").val(),o=$(".perpage_record").val();if(parseInt(o)<=parseInt(t)){var n=t/o;n=parseInt(n,10);var i=t%o;if(i>0&&(n+=1),parseInt(e)<=parseInt(n)){var s=parseInt($(".page_number:last").val())+1;business_search_post(s)}}}})});var isProcessing=!1,text=document.getElementById("search").value;$(".search").highlite({text:text}),$("#searchplace").select2({placeholder:"Find Your Location",maximumSelectionLength:1,ajax:{url:base_url+"business_profile/location",dataType:"json",delay:250,processResults:function(e){return{results:e}},cache:!0}});var modal=document.getElementById("myModal"),btn=document.getElementById("myBtn"),span=document.getElementsByClassName("close1")[0];btn.onclick=function(){modal.style.display="block"},span.onclick=function(){modal.style.display="none"},window.onclick=function(e){e.target==modal&&(modal.style.display="none")},window.onclick=function(e){if(!e.target.matches(".dropbtn1")){var t,o=document.getElementsByClassName("dropdown-content1");for(t=0;t<o.length;t++){var n=o[t];n.classList.contains("show")&&n.classList.remove("show")}}};var $fileUpload=$("#files"),$list=$("#list"),thumbsArray=[],maxUpload=5;$fileUpload.change(function(e){alert("aaaa"),handleFileSelect(e)}),$list.on("click",".remove_thumb",function(){var e=$(".remove_thumb"),t=e.index(this);$(this).closest("span.thumbParent").remove(),thumbsArray.splice(t,1)}),$("#file-fr").fileinput({language:"fr",uploadUrl:"#",allowedFileExtensions:["jpg","png","gif"]}),$("#file-es").fileinput({language:"es",uploadUrl:"#",allowedFileExtensions:["jpg","png","gif"]}),$("#file-0").fileinput({allowedFileExtensions:["jpg","png","gif"]}),$("#file-1").fileinput({uploadUrl:"#",allowedFileExtensions:["jpg","png","gif"],overwriteInitial:!1,maxFileSize:1e3,maxFilesNum:10,slugCallback:function(e){return e.replace("(","_").replace("]","_")}}),$("#file-3").fileinput({showUpload:!1,showCaption:!1,browseClass:"btn btn-primary btn-lg",fileType:"any",previewFileIcon:"<i class='glyphicon glyphicon-king'></i>",overwriteInitial:!1,initialPreviewAsData:!0,initialPreview:["http://lorempixel.com/1920/1080/transport/1","http://lorempixel.com/1920/1080/transport/2","http://lorempixel.com/1920/1080/transport/3"],initialPreviewConfig:[{caption:"transport-1.jpg",size:329892,width:"120px",url:"{$url}",key:1},{caption:"transport-2.jpg",size:872378,width:"120px",url:"{$url}",key:2},{caption:"transport-3.jpg",size:632762,width:"120px",url:"{$url}",key:3}]}),$("#file-4").fileinput({uploadExtraData:{kvId:"10"}}),$(".btn-warning").on("click",function(){var e=$("#file-4");e.attr("disabled")?e.fileinput("enable"):e.fileinput("disable")}),$(".btn-info").on("click",function(){$("#file-4").fileinput("refresh",{previewClass:"bg-info"})}),$(document).ready(function(){$("#test-upload").fileinput({showPreview:!1,allowedFileExtensions:["jpg","png","gif"],elErrorContainer:"#errorBlock"}),$("#kv-explorer").fileinput({theme:"explorer",uploadUrl:"#",overwriteInitial:!1,initialPreviewAsData:!0,initialPreview:["http://lorempixel.com/1920/1080/nature/1","http://lorempixel.com/1920/1080/nature/2","http://lorempixel.com/1920/1080/nature/3"],initialPreviewConfig:[{caption:"nature-1.jpg",size:329892,width:"120px",url:"{$url}",key:1},{caption:"nature-2.jpg",size:872378,width:"120px",url:"{$url}",key:2},{caption:"nature-3.jpg",size:632762,width:"120px",url:"{$url}",key:3}]})}),$(document).ready(function(){$(".modal-close").on("click",function(){$(".modal-post").hide()})}),$("body").on("click","*",function(e){var t=$(e.target).attr("class").toString().split(" ").pop();"fa-ellipsis-v"!=t&&$("div[id^=myDropdown]").hide().removeClass("show")}),$("body").on("touchstart",function(e){var t=$(e.target).attr("class").toString().split(" ").pop();"fa-ellipsis-v"!=t&&$("div[id^=myDropdown]").hide().removeClass("show")}),window.onclick=function(e){if(!e.target.matches(".dropbtn1")){var t,o=document.getElementsByClassName("dropdown-content1");for(t=0;t<o.length;t++){var n=o[t];n.classList.contains("show")&&n.classList.remove("show")}}},$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal").modal("hide")});