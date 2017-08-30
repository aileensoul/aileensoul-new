jQuery(document).ready(function ($) {
    $(window).load(function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
});

// script for business autofill 
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
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return false;
    }
}

// end of business search auto fill 

//select2 autocomplete start for Location
$('#searchplace').select2({

    placeholder: 'Find Your Location',
    maximumSelectionLength: 1,
    ajax: {

        url: base_url + "business_profile/location",
        dataType: 'json',
        delay: 250,
        processResults: function (data) {

            return {

                results: data


            };
        },
        cache: true
    }
});
//select2 autocomplete End for Location
//validation for edit email formate form
// jQuery.validator.addMethod("noSpace", function(value, element) {
//       return value == '' || value.trim().length != 0;  
//     }, "No space please and don't leave it empty");


$.validator.addMethod("regx1", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Only numbers are allowed");
$.validator.addMethod("regx", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Only space and only number  are not allow");
$(document).ready(function () {

    $("#contactinfo").validate({

        rules: {

            contactname: {

                required: true,
                regx: /^[a-zA-Z\s]*[a-zA-Z]/
                        //noSpace: true


            },
            contactmobile: {

                //regx1:/^\d+(\.\d+)?$/
                number: true,
                minlength: 8,
                maxlength: 15

            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: base_url + "business_profile/check_email",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val();
                        },
                        get_csrf_token_name: get_csrf_hash,
                    },
                },
            },
        },
        messages: {

            contactname: {

                required: "Company name Is Required.",
            },
            contactmobile: {

                required: "Mobile number Is Required.",
            },
            email: {
                required: "Email id is required",
                email: "Please enter valid email id",
                remote: "Email already exists"
            },
        },
    });
});
// footer end 
$(".alert").delay(3200).fadeOut(300);


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
            $("#tag1").val(ui.item.label);
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

function check() {
    var keyword = $.trim(document.getElementById('tags1').value);
    var place = $.trim(document.getElementById('searchplace1').value);
    if (keyword == "" && place == "") {
        return false;
    }
}

