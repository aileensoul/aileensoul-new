//CODE FOR COUNTRY,STATE, CITY START
$(document).ready(function () {
                    $('#country').on('change', function () {
                        var countryID = $(this).val();
                        if (countryID) {
                            $.ajax({
                                type: 'POST',
                                url:  base_url + "freelancer/ajax_data",
                                data: 'country_id=' + countryID,
                                success: function (html) {
                                    $('#state').html(html);
                                    $('#city').html('<option value="">Select state first</option>');
                                }
                            });
                        } else {
                            $('#state').html('<option value="">Select country first</option>');
                            $('#city').html('<option value="">Select state first</option>');
                        }
                    });

                    $('#state').on('change', function () {
                        var stateID = $(this).val();
                        if (stateID) {
                            $.ajax({
                                type: 'POST',
                                url:  base_url + "freelancer/ajax_data",
                                data: 'state_id=' + stateID,
                                success: function (html) {
                                    $('#city').html(html);
                                }
                            });
                        } else {
                            $('#city').html('<option value="">Select state first</option>');
                        }
                    });
                });
//CODE FOR COUNTRY,STATE,CITY END
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
//FLASH MASSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MASSAGE SCRIPT END
//FORM FILL UP VALIDATION START
 jQuery.validator.addMethod("noSpace", function (value, element) {
                    return value == '' || value.trim().length != 0;
                }, "No space please and don't leave it empty");
                $.validator.addMethod("regx", function (value, element, regexpr) {
                    return regexpr.test(value);
                }, "Only space, only number and only specila characters are not allow");
                $(document).ready(function () {
                    $("#freelancer_post_addressinfo").validate({
                        rules: {
                            country: {
                                required: true,
                            },
                            state: {
                                required: true,
                            },
                            postaladdress: {
                                required: true,
                                regx: /^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]*$/,
                            },
                        },

                        messages: {
                            country: {
                                required: "Country is required.",
                            },
                            state: {
                                required: "State is required.",
                            },
                            postaladdress: {
                                required: "Postal address is required.",
                            },
                        },
                    });
                });
//FORM FILL UP VALIADATION END
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
