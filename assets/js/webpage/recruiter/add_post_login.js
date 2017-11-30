function login_profile() {
    $('#login').modal('show');
}
function register_profile() {
    $('#login').modal('hide');
    $('#register').modal('show');
}
function forgot_profile() {
    $('#forgotPassword').modal('show');
}
$(document).ready(function () {
    
        $("#login_form").validate({

        rules: {
            email_login: {
                required: true,
            },
            password_login: {
                required: true,
            }
        },
        messages:
                {
                    email_login: {
                        required: "Please enter email address",
                    },
                    password_login: {
                        required: "Please enter password",
                    }
                },
        submitHandler: submitForm
    });
        /* login submit */
    function submitForm()
    {
         var email_login = $("#email_login").val();
        var password_login = $("#password_login").val();
         var post_data = {
            'email_login': email_login,
            'password_login': password_login,
            csrf_token_name: csrf_hash
        }
          $.ajax({
            type: 'POST',
            url: base_url + 'registration/check_login',
            data: post_data,
            dataType: "json",
            beforeSend: function ()
            {
                $("#error").fadeOut();
                $("#btn1").html('Login ...');
            },
            success: function (response)
            {
                if (response.data == "ok") {
                  //  alert("login");
                    $("#btn1").html('<img src="' + base_url + 'images/btn-ajax-loader.gif" /> &nbsp; Login ...');
                 // 8-11   window.location = base_url + "job/home";
                    window.location = base_url + "recruiter/jobpost/";
                } else if (response.data == "password") {
                    $("#errorpass").html('<label for="email_login" class="error">Please enter a valid password.</label>');
                    document.getElementById("password_login").classList.add('error');
                    document.getElementById("password_login").classList.add('error');
                    $("#btn1").html('Login');
                } else {
                    $("#errorlogin").html('<label for="email_login" class="error">Please enter a valid email.</label>');
                    document.getElementById("email_login").classList.add('error');
                    document.getElementById("email_login").classList.add('error');
                    $("#btn1").html('Login');
                }
            }
        });
        return false;
    }
    
});