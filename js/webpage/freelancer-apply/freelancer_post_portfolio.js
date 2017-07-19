//CODE FOR AUTOFILL OF SEARCH KEYWORD START
$(function () {
    $("#tags").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#tags").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#tags").val(ui.item.label);
        }
    });
});
//CODE FOR AUTOFILL OF SEARCH KEYWORD END  
//CODE FOR AUTOFILL OF SEARCH LOCATION START
$(function () {
    $("#searchplace").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data1, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#searchplace").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#searchplace").val(ui.item.label);
        }
    });
});
//CODE FOR AUTOFILL OF SEARCH LOCATION END     
//FLASH MASSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MASSAGE SCRIPT END
//CODE FOR PREELOADER START
jQuery(document).ready(function ($) {
                    // site preloader -- also uncomment the div in the header and the css style for #preloader
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
//CODE FOR PREELOADER END
//CHECK SEARCH KEYWORD AND LOCATION BLANK START
 function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return  false;
                    }
                }
//CHECK SEARCH KEYWORD AND LOCATION BLANK END
//COPY-PASTE CODE START
  var _onPaste_StripFormatting_IEPaste = false;
                function OnPaste_StripFormatting(elem, e) {
                    //alert(456);
                    if (e.originalEvent && e.originalEvent.clipboardData && e.originalEvent.clipboardData.getData) {
                        e.preventDefault();
                        var text = e.originalEvent.clipboardData.getData('text/plain');
                        window.document.execCommand('insertText', false, text);
                    } else if (e.clipboardData && e.clipboardData.getData) {
                        e.preventDefault();
                        var text = e.clipboardData.getData('text/plain');
                        window.document.execCommand('insertText', false, text);
                    } else if (window.clipboardData && window.clipboardData.getData) {
                        // Stop stack overflow
                        if (!_onPaste_StripFormatting_IEPaste) {
                            _onPaste_StripFormatting_IEPaste = true;
                            e.preventDefault();
                            window.document.execCommand('ms-pasteTextOnly', false);
                        }
                        _onPaste_StripFormatting_IEPaste = false;
                    }
                }
//COPY-PASTE CODE END
//DELETE PDF CODE START
 function delpdf() {
                    $.ajax({
                        type: 'POST',
                        url:  base_url + "freelancer/deletepdf",
                        success: function (data) {
                            $("#filename").text('');
                            $("#pdffile").hide();
                            document.getElementById('image_hidden_portfolio').value = '';

                        }
                    });
                }
//DELETE PDF CODE END

