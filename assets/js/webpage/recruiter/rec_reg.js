$.validator.addMethod("regx", function (value, element, regexpr) {
    return regexpr.test(value);
}, "Number, space and special character are not allowed.");

// compnay info start
jQuery.validator.addMethod("noSpace", function (value, element) {
    return value == '' || value.trim().length != 0;
}, "No space please and don't leave it empty");


// compnay info end
$(document).ready(function () {

    $("#basicinfo").validate({

        rules: {

            first_name: {

                required: true,
                regx: /^[a-zA-Z]+$/,
                //noSpace: true

            },

            last_name: {

                required: true,
                regx: /^[a-zA-Z]+$/,
                //noSpace: true

            },

            email: {
                required: true,
                email: true,
                remote: {
                    url: base_url + "recruiter/check_email",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#email").val();
                        },
                        get_csrf_token_name: get_csrf_hash,
                    },
                },
            },
            
            comp_name: {

                required: true,
                regx: /^[a-zA-Z0-9\s]*[a-zA-Z][a-zA-Z0-9]*[-@./#&+,\w\s]/
                        //noSpace: true

            },

            comp_email: {

                required: true,
                email: true,
                remote: {
                    url: base_url + "recruiter/check_email_com",
                    type: "post",
                    data: {
                        email: function () {
                            return $("#comp_email").val();
                        },
                         get_csrf_token_name: get_csrf_hash,
                    },
                },
            },

            comp_num: {

                minlength: 8,
                maxlength: 15,
                number: true
            },
            
             comp_profile: {

                maxlength: 2500

            },
            
            
             country: {

                required: true,

            },

            state: {

                required: true,

            },

            

        },

        messages: {

            first_name: {

                required: "First name is required.",
            },

            last_name: {

                required: "Last name is required.",
            },

            email: {
                required: "Email id is required.",
                email: "Please enter valid email id.",
                remote: "Email already exists."
            },
            
            comp_name: {

                required: "Company name is required.",

            },

            comp_email: {

                required: "Email address is required.",
                email: "Please enter valid email id.",
                remote: "Email already exists."
            },

            comp_num: {

                required: "Phone no is required.",

            },
            
             country: {

                required: "Country is required.",

            },

            state: {

                required: "State is required.",

            },

            
        },
submitHandler: submitrecruiterForm
    });
});



function submitrecruiterForm()
    {
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var comp_name = $("#comp_name").val();
      var comp_email = $("#comp_email").val();
      var comp_num = $("#comp_num").val();
      var country = $("#country").val();
      var state = $("#state").val();
      var city = $("#city").val();
      var comp_profile = $("#comp_profile").val();
      
      
      var post_data = {
            'first_name': first_name,
            'last_name': last_name,
            'email': email,
            'comp_name': comp_name,
            'comp_email': comp_email,
            'comp_num': comp_num,
            'country': country,
            'state': state,
            'city': city,
            'comp_profile': comp_profile,
          //  'aileensoulnewfrontcsrf': get_csrf_hash,
        }
        
        $.ajax({
            type: 'POST',
            url: base_url + 'recruiter/reg_insert',
            dataType: 'json',
            data: post_data,
            beforeSend: function ()
            {
//                $("#register_error").fadeOut();
//                $("#btn-register").html('Sign Up');
            },
            success: function (response)
            {
               
               
                if (response.okmsg == "ok") {
                    window.location = base_url + "recruiter/home";
                } else {
                    window.location = base_url + "recruiter/rec_reg";
                }
            }
        });
         return false;
    }
// country state start


$(document).ready(function () {
    $('#country').on('change', function () {
        var countryID = $(this).val();
        
        if (countryID) {
            $.ajax({
                type: 'POST',
                url: base_url + "job_profile/ajax_data",
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
                url: base_url + "job_profile/ajax_data",
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


