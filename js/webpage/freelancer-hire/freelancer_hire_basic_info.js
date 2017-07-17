// CHECK SEARCH KEYWORD AND LOCATION BLANK START
                function checkvalue() {
                    var searchkeyword = $.trim(document.getElementById('tags').value);
                    var searchplace = $.trim(document.getElementById('searchplace').value);
                    if (searchkeyword == "" && searchplace == "") {
                        return false;
                    }
                }
 // CHECK SEARCH KEYWORD AND LOCATION BLANK END
 
// FORM FILL UP VALIDATION START
//validation for edit email formate form
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
                    $("#basic_info").validate({
                        rules: {
                            fname: {
                                required: true,
                                regx: /^[^-\s][a-zA-Z_\s-]+$/,
                            },
                            lname: {
                                required: true,
                                regx: /^[^-\s][a-zA-Z_\s-]+$/,
                            },
                            email: {
                                required: true,
                                email: true,
                                remote: {
                                    url: base_url() + "freelancer_hire/check_email",
                                    type: "post",
                                    data: {
                                        email: function () {
                                            return $("#email").val();
                                        },
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    },
                                },
                            },
                            phone: {
                                number: true,
                                minlength: 8,
                                maxlength: 15
                            },
                        },
                        messages: {
                            fname: {
                                required: "First name Is Required.",
                            },
                            lname: {
                                required: "Last name Is Required.",
                            },
                            email: {
                                required: "Email id is required",
                                email: "Please enter valid email id",
                                remote: "Email already exists"
                            },
                            phone: {
                                minlength: "Minimum length 8 digit",
                                maxlength: "Maximum length 15 digit"
                            }
                        },

                    });
                });

//FORM FILL UP VALIDATION END

////FOR PRELOADER START
//                jQuery(document).ready(function ($) {
//                    // site preloader -- also uncomment the div in the header and the css style for #preloader
//                    $(window).load(function () {
//                        $('#preloader').fadeOut('slow', function () {
//                            $(this).remove();
//                        });
//                    });
//                });
//
////FOR PREELOADER END

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