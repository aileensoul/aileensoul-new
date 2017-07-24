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
//CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return  false;
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
//FLASH MESSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MESSAGE SCRIPT END

//FORM FILL UP VALIDATION START
 $.validator.addMethod("regx1", function (value, element, regexpr) {
                    //return value == '' || value.trim().length != 0; 
                    if (!value)
                    {
                        return true;
                    } else
                    {
                        return regexpr.test(value);
                    }
                }, "upto 8 digit number allow");

                $(document).ready(function () {
                    $("#freelancer_post_rate").validate({
                        rules: {
                            hourly: {
                                number: true,
                                regx1: /^.{0,8}$/
                            },
                        },

                        messages: {
                        },
                    });
                });
//FORM FILL UP VALIDATION END
//FOR PREELOADER START
 jQuery(document).ready(function ($) {
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
//FOR PREELOADER END
