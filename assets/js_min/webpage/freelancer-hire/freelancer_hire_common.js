function updateprofilepopup(e){document.getElementById("upload-one").value=null,$("#profi_loader").hide(),document.getElementById("upload-demo-one").style.display="none",$("#bidmodal-2").modal("show")}function myFunction(){document.getElementById("upload-demo").style.visibility="hidden",document.getElementById("upload-demo-i").style.visibility="hidden",document.getElementById("message1").style.display="block"}function showDiv(){document.getElementById("row1").style.display="block",document.getElementById("row2").style.display="none"}$(function(){function e(e){return e.split(/,\s*/)}function t(t){return e(t).pop()}$(".skill_keyword").bind("keydown",function(e){e.keyCode===$.ui.keyCode.TAB&&$(this).autocomplete("instance").menu.active&&e.preventDefault()}).autocomplete({minLength:2,source:function(e,n){$.getJSON(base_url+"freelancer/freelancer_hire_search_keyword",{term:t(e.term)},n)},focus:function(){return!1},select:function(t,n){var o=e(this.value);if(o.length<=1)return o.pop(),o.push(n.item.value),o.push(""),this.value=o.join(""),!1;var l=o.pop();return $(this).val(this.value.substr(0,this.value.length-l.length-2)),$(this).effect("highlight",{},1e3),$(this).attr("style","border: solid 1px red;"),!1}})}),$(function(){function e(e){return e.split(/,\s*/)}function t(t){return e(t).pop()}$(".skill_place").bind("keydown",function(e){e.keyCode===$.ui.keyCode.TAB&&$(this).autocomplete("instance").menu.active&&e.preventDefault()}).autocomplete({minLength:2,source:function(e,n){$.getJSON(base_url+"freelancer/freelancer_search_city",{term:t(e.term)},n)},focus:function(){return!1},select:function(t,n){var o=e(this.value);if(o.length<=1)return o.pop(),o.push(n.item.value),o.push(""),this.value=o.join(""),!1;var l=o.pop();return $(this).val(this.value.substr(0,this.value.length-l.length-2)),$(this).effect("highlight",{},1e3),$(this).attr("style","border: solid 1px red;"),!1}})}),$uploadCrop1=$("#upload-demo-one").croppie({enableExif:!0,viewport:{width:157,height:157,type:"square"},boundary:{width:257,height:257}}),$("#upload-one").on("change",function(){document.getElementById("upload-demo-one").style.display="block";var e=new FileReader;e.onload=function(e){$uploadCrop1.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete")})},e.readAsDataURL(this.files[0])}),$(document).ready(function(){function e(){$uploadCrop1.croppie("result",{type:"canvas",size:"viewport"}).then(function(e){$.ajax({url:base_url+"freelancer/user_image_insert1",type:"POST",data:{image:e},beforeSend:function(){$("#profi_loader").show()},complete:function(){$document.getElementById("loader").style.display="none"},success:function(e){$("#profi_loader").hide(),$("#bidmodal-2").modal("hide"),$(".user-pic").html(e),document.getElementById("upload-one").value=null,document.getElementById("upload-demo-one").style.display="none",$(".cr-image").attr("src","#")}})})}$("#userimage").validate({rules:{profilepic:{required:!0}},messages:{profilepic:{required:"Photo Required"}},submitHandler:e})}),$uploadCrop=$("#upload-demo").croppie({enableExif:!0,viewport:{width:1250,height:350,type:"square"},boundary:{width:1250,height:350}}),$(".upload-result").off("click").on("click",function(e){document.getElementById("upload-demo").style.visibility="hidden",document.getElementById("upload-demo-i").style.visibility="hidden",document.getElementById("message1").style.display="block",$uploadCrop.croppie("result",{type:"canvas",size:"viewport"}).then(function(e){var t=e.length;return 11350==t?(document.getElementById("row2").style.display="block",document.getElementById("row1").style.display="none",document.getElementById("message1").style.display="none",document.getElementById("upload-demo").style.visibility="visible",document.getElementById("upload-demo-i").style.visibility="visible",!1):void $.ajax({url:base_url+"freelancer/ajaxpro_hire",type:"POST",data:{image:e},success:function(e){e&&($("#row2").html(e),document.getElementById("row2").style.display="block",document.getElementById("row1").style.display="none",document.getElementById("message1").style.display="none",document.getElementById("upload-demo").style.visibility="visible",document.getElementById("upload-demo-i").style.visibility="visible")}})})}),$(".cancel-result").on("click",function(e){document.getElementById("row2").style.display="block",document.getElementById("row1").style.display="none",document.getElementById("message1").style.display="none",$(".cr-image").attr("src","")}),$("#upload").on("change",function(){var e=new FileReader;e.onload=function(e){$uploadCrop.croppie("bind",{url:e.target.result}).then(function(){console.log("jQuery bind complete")})},e.readAsDataURL(this.files[0])}),$("#upload").on("change",function(){var e=new FormData;return e.append("image",$("#upload")[0].files[0]),files=this.files,size=files[0].size,files[0].name.match(/.(jpg|jpeg|png|gif)$/i)?size>26214400?(alert("Allowed file size exceeded. (Max. 25 MB)"),document.getElementById("row1").style.display="none",document.getElementById("row2").style.display="block",!1):void $.ajax({url:base_url+"freelancer/image_hire",type:"POST",data:e,processData:!1,contentType:!1,success:function(e){}}):(picpopup(),document.getElementById("row1").style.display="none",document.getElementById("row2").style.display="block",$("#upload").val(""),!1)});