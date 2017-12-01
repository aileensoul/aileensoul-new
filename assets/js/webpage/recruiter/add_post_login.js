function login_profile() {

    $('#register').modal('hide');
    $('#login').modal('show');
}
function register_profile() {
    $('#login').modal('hide');
    $('#register').modal('show');
}
function forgot_profile() {
    $('#forgotPassword').modal('show');
}


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
    $(".day").attr('tabindex', 12);
    $(".month").attr('tabindex', 13);
    $(".year").attr('tabindex', 14);
});


$(function () {
    $("#post_name").autocomplete({
        source: function (request, response) {
            var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
            response($.grep(jobdata, function (item) {
                return matcher.test(item.label);
            }));
        },
        minLength: 1,
        select: function (event, ui) {
            event.preventDefault();
            $("#post_name").val(ui.item.label);
            $("#selected-tag").val(ui.item.label);
            // window.location.href = ui.item.value;
        }
        ,
        focus: function (event, ui) {
            event.preventDefault();
            $("#post_name").val(ui.item.label);
        }
    });
});

$(function () {
    function split(val) {
        return val.split(/,\s*/);
    }
    function extractLast(term) {
        return split(term).pop();
    }

    $("#skills2").bind("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    })
            .autocomplete({
                minLength: 2,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON(base_url + "general/get_skill", {term: extractLast(request.term)}, response);
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {

                    var text = this.value;
                    var terms = split(this.value);

                    text = text == null || text == undefined ? "" : text;
                    var checked = (text.indexOf(ui.item.value + ', ') > -1 ? 'checked' : '');
                    if (checked == 'checked') {

                        terms.push(ui.item.value);
                        this.value = terms.split(", ");
                    }//if end

                    else {
                        if (terms.length <= 20) {
                            // remove the current input
                            terms.pop();
                            // add the selected item
                            terms.push(ui.item.value);
                            // add placeholder to get the comma-and-space at the end
                            terms.push("");
                            this.value = terms.join(", ");
                            return false;
                        } else {
                            var last = terms.pop();
                            $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                            $(this).effect("highlight", {}, 1000);
                            $(this).attr("style", "border: solid 1px red;");
                            return false;
                        }
                    }
                }//end else


            });
});

$(function () {
    function split(val) {
        return val.split(/,\s*/);
    }
    function extractLast(term) {
        return split(term).pop();
    }

    $("#education").bind("keydown", function (event) {
        if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete("instance").menu.active) {
            event.preventDefault();
        }
    })
            .autocomplete({
                minLength: 0,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    $.getJSON(base_url + "recruiter/get_degree", {term: extractLast(request.term)}, response);
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {

                    var terms = split(this.value);
                    if (terms.length <= 20) {
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");
                        return false;
                    } else {
                        var last = terms.pop();
                        $(this).val(this.value.substr(0, this.value.length - last.length - 2)); // removes text from input
                        $(this).effect("highlight", {}, 1000);
                        $(this).attr("style", "border: solid 1px red;");
                        return false;
                    }
                }



            });
});


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
                    var post_name = $("#post_name").val();
                    var skills = $("#skills2").val();
                    var position = $("#position").val();
                    var minyear = $("#minyear").val();
                    var maxyear = $("#maxyear").val();
                    var fresher = $("#fresher_nme").val();
                    var industry = $("#industry").val();
                    var emp_type = $("#emp_type").val();
                    var education = $("#education").val();
                    var post_desc = $("#post_desc").val();
                    var interview = $("#post_desc").val();
                    var country = $("#country").val();
                    var state = $("#state").val();
                    var city = $("#city").val();
                    var salary_type = $("#salary_type").val();
                    var datepicker = $("#example2").val();
                    var minsal = $("#minsal").val();
                    var maxsal = $("#maxsal").val();
                    var currency = $("#currency").val();

                    var post_data1 = {
                        'post_name': post_name,
                        'skills': skills,
                        'position': position,
                        'minyear': minyear,
                        'maxyear': maxyear,
                        'fresher': fresher,
                        'industry': industry,
                        'emp_type': emp_type,
                        'education': education,
                        'post_desc': post_desc,
                        'interview': interview,
                        'country': country,
                        'state': state,
                        'city': city,
                        'salary_type': salary_type,
                        'datepicker': datepicker,
                        'minsal': minsal,
                        'maxsal': maxsal,
                        'currency': currency,
                        csrf_token_name: csrf_hash
                    }
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'recruiter/add_post_insert',
                        data: post_data1,
                        dataType: "json",
                        success: function (response){
                            if(response.data == "ok") {
                                window.location = base_url + "recruiter/home";
                            }
                        }
                    });

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
    
    
    $.validator.addMethod("lowercase", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Email should be in small character");
    
      $("#register_form").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email_reg: {
                required: true,
                email: true,
                lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                remote: {
                    url: base_url + "registration/check_email",
                    type: "post",
                    data: {
                        email_reg: function () {
                            // alert("hi");
                            return $("#email_reg").val();
                        },
                        csrf_token_name: csrf_hash,
                    },
                },
            },
            password_reg: {
                required: true,
            },
            selday: {
                required: true,
            },
            selmonth: {
                required: true,
            },
            selyear: {
                required: true,
            },
            selgen: {
                required: true,
            }
        },

        groups: {
            selyear: "selyear selmonth selday"
        },
        messages:
                {
                    first_name: {
                        required: "Please enter first name",
                    },
                    last_name: {
                        required: "Please enter last name",
                    },
                    email_reg: {
                        required: "Please enter email address",
                        remote: "Email address already exists",
                    },
                    password_reg: {
                        required: "Please enter password",
                    },

                    selday: {
                        required: "Please enter your birthdate",
                    },
                    selmonth: {
                        required: "Please enter your birthdate",
                    },
                    selyear: {
                        required: "Please enter your birthdate",
                    },
                    selgen: {
                        required: "Please enter your gender",
                    }

                },
        submitHandler: submitRegisterForm
    });
    
     function submitRegisterForm()
    {
        var postid = '';
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email_reg = $("#email_reg").val();
        var password_reg = $("#password_reg").val();
        var selday = $("#selday").val();
        var selmonth = $("#selmonth").val();
        var selyear = $("#selyear").val();
        var selgen = $("#selgen").val();
        var postid = $(".post_id_login").val();
//alert(postid);
        var post_data2 = {
            'first_name': first_name,
            'last_name': last_name,
            'email_reg': email_reg,
            'password_reg': password_reg,
            'selday': selday,
            'selmonth': selmonth,
            'selyear': selyear,
            'selgen': selgen,
            csrf_token_name: csrf_hash
        }


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

        var todaydate = yyyy + '/' + mm + '/' + dd;
        var value = selyear + '/' + selmonth + '/' + selday;


        var d1 = Date.parse(todaydate);
        var d2 = Date.parse(value);
        if (d1 < d2) {
            $(".dateerror").html("Date of birth always less than to today's date.");
            return false;
        } else {
            if ((0 == selyear % 4) && (0 != selyear % 100) || (0 == selyear % 400))
            {
                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                    if (selday == 31) {
                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) { //alert("hii");
                    if (selday == 31 || selday == 30) {
                        $(".dateerror").html("This month has only 29 days.");
                        return false;
                    }
                }
            } else {
                if (selmonth == 4 || selmonth == 6 || selmonth == 9 || selmonth == 11) {
                    if (selday == 31) {
                        $(".dateerror").html("This month has only 30 days.");
                        return false;
                    }
                } else if (selmonth == 2) {
                    if (selday == 31 || selday == 30 || selday == 29) {
                        $(".dateerror").html("This month has only 28 days.");
                        return false;
                    }
                }
            }
        }
        $.ajax({
            type: 'POST',
            url: base_url + 'registration/reg_insert',
            dataType: 'json',
            data: post_data2,
            beforeSend: function ()
            {
                $("#register_error").fadeOut();
                $("#btn1").html('Create an account ...');
            },
            success: function (response)
            { 
             
                var userid = response.userid;
                if (response.okmsg == "ok") {
                 var post_name = $("#post_name").val();
                    var skills = $("#skills2").val();
                    var position = $("#position").val();
                    var minyear = $("#minyear").val();
                    var maxyear = $("#maxyear").val();
                    var fresher = $("#fresher_nme").val();
                    var industry = $("#industry").val();
                    var emp_type = $("#emp_type").val();
                    var education = $("#education").val();
                    var post_desc = $("#post_desc").val();
                    var interview = $("#post_desc").val();
                    var country = $("#country").val();
                    var state = $("#state").val();
                    var city = $("#city").val();
                    var salary_type = $("#salary_type").val();
                    var datepicker = $("#example2").val();
                    var minsal = $("#minsal").val();
                    var maxsal = $("#maxsal").val();
                    var currency = $("#currency").val();

                    var post_data1 = {
                        'post_name': post_name,
                        'skills': skills,
                        'position': position,
                        'minyear': minyear,
                        'maxyear': maxyear,
                        'fresher': fresher,
                        'industry': industry,
                        'emp_type': emp_type,
                        'education': education,
                        'post_desc': post_desc,
                        'interview': interview,
                        'country': country,
                        'state': state,
                        'city': city,
                        'salary_type': salary_type,
                        'datepicker': datepicker,
                        'minsal': minsal,
                        'maxsal': maxsal,
                        'currency': currency,
                        csrf_token_name: csrf_hash
                    }
                    $.ajax({
                        type: 'POST',
                        url: base_url + 'recruiter/add_post_insert',
                        data: post_data1,
                        dataType: "json",
                        success: function (response){
                            if(response.data == "ok") {
                                window.location = base_url + "recruiter/registration/live-post";
                            }
                        }
                    });
                 
                 
                 
                    
                    return false;
                   
                } else {
                    $("#register_error").fadeIn(1000, function () {
                        $("#register_error").html('<div class="alert alert-danger main"> <i class="fa fa-info-circle" aria-hidden="true"></i> &nbsp; ' + response + ' !</div>');
                        $("#btn1").html('Create an account');
                    });
                }

            }
        });
        return false;
    }

});