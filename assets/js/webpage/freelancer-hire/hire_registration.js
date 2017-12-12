//CODE FOR COUNTRY,STATE, CITY START
$(document).ready(function () {
    $('#country').on('change', function () {
        var countryID = $(this).val();
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: base_url + "freelancer/ajax_data",
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
                url: base_url + "freelancer/ajax_data",
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

$.validator.addMethod("regx", function (value, element, regexpr) {
    if(!value){
    return true;
}else{
   
     return regexpr.test(value);
}
}, "Only space, only number and only special characters are not allow");
$(document).ready(function () {

    $("#freelancerhire_regform").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true,
                regx: /^["-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            email_reg: {
                required: true,
                email: true,
                remote: {
                    url: site + "freelancer/check_email",
                    type: "post",
                    data: {
                        email_reg: function () {
                            return $("#email_reg").val();
                        },
                         'aileensoulnewfrontcsrf': get_csrf_hash,
                    },
                },

            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            city: {
                required: true,
            }
           


        },

        messages: {
            firstname: {
                required: "First name is required."
            },
            lastname: {
                required: "Last name is required."
            },
            email: {
                required: "Email id is required.",
                email: "Please enter valid email id.",
                remote: "Email already exists."
            },
            country: {
                required: "Country is required.",
            },
            state: {
                required: "State is required.",
            },
            city: {
                required: "City is required.",
            }
        },
    });

});
//FORM FILL UP VALIDATION END

//CODE FOR COPY-PASTE START
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
//CODE FOR COPY-PASTE END
//
////DISABLE BUTTON ON ONE TIME CLICK START
$("#submit").on('click', function ()
{
    if ($('#freelancerhire_regform').valid())
    {
        $("#submit").addClass("register_disable");
        return true;
    }

});
////DISABLE CUTTON ON ONE TIME CLICK END