function updateprofilepopup(t){$("#bidmodal-2").modal("show")}function divClicked(){var t=$(this).html();t=t.trim();var e=$("<textarea />");e.val(t),$(this).replaceWith(e),e.focus(),e.blur(editableTextBlurred)}function editableTextBlurred(){var t=$(this).val();t=t.trim();var e=$("<a>");(t.match(/^\s*$/)||""==t)&&(t="Current Work"),e.html(t),$(this).replaceWith(e),e.click(divClicked),$.ajax({url:base_url+"artist/art_designation",type:"POST",data:{designation:t},success:function(t){}})}function checkvalue(){var t=$.trim(document.getElementById("tags").value),e=$.trim(document.getElementById("searchplace").value);return""==t&&""==e?!1:void 0}function check(){var t=$.trim(document.getElementById("tags1").value),e=$.trim(document.getElementById("searchplace1").value);return""==t&&""==e?!1:void 0}function followuser(t){$.ajax({type:"POST",url:base_url+"artist/follow_two",data:"follow_to="+t,dataType:"json",success:function(e){if($(".fruser"+t).html(e.follow_html),0!=e.notification.notification_count){var o=e.notification.notification_count,a=e.notification.to_id;show_header_notification(o,a)}}})}function unfollowuser(t){$.ajax({type:"POST",url:base_url+"artist/unfollow_two",data:"follow_to="+t,success:function(e){$(".fruser"+t).html(e)}})}function picpopup(){$(".biderror .mes").html("<div class='pop_content'>Only Image Type Supported"),$("#bidmodal").modal("show")}$(document).ready(function(){$("a.designation").click(divClicked)}),$("#searchplace").select2({placeholder:"Find Your Location",maximumSelectionLength:1,ajax:{url:base_url+"artist/location",dataType:"json",delay:250,processResults:function(t){return{results:t}},cache:!0}}),$(document).ready(function(){$(".blocks").jMosaic({items_type:"li",margin:0}),$(".pictures").jMosaic({min_row_height:150,margin:3,is_first_big:!0})}),$(document).ready(function(){$("video").mediaelementplayer({alwaysShowControls:!1,videoVolume:"horizontal",features:["playpause","progress","volume","fullscreen"]})}),$(document).ready(function(){$("html,body").animate({scrollTop:350},100)}),$(document).on("keydown",function(t){27===t.keyCode&&$("#bidmodal-2").modal("hide")}),$(document).ready(function(){$("html,body").animate({scrollTop:265},100)});