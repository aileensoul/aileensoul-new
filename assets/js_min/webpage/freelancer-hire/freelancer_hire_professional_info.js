function checkvalue(){var e=$.trim(document.getElementById("tags").value),t=$.trim(document.getElementById("searchplace").value);return""==e&&""==t?!1:void 0}function check(){var e=$.trim(document.getElementById("tags1").value),t=$.trim(document.getElementById("searchplace1").value);return""==e&&""==t?!1:void 0}function OnPaste_StripFormatting(e,t){if(t.originalEvent&&t.originalEvent.clipboardData&&t.originalEvent.clipboardData.getData){t.preventDefault();var a=t.originalEvent.clipboardData.getData("text/plain");window.document.execCommand("insertText",!1,a)}else if(t.clipboardData&&t.clipboardData.getData){t.preventDefault();var a=t.clipboardData.getData("text/plain");window.document.execCommand("insertText",!1,a)}else window.clipboardData&&window.clipboardData.getData&&(_onPaste_StripFormatting_IEPaste||(_onPaste_StripFormatting_IEPaste=!0,t.preventDefault(),window.document.execCommand("ms-pasteTextOnly",!1)),_onPaste_StripFormatting_IEPaste=!1)}jQuery.validator.addMethod("noSpace",function(e,t){return""==e||0!=e.trim().length},"No space please and don't leave it empty"),$.validator.addMethod("regx",function(e,t,a){return e?a.test(e):!0},"Only space, only number and only special characters are not allow"),$(document).ready(function(){$("#professional_info1").validate({rules:{professional_info:{regx:/^["-@.\/#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/}},messages:{professional_info:{required:"Professional information is required."}}})}),$(".alert").delay(3200).fadeOut(300);var _onPaste_StripFormatting_IEPaste=!1;