function profile_pic(){if("undefined"!=typeof FormData){var e=new FormData($("#userimage")[0]);return $.ajax({url:base_url+"freelancer/user_image_add",type:"POST",data:e,contentType:!1,cache:!1,processData:!1,success:function(e){$("#bidmodal-2").modal("hide"),$(".user-pic").html(e),document.getElementById("profilepic").value=null,$("#preview").prop("src","#"),$(".popup_previred").hide()}}),!1}}function divClicked(){var e=$(this).html(),r=$("<textarea/>");r.val(e),$(this).replaceWith(r),r.focus(),r.blur(editableTextBlurred)}function capitalize(e){return e[0].toUpperCase()+e.slice(1)}function editableTextBlurred(){var e=$(this).val(),r=$("<a>");(e.match(/^\s*$/)||""==e)&&(e="Designation"),r.html(capitalize(e)),$(this).replaceWith(r),r.click(divClicked),$.ajax({url:base_url+"freelancer/designation",type:"POST",data:{designation:e},success:function(e){}})}function savepopup(e){save_user(e),$(".biderror .mes").html("<div class='pop_content'>Freelancer is successfully saved."),$("#bidmodal").modal("show")}function save_user(e){$.ajax({type:"POST",url:base_url+"freelancer/save_user1",data:"user_id="+e,success:function(r){$(".saveduser"+e).html(r).addClass("butt_rec")}})}function picpopup(){$(".biderror .mes").html("<div class='pop_content'>Please select only Image type File.(jpeg,jpg,png,gif)"),$("#bidmodal").modal("show")}function shortlistpopup(e){short_user(e),$(".biderror .mes").html("<div class='pop_content'>Freelancer successfully Shortlisted."),$("#bidmodal").modal("show")}function short_user(e){var r=document.getElementById("hideenpostid");$.ajax({type:"POST",url:base_url+"freelancer/shortlist_user",data:"user_id="+e+"&post_id="+r.value,dataType:"json",success:function(r){if($(".saveduser"+e).html(r).addClass("butt_rec"),0!=r.notification.notification_count){var a=r.notification.notification_count,t=r.notification.to_id;show_header_notification(a,t)}}})}function login_profile(){$("#register").modal("hide"),$("#login").modal("show")}function login_profile1(){$("#forgotPassword").modal("hide"),$("#login").modal("show")}function forgot_profile(){$("#login").modal("hide"),$("#forgotPassword").modal("show")}function register_profile(){$("#login").modal("hide"),$("#register").modal("show")}function submitForm(){var e=$("#email_login").val(),r=$("#password_login").val(),a={email_login:e,password_login:r};return $.ajax({type:"POST",url:base_url+"login/freelancer_hire_login",data:a,dataType:"json",beforeSend:function(){$("#error").fadeOut(),$("#btn1").html("Login ...")},success:function(e){"ok"==e.data?0==e.freelancerhire?window.location=base_url+"freelance-hire/registration":($("#btn1").html('<img src="'+base_url+'images/btn-ajax-loader.gif" /> &nbsp; Login ...'),window.location=base_url+"freelance-work/freelancer-details/"+segment3):"password"==e.data?($("#errorpass").html('<label for="email_login" class="error">Please enter a valid password.</label>'),document.getElementById("password_login").classList.add("error"),document.getElementById("password_login").classList.add("error"),$("#btn1").html("Login")):($("#errorlogin").html('<label for="email_login" class="error">Please enter a valid email.</label>'),document.getElementById("email_login").classList.add("error"),document.getElementById("email_login").classList.add("error"),$("#btn1").html("Login"))}}),!1}function submitforgotForm(){var e=$("#forgot_email").val(),r={forgot_email:e};return $.ajax({type:"POST",url:base_url+"profile/forgot_live",data:r,dataType:"json",beforeSend:function(){$("#error").fadeOut(),$("#forgotbuton").html("Your credential has been send in your register email id")},success:function(e){"success"==e.data?$("#forgotbuton").html(e.data):$("#forgotbuton").html(e.message)}}),!1}$(document).ready(function(){function e(){var e=$("#first_name").val(),r=$("#last_name").val(),a=$("#email_reg").val(),t=$("#password_reg").val(),s=$("#selday").val(),i=$("#selmonth").val(),o=$("#selyear").val(),l=$("#selgen").val(),n={first_name:e,last_name:r,email_reg:a,password_reg:t,selday:s,selmonth:i,selyear:o,selgen:l},d=new Date,u=d.getDate(),m=d.getMonth()+1,c=d.getFullYear();10>u&&(u="0"+u),10>m&&(m="0"+m);var d=c+"/"+m+"/"+u,f=o+"/"+i+"/"+s,g=Date.parse(d),h=Date.parse(f);if(h>g)return $(".dateerror").html("Date of birth always less than to today's date."),!1;if(0==o%4&&0!=o%100||0==o%400){if(4==i||6==i||9==i||11==i){if(31==s)return $(".dateerror").html("This month has only 30 days."),!1}else if(2==i&&(31==s||30==s))return $(".dateerror").html("This month has only 29 days."),!1}else if(4==i||6==i||9==i||11==i){if(31==s)return $(".dateerror").html("This month has only 30 days."),!1}else if(2==i&&(31==s||30==s||29==s))return $(".dateerror").html("This month has only 28 days."),!1;return $.ajax({type:"POST",url:base_url+"registration/reg_insert",dataType:"json",data:n,beforeSend:function(){$("#register_error").fadeOut(),$("#btn1").html("Create an account ...")},success:function(e){e.userid;"ok"==e.okmsg?window.location=base_url+"freelance-hire/registration":$("#register_error").fadeIn(1e3,function(){$("#register_error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; '+e+" !</div>"),$("#btn1").html("Create an account")})}}),!1}$("a.designation").click(divClicked),user_session||$("#register").modal("show"),$.validator.addMethod("lowercase",function(e,r,a){return a.test(e)},"Email should be in small character"),$("#register_form").validate({rules:{first_name:{required:!0},last_name:{required:!0},email_reg:{required:!0,email:!0,lowercase:/^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,remote:{url:base_url+"registration/check_email",type:"post",data:{email_reg:function(){return $("#email_reg").val()}}}},password_reg:{required:!0},selday:{required:!0},selmonth:{required:!0},selyear:{required:!0},selgen:{required:!0}},groups:{selyear:"selyear selmonth selday"},messages:{first_name:{required:"Please enter first name"},last_name:{required:"Please enter last name"},email_reg:{required:"Please enter email address",remote:"Email address already exists"},password_reg:{required:"Please enter password"},selday:{required:"Please enter your birthdate"},selmonth:{required:"Please enter your birthdate"},selyear:{required:"Please enter your birthdate"},selgen:{required:"Please enter your gender"}},submitHandler:e})}),$(document).on("keydown",function(e){27===e.keyCode&&$("#bidmodal-2").modal("hide")}),$(document).ready(function(){$("html,body").animate({scrollTop:265},100)}),$("#login_form").validate({rules:{email_login:{required:!0},password_login:{required:!0}},messages:{email_login:{required:"Please enter email address"},password_login:{required:"Please enter password"}},submitHandler:submitForm}),$("#forgot_password").validate({rules:{forgot_email:{required:!0,email:!0}},messages:{forgot_email:{required:"Email address is required."}},submitHandler:submitforgotForm});