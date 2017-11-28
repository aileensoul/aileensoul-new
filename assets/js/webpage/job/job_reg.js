
//validation start
$(document).ready(function () {
    // $.validator.addMethod("lowercase", function(value, element, regexpr) {          
    //          return regexpr.test(value);
    //      }, "email Should be in Small Character");


    $.validator.addMethod("regx2", function (value, element, regexpr) {

        if (!value)
        {
            return true;
        } else
        {
            return regexpr.test(value);

        }

    }, "Special character and space not allow in the beginning");

    $.validator.addMethod("regx_digit", function (value, element, regexpr) {

        if (!value)
        {
            return true;
        } else
        {

            return regexpr.test(value);

        }

    }, "Digit is not allow");

    $.validator.addMethod("regx1", function (value, element, regexpr) {

        if (!value)
        {
            return true;
        } else
        {
            return regexpr.test(value);
        }

    }, "Only space, only number and only special characters are not allow");


    $("#jobseeker_regform").validate({

        ignore: '*:not([name])',
        ignore: ":hidden",

        rules: {

            first_name: {

                required: true,
                regx2: /^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                regx_digit: /^([^0-9]*)$/,

            },

            last_name: {

                required: true,
                regx2: /^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                regx_digit: /^([^0-9]*)$/,
            },

            cities: {

                required: true,
            },

            email: {

                required: true,
                email: true,
                // lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                remote: {
                    url: base_url + "job/check_email",
                    //async is used for double click on submit avoid
                    async: false,
                    type: "post",

                },
            },

            fresher: {

                required: true,

            },

            job_title: {

                /// required: "#test2:checked",
                required: true,
                regx1: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,

            },

            industry: {

                required: true,
            },

            cities: {

                required: true,
                regx1: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
            },

            skills: {

                required: true,
                regx1: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,

            },
//            'experience_year': {
//
//                required: true
//            },
//
//            'experience_month': {
//
//                required: true
//            },

        },

        messages: {

            first_name: {

                required: "First name is required.",

            },

            last_name: {

                required: "Last name is required.",

            },

            email: {

                required: "Email address is required.",
                email: "Please enter valid email id.",
                remote: "Email already exists"
            },

            fresher: {

                required: "Fresher is required.",

            },

            industry: {

                required: "Industry is required.",

            },

            cities: {

                required: "City is required.",

            },

            job_title: {

                required: "Job title is required.",

            },

            skills: {

                required: "Skill is required.",

            },
//            'experience_year': {
//
//                required: "Experience year is required.",
//            },
//            'experience_month': {
//
//                required: "Experience month is required.",
//            },

        },

        errorPlacement: function (error, element) {
            if (element.attr("name") == "fresher") {
                $(".fresher-error").html(error);
            } else {
                error.insertAfter(element);
            }
        }
    });
});

$("#submit").on('click', function () {
    $('#experience_error').remove();
    $('.experience_month').removeClass('error');
    $('.experience_year').removeClass('error');

    var year = $('#experience_year').val();
    var month = $('#experience_month').val();
    var checked_val = $('input[name=fresher]:checked').val();
    if (checked_val == 'Experience') {
        if (year == null && month == null) {

            $('#experience_year').addClass('error');
            $('#experience_month').addClass('error');
            $('<span class="error" id="experience_error" style="float: right;color: red; font-size: 11px;">Experiance is required</span>').insertAfter('#experience_month');
            //   return false;
        } else {
            return true;
        }
    }
//    $('.experience_month').append('<label for="year-month" class="year-month" style="display: block;">Experiance is required.</label>');

});
//BUTTON SUBMIT DISABLE AFTER SOME TIME START
$("#submit").on('click', function ()
{
    /*if (!$('#jobseeker_regform').valid())
     {
     return false;
     } else
     {
     $("#submit").addClass("register_disable");
     return true;
     }*/
    if (!$('#jobseeker_regform').valid())
    {
        return false;
    }
});
//BUTTON SUBMIT DISABLE AFTER SOME TIME END

//OTHER INDUSTRY INSERT START
$(document).on('change', '#industry', function (event) {

    var item = $(this);
    var industry = (item.val());

    if (industry == 288)
    {

        item.val('');

        $('.biderror .mes').html('<h2>Add Industry</h2><input type="text" name="other_indu" id="other_indu" onkeypress="return remove_validation_stream()"><a id="indus" class="btn">OK</a>');
        $('#bidmodal').modal('show');

        //$.fancybox.open('<div class="message" style="width:300px;"><h2>Add Industry</h2><input type="text" name="other_indu" id="other_indu"><a id="indus" class="btn">OK</a></div>');

        $('.message #indus').on('click', function () {

            $("#other_indu").removeClass("keyskill_border_active");
            $('#field_error').remove();
            var x = $.trim(document.getElementById("other_indu").value);
            if (x == '') {
                $("#other_indu").addClass("keyskill_border_active");
                $('<span class="error" id="field_error" style="float: right;color: red; font-size: 11px;">Empty Field  is not valid</span>').insertAfter('#other_indu');
                return false;
            } else {
                var $textbox = $('.message').find('input[type="text"]'),
                        textVal = $textbox.val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'job/job_other_industry',
                    data: 'other_industry=' + textVal,
                    success: function (response) {

                        if (response == 0)
                        {
                            $("#other_indu").addClass("keyskill_border_active");
                            $('<span class="error" id="field_error" style="float: right;color: red; font-size: 11px;">Written industry already available in industry Selection</span>').insertAfter('#other_indu');
                        } else if (response == 1)
                        {

                            $("#other_indu").addClass("keyskill_border_active");
                            $('<span class="error" id="field_error" style="float: right;color: red; font-size: 11px;">Empty industry  is not valid</span>').insertAfter('#other_indu');
                        } else
                        {
                            //$.fancybox.close();
                            $('#bidmodal').modal('hide');
                            $('#industry').html(response);
                        }
                    }
                });
            }
        });
    }

});
//OTHER INDUSTRY INSERT END
$(document).on('keydown', function (e) {
    if (e.keyCode === 27) {
        $("#bidmodal").hide();
    }
});
function remove_validation_stream() {
    $("#other_indu").removeClass("keyskill_border_active");
    $('#field_error').remove();

}