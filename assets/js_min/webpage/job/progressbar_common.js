$(document).ready(function(){var e=$("div.profile-job-post-title").length;0==e&&$("#dropdownclass").addClass("no-post-h2")}),$(document).ready(function(){$(".complete_profile").fadeIn("fast").delay(5e3).fadeOut("slow"),$(".edit_profile_job").fadeIn("slow").delay(5e3),$(".tr_text").fadeIn("slow").delay(500),$(".true_progtree img").fadeIn("slow").delay(500)}),function(e){e(".second.circle-1").circleProgress({value:count_profile_value}).on("circle-animation-progress",function(o,d){e(this).find("strong").html(Math.round(count_profile*d)+"<i>%</i>")})}(jQuery),$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal").modal("hide")}),$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal-2").modal("hide")});