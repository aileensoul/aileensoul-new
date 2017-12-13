function login_profile() {

    $('#register_profile').modal('hide');
    $('#login').modal('show');
}
function register_profile() {
    $('#login').modal('hide');
    $('#register_profile').modal('show');
}
function forgot_profile() {
    $('#forgotPassword').modal('show');
}
//VALIDATION FOR ESTIMATE TIME NOT ACCEPT ONLY NUMBER END
$(document).ready(function () {
    $("#postinfo").validate({
        ignore: '*:not([name])',
        rules: {
            post_name: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            skills: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
            fields_req: {
                required: true,
            },
            post_desc: {
                required: true,
                regx: /^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/
            },
//            last_date: {
//                last_date_require: true,
//                isValid: true
//            },
//            currency: {
//                required: true,
//            },
            rate: {
                number: true,
            },
            country: {
                required: true,
            },
            state: {
                required: true,
            },
            est_time: {
                regx_num_space: /[0-9\s][a-zA-Z]/
            }

        },
        messages: {
            post_name: {
                required: "Project name is required."
            },
            skills: {
                required: "Skill is required."
            },
            fields_req: {
                required: "Please select field of requirement."
            },
            post_desc: {
                required: "Project description  is required."
            },
//            last_date: {
//                //required: "Last Date of apply is required.",
//            },
//            currency: {
//                required: "Please select currency type",
//            },
          
            country: {
                required: "Please select country."
            },
            state: {
                required: "Please select state."
            }

        },
    });
});
// FORM FILL UP VALIDATION END