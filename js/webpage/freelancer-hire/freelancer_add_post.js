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
// CHECK SEARCH KEYWORD AND LOCATION BLANK START
function checkvalue() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "") {
        return false;
    }
}

function checkvalue_search() {
    var searchkeyword = $.trim(document.getElementById('tags').value);
    var searchplace = $.trim(document.getElementById('searchplace').value);
    if (searchkeyword == "" && searchplace == "")
    {
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
// CHECK SEARCH KEYWORD AND LOCATION BLANK END
//CODE FOR VALIDATION OF SKILL AND OTHER SKILL START
function imgval() {
    $("#postinfo .select2-selection").removeClass("keyskill_border_active");
    var skill_main = document.getElementById("skills").value;
    var skill_other = document.getElementById("other_skill").value;
    if (skill_main == '' && skill_other == '') {
        $("#postinfo .select2-selection").addClass("keyskill_border_active");
    }

}
//CODE FOR VALIDATION OF SKILL AND OTHER SKILL END
// FORM FILL UP VALIDATION START
 jQuery.validator.addMethod("noSpace", function (value, element) {
                return value == '' || value.trim().length != 0;
            }, "No space please and don't leave it empty");
            $.validator.addMethod("regx", function (value, element, regexpr) {
                //return value == '' || value.trim().length != 0; 
                if (!value)
                {
                    return true;
                } else
                {
                    return regexpr.test(value);
                }
                // return regexpr.test(value);
            }, "Only space, only number and only special characters are not allow");
            // for date validtaion start
            jQuery.validator.addMethod("isValid", function (value, element) {
                var todaydate = new Date();
                var dd = todaydate.getDate();
                var mm = todaydate.getMonth() + 1; //January is 0!
                var yyyy = todaydate.getFullYear();
                if (dd < 10) {
                    dd = '0' + dd
                }

                if (mm < 10) {
                    mm = '0' + mm
                }
                var todaydate = dd + '/' + mm + '/' + yyyy;
                var lastDate = $("input[name=last_date]").val();
                lastDate = lastDate.split("/");
                var lastdata_new = lastDate[1] + "/" + lastDate[0] + "/" + lastDate[2];
                var lastdata_new_one = new Date(lastdata_new).getTime();

                todaydate = todaydate.split("/");
                var todaydate_new = todaydate[1] + "/" + todaydate[0] + "/" + todaydate[2];
                var todaydate_new_one = new Date(todaydate_new).getTime();
                return lastdata_new_one >= todaydate_new_one;
            }, "Last date should be grater than and equal to today date");

            //date validation end
            $(document).ready(function () {
                $("#postinfo").validate({
                    ignore: '*:not([name])',
                    rules: {
                        post_name: {
                            required: true,
                            regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                        },

                        'skills[]': {
                            require_from_group: [1, ".keyskil"]
                        },
                        other_skill: {
                            require_from_group: [1, ".keyskil"],
                            regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                        },
                        fields_req: {
                            required: true,
                        },
                        post_desc: {
                            required: true,
                            regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
                        },
                        last_date: {
                            required: true,
                            isValid: 'Last date should be grater than and equal to today date'
                        },
                        currency: {
                            required: true,
                        },
                        rate: {
                            required: true,
                        },
                        country: {
                            required: true,
                        },
                        state: {
                            required: true,
                        }

                    },

                    messages: {
                        post_name: {
                            required: "Post name Is Required.",
                        },

                        'skills[]': {
                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'"
                        },

                        other_skill: {
                            require_from_group: "You must either fill out 'Keyskills' or 'Other Skills'"
                        },
                        fields_req: {
                            required: "Please Select Field of Requirement",
                        },
                        post_desc: {
                            required: "Post Description  Is Required.",
                        },
                        last_date: {
                            required: "Last Date of apply is required.",
                        },
                        currency: {
                            required: "Please select currency type",
                        },
                        rate: {
                            required: "Rate is Required",
                        },
                        country: {
                            required: "Please Select Country"
                        },
                        state: {
                            required: "Please Select State"
                        }

                    },

                });
            });
 // FORM FILL UP VALIDATION END
// CODE FOR COUNTRY,STATE, CITY CODE START
            $(document).ready(function () {
                $('#country').on('change', function () {
                    var countryID = $(this).val();

                    if (countryID) {
                        $.ajax({
                            type: 'POST',
                            url:  base_url + "freelancer/ajax_dataforcity",
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
                            url:  base_url + "freelancer/ajax_dataforcity",
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
// CODE FOR COUNTRY,STATE, CITY CODE END

//SELECT2 AUTOCOMPLETE START FOR SKILL
 $('#skills').select2({
                placeholder: 'Find Your Skills',
                ajax: {
                    url:  base_url + "freelancer/keyskill",
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
//SELECT2 AUTOCOMPLETE FOR SKILL END
//SCRIPT FOR COPY-PASTE START
 var _onPaste_StripFormatting_IEPaste = false;
            function OnPaste_StripFormatting(elem, e) {
                alert(456);
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
//SCRIPT FOR COPY-PASTE END

//SCRIPT FOR DATEPICKER START
  $(function () {
                var today = new Date();
                var dd = today.getDate();
                var mm = today.getMonth() + 1; //January is 0!
                var yyyy = today.getFullYear();
                var today = yyyy;
                $("#example2").dateDropdowns({
                    submitFieldName: 'last_date',
                    submitFormat: "dd/mm/yyyy",
                    minYear: today,
                    maxYear: today + 1,
                    daySuffixes: false,
                    monthFormat: "short",
                    dayLabel: 'DD',
                    monthLabel: 'MM',
                    yearLabel: 'YYYY',
                    //startDate: today,
                });

            });
//SCRIPT FOR DATEPICKER END 

