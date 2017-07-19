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
//CODE FOR DEGREE DATA START
 $(document).ready(function () {
                    $('#degree').on('change', function () {
                        var degreeID = $(this).val();
                        if (degreeID) {
                            $.ajax({
                                type: 'POST',
                                url: base_url + "freelancer/ajax_data",
                                data: 'degree_id=' + degreeID,
                                success: function (html) {
                                    $('#stream').html(html);

                                }
                            });
                        } else {
                            $('#stream').html('<option value="">Select Degree first</option>');
                        }
                    });
                });
//CODE FOR DEGREE DATA END
//FOR PREELOADER START
 jQuery(document).ready(function ($) {
                    $(window).load(function () {
                        $('#preloader').fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                });
//FOR PREELOADER END
//FLASH MESSAGE SCRIPT START
$(".alert").delay(3200).fadeOut(300);
//FLASH MESSAGE SCRIPT END
//OTHER UNIVERSITY ADD START
 $(document).on('change', '.university_1', function (event) {
                    var item = $(this);
                    var uni = (item.val());
                    if (uni == 463)
                    {
                        $.fancybox.open('<div class="message"><h2>Add University</h2><input type="text" name="other_uni" id="other_uni"><a id="univer" class="btn">OK</a></div>');

                        $('.message #univer').on('click', function () {
                            var $textbox = $('.message').find('input[type="text"]'),
                                    textVal = $textbox.val();
                            $.ajax({
                                type: 'POST',
                                url:  base_url + "freelancer/freelancer_other_university" ,
                                dataType: 'json',
                                data: 'other_university=' + textVal,
                                success: function (response) {

                                    if (response.select == 0)
                                    {
                                        $.fancybox.open('<div class="message"><h2>Written University already available in University Selection</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                                    } else if (response.select == 1)
                                    {
                                        $.fancybox.open('<div class="message"><h2>Empty University is not valid</h2><button data-fancybox-close="" class="btn">OK</button></div>');
                                    } else
                                    {
                                        $.fancybox.close();

                                        $('.university_1').html(response.select);
                                    }
                                }
                            });

                        });
                    }

                });
//OTHER UNIVERSITY ADD END
//FORM FILL UP VALIDATION START
 //pattern validation at percentage start//
                $.validator.addMethod("percen", function (value, element, param) {
                    if (this.optional(element)) {
                        return true;
                    }
                    if (typeof param === "string") {
                        param = new RegExp("^(?:" + param + ")$");
                    }
                    return param.test(value);
                }, "Please Enter Percentage like 89.96.");

                //pattern validation at percentage end//
                $(document).ready(function () {

                    $("#freelancer_post_education").validate({

                        rules: {
                            percentage: {
                                number: true,
                                percen: /^([0-9]{1,2}){1}(\.[0-9]{1,2})?$/

                            },
                        },

                        messages: {
                        },

                    });
                });
//FORM FILL UP VALIDATION END
