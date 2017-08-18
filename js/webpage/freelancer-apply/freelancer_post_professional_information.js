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
$(function () {
                $("#tags1").autocomplete({
                    source: function (request, response) {
                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                        response($.grep(data, function (item) {
                            return matcher.test(item.label);
                        }));
                    },
                    minLength: 1,
                    select: function (event, ui) {
                        event.preventDefault();
                        $("#tags1").val(ui.item.label);
                        $("#selected-tag").val(ui.item.label);
                        // window.location.href = ui.item.value;
                    }
                    ,
                    focus: function (event, ui) {
                        event.preventDefault();
                        $("#tags1").val(ui.item.label);
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
$(function () {
    $("#searchplace1").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(data1, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#searchplace1").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#searchplace1").val(ui.item.label);
        }
    });
});
//CODE FOR AUTOFILL OF SEARCH LOCATION END    
//SKILL VALIDATION START
function imgval() {
    var skill_main = document.getElementById("skill1").value;
    var skill_other = document.getElementById("otherskill").value;
    if (skill_main == '' && skill_other == '') {
        $($("#skill1").select2("container")).addClass("keyskill_border_active");
    }
}
//SKILL VALIDATION END
//FORM FILL UP VALIDATION START
//validation for edit email formate form

jQuery.validator.addMethod("noSpace", function (value, element) {
    return value == '' || value.trim().length != 0;
}, "No space please and don't leave it empty");

$.validator.addMethod("regx", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Only space, only number and only specila characters are not allow");

$(document).ready(function () {

    $("#freelancer_post_professional").validate({
        ignore: '*:not([name])',
        //  ignore: ":hidden",
        rules: {

            field: {
                required: true,
            },
            area: {
                required: true,
            },

            'skills[]': {
                require_from_group: [1, ".keyskil"]
            },

            otherskill: {
                require_from_group: [1, ".keyskil"],
                noSpace: true
            },

            skill_description: {
                required: true,
                regx:/^["-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            experience_year: {
                require_from_group: [1, ".day"]
            },

            experience_month: {
                require_from_group: [1, ".day"],
                noSpace: true
            },

        },

        messages: {

            field: {
                required: "This field is required.",
            },

            area: {
                required: "Area is required.",
            },

            'skills[]': {
                require_from_group: "You must either fill out 'skills' or 'Other Skills'"
            },

            otherskill: {
                require_from_group: "You must either fill out 'skills' or 'Other Skills'"
            },

            skill_description: {
                required: "Skill description is required.",
            },
            experience_year: {
                require_from_group: "You must either fill out 'experience year' or 'experience month'"
            },
            experience_month: {
                require_from_group: "You must either fill out 'experience year' or 'experience month'"
            },
        }

    });
});
//FORM FILL UP VALIDATION END
//FLASH MESSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MESSAGE SCRIPT END
//CODE FOR PREELOADER START
jQuery(document).ready(function ($) {
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
        return false;
    }
}
function check() {
    var keyword = $.trim(document.getElementById('tags1').value);
    var place = $.trim(document.getElementById('searchplace1').value);
    if (keyword == "" && place == "") {
        return false;
    }
}
//CHECK SEARCH KEYWORD AND LOCATION BLANK END
//COPY-PASTE CODE START
 var _onPaste_StripFormatting_IEPaste = false;
                function OnPaste_StripFormatting(elem, e) {
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
//CODE FOR SKILL SELECTED START
 
                if (complex != '')
                {
                    $("#skill1").select2({
                        placeholder: "Select a Language",
                    }).select2('val', complex);
                }
                if (complex == '')
                {
                    $("#skill1").select2({
                        placeholder: "Select a Language",

                    });
                }
//CODE FOR SKILL SELECTED END
