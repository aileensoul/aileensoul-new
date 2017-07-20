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
//CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return  false;
    }
}
//CHECK SEARCH KEYWORD AND LOCATION BLANK END
//FLASH MESSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MESSAGE SCRIPT END
//FORM FILL UP VALIDATION START
 
                jQuery.validator.addMethod("noSpace", function (value, element) {
                    return value == '' || value.trim().length != 0;
                }, "No space please and don't leave it empty");

                $.validator.addMethod("regx", function (value, element, regexpr) {
                    if (!value)
                    {
                        return true;
                    } else
                    {
                        return regexpr.test(value);
                    }
                }, "Number, space and special character are not allowed");


                $(document).ready(function () {
                    $("#freelancer_post_basicinfo").validate({
                        rules: {
                            firstname: {
                                required: true,
                                regx: /^[^-\s][a-zA-Z_\s-]+$/,
                            },

                            lastname: {
                                required: true,
                                regx: /^[^-\s][a-zA-Z_\s-]+$/,
                            },

                            email: {
                                required: true,
                                email: true,
                                remote: {
                                    url:  site + "freelancer/check_email",
                                    type: "post",
                                    data: {
                                        email: function () {
                                            return $("#email").val();
                                        },
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                },
                            },

                            phoneno: {
                                number: true,
                                minlength: 8,
                                maxlength: 15
                            },

                        },

                        messages: {
                            firstname: {
                                required: "First name is required.",
                            },

                            lastname: {
                                required: "Last name is required.",
                            },

                            email: {
                                required: "Email id is required.",
                                email: "Please enter valid email id.",
                                remote: "Email already exists."
                            },

                            phoneno: {
                                minlength: "Minimum length 8 digit",
                                maxlength: "Maximum length 15 digit"

                            }

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

